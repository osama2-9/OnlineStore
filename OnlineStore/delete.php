<?php
ob_start();
include "DBConnect.php";
$id = $_GET['store_id'];
$sql = "DELETE FROM `store` WHERE store_id = $id";
$result = mysqli_query($dbconn, $sql);
if ($result) {

    header("Location: showStore.php?d=0");
} else {
    echo "Failed: " . mysqli_error($dbconn);
}
