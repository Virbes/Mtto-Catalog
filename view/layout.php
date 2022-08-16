<?php session_start()?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminT</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="view/img/plantilla/icono-negro.png">

    <!-- ====================
        Plugins de CSS
    ====================== -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="view/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables -->
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <!-- =======================
        Plugins de JavaScript
    =========================== -->
    <!-- jQuery 3 -->
    <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="view/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="view/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- Select Bootstrap -->
    <link rel="stylesheet" href="view/dist/css/bootstrap-select.min.css">

    <script src="view/js/plantilla.js"></script>
    <script src="view/js/usuarios.js"></script>

    <!-- Estilos de Mantenimiento De Catalogos & Datos Personales -->
    <link rel="stylesheet" href="view/css/mtto.css">
</head>

<body class="hold-transition skin-blue sidebar-mini login-page">
    <?php

        if (isset($_SESSION['iniciarSesion']) && isset($_SESSION['iniciarSesion']) == 'ok') {

            echo '<div class="wrapper">';

                include 'modules/header.php';
                include 'modules/menu.php';

                /* Lista de todas las rutas del proyecto */
                $routes = array('inicio', 'usuarios', 'categorias', 'productos', 'clientes', 'ventas', 'crear-venta', 'reportes', 'logout', 'catalogos', 'datos-personales', 'mtto-usuarios', 'change-password');
                
                if (isset($_GET['ruta'])) {
                    
                    if (in_array($_GET['ruta'], $routes)) {
                        include 'modules/'.$_GET['ruta'].'.php';
                    } else {
                        require 'modules/404.php';
                    }

                } else {
                    include 'modules/inicio.php';
                }
                /* fin de la lista */

                include 'modules/footer.php';

            echo '</div>';

        } else {
            include 'modules/login.php';
        }
    ?>
</body>

</html>