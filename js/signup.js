var isIdChecked = false; // 중복 확인이 완료되었는지 나타내는 변수
// 중복 확인 함수
function checkId() {
  window.open(
    "signup_check_Id.php?userId=" + document.getElementById("userId").value,
    "IDCheck",
    "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes"
  );
  isIdChecked = true; // 중복 확인 클릭 시 true로 설정
}

// 폼 제출 전 검사 함수
function beforeSubmit() {
  if (!isIdChecked) {
    // 중복 확인이 완료되지 않았다면
    alert("아이디 중복 확인을 해주세요.");
    return false;
  }
  return true;
}

function checkEmailDomain() {
  var selectEmailDomain = document.getElementById("selectEmailDomain").value;
  var emailDomain = document.getElementById("emailDomain");
  emailDomain.value = selectEmailDomain; // 선택된 도메인을 직접 입력 필드에 자동으로 채워줍니다.
}

function passwordCheck() {
  if (
    document.getElementById("userPw1").value !=
    document.getElementById("userPw2").value
  ) {
    alert("비밀번호를 다시 입력하세요");
    return false;
  }
  return true;
}

function validateForm() {
  // 필수 입력 필드 ID 및 이름 배열
  const requiredFields = [
    { id: "userId", name: "아이디" },
    { id: "userPw1", name: "비밀번호" },
    { id: "userPw2", name: "비밀번호 확인" },
    { id: "userEmail", name: "이메일" },
    { id: "emailDomain", name: "이메일 도메인" },
    { id: "userTel", name: "휴대전화" },
    { id: "userName", name: "이름" },
    { id: "birth_year", name: "생년월일 연도" },
    { id: "birth_month", name: "생년월일 월" },
    { id: "birth_day", name: "생년월일 일" },
    { id: "postcode", name: "우편번호" },
    { id: "address", name: "주소" },
    { id: "detailAddress", name: "상세주소" },
  ];

  for (let field of requiredFields) {
    const inputElement = document.getElementById(field.id);
    if (inputElement && inputElement.value === "") {
      alert(field.name + "을(를) 입력해주세요.");
      inputElement.focus(); // 해당 필드로 포커스 이동
      return false; // 폼 제출 중단
    }
  }

  if (!beforeSubmit()) {
    return false;
  }

  // 비밀번호 일치 확인
  if (!passwordCheck()) {
    return false; // 비밀번호 불일치 시 폼 제출 중단
  }

  // 모든 검사 통과 시 폼 제출
  return true;
}
