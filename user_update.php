<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'nav_bar.php'; ?>

<?php

    session_start(); // 세션 시작

    // Create connection
    $con = new mysqli("localhost","root","","final_project");

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // 가정: $userId는 로그인한 사용자의 ID
    $userId = $_SESSION['userId']; // 또는 적절한 사용자 식별 정보
    $sql = "SELECT * FROM signup WHERE userId = '$userId'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // 이메일 주소 분리
        list($userEmail, $emailDomain) = explode('@', $row["userEmail"]);
    } else {
        echo "0 results";
    }
?>
    <h1>회원정보 수정</h1>
    <form action="user_update_server.php" method="post">
        아이디 : <input type="text" name="userId" id="" value="<?= $row["userId"]; ?>" readonly /> <br /> 
        비밀번호 : <input type="password" name="userPw1" id="" />
        비밀번호확인 : <input type="password" name="userPw2" id="" />
        이메일 : <input type="text" id="userEmail" name="userEmail" value="<?= $userEmail; ?>" /> @
        <select name="emailDomain" id="emailDomain">
            <option value="직접 입력">직접 입력</option>
            <option value="gmail.com" <?= $emailDomain == 'gmail.com' ? 'selected' : ''; ?>>gmail.com</option>
            <option value="naver.com" <?= $emailDomain == 'naver.com' ? 'selected' : ''; ?>>naver.com</option>
            <option value="daum.net" <?= $emailDomain == 'daum.net' ? 'selected' : ''; ?>>daum.net</option>
            <option value="nate.com" <?= $emailDomain == 'nate.com' ? 'selected' : ''; ?>>nate.com</option>
            <option value="hotmail.com" <?= $emailDomain == 'hotmail.com' ? 'selected' : ''; ?>>hotmail.com</option>
        </select> <br>
        휴대전화 :
        <input
            type="text"
            name="userTel"
            id="userTel"
            value="<?= $row["userTel"]?>"
            pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"
            title="휴대폰 번호 형식: 010-1234-5678"
            required
        /> <br>
        성별 :
        <select name="userGender" id="userGender">
            <option value="" <?= $row['userGender'] == '' ? 'selected' : ''; ?>>성별</option>
            <option value="남" <?= $row['userGender'] == '남' ? 'selected' : ''; ?>>남</option>
            <option value="여" <?= $row['userGender'] == '여' ? 'selected' : ''; ?>>여</option>
        </select>
        <br />
        이름 : <input type="text" name="userName" id="" value="<?= $row["userName"]; ?>"/> <br />
        생년월일 :
        <input
            type="date"
            name="userBirth"
            value="<?= $row["userBirth"] ?>"
        /> <br>
        <input
            type="text"
            name="postcode"
            id="postcode"
            placeholder="우편번호"
        />
        <input
            type="button"
            onclick="execDaumPostcode()"
            value="우편번호 찾기"
        /><br />
        <input
            type="text"
            name="address"
            id="address"
            placeholder="주소"
        /><br />
        <input
            type="text"
            name="detailAddress"
            id="detailAddress"
            placeholder="상세주소"
        />
        <input
            type="text"
            name="extraAddress"
            id="extraAddress"
            placeholder="참고항목"
        />
        <br />
        <input type="submit" value="수정하기" />
        <input type="reset" value="취소하기" />
    </form>   
    <!-- 다음 주소검색 API -->
    <script src="http://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
    function execDaumPostcode() {
        new daum.Postcode({
        oncomplete: function (data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ""; // 주소 변수
            var extraAddr = ""; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === "R") {
            // 사용자가 도로명 주소를 선택했을 경우
            addr = data.roadAddress;
            } else {
            // 사용자가 지번 주소를 선택했을 경우(J)
            addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if (data.userSelectedType === "R") {
            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
            if (data.bname !== "" && /[동|로|가]$/g.test(data.bname)) {
                extraAddr += data.bname;
            }
            // 건물명이 있고, 공동주택일 경우 추가한다.
            if (data.buildingName !== "" && data.apartment === "Y") {
                extraAddr +=
                extraAddr !== ""
                    ? ", " + data.buildingName
                    : data.buildingName;
            }
            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
            if (extraAddr !== "") {
                extraAddr = " (" + extraAddr + ")";
            }
            // 조합된 참고항목을 해당 필드에 넣는다.
            document.getElementById("extraAddress").value = extraAddr;
            } else {
            document.getElementById("extraAddress").value = "";
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById("postcode").value = data.zonecode;
            document.getElementById("address").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("detailAddress").focus();
        },
        }).open();
    }
    </script>
</body>
</html>