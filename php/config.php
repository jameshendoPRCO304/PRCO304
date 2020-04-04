<?php
//* Database credentials.
define('DB_SERVER', 'proj-mysql.uopnet.plymouth.ac.uk');
define('DB_USERNAME', 'PRCO304_JHenderson');
define('DB_PASSWORD', 'Yy8XnUmfde2zEHTJ');
define('DB_NAME', 'PRCO304_JHenderson');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>