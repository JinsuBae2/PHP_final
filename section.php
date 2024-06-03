<?php
    include 'db_con.php';

    $session_userId = $_SESSION['userId'];

    // 인기별로 조회 - 좋아요(like) 기준
    $sql_popular = "SELECT * FROM store ORDER BY store_like DESC LIMIT 5";
    $result_popular = mysqli_query($con, $sql_popular);
    $posts_popular = [];
    while ($row = mysqli_fetch_assoc($result_popular)) {
        array_push($posts_popular, $row);
    }

    // 최근 등록별로 조회
    $sql_recent = "SELECT * FROM store ORDER BY post_date DESC LIMIT 5";
    $result_recent = mysqli_query($con, $sql_recent);
    $posts_recent = [];
    while ($row = mysqli_fetch_assoc($result_recent)) {
        array_push($posts_recent, $row);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>맛집 리스트 섹션별 보기</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        section {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        #store_list_container {
            margin-bottom: 20px;
        }

        #store_list_div {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #store_list_div span:first-child {
            width: 200px;
        }

        #store_list_div span {
            margin-right: 10px;
        }

        #store_list_div:last-child {
            border-bottom: none;
        }

        select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #category_store_list {
            margin-top: 20px;
        }

        ul#store_list {
            list-style-type: none;
            padding: 0;
        }

        ul#store_list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        ul#store_list li:last-child {
            border-bottom: none;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        ul#store_list li, li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            min-height: 50px; /* 최소 높이 설정 */
            display: flex; /* Flexbox 사용 */
            align-items: center; /* 세로 중앙 정렬 */
            justify-content: center; /* 가로 중앙 정렬 */
        }

        ul#store_list li:last-child {
            border-bottom: none;
        }

    </style>
    <script>
        function fetchCategoryStores(category) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'section_fetch_category_stores.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('category_store_list').innerHTML = xhr.responseText;
                }
            };
            xhr.send('category=' + category);
        }
    </script>
</head>
<body>
    <section>
        <h3>인기 맛집 ></h3>
        <div id="store_list_container">
            <?php displayPosts($posts_popular, 'popular'); ?>
        </div>
        <h3>최근 등록 맛집 ></h3>
        <div id="store_list_container">
            <?php displayPosts($posts_recent, 'recent'); ?>
        </div>
        <h3>카테고리별 맛집 ></h3>
        <div>
            <select onchange="fetchCategoryStores(this.value)">
                <option value="">카테고리</option>
                <option value="한식">한식</option>
                <option value="중식">중식</option>
                <option value="양식">양식</option>
                <option value="분식">분식</option>
                <option value="패스트푸드">패스트푸드</option>
                <option value="카페">카페</option>
                <option value="고기">고기</option>
                <option value="치킨">치킨</option>
                <option value="기타">기타</option>
            </select>
        </div>
        <div id="category_store_list">
            <!-- 카테고리별 맛집 리스트가 여기에 표시됩니다. -->
        </div>
    </section>
</body>
</html>
<?php
    function displayPosts($posts, $type) {
        if (isset($_SESSION['userId'])){
            if (count($posts) > 0) {
                echo '<ul id="store_list">';
                foreach ($posts as $post) {
                    if ($type == 'popular') {
                        echo '<div id="store_list_div">';
                        // 여기서 각 게시글을 표시하는 HTML 구조를 넣으세요.
                        // 예: echo '<li>' . $post['store_name'] . '</li>';
                        echo '<span>' . $post['store_name'] . '</span>';
                        echo '<span>' . str_repeat('⭐️', $post['rating']) . '</span>';
                        echo '<span> 좋아요 ' . $post['store_like'] . '</span>';
                        // 나머지 필드들도 유사하게 추가 가능
                        echo '</div>';
                    } else if ($type == 'recent') {
                        echo '<div id="store_list_div">';
                        // 여기서 각 게시글을 표시하는 HTML 구조를 넣으세요.
                        // 예: echo '<li>' . $post['store_name'] . '</li>';
                        echo '<span>' . $post['store_name'] . '</span>';
                        echo '<span>' . $post['post_date'] . '</span>';
                        // 나머지 필드들도 유사하게 추가 가능
                        echo '</div>';
                    }
                }
                echo '</ul> <hr>';
            } else {
                echo "<li>등록된 글이 없습니다.</li>";
            }
        } else {
            echo "<li>로그인 후 확인 할 수 있습니다.</li>";
        }
    }
?>
