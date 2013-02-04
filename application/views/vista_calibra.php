<hr />
<div id="main_container" class='span-12 prefix-6 suffix-6 last center'>
    <div id="header"></div>
    <div id="content">
        <div id="sub_container">
            <input type="button" title="Guarda el diseño de la matrícula." onclick="javascript:guarda('<?php echo $URLControlador; ?>');" value="Guardar" />
            <input type="button" title="Guarda y exporta el diseño." onclick="javascript:exporta('<?php echo $URLControlador; ?>');" value="Exportar diseño" />
            <!-- <input type="button" onclick="javascript:reset();" value="Resetear calibracion" /> -->
            <input type="button" title="Rrealiza una impresión de prueba." onclick="javascript:imprime('<?php echo $URLControlador; ?>');" value="Imprimir prueba" />
            <br /><br />
            Sep. horizontal: <input type="text" size='3' name="hs" id="hs" value="<?php echo (isset($espacios['hs']))?$espacios['hs']:''; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
            Sep. vertical: <input type="text" size='3' name="vs" id="vs" value="<?php echo (isset($espacios['vs']))?$espacios['vs']:''; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
            Margen superior para pie: <input type="text" size='3' name="ms" id="ms" value="<?php echo (isset($espacios['ms']))?$espacios['ms']:''; ?>" />
            <br /><br />
            <div id="anverso" style='height:350px'>
                <?php if ($anverso){ echo stripslashes($anverso);} else { ?>
                <div class="draggable">{Apellidos y Nombres}</div>
                <div class="draggable">{Carnet}</div>
                <div class="draggable">{Reg. universitario}</div>
                <div class="draggable">{Carrera}</div>
                <div class="draggable">{Domicilio}</div>
                <div class="draggable">{Fecha}</div>
                <div class="draggable">{Categoria}</div>
                <div class="draggable">{Numero}</div>
                <?php } ?>
            </div>
            <br />
            <div id="reverso" style='height:350px'>
                <?php if ($reverso){ echo stripslashes($reverso);} else { ?>
                <div class="draggable">{Apellidos y Nombres}</div>
                <div class="draggable">{Carnet}</div>
                <div class="draggable">{Reg. universitario}</div>
                <div class="draggable">{Carrera}</div>
                <div class="draggable">{Domicilio}</div>
                <div class="draggable">{Fecha}</div>
                <div class="draggable">{Categoria}</div>
                <div class="draggable">{Numero}</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="footer"></div>