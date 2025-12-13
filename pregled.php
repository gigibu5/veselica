<div id="pogled">
	<?php
	include_once("baza.php");

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if (!isset($narocilo))
		$narocilo = $_GET["narocilo"];


	$sql = "SELECT p.id, a.naziv, p.kolicina FROM pozicija p 
	INNER JOIN artikel a ON (a.id = p.artikel)
	WHERE p.narocilo = $narocilo;";

	$res = $conn->query($sql);

	if ($res->num_rows == 0) {
		echo '<p class="title is-4 m-2 mt-5 has-text-centered">Naročilo nima pozicij</p>';
	}

	while ($r = $res->fetch_assoc()) {
		$naziv = $r["naziv"];
		$kolicina = $r["kolicina"];
		$pozicija = $r["id"];

		$manjsaj = ($kolicina == 1) ? "fa-trash" : "fa-minus";

		$dodatki = $conn->query("SELECT GROUP_CONCAT(d.naziv ORDER BY d.naziv SEPARATOR ', ')
		FROM pozicija p
		INNER JOIN pozicija_ima_dodatek pid ON (p.id = pid.pozicija)
		INNER JOIN dodatek d ON (pid.dodatek = d.id)
		WHERE p.id = $pozicija")->fetch_column();

		echo <<<POZICIJA
		<div class="box vnos-pregled" id="pozicija-$pozicija">
			<p class="title is-6 m-0">$naziv</p>
			<div id="gumbi-$pozicija" class="buttons has-addons m-0">
		POZICIJA;
		include("gumbi_pozicija.php");
		echo <<<POZICIJA
			</div>
			$dodatki
		</div>
		POZICIJA;
	}
	/*

<div class="box vnos-pregled">
						<p class="title is-6 m-0">Laško 0,5l</p>
						<div class="buttons has-addons m-0">
							<button class="button is-danger">
								<span class="icon is-small">
									<i class="fas fa-trash"></i>
								</span></button>
							<button class="button">1</button>
							<button class="button is-success">+</button>
						</div>
					</div>
					<div class="box vnos-pregled">
						<p class="title is-6 m-0">Čevapi 8 KOM</p>
						<div class="buttons has-addons m-0">
							<button class="button is-danger">
								<span class="icon is-small">
									<i class="fas fa-trash"></i>
								</span></button>
							<button class="button">1</button>
							<button class="button is-success">+</button>
						</div>
						<p>Kečap, djlkasjdk</p>
					</div>

					*/

	?>

</div>