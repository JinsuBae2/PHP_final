<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function checkEmailDomain() {
            var selectFindEmailDomain = document.getElementById("selectFindEmailDomain").value;
            var findEmailDomain = document.getElementById("findEmailDomain");
            findEmailDomain.value = selectFindEmailDomain; // 선택된 도메인을 직접 입력 필드에 자동으로 채워줍니다.   
        }
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #444;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit], input[type=reset] {
            width: 48%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover, input[type=reset]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>비밀번호 찾기</h1>
    <form action="find_pw_server.php", method="post">
        <input type="text" name="findId" id="findId" placeholder="아이디를 입력하세요"> <br>
        <input type="text" id="findEmail" name="findEmail" placeholder="이메일을 입력하세요"/> @
        <input type="text" name="findEmailDomain" id="findEmailDomain" placeholder="직접 입력">
        <select name="selectFindEmailDomain" id="selectFindEmailDomain" onchange="checkEmailDomain()">
            <option value="">직접 입력</option>
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