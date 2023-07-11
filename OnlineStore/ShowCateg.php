<?php ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Category</title>
    <link rel="stylesheet" href="bootstrap/bootoff_css.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    require_once 'DBConnect.php';
    ?>
    <?php
    require_once 'mainNav.html';
    ?>
    <h3 class="text-center"> Category page</h3>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>


<?php
echo '<table class="table w-100 mt-5 text-center text-primary container  table-hover   table-striped table-bordered" >';
$arr = array("#id", "Category Name", "Update", "Delete");
$count = count($arr);
for ($i = 0; $i < $count; $i++) {
    echo "<th>";
    echo $arr[$i];
    echo "</th>";
}
$sql  = "SELECT * FROM category";
$res = mysqli_query($dbconn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {

?>
        <tr>
            <td class='text-dark'><?php echo $row['category_id'] ?></td>
            <td class='text-dark'> <?php echo $row['cname'] ?> </td>
            <td> <button class='btn btn-success'><a style='text-decoration: none;' class='link-light' href='update.php?category_id= <?php echo $row['category_id'] ?> '>Update</a></button> </td>
            <td><a href='deleteCategory.php?category_id=<?php echo $row['category_id'] ?>' class='del'><button style='text-decoration: none;' class='btn btn-danger' type='button'>Delete</button></a></td>

        </tr> <?php



            }
        }
                ?> </table>




<script>
    if (window.location.search.includes('b=1')) {
        Swal.fire(
            'Good Job!',
            'Category updated successfully!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                document.location.href = 'ShowCateg.php';
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



    if (window.location.search.includes('b=5')) {
        Swal.fire(
            'Deleted!',
            'Your Category has been deleted.',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'ShowCateg.php';
            }
        });
    }
</script>

<script>
    if (window.location.search.includes('c=1')) {
        Swal.fire(
            'Good Job',
            'New Category Created Successfully !',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'ShowCateg.php';
            }
        });
    }
</script>