<?php
include_once("baza.php");

$dodatek = $_GET["dodatek"];
$pozicija = $_GET["pozicija"];

$conn->query("DELETE FROM pozicija_ima_dodatek WHERE pozicija=$pozicija AND dodatek=$dodatek;");

$naziv = $conn->query("SELECT naziv FROM dodatek WHERE id=$dodatek")->fetch_column();

echo <<<BUTTON
<button class="button is-danger" hx-swap="outerHTML" hx-get="dodaj_dodatek.php?pozicija=$pozicija&dodatek=$dodatek">$naziv</button>
BUTTON;
