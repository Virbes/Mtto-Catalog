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
                        <tr>
                            <td>1</td>
                            <td>Usuario Administrador</td>
                            <td>admin</td>
                            <td><img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                            <td>Administrador</td>
                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                            <td>2021-04-24 12:05:32</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Usuario Administrador</td>
                            <td>admin</td>
                            <td><img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                            <td>Administrador</td>
                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                            <td>2021-04-24 12:05:32</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Usuario Administrador</td>
                            <td>admin</td>
                            <td><img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                            <td>Administrador</td>
                            <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
                            <td>2021-04-24 12:05:32</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                    <tfoot></tfoot>

                </table>
            </div>
        </div>
    </section>
</div>

<!-- ==================== -->
<!--    Ventana Modal     -->
<!-- ==================== -->
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
                                <input class="form-control input-lg" type="text" name="nuevoUsuario" placeholder="Ingresar nombre" required>
                            </div>
                        </div>

                        <!-- Input Contraseña -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input class="form-control input-lg" type="password" name="nuevoPassword" placeholder="Ingresar nombre" required>
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
                            <input type="file" id="nuevaFoto" name="nuevaFoto">
                            <p class="help-block">Peso máximo de la foto 200MB</p>
                            <img class="img-thumnnail" width="100px" src="view/img/usuarios/default/anonymous.png">
                        </div>

                    </div>
                </div>

                <!-- Modal FOOTER -->
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-primary" type="submit">Guardar usuario</button>
                </div>
            </form>

        </div>
    </div>
</div>