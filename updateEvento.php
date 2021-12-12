<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreEvento = $lugarEvento = $descripcionEvento =  $precioEvento = "";
$nombreEvento_err = $lugarEvento_err = $descripcionEvento_err = $precioEvento_err = "";

// Processing form data when form is submitted
if (isset($_POST["idEvento"]) && !empty($_POST["idEvento"])) {
    // Get hidden input value
    $idEvento = $_POST["idEvento"];

    // Validate nombreEvento
    $input_nombreEvento = trim($_POST["nombreEvento"]);
    if (empty($input_nombreEvento)) {
        $nombreEvento_err = "Please enter a name.";
    } elseif (!filter_var($input_nombreEvento, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombreEvento_err = "Please enter a valid name.";
    } else {
        $nombreEvento = $input_nombreEvento;
    }

    // Validate lugarEvento
    $input_lugarEvento = trim($_POST["lugarEvento"]);
    if (empty($input_lugarEvento)) {
        $lugarEvento_err = "Please enter an address.";
    } else {
        $lugarEvento = $input_lugarEvento;
    }

    // Validate descripcionEvento
    $input_descripcionEvento = trim($_POST["descripcionEvento"]);
    if (empty($input_descripcionEvento)) {
        $descripcionEvento_err = "Please enter an address.";
    } else {
        $descripcionEvento = $input_descripcionEvento;
    }
    // Validate precioEvento
    $input_precioEvento = trim($_POST["precioEvento"]);
    if (empty($input_precioEvento)) {
        $precioEvento_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_precioEvento)) {
        $precioEvento_err = "Please enter a positive integer value.";
    } else {
        $precioEvento = $input_precioEvento;
    }

    // Check input errors before inserting in database
    if (empty($nombreEvento_err) && empty($lugarEvento_err) && empty($descripcionEvento_err) && empty($precioEvento_err)) {
        // Prepare an update statement
        $sql = "UPDATE eventos SET nombreEvento=:nombreEvento, lugarEvento=:lugarEvento, descripcionEvento=:descripcionEvento, precioEvento=:precioEvento WHERE idEvento=:idEvento";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreEvento", $param_nombreEvento);
            $stmt->bindParam(":lugarEvento", $param_lugarEvento);
            $stmt->bindParam(":descripcionEvento", $param_descripcionEvento);
            $stmt->bindParam(":precioEvento", $param_precioEvento);
            $stmt->bindParam(":idEvento", $param_idEvento);

            // Set parameters
            $param_nombreEvento = $nombreEvento;
            $param_lugarEvento = $lugarEvento;
            $param_descripcionEvento = $descripcionEvento;
            $param_precioEvento = $precioEvento;
            $param_idEvento  = $idEvento;


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: listaEventos.php");
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
    if (isset($_GET["idEvento"]) && !empty(trim($_GET["idEvento"]))) {
        // Get URL parameter
        $idEvento =  trim($_GET["idEvento"]);

        // Prepare a select statement
        $sql = "SELECT * FROM eventos WHERE idEvento = :idEvento";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idEvento", $param_idEvento);

            // Set parameters
            $param_idEvento = $idEvento;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $nombreEvento = $row["nombreEvento"];
                    $lugarEvento = $row["lugarEvento"];
                    $descripcionEvento = $row["descripcionEvento"];
                    $precioEvento = $row["precioEvento"];
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
                            <input type="text" name="nombreEvento" class="form-control <?php echo (!empty($nombreEvento_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreEvento; ?>">
                            <span class="invalid-feedback"><?php echo $nombreEvento_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lugar del evento</label>
                            <textarea name="lugarEvento" class="form-control <?php echo (!empty($lugarEvento_err)) ? 'is-invalid' : ''; ?>"><?php echo $lugarEvento; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lugarEvento_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion del evento</label>
                            <textarea name="descripcionEvento" class="form-control <?php echo (!empty($descripcionEvento_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionEvento; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionEvento_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio de evento</label>
                            <input type="text" name="precioEvento" class="form-control <?php echo (!empty($precioEvento_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioEvento; ?>">
                            <span class="invalid-feedback"><?php echo $precioEvento_err; ?></span>
                        </div>
                        <input type="hidden" name="idEvento" value="<?php echo $idEvento; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="listaEventos.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>