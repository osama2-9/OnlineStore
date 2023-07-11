<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: Login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashbord.css">
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <title>DashBord</title>

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php

    require_once 'DBConnect.php';
    include 'mainNav.html';


    ?>
    <div class="mainDIV mt-4">
        <div class="content">
            <div class="row ">
                <div class="col-sm-6">
                    <div class="bg-primary text-white card shadow rounded">
                        <div class="card-body text-center ">
                            <h5 class="card-title">Category</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                            </svg>
                            <?php
                            $sql = " SELECT COUNT(category_id)  as cou FROM category;";
                            $res = mysqli_query($dbconn, $sql);
                            if ($res->num_rows > 0) {
                                $row = $res->fetch_assoc();
                                $count = $row['cou'];
                                echo "Number of records in column: " . $count;
                            } else {
                                echo "0 records found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="bg-white text-dark card shadow  border border-2 border-primary">
                        <div class="card-body  text-center">
                            <h5 class="card-title">Store</h5>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                            </svg>

                            <?php
                            $sql = " SELECT COUNT(store_id)  as cou FROM store;";
                            $res = mysqli_query($dbconn, $sql);
                            if ($res->num_rows > 0) {
                                $row = $res->fetch_assoc();
                                $count = $row['cou'];
                                echo "Number of records in column: " . $count;
                            } else {
                                echo "0 records found";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="srt">
                <h2 class="">Store Rateing Trend</h2>

                <?php
                $sql = "SELECT cname FROM category";
                $res = mysqli_query($dbconn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        echo ("<div class='row '>
                <div class='col-sm-10'>
                <div class='card border-1 text-primary border-gray w-25 text-center p-2  m-2 '>
                <h5 class='card-title' > " . $row['cname'] . "  
                
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height=' 16' fill='currentColor' class='bi bi-arrow-down-up' viewBox='0 0 16 16'>
  <path fill-rule='evenodd' d='M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z'/>
</svg>
                </h5>
                </div>
                </div>
                </div>");
                    }
                }



                ?>
            </div>




        </div>



</body>

</html>