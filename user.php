<?php
require 'functions.php';
require_once('header.php');


?>

<div class="block">
    <h1>Gebruikerspaneel</h1>
    <form action="" method="post">
        <section class="dotted">
            <ul>
                <li><strong>Woonplaats:</strong><span><?php print $city; ?></span></li>
                <li><strong>Straatnaam:</strong><span><?php print $street; ?></span></li>
                <li><strong>Huisnummer:</strong><span><?php print $house; ?></span></li>
            </ul>
        </section>
        <section class="lights">
            <h2>Verlichting</h2>
            <div class="switch">
                <button type="button">aan</button>
                <button type="button">uit</button>
                <a class="off">uit</a>
                <a class="on">aan</a>
                <input type="hidden" value="<?php print $lights; ?>" />
            </div>
        </section>
        <section class="cameras">
            <h2>Camera's</h2>
            <div class="switch">
                <button type="button">aan</button>
                <button type="button">uit</button>
                <a class="off">uit</a>
                <a class="on">aan</a>
                <input type="hidden" value="<?php print $cameras; ?>" />
            </div>
        </section>
        <button name="save" type="submit">Opslaan</button>
        <a href="http://localhost/alpha-domotica>" <button name="logoff" type="submit">Uitloggen</button></a>
    </form>
</div>

<?php
require_once('footer.php');
