<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start(); // 세션 시작

    // Create connection
    $con = new mysqli("localhost","root","","final_project");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // 가정: $userId는 로그인한 사용자의 ID
    $userId = $_SESSION['userId']; // 또는 적절한 사용자 식별 정보
    $sql = "SELECT * FROM signup WHERE userId = '$userId'"; // SQL 인젝션 방지를 위해 변수를 쿼리 문자열에 직접 넣는 것을 피하고, Prepared Statements 사용을 고려해야 합니다.
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    // 이제 $row에 사용자 정보가 들어있습니다.
    } else {
        echo "0 results";
    }
?>
    <h1>회원정보 수정</h1>
    <form action="user_update_server.php" method="post"> <!-- 수정된 부분 -->
        아이디 : <input type="text" name="userId" id="" value="<?= $row["userId"]; ?>"/> <br /> <!-- 수정된 부분 -->
        <input type="submit" value="수정하기" />
        <input type="reset" value="취소하기" />
    </form>

</body>

</html>