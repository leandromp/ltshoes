$(document).ready(function() {
  

    //Validacion del formulario de productos
    $('#productos-form').bootstrapValidator({
        fields:{

            precio:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    },
                    numeric:{
                        message: 'solo se permiten numeros'
                    }
                }

            },

            descripcion:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    }
                }
            },

            codigo:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    }
                }
            },

            tipo:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    }
                }
            },

            marca:{
                validators:{
                    notEmpty:{
                        message: 'El campo no puede estar vacio'
                    }
                }
            }
        }

    });
});