<?php
include_once("./bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $peticion = peticion("SELECT * FROM pozos WHERE id_pozo = '{$_GET['id']}'");
    $pozo = mysqli_fetch_assoc($peticion);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $numberp = $_POST['numberp'];
    $locationp = $_POST['locationp'];
    $depth = $_POST['depth'];

    $peticion = peticion("UPDATE pozos SET numberp='$numberp', locationp='$locationp', depth='$depth' WHERE id_pozo = '$id'");

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Pozo</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Modificar Pozo</h1>
        </div>
    </nav>
    <div class="contenedor">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $pozo['id_pozo']; ?>">
            <div class="mb-3">
                <label for="numberp" class="form-label">Número:</label>
                <input type="text" autocomplete="off" class="form-control" id="numberp" name="numberp" value="<?php echo $pozo['numberp']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="locationp" class="form-label">Ubicación:</label>
                <select type="text" class="form-control" id="locationp" name="locationp" value="<?php echo $pozo['locationp']; ?>" required>
                    <option value="Occidente Zulia">Occidente Zulia</option>
                    <option value="Barinas-Apure">Barinas-Apure</option>
                    <option value="Oriente">Oriente</option>
                    <option value="Faja (FPO)">Faja (FPO)</option>
                    <option value="Costa afuera">Costa afuera</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="depth" class="form-label">Profundidad:</label>
                <input type="text" autocomplete="off" class="form-control" id="depth" name="depth" value="<?php echo $pozo['depth']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</body>
</html>