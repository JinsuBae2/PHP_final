<?php 
        $findName = $_POST['findName'];
        $findEmail = $_POST['findEmail'].'@'.$_POST['findEmailDomain'];

        include 'db_con.php';

        // SQL Injection 방지를 위한 prepared statement 사용
        $sql = "SELECT * FROM signup WHERE userName = ? AND userEmail = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $findName, $findEmail);
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
                alert("사용자 아이디는 <?= $userId ?>입니다.")
                history.go(-2);
            </script>
    <?php        
        }

        // 리소스 해제 및 연결 종료
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    ?>