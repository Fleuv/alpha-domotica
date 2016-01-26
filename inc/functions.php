<?php
session_start();

include ABSPATH.'inc'.DIRECTORY_SEPARATOR.'connect.php';

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) and !empty($_POST['password'])) {
        $q = $pdo->prepare('SELECT user_id, username, role FROM users WHERE username = :user AND password = :pass');
        $q->execute(array(
            ':user' => $_POST['username'],
            ':pass' => md5($_POST['password']),
        ));
        $r = $q->fetch();

        if ($r) {
            // Logged in successfully
            $_SESSION['user'] = $r;
            if ($r['role'] == 0) {
                $q = $pdo->prepare('SELECT * FROM systems WHERE user_id = :id');
                $q->execute(array(':id' => $r['user_id']));
                $r = $q->fetch();
                if ($r) {
                    // Open user panel
                    $_SESSION['system'] = $r;
                    header('Location: '.$_SERVER['REQUEST_URI']);
                } else {
                    $error = 'U account is niet gekoppeld aan een domotica systeem.';
                }
            } else {
                // Open admin panel
                header('Location: '.$_SERVER['REQUEST_URI']);
            }
        } else {
            $error = 'Verkeerde gebruikersnaam of wachtwoord.';
        }
    } else {
        $error = 'Gebruikersnaam of wachtwoord is niet ingevuld.';
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: '.$_SERVER['REQUEST_URI']);
}

if (isset($_POST['save'])) {
    var_dump($_POST);
}