<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=adc4cfe9f0c4a6fd3571bc294371f05e&libraries=services"></script>
</head>
<body>
    <!-- PHP 작성 -->

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'final_project');

    $sql = "SELECT * FROM store WHERE x is null order by id asc";
    $result = mysqli_query($conn, $sql);

    if($result) {
        ?>

        <script> alert("연결에 성공했습니다.");</script>

    <?php
    }
    else{
    ?>

        <script> alert("연결에 실패했습니다.");</script>

    <?php

    }

    ?>

    <?php
    // SQL을 설정하여 좌표값이 비어있는 id를 순차적으로 조회
    while ($row = mysqli_fetch_array($result)) {

        echo $row['store_address']."<br>";
    ?>

        <script>
            var geocoder = new kakao.maps.services.Geocoder();
        // 주소-좌표 변환 객체를 생성합니다

        // 주소로 좌표를 검색합니다
        geocoder.addressSearch('<?= $row['store_address'] ?>', function(result, status) {

        // 정상적으로 검색이 완료됐으면 
        if (status === kakao.maps.services.Status.OK) {
      
            var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

            console.log(result[0].y + " / " + result[0].x);
          
            save_geo(result[0].y, result[0].x, <?=$row['id'] ?>);
                    
        }
        else {

        }
    });
    </script>

    <?php 
    }

    mysqli_close($conn);
    ?>
<script>
    function save_geo(x, y, id) {
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('target', '_blank');
        form.setAttribute('action', 'save_geo.php');
        document.charset = "UTF-8";

        var hiddenField1 = document.createElement('input');
        hiddenField1.setAttribute('type', 'hidden');
        hiddenField1.setAttribute('name', 'id');
        hiddenField1.setAttribute('value', id);
        var hiddenField2 = document.createElement('input');
        hiddenField2.setAttribute('type', 'hidden');
        hiddenField2.setAttribute('name', 'x');
        hiddenField2.setAttribute('value', x);
        var hiddenField3 = document.createElement('input');
        hiddenField3.setAttribute('type', 'hidden');
        hiddenField3.setAttribute('name', 'y');
        hiddenField3.setAttribute('value', y);

        document.body.appendChild(form);
        form.appendChild(hiddenField1);
        form.appendChild(hiddenField2);
        form.appendChild(hiddenField3);

        form.submit();
    }

</script>

</body>
</html>