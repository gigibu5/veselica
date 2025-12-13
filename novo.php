<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("preveri.php");

if (isset($_GET["narocilo"])) {
	$narocilo = $_GET["narocilo"];

	$sql = "SELECT CONCAT('Miza ', m.vrsta, m.stolpec)
FROM narocilo n
INNER JOIN miza m ON (n.miza = m.id)
WHERE n.id=$narocilo;";

	$miza = $conn->query($sql)->fetch_column();
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Veselica PGD Šmarca</title>
	<link rel="stylesheet" href="/css/bulma.min.css">
	<script src="js/fontawesome.js" crossorigin="anonymous"></script>
	<script src="js/htmx.min.js"></script>
	<style>
		.spodna {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
			padding-left: 0.75rem;
			padding-right: 0.75rem;
		}

		.mize {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
			grid-auto-rows: 4em;
		}

		.baton {
			height: 100%;
			white-space: normal;
			padding-left: 0;
			padding-right: 0;
			position: relative;
		}

		.vnos-pregled {
			display: grid;
			grid-template-columns: 1fr auto;
			align-items: center;
			border: solid var(--bulma-box-color) 1px;
		}

		.stevec {
			background-color: #fa3e3e;
			border-radius: 2px;
			color: white;

			padding: 1px 3px;
			font-size: 0.8em;

			position: absolute;
			/* Position the badge within the relatively positioned button */
			top: 0;
			right: 0;
		}
	</style>
</head>

<body class="has-navbar-fixed-top has-navbar-fixed-bottom">
	<section class="section p-1">
		<div class="container">
			<nav class="navbar is-flex is-justify-content-space-between is-fixed-top">
				<div class="navbar-item">
					<h1 class="title" id="naslov"><?php
													if (isset($miza)) {
														echo $miza;
													} else {
														echo "Izberi mizo";
													}
													?></h1>
				</div>
				<div class="navbar-item">
					<a id="shrani" class="button is-success" hx-get="shrani_narocilo.php?narocilo=<?php echo $narocilo ?>">
						Shrani
					</a>
				</div>
			</nav>

			<?php
			if (!isset($_GET["narocilo"])) {
				include("mize.php");
			}
			?>

			<div id="dodatki" style="display: none;"></div>

			<div id="novo">
				<?php
				include("artikli.php");
				include("navigacija_spodaj.php");
				?>
			</div>
		</div>
	</section>

	<script>
		let naslov = document.getElementById("naslov");

		let vrsta;
		let stolpec;

		function shraniVrsto(v) {
			vrsta = v;
		}

		function shraniStolpec(s) {
			stolpec = s;
			let izbira = document.getElementById("izbira");
			izbira.classList.remove("is-active");

			naslov.innerHTML = "Miza " + vrsta + stolpec;
		}

		function zapriDodatke() {
			let izbira = document.getElementById("dodatki");
			izbira.classList.remove("is-active");
		}

		document.body.addEventListener("nastaviShrani", function(evt) {
			htmx.find('#shrani').setAttribute('hx-get', '/shrani_narocilo.php?narocilo=' + evt.detail.narocilo);
			htmx.process('#shrani');
		})
	</script>
</body>

</html>