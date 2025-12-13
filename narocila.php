<?php

include_once("baza.php");
include_once("preveri.php");

$pokazi = (isset($_GET["pokazi"])) ? (int)$_GET["pokazi"] : 1;
$naslov = ($pokazi) ? "Naročila" : "Pretekla naročila";
$barva = ($pokazi) ? "is-info" : "is-danger";

?>

<nav class="navbar is-flex is-justify-content-space-between is-fixed-top">
	<div class="navbar-item">
		<h1 class="title"><?php echo $naslov ?></h1>
	</div>
	<div class="navbar-item buttons">
		<a class="button <?php echo $barva ?>" hx-target="#pogled" hx-get="narocila.php?pokazi=<?php echo !$pokazi; ?>">
			<span class="icon">
				<i class="fa-solid fa-clock-rotate-left"></i>
			</span>
		</a>
	</div>
</nav>

<?php

$uredi = ($pokazi) ? "" : "DESC LIMIT 20";

$res = $conn->query("SELECT DISTINCT n.id,
	CONCAT(m.vrsta, m.stolpec) as miza,
	DATE_FORMAT(n.cas, '%e.%c.%Y ob %H:%i') as cas,
	n.kuhinja
FROM narocilo n
INNER JOIN miza m ON (m.id = n.miza)
INNER JOIN pozicija p ON (p.narocilo = n.id)
WHERE uporabnik = $user_id AND pokazi = $pokazi
ORDER BY n.cas $uredi;");

if ($res->num_rows == 0) {
?>
	<p class="title is-4">Ni odprtih naročil</p>
	<?php
} else {
	while ($r = $res->fetch_assoc()) {
		$narocilo = $r["id"];
		$miza = $r["miza"];
		$cas = $r["cas"];
		$kuhinja = $r["kuhinja"];
	?>
		<div class="card" id="narocilo-<?php echo $narocilo ?>">
			<header class="card-header">
				<p class="card-header-title">Miza <?php echo $miza ?> - <?php echo $cas ?></p>
				<?php
				if ($pokazi) {
					echo <<<ZAPRI
				<button class="card-header-icon" hx-target="#narocilo-$narocilo" hx-swap="delete" hx-get="skrij_narocilo.php?narocilo=$narocilo">
					<span class="icon">
						<i class="fas fa-circle-xmark"></i>
					</span>
				</button>
				ZAPRI;
				}
				?>
			</header>
			<div class="card-content">
				<div class="content">
					<ul>
						<?php
						$sql = "SELECT p.kolicina, a.naziv, a.kategorija
							FROM pozicija p
							INNER JOIN artikel a ON (a.id = p.artikel)
							AND p.narocilo = $narocilo;";

						$pozicije = $conn->query($sql);
						while ($p = $pozicije->fetch_assoc()) {
							$kolicina = $p["kolicina"];
							$naziv = $p["naziv"];
							echo "<li>" . $kolicina . "x $naziv</li>";
						}

						?>
					</ul>
				</div>
			</div>
		</div>
<?php
	}
}
