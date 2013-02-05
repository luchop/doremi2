<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $( "#Mensaje" ).dialog({
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
            
        $( "#opener" ).click(function() {
            $( "#Mensaje" ).dialog( "open" );
        });
    });

    $("#formulario").validate({
        rules: {
            AnioIngreso: {
                required: true,
                number : true,
                min: 2001,
                max: 2020
            },
            Matricula: {
                required: true,
                number : true
            },
            RegUniversitario: {
                required: true,
                number : true
            },
            Anexo: {
                number : true
            },
            AnioEgreso: {
                number : true,
                min: 2006,
                max: 2020
            },
            DocIngreso: {
                required: true
            },
            NumArchivo: {
                required: true
            },
            CodCarrera: {
                required: true
            }
        },
        messages: {
            AnioIngreso: {
                required: "El año de ingreso es dato obligatorio.",
                number: "El campo 'año de ingreso' sólo puede contener números.",
                min: "El año de ingreso no puede ser inferior a 2001.",
                max: "El año de ingreso no puede ser superior a 2020."
            },
            Matricula: {
                required: "El número de matrícula es dato obligatorio.",
                number: "El campo 'Matrícula' sólo puede contener números."
            },
            RegUniversitario: {
                required: "El registro universitario es dato obligatorio.",
                number: "El registro universitario sólo puede contener números."
            },
            Anexo: {
                number: "El campo 'Anexo' sólo puede contener números."
            },
            AnioEgreso: {
                number: "El campo 'año de egreso' sólo puede contener números.",
                min: "El año de ingreso no puede ser inferior a 2006.",
                max: "El año de ingreso no puede ser superior a 2020."
            },
            DocIngreso: {
                required: "Debe señalar el documento de ingreso."
            },
            NumArchivo: {
                required: "El número de archivo es un dato obligatorio."
            },
            CodCarrera: {
                required: "Debe indicar la carrera del universitario."
            }
        },
        errorContainer: "#errorContainer",
        errorLabelContainer: "#errorContainer",
        errorElement: "li"
    });
    $("#Egresado").click(function() {  
        if($("#Egresado").is(':checked')) 
            $("#AnioEgreso").removeAttr("disabled"); 
        else 
            $("#AnioEgreso").attr("disabled", true);
    }); 
});
</script>

<div class='span-22 prefix-1 suffix-1 last'>
<?php 
echo form_open("matriculacion/NuevaMatricula/$CodPersona",  array('id' => 'formulario', 'name' => 'formulario'));
?>
<fieldset><legend>Formulario de matriculaci&oacute;n - <?php echo $this->session->userdata('Gestion'); ?></legend>
<h4 class='center'><?php echo "Univ. ".$this->modelo_persona->GetNombre($CodPersona); ?> </h4><hr />

<div id='errorContainer'> <?php echo validation_errors(); ?> </div> 

<!-- ************** -->
<div id="Mensaje" title="Importante!">
<p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<button id="opener">Open Dialog</button>
<!-- ************** -->

<div class="span-7 center">
	<label for='AnioIngreso'>A&ntilde;o de ingreso </label> 
		<input type='text' name='AnioIngreso' id='AnioIngreso' size=4 maxlength=4 value='<?php echo $AnioIngreso; ?>' /><br />
</div>
<div class="span-7 center">
	<label for='Matricula'>Matr&iacute;cula </label>
		<input type='text' name='Matricula' id='Matricula' size=11 maxlength=11 value='<?php echo $Matricula; ?>'><br />
</div>
<div class="span-8 center last">
	<label for='RegUniversitario'>Reg. univ. </label>
		<input type='text' name='RegUniversitario' id='RegUniversitario' size=9 maxlength=10 value='<?php echo $RegUniversitario; ?>'>
		<input type='text' name='Anexo' id='Anexo' size=2 maxlength=2 value='<?php echo $Anexo; ?>'><br />   	   
</div><hr />

