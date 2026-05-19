<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Últims Arxius</title>
    <style>
        body{
            font-family:Arial;
            background:#f4f4f4;
            margin:0;
        }
        .container{
            width:70%;
            margin:auto;
            margin-top:40px;
            background:white;
            padding:30px;
            border-radius:10px;
        }
        li{
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

    <h2>Mis últimos archivos</h2>

    <ul>

    <?php
    foreach($_COOKIE as $key => $value){

        if(strpos($key, 'fitxer_') === 0){
            echo "<li><a href='$value'>$value</a></li>";
        }
    }
    ?>

    </ul>

</div>
</body>
</html>

