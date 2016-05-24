provincia = "";
distrito = "";

$(document).ready(function () {
    
    $("#txtCorreo").on("focusout",validarEmail);
//    $(".select_tipo_documento_recarga").on("change",cambiarValidacionTipoDocumento);
    
    function validarEmail()
    {
        var basePath=window.location.protocol + "//" + window.location.host + "/";
        var correo=$("#txtCorreo").val();

        $.ajax({
          url: basePath+'ajax-find-user',
          type: 'POST',
          async: true,
          data: {txtCorreo:correo},
          success:function(data) {
                if(data.flag===1) // registrado y sin plan
                {
                    var correo = $("#txtCorreo").val();
                    $("input[name='username']").val(correo);
                    $('#modal_only_login').modal('show');                    
                }
                else if(data.flag===2)// no esta registrado
                {

                }
                else if(data.flag===3) // correo invalido
                {

                }
                else if(data.flag===4)//registrado con plan
                {
                    $('#modal_only_login').modal('show');
                }
            }
        });
    }
    
    $("#btnCancelar").click(function() {
        var parametros = {
            id_cuenta_ajax: $("#id").val()
        };
        $.ajax({
            url:'ajax-mis-datos',
            type:'POST',
            async: false,
            data : parametros
        }).success(function(respuesta) {
            //alert(respuesta);
            if(respuesta !== '') {
                $("#txtNombreTitular").val($.trim(respuesta.txtNombreTitular));
                $("#txtApellidosTitular").val($.trim(respuesta.txtApellidosTitular));
                $("#idDpto").val($.trim(respuesta.idDpto));
                $("#idDpto").change();
                
                provincia=$.trim(respuesta.idProvin);
                distrito=$.trim(respuesta.idDistrito);
                //$("#idProvin").val($.trim(respuesta.idProvin));
                //$("#idDistrito").val($.trim(respuesta.idDistrito));
                $("#txtDireccion").val($.trim(respuesta.txtDireccion));
                $("#txtReferencia").val($.trim(respuesta.txtReferencia));
                $("#txtContrasenia").val('');
                $("#txtConfirmaContrasenia").val('');                
            }
        });
    });
    function cambiarValidacionTipoDocumento()
    {

        var valorTipoDocumento=$(this).val();
        if(valorTipoDocumento==0)//Si es RUC
        {
            var settings = $('#form_dashboard_datos').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 11,maxlength:11};
            $("#txtNumDocumento").attr("minlength",11);
            $("#txtNumDocumento").attr("maxlength",11);
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento==1)// si es DNI
        {            
            var settings = $('#form_dashboard_datos').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 8,maxlength:8};
            $("#txtNumDocumento").attr("minlength",8);
            $("#txtNumDocumento").attr("maxlength",8);
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento==2)// si es CE
        {
            var settings = $('#form_dashboard_datos').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 9,maxlength:12};
            $("#txtNumDocumento").attr("minlength",9);
            $("#txtNumDocumento").attr("maxlength",12);
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento==3)// si es pasaporte
        {
            var settings = $('#form_dashboard_datos').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 7,maxlength:12};
            $("#txtNumDocumento").attr("minlength",7);
            $("#txtNumDocumento").attr("maxlength",12);
            //settings.messages.txtNumDocumento = "Field is required";
        }
    }
    
});
