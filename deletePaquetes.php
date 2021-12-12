<?php
// Process delete operation after confirmation
if (isset($_POST["idPaquete"]) && !empty($_POST["idPaquete"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM paquetes WHERE idPaquete = :idPaquete";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idPaquete", $param_idPaquete);

        // Set parameters
        $param_idPaquete = trim($_POST["idPaquete"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: listaPaquetes.php");
            exit();
        } else {
            echo "Oops! Algo salio mal, intente luego.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["idPaquete"]))) {
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
    <title>Borrar Datos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Borrar datos</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="idPaquete" value="<?php echo trim($_GET["idPaquete"]); ?>" />
                            <p>Esta seguro de eliminar este dato?</p>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="listaPaquetes.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>