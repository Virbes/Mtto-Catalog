<div class="login-box">

    <div class="login-logo">
        <img src="view/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding: 30px 100px 0px 100px">
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Ingresar</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">

                <input id="pass" type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required style="display: inline; width: 85%;">
                <span class="glyphicon glyphicon-lock form-control-feedback" style="width: 40%;"></span>

                <a id="eye_login" class="btn btn-success btn-sm" style="margin-left: 10px;margin-bottom: 3px;" tabindex="-1">
                    <i class="fa fa-eye"></i>
                </a>

                <script type="text/javascript">var a=false;$('#eye_login').click(function(e){e.preventDefault();if(a){a=false;$('#pass').prop('type','password');}else{a=true;$('#pass').prop('type','text');}});</script>

            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

            <?php
            // $login = new ControllerUsers();
            $login = new ControllerUsuarios();
            $login->Login();
            ?>

        </form>  
    </div>
</div>