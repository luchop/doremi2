<?php

class Modelo_persona extends CI_Model {

    private $Tabla = 'persona';

    function __construct() {
        parent::__construct();
    }

	function EsNacional($CodPersona) {
		$sql = "select CodPais from persona WHERE CodPersona=$CodPersona";
        $query = $this->db->query($sql);	
		return $query->row()->CodPais==$this->modelo_valores->GetNumero('CODIGOPAIS');
	}
	
	function GetNombre($CodPersona) {
		$sql = "select CONCAT_WS(' ', Nombres, Paterno, Materno) AS Nombre from persona WHERE CodPersona=$CodPersona";
        $query = $this->db->query($sql);	
		return $query->row()->Nombre;
	}
    
    function Depuracion($Plazo) {
        $sql = "SELECT COUNT(*) as Conteo FROM persona p LEFT JOIN estudiante_carrera
                ON estudiante_carrera.CodPersona=p.CodPersona
                WHERE estudiante_carrera.CodPersona IS NULL
                AND NOT EXISTS (SELECT NULL FROM usuario WHERE codPersona=p.CodPersona )
                AND DATEDIFF(NOW(), FechaAlta)>$Plazo";
        $query = $this->db->query($sql);
        
        $sql = "DELETE p FROM persona p LEFT JOIN estudiante_carrera
                ON estudiante_carrera.CodPersona=p.CodPersona
                WHERE estudiante_carrera.CodPersona IS NULL
                AND NOT EXISTS (SELECT NULL FROM usuario WHERE codPersona=p.CodPersona )
                AND DATEDIFF(NOW(), FechaAlta)>$Plazo";
        $this->db->query($sql);
        return $query->row()->Conteo;
    }
}

?>