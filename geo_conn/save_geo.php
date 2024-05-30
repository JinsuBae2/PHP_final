<?php
    include "../db_con.php";

    $id = $_POST['id'];
    $x = $_POST['x'];
    $y = $_POST['y'];

    echo "id : ".$id."    =      ";
    echo "x : ".$x."     /     ";
    echo "y : ".$y;

    $sql = "UPDATE store SET x='$x', y='$y' WHERE id=$id";

    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    echo "<script>
            alert('업데이트 성공');
            location.href = '../list_store.php';
        </script>"
?>