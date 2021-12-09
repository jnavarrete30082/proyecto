<?php
// Check existence of id parameter before processing further
if (isset($_GET["idVuelo"]) && !empty(trim($_GET["idVuelo"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM vuelos WHERE idVuelo = :idVuelo";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idVuelo", $param_idVuelo);

        // Set parameters
        $param_idVuelo = trim($_GET["idVuelo"]);

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
                // URL doesn't contain valid id parameter. Redirect to error page
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ver Datos</title>
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
                    <h1 class="mt-5 mb-3">Ver Datos</h1>
                    <div class="form-group">
                        <b><label>Nombre</label></b>
                        <p><?php echo $row["nombreVuelo"]; ?></p>
                    </div>
                    <div class="form-group">
                       <b><label>Nombre Aerolinea</label></b> 
                        <p><?php echo $row["nombreAerolinea"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Destino</label></b>
                        <p><?php echo $row["destinoVuelo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Precio</label></b>
                        <p><?php echo $row["precioVuelo"]; ?></p>
                    </div>
                    <p><a href="listaVuelos.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>