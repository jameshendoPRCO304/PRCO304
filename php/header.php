<?php session_start();

// Include config file
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)); ?> | Web App</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="welcome.php">Web App</a>
        </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a><?php if (isset($_SESSION["username"])) {
                            echo 'Logged in as <b>' . $_SESSION["username"] . '</b>';
                        } ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if (isset($_SESSION["id"])) {
                            echo '<li><a href="reset-password.php">Reset password</a></li>';
                            echo '<li role="separator" class="divider"></li>';
                            echo '<li><a href="logout.php">logout</a></li>';
                        } ?>

                        <?php if (!isset($_SESSION["id"])) {
                            echo '<li><a href="login.php">Login</a></li>';
                            echo '<li><a href="register.php">Register</a></li>';
                        } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
