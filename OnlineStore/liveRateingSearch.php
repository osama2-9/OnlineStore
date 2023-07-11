<?php
require_once 'DBConnect.php';
if (isset($_POST['input'])) {

    $input = $_POST['input'];
    $sql = "SELECT * FROM store WHERE storename LIKE  '{$input}%'";
    $res = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($res) > 0) { ?>
        <div class="container " style="margin-left: 95px;">


            <div class="container-fluid shadow p-3">
                <ol class="list-group list-group-flush">
                    <?php

                    while ($data = mysqli_fetch_assoc($res)) {
                        $name = $data['storename'];
                        echo "<a style='text-decoration:none;' class='list-item-group text-dark ms-3' >
                        
                    
                        <li class='text-dark ms-1'>" . $data['storename']  . "  <img class='rounded float-end' src='" . $data['img'] . "' width='60px' height='60px'>  </li>

                    
                    </a>" . "<hr>";
                    }

                    ?>
                </ol>
            </div>
        </div>


<?php
    } else {
        echo "<h6 class='text-danger text-center mt-3 fs-3'>No Data Found</h6>";
    }
}
