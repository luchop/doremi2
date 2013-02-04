<?php

class Modelo_login extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function Login($Usuario, $Clave) {
        $this->db->select('CodUsuario, NombreUsuario');
        $this->db->from('usuario');
        $this->db->where('NombreUsuario', $Usuario);
        $this->db->where('Clave', $Clave);
        $this->db->where('Activo', 'S');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
            return $query->result();
        else 
            return false;
    }
	
    function LoginDatos($Usuario, $Clave) {
        $sql="SELECT u.CodUsuario, u.CodPerfil, u.CodPersona, u.NombreUsuario, p.Perfil, p.Llave FROM usuario u, perfil p 
		      WHERE u.CodPerfil=p.CodPerfil and u.NombreUsuario=? and u.Clave=? and u.Activo='S'";
        return $this->db->query($sql, array($Usuario, $Clave))->row(); 
    }
}

?>