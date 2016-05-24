$(document).on("ready",inicio)
function inicio()
{
    validarFormularioVehiculos()
	$(".paqueteEpass-Contenido-VerMas").on("click",mostratPaqueteSeleccionado)
}
function validarFormularioVehiculos()
{
    $("#formulario-actualizar-vehiculo").validate({
        rules:
        {
            
        },highlight: function (element) {
               $(element).addClass('error-validacion');
           },
           unhighlight: function (element) {
               $(element).removeClass('error-validacion');
           },
           errorPlacement: function(error, element) {
               if (element.attr('type') === 'checkbox') {
                   error.appendTo( element.parent());
               }
               else if(element.attr('type') === 'radio')
               {
                       error.appendTo( element.parent().parent());
               }
           }
    });
}
function mostratPaqueteSeleccionado()
{
	alert("asd");
}

var marca;
var modelo;

$(document).ready(function () {
    $('#slxTipo').change(function () {
        var idTipoVehiculo = $(this).children('option:selected').attr('data-type');
        var html = '<option value="0">Seleccionar Marca</option>';
        var obj;
        if (idTipoVehiculo !== '0') {
            $.ajax({
                url: '/alinkedlist?LIST=' + idTipoVehiculo,
                success: function (data) {
                    obj =data;
                    $.each(obj, function (index,val) {
                        var LIST = parseInt(idTipoVehiculo) + parseInt(1);
                        html += '<option value="' + val.INDEX + '" data-list="' + LIST + '" >' + val.TEXT + '</option>';
                    });
                    $('#slxMarca').html(html);
                    //$('#slxMarca option[value="0"]').attr("selected", true);
                    $("#slxMarca option").filter(function() {
                        return this.text == $.trim(marca);
                     }).attr('selected', true);
                     marca = '';
                     $("#slxMarca" ).change();
                     $("#texto_marca").val($("#slxMarca option:selected").html());
                    }
            });
        }else {
            $('#slxMarca').html(html);
            $("#slxMarca" ).change();
        }
    });

    
    $('#slxMarca').change(function () {
        var LIST = $(this).children('option:selected').attr('data-list');
        var DEPINDEX = $(this).children('option:selected').val();
        var html = '<option value="0">Seleccionar Modelo</option>';
        var obj;
        if (DEPINDEX != '0') {
            $.ajax({
                url: '/alinkedlist?LIST='+ LIST +'&DEPINDEX=' + DEPINDEX,
                success: function (data) {
                    obj = data;
                    $.each(obj, function (i, val) {
                        html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                    });
                    $('#slxModelo').html(html);
                    //$('#slxModelo option[value="0"]').attr("selected", true);
                    $("#slxModelo option").filter(function() {
                            return this.text == $.trim(modelo);
                    }).attr('selected', true);
                    modelo = '';
                    $("#slxModelo" ).change();
                    $("#texto_modelo").val($("#slxModelo option:selected").html());
                    
                }
            });
        }else {
            $('#slxModelo').html(html);
            $("#slxModelo" ).change();
        }
        $("#texto_marca").val($("#slxMarca option:selected").html());
    });
    
    //$("#texto_marca").val($("#slxMarca option:selected").html());
    //$("#texto_modelo").val($("#slxModelo option:selected").html());
    
    $('#slxModelo').change(function () {
        $("#texto_modelo").val($("#slxModelo option:selected").html());
    });
    
    $("#btn-editar-vehiculo").on("click",validacionActualizarVehiculo);
    $(".select-valid").on("change",validacionActualizarCbo);

    $("#actualizar_vehiculo").click(function() {
        $("#formulario-actualizar-vehiculo").submit();
    });
    
    
    
});
function validacionActualizarCbo(){
    var value=$(this).val();
     if(value=="0"){
            if(!$(this).hasClass('error')){
                $(this).addClass("error");
                $(this).addClass("error-validacion");
            }
        }
        else{
            $(this).removeClass("error");
            $(this).removeClass("error-validacion");

        }
}
function validacionCbo(cbo){
        var value=cbo.val();
        if(value=="0"){
            if(!cbo.hasClass('error')){
                cbo.addClass("error");
                cbo.addClass("error-validacion");
            }
            return false;
        }
        else{
            cbo.removeClass("error");
            cbo.removeClass("error-validacion");
            return true;

        }
}
function validacionInput(input){
    var value=input.val();
    if(value==""){
        if(!input.hasClass('error')){
            input.addClass("error");
            input.addClass("error-validacion");
        }
        return false;
    }
    else{
        input.removeClass("error");
        input.removeClass("error-validacion");
        return true;
    }
}

function validacionActualizarVehiculo(){

    if(validacionCbo($("#slxTipo"))){
        if(validacionCbo($("#slxMarca"))){
            if(validacionCbo($("#slxModelo"))){
                if(validacionInput($("#color_v"))){
                    $("#editar_vehiculo").modal('hide');
                    $("#mensaje_confirmacion").modal('show');
                }
            }
        }

    }

}

function data_vehiculo(id_account, placa) {
   
    var parametros = {
            id_vehiculo: placa,
            account_id: id_account
        };
    $.ajax({
        url:'vehiculo',
        type:'POST',
        async: false,
        data : parametros
    }).success(function(respuesta) {
        if(respuesta.mensaje.cuenta != '') {
            $("#cuenta_v").val($.trim(respuesta.mensaje.cuenta));
            $("#placa_v").val($.trim(respuesta.mensaje.placa));
            $("#tag_v").val($.trim(respuesta.mensaje.tag));
            $("#estado_v").val($.trim(respuesta.mensaje.estado_actual));
            $("#color_v").val($.trim(respuesta.mensaje.color));
            $("#slxTipo").val($.trim(respuesta.mensaje.tipo));
            $("#vehiculo_id").val(respuesta.mensaje.vehiculo_id);
            marca = respuesta.mensaje.marca.toUpperCase();
            modelo = respuesta.mensaje.modelo;
            $("#slxTipo" ).change();
            $("#editar_vehiculo").modal('show');
        }
        //$("#slxMarca" ).change();
        $(".description-mensaje-confirmacion").html('¿Está seguro de editar el vehículo con la placa '+$.trim(respuesta.mensaje.placa)+'?');
    });
}
