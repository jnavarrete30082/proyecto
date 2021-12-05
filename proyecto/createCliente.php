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
        $motivoCliente_err = "Ingrese los apellidos.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["motivoCliente"]))) {
        $motivoCliente_err = "Motivo no puede ir en blanco";
    } else {
        $motivoCliente = trim($_POST["motivoCliente"]);
    }
    // Validate descripcion
    if (empty(trim($_POST["descripcionCliente"]))) {
        $descripcionCliente_err = "Ingrese los apellidos.";
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
                header("location: listaClientes.php");
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
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" media="all" href="style.css" />
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="hero">
        <div class="hero__title">
            <!-- <div class="wrapper"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mt-5">Crear un nuevo usuario</h2>
                            <p>LLene el formulario para agregar un nuevo usuario a la base de datos.</p>
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
                                    <input type="submit" class="btn btn-primary" value="Ingresar">
                                    <input type="reset" class="btn btn-secondary ml-2" value="Limpiar">
                                    <a class="btn btn-primary" href="listaClientes.php">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>
    <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
</body>

</html>