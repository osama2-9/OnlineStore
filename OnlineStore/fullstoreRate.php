<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate</title>
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <script src="https://kit.fontawesome.com/d5dfe9991d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <?php
    require_once 'DBConnect.php';




    ?>
    <ul class=" nav nav-pills nav-fill shadow-lg p-3">
        <li class="nav-item">
            <img src="img/store.png" alt="Bootstrap" width="50" height="50">
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Category</a>
            <ul class="dropdown-menu">
                <?php
                $sql = "SELECT * FROM category";
                $data = mysqli_query($dbconn, $sql);
                if (mysqli_num_rows($data) > 0) {
                    while ($category = mysqli_fetch_assoc($data)) {
                ?>
                        <li class="dropdown-item">
                            <?php
                            echo $category['cname'];
                            ?>
                        </li>
                <?php
                    }
                }
                ?>






            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Website/OnlineStore.php?page_num=1">Home</a>
        </li>
        <li class="nav-item">
            <button class="btn btn-success p-0 ">
                <a class="nav-link text-white " href="Login.php">Login</a>
            </button>
        </li>
    </ul>
    <?php

    $name = $_GET['storename'];
    $searchsql = "SELECT * FROM store join category on store.category_id = category.category_id AND storename LIKE '%$name%' LIMIT 1";
    $result = mysqli_query($dbconn, $searchsql);
    if (mysqli_num_rows($result) > 0) {
        while ($value = mysqli_fetch_assoc($result)) {

    ?>
            <div class="container d-flex align-items-center justify-content-center">

                <div class="card w-75 mt-5 shadow">
                    <div class="card-body text-center">

                        <img width="300" height="300" src="<?php echo $value['img'] ?>" class="rounded float-start" alt="">
                        <h4 class="card-title mt-3"> <?php echo $value['storename'] ?></h4>
                        <p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                            </svg>
                            Category: <?php echo $value['cname'] ?>
                        </p>
                        <p class="card-text">Phone: <?php echo $value['phone'] ?></p>
                        <p class="card-text">Address: <?php echo $value['addressi'] ?></p>
                        <p class="card-text">Rateing: 10</p>
                    </div>
                </div>
            </div>

    <?php
        }
    }
    ?>
    <div class="container mt-5 text-center ">
        <h5>What Would You Rate This Store ?</h5>
        <hr>
        <i class="fa fa-star fa-2x" data-index="0"></i>
        <i class="fa fa-star fa-2x" data-index="1"></i>
        <i class="fa fa-star fa-2x" data-index="2"></i>
        <i class="fa fa-star fa-2x" data-index="3"></i>
        <i class="fa fa-star fa-2x" data-index="4"></i>
        <br>
        <br>

        <button type="submit" class="btn btn-success">RateNow</button>
    </div>
    </div>
    <script>
        var rateindex = -1;
        var sId = 0;
        $(document).ready(function() {

            if (localStorage.getItem('rateindex') != null) {
                setStar(parseInt(localStorage.getItem('rateindex')));
            }

            $('.fa-star').on("click", function() {
                rateindex = parseInt($(this).data("index"));
                localStorage.setItem('rateindex', rateindex);

            });



            $('.fa-star').mouseover(function() {

                var curr = parseInt($(this).data('index'));
                setStar(curr);





            });
            $('.fa-star').mouseleave(function() {
                bcolor();
                if (rateindex != -1) {
                    setStar(rateindex);


                }



            });

            function saveRateing() {
                $.ajax({
                    url: "OnlineStore.php",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        save: 1,
                        sId: sId,
                        rateindex: rateindex

                    },
                    success: function(r) {
                        sId = r.sId;


                    }

                });

            }

            function bcolor() {
                $('.fa-star').css("color", "black");
            }

            function setStar(max) {
                for (var i = 0; i <= max; i++) {

                    $('.fa-star:eq(' + i + ')').css("color", "yellow");

                }

            }

        });
    </script>


</body>

</html>