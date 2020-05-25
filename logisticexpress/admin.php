<?php

require_once(__DIR__ . "/functions/db.php");
require_once(__DIR__ . "/functions/functions.php");

session_start();

if (!isset($_SESSION['userid']) && !isset($_SESSION['username'])) header('Location: ./login.php');

db_Connect();

$jobs = get_jobs();

db_Disconnect();

if (isset($_GET['logout']) && $_GET['logout'] == 1)
{
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    session_destroy();
    header('Location: ./index.php');
}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->

    <link rel="stylesheet" href="css/admin.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/functions.js"></script>

    <style>
        * {
        box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
    </style>
</head>
<body>
<header role="banner">
    <h1>Admin Panel</h1>
    <ul class="utilities">
        <br>
        <li class="logout warn"><a href="./admin.php?logout=1">Log Out</a></li>
    </ul>
</header>

<main role="main">


    <section class="panel important">
        <h2>Add a job</h2>
        <form action="./utils/add_job.php" method="post" enctype="multipart/form-data">
            <div class="twothirds">
                Job Name:<br/>
                <input type="text" name="name" size="40"/><br/><br/>
                Job Location:<br/>
                <input type="text" name="location" size="40"/><br/>
                Job Short Description<br/>
                <textarea name="shdescription" rows="15" cols="67"></textarea><br/>
                Job Full Description<br/>
                <textarea name="fdescription" rows="15" cols="67"></textarea><br/>
            </div>
            <div>
                <input type="hidden" value="" id="job_fields_id" name="fields_id"/>
                <input type="submit" name="submit" value="Save"/>
            </div>
            </div>
        </form>
            <div class="w3-container">
                <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">Inside Fields</button>
                <div id="id02" class="w3-modal">
                    <div class="w3-modal-content" style="height: 90%;">
                        <div class="w3-container">
                            <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <div style="margin: 20px;">
                                <div class="row">
                                    <div class="column" style="width: 50%;border-right: black solid 1px;">
                                        Job inside header:<br>
                                        <input type="text" id="header"><br><br>
                                    </div>
                                    <div class="column" style="width: 50%;">
                                        <div id="values">
                                            Job inside values:<br>
                                            <input type="text" class="header_value"><br><br>
                                        </div>
                                        <button onclick="add_value();">Add</button>
                                        <button onclick="add_additional_field();">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="panel important">
        <table>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            <?php
            foreach ($jobs as $jb):
            ?>
                <tr>
                    <td><?=$jb['name'] ?></td>
                    <td><button onclick="delete_job(<?=$jb['id'] ?>, this.closest('tr'));">Delete</button></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </section>

</main>


</body>