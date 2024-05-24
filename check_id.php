<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }
        li.success {
            background-color: #d4edda;
            color: #155724;
        }
        li.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        button {
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
<?php
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // 데이터베이스 연결
    $con = new mysqli("localhost", "root", "", "final_project");

    // 연결 확인
    if ($con->connect_error) {
        die("Database connection failed: " . $con->connect_error);
    }

    // SQL 인젝션 방지
    $userId = $con->real_escape_string($userId);

    $sql = "SELECT userId FROM signup WHERE userId='$userId'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul><li class='error'>이미 사용중인 아이디입니다</li></ul>";
    } else {
        echo "<ul><li class='success'>사용 가능한 아이디 입니다.</li></ul>";
    }
        ?>
        <button onclick="window.close()">확인</button>
        <?php
    $con->close();
} else {
    echo "<script>alert('userId 파라미터가 필요합니다.')</script>";
}
?>
</div>
</body>
</html>
