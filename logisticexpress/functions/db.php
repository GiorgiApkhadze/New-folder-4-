<?php

require_once(__DIR__ . "/functions.php");

$dbconn;

function db_Connect()
{
    global $dbconn;
	// $dbconn = new mysqli('localhost', 'halitr5_user', 'Hailtrephes123#', 'halitr5_web');
	$dbconn = new mysqli('localhost', 'root', '', 'hailtrephes');
	if ($dbconn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$dbconn->set_charset("utf8");
}

function db_Disconnect()
{
    global $dbconn;
	$dbconn->close();
}

?>
