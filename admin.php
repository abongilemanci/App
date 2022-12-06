<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header('location:signin.php');
} else {
    $user_data = $_SESSION['user_data'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>MyApplication | Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">



    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bs/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./assets/css/bs/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/dashboard.css" rel="stylesheet">
    <link href="./assets/css/fa/css/all.min.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">MyApplication</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="email" placeholder="Search user by email" aria-label="Search" id="txtSearch">
        <button type="button" class="btn btn-success" id="btnSearch">
            <i class="fa fa-search fa-flip-horizontal fa-lg"></i>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="./scripts/logout.php ">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column text-uppercase">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./dashboard.php">
                                <span class="fas fa-home"></span>
                                Dashboard
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                My Application User Profiles
                            </div>
                            <div class="table-responsive text-center">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">username</th>
                                            <th scope="col">Email address</th>
                                            <th scope="col">User Type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <span id="user-list"></span>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="./assets/css/bs/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="dashboard.js"></script> -->
    <script>
        $(document).ready(function() {
            getUsers()
        });

        function getUsers() {
            $.ajax({
                url: "./includes/adminController.php",
                method: "POST",
                data: {
                    getUser: 1
                },
                success: function(response) {
                    $('#user-list').html(response);
                }
            });
        }

        $('#btnSearch').click(function(e) {
            e.preventDefault();
            var key = $("#txtSearch").val();
            if (key != "") {
                $.ajax({
                    url: "./includes/adminController.php",
                    method: "POST",
                    data: {
                        key: key,
                        searchUser: 1
                    },
                    success: function(response) {
                        $('#user-list').html(response);
                    }
                });
            }
        });

        $(document).delegate('.btnDelete', 'click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: "./includes/adminController.php",
                method: "POST",
                data: {
                    id: id,
                    deleteUser: 1
                },
                success: function(response) {
                    alert(response);
                    location.href = "./admin.php"
                    // $('#user-list').html(response);
                }
            });
        });
    </script>
</body>

</html>
