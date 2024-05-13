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

        $con = new mysqli("localhost","root","","final_project");
    
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        //2.DB사용 - sql명령어
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = mysqli_real_escape_string($con, $_POST['userId']);
            $userPw = mysqli_real_escape_string($con, $_POST['userPw']);
        
            $sql = "SELECT userId FROM signup WHERE userId = '$userId' AND userPw = '$userPw'";
            $result = $con->query($sql);
        
            if ($result->num_rows == 1) {
                $_SESSION['userId'] = $userId;
                echo "<script>
                        window.opener.location.reload(); // 부모 창을 새로고침
                        window.close(); // 팝업 창 닫기
                    </script>";
                exit();
                // header("Location: index.php"); // 사용자를 index.php로 리디렉션
                // exit(); // 중요: 리디렉션 후에는 추가적인 코드 실행을 방지하기 위해 exit() 함수를 호출해야 함
            } else {
                echo "Invalid userId or userPw";
            }
        }
        
        //3.DB해제
        mysqli_close($con);
    ?>
</body>
</html>