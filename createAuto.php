<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$marcaAuto = $tipoAuto = $descripcionAuto =  $precioAuto = "";
$marcaAuto_err = $tipoAuto_err = $descripcionAuto_err = $precioAuto_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate marcaAuto
    $input_marcaAuto = trim($_POST["marcaAuto"]);
    if (empty($input_marcaAuto)) {
        $marcaAuto_err = "Please enter a name.";
    } elseif (!filter_var($input_marcaAuto, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $marcaAuto_err = "Please enter a valid name.";
    } else {
        $marcaAuto = $input_marcaAuto;
    }

    // Validate tipoAuto
    $input_tipoAuto = trim($_POST["tipoAuto"]);
    if (empty($input_tipoAuto)) {
        $tipoAuto_err = "Please enter an address.";
    } else {
        $tipoAuto = $input_tipoAuto;
    }

    // Validate descripcionAuto
    $input_descripcionAuto = trim($_POST["descripcionAuto"]);
    if (empty($input_descripcionAuto)) {
        $descripcionAuto_err = "Please enter an address.";
    } else {
        $descripcionAuto = $input_descripcionAuto;
    }
    // Validate precioAuto
    $input_precioAuto = trim($_POST["precioAuto"]);
    if (empty($input_precioAuto)) {
        $precioAuto_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_precioAuto)) {
        $precioAuto_err = "Please enter a positive integer value.";
    } else {
        $precioAuto = $input_precioAuto;
    }

    // Check input errors before inserting in database
    if (empty($marcaAuto_err) && empty($tipoAuto_err) && empty($descripcionAuto_err) && empty($precioAuto_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO autos (marcaAuto, tipoAuto,descripcionAuto, precioAuto) 
        VALUES (:marcaAuto, :tipoAuto, :descripcionAuto, :precioAuto)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":marcaAuto", $param_marcaAuto);
            $stmt->bindParam(":tipoAuto", $param_tipoAuto);
            $stmt->bindParam(":descripcionAuto", $param_descripcionAuto);
            $stmt->bindParam(":precioAuto", $param_precioAuto);

            // Set parameters
            $param_marcaAuto = $marcaAuto;
            $param_tipoAuto = $tipoAuto;
            $param_descripcionAuto = $descripcionAuto;
            $param_precioAuto = $precioAuto;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: listaAutos.php");
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear Auto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Start of Header-NavBar -->
    <div class="m-4">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <img src="images/logo2.jpg" width="120" height="120" alt="Logo" />
            <h1 style="color: white; text-align: justify;font-size: 28px;">Panel de administracion</h1>
    </div>
    </nav>
    </div>
    <!-- End of Navbar -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear auto</h2>
                    <p>Favor de ingresar los datos para un nuevo registro.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Marca del vehiculo</label>
                            <input type="text" name="marcaAuto" class="form-control <?php echo (!empty($marcaAuto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marcaAuto; ?>">
                            <span class="invalid-feedback"><?php echo $marcaAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Tipo de vehiculo</label>
                            <textarea name="tipoAuto" class="form-control <?php echo (!empty($tipoAuto_err)) ? 'is-invalid' : ''; ?>"><?php echo $tipoAuto; ?></textarea>
                            <span class="invalid-feedback"><?php echo $tipoAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion del vehiculo</label>
                            <textarea name="descripcionAuto" class="form-control <?php echo (!empty($descripcionAuto_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionAuto; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio de alquiler</label>
                            <input type="text" name="precioAuto" class="form-control <?php echo (!empty($precioAuto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioAuto; ?>">
                            <span class="invalid-feedback"><?php echo $precioAuto_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Agregar">
                        <a href="listaAutos.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>