<?php
// Process delete operation after confirmation
if (isset($_POST["idCliente"]) && !empty($_POST["idCliente"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM clientes WHERE idCliente  = :idCliente";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":idCliente", $param_idCliente);

        // Set parameters
        $param_idCliente  = trim($_POST["idCliente"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: listaCliente.php");
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
    if (empty(trim($_GET["idCliente"]))) {
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Borrar cliente</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="idCliente" value="<?php echo trim($_GET["idCliente"]); ?>" />
                            <p>Esta seguro de eliminar este cliente?</p>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="listaCliente.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>