<?php
require_once("functions/functions.php");

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerámicart</title>
    <link href="src/favicon4.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/rwd.css">
    <link rel="stylesheet" href="styles/palette-dark.css">
    <script src="functions/functions.js" defer></script>
</head>
<body>
<?php
    Launch("header");
?>
<div class="div-body">
    <?php
        Launch("menu");
    ?>
    <div class="main-section">
        <?php
            Launch($id);
        ?>
    </div>
</div>
<?php
    Launch("footer");
?>
</body>
</html>