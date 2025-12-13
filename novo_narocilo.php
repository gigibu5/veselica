<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("baza.php");
include_once("preveri.php");

$miza = $_GET["miza"];

$conn->query("INSERT INTO narocilo(miza, uporabnik) VALUES ($miza,$user_id);");

$narocilo = $conn->insert_id;
#$narocilo = 2;

header("hx-replace-url: /novo.php?narocilo=$narocilo");
header("HX-Trigger: {\"nastaviShrani\":{\"narocilo\":\"$narocilo\"}}");

include("artikli.php"); 
include("navigacija_spodaj.php");
