<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
    <link rel="stylesheet" media="all" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 900px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <!-- Start of Header-NavBar -->
    <div class="m-4">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <img src="images/logo2.jpg" width="120" height="120" alt="Logo" />
            <h1 style="color: white; text-align: justify; font-size: 28px;">Panel de administracion</h1>
    </div>
    </nav>
    </div>
    <!-- End of Navbar -->
    <br>
    <div class="hero">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Detalles de Clientes</h2>
                            <p></p>
                            <a href="welcome.php" class="btn btn-danger pull-right"></> Volver</a>
                            <a href="createCliente.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar cliente</a>
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
                                echo "<th>#</th>";
                                echo "<th>Nombre</th>";
                                echo "<th>Apellidos</th>";
                                echo "<th>Email</th>";
                                echo "<th>Celular</th>";
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
                                    echo '<a href="readCliente.php?idCliente=' . $row['idCliente'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="updateCliente.php?idCliente=' . $row['idCliente'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="deleteCliente.php?idCliente=' . $row['idCliente'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
    </div>
</body>

</html>