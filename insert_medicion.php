<?php
session_start();
include_once("./bdd.php");

$id = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location:index.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['datos'] = $_POST;
    header('Location: ' . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
    exit;
}

if (isset($_SESSION['datos'])) {
    $_POST = $_SESSION['datos'];
    if (isset($_POST['fecha']) && isset($_POST['medicion'])) {

        $fecha = $_POST['fecha'];
        $medicion = $_POST['medicion'];

        $peticion = peticion("INSERT INTO mediciones (pozo, fecha, medicion) VALUES ('$id', '$fecha', '$medicion')");

        if ($peticion) echo "Hecho.";
        else echo "Error.";
    }
    unset($_SESSION['datos']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir mediciones</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Añadir medición</h1>
        </div>
    </nav>
    <div class="contenedor">
        <h2>Inserte la información requerida:</h2>
        <form method="post">
            <div>
                <label for="medicion" class="form-label">Valor de la medición (PSI):</label>
                <input type="number" autocomplete="off" class="form-control" name="medicion" id="medicion" min="1">
            </div>
            <div>
                <label for="fecha" class="form-label">Fecha de la medición:</label>
                <input type="date" class="form-control" required name="fecha" id="fecha">
            </div>
            <br>
            <div class="btn__group">
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
                <a href="index.php" class="btn btn__danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>