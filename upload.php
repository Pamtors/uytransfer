<?php

$extensions_permeses = ['pdf','png','jpg','rar','zip'];
$max_size = 10 * 1024 * 1024;

$nom = trim($_POST['nom']);
$email = trim($_POST['email']);
$missatge = trim($_POST['missatge']);

$fitxer = $_FILES['arxiu'];

$extensio = strtolower(pathinfo($fitxer['name'], PATHINFO_EXTENSION));

$error = "";

if($fitxer['size'] > $max_size){
    $error = "L'arxiu supera els 10 MB.";
}

if(!in_array($extensio, $extensions_permeses)){
    $error = "Format no vàlid.";
}

if(isset($_POST['enviar_mail'])){
    if(strpos($email, '@') === false){
        header("Location: index.php?error_mail=1");
        exit;
    }
}

$pujada_correcta = false;
$link = "";

if($error == ""){

    $nou_nom = date('Ymd') . rand(10000,99999) . "." . $extensio;

    if(!file_exists("files")){
        mkdir("files");
    }

    move_uploaded_file($fitxer['tmp_name'], "files/" . $nou_nom);

    $link = "http://localhost/uytransfer/files/" . $nou_nom;

    $cookie_name = "fitxer_" . time();
    setcookie($cookie_name, $link, time() + (7 * 24 * 60 * 60));

    if(isset($_POST['enviar_mail'])){

        if($missatge == ""){
            $missatge = "Han compartit un document amb tu.";
        }

        $cos = $missatge . "\n\nLink: " . $link;

        mail($email, "Nou arxiu compartit", $cos);
    }

    $pujada_correcta = true;
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
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
        .ok{
            color:green;
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<?php if($pujada_correcta){ ?>

    <h2 class="ok">Pujada satisfactòria</h2>

    <?php if($nom != ""){ ?>
        <p>Hola <?php echo $nom; ?>, usa este link para compartir tu archivo:</p>
    <?php } else { ?>
        <p>Oye tú!! Usa este link para compartir tu archivo:</p>
    <?php } ?>

    <a href="<?php echo $link; ?>">
        <?php echo $link; ?>
    </a>

<?php } else { ?>

    <h2 class="error">Error en la pujada</h2>
    <p><?php echo $error; ?></p>

<?php } ?>

</div>
</body>
</html>
