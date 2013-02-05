<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <?php
        header('Content-type: text/html; charset=utf-8');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        echo "<title>Matriculaci&oacute;n UPEA</title>";

        // echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/reset.css' />";
        //echo "<link rel='stylesheet' media='screen' href='" . base_url() . "css/grid960.css' />";
        //echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/type.css' />";
        //echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/helpers.css' />";
        //echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/ux.css' />";
        //echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/forms.css' />";
        echo "<link rel='stylesheet' type='text/css' href='" . base_url() . "css/tables.css' />";

        //echo "<link href='" . base_url() . "css/estilo.css' rel='stylesheet' type='text/css' />";
        echo "<link href='" . base_url() . "css/cwcalendar.css' rel='stylesheet' type='text/css' />";
        //echo "<script type='text/javascript' src='" . base_url() . "js/calendar.js'></script>";
        echo "<script type='text/javascript' src='" . base_url() . "js/jquery.js'></script>";
        echo "<link rel='stylesheet' href='" . base_url() . "css/stylemenu.css' type='text/css' media='screen, projection'/>";
        echo "<script type='text/javascript' language='javascript' src='" . base_url() . "js/jquery.dropdownPlain.js'></script>";
        echo "<!--[if lte IE 7]>
				<link rel='stylesheet' type='text/css' href='" . base_url() . "css/iemenu.css' media='screen' />
			<![endif]-->";
        echo "<script type='text/javascript' src='" . base_url() . "js/jquery.validate.js'></script>";
        ?>
        <script>
            $(document).ready(function(){
                ;//alert("asdf");
                $(".texto").hover(function(){
                    $(this).css('border','2px solid #cd474b');
                }, function(){
                    $(this).css('border','1px solid #cd474b');
                }
            );
            
            
            $("#submit").hover(function(){
                    $(this).css("opacity", "0.8");
                    
                }, function(){
                    $(this).css("opacity", "1");
                }
            );
            
            });
        
        </script>
        <style>

            #container{
                   /*border:1px black solid;*/
                margin: auto;
             
            }
            #container h1{
                
                color:#676aaf;
                font-family: Arial Narrow;
            }
            
            #login{
                border:2px #676aaf solid;
                width: 30%;
                margin: auto;
                position: relative;
                
            }
            
            #titulo{
                
                background-color: #676aaf;
                color:#ffffff;
                text-align: center;
                font-family: Arial Narrow;
                font-weight: bold;
                margin: auto;
            }
            
            #formulario{
                width: 100%;
                margin: auto;
                
            }
            
            #formulario input[type=submit]{
                background-color: #cd474b;
                color: #ffffff;
                font-family: Arial Narrow;
                font-weight: bold;
                margin: auto;
                text-align: center;
                vertical-align: middle;
                border: none;
                width: 45%;
                height: 25px;
                font-size: 16px;
            }
            #formulario input[type=text],input[type=password]{
                margin: auto;
                width: 200px;
                border: 1px solid #cd474b;
            }
            

            #formulario label{
                
                font-family: Arial Narrow;
                margin-right: 50px;
                margin-left: 10px;
            }
            
        </style>
    </head>
    <body>        
        <div id="container">
            <?php
            date_default_timezone_set('America/La_Paz');
            ?>
            <h1>Sistema de Matriculaci&oacute;n de la Universidad P&uacute;blica de El Alto</h1>
            <div id="login">
                
                <div id="titulo">Introduzca sus datos</div>
                <div id="formulario">
                    <form action="<?php echo base_url() ?>index.php/login/Verifica" method="POST">


                        <p>
                            <label for="NombreUsuario">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  <input type="text" name="NombreUsuario" id="NombreUsuario" value="" class="texto"/>
                        </p>
                        <p>
                            <label>Contraseña:&nbsp;</label><input type="password" name="Clave" id="Clave" value="" class="texto" />
                        </p>
                        <p style="text-align: center;">
                            <input type="submit" value="Ingresar"  id="submit"/>
                        </p>


                    </form>

                </div>
            </div>
        </div>
    </body>
</html>



