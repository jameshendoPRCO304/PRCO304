<?php include("header.php"); ?>
<?php include("auth.php"); ?>

    <div class="page-header text-center">
        <h1 class="">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p class="text-center">
        <a href="results.php" class="btn btn-primary btn-block">Go to Final Results</a>
    </p>
    <p>&nbsp;</p>
    <p class="text-center">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
<?php include("footer.php"); ?>