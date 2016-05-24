jQuery.validator.addMethod("emailPersonalizado", function(value, element) {
  return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i.test(value);
}, "Letters only please");
$.validator.addMethod("alphanumerics", function(value, element) {
        return this.optional(element) || /^[a-z0-9\s]+$/i.test(value);
    }, "* Sólo letras y números");

var basePath=window.location.protocol + "//" + window.location.host + "/"
var urlredirect = '';
var idPlan = '';
var authStatus = $('meta[name=status_auth]').attr('content');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 var flagModalPreload="";
$(document).on("ready",ready)
function setearModalLoginRecarga()
{
    $("#vista-actual").val("login-recarga");
    
}
function asignarValorPreloadRecarga()
{  
  flagModalPreload=$(this).val();
}
function setearModalOnlyLogin()
{    
    $("#vista-actual").val("only-login");
}
function descargarPdf(e)
{
    //e.preventDefault();  //stop the browser from following
    //window.location.href = 'uploads/file.doc';
}
function seleccionarTagONumeroPlaca()
{
    $(".txt-tag-o-placa").attr("disabled",false)  
    var opcion =$(this).val()
    if(opcion==="placa")
    {        
        $(".radio-placa-change").attr("checked",true);
        $(".txt-tag-o-placa").attr("placeholder","Ingrese su número de placa")
        $(".txt-tag-o-placa").attr("maxlength",10)
        var settings = $('.form-recarga-directa').validate().settings;
        delete settings.rules.nroType;
        settings.rules.nroType = {minlength: 6,maxlength:10};
    }
    else if(opcion==="tag")
    {        
        $(".radio-tag-change").attr("checked",true);        
        $(".txt-tag-o-placa").attr("placeholder","Ingrese los 8 dígitos de su tag")
        $(".txt-tag-o-placa").attr("maxlength",8)
        var settings = $('.form-recarga-directa').validate().settings;
        delete settings.rules.nroType;
        settings.rules.nroType = {minlength: 8,maxlength:8};
    }
}
function levantarModalLoginRecarga()
{
    $("#loginModal").modal("show");
}
function bloqueoDeTecladoEnFormularios()
{
    $('.bloqueoSoloLetras').on("keyup",function(event){
        if(event.keyCode != 37 && event.keyCode != 39) 
        {
            this.value = (this.value + '').replace(/[^a-zA-Z áéíóúñ]/g, '');
        }             
    });
    $('.bloqueoSoloNumeros').on("keyup",function(event){
        if(event.keyCode != 37 && event.keyCode != 39) 
        {
            this.value = (this.value + '').replace(/[^0-9]/g, '');
        }
    });
    $('.bloqueoSoloLetrasYNumeros').on("keyup",function(event){
        if(event.keyCode != 37 && event.keyCode != 39) 
        {
            this.value = (this.value + '').replace(/[^0-9a-zA-Z]/g, '');
        }
    });
    $('.bloqueoTelefono').on("keyup",function(event){
        if(event.keyCode != 37 && event.keyCode != 39) 
        {
            this.value = (this.value + '').replace(/[^0-9 #()-]/g, '');
        }
    });
}
function restablecerRecuperarContra()
{
    $("#title-recover-pw").html("Recuperación de Contraseña");
    $("#mensaje-seguiradad-contra").html("Por favor ingresa tu correo con el que te registraste.");
    $("#correo-recupera-pw").val("");
}
function ready(){

    //restableceremos el formulario de recuperar contraseña
    $("#forget-pw-id").on("click",restablecerRecuperarContra);


    bloqueoDeTecladoEnFormularios();
    $("#recarga-directa-only-show-modal").click(function(){
        $("#modal_recargadirecta").modal("show");
    })
    $(".shoh-modal-login-dashboard").click(function(){
        $("#modal_only_login").modal("show");
    })
    $("input[name='type']").on("click",seleccionarTagONumeroPlaca);
    $("#id_top_menuIniciarSesión").on("click",function(){
        $.ajax({
          url: basePath+'login/logged',
          type: 'GET',
          async: true,
          success:function(data) {
                if(data.status==='logged'){
                    window.location = '/mi-cuenta';
                }
                else{
                    levantarModalLoginRecarga();
                }
            }
        });        
    });

    $(".recarga-tag-show-proload").on("click",asignarValorPreloadRecarga)
    $("#href_descargar_pdf").on("click",descargarPdf) 
    $("#id_top_menuIniciarSesión").on("click",setearModalLoginRecarga)
    $("#btn-login-preloader").on("click",setearModalOnlyLogin);

    $("#form_recuperar_password").validate({
    rules: {
            new_password:
            {
                required:true
            },
            repeat_password: {
              equalTo: "#new_password"
            }
        },
    errorPlacement: function(error, element) {
         error.insertAfter($(element).parent());
    },
    submitHandler: function(form) {
        var url = $(form).attr("action");
        var dataSend = $(form).serialize();
        $.post( url, dataSend, function( data ) {
            if(data.status==='ok'){
                var form_change_password;
                form_change_password = $(form).parent().parent();
                form_change_password.hide();
                $('#recuperar_exito_cambiopassword').modal('show');
            } else {
                var alert;
                alert = $(form).parent().find('.alert.alert-danger');
                alert.removeClass('hidden');
                alert.find('.alert-message').html(data.messages);

            }
        }, "json");

    }
  });
  readRememberPassword($('form.form-login').find('#remember'),$("input[name='username']"), $("input[name='password']"));
    $("input[name='type']").on("click",hideAlertas);

}
function hideAlertas(){
    $(".alert-danger").addClass("hidden");
    $(".alert-message").html("");
}

$('#loginModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    modal.removeClass('modal-login');
    modal.removeClass('modal-recarga');
    if (recipient === 'recarga') {  
        modal.addClass('modal-recarga');
    }
    if (recipient === 'login') {
        modal.addClass('modal-login');
    }
});

$('#recoverPasswordModal').on('show.bs.modal', function (event) {
    $('#loginModal').modal('hide');
});

$('.form-recarga-directa').each(function() { 
        $(this).validate({
            rules:{
                nroType:
                {
                    required:true,
                    alphanumerics:true
                }
            },
            errorPlacement: function(error, element) {                
                if (element.attr('type') === 'radio') {
                    error.appendTo( element.parent().parent());
                } else {
                    error.insertAfter($(element).parent());
                }
                
            },
            submitHandler: function(form) {                
                $("#loginModal").modal("hide");
                $("#modal_recargadirecta").modal("hide"); 
                setTimeout(function(){ mostrarPreloader(); }, 200);               
                
                    $.ajax({
                        url: $(form).attr("action"),
                        data:  $(form).serialize()+ '&idPlan=' + idPlan,  
                        type: 'POST',
                        dataType: 'json',
                        success:function(data) {
                                if(data.status==='ok'){  
                                    window.location = '/mi-cuenta/recarga-directa';
                                } else {
                                    $(form).parent().find('.alert').removeClass('hidden');
                                    $(form).parent().find('.alert-message').html('');
                                    $.each(data.messages, function (key, val) {
                                         $(form).parent().find('.alert-message').append($('<p>').text(val));
                                    });
                                    ocultarPreloader();
                                    if(flagModalPreload==="btn-recarga-sesion")
                                    {
                                        setTimeout(function(){ $("#loginModal").modal("show"); }, 200);
                                        
                                    }
                                    else if(flagModalPreload==="btn_only_recarga")
                                    {
                                        setTimeout(function(){ $("#modal_recargadirecta").modal("show"); }, 200);                                        
                                    }
                                     
                                }
                        },
                        error:function() {
                            $(form).parent().find('.alert-message').html('');
                            $(form).parent().find('.alert').removeClass('hidden');
                            $(form).parent().find('.alert-message').html('Se ha producido un error inesperado. Inténtelo de nuevo más tarde.');
                            ocultarPreloader();
                                    if(flagModalPreload==="btn-recarga-sesion")
                                    {
                                        setTimeout(function(){ $("#loginModal").modal("show"); }, 200);
                                    }
                                    else if(flagModalPreload==="btn_only_recarga")
                                    {
                                        setTimeout(function(){ $("#modal_recargadirecta").modal("show"); }, 200);                                        
                                    }
                        }
                    });
            }
        });
});

$("#form-recoverpassword").validate({
    errorPlacement: function(error, element) {
         error.insertAfter($(element).parent());
    },
    submitHandler: function(form) {
        var url = $(form).attr("action");
        var dataSend = $(form).serialize();
        $("#recoverPasswordModal").modal('hide');
        setTimeout(function(){ mostrarPreloader(); }, 200);
        $.post( url, dataSend, function( data ) {
            ocultarPreloader();                        
            setTimeout(function(){ $("#recoverPasswordModal").modal('show'); }, 200);
            var alert;
            if(data.status==='ok'){    
                alert = $(form).parent().find('.alert.alert-success');
                $(form).parent().find('.alert.alert-danger').hide();
                $(form).parent().find('h5').hide();
                $(form).hide();   
            } else {
                alert = $(form).parent().find('.alert.alert-danger');
            }
            //confirm("Press a button!");
            alert.removeClass('hidden');
            alert.find('.alert-message').html(data.messages);
        }, "json");

    }
});

$("#form-only-recoverpassword").validate({
    errorPlacement: function(error, element) {
         error.insertAfter($(element).parent());
    },
    submitHandler: function(form) {
        var url = $(form).attr("action");
        var dataSend = $(form).serialize();
        $.post( url, dataSend, function( data ) {
            var alert;
            if(data.status==='ok'){
                alert = $(form).parent().find('.alert.alert-success');
                $(form).parent().find('.alert.alert-danger').hide();
                $(form).parent().find('.mensaje-confirmacion').hide();
                $(form).parent().find('h5').hide();
                $(form).hide();
            } else {
                alert = $(form).parent().find('.alert.alert-danger');
            }
            alert.removeClass('hidden');
            alert.find('.alert-message').html(data.messages);
        }, "json");

    }
});

$('.generate-new-check-email').click(function(){
    var parent = $(this).parent().parent();
    var url = 'login/sendCheckEmail';
    var dataSend = { email: parent.find('.email_check').val(), iduser: parent.find('.iduser_check').val()};
    
    $.post( url, dataSend, function( data ) {
            var alert;
            if(data.status==='ok'){
                $("#check_email_caducidad_cuenta").modal('hide');
                $("#agradecimiento_cuenta").modal('show');
            } else {
                alert = parent.find('.alert.alert-danger');
                alert.removeClass('hidden');
                alert.find('.alert-message').html(data.messages);
            }
    }, "json");
  
});

function mostrarPreloader()
{
    $("#pagetransition").css("display","block");
    $("#bg").css("height","100%");
    //$("html").css("background","black")
    //$('#modal_only_login').modal('hide')
}
function ocultarPreloader()
{
    $("#pagetransition").css("display","none");
    $("#bg").css("height","0%");   
    //$('#modal_only_login').modal('hide')
}   

$('.form-login').each(function() { 
    $(this).validate({
        errorPlacement: function(error, element) {
             error.insertAfter($(element).parent());
        },
        submitHandler: function(form) {

            //alert("jquery validate ocultando modales");
            
            
            $("#loginModal").modal("hide");
            $("#modal_only_login").modal("hide");
             
            //alert("jquey validate mostrar preload");
            setTimeout(function(){ mostrarPreloader(); }, 200);
            
            saveRememberPassword($(form).find('#remember'),$(form).find("input[name='username']"), $(form).find("input[name='password']"));
            $.ajax({
                url: $(form).attr("action"),
                data:  $(form).serialize(),            
                type: 'POST',
                dataType: 'json',
                success:function(data) {
                        if(data.status==='ok'){  
                            //alert($("#cerificadorFlag4").val());
                            if($("#cerificadorFlag4").val()=="si")
                            {
                                window.location = '/registro-individual';
                            }
                            else
                            {
                                window.location = '/mi-cuenta';    
                            }
                            
                        }
                        else  if(data.status==='UserMpe'){
                            ocultarPreloader();
                            $("#loginModal").modal("hide");                            
                            setTimeout(function(){ $("#recoverPasswordModal").modal("show");}, 200);
                            $("#title-recover-pw").html("Una web renovada, pensando en usted");
                            $("#mensaje-seguiradad-contra").html("<p>Un portal más sencillo que le permite conocer su saldo, el detalle de sus transacciones y realizar sus recargas en forma más rápida. </p>");
                            $("#mensaje-seguiradad-contra").append("<p>Click en Continuar para restaurar su contraseña</p>");
                            var correo=$("#correo-user-zkt").val();
                            $("#correo-recupera-pw").val(correo);
                        }
                        else {
                            //alert("bd: ocultar preload");
                            ocultarPreloader();
                            if(flagModalPreload==="modal_preload_sesion_recarga")
                            {
                                //alert("bd: mostrar modal loginModal");
                                setTimeout(function(){ $("#loginModal").modal("show");}, 200);
                                
                            }
                            else if(flagModalPreload==="modal_preloader_only_login")
                            {
                                //alert("bd: mostrar modal modal_only_login");
                                setTimeout(function(){ $("#modal_only_login").modal("show"); }, 200);
                                
                            }
                            $(form).parent().find('.alert').removeClass('hidden');
                            $(form).parent().find('.alert-message').html(data.messages);
                            ocultarPreloader();             
                        }
                       
                },
                error:function() {
                    //alert("error: ocultar preload")
                    ocultarPreloader();
                    $(form).parent().find('.alert').removeClass('hidden');
                    $(form).parent().find('.alert-message').html('Se ha producido un error inesperado. Inténtelo de nuevo más tarde.');
                    ocultarPreloader();
                    if(flagModalPreload==="modal_preload_sesion_recarga")
                    {
                        //alert("error: mostrar modal loginModal");
                        setTimeout(function(){ $("#loginModal").modal("show"); }, 200);
                        
                    }
                    else if(flagModalPreload==="modal_preloader_only_login")
                    {
                        //alert("error: mostrar modal modal_only_login");
                        setTimeout(function(){ $("#modal_only_login").modal("show"); }, 200);
                        
                    }
                }
            });
        }
    });    
});

function msgConfirmacionNaranja(){
    $("#confirmacion_cuenta").modal('show');
}
function msgAgradecimientoCuenta(){
    $("#agradecimiento_cuenta").modal('show');
}
function msgActivacionCuenta(){
    $("#activacion_cuenta").modal('show');
}
function msgCaducidadCuenta(){
    $("#caducidad_cuenta").modal('show');
}
function msgExitoCambioPassword(){
    $("#exito_cambiopassword").modal('show');
}
function msgRecuperarPassword(){
    $("#modal_recuperar_contra").modal('show');
}


function saveRememberPassword(inputRemember,inputUsername, inputPassword) {
    if (inputRemember.is(':checked')) {

        var username =inputUsername.val();
        var password = inputPassword.val();
        // set cookies to expire in 14 days
        $.cookie('username', username, { expires: 14 });
        $.cookie('password', password, { expires: 14 });
        $.cookie('remember', true, { expires: 14 });
    } else {
        // reset cookies
        $.cookie('username', null);
        $.cookie('password', null);
        $.cookie('remember', null);
    }
}

function readRememberPassword(inputRemember,inputUsername, inputPassword) {
    
    var remembercookie = $.cookie('remember');

    if ( remembercookie == 'true' ) {
        var username = $.cookie('username');
        var password = $.cookie('password');
        // autofill the fields
        
        inputUsername.val(username);
        inputPassword.val(password);
        inputRemember.prop("checked", true); 
    }
}
function recargaEvent() {

    if(authStatus == 1) {
        window.location = '/mi-cuenta/recarga-directa';
    } else {
        $('#modal_recargadirecta').modal('show');
    }
}

$(".form-recarga-directa tipos input[name='type']").change(function() {
    $(".form-recarga-directa").parent().find('.alert').removeClass('hidden');
});


$(window).bind("load", function() { 
    $('.video-Epass').html('<iframe  src="https://www.youtube.com/embed/ceO3zECLc1k" frameborder="0" allowfullscreen></iframe>');
});
