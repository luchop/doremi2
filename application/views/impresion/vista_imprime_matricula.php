<script>var URLControlador='<?php echo base_url().'index.php/calibra'; ?>'</script>
<style>
    .primero{
        margin-right:<?php echo (isset($espacios)) ?($espacios['hs']):'0'; ?>px;
    }
    .debajo{
        margin-top:<?php echo (isset($espacios)) ?($espacios['vs']):'0'; ?>px;
    }
</style>

<script>
$(document).ready(function() {
    window.print();
});
</script>

<div id="sub_container">
    <div id="anverso" class="bloque primero">
        <?php if (isset($anverso)){ echo stripslashes($anverso);} ?>
    </div><div id="anverso1" class="bloque">
        <?php if (isset($anverso)){ echo stripslashes($anverso);} ?>
    </div><br />
    <div id="reverso" class="bloque primero debajo">
        <?php if (isset($reverso)){ echo stripslashes($reverso);} ?>
    </div><div id="reverso" class="bloque debajo">
        <?php if (isset($reverso)){ echo stripslashes($reverso);} ?>
    </div><br />
    <div id="reverso" class="bloque primero debajo">
        <?php if (isset($reverso)){ echo stripslashes($reverso);} ?>
    </div><div id="reverso" class="bloque debajo">
    <?php if (isset($reverso)){ echo stripslashes($reverso);} ?>
    </div>
</div>