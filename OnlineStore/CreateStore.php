<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateStore</title>
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <link rel="stylesheet" href="css/createstore.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>


<body>

    <div class="mainDIV">


        <?php
        require_once 'mainNav.html';
        ?>
        <?php
        require_once 'DBConnect.php';
        ?>
        <?php



        ?>
        <h3 class="">Create Store page</h3>
        <form method="post" class="container" enctype="multipart/form-data">
            <?php

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['sub'])) {

                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
                    $catg = $_POST['categ'];


                    $img_s = $_FILES['img']['name'];
                    $temp_img = $_FILES['img']['tmp_name'];
                    $folder = "img/" . $img_s;
                    move_uploaded_file($temp_img, $folder);





                    if (empty($name) || empty($address) || empty($phone) || empty($catg) || empty($img_s)) {
                        echo "<div class='alert alert-danger text-center fs-3 mt-2 ms-5 container'>
                            <h5>Check Your Input</h5>
                            </div>";
                    } else {
                        $sql = "INSERT INTO store( storename ,phone ,addressi,category_id ,img) VALUES( '$name' ,'$phone' ,'$address'  ,'$catg','$folder')";
                        if ($dbconn->query($sql) == TRUE) {

                            header("Location: showStore.php?m=1");
                            exit();
                        }
                    }
                }
            }
            ?>
            <div class="mt-5">
                <label class="form-label fs-3">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mt-5">
                <label class="form-label fs-3">Address</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div class="mt-5">
                <label class="form-label fs-3 ">Phone</label>
                <input type="text" class="form-control " name="phone">
            </div>
            <div class="mt-5">
                <?php
                echo "<label class='form-label fs-3 ' > Category</label>";
                echo " <select name='categ'class='form-select ms-1 w-100 '>";
                $sql = "SELECT * FROM  category";
                $res = mysqli_query($dbconn, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "  <option value=' " . $row['category_id'] . " '> " . $row['cname'] . "</option>";
                }
                echo "  </select>";


                ?>
            </div>
            <div class="mt-5">
                <label class="form-label fs-3 ">Image</label>
                <input type="file" class="form-control " name="img">
            </div>

            <div class="mt-5">
                <button type="submit" name="sub" class="btn btn-primary w-25 mx-auto d-block">Add</button>
            </div>



        </form>




    </div>






</body>

</html>