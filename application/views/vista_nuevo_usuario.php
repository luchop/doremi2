<script type="text/javascript">
    $(document).ready(function() {
        $("#formulario").validate({
            highlight: function(label) {
	    		//$(label).closest('#formulario div').addClass('error2');
            },
            success: function(label) {
                
                ;
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
        
        $("input[type=text]").css("height","20px");
        $("input[type=submit]").css("height","30px");
        $("input[type=submit]").css("width","100px");
        $("#Clave").attr('readonly','true');
        $("#NombreUsuario").change(function(){
            
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
        });
        
    })
</script>


<?php
echo "<div class='span-12 prefix-6 suffix-6  center'>";


echo "<form action='" . base_url() . "index.php/usuario/Guardar' method='post' id='formulario' >";
echo "<fieldset >";
echo "<legend> Nuevo Usuario</legend>";
//echo "<hr>";
echo "<div class='span-6 center ' ><label>Nombre:</label>" . "<input  type='text' name='Nombres' id='Nombres' maxlength='30'  value=''  /></div>";
echo "<div class='span-6 center last' ><label>Paterno:</label>" . "<input  type='text' name='Paterno' id='Paterno' maxlength='20'  value=''  /></div>";
echo "<div class='span-6 center' ><label>Materno:</label>" . "<input  type='text' name='Materno' id='Materno' maxlength='20'  value=''  /></div>";
echo "<div class='span-6 center last'  ><label>Telefono:</label>" . "<input  type='text' name='Telefono' id='Telefono' maxlength='8'  value='' /></div>";
echo "<div class='span-6 center'  ><label>Celular:</label>" . "<input  type='text' name='Celular' id='Celular' maxlength='8'  value=''  /></div>";
echo "<div class='span-6 center last' ><label>E-Mail:</label>" . "<input  type='text' name='Email' id='Email' maxlength='50'  value='' /></div>";
echo "<div class='span-6  center'><label>Usuario:</label>" . "<input  type='text' name='NombreUsuario' id='NombreUsuario' maxlength='15'  value='' /></div>";
echo "<div class='span-6 center last'><label>Clave:</label>" . "<input  type='text' name='Clave' id='Clave' maxlength='30'  value='' /></div>";
echo "<div class='span-6 center '><label>Perfil:</label>" . $ComboPerfil . "</div>";
echo "<input  type='hidden' name='Tipo' id='Tipo' value='$Tipo' />";
echo "<hr>";
echo "<div class='span-6 prefix-6 center'>
    
    <button class='button positive' >
				<img src='" . base_url() . "css/images/icons/tick.png' alt=''>Guardar
    </button>
    
</div>";

echo "</fieldset>";
echo "<div id='errorContainer'></div>";
echo "</form>";

echo "</div>";
?>
