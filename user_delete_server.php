<?php
session_start();

include "db_con.php";

// 세션에서 사용자 ID 가져오기
$userId = $_SESSION['userId'];

// 사용자 정보 삭제 쿼리
$sql = "DELETE FROM signup WHERE userId = ?";

// 준비된 문(Prepared Statement) 준비
$stmt = mysqli_prepare($con, $sql);

// 변수를 준비된 문에 바인딩
mysqli_stmt_bind_param($stmt, "s", $userId);

// 쿼리 실행
if (mysqli_stmt_execute($stmt)) {
    // 세션 파기 (로그아웃 처리)
    session_destroy();
    echo "<script>alert('회원탈퇴가 완료되었습니다.'); location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// 준비된 문과 DB 연결 해제
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
