jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-z ñáéíóú]{2,60})$/i.test(value);
}, "Letters only please");
jQuery.validator.addMethod("alfanumerico", function(value, element) {
  return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*/i.test(value);
}, "Letters only please");
jQuery.validator.addMethod("emailPersonalizado", function(value, element) {
  return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i.test(value);
}, "Letters only please");
jQuery.validator.addMethod("telefono", function(value, element) {
  return this.optional(element) || /^[0-9()#-*-]+([0-9()#-*-]+)*$/i.test(value);
}, "Letters only please");

var nroVehiculos=1;
var vehiculo2=false;
var vehiculo3=false;
var vehiculosValue = {
    1: true,
    2: false,
    3: false,
    4: false,
    5: false,
    6: false,
    7: false,
    8: false,
    9: false,
    10: false
};
function validacionRuc(){
  var var_ruc=$("#comp_ruc").val();
  if($.isNumeric(var_ruc)){
        if(var_ruc.length<11||var_ruc.length==0){
          if(!$("#comp_ruc").hasClass('error')){
             $("#comp_ruc").addClass("error");
             $("#comp_ruc").addClass("error-validacion");
          }
        }
        else{
              $("#comp_ruc").removeClass("error");
              $("#comp_ruc").removeClass("error-validacion");
        }
  }
  else{
      if(!$("#comp_ruc").hasClass('error')){
           $("#comp_ruc").addClass("error");
           $("#comp_ruc").addClass("error-validacion");
      }
  }
}
function validacionRazSoc(){
  var var_raz_soc=$("#comp_raz_soc").val();
  if(var_raz_soc.length==0){
      if(!$("#comp_raz_soc").hasClass('error')){
         $("#comp_raz_soc").addClass("error");
         $("#comp_raz_soc").addClass("error-validacion");
      }
  }
  else{
      $("#comp_raz_soc").removeClass("error");
      $("#comp_raz_soc").removeClass("error-validacion");
  }
}
function validacionComprobanteRecargaDirecta(){

  var tipo_comprobante=$(this).val();
  if(tipo_comprobante==='factura'){
      $("#comp_ruc").removeClass("disabled-input");
      $("#comp_raz_soc").removeClass("disabled-input");
      var cmp_ruc=$("#comp_ruc").val();
      var cmp_raz_soc=$("#comp_raz_soc").val();
      if(cmp_ruc==""){
        $("#comp_ruc").addClass("error");
        $("#comp_ruc").addClass("error-validacion");
      }
      if(cmp_raz_soc==""){
          $("#comp_raz_soc").addClass("error");
          $("#comp_raz_soc").addClass("error-validacion");
      }
  }else{
     $("#comp_ruc").addClass("disabled-input");
     $("#comp_raz_soc").addClass("disabled-input");
     $("#comp_ruc").removeClass("error");
     $("#comp_ruc").removeClass("error-validacion");
     $("#comp_raz_soc").removeClass("error");
     $("#comp_raz_soc").removeClass("error-validacion");
  }
}
function validacionPago(event)
{

      var txtRuc=$("#comp_ruc").val().length;
      var comprobante = $('input:radio[name="medio_de_pago_dash"]:checked').val();
      if(comprobante=="boleta")
      {
        if($('input[name="medio_de_pago"]').is(':checked')) 
            { 
                document.frmPago.submit(); 
            }
            else
            {
                $(".error_metodo_pago").css("display","inline");
            }
      }
      else if(comprobante=="factura" )
      {
        $( 'input[name="medio_de_pago_dash"]' ).trigger( "click" );
          if(txtRuc==11 && $("#comp_raz_soc").val()!="" && $('input[name="medio_de_pago"]').is(':checked'))
          {
              document.frmPago.submit(); 
          }
          else
          {
              if($('input[name="medio_de_pago"]').is(':checked'))
              {
              }
              else
              {
                $(".error_metodo_pago").css("display","inline");
              }                
          }
          
      }
}

function limpiarCorreo()
{
    $("#txtCorreo").val("");
}
function validarEmpresaPrepago()
{
    $("#frm-empresa-prepago").validate({
        rules:{
                txtRazonSocial:{
                    lettersonly:true,
                    required:true,
                    minlength:2,
                    maxlength:100
                },
                ruc:{
                    digits:true,
                    required:true,
                    minlength:11,
                    maxlength:1
                },
                telefono:
                {
                    required:true
                },
                txtNumDocumento:
                {
                    required:true
                },
                txtCorreo:
                {
                    emailPersonalizado:true,
                    required:true
                },
                txtContrasenia:
                {
                    minlength:6,
                    required:true
                },
                txtConfirmaContrasenia:
                {
                     equalTo: "#txtContrasenia"
                },
                idTipoVehiculo:
                {
                    required:true
                },
                idMarca:
                {
                    required:true
                },
                txtPlaca:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                },                
                idModelo:
                {
                    required:true
                },
                CkNovedades:
                {
                    required:true
                },
                radTipo:
                {
                    required:true
                },
                idDpto:
                {
                    required:true
                },
                idProvin:
                {
                    required:true
                },
                idDistrito:
                {
                    required:true
                }
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
function cerrarVehiculo(etiqueta,position)
    {        
        nroVehiculos=nroVehiculos-1;
        vehiculosValue[position]=false;  
        $(etiqueta).parent().remove();
        $("#contadorVehiculos").html(nroVehiculos);
        $("#agregarOtroVehiculo").css("display","inline-block");

    }
function validacionPlacasIguales(event)
{
    event.preventDefault();
    for(var i=1;i<=10;i++)
        {
            if(i==1)
            {
                for(j=1;j<=10;j++)
                {
                    if(i==j){}
                    else{                        
                        if($("#txtPlaca"+j).val() != undefined)
                        {
                            if($("#txtPlaca"+j).val()==$("#txtPlaca").val())
                            {
                                $("#txtPlaca"+j).addClass("error-validacion")
                                $("#txtPlaca").addClass("error-validacion")
                                $(".MensajeError-Placa-Vehiculo").html("Verificar los datos para poder continuar");
                                return false;
                            }
                            else
                            {
                                $("#txtPlaca"+j).removeClass("error-validacion")
                                $("#txtPlaca").removeClass("error-validacion")
                            }
                        }
                    }
                }
            }
            else
            {
                for(j=1;j<=10;j++)
                {
                    if(i==j){}
                    else{                        
                        if($("#txtPlaca"+j).val() != undefined)
                        {
                            if($("#txtPlaca"+j).val()==$("#txtPlaca"+i).val())
                            {
                                $("#txtPlaca"+j).addClass("error-validacion");
                                $("#txtPlaca"+i).addClass("error-validacion");
                                return false;
                            }
                            else
                            {
                                $("#txtPlaca"+j).removeClass("error-validacion")
                                $("#txtPlaca").removeClass("error-validacion")
                            }
                        }
                    }
                }
            } 
                
          
        }

    mostrarPreloader();
   var validacionServe=1;
   var placa_repetida;
   var etiquetaDondeMostrarElError;
   var placa=$("#txtPlaca").val();
    var placa_ajax1=$("#txtPlaca").val();
    $.ajax({
          url: basePath+'ajax-vehicles',
          type: 'POST',
          async: true,
          data: {txtPlaca:placa},
          success:function(data) {

                if(data.flag===1) 
                {
                    validacionServe=0;
                    placa_repetida=placa;
                    etiquetaDondeMostrarElError="txtPlacamensaje"
                }
                else
                {
                }
                
            }
        });
        $(".txtPlacamensaje-class").html("");
        var placa2=$("#txtPlaca2").val();
        var placa_ajax2=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa2},
              success:function(data) {
                    if(data.flag===1) 
                    {
                        validacionServe=0;
                        placa_repetida=placa2;
                        etiquetaDondeMostrarElError="txtPlacamensaje2"
                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa3=$("#txtPlaca3").val();
        var placa_ajax3=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa3},
              success:function(data) {
                    if(data.flag===1) 
                    {
                       validacionServe=0;
                       placa_repetida=placa3;
                       etiquetaDondeMostrarElError="txtPlacamensaje3"                        
                        
                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa4=$("#txtPlaca4").val();
        var placa_ajax4=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa4},
              success:function(data) {
                    if(data.flag===1) 
                    {
                        validacionServe=0;
                        placa_repetida=placa4;
                        etiquetaDondeMostrarElError="txtPlacamensaje4"
      
                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa5=$("#txtPlaca5").val();
        var placa_ajax5=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa5},
              success:function(data) {
                    if(data.flag===1) 
                    {
                        validacionServe=0;
                        placa_repetida=placa5;
                        etiquetaDondeMostrarElError="txtPlacamensaje5"

                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa6=$("#txtPlaca6").val();
        var placa_ajax6=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa6},
              success:function(data) {
                    if(data.flag===1) // registrado
                    {
                        validacionServe=0;
                        placa_repetida=placa6;
                        etiquetaDondeMostrarElError="txtPlacamensaje6"
                        //vehiculoInputHidden.val(0);
                        //$("#"+id).html('<div class="error">Esta placa ya esta registrada</div>')                
                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa7=$("#txtPlaca7").val();
        var placa_ajax7=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa7},
              success:function(data) {
                    if(data.flag===1) 
                    {
                        validacionServe=0;
                        placa_repetida=placa7;
                        etiquetaDondeMostrarElError="txtPlacamensaje7"
                    }
                    else
                    {                        
                    }                    
                }
            });
        var placa8=$("#txtPlaca8").val();
        var placa_ajax8=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa8},
              success:function(data) {
                    if(data.flag===1) 
                    {
                        validacionServe=0;
                        placa_repetida=placa8;
                        etiquetaDondeMostrarElError="txtPlacamensaje8"
                    }
                    else
                    {
                        
                    }                    
                }
            });
        var placa9=$("#txtPlaca9").val();
        var placa_ajax9=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa9},
              success:function(data) {
                    if(data.flag===1) // registrado
                    {
                        validacionServe=0;
                        placa_repetida=placa9;
                        etiquetaDondeMostrarElError="txtPlacamensaje9"
                        //vehiculoInputHidden.val(0);
                        //$("#"+id).html('<div class="error">Esta placa ya esta registrada</div>')                
                    }
                    else
                    {
                        //$("#form-validacionPlaca").submit();
                        //$("#"+id).html("");
                        //vehiculoInputHidden.val(1);
                    }                    
                }
            });
        var placa10=$("#txtPlaca10").val();
        var placa_ajax10=$.ajax({
              url: basePath+'ajax-vehicles',
              type: 'POST',
              async: true,
              data: {txtPlaca:placa10},
              success:function(data) {
                    if(data.flag===1) // registrado
                    {
                        validacionServe=0;
                        placa_repetida=placa10;
                        etiquetaDondeMostrarElError="txtPlacamensaje10"
                        //vehiculoInputHidden.val(0);
                        //$("#"+id).html('<div class="error">Esta placa ya esta registrada</div>')                
                    }
                    else
                    {
                        //$("#form-validacionPlaca").submit();
                        //$("#"+id).html("");
                        //vehiculoInputHidden.val(1);
                    }                    
                }
            });
      $.when(placa_ajax1, placa_ajax2,placa_ajax3,
        placa_ajax4,placa_ajax5,placa_ajax6,placa_ajax7
        ,placa_ajax8,placa_ajax9,placa_ajax10).done(function () {
         
          if(validacionServe==0)
          {
            $(".MensajeError-Placa-Vehiculo").html("Verificar los datos para poder continuar");
            ocultarPreloader();
            $("#"+etiquetaDondeMostrarElError).html("Esta placa ya está registrada")
            $("#"+etiquetaDondeMostrarElError).addClass("error")
            $("#div_errores").html("<div class='error'>Debe completar los campos obligatorios</div>");

          }
          else
          {
            ocultarPreloader();
            $(".formulario-afiliate").submit();
          }
          //ocultarPreloader();
      }).always(function()
      {
        ocultarPreloader();
      });
        
      
    
    

}
function recorrerHiddenVehiculos()
{

}
function validarPlacaEnWebService(inputPlaca)
{   

    var id=inputPlaca.siblings().attr("id");
    var vehiculoInputHidden=inputPlaca.parent().find(".hidden-vehiculo");
    
    var placa=inputPlaca.val();

    $.ajax({
          url: basePath+'ajax-vehicles',
          type: 'POST',
          async: true,
          data: {txtPlaca:placa},
          success:function(data) {
                if(data.flag===1) // registrado
                {                
                    //alert(vehiculoInputHidden.val())
                    vehiculoInputHidden.val(0);
                    $("#"+id).html('<div class="error">Esta placa ya esta registrada</div>')                    
                    $("#div_errores").html("<div class='error'>Debe completar los campos obligatorios</div>");
                    //$("#id_form_placas_iguales").attr("disabled","disabled")
                }
                else
                {
                    $("#"+id).html("");
                    vehiculoInputHidden.val(1)
                    //alert("no esta registrada")
                    //$("#"+id+"mensaje").append('<div class="error">Excelente</div>')
                }
                
            }
        });
    

}

