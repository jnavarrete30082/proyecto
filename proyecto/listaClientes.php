<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" media="all" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <style>
    body {
      font: 14px sans-serif;
      text-align: center;
    }

    .wrapper {
      width: 600px;
      margin: 0 auto;
    }

    table tr td:last-child {
      width: 20px;
    }
  </style>
</head>

<body>
  <!-- Start of Header-NavBar -->
  <div class="m-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="container-fluid">
        <img src="images/logo2.jpg" width="120" height="120" alt="Logo" />
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="nav-item">
              <a href="welcome.php" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Datos de clientes</a>
              <div class="dropdown-menu">
                <a href="listaClientes.php" class="dropdown-item">Ver lista de clientes</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Datos de proveedores</a>
              <div class="dropdown-menu">
                <a href="alquilerAuto.php" class="dropdown-item">Alquiler de autos</a>
                <a href="#" class="dropdown-item">Entradas a Eventos</a>
                <a href="#" class="dropdown-item">Hospedaje</a>
                <a href="#" class="dropdown-item">Paquetes de viajes</a>
                <a href="#" class="dropdown-item">Vuelos</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Administracion de usuarios</a>
              <div class="dropdown-menu">
                <a href="register.php" class="dropdown-item">Registrar nuevos usuarios</a>
                <a href="listaUsuario.php" class="dropdown-item">Lista de usuarios</a>
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Perfil</a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="reset-password.php" class="dropdown-item">Cambiar contraseña</a>
                <a href="logout.php" class="dropdown-item">Salir del sistema</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- End of Navbar -->
  <!-- Start of Table -->
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Detalles de usuarios</h2>
            <a href="createCliente.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar un usuario</a>
          </div>
          <?php
          // Include config file
          require_once "config.php";

          // Attempt select query execution
          $sql = "SELECT * FROM clientes";
          if ($result = $pdo->query($sql)) {
            if ($result->rowCount() > 0) {
              echo '<table class="table table-bordered table-striped">';
              echo "<thead>";
              echo "<tr>";
              echo "<th>Id</th>";
              echo "<th>Nombre</th>";
              echo "<th>Apellidos</th>";
              echo "<th>Correo</th>";
              echo "<th>Telefono</th>";
              echo "<th>Motivo</th>";
              echo "<th>Descripcion</th>";
              echo "<th>Action</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while ($row = $result->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['idCliente'] . "</td>";
                echo "<td>" . $row['nombreCliente'] . "</td>";
                echo "<td>" . $row['apellidosCliente'] . "</td>";
                echo "<td>" . $row['correoCliente'] . "</td>";
                echo "<td>" . $row['celularCliente'] . "</td>";
                echo "<td>" . $row['motivoCliente'] . "</td>";
                echo "<td>" . $row['descripcionCliente'] . "</td>";
                echo "<td>";
                echo '<a href="readCliente.php?idCliente=' . $row['idCliente'] . '" class="mr-6" title="Ver registro" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="updateCliente.php?idCliente=' . $row['idCliente'] . '" class="mr-6" title="Actualizar registro" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="deleteCliente.php?idCliente=' . $row['idCliente'] . '" class="mr-6" title="Eliminar registro" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
              // Free result set
              unset($result);
            } else {
              echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
          } else {
            echo "Oops! Something went wrong. Please try again later.";
          }

          // Close connection
          unset($pdo);
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Table -->
</body>

</html>