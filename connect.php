<?php

// Database configuration
$dbname = 'database_name';
$user = 'username';
$pass = 'password';
$host = 'localhost';

// Try to connect the database
try {

    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);

} catch(PDOexception $e) {

    echo $e->getMessage();

}