function validarPlacaIndividual(event)
{
    mostrarPreloader();
    event.preventDefault();
    var placa=$("#txtPlaca").val();
    //alert(placa);
     $.ajax({
          url: basePath+'ajax-vehicles',
          type: 'POST',
          async: true,
          data: {txtPlaca:placa},
          success:function(data) {

                if(data.flag===1) // registrado
                {
                    $(".mensaje-placa-registrada-individual").html("Esta placa ya esta registrada")
                    $(".mensaje-placa-registrada-individual").addClass("error");
                    ocultarPreloader();
                    $("#div_errores").html("<div class='error'>Debe completar los campos obligatorios</div>");
                }
                else
                {
                    $(".formulario-afiliate").submit();
                    $(".mensaje-placa-registrada-individual").html("(mínimo 6 y máximo 10 caracteres)");
                    $(".mensaje-placa-registrada-individual").removeClass("error");
                    ocultarPreloader();
                }
                
            }
        });
}
$(document).ready(function () {
    /****Esto es para inicializar el nro de vehiculos con lo que mando back al dar click atras****/
//    $(".select_tipo_documento").val("");
//    $(".select_tipo_documento").change();
//    $(".select_tipo_documento").on("change",cambiarValidacionTipoDocumento);
    cambiarValidacionTipoDocumento();

    //agregaremos el la etiqueta para que muestre los mensajes de tipo de documemnto
     $("#txtNumDocumento").parent().append("<div id='cont-mensaje-error-documento'></div>")

    nroVehiculos=parseInt($("#contadorVehiculos").html());

    $('.soloNumeros').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
    });


    if(typeof maxCarros!=undefined)
    {
        if(nroVehiculos== typeof maxCarros)
        {
            $("#agregarOtroVehiculo").css("display","none");
        }
    }
    /*****************Definiendo los campos vacios cuando de click atras******************/
      $("#txtPlaca").val("");
      $("#idTipoVehiculo").val("");
      $("#idTipoVehiculo").change();
      $("#idMarca").val("");
      $("#idMarca").change();
      $("#idModelo").val("");
      $("#idModelo").change("");
    /*****************Definiendo los campos vacios cuando de click atras******************/
    /****Esto es para inicializar el nro de vehiculos con lo que mando back al dar click atras****/
    validacion();
    validarEmpresaPrepago()
    // valdiacion de placas iguales
    $("#id_form_placas_iguales").on("click",{evento:this},validacionPlacasIguales)
    //$("#id_form_placas_iguales").on("click",validacionExistentesEnLaBd)
    $("#btn-sgt-paso-individual").on("click",{evento:this},validarPlacaIndividual)
    $(".radioEnvioRetiro").on("change",mostrarEnvio);
    $(".label-animation").on("click",seleccionarRadioPago)
    $("#agregarOtroVehiculo").on("click",agregarOtroVehiculo)
