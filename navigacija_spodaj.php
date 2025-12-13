<?php

$a = "";
if (isset($narocilo)) {
	$a = "narocilo=$narocilo";
}
?>

<nav class="navbar buttons spodna is-fixed-bottom">
	<button class="button is-info" hx-get="artikli.php?kategorija=2&<?php echo $a ?>" hx-swap="outerHTML" hx-target="#pogled">
		<span class="icon is-large">
			<i class="fa-solid fa-2x fa-wine-glass"></i>
		</span>
	</button>
	<button class="button is-success" hx-get="artikli.php?kategorija=1&<?php echo $a ?>" hx-swap="outerHTML" hx-target="#pogled">
		<span class="icon is-large">
			<i class="fa-solid fa-2x fa-utensils"></i>
		</span>
	</button>
	<button class="button is-primary" hx-get="pregled.php?<?php echo $a ?>" hx-swap="outerHTML" hx-target="#pogled">
		Pregled
	</button>
</nav>