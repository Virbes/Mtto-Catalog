$(document).ready(function() {

    $('#curp').keyup(function() {
        repeatCURP();
    });

    $('#nuevo').click(function() {
        addNewPerson();
    });

    $('#eliminar').click(function() {
        deletePerson();
    });

    $('#modificar').click(function() {
        editPerson();
    });

    $('#cancelar').click(function() {
        cancelar();
    });

    validarCaracteresCurpRfc();
    setFecMax();
});

/** --------------- Logic validate curp Repeat ----------------  */
function repeatCURP() {
    if ($('#nuevo').text() == 'Grabar') {

        if (($('#curp').val()).length == 18) {

            let curp = $('#curp').val();
    
            $.ajax({
                
                type: 'POST', 
                url: 'controller/datperson.controller.php',
                data: {
                    action: "existsCURP",
                    curp: curp
                }
    
            }).done(function (result) {

                if ( result ) {
                    let data = JSON.parse(result);
                    let ques = '¿Qué desea hacer con ' + data.DsNombre + ' ' + data.DsApellido + '?';
                    
                    
                    swal({
    
                        title: '¡Curp repetida!',
                        text: ques,
                        type: 'warning',
                        showCancelButton: true,
                        showCloseButton: true,
    
                        confirmButtonColor: '#7367F0',
                        confirmButtonText: 'Editar',
    
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Eliminar'
    
                    }).then((result) => {
    
                        if (result.dismiss == 'close' || result.dismiss == 'overlay' || result.dismiss == 'esc') {
                            $('#curp').val('');
                        } else if (result.dismiss == 'cancel') {
                            // Eliminar
                            $.ajax({
    
                                type: 'POST',
                                url: 'controller/datperson.controller.php',
                                data: {
                                    action: 'deleteByCurp', 
                                    CvPerson: data.CvPerson
                                }
    
                            }).done(function (result) {
                                enableComponents(false);
                                clearComponents();
                                getDataTable();
    
                                swal({
                                    type: 'success', 
                                    title: 'Se ha eliminado ' + data.DsNombre + ' ' + data.DsApellido, 
                                    showConfirmButton: false,
                                    timer: 1200
                                });
    
                            }).fail(function () {
                                alert('ERROR');
                            });
    
                        } else if (result.value) {
                            // Editar
                            showData(data.CvPerson);
                            clearErrors();
                            $('#nuevo').text('Guardar');
                            $('.componentes').removeClass('errors');
                            $('#' + data.CvPerson).addClass('seleccionada');
                            $('#curp').prop('disabled', true);
                        }
    
                    });
                } 
    
            }).fail(function () {
                alert('ERROR');
            });
    
        }
    }

}
/** ------------- END Logic validate curp Repeat --------------  */


/** ------------- Logic Add New Person --------------  */
function addNewPerson() {

    if ($('#nuevo').text() == 'Nuevo') {

        enableComponents(true);
        clearComponents();
        $('#nuevo').css('background-color', 'green').text('Grabar');
        $('.filasTablita').removeClass('seleccionada');
        $('#eliminar').prop('disabled', true);
        $('#modificar').prop('disabled', true);        

    } else if ($('#nuevo').text() == 'Grabar') {

        let data = getData();
        
        if (data) {
            data.action = 'add';

            $.ajax({

                type: 'POST',
                url: 'controller/datperson.controller.php',
                data: data

            }).done(function (result) {
                enableComponents(false);
                clearComponents();
                getDataTable();
            }).fail(function () {
                alert('ERROR');
            });

        }

    } else if ($('#nuevo').text() == 'Guardar') {


        swal({
            type: "warning",
            title: '¿Seguro que desea guardar los cambios?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            }).then((result) => {
                
                if (result.value) {

                    let data = getData();

                    if (data) {
                        data.action = 'edit';
                        data.CvPerson = $('.seleccionada').attr('id');
            
                        $.ajax({
                            
                            type: 'POST',
                            url: 'controller/datperson.controller.php',
                            data: data
            
                        }).done(function(result) {
                            cancelar();
                            getDataTable();
                        }).fail(function() {
                            alert('ERROR');
                        });
                    }
                    
                } else {
                    cancelar();
                }
                
            }
        );

    }

}

