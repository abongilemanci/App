<?php

//Include script
include_once "./includes/authController.php";
$app = "Account Registration";
$msg = '<div class="alert alert-info">Recover your account</div>';

if (isset($_GET['msg'])) {
    $msg = '<div class="alert alert-success">' . $_GET['msg'] . '</div>';
}
if (isset($_GET['err'])) {
    $msg = '<div class="alert alert-danger">' . $_GET['err'] . '</div>';
}
require_once "./layouts/header.php";

?>
<!-- main content -->
<div class="form-signin text-center">
    <form id="frm-signup" action="recover.php" method="POST">
        <div class="text-center">
            <img class="mb-4" src="./assets/imgs/png/forgot.png" alt="" width="100" height="100">
            <h1 class="h2 text-uppercase mb-3 fw-normal">RECOVERY</h1>
        </div>
        <?php echo $msg; ?>

<div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" data-bs-title="Must be valid and active email e.g user@host.com">
    <input type="email" name="email" id="tx-email" class="form-control" placeholder="name@example.com" required autocomplete="" autofocus />
    <label for="floatingInput">Email address</label>
</div>


        <button class="w-100 btn btn-success mt-3" type="submit" name="recovery">
            SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
        </button>

        <div class="my-3">
            <a href="./signup.php" class="btn-link text-primary h6">
                Not registered yet? Signup here
            </a>
        </div>
        <div class="my-3">
            <a href="./signin.php" class="btn-link text-primary h6">
                Already registered? Signin here
            </a>
        </div>
    </form>
</div>
<?php
include "./layouts/footer.php";
?>