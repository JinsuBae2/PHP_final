<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      /* 전체 페이지에 대한 스타일링 */
      body {
          font-family: 'Arial', sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 20px;

      }

      h1 {
          color: #333;
          text-align: center;
      }

      /* 폼 스타일링 */
      form {
          background: #fff;
          padding: 20px;
          padding-left: 30%;
          padding-right: 30%;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      /* 라벨과 인풋 간격 */
      form input[type="text"],
      form input[type="password"],
      form select {
          width: 100%;
          padding: 10px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
      }

      #birth_year, #birth_month, #birth_day {
        width: 20%
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

      /* 가입하기, 취소하기 버튼 스타일링 */
      form input[type="submit"],
      form input[type="reset"] {
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
      form input[type="reset"]:hover {
          background-color: #007B9E;
      }

      /* 간격 조절 */
      form br {
          margin: 10px 0;
      }


    </style>
    <script>
      checkId = () => {
        window.open(
          'signup_check_Id.php?userId=' + document.getElementById('userId').value,
          "IDCheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes"
        );
      }
      function checkEmailDomain() {
        var selectEmailDomain = document.getElementById("selectEmailDomain").value;
        var emailDomain = document.getElementById("emailDomain");
        emailDomain.value = selectEmailDomain; // 선택된 도메인을 직접 입력 필드에 자동으로 채워줍니다.
        
      }
    </script>
  </head>
  <body>
    <?php include 'header.php'; ?>

    <h1>회원가입</h1>
    <form action="signup_server.php" method="post">
      아이디 : <input type="text" name="userId" id="userId" /> <input type="button" value="중복확인" onclick=checkId()> <br />
      비밀번호 : <input type="password" name="userPw1" id="" /> <br />
      비밀번호 확인 : <input type="password" name="userPw2" id="" /> <br />
      이메일 : <input type="text" id="userEmail" name="userEmail" /> @
      <select name="selectEmailDomain" id="selectEmailDomain" onchange="checkEmailDomain();">
        <option value="">직접 입력</option>
        <option value="gmail.com">gmail.com</option>
        <option value="naver.com">naver.com</option>
        <option value="daum.net">daum.net</option>
        <option value="nate.com">nate.com</option>
        <option value="hotmail.com">hotmail.com</option>
      </select>
      <input type="text" id="emailDomain" name="emailDomain" placeholder="직접 입력" />
      <br />
      휴대전화 :
      <input
        type="text"
        name="userTel"
        id="userTel"
        placeholder="휴대폰 번호"
        pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"
        title="휴대폰 번호 형식: 010-1234-5678"
        required
      />
      <br />
      성별 :
      <select name="userGender" id="userGender">
        <option value="">성별</option>
        <option value="남">남</option>
        <option value="여">여</option>
      </select>
      <br />
      이름 : <input type="text" name="userName" id="" /> <br />
      생년월일 :
      <!-- 연도 선택 -->
      <select name="birth_year" id="birth_year">
        <option value="">Year</option>
        <!-- 자바스크립트를 이용하여 연도 옵션 자동 생성 -->
      </select>

      <!-- 월 선택 -->
      <select name="birth_month" id="birth_month">
        <option value="">Month</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>

      <!-- 일 선택 -->
      <select name="birth_day" id="birth_day">
        <option value="">Day</option>
        <!-- 자바스크립트를 이용하여 일 옵션 자동 생성 -->
      </select>

      <script>
        // 연도 옵션을 자동으로 생성하는 자바스크립트 코드
        const year = new Date().getFullYear();
        const earliestYear = year - 100; // 현재로부터 100년 전
        const latestYear = year;
        const yearSelect = document.getElementById("birth_year");

        for (let i = latestYear; i >= earliestYear; i--) {
          let option = new Option(i, i);
          yearSelect.add(option);
        }

        // 일 옵션을 자동으로 생성하는 자바스크립트 코드
        const daySelect = document.getElementById("birth_day");
        for (let i = 1; i <= 31; i++) {
          let option = new Option(i, i);
          daySelect.add(option);
        }
      </script>
      <br />
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
      <input type="submit" value="가입하기" />
      <input type="reset" value="취소하기" onclick="history.back()"/>
    </form>
    <!-- 다음 주소검색 API -->
    <script src="http://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="js/daum_adress_api.js"></script>
  </body>
</html>
