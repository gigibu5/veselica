<?php

include_once("baza.php");

$narocilo = $_GET["narocilo"];

$conn->query("UPDATE narocilo SET kuhinja = 1 WHERE id = $narocilo");

echo "ok";
