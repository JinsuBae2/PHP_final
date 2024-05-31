<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/store_post.css">
    <script>
        const title = document.getElementById('post_name');
        const address = document.getElementById('post_address');
        const post_contents = document.getElementById('post_contents');

        function check_input() {
        if (!title.value)
        {
            alert("음식점 이름을 입력하세요!");
            title.focus();
            return;
        }
        if (!address.value)
        {
            alert("주소를 입력하세요!");    
            address.focus();
            return;
        }
        if (!post_contents.value)
        {
            alert("내용을 입력하세요!");    
            post_contents.focus();
            return;
        }

        document.board_form.submit();
    }
    </script>
</head>
<body>
    <?php 
        include 'header.php';
        if(isset($_SESSION['userId'])) {
            $session_userId = $_SESSION['userId'];
        } else {
            echo "  <script>
                        alert('로그인 후 이용하세요');
                        history.back()
                    </script>";
            exit;
        }
    ?>
    <section>
    <h3>글쓰기</h3> <hr>
    <form action="store_post_server.php?userId=<?=$session_userId?>" method="post" enctype="multipart/form-data">
        사용자 이름 : <?=$session_userId?> <br>
        <input type="text" name="post_name" id="post_name" placeholder="음식점 이름">  
        <input type="button" value="찾기" onclick="store_search()"> <br>
        <input type="text" name="post_address" id="post_address" placeholder="음식점 주소"><br>
        이미지 첨부 : <input type="file" name="upfile" id="upfile"> <br>
        <textarea name="post_contents" id="post_contents" cols="30" rows="10" placeholder="내용을 입력하세요."></textarea> <br>
        <input type="text" name="recommend_menu" id="recommend_menu" placeholder="추천 메뉴"> <br>
        평점 : <br><input type="range" min="1" max="5" name="rating" id="rating" list="rating_data">
                <datalist id="rating_data">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </datalist>
        <input type="submit" value="작성완료">
        <input type="button" value="뒤로가기" onclick="history.back()">
    </form>
    </section>
    <script>
        const post_name = document.getElementById('post_name');
        store_search = () => {
            window.open(
                'https://map.kakao.com/link/search/' + post_name.value,
                "loginWindow",
                "width=1000,height=1200,left=100,top=100"
            )
        }
    </script>
</body>
</html>