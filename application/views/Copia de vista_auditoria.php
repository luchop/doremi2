<script>
$(document).ready(function(){
    $("#buscar").click(function(){
        $.ajax({
            url:"<?php echo base_url();?>index.php/auditoria/Listado",
            dataType:'text',
            data:{
                Apellido:$("#Paterno").val(),
                Registro:$("#Registro").val(),
                Ci:$("#Carnet").val()
            },
            type:'POST',
            success:function(data){
                $("#resultado").html(data);
            }
        });
    });
});     
</script>

<div  class='span-12 prefix-6 suffix-6  center'>
    
<form>
<fieldset>
    <legend>Buscar universitario afectado:</legend>
    <br/>
    
    <div><label>Registro universitario</label><input type="text" name="Registro" id="Registro" value="" /></div>
    <div><label>Apellido : </label>  <input type="text" name="Paterno" id="Paterno" maxlength="20" value=""/></div>
    <div><label>N&uacute;mero de carnet o pasaporte :</label><input type="text" name="Carnet" id="Carnet" maxlength="10" value=""/></div><br /><br />
    <div><input type="button" value="Buscar" name="buscar" id="buscar" class='buttonok' /></div>
</fieldset>
</form>
<div id="resultado">
    
</div>
</div>
