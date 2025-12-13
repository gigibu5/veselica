<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once("baza.php");

$narocilo = $_GET["narocilo"];

$conn->query("UPDATE narocilo SET cas = CURRENT_TIMESTAMP WHERE id=$narocilo");

header("hx-redirect: /natakar.php");
