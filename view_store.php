<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=adc4cfe9f0c4a6fd3571bc294371f05e&libraries=services"></script>
    <style>
        .iw_contents {
            width: 200px;
            padding: 10px;
        }
    </style>
</head>

<body>
<?php include 'header.php' ?>
<?php include 'nav_bar.php' ?>

<div >
    <div id='map' class="display:inline-block" style="width: 1540px; height: 700px;"></div>
    <div style="position: absolute; cursor: default; z-index: 1; margin-bottom: 59%; margin-left:10px; height: 19px; line-height: 14px; left: 0px; bottom: 0px; color: rgb(0, 0, 0);" id="btnSection">
        <button onclick="panTo()">현위치</button> 
    </div>
</div>
    <!-- <div class="display:inline-block" style="background-color:blue; width:10%; height:200px; margin-left:600px" ></div> -->
    <div id="listView">

    </div>
  
    <script>
        var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
            mapOption = {
                center: new kakao.maps.LatLng(35.84820814048089, 128.5820934965743), // 지도의 중심좌표
                level: 4 // 지도의 확대 레벨
            };

        // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);
        function panTo() {
            // 이동할 위도 경도 위치를 생성합니다 
            var moveLatLon = new kakao.maps.LatLng(35.84820814048089, 128.5820934965743);
            
            // 지도 중심을 부드럽게 이동시킵니다
            // 만약 이동할 거리가 지도 화면보다 크면 부드러운 효과 없이 이동합니다
            map.panTo(moveLatLon);            
        }   
    </script>
    <p id="result"></p>
    <?php
    include "db_con.php";

    $sql = "SELECT * FROM store";

    $result = mysqli_query($con, $sql);
    ?>

    <script>
        var positions = [];
    </script>

    <?php
    while ($row = mysqli_fetch_array($result)) {
        // echo $row['store_name'] . "<br>";
        // echo $row[' x'] . "<br>";
        // echo $row['y'] . "<br>";
    ?>
        <script>
            positions.push({
                title: '<?= $row['store_name'] ?>',
                content: 
                    "<div class=iw_contents><?= $row['store_name'] ?><br> 추천메뉴 : <?= $row['recommend_menu']?></div>",
                latlng: new kakao.maps.LatLng(<?= $row['x'] ?>, <?= $row['y'] ?>,
                    coords = new kakao.maps.Coords(<?= $row['x'] ?>, <?= $row['y'] ?>))
            });
            console.log(positions)
        </script>

    <?php
    }
    mysqli_close($con);
    ?>

    <script>
        var markers = [];

        var storeMarkers = [];
      
        var storeImageSrc = './images/markers/markers.png', // 마커이미지의 주소입니다    
            imageSize = new kakao.maps.Size(31, 35), // 마커이미지의 크기입니다
            imageOption = {offset: new kakao.maps.Point(15, 32)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

        var storeImage = new kakao.maps.MarkerImage(storeImageSrc, imageSize, imageOption);
      
        // 마커가 표시될 위치입니다 
        for (var i = 0; i < 36; i++) {
            // 마커를 생성합니다
            var marker = new kakao.maps.Marker({
                // map: map, // 마커를 표시할 지도
                position: positions[i].latlng, // 마커의 위치
                image : storeImage
            });

            // marker.title = positions[i].title;

            // 마커에 표시할 인포윈도우를 생성합니다 
            var infowindow = new kakao.maps.InfoWindow({
                content: positions[i].content, // 인포윈도우에 표시할 내용
            });

            markers.push(marker);

            kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
            kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
            kakao.maps.event.addListener(marker, 'mouseover', markerCircle(map, marker));
            kakao.maps.event.addListener(marker, 'mouseout', clearCircle(map, marker));
            kakao.maps.event.addListener(marker, 'click', circleInMarker(marker, circle));
            kakao.maps.event.addListener(marker, 'click', testClick(marker));

            // 마커가 지도 위에 표시되도록 설정합니다
            marker.setMap(map);
        }

        function testClick(marker) {
            return function() {
           
            }
        }

        // 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
        function makeOverListener(map, marker, infowindow) {
            return function() {
                infowindow.open(map, marker);
            };
        }

        // 인포윈도우를 닫는 클로저를 만드는 함수입니다 
        function makeOutListener(infowindow) {
            return function() {
                infowindow.close();
            };
        }

        var circle;

        kakao.maps.event.addListener(map, 'click', function(mouseEvent) {
            var latlng = mouseEvent.latLng;
            if (circle) {
                circle.setMap(null);
            }
            circle = new kakao.maps.Circle({
                center: new kakao.maps.LatLng(latlng.getLat(), latlng.getLng()), // 원의 중심좌표 입니다
                radius: 1000, // 미터 단위의 원의 반지름입니다 
                strokeWeight: 1, // 선의 두께입니다 
                strokeColor: '#75B8FA', // 선의 색깔입니다
                strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
                strokeStyle: 'line', // 선의 스타일 입니다
                fillColor: '#CFE7FF', // 채우기 색깔입니다
                fillOpacity: 0.7, // 채우기 불투명도 입니다   
            });
            circle.setMap(map)
        });

        var circleInMarker = [];
        function circleInMarker(marker, circle) {
            return function() {
                circleInMarker = [];
                var center = marker.getPosition();
                var radius = 1000;
                var line = new kakao.maps.Polyline();

                markers.forEach(function(marker) {
                    var path = [marker.getPosition(), center];
                    line.setPath(path);

                    var dist = line.getLength();

                    if (dist < 1000) {
                        marker.setMap(map)
                        circleInMarker.push(marker);
                    } else {
                        marker.setMap(null);
                    }

                });
            }

        }

        function clearCircle(map, marker) {
            return function() {
                if (clearCircle) {
                    circle.setMap(null)
                }
            }
        }

        function markerCircle(map, marker) {
            return function() {
                if (circle) {
                    circle.setMap(null);
                }
                circle = new kakao.maps.Circle({
                    center: new kakao.maps.LatLng(marker.getPosition().getLat(), marker.getPosition().getLng()), // 원의 중심좌표 입니다
                    radius: 1000, // 미터 단위의 원의 반지름입니다 dd
                    strokeWeight: 1, // 선의 두께입니다 
                    strokeColor: '#75B8FA', // 선의 색깔입니다
                    strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
                    strokeStyle: 'line', // 선의 스타일 입니다
                    fillColor: '#CFE7FF', // 채우기 색깔입니다
                    fillOpacity: 0.2, // 채우기 불투명도 입니다   
                });
                circle.setMap(map)
            }
        }
    </script>


    <!-- <script>
        function makeMarker() {
            markers.forEach(function(marker) {
                marker.setMap(map);
            });
        }
    </script> -->


    <script>
        function showStore() {

        }
    </script>
</div>
</body>

</html>