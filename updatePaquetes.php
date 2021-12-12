<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombrePaquete = $lugarPaquete = $descripcionPaquete =  $precioPaquete = "";
$nombrePaquete_err = $lugarPaquete_err = $descripcionPaquete_err = $precioPaquete_err = "";

// Processing form data when form is submitted
if (isset($_POST["idPaquete"]) && !empty($_POST["idPaquete"])) {
    // Get hidden input value
    $idPaquete = $_POST["idPaquete"];

    // Validate nombrePaquete
    $input_nombrePaquete = trim($_POST["nombrePaquete"]);
    if (empty($input_nombrePaquete)) {
        $nombrePaquete_err = "Please enter a name.";
    } elseif (!filter_var($input_nombrePaquete, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombrePaquete_err = "Please enter a valid name.";
    } else {
        $nombrePaquete = $input_nombrePaquete;
    }

    // Validate lugarPaquete
    $input_lugarPaquete = trim($_POST["lugarPaquete"]);
    if (empty($input_lugarPaquete)) {
        $lugarPaquete_err = "Please enter an address.";
    } else {
        $lugarPaquete = $input_lugarPaquete;
    }

    // Validate descripcionPaquete
    $input_descripcionPaquete = trim($_POST["descripcionPaquete"]);
    if (empty($input_descripcionPaquete)) {
        $descripcionPaquete_err = "Please enter an address.";
    } else {
        $descripcionPaquete = $input_descripcionPaquete;
    }
    // Validate precioPaquete
    $input_precioPaquete = trim($_POST["precioPaquete"]);
    if (empty($input_precioPaquete)) {
        $precioPaquete_err = "Please enter the salary amount.";
    } elseif (!ctype_digit($input_precioPaquete)) {
        $precioPaquete_err = "Please enter a positive integer value.";
    } else {
        $precioPaquete = $input_precioPaquete;
    }

    // Check input errors before inserting in database
    if (empty($nombrePaquete_err) && empty($lugarPaquete_err) && empty($descripcionPaquete_err) && empty($precioPaquete_err)) {
        // Prepare an update statement
        $sql = "UPDATE paquetes SET nombrePaquete=:nombrePaquete, lugarPaquete=:lugarPaquete, descripcionPaquete=:descripcionPaquete, precioPaquete=:precioPaquete WHERE idPaquete=:idPaquete";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombrePaquete", $param_nombrePaquete);
            $stmt->bindParam(":lugarPaquete", $param_lugarPaquete);
            $stmt->bindParam(":descripcionPaquete", $param_descripcionPaquete);
            $stmt->bindParam(":precioPaquete", $param_precioPaquete);
            $stmt->bindParam(":idPaquete", $param_idPaquete);

            // Set parameters
            $param_nombrePaquete = $nombrePaquete;
            $param_lugarPaquete = $lugarPaquete;
            $param_descripcionPaquete = $descripcionPaquete;
            $param_precioPaquete = $precioPaquete;
            $param_idPaquete  = $idPaquete;


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: listaPaquetes.php");
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
    if (isset($_GET["idPaquete"]) && !empty(trim($_GET["idPaquete"]))) {
        // Get URL parameter
        $idPaquete =  trim($_GET["idPaquete"]);

        // Prepare a select statement
        $sql = "SELECT * FROM paquetes WHERE idPaquete = :idPaquete";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":idPaquete", $param_idPaquete);

            // Set parameters
            $param_idPaquete = $idPaquete;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $nombrePaquete = $row["nombrePaquete"];
                    $lugarPaquete = $row["lugarPaquete"];
                    $descripcionPaquete = $row["descripcionPaquete"];
                    $precioPaquete = $row["precioPaquete"];
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Actualizar Datos del paquete</h2>
                    <p>Por favor edite los datos necesarios.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre del paquete</label>
                            <input type="text" name="nombrePaquete" class="form-control <?php echo (!empty($nombrePaquete_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombrePaquete; ?>">
                            <span class="invalid-feedback"><?php echo $nombrePaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lugar del hospedaje</label>
                            <textarea name="lugarPaquete" class="form-control <?php echo (!empty($lugarPaquete_err)) ? 'is-invalid' : ''; ?>"><?php echo $lugarPaquete; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lugarPaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion del paquete</label>
                            <textarea name="descripcionPaquete" class="form-control <?php echo (!empty($descripcionPaquete_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionPaquete; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionPaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio de paquete</label>
                            <input type="text" name="precioPaquete" class="form-control <?php echo (!empty($precioPaquete_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioPaquete; ?>">
                            <span class="invalid-feedback"><?php echo $precioPaquete_err; ?></span>
                        </div>
                        <input type="hidden" name="idPaquete" value="<?php echo $idPaquete; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="listaPaquetes.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>