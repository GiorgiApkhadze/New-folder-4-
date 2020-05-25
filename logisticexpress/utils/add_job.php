<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");

if (!isset($_POST['name']) || 
    !isset($_POST['location']) || 
    !isset($_POST['shdescription']) || 
    !isset($_POST['fdescription'])) exit;

db_Connect();

$id = add_job(  $_POST['name'], 
                $_POST['location'], 
                $_POST['shdescription'], 
                $_POST['fdescription']);

$fields = json_decode($_POST['fields_id'], true);

for ($i = 0; $i < sizeof($fields); $i++)
{
    update_job_id_fields($id, $fields[$i]);
}

db_Disconnect();

header("Location: ../admin.php");

?>