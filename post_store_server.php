<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $userId = $_GET['userId'];
        $store_name = $_POST['post_name'];
        $store_address = $_POST['post_address'];
        $post_contents = $_POST['post_contents'];
        $recommend_menu = $_POST['recommend_menu'];
        $rating = $_POST['rating'];
        $post_date = date('Y-m-d H:i:s');

        echo $userId, $store_name, $store_address, $post_contents, $recommend_menu, $rating;

        $conn = mysqli_connect('localhost', 'root','' , 'final_project');
        
        //2.DB사용 - sql명령어
        $sql = "INSERT INTO store (userId, store_name, store_address, post_contents, recommend_menu, rating, post_date) ";
        $sql .= "VALUES ('$userId', '$store_name', '$store_address', '$post_contents', '$recommend_menu', $rating, '$post_date')";

        mysqli_query($conn, $sql);
        
        //3.DB해제
        mysqli_close($conn);

        include "./geo_conn/convert_geo.php";
    ?>
</body>
</html>