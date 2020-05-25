<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_POST['Data'])) exit;

db_Connect();

echo json_encode(add_transfer_field($_POST['Data']), true);

db_Disconnect();


?>