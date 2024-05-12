<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <style>
        /*==================== GOOGLE FONTS ====================*/
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap");

/*==================== VARIABLES CSS ====================*/
:root {
  /*========== Colors ==========*/
  --text-color: #000000;
  --bg-color: #222222;

  /*========== Font and typography ==========*/
  --body-font: "Poppins", sans-serif;
  --normal-font-size: 0.938rem;
}

@media screen and (min-width: 968px) {
  :root {
    --normal-font-size: 1rem;
  }
}

/*==================== BASE ====================*/
*,
*:after,
*:before {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  font-size: var(--normal-font-size);
  background-color: var(--bg-color);
  color: var(--text-color);
  font-weight: 400;
  font-family: var(--body-font);
  transition: all 0.2s ease;
}

/*==================== REUSABLE CSS CLASSES ====================*/
.container {
  max-width: 1140px;
  width: 100%;
  margin: 0 auto;
  padding: 3rem 0;
  min-height: 100vh;
  display: grid;
  place-items: center;
}

/*==================== SERVICE CARD ====================*/
.card__container {
  display: flex;
  flex-wrap: wrap;
  gap: 60px;
  justify-content: center;
  width: 100%;
  max-width: 90%;
  margin: auto;
  padding: 60px 0;
}
.card__bx {
  --dark-color: #2e2e2e;
  --dark-alt-color: #777777;
  --white-color: #ffffff;
  --button-color: #333333;
  --transition: 0.5s ease-in-out;

  font-family: inherit;
  height: 350px;
  width: 300px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  background: var(--dark-color);
  transition: var(--transition);
}
.card__bx::before,
.card__bx::after {
  content: "";
  position: absolute;
  z-index: -1;
  transition: var(--transition);
}
.card__bx::before {
  inset: -10px 50px;
  border-top: 4px solid var(--clr);
  transform: skewY(15deg);
  border-bottom: 4px solid var(--clr);
}
.card__bx:hover::before {
  inset: -10px 40px;
  transform: skewY(0deg);
}
.card__bx::after {
  inset: 60px -10px;
  border-left: 4px solid var(--clr);
  transform: skew(15deg);
  border-right: 4px solid var(--clr);
}
.card__bx:hover::after {
  inset: 40px -10px;
  transform: skew(0deg);
}
.card__bx .card__data {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 30px;
  text-align: center;
  padding: 0 20px;
  height: 100%;
  width: 100%;
  overflow: hidden;
}
.card__bx .card__data .card__icon {
  height: 80px;
  width: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 3rem;
  color: var(--text-color);
  background-color: var(--dark-color);
  transition: var(--transition);
}
.card__bx .card__data .card__icon {
  color: var(--clr);
  box-shadow: 0 0 0 4px var(--dark-color), 0 0 0 6px var(--clr);
}
.card__bx:hover .card__data .card__icon {
  color: var(--dark-color);
  background-color: var(--clr);
  box-shadow: 0 0 0 4px var(--dark-color), 0 0 0 300px var(--clr);
}
.card__bx .card__data .card__content {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  gap: 10px;
}
.card__bx .card__data h3 {
  font-size: 1.5rem;
  font-weight: 500;
  color: var(--white-color);
  transition: var(--transition);
}
.card__bx:hover .card__data h3 {
  color: var(--dark-color);
  transition: var(--transition);
}
.card__bx .card__data p {
  font-size: 0.9rem;
  color: var(--dark-alt-color);
  transition: var(--transition);
}
.card__bx:hover .card__data p {
  color: var(--dark-color);
  transition: var(--transition);
}
.card__bx .card__data a {
  position: relative;
  display: inline-flex;
  padding: 8px 15px;
  text-decoration: none;
  font-weight: 500;
  margin-top: 10px;
  border: 2px solid var(--clr);
  color: var(--dark-color);
  background-color: var(--clr);
  transition: var(--transition);
}
.card__bx:hover .card__data a {
  color: var(--clr);
  background-color: var(--dark-color);
}
.card__bx:hover .card__data a:hover {
  border-color: var(--dark-color);
  color: var(--dark-color);
  background-color: var(--clr);
}

    </style>
</head>
<body>
    <section class="container">
        <section class="card__container">
          <div class="card__bx" style="--clr: #89ec5b">
            <div class="card__data">
              <div class="card__icon">
                <i class="fa-solid fa-paintbrush"></i>
              </div>
              <div class="card__content">
                <h3>Login</h3>
                <p>Login Khusus untuk Admin dan Guru.</p>
                <a href="{{ url('login-management') }}">Login</a>
              </div>
            </div>
          </div>
          <div class="card__bx" style="--clr: #5b98eb">
            <div class="card__data">
              <div class="card__icon">
                <i class="fa-brands fa-searchengin"></i>
              </div>
              <div class="card__content">
                <h3>Login QR Code</h3>
                <p>Login Khusus untuk Siswa.</p>
                <a href="{{ url('login-siswa') }}">Login</a>
              </div>
            </div>
          </div>
      
        </section>
      
      </section>
</body>
</html>