<?php

include_once("baza.php");

$dodatek = $_GET["dodatek"];
$pozicija = $_GET["pozicija"];

$conn->query("INSERT INTO pozicija_ima_dodatek(pozicija, dodatek) VALUES ($pozicija,$dodatek);");

$naziv = $conn->query("SELECT naziv FROM dodatek WHERE id=$dodatek")->fetch_column();

echo <<<BUTTON
<button class="button is-success" hx-swap="outerHTML" hx-get="odstrani_dodatek.php?pozicija=$pozicija&dodatek=$dodatek">$naziv</button>
BUTTON;
