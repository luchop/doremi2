function ValidaApellido(){
    if($("#Paterno").val()!="")
    {
        $("#errorContainer li").remove();
        $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
        $("#errorContainer").css('display','');
        return true;
    }
    else if($("#Materno").val()!="")
    {
                        
        $("#errorContainer li").remove();
        $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
        $("#errorContainer").css('display','');
                       
        return true;
    }
    else
    {
        $("#errorContainer").css('display','block');
        $("#errorContainer li").remove();
        $("#errorContainer").append("<li>Debe ingresar por lo menos un apellido.</li>");
        return false;
    }
}
function rotateTab()
{
    var numTabs=2;
    var nextTab;
    tab = $('#tabs').tabs("option", "selected"); 
    //alert(tab);
    if(tab<2)
        nextTab=tab+1;
    else
        nextTab=0;
                
    $( "#tabs" ).tabs({
        selected:nextTab
    });
    
}
$(document).ready(function () {

$("#CodCarrera").change(function() {
        
        $.ajax({
            url:url3,
            type:'post',
            dataType:'text',
            data:{
              CodCarrera:$(this).val()  
            },
            success:function(data){
                $("#subsede").html(data);
            }
        });
    });
    
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;//rotateTab();
        }
    });
                
    $('input[type=text]').keypress(function(e){ 
        if(e.which == 13){ 
            return false;
        } 
    }); 

    $("#TelUrgencia").keypress(function(e){
        if(e.which == 13){ 
            rotateTab();
            //alert("si");
            $("#Colegio").focus();      
            return false;
        } 
    });

    $("#NumTitulo").keypress(function(e){
        if(e.which == 13){ 
            rotateTab();
            $("#CodZona").focus();      
            return false;
        } 
    });

    $('input[type=submit]').keypress(function(e){ 
        return false;
    }); 

    // Tabs
    $('#tabs').tabs();

    // Button
    $("input[type=button],input[type=submit]").button();
    $(".enlace").button();
                
    $('#FechaNac').datepicker({
        inline: false,
        changeMonth:true,
        changeYear:true,
        dateFormat:"dd-mm-yy",
        yearRange: '1950:2012',
        onSelect:function(){
            $("#form").validate().element(this);
        }
    });
                			
    $('#errorContainer2').dialog({
        autoOpen: false,
        width: 600,
        modal:true,
        position:[300,-300],
        title:'Errores en el formulario'
                    
    });

    // Dialog Link
    $('#dialog_link').click(function () {
        $('#dialog').dialog('open');
        return false;
    });
    $('#trabajano').click(function(){
        if($(this).is(':checked'))
        {
            $('#Trabajo').attr('disabled', 'true');
            $('#Jornada').attr('disabled', 'true');
            $('#Trabajo option[value=]').attr('selected',true);
            $('#Jornada option[value=]').attr('selected',true);
        }
    });
    $('#trabajasi').click(function(){
        if($(this).is(':checked'))
        {
            $('#Trabajo').attr('disabled', '');
            $('#Jornada').attr('disabled', '');
            
        }
    });
    $('#trabajaeventual').click(function(){
        if($(this).is(':checked'))
        {
            $('#Trabajo').attr('disabled', '');
            $('#Jornada').attr('disabled', '');
        }
    });
             
             
    $("#form").validate({
        highlight: function(label) {
            $(label).closest('#form #tabs .field').addClass('error2');
        },
        success: function(label) {
        ;
        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            var errores="";
            for (var i=0;i<validator.errorList.length;i++){
                errores+="<li>"+validator.errorList[i].message+"</li>";
            }
            
            if (errors) {
                var message = errors == 1
                ? 'Tienes 1 campo incorrecto'
                : 'Tienes' + errors + ' campos incorrectos.';
                
                $('#errorContainer2').html(message+"<br>"+errores);
                $('#errorContainer2').dialog('open');
                
                
            } else {
                $("errorContainer").hide();
            }
            
        },
        
        
        errorContainer: "#errorContainer",
        errorLabelContainer: "#errorContainer",
        errorElement: "li" ,
        rules: {
                        
            'CI':  {
                required: true, 
                number: true
            },
            'Nombres': 'required',
            'FechaNac':'required',
            'LugarNac':'required',
            'Domicilio':   'required',
            'EstadoCivil':'required',
            'Colegio':'required',
            'AnioEgreso':{
                required: true, 
                number: true,
                maxlength:4,
                minlength:4,
                range:[1950,2020]
            },
            'TipoColegio':'required',
            'CodZona':'required',
            'Vivienda':'required',
            'Caracteristicas':'required',
            'CodUniversidad':'required',
            'CodCarrera':'required',
            'Correo':{
                email:true
            },
            'Trabajo':'required',
            'Jornada':'required'
        
        },
        messages: {
                        
            'CI':{
                required:'Debe ingresar su n&uacute;mero de identificaci&oacute;n!',
                number:'El documento de identificaci&oacute;n debe ser un n&uacute;mero!'
            },
            'Nombres': 'Debe ingresar el nombre.',
            'FechaNac':'Debe ingresar su fecha de nacimiento.',
            'LugarNac':'Debe registrar su lugar de nacimiento.',
            'Domicilio':   'Debe registrar su domicilio.',
            'EstadoCivil':'Debe seleccionar su estado civil.',
            'Colegio':'Debe escribir el nombre de su colegio de egreso.',
            'AnioEgreso':{
                required:'Debe ingresar el a&ntilde;o de egreso de colegio.',
                number:'El a&ntilde;o de egreso de colegio debe ser n&uacute;mero!',
                maxlength:'Su a&ntilde;o de egreso de colegio debe ser una gesti&oacute;n v&aacute;lida.',
                minlength:'Su a&ntilde;o de egreso de colegio  debe ser una gesti&oacute;n v&aacute;lida.',
                range:'Su a&ntilde;o de egreso de colegio debe ser una gestion v&aacute;lida.'
            },
                        
            'TipoColegio':'Debe seleccionar el tipo de su colegio.',
            'CodZona':'Debe seleccionar la zona de donde habita!',
            'Vivienda':'Debe seleccionar el tipo de vivienda!',
            'Caracteristicas':'Debe seleccionar las caracter&iacute;sticas de su vivienda!',
            'CodUniversidad':'El campo "Expedido por" es obligatorio.',
            'CodCarrera':'Por favor, escoja una carrera.',
            'Correo':{
                email:'Ingrese un correo v&alido.'
            },
            'Trabajo':'El trabajo es obliglatorio.',
            'Jornada':'La jornada laboral es obligatoria'
        
        },
        debug: true,
        submitHandler: function(form){
            $.ajax({
                url:url1,
                dataType:'text',
                data:{
                    Pais:$("#PaisNacimiento").val()
                },
                type:'POST',
                success:function(data){
                    if(data=="1"){
                        //tiene que tener expedido
                        if($("#Expedido").val()=="")
                        {
                            $("#errorContainer").css('display','block');
                            $("#errorContainer li").remove();
                            $("#errorContainer").append("<li>Debe seleccionar el lugar de expedici&oacute;n del carnet.</li>");
                            return false;
                        }
                        else{
                            $("#errorContainer li").remove();
                            $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
                            $("#errorContainer").css('display','');
                            if(ValidaApellido()) form.submit();
                        }
                    } 
                    else
                    {
                        $("#errorContainer li").remove();
                        $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
                        $("#errorContainer").css('display','');
                        if(ValidaApellido()) form.submit();   
                    }
                }
                           
            });
        } 
    });           
});