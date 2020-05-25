<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_POST['id'])) exit;

db_Connect();

echo delete_job($_POST['id']);

db_Disconnect();

?>