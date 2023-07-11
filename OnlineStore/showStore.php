<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Store</title>
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


</head>


<body>

    <?php
    include 'mainNav.html';
    ?>
    <h3 class="text-center"> Store page</h3>

    <br><br>
    <div class="container ">
        <button class="btn btn-primary "><a class='link-light' style="text-decoration: none;" href="CreateStore.php">Add New Item</a> </button>
    </div>
    <?php
    $arr = array('#Id', 'img', 'Name', 'Phone', 'Address', 'Category', "Update", "Delete");
    require_once 'DBConnect.php';
    $ele = count($arr);
    echo '<table class="table table-striped table-bordered w-100 mt-5 text-center text-primary table-light table-hover container-md  " >';
    for ($i = 0; $i < $ele; $i++) {
        echo "<th>";
        echo $arr[$i];
        echo "</th>";
    }

    $sql = "SELECT * FROM store join category  on store.category_id	= category.category_id  ";

    $res = mysqli_query($dbconn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $img_path = $row['img'];
            echo "<tr>
            <td class='text-dark'>" . $row["store_id"] . "</td>
            <td class='text-dark'><img  src='$img_path' width='60px' heigth='60px' ></td>
            <td class='text-dark'>" . $row["storename"] . "</td>
            <td class='text-dark'>" . $row["phone"] .  "</td>
            <td class='text-dark'>" . $row["addressi"] .  "</td>
            <td class='text-dark'>" . $row["cname"] .  "</td>
            <td>  <button class='btn btn-success'><a style='text-decoration: none;' class='link-light' href='updateStore.php?store_id= " . $row['store_id'] . "' >Update</a></button>  </td>
             <td><button class='btn btn-danger' >   <a style='text-decoration: none;' class=' del link-light' href='delete.php?store_id= " . $row['store_id'] . "' >Delete</a>  </button></td>
             
            
            
            
            </tr>";
        }
    }
    echo '</table>';

    ?>



    <script>
        if (window.location.search.includes('m=1')) {
            Swal.fire(
                'Good Job!',
                'New Store Addedd Successfully!',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'ShowStore.php';
                }
            });
        }
    </script>

    <script>
        if (window.location.search.includes('u=1')) {
            Swal.fire(
                'Good Job!',
                'Store Updated Successfully!',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'ShowStore.php';
                }
            });
        }
    </script>
    <script>
        $('.del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        })



        if (window.location.search.includes('d=0')) {
            Swal.fire(
                'Deleted!',
                'Your Category has been deleted.',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'showStore.php';
                }
            });
        }
    </script>
</body>

</html>