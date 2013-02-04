<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function FechaLiteral($Fecha, $Formato=2) {
        $dias = array(1=>'Lunes', 2=>'Martes', 3=>'Miércoles', 4=>'Jueves', 5=>'Viernes', 6=>'Sábado', 7=>'Domingo');
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
	
	function ComboEstadoCivil($Combo,$Selected) {
        $Estado[0]="Soltero(a)";
        $Estado[1]="Casado(a)";
        $Estado[2]="Conviviente";
        $Estado[3]="Divorciado(a)";
        $Estado[4]="Viudo(a)";

        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Estado-</option>";
        for($i=0;$i<count($Estado);$i++){
            if($i===$Selected)
            {
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            }
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
    
    function ComboTipoColegio($Combo,$Selected) {
        $Estado[0]="Publico";
        $Estado[1]="Privado";
        $Estado[2]="CEMA";
        $Estado[3]="Otros";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if($i===$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
     function ComboTipoVivienda($Combo,$Selected) {
        $Estado[0]="Propia";
        $Estado[1]="Alquilada";
        $Estado[2]="Prestada";
        $Estado[3]="Anticretico";
        $Estado[4]="Adjudicad";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if($i===$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
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
            if($i===$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
     function ComboComoTrabaja($Combo,$Selected) {
          
          $Estado[0]="Empleado";
          $Estado[1]="Obrero";
          $Estado[2]="Cuenta Propia";
          $Estado[3]="Patrón o Empleador";
          $Estado[4]="Otro";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if($i===$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }
    
    function ComboJornada($Combo,$Selected) {
          
        $Estado[0]="Tiempo Completo";
        $Estado[1]="Medio Tiempo";
        $Estado[2]="Tiempo Horario";
        
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Tipo-</option>";
        for($i=0;$i<count($Estado);$i++){
            if($i===$Selected)
                $s .= "<option value=" . $i. " selected>" . $Estado[$i] . "</option>";
            else
				$s .= "<option value=" . $i. ">" . $Estado[$i] . "</option>";
        }
        return $s . "</select>";
    }


/* End of file utiles.php */