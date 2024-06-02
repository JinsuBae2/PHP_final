<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/store_post.css">
</head>
<body>
    <?php include 'header.php' ?>
    <?php include 'db_con.php' ?>
    <?php 
        if (isset($_SESSION['userId'])) {
            $session_userId = $_SESSION['userId'];
        }

        $post_Id = $_GET['post_Id'];
        $sql = "SELECT * FROM store WHERE post_Id='$post_Id'";
        $result = mysqli_query($con, $sql);
        $post = mysqli_fetch_assoc($result);
    ?>
    <section>
        <h3>글 수정하기</h3> <hr>
        <form action="store_post_update_server.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="post_Id" value="<?=$post_Id?>"> <!-- 게시글 ID 숨김 필드 -->
            작성자 이름 : <?=$session_userId?> <br>
            <input type="text" name="post_name" id="post_name" value="<?=$post['store_name']?>" placeholder="음식점 이름">  
            <input type="button" value="찾기" onclick="store_search()"> <br>
            <input type="text" name="post_address" id="post_address" value="<?=$post['store_address']?>" placeholder="음식점 주소"><br>
            이미지 첨부 : <input type="file" name="upfile" id="upfile"> <br>
            <textarea name="post_contents" id="post_contents" cols="30" rows="10" placeholder="내용을 입력하세요."><?=$post['post_contents']?></textarea> <br>
            음식 종류 :
            <select name="category" id="category">
                <option value="">카테고리</option>
                <option value="한식">한식</option>
                <option value="중식">중식</option>
                <option value="양식">양식</option>
                <option value="분식">분식</option>
                <option value="패스트푸드">패스트푸드</option>
                <option value="카페">카페</option>
                <option value="고기">고기</option>
                <option value="치킨">치킨</option>
            </select>
            <input type="text" name="recommend_menu" id="recommend_menu" value="<?=$post['recommend_menu']?>" placeholder="추천 메뉴"> <br>
            평점 : <br><input type="range" min="1" max="5" value="<?=$post['rating']?>" name="rating" id="rating" list="rating_data">
                    <datalist id="rating_data">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </datalist>
            <input type="submit" value="수정 완료">
            <input type="button" value="뒤로가기" onclick="history.back()">
            <input type="button" value="글 삭제" onclick="deletePost()">
        </form>
    </section>

</body>
<script>
    const post_name = document.getElementById('post_name');
    store_search = () => {
        window.open(
            'https://map.kakao.com/link/search/' + post_name.value,
            "loginWindow",
            "width=1000,height=1200,left=100,top=100"
        )
    }

    function deletePost() {
        if (confirm('정말로 이 글을 삭제하시겠습니까?')) {
            window.location.href = 'store_post_delete_server.php?post_Id=<?=$post_Id?>';
        }
    }
</script>
</html>
