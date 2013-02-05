<?php

class Modelo_carrera extends CI_Model {

    private $Tabla = 'carrera';

    function __construct() {
        parent::__construct();
    }

	function ComboCarrerasHabilitadas($CodCarrera=0, $Nombre='CodCarrera', $Requerido=False, $Todas=True) {
		if( $Todas ) 
            $sql = "select * from carrera order by Nombre";
        else
            $sql = "SELECT DISTINCT carrera.* FROM carrera, habilitacion WHERE carrera.CodCarrera=habilitacion.CodCarrera
                    AND CURDATE() BETWEEN FechaInicio AND FechaFin ORDER BY Nombre";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Nombre' id='$Nombre'".($Requerido?" class='required'":"").">";
		$s .= "<option value=''>-- Seleccione una carrera --</option>";
        foreach($resultado->result() as $row) 
			$s .= "<option value='".$row->CodCarrera."'".($CodCarrera==$row->CodCarrera? ' selected ':'').">".$row->Nombre."</option>";
        return $s."</select>";
	}
    
    function ComboCarrerasAdmitidas($CodUsuario, $Requerido=True) {
		$sql = "SELECT carrera.* FROM usuario, usuario_carrera, carrera
                WHERE usuario.CodUsuario=usuario_carrera.CodUsuario
                AND usuario_carrera.CodCarrera=carrera.CodCarrera
                AND usuario.CodUsuario=$CodUsuario
                ORDER BY carrera.Nombre";
        $resultado = $this->db->query($sql);
        $s = "<select name='CodCarrera' id='CodCarrera'".($Requerido?" class='required'":"").">";
		$s .= "<option value=''>-- Seleccione una carrera --</option>";
        foreach($resultado->result() as $row) 
			$s .= "<option value='$row->CodCarrera'>$row->Nombre</option>";
        return $s."</select>";
	}
	
	function GetCarrera($CodCarrera) {
		$sql = "select * from carrera where CodCarrera=$CodCarrera";
        return $this->db->query($sql)->row();
	}
}

?>