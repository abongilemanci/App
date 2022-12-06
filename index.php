<?php
    session_start();
    if(!isset($_GET['appname'])){
        $app = "Welcome to my application";
    }
    else{
        $app = $get['app'];
    }
?>

    <!-- Navigation -->
    <?php
        require './layouts/header.php';
        // if(!isset($_SESSION['user_data'])){
        //     include"./layouts/index/nav.php";
        // }
    ?>
    <!-- main content -->
    <main class="container">
        <div id="content" style="height:88vh">
            <?php include"./layouts/index/content.php"; ?>
        </div>
    </main>
    <?php
        include"./layouts/index/foot.php";
    ?>
    <script src="./assets/js/bs/bootstrap.bundle.min.js"></script>
</body>
</html>