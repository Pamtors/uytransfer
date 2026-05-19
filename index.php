<?php
$errorMail = isset($_GET['error_mail']);
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Uy!Transfer</title>
    <style>
        body{
            font-family: Arial;
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
        input, textarea{
            width:100%;
            padding:10px;
            margin-top:10px;
        }
        button{
            background:#00aaff;
            color:white;
            border:none;
            padding:12px 20px;
            margin-top:20px;
            cursor:pointer;
        }
        .error{
            background:#ffcccc;
            padding:10px;
            border:1px solid red;
            margin-bottom:15px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Pujar Arxiu</h2>

    <?php if($errorMail){ ?>
        <div class="error">
            L'email introduït no és vàlid.
        </div>
    <?php } ?>

    <form action="upload.php" method="POST" enctype="multipart/form-data">

        <label>Nom:</label>
        <input type="text" name="nom">

        <label>Email:</label>
        <input type="text" name="email">

        <label>Missatge:</label>
        <textarea name="missatge"></textarea>

        <label>
            <input type="checkbox" name="enviar_mail">
            Enviar correu electrònic
        </label>

        <label>Selecciona un arxiu:</label>
        <input type="file" name="arxiu" required>

        <button type="submit">Pujar Arxiu</button>

    </form>
</div>
</body>
</html>

