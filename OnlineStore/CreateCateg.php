<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreateCategory</title>
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <link rel="stylesheet" href="css/createCategory.css">
</head>

<body>
    <?php
    include 'mainNav.html';

    ?>
    <h3>Create Category page</h3>

    <?php
    require_once 'DBConnect.php';
    if (isset($_POST['sub'])) {
        $cname = $_POST['catgname'];
        if (empty($cname)) {
            echo "<div class='alert alert-danger text-center fs-3 mt-3  container '>
                <p>Please Fill The Input</p>
                </div>";
        } else {
            $sql = "INSERT INTO category (cname) VALUE('$cname') ";
            $res = mysqli_query($dbconn, $sql);
            if ($res) {
                header("Location: ShowCateg.php?c=1");
                exit();
            }
        }
    }
    ?>

    <form action="" method="post" class="container-lg  mt-5">
        <div class="mt-3 ms-1">

            <label for="" class="form-lable fs-3">Category Name:</label>
            <input type="text" name="catgname" class="form-control w-50  mt-2">

        </div>
        <div class="row mt-3">
            <input type="submit" class="btn btn-primary ms-3   " value="Create Category" name="sub">
        </div>
    </form>

</body>

</html>