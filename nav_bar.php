<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>맛집 검색 서비스</title>
    <style>
      /* 전체 body 스타일링 */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
      }

      /* 헤더 스타일링 */
      header {
        background: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
      }

      /* 네비게이션 바 스타일링 */
      nav {
        background: #444;
        display: flex;
        justify-content: space-around;
        padding: 10px 0;
      }

      /* 네비게이션 링크 스타일링 */
      nav a {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
      }

      /* 활성화된 링크/호버 스타일링 */
      nav a:hover {
        background: #555;
      }

      /* 검색 영역 스타일링 */
      nav span {
        display: flex;
      }

      /* 검색 입력 필드 스타일링 */
      nav input[type="text"] {
        padding: 5px;
        margin-right: 5px;
        border: none;
        border-radius: 5px;
      }

      /* 검색 버튼 스타일링 */
      nav input[type="submit"] {
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
        background: #333;
        color: white;
      }

      /* 검색 버튼 호버 효과 */
      nav input[type="submit"]:hover {
        background: #555;
      }
  </style>

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
            echo ("
                <a href='user_update.php'>회원정보 수정</a>  
                <a href='logout.php'>로그아웃</a> 
            ");
        }
        else {
            echo ("
            <a href='' onclick='openLoginWindow()'>로그인</a>
            <a href='signup.php'>회원가입</a>
            ");
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
