<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreCliente = $apellidosCliente = $correoCliente =  $celularCliente = $motivoCliente = $descripcionCliente = "";
$nombreCliente_err = $apellidosCliente_err = $correoCliente_err = $celularCliente_err = $motivoCliente_err = $descripcionCliente_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate nombreCliente
    $input_nombreCliente = trim($_POST["nombreCliente"]);
    if (empty($input_nombreCliente)) {
        $nombreCliente_err = "Please enter a name.";
    } elseif (!filter_var($input_nombreCliente, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombreCliente_err = "Please enter a valid name.";
    } else {
        $nombreCliente = $input_nombreCliente;
    }

    // Validate apellidosCliente
    $input_apellidosCliente = trim($_POST["apellidosCliente"]);
    if (empty($input_apellidosCliente)) {
        $apellidosCliente_err = "Please enter an address.";
    } else {
        $apellidosCliente = $input_apellidosCliente;
    }

    // Validate correoCliente
    $input_correoCliente = trim($_POST["correoCliente"]);
    if (empty($input_correoCliente)) {
        $correoCliente_err = "Please enter an address.";
    } else {
        $correoCliente = $input_correoCliente;
    }
    // Validate celularCliente
    $input_celularCliente = trim($_POST["celularCliente"]);
    if (empty($input_celularCliente)) {
        $celularCliente_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_celularCliente)) {
        $celularCliente_err = "Please enter a positive integer value.";
    } else {
        $celularCliente = $input_celularCliente;
    }

    // Validate motivoCliente
    $input_motivoCliente = trim($_POST["motivoCliente"]);
    if (empty($input_motivoCliente)) {
        $motivoCliente_err = "Please enter an address.";
    } else {
        $motivoCliente = $input_motivoCliente;
    }

    // Validate descripcionCliente
    $input_descripcionCliente = trim($_POST["descripcionCliente"]);
    if (empty($input_descripcionCliente)) {
        $descripcionCliente_err = "Please enter an address.";
    } else {
        $descripcionCliente = $input_descripcionCliente;
    }

    // Check input errors before inserting in database
    if (
        empty($nombreCliente_err) && empty($apellidosCliente_err) && empty($correoCliente_err)
        && empty($celularCliente_err) && empty($motivoCliente_err) && empty($descripcionCliente_err)
    ) {
        // Prepare an insert statement
        $sql = "INSERT INTO clientes (nombreCliente, apellidosCliente, correoCliente, celularCliente, motivoCliente, descripcionCliente) 
        VALUES (:nombreCliente, :apellidosCliente, :correoCliente, :celularCliente, :motivoCliente, :descripcionCliente)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreCliente", $param_nombreCliente);
            $stmt->bindParam(":apellidosCliente", $param_apellidosCliente);
            $stmt->bindParam(":correoCliente", $param_correoCliente);
            $stmt->bindParam(":celularCliente", $param_celularCliente);
            $stmt->bindParam(":motivoCliente", $param_motivoCliente);
            $stmt->bindParam(":descripcionCliente", $param_descripcionCliente);

            // Set parameters
            $param_nombreCliente = $nombreCliente;
            $param_apellidosCliente = $apellidosCliente;
            $param_correoCliente = $correoCliente;
            $param_celularCliente = $celularCliente;
            $param_motivoCliente = $motivoCliente;
            $param_descripcionCliente = $descripcionCliente;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: listaCliente.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear cliente</title>
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
                    <h2 class="mt-5">Crear Cliente</h2>
                    <p>Llene el formulario para un nuevo cliente.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombreCliente" class="form-control <?php echo (!empty($nombreCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreCliente; ?>">
                            <span class="invalid-feedback"><?php echo $nombreCliente_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellidosCliente" class="form-control <?php echo (!empty($apellidosCliente_err)) ? 'is-invalid' : ''; ?>"><?php echo $apellidosCliente; ?></input>
                            <span class="invalid-feedback"><?php echo $apellidosCliente_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="correoCliente" class="form-control <?php echo (!empty($correoCliente_err)) ? 'is-invalid' : ''; ?>"><?php echo $correoCliente; ?></textarea>
                            <span class="invalid-feedback"><?php echo $correoCliente_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="text" name="celularCliente" class="form-control <?php echo (!empty($celularCliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $celularCliente; ?>">
                            <span class="invalid-feedback"><?php echo $celularCliente_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Motivo</label>
                            <input type="text" name="motivoCliente" class="form-control <?php echo (!empty($motivoCliente_err)) ? 'is-invalid' : ''; ?>"><?php echo $motivoCliente; ?></textarea>
                            <span class="invalid-feedback"><?php echo $motivoCliente_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea name="descripcionCliente" class="form-control <?php echo (!empty($descripcionCliente_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionCliente; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionCliente_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <a href="listaCliente.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>