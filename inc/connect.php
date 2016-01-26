<?php

// Database configuration
$dbname = 'db_name';
$user = 'db_user';
$pass = 'db_pass';
$host = 'localhost';

// Try to connect the database
try {

    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOexception $e) {

    echo $e->getMessage();

}
