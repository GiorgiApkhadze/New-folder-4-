<?php

require_once(__DIR__ . "/functions/db.php");
require_once(__DIR__ . "/functions/functions.php");

session_start();


if (!isset($_SESSION['userid']) && !isset($_SESSION['username'])) header('Location: ./login.php');
db_Connect();

$types = get_transfer_types();
$transfers = get_transfers();

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
    <script src="./js/add_transfer.js"></script>

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
        <li class="logout warn"><a href="./add_transfer.php?logout=1">Log Out</a></li>
    </ul>
</header>

<nav role='navigation'>
    <ul class="main">
        <li class="dashboard"><a href="admin.php">Dashboard</a></li>
        <li class="edit"><a href="add_tour.php">Add tours</a></li>
        <li class="edit"><a href="add_transfer.php">Add transfers</a></li>
        <li class="comments"><a href="add_blog.php">add blog</a></li>
        <li class="write"><a href="add_city.php">Add city</a></li>
        <li class="users"><a href="add_type.php">Add type</a></li>
        <li class="users"><a href="add_transfer_type.php">Add transfer type</a></li>
    </ul>
</nav>

<main role="main">


    <section class="panel important">
        <h2>Write a post</h2>
        <form action="./utils/add_transfer.php" method="post" enctype="multipart/form-data">
            <div class="twothirds">
                Name:<br/>
                <input type="text" name="name" size="40"/><br/><br/>
                Description:<br/>
                <input type="text" name="description" size="40"/><br/>
                What eo expect?<br/>
                <textarea name="expectation" rows="15" cols="67"></textarea><br/>
                Price:<br/>
                <input type="text" name="price" size="40"/><br/>
                type:<br/>
                <select name="type">
                <option></option>
                <?php
                    foreach ($types as $tp) :
                    ?>
                        <option value="<?=$tp['id'] ?>"><?=$tp['type'] ?></option>
                    <?php
                    endforeach;
                    ?>
                </select><br/>
                Image<br/>
                <input type="file" name="image" accept="image/*"/><br/>
            </div>
            <div>
                <input type="hidden" value="" id="transfer_fields_id" name="fields_id"/>
                <input type="submit" name="submit" value="Save"/>
            </div>
            </div>
        </form>
            <div class="w3-container">
                <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black">Additional Fields</button>
                <div id="id02" class="w3-modal">
                    <div class="w3-modal-content" style="height: 90%;">
                        <div class="w3-container">
                            <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <div style="margin: 20px;">
                                <div class="row">
                                    <div class="column" style="width: 50%;border-right: black solid 1px;">
                                        Header:
                                        <input type="text" id="header"><br><br>
                                    </div>
                                    <div class="column" style="width: 50%;">
                                        <div id="values">
                                            Values:<br>
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
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($transfers as $tf):
            ?>
                <tr ondblclick="get_transfer_data(<?=$tf['id'] ?>, document.getElementById('update_transfer'));">
                    <td><?=$tf['name'] ?></td>
                    <td><?=$tf['price'] ?></td>
                    <td><button onclick="delete_transfer(<?=$tf['id'] ?>, this.closest('tr'));">Delete</button></td>
                    <td><button onclick="document.getElementById('clone_transfer_id').value = <?=$tf['id'] ?>;document.getElementById('clone_transfer').submit();">Clone</button></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </section>
    <form method="POST" action="./utils/clone_transfer.php" id="clone_transfer" style="display: none;">
        <input type="hidden" value="" id="clone_transfer_id" name="transfer_id"/>
    </form>
    <div class="w3-container">
        <div id="update_transfer" class="w3-modal">
            <div class="w3-modal-content" style="height: auto;">
                <div class="w3-container">
                    <span onclick="document.getElementById('update_transfer').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <div style="margin: 20px;">
                        <div class="row">
                            <form action="./utils/update_transfer.php" method="post" enctype="multipart/form-data" id="update_transfer_form">
                                <div class="twothirds">
                                Name:<br/>
                                <input type="text" name="name" size="40"/><br/><br/>
                                Description:<br/>
                                <input type="text" name="description" size="40"/><br/>
                                What eo expect?<br/>
                                <textarea name="expectation" rows="15" cols="67"></textarea><br/>
                                Price:<br/>
                                <input type="text" name="price" size="40"/><br/>
                                type:<br/>
                                <select name="type">
                                <option></option>
                                <?php
                                    foreach ($types as $tp) :
                                    ?>
                                        <option value="<?=$tp['id'] ?>"><?=$tp['type'] ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select><br/>
                                Image<br/>
                                <input type="file" name="image" accept="image/*"/><br/>
                                </div>
                                <div>
                                    <input type="hidden" value="" id="transfer_id" name="transfer_id"/>
                                    <input type="submit" name="submit" value="Save"/>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


</body>