<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // 데이터베이스 연결 정보
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'final_project';

        // 데이터베이스 연결
        $con = mysqli_connect($host, $username, $password, $database); 
        // 연결 오류 확인
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
     ?>
</body>
</html>