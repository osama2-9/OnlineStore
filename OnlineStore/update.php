<?php ob_start();
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


    <?php
    include "DBConnect.php";
    $id = $_GET['category_id'];
    $sql = "SELECT * FROM `category` WHERE category_id = $id LIMIT 1";
    $result = mysqli_query($dbconn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <?php
    if (isset($_POST['sub'])) {
        $newCategName = $_POST['catgname'];
        if ((empty($newCategName))) {
            echo "<div class='alert alert-danger text-center fs-3 mt-3  container '>
                    <p>Please Fill The Input</p>
                    </div>";
        } else {
            $sql = "UPDATE `category` SET cname = '$newCategName'  WHERE category_id =$id";
            $result = mysqli_query($dbconn, $sql);
            if ($result) {
                header("Location: ShowCateg.php?b=1");
                exit();
            }

            // echo "<div class='alert alert-success text-center fs-3 mt-3 container'>
            //     <p> Category Updated Successfully</p>
            //     </div>";
        }
        $dbconn->close();
    }
    ?>
    <form action="" method="post" class="container-lg ">
        <div class="mt-3 ms-1">

            <label for="" class="form-lable fs-3">Category Name:</label>
            <input type="text" name="catgname" class="form-control w-50  mt-2" value="<?php echo $row['cname'] ?>">

        </div>
        <div class="row mt-3">
            <input type="submit" class="btn btn-success ms-3   " value="Update" name="sub">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

    </script>

</body>

</html>