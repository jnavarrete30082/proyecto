<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <title>Viajes Internacionales</title>
  <style>
    body {
      font-family: Arial;
      margin: 0;
    }

    * {
      box-sizing: border-box;
    }

    img {
      vertical-align: middle;
    }

    /* Position the image container (needed to position the left and right arrows) */
    .container {
      position: relative;
    }

    /* Hide the images by default */
    .mySlides {
      display: none;
    }

    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
      cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 40%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }

    /* Container for image text */
    .caption-container {
      text-align: center;
      background-color: #222;
      padding: 2px 16px;
      color: white;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Six columns side by side */
    .column {
      float: left;
      width: 16.66%;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
      opacity: 0.6;
    }

    .active,
    .demo:hover {
      opacity: 1;
    }

    /* Float the link section to the right */
    .header-right {
      float: right;
    }

    /*Start style of Header-NavBar*/
    /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }
  </style>
</head>

<body>
  <!-- Start of Header-NavBar -->
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="images/logo2.jpg" width="120" height="120" alt="Logo" />
      </a>
      <a class="navbar-brand" href="">TRAVEL</a>
      <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Vuelos</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Alquiler de Autos</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Paquetes de Viajes</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Entradas a Eventos</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Hospedaje</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Quienes somos?</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="contactoPage.php">Contactenos</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <a href="login.php" class="btn btn-outline-primary my-2 my-sm-0">Iniciar sesion</a>
          <!-- Iniciar sesion -->
        </form>
      </div>
    </nav>
    <!-- End of Navbar -->
  </div>
  <div>

  </div>
  <!-- Start Content -->
  <h2 style="text-align: center">Nuestros lugares favoritos</h2>

  <div class="container">
    <div class="mySlides">
      <div class="numbertext">1 / 6</div>
      <img src="images/img_woods_wide.jpg" style="width: 100%" />
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 6</div>
      <img src="images/img_cinqueterre_wide.jpg" style="width: 100%" />
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 6</div>
      <img src="images/img_mountains_wide.jpg" style="width: 100%" />
    </div>

    <div class="mySlides">
      <div class="numbertext">4 / 6</div>
      <img src="images/img_lights_wide.jpg" style="width: 100%" />
    </div>

    <div class="mySlides">
      <div class="numbertext">5 / 6</div>
      <img src="images/img_nature_wide.jpg" style="width: 100%" />
    </div>

    <div class="mySlides">
      <div class="numbertext">6 / 6</div>
      <img src="images/img_snow_wide.jpg" style="width: 100%" />
    </div>

    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <div class="row">
      <div class="column">
        <img class="demo cursor" img src="images/img_woods.jpg" style="width: 100%" onclick="currentSlide(1)" alt="Ubicados en una casa rural con vistas al bosque" />
      </div>
      <div class="column">
        <img class="demo cursor" img src="images/img_cinqueterre.jpg" style="width: 100%" onclick="currentSlide(2)" alt="Cinque Terre" />
      </div>
      <div class="column">
        <img class="demo cursor" img src="images/img_mountains.jpg" style="width: 100%" onclick="currentSlide(3)" alt="Mountains and fjords" />
      </div>
      <div class="column">
        <img class="demo cursor" img src="images/img_lights.jpg" style="width: 100%" onclick="currentSlide(4)" alt="Northern Lights" />
      </div>
      <div class="column">
        <img class="demo cursor" img src="images/img_nature.jpg" style="width: 100%" onclick="currentSlide(5)" alt="Nature and sunrise" />
      </div>
      <div class="column">
        <img class="demo cursor" img src="images/img_snow.jpg" style="width: 100%" onclick="currentSlide(6)" alt="Snowy Mountains" />
      </div>
    </div>
  </div>
  <br>
  <br>
  <!-- End Content -->
  <!-- Start of Footer -->
  <footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Start Section: Images -->
      <section class="">
        <div class="row">
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/113.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/111.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/112.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/114.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/115.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
          <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-ripple-color="light">
              <img src="https://mdbootstrap.com/img/new/fluid/city/116.jpg" class="w-100" />
              <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- End Section: Images -->
      <br />
      <!-- Start Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-facebook"></i></a>
        <!-- Twitter -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-twitter"></i></a>
        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-instagram"></i></a>
        <!-- Google -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fa fa-google"></i></a>
      </section>
      <!-- End Section: Social media -->
    </div>
    <!-- Grid container -->
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="">Los Mejores Programadores</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- End of Footer -->
  <!-- Start Bootstrap 5 Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <!-- Start Body Scripts -->
  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides((slideIndex += n));
    }

    function currentSlide(n) {
      showSlides((slideIndex = n));
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      captionText.innerHTML = dots[slideIndex - 1].alt;
    }
  </script>
  <!-- End Body Scripts -->
  <!-- End Bootstrap 5 Scripts -->
</body>

</html>
