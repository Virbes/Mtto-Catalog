<?php

class ControllerPassword {

    public static function changePassword() {
        if (isset($_POST['current_password'])) {

            $current_password = ModelPassword::getCurrentPassword(crypt($_POST['current_password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), $_SESSION['Name']);

            if ($current_password) {

                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                if ($new_password == $confirm_password) {

                    $repeat = ModelPassword::getExistsPassword(crypt($new_password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'), $_SESSION['Name']);

                    if ($repeat) {
                        echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡Contraseña Invalida!",
                                    text: "Pongase en contato con su administrador",
                                    showCancelButton: false,
                                    confirmButtonColor: "#3085d6",
                                    confirmButtonText: "Aceptar"
                                });
                                
                                $("#current_password").val("'.$_POST['current_password'].'");
                            </script>';
                        
                    } else {
                        ModelPassword::changePassword($current_password[0][0], crypt($new_password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'));

                        echo
                        '<script>
                            swal({
                                type: "success",
                                title: "¡La contraseña ah sido cambiadio exitosamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result) => {
                                if (result.value) {
                                    //window.location = "inicio";
                                }
                            });
                        </script>';
                    }

                } else {
                    echo '<script>
                            swal({
                                type: "error",
                                title: "¡Error!",
                                text: "¡Las contraseñas no coinciden!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            });
                                
                            $("#current_password").val("'.$_POST['current_password'].'");
                            $("#new_password").val("'.$_POST['new_password'].'");
                            $("#confirm_password").val("'.$_POST['confirm_password'].'");
                        </script>';
                }

            } else {
                echo '<script>
                        swal({
                            type: "error",
                            title: "¡Error!",
                            text: "¡Contraseña actual incorrecta!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                        
                        $("#current_password").val("'.$_POST['current_password'].'");
                        $("#new_password").val("'.$_POST['new_password'].'");
                        $("#confirm_password").val("'.$_POST['confirm_password'].'");
                       </script>';
            }
        }
    }
    
}