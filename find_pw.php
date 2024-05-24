<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>비밀번호 찾기</h1>
    <form action="find_pw_server.php", method="post">
        <input type="text" name="findId" id="findId" placeholder="아이디를 입력하세요"> <br>
        <input type="text" id="findEmail" name="findEmail" placeholder="이메일을 입력하세요"/> @
        <select name="findEmailDomain" id="findEmailDomain">
            <option value="직접 입력">직접 입력</option>
            <option value="gmail.com">gmail.com</option>
            <option value="naver.com">naver.com</option>
            <option value="daum.net">daum.net</option>
            <option value="nate.com">nate.com</option>
            <option value="hotmail.com">hotmail.com</option>
        </select>
        <br>
        <input type="submit" value="찾기">
        <input type="reset" value="뒤로가기" onclick="history.back()">
    </form>
</body>
</html>