;
    $(".cerrarVehiculo").on("click",cerrarVehiculo)

    //$(".ajax-paca").on("focusout",validarPlacaEnWebService)

    $("#txtCorreo").on("focusout",validarEmail)
    $("#btn-cerrar-limpiar-email-plan-individual").on("click",limpiarCorreo)
    $("input[name='medio_de_pago_dash']").on("click",validacionComprobanteRecargaDirecta);
    $("#comp_ruc").on("keyup",validacionRuc);
    $("#comp_raz_soc").on("keyup",validacionRazSoc);

    function validarEmail()
    {

        var basePath=window.location.protocol + "//" + window.location.host + "/";
        var correo=$("#txtCorreo").val();
        var id_plan=$('#id_plan').val();
        var isUserSessionActive = $('#isUserSessionActive').val();
        if(isUserSessionActive==='0'){
            $.ajax({
              url: basePath+'ajax-find-user',
              type: 'POST',
              async: true,
              data: {txtCorreo:correo, idPlan:id_plan},
              success:function(data) {
                    if(data.flag===1) // registrado y sin plan
                    {
                        var correo = $("#txtCorreo").val();
                        $("input[name='username']").val(correo);
                        $('#modal_only_login').modal('show');
                        $('#id_user_trunco').removeAttr('value');
                    }
                    else if(data.flag===2)// no esta registrado
                    {
                        $('#id_user_trunco').removeAttr('value');
                    }
                    else if(data.flag===3) // correo invalido
                    {
                        $('#id_user_trunco').removeAttr('value');
                    }
                    else if(data.flag===4)//registrado con plan
                    {
                      //alert("tengo plan")
                        $('#modal_only_login').modal('show');
                        $('#id_user_trunco').removeAttr('value');
                        $("#cerificadorFlag4").val("si");
                    }
                    else if(data.flag===5)//registrado con este plan trunco
                    {
                        //alert($('#id_plan').val());
                        $('#id_user_trunco').val(data.id);
                    }
                    else if(data.flag===6)//Registrado con plan activo
                    {
                        $('#modal_only_login').modal('show');
                        $('#id_user_trunco').removeAttr('value');
                    }
                    else if(data.flag===7)//Registrado con otro plan trunco
                    {
                        $('#id_user_trunco').val(data.id);
                    }
                }
            });
        }
    }
    
    function agregarOtroVehiculo()
    {
        $('#modal_post_pago_recarga_consulta').modal('show');
        $('#modal_post_pago_recarga_consulta').find('.modal-body_post_pago_text').html("Si deseas agregar vehículos, podrás <br> solicitarlo en los siguientes canales de atención:<br>Teléfono: 249-7222 <br> E-mail: atencionalcliente@epass.pe");       

        /*
        
        maxCarros=parseInt(maxCarros)
        if(nroVehiculos==maxCarros)
        {
           // $("#agregarOtroVehiculo").css("display","none");
        }
        else
        {                           
            var vehiculoNuevo=$("#vehiculo1").html();
            vehiculoNuevo = $(vehiculoNuevo).eq(0).prepend('<span id="vehiculo-nr'+nroVehiculos+'-close" class="cerrarVehiculo" onclick="cerrarVehiculo(this);"><i class="fa fa-times"></i></span>');
            //$(vehiculoNuevo).children().eq(0).html("Vehiculo "+nroVehiculos)
            //$("#vehiculo-nr"+nroVehiculos+"-close")
            $("#contenedorVehiculosAgregados").prepend(vehiculoNuevo);
            
            $("#contadorVehiculos").html(nroVehiculos+1);
            var i=1;
            for(i;i<=10;i++)
            {
                if(vehiculosValue[i]==false)
                {   
                    vehiculosValue[i]=true;                    
                    $("#contenedorVehiculosAgregados").find("#idTipoVehiculo").attr("id","idTipoVehiculo"+i);
                    $("#contenedorVehiculosAgregados").find("#idTipoVehiculo"+i).attr("name","idTipoVehiculo"+i);
                    $("#contenedorVehiculosAgregados").find("#idTipoVehiculo").attr("data-position",(i));
                    $("#idTipoVehiculo"+i).val("");
                    $("#idTipoVehiculo"+i).change();
                    $("#idTipoVehiculo"+i).removeClass("error-validacion");

                    $("#contenedorVehiculosAgregados").find("#idMarca").attr("id","idMarca"+i);
                    $("#contenedorVehiculosAgregados").find("#idMarca"+i).attr("name","idMarca"+i);
                    $("#contenedorVehiculosAgregados").find("#idMarca").attr("data-position",(i));
                    $("#idMarca"+i).val("");
                    $("#idMarca"+i).change();
                    $("#idMarca"+i).removeClass("error-validacion");

                    $("#contenedorVehiculosAgregados").find("#idModelo").attr("id","idModelo"+i);
                    $("#contenedorVehiculosAgregados").find("#idModelo"+i).attr("name","idModelo"+i);
                    $("#contenedorVehiculosAgregados").find("#idModelo").attr("data-position",(i));
                    $("#idModelo"+i).val("");
                    $("#idModelo"+i).change()
                    $("#idModelo"+i).removeClass("error-validacion");

                    $("#contenedorVehiculosAgregados").find("#txtPlaca").attr("id","txtPlaca"+i);
                    $("#contenedorVehiculosAgregados").find("#txtPlaca"+i).attr("name","txtPlaca"+i);
                    $("#contenedorVehiculosAgregados").find("#txtPlaca").attr("data-position",(i));
                    $("#txtPlaca"+i).val("");
                    $("#txtPlaca"+i).removeClass("error-validacion");

                    $("#contenedorVehiculosAgregados").find("#txtColor").attr("id","txtColor"+i);
                    $("#contenedorVehiculosAgregados").find("#txtColor"+i).attr("name","txtColor"+i);
                    $("#contenedorVehiculosAgregados").find("#txtColor").attr("data-position",(i));
                    $("#txtColor"+i).val("");
                    $("#txtColor"+i).removeClass("error-validacion");

                    $("#contenedorVehiculosAgregados").find("#txtPlacamensaje").attr("id","txtPlacamensaje"+i);
                    $("#contenedorVehiculosAgregados").find("#hidden-vehiculo").attr("id","hidden-vehiculo"+i);
                    //$("#contenedorVehiculosAgregados").find("#hidden-vehiculo"+i).addClass("hidden-vehiculo");

                    $('#vehiculo-nr'+nroVehiculos+'-close').attr("data-position",i);
                    
                                        
                    $("#txtPlacamensaje"+i).html("");

                    //$(".ajax-paca").on("focusout",validarPlacaEnWebService)
                    var number= parseInt(i);
                    $('#vehiculo-nr'+nroVehiculos+'-close').attr("onclick","cerrarVehiculo(this,"+number+");")
                    nroVehiculos=nroVehiculos+1;
                    if(nroVehiculos==maxCarros)
                    {
                        $("#agregarOtroVehiculo").css("display","none");
                    }
                    break;
                }                
            } 
            $('#idTipoVehiculo'+i).change(function () {
            var idTipoVehiculo = $(this).children('option:selected').attr('data-type');
            var html = '<option value="">Seleccionar Marca</option>';
            var obj;
            console.log(idTipoVehiculo);
                if (idTipoVehiculo !== '0') {
                    $.ajax({
                        url: '/alinkedlist?LIST=' + idTipoVehiculo,
                        success: function (data) {
                            obj =data;
                            $.each(obj, function (index,val) {
                                var LIST = parseInt(idTipoVehiculo) + parseInt(1);
                                html += '<option value="' + val.INDEX + '" data-list="' + LIST + '" >' + val.TEXT + '</option>';
                            });
                            $('#idMarca'+i).html(html);
                            $('#idMarca'+i+' option[value=""]').attr("selected", true);
                        }
                    });
                }
            });

            $('#idMarca'+i).change(function () {
                var LIST = $(this).children('option:selected').attr('data-list');
                var DEPINDEX = $(this).children('option:selected').val();
                var html = '<option value="">Seleccionar Modelo</option>';
                var obj;
                if (DEPINDEX != '0') {
                    $.ajax({
                        url: '/alinkedlist?LIST='+ LIST +'&DEPINDEX=' + DEPINDEX,
                        success: function (data) {
                            obj = data;
                            $.each(obj, function (i, val) {
                                html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                            });
                            $('#idModelo'+i).html(html);
                            $('#idModelo'+i+' option[value=""]').attr("selected", true);
                        }
                    });
                }
            });           
        }
        */
     
    }
    function validacion()
    {
        $(".formulario-afiliate").validate({
            rules:{
                txtNombreTitular:{
                    lettersonly:true,
                    required:true,
                    minlength:2,
                    maxlength:20
                },
                txtApellidosTitular:{
                    lettersonly:true,
                    required:true,
                    minlength:2,
                    maxlength:20
                },
                txtColor:
                {
                  required:true
                },
                tipoDoc:
                {
                    required:true
                },
                txtNumDocumento:
                {
                    required:true,
                    //digits:true
                },
                txtCorreo:
                {
                    emailPersonalizado:true,
                    required:true
                },
                txtTelefono:
                {
                    maxlength:15,
                    telefono:true                 
                },
                txtContrasenia:
                {
                    minlength:6,
                    required:true
                },
                txtConfirmaContrasenia:
                {
                     equalTo: "#txtContrasenia"
                },
                idTipoVehiculo:
                {
                    required:true
                },
                idTipoVehiculo2:
                {
                    required:true
                },
                idTipoVehiculo3:
                {
                    required:true
                },
                idTipoVehiculo4:
                {
                    required:true
                },
                idTipoVehiculo5:
                {
                    required:true
                },
                idTipoVehiculo6:
                {
                    required:true
                },
                idTipoVehiculo7:
                {
                    required:true
                },
                idTipoVehiculo8:
                {
                    required:true
                },
                idTipoVehiculo9:
                {
                    required:true
                },
                idTipoVehiculo10:
                {
                    required:true
                },
                idMarca:
                {
                    required:true
                },
                idMarca2:
                {
                    required:true
                },
                idMarca3:
                {
                    required:true
                },
                idMarca4:
                {
                    required:true
                },
                idMarca5:
                {
                    required:true
                },
                idMarca6:
                {
                    required:true
                },
                idMarca7:
                {
                    required:true
                },
                idMarca8:
                {
                    required:true
                },
                idMarca9:
                {
                    required:true
                },
                idMarca10:
                {
                    required:true
                },
                idModelo:
                {
                    required:true
                },
                idModelo2:
                {
                    required:true
                },
                idModelo3:
                {
                    required:true
                },
                idModelo4:
                {
                    required:true
                },
                idModelo5:
                {
                    required:true
                },
                idModelo6:
                {
                    required:true
                },
                idModelo7:
                {
                    required:true
                },
                idModelo8:
                {
                    required:true
                },
                idModelo9:
                {
                    required:true
                },
                idModelo10:
                {
                    required:true
                },
                idModeloDos:
                {
                    required:true
                },
                idModeloTres:
                {
                    required:true
                },
                txtPlaca:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true,
                    
                },
                txtPlaca2:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca3:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                }, 
                txtPlaca4:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca5:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca6:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca7:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca8:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca9:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },
                txtPlaca10:
                {
                    required:true,
                    minlength:6,
                    maxlength:10,
                    alphanumerics:true
                    
                },               
                CkNovedades:
                {
                    //required:true
                },
                radTipo:
                {
                    required:true
                },
                idDpto:
                {
                    required:true
                },                
                idProvin:
                {
                    required:true
                },
                idDistrito:
                {
                    required:true
                },
                txtNombVia:
                {
                  maxlength:40,
                },
                txtColor:
                {
                  required:true
                },
                txtNumVia:
                {

                },
                txtUrbanizacion:{
                    maxlength:140
                },
            },
            highlight: function (element) {
                if ($(element).attr('type') === 'checkbox') {
                    $(element).siblings('span').addClass('error');
                }
                else if($(element).attr('type') === 'radio'){
                     $(element).parent().removeClass('spanEpass');
                     $(element).parent().siblings().removeClass('spanEpass');
                     $(element).parent().parent().addClass('error');
                }else{

                    $(element).addClass('error-validacion');
//                    $("#txtNumDocumento").siblings("div").children("div").css("display","block");
                }
                
            },
            unhighlight: function (element) {
                if ($(element).attr('type') === 'checkbox') {
                    $(element).siblings('span').removeClass('error');
                }
                else if($(element).attr('type') === 'radio'){
                     $(element).parent().addClass('spanEpass');
                     $(element).parent().siblings().addClass('spanEpass');
                     $(element).parent().parent().removeClass('error');
                }else{
                    $(element).removeClass('error-validacion');
//                    $("#txtNumDocumento").siblings("div").children("div").css("display","none");
                }
                
            },
            errorPlacement: function(error, element) {
                
                if ($(element).attr('name') == 'txtNumDocumento') {
                    var placement = $(element).parent();
                    if (placement) {
                        $(placement).append(error);
                    } else {
                        error.insertAfter(element);
                    }
                }
               $("#div_errores").html("<div class='error'>Debe completar los campos obligatorios</div>");
            }

        }
        );
        $(".select_tipo_documento").on("change",cambiarValidacionTipoDocumento)
    }
    function validarPlacasIguales()
    {
        alert("hola");
        return false;
    }
    function cambiarValidacionTipoDocumento()
    {
        var input = $('#txtNumDocumento');
        var tipo = '00';
        if( $('.select_tipo_documento').length )  {
            tipo = $('.select_tipo_documento').val();
        } 

        switch(tipo) {
            case '00': //ruc
                    input.attr('maxlength', 11);
                    input.attr('minlength', 11);              
                break;
            case '01': // dni
                    input.attr('maxlength', 8);
                    input.attr('minlength', 8);
                    input.removeClass("bloqueoSoloLetrasYNumeros");
                    input.addClass("bloqueoSoloNumeros");
                break;
            case '02': // carnet extranjeria
                    input.attr('maxlength', 9);
                    input.attr('minlength', 9);
                    input.removeClass("bloqueoSoloLetrasYNumeros");
                    input.addClass("bloqueoSoloNumeros");
                break;
            case '03': //pasaporte
                    input.attr('maxlength', 12);
                    input.attr('minlength', 4);
                    input.removeClass("bloqueoSoloNumeros");
                    input.addClass("bloqueoSoloLetrasYNumeros");
                break;
            default:
                    input.attr('maxlength', 11);
                    input.attr('minlength', 11);
        }
        input.off("keyup");
        bloqueoDeTecladoEnFormularios();
        /*
        $("#txtNumDocumento").off("keyup");
        $("#cont-mensaje-error-documento").css("display","block");
        var caracteresDocumento=parseInt($("#txtNumDocumento").val().length);
        var valorTipoDocumento=$(this).val();
        if(valorTipoDocumento=="")
        {
            $("#cont-mensaje-error-documento").html("<div class='error'>Por favor, seleccione un tipo de documento</div>")
        }
        else if(valorTipoDocumento==0)//Si es RUC
        {
            $("#txtNumDocumento").removeClass("bloqueoSoloLetrasYNumeros");
            $("#txtNumDocumento").addClass("bloqueoSoloNumeros");
            var settings = $('.formulario-afiliate').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 11,maxlength:11,digits:true};
            $("#txtNumDocumento").attr("minlength",11);
            $("#txtNumDocumento").attr("maxlength",11);
            if(caracteresDocumento==11)
            {
              $("#txtNumDocumento").removeClass("error-validacion");
              $("#cont-mensaje-error-documento").css("display","none");
            }
            else
            {
              $("#txtNumDocumento").addClass("error-validacion");
              $("#cont-mensaje-error-documento").html("<div class='error'>Por favor, digite 11 carcateres</div>")
              //$("#txtNumDocumento").parent().append("<div class='error'>Por favor, digite 11 carcateres</div>");
            }
            //settings.messages.txtNumDocumento = "Field is required";
        }

        else if(valorTipoDocumento==1)// si es DNI
        {
            $("#txtNumDocumento").removeClass("bloqueoSoloLetrasYNumeros");
            $("#txtNumDocumento").addClass("bloqueoSoloNumeros");
            var settings = $('.formulario-afiliate').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 8,maxlength:8,digits:true};
            $("#txtNumDocumento").attr("minlength",8);
            $("#txtNumDocumento").attr("maxlength",8);
            if(caracteresDocumento==8)
            {
              $("#txtNumDocumento").removeClass("error-validacion");
              $("#cont-mensaje-error-documento").css("display","none");
            }
            else
            {
              $("#txtNumDocumento").addClass("error-validacion");              
              $("#cont-mensaje-error-documento").html("<div class='error'>Por favor, digite 8 caracteres</div>")
            }
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento==2)// si es CE
        {
            $("#txtNumDocumento").removeClass("bloqueoSoloLetrasYNumeros");
            $("#txtNumDocumento").addClass("bloqueoSoloNumeros");
            var settings = $('.formulario-afiliate').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 9,maxlength:12,digits:true};
            $("#txtNumDocumento").attr("minlength",9);
            $("#txtNumDocumento").attr("maxlength",12);
            if(caracteresDocumento>=9 && caracteresDocumento<=12)
            {
              $("#txtNumDocumento").removeClass("error-validacion");
              $("#cont-mensaje-error-documento").css("display","none");
            }
            else
            {
              $("#txtNumDocumento").addClass("error-validacion");
              //$("#txtNumDocumento").parent().append("<div class='error'>Por favor, digite entre 9 y 12 caracteres</div>");
              $("#cont-mensaje-error-documento").html("<div class='error'>Por favor, digite entre 9 y 12 caracteres</div>")
            }
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento==3)// si es pasaporte
        {

            $("#txtNumDocumento").removeClass("bloqueoSoloNumeros");
            $("#txtNumDocumento").addClass("bloqueoSoloLetrasYNumeros");
            var settings = $('.formulario-afiliate').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 4,maxlength:12,alfanumerico:true};
            $("#txtNumDocumento").attr("minlength",4);
            $("#txtNumDocumento").attr("maxlength",12);
            if(caracteresDocumento>=4 && caracteresDocumento<=12)
            {
              $("#txtNumDocumento").removeClass("error-validacion"); 
              $("#cont-mensaje-error-documento").css("display","none");
            }
            else
            {
              $("#txtNumDocumento").addClass("error-validacion");
              //$("#txtNumDocumento").parent().append("<div class='error'>Por favor, digite entre 4 a 12 caracteres</div>");
              $("#cont-mensaje-error-documento").html("<div class='error'>Por favor, digite entre 4 a 12 caracteres</div>")
            }
            //settings.messages.txtNumDocumento = "Field is required";
        }
        bloqueoDeTecladoEnFormularios();
        */
    }
    function seleccionarRadioPago()
    {
        //alert("hola");
        $(".label-animation").removeClass("animacionRadioSelected");
        $(this).addClass("animacionRadioSelected");
    }
    function mostrarEnvio()
    {

        var radio = $('.radioEnvioRetiro:checked').val();
        //alert(radio)
        if (radio == "0")
        {
            $(".form-venta").css("display", "block");
            $(".form-domicilio").css("display", "none");
            borrarValidacionesDireccion();
        } else if (radio == "1")
        {
            $(".form-venta").css("display", "none");
            $(".form-domicilio").css("display", "block");
            agregarValidacionesDireccion();
        }
    }
   
    function borrarValidacionesDireccion()
    {
        var settings = $('.formulario-afiliate').validate().settings;
        delete settings.rules.idDpto;
        delete settings.rules.txtNombVia;
        delete settings.rules.txtNumVia;
        delete settings.rules.txtDireccion;
    }
    function agregarValidacionesDireccion()
    {
        var settings = $('.formulario-afiliate').validate().settings;
            settings.rules.idDpto = {required: true};
            settings.rules.txtNombVia = {required: true,maxlength:40};
            settings.rules.txtNumVia = {required: true};
            settings.rules.txtDireccion={ required:true,maxlength:180}
    }

