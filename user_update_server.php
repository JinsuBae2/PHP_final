<?php
session_start(); // 세션 시작

// 데이터베이스 연결 설정
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'final_project';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
$sql = "UPDATE signup SET userPw=?, userEmail=?, userTel=?, userGender=?, userName=?, userBirth=?, postcode=?, address=?, WHERE userId=?";

// 준비된 문(Prepared Statement) 준비
$stmt = $conn->prepare($sql);

// 변수를 준비된 문에 바인딩
$stmt->bind_param("sssssssssss", $hashed_password, $userEmail, $userTel, $userGender, $userName, $userBirth, $postcode, $address, $userId);

// 쿼리 실행
if ($stmt->execute()) {
    echo "회원정보가 성공적으로 업데이트되었습니다.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$stmt->close();
$conn->close();
?>
