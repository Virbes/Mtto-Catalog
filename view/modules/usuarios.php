<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Administrar Usuarios
        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar usuarios</li>
        </ol>
    </section>


    <section class="content">
        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
                    Agregar Usuario
                </button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">

                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php /*
                            $users = ControllerUsers::getUsers();
                            

                            foreach ($users as $value) {
                                echo '
                                <tr>
                                    <td>'.$value['id_user'].'</td>
                                    <td>'.$value['Name'].'</td>
                                    <td>'.$value['Username'].'</td>';
                                    if ($value['Photo'] == '') {
                                        echo '<td><img src="view/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                                    } else {
                                        echo '<td><img src="'.$value['Photo'].'" class="img-thumbnail" width="40px"></td>';
                                    }
                                echo'<td>'.$value['Profile'].'</td>';
                                    if ($value['Status'] == 1) {
                                        echo '<td><button class="btn btn-success btn-xs">Activado</button></td>';
                                    } else {
                                        echo '<td><button class="btn btn-danger btn-xs">Desactivado</button></td>';
                                    }
                                echo '
                                    <td>'.$value['LastLogin'].'</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditUser" idUser="'.$value['id_user'].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                            </tr>';
                            }*/
                        ?>

                    </tbody>

                    <tfoot></tfoot>

                </table>
            </div>
        </div>
    </section>
</div>

<!-- ==================================== -->
<!--    Ventana Modal Agregar Usuario     -->
<!-- ==================================== -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- Modal HEADER -->
                <div class="modal-header" style="background-color: #3c8dbc; color: #fff;">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar usuario</h4>
                </div>

                <!-- Modal BODY -->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- Input Nombre -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control input-lg" type="text" name="nuevoNombre" placeholder="Ingresar nombre" required>
                            </div>
                        </div>

                        <!-- Input Usuario -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control input-lg" type="text" name="nuevoUsuario" placeholder="Ingresar usuario" required>
                            </div>
                        </div>

                        <!-- Input Contraseña -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input class="form-control input-lg" type="password" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                            </div>
                        </div>

                        <!-- Entrada para seleccionar su perfil -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="nuevoPerfil">
                                    <option value="">-- Seleccionar perfil --</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <!-- Subir foto -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="nuevaFoto" accept="image/*">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img class="img-thumnnail previsualizar" width="100px" src="view/img/users/default/anonymous.png">
                        </div>

                    </div>
                </div>

                <!-- Modal FOOTER -->
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-primary" type="submit">Guardar usuario</button>
                </div>

                <?php
                    $crearUsuario = new ControllerUsers();
                    $crearUsuario -> createUser();
                ?>
            </form>

        </div>
    </div>
</div>


<!-- =================================== -->
<!--    Ventana Modal Editar Usuario     -->
<!-- =================================== -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- Modal HEADER -->
                <div class="modal-header" style="background-color: #3c8dbc; color: #fff;">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar usuario</h4>
                </div>

                <!-- Modal BODY -->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- Input Nombre -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control input-lg" type="text" id="editarNombre" name="editarNombre" value="" required>
                            </div>
                        </div>

                        <!-- Input Usuario -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control input-lg" type="text" id="editarUsuario" name="editarUsuario" value="" required>
                            </div>
                        </div>

                        <!-- Input Contraseña -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input class="form-control input-lg" type="password" name="editarPassword" placeholder="Ingresa la nueva contraseña" required>
                            </div>
                        </div>

                        <!-- Entrada para seleccionar su perfil -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" id="editarPerfil" name="editarPerfil">
                                    <option value="default" id="optionDefaultEdit">-- Seleccione una Opción --</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <!-- Subir foto -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="editarFoto" accept="image/*">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img class="img-thumnnail previsualizar" width="100px" src="view/img/users/default/anonymous.png">
                        </div>

                    </div>
                </div>

                <!-- Modal FOOTER -->
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-primary" type="submit">Modificar usuario</button>
                </div>

                <?php
                    // $crearUsuario = new ControllerUsers();
                    // $crearUsuario -> createUser();
                ?>
            </form>

        </div>
    </div>
</div>