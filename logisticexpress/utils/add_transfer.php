<?php

require_once(__DIR__ . "/../functions/db.php");
require_once(__DIR__ . "/../functions/functions.php");
var_dump($_POST, $_FILES);
if (!isset($_POST['name']) || 
    !isset($_POST['description']) || 
    !isset($_POST['expectation']) || 
    !isset($_POST['price']) || 
    !isset($_POST['type']) || 
    !isset($_FILES['image'])) exit;

db_Connect();

$image = upload_image($_FILES);

$id = add_transfer( $_POST['name'], 
                    $_POST['description'], 
                    $_POST['expectation'], 
                    $_POST['type'],  
                    $_POST['price'],
                    $image);

$fields = json_decode($_POST['fields_id'], true);

for ($i = 0; $i < sizeof($fields); $i++)
{
    update_transfer_id_fields($id, $fields[$i]);
}

db_Disconnect();

header("Location: ../add_transfer.php");

?>