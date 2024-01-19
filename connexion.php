<?php session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'nlerond_utilisateur');
define('DB_PASSWORD', 'utilisateur123');
define('DB_NAME', 'nlerond_datavisualisation');

$bdd = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
