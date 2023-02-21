<?php

session_start();
include "helpers/db.php";

$sql = "SELECT * FROM equipos";
$consulta = $cn->query($sql);
$equipos = mysqli_fetch_all($consulta);


$sql = "SELECT * FROM partidos";
$consulta = $cn->query($sql);
$partidos = mysqli_fetch_all($consulta);


if (count($partidos) > 0) $idPartido = count($partidos) + 1; 
else $idPartido = 1;

$sql = "SELECT * FROM equipos ORDER BY puntos DESC LIMIT 3";
$consulta = $cn->query($sql);
$ganadores = mysqli_fetch_all($consulta);

$empate = 0;
if ($idPartido > 15) {
  if ($ganadores[0][8] == $ganadores[1][8]) $empate = 1; 
}

$sql = "SELECT * FROM jugadores WHERE goles>=1 ORDER BY goles DESC LIMIT 10";
$consulta = $cn->query($sql);
$goleadores = mysqli_fetch_all($consulta);

?>

<!DOCTYPE html>
<html lang="es">

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


  <h1 class="text-center text-8xl font-bold text-white my-3">Partido</h1>

  <!-- Fecha 1 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 1</h2>
    </div>
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=1&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[1][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=2&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[3][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=3&E1=<?= $equipos[4][0] ?>&E2=<?= $equipos[5][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 3 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
  </div>

  <!-- Fecha 2 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 2</h2>
    </div>
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=4&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[5][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 4 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=5&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[2][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 5 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=6&E1=<?= $equipos[3][0] ?>&E2=<?= $equipos[4][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 6 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
  </div>

  <!-- Fecha 3 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 3</h2>
    </div>
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=7&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[2][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 7 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=8&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[4][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 8 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=9&E1=<?= $equipos[3][0] ?>&E2=<?= $equipos[5][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 9 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
  </div>

  <!-- Fecha 4 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 4</h2>
    </div>
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=10&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[3][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 10 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=11&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[5][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 11 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=12&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[4][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 12 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
  </div>

  <!-- Fecha 5 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 5</h2>
    </div>
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=13&E1=<?= $equipos[1][0] ?>&E2=<?= $equipos[3][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 13 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=14&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[4][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 14 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="font-black text-center">VS</div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <a href="jugarFecha.php?id=15&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[5][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 15 ? "disabled" : "" ?>">Jugar</a>
      </div>
    </div>
  </div>

  <!-- Puntajes -->
  <div class="w-2/4 mx-auto bg-white rounded-md p-2 mt-8 grid grid-cols-3 gap-2">
    <div class="col-span-3 flex justify-center items-center mb-5 font-black underline">Puntajes</div>
    <?php foreach ($equipos as $equipo) : ?>
      <div class="flex justify-left items-center font-bold pl-20">
        <?= $equipo[1] ?>
      </div>
      <div class="flex justify-center items-center font-bold">
        <?= $equipo[8] ?>
      </div>
      <div class="flex justify-center items-center font-bold">
        <a href="verEquipo.php?id=<?= $equipo[0] ?>" class="underline text-red-500">Ver equipo</a>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Ganadores -->
  <div class="text-light p-3 mt-2 container">
    <h3 class="text-center my-3 text-xl font-bold font-sans">Ganadores</h3>
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



    <?php if ($empate) : ?>
      <div class="container card text-dark p-0 row d-flex text-center mx-auto div-empate col-sm-6">
        <h3 class="mt-2 text-danger col-12">Empate</h3>
        <div class="d-flex position-relative row mx-auto">
          <a href="verEquipo.php?id=<?= $ganadores[0][0] ?>" class="col-12 p-0"><?= $ganadores[0][1] ?></a>
          <p class="mx-auto mt-1 mb-1 p-0">VS</p>
          <a href="verEquipo.php?id=<?= $ganadores[1][0] ?>" class="col-12 p-0"><?= $ganadores[1][1] ?></a>
          <div class="d-flex mx-auto col-12 div-btn-empate">
            <a href="jugarFecha.php?id=16&E1=<?= $ganadores[0][0] ?>&E2=<?= $ganadores[1][0] ?>" class="btn btn-primary d-flex mx-auto">Desempatar</a>
          </div>
        </div>
      </div>
    <?php endif ?>

</body>

</html>