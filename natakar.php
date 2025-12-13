<?php

include_once("baza.php");
include_once("preveri.php");

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
			grid-template-columns: 1fr;
			padding-left: 0.75rem;
			padding-right: 0.75rem;
		}

		.card {
			border: solid var(--bulma-card-color) 1px;
		}
	</style>
</head>

<body class="has-navbar-fixed-top has-navbar-fixed-bottom">
	<section class="section p-1">
		<div class="container">
			<div id="pogled">
				<?php
				include("narocila.php");
				?>
			</div>

			<nav class="navbar buttons spodna is-fixed-bottom">
				<a href="novo.php" class="button is-info">
					Novo naročilo
				</a>
			</nav>
		</div>
	</section>
</body>

</html>