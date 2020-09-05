<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    require_once 'api.php';

    $serieTotal = getValoresIndividual($id);
    $serie = $serieTotal[0];
    $casting = $serieTotal[1];
} else {
    header('Location: /');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serie <?= $serie->getTitle() ?></title>
    <link href="https://fonts.googleapis.com/css?family=Barlow:300|Fira+Sans:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesPageSerie.css">
</head>

<body>

    <header id="header">
        <img id="btnBack" src="images/back.png" alt="Back">
        <h1><?= $serie->getTitle() ?></h1>
    </header>

    <main id="main">
        <div class="contenedor">
            <div class="principal">
                <img src="<?= $serie->getImage() ?>" alt="Imagen Serie <?= $serie->getTitle() ?>">
                <div class="informacionPrincipal">
                    <div class="sinopsis">
                        <h2>SYNOPSIS</h2>
                        <h3><?= $serie->getSummary() ?></h3>
                    </div>

                    <hr>

                    <div class="informacionSerie">
                        <h2><strong>Show Type : </strong><?= $serie->getType() ?></h2>
                        <h2><strong>Genres : </strong>
                            <?php
                            for ($i = 0; $i < count($serie->getGenres()); $i++) :
                            ?>
                                <a href="/?category=<?= $serie->getGenres()[$i] ?>">
                                    <?= $serie->getGenres()[$i] ?>
                                </a>
                            <?php endfor; ?>
                        </h2>
                        <h2><strong>Language : </strong><?= $serie->getLanguage() ?></h2>
                        <h2><strong>Status : </strong><?= $serie->getStatus() ?></h2>
                        <h2><strong>Schedule : </strong><?= $serie->getSchedule() ?></h2>
                    </div>
                </div>
            </div>
            <hr>
            <h2 id="cast">Cast '<?= $serie->getTitle() ?>'</h2>
            <div class="cast">
                <?php
                for ($i = 0; $i < count($casting); $i++) :
                ?>
                    <div class="cardCast">
                        <img src="<?= $casting[$i]->getImage() ?>" alt="Serie">
                        <h3><?= $casting[$i]->getName() ?></h3>
                        <p><span>As </span> <?= $casting[$i]->getAlias() ?></p>
                    </div>

                <?php endfor; ?>
            </div>
    </main>

    <script>
        document.getElementById("btnBack").onclick = function() {
            window.history.back();
        };
    </script>

</body>

</html>