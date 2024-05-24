<?php
session_start();

// 데이터베이스 연결 설정
$con = new mysqli("localhost", "root", "", "final_project");

// 연결 확인
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// 세션에서 사용자 ID 가져오기
$userId = $_SESSION['userId'];

// 사용자 정보 삭제 쿼리
$sql = "DELETE FROM signup WHERE userId = '$userId'";

if ($con->query($sql) === TRUE) {
    // 세션 파기 (로그아웃 처리)
    session_destroy();
    echo "<script>alert('회원탈퇴가 완료되었습니다.'); location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>