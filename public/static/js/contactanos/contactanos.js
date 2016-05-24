$(document).on("ready",inicio)
function inicio()
{
	$("#form_contactanos").validate(
		{
            rules:{
                 nombre:{
                    maxlength:20,
                },
                 apellidos:{
                    maxlength:20,
                },
                telefono_contacto:{
                    maxlength:15,
                },
                telefono_contacto:{
                    maxlength:15,
                },
                telefono_adicional:{
                    maxlength:15,
                },
                correo:{
                    email:true,
                }
                ,
                asunto:{
                    maxlength:120,
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
        $('#recaptcha_response_field').prop('requerid', 'requerid');
        //$("#recaptcha_response_field").attr("", "requerid");
}