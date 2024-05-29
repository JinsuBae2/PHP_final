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

        $con = mysqli_connect("localhost","root","","final_project");
    
        //2.DB사용 - sql명령어
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userId = mysqli_real_escape_string($con, $_POST['userId']);
            $userPw = mysqli_real_escape_string($con, $_POST['userPw']);
        
            $sql = "SELECT userId FROM signup WHERE userId = '$userId' AND userPw = '$userPw'";
            $result = mysqli_query($con, $sql);
        
            $row = mysqli_fetch_array($result);
            $num_rows = mysqli_num_rows($result);
            
            if ($num_rows == 1) {
                $_SESSION['userId'] = $userId;
                echo "<script>
                        window.opener.location.reload(); // 부모 창을 새로고침
                        window.close(); // 팝업 창 닫기
                    </script>";
                exit();
            } else {
                echo "<script>
                        alert('아이디와 비밀번호를 다시 입력하세요');
                        history.back()    
                    </script>";
            }
        }
        
        //3.DB해제
        mysqli_close($con);
    ?>
</body>
</html>