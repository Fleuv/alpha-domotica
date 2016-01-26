<?php

define('ABSPATH', getcwd().DIRECTORY_SEPARATOR);

require_once(ABSPATH.'inc'.DIRECTORY_SEPARATOR.'header.php');

// Check if the user made an error
if (!empty($error)) {
    print '<div class="status error">'.$error.'</div>';
}

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // Check if the user is an admin
    if ($_SESSION['user']['role'] == 1) {
        include_once(ABSPATH.'html'.DIRECTORY_SEPARATOR.'admin.php');
    } else {
        include_once(ABSPATH.'html'.DIRECTORY_SEPARATOR.'user.php');
    }
} else {
    include_once(ABSPATH.'html'.DIRECTORY_SEPARATOR.'login.php');
}

require_once(ABSPATH.'inc'.DIRECTORY_SEPARATOR.'footer.php');