////////////////////////////////////////////////////////////////////////////////
var departamentos = [];
var provincias = [];
var currentDepartamento = 0;
var currentProvincia = 0;
var currentDistrito = 0;
var ID_DEPARTAMENTO_LIMA = 15;
var ID_PROVINCIA_LIMA = 128;
var ID_DISTRITO_LIMA = 1252;

if($("#active_lima").val() == "" || $("#active_lima").val() == "1" || (typeof $("#active_lima").val() === "undefined")) {
    loadSelectDepartamentos(ID_DEPARTAMENTO_LIMA);   
}

$('#idDpto').change(function () {
    var index = $(this).children('option:selected').val();
    loadSelectProvincias(index, 0);
});
$('#idProvin').change(function () {
    var index = $(this).children('option:selected').val();
    loadSelectDistritos(index, 0);
});

function loadSelectDepartamentos(indexDefault) {
    var html = '';
    var selectProvincias = '<option value="">Seleccionar Provincia</option>';
    var selectDistritos = '<option value="">Seleccionar Distrito</option>';
    var obj;

    $.ajax({
        url: '/alinkedlist?LIST=3',
        success: function (data) {
            departamentos = data;

            $.each(data, function (index, val) {
                if(index !== 'LIST') {
                    html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                }
            });
            $('#idDpto').html(html);
            $('#idProvin').html(selectProvincias);

            $('#idDpto option[value="' + indexDefault + '"]').attr("selected", true);

            if (indexDefault == ID_DEPARTAMENTO_LIMA) {
                loadSelectProvincias(indexDefault, ID_PROVINCIA_LIMA);
            } else {
                loadSelectProvincias(indexDefault, 0);
            }
        }
    });
}

