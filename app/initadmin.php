<?php
    ob_start();
    session_start();
    include "config/config.php";
    include "includes/functions/functions.php";
    include "libs/database.php";
    include 'libs/controller.php';
    include 'libs/core.php';
    include 'views/admin/header.php';
    $init = new core('admin');
?>
