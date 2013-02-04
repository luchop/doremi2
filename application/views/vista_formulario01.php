<script>var url1="<?php echo base_url(); ?>index.php/formulario/ValorPais";
    var url2="<?php echo base_url(); ?>index.php/formulario/VerificaCI";
    var url3="<?php echo base_url(); ?>index.php/formulario/CargaSubsede";
</script>
<?php echo "<script type='text/javascript' src='" . base_url() . "js/formulario01.js'></script>"; ?>

<style type="text/css">
    table, td, th {border:0}
</style>
</head>
<body>
    <div id="wrapper">

        <!-- Tabs -->
        <h2 class="header">Formulario 01</h2>


        <form name="form" action="<?php echo base_url(); ?>index.php/Formulario/Guardar" method="POST" id="form">

            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Datos generales</a></li>
                    <li><a href="#tabs-2">Datos de egreso</a></li>
                    <li><a href="#tabs-3">Datos socio - econ&oacute;micos</a></li>
                </ul>
                <div id="tabs-1">

                    <table border="0" >
                        <tr>
                            <td valign="top">
                                <div class="field"><label>Apellido paterno:</label> <input type="text" id="Paterno" name="Paterno" value="" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> maxlength="20"/></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Apellido materno:</label> <input type="text" id="Materno" name="Materno" value="" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> maxlength="20"/></div> 
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Nombres:</label> <input type="text" name="Nombres"  id="Nombres" value="" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?>  maxlength="30" /></div>          
                            </td>
                            <td valign="top">
                                <div class="field"><label>G&eacute;nero:</label> Masculino: <input type="radio" name="Genero" value="M" checked />  Femenino:<input type="radio" name="Genero" value="F" /></div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>CI / Pas.:</label> <input type="text" id="CI" name="CI" value="" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> class="required" maxlength="10" />  </div>
                                <div class="field"><label>Exp.:</label>  
                                    <?php echo $ComboDepartamentos; ?>
                                </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Fecha de nacimiento:</label> <input type="text" name="FechaNac" id="FechaNac" value="" readonly="true"/> </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Lugar de nacimiento:</label> <input type="text" name="LugarNac" id="LugarNac" value="" maxlength="40" /> </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Pa&iacute;s de  nacimiento:</label> 
                                    <?php echo $ComboPaisesNacimiento; ?>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Tel&eacute;fono:</label> <input type="text" name="Telefono" id="Telefono" value="" maxlength="8" /> </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Correo electr&oacute;nico:</label> <input type="text" name="Correo" id="Correo" value="" maxlength="50" /> </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" colspan="2">
                                <div class="field"><label>Domicilio:</label> <input type="text" name="Domicilio" id="Domicilio" value="" size="50" maxlength="50" /> </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Estado civil:</label> 
                                    <?php echo $EstadoCivil; ?>
                            </td>
                            <td>
                                <div class="field"><label>Tel&eacute;fono de urgencia:</label> <input type="text" name="TelUrgencia" id="TelUrgencia" value="" maxlength="8" /> </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="field"><label>Carrera:</label> <?php echo $ComboCarrera; ?> </div>
                            </td>
                            <td >
                                <div class="field"><label>Subsede:</label> <div id="subsede"><?php echo $ComboSubsede; ?></div><br/></div>
                            </td>
                        </tr>

                    </table>
                </div>
                <div id="tabs-2">
                    <table border="0" >
                        <tr>
                            <td valign="top">
                                <div class="field"><label>Colegio:</label> <input type="text" name="Colegio" id="Colegio" value="" size="40" maxlength="40"/></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>A&ntilde;o de egreso:</label> <input type="text" name="AnioEgreso"  id="AnioEgreso" value="" /></div> 
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Tipo:</label> 
                                    <?php echo $ComboTipoColegio; ?>   
                                </div>
                            </td>
                            <td valign="top">
                                <div class="field"></div> 
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Localidad:</label> <input type="text" name="Localidad" id="Localidad" value="" maxlength="30" /></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Pa&iacute;s:</label> 
                                    <?php echo $ComboPaisesColegio; ?>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" colspan="2">
                                <div class="field"><label>Expedido por:</label> <?php echo $ComboUniversidades; ?></div>
                            </td>

                        </tr>

                        <tr>
                            <td valign="top" >
                                <div class="field"><label>A&ntilde;o T&iacute;tulo:</label> <input type="text" name="AnioTitulo" id="AnioTitulo" value="" /></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>N&uacute;mero de T&iacute;tulo:</label> <input type="text" name="NumTitulo"  id="NumTitulo" value="" maxlength="10" /></div>
                            </td>
                        </tr>

                    </table>

                </div>
                <div id="tabs-3">
                    <table border="0" width="70%" align="center" style="margin:auto;" >
                        <tr>
                            <td valign="top" align="center">
                                <div class="field"><label>Zona aproximada de la vivienda:</label> 
                                    <?php echo $ComboZona; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="field"><label>La vivienda que habita es?:</label> 
                                    <?php echo $ComboVivienda; ?></div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Caracter&iacute;sticas de la vivienda?:</label> 
                                    <?php echo $ComboCaracteristicasVivienda; ?></div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field">
                                    <fieldset>
                                        <legend>Trabaja?</legend>
                                        <p>No: <input type="radio" name="Trabaja" value="0" id="trabajano"  />  Si:<input type="radio" name="Trabaja" value="1"  id="trabajasi" checked /> Eventual:<input type="radio" name="Trabaja" value="2" id="trabajaeventual" /></p>
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
                <div align="center">
                    <input type="submit" value="Guardar Formulario" id="Guardar" style="height:40px;margin:auto;"/>
                </div>
                <input type="hidden" name="Modo" id="Modo" value="<?php echo $Modo; ?>">
                <div id="errorContainer"></div>
            </div>

        </form>


    </div>