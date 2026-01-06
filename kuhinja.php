<?php
include_once("baza.php");

$sql = "SELECT DISTINCT n.id,
	CONCAT(m.vrsta, m.stolpec) as miza,
	DATE_FORMAT(n.cas, '%e.%c.%Y ob %H:%i') as cas,
	u.ime as uporabnik
FROM narocilo n
INNER JOIN miza m ON (m.id = n.miza)
INNER JOIN pozicija p ON (p.narocilo = n.id)
INNER JOIN artikel a ON (a.id = p.artikel)
INNER JOIN uporabnik u ON (u.id = n.uporabnik)
WHERE kuhinja = 0 AND a.kategorija = 1 AND n.cas IS NOT NULL
ORDER BY n.cas;";

$narocila = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

foreach ($narocila as &$n) {
	$id = $n["id"];

	$sql = "SELECT p.id,
		p.kolicina,
		a.naziv, 
		IF(COUNT(aid.artikel) > 0, 1, 0) as ima_dodatke
    FROM pozicija p
    INNER JOIN artikel a ON (a.id = p.artikel)
    LEFT JOIN artikel_ima_dodatek aid ON (p.artikel = aid.artikel)
    WHERE p.narocilo = $id and a.kategorija = 1
    GROUP BY p.id
    ORDER BY a.naziv;";

	$n["pozicija"] = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

	foreach ($n["pozicija"] as &$p) {
		if (!$p["ima_dodatke"]) continue;

		$pozicija = $p["id"];

		$sql = "SELECT d.naziv
		FROM pozicija_ima_dodatek pid
		INNER JOIN dodatek d ON (d.id = pid.dodatek)
		WHERE pid.pozicija = $pozicija
		ORDER BY d.naziv;";

		$p["dodatek"] = array_column($conn->query($sql)->fetch_all(), 0);
	}
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($narocila);
