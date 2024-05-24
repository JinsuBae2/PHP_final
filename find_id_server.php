<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $findName = $_POST['findName'];
        $findEmail = $_POST['findEmail'].'@'.$_POST['findEmailDomain'];

        $con = new mysqli('localhost','root','','final_project');

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // SQL Injection 방지를 위한 prepared statement 사용
        $stmt = $con->prepare("SELECT * FROM signup WHERE userName = ? AND userEmail = ?");
        $stmt->bind_param("ss", $findName, $findEmail);
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
            $userId = $row['userId']; // 사용자 ID를 가져옵니다. 'userId'는 해당 컬럼의 실제 이름이어야 합니다.
    ?>
            
            <script>
                alert("사용자 아이디는 <?= $userId ?>입니다.")
                history.back();
            </script>
    <?php        

        }

        $stmt->close();
        $con->close();
    ?>

</body>
</html>