function getData() {

    const TipPerson      = $( '#TipPerson' ).val();

    const Curp           = $( '#curp'      ).val();
    const Rfc            = $( '#rfc'       ).val();
    const Email          = $( '#email'     ).val();
    const Name           = $( '#nombre'    ).val();
    const LastName       = $( '#ApePat'    ).val();
    const MotherLastName = $( '#ApeMat'    ).val();
    const Date           = $( '#fecha'     ).val();
    const Gender         = $( '#genero'    ).val();
    const Phone          = $( '#telefono'  ).val();

    const State          = $( '#estado'    ).val();
    const Municipality   = $( '#municipio' ).val();
    const Suburb         = $( '#colonia'   ).val();
    const Street         = $( '#calle'     ).val();
    const Number         = $( '#numero'    ).val();
    const PostalCode     = $( '#cp'        ).val();

    const data = {
        "TipPerson": TipPerson,
        "Name": Name, 
        "LastName": LastName, 
        "MotherLastName": MotherLastName, 
        "Date": Date,
        "Gender": Gender, 
        "Phone": Phone, 
        "Email": Email, 
        "Curp": Curp, 
        "Rfc": Rfc, 
        "State": State, 
        "Municipality": Municipality, 
        "Suburb": Suburb, 
        "Street": Street, 
        "Number": Number, 
        "PostalCode": PostalCode
    };

    return validateData(data);
}

function validateData(data) {

    let errors = [];

    if (data.TipPerson == 0) {
        errors.push('TipPersonError');
    }

    if (data.Curp == '' || data.Curp.length < 18) {
        errors.push('CurpError');
    }

    if (data.Rfc != '') {
        if (data.Rfc.length < 13) {
            errors.push('RfcError');
        }
    }

    if (data.Name == 0) {
        errors.push('NombreError');
    } 

    if (data.LastName == 0) {
        errors.push('ApePatError');
    }

    if (data.MotherLastName == 0) {
        errors.push('ApeMatError')
    }

    let now = new Date();
    let new_date = new Date(data.Date);
    let year = new_date.getFullYear();

    if (data.Date == '' || year < 1950 || now < new_date) {
        errors.push('DateError');
    }

    if (data.Gender == 0) {
        errors.push('GeneroError');
    }

    if (data.Phone == '') {
        errors.push('TelefonoError');
    }

    if (data.Matricula == '') {
        errors.push('MatriculaError');
    }

    if (data.Email == '' || validateEmail(data.Email)) {
        errors.push('EmailError');
    }

    if (data.Street == 0) {
        errors.push('CalleError');
    }

    if (data.Suburb == 0) {
        errors.push('ColoniaError');
    }

    if (data.Municipality == 0) {
        errors.push('MunicipioError');
    }

    if (data.State == 0) {
        errors.push('EstadoError');
    }

    if (data.PostalCode == '') {
        errors.push('CpError');
    }

    if (errors.length == 0) {
        clearErrors();
        $('.componentes').removeClass('errors');

        return data;
    } else {
        errors_msg(errors);
        return 0;
    }

}
/** ----------- End Logic Add New Person ------------  */


/** ------------- Logic Delete a person in table mPersona --------------  */
function deletePerson() {
    let id = $('.seleccionada').attr('id');

    $.ajax({

        type: 'POST',
        url: 'controller/datperson.controller.php',
        data: {action: 'existsUser', id: id}

    }).done(function(res) {

        if (JSON.parse(res)) {
            
            swal({
                type: "error",
                title: "¡No se puede eliminar!",
                text: "El registro completa otra tabla",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            });

        } else {

            swal({
                type: "warning",
                title: '¿Estas seguro?',
                text: 'Se eliminara a ' + $($('#' + id).children()[0]).text() + ' ' + $($('#' + id).children()[1]).text(),
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
            }).then((result) => {

                if (result.value) {
        
                    $.ajax({

                        type: 'POST',
                        url: 'controller/datperson.controller.php',
                        data: {action: 'delete', id: id}
                
                    }).done(function (res) {
                        getDataTable();
                    }).fail(function () {
                        alert('ERROR');
                    });
                    
                    enableComponents(false);
                    clearComponents();

                }
                    
            });
        }

    });   

}
/** ----------- End Logic Delete a person in table mPersona ------------  */


/** --------------- Logic Edit a person in table mPersona ----------------  */
function editPerson() {
    $('#nuevo').text('Guardar').css('background-color','green');
    enableComponents(true);
    $('#curp').prop('disabled', true);
    $('#modificar').prop('disabled', true);
    $('#eliminar').prop('disabled', true);
}
/** ------------- End Logic Edit a person in table mPersona --------------  */


/** ------------- Logic Cancelar Button --------------  */
function cancelar() {
    $('#nuevo').text('Nuevo').css('background-color', '#3c8dbc');
    $('.filasTablita').removeClass('seleccionada');
    $('#CurpError').text('Ingrese una CURP');
    enableComponents(false);
    clearComponents();
}
/** ----------- End Logic Cancelar Button ------------  */


