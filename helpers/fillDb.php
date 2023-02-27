<?php
include("db.php");

$equipos = [
    "Boca",
    "River",
    "Independiente",
    "Racing",
    "Chacarita",
    "Chicago"
];

$nombrePersonas = [
    "Luis",
    "Ignacio",
    "Ezequiel",
    "Fernando",
    "Valentin",
    "José",
    "Juan",
    "Salvador",
    "Ignacio",
    "Hector",
    "Francisco",
    "Ramón",
    "Pedro",
    "Lucas"
];

$apellidoPersonas = [
    "Lamiral",
    "Roa",
    "Abraham",
    "Lamiral",
    "Massini",
    "Galan",
    "Perez",
    "Gonzalez",
    "Locatti",
    "Perez",
    "Gonzalez",
    "Fernandez",
    "Benitez"
];


$sql = "INSERT INTO equipos (nombre,pj,pg,pe,pp,gf,gc) VALUES (?,?,?,?,?,?,?)";
$consulta = $cn->prepare($sql);
$v = 0;

foreach($equipos as $equipo){

    $consulta->bind_param("siiiiii",$equipo,$v,$v,$v,$v,$v,$v);
    $consulta->execute();
}


$sql = "INSERT INTO jugadores (nombre,apellido,fechaNacimiento,altura,puesto,peso,DNI,equipo) VALUES (?,?,?,?,?,?,?,?)";
$consulta = $cn->prepare($sql);
$equipo = 1;
$puesto = 1;

for($x=1;$x<61;$x++){

    $nombreJugador = $nombrePersonas[rand(0,count($nombrePersonas)-1)];
    $apellidoJugador = $apellidoPersonas[rand(0,count($apellidoPersonas)-1)];

    $año = rand(1995,2004);
    $mes = rand(1,12);
    $dia = rand(1,28);
    $fechaNacimiento = date("$año-$mes-$dia");

    $altura = rand(160,195) / 100;

    if($x%10<2) $puesto = 1; //Arqueros
    else if($x%10<4) $puesto = 2; //Defensores
    else if($x%10<8) $puesto = 3; //Delanteros
    else $puesto = 4; //Mediocampistas

    $peso = rand(65,95);
    $DNI = rand(35000000,45000000);

    $consulta->bind_param("sssdiiii",$nombreJugador,$apellidoJugador,$fechaNacimiento,$altura,$puesto,$peso,$DNI,$equipo);
    $consulta->execute();

    if($x%10==0 && $x>1) $equipo++;
}

$sql = "INSERT INTO staff (nombre,apellido,fechaNacimiento,altura,puesto,peso,DNI,equipo) VALUES (?,?,?,?,?,?,?,?)";
$consulta = $cn->prepare($sql);

$equipo = 1;

for($x=1;$x<19;$x++){

    $nombreStaff = $nombrePersonas[rand(0,count($nombrePersonas)-1)];
    $apellidoStaff = $apellidoPersonas[rand(0,count($apellidoPersonas)-1)];

    $año = rand(1995,2004);
    $mes = rand(1,12);
    $dia = rand(1,28);
    $fechaNacimiento = date("$año-$mes-$dia");

    $altura = rand(160,199) / 100;


    if($x%3==0) $puesto = 3; //Medico
    else if($x%3==2) $puesto = 2; //Preparador fisico
    else $puesto = 1; //tecnico


    $peso = rand(65,95);
    $DNI = rand(40123546,42987253);

    $consulta->bind_param("sssdiiii",$nombreStaff,$apellidoStaff,$fechaNacimiento,$altura,$puesto,$peso,$DNI,$equipo);
    $consulta->execute();

    if($x%3==0 && $x>1) $equipo++;
}