function loadSelectProvincias(indexDepartamento, indexDefault) {
    console.log('loadSelectProvincias default', indexDefault);
    var idDpto = indexDepartamento;

    var html = '<option value="">Seleccionar Provincia</option>';
    var select = '<option value="">Seleccionar Distrito</option>';
    var obj;
    if (idDpto !== '0' && idDpto !== '') {
        $.ajax({
            url: '/alinkedlist?LIST=4&DEPINDEX=' + idDpto,
            success: function (data) {
                provincias = data;
                $.each(data, function (index,val) {
                    if(index !== 'LIST') {
                        html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                    }
                });
                $('#idProvin').html(html);
                $('#idProvin option[value="' + indexDefault + '"]').attr("selected", true);
                $('#idDistrito').html(select);
                
                if(typeof provincia === "undefined") {
                    if (indexDefault == ID_PROVINCIA_LIMA) {
                        loadSelectDistritos(indexDefault, ID_DISTRITO_LIMA);
                    } else {
                        loadSelectDistritos(indexDefault, 0);
                    }
                }else {
                    $("#idProvin").val(provincia);
                    $("#idProvin").change();
                    provincia ="";
                }
                /*if (indexDefault == ID_PROVINCIA_LIMA) {
                    loadSelectDistritos(indexDefault, ID_DISTRITO_LIMA);
                } else {
                    loadSelectDistritos(indexDefault, 0);
                }*/
            }
        });
    }else {
        $('#idProvin').html(html);
        $('#idProvin').change();
    }
}

