<?php include_once('script.inc'); ?>

<div class="span-12 prefix-6 suffix-6 last center">
    <?php echo form_open("listados/ListaPorCarrera1", array('id'=>'Formulario')); ?>
    
    <fieldset><legend>Listado por carrera</legend>
    <div id='errorContainer'></div>
    <br />
    <label for='Estado'>Carrera </label>
    <?php echo $ComboCarrera; ?><br /><br />

    <label for='Hasta'>Gesti&oacute;n </label>
    <?php echo $ComboGestion; ?><br /><br />

    <label for='Incluir'>Incluir </label>
    <input type="checkbox" id="CI" name="CI" <?php echo ($CI? 'checked':''); ?>/> C.I.&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="checkbox" id="RegUniversitario" name="RegUniversitario" <?php echo ($RegUniversitario? 'checked': ''); ?>/> Reg. universitario 

    <br /><br /><hr />
    <button class='button positive' style='margin-left:180px;'> 
        <img src='<?php echo base_url();?>css/images/icons/tick.png' alt='' /> Imprimir
    </button>
    </fieldset>
    </form>
</div>