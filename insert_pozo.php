<?php
session_start();
include_once("./bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['datos'] = $_POST;
    header('Location: ' . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
    exit;
}

if (isset($_SESSION['datos'])) {
    $_POST = $_SESSION['datos'];
    if (isset($_POST['numberp']) && isset($_POST['locationp']) && isset($_POST['depth'])) {

        $numberp = $_POST['numberp'];
        $locationp = $_POST['locationp'];
        $depth = $_POST['depth'];

        $verificar = peticion("SELECT * FROM pozos WHERE numberp = '$numberp' AND locationp = '$locationp'");
        if (mysqli_num_rows($verificar) > 0) {
            echo "Error: Ya existe un pozo con el mismo número y ubicación.";
        } else {
            $peticion = peticion("INSERT INTO pozos (numberp, locationp, depth) VALUES ('$numberp', '$locationp', '$depth')");

            if ($peticion) {
                echo "Hecho.";
            } else {
                echo "Error.";
            }
        }
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
    <title>Nuevo Pozo Petrolero</title>
    <link rel="icon" href="./assets/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./assets/img/logo.png" alt="Bootstrap" width="100%" height="50">
            </a>
            <h1>Crear nuevo pozo</h1>
        </div>
    </nav>
    <div class="contenedor">
        <h2>Inserte la información requerida:</h2>
        <form method="post">
            <div class="form-group">
                <input type="number" autocomplete="off" required step="any" min="1" name="numberp" placeholder="Numero del pozo" class="input__text">
                <select type="text" required name="locationp" placeholder="Ubicacion del pozo" class="input__text">
                    <option value="Occidente Zulia">Occidente Zulia</option>
                    <option value="Barinas-Apure">Barinas-Apure</option>
                    <option value="Oriente">Oriente</option>
                    <option value="Faja (FPO)">Faja (FPO)</option>
                    <option value="Costa afuera">Costa afuera</option>
                </select>
                <input type="numberp" autocomplete="off" required step="any" min="1" name="depth" placeholder="Profundidad del pozo" class="input__text">
            </div>
            <div class="btn__group">
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
                <a href="index.php" class="btn btn__danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>