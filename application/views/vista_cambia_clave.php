<script type="text/javascript">

$(document).ready(function(){
    $("#formulario").validate({
        highlight: function(label) {
        ;
    },
    success: function(label) {
        ;
    },
    
        
    errorContainer: "#errorContainer",
    errorLabelContainer: "#errorContainer",
    errorElement: "li" ,
  rules: {
    ClaveActual: {
      required: true
    },
	NuevaClave1: {
      required: true,
      minlength: 6
    },
	NuevaClave2: {
      required: true,
      minlength: 6,
	  equalTo: NuevaClave1
    }
  }
})});
</script>
<div  class='span-10 prefix-7 suffix-7 last'>
 <?php 
echo form_open("cambia_clave/Guardar",  array('id' => 'formulario', 'name' => 'formulario'));
?>
<fieldset>
    <legend>Cambio de contrase&ntilde;a</legend>
<br />

<div>
<label for='ClaveActual'>Clave actual *</label>
<input type='password' name='ClaveActual' id='ClaveActual' maxlength='15' size='20' value='' /><br />
</div>
<div>
<label for='NuevaClave1'>Nueva clave *</label>
<input type='password' name='NuevaClave1' id='NuevaClave1' maxlength='15' size='20' minlength='6' value='' /><br />
</div>
<div>
<label for='NuevaClave2'>Confirmaci&oacute;n de clave *</label>
<input type='password' name='NuevaClave2' id='NuevaClave2' maxlength='15' size='20' value='' /><br />
</div>
<hr />
<div>
    <button class='button positive' style='margin-left:140px;'> 
        <img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Cambiar
    </button> 	  
</div>

</fieldset>
<div id="errorContainer"><?php echo validation_errors();?></div>
</form>

</div>