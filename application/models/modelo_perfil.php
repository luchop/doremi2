<?php

class Modelo_perfil extends CI_Model {

    //nombre de la tabla
    private $Tabla = 'perfil';

    function __construct() {
        parent::__construct();
    }
    
    function Insert($Perfil, $Llave) {
        $sql = "INSERT INTO perfil (Perfil,Administrador,Llave) VALUES ('$Perfil', 'N', '$Llave')";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert(0, $sql);
    }

    function Update($CodPerfil, $Perfil,$Llave) {
        $sql = "UPDATE perfil SET Perfil='$Perfil', Llave='$Llave'
                WHERE CodPerfil=$CodPerfil";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }

    function Disable($CodPerfil) {
        $sql = "UPDATE perfil SET Administrador='N'
                WHERE CodPerfil=$CodPerfil";
        return $this->db->query($sql);
    }

    function GetAll() {
        $sql = "SELECT * FROM  perfil order by Perfil";
        return $this->db->query($sql);
    }
    
    function GetXId($codigo) {
        $sql = "SELECT * FROM perfil WHERE CodPerfil=$codigo";
        return $this->db->query($sql)->row();
    }
}

?>