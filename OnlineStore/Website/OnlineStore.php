<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/website.css">
    <link rel="stylesheet" href="../bootstrap/bootoff_css.css">
    <script src="https://kit.fontawesome.com/d5dfe9991d.js" crossorigin="anonymous"></script>
    <title>OnlineStroe</title>
    <style>
        * {
            max-width: 100%;
        }

        .cLi {
            height: 45px !important;
            transition: .2s ease-in-out;
            text-align: left;
            padding-right: 2px;
            background-color: white;


        }

        .cLi:hover {
            transform: scale(.98);

        }

        .cLi::before {
            content: '';
            position: absolute;
            top: 0px;
            left: -4px;
            width: 3px;
            height: 100%;
            background-color: #0d6efd;

        }

        .num {
            width: 25px;
            height: 25px;
            color: black;
            background-color: white;
            border-radius: 50%;
            border: 2px solid #0d6efd;
            font-size: 16px;
            position: relative;
            top: -28px;
            left: 83%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;


        }
    </style>
</head>

<body>

    <?php
    require_once '../DBConnect.php';




    ?>
    <ul class=" nav nav-pills nav-fill shadow-lg p-3">
        <li class="nav-item">
            <img src="../img/store.png" alt="Bootstrap" width="50" height="50">
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
            <a class="nav-link" href="../Website/OnlineStore.php?page_num=1">Home</a>
        </li>
        <li class="nav-item">
            <button class="btn btn-success p-0 ">
                <a class="nav-link text-white " href="../Login.php">Login</a>
            </button>
        </li>
    </ul>

    <div class="container d-flex align-items-center justify-content-center mt-5">
        <form class="d-flex" role="search" method="GET">
            <input class="form-control" style="width: 600px;" name='searchInput' id="live_ser" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success ms-2 rounded-circle" name="serbtn" type="submit">
                <svg class='mb-1 ' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </form>
    </div>
    <div id="searchRes" style="width: 600px; z-index:10;  position: absolute; left:407px;  padding: 0;">
    </div>




    <div id="Mcard" class="card w-25 mt-5 ms-3">


        <div class="card-body shadow">
            <h5 class="card-title text-primary fs-4">Categorys</h5>
            <p class="card-text fs-5">You Can Also Browse products From This Tabs </p>
            <div class="card-body">
                <?php

                $sql = " SELECT COUNT(store_id)  as cou FROM store;";
                $res = mysqli_query($dbconn, $sql);
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $count = $row['cou'];
                    echo "<form role='search'>";
                    echo "<button type='search' class='btn btn-primary w-100 text-white' name='all' style='width: 80px;'>All " . $count . "</button > ";
                    echo "</form>";
                } else {
                    echo "0 records found";
                }
                ?>


                <?php
                $sql  = "SELECT category.* , COUNT(store.store_id) as cou FROM category LEFT JOIN store on category.category_id = store.category_id GROUP BY category.category_id";
                $res = mysqli_query($dbconn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    echo "   <div class='list-group'>";
                    while ($row = mysqli_fetch_assoc($res)) {
                        $category_id = $row['category_id'];
                        echo "<a style='text-decoration:none;' class='' href='OnlineStore.php?Category_id=$category_id' >";
                        echo  "<li  class='cLi fs-5  rounded list-group-item  mt-2 '>
                        " . $row['cname'] . " 
                        <span  class='num'>" . $row['cou'] . "</span>
                        </li>";
                        echo "</a>";
                    }
                    echo "</div>";
                }




                ?>

            </div>
        </div>

    </div>

    <?php


    if (isset($_GET['Category_id'])) {
        $category_id = $_GET['Category_id'];


        if ($category_id  == 1) {
            $Psql = "SELECT * FROM store join category WHERE store.category_id= category.category_id AND category.cname = 'phone'";
            $phoneResult = mysqli_query($dbconn, $Psql);
            while ($phones = mysqli_fetch_assoc($phoneResult)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";

                echo "<div class='row container-md text-center mt-3 w-50 '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $phones['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                        <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $phones['storename'] . "'</a> " . $phones['storename'] . " </h4>
                             <p class='card-text'>Category: " . $phones['cname'] . " </p>
                              <p class='card-text'>Phone:" . $phones['phone'] . " </p>
                             <p class='card-text'>Address: " . $phones['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        } elseif ($category_id  == 2) {
            $Nsql = "SELECT * FROM store join category WHERE store.category_id= category.category_id AND category.cname = 'Nike'";
            $NikeResult = mysqli_query($dbconn, $Nsql);
            while ($Nike = mysqli_fetch_assoc($NikeResult)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";

                echo "<div class='row container-md text-center mt-3 w-50 '>
                <div class='col ' >
                    <div class='card '>
                        <div class=' card-body'>
                           


                             <img src='../" . $Nike['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                               <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $Nike['storename'] . "'</a> " . $Nike['storename'] . " </h4>
                             <p class='card-text'>Category: " . $Nike['cname'] . " </p>
                              <p class='card-text'>Phone:" . $Nike['phone'] . " </p>
                             <p class='card-text'>Address: " . $Nike['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        } elseif ($category_id == 4) {
            $Lsql = "SELECT * FROM store join category WHERE store.category_id= category.category_id AND category.cname = 'Laptop'";
            $LaptopResult = mysqli_query($dbconn, $Lsql);
            while ($Laptop = mysqli_fetch_assoc($LaptopResult)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";

                echo "<div class='row container-md text-center mt-3 w-50 '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $Laptop['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                              <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $Laptop['storename'] . "'</a> " . $Laptop['storename'] . " </h4>
                             <p class='card-text'>Category: " . $Laptop['cname'] . " </p>
                              <p class='card-text'>Phone:" . $Laptop['phone'] . " </p>
                             <p class='card-text'>Address: " . $Laptop['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        } elseif ($category_id == 3) {
            $Gsql = "SELECT * FROM store join category WHERE store.category_id= category.category_id AND category.cname = 'Gameing Box'";
            $GBpResult = mysqli_query($dbconn, $Gsql);
            while ($GB = mysqli_fetch_assoc($GBpResult)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";

                echo "<div class='row container-md text-center mt-3 w-50 '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $GB['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                             <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $GB['storename'] . "'</a> " . $GB['storename'] . " </h4>
                             <p class='card-text'>Category: " . $GB['cname'] . " </p>
                              <p class='card-text'>Phone:" . $GB['phone'] . " </p>
                             <p class='card-text'>Address: " . $GB['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        }
    }
    ?>
    <?php


    if (isset($_GET['page_num'])) {
        $page = $_GET['page_num'];
        if ($page == 1) {
            $sql = "SELECT * FROM store join category on store.category_id	= category.category_id LIMIT 3 OFFSET 3";
            $sql_res = mysqli_query($dbconn, $sql);
            while ($page_1 = mysqli_fetch_assoc($sql_res)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";

                echo "<div class='row container-md text-center mt-3 w-50 '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $page_1['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                               <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $page_1['storename'] . "'</a> " . $page_1['storename'] . " </h4>
                             <p class='card-text'>Category: " . $page_1['cname'] . " </p>
                              <p class='card-text'>Phone:" . $page_1['phone'] . " </p>
                             <p class='card-text'>Address: " . $page_1['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        } elseif ($page == 2) {
            $sql = "SELECT * FROM store join category on store.category_id	= category.category_id LIMIT 3 OFFSET 6";
            $sql_res = mysqli_query($dbconn, $sql);
            while ($page_2 = mysqli_fetch_assoc($sql_res)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";
                echo "<div class='row container-md text-center mt-3 w-50  '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $page_2['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                             <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $page_2['storename'] . "'</a> " . $page_2['storename'] . " </h4>
                             <p class='card-text'>Category: " . $page_2['cname'] . " </p>
                              <p class='card-text'>Phone:" . $page_2['phone'] . " </p>
                             <p class='card-text'>Address: " . $page_2['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            ";
            }
        } elseif ($page == 3) {

            $sql = "SELECT * FROM store join category on store.category_id	= category.category_id LIMIT 3 OFFSET 9";
            $sql_res = mysqli_query($dbconn, $sql);
            while ($page_3 = mysqli_fetch_assoc($sql_res)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";
                echo "<div class='row container-md text-center mt-3 w-50  '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $page_3['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                               <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $page_3['storename'] . "'</a> " . $page_3['storename'] . " </h4>
                             <p class='card-text'>Category: " . $page_3['cname'] . " </p>
                              <p class='card-text'>Phone:" . $page_3['phone'] . " </p>
                             <p class='card-text'>Address: " . $page_3['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            ";
            }
        } elseif ($page == 4) {
            $sql = "SELECT * FROM store join category on store.category_id	= category.category_id LIMIT 3 OFFSET 9";
            $sql_res = mysqli_query($dbconn, $sql);
            while ($page_4 = mysqli_fetch_assoc($sql_res)) {
                echo " <div class='d-flex align-items-center justify-content-center'>";
                echo "<div class='row container-md text-center mt-3 w-50  '>
                <div class='col ' >
                    <div class='card'>
                        <div class=' card-body'>
                           


                             <img src='../" . $page_4['img'] . "'alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> 
                              <h4 class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $page_4['storename'] . "'</a> " . $page_4['storename'] . " </h4>
                               <p class='card-text'>Category: " . $page_4['cname'] . " </p>
                              <p class='card-text'>Phone:" . $page_4['phone'] . " </p>
                             <p class='card-text'>Address: " . $page_4['addressi'] . " </p>
                            

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            
                            ";
            }
        }
    }
    ?>
    <?php
    if (isset($_REQUEST['all'])) {
        $sql = "SELECT * FROM store join category on store.category_id	= category.category_id ";
        $res = mysqli_query($dbconn, $sql);
    }
    if (mysqli_num_rows($res) > 0) {
        while ($item = mysqli_fetch_assoc($res)) {
            // $storeName  = $item[]


    ?>
            <div class="d-flex align-items-center justify-content-center">

                <div class="row w-50">
                    <div class="col">
                        <div class="card text-center mt-3">
                            <div class=" card-body">
                                <?php


                                echo " <img src='../" . $item['img'] . "' alt='img not found'  class='card-img-top'  style='width:400px;height:300px;'> ";
                                echo " <h4  class='card-title'> <a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $item['storename'] . "'</a> " . $item['storename'] . " </h4>";
                                echo " <p class='card-text'>Category: " . $item['cname'] . " </p>";
                                echo " <p class='card-text'>Phone:" . $item['phone'] . " </p>";
                                echo " <p class='card-text'>Address: " . $item['addressi'] . " </p>";
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php

        }
    }

    ?>

    <script script src="../bootstrap/bootoff_Js.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $("#live_ser").keyup(function() {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "../Website/liveSearch.php",
                        method: "POST",
                        data: {
                            input: input

                        },
                        success: function(data) {
                            $("#searchRes").html(data);
                        }

                    });
                } else {
                    $("#searchRes").css("display", "none");
                }
                if (input == "") {
                    location.reload();
                }


            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</body>

</html>
<!-- Pagination Show -->
<?php
$pageNumber = 3;
$sql = "SELECT * FROM store join category on store.category_id	= category.category_id  ";
$sql_res = mysqli_query($dbconn, $sql);
$total_record = mysqli_num_rows($sql_res);
$All_pages = ceil($total_record / $pageNumber);
echo "<div id='MP' class=''>";

echo "<ul class='  pagination mt-5 d-flex align-items-center justify-content-center'>";
for ($i = 1; $i <= $All_pages; $i++) {
    echo "<li  class=' page-item text-center' '><a class='page-link ' href='OnlineStore.php?page_num=" . $i . "'>" . $i . "</a></li>";
}
echo "</ul>";
echo "</div>";
?>

<?php
if (isset($_GET['searchInput'])) {
    echo "<script>
   document.getElementById('MP').style.display = 'none';
    document.getElementById('Mcard').style.display = 'none';
    </script>";
    if (empty($_GET['searchInput'])) {
        echo "<script>
                location.href = 'OnlineStore.php';
            </script>";
    }
    $inpvalue =   $_GET['searchInput'];
    $searchsql = "SELECT * FROM store join category on store.category_id= category.category_id  AND storename LIKE '%$inpvalue%' LIMIT 1";
    $result = mysqli_query($dbconn, $searchsql);
    if (mysqli_num_rows($result) > 0) {
        while ($value = mysqli_fetch_assoc($result)) {

?>
            <div class="container d-flex align-items-center justify-content-center ">

                <div class="card w-75 mt-5 shadow">
                    <div class="card-body text-center">

                        <img width="300" height="300" src="../<?php echo $value['img'] ?>" class="rounded float-start" alt="">
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

                <button type="submit" id="ratebtn" class="btn btn-success">RateNow</button>
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



<?php
        }
    }
}


?>

<?php
if (isset($_POST['save'])) {

    $rateindex  = $_POST['rateindex'];
    $sId  = $_POST['sId'];

    $rateindex++;
    if ($sId === 0) {
        $insert = "INSERT INTO rating (StoreRating) VALUES('$rateindex')";
        if ($dbconn->query($insert) == true) {
        }
    }
}

?>