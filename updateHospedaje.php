<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreHospedaje = $lugarHospedaje = $descripcionHospedaje =  $precioHospedaje = "";
$nombreHospedaje_err = $lugarHospedaje_err = $descripcionHospedaje_err = $precioHospedaje_err = "";

// Processing form data when form is submitted
if (isset($_POST["idHospedaje"]) && !empty($_POST["idHospedaje"])) {
    // Get hidden input value
    $idHospedaje = $_POST["idHospedaje"];

    // Validate nombreHospedaje
    $input_nombreHospedaje = trim($_POST["nombreHospedaje"]);
    if (empty($input_nombreHospedaje)) {
        $nombreHospedaje_err = "Please enter a name.";
    } elseif (!filter_var($input_nombreHospedaje, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombreHospedaje_err = "Please enter a valid name.";
    } else {
        $nombreHospedaje = $input_nombreHospedaje;
    }

    // Validate lugarHospedaje
    $input_lugarHospedaje = trim($_POST["lugarHospedaje"]);
    if (empty($input_lugarHospedaje)) {
        $lugarHospedaje_err = "Please enter an address.";
    } else {
        $lugarHospedaje = $input_lugarHospedaje;
    }

    // Validate descripcionHospedaje
    $input_descripcionHospedaje = trim($_POST["descripcionHospedaje"]);
    if (empty($input_descripcionHospedaje)) {
        $descripcionHospedaje_err = "Please enter an address.";
    } else {
        $descripcionHospedaje = $input_descripcionHospedaje;
    }
    // Validate precioEvento
    $input_precioHospedaje = trim($_POST["precioHospedaje"]);
    if (empty($input_precioHospedaje)) {
        $precioHospedaje_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_precioHospedaje)) {
        $precioHospedaje_err = "Please enter a positive integer value.";
    } else {
        $precioHospedaje = $input_precioHospedaje;
    }

    // Check input errors before inserting in database
    if (empty($nombreHospedaje_err) && empty($lugarHospedaje_err) && empty($descripcionHospedaje_err) && empty($precioHospedaje_err)) {
        // Prepare an update statement
        $sql = "UPDATE hospedaje SET nombreHospedaje=:nombreHospedaje, lugarHospedaje=:lugarHospedaje, descripcionHospedaje=:descripcionHospedaje, precioHospedaje=:precioHospedaje WHERE idHospedaje=:idHospedaje";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreHospedaje", $param_nombreHospedaje);
            $stmt->bindParam(":lugarHospedaje", $param_lugarHospedaje);
            $stmt->bindParam(":descripcionHospedaje", $param_descripcionHospedaje);
            $stmt->bindParam(":precioHospedaje", $param_precioHospedaje);
            $stmt->bindParam(":idHospedaje", $param_idHospedaje);

            // Set parameters
            $param_nombreHospedaje = $nombreHospedaje;
            $param_lugarHospedaje = $lugarHospedaje;
            $param_descripcionHospedaje = $descripcionHospedaje;
            $param_precioHospedaje = $precioHospedaje;
            $param_idHospedaje  = $idHospedaje;


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: listaHospedaje.php");
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
    if (isset($_GET["idHospedaje"]) && !empty(trim($_GET["idHospedaje"]))) {
        // Get URL parameter
        $idHospedaje =  trim($_GET["idHospedaje"]);

        // Prepare a select statement
        $sql = "SELECT * FROM hospedaje WHERE idHospedaje = :idHospedaje";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idHospedaje", $param_idHospedaje);

            // Set parameters
            $param_idHospedaje = $idHospedaje;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $nombreHospedaje = $row["nombreHospedaje"];
                    $lugarHospedaje = $row["lugarHospedaje"];
                    $descripcionHospedaje = $row["descripcionHospedaje"];
                    $precioHospedaje = $row["precioHospedaje"];
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
                    <h2 class="mt-5">Actualizar Datos de eventos</h2>
                    <p>Por favor edite los datos necesarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre del evento</label>
                            <input type="text" name="nombreHospedaje" class="form-control <?php echo (!empty($nombreHospedaje_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreHospedaje; ?>">
                            <span class="invalid-feedback"><?php echo $nombreHospedaje_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lugar del evento</label>
                            <textarea name="lugarHospedaje" class="form-control <?php echo (!empty($lugarHospedaje_err)) ? 'is-invalid' : ''; ?>"><?php echo $lugarHospedaje; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lugarHospedaje_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion del evento</label>
                            <textarea name="descripcionHospedaje" class="form-control <?php echo (!empty($descripcionHospedaje_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionHospedaje; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionHospedaje_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio de evento</label>
                            <input type="text" name="precioHospedaje" class="form-control <?php echo (!empty($precioHospedaje_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioHospedaje; ?>">
                            <span class="invalid-feedback"><?php echo $precioHospedaje_err; ?></span>
                        </div>
                        <input type="hidden" name="idHospedaje" value="<?php echo $idHospedaje; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="listaHospedaje.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>