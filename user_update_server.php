<?php
        session_start();
        if (!isset($_SESSION['userID'])) {
            header('Location: login.php'); // 로그인하지 않은 사용자는 로그인 페이지로 리다이렉트
            exit();
        }

        // 데이터베이스 연결
        $con = new mysqli("localhost","root","","final_project");

        // 연결 에러 확인
        if ($con->connect_error) {
            die("연결 실패: " . $con->connect_error);
        }

        // POST로부터 데이터 받기
        $username = $con->real_escape_string($_POST['username']);
        $email = $con->real_escape_string($_POST['email']);
        $userID = $_SESSION['userID']; // 세션에서 사용자 ID 가져오기

        // 데이터베이스 업데이트 쿼리
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id='$userID'";

        if ($con->query($sql) === TRUE) {
            echo "회원정보가 성공적으로 업데이트되었습니다.";
        } else {
            echo "오류: " . $sql . "<br>" . $con->error;
        }

        $con->close();
    ?>