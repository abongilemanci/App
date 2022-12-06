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
            <img class="mb-1" src="./assets/imgs/png/signup.png" alt="" width="100" height="100">
            <h1 class="h1 text-uppercase mb- fw-normal">REGISTRATION</h1>
        </div>

        <?php echo $msg; ?>

        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" data-bs-title="Must be valid and active email e.g user@host.com">
            <input type="email" name="email" id="tx-email" class="form-control" placeholder="name@example.com" required autocomplete="" autofocus />
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" data-bs-title="Is required, must contain alphabets(a-z A-Z) only and a minimum 3 or more characters">
            <input type="text" name="user" id="tx-user" class="form-control" placeholder="John" required />
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="right" data-bs-title="Is required, and contain more 6 or characters">
            <input type="password" name="password" id="tx-password" class="form-control" placeholder="Password" min="6" required />
            <label for="floatingPassword">Password</label>
        </div>


        <button class="w-100 btn btn-success mt-3" type="submit" name="registration">
            SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
        </button>


        <p class="my-4">
            Already registered?
            <a href="./signin.php" class="btn-link text-primary h6">
                Login here
            </a>
        </p>
    </form>
</div>
<?php
include "./layouts/footer.php";
?>