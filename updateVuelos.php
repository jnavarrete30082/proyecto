<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreVuelo = $nombreAerolinea = $destinoVuelo =  $precioVuelo = "";
$nombreVuelo_err = $nombreAerolinea_err = $destinoVuelo_err = $precioVuelo_err = "";

// Processing form data when form is submitted
if (isset($_POST["idVuelo"]) && !empty($_POST["idVuelo"])) {
    // Get hidden input value
    $idVuelo = $_POST["idVuelo"];

    // Validate nombreVuelo
    $input_nombreVuelo = trim($_POST["nombreVuelo"]);
    if (empty($input_nombreVuelo)) {
        $nombreVuelo_err = "Please enter a name.";
    } elseif (!filter_var($input_nombreVuelo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombreVuelo_err = "Please enter a valid name.";
    } else {
        $nombreVuelo = $input_nombreVuelo;
    }

    // Validate nombreAerolinea
    $input_nombreAerolinea = trim($_POST["nombreAerolinea"]);
    if (empty($input_nombreAerolinea)) {
        $nombreAerolinea_err = "Please enter an address.";
    } else {
        $nombreAerolinea = $input_nombreAerolinea;
    }

    // Validate destinoVuelo
    $input_destinoVuelo = trim($_POST["destinoVuelo"]);
    if (empty($input_destinoVuelo)) {
        $destinoVuelo_err = "Please enter an address.";
    } else {
        $destinoVuelo = $input_destinoVuelo;
    }

    // Validate precioVuelo
    $input_precioVuelo = trim($_POST["precioVuelo"]);
    if (empty($input_precioVuelo)) {
        $precioVuelo_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_precioVuelo)) {
        $precioVuelo_err = "Please enter a positive integer value.";
    } else {
        $precioVuelo = $input_precioVuelo;
    }

    // Check input errors before inserting in database
    if (empty($nombreVuelo_err) && empty($nombreAerolinea_err) && empty($destinoVuelo_err) && empty($precioVuelo_err)) {
        // Prepare an update statement
        $sql = "UPDATE vuelos SET nombreVuelo=:nombreVuelo, nombreAerolinea=:nombreAerolinea, destinoVuelo=:destinoVuelo, precioVuelo=:precioVuelo WHERE idVuelo=:idVuelo";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreVuelo", $param_nombreVuelo);
            $stmt->bindParam(":nombreAerolinea", $param_nombreAerolinea);
            $stmt->bindParam(":destinoVuelo", $param_destinoVuelo);
            $stmt->bindParam(":precioVuelo", $param_precioVuelo);
            $stmt->bindParam(":idVuelo", $param_idVuelo);

            // Set parameters
            $param_nombreVuelo = $nombreVuelo;
            $param_nombreAerolinea = $nombreAerolinea;
            $param_destinoVuelo = $destinoVuelo;
            $param_precioVuelo = $precioVuelo;
            $param_idVuelo = $idVuelo;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
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
    if (isset($_GET["idVuelo"]) && !empty(trim($_GET["idVuelo"]))) {
        // Get URL parameter
        $idVuelo =  trim($_GET["idVuelo"]);

        // Prepare a select statement
        $sql = "SELECT * FROM vuelos WHERE idVuelo = :idVuelo";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idVuelo", $param_idVuelo);

            // Set parameters
            $param_idVuelo = $idVuelo;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $nombreVuelo = $row["nombreVuelo"];
                    $nombreAerolinea = $row["nombreAerolinea"];
                    $destinoVuelo = $row["destinoVuelo"];
                    $precioVuelo = $row["precioVuelo"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
                    <h2 class="mt-5">Actualizar Datos</h2>
                    <p>Por favor edite los datos necesarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombreVuelo" class="form-control <?php echo (!empty($nombreVuelo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreVuelo; ?>">
                            <span class="invalid-feedback"><?php echo $nombreVuelo_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Nomnbre Aerolinea</label>
                            <textarea name="nombreAerolinea" class="form-control <?php echo (!empty($nombreAerolinea_err)) ? 'is-invalid' : ''; ?>"><?php echo $nombreAerolinea; ?></textarea>
                            <span class="invalid-feedback"><?php echo $nombreAerolinea_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Destino</label>
                            <textarea name="destinoVuelo" class="form-control <?php echo (!empty($destinoVuelo_err)) ? 'is-invalid' : ''; ?>"><?php echo $destinoVuelo; ?></textarea>
                            <span class="invalid-feedback"><?php echo $destinoVuelo_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio vuelo</label>
                            <input type="text" name="precioVuelo" class="form-control <?php echo (!empty($precioVuelo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioVuelo; ?>">
                            <span class="invalid-feedback"><?php echo $precioVuelo_err; ?></span>
                        </div>
                        <input type="hidden" name="idVuelo" value="<?php echo $idVuelo; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="listaVuelos.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>