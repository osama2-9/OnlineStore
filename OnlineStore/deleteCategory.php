<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php

include "DBConnect.php";
$id = $_GET['category_id'];
$sql = "DELETE FROM `category` WHERE category_id = $id";
$result = mysqli_query($dbconn, $sql);
if ($result) {
    header("Location: ShowCateg.php?b=5");
    exit();
} else {
    echo "Failed: " . mysqli_error($dbconn);
}
