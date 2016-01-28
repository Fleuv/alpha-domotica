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
    // Get the new value
    $lights = (isset($_POST['lights'])) ? $_POST['lights'] : 0;
    $camera = (isset($_POST['camera'])) ? $_POST['camera'] : 0;

    // Update the database with the new value
    $q = $pdo->prepare('UPDATE systems SET lights = :lights, camera = :camera WHERE user_id = :uid');
    $q->execute(array(
        ':lights' => $_POST['lights'],
        ':camera' => $_POST['camera'],
        ':uid' => $_SESSION['user']['user_id'],
    ));

    // Update the session with the new value
    $_SESSION['system']['lights'] = $lights;
    $_SESSION['system']['camera'] = $camera;

    // Get the user's password (hash)
    $q = $pdo->prepare('SELECT password FROM users WHERE user_id = :uid');
    $q->execute(array(
        ':uid' => $_SESSION['user']['user_id'],
    ));
    $r = $q->fetch();

    // Inform the related system with a POST request
    $ip = rtrim($_SESSION['system']['ip']);
    $port = rtrim($_SESSION['system']['port']);
    $url = 'http://'.$ip.':'.$port.'/execute';
    $data = array(
        'user' => urlencode($_SESSION['user']['username']),
        'pass' => urlencode($r['password']),
        'lights' => urlencode($_SESSION['system']['lights']),
        'camera' => urlencode($_SESSION['system']['camera']),
    );
    $data_string = '';
    foreach($data as $key=>$value) { $data_string .= $key.'='.$value.'&'; }
    rtrim($data_string,'&');
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,count($data));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);
    $result = curl_exec($ch);

    // Redirect back to the form
    header('Location:'.$_SERVER['REQUEST_URI']);
}

if (isset($_POST['api']) and !empty($_POST['user']) and !empty($_POST['pass'])) {
    $q = $pdo->prepare('SELECT user_id FROM users WHERE username = :user AND password = :pass');
    $q->execute(array(
        ':user' => $_POST['user'],
        ':pass' => md5($_POST['pass']),
    ));
    $current_user = $q->fetch();

    // Handle the on boot api call
    if ($_POST['api'] == 'boot' and $current_user) {
        $q = $pdo->prepare('UPDATE systems SET ip = :ip, port = :port WHERE user_id = :uid');
        $q->execute(array(
            ':ip' => $_POST['ip'],
            ':port' => $_POST['port'],
            ':uid' => $current_user['user_id'],
        ));
        print('The system is ready to interact.');
    }

    // Handle messages send via the api
    if ($_POST['api'] == 'message' and $current_user) {
        $q = $pdo->prepare('INSERT INTO messages (user_id) VALUES (:uid)');
        $q->execute(array(
            ':uid' => $current_user['user_id'],
        ));
        $result = $q->fetch();
        print('Message was successfully sent.');
    }
    die();
}