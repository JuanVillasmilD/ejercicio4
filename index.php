<?php
include_once("./bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $peticion4 = peticion("DELETE FROM pozos WHERE id_pozo = '{$_GET['id']}'");
        $peticion5 = peticion("DELETE FROM mediciones WHERE pozo = '{$_GET['id']}'");
    }
}

$peticion = peticion('SELECT * FROM pozos');
$datospozo = [];

if (mysqli_num_rows($peticion) > 0) {
    while ($array = mysqli_fetch_array($peticion)) {
        array_push($datospozo, $array);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDVSA</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Pozos</h1>
        </div>
    </nav>
    <div class="contenedor">
        <div class="barra__buscador">
            <form action="" class="formulario" method="post">
                <a href="insert_pozo.php" class="btn btn__nuevo">Nuevo</a>
            </form>
        </div>
        <table class="table table-hover">
            <?php if (count($datospozo) > 0) : ?>
                <thead>
                    <tr class="head">
                        <td>Id</td>
                        <td>Pozo</td>
                        <td>Ubicación</td>
                        <td>Profundidad</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datospozo as $pozo) : ?>
                        <tr class="tabla">
                            <td><?= $pozo['id_pozo'] ?></td>
                            <td><?= '#' . $pozo['numberp'] ?></td>
                            <td><?= $pozo['locationp'] ?></td>
                            <td><?= $pozo['depth'] . ' m' ?></td>
                            <td> <a href="./edit_pozo.php?id=<?php echo $pozo['id_pozo'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> <a href="./mediciones.php?id=<?php echo $pozo['id_pozo'] ?>"><i class="fa-solid fa-eye"></i></a> <a href="./index.php?id=<?php echo $pozo['id_pozo'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else : ?>
                <h3>No se encontró nada.</h3>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>