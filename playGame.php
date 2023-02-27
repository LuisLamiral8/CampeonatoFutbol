<?php

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
  <script src="./node_modules/axios/dist/axios.min.js"></script>
  <script defer src="scripts/handlePlay.js"></script>



  <h1 class="text-center text-8xl font-bold text-white my-3">Partido</h1>
  <a href="verPuntaje.php" class="underline text-white flex justify-center items-center my-5">Ver puntajes</a>
  <!-- Fecha 1 -->
  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 1</h2>
    </div>
    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">

        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="team-1 text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="team-2 text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>

      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>

      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 t1Container ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 t2Container ">
        </div>

      </div>

      <!-- Jugar -->
      <div class="col-span-5 flex justify-center items-center">
        <!-- <a href="jugarFecha.php?id=1&E1=<?= $equipos[0][0] ?>&E2=<?= $equipos[1][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</a> -->
        <button id="<?= $equipos[0][0] ?><?= $equipos[1][0] ?>" class="pressedPlay btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</button>
        <button class="pressedConfirm btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
      <!-- end jugar -->
    </div>
    <hr class="m-2">
    <div class="font-sans grid grid-cols-3 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="team-1 text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="team-2 text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>

      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="col-span-3 flex justify-center items-center">
        <!-- <a href="jugarFecha.php?id=2&E1=<?= $equipos[2][0] ?>&E2=<?= $equipos[3][0] ?>" class="btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</a> -->
        <button id="<?= $equipos[0][0] ?><?= $equipos[1][0] ?>" class="pressedPlay btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</button>
        <button class="pressedConfirm btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
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

  <?php if ($empate) : ?>
    <div class="w-full  top-16 flex flex-col justify-center items-center bg-red-500 position-fixed p-3 rounded mx-auto z-16">
      <h3 class="text-center text-3xl font-bold">Empate</h3>
      <div class="flex flex-row justify-center items-center gap-3">
        <a href="verEquipo.php?id=<?= $ganadores[0][0] ?>" class="text-center text-black font-bold "><?= $ganadores[0][1] ?></a>
        <p class="my-4">VS</p>
        <a href="verEquipo.php?id=<?= $ganadores[1][0] ?>" class="text-center text-black font-bold "><?= $ganadores[1][1] ?></a>
      </div>
      <a href="jugarFecha.php?id=16&E1=<?= $ganadores[0][0] ?>&E2=<?= $ganadores[1][0] ?>" class="bg-green-500 mx-auto px-3 py-2 rounded-xl text-white">Desempatar</a>
    </div>
  <?php endif ?>



</body>

</html>