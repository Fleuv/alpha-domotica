<?php

// Database configuration
$dbname = 'custom_idp_project';
$user = 'root';
$pass = 'r158Lwb5E4j34pA';
$host = 'localhost';

// Try to connect the database
try {

    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOexception $e) {

    echo $e->getMessage();

}
