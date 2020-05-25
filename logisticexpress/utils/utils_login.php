<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_POST['username']) || !isset($_POST['password'])) exit;

session_start();

db_Connect();

$data = check_user($_POST['username'], $_POST['password']);

db_Disconnect();

if ($data == false)
{
    echo json_encode(0);
}
else
{
    $_SESSION['userid'] = $data['id'];
    $_SESSION['username'] = $_POST['username'];
    echo json_encode(1);
}

?>