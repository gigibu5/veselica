<?php

include_once("baza.php");

$artikel = $_GET["artikel"];
$narocilo = $_GET["narocilo"];

$c = $conn->query("SELECT naziv, barva FROM artikel WHERE id = $artikel");
$r = $c->fetch_assoc();
$naziv_artikla = $r["naziv"];
$barva_artikla = $r["barva"];

$sql = "SELECT d.id, d.naziv, aid.privzet
FROM artikel_ima_dodatek aid
INNER JOIN dodatek d ON (d.id = aid.dodatek)
WHERE aid.artikel = $artikel;";

$res = $conn->query($sql);

$c = $conn->query("SELECT id FROM pozicija WHERE artikel=$artikel AND narocilo=$narocilo");
if ($c->num_rows > 0) {
	$pozicija = $c->fetch_column();
	$conn->query("UPDATE pozicija SET kolicina=kolicina+1 WHERE id=$pozicija");
} else {
	$conn->query("INSERT INTO pozicija(narocilo, artikel) VALUES ($narocilo,$artikel);");
}
echo <<<IZPIS
	<button class="button $barva_artikla baton" hx-get="dodaj_pozicijo.php?artikel=$artikel&narocilo=$narocilo" hx-swap="outerHTML">
		$naziv_artikla
	</button>
IZPIS;
