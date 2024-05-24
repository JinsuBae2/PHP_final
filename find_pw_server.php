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
        $findEmail = $_POST['findEmail'].'@'.$_POST['findEmailDomain'];

        $con = new mysqli('localhost','root','','final_project');

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // SQL Injection 방지를 위한 prepared statement 사용
        $stmt = $con->prepare("SELECT * FROM signup WHERE userId = ? AND userEmail = ?");
        $stmt->bind_param("ss", $findId, $findEmail);
        $stmt->execute();
        $result = $stmt->get_result();

         // 사용자 정보가 있는지 확인
         if ($result->num_rows == 0) {
            // 사용자가 없으면 알림
    ?>
            <script>
                alert("등록된 사용자가 없습니다.")
                history.back();
            </script>
    <?php
        } else {
            // 사용자가 있으면 결과 가져오기
            $row = $result->fetch_assoc();
            $userId = $row['userId'];
            
    ?>
            <script>
                alert("확인되었습니다.")
                location.href = 'find_reset_password.php?userId=<?=$findId?>';
            </script>
        
    <?php
        }
        $stmt->close();
        $con->close();
    ?>

</body>
</html>