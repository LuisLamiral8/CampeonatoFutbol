<?php
header("Content-Type: application/json");


include "db.php";

$t1 = htmlspecialchars($_GET['E1']);
$t2 = htmlspecialchars($_GET['E2']);


$sql = "SELECT * FROM jugadores WHERE equipo=?";
$query = $cn->prepare($sql);
$query->bind_param("i", $t1);
$query->execute();
$t1Players = mysqli_fetch_all($query->get_result());

$sql = "SELECT * FROM jugadores WHERE equipo=?";
$query = $cn->prepare($sql);
$query->bind_param("i", $t2);
$query->execute();
$t2Players = mysqli_fetch_all($query->get_result());

$data = array_merge($t1Players, $t2Players);

echo json_encode($data);
