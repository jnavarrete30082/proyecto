<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreCliente = "";
$apellidosCliente = "";
$correoCliente = "";
$celularCliente = "";
$motivoCliente = "";
$descripcionCliente = "";

$nombreCliente_err = $apellidosCliente_err = $correoCliente_err = $celularCliente_err = $motivoCliente_err = $descripcionCliente_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Cliente
    if (empty(trim($_POST["nombreCliente"]))) {
        $nombreCliente_err = "Ingrese un usuario.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nombreCliente"]))) {
        $nombreCliente_err = "Usuario no puede ir en blanco";
    } else {
        $nombreCliente = trim($_POST["nombreCliente"]);
    }
    // Validate apellido
    if (empty(trim($_POST["apellidosCliente"]))) {
        $apellidosCliente_err = "Ingrese los apellidos.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["apellidosCliente"]))) {
        $apellidosCliente_err = "Apellidos no puede ir en blanco";
    } else {
        $apellidosCliente = trim($_POST["apellidosCliente"]);
    }

    // Validate correo
    if (empty(trim($_POST["correoCliente"]))) {
        $correoCliente_err = "Ingrese un correo.";
    } else {
        $correoCliente = trim($_POST["correoCliente"]);
    }
    // Validate celular
    if (empty(trim($_POST["celularCliente"]))) {
        $celularCliente_err = "Ingrese un numero valido.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["celularCliente"]))) {
        $celularCliente_err = "Celular no puede ir en blanco";
    } else {
        $celularCliente = trim($_POST["celularCliente"]);
    }
    // Validate motivo
    if (empty(trim($_POST["motivoCliente"]))) {
        $motivoCliente_err = "Ingrese un motivo.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["motivoCliente"]))) {
        $motivoCliente_err = "Motivo no puede ir en blanco";
    } else {
        $motivoCliente = trim($_POST["motivoCliente"]);
    }
    // Validate descripcion
    if (empty(trim($_POST["descripcionCliente"]))) {
        $descripcionCliente_err = "Ingrese un mensaje.";
    } {
        $descripcionCliente = trim($_POST["descripcionCliente"]);
    }
    // Check input errors before inserting in database
    if (empty($nombreCliente_err) && empty($apellidosCliente_err) && empty($correoCliente_err) && empty($celularCliente_err) && empty($motivoCliente_err) && empty($descripcionCliente_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO clientes (nombreCliente, apellidosCliente,correoCliente,celularCliente,motivoCliente,descripcionCliente) 
        VALUES (:nombreCliente, :apellidosCliente,:correoCliente,:celularCliente,:motivoCliente,:descripcionCliente)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreCliente", $param_nombreCliente, PDO::PARAM_STR);
            $stmt->bindParam(":apellidosCliente", $param_apellidosCliente, PDO::PARAM_STR);
            $stmt->bindParam(":correoCliente", $param_correoCliente, PDO::PARAM_STR);
            $stmt->bindParam(":celularCliente", $param_celularCliente, PDO::PARAM_INT);
            $stmt->bindParam(":motivoCliente", $param_motivoCliente, PDO::PARAM_STR);
            $stmt->bindParam(":descripcionCliente", $param_descripcionCliente, PDO::PARAM_STR);

            // Set parameters
            $param_nombreCliente = $nombreCliente;
            $param_apellidosCliente = $apellidosCliente;
            $param_correoCliente = $correoCliente;
            $param_celularCliente = $celularCliente;
            $param_motivoCliente = $motivoCliente;
            $param_descripcionCliente = $descripcionCliente;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: index.php");
            } else {
                echo "Oops! Algo salio mal, intente luego.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>
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
                        <a class="nav-link" href="">Alquiler de Autos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="">Entradas a Eventos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="">Hospedaje</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="">Paquetes de Viajes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="">Vuelos</a>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombreCliente" class="form-control <?php echo (!empty($nombreCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreCliente; ?>">
                    <span class="invalid-feedback"><?php echo $nombreCliente_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidosCliente" class="form-control <?php echo (!empty($apellidosCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellidosCliente; ?>">
                    <span class="invalid-feedback"><?php echo $apellidosCliente_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="correoCliente" class="form-control <?php echo (!empty($correoCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $correoCliente; ?>">
                    <span class="invalid-feedback"><?php echo $correoCliente_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Número telefónico</label>
                    <input type="phone" name="celularCliente" class="form-control <?php echo (!empty($celularCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $celularCliente; ?>">
                    <span class="invalid-feedback"><?php echo $celularCliente_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Motivo</label>
                    <input type="text" name="motivoCliente" class="form-control <?php echo (!empty($motivoCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $motivoCliente; ?>">
                    <span class="invalid-feedback"><?php echo $motivoCliente_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Mensaje</label>
                    <input type="text" name="descripcionCliente" class="form-control <?php echo (!empty($descripcionCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $descripcionCliente; ?>">
                    <span class="invalid-feedback"><?php echo $descripcionCliente_err; ?></span>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
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