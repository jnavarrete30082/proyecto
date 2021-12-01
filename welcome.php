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
  <meta charset="UTF-8">
  <title>Bienvenido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
  rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <style>
    body {
      font: 14px sans-serif;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Start of Header-NavBar -->
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="images/logo2.jpg" width="120" height="120" alt="Logo" />
      </a>
      <a class="navbar-brand" href="">TRAVEL</a>
      <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="">Inicio</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Datos de contactos</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="">Mantenimiento de usuarios</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="reset-password.php" class="btn btn-warning">Reestablecer contraseña</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="logout.php" class="btn btn-danger ml-3">Salir del sistema</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- End of Navbar -->
  <div>
    <h1 class="my-5">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido.</h1>
  </div>
</body>

</html>