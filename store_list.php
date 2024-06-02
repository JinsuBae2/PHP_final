<?php
        include 'header.php';
        include 'db_con.php';

        $session_userId = $_SESSION['userId'];

        $offset = $_GET['offset'] ? $_GET['offset'] : 1;
        $viewPost = 5 * $offset;

        $sql = "SELECT * FROM store order by post_Id DESC LIMIT ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt , "i", $viewPost);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $posts = [];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($posts, $row);
        }

        $total_post_result = mysqli_query($con, "SELECT COUNT(post_Id) FROM store");
        $total_post = (mysqli_fetch_row($total_post_result))[0];
        $total_pages = ceil($total_post / $viewPost);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/store_list.css">
</head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 페이지 로드 시 저장된 스크롤 위치로 이동
            const scrollPosition = localStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem('scrollPosition');
            }
        });

        function saveScrollPosition() {
            // 현재 스크롤 위치 저장
            localStorage.setItem('scrollPosition', window.scrollY);
        }
    </script>
</head>
<body>
    
    <section>
        <h3>맛집 리스트 ></h3> 
        <hr>
        <button class="postcreateBtn" onclick="location.href= 'store_post.php'">글쓰기</button>
        <div id="store_list_container">
            <ul id="store_list">
                <?php
                    if (!$result) {
                        echo "<li>등록된 글이 없습니다.</li>";
                    } else {
                        // while ($row = mysqli_fetch_array($result)) {
                            // $post_Id = $row['post_Id'];
                            // $userId = $row['userId'];
                            // $store_name = $row['store_name'];
                            // $store_address = $row['store_address'];
                            // $post_contents = $row['post_contents'];
                            // $recommend_menu = $row['recommend_menu'];
                            // $rating = $row['rating'];
                            // $store_like = $row['store_like'];
                            // $post_date = $row['post_date'];
                            // $file_copied = $row['file_copied'];
                            // $like_Id = $row['like_Id'];
                            // $rating_star = str_repeat('⭐️', $rating);
                        foreach ($posts as $post) {
                            $post_Id = $post['post_Id'];
                            $userId = $post['userId'];
                            $store_name = $post['store_name'];
                            $store_address = $post['store_address'];
                            $post_contents = $post['post_contents'];
                            $recommend_menu = $post['recommend_menu'];
                            $rating = $post['rating'];
                            $store_like = $post['store_like'];
                            $post_date = $post['post_date'];
                            $file_copied = $post['file_copied'];
                            $like_Id = $post['like_Id'];
                            $rating_star = str_repeat('⭐️', $rating);
                ?>
                            <div id="store_list_div">
                                <p class="col0"><?=$post_Id?></p>
                                <p class="col1"><?=$userId?></p>
                                <p class="col2"><?=$store_name?></p>
                                <p class="col3"><?=$post_date?></p>
                                <p class="col4"><?=$store_address?></p>
                                <p class="col5"><?=$recommend_menu?></p>
                                <p class="col6"><?=$rating_star?></p>
                                <hr>
                                <?php if (!empty($file_copied) && file_exists("./images/" . $file_copied)) { ?>
                                    <p class="col7"><img src="./images/<?=$file_copied?>" alt=" "></p>
                                <?php } ?>
                                <p class="col8"><?=$post_contents?></p>
                                <hr>
                                <!-- 좋아요 버튼 -->
                                <form method="post" action="store_like.php?userId=<?=$session_userId?>&post_Id=<?=$post_Id?>" onsubmit="saveScrollPosition()">
                                    <button style="border: 0; background-color: transparent; cursor:pointer;" type="submit">
                                        <?php 
                                            if (!str_contains($like_Id, $session_userId)){
                                        ?>
                                            <span style="font-size:30px; color:red;">♡</span>
                                        <?php } else { ?>
                                            <span style="font-size:30px; color:red;">♥</span>
                                        <?php }?>
                                    </button>
                                    <span style="font-size:20px"><?=$store_like?></span>
                                </form>
                                <?php if ($session_userId == $userId) {?>
                                        <button class="postcreateBtn" onclick="location.href= 'store_post_update.php?post_Id=<?=$post_Id?>'">수정하기</button>
                                <?php } ?>
                                
                            </div>
                <?php            
                        }
                    }
                ?>
                
            </ul>
            <?php 
            echo "<script>console.log($total_post, $viewPost, $total_pages )</script>";
            if ($viewPost - $total_post > 5) { ?>
                <script>alert('마지막 게시글 입니다.')</script>
                <div class="more-button">더보기</div>
            <?php } else { ?>
                <a href="store_list.php?offset=<?=$offset + 1 ?>" onclick="saveScrollPosition()" class="more-button">더보기</a>
            <?php } ?>
        </div>
    </section>
</body>
</html>
