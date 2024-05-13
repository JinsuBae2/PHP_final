<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>회원가입</h1>
    <form action="signup_server.php" method="post">
      아이디 : <input type="text" name="userId" id="" /> <br />
      비밀번호 : <input type="password" name="userPw1" id="" /> <br />
      비밀번호 확인 : <input type="password" name="userPw2" id="" /> <br />
      이메일 : <input type="text" id="userEmail" name="userEmail" /> @
      <select name="emailDomain" id="emailDomain">
        <option value="직접 입력">직접 입력</option>
        <option value="gmail.com">gmail.com</option>
        <option value="naver.com">naver.com</option>
        <option value="daum.net">daum.net</option>
        <option value="nate.com">nate.com</option>
        <option value="hotmail.com">hotmail.com</option>
      </select>
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
