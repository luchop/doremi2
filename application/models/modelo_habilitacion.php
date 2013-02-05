<?php

class Modelo_habilitacion extends CI_Model {

    //nombre de la tabla
    private $Tabla = 'habilitacion';

    function __construct() {
        parent::__construct();
    }
	
	function GetItem($CodHabilitacion){
		$sql = "SELECT * FROM habilitacion WHERE CodHabilitacion=$CodHabilitacion";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
    function Insert($FechaInicio,$FechaFin,$CodCarrera,$DesdeNombre,$HastaNombre) {
        $sql = "INSERT INTO habilitacion (FechaInicio,FechaFin,CodCarrera,DesdeNombre,HastaNombre) VALUES 
		        ('$FechaInicio','$FechaFin','$CodCarrera','$DesdeNombre','$HastaNombre')";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert(0, $sql);
    }

    function Update($CodHabilitacion,$FechaInicio,$FechaFin,$CodCarrera,$DesdeNombre,$HastaNombre) {
        $sql = "UPDATE habilitacion SET FechaInicio='$FechaInicio',FechaFin='$FechaFin',CodCarrera='$CodCarrera',DesdeNombre='$DesdeNombre',HastaNombre='$HastaNombre' WHERE CodHabilitacion='$CodHabilitacion'";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert(0, $sql);
    }
}
?>