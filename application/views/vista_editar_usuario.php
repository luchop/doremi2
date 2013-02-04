<script type="text/javascript">
    function Eliminar(Codigo)
    {
        $.ajax({
                    url:'<?php echo base_url(); ?>index.php/usuario/EliminarUsuarioCarrera',
                    dataType:'text',
                    type:'POST',
                    data:{
                        CodUsuarioCarrera:Codigo,
                       CodUsuario:<?php echo $Fila->CodUsuario; ?>
                    },
                    success: function(data){
                       $("#carreras").html(data);
                    }
                
                });
    }
    $(document).ready(function() {
        $.ajax({
                    url:'<?php echo base_url(); ?>index.php/usuario/ListadoUsuarioCarrera',
                    dataType:'text',
                    type:'POST',
                    data:{
                        CodUsuario:<?php echo $Fila->CodUsuario; ?>
                    },
                    success: function(data){
                       $("#carreras").html(data);
                    }
                
                });
          $("#agregar").click(function(){
              if($('#CodCarrera').val()!="")
                  {
              $.ajax({
                    url:'<?php echo base_url(); ?>index.php/usuario/InsertUsuarioCarrera',
                    dataType:'text',
                    type:'POST',
                    data:{
                        CodUsuario:<?php echo $Fila->CodUsuario; ?>,
                        CodCarrera:$('#CodCarrera').val()
                    },
                    success: function(data){
                       $("#carreras").html(data);
                       //$('#CodCarrera[option=]').attr()
                    }
                
                });
                }
          });    
                
        $("#formulario").validate({
            highlight: function(label) {
            },
            success: function(label) {
            },
            errorContainer: "#errorContainer",
            errorLabelContainer: "#errorContainer",
            errorElement: "li" ,
            onfocusout: false,
            rules: {
                        
                
                'Nombres': 'required',
                'Email':{email:true},
                'NombreUsuario':'required',
                'Clave':'required'
            },
            messages: {
                        
                'Nombres': 'Debe ingresar el nombre!',
                'Email':{email:'Correo no v&aacute;lido!'},
                'NombreUsuario':'Debe  ingresar nombre de usuario!',
                'Clave':'Debe ingresar una clave para el usuario!'
            },
            submitHandler: function(form){
                form.submit();    
            }
        
        });
        $('#CodPerfil option[value=<?php echo $Fila->CodPerfil; ?>]').attr('selected',true);
        //$("#Clave").attr('readonly','true');
        $("#NombreUsuario").change(function(){
            if($("#UsuarioAnterior").val()!=$("#NombreUsuario").val())
            {
                $.ajax({
                    url:'<?php echo base_url(); ?>index.php/usuario/Verificacion',
                    dataType:'text',
                    type:'POST',
                    data:{
                        Usuario:$(this).val()
                    },
                    success: function(data){
                        if(data=="1")
                        {
                            alert("El nombre de usuario ya existe!");
                            $("#NombreUsuario").val('');
                            $("#NombreUsuario").focus();
                            $("#formulario").validate().element($("#NombreUsuario"));
                        }
                        else if(data=="0")
                        {
                            //alert("Nombre de usuario disponible!");
                            $("#Clave").attr('readonly','');
                            $("#Clave").focus();
                        }
                    }
                
                });
            }
            
        });
        
    });
</script>
<?php

echo "<div class='span-12 prefix-6 suffix-6  center'>"; //aqui quiero el bendito layout de dos columnas

echo "<form action='" . base_url() . "index.php/usuario/Guardar' method='post' id='formulario'>";
echo "<fieldset>";
echo "<legend> Editar Usuario</legend>";
echo "<div class='span-6 center' ><label>Nombre:</label>" . "<input  type='text' name='Nombres' id='Nombres' maxlength='20'  value='$Fila->Nombres' /></div>";
echo "<div class='span-6 center last' ><label>Paterno:</label>" . "<input  type='text' name='Paterno' id='Paterno' maxlength='30'  value='" . $Fila->Paterno . "' class='required' /></div>";
echo "<div class='span-6 center' ><label>Materno:</label>" . "<input  type='text' name='Materno' id='Materno' maxlength='20'  value='$Fila->Materno' /></div>";
echo "<div class='span-6 center last' ><label>Telefono:</label>" . "<input  type='text' name='Telefono' id='Telefono' maxlength='8'  value='$Fila->Telefono'   /></div>";
echo "<div class='span-6 center' ><label>Celular:</label>" . "<input  type='text' name='Celular' id='Celular' maxlength='8'  value='$Fila->Celular' /></div>";
echo "<div class='span-6 center last' ><label>E-Mail:</label>" . "<input  type='text' name='Correo' id='Correo' maxlength='50'  value='$Fila->Correo' /></div>";
echo "<div class='span-6 center' ><label>Usuario:</label>" . "<input  type='text' name='NombreUsuario' id='NombreUsuario' maxlength='30'  value='$Fila->NombreUsuario' /></div>";
echo "<div class='span-6 center last' ><label>Clave:</label>" . "<input  type='password' name='Clave' id='Clave' maxlength='30'  value='$Fila->Clave' /></div>";
echo "<div class='span-6 center' ><label>Perfil:</label>" . $ComboPerfil . "</div>";
echo "<input  type='hidden' name='Tipo' id='Tipo' value='$Tipo' />";
echo "<hr>";
echo "<div class='span-6 prefix-6'>
<button class='button positive'>
				<img src='".base_url()."css/images/icons/tick.png' alt=''>Guardar
    </button>
    
</div>";
echo "<input  type='hidden' name='UsuarioAnterior' id='UsuarioAnterior' value='" . $Fila->NombreUsuario . "' />";
echo "<input  type='hidden' name='CodUsuario' id='CodUsuario' value='" . $Fila->CodUsuario . "' />";
echo "<input  type='hidden' name='CodPersona' id='CodPersona' value='" . $Fila->CodPersona . "' />";
echo "</fieldset>";
echo "<div id='errorContainer'></div>";
echo "</form>";


echo "<form><fieldset>";
echo "<legend>Carreras habilitadas</legend>";
echo "<div id='#'></div>";
echo "<div id='carreras'>
    </div>";
echo "<hr>";
echo "<label>Carrera:</label>" . $ComboCarreras ."    <input type='button' class='buttonok' id='agregar' value='  Agregar Carrera'/>
				
    ";
echo "<div id='#'></div>";
echo "</fieldset></form>";
echo "</div>";
?>
