<?php

// require_once(__DIR__ . "/functions/db.php");
// require_once(__DIR__ . "/functions/functions.php");

session_start();

if (isset($_SESSION['userid']) && isset($_SESSION['username'])) header('Location: ./admin.php');

?>

<html>
    <head>
        <title></title>
        
        <script src='./js/jquery-3.4.1.min.js'></script>
        <script src='./js/encrypt.js'></script>
        <script src='./js/login.js'></script>
        
    </head>
    <body>
        <form name="login">
            Username<input type="text" name="username"/>
            Password<input type="password" name="password"/>
            <input type="button" onclick="LoginCheck(this.form)" value="Login"/>
        </form>

    </body>
</html>