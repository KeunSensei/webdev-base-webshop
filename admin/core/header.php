<?php
    include($_SERVER['DOCUMENT_ROOT'].'/base_cms/core/db_connect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/base_cms/admin/core/functions.php');

    define("CURHREF", filter_var( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],FILTER_SANITIZE_STRING));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Webshop</title>
</head>
<body>