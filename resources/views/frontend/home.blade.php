<html>
<head>
  <title>AQI HA NOI</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
  <style>
    #aqi_hourly{
      height: 130px;
      text-align: center;
      padding-top: 40px;
      font-size: 40px;
      color: black;

    }
    .color {
      width: 80px;
      height: 30px;
      display: block;
      text-align: center;
      line-height: 30px;
      font-weight: bold;
      color: black;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="">
          AQI
        </a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href=""> Liên hệ </a> </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <div>
          <div>
            <div>
              <div style="text-align: center; font-size: 18px; margin-bottom: 20px;">
                AQI theo giờ vào lúc: {{ date("H:s:i d/m/Y", strtotime($aqiHourly->created_at)) }}
              </div>

            </div>

            <div id="aqi_hourly" style="background-color: {{ $background }}">
              <span>{{ $aqiHourly->aqi }}</span>
            </div>
          </div>
        </div>
      </div>
      {{--<div class="col-md-6">--}}
        {{--<div id="googleMap" style="width:100%;height:400px;"></div>--}}
      {{--</div>--}}
    </div>
    <div style="margin-top: 40px;">
      <div style="text-align: center; font-size: 18px">Chỉ số AQI gần đây</div>
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Thời gian</th>
          <th style="text-align: center">Chỉ số</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listAqi as $aqi)
        <tr>
          <td>{{date("H:s:i d/m/Y", strtotime($aqi->created_at))}}</td>
          <td style="background-color: {{$aqi->background}}; text-align: center">{{$aqi->aqi}}</td>
          <td></td>
        </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div style="margin-top: 50px;">
      <div style="text-align: center; font-size: 30px">Bảng quy đổi giá trị AQI</div>
      <table class="table table-bordered">
        <tbody><tr class="active">
          <th style="width: 100px;">Giá trị AQI</th>
          <th>Chất lượng không khí</th>
          <th>Ảnh hưởng sức khỏe</th>
          <th>Màu</th>
        </tr>
        <tr>
          <td>0-50</td>
          <td>TỐT</td>
          <td>Không ảnh hưởng đến sức khỏe</td>
          <td><label class="color" style="background-color: blue">XANH</label></td>
        </tr>
        <tr>
          <td>51-100</td>
          <td>TRUNG BÌNH</td>
          <td>Nhóm nhạy cảm nên hạn chế thời gian ở ngoai</td>
          <td><label class="color" style="background-color: yellow">VÀNG</label></td>
        </tr>
        <tr>
          <td>101-200</td>
          <td>KÉM</td>
          <td>Nhóm nhạy cảm cần hạn chế thời gian ở ngoai</td>
          <td><label class="color" style="background-color: orange">DA CAM</label></td>
        </tr>
        <tr>
          <td>201-300</td>
          <td>XẤU</td>
          <td>Nhóm nhạy cảm tránh ra ngoài, nhừng người khác hạn chế ở ngoài</td>
          <td><label class="color" style="background-color: red">ĐỎ</label></td>
        </tr>
        <tr>
          <td>Từ 301</td>
          <td>RẤT XẤU</td>
          <td>Mọi người nên ở trong nhà</td>
          <td><label class="color" style="background-color: brown">NÂU</label></td>
        </tr>
        </tbody></table>
    </div>
  </div>
</body>
<script>

  function initMap() {
    //Cau hinh google map
    var mapProp= {
      // Vi tri toa do se hien thi khi khoi tao
      center:new google.maps.LatLng(21.0015176,105.8437417),
      // Muc do zoom
      zoom:13
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    return map;
  }
  function myMap() {
//    var myCenter = google.maps.LatLng(21.0015176,105.8437417);
    var myLatLng = {
      lat : 21.0015176,
      lng : 105.8437417
    };

    var map = initMap();
    var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
    var marker =new google.maps.Marker({
      position : myLatLng,
      map : map,
      label : '2',
      title : 'hello',
      icon : image

    });

    var infoWindow = new google.maps.InfoWindow({
      content : '<div id="infoAqi">hello</div>',
      position : myLatLng
    });
    google.maps.event.addListener(marker, 'click', function () {
      infoWindow.open(map, marker);
    })

  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRVe5MRoesoQe6ZZ5RgTPdwuciree4Ixk&callback=myMap&language=vi"></script>
</html>