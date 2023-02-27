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

// $idPartido = 15;
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
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 1 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 1 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>

      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>

      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 1 ? "t1Container" : "" ?>">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 1 ? "t2Container" : "" ?> ">
        </div>

      </div>

      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[0][0] ?><?= $equipos[1][0] ?>" class="<?php echo $idPartido == 1 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 1 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 1 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 2 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 2 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>

      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>

      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 2 ? "t1Container" : "" ?>">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 2 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[2][0] ?><?= $equipos[3][0] ?>" class="<?php echo $idPartido == 2 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 2 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 2 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 3 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 3 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 3 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 3 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[4][0] ?><?= $equipos[5][0] ?>" class="<?php echo $idPartido == 3 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 3 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 3 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>
  </div>

  <!-- Fecha 2 -->


  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 2</h2>
    </div>
    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 4 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 4 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 4 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 4 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[0][0] ?><?= $equipos[5][0] ?>" class="<?php echo $idPartido == 4 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 4 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 4 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 5 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 5 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 5 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 5 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[1][0] ?><?= $equipos[2][0] ?>" class="<?php echo $idPartido == 5 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 5 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 5 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 6 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 6 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 6 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 6 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[3][0] ?><?= $equipos[4][0] ?>" class="<?php echo $idPartido == 6 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 6 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 6 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>
  </div>


  <!-- Fecha 3 -->


  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 3</h2>
    </div>
    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 7 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 7 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 7 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 7 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[0][0] ?><?= $equipos[2][0] ?>" class="<?php echo $idPartido == 7 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 7 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 7 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 8 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 8 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 8 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 8 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[1][0] ?><?= $equipos[4][0] ?>" class="<?php echo $idPartido == 8 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 8 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 8 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 9 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 9 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 9 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 9 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[3][0] ?><?= $equipos[5][0] ?>" class="<?php echo $idPartido == 9 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 9 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 9 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>
  </div>


  <!-- Fecha 4 -->


  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 4</h2>
    </div>
    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 10 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 10 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 10 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 10 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[0][0] ?><?= $equipos[3][0] ?>" class="<?php echo $idPartido == 10 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 10 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 10 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 11 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 11 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 11 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 11 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[1][0] ?><?= $equipos[5][0] ?>" class="<?php echo $idPartido == 11 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 11 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 11 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 12 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 12 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>

      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 12 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 12 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[2][0] ?><?= $equipos[4][0] ?>" class="<?php echo $idPartido == 12 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 12 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 12 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>
  </div>


  <!-- Fecha 5 -->


  <div class="w-3/4 mx-auto bg-white rounded-xl px-2 pb-2">
    <div class="mt-8 w-full mx-auto py-2">
      <h2 class="font-sans text-bold font-xl text-center mb-2 ">Fecha 5</h2>
    </div>
    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[1][0] ?>"><?= $equipos[1][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 13 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 13 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[3][0] ?>"><?= $equipos[3][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 13 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 13 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[1][0] ?><?= $equipos[3][0] ?>" class="<?php echo $idPartido == 13 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 13 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 13 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[0][0] ?>"><?= $equipos[0][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 14 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 14 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[4][0] ?>"><?= $equipos[4][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 14 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 14 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[0][0] ?><?= $equipos[4][0] ?>" class="<?php echo $idPartido == 14 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 14 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 14 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>


    <hr class="m-2">


    <div class="font-sans grid grid-cols-5 gap-2">
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[2][0] ?>"><?= $equipos[2][1] ?></a>
      </div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 15 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="font-black text-center">VS</div>
      <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido == 15 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
      <div class="bg-gray-500 text-center font-medium text-white rounded-xl">
        <a href="verEquipo.php?id=<?= $equipos[5][0] ?>"><?= $equipos[5][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 15 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido == 15 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <div class="col-span-5 flex justify-center items-center">
        <button id="<?= $equipos[2][0] ?><?= $equipos[5][0] ?>" class="<?php echo $idPartido == 15 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md  <?php echo $idPartido != 15 ? "disabled" : "" ?>">Jugar</button>
        <button class="<?php echo $idPartido == 15 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
      </div>
    </div>
  </div>

  <?php if ($empate) : ?>
    <div class="w-full  top-16 flex flex-col justify-center items-center bg-red-500 position-fixed p-3 rounded mx-auto z-16">
      <h3 class="text-center text-3xl font-bold">Empate</h3>
      <div class="flex flex-row justify-center items-center gap-3">
        <a href="verEquipo.php?id=<?= $ganadores[0][0] ?>" class="text-center text-black font-bold "><?= $ganadores[0][1] ?></a>
        <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido >= 15 ? "team-1" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>
        <div class="font-black text-center">VS</div>
        <div class="flex flex-row justify-center items-center"><input type="number" class="<?php echo $idPartido >= 15 ? "team-2" : "" ?> text-center bg-gray-200 rounded-xl w-full" placeholder="Goles..."></label></div>

        <a href="verEquipo.php?id=<?= $ganadores[1][0] ?>" class="text-center text-black font-bold "><?= $ganadores[1][1] ?></a>
      </div>
      <div class="grid grid-cols-5 col-span-5 gap-2 col-span-2">
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido >= 15 ? "t1Container" : "" ?> ">
        </div>
        <div> </div>
        <div class="grid grid-cols-5 gap-2 col-span-2 <?php echo $idPartido >= 15 ? "t2Container" : "" ?> ">
        </div>
      </div>
      <button id="<?= $equipos[0][0] ?><?= $equipos[1][0] ?>" class="<?php echo $idPartido >= 15 ? "pressedPlay" : "" ?> btn btn-secondary bg-gray-500 px-3 my-3 font-black text-white rounded-md  <?php echo $idPartido >= 15 ? "" : "disabled" ?>">Desempatar</button>
      <button class="<?php echo $idPartido >= 15 ? "pressedConfirm" : "" ?> btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md hidden">Confirmar</button>
    </div>
  <?php endif ?>



</body>

</html>