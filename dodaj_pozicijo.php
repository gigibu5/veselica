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

if ($res->num_rows > 0) {
	echo <<<MODAL
	<div hx-swap-oob="true" id="dodatki" class="modal is-active">
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Dodatki</p>
			</header>
			<section class="modal-card-body buttons mize m-0">
	MODAL;

	$conn->query("INSERT INTO pozicija(narocilo, artikel) VALUES ($narocilo,$artikel);");

	$pozicija = $conn->insert_id;

	while ($r = $res->fetch_assoc()) {
		$barva = ($r["privzet"]) ? "is-success" : "is-danger";
		$naziv = $r["naziv"];
		$did = $r["id"];
		$akcija = ($r["privzet"]) ? "odstrani_dodatek.php?pozicija=$pozicija&dodatek=$did" : "dodaj_dodatek.php?pozicija=$pozicija&dodatek=$did";

		echo <<<BUTTON
		<button class="button $barva" hx-swap="outerHTML" hx-get="$akcija">$naziv</button>
		BUTTON;
	}
	echo <<<MODAL
			</section>
			<footer class="modal-card-foot buttons is-right">
				<button class="button is-success" onclick="zapriDodatke()">Shrani</button>
			</footer>
		</div>
	</div>
	MODAL;

	$kolicina = 1;
} else {
	$c = $conn->query("SELECT id FROM pozicija WHERE artikel=$artikel AND narocilo=$narocilo");
	if ($c->num_rows > 0) {
		$pozicija = $c->fetch_column();
		$conn->query("UPDATE pozicija SET kolicina=kolicina+1 WHERE id=$pozicija");
	} else {
		$conn->query("INSERT INTO pozicija(narocilo, artikel) VALUES ($narocilo,$artikel);");
	}
}

$c = $conn->query("SELECT SUM(kolicina) as kolicina FROM pozicija WHERE artikel = $artikel AND narocilo = $narocilo;");
$kolicina = $c->fetch_column();

echo <<<IZPIS
	<button class="button $barva_artikla baton" hx-get="dodaj_pozicijo.php?artikel=$artikel&narocilo=$narocilo" hx-swap="outerHTML">
		$naziv_artikla
		<span class="stevec">$kolicina</span>
	</button>
IZPIS;
