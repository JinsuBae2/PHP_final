<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>아이디 찾기</h1>
    <form action="find_id_server.php", method="post">
        이름 : <input type="text" name="findName" id=""> <br>
        이메일 : <input type="text" id="findEmail" name="findEmail" /> @
        <input type="text" name="findeEmailDomain" id="findeEmailDomain" placeholder="직접 입력">
        <select name="selectFindEmailDomain" id="selectFindEmailDomain" onchange=checkEmailDomain()>
            <option value="">직접 입력</option>
            <option value="gmail.com">gmail.com</option>
            <option value="naver.com">naver.com</option>
            <option value="daum.net">daum.net</option>
            <option value="nate.com">nate.com</option>
            <option value="hotmail.com">hotmail.com</option>
        </select>
        
        <input type="submit" value="찾기">
        <input type="reset" value="뒤로가기" onclick="history.back()">
    </form>
    <script>
        checkEmailDomain = () => {
            var selectFindEmailDomain = document.getElementById('selectFindEmailDomain').value;
            var findeEmailDomain =document.getElementById('findeEmailDomain');

            findeEmailDomain.value = selectFindEmailDomain;
        }
    </script>
</body>
</html>