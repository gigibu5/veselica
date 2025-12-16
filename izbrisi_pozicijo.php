<?php
include_once("baza.php");

$pozicija = $_GET["pozicija"];

$conn->query("DELETE FROM pozicija WHERE id=$pozicija");
