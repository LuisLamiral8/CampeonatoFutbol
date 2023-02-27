<?php

session_start();
include "db.php";

$data = json_decode($_POST['json']);

$sqlEquipo = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
$traerEquipo = $cn->prepare($sqlEquipo);

$sqlJugadores = "UPDATE jugadores SET goles=? WHERE ID=?";
$actualizarJugador = $cn->prepare($sqlJugadores);

$sqlEquipo = "UPDATE equipos SET pj=?,pg=?,pe=?,pp=?,gf=?,gc=?,puntos=? WHERE ID=?";
$actualizarEquipo = $cn->prepare($sqlEquipo);

$ganador = null; 

foreach($data as $i => $equipo){

    $traerEquipo->bind_param('i',$equipo->equipo); 
    $traerEquipo->execute();
    $equipoDB = mysqli_fetch_assoc($traerEquipo->get_result());

    $pj = intval($equipoDB["pj"]) + 1; 
    $pg = intval($equipoDB["pg"]);
    $pe = intval($equipoDB['pe']);
    $pp = intval($equipoDB['pp']);

    $puntosEquipo = intval($equipoDB['puntos']);

    if($i == 0){
        if($equipo->goles > $data[1]->goles) $ganador = $equipo->equipo; 
        else if($data[1]->goles > $equipo->goles) $ganador = $data[1]->equipo;
    }
    if($ganador == null){
        $pe++;
        $puntosEquipo++;
    } 
    else if($ganador == $equipo->equipo){ 
        $pg++;
        $puntosEquipo += 3;
    } 
    else $pp++; 

    $gf = $equipo->goles;
    $gc = $i == 0 ? $data[1]->goles : $data[0]->goles; 

   
    if(count($equipo->goleadores) > 0){
        foreach((array) $equipo->goleadores as $goleador){
            $actualizarJugador->bind_param('ii',$goleador->goles,$goleador->idJugador);
            $actualizarJugador->execute();
        }
    }

   
    $actualizarEquipo->bind_param('iiiiiiii',$pj,$pg,$pe,$pp,$gf,$gc,$puntosEquipo,$equipo->equipo);
    $actualizarEquipo->execute();

}

$sqlPartido = "INSERT INTO partidos (ID_equipoA,ID_equipoB,goles_equipoA,goles_equipoB) VALUES (?,?,?,?)";
$consultaPartido = $cn->prepare($sqlPartido);
$consultaPartido->bind_param('iiii',$data[0]->equipo,$data[1]->equipo,$data[0]->goles,$data[1]->goles);
$consultaPartido->execute();


