<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // 데이터베이스 연결 설정
    $conn = new mysqli("localhost", "root", "", "final_project");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_GET['userId'];

    $sql = "SELECT * FROM signup WHERE userId='$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 토큰이 유효한 경우 비밀번호 재설정 폼 표시
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>비밀번호 재설정</title>
        </head>
        <body>
            <form action="find_reset_password_process.php" method="post">
                <input type="password" id="newPassword" name="newPassword" required placeholder="비밀번호 입력">
                <input type="password" id="newPassword" name="newPassword" required placeholder="비밀번호 확인">
                <button type="submit">비밀번호 재설정</button>
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "유효하지 않은 아이디입니다.";
    }

    $conn->close();
?>
</body>
</html>