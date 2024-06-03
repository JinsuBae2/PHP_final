<?php
    include 'db_con.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category = $_POST['category'];

        $sql_category = "SELECT * FROM store WHERE category=? ORDER BY post_date DESC LIMIT 5";
        $stmt_category = mysqli_prepare($con, $sql_category);
        mysqli_stmt_bind_param($stmt_category, "s", $category);
        mysqli_stmt_execute($stmt_category);
        $result_category = mysqli_stmt_get_result($stmt_category);
        $posts_category = [];
        while ($row = mysqli_fetch_assoc($result_category)) {
            array_push($posts_category, $row);
        }

        displayPosts($posts_category);
    }

    function displayPosts($posts) {
        if (count($posts) > 0) {
            echo '<ul id="store_list">';
            foreach ($posts as $post) {
                echo '<div id="store_list_div">';
                echo '<span>' . $post['store_name'] . '</span>';
                echo '<span>' . $post['recommend_menu'] . '</span>';
                echo '</div>';
            }
            echo '</ul> <hr>';
        } else {
            echo "<li>등록된 글이 없습니다.</li>";
        }
    }
?>
