<header class="main-header">

    <!-- ====================
            LOGOTIPO
    ====================== -->
    <a href="inicio" class="logo">
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="view/img/plantilla/icono-blanco.png" class="img-responsive" style="padding: 10px;">
        </span>
        <!-- logo normal -->

        <span class="logo-lg">
            <img src="view/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding: 10px 0px;">
        </span>
    </a>

    <!-- ======================
        BARRA DE NAVEGACION
    ======================== -->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Botón de navegacion -->
        <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Perfil de usuario -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">

                        <?php 

                            if ($_SESSION['Photo'] != '') {
                                echo '<img src="'.$_SESSION['Photo'].'" class="user-image">';
                            } else {
                                echo '<img src="view/img/users/default/anonymous.png" class="user-image">';
                            }

                        ?>

                        <span class="hidden-xs"><?php echo $_SESSION['Name']?></span>
                        <!-- Dropdown -->
                        <ul class="dropdown-menu">
                            <li class="user-body">
                                <div class="pull-right">
                                    <a href="logout" class="btn btn-default btn-flat">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </a>
                </li>
            </ul>
        </div>

    </nav>

</header>