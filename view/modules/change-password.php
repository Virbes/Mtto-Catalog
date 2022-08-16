<script src="view/js/password.js"></script>
<link rel="stylesheet" href="view/css/toggle-switch.css">

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Cambiar contraseña
        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Cambiar contraseña</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">

            <br>

            <div class="col-md-4 col-md-offset-4 panel-style" style="width: 42% !important; margin-left: 30%;">

                <div class="panel panel-default">

                    <div class="panel-heading">

                        <h3 class="panel-title">
                            <strong>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </strong>
                        </h3>

                    </div>

                    <div class="panel-body">
                        <form method="POST">

                            <label for="current_password">Contraseña Actual</label>
                            <div class="form-inline components">
                                <input type="password" name="current_password" id="current_password" class="form-control" required>

                                <label class="switch">
                                    <input type="checkbox" id="check_current" inputCheck="current_password" tabindex="-1">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <label for="new_password">Nueva Contraseña</label>
                            <div class="form-inline components">
                                <input type="password" name="new_password" id="new_password" class="form-control" required>

                                <label class="switch">
                                    <input type="checkbox" id="check_new" inputCheck="new_password" tabindex="-1">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <label for="confirm_password">Confirmar Contraseña</label>
                            <div class="form-inline components">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required aria-describedby="button-addon2">

                                <label class="switch">
                                    <input type="checkbox" id="check_confirm" inputCheck="confirm_password" tabindex="-1">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <br>

                            <div class="form-group">
                                <button type="submit" id="Cambiar" class="btn btn-primary btn-small btn-lg" style="width: 40%; margin-left: 20px;">Cambiar</button>
                                <a class="btn btn-danger btn-small btn-lg" href="change-password" style="width: 40%; margin-left: 30px;">Cancelar</a>
                            </div>

                            <?php
                            $Passw = new ControllerPassword();
                            $Passw->changePassword();
                            ?>

                        </form>
                    </div>
                </div>

            </div>

            <div class="clearfix"></div>

        </div>
    </section>

</div>