<?php
require 'functions.php';
require_once('header.php');


?>
    <div class="title">
        <h1>Beheerders paneel</h1>
    </div>
    <div class="block">
    <h2>Domotica systemen</h2>
    <form action="" method="post" class="filter">
        <input type="text" placeholder="Adres..." />
        <button type="submit">Filter</button>
    </form>
<?php
if (!empty($rows)) :
    foreach ($rows as $row) :
        ?>
        <div class="row">
            <span class="status <?php print $row['status']; ?>"></span>
 <span class="city"><?php print $row['city']; ?></span>
 <span class="street"><?php print $row['street']; ?></span>
 <span class="house"><?php print $row['house']; ?></span>
 </div>
 <?php
 endforeach;
 else:
 ?>
 <div class="no-results">Geen domotica systemenen gevonden.</div>
 <?php endif; ?>
 </div>


<?php
require_once('footer.php');
