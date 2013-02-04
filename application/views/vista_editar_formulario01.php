<script>var url1="<?php echo base_url(); ?>index.php/formulario/ValorPais";
    var url2="<?php echo base_url(); ?>index.php/Formulario/VerificaCI";
    var url3="<?php echo base_url(); ?>index.php/formulario/CargaSubsede";
</script>
<?php echo "<script type='text/javascript' src='" . base_url() . "js/formulario01.js'></script>";?>
<style type="text/css">
    table,table tr, table tr td{border:none;}
</style>

<div class="span-20 prefix-2 suffix-2 last center">
    <h4 class='center'>
    <?php
        if($Categoria=='Antiguo') echo "Antiguo";
        elseif($Categoria=='BachillerWeb') echo "Bachiller registrado v&iacute;a internet";
        else echo "Registro de nuevo universitario";
    ?>
    </h4>
    <!-- Tabs -->
    <form name="form" action="<?php echo base_url(); ?>index.php/Formulario/Guardar" method="POST" id="form">

        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Datos generales</a></li>
                <li><a href="#tabs-2">Datos de egreso</a></li>
                <li><a href="#tabs-3">Datos socio - econ&oacute;micos</a></li>
            </ul>
            <div id="tabs-1">
                <table>
                    <tr>
                        <td>
                            <div class="field"><label>Apellido paterno:</label> <input type="text" id="Paterno" name="Paterno" value="<?php echo $Fila->Paterno ?>" maxlength="20" /></div>
                        </td>
                        <td>
                            <div class="field"><label>Apellido materno:</label> <input type="text" id="Materno" name="Materno" value="<?php echo $Fila->Materno ?>"  maxlength="20"/></div> 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Nombres:</label> <input type="text" name="Nombres"  id="Nombres" value="<?php echo $Fila->Nombres ?>" maxlength="30" /></div>          
                        </td>
                        <td>
                            <?php
                            $masculino = "";
                            $femenino = "";
                            if ($Fila->Genero == "M")
                                $masculino = "checked";
                            if ($Fila->Genero == "F")
                                $femenino = "checked";
                            ?>
                            <div class="field"><label>G&eacute;nero:</label> Masculino: <input type="radio" name="Genero" value="M" <?php echo $masculino; ?> /> Femenino:<input type="radio" name="Genero" value="F" <?php echo $femenino; ?> /></div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>CI / Pas.:</label> 
                                <input type="text"  name="CI" id="CI" value="<?php echo $Fila->CI; ?>" class="required" maxlength="10" />
                            </div>
                            <div class="field"><label>Expedido.:</label>  
                                <?php echo $ComboDepartamentos; ?>
                            </div>
                        </td>
                        <td>
                            <div class="field"><label>Fecha de nacimiento:</label> <input type="text" name="FechaNac" id="FechaNac" value="<?php echo $FechaNac2; ?>" /> </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Lugar de nacimiento:</label> <input type="text" name="LugarNac" id="LugarNac" value="<?php echo $Fila->LugarNac ?>"  maxlength="40"/> </div>
                        </td>
                        <td>
                            <div class="field"><label>Pa&iacute;s de  nacimiento:</label> 
                                <?php echo $ComboPaisesNacimiento; ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Tel&eacute;fono:</label> <input type="text" name="Telefono" id="Telefono" value="<?php echo $Fila->Telefono ?>" maxlength="8" /> </div>
                        </td>
                        <td>
                            <div class="field"><label>Correo electr&oacute;nico:</label> <input type="text" name="Correo" id="Correo" value="<?php echo $Fila->Correo ?>" maxlength="50" /> </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="field"><label>Domicilio:</label> <input type="text" name="Domicilio" id="Domicilio" value="<?php echo $Fila->Domicilio ?>" size="50" /> </div>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Estado civil:</label> 
                                <?php echo $EstadoCivil; ?>
                            </div>
                        </td>
                        <td>
                            <div class="field"><label>Tel&eacute;fono de urgencia:</label> <input type="text" name="TelUrgencia" id="TelUrgencia" value="<?php echo $Fila->TelUrgencia ?>" maxlength="8"/> </div>
                        </td>
                    </tr>
                    <td >
                            <div class="field"><label>Carrera:</label> <?php echo $ComboCarrera;?> </div>
                        </td>
                         <td >
                                <div class="field"><label>Subsede:</label> <div id="subsede"><?php echo $ComboSubsede; ?></div><br/></div>
                            </td>

                </table>
            </div>
            
            <div id="tabs-2">
                <table>
                    <tr>
                        <td>
                            <div class="field"><label>Colegio:</label> <input type="text" name="Colegio" id="Colegio" value="<?php echo $Fila->Colegio ?>" size="40" maxlength="40"/></div>
                        </td>
                        <td>
                            <div class="field"><label>A&ntilde;o de egreso:</label> <input type="text" name="AnioEgreso"  id="AnioEgreso" value="<?php echo $Fila->AnioEgreso ?>" /></div> 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Tipo:</label> 
                                <?php echo $ComboTipoColegio; ?>   
                            </div>
                        </td>
                        <td>
                            <div class="field"></div> 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Localidad:</label> <input type="text" name="Localidad" id="Localidad" value="<?php echo $Fila->Localidad ?>" maxlength="30" /></div>
                        </td>
                        <td>
                            <div class="field"><label>Pa&iacute;s:</label> <?php echo $ComboPaisesColegio; ?> </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="field"><label>Expedido por:</label> <?php echo $ComboUniversidades; ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td >
                            <div class="field"><label>A&ntilde;o t&iacute;tulo:</label> <input type="text" name="AnioTitulo" id="AnioTitulo" value="<?php echo $Fila->AnioTitulo ?>" /></div>
                        </td>
                        <td>
                            <div class="field"><label>N&uacute;mero de t&iacute;tulo:</label> <input type="text" name="NumTitulo"  id="NumTitulo" value="<?php echo $Fila->NumTitulo ?>" maxlength="10" /></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div id="tabs-3">
                <table border="0" width="60%" align="center" style="margin:auto;">
                    <tr>
                        <td>
                            <div class="field"><label>Zona aproximada de la vivienda</label> 
                                <?php echo $ComboZona; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="field"><label>La vivienda que habita es?:</label> 
                                <?php echo $ComboVivienda; ?></div>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <div class="field"><label>Caracteristicas de la vivienda?:</label> 
                                <?php echo $ComboCaracteristicasVivienda; ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td >
                            <div class="field">
                                <fieldset>
                                    <legend>Trabaja?</legend>
                                    <?php
                                    $si = "";
                                    $no = "";
                                    $eventual = "";
                                    if ($Fila->Trabaja == "0")
                                        $no = "checked";

                                    if ($Fila->Trabaja == "1")
                                        $si = "checked";
                                    if ($Fila->Trabaja == "2")
                                        $eventual = "checked";
                                    ?>
                                    <p>No: <input type="radio" name="Trabaja" value="0" id="trabajano" <?php echo $no; ?> />  Si:<input type="radio" name="Trabaja"id="trabajasi"  value="1" <?php echo $si; ?> /> Eventual:<input type="radio" name="Trabaja" value="2" id="trabajaeventual" <?php echo $eventual; ?> /></p>
                                    <label>Como?</label>
                                        <?php echo $ComboComoTrabaja; ?>            
                                    <div class="field"><label>Jornada:</label> 
                                        <?php echo $ComboJornada; ?>
                                    </div>
                                </fieldset>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br/>
        </div>
        
        <div class='span-4 prefix-9 suffix-9 last center'>
            <button class="button positive">
                <img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
            </button>
        </div>
        <input type="hidden" name="Modo" id="Modo" value="<?php echo $Modo; ?>"/>    
        <input type="hidden" name="CodPersona" id="CodPersona" value="<?php echo $Fila->CodPersona; ?>"/>
        <div id="errorContainer"></div>
    </form>
</div>
    