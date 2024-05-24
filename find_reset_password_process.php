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

        $con = new mysqli("localhost", "root", "", "final_project");
        
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = "UPDATE signup SET userPw=? WHERE userId=?";

        $stmt = $con->prepare($sql);
        
        if ($stmt === false) {
            die("Prepare failed: " . $con->error);
        }

        $stmt->bind_param("ss", $userPw, $userId);

        // 쿼리 실행
        if ($stmt->execute()) {
            echo "비밀번호가 성공적으로 업데이트되었습니다.";
        } else {
            echo "Error: " . $stmt->error;
        }
        ?>
        <button onclick="window.close()">확인</button>
        <?php

        // 연결 종료
        $stmt->close();
        $con->close();
    ?>
</body>
</html>
