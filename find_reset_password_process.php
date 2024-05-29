<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            padding: 20px;
            text-align: center;
        }

        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET['userId'])){
            $userId = $_GET['userId']; 
        }

        $userPw = $_POST['newPassword1'];

        include 'db_con.php';


        $sql = "UPDATE signup SET userPw=? WHERE userId=?";

        $stmt = mysqli_prepare($con, $sql);
        
        if ($stmt === false) {
            die("준비된 SQL문 생성 실패: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ss", $userPw, $userId);

        // 쿼리 실행
        if (mysqli_stmt_execute($stmt)) {
            echo "비밀번호가 성공적으로 업데이트되었습니다.";
        } else {
            echo "Error: " . mysqli_error($con);
        }
        ?>
        <button onclick="window.close()">확인</button>
        <?php

        // 준비된 SQL문 종료
        mysqli_stmt_close($stmt);

        // 데이터베이스 연결 종료
        mysqli_close($conn);
    ?>
</body>
</html>
