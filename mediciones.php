<?php
include_once("./bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $peticion = peticion("SELECT * FROM pozos WHERE id_pozo = '{$_GET['id']}'");
        $pozo = mysqli_fetch_array($peticion);
        $peticion2 = peticion("SELECT * FROM mediciones WHERE pozo = '{$_GET['id']}' ORDER BY fecha");
        $datosmediciones = [];
        $fechas = [];
        $valores = [];
        if (mysqli_num_rows($peticion2) > 0) {
            while ($array = mysqli_fetch_array($peticion2)) {
                array_push($datosmediciones, $array);
                array_push($fechas, $array['fecha']);
                array_push($valores, $array['medicion']);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediciones de Pozo</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Mediciones del pozo #<?php echo $pozo['numberp'] . ' en ' .  $pozo['locationp']; ?></h1>
        </div>
    </nav>
    <br>
    <div class="chart-container" style="width: 600px; height: 300px;">
        <canvas id="lineChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const CHART = document.getElementById('lineChart');
        let lineChart = new Chart(CHART, {
            type: 'line',
            data: {
                labels: [<?php echo '"' . implode('","',  $fechas) . '"' ?>],
                datasets: [{
                    label: 'Pozo petrolero #<?php echo $pozo['numberp']; ?>',
                    data: [<?php echo '"' . implode('","',  $valores) . '"' ?>],
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)',
                    borderWidth: 2,
                    pointBackgroundColor: 'white',
                    pointBorderColor: 'rgb(75, 192, 192)',
                    pointBorderWidth: 1,
                    pointRadius: 3,
                    pointHitRadius: 10,
                    tension: 0.1,
                }]
            },
            options: {
                legend: {
                    position: 'top',
                    labels: {
                        fontColor: 'black',
                        fontSize: 14,
                        boxWidth: 20,
                    },
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: 'black',
                            fontSize: 12,
                        },
                    }],
                    yAxes: [{
                        ticks: {
                            fontColor: 'black',
                            fontSize: 12,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Valor de la medición',
                            fontColor: 'black',
                            fontSize: 14,
                        },
                    }]
                },
            },
        });
    </script>
    <div class="contenedor">
        <div class="barra__buscador">
            <form action="" class="formulario" method="post">
                <a href="./insert_medicion.php?id=<?php echo $pozo['id_pozo'] ?>" class="btn btn__nuevo">Nuevo</a>
            </form>
        </div>
        <table class="table table-dark table-hover">
            <?php if (count($datosmediciones) > 0) : ?>
                <thead>
                    <tr class="head">
                        <td>Id</td>
                        <td>Valor</td>
                        <td>Fecha de medicion</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datosmediciones as $mediciones) : ?>
                        <tr class="tabla">
                            <td><?= $mediciones['id_medicion'] ?></td>
                            <td><?= $mediciones['medicion'] . ' PSI' ?></td>
                            <td><?= $mediciones['fecha'] ?></td>
                            <td>
                                <a href="./edit_medicion.php?id=<?= $mediciones['id_medicion'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else : ?>
                <h3>No se encontraron mediciones para este pozo.</h3>
            <?php endif; ?>
        </table>
        <a href="./index.php" class="btn btn__volver">Volver</a>
    </div>
</body>

</html>