<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #444;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        passwordCheck = () => {
            if (document.getElementById('newPassword1').value != document.getElementById('newPassword2').value) {
                alert('비밀번호를 다시 입력하세요');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<?php
    // 데이터베이스 연결 설정
    include 'db_con.php';

    $userId = $_GET['userId'];

    $sql = "SELECT * FROM signup WHERE userId='$userId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>

        <form action="find_reset_password_server.php?userId=<?=$userId?>" method="post">
            <input type="password" id="newPassword1" name="newPassword1" required placeholder="새로운 비밀번호 입력">
            <input type="password" id="newPassword2" name="newPassword2" required placeholder="새로운 비밀번호 확인">
            <button type="submit" onclick=passwordCheck()>비밀번호 재설정</button>
        </form>

        <?php
    } else {
        echo "유효하지 않은 아이디입니다.";
    }

    mysqli_close($con);
?>
</body>
</html>