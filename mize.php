<?php

include_once("baza.php");

if (isset($_GET["miza"])) {
	$vrsta = $_GET["miza"];
	$barva = "is-warning";
	$naslov = "STOLPEC";
	$f = "shraniStolpec";
	$sql = "SELECT id, stolpec AS vrsta FROM miza WHERE vrsta='$vrsta';";
} else {
	$barva = "is-info";
	$naslov = "VRSTA";
	$f = "shraniVrsto";
	$sql = "SELECT DISTINCT vrsta FROM miza;";
}


echo <<<OSNOVA
<div id="izbira" class="modal is-active">
	<div class="modal-background"></div>
	<div class="modal-card">
		<header class="modal-card-head">
			<p class="modal-card-title">Izberi mizo - $naslov</p>
		</header>
		<section class="modal-card-body buttons mize">
OSNOVA;

$result = $conn->query($sql);
while ($r = $result->fetch_assoc()) {
	$miza = $r["vrsta"];
	if (!isset($vrsta)) {
		$a = "hx-get=\"mize.php?miza=$miza\" hx-swap=\"outerHTML\" hx-target=\"#izbira\"";
	} else {
		$id = $r["id"];
		$a = "hx-get=\"novo_narocilo.php?miza=$id\" hx-swap=\"outerHTML\" hx-target=\"#novo\"";
	}
	echo <<<GUMB
			<button class="button $barva" onclick="$f('$miza');" $a>
				$miza
			</button>

	GUMB;
}

echo <<<OSNOVA
		</section>
	</div>
</div>
OSNOVA;
