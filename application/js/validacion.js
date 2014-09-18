$(document).ready(function() {
    $('#clientes-form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //container:'tooltip',
        fields: {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede estar vacio'
                    },
                    stringLength: {
                        min: 0,
                        max: 100,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    }
                }
            },
            apellido: {
                validators: {
                    notEmpty: {
                        message: 'El campo no puede estar vacio'
                    },
                    stringLength: {
                        min:0,
                        max:100,
                        message: 'El campo no puede contener mas de 100 caracteres'
                    }
                }
            },
            dni: {
                validators: {
                    notEmpty: {
                         message: 'El campo no puede estar vacio'
                    },
                    digits:{
                        message : 'Este campo solo acepta n&uacute;meros'
                    },
                    stringLength: {
                        min: 8,
                        message: 'El campo debe tener al menos 8 Digitos'
                    }
                }
            },
           fecha: {
                validators:{
                    notEmpty:{
                        message:"El campo no puede estar vacio"
                    },
                    stringLength:{
                        min:10,
                        max:10,
                        message: 'Fecha invalida'
                    }
                }
           },
           direccion:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    }
                }
           }

        }
    });
});