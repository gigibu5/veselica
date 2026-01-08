<div id="pogled" class="mize buttons">

	<?php

	include_once("baza.php");

	$kategorija = 1;
	if (isset($_GET["kategorija"])) {
		$kategorija = $_GET["kategorija"];
	}

	if (isset($_GET["narocilo"])) {
		$narocilo = $_GET["narocilo"];
	}

	if (!isset($narocilo)) {
		$narocilo = "1";
	}

	$sql = "SELECT a.id, a.naziv, a.barva, p.kolicina
	FROM artikel a
	LEFT JOIN (
		SELECT p.artikel, SUM(p.kolicina) as kolicina
		FROM pozicija p
		WHERE narocilo = $narocilo
		GROUP BY p.artikel
	) p ON (p.artikel = a.id)
	WHERE a.kategorija = $kategorija
	GROUP BY a.id
	ORDER BY a.barva, a.naziv;";

	$res = $conn->query($sql);

	//print_r($res->fetch_all(MYSQLI_ASSOC));

	while ($r = $res->fetch_assoc()) {
		$aid = $r["id"];
		$naziv = $r["naziv"];
		$barva = $r["barva"];
		$kolicina = $r["kolicina"];

		echo <<<IZPIS
			<button class="button $barva baton" hx-get="dodaj_pozicijo.php?artikel=$aid&narocilo=$narocilo" hx-swap="outerHTML">
				$naziv
		IZPIS;

		if ($kolicina) {
			echo "<span class=\"stevec\">$kolicina</span>";
		}

		echo <<<IZPIS
			</button>
		IZPIS;
	}
	?>
</div>