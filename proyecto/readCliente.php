<?php
// Check existence of id parameter before processing further
if (isset($_GET["idCliente"]) && !empty(trim($_GET["idCliente"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM clientes WHERE idCliente = :idCliente";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idCliente", $param_idCliente);

        // Set parameters
        $param_idCliente = trim($_GET["idCliente"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve individual field value
                $nombreCliente = $row["nombreCliente"];
                $apellidosCliente = $row["apellidosCliente"];
                $correoCliente = $row["correoCliente"];
                $celularCliente = $row["celularCliente"];
                $motivoCliente = $row["motivoCliente"];
                $descripcionCliente = $row["descripcionCliente"];
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
                    <h1 class="mt-5 mb-3">Datos del cliente</h1>
                    <div class="form-group">
                        <b><label>Nombre</label></b>
                        <p><?php echo $row["nombreCliente"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Apellidos</label></b>
                        <p><?php echo $row["apellidosCliente"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Email</label></b>
                        <p><?php echo $row["correoCliente"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Celular</label></b>
                        <p><?php echo $row["celularCliente"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Motivo</label></b>
                        <p><?php echo $row["motivoCliente"]; ?></p>
                    </div>
                    <div class="form-group">
                        <b><label>Descripcion</label></b>
                        <p><?php echo $row["descripcionCliente"]; ?></p>
                    </div>
                    <p><a href="listaCliente.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>