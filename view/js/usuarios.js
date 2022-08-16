$(document).ready(function() {
    /* ========================
        SUBIR FOTO -> Usuario
    =========================== */

    $('.nuevaFoto').change(function () {
        var image = this.files[0];

        // Validar formato de imagen (jpg/png)
        if (image['type'] != 'image/jpeg' && image['type'] != 'image/png') {
            $('.nuevaFoto').val('');
            $('.previsualizar').attr('src', 'view/img/usuarios/default/anonymous.png');
            swal({
                title: 'Error al subir la imagen',
                text: '¡La imagen debe estar en formato JPG o PNG!',
                type: 'error',
                confirmButtonText: '¡Cerrar!'
            });

        } else if (image['size'] > 2000000) {
            $('.nuevaFoto').val('');
            $('.previsualizar').attr('src', 'view/img/usuarios/default/anonymous.png');
            swal({
                title: 'Error al subir la imagen',
                text: '¡La imagen no debe pesar mas de 2MB!',
                type: 'error',
                confirmButtonText: '¡Cerrar!'
            });

        } else {
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(image);

            $(datosImagen).on('load', function (e) {
                var rutaImagen = e.target.result;

                $('.previsualizar').attr('src', rutaImagen);
            });

            console.log(datosImagen);
        }

    });

    /* ========================
        Editar   Usuario
    =========================== */
    $('.btnEditUser').click(function() {
        var id_user = $(this).attr('idUser');
        
        var data = new FormData();
        data.append('idUser', id_user);

        $.ajax({

            url: 'ajax/users.ajax.php', 
            method: 'POST', 
            data: data,
            cache: false,
            contentType: false,
            processData: false, 
            dataType: 'json',
            
        }).done(function(res) {
            
            $( '#editarNombre'  ).val( res.Name     );
            $( '#editarUsuario' ).val( res.Username );
            $( '#editarPerfil'  ).val( res.Profile  );
            
            $( '#optionDefaultEdit').prop('disabled', true);

        }).fail(function () {
            alert('ERROR');
        });
    });

});