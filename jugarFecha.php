<?php

session_start();
include "helpers/db.php";


//html special chars restriction
$idPartido = htmlspecialchars($_GET['id']);
$E1 = htmlspecialchars($_GET['E1']);
$E2 = htmlspecialchars($_GET['E2']);

if (
    !($idPartido > 0 && $idPartido <= 16) ||
    !($E1 > 0  && $E1 < 7) ||
    !($E2 > 0 && $E2 < 7)
) {
    header('location:./');
    die();
}

$sql = "SELECT * FROM equipos WHERE ID=? || ID=? LIMIT 2";
$consulta = $cn->prepare($sql);
$consulta->bind_param("ii", $E1, $E2);
$consulta->execute();
$equipos = mysqli_fetch_all($consulta->get_result());

$sql = "SELECT ID FROM partidos";
$consulta = $cn->query($sql);
$partido = mysqli_fetch_all($consulta);

if (count($partido) == 0) $partido = 1;
else $partido = count($partido) + 1;




$sql = "SELECT * FROM jugadores WHERE equipo=? || equipo=?";
$consulta = $cn->prepare($sql);
$consulta->bind_param('ii', $E1, $E2);
$consulta->execute();
$jugadores = mysqli_fetch_all($consulta->get_result());

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="scripts/play.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title><?php echo $equipos[0][1] . " VS " . $equipos[1][1] ?></title>
</head>

<body class="bg-gray-800 w-3/4 mx-auto">
    <form class="w-full mx-auto  m-5 ">
        <div class="teamsContainer grid grid-cols-1 justify-center items-center">
            <?php foreach ($equipos as $i => $equipo) : ?>
                <div class="divEquipo divEquipo-<?= $i ?>  flex flex-col gap-2 mb-14 bg-red-400 rounded-2xl py-3">
                    <input type="hidden" value="<?= $i . "=" . $equipo[0] ?>" class="team">
                    <h1 class="text-4xl font-black text-white text-center"><?= $equipo[1] ?></h1>
                    <div class="mx-auto my-3">

                        <label for="goles-<?= $i ?>" class="text-xl text-white font-bold ml-2">Goles: </label>
                        <input type="number" id="goles-<?= $i ?>" class="goles goles-<?= $i ?> rounded pl-4" value="0" key="<?= $i ?>" min="0">
                    </div>
                    <h4 class="text-center text-2xl text-white font-bold mb-5">Goleadores</h4>
                    <?php foreach ($jugadores as $jugador) : ?>
                        <?php if ($jugador[8] == $equipo[0]) : ?>
                            <div class="golesJugador flex flex-row justify-between items-center px-64">
                                <h6 class="underline font-xl" key="<?= $i . "=" . $jugador[0] ?>"><?= $jugador[1] . " " . $jugador[2] . " (" . ucwords($jugador[5]) . ")" ?></h6>
                                <input type="number" key="<?= $i . "=" . $jugador[0] ?>" min="0" value="0" class="player player-<?= $i ?> pl-2 rounded">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="rounded w-full mx-auto flex justify-center items-center bg-green-500 py-1 font-bold text-white hover:bg-green-600 play">Subir</button>
    </form>
</body>

</html>