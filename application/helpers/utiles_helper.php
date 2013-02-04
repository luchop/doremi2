<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function ComboGestion($Gestion) {
        $s = "<select name='Gestion' id='Gestion' class='required'>";
        for($i=2001; $i<=2020; $i++)
            $s .= "<option value='$i' ".($Gestion==$i?'selected':'')." >".$i."</option>";
        return $s . "</select>";
    }
	
	function ObtieneVista($TipoUsuario) {
		/*if( $TipoUsuario==0 ) 
			return 'vista_menu';
		else if( $TipoUsuario==1 ) 
			return 'vista_menu';
		else if( $TipoUsuario==2 ) 
			return 'vista_menu_operador';
		else if( $TipoUsuario==3 ) 
			return 'vista_menu_operador';*/
        return 'vista_menu';    
    }
	
	function FechaLiteral($Fecha, $Formato=2) {
        $dias = array(1=>'Lunes', 2=>'Martes', 3=>'Mi�rcoles', 4=>'Jueves', 5=>'Viernes', 6=>'S�bado', 7=>'Domingo');
        $meses = array(1=>'enero', 2=>'febrero', 3=>'marzo', 4=>'abril', 5=>'mayo', 6=>'junio',
                       7=>'julio', 8=>'agosto', 9=>'septiembre', 10=>'octubre', 11=>'noviembre', 12=>'diciembre');    
        $aux = date_parse($Fecha);
        switch ($Formato) {
            case 1:  // 04/10/10
                return date('d/m/y', $Fecha);
            case 2:  //04/oct/10
                return sprintf('%02d/%s/%02d', $aux['day'], substr($meses[$aux['month']],0,3), $aux['year'] % 100);
            case 3:   //octubre 4, 2010
                return $meses[$aux['month']] . ' '.sprintf('%.2d',$aux['day']).', '.$aux['year'];
            case 4:   // 4 de octubre de 2010
                return $aux['day'].' de ' . $meses[$aux['month']] . ' de '.$aux['year'];
            case 5: 
                return date('d/m/Y', $Fecha);       
            default: 
                return date('d/m/Y', $Fecha);
        }
    }
	
	//recibe la fecha en formato dd/mm/aaaa o dd-mm-aaaa
    //y convierte a aaaa-mm-dd
    function FechaParaMySQL($Fecha) {
        if( $Fecha!='') {
            $Fecha = strtr($Fecha, '-', '/');  //convierte a dd/mm/aaaa
            $Fecha = implode( '/', array_reverse( explode( '/', $Fecha ) ) ) ;
        }
        return $Fecha;
    }

    //recibe la fecha en formato aaaa/mm/dd o aaaa-mm-dd
    //y convierte a dd/mm/aaaa
    function FechaDeMySQL($Fecha) {
        if( $Fecha!='') {
            $Fecha = strtr($Fecha, '-', '/');  //convierte a aaaa/mm/dd
            $Fecha = implode( '/', array_reverse( explode( '/', $Fecha ) ) ) ;
        }
        return $Fecha;
    }
function Genero($str) {
    if($str=="M")
        return "Masculino";
    else if($str=="F")
        return "Femenino";
}

function EstadoCivil($i) {
        $Estado[0]="Soltero(a)";
        $Estado[1]="Casado(a)";
        $Estado[2]="Conviviente";
        $Estado[3]="Divorciado(a)";
        $Estado[4]="Viudo(a)";
        return $Estado[$i];
}

