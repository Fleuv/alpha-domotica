<div class="row border thick">
    <h1>Beheerders paneel</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button name="logout" type="submit">Uitloggen</button>
    </form>
</div>
<div class="block border thick">
    <h2>Domotica systemen</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input name="city" type="text" placeholder="Stad" />
        <input name="street" type="text" placeholder="Straat" />
        <input name="house" type="text" placeholder="Huisnummer" />
        <button name="search" type="submit">Zoeken</button>
    </form>
    <?php
        if (isset($_POST['search'])) {
            $q = $pdo->prepare('SELECT *
                                FROM systems
                                WHERE city LIKE :city AND
                                      street LIKE :street AND
                                      house LIKE :house
                               ');
            $q->execute(array(
                ':city' => '%'.$_POST['city'].'%',
                ':street' => '%'.$_POST['street'].'%',
                ':house' => '%'.$_POST['house'].'%',
            ));
            $rows = $q->fetchAll();
        } else {
            $q = $pdo->prepare('SELECT * FROM systems LIMIT 0,10');
            $q->execute();
            $rows = $q->fetchAll();
        }
        if ($rows) :
            foreach ($rows as $row) :
    ?>
        <div class="row">
        <span class="status <?php print ($row['status']) ? 'on' : 'off'; ?>"></span>
        <span class="city"><?php print $row['city']; ?></span>
        <span class="street"><?php print $row['street']; ?></span>
        <span class="house"><?php print $row['house']; ?></span>
        </div>
    <?php
            endforeach;
        else:
    ?>
        <div class="no-results">Geen domotica systemenen gevonden.</div>
    <?php
        endif;
    ?>
</div>
