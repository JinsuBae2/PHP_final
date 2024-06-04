<?php 
        $userId = $_GET['userId'];
        $store_name = $_POST['post_name'];
        $store_address = $_POST['post_address'];
        $post_contents = $_POST['post_contents'];
        $category = $_POST['category'];
        $recommend_menu = $_POST['recommend_menu'];
        $rating = $_POST['rating'];
        $post_date = date('Y-m-d H:i:s');

        include 'db_con.php';
        
        $upload_dir = './images/';

        $upfile_name	 = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
        $upfile_type     = $_FILES["upfile"]["type"];
        $upfile_size     = $_FILES["upfile"]["size"];
        $upfile_error    = $_FILES["upfile"]["error"];

        if ($upfile_name && !$upfile_error)
        {
            $file = explode(".", $upfile_name);
            $file_name = $file[0];
            $file_ext  = $file[1];

            $new_file_name = date("Y_m_d_H_i_s");
            // $new_file_name = $new_file_name;
            $copied_file_name = $new_file_name.".".$file_ext;
            $uploaded_file = $upload_dir.$copied_file_name;

            if( $upfile_size  > 10000000 ) {
                    echo("
                    <script>
                    alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                    </script>
                    ");
                    exit;
            }

            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file))
            {
                    echo("
                        <script>
                        alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                        history.go(-1)
                        </script>
                    ");
                    exit;
            }
        }
        else 
        {
            $upfile_name      = "";
            $upfile_type      = "";
            $copied_file_name = "";
        }

        //2.DB사용 - sql명령어
        $sql = "INSERT INTO store (userId, store_name, store_address, post_contents, category, recommend_menu, rating, file_copied, post_date) ";
        $sql .= "VALUES ('$userId', '$store_name', '$store_address', '$post_contents', '$category', '$recommend_menu', $rating, '$copied_file_name', '$post_date')";

        mysqli_query($con, $sql);
        
        //3.DB해제
        mysqli_close($con);

        include "geo_convert.php";
    ?>