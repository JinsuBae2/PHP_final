<?php 
    include 'header.php';
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            h1 {
                color: #343a40;
                text-align: center;
                margin-bottom: 20px;
            }
            form {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                max-width: 500px;
                margin: auto;
            }
            input[type=text], input[type=password], input[type=date], select {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            /* 우편번호 찾기 버튼 스타일링 */
            form input[type="button"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            form input[type="button"]:hover {
                background-color: #45a049;
            }

            /* 가입하기, 취소하기 및 회원탈퇴 버튼 스타일링 */
            form input[type="submit"],
            form input[type="reset"],
            form input[type="button"] {
                width: auto;
                background-color: #008CBA;
                color: white;
                padding: 10px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            form input[type="submit"]:hover,
            form input[type="reset"]:hover,
            form input[type="button"]:hover {
                background-color: #007B9E;
            }

            .button-group {
                display: flex;
                justify-content: flex-end;
                gap: 10px; /* 버튼 사이의 간격을 조절 */
            }

            #delete {
                background-color: red;
            }

            #delete:hover {
                background-color: darkred;
            }

            .form-group {
                margin-bottom: 15px;
            }
            label {
                margin-bottom: 5px;
                display: block;
            }
        </style>


        
    </head>
    <body>
    <?php
        include "db_con.php";


        // $userId = $_GET['userId'];

        // SQL 준비
        $sql = "SELECT * FROM signup WHERE userId = ?";

        // 준비된 문(statement) 생성
        $stmt = mysqli_prepare($con, $sql);

        // 준비된 문에 변수 바인딩
        mysqli_stmt_bind_param($stmt, "s", $userId);

        // 쿼리 실행
        mysqli_stmt_execute($stmt);

        // 결과 가져오기
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // 이메일 주소 분리
            list($userEmail, $emailDomain) = explode('@', $row["userEmail"]);
        } else {
            echo "0 results";
        }

        // 준비된 문과 데이터베이스 연결 닫기
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    ?>
        <h1>회원정보 수정</h1>
        <form action="user_update_server.php" method="post">
            아이디 : <input type="text" name="userId" id="userId" value="<?= $row["userId"]; ?>" readonly /> <br /> 
            비밀번호 : <input type="password" name="userPw1" id="userPw1" />
            비밀번호확인 : <input type="password" name="userPw2" id="userPw2" /> <br>
            이메일 : <input type="text" id="userEmail" name="userEmail" value="<?= $userEmail; ?>" /> @
            <input type="text" name="emailDomain" id="emailDomain" placeholder="직접 입력">
            <select name="selectEmailDomain" id="selectEmailDomain" onchange="checkEmailDomain()">
                <option value="">직접 입력</option>
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
            이름 : <input type="text" name="userName" id="userName" value="<?= $row["userName"]; ?>"/> <br />
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
            <div class="button-group">
                <input type="submit" value="수정하기" />
                <input type="reset" value="뒤로가기" onclick="history.back()" />
                <input id='delete' type="button" value="회원탈퇴" onclick="confirmDelete()">
            </div>
        </form>   
        <!-- 다음 주소검색 API -->
        <script src="http://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="./js/daum_adress_api.js"></script>
        <script>
            checkEmailDomain = () => {
                var emailDomain = document.getElementById('emailDomain');
                var selectEmailDomain = document.getElementById('selectEmailDomain').value;

                emailDomain.value = selectEmailDomain;
    }
        </script>
        <script>
            function confirmDelete() {
                if (confirm("정말로 회원을 탈퇴하시겠습니까?")) {
                    window.location.href = 'user_delete_server.php';
                }
                else {
                    history.back();
                }
            }

            const userPw1 = document.getElementById('userPw1').value
            console.log(userPw1)
        </script>
    </body>
    </html>