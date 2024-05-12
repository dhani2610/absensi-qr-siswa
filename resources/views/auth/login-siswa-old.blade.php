<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page_title }}</title>

  <style>
    body {
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #222;
}

.login-container {
  background-color: #333;
  padding: 20px;
  border-radius: 40px;
  box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.3);
}

.login-content {
  text-align: center;
  padding: 20px;
}

.welcome-text {
  font-family: "Helvetica Neue", sans-serif;
  font-size: 30px;
  color: #fff;
  margin-bottom: 20px;
}

.input-field {
  display: block;
  width: auto;
  padding: 10px;
  margin: 10px auto;
  border: 1px solid #555;
  border-radius: 15px;
  background-color: #444;
  color: #fff;
}

.login-button {
  display: block;
  width: 100%;
  max-width: 100px;
  padding: 10px;
  margin: 20px auto 10px;
  border: none;
  border-radius: 15px;
  background-color: #0077ff;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.4s ease;
}

.login-button:hover {
  background-color: #0066cc;
  box-shadow: 15px;
  box-shadow: 0px 0px 10 rgba(0, 0, 0, 0.3);
}

.container {
  height: 100vh;
  width: 100%;
  background: linear-gradient(45deg,#d2001a,#7462ff,#f48e21,#23d5ab);
  background-size: 300% 300%;
  animation: color 45s ease-in-out infinite;
}

@keyframes color {
  0% {
    background-position: 0 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0 50%;
  }
}
  </style>
</head>
  <body class="container">  
    <div class="login-container">
      <div class="login-content">
        <h1 class="welcome-text">Selamat Datang</h1>
          <form class="login-form login-form" method="POST" action="{{ route('login-siswa-post') }}" id="login-siswa-post">
            @csrf
            @include('sweetalert::alert')

            <div style="width: 300px" id="reader"></div>
            <input type="hidden" id="result" name="id_siswa">
        </form>
      </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

      
        let currentText = '';
        const onScanSuccess = (decodedText, decodedResult) => {
          console.log(`Scan result: ${decodedText}`, decodedResult);
          $('#result').val(decodedText);
          if (currentText !== decodedText) {
            currentText = decodedText;
            $('#login-siswa-post').submit();
          }
        }

        const html5QrcodeScanner = new Html5QrcodeScanner(
          "reader", { fps: 10, qrbox: 200 });
        html5QrcodeScanner.render(onScanSuccess);

       
    </script>
  </body>
</html>