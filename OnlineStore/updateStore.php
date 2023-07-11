<?php ob_start();
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
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php
    require_once 'mainNav.html';
    ?>
    <?php
    require_once 'DBConnect.php';
    $id = $_GET['store_id'];
    ?>
    <?php
    $sql = "SELECT * FROM `store` WHERE store_id = $id LIMIT 1";
    $result = mysqli_query($dbconn, $sql);
    $row = mysqli_fetch_assoc($result);
    $img_path = $row['img'];
    ?>
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
                echo "<div class='alert alert-danger text-center fs-3 mt-3 container'>
                            <h5>Check Your Input</h5>
                            </div>";
            } else {
                $sql = "UPDATE `store` SET `storename`='$name' ,`phone`=$phone ,`addressi`='$address' , `category_id`=$catg ,`img`='$folder' WHERE store_id=$id ";
                if ($dbconn->query($sql) == TRUE) {
                    header("Location: showStore.php?u=1");
                }
            }
        }
    }


    ?>

    <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label fs-3">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['storename'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label fs-3">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $row['addressi'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label fs-3 ">Phone</label>
            <input type="text" class="form-control " name="phone" value="<?php echo $row['phone'] ?>">
        </div>
        <div class="mb-3">
            <label class='form-label fs-3 '> Category</label>
            <select name='categ' class='form-select ms-1 w-100 '>";
                <?php
                $sqlc = "SELECT * FROM category ";
                $res = mysqli_query($dbconn, $sqlc);

                while ($rowc = mysqli_fetch_assoc($res)) {
                ?>
                    <option value="<?php echo $rowc['category_id'] ?>"><?php echo $rowc['cname'] ?> </option>

                <?php
                }
                ?>

            </select>



        </div>
        <div class="mt-3">
            <label class="form-label fs-3 ">Image</label>
            <input type="file" class="form-control " name="img" value="<?php echo $row['img'] ?>">
            <?php

            echo " <img src='$img_path' alt='img not found' width='60px'>";
            ?>
        </div>

        <div class="mt-5">
            <button type="submit" name="sub" class="btn btn-success w-25 mx-auto d-block">Update</button>
        </div>



    </form>







</body>

</html>