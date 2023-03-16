<?php
include_once("./bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $peticion = peticion("SELECT * FROM mediciones WHERE id_medicion = '{$_GET['id']}'");
        $medicion = mysqli_fetch_array($peticion);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['medicion']) && !empty($_POST['medicion']) && isset($_POST['fecha']) && !empty($_POST['fecha'])) {
        $peticion = peticion("UPDATE mediciones SET medicion = '{$_POST['medicion']}', fecha = '{$_POST['fecha']}' WHERE id_medicion = '{$_POST['id']}'");
        if ($peticion) {
            header('Location: index.php');
            exit;
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
    <title>Editar Medición</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Modificar Medicion</h1>
        </div>
    </nav>
    <div class="contenedor">
        <form method="post">
            <input type="hidden" name="id" value="<?= $medicion['id_medicion'] ?>">
            <div>
                <label for="medicion" class="form-label">Valor de la medición (PSI):</label>
                <input type="number" class="form-control" name="medicion" id="medicion" value="<?= $medicion['medicion'] ?>">
            </div>
            <div>
                <label for="fecha" class="form-label">Fecha de la medición:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="<?= $medicion['fecha'] ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</body>

</html>