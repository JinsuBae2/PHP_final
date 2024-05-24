<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>맛집 검색 서비스</title>
    <link rel="stylesheet" href="./css/nav_bar.css">

  </head>
  <body>
    <header>
      <h1>aaa</h1>
    </header>
    <nav>
        <a href='index.php'>홈</a>
        <a href='#'>맛집 보기</a>
        <a href='#'>맛집 후기</a>
        <span
        ><input type="text" name="search" id="" placeholder="검색" />
        <input type="submit" value="검색"
      /></span>
    <?php
        session_start();
        
        if (isset($_SESSION['userId'])){
    ?>
    
          <a href='user_update.php'>회원정보 수정</a>  
          <a href='logout.php'>로그아웃</a> 
    <?php
        }
        else {
    ?>
          <a href='' onclick='openLoginWindow()'>로그인</a>
          <a href='signup.php'>회원가입</a>
    <?php
        }
    ?>      
    </nav>
    <script>
        function openLoginWindow() {
          // 새 창을 열고, 크기와 위치를 지정합니다.
          // window.open(URL, name, specs, replace)
          window.open(
            "login.php",
            "loginWindow",
            "width=400,height=600,left=100,top=100"
          );
        }
      </script>
  </body>
</html>
