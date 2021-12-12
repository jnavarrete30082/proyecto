<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$marcaAuto = $tipoAuto = $descripcionAuto =  $precioAuto = "";
$marcaAuto_err = $tipoAuto_err = $descripcionAuto_err = $precioAuto_err = "";

// Processing form data when form is submitted
if (isset($_POST["idAuto"]) && !empty($_POST["idAuto"])) {
    // Get hidden input value
    $idAuto = $_POST["idAuto"];

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
        // Prepare an update statement
        $sql = "UPDATE autos SET marcaAuto=:marcaAuto, tipoAuto=:tipoAuto, descripcionAuto=:descripcionAuto, precioAuto=:precioAuto WHERE idAuto=:idAuto";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":marcaAuto", $param_marcaAuto);
            $stmt->bindParam(":tipoAuto", $param_tipoAuto);
            $stmt->bindParam(":descripcionAuto", $param_descripcionAuto);
            $stmt->bindParam(":precioAuto", $param_precioAuto);
            $stmt->bindParam(":idAuto", $param_idAuto);

            // Set parameters
            $param_marcaAuto = $marcaAuto;
            $param_tipoAuto = $tipoAuto;
            $param_descripcionAuto = $descripcionAuto;
            $param_precioAuto = $precioAuto;
            $param_idAuto = $idAuto;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: listaAutos.php");
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["idAuto"]) && !empty(trim($_GET["idAuto"]))) {
        // Get URL parameter
        $idAuto =  trim($_GET["idAuto"]);

        // Prepare a select statement
        $sql = "SELECT * FROM autos WHERE idAuto = :idAuto";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idAuto", $param_idAuto);

            // Set parameters
            $param_idAuto = $idAuto;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $marcaAuto = $row["marcaAuto"];
                    $tipoAuto = $row["tipoAuto"];
                    $descripcionAuto = $row["descripcionAuto"];
                    $precioAuto = $row["precioAuto"];
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
    <title>Actualizar Datos</title>
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
                    <h2 class="mt-5">Actualizar Datos de vehiculos</h2>
                    <p>Por favor edite los datos necesarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="marcaAuto" class="form-control <?php echo (!empty($marcaAuto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $marcaAuto; ?>">
                            <span class="invalid-feedback"><?php echo $marcaAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nomnbre Aerolinea</label>
                            <textarea name="tipoAuto" class="form-control <?php echo (!empty($tipoAuto_err)) ? 'is-invalid' : ''; ?>"><?php echo $tipoAuto; ?></textarea>
                            <span class="invalid-feedback"><?php echo $tipoAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Destino</label>
                            <textarea name="descripcionAuto" class="form-control <?php echo (!empty($descripcionAuto_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionAuto; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionAuto_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio vuelo</label>
                            <input type="text" name="precioAuto" class="form-control <?php echo (!empty($precioAuto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioAuto; ?>">
                            <span class="invalid-feedback"><?php echo $precioAuto_err; ?></span>
                        </div>
                        <input type="hidden" name="idAuto" value="<?php echo $idAuto; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="listaAutos.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>