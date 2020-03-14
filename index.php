<?php
require_once 'api.php';

$array = creacion();

if (isset($_GET['category'])) {
    $categoria = $_GET['category'];
} else {
    $categoria = "comedy";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TvMaze Api</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesMain.css">
</head>

<body>
    <header id="header">

        <a href="https://www.tvmaze.com/" target="_blank"><img src="images/logo-tvm.png" alt="Logo TvMaze"></a>
        <div id="buscar">
            <input id="searchText" type="text" placeholder="Search.." name="search">
            <button id="btnSearch"><i class="fa fa-search"></i>Search</button>
        </div>
        <a href="" target="_blank"><img src="images/github_logo.png" alt="Logo GitHub"></a>

    </header>

    <main id="main">
        <div class="contenedor">
            <div class="principal">
                <?php
                $series = getValores($array);
                $series = $series[ucwords($categoria)];

                for ($i = 0; $i < (count($series) > 5 ? 5 : count($series)); $i++) :
                ?>
                    <div class="cardSerie">
                        <a href="serie.php?id=<?= $series[$i][3] ?>"><img src="<?= $series[$i][2] ?>" alt="Serie"></a>
                        <div id="textoSerie">
                            <a href="serie.php?id=<?= $series[$i][3] ?>">
                                <h3><?= $series[$i][0] ?></h3>
                            </a>
                            <div id="calificacion">
                                <img src="images/estrella.png" alt="estrella">
                                <h3><?= $series[$i][1] ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>

            </div>

            <?php if (count($series) > 5) : ?>
                <div id="btnAgregar">
                    <hr>
                    <img id="btnMore" src="images/more.png" alt="Agregar Más">
                    <h2>5 More</h2>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            let variableCon = 5;
            var js_array = <?php echo json_encode($series); ?>;

            document.getElementById("btnSearch").onclick = function() {
                category = document.getElementById("searchText").value;
                buscarCategoria(category);
            }

            function buscarCategoria(category) {
                window.open("http://localhost:3000/?category=" + category, "_self");
            }

            $("#btnMore").click(function() {
                for (let i = variableCon; i < variableCon + 5; i++) {

                    if (i < js_array.length) {
                        console.log(i);
                        var div = document.createElement("div");
                        div.className = "cardSerie";

                        var a = document.createElement("a");
                        a.href = "serie.php?id=" + js_array[i][3];
                        var img = document.createElement("img");
                        img.src = js_array[i][2];
                        img.alt = "Imagen Serie";
                        a.appendChild(img);
                        div.appendChild(a);

                        var div2 = document.createElement("div");
                        div2.id = "textoSerie";
                        var a2 = document.createElement("a");
                        a2.href = "serie.php?id=" + js_array[i][3];
                        var h3 = document.createElement("h3");
                        h3.textContent = js_array[i][0];
                        a2.appendChild(h3);
                        div2.appendChild(a2);

                        var div3 = document.createElement("div");
                        div3.id = "calificacion";
                        var img2 = document.createElement("img");
                        img2.src = "images/estrella.png";
                        img2.alt = "Estrella";
                        div3.appendChild(img2);
                        var h3_2 = document.createElement("h3");
                        h3_2.textContent = js_array[i][1];
                        div3.appendChild(h3_2);
                        div2.appendChild(div3);
                        div.appendChild(div2);

                        $(".principal").append(div);
                    } else {
                        $("#btnAgregar").hide();
                    }
                }
                variableCon += 5;

            });
        });
    </script>
</body>

</html>