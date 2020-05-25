<?php

function get_cities()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    id,
                                    text,
                                    image,
                                    description
                                FROM
                                    tm_cities
                                WHERE
                                    active = 1');
       
    if ($result === false)
    {
        return "";
    }
    $data = array();
    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'city' => $row['text'],
                                    'image' => $row['image'],
                                    'description' => $row['description']));
    }
    return $data;
}

function get_types()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    id,
                                    text
                                FROM
                                    tm_types
                                WHERE
                                    active = 1');
       
    if ($result === false)
    {
        return "";
    }
    $data = array();
    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'type' => $row['text']));
    }
    return $data;
}

function get_transfer_types()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    id,
                                    type
                                FROM
                                    tm_transfer_types
                                WHERE
                                    active = 1');
       
    if ($result === false)
    {
        return "";
    }
    $data = array();
    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'type' => $row['type']));
    }
    return $data;
}

function get_plan_yourself_data()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    *
                                FROM
                                    tm_planyourself');
       
    if ($result === false)
    {
        return "";
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'fname' => $row['fname'],
                                    'lname' => $row['lname'],
                                    'email' => $row['email'],
                                    'phone' => $row['phone'],
                                    'arrivaldate' => $row['arrivaldate'],
                                    'departuredate' => $row['departuredate'],
                                    'adults' => $row['adults'],
                                    'children' => $row['children'],
                                    'infants' => $row['infants'],
                                    'hotel' => $row['hotel'],
                                    'budget' => $row['budget'],
                                    'details' => $row['details']));
    }
    return $data;
}

function get_routes()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    tm.id as id,
                                    tm.name as name,
                                    tm.description as description,
                                    tm.image as image,
                                    tm.price as price,
                                    tm.days as days,
                                    tm.draft as draft,
                                    dw.text as destwhere,
                                    tp.text  as type
                                FROM
                                    tm_routes as tm
                                        LEFT JOIN
                                                tm_types as tp
                                                    ON
                                                        tp.id = tm.type
                                        LEFT JOIN
                                            tm_cities as dw
                                                ON
                                                    dw.id = tm.destwhere
                                WHERE
                                    tm.active = 1');
       
    if ($result === false)
    {
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'description' => $row['description'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type'],
                                    'destwhere' => $row['destwhere'],
                                    'days' => $row['days'],
                                    'draft' => $row['draft']));
    }
    return $data;
}

function get_route_details($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            detailed_info
                                        FROM
                                            tm_routes
                                        WHERE
                                            id=?');
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
    $result = $result->fetch_assoc();

    return $result;
}

function get_route_tasks($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            day
                                        FROM
                                            tm_tasks
                                        WHERE
                                            route_id=?');
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
                                    'description' => $row['description'],
                                    'day' => $row['day']));
    }

    return $data;
}

function get_route_tasks_days($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            minutes,
                                            time,
                                            name,
                                            description
                                        FROM
                                            tm_task_day_plans
                                        WHERE
                                            task_id=?');
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
                                    'minutes' => $row['minutes'],
                                    'time' => $row['time'],
                                    'name' => $row['name'],
                                    'description' => $row['description']));
    }

    return $data;
}

function get_route_additional_fields($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            data
                                        FROM
                                            tm_tour_fields
                                        WHERE
                                            route_id=?');
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

function get_route_images($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            image
                                        FROM
                                            tm_tour_images
                                        WHERE
                                            tour_id=?');
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
                                    'image' => $row['image']));
    }

    return $data;
}

function get_routes_detailed()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    tm.id as id,
                                    tm.name as name,
                                    tm.description as description,
                                    tm.image as image,
                                    tm.price as price,
                                    type.text as type,
                                    cities.text as destfrom,
                                    ct.text as destwhere
                                FROM
                                    tm_routes as tm
                                        LEFT JOIN
                                            tm_types as type
                                                ON
                                                    type.id = tm.type
                                        LEFT JOIN
                                            tm_cities as cities
                                                ON
                                                    cities.id = tm.destfrom
                                        LEFT JOIN
                                            tm_cities as ct
                                                ON
                                                    ct.id = tm.destwhere
                                WHERE
                                    tm.active = 1');
       
    if ($result === false)
    {
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'description' => $row['description'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type'],
                                    'destfrom' => $row['destfrom'],
                                    'destwhere' => $row['destwhere']));
    }
    return $data;
}

