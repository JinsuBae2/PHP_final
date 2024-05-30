<?php
    include "db_con.php";

    $post_Id = $_POST['post_Id'];
    $x = $_POST['x'];
    $y = $_POST['y'];

    echo "post_Id : ".$post_Id."    =      ";
    echo "x : ".$x."     /     ";
    echo "y : ".$y;

    $sql = "UPDATE store SET x='$x', y='$y' WHERE post_Id=$post_Id";

    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    echo "<script>
            alert('업데이트 성공');
            location.href = 'store_list.php';
        </script>"
?>