function loadSelectDistritos(indexProvincia, indexDefault) {
    var idProvin = indexProvincia;
    var html = '<option value="">Seleccionar Distrito</option>';
    var obj;
    if (idProvin != '0' && idProvin != '') {
        $.ajax({
            url: '/alinkedlist?LIST=5&DEPINDEX=' + idProvin,
            success: function (data) {
                obj = data;
                $.each(obj, function (i, val) {
                    if(i !== 'LIST') {
                        html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                    }
                });
                $('#idDistrito').html(html);
                $('#idDistrito option[value="' + indexDefault + '"]').attr("selected", true);
                if(typeof distrito !== "undefined") {
                    $("#idDistrito").val(distrito);
                    distrito ="";
                }
                
            }
        });
    }else {
        $('#idDistrito').html(html);
    }
}
////////////////////////////////////////////////////////////////////////////////
    /*$('#idDpto').change(function () {
        var idDpto = $(this).children('option:selected').val();
        var html = '<option value="">Seleccionar Provincia</option>';
        var select = '<option value="">Seleccionar Distrito</option>';
        var obj;
        if (idDpto !== '0') {
            $.ajax({
                url: '/alinkedlist?LIST=4&DEPINDEX=' + idDpto,
                success: function (data) {
                    obj =data;
                    $.each(obj, function (index,val) {
                        html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                    });
                    $('#idProvin').html(html);
                    $('#idProvin option[value=""]').attr("selected", true);
                    $('#idDistrito').html(select);

                }
            });
        }
    });
    
    $('#idProvin').change(function () {
        var idProvin = $(this).children('option:selected').val();
        var html = '<option value="">Seleccionar Distrito</option>';
        var obj;
        if (idProvin != '0') {
            $.ajax({
                url: '/alinkedlist?LIST=5&DEPINDEX=' + idProvin,
                success: function (data) {
                    obj = data;
                    $.each(obj, function (i, val) {
                        html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                    });
                    $('#idDistrito').html(html);
                    $('#idDistrito option[value=""]').attr("selected", true);
                }
            });
        }
    });*/
  
