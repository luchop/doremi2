<script>
    $(document).ready(function(){
        $(":input:first").focus();
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-zA-ZáéíóúñÑ ]+$/i.test(value);
        }, "Solo letras, por favor.");

        $("#form").validate({
            highlight: function(label) {    
                ;
            },
            errorContainer: "#errorContainer",
            errorLabelContainer: "#errorContainer",
            errorElement: "li" ,
            rules: {
                'Nombres': {required:true,
                            lettersonly:true
                },
                'Carnet': { required: true, number: true },
                'CodCarrera':'required',
                'Paterno':{ lettersonly:true},
                'Materno':{ lettersonly:true}
            },
            messages: {
                'Nombres':{ required:'Debe ingresar el nombre!',
                    lettersonly:'El nombre solo debe contener letras!'
                },
                'Paterno':{ lettersonly:'El apellido solo debe contener letras!'},
                'Materno':{ lettersonly:'El apellido solo debe contener letras!'},
                'Carnet': {
                    required:'Debe ingresar su n&uacute;mero de identificaci&oacute;n!',
                    number:'El documento de identificaci&oacute;n debe ser un n&uacute;mero!'
                },
                'CodCarrera':'La Carrera es obligatoria!'
            },
            debug: true,
            submitHandler: function(form){
                if($("#Paterno").val()!="")
                {
                    $("#errorContainer li").remove();
                    $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
                    $("#errorContainer").css('display','');
                    form.submit();
                }
                else if($("#Materno").val()!="") {
                    $("#errorContainer li").remove();
                    $("#errorContainer").append("<li><strong style='color:green;'>El formulario ha sido validado correctamente!</strong></li>");
                    $("#errorContainer").css('display','');
                    form.submit();
                }
                else {
                    $("#errorContainer").css('display','block');
                    $("#errorContainer").append("<li>Debe ingresar por lo menos un apellido!</li>");
                    return false;
                }
            }
        });
    });
</script>

<style>
    label {width:200px; text-align:right}
</style>

<br/>
<hr>
<div id="formulario" class="span-12 prefix-6 suffix-6 last center">
    <form action="<?php echo base_url() ?>index.php/formulario/Busqueda" method="POST" id="form" name="form">
        <fieldset>
            <legend>Introduzca sus datos cuidadosamente, por favor.</legend>
            <br />
            <label>Nombre(s) del estudiante :</label>  <input type="text" name="Nombres" title="Nombre(s). Ejemplo: Luis Alberto"
                id="Nombres" maxlength="30" value=""/><br /><br />
            <label>Apellido paterno :</label>  <input type="text" name="Paterno" id="Paterno" title="Apellido paterno. Ejemplo: P&eacute;rez"
                maxlength="20" value=""/><br /><br />
            <label>Apellido materno :</label>  <input type="text" name="Materno" id="Materno" title="Apellido materno. Ejemplo: G&oacute;mez"
                maxlength="20" value=""/><br /><br />
            <label>N&uacute;mero de carnet o pasaporte :</label><input type="text" name="Carnet" id="Carnet" title="N&uacute;mero del carnet (bolivianos) o del pasaporte (extranjeros)"
                maxlength="10" value=""/><br /><br />
            <label>Carreras habilitadas hoy :</label><?php echo $ComboCarrera;?><br /><br /><hr />
            <div class='span-3 prefix-5 suffix-4 last center'>
                <button class="button positive">
                    <img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Continuar
                </button>
            </div>
        </fieldset>
    </form>
    <div id="errorContainer"></div>
</div>

<div class="span-14 prefix-5 suffix-5 last">
    <h6>Pasos:</h6>
    <ol>
        <li>Los pre-universitarios habilitados deben registrar sus datos en este formulario.</li>
        <li>Al finalizar, <strong>imprimir</strong> el formulario registrado</li>
        <li>Llevar el formulario impreso a las ventanillas de la oficina de <strong>Registros y Admisiones</strong></li>
    </ol>
</div>