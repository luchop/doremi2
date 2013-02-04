<script>var url1="<?php echo base_url(); ?>index.php/formulario/ValorPais";
    var url2="<?php echo base_url(); ?>index.php/formulario/VerificaCI";
    var url3="<?php echo base_url(); ?>index.php/formulario/CargaSubsede";
</script>
<?php echo "<script type='text/javascript' src='" . base_url() . "js/formulario01.js'></script>";?>

<style type="text/css">
    #wrapper{
        width:800px;
        margin: auto;
    }
    .field{
        margin: 5px 5px 5px 5px;
    }
    .field label{
        float: left;
        width: 130px;
    }
    .field input{
        border:1px solid #676aaf;
    }
    
    #wrapper table, td, th {border:0; padding: 0.4em; }
</style>

<h4 class="center">Formulario 01</h4>
<div id="wrapper">
    <form name="form" action="<?php echo base_url(); ?>index.php/formulario/Guardar" method="POST" id="form">
    
        <fieldset><legend>Datos Generales</legend>
            <table border="0" >
                <tr>
                    <td>
                        <div class="field"><label>Apellido paterno:</label> <input type="text" id="Paterno" title="Apellido paterno. Ejemplo: P&eacute;rez"
                            name="Paterno" value="<?php echo $this->session->userdata('Paterno'); ?>" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> maxlength="20"/></div>
                    </td>
                    <td>
                        <div class="field"><label>Apellido materno:</label> <input type="text" id="Materno" title="Apellido materno. Ejemplo: G&oacute;mez"
                            name="Materno" value="<?php echo $this->session->userdata('Materno'); ?>" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> maxlength="20"/></div> 
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field"><label>Nombres:</label> <input type="text" name="Nombres" title="Nombre(s). Ejemplo: Luis Alberto" 
                            id="Nombres" value="<?php echo $this->session->userdata('Nombres'); ?>" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> maxlength="30" /></div>          
                    </td>
                    <td>
                        <div class="field"><label>G&eacute;nero:</label> Masculino: <input type="radio" name="Genero" value="M" checked />  Femenino:<input type="radio" name="Genero" value="F" /></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field"><label>CI / Pas.:</label> <input type="text" id="CI" name="CI" title="N&uacute;mero de carnet o pasaporte"
                            value="<?php echo $this->session->userdata('Carnet'); ?>" <?php if ($Proveniente == "Estudiante") { ?>readonly="true"<?php } ?> class="required" maxlength="10" />  </div>
                        <div class="field"><label>Expedido:</label>  
                            <?php echo $ComboDepartamentos; ?>
                        </div>
                    </td>
                    <td>
                        <div class="field"><label>Fecha de nacimiento:</label> <input type="text" name="FechaNac" title="Escoja mes, a&ntilde;o y d&iacute;a de nacimiento"
                            id="FechaNac" value="" readonly="true"/> </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field"><label>Lugar de nacimiento:</label> <input type="text" name="LugarNac" id="LugarNac" title="Escriba el departamento de nacimiento."
                            value="" maxlength="50"/> </div>
                    </td>
                    <td>
                        <div class="field"><label>Pa&iacute;s de  nacimiento:</label> 
                            <?php echo $ComboPaisesNacimiento; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field"><label>Tel&eacute;fono:</label> <input type="text" name="Telefono" id="Telefono" title="T&eacute;lefono fijo o celular"
                            value="" maxlength="8"/> </div>
                    </td>
                    <td>
                        <div class="field"><label>Correo electr&oacute;nico:</label> <input type="text" name="Correo" title="Correo electr&oacute;nico, si tiene uno."
                            id="Correo" value="" maxlength="50" /> </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="field"><label>Domicilio:</label> <input type="text" name="Domicilio" id="Domicilio" title="Escriba su direcci&oacute;n actual"
                            value="" size="50" maxlength="50" /> </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field"><label>Estado civil:</label> 
                            <?php echo $EstadoCivil; ?></div>
                    </td>
                    <td>
                        <div class="field"><label>Tel&eacute;fono de urgencia:</label> <input type="text" name="TelUrgencia" id="TelUrgencia" title="Tel&eacute;fono para llamar en caso de urgencia"
                            value="" maxlength="8"/> </div>
                    </td>
                </tr>
                <td >
                    <div class="field"><label>Carreras habilitadas:</label> <?php echo $ComboCarrera;?> <br/></div>
                </td>
                <td >
                    <div class="field"><label>Subsede:</label> <div id="subsede"><?php echo $ComboSubsede;?></div><br/></div>
                </td>

            </table>
        </fieldset>
        <br />

        <fieldset><legend>Datos de egreso</legend>
            <table border="0" >
                <tr>
                    <td>
                        <div class="field"><label>Colegio:</label> <input type="text" name="Colegio" title"Nombre del colegio de egreso."
                            id="Colegio" value="" size="40"/></div>
                    </td>
                    <td>
                        <div class="field"><label>A&ntilde;o de egreso:</label> <input type="text" name="AnioEgreso"  title="A&ntilde;o de egreso de colegio."
                            id="AnioEgreso" value="" /></div> 
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
                        <div class="field"><label>Localidad:</label> <input type="text" name="Localidad" id="Localidad" title="Lugar en que se encuentra el colegio de egreso"
                            value="" maxlength="30" /></div>
                    </td>
                    <td>
                        <div class="field"><label>Pa&iacute;s:</label> 
                            <?php echo $ComboPaisesColegio; ?></div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="field"><label>Expedido por:</label> <?php echo $ComboUniversidades; ?></div>
                    </td>

                </tr>

                <tr>
                    <td >
                        <div class="field"><label>A&ntilde;o T&iacute;tulo:</label> <input type="text" name="AnioTitulo" title="A&ntilde;o en que fue expedido su titulo de bachiller."
                            id="AnioTitulo" value="" /></div>
                    </td>
                    <td>
                        <div class="field"><label>N&uacute;mero de T&iacute;tulo:</label> <input type="text" name="NumTitulo"  title="N&uacute;mero del t&iacute;tulo de bachiller"
                            id="NumTitulo" value="" maxlength="10"/></div>
                    </td>
                </tr>

            </table>
        </fieldset>

        <br />
        <fieldset><legend>Datos socio - econ&oacute;micos</legend>
            <table border="0" width="70%" align="center" style="margin:auto;" >
                <tr>
                    <td align="center">
                        <div class="field"><label>Zona aproximada de la vivienda:</label> 
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
                        <div class="field"><label>Caracter&iacute;sticas de la vivienda?:</label> 
                            <?php echo $ComboCaracteristicasVivienda; ?></div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="field">
                            <fieldset>
                                <legend>Trabaja?</legend>
                                <p>No: <input type="radio" name="Trabaja" value="0" id="trabajano"  />  Si:<input type="radio" name="Trabaja" value="1"  id="trabajasi" checked /> Eventual:<input type="radio" name="Trabaja" value="2" id="trabajaeventual" /></p>
                                <label>C&oacute;mo?</label>
                                <?php echo $ComboComoTrabaja; ?>
                                
                                <br />
                                <div class="field"><label>Jornada:</label> 
                                <?php echo $ComboJornada; ?></div>
                            </fieldset>
                        </div>
                    </td>

                </tr>
            </table>
        </fieldset>
        <br/>
        <div id="errorContainer"></div>
        <div id="errorContainer2"></div>

        <div class='span-3 prefix-9 suffix-12 last center'>
            <button class="button positive">
                <img src="<?php echo base_url(); ?>css/images/icons/tick.png" alt=""> Guardar 
            </button>
        </div>
        <input type="hidden" name="Modo" id="Modo" value="<?php echo $Modo; ?>">
        <input type="hidden" name="Proveniente" id="Proveniente" value="<?php echo $Proveniente; ?>">
        <br /><br />
        
    </form>
</div>