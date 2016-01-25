<?php
require 'functions.php';
require_once('header.php');


?>
<div class="block">
    <h1>Inloggen</h1>
    <form action="" method="post">
        <input type="text" name="username" />
        <button type="reset">reset</button>
    </form>
    <form action="" method="post">
        <input type="password" name="password"/>
        <button type="submit">login</button>
    </form>
</div>



<?php
require_once('footer.php');
