<?php
include 'db_con.php'; // 데이터베이스 연결 설정

$userId = mysqli_real_escape_string($con, $_GET['userId']);
$post_Id = mysqli_real_escape_string($con, $_GET['post_Id']);

// `like_Id`가 `null`인 경우를 처리하기 위해 먼저 현재 값을 가져옵니다.
$query = "SELECT like_Id FROM store WHERE post_Id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $post_Id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$like_id = $row['like_Id'];
mysqli_stmt_close($stmt);

if ($like_id === null) {
    // `like_Id`가 `null`인 경우 초기값 설정
    $like_id = '';
}

if (strpos($like_id, $userId) !== false) {
    // 사용자 ID가 이미 존재하면 좋아요를 취소합니다.
    $sql = "UPDATE store SET store_like = store_like - 1, like_Id = REPLACE(like_Id, ?, '') WHERE post_Id = ?";
} else {
    // 사용자 ID가 없으면 좋아요를 추가합니다.
    // `like_Id`가 `null`일 경우를 대비하여 `COALESCE`와 `CONCAT`을 사용합니다.
    $sql = "UPDATE store SET store_like = store_like + 1, like_Id = CONCAT(COALESCE(like_Id, ''), ?) WHERE post_Id = ?";
}

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ss", $userId, $post_Id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);

// 페이지 리다이렉션
echo "<script>location.href = 'store_list.php'</script>";
?>
