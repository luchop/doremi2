<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>UPEA | Formulario 01 Matriculaci&oacute;n</title>
        <?php
        //echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/jquery-ui.css' />";
        //echo "<script type='text/javascript' src='" . base_url() . "js/jquery.js'></script>";
        //echo "<script type='text/javascript' src='" . base_url() . "js/jquery-ui-1.8.23.custom.min.js'></script>";
        ?>

        <script type="text/javascript">
            $(function () {

                 // Tabs
                $('#tabs').tabs();

                // Button
                $("input[type=button],input[type=submit]").button();
                $(".enlace").button({height:40});
                
                $("select").attr("disabled","true");
        
                $('#Ayuda').click(function () {
		            $('#dialog').dialog('open');
		            return false;
		        });      
                			
                $('#dialog').dialog({
                    autoOpen: false,
                    width: 600,modal:true
                    
                });

                // Dialog Link
                $('#dialog_link').click(function () {
                    $('#dialog').dialog('open');
                    return false;
                });

           

            });
        </script>
        <style type="text/css">
            body{ font-family:"Segoe UI", Helvetica, Verdana;font-size: 11px; margin: 50px;}
            #wrapper{
                width:800px;
                margin: auto;
            }
            h1{font-weight:normal;}
            .header { margin-top: 2em;font-weight:normal; }
            #dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
            #dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
            ul#icons {margin: 0; padding: 0;}
            ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
            ul#icons span.ui-icon {float: left; margin: 0 4px;}
            #verticalSliders{height:140px;padding-top:20px;}
            #verticalSliders > div{float:left;margin:20px;}

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
             table, td, th {border:0}
             .enlace{
                 height: 40px;
                 color: #fff;
             }

        </style>
    
        <div id="wrapper">

            <!-- Tabs -->
            <h2 class="header">Formulario 01 <span style="color:red;">*No se puede editar*</span></h2>
            <input type="button" value="?" id="Ayuda"  class="enlace" />
            <a href="<?php echo base_url();?>index.php/formulario/Busqueda" class="enlace" style="color:#ffffff;">Salir</a>
            
            
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
                                <div class="field"><label>Apellido paterno:</label> <input type="text" id="Paterno" name="Paterno" value="<?php echo $Fila->Paterno?>" readonly="true"/></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Apellido materno:</label> <input type="text" id="Materno" name="Materno" value="<?php echo $Fila->Materno?>" readonly="true" /></div> 

                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Nombres:</label> <input type="text" name="Nombres"  id="Nombres" value="<?php echo $Fila->Nombres?>" readonly="true" /></div>          
                            </td>
                            <td valign="top">
                                <?php
                                $masculino="";
                                $femenino="";
                                if($Fila->Genero=="M")
                                    $masculino="checked";
                                if($Fila->Genero=="F")
                                    $femenino="checked";
                                ?>
                                <div class="field"><label>G&eacute;nero:</label> Masculino: <input type="radio" name="Genero" value="M" <?php echo $masculino;?> /> Femenino:<input type="radio" name="Genero" value="F" <?php echo $femenino;?> /></div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>CI / Pas:</label> <input type="text" id="CI" name="CI" value="<?php echo $Fila->CI?>" readonly="true" />  </div>
                                <div class="field"><label>Expedido.:</label>  
                                   <?php echo $ComboDepartamentos;?>
                                </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Fecha de nacimiento:</label> <input type="text" name="FechaNac" id="FechaNac" value="<?php echo $Fila->FechaNac?>" readonly="true" /> </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Lugar de nacimiento:</label> <input type="text" name="LugarNac" id="LugarNac" value="<?php echo $Fila->LugarNac?>" /> </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Pa&iacute;s de  Nacimiento:</label> 
                                   <?php echo $ComboPaisesNacimiento; ?>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <div class="field"><label>Tel&eacute;fono:</label> <input type="text" name="Telefono" id="Telefono" value="<?php echo $Fila->Telefono?>" readonly="true"/> </div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>Correo electr&oacute;nico:</label> <input type="text" name="Correo" id="Correo" value="<?php echo $Fila->Correo?>" readonly="true" /> </div>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" colspan="2">
                                <div class="field"><label>Domicilio:</label> <input type="text" name="Domicilio" id="Domicilio" value="<?php echo $Fila->Domicilio?>" readonly="true" size="50"/> </div>
                            </td>
                           
                        </tr>




                        <tr>
                            <td valign="top">
                                <div class="field"><label>Estado civil:</label> 
                                   <?php echo $EstadoCivil;?>
                            </td>
                            <td>
                                <div class="field"><label>Tel&eacute;fono de urgencia:</label> <input type="text" name="TelUrgencia" id="TelUrgencia" value="<?php echo $Fila->TelUrgencia?>" readonly="true" /> </div>
                            </td>
                        </tr>

                    </table>


                </div>
                <div id="tabs-2">
                            <table border="0" >
                        <tr>
                            <td valign="top">
                                <div class="field"><label>Colegio:</label> <input type="text" name="Colegio" id="Colegio" value="<?php echo $Fila->Colegio?>" readonly="true" size="40"/></div>
                            </td>
                            <td valign="top">
                                <div class="field"><label>A&ntilde;o de egreso:</label> <input type="text" name="AnioEgreso"  id="AnioEgreso" value="<?php echo $Fila->AnioEgreso?>" readonly="true" /></div> 

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
                                <div class="field"><label>Localidad:</label> <input type="text" name="Localidad" id="Localidad" value="<?php echo $Fila->Localidad?>" readonly="true" /></div>
                            </td>
                            <td valign="top">
                               <div class="field"><label>Pa&iacute;s:</label> 
                                   <?php echo $ComboPaisesColegio; ?>
                            </td>
                        </tr>
                        
                          <tr>
                            <td valign="top" colspan="2">
                                <div class="field"><label>Expedido por:</label> <?php echo $ComboUniversidades;?></div>
                            </td>
                            
                        </tr>
                        
                          <tr>
                            <td valign="top" >
                                <div class="field"><label>A&ntilde;o t&iacute;tulo:</label> <input type="text" name="AnioTitulo" id="AnioTitulo" value="<?php echo $Fila->AnioTitulo?>" readonly="true" /></div>
                            </td>
                              <td valign="top">
                                  <div class="field"><label>N&uacute;mero de t&iacute;tulo:</label> <input type="text" name="NumTitulo"  id="NumTitulo" value="<?php echo $Fila->NumTitulo?>" readonly="true" /></div>
                            </td>
                            
                        </tr>
                        
                        
                        </table>

                </div>
                <div id="tabs-3">
                    <table border="0" width="60%" align="center" >
                        <tr>
                            <td valign="top" align="center">
                                <div class="field"><label>Zona aproximada de la vivienda</label> 
                                    <?php echo $ComboZona;?></div>
                            </td>
                           
                        </tr>
                        <tr>
                            <td valign="top">
                                <div class="field"><label>La vivienda que habita es?:</label> 
                                <?php echo $ComboVivienda;?></div>
                                </div>
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td valign="top">
                                <div class="field"><label>Caracter&iacute;sticas de la vivienda?:</label> 
                                    <?php echo $ComboCaracteristicasVivienda;?></div>
                            </td>
                            
                        </tr>
                        
                        
                        <tr>
                            <td valign="top">
                                <div class="field">
                                    <fieldset>
                                        <legend>Trabaja?</legend>
                                        <?php
                                        
                                        $si="";$no="";$eventual="";
                                        if($Fila->Trabaja=="0")
                                                $no="checked";
                                            
                                        if($Fila->Trabaja=="1")
                                        $si="checked";
                                        if($Fila->Trabaja=="2")
                                            $eventual="checked";
                                        ?>
                                        <p>No: <input type="radio" name="Trabaja" value="0" <?php echo $no;?> />  Si:<input type="radio" name="Trabaja" value="1" <?php echo $si;?> /> Eventual:<input type="radio" name="Trabaja" value="2" <?php echo $eventual;?> /></p>
                                        
                                        
                                        <label>Como?</label>
                                        <?php echo $ComboComoTrabaja;?>
                                    </fieldset>
                                
                                </div>
                            </td>
                            
                        </tr>
                         <tr>
                            <td valign="top" >
                                <div class="field"><label>Jornada:</label> 
                                    <?php echo $ComboJornada;?></div>
                            </td>
                            
                        </tr>
                        
                    </table>
                </div>
                <br/>
                
                
                <a href="<?php echo base_url();?>index.php/formulario_pdf/Pdf/<?php echo $Fila->CodPersona;?>" class="enlace">Imprimir</a>
            </div>
                
            

           <div id="dialog" title="Ayuda">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
         
        </div>
                <br><hr>
 
