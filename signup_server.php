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
        //1.DB 접속
        $con = mysqli_connect("localhost","root","","final_project");
        
        //2.DB사용 - sql명령어
        $sql = "insert into signup (userId, userPw, userEmail, userTel, userGender, userName, userBirth, postCode, address, signup_date) "; 
        $sql .= "values('$userId', '$userPw', '$userEmail', '$userTel', '$userGender', '$userName', '$userBirth', '$postCode', '$address', '$signup_date')";

        mysqli_query($con, $sql); //$sqldp 저장된 명령 실행

        //3.DB해제
        mysqli_close($con);
    ?>  
    <h1>회원가입 되셨습니다 !</h1>
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
    </p>
    <a href="index.php">뒤로가기</a>
</body>
</html>