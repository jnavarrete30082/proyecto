<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Viajes Internacionales Contacto</title>
    <style>
        .container {
            display: block;
            box-sizing: border-box;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .form {
            width: 450px;
        }

        div.elem-group {
            margin: 40px 0;
        }

        label {
            display: block;
            font-family: 'Aleo';
            padding-bottom: 4px;
            font-size: 1.25em;
        }

        input,
        select,
        textarea {
            border-radius: 2px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 1.25em;
            font-family: 'Aleo';
            width: 500px;
            padding: 8px;
        }

        textarea {
            height: 250px;
        }

        button {
            height: 50px;
            background: green;
            color: white;
            border: 2px solid darkgreen;
            font-size: 1.25em;
            font-family: 'Aleo';
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            border: 2px solid black;
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
          <!-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
            Iniciar sesion -->
          </button>
        </form>
      </div>
    </nav>
    <!-- End of Navbar -->
    </div>
    </div>

    <!-- Start of Form -->
    <div class="container">
        <div class="abs-center">
            <img src="images/boarding pass.gif" alt="tiquete" style="padding-left: -70%;">
            <br>
            <form action="contact.php" method="post">
                <div class="elem-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
                </div>
                <div class="elem-group">
                    <label for="email">Your E-mail</label>
                    <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
                </div>
                <div class="elem-group">
                    <label for="title">Reason For Contacting Us</label>
                    <input type="text" id="title" name="email_title" required placeholder="Unable to Reset my Password" pattern=[A-Za-z0-9\s]{8,60}>
                </div>
                <div class="elem-group">
                    <label for="message">Write your message</label>
                    <textarea id="message" name="visitor_message" placeholder="Say whatever you want." required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
    <br>
    <!-- End of Form -->
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
</body>

</html>