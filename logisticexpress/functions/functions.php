<?php

function check_user($username, $password)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare('  SELECT
                                    id
                                FROM
                                    hp_users
                                WHERE
                                    username = ?
                                AND
                                    password = ?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ss', $username, $password) === false)
    {
        $stmt->close();
        return false;
    }
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }
    $result = $stmt->get_result();
    $stmt->close();
    $result = $result->fetch_assoc();
    
    if (!isset($result['id'])) return false;
    else return $result;
}

function get_job_data($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            location,
                                            sh_description,
                                            full_description
                                        FROM
                                            hp_jobs
                                        WHERE
                                            id = ?');
    if ($stmt_select === false)
    {
        return false;
    }
    
    if($stmt_select->bind_param('i', $id) === false)
    {
        $stmt_select->close();
        return false;
    }
    
    if($stmt_select->execute() === false)
    {
        $stmt_select->close();
        return false;
    }
    
    $result = $stmt_select->get_result();

    $data = array();

    while ($row = $result->fetch_assoc())
    {
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'location' => $row['location'],
                                    'shdescription' => $row['sh_description'],
                                    'fdescription' => $row['full_description']));
    }

    return $data;
}

function add_job($name, $location, $shdescription, $fdescription)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(  'INSERT INTO
                                    hp_jobs
                                       (name,
                                        location,
                                        sh_description,
                                        full_description)
                                VALUES
                                        (?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('ssss', $name, $location, $shdescription, $fdescription) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

    $id = $stmt->insert_id;
	$stmt->free_result();
	$stmt->close();

    return $id;
}

function add_job_field($data)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    hp_fields
                                       (data)
                                VALUES
                                        (?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('s', $data) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

    $id = $stmt->insert_id;
	$stmt->free_result();
	$stmt->close();

    return $id;
}

function update_job_id_fields($job_id, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    hp_fields
                                SET
                                    job_id=?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ii', $job_id, $id) === false)
    {
        $stmt->close();
        return false;
    }
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }
    return true;
}



function get_jobs()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    id,
                                    name,
                                    location,
                                    sh_description
                                FROM
                                    hp_jobs
                                WHERE
                                    active = 1');
       
    if ($result === false)
    {
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'location' => $row['location'],
                                    'sh_description' => $row['sh_description']));
    }
    return $data;
}

function get_job_tasks($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            data
                                        FROM
                                            hp_fields
                                        WHERE
                                            job_id=?');
    if ($stmt_select === false)
    {
        return false;
    }
    
    if($stmt_select->bind_param('i', $id) === false)
    {
        $stmt_select->close();
        return false;
    }
    
    if($stmt_select->execute() === false)
    {
        $stmt_select->close();
        return false;
    }
    
    $result = $stmt_select->get_result();

    $data = array();

    while ($row = $result->fetch_assoc())
    {
        array_push($data, Array(    'id' => $row['id'],
                                    'data' => $row['data']));
    }

    return $data;
}


function delete_job($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    hp_jobs
                                SET
                                    active=?
                                WHERE
                                    id=?');
    
    if($stmt === false)
    {
        return false;
    }

    $act = 0;
        
    if($stmt->bind_param('ii', $act, $id) === false)
     {
        $stmt->close();
        return false;
     }
   if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }
    
    return true;
}

?>