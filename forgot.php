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

?>
    <!-- main content -->
    <div class="form-signin text-center">
        <form id="frm-signup" action="signup.php" method="POST">
            <div class="text-center">
                <img class="mb-4" src="./assets/imgs/png/signup.png" alt="" width="100" height="100">
                <h1 class="h2 text-uppercase mb- fw-normal">RECOVERY</h1>
            </div>

            <?php echo $msg; ?>
            <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Is required, and contain more 6 or characters">
                <input type="password" name="password" id="tx-password" class="form-control" placeholder="Password" min="6" required />
                <label for="floatingPassword">New Password*</label>
            </div>
            <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Is required, and contain more 6 or characters">
                <input type="password" name="repassword" id="tx-repassword" class="form-control" placeholder="Password" min="6" required />
                <label for="floatingPassword">Confirm New Password*</label>
            </div>


            <button class="w-100 btn btn-success mt-1" type="submit" name="register">
                SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
            </button>

            <div class="my-3">
                Not registered yet?
                <a href="./signup.php" class="btn-link text-primary h6">
                    Signup now
                </a>
            </div>
            <p class="my-3">
                Already registered?
                <a href="./signin.php" class="btn-link text-primary h6">
                    Login
                </a>
            </p>
        </form>
    </div>
<?php
include "./layouts/footer.php";
?>