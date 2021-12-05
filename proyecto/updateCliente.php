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
if (isset($_POST["idCliente"]) && !empty($_POST["idCliente"])) {
    // Get hidden input value
    $id = $_POST["idCliente"];

    // Validate nombre
    $input_nombreCliente  = trim($_POST["nombreCliente "]);
    if (empty($input_nombreCliente)) {
        $nombreCliente_err = "Please enter a name.";
    } elseif (!filter_var($input_nombreCliente, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombreCliente_err = "Por favor ingrese un nombre valido.";
    } else {
        $nombreCliente  = $input_nombreCliente;
    }

    // Validate apellido
    $input_apellidosCliente = trim($_POST["apellidosCliente"]);
    if (empty($input_apellidosCliente)) {
        $apellidosCliente_err = "Por favor ingrese apellidos validos.";
    } else {
        $apellidosCliente = $input_apellidosCliente;
    }
    // Validate correo
    $input_correoCliente = trim($_POST["correoCliente"]);
    if (empty($input_correoCliente)) {
        $correoCliente_err = "Por favor ingrese un correo valido.";
    } else {
        $correoCliente = $input_correoCliente;
    }
    // Validate numero
    $input_celularCliente = trim($_POST["celularCliente"]);
    if (empty($input_celularCliente)) {
        $celularCliente_err = "Por favor ingrese un numero.";
    } elseif (!ctype_digit($input_celularCliente)) {
        $celularCliente_err = "Por favor ingrese un numero valido.";
    } else {
        $celularCliente = $input_celularCliente;
    }
    // Validate motivo
    $input_motivoCliente = trim($_POST["motivoCliente"]);
    if (empty($input_motivoCliente)) {
        $motivoCliente_err = "Por favor ingrese un motivo de consulta valido.";
    } else {
        $motivoCliente = $input_motivoCliente;
    }
    // Validate descripcion
    $input_descripcionCliente = trim($_POST["descripcionCliente"]);
    if (empty($input_descripcionCliente)) {
        $descripcionCliente_err = "Por favor ingrese una descripcion valida.";
    } else {
        $descripcionCliente = $input_descripcionCliente;
    }

    // Check input errors before inserting in database
    if (empty($nombreCliente_err) && empty($apellidosCliente_err) && empty($correoCliente_err) && empty($celularCliente_err) && empty($motivoCliente_err) && empty($descripcionCliente_err)) {
        // Prepare an update statement
        $sql = "UPDATE clientes SET nombreCliente=:nombreCliente, apellidosCliente=:apellidosCliente, 
        correoCliente=:correoCliente, celularCliente=:celularCliente,  motivoCliente=:motivoCliente , 
        descripcionCliente=:descripcionCliente,  WHERE idCliente=:idCliente";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreCliente", $param_nombreCliente);
            $stmt->bindParam(":apellidosCliente", $param_apellidosCliente);
            $stmt->bindParam(":correoCliente", $param_correoCliente);
            $stmt->bindParam(":celularCliente", $param_celularCliente);
            $stmt->bindParam(":motivoCliente", $param_motivoCliente);
            $stmt->bindParam(":descripcionCliente", $param_descripcionCliente);
            $stmt->bindParam(":idCliente", $param_idCliente);

            // Set parameters
            $param_nombreCliente = $nombreCliente;
            $param_apellidosCliente = $apellidosCliente;
            $param_correoCliente = $correoCliente;
            $param_celularCliente = $celularCliente;
            $param_motivoCliente = $motivoCliente;
            $param_descripcionCliente = $descripcionCliente;
            $param_idCliente = $idCliente;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: listaClientes.php");
                exit();
            } else {
                echo "Oops! Algo salio mal, intente luego.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["idCliente"]) && !empty(trim($_GET["idCliente"]))) {
        // Get URL parameter
        $id =  trim($_GET["idCliente"]);

        // Prepare a select statement
        $sql = "SELECT * FROM clientes WHERE idCliente = :idCliente";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idCliente", $param_idCliente);

            // Set parameters
            $param_idCliente = $idCliente;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $nombreCliente = $row["nombreCliente"];
                    $apellidosCliente = $row["apellidosCliente"];
                    $correoCliente = $row["correoCliente"];
                    $celularCliente = $row["celularCliente"];
                    $motivoCliente = $row["motivoCliente"];
                    $descripcionCliente = $row["descripcionCliente"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Algo salio mal, intente luego.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Actualizar Cliente</h2>
                    <p>Por favor rellene los espacios para actualizar al cliente.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="listaClientes.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>