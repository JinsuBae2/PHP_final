<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    include "db_conn.php";

    $id = $_POST['id'];
    $x = $_POST['x'];
    $y = $_POST['y'];

    echo "id : ".$id."    =      ";
    echo "x : ".$x."     /     ";
    echo "y : ".$y;

    $sql = "UPDATE store SET x=$x, y=$y WHERE id=$id";

    $result = mysqli_query($connect, $sql);

    mysqli_close($connect);
?>
</body>
</html>