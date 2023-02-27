<?php

include "helpers/db.php";

$sql = "SELECT * FROM equipos";
$consulta = $cn->query($sql);
$equipos = mysqli_fetch_all($consulta);

$sql = "SELECT * FROM equipos ORDER BY puntos DESC LIMIT 3";
$consulta = $cn->query($sql);
$ganadores = mysqli_fetch_all($consulta);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <title>Torneo</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-800">
    <!-- Tabla general -->
    <h3 class="text-white my-3 text-8xl text-center font-bold">Puntaje General </h3>
    <a href="playGame.php" class="underline text-white flex justify-center items-center my-5">Ir a fechas</a>
    <div class="grid grid-cols-9 w-4/5 mx-auto justify-center items-center bg-white gap-3">
        <p class="col-span-2 px-3 text-black font-bold">Nombre</p>
        <p class=" px-3 text-black font-bold">Partidos Jugados</p>
        <p class=" px-3 text-black font-bold">Partidos Ganados</p>
        <p class=" px-3 text-black font-bold">Partidos Empatados</p>
        <p class=" px-3 text-black font-bold">Partidos Perdidos</p>
        <p class=" px-3 text-black font-bold">Goles favor</p>
        <p class=" px-3 text-black font-bold">Goles contra</p>
        <p class=" px-3 text-black font-bold">Puntaje</p>
        <?php foreach ($equipos as $equipo) : ?>
            <a href="verEquipo.php?id=<?= $equipo[0] ?>" class="col-span-2 text-left pl-3 underline font-bold"><?= $equipo[1] ?></a>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[2] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[3] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[4] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[5] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[6] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[7] ?></p>
            <p class="text-center border rounded-3xl border-2"><?= $equipo[8] ?></p>
        <?php endforeach; ?>
    </div>
    <!-- Ganadores -->
    <div class="">
        <h3 class="text-center my-3 font-bold font-sans text-white text-3xl">Ganadores</h3>
        <div class="bg-white w-3/4 mx-auto grid grid-cols-3 text-black gap-2">
            <div class="flex justify-center items-center font-bold underline">Lugar</div>
            <div class="flex justify-center items-center font-bold underline">Equipo</div>
            <div class="flex justify-center items-center font-bold underline">Puntaje total</div>
            <?php foreach ($ganadores as $i => $ganador) : ?>
                <div class="flex justify-center items-center underline"><?= $i + 1 ?>°</div>
                <div class="flex justify-center items-center"><?= $ganador[1] ?></div>
                <div class="flex justify-center items-center"><?= $ganador[8] ?></div>

            <?php endforeach; ?>

        </div>




</body>

</html>