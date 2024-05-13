<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>로그인</h1>
    <form action="login_server.php" method="post">
      아이디 : <input type="text" name="userId" id="" /> <br />
      비밀번호 : <input type="password" name="userPw" id="" /> <br />
      <input type="submit" value="로그인" />
      <input type="reset" value="취소" onclick="windowClose()"/>
    </form>
    <script>
      windowClose = () => {
        window.close();
    }
    </script>
  </body>
</html>
