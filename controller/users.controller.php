<?php
class ControllerUsers {

    /*==============================
        INGRESO DE USUARIO
    ================================ */

    public static function Login() {
        if (isset($_POST['ingUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

                $tabla = 'Users';
                $item = 'Username';
                $valor = $_POST['ingUsuario'];

                $response = ModelUsers::getUser($tabla, $item, $valor);

                if ($response && $response['Password'] == crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$')) {

                    $_SESSION['iniciarSesion'] = 'ok';

                    $_SESSION['id_user'] = $response['id_user'];
                    $_SESSION['Name'] = $response['Name'];
                    $_SESSION['Username'] = $response['Username'];
                    $_SESSION['Photo'] = $response['Photo'];
                    $_SESSION['Profile'] = $response['Profile'];

                    echo '<script>window.location = "inicio"</script>';
                } else {
                    echo '<br><div class="alert alert-danger">Error a ingresar, vuelve a internarlo</div>';
                }
            }
        }
    }

    /*==============================
        CREAR USUARIO
    ================================ */

    public static function createUser() {
        if (isset($_POST['nuevoUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])) {

                $ruta = '';
                /** Validar Imagen */
                if (is_uploaded_file($_FILES['nuevaFoto']['tmp_name'])) {

                    list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

                    $newWidth = 500;
                    $newHeight = 500;

                    // Crear Directorio
                    $directory = 'view/img/users/'.$_POST['nuevoUsuario'];
                    mkdir($directory, 0755);

                    /** De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP */
                    if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {
                        /** Guardar imagen */
                        $random = mt_rand(100, 999);
                        $ruta = 'view/img/users/'.$_POST['nuevoUsuario'].'/'.$random.'.jpg';
                        $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $newWidth, $newHeight, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES['nuevaFoto']['type'] == 'image/png') {
                        /** Guardar imagen */
                        $random = mt_rand(100, 999);
                        $ruta = 'view/img/users/'.$_POST['nuevoUsuario'].'/'.$random.'.png';
                        $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $newWidth, $newHeight, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $PasswordEncrypted = crypt($_POST['nuevoPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $data = array('Name' => $_POST['nuevoNombre'],
                               'Username' => $_POST['nuevoUsuario'],
                               'Password' => $PasswordEncrypted,
                               'Profile' => $_POST['nuevoPerfil'],
                               'Photo' => $ruta);

                $response = ModelUsers::addUser($data);

                if ($response == 'ok') {
                    echo
                    '<script>
                        swal({
                            type: "success",
                            title: "¡El usuario ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result) => {
                            if (result.value) {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }

            } else {
                echo
                '<script>
                    swal({
                        type: "error",
                        title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {
                            window.location = "usuarios";
                        }
                    });
                </script>';
            }
        }
    }

    /*================================
        Get all users in table Users
    ================================== */
    public static function getUsers() {
        return ModelUsers::getUsers();
    }

    /*===============================
        Get a user in table Users
    ================================= */
    public static function getUser($id_user) {
        return ModelUsers::getUser('Users', 'id_user', $id_user);
    }
}
