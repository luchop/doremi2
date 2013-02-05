<?php include_once('script.inc'); ?>

<div id='formulario' class='span-12 prefix-6 suffix-6 center last'>
    <?php echo form_open("listados/ExportaListaCarrera", array('id'=>'Formulario')); ?>
    <fieldset><legend>Listado por carrera</legend>
    <div id='errorContainer'></div>
    <br />
    <label for='Estado'>Carrera </label>
    <?php echo $ComboCarrera; ?><br /><br />

    <label for='Hasta'>Gesti&oacute;n </label>
    <?php echo $ComboGestion; ?><br /><br />

    <br /><hr />
    <button class='button positive' style='margin-left:180px;' name='exportar' id='exportar' value='exportar'> 
        <img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Exportar
    </button>
    </fieldset>
    </form>
</div>