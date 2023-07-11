<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Rateing</title>
</head>

<body>
    <?php
    require_once 'mainNav.html';
    ?>
    <?php

    require_once 'DBConnect.php';
    ?>
    <h3>Store Rateing</h3>
    <div class="container mt-5 ">
        <form class="d-flex" role="search" method="get">
            <input class="form-control w-100" name='ser' id="live_ser" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success ms-2" name="Rsearch" type="submit">Search</button>
        </form>
    </div>
    <div id="searchRes" class="w-100" style="width: 672px; margin-left: 80px; padding: 0;">
    </div>
    <div class="container-md mt-5">


        <table id="t1" class="table text-center table-striped table-bordered ">
            <?php
            $arr = array('#Id', 'Img', 'Store name', 'Total rating', 'Number Of Rating', 'Store Rating');

            for ($i = 0; $i < count($arr); $i++) {
                echo "<th class=''>
            
            " . $arr[$i] . " 
            </th>";
            }
            ?>
            <?php
            if (isset($_GET['page_num'])) {
                $pagenum = $_GET['page_num'];
                if ($pagenum == 1) {
                    $tsql = "SELECT * FROM store join category WHERE store.category_id = category.category_id LIMIT 5";
                    $tresult = mysqli_query($dbconn, $tsql);
                    if (mysqli_num_rows($tresult) > 0) {
                        while ($tdata  = mysqli_fetch_assoc($tresult)) {

            ?>

                            <tr>
                                <td><?php echo $tdata['store_id'] ?></td>
                                <td><img src="<?php echo $tdata['img'] ?>" alt="" width="60px" height="60px"></td>
                                <td><?php echo $tdata['storename'] ?></td>
                                <td><?php echo $tdata['store_id'] ?></td>
                                <td><?php echo $tdata['store_id'] ?></td>
                                <td><?php echo $tdata['store_id'] ?></td>

                            </tr>

            <?php
                        }
                    }
                } elseif ($pagenum == 2) {
                    $tsql2 = "SELECT * FROM store join category WHERE store.category_id = category.category_id LIMIT 5 OFFSET 5";
                    $tresult2 = mysqli_query($dbconn, $tsql2);
                    if (mysqli_num_rows($tresult2) > 0) {
                        while ($tdata2  = mysqli_fetch_assoc($tresult2)) {
                            echo "<tr >";
                            echo "  <td> " . $tdata2['store_id'] . "  </td>";
                            echo "    <td><img src='" . $tdata2['img'] . "' width='60px' height='60px'></td>";
                            echo "    <td> " . $tdata2['storename'] . " </td>";
                            echo "    <td> " . $tdata2['store_id'] . " </td>";
                            echo "    <td> " . $tdata2['store_id'] . " </td>";
                            echo "    <td> " . $tdata2['store_id'] . " </td>";




                            echo "</tr >";
                        }
                    }
                } elseif ($pagenum == 3) {
                    $tsql3 = "SELECT * FROM store join category WHERE store.category_id = category.category_id LIMIT 5 OFFSET 10";
                    $tresult3 = mysqli_query($dbconn, $tsql3);
                    if (mysqli_num_rows($tresult3) > 0) {
                        while ($tdata3  = mysqli_fetch_assoc($tresult3)) {
                            echo "<tr >";
                            echo "  <td> " . $tdata3['store_id'] . "  </td>";
                            echo "    <td><img src='" . $tdata3['img'] . "' width='60px' height='60px'></td>";
                            echo "    <td> " . $tdata3['storename'] . " </td>";
                            echo "    <td> " . $tdata3['store_id'] . " </td>";
                            echo "    <td> " . $tdata3['store_id'] . " </td>";
                            echo "    <td> " . $tdata3['store_id'] . " </td>";




                            echo "</tr >";
                        }
                    }
                }
            }
            ?>





        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $("#live_ser").keyup(function() {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "liveRateingSearch.php",
                        method: "POST",
                        data: {
                            input: input

                        },
                        // after success data will show in searchRes
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

</body>


</html>
<?php

if (isset($_GET['Rsearch'])) {
    echo "  <script>
  document.querySelector('#t1').style.display='none';
  </script>";
    $value = "%" . $_GET['ser'] . "%";
    $searchSql = "SELECT * FROM store join category on store.category_id	= category.category_id  AND storename LIKE '$value'";
    $searchRes =  mysqli_query($dbconn, $searchSql);
    $arra = array('#Id', 'Img', 'Store name', 'Total rating', 'Number Of Rating', 'Store Rating');
    echo "<table class='table container text-center table-striped table-bordered >";
    for ($i = -1; $i < count($arra); $i++) {
        echo "<th class=''>

            " . $arr[$i] . " 
            </th>";
    }
    while ($res = mysqli_fetch_assoc($searchRes)) {
        echo "<tr >";
        echo "  <td> " . $res['store_id'] . "  </td>";
        echo "    <td><img src='" . $res['img'] . "' width='60px' height='60px'></td>";
        echo "    <td> " . $res['storename'] . " </td>";
        echo "    <td> " . $res['store_id'] . " </td>";
        echo "    <td> " . $res['store_id'] . " </td>";
        echo "    <td> " . $res['store_id'] . " </td>";




        echo "</tr >";
    }
    echo "</table>";
}




?>
<?php
$pageNumber = 3;
$sql = "SELECT * FROM store join category on store.category_id	= category.category_id  ";
$sql_res = mysqli_query($dbconn, $sql);
$total_record = mysqli_num_rows($sql_res);
$All_pages = ceil($total_record / $pageNumber);
echo "<div class=''>";

echo "<ul class='pagination mt-5 d-flex align-items-center justify-content-center'>";
for ($i = 1; $i <= $All_pages; $i++) {

    echo "<li class='page-item '><a  class='page-link ' href='Rating.php?page_num=" . $i . "'>" . $i . "</a></li>";
}
echo "</ul>";
echo "</div>";
?>