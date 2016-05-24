jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^([a-z ñáéíóú]{2,60})$/i.test(value);
}, "Letters only please");
"use strict";

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var FormularioReclamacionesEpass = (function () {
	function FormularioReclamacionesEpass() {
		_classCallCheck(this, FormularioReclamacionesEpass);

		this.banderaPersona = true;
		$(".radioSelectedCliente input").on("change", this.cambiarDeCliente);
	}

	_createClass(FormularioReclamacionesEpass, [{
		key: "cambiarDeCliente",
		value: function cambiarDeCliente() {

			var radio = $(this).val();
			if (radio == "natural") {
				$(".formularioPersonaNaturalAOcultar").css("display", "block");
				$(".formularioEmpresa").css("display", "none");
			} else if ("juridica") {
				$(".formularioPersonaNaturalAOcultar").css("display", "none");
				$(".formularioEmpresa").css("display", "block");
			}
			var disabled = $(this).val() === 'natural';
    		$('.formularioEmpresa input').attr('disabled', disabled);

    		if ($('.formularioEmpresa input').hasClass('error')) {
		        $('form').validate().form();
		    }
		}
	}]);

	return FormularioReclamacionesEpass;
})();

$(document).on("ready", inicio);
function validacionReclamaciones()
{
	$("#form_reclamaciones").validate({
            rules:{
                first_name:{
                    lettersonly:true,
                    required:true,
                    minlength:2,
                    maxlength:20
                },
                last_name:{
                	lettersonly:true,
                    required:true,
                    minlength:2,
                    maxlength:20
                },
                address_5:
                {
                    required:true
                },
                document_type:
                {
                    required:true
                },
                address_8:
                {
                	required:true,
                	maxlength:200,
                	minlength:2	
                },
                ruc:{
                    digits:true,
                    required:true,
                    minlength:11,
                    maxlength:1
                },
                home_phone:
                {
                    required:true,
                    maxlength:15,
                    digits:true
                },
                mobile_phone:
                {
                	required:true,
                    maxlength:15
                },
                address_7:
                {
                	required:true,
                    maxlength:15
                },
                empresa:
                {
                	required:true,
                    maxlength:120
                },
                razon_social:
                {
                	required:true,
                    maxlength:120
                },
                ruc:
                {
                	required:true,
                    maxlength:11,
                    minlength:11
                },
                numero_documento:
                {
                    required:true
                },
                email:
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
                    minlength:6
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
}
function inicio() {
	var obj = new FormularioReclamacionesEpass();
	validacionReclamaciones();
	 $("#document_type").on("change",cambiarValidacionTipoDocumento)
	//$("input[value=natural]").attr("checked","checked");
	
}
function cambiarValidacionTipoDocumento()
    {
        
        var valorTipoDocumento=$(this).val();
         if(valorTipoDocumento=="dni")// si es DNI
        {            
            var settings = $('#form_reclamaciones').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 8,maxlength:8};
            $("#document_number").attr("minlength",8);
            $("#document_number").attr("maxlength",8);
            //settings.messages.txtNumDocumento = "Field is required";
        }
        else if(valorTipoDocumento=="carnet_extranjeria")// si es CE
        {
            var settings = $('#form_reclamaciones').validate().settings;
            delete settings.rules.txtNumDocumento;
            settings.rules.txtNumDocumento = {minlength: 9,maxlength:9,digits:true};
            $("#document_number").attr("minlength",9);
            $("#document_number").attr("maxlength",9);
            //settings.messages.txtNumDocumento = "Field is required";
        }
        
    }