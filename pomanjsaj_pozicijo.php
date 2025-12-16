<?php
include_once("baza.php");

$pozicija = $_GET["pozicija"];

$conn->query("UPDATE pozicija SET kolicina = kolicina - 1 WHERE id=$pozicija");

$kolicina = $conn->query("SELECT kolicina FROM pozicija WHERE id=$pozicija")->fetch_column();

include("gumbi_pozicija.php");
