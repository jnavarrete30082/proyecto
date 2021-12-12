<?php
// Check existence of id parameter before processing further
if (isset($_GET["idEvento"]) && !empty(trim($_GET["idEvento"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM eventos WHERE idEvento = :idEvento";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idEvento", $param_idEvento);

        // Set parameters
        $param_idEvento = trim($_GET["idEvento"]);

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
    <title>Ver Datos Eventos</title>
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
                    <h1 class="mt-5 mb-3">Ver Datos de Eventos</h1>
                    <div class="form-group">
                        <b><label>Nombre del evento</label></b>
                        <p><?php echo $row["nombreEvento"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Lugar del evento</label></b>
                        <p><?php echo $row["lugarEvento"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Descripcion del evento</label></b>
                        <p><?php echo $row["descripcionEvento"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Precio de evento</label></b>
                        <p><?php echo "$", $row["precioEvento"]; ?></p>
                    </div>
                    <p><a href="listaEventos.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>