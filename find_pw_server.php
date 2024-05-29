<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
<?php 
    $findId = $_POST['findId'];
    $findEmail = $_POST['findEmail'] . '@' . $_POST['findEmailDomain'];

    include 'db_con.php';

    // SQL Injection 방지를 위한 prepared statement 사용
    $sql = "SELECT * FROM signup WHERE userId = ? AND userEmail = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $findId, $findEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // 사용자 정보가 있는지 확인
    if (mysqli_num_rows($result) == 0) {
        // 사용자가 없으면 알림
?>
        <script>
            alert("등록된 사용자가 없습니다.")
            history.back();
        </script>
<?php
    } else {
        // 사용자가 있으면 결과 가져오기
        $row = mysqli_fetch_assoc($result);
        $userId = $row['userId'];
?>
        <script>
            alert("확인되었습니다.")
            location.href = 'find_reset_password.php?userId=<?= $findId ?>';
        </script>
<?php
    }
    // 리소스 해제 및 연결 종료
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
?>
</body>
</html>
