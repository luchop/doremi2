<script type="text/javascript">
$(document).ready(function() {
	$("#formulario").validate({
            highlight: function(label) {
	    	;
            },
            success: function(label) {
                ;
            },
            errorContainer: "#errorContainer",
            errorLabelContainer: "#errorContainer",
            errorElement: "li" ,
            onfocusout: false,
            rules: {
                'Perfil':'required'
            },
            messages: {
                        
                'Perfil': 'Debe ingresar el Perfil!'
            },
            submitHandler: function(form){
                form.submit();    
            }
        });
})
</script>

<?php
echo "
    ";
echo "<div id='formu' class='span-24 center'>";
echo "<form action='".  base_url()."index.php/perfil/Guardar' method='post' id='formulario'>";

echo "<div id='errorContainer'></div>";
echo "<fieldset >";
echo "<legend> Nuevo perfil de usuario</legend><br/>";
echo "<div><label>Nombre del Perfil:</label>". "<input  type='text' name='Perfil' id='Perfil' value='' maxlength='40'/>
    </div>";

echo "<table width='85%' style='width:80%;margin:auto;'  >
    <tr>
        <td>";


echo "<p>Universitarios:". "<input  type='checkbox' name='menu1' id='menu1' value='1' />
Nuevo:". "<input  type='checkbox' name='menu2' id='menu2' value='1' />
Editar:". "<input  type='checkbox' name='menu3' id='menu3' value='1' />
Eliminar:". "<input  type='checkbox' name='menu4' id='menu4' value='1' /></p>";

echo "</td>
        <td>";
echo "<p>Matriculaci&oacute;n:". "<input  type='checkbox' name='menu5' id='menu5' value='1' />
Nuevo:". "<input  type='checkbox' name='menu6' id='menu6' value='1' />
Editar:". "<input  type='checkbox' name='menu7' id='menu7' value='1' />
Eliminar:". "<input  type='checkbox' name='menu8' id='menu8' value='1' /></p>";
echo "</td>";
echo "</tr>
    <tr>";
echo "<td>";
echo "<p>Impresi&oacute;n de matr&iacute;culas:". "<input  type='checkbox' name='menu9' id='menu9' value='1' /></p>";
echo "</td>";

echo "<td>";

echo "<p>";
echo "Estad&iacute;sticas:". "<input  type='checkbox' name='menu10' id='menu10' value='1' />";
echo "</p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=2>"; 
echo "<p>N&oacute;minas de universitarios</p><p>
    Reporte de matr&iacute;culas expedidas:". "<input  type='checkbox' name='menu11' id='menu11' value='1' />
    Gesti&oacute;n:". "<input  type='checkbox' name='menu12' id='menu12' value='1' />
    Por carrera:". "<input  type='checkbox' name='menu13' id='menu13' value='1' />";
echo "Arqueo:". "<input  type='checkbox' name='menu14' id='menu14' value='1' /></p>";
echo "</td>";
echo "</tr>";

    echo "<tr>
        <td>"; 
echo "Reporte de irregularidades<input  type='checkbox' name='menu15' id='menu15' value='1' />";
echo"</td>
        <td>"; 
echo "<p>Exportaci&oacute;n a Excel:". "<input  type='checkbox' name='menu16' id='menu16' value='1' />
    </p>";
echo "</td>";

echo "</tr>
    
    <tr>";
    
echo "<td colspan=2>
    <p><label>Utilidades</label></p> 
    Calibraci&oacute;n de la matricula :". "<input  type='checkbox' name='menu17' id='menu17' value='1' />
    Control de cupos de matriculas:". "<input  type='checkbox' name='menu18' id='menu18' value='1' />
    Habilitaci&oacute;n de Registro Web:". "<input  type='checkbox' name='menu19' id='menu19' value='1' />
    Depuraci&oacute;n de Registro Web:". "<input  type='checkbox' name='menu20' id='menu20' value='1' /><br/>
    Varios:". "<input  type='checkbox' name='menu21' id='menu21' value='1' />
    Administraci&oacute;n de usuarios:". "<input  type='checkbox' name='menu22' id='menu22' value='1' />
    Auditor&iacute;a:". "<input  type='checkbox' name='menu23' id='menu23' value='1' />
    </p>";
echo "</td>";
    echo "</tr>


    
    </table>";


echo "<input  type='hidden' name='Tipo' id='Tipo' value='$Tipo' />";


echo "<div style='padding-left:350px;'>
    <button class='button positive'>
        <img src='".base_url()."css/images/icons/tick.png' alt=''>Guardar
    </button>
    </div>";
echo "</fieldset >";
echo "</form>";

echo "</div>";

?>

