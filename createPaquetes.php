<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombrePaquete = $lugarPaquete = $descripcionPaquete =  $precioPaquete = "";
$nombrePaquete_err = $lugarPaquete_err = $descripcionPaquete_err = $precioPaquete_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        // Prepare an insert statement
        $sql = "INSERT INTO paquetes (nombrePaquete, lugarPaquete, descripcionPaquete, precioPaquete) 
        VALUES (:nombrePaquete, :lugarPaquete, :descripcionPaquete, :precioPaquete)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombrePaquete", $param_nombrePaquete);
            $stmt->bindParam(":lugarPaquete", $param_lugarPaquete);
            $stmt->bindParam(":descripcionPaquete", $param_descripcionPaquete);
            $stmt->bindParam(":precioPaquete", $param_precioPaquete);

            // Set parameters
            $param_nombrePaquete = $nombrePaquete;
            $param_lugarPaquete = $lugarPaquete;
            $param_descripcionPaquete = $descripcionPaquete;
            $param_precioPaquete = $precioPaquete;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crear Paquete</title>
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
                    <h2 class="mt-5">Crear Paquete</h2>
                    <p>Favor de ingresar los datos para un nuevo registro.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre del paquete</label>
                            <input type="text" name="nombrePaquete" class="form-control <?php echo (!empty($nombrePaquete_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombrePaquete; ?>">
                            <span class="invalid-feedback"><?php echo $nombrePaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Lugar del destino</label>
                            <textarea name="lugarPaquete" class="form-control <?php echo (!empty($lugarPaquete_err)) ? 'is-invalid' : ''; ?>"><?php echo $lugarPaquete; ?></textarea>
                            <span class="invalid-feedback"><?php echo $lugarPaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripcion del paquete</label>
                            <textarea name="descripcionPaquete" class="form-control <?php echo (!empty($ddescripcionPaquete_err)) ? 'is-invalid' : ''; ?>"><?php echo $descripcionPaquete; ?></textarea>
                            <span class="invalid-feedback"><?php echo $descripcionPaquete_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Precio de paquete</label>
                            <input type="text" name="precioPaquete" class="form-control <?php echo (!empty($precioPaquete_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $precioPaquete; ?>">
                            <span class="invalid-feedback"><?php echo $precioPaquete_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Agregar">
                        <a href="listaPaquetes.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>