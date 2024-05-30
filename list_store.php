<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        section {
            padding-left: 150px;
        }
        /* 게시판 목록보기(store_list.php) */
        #store_list_container {
            text-align: center;
            /* max-height: 400px; 원하는 높이로 설정 */
            overflow-y: scroll;
            border: 1px solid #dddddd;
            padding: 10px;
            background-color: white;
        }
        #store_list_div {
            text-align: center;
            border-style: solid;
            border-radius: 50px;
            width: 50%;
            min-height: 300px;
            margin:0px 20%;
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
        }
        #store_list_div p {
            margin: 10px 0;
            font-size: 16px;
        }
        #store_list_div .col0 { width: 80px; display: inline-block; }
        #store_list_div .col1 { width: 80px; display: inline-block; }
        #store_list_div .col2 { width: 200px; display: inline-block; text-align: center; }
        #store_list_div .col3 { width: 200px; display: inline-block; text-align: right; }
        #store_list_div .col4 { width: 300px; display: inline-block; text-align: center; }
        #store_list_div .col5 { width: 100px; display: inline-block; }
        #store_list_div .col6 { width: 100px; display: inline-block; }
        #store_list_div .col7 { text-align: center;}

        form {
            margin-top: 20px;
        }
        form input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        form button, .postcreateBtn{
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }
        form button:hover {
            background-color: #0056b3;
        }
        summary {
            margin-top: 20px;
        }
        summary div {
            padding: 10px;
            border: 1px solid #dddddd;
        }
    </style>
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

        $conn = mysqli_connect('localhost', 'root', '', 'final_project');

        $sql = "SELECT post_Id, userId, store_name, store_address, recommend_menu, rating, store_like, like_Id, file_copied FROM store";
        $result = mysqli_query($conn, $sql);
    ?>
    <section>
        <h3>맛집 리스트 ></h3> 
        <hr>
        <button class="postcreateBtn" onclick="location.href= 'post_store.php'">글쓰기</button>
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
                                <p class="col7"><img src="./images/<?=$file_copied?>" alt=""></p>
                                <!-- 좋아요 버튼 -->
                                <form method="post" action="like_store.php?userId=<?=$userId?>&post_Id=<?=$post_Id?>" onsubmit="saveScrollPosition()">
                                    <button style="border: 0; background-color: transparent; cursor:pointer;" type="submit">
                                        <?php 
                                            if (!str_contains($like_Id, $userId)){
                                        ?>
                                            <span style="font-size:30px; color:red;">♡</span>
                                        <?php } else { ?>
                                            <span style="font-size:30px; color:red;">♥</span>
                                        <?php }?>
                                    </button>
                                    <span style="font-size:20px"><?=$store_like?></span>
                                </form>
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
