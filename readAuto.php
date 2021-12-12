<?php
// Check existence of id parameter before processing further
if (isset($_GET["idAuto"]) && !empty(trim($_GET["idAuto"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM autos WHERE idAuto = :idAuto";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idAuto", $param_idAuto);

        // Set parameters
        $param_idAuto = trim($_GET["idAuto"]);

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
                // URL doesn't contain valid id parameter. Redirect to error page
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ver Datos autos</title>
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
                    <h1 class="mt-5 mb-3">Ver Datos de autos</h1>
                    <div class="form-group">
                        <b><label>Marca del vehiculo</label></b>
                        <p><?php echo $row["marcaAuto"]; ?></p>
                    </div>
                    <div class="form-group">
                       <b><label>Tipo de vehiculo</label></b> 
                        <p><?php echo $row["tipoAuto"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Descripcion del vehiculo</label></b>
                        <p><?php echo $row["descripcionAuto"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Precio de alquiler</label></b>
                        <p><?php echo "$", $row["precioAuto"]; ?></p>
                    </div>
                    <p><a href="listaAutos.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>