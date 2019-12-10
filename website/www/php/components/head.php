<?php 
$array=explode('/',$_SERVER['PHP_SELF']); 
$page=explode('.',end($array));
$page=ucfirst($page[0]);
$index=TRUE;
if(!strcmp($page,'Modifica_prodotto') || !strcmp($page,'Modifica_news'))
    $index=FALSE;
?>

<head>
    <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
    <title> <?php echo($page); ?> - Pasticceria Padovana</title>
    <meta name="title" content="Pasticceria Padovana, il meglio delle paste a Padova" />
    <meta name="description" content="La Pasticceria Padovana propone le migliori selezioni di paste e torte prodotte ogni giorno dai nostri pasticceri." />
    <meta name="keywords" content="Pasticceria,Veneto,Padova,Padovana,Paste,Torte" />
    <meta name="language" content="italian it" />
    <meta name="author" content="Alberto Gobbo, Marco Dalla Libera, Riccardo Cestaro, Stefano Lazzaroni" />
    <meta name="viewport" content="width=device-width" />
    <?php if(!$index){?>
        <meta name="robots" content="noindex">
    <?php } ?>
    <link rel="icon" href="../images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../css/screen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
    <script src="../JS/dynamic.js" type="text/javascript"></script>
</head>

