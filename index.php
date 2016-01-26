<?php

define('ABSPATH', getcwd().'/');

require_once(ABSPATH.'inc/header.php');

// Check if the user made an error
if (!empty($error)) {
    print '<div class="status error">'.$error.'</div>';
}

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Check if the user is an admin
    if ($_SESSION['user']['role'] == 1) {
        include_once(ABSPATH.'html/admin.php');
    } else {
        include_once(ABSPATH.'html/user.php');
    }
} else {
    include_once(ABSPATH.'html/login.php');
}

require_once(ABSPATH.'inc/footer.php');