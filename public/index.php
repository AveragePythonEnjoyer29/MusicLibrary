<?php 
require_once('../source/config.php');
include_once('../source/data.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music library</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <div class="container__blocks">
        <?php

        foreach ($music as $row) {
            include("../source/views/card.php");
        }
        ?>
    </div>
</div>
    
</body>
</html>