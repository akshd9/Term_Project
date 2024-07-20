<?php require_once "scripts/session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <style>
        nav a.nav-link {
            color: #fff !important;
        }
    </style>

    <title>Home Services</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Home Services</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login &nbsp;
                        </a>
                        <div class="dropdown-menu" aria-labelledby="loginDropdown">
                            <a class="dropdown-item" href="providerlogin.php">Login as Provider</a>
                            <a class="dropdown-item" href="login.php">Login as Admin</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Find Service Provider &nbsp; |</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register Service Provider &nbsp; |</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About &nbsp; </a>
                    </li>
                    
                <?php elseif ($_SESSION['user']->name == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="managehall.php">Manage Providers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Manage Booking &nbsp; &nbsp; &nbsp; </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item" style="text-align: right;">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Include Bootstrap JS (necessary for the dropdown to work) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
