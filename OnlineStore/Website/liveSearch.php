<?php

require_once '../DBConnect.php';
if (isset($_POST['input'])) {

    $input = $_POST['input'];
    $sql = "SELECT * FROM store WHERE  storename LIKE  '{$input}%'";
    $res = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($res) > 0) { ?>
        <div class="container " style="margin-left: 110px;">

            <div class="container-fluid shadow">
                <?php
                while ($data = mysqli_fetch_assoc($res)) {
                    $name = $data['storename'];
                    $img = $data['img'];
                    echo "<ul class='list-group p-2'>";
                    echo "<a style='text-decoration: none;' href='../fullstoreRate.php?storename=" . $data['storename'] . "'>";
                    echo "<li class='list-group-item list-group-item-action'>" . $data['storename'] . "
                    <img class='rounded float-end' src='../" . $img . "'  width='30px' height='30px'>
                    </li>";
                    echo "<a>";
                    echo "</ul>";
                }

                ?>

            </div>
        </div>


<?php
    } else {
        echo "<h6 class='text-danger text-center mt-3 fs-3'>No Data Found</h6>";
    }
}
?>

<script>
    document.querySelector('#input')
</script>