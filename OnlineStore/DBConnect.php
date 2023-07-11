<?php
try {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname =  "onlinestoredb";
    $dbconn = mysqli_connect($server, $user, $pass, $dbname);
} catch (mysqli_sql_exception $me) {

    die($me->getMessage());
}
