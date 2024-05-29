<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $userId = $_POST['userId'];
        $userPw = $_POST['userPw1'];
        $userEmail = $_POST['userEmail'].'@'.$_POST['emailDomain'];
        $userTel = $_POST['userTel'];
        $userGender = $_POST['userGender'];
        $userName = $_POST['userName'];
        $userBirth = sprintf('%4d-%02d-%02d', $_POST['birth_year'], $_POST['birth_month'], $_POST['birth_day']);
        $postCode = $_POST['postcode'];
        $address = $_POST['address'].' '.$_POST['detailAddress'].$_POST['extraAddress'];
        $signup_date = date('Y-m-d H:i:s');

        // 비밀번호 해싱
        $hashed_password = password_hash($userPw, PASSWORD_DEFAULT);

        include "db_con.php";
        
        //2.DB사용 - sql명령어
        $sql = "INSERT INTO signup (userId, userPw, userEmail, userTel, userGender, userName, userBirth, postcode, address, signup_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // 준비된 문(Prepared Statement) 준비
        $stmt = mysqli_prepare($con, $sql);
        
        // 변수를 준비된 문에 바인딩
        mysqli_stmt_bind_param($stmt, "sssssssss", $userId, $hashed_password, $userEmail, $userTel, $userGender, $userName, $userBirth, $postcode, $address, $signup_date);
        
       // 3. DB 해제
       mysqli_stmt_close($stmt);
       mysqli_close($con);
    ?>  
    <!-- <script>
        alert("회원가입이 완료되었습니다.")
        location.href('index.php');
    </script> -->
    <p>
        아이디 : <?=$userId?>   <br>
        비밀번호 : <?=$userPw?> <br>
        이메일 : <?=$userEmail?>    <br>
        휴대전화 : <?=$userTel?>    <br>
        성별 : <?=$userGender?>    <br>
        이름 : <?=$userName?>    <br>
        생년월일 : <?=$userBirth?>    <br>
        우편번호 : <?=$postCode?>   <br>
        주소 : <?=$address?>    <br>
        가입 날짜 : <?=$signup_date?>
    </p>
    <a href="index.php">뒤로가기</a>
</body>
</html>