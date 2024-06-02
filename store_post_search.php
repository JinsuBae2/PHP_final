<?php
    include "header.php";
    include "db_con.php";

    $session_userId = $_SESSION['userId'];
    $search = $_GET['search'];
    
    if (isset($search)) {
        $search = '%' . $search . '%';
    } else {
        echo "<script>
                alert('검색어를 입력하세요')
                history.back();
              </script>";
    }

    $sql = "SELECT * FROM store WHERE store_name LIKE ? OR category LIKE ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/store_list.css">
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
        <h3>검색 결과 ></h3>
        <hr>
        <div id="store_list_container">
            <ul id="store_list">
                <?php
                    // if (!$result) {
                    if (!mysqli_num_rows($result)) {
                        echo "<p>등록된 글이 없습니다.</p>";
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            $post_Id = $row['post_Id'];
                            $userId = $row['userId'];
                            $store_name = $row['store_name'];
                            $store_address = $row['store_address'];
                            $post_contents = $row['post_contents'];
                            $recommend_menu = $row['recommend_menu'];
                            $rating = $row['rating'];
                            $store_like = $row['store_like'];
                            $post_date = $row['post_date'];
                            $file_copied = $row['file_copied'];
                            $like_Id = $row['like_Id'];
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
        </div>
    </section>
</body>
</html>