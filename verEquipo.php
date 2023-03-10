<?php

include("helpers/db.php");

if (empty($_GET['id']) || $_GET['id'] <= 0 || $_GET['id'] > 6) {
    header('location:fechas.php');
    die();
}

$idEquipo = htmlspecialchars($_GET['id']);


$sql = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
$consulta = $cn->prepare($sql);
$consulta->bind_param('i', $idEquipo);
$consulta->execute();
$equipo = mysqli_fetch_assoc($consulta->get_result());

$sql = "SELECT * FROM jugadores WHERE equipo=?";
$consulta = $cn->prepare($sql);
$consulta->bind_param("i", $idEquipo);
$consulta->execute();
$jugadores = mysqli_fetch_all($consulta->get_result());

$sql = "SELECT * FROM staff WHERE equipo=?";
$consulta = $cn->prepare($sql);
$consulta->bind_param("i", $idEquipo);
$consulta->execute();
$staff = mysqli_fetch_all($consulta->get_result());


$puntosEquipo = 0;
$puntosEquipo += intval($equipo['pg']) * 3;
$puntosEquipo += intval($equipo['pe']);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/verEquipo.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Equipo <?= $equipo['nombre'] ?></title>
</head>

<body class="bg-gray-800 w-full">
    <div class="w-2/4 mx-auto flex flex-col justify-center items-center font-sans">
        <h1 class="text-center text-7xl text-white font-bold font-sans mt-4"><?= $equipo['nombre'] ?></h1>
        <div class="w-full flex flex-col justify-center items-center gap-3 ">
            <h1 class="rounded text-xl text-center py-1 text-white mt-16">Jugadores</h1>
            <div class="grid grid-cols-2 gap-2 w-full ">
                <p class="bg-white rounded text-xl text-center py-1">Jugador</p>
                <p class="bg-white rounded text-xl text-center py-1">Goles a favor</p>
                <?php foreach ($jugadores as $jugador) : ?>
                    <p class="bg-white rounded text-xl text-center py-1"><?= $jugador[1] . " " . $jugador[2] ?> (<?php echo ucwords($jugador[5]) ?>)</p>
                    <p class="bg-white rounded text-xl text-center py-1"><?= $jugador[9] ?></p>
                <?php endforeach; ?>
            </div>
            <div class="grid grid-cols-1 gap-2 w-full mt-16">
                <h1 class=" rounded text-xl text-center py-1 text-white">Staff</h1>
                <?php foreach ($staff as $personal) : ?>
                    <p class="bg-white rounded text-xl text-center py-1"><?= $personal[1] . " " . $personal[2] ?> (<?php echo ucwords($personal[7]) ?>)</p>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="verPuntaje.php" class="w-full mx-auto text-white flex justify-center items-center bg-green-500 mt-12 mb-8 rounded-xl hover:bg-green-700 py-2">Volver</a>
    </div>
</body>

</html>