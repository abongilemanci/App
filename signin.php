<?php

//Include script
include_once "./includes/authController.php";
$app = "Account Login";
$msg = '<div class="alert alert-info">Signin to access your account</div>';

if (isset($_GET['msg'])) {
    $msg = '<div class="alert alert-success">' . $_GET['msg'] . '</div>';
}
if (isset($_GET['err'])) {
    $msg = '<div class="alert alert-danger">' . $_GET['err'] . '</div>';
}

require_once "./layouts/header.php";
?>

<!-- main content -->
<div class="form-signin">
    <form id="frm-signup" action="signin.php" method="POST">
        <div class="text-center">
            <img class="mb-4" src="./assets/imgs/png/sign.png" alt="" width="100" height="100">
            <h1 class="h2 text-uppercase mb-3 fw-normal">SIGN IN</h1>
        </div>

        <?php echo $msg; ?>

        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Is required and must be valid and active email e.g user@host.com">
            <input type="email" name="email" id="tx-email" class="form-control" placeholder="name@example.com" required />
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Is required, and contain more 6 or characters">
            <input type="password" name="password" id="tx-password" class="form-control" placeholder="Password" min="6" required />
            <label for="floatingPassword">Password</label>
        </div>

        <p class="my-2 mb-4 text-left">
            <a href="./recover.php" class="btn-link text-primary h6">
                Forgot password?
            </a>
        </p>


        <button class="w-100 btn btn-success" type="submit" name="auth">
            SUBMIT <i class="fas fa-arrow-right fa-pull-right pt-1"></i>
        </button>
        <p class="my-3 text-center">
            Already registered?
            <a href="./signup.php" class="btn-link text-primary h6">
                Signup now
            </a>
        </p>
        <?php
        include "./layouts/index/foot.php";
        ?>
    </form>
</div>
<script src=<?php
            include "./layouts/footer.php";
            ?>