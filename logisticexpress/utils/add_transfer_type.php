<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_POST['type'])) exit;

db_Connect();

add_transfer_type($_POST['type']);

db_Disconnect();

header("Location: ../add_transfer_type.php");

?>