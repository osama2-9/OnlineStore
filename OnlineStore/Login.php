<?php
require_once 'DBConnect.php';
session_start();

if (isset($_SESSION['mail'])) {
    header("Location: dashborde.php");
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['sub'])) {
            $mail = inputCheck($_POST['mail']);
            $pass = inputCheck($_POST['pass']);

            if (empty(inputCheck($mail)) && empty(inputCheck($pass))) {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error while Login:</strong>Please Cheak Your Inputs
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
            ";
            } else {
                $sql =  "SELECT * FROM users WHERE mail ='$mail'AND pass= '$pass'; ";
                $res = mysqli_query($dbconn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    $_SESSION['mail'] = $mail;
                    $_SESSION['pass'] = $pass;
                    header('Location: dashborde.php');
                }
            }
        }
    }

    ?>
    <div class="container-lg h-75 ">

        <div class='col-md-9 sscard mx-auto d-flex flex-row px-0  shadow-lg h-100'>

            <div class="img-left d-md-flex d-none"></div>

            <div class="card-body d-flex flex-column justify-content-center ">
                <h1 class="title text-center mt-4 pb-3 text-primary">Login </h1>
                <form class='col-sm-10 col-12 mx-auto ' method="post">
                    <div class='form-group '>
                        <?php



                        ?>
                        <input type="email" class="form-control" name="mail" placeholder='email'>

                    </div>

                    <div class='form-group py-3 '>
                        <input type="password" class="form-control" name="pass" placeholder='****'>
                    </div>


                    <div class=''>
                        <input type="submit" name="sub" class="btn  btn-outline-primary d-block w-100 " value='Login'>
                    </div>

                </form>

            </div>

        </div>


    </div>


    <script src="bootstrap/bootoff_Js.js"></script>
</body>

</html>

<?php
function inputCheck($data)
{
    $data1 = htmlspecialchars($data);
    $data = trim($data1);
    return $data;
}

?>