<div class="span-16 center">
	<input type="checkbox" id="Egresado" name="Egresado" <?php echo $Egresado ?> value="Egresado" /> Egresado&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="Profesional" name="Profesional" <?php echo $Profesional ?> value="Profesional" /> Profesional&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="Traspaso" name="Traspaso" <?php echo $Traspaso ?> value="Traspaso" /> Traspaso&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="Magisterio" name="Magisterio" <?php echo $Magisterio ?> value="Magisterio" /> Plan magisterio<span>
</div>
<div class="span-6 center last">
	<label for='AnioEgreso'>A&ntilde;o de egreso </label>
	   <input type ='text' name='AnioEgreso' id='AnioEgreso' size=4 maxlength=4 disabled value='<?php echo $AnioEgreso; ?>'></span>
</div><hr />

<div class="span-22 center last">
	<input type="checkbox" id="Titulo" name="Titulo" <?php echo $Titulo ?> value="Titulo" /> T&iacute;tulo de bachiller&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="FotocopiaCI" name="FotocopiaCI" <?php echo $FotocopiaCI ?> value="FotocopiaCI" /> Fotocopia de C.I.&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="Certificado" name="Certificado" <?php echo $Certificado ?> value="Certificado" /> Certificado de nacimiento&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" id="Fotografia" name="Fotografia" <?php echo $Fotografia ?> value="Fotografia" /> Fotograf&iacute;as<br />
</div><hr />

<div class="span-11 center">
	<label for='DocIngreso'>Doc. de ingreso </label><?php echo $ComboDocIngreso;?>
</div>
<div class="span-11 center last">
	<label for='NumArchivo'>N&uacute;mero de archivo </label>
		<input type ='text' name='NumArchivo' id='NumArchivo' size=10 maxlength=10 value='<?php echo $NumArchivo;?>'><br />
</div><hr />

<div class="span-11 center">
    <label for='CodCarrera'>Carrera actual </label><?php echo $this->modelo_carrera->ComboCarrerasHabilitadas($CodCarrera, 'CodCarrera', True, True); ?>
</div>
<div class="span-11 center last">
	<label for='CodCarreraOrigen'>Carrera origen </label><?php echo $this->modelo_carrera->ComboCarrerasHabilitadas($CodCarreraOrigen, 'CodCarreraOrigen', False, True); ?><br />
	<label for='CodCambio1'>1er. cambio </label><?php echo $this->modelo_carrera->ComboCarrerasHabilitadas($CodCambio1, 'CodCambio1', False, True); ?><br />
	<label for='CodCambio2'>2do. cambio </label><?php echo $this->modelo_carrera->ComboCarrerasHabilitadas($CodCambio2, 'CodCambio2', False, True); ?>
</div><hr />

<div class="span-7 center">
	<label for='Fecha'>Fecha </label>
	<?php
	echo "<input type='text' name='Fecha' id='Fecha' size='12' maxlength='10' class='required' onclick='";
	echo 'fPopCalendar("Fecha")'."' value='".$Fecha."'/>";
	?>
</div>
<div class="span-7 center">
	<label for='NumDeposito'>N&uacute;m. dep&oacute;sito </label>
	  <input type='text' id='NumDeposito' name='NumDeposito' size='10' maxlength='10' value='<?php echo $NumDeposito; ?>' /><br />
</div>
<div class="span-8 center last">
	<label for='Deposito'>Dep&oacute;sito </label>
	  <input type='text' id='Deposito' name='Deposito' size='10' maxlength='10' class='required number' value='<?php echo $Deposito; ?>' /><br />  
</div><hr />

<input type='hidden' id='CodPersona' name='CodPersona'value='<?php echo $CodPersona; ?>' />

<div class="span-22 center last">
<label for='Notas'>Notas</label>
<textarea id='Notas' name='Notas' cols='100' rows='2'>
<?php echo $Notas; ?>
</textarea>
</div>

<input type='hidden' id='Opcion' name='Opcion' value='<?php echo $Opcion; ?>' />
<hr />

<div class='span-4 prefix-9 suffix-9 last center'>
	<button class="button positive">
		<img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
	</button>
</div>

</fieldset>
</form>
</div>