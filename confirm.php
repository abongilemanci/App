<?php

//Include script
include_once "./includes/authController.php";
$app = "Account Registration";
$msg = '<div class="alert alert-info">Create new account</div>';

if (isset($_GET['msg'])) {
    $msg = '<div class="alert alert-success">' . $_GET['msg'] . '</div>';
}
if (isset($_GET['err'])) {
    $msg = '<div class="alert alert-danger">' . $_GET['err'] . '</div>';
}
require_once "./layouts/header.php";

$u=''; 
$t='';
if(isset($_GET['usr'])&&isset($_GET['tkn'])){
    $u=$_GET['usr'];
    $t=$_GET['tkn'];
}
?>
<!-- main content -->
<div class="form-signin text-center">
    <form id="frm-signup" action="confirm.php" method="POST">
        <div class="text-center">
            <img class="mb-4" src="./assets/imgs/png/confirm.png" alt="" width="100" height="100">
            <h1 class="h2 text-uppercase mb-3 fw-normal">CONFIRMATION</h1>
        </div>
        <?php echo $msg; ?>

        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-title="Paste confirmation token code">
            <input type="number" name="otp" id="tx-otp" class="form-control" minlength="6" maxlength="6" placeholder="999999" required autocomplete="" autofocus />
            <label for="floatingInput">Token code</label>
        </div>
        <input type="text" class="form-control" value="<?= $u ?>" hidden name="user">
        <input type="text" class="form-control" value="<?= $t ?>" hidden name="token">
        <!-- <div class="text-left my-2"> -->
        <!-- <a href="./signin.php" class="btn-link text-primary h6" data-bs-toggle="modal" data-bs-target="#md-resend">
                    Request new token
                </a>
            </div> -->

        <button class="w-100 btn btn-success mt-3" type="submit" name="confirm">
            SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
        </button>

        <div class="text-center">
            <p class="my-3">
                <a href="./signup.php" class="btn-link text-primary btn-sm">
                    Not registered yet? Signup here
                </a>
            </p>
            <p class="my-3">
                <a href="./signin.php" class="btn-link text-primary btn-sm">
                    Already registered? Signin here
                </a>
            </p>
        </div>
        <?php
        include "./layouts/index/foot.php";
        ?>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="md-resend" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    RESEND OTP
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frm-signup" action="verify.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" id="tx-email" class="form-control" placeholder="name@example.com" required />
                        <label for="floatingInput">Email address</label>
                    </div>


                    <button class="w-100 btn btn-success" type="submit" name="sign">
                        SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php
include "./layouts/footer.php";
?>