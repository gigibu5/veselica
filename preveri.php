<?php

include_once("baza.php");

if (isset($_POST["user"]) && isset($_POST["pass"])) {
	setcookie("user", $_POST["user"], time() + 60 * 60 * 24 * 30);
	setcookie("pass", $_POST["pass"], time() + 60 * 60 * 24 * 30);

	$_COOKIE["user"] = $_POST["user"];
	$_COOKIE["pass"] = $_POST["pass"];
}

if (!isset($_COOKIE["user"]) || !isset($_COOKIE["pass"])) {
	include("login.php");
	die;
}

$user = $_COOKIE["user"];
$pass = $_COOKIE["pass"];

$r = $conn->query("SELECT id FROM uporabnik WHERE user='$user' AND pass='$pass';");


if (mysqli_num_rows($r) == 0) {
	include("login.php");
	die;
}

$user_id = mysqli_fetch_assoc($r)["id"];
