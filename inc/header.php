<?php
    require ABSPATH.'inc'.DIRECTORY_SEPARATOR.'functions.php';
?>
<html>
<head>
    <title>Alpha Domotica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<?php if (isset($_SESSION['status'])): ?>
<div class="status <?php print $_SESSION['status']['type']; ?>">
    <?php print $_SESSION['status']['message']; ?>
</div>
<?php endif; ?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

