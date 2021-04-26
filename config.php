<?php
$server = getenv("pidbsrv");
$db = getenv("pidb");
$usr = getenv("pidbusr");
$pass = getenv("pidbpass");
$conn = new PDO(
    "mysql:host=$server;dbname=$db", $usr, $pass
); ?>