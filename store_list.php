
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif; /* 기본 글씨체를 유지하거나 'Segoe UI', 'Roboto'로 변경할 수 있습니다. */
            background-color: #FAFAFA; /* 밝은 회색으로 변경 */
            color: #262626; /* 어두운 글씨색 */
            margin: 0;
            padding: 20px;
        }

        section {
            padding: 0 150px; /* 좌우 패딩 조정 */
        }

        /* 게시판 목록보기 스타일 */
        #store_list_container {
            text-align: center;
            overflow-y: scroll;
            border: 1px solid #dddddd;
            padding: 10px;
            background-color: white;
        }

        #store_list_div {
            text-align: center; /* 왼쪽 정렬로 변경 */
            border: 1px solid #e6e6e6; /* 경계선 스타일 변경 */
            border-radius: 10px; /* 둥근 모서리 */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* 그림자 추가 */
            width: 50%;
            min-height: 300px;
            margin: 20px auto; /* 중앙 정렬 */
            padding: 20px;
            background-color: #ffffff;


        }

        form button, .postcreateBtn{
            padding: 8px 16px;
            background-color: #0095f6; /* 파란색으로 변경 */
            color: white;
            border-radius: 4px; /* 둥근 모서리 */
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* 그림자 추가 */
        }

        form button:hover, .postcreateBtn:hover {
            background-color: #007BFF; /* 호버 색상 변경 */
            box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* 호버시 그림자 강조 */
        }

        /* 좋아요 버튼 스타일링 */
        form button[type="submit"] {
            background-color: transparent;
            padding: 0;
        }

        form button[type="submit"]:hover {
            background-color: transparent;
        }

        /* 이미지 스타일링 (예시) */
        #store_list_div .col7 img {
            width: 300px; /* 이미지 크기 조정 */
            height: 300px;
            border-radius: 10%; /* 원형 이미지 */
        }
    </style>
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
    <?php
        include 'header.php';
        include 'db_con.php';

        $session_userId = $_SESSION['userId'];

        $sql = "SELECT * FROM store order by post_Id DESC";
        $result = mysqli_query($con, $sql);
    ?>
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
                                <p class="col7"><img src="./images/<?=$file_copied?>" alt=" "></p>
                                <p class="col8"><?=$post_contents?></p>
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
                                        <button class="postcreateBtn" onclick="location.href= 'store_post_update.php'">수정하기</button>
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
