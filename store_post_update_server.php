<?php
$post_Id = $_POST['post_Id'];
$store_name = $_POST['post_name'];
$store_address = $_POST['post_address'];
$post_contents = $_POST['post_contents'];
$recommend_menu = $_POST['recommend_menu'];
$rating = $_POST['rating'];

echo $store_name, $store_address, $post_contents, $recommend_menu, $rating, $post_Id;

$upfile_name = "";
$upfile_type = "";
$copied_file_name = "";

include 'db_con.php';

// 음식점 변경 시 좌표값 초기화
$sql = "SELECT * FROM store WHERE post_Id=?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $post_Id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
if ($store_name != $row['store_name']) {
    $store_x = null;
    $store_y = null;
} else {
    $store_x = $row['x'];
    $store_y = $row['y'];
}


$upload_dir = './images/';

if (isset($_FILES["upfile"]) && !empty($_FILES["upfile"]) && $_FILES["upfile"]["error"] == UPLOAD_ERR_OK) {
    $upfile_name = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type = $_FILES["upfile"]["type"];
    $upfile_size = $_FILES["upfile"]["size"];
    $upfile_error = $_FILES["upfile"]["error"];

    if ($upfile_size > 10000000) {
        echo "<script>
                alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다! 파일 크기를 체크해주세요!');
                history.go(-1);
              </script>";
        exit;
    }

    $file_info = pathinfo($upfile_name);
    $file_ext = $file_info['extension'];
    $new_file_name = date("Y_m_d_H_i_s");
    $copied_file_name = $new_file_name . "." . $file_ext;
    $uploaded_file = $upload_dir . $copied_file_name;

    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
        echo "<script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                history.go(-1);
              </script>";
        exit;
    }
}

if ($copied_file_name == "") {
    $sql = "UPDATE store SET store_name=?, store_address=?, post_contents=?, recommend_menu=?, rating=?, x=?, y=? WHERE post_Id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssissi", $store_name, $store_address, $post_contents, $recommend_menu, $rating, $store_x, $store_y, $post_Id);
} else {
    $sql = "UPDATE store SET store_name=?, store_address=?, post_contents=?, recommend_menu=?, rating=?, file_copied=?, x=?, y=? WHERE post_Id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssisssi", $store_name, $store_address, $post_contents, $recommend_menu, $rating, $copied_file_name, $store_x, $store_y, $post_Id);
}

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
            alert('수정이 완료되었습니다.');
            location.href='geo_convert.php';
          </script>";
} else {
    echo "수정이 실패하였습니다: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