function get_tour_data($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            detailed_info,
                                            image,
                                            price,
                                            type,
                                            destfrom,
                                            destwhere,
                                            days
                                        FROM
                                            tm_routes
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
                                    'description' => $row['description'],
                                    'detailed_info' => $row['detailed_info'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type'],
                                    'destfrom' => $row['destfrom'],
                                    'destwhere' => $row['destwhere'],
                                    'days' => $row['days']));
    }

    return $data;
}

function get_transfer_data($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            expectation,
                                            image,
                                            type,
                                            price
                                        FROM
                                            tm_transfers
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
                                    'description' => $row['description'],
                                    'expectation' => $row['expectation'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type']));
    }

    return $data;
}

function get_blog_data($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            image
                                        FROM
                                            tm_blog
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
                                    'description' => $row['description'],
                                    'image' => $row['image']));
    }

    return $data;
}

function get_popular_destinations()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT 
                                    cl.route_id as route_id
                                FROM 
                                    tm_clicks as cl
                                    LEFT JOIN
                                            tm_routes as tour
                                                ON
                                                    tour.id = cl.route_id
                                WHERE
                                    tour.active = 1
                                GROUP BY 
                                    cl.route_id
                                ORDER BY COUNT(*) DESC
                                LIMIT 3');
       
    if ($result === false)
    {
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, get_popular_destination_data($row['route_id']));
    }
    return $data;
}

function get_popular_destination_data($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            image,
                                            price,
                                            days
                                        FROM
                                            tm_routes
                                        WHERE
                                            id=?');
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
    $result = $result->fetch_assoc();

    return $result;
}

function get_blog_posts()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    id,
                                    name,
                                    description,
                                    image,
                                    timestamp
                                FROM
                                    tm_blog
                                WHERE
                                    active=1');
       
    if ($result === false)
    {
        return "";
    }
    
    $data = array();

    while ($row = $result->fetch_assoc())
    {
        
        $row['timestamp'] = substr($row['timestamp'], 0, 10);

        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'description' => $row['description'],
                                    'image' => $row['image'],
                                    'timestamp' => $row['timestamp']));
    }
    return $data;
}

function get_single_post($id)
{

    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            name,
                                            description,
                                            image,
                                            timestamp
                                        FROM
                                            tm_blog
                                        WHERE
                                            id=?');
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
    $result = $result->fetch_assoc();

    $result['timestamp'] = substr($result['timestamp'], 0, 10);

    return $result;
}

