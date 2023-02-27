<?php

include "db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
}
$zero = "0";
$one = "1";
$three = "3";
$winner = null;
echo json_encode($data);
// echo "----";

// echo $data->tie;

// $sqlTeam1 = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
// $queryGetTeams1 = $cn->prepare($sqlTeam1);
// $queryGetTeams1->bind_param('i', $data->t1Id);
// $queryGetTeams1->execute();
// $team1 = mysqli_fetch_all($queryGetTeams1->get_result());

// $sqlTeam2 = "SELECT * FROM equipos WHERE ID=? LIMIT 1";
// $queryGetTeams2 = $cn->prepare($sqlTeam2);
// $queryGetTeams2->bind_param('i', $data->t2Id);
// $queryGetTeams2->execute();
// $team2 = mysqli_fetch_all($queryGetTeams2->get_result());


if ($data->tie === "true") {
    echo "Empate es true";
    //Team 1
    $sqlTeam1 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
    $queryUpdateTeam1 = $cn->prepare($sqlTeam1);
    $queryUpdateTeam1->bind_param("iiiiiiii", $one, $zero, $one, $zero, $data->t1Goles, $data->t2Goles, $one, $data->t1Id);
    $queryUpdateTeam1->execute();
    //Team 2
    $sqlTeam2 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
    $queryUpdateTeam2 = $cn->prepare($sqlTeam2);
    $queryUpdateTeam2->bind_param("iiiiiiii", $one, $zero, $one, $zero, $data->t2Goles, $data->t1Goles, $one, $data->t2Id);
    $queryUpdateTeam2->execute();
} else {
    if ($data->winner == $data->t1Id) {
        //Team 1 win (+3 points)
        $sqlTeam1 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
        $queryUpdateTeam1 = $cn->prepare($sqlTeam1);
        $queryUpdateTeam1->bind_param("iiiiiiii", $one, $one, $zero, $zero, $data->t1Goles, $data->t2Goles, $three, $data->t1Id);
        $queryUpdateTeam1->execute();
        //Team 2 lose (+$zero points)
        $sqlTeam2 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
        $queryUpdateTeam2 = $cn->prepare($sqlTeam2);
        $queryUpdateTeam2->bind_param("iiiiiiii", $one, $zero, $zero, $one, $data->t2Goles, $data->t1Goles, $zero, $data->t2Id);
        $queryUpdateTeam2->execute();
    } else {
        //Team 2 win (+3 points)
        $sqlTeam1 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
        $queryUpdateTeam1 = $cn->prepare($sqlTeam1);
        $queryUpdateTeam1->bind_param("iiiiiiii", $one, $one, $zero, $zero, $data->t2Goles, $data->t1Goles, $three, $data->t2Id);
        $queryUpdateTeam1->execute();
        //Team 1 lose (+$zero points)
        $sqlTeam2 = "UPDATE equipos SET pj=pj+?,pg=pg+?,pe=pe+?,pp=pp+?,gf=gf+?,gc=gc+?,puntos=puntos+? WHERE ID=?";
        $queryUpdateTeam2 = $cn->prepare($sqlTeam2);
        $queryUpdateTeam2->bind_param("iiiiiiii", $one, $zero, $zero, $one, $data->t1Goles, $data->t2Goles, $zero, $data->t1Id);
        $queryUpdateTeam2->execute();
    }
}
foreach ($data->goles as $i => $players) {
    $sqlPlayers = "UPDATE jugadores SET goles=goles+? WHERE ID=?";
    $queryUpdatePlayers = $cn->prepare($sqlPlayers);
    $queryUpdatePlayers->bind_param('ii', $players->goles, $players->idPlayer);
    $queryUpdatePlayers->execute();
}
$sqlGame = "INSERT INTO partidos (ID_equipoA,ID_equipoB,goles_equipoA,goles_equipoB) VALUES (?,?,?,?)";
$queryGame = $cn->prepare($sqlGame);
$queryGame->bind_param('iiii', $data->t1Id, $data->t2Id, $data->t1Goles, $data->t2Goles);
$queryGame->execute();
