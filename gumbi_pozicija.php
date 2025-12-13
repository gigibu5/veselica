<?php
$manjsaj = ($kolicina == 1) ? "fa-trash" : "fa-minus";
$akcija = ($kolicina == 1) ? "izbrisi" : "pomanjsaj";
$swap = ($kolicina == 1) ? 'hx-swap="outerHTML"' : "";
$target = ($kolicina == 1) ? "pozicija" : "gumbi";
?>

<button class="button is-danger" hx-target="#<?php echo $target . "-" . $pozicija ?>" hx-get="<?php echo $akcija ?>_pozicijo.php?pozicija=<?php echo $pozicija ?>" <?php echo $swap ?>>
	<span class="icon is-small">
		<i class="fas <?php echo $manjsaj ?>"></i>
	</span></button>
<button class="button"><?php echo $kolicina ?></button>
<button class="button is-success" hx-target="#gumbi-<?php echo $pozicija ?>" hx-get="povecaj_pozicijo.php?pozicija=<?php echo $pozicija ?>">
	<span class="icon is-small">
		<i class="fas fa-plus"></i>
	</span></button>
</button>