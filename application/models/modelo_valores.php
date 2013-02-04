<?php

class Modelo_valores extends CI_Model {

    //nombre de la tabla
    private $Tabla = 'valores';

    function __construct() {
        parent::__construct();
    }

	function SetNumero($Codigo, $Numero) {
        $sql = "insert into $this->Tabla (Codigo, Numero) values('$Codigo', $Numero)
				on duplicate key update Numero=$Numero";
        $this->db->query($sql);	
	}
	
	function SetTexto($Codigo, $Cadena) {
        $sql = "insert into $this->Tabla (Codigo, Cadena) values('$Codigo', '$Cadena')
				on duplicate key update Cadena='$Cadena'";
        $this->db->query($sql);	
	}
	
	function GetTexto($Codigo) {
        $sql = "select Cadena from $this->Tabla where Codigo='$Codigo'";
        $query = $this->db->query($sql);	
		if( $query->num_rows()==0 )
			return '';
		else
			return $query->row()->Cadena;
	}
	
	function GetNumero($Codigo) {
        $sql = "select Numero from $this->Tabla where Codigo='$Codigo'";
        $query = $this->db->query($sql);	
		if( $query->num_rows()==0 )
			return 0;
		else
			return $query->row()->Numero;
	}
}

?>