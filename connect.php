<?php

    $dsn = "mysql:host=localhost;dbname=camagru";
    $user = "root";
    $pass = "";
    try
    {
        $con = new PDO($dsn, $user, $pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>