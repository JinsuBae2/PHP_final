<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
    /* 전체 페이지 스타일링 */
      body {
          font-family: Arial, sans-serif;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          margin: 0;
          background-color: #f5f5f5;
      }

      /* 폼 스타일링 */
      form {
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 40px;
          border: 1px solid #ccc;
          border-radius: 5px;
          background-color: #fff;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      /* 입력 박스 스타일링 */
      .input-box {
          position: relative;
          margin-bottom: 20px;
          width: 100%;
      }

      .input-box input {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          box-sizing: border-box;
      }

      .input-box label {
          position: absolute;
          top: -10px;
          left: 10px;
          background-color: #fff;
          padding: 0 5px;
          font-size: 12px;
          color: #666;
      }

      /* 링크 스타일링 */
      #forgot {
          display: flex;
          justify-content: space-between;
          width: 100%;
          margin-bottom: 20px;
      }

      #forgot a {
          color: #007bff;
          text-decoration: none;
          font-size: 14px;
      }

      #forgot a:hover {
          text-decoration: underline;
      }

      /* 버튼 스타일링 */
      form input[type="submit"],
      form input[type="reset"] {
          width: 100%;
          padding: 10px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          font-size: 16px;
          margin-bottom: 10px;
      }

      form input[type="submit"] {
          background-color: #007bff;
          color: white;
      }

      form input[type="reset"] {
          background-color: #6c757d;
          color: white;
      }
    </style>
  </head>
  <body>
    <form action="login_server.php" method="post">
      <div class="input-box">
          <input id="userId" type="text" name="userId" placeholder="아이디">
          <label for="userId">아이디</label>
      </div>

      <div class="input-box">
          <input id="userPw" type="password" name="userPw" placeholder="비밀번호">
          <label for="userPw">비밀번호</label>
      </div>
      <div id="forgot">
        <a href="find_id.php">아이디 찾기</a>
        <a href="find_pw.php">비밀번호 찾기</a>
      </div>
      <input type="submit" value="로그인">
      <input type="reset" value="취소" onclick="windowClose()"/>
    </form>
    <script>
      windowClose = () => {
        window.close();
    }
    </script>
  </body>
</html>
