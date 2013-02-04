<?php

class Modelo_auditoria extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function InsertHora() {
        $sql = "INSERT INTO temphora VALUES ()";
        $this->db->query($sql);
    }

    public function Insert($CodUsuario, $CodPersona, $Operacion, $Consulta) {
        $Consulta=str_replace("'",' ',$Consulta);
        $consulta = "INSERT INTO auditoria (CodUsuario, CodPersona, Fecha, Operacion, Consulta) ";
        $consulta.= "VALUES ('$CodUsuario', '$CodPersona', now(), '$Operacion', '$Consulta') ";
        return $this->db->query($consulta);
    }

    public function Update($CodAuditoria, $CodUsuario, $CodPersona, $Operacion, $Consulta) {
        $consulta = "UPDATE auditoria SET ";
        $consulta.= " CodUsuario = '$CodUsuario', CodPersona = '$CodPersona', Operacion = '$Operacion', Consulta = '$Consulta' ";
        $consulta.= " WHERE CodAuditoria = '$CodAuditoria'  ";
        return $this->db->query($consulta);
    }

    public function GetAll() {
        $consulta = "SELECT * FROM auditoria ";
        return $resultado = $this->db->query($consulta);
    }
   
    function BusquedaPersona( $CI,$Apellido, $RegUniversitario) {
	
		$sql = "SELECT persona.CodPersona, CONCAT_WS(' ', Paterno, Materno, Nombres) AS NombreCompleto
				
				FROM estudiante, persona 
				WHERE persona.CodPersona=estudiante.CodPersona  
				AND (CONCAT_WS(' ', Paterno, Materno) LIKE '%$Apellido%' OR '$Apellido'='') 
				AND (CI='$CI' OR '$CI'='') 
				AND (RegUniversitario='$RegUniversitario' OR '$RegUniversitario'='') limit 0,1";			
                //echo $sql;
		return $this->db->query($sql)->row();
	}
    public function GetAllXCodPersona($CodPersona) {
        $consulta = "SELECT * FROM auditoria where CodPersona='$CodPersona'";
        //echo $consulta;
        return $resultado = $this->db->query($consulta);
    }

    function VerificaCI($Ci) {
        $sql = "SELECT * FROM persona Where CI='$Ci'";
        //echo $sql;
        return $resultado = $this->db->query($sql)->row();
    }

}

?>
