<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nombreCliente = "";
$apellidosCliente = "";
$correoCliente = "";
$celularCliente = "";
$motivoCliente = "";
$descripcionCliente = "";

$nombreCliente_err = $apellidosCliente_err = $correoCliente_err = $celularCliente_err = $motivoCliente_err = $descripcionCliente_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Cliente
    if (empty(trim($_POST["nombreCliente"]))) {
        $nombreCliente_err = "Ingrese un usuario.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nombreCliente"]))) {
        $nombreCliente_err = "Usuario no puede ir en blanco";
    } else {
        $nombreCliente = trim($_POST["nombreCliente"]);
    }
    // Validate apellido
    if (empty(trim($_POST["apellidosCliente"]))) {
        $apellidosCliente_err = "Ingrese los apellidos.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["apellidosCliente"]))) {
        $apellidosCliente_err = "Apellidos no puede ir en blanco";
    } else {
        $apellidosCliente = trim($_POST["apellidosCliente"]);
    }

    // Validate correo
    if (empty(trim($_POST["correoCliente"]))) {
        $correoCliente_err = "Ingrese un correo.";
    } else {
        $correoCliente = trim($_POST["correoCliente"]);
    }
    // Validate celular
    if (empty(trim($_POST["celularCliente"]))) {
        $celularCliente_err = "Ingrese un numero valido.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["celularCliente"]))) {
        $celularCliente_err = "Celular no puede ir en blanco";
    } else {
        $celularCliente = trim($_POST["celularCliente"]);
    }
    // Validate motivo
    if (empty(trim($_POST["motivoCliente"]))) {
        $motivoCliente_err = "Ingrese los apellidos.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["motivoCliente"]))) {
        $motivoCliente_err = "Motivo no puede ir en blanco";
    } else {
        $motivoCliente = trim($_POST["motivoCliente"]);
    }
    // Validate descripcion
    if (empty(trim($_POST["descripcionCliente"]))) {
        $descripcionCliente_err = "Ingrese los apellidos.";
    } {
        $descripcionCliente = trim($_POST["descripcionCliente"]);
    }
    // Check input errors before inserting in database
    if (empty($nombreCliente_err) && empty($apellidosCliente_err) && empty($correoCliente_err) && empty($celularCliente_err) && empty($motivoCliente_err) && empty($descripcionCliente_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO clientes (nombreCliente, apellidosCliente,correoCliente,celularCliente,motivoCliente,descripcionCliente) 
        VALUES (:nombreCliente, :apellidosCliente,:correoCliente,:celularCliente,:motivoCliente,:descripcionCliente)";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":nombreCliente", $param_nombreCliente, PDO::PARAM_STR);
            $stmt->bindParam(":apellidosCliente", $param_apellidosCliente, PDO::PARAM_STR);
            $stmt->bindParam(":correoCliente", $param_correoCliente, PDO::PARAM_STR);
            $stmt->bindParam(":celularCliente", $param_celularCliente, PDO::PARAM_INT);
            $stmt->bindParam(":motivoCliente", $param_motivoCliente, PDO::PARAM_STR);
            $stmt->bindParam(":descripcionCliente", $param_descripcionCliente, PDO::PARAM_STR);

            // Set parameters
            $param_nombreCliente = $nombreCliente;
            $param_apellidosCliente = $apellidosCliente;
            $param_correoCliente = $correoCliente;
            $param_celularCliente = $celularCliente;
            $param_motivoCliente = $motivoCliente;
            $param_descripcionCliente = $descripcionCliente;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to Contact page
                header("location: contactoPage.php");
            } else {
                echo "Oops! Algo salio mal, intente luego.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>
