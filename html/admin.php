<header>
    <h1>Beheerders paneel</h1>
    <button name="logout" type="submit">Uitloggen</button>
</header>
<div class="block">
    <h2>Domotica systemen</h2>
    <section class="form">
        <div class="fields">
            <input name="city" type="text" placeholder="Stad" />
            <input name="street" type="text" placeholder="Straat" />
            <input name="house" type="text" placeholder="Huisnummer" />
        </div>
        <div class="actions">
            <button name="search" type="submit">Zoeken</button>
        </div>
    </section>
    <?php
        if (isset($_POST['search'])) {
            $q = $pdo->prepare('SELECT * FROM systems WHERE city LIKE :city AND street LIKE :street AND house LIKE :house');
            $q->execute(array(
                ':city' => '%'.$_POST['city'].'%',
                ':street' => '%'.$_POST['street'].'%',
                ':house' => '%'.$_POST['house'].'%',
            ));
            $rows = $q->fetchAll();
        } else {
            $q = $pdo->prepare('SELECT * FROM systems LIMIT 10');
            $q->execute();
            $rows = $q->fetchAll();
        }
        if ($rows) :
    ?>
    <div class="results">
        <?php
            foreach ($rows as $row):
                $selected = (isset($_SESSION['system']) and $row['user_id']==$_SESSION['system']['user_id']) ? ' active' : '';
        ?>
        <a href="?selected=<?php print $row['user_id']; ?>" class="row<?php print $selected; ?>">
            <span class="status <?php print ($row['status']) ? 'on' : 'off'; ?>"></span>
            <span class="city"><?php print $row['city']; ?></span>
            <span class="street"><?php print $row['street']; ?></span>
            <span class="house"><?php print $row['house']; ?></span>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <span class="status error">Geen domotica systemen gevonden.</span>
    <?php endif; ?>
</div>
<div class="block">
    <h2>Berichten</h2>
    <?php
        if (isset($_SESSION['system'])) :
            $q = $pdo->prepare('SELECT timestamp FROM messages WHERE user_id = :selected ORDER BY timestamp DESC LIMIT 10 ');
            $q->execute(array(
                ':selected' => $_SESSION['system']['user_id'],
            ));
            $rows = $q->fetchAll();
            if ($rows) :
    ?>
    <div class="results">
            <?php foreach ($rows as $row): ?>
        <div class="row">
            <span class="timestamp"><?php print $row['timestamp']; ?></span>
        </div>
            <?php endforeach; ?>
    </div>
        <?php else: ?>
    <span class="status error">Geen berichten voor het geselecteerde domotica systeem gevonden.</span>
    <?php
            endif;
        else:
    ?>
    <span class="status error">Geen domotica systeem geselecteerd.</span>
    <?php endif ;?>
</div>
<div class="block">
    <h2>Handelingen</h2>
    <?php
        if (isset($_SESSION['system'])):
    ?>
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
    <?php
        else:
    ?>
    <span class="status error">Geen domotica systeem geselecteerd.</span>
    <?php
        endif;
    ?>
</div>
