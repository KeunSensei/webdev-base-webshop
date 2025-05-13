<?php
session_start();

/**
 * Voor de MAC gebruikers;
 */
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "base_cms";

/**
 * Voor de Windows gebruikers;
 */
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "webshop";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}

define("BASEURL","http://localhost/base_cms/");
define("BASEURL_CMS","http://localhost/base_cms/admin/");

function prettyDump ( $var ) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}