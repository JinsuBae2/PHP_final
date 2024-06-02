<?php
    include 'db_con.php';
    $post_Id = $_GET['post_Id'];

    // SQL을 이용해 포스트 삭제
    $sql = "DELETE FROM store WHERE post_Id = $post_Id";

    if (mysqli_query($con, $sql)) {
        echo "<script> 
                alert('게시글이 성공적으로 삭제되었습니다.')
                location.href='store_list.php'
            </script>";
    } else {
        echo "오류: " . $sql . "<br>" . mysqli_error($con);
    }

    // 연결 닫기
    mysqli_close($con);
?>