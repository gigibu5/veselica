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
					<h1 class="title" id="naslov">Izberi mizo</h1>
				</div>
				<div class="navbar-item">
					<a id="shrani" class="button is-success">
						Shrani
					</a>
				</div>
			</nav>

			<div id="pogled" class="mize buttons">
				<button class="button is-primary baton" hx-get="dodaj_pozicijo.php?artikel=31&amp;narocilo=1" hx-swap="outerHTML">
					Čevapčiči 5 kom
				</button> <button class="button is-primary baton" hx-get="dodaj_pozicijo.php?artikel=30&amp;narocilo=1" hx-swap="outerHTML">
					Čevapčiči 8 kom
				</button> <button class="button is-primary baton" hx-get="dodaj_pozicijo.php?artikel=3&amp;narocilo=1" hx-swap="outerHTML">
					Hot Dog
				</button> <button class="button is-primary baton" hx-get="dodaj_pozicijo.php?artikel=33&amp;narocilo=1" hx-swap="outerHTML">
					Klobasa 1/2
				</button> <button class="button is-primary baton" hx-get="dodaj_pozicijo.php?artikel=32&amp;narocilo=1" hx-swap="outerHTML">
					Klobasa cela
				</button> <button class="button is-warning baton" hx-get="dodaj_pozicijo.php?artikel=34&amp;narocilo=1" hx-swap="outerHTML">
					Čevapčiči 5 kom KUPON
				</button> <button class="button is-warning baton" hx-get="dodaj_pozicijo.php?artikel=35&amp;narocilo=1" hx-swap="outerHTML">
					Čevapčiči 8 kom KUPON
				</button> <button class="button is-warning baton" hx-get="dodaj_pozicijo.php?artikel=38&amp;narocilo=1" hx-swap="outerHTML">
					Hot Dog KUPON
				</button> <button class="button is-warning baton" hx-get="dodaj_pozicijo.php?artikel=36&amp;narocilo=1" hx-swap="outerHTML">
					Klobasa 1/2 KUPON
				</button> <button class="button is-warning baton" hx-get="dodaj_pozicijo.php?artikel=37&amp;narocilo=1" hx-swap="outerHTML">
					Klobasa cela KUPON
				</button>
			</div>

			<div id="dodatki" style="display: none;"></div>

			<div id="novo">
			</div>
		</div>
	</section>
</body>

</html>