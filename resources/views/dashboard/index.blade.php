@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<style>
@use postcss-color-function;
@use postcss-nested;
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');
<style>
       .master-data {
           cursor: pointer;
       }

       .master-data:hover {
            box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            -webkit-box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            border: 4px solid #0083ff;";
       }
       .info-box {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.50rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            position: relative;
            width: 100%;
        }

        .info-box .info-box-icon {
            border-radius: 0.50rem 0 0 0.50rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-icon > img {
            max-width: 100%;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 15px;
        }

        h1 {
        margin: 20px 10%;
        font-size: 60px;
        letter-spacing: 10px;
        }
        .jam-digital {
        width: 70%;
        margin: 1% 30%;
        }
        #jam span {
        float: left;
        text-align: center;
        font-size: 70px;
        margin: 0 2.5%;
        padding: 20px;
        width: 15%;
        border-radius: 10px;
        box-sizing: border-box;
        }
        #jam span:nth-child(1) {
        background: #0083ff;
        }
        #jam span:nth-child(2) {
        background: #0083ff;
        }
        #jam span:nth-child(3) {
        background: #0083ff;
        }
        #jam::after {
        content: "";
        display: block;
        clear: both;
        }
        #unit span {
        float: left;
        width: 20%;
        margin-top: 30px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 18px;
        text-shadow: white
        }
        span.turn {
        animation: turn 0.7s ease;
        }
        @keyframes turn {
        0% {transform: rotateX(0deg)}
        100% {transform: rotateX(360deg)}
        }
        @media screen and (max-width: 980px){
        #jam span {
            float: left;
            text-align: center;
            font-size: 50px;
            margin: 0 1.5%;
            padding: 20px;
            width: 20%;
        }
        h1 {
            margin: 20px 5%;
        }
        .jam-digital {
            width: 100%;
            margin: 10% 20%;
        }
        #unit span {
            width: 23%;
        }
        }
   </style>
@endsection

@section('breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">home</li>
                        <li class="breadcrumb-item">/</li>              
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    
@endsection

@section('content')
@include('sweetalert::alert')

<div class="row mt-4">
    <div class="jam-digital">
        <div id="jam"></div>
        <div id="unit">
          <span>Jam</span>
          <span>Menit</span>
          <span>Detik</span>
        </div>
     </div>
</div>
@if ($absen_hari_ini == null)
<div class="row mt-4">
    <div class="col-lg-12 col-md-6">
        <div class="row">
            <center>
                <label for="" style="font-size: 23px;font-weight: 600;margin-bottom:0px!important">Scan Barcode Dibawah Ini untuk Absen!</label> <br>
                <small style="color: red">Gunakan Scanner dibawah QR code! (Tidak bisa menggukan scan lain)</small>
                <br>
                <br>
            </center>
            <center>
                {!! QrCode::size(250)->generate(date('Y-m-d')); !!}
            </center>
        </div>
    </div>
</div>
<div class="row mt-4">
    <center>
        <div style="width: 300px" id="reader" ></div>
        <form name="signin" class="form"  method="get" action="{{ route('absen') }}" id="absen">
            <input type="hidden" id="result" name="tanggal">
        </form>

      </center>
</div>
<br>
<br>
<br>
<br>
<br>
@else
<div class="row mt-4">
    <div class="col-lg-12 col-md-6">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12 p-1 mx-auto" >
                <div class="info-box bg-gradient-info master-data">

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black;text-align:center">Anda Sudah Absen Hari ini!</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('script')
<script>
function animation(span) {
   span.className = "turn";
   setTimeout(function () {
      span.className = ""
   }, 700);
}

function jam() {
   setInterval(function () {

      var waktu = new Date();
      var jam   = document.getElementById('jam');
      var hours = waktu.getHours();
      var minutes = waktu.getMinutes();
      var seconds = waktu.getSeconds();

      if (waktu.getHours() < 10)
      {
         hours = '0' + waktu.getHours();
      }
      if (waktu.getMinutes() < 10)
      {
         minutes = '0' + waktu.getMinutes();
      }
      if (waktu.getSeconds() < 10)
      {
         seconds = '0' + waktu.getSeconds();
      }
      jam.innerHTML  = '<span>' + hours + '</span>'
                     + '<span>' + minutes + '</span>'
                     + '<span>' + seconds +'</span>';

      var spans      = jam.getElementsByTagName('span');
      animation(spans[2]);
      if (seconds == 0) animation(spans[1]);
      if (minutes == 0 && seconds == 0) animation(spans[0]);

   }, 1000);
}

jam();

</script>



<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  
    let currentText = '';
    const onScanSuccess = (decodedText, decodedResult) => {
      console.log(`Scan result: ${decodedText}`, decodedResult);
      $('#result').val(decodedText);
      if (currentText !== decodedText) {
        currentText = decodedText;
        console.log(currentText);
        $('#absen').submit();
      }
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
      "reader", { fps: 10, qrbox: 200 });
    html5QrcodeScanner.render(onScanSuccess);

   
</script>
@endsection