function add_click($id)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(  'INSERT INTO
                                    tm_clicks
                                        (route_id)
                                VALUES
                                        (?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('i', $id) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_tour_image_gallery($image, $id)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(  'INSERT INTO
                                    tm_tour_images
                                        (image, tour_id)
                                VALUES
                                        (?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('si', $image, $id) === false)
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

function check_user($username, $password)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare('  SELECT
                                    id
                                FROM
                                    tm_users
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

function upload_image($file)
{
    $filename =  mb_convert_encoding($file['image']['name'],  'UTF-8', 'auto');
    $filename = time().'-'.$filename;
    
    //FILE UPLOAD
    if (@(0 < $file['image']['error'] || !isset($file['image'])))
    {
      exit('0');
    }
    else
    {
        move_uploaded_file($file['image']['tmp_name'], '../images/' . $filename);
        //echo json_encode(1);
    }
    
    $Dir = "images/" . $filename;

    return $Dir;
}

function add_city($city, $description, $image)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_cities
                                       (text,
                                        description,
                                        image)
                                VALUES
                                        (?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('sss', $city, $description, $image) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_type($type)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_types
                                        (type)
                                VALUES
                                        (?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('s', $type) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_transfer_type($type)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_transfer_types
                                        (type)
                                VALUES
                                        (?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('s', $type) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_post($name, $description, $image)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_blog
                                       (name,
                                        description,
                                        image)
                                VALUES
                                        (?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('sss', $name, $description, $image) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_tour($name, $description, $detailed_info, $price, $destfrom, $destwhere, $type, $days, $image)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(  'INSERT INTO
                                    tm_routes
                                       (name,
                                        description,
                                        detailed_info,
                                        price,
                                        destfrom,
                                        destwhere,
                                        type,
                                        days,
                                        image)
                                VALUES
                                        (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('ssssiiiis', $name, $description, $detailed_info, $price, $destfrom, $destwhere, $type, $days, $image) === false)
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

function add_tour_day($name, $description, $day, $id)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_tasks
                                       (route_id,
                                        name,
                                        description,
                                        day)
                                VALUES
                                        (?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('isss', $id, $name, $description, $day) === false)
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

function add_day_task($id, $minute, $time, $name, $description)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_task_day_plans
                                       (task_id,
                                        minutes,
                                        time,
                                        name,
                                        description)
                                VALUES
                                        (?, ?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('issss', $id, $minute, $time, $name, $description) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function add_tour_field($data)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_tour_fields
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

function add_tour_image($tour_id, $image)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_tour_images
                                       (tour_id,
                                        image)
                                VALUES
                                        (?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('is', $tour_id, $image) === false)
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

function add_transfer($name, $description, $expectation, $type, $price, $image)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(  'INSERT INTO
                                    tm_transfers
                                       (name,
                                        description,
                                        expectation,
                                        type,
                                        price,
                                        image)
                                VALUES
                                        (?, ?, ?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('sssiss', $name, $description, $expectation, $type, $price, $image) === false)
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

function add_transfer_field($data)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO
                                    tm_transfer_tasks
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

function update_transfer_id_fields($transfer_id, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_transfer_tasks
                                SET
                                    transfer_id=?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ii', $transfer_id, $id) === false)
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

function update_tour_id_image($tour_id, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_tour_images
                                SET
                                    tour_id=?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        echo $stmt->error;
        return false;
    }
    if($stmt->bind_param('ii', $tour_id, $id) === false)
    {echo $stmt->error;
        $stmt->close();
        return false;
    }
    if($stmt->execute() === false)
    {echo $stmt->error;
        $stmt->close();
        return false;
    }
    return true;
}

function update_route_id($route_id, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_tasks
                                SET
                                    route_id=?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ii', $route_id, $id) === false)
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

function update_route_id_fields($route_id, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_tour_fields
                                SET
                                    route_id=?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ii', $route_id, $id) === false)
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

function get_transfers()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    tf.id as id,
                                    tf.name as name,
                                    tf.description as description,
                                    tf.image as image,
                                    tf.price as price,
                                    type.type as type
                                FROM
                                    tm_transfers as tf
                                        LEFT JOIN
                                            tm_transfer_types as type
                                                ON
                                                    type.id = tf.type
                                WHERE
                                    tf.active = 1');
       
    if ($result === false)
    {
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'description' => $row['description'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type']));
    }
    return $data;
}

function get_three_transfer()
{

    global $dbconn;

    $result = $dbconn->query(  'SELECT
                                    tf.id as id,
                                    tf.name as name,
                                    tf.description as description,
                                    tf.image as image,
                                    tf.price as price,
                                    types.type as type
                                FROM
                                    tm_transfers as tf
                                        LEFT JOIN
                                            tm_transfer_types as types
                                                ON
                                                    types.id = tf.type
                                WHERE
                                    tf.active = 1
                                LIMIT 3');
       
    if ($result === false)
    {echo $result->error;
        return false;
    }

    $data = array();

    while ($row = $result->fetch_assoc())
    {
     
        array_push($data, Array(    'id' => $row['id'],
                                    'name' => $row['name'],
                                    'description' => $row['description'],
                                    'image' => $row['image'],
                                    'price' => $row['price'],
                                    'type' => $row['type']));
    }
    return $data;
}

function get_transfer_details($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            description,
                                            expectation,
                                            price
                                        FROM
                                            tm_transfers
                                        WHERE
                                            id=?');
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
    $result = $result->fetch_assoc();

    return $result;
}

function get_transfer_tasks($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            data
                                        FROM
                                            tm_transfer_tasks
                                        WHERE
                                            transfer_id=?');
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

function get_tour_images($id)
{
    global $dbconn;

    $stmt_select = $dbconn->prepare(   'SELECT
                                            id,
                                            image
                                        FROM
                                            tm_tour_images
                                        WHERE
                                            tour_id=?');
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
                                    'image' => $row['image']));
    }

    return $data;
}

function publish_tour($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_routes
                                SET
                                    draft=?
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

function delete_city($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_cities
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

function delete_type($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_types
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

function delete_transfer_type($id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare('  UPDATE
                                    tm_transfer_types
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

function delete_tour($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_routes
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

function delete_transfer($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_transfers
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

function delete_blog($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE
                                    tm_blog
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

function delete_tour_image($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  DELETE FROM
                                    tm_tour_images
                                WHERE
                                    id=?');
    
    if($stmt === false)
    {
        return false;
    }

    if($stmt->bind_param('i', $id) === false)
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

function delete_tour_day($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  DELETE FROM
                                    tm_tasks
                                WHERE
                                    id=?');
    
    if($stmt === false)
    {
        return false;
    }

    if($stmt->bind_param('i', $id) === false)
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

function delete_tour_day_task($id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  DELETE FROM
                                    tm_task_day_plans
                                WHERE
                                    id=?');
    
    if($stmt === false)
    {
        return false;
    }

    if($stmt->bind_param('i', $id) === false)
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

function insert_plan_yourself_data($fname, $lname, $email, $phone, $arrivaldate, $departuredate, $adults, $children, $infants, $hotel, $budget, $details)
{
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'INSERT INTO 
                                    tm_planyourself
                                       (fname, 
                                        lname, 
                                        email, 
                                        phone, 
                                        arrivaldate, 
                                        departuredate, 
                                        adults, 
                                        children, 
                                        infants, 
                                        hotel, 
                                        budget, 
                                        details) 
                                VALUES 
                                        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
    if($stmt === false)
    {
		return false;
    }
    
    
    if($stmt->bind_param('ssssssssssss', $fname, $lname, $email, $phone, $arrivaldate, $departuredate, $adults, $children, $infants, $hotel, $budget, $details) === false)
    {
        $stmt->close();
        return false;
    }
    
    if($stmt->execute() === false)
    {
        $stmt->close();
        return false;
    }

	$stmt->free_result();
	$stmt->close();

    return true;
}

function update_tour($name, $descritpion, $detailed_info, $price, $destfrom, $destwhere, $type, $days, $id)
{
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_routes 
                                SET 
                                    name= ?,
                                    description = ?,
                                    detailed_info = ?,
                                    price = ?,
                                    destfrom = ?,
                                    destwhere = ?,
                                    type = ?,
                                    days = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }

    $act = 0;
        
    if($stmt->bind_param('ssssiiisi', $name, $descritpion, $detailed_info, $price, $destfrom, $destwhere, $type, $days, $id) === false)
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

function update_tour_image($image, $id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_routes 
                                SET 
                                    image = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }
        
    if($stmt->bind_param('si', $image, $id) === false)
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

function update_transfer($name, $descritpion, $expectation, $type, $price, $id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_transfers
                                SET 
                                    name= ?,
                                    description = ?,
                                    expectation = ?,
                                    type = ?,
                                    price = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }

    $act = 0;
        
    if($stmt->bind_param('sssssi', $name, $descritpion, $expectation, $type, $price, $id) === false)
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

function update_transfer_image($image, $id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_transfers 
                                SET 
                                    image = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }
        
    if($stmt->bind_param('si', $image, $id) === false)
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

function update_blog($name, $descritpion, $id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_blog 
                                SET 
                                    name= ?,
                                    description = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }

    $act = 0;
        
    if($stmt->bind_param('ssi', $name, $descritpion, $id) === false)
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

function update_blog_image($image, $id)
{
    
    global $dbconn;

    $stmt = $dbconn->prepare('  UPDATE 
                                    tm_blog
                                SET 
                                    image = ?
                                WHERE 
                                    id = ?');
    
    if($stmt === false)
    {
        return false;
    }
        
    if($stmt->bind_param('si', $image, $id) === false)
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

function update_tour_day($name, $description, $day, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_tasks
                                SET
                                    name = ?,
                                    description = ?,
                                    day = ?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('sssi', $name, $description, $day, $id) === false)
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

function update_tour_tasks($minutes, $time, $name, $description, $id)
{
    
    global $dbconn;
    
    $stmt = $dbconn->prepare(   'UPDATE
                                    tm_task_day_plans
                                SET
                                    minutes = ?,
                                    time = ?,
                                    name = ?,
                                    description = ?
                                WHERE
                                    id=?');
    if($stmt === false)
    {
        return false;
    }
    if($stmt->bind_param('ssssi', $minutes, $time, $name, $description, $id) === false)
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