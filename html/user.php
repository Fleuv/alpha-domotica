<div class="heading border thick">
    <h1>Gebruikerspaneel</h1>
    <button name="logout" type="submit">Uitloggen</button>
</div>
<div class="block border thick">
    <h2>Systeem</h2>
    <section class="dotted">
        <ul>
            <li><strong>Woonplaats:</strong><span><?php print $_SESSION['system']['city']; ?></span></li>
            <li><strong>Straatnaam:</strong><span><?php print $_SESSION['system']['street']; ?></span></li>
            <li><strong>Huisnummer:</strong><span><?php print $_SESSION['system']['house']; ?></span></li>
        </ul>
    </section>
    <section class="lights">
        <h2>Verlichting</h2>
        <?php
            $lights = $_SESSION['system']['lights'];
            $lights_class = ($lights==1) ? ' active' : '';
        ?>
        <div class="switch<?php print $lights_class; ?>">
            <a class="off">uit</a>
            <a class="on">aan</a>
            <input name="lights" type="hidden" value="<?php print $lights; ?>" />
        </div>
    </section>
    <section class="camera">
        <h2>Camera</h2>
        <?php
            $camera = $_SESSION['system']['camera'];
            $camera_class = ($camera==1) ? ' active' : '';
        ?>
        <div class="switch<?php print $camera_class; ?>">
            <a class="off">uit</a>
            <a class="on">aan</a>
            <input name="camera" type="hidden" value="<?php print $camera; ?>" />
        </div>
    </section>
    <button name="save" type="submit">Opslaan</button>
</div>
