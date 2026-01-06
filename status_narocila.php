<?php

// <span class="tag is-success">Kuhinja je dostavila naročilo</span>
// <span class="tag is-warning">Kuhinja je prevzela naročilo</span>
// <span class="tag is-danger">Kuhinja ni prevzela naročila</span>

include_once("baza.php");

if (!isset($narocilo)) {
	$narocilo = $_GET["narocilo"];
	$c = $conn->query("SELECT kuhinja FROM narocilo WHERE id = $narocilo");
	$kuhinja = $c->fetch_column();
}

if (intval($kuhinja)) {
	echo '<span class="tag is-success">Kuhinja je prevzela naročilo</span>';
} else {
	echo <<<SPAN
	<span class="tag is-danger"
		hx-get="/status_narocila.php?narocilo=$narocilo"
		hx-trigger="every 1s"
		hx-swap="outerHTML">
			Kuhinja ni prevzela naročila
	</span>
	SPAN;
}
