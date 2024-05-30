<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>맛집 검색 서비스</title>
    <style>
      body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      #h_div {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e0e0e0;
        padding-left: 150px;
        padding-right: 150px;
      }

      #h_div a {
        text-decoration: none;
        color: #007bff;
        margin: 0 10px;
      }

      #h_div span {
        display: flex;
        align-items: center;
      }

      #h_div input[type="text"] {
        width: 200px;
        height: 30px;
        padding: 5px;
        margin-right: 5px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        
      }

      #h_div input[type="submit"] {
        height: 30px;
        padding: 5px;
        margin-right: 5px;
        border: 1px solid #007bff;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
      }
      nav {
        background-color: #f8f9fa;
        padding: 10px 20px;
        display: flex;
        padding-left: 150px;
        border-bottom: 1px solid #e0e0e0;
      }

      nav a {
        text-decoration: none;
        color: black;
        margin: 0 10px;
      }

      nav a:hover {
        text-decoration: underline;
      }
    </style>
    

  </head>
  <body>
    
    <div id="h_div">
        <a href='index.php'>홈</a>
        <span>
            <input type="text" name="search" id="" placeholder="검색" />
            <input type="submit" value="검색"/>
        </span>
        <span>
        <?php
            
            $userId = $_SESSION['userId'];
            if (isset($_SESSION['userId'])){
        ?>
        
            <a href='user_update.php?userId=<?=$userId?>'>회원정보 수정</a>  
            <a href='logout.php'>로그아웃</a> 
        <?php
            } else {
        ?>
              <a href='' onclick='openLoginWindow()'>로그인</a>
              <a href='signup.php'>회원가입</a>
        <?php
            }
        ?>    
        </span>
        
    </div>
    <nav>
      <a href='view_store.php'>맛집 지도 보기</a> |
      <a href="list_store.php">맛집 리스트</a> |
      <a href='#'>맛집 후기</a> |
      
    </nav>
    <script>
        function openLoginWindow() {
          window.open(
            "login.php",
            "loginWindow",
            "width=400,height=600,left=100,top=100"
          );
        }
      </script>
  </body>
</html>