$('#idTipoVehiculo').change(function () {
        var idTipoVehiculo = $(this).children('option:selected').attr('data-type');
        var html = '<option value="">Seleccionar Marca</option>';
        var obj;
        console.log(idTipoVehiculo);
            if (idTipoVehiculo !== '0') {
                $.ajax({
                    url: '/alinkedlist?LIST=' + idTipoVehiculo,
                    success: function (data) {
                        obj =data;
                        $.each(obj, function (index,val) {
                            var LIST = parseInt(idTipoVehiculo) + parseInt(1);
                            html += '<option value="' + val.INDEX + '" data-list="' + LIST + '" >' + val.TEXT + '</option>';
                        });
                        $('#idMarca').html(html);
                        $('#idMarca option[value=""]').attr("selected", true);
                    }
                });
            }
        });

        $('#idMarca').change(function () {
            var LIST = $(this).children('option:selected').attr('data-list');
            var DEPINDEX = $(this).children('option:selected').val();
            var html = '<option value="">Seleccionar Modelo</option>';
            var obj;
            if (DEPINDEX != '0') {
                $.ajax({
                    url: '/alinkedlist?LIST='+ LIST +'&DEPINDEX=' + DEPINDEX,
                    success: function (data) {
                        obj = data;
                        $.each(obj, function (i, val) {
                            html += '<option value="' + val.INDEX + '">' + val.TEXT + '</option>';
                        });
                        $('#idModelo').html(html);
                        $('#idModelo option[value=""]').attr("selected", true);
                    }
                });
            }
        });
    
    $(".formulario-afiliate").submit(function(e) {
        placa = $("#txtPlaca").val();
        if(placa == '') {
            return false;
        }
        if(vehiculo2 === true && vehiculo3 !== true) {
            placa2 = $("#txtPlacaDos").val();
            if(placa == placa2 || placa == '' || placa2 == '') {
                return false;
            }
        }
        if(vehiculo3 === true) {
           placa2 = $("#txtPlacaDos").val(); 
           placa3 = $("#txtPlacaTres").val();
           if(((placa == placa2) ||  (placa == placa3) || 
                   (placa2 == placa3)) || placa == '' || placa2 == '' || placa3 == '') {
                return false;
           }
        }
        return true;
    });
       
});
