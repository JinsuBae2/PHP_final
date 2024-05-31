<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        $con = mysqli_connect("localhost", "root", "", "final_project");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = mysqli_real_escape_string($con, $_POST['userId']);
            $userPw = $_POST['userPw']; // 비밀번호는 해싱하지 않고 원본을 사용

            $sql = "SELECT userPw FROM signup WHERE userId = ?";

            // 준비된 sql문(Prepared Statement) 준비
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "s", $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $hashed_password_from_db);
            mysqli_stmt_fetch($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1 && password_verify($userPw, $hashed_password_from_db)) {
                $_SESSION['userId'] = $userId;
                echo "<script>
                        window.opener.location.reload(); // 부모 창을 새로고침
                        window.close(); // 팝업 창 닫기
                    </script>";
                exit();
            } else {
                echo "<script>
                        alert('아이디와 비밀번호를 다시 입력하세요');
                        history.back();
                    </script>";
            }

            // 준비된 문 닫기
            mysqli_stmt_close($stmt);
        }

        // DB 연결 해제
        mysqli_close($con);
    ?>
</body>
</html>
