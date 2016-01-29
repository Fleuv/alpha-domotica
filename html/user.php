<header>
    <h1>Gebruikerspaneel</h1>
    <button name="logout" type="submit">Uitloggen</button>
</header>
<div class="block">
    <h2>Systeem</h2>
    <section>
        <ul>
            <li><strong>Woonplaats:</strong><span><?php print $_SESSION['system']['city']; ?></span></li>
            <li><strong>Straatnaam:</strong><span><?php print $_SESSION['system']['street']; ?></span></li>
            <li><strong>Huisnummer:</strong><span><?php print $_SESSION['system']['house']; ?></span></li>
        </ul>
    </section>
    <section class="lights">
        <h3>Verlichting</h3>
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
        <h3>Camera</h3>
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
    <div class="actions">
        <button name="save" type="submit">Opslaan</button>
    </div>
</div>
