<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      .input-box{
        position:relative;
        margin:10px 0;
      }
      .input-box > input{
        background:transparent;
        border:none;
        border-bottom: solid 1px #ccc;
        padding:20px 0px 5px 0px;
        font-size:14pt;
        width:100%;
      }
      input::placeholder{
        color:transparent;
      }
      input:placeholder-shown + label{
        color:#aaa;
        font-size:14pt;
        top:15px;
      }
      input:focus + label, label{
        color:#8aa1a1;
        font-size:10pt;
        pointer-events: none;
        position: absolute;
        left:0px;
        top:0px;
        transition: all 0.2s ease ;
        -webkit-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
      }
      input:focus, input:not(:placeholder-shown){
        border-bottom: solid 1px #8aa1a1;
        outline:none;
      }
      input[type=submit], input[type=reset]{
                background-color: #8aa1a1;
                border:none;
                color:white;
                border-radius: 5px;
                width:100%;
                height:35px;
                font-size: 14pt;
                margin-top:10px;
            }
      input[type=submit]:hover, input[type=reset]:hover {
        opacity: 0.8;
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
