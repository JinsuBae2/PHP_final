<?php
session_start(); // 세션 시작

// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'final_project');

if (!$conn) {
    $error_code = mysqli_connect_errno();
    $error_message = mysqli_connect_error();
    
    echo "데이터베이스 연결 실패: ($error_code) $error_message";
    exit();
}


// POST 데이터 수집
$userId = $_SESSION['userId']; // 세션에서 사용자 ID 가져오기
$userPw = $_POST['userPw1']; // 비밀번호
$userEmail = $_POST['userEmail'] . '@' . $_POST['emailDomain']; // 이메일
$userTel = $_POST['userTel']; // 휴대전화
$userGender = $_POST['userGender']; // 성별
$userName = $_POST['userName']; // 이름
$userBirth = $_POST['userBirth']; // 생년월일
$postcode = $_POST['postcode']; // 우편번호
$address = $_POST['address']. ' ' . $_POST['detailAddress'].$_POST['extraAddress']; // 주소

// 비밀번호 해싱
$hashed_password = password_hash($userPw, PASSWORD_DEFAULT);

// SQL 준비
$sql = "UPDATE signup SET userPw=?, userEmail=?, userTel=?, userGender=?, userName=?, userBirth=?, postcode=?, address=? WHERE userId=?";

// 준비된 문(Prepared Statement) 준비
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    die("준비된 문 생성 실패: " . mysqli_error($conn));
}

// 변수를 준비된 문에 바인딩
mysqli_stmt_bind_param($stmt, "ssssssssi", $hashed_password, $userEmail, $userTel, $userGender, $userName, $userBirth, $postcode, $address, $userId);

// 쿼리 실행
if (mysqli_stmt_execute($stmt)) {
    echo "회원정보가 성공적으로 업데이트되었습니다.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// 준비된 SQL문 종료
mysqli_stmt_close($stmt);

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
