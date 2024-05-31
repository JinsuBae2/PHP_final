<?php
include "db_con.php";

$post_Id = mysqli_real_escape_string($con, $_POST['post_Id']);
$x = mysqli_real_escape_string($con, $_POST['x']);
$y = mysqli_real_escape_string($con, $_POST['y']);

echo "post_Id : " . $post_Id . "    =      ";
echo "x : " . $x . "     /     ";
echo "y : " . $y;

$sql = "UPDATE store SET x='$x', y='$y' WHERE post_Id=$post_Id";

$result = mysqli_query($con, $sql);

if ($result) {
    echo "<script>
            alert('업데이트 성공');
            location.href = 'store_list.php';
          </script>";
} else {
    echo "<script>
            alert('업데이트 실패: " . mysqli_error($con) . "');
            location.href = 'store_list.php';
          </script>";
}

mysqli_close($con);
?>
