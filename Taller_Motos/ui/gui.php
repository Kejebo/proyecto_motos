<?php

require_once('ln/ln_security.php');

class Gui
{

    var $ln_security;
    var $config;
    function __construct($config)
    {
        $this->ln_security = new ln_security();


        if ($config) {
            $this->config = $config;
        }

        $this->ln_security->check_tipo_login_admin();
    }
    function get_header()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta name="google" content="notranslate">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mighty motors</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
            <link rel="stylesheet" href="assets/css/styles.css">
            <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        </head>

    <?php
    }
    function get_sidebar()
    {
    ?>

        <body>

            <div class="wrapper">
                <div class="sidebar">
                    <div>
                        <h2>Sidebar</h2>
                    </div>
                    <ul>
                        <li><a href="inventary.php"><i class="fas fa-boxes"></i> Inventario</a></li>
                        <li><a href="repairs.php"><i class="fas fa-tools"></i> Reparacion</a></li>
                        <li><a href="purchases.php"><i class="fas fa-shopping-cart"></i> Compras</a></li>
                        <li><a href="sales.php"><i class="fas fa-cash-register"></i> Ventas</a></li>
                        <li><a href="clients.php"><i class="fas fa-users"></i> Clientes</a></li>
                        <li><a href="motorcycle.php"><i class="fas fa-tools"></i> Motos</a></li>
                        <li><a href="proveedores.php"><i class="fas fa-user-tie"></i> Proveedores</a></li>
                        <li><a href="users.php"><i class="far fa-address-book"></i> Usuarios</a></li>
                        <li><a href="reportes.php"><i class="fas fa-user-cog"></i> Ajustes</a></li>
                    </ul>

                </div>
                <div class="main_content">

                <?php
            }
            function get_nabvar()
            {
                ?>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" id="modulo"><?= $this->config['titulo']; ?></a>
                        <div class="container-fluid" id="cerrar_sesion_contenedor">
                        <form action="security.php?action=logout" method="post">
                        <button class="btn btn-success" id="boton_cerrar_sesion"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</button>
                        </form>
                        </div>
                        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="my-nav" class="collapse navbar-collapse">
                            <ul class="navbar-nav mr-auto">

                                <li class="nav-item">
                                    <a class="nav-link" href="inventary.php">Inventario</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="repairs.php"></i> Reparacion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="purchases.php">Compras</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="sales.php">Ventas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="motorcycle.php"></i> Motos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="clients.php">Clientes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="proveedores.php">Proveedores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="users.php">Usuarios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="reportes.php">Ajustes</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                <?php
            }
            function get_footer()
            {
                ?>
                    <footer>
                        <div class="container">
                            <p>Derechos Reservados <strong>Gesy</strong></p>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="assets/js/main.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script src="assets/js/datatables.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
            <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>

        </body>

        </html>
<?php
            }
        }
?>
