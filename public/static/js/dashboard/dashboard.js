$(document).on("ready",inicio)
function asignarVistaActual()
{
  $("#vista-actual").val("only-login");
  //alert($("#vista-actual").val());
}
function inicio()
{
    $(".href_invitado_login").on("click",asignarVistaActual);

    // Select dinamico en modal crear solicitud

    var temasSolicitudes = null;

    $.ajax({
        url: '/ajax-temas-zendesk',
        success: function (response) {
            //console.log(response);
            temasSolicitudes = response.data;
            //console.log('Data solicitudes',  temasSolicitudes);
            var html = '<option value="">Seleccione tema</option>';
            $.each(temasSolicitudes, function (i, obj) {
                html += '<option value="' + obj.value + '">' + obj.name + '</option>';
            });
            $('#req_theme').html(html);
        }
    });


    $('#req_theme').change(function (e) {
        var tema = $(this).children('option:selected').val();
        var html = '<option value="">Seleccione subtema</option>';
        //console.log('Option select', tema);

        if (temasSolicitudes != null) {
            var subthemes = temasSolicitudes[tema].subthemes;
            $.each(subthemes, function (i, obj) {
                html += '<option value="' + obj.value + '">' + obj.name + '</option>';
            });
            $('#req_subtheme').html(html);
        }
    });

    $('#req_subtheme').change(function (e) {
        var tema = $(this).children('option:selected').val();
        $('#theme').val(tema);
    });
    
    // Submit solicitud
  /*  $('#form-crear-solicitud').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/solicitudes',
            type: 'POST',
            async: true,
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
                $('#modal_solicitud').modal('hide');
                if (response.status == 'ok') {
                    alert('Su solicitud ha sido enviada.');
                }
            },
            error: function error(xhr, textStatus, errorThrown) {
                console.log(xhr);
                $('#modal_solicitud').modal('hide');
            }
        });

    });*/


	$("#resumen_dashboard").on("click",mostrarAside);
	//$("#tab-mis-datos").on("click",ocultarAside);
	//$("#tab-recarga-directa").on("click",ocultarAside);
	$("#btn-confirmacion").on("click",confirmarCambioCuenta);
	$("#aceptarNuevaCuenta").on("click",accionConfirmacionCuenta);
  $("#pagar-recarga-directa").on("click",validarPagoRecargaDirecta);


  $("#resumen_dashboard").on("click",verResumen);
	$( "#form_dashboard_datos" ).validate({
		rules: {
		    txtContrasenia:{
          minlength:6,
          maxlength:12
        },
		    txtConfirmaContrasenia: {
		      equalTo: "#txtContrasenia"
		    },
        txtNombreTitular:{
          maxlength:20,
        },
        txtApellidosTitular:{
          maxlength:20,
        },
        txtNombVia:{
          maxlength:40,
        },
        txtNumVia:{
          maxlength:10,
        },
        txtDptoVia:{
          maxlength:10,
        },
        txtUrbanizacion:{
          maxlength:130,
        }
		},
    highlight: function (element) {
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


	$('.datatable').DataTable({
		"info":     false,
		"bFilter": false,
		"bLengthChange": false,
		"iDisplayLength": 7,
    "bSort": false,
		"language": {
        "emptyTable": "<p style='color:red;text-align:center;font-size:14px'>No se encontraron registros.</p>",
        "zeroRecords": "<p style='color:red;text-align:center;font-size:14px'>No se encontró resultados en su búsqueda.</p>",
			"paginate": {
	      		"next": "<i class='fa fa-step-forward'></i>",
	      		"previous": "<i class='fa fa-step-backward'></i>"
	    	}
	    } 
	});
  var tabla_solicitudes=$('.datatable-default').DataTable({
    "info":     false,
    "bFilter": false,
    "bLengthChange": false,
    "bSort": false,
    "language": {
        "emptyTable": "<p style='color:red;text-align:center;font-size:14px'>No se encontraron registros.</p>",
        "zeroRecords": "<p style='color:red;text-align:center;font-size:14px'>No se encontró resultados en su búsqueda.</p>",
      "paginate": {
            "next": "<i class='fa fa-step-forward'></i>",
            "previous": "<i class='fa fa-step-backward'></i>"
        }
      } 
  });
  $(".dataTables_empty").attr("colspan",7);
  $('#form-crear-solicitud').validate({
        highlight: function (element) {
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
        },
        submitHandler:function(form){

             $('#modal_solicitud').modal('hide');

              $.ajax({
                url: '/solicitudes',
                type: 'POST',
                async: true,
                data: $(form).serialize(),
                success: function (response) {
                    //console.log(response);

                    if (response.status == 'ok') {
                        
                       tabla_solicitudes.row.add([
                            response.data.solicitud.ticket_id,
                            parseFecha(response.data.solicitud.created_at),
                            $("#req_theme option:selected").html(),
                            $("#req_subtheme option:selected").html(),
                            response.data.solicitud.body,
                            response.data.solicitud.status,
                            parseFecha(response.data.solicitud.updated_at),

                        ] ).draw();
                        
                        $("#solicitud_enviada").modal('show');
                       
                    }else{
                      $("#error_solicitud_enviada").modal('show')
                    }
                },
                error: function error(xhr, textStatus, errorThrown) {
                   //console.log('Error', xhr);
                   // alert('No se pudo enviar la solicitud!');
                     $("#error_solicitud_enviada").modal('show')
                }
             });

        }
    });

  $('.expander').expander({
    slicePoint: 10,
    widow: 2,
    expandEffect: 'show',
    userCollapseText: '[^]',
  });




	iniciarCarruseles();
  $(".nav-tabs li").on("click",ocultarBtnRecargar);
  //$("input[name='medio_de_pago_dash']").on("click",validacionComprobanteRecargaDirecta);
  //$("#comp_ruc").on("keyup",validacionRuc);
  //$("#comp_raz_soc").on("keyup",validacionRazSoc);

}
function parseFecha(valor){

  var fecha=new Date(valor);
  var anio=fecha.getUTCFullYear();
  var mes=fecha.getUTCMonth()+1;
  var dia=fecha.getUTCDate();


  return dia+"/"+mes+"/"+anio;
}
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
function ocultarBtnRecargar(){
  var id_tabs=$(this).attr("id");
  if(id_tabs==='tab-recarga-directa'){
    $("#btn-recargar-dashboard").hide();
  }
  else{
    $("#btn-recargar-dashboard").show();
  }
}
function validarPagoRecargaDirecta(){
  if($("#paquetesPlan-recargaDirecta").find("div").hasClass("bgselect")){
      $("#validacion_pago").html("");
      if($("input:radio[name='medio_de_pago']").is(':checked'))
      {
        /*if($("#comp_raz_soc").hasClass('error')||$("#comp_ruc").hasClass('error')){
          $("#validacion_pago").html("Registre datos solicitados");
        }
        else{*/
          $("#validacion_pago").html("");
          $("#pagar-recarga-directa").removeAttr("type");
          $("#pagar-recarga-directa").removeAttr("type");
          $('#pagar-recarga-directa').attr('type','submit');
       /* }  */

      }else{
         $("#validacion_pago").html("Seleccione un Método de Pago");
      }
  } else if(!$("input:radio[name='medio_de_pago']").is(':checked')) {
    $("#validacion_pago").html("Seleccione un Paquete y Método de Pago");
  } else {
    $("#validacion_pago").html("Seleccione un Paquete");
  }
}
function confirmarCambioCuenta(){
		msgConfirmacionNaranja();
}
function verResumen(){
  $("#link-cuentas-asociadas").removeClass("aside-item-active");
  $("#link-ultimas-recargas").addClass("aside-item-active");
  $("#datosprincipales_cuenta_asociada").addClass('hide');
  $("#datos_cuenta_asociada").addClass('hide');
  $("#datos_resumen").removeClass('hide');
  $("#ultimas_recargas_resumen").removeClass('hide');
  $("#link-ultimas-recargas").removeClass("cursorPointer");
  $("#link-cuentas-asociadas").addClass("cursorPointer");
}
function verCuentasAsociadas(){
  $("#link-cuentas-asociadas").addClass("aside-item-active");
  $("#link-ultimas-recargas").removeClass("aside-item-active");
  $("#datosprincipales_cuenta_asociada").removeClass('hide');
  $("#datos_cuenta_asociada").removeClass('hide');
  $("#datos_resumen").addClass('hide');
  $("#ultimas_recargas_resumen").addClass('hide');
  $("#link-ultimas-recargas").addClass("cursorPointer");
  $("#link-cuentas-asociadas").removeClass("cursorPointer");

}
function paqueteSeleccionado(seleccionado){
  var costoTotal=$("#costoTotal"+seleccionado).val();
  var tasaRecarga=$("#tasaRecarga" +seleccionado).val()
  var saldoUso=$("#saldoUso"+seleccionado).val();
  var costoTag=$("#costoTag"+seleccionado).val();
  var costoPromocionalTag=$("#costoPromocionalTag"+seleccionado).val();

  var div_padre=$("#costoPromocionalTag"+seleccionado).parent().parent().parent().parent();
  $("#paquetesPlan-recargaDirecta").find('.bgselect').addClass("bgceleste");
  $("#paquetesPlan-recargaDirecta").find('.borderselect').addClass("borderCeleste");
  $("#paquetesPlan-recargaDirecta").find('.dashedselect').addClass("dashedCeleste");
  $("#paquetesPlan-recargaDirecta").find('.bgselectTransparent').addClass("bgCelesteTransparent");
  $("#paquetesPlan-recargaDirecta").find('.colorselect').addClass("colorceleste");

  $("#paquetesPlan-recargaDirecta").find(".bgselect").removeClass("bgselect");
  $("#paquetesPlan-recargaDirecta").find(".borderselect").removeClass("borderselect");
  $("#paquetesPlan-recargaDirecta").find(".dashedselect").removeClass("dashedselect");
  $("#paquetesPlan-recargaDirecta").find(".bgselectTransparent").removeClass("bgselectTransparent");
  $("#paquetesPlan-recargaDirecta").find(".colorselect").removeClass("colorselect");


  div_padre.find('.bgceleste').addClass("bgselect");
  div_padre.find('.borderCeleste').addClass("borderselect");
   div_padre.find('.dashedCeleste').addClass("dashedselect");
  div_padre.find('.bgCelesteTransparent').addClass("bgselectTransparent");
  div_padre.find('.colorceleste').addClass("colorselect");
  

  div_padre.find('.bgselect').removeClass("bgceleste");
  div_padre.find('.borderselect').removeClass("borderCeleste");
  div_padre.find('.dashedselect').removeClass("dashedCeleste");
  div_padre.find('.bgselectTransparent').removeClass("bgCelesteTransparent");
  div_padre.find('.colorselect').removeClass("colorceleste");

    $.ajax({
         url: basePath+'UserPlans?recarga=true&costoTag='+costoTag+'&costoPromocionalTag='+costoPromocionalTag+'&tasaRecarga='+tasaRecarga+'&saldoUso='+saldoUso+'&costoTotal='+costoTotal,
         type: 'GET',
         async: true,
         success:function(data) {
               if(data.STATUS) 
               {
                   $("#total_plan").html(data.total);                 
               }
           }
       });


}
function accionConfirmacionCuenta(){
	var dato=$("input:radio[name ='account_id']:checked").val();
  $("#confirmacion_cuenta").modal("hide"); 
  setTimeout(function(){ mostrarPreloader(); }, 200); 
	$.ajax({
         url: basePath+'UserPlans?save=true&account_id='+dato,
         type: 'GET',
         async: true,
         success:function(data) {
               if(data.STATUS) 
               {
                   location.reload();                   
               }
               else 
               {  ocultarPreloader();
                  $("#error_cambiar_cuenta").modal('show');         
               }
           }
       });
}

function mostrarAside()
{
	$(".item-aside").css("display","block");
}
function ocultarAside()
{
	$(".item-aside").css("display","none");
}
function activeRecargaDirecta(){
  $("#btn-recargar-dashboard").hide();
  $("#tab-content-cuenta .tab-pane").removeClass('active');
  $("#recargadirecta").addClass('active');
  $("#enlace-tab-cuenta li").removeClass('active');
  $("#enlace-tab-cuenta #tab-recarga-directa ").addClass('active');
}
function crearSolicitud(){
  $("#req_theme").val("");
  $("#req_subtheme").val("");
  $("#subject").val("");
  $("#body").val("");
  $("#modal_solicitud").modal('show');
}
function iniciarCarruseles()
{
	var owl = $("#owl-demo");
	owl.owlCarousel({
      items : 2, //10 items above 1000px browser width
      stopOnHover:true,
      itemsDesktop : [1000,2], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,1], // 3 items betweem 900px and 601px
      itemsTablet: [600,1], //2 items between 600 and 0;
      itemsMobile : [400,1], // itemsMobile disabled - inherit from itemsTablet option
      autoPlay:true,
      });
      // Custom Navigation Events
      $(".next2").click(function(){
        owl.trigger('owl.next');
      })
      $(".prev2").click(function(){
        owl.trigger('owl.prev');
      })
      $(".play").click(function(){
        owl.trigger('owl.play',1000);
      })
      $(".stop").click(function(){
        owl.trigger('owl.stop');
      })
	
	     


}