/** ------------- Select Row in table mPersonas --------------  */
function selectRow(id_fila) {
    clearErrors();
    showData(id_fila);

    $('.filasTablita').removeClass('seleccionada');
    $('#' + id_fila).addClass('seleccionada');
    
    $('#nuevo').text('Nuevo').css('background-color', '#3c8dbc');

    enableComponents(false);
    
    $('#eliminar').prop('disabled', false);
    $('#modificar').prop('disabled', false);
    $('#cancelar').prop('disabled', false);

    $('#CurpError').text('Ingrese una CURP');
}
/** ------------- End Select Row in table mPersonas --------------  */


/** ------------- Show Data in Components (Inputs, Selects) --------------  */
function showData(id_fila) {

    $.ajax({

        type: 'POST',
        url: 'controller/datperson.controller.php',
        data: {action: 'getDataPerson', id: id_fila}

    }).done(function (result) {
        setData(JSON.parse(result));

    }).fail(function () {
        alert('ERROR');
    });

}

function setData(data) {
    $( '#TipPerson' ).val( data.CvTipPerson );
    $( '#curp'      ).val( data.Curp        );
    $( '#rfc'       ).val( data.Rfc         );
    $( '#email'     ).val( data.Email       );
    $( '#nombre'    ).val( data.CvNombre    );
    $( '#ApePat'    ).val( data.CvApePat    );
    $( '#ApeMat'    ).val( data.CvApeMat    );
    $( '#fecha'     ).val( data.FecNac      );
    $( '#genero'    ).val( data.CvGenero    );
    $( '#telefono'  ).val( data.Telefono    );
    $( '#estado'    ).val( data.CvEstado    );
    $( '#municipio' ).val( data.CvMunicipio );
    $( '#colonia'   ).val( data.CvColonia   );
    $( '#calle'     ).val( data.CvCalle     );
    $( '#numero'    ).val( data.Numero      );
    $( '#cp'        ).val( data.Cp          );
}
/** ----------- End Show Data in Components (Inputs, Selects) ------------  */


/** ------------- Activar Mensajes de error --------------  */
function errors_msg(errors) {

    clearErrors();

    $('.componentes').addClass('errors');

    errors.forEach(element => {
        $('#' + element).css('display', 'block');
    });

}

function clearErrors() {
    const errors = ['CurpError', 'RfcError', 'TipPersonError', 'NombreError', 'ApePatError', 'ApeMatError', 'DateError', 'GeneroError', 'MatriculaError', 'EmailError', 'TelefonoError','CalleError', 'ColoniaError', 'MunicipioError', 'EstadoError', 'CpError'];

    errors.forEach(element => {
        $('#' + element).css('display', 'none');
    });
}
/** ----------- End Activar Mensajes de error ------------  */


/** ------------- Enable & Disable Componets --------------  */
function enableComponents(value) {
    $('input').prop('disabled', !value);
    $('select').prop('disabled', !value);
    $('button').prop('disabled', !value);

    $('#nuevo').prop('disabled', false);
    $('#salir').prop('disabled', false);
}
/** ----------- END Enable & Disable Componets ------------  */


/** --------------- Clear Components ----------------  */
function clearComponents() {
    $('input').val('');
    $('.default').prop('selected', true);

    clearErrors();
    $('.componentes').removeClass('errors');
    $('#nuevo').text('Nuevo').css('background-color', '#3c8dbc');
}
/** ------------- End Clear Components --------------  */


/** ------------- Validar Correo --------------  */
function validateEmail(email) {
    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    return !regex.test(email.trim());
}
/** ----------- End Validar Correo ------------  */


/** --------------- Get Data (Table) ----------------  */
function getDataTable() {

    $.ajax({

        type: 'POST',
        url: 'controller/datperson.controller.php',
        data: {action: 'getDataTable'}

    }).done(function (result) {
        $('#PeopleTable').html(result);
    }).fail(function () {
        alert('ERROR');
    });

}
/** ------------- End Get Data (Table) --------------  */


/** ------------- Validar campos de texto (RFC, CURP) --------------  */
function validarCaracteresCurpRfc() {
    $('#curp, #rfc').bind('keypress', function(event) {
        var regex = new RegExp("^[a-zA-Z0-9]+$"); 
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        } 
    });

    $('#cp, #telefono').bind('keypress', function(event) {
        var regex = new RegExp("^[0-9]+$"); 
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        } 
    });
}
/** ------------- END Validar campos de texto (RFC, CURP) --------------  */




function setFecMax(id) {
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    $('#fecha').prop('max', new Date().toDateInputValue());
}