function ComboEstadoCivil($Combo,$Selected) {
        $Estado[0]="Soltero(a)";
        $Estado[1]="Casado(a)";
        $Estado[2]="Conviviente";
        $Estado[3]="Divorciado(a)";
        $Estado[4]="Viudo(a)";

        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Estado-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
function ComboDepartamentos($Combo,$Selected) {
          $Dep["LP"]="La Paz";
          $Dep["OR"]="Oruro";
          $Dep["PT"]="Potosi";
          $Dep["CO"]="Cochabamba";
          $Dep["CH"]="Chuquisaca";
          $Dep["TA"]="Tarija";
          $Dep["SC"]="Santa Cruz";
          $Dep["BE"]="Beni";
          $Dep["PA"]="Pando";
          $Dep2[1]="LP";$Dep2[2]="OR";$Dep2[3]="PT";$Dep2[4]="CO";$Dep2[5]="CH";$Dep2[6]="TA";$Dep2[7]="SC";$Dep2[8]="BE";$Dep2[9]="PA";
          
         $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Departamento-</option>";
        for($i=1;$i<=count($Dep2);$i++){
            if($Dep2[$i]==$Selected)
            {
                $s .= "<option value='" . $Dep2[$i]. "'  selected >" . $Dep[$Dep2[$i]] . "</option>";
            }
            else
            $s .= "<option value='" . $Dep2[$i]. "'>" . $Dep[$Dep2[$i]] . "</option>";
        }
        return $s . "</select>";
    }
    
    function TipoColegio($i){
        $Estado[0]="Publico";
        $Estado[1]="Privado";
        $Estado[2]="CEMA";
        $Estado[3]="Otros";
        return $Estado[$i];
    }
	
    function ComboTipoColegio($Combo,$Selected) {
        $Estado[0]="Publico";
        $Estado[1]="Privado";
        $Estado[2]="CEMA";
        $Estado[3]="Otros";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
    function TipoVivienda($i)
    {
        $Estado[0]="Propia";
        $Estado[1]="Alquilada";
        $Estado[2]="Prestada";
        $Estado[3]="Anticretico";
        $Estado[4]="Adjudicado";
        
        switch ($i)
        {
            case 0: return $Estado[0];
            case 1:return $Estado[1];
                case 2:return $Estado[2];
                    case 3:return $Estado[3];
                        case 4:return $Estado[4];
                        default : return "";
        }
        
        
        return $Estado[$i];
    }
	
    function ComboTipoVivienda($Combo,$Selected) {
        $Estado[0]="Propia";
        $Estado[1]="Alquilada";
        $Estado[2]="Prestada";
        $Estado[3]="Anticretico";
        $Estado[4]="Adjudicado";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
    function CaracteristicasVivienda($i)
    {
        $Estado[0]="Casa";
        $Estado[1]="Departamento";
        $Estado[2]="Habitacion";
        $Estado[3]="Residencial";
        $Estado[4]="Internado";
        $Estado[5]="Otro";
        
        switch ($i)
        {
            case 0: return $Estado[0];
            case 1:return $Estado[1];
                case 2:return $Estado[2];
                    case 3:return $Estado[3];
                 case 4:return $Estado[4];
                case 5:return $Estado[5];
                        default : return "";
        }    
        return $Estado[$i];
    }
    
    function ComboCaracteristicasVivienda($Combo,$Selected) {
        $Estado[0]="Casa";
        $Estado[1]="Departamento";
        $Estado[2]="Habitacion";
        $Estado[3]="Residencial";
        $Estado[4]="Internado";
        $Estado[5]="Otro";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
    function Trabajo($i)
    {
        $Estado[0]="Empleado";
          $Estado[1]="Obrero";
          $Estado[2]="Cuenta Propia";
          $Estado[3]="Patrón o Empleador";
          $Estado[4]="Otro";
          
        switch ($i)
        {
            case 0: return $Estado[0];
            case 1:return $Estado[1];
                case 2:return $Estado[2];
                    case 3:return $Estado[3];
                 case 4:return $Estado[4];
                
                        default : return "";
        }
        return $Estado[$i];
    }
	
    function ComboComoTrabaja($Combo,$Selected) {
          
          $Estado[0]="Empleado";
          $Estado[1]="Obrero";
          $Estado[2]="Cuenta Propia";
          $Estado[3]="Patr&oacute;n o Empleador";
          $Estado[4]="Otro";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
    function Trabaja($i)
    {
        $Estado[0]="No";
          $Estado[1]="Si";
          $Estado[2]="Eventual";
           
        switch ($i)
        {
            case 0: return $Estado[0];
            case 1:return $Estado[1];
            case 2:return $Estado[2];
            default : return "";
        }
        return $Estado[$i];
    }
    
	function Jornada($i) {
        $Estado[0]="Tiempo Completo";
        $Estado[1]="Medio Tiempo";
        $Estado[2]="Tiempo Horario";

        switch ($i) {
            case 0: return $Estado[0];
            case 1:return $Estado[1];
            case 2:return $Estado[2];
            default : return "";
        }
   
        return $Estado[$i];
    }
	
    function ComboJornada($Combo,$Selected) {
          
        $Estado[0]="Tiempo Completo";
        $Estado[1]="Medio Tiempo";
        $Estado[2]="Tiempo Horario";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if("$i"==$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }

/* End of file utiles.php */