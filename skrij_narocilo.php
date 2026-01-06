<?php

include_once("baza.php");

$narocilo = $_GET["narocilo"];

$conn->query("UPDATE narocilo SET pokazi = 0 WHERE id=$narocilo");
