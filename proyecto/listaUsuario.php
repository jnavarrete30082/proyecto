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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" media="all" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
        font: 14px sans-serif;
        text-align: center;
      }
    </style>
  </head>
<body>
        <!-- Start of Header-NavBar -->
        <div class="m-4">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <img src="images/logo2.jpg" width="120" height="120" alt="Logo" /> 
          <button
            type="button"
            class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="nav-item">
                <a href="welcome.php" class="nav-link">Inicio</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  >Datos de clientes</a
                >
                <div class="dropdown-menu">
                  <a href="ingresarCliente.php" class="dropdown-item">Ver datos de clientes</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  >Datos de proveedores</a
                >
                <div class="dropdown-menu">
                <a href="alquilerAuto.php" class="dropdown-item">Alquiler de autos</a>
                <a href="#" class="dropdown-item">Entradas a Eventos</a>
                <a href="#" class="dropdown-item">Hospedaje</a>
                  <a href="#" class="dropdown-item">Paquetes de viajes</a>
                  <a href="#" class="dropdown-item">Vuelos</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  >Administracion de usuarios</a
                >
                <div class="dropdown-menu">
                  <a href="register.php" class="dropdown-item">Registrar nuevos usuarios</a>
                  <a href="listaUsuario.php" class="dropdown-item">Lista de usuarios</a>
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  >Perfil</a
                >
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
</body>
</html>