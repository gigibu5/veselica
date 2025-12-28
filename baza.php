<?php
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// prilagoditve za dokerizacijo - če baza ne obstaja, jo ustvari in naloži začetne podatke
$obstaja = $conn->query("SHOW DATABASES LIKE '$dbname';")->num_rows;

if (!$obstaja) {
	$sql = "CREATE DATABASE $dbname";
	$conn->query($sql);
	$conn->select_db($dbname);
}
$conn->select_db($dbname);

$so_tabele = $conn->query("SHOW TABLES LIKE 'uporabnik';")->num_rows;

if (!$so_tabele) {
	$filename = 'veselica-1.sql';

	$templine = '';
	$lines = file($filename);
	foreach ($lines as $line) {
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;

		$templine .= $line;

		if (substr(trim($line), -1, 1) == ';') {
			$conn->query($templine);
			$templine = '';
		}
	}
}
