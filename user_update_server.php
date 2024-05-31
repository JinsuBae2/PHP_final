<?php
    // 데이터베이스 연결
    include 'db_con.php';

    // POST 데이터 수집
    $userId = $_POST['userId']; // 세션에서 사용자 ID 가져오기
    $userEmail = $_POST['userEmail'] . '@' . $_POST['emailDomain']; // 이메일
    $userTel = $_POST['userTel']; // 휴대전화
    $userGender = $_POST['userGender']; // 성별
    $userName = $_POST['userName']; // 이름
    $userBirth = $_POST['userBirth']; // 생년월일

    // SQL 준비
    $sql = "UPDATE signup SET ";
    $params = [];
    $types = "";

    // 비밀번호가 설정된 경우
    if (isset($_POST['userPw1']) && !empty($_POST['userPw1'])) {
        $userPw = $_POST['userPw1']; // 비밀번호
        // 비밀번호 해싱
        $hashed_password = password_hash($userPw, PASSWORD_DEFAULT);
        $sql .= "userPw=?, ";
        $params[] = $hashed_password;
        $types .= "s";
    }

    $sql .= "userEmail=?, userTel=?, userGender=?, userName=?, userBirth=?,";
    $params[] = $userEmail;
    $params[] = $userTel;
    $params[] = $userGender;
    $params[] = $userName;
    $params[] = $userBirth;
    $types .= "sssss";

    // 주소가 설정된 경우
    if (isset($_POST['postcode']) && !empty($_POST['postcode']) && isset($_POST['address']) && !empty($_POST['address'])) {
        $postCode = $_POST['postcode']; // 우편번호
        $address = $_POST['address'] . ' ' . $_POST['detailAddress'] . $_POST['extraAddress']; // 주소
        $sql .= "postCode=?, address=?, ";
        $params[] = $postCode;
        $params[] = $address;
        $types .= "ss";
    }

    // 마지막 쉼표 제거
    $sql = rtrim($sql, ', ');

    $sql .= " WHERE userId=?";
    $params[] = $userId;
    $types .= "s";

    // 준비된 문(Prepared Statement) 준비
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        die("준비된 문 생성 실패: " . mysqli_error($con));
    }

    // 변수를 준비된 문에 바인딩
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // 문 실행
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('사용자 정보가 성공적으로 업데이트되었습니다.')
                location.href='index.php'
                </script>";

    } else {
        echo "사용자 정보 업데이트에 실패했습니다: " . mysqli_stmt_error($stmt);
    }

    // 문과 연결 해제
    mysqli_stmt_close($stmt);
    mysqli_close($con);
?>
