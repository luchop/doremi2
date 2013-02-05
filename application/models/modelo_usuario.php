<?php

class Modelo_usuario extends CI_Model {

    //nombre de la tabla
    private $Tabla = 'usuario';

    function __construct() {
        parent::__construct();
           $this->load->model('modelo_auditoria',"Auditoria");
    }
	
	function TablaOperadores() {
		$sql = "SELECT persona.CodPersona, CONCAT_WS(' ',persona.Nombres, persona.Paterno, persona.Materno) AS NombreCompleto, usuario.NombreUsuario
				FROM usuario, persona WHERE usuario.CodPersona=persona.CodPersona
				AND (usuario.TipoUsuario='O' OR usuario.TipoUsuario='A')
				ORDER BY NombreCompleto";
        return $this->db->query($sql);
	}
	function ClaveCorrespondeUsuario($Clave,$CodUsuario) {
            $sql = "SELECT * FROM  usuario u WHERE u.CodUsuario='$CodUsuario' and Clave='$Clave' and u.Activo in ('S')";
            return $this->db->query($sql)->row();
    }
        
        function CambiaClave($CodUsuario, $NuevaClave) {
            $sql = "UPDATE usuario SET Clave='$NuevaClave' WHERE CodUsuario='$CodUsuario' and Activo in ('S')";
            $this->db->query($sql);
            
            $this->modelo_auditoria->Insert(0, $sql);
        }
	function ComboUsuarios($Tipos) {
		$sql = "SELECT persona.CodPersona, CONCAT_WS(' ',persona.Nombres, persona.Paterno, persona.Materno) AS NombreCompleto, usuario.NombreUsuario
				FROM usuario, persona WHERE usuario.CodPersona=persona.CodPersona
				AND INSTR('$Tipos', usuario.TipoUsuario)>0 ORDER BY NombreCompleto";
        $resultado = $this->db->query($sql);
        $s = "<select name='CodPersona' id='CodPersona' class='required' >";
		$s .= "<option value=''>Seleccione el usuario</option>";
        foreach($resultado->result() as $row) 
			$s .= "<option value='".$row->CodPersona."'>".$row->NombreCompleto."</option>";
        return $s."</select>";
	}
	
	function InsertCupo($CodPersona, $Gestion, $Fecha, $Desde, $Hasta) {
		$sql = "INSERT INTO cupo_matricula (CodPersona, Gestion, Fecha, Desde, Hasta) VALUES(
		       $CodPersona, '$Gestion', '$Fecha', $Desde, $Hasta)";
		$this->db->query($sql);
        $this->modelo_auditoria->Insert($CodPersona, $sql);
	}
	
    function InsertPersona($Paterno, $Materno, $Nombres, $Telefono,$Celular,$Correo) {
        $sql = "INSERT INTO persona (Paterno,Materno,Nombres,Genero,FechaNac,LugarNac,TipoId,CI,Expedido,
				CodPais,EstadoCivil,Domicilio,Telefono,Celular,Correo,TelUrgencia,Obs) 
                VALUES ('$Paterno','$Materno','$Nombres','','','','U','','',".
				$this->modelo_valores->GetNumero('CODIGOPAIS').
				",'','','$Telefono','$Celular','$Correo','','')";
        
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }
	
    function Insert($NombreUsuario, $Clave, $TipoUsuario) {
        $Activo = "S";
        $sql = "INSERT INTO usuario (CodPersona, NombreUsuario, Clave,CodPerfil,Activo) VALUES 
		        (LAST_INSERT_ID(), '$NombreUsuario', '$Clave', '$TipoUsuario','$Activo')";
        
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }
    function InsertUsuarioCarrera($CodUsuario, $CodCarrera) {
        $sql = "INSERT INTO usuario_carrera (CodUsuario, CodCarrera) VALUES ($CodUsuario,$CodCarrera)";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }
    function DeleteUsuarioCarrera($CodUsuarioCarrera) {
        $sql = "DELETE FROM usuario_carrera WHERE CodUsuarioCarrera=$CodUsuarioCarrera";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }
    function DeleteAllUsuarioCarrera($CodUsuario) {
        $sql = "DELETE FROM usuario_carrera WHERE CodUsuario=$CodUsuario";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert(0, $sql);
    }
    function GetUsuarioCarrera($CodUsuario) {
        $sql = "SELECT * FROM  usuario_carrera uc, carrera c 
		        WHERE uc.CodCarrera=c.CodCarrera and uc.CodUsuario=$CodUsuario order by c.Nombre asc";

        return $this->db->query($sql);
    }
	
    function UpdatePersona($CodPersona,$Paterno, $Materno, $Nombres, $Telefono,$Celular,$Correo) {
        $sql = "UPDATE persona set Paterno='$Paterno',Materno='$Materno',Nombres='$Nombres',Telefono='$Telefono',Celular='$Celular',Correo='$Correo'
                WHERE CodPersona='$CodPersona'";
     
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        return $this->db->query($sql);
    }

    function Update($CodUsuario, $CodPersona, $NombreUsuario, $Clave, $TipoUsuario) {
        $sql = "UPDATE $this->Tabla SET  NombreUsuario='$NombreUsuario',Clave='$Clave',CodPerfil='$TipoUsuario'
                WHERE CodUsuario=$CodUsuario and CodPersona='$CodPersona'";
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        return $this->db->query($sql);
    }

    function Disable($CodUsuario) {
        $sql = "UPDATE $this->Tabla SET Activo='N'
                WHERE CodUsuario=$CodUsuario";
        return $this->db->query($sql);
    }

    function GetAll() {
        $sql = "SELECT u.*,p.*,pr.Nombres,pr.Paterno,pr.Materno FROM  usuario u, perfil p,persona pr 
		        WHERE pr.CodPersona=u.CodPersona and u.CodPerfil=p.CodPerfil and u.Activo in ('S')";

        return $this->db->query($sql);
    }
    
    function GetXUsuario($Usuario) {
        $sql = "SELECT * FROM  usuario u WHERE u.NombreUsuario='$Usuario' and u.Activo in ('S')";
        return $this->db->query($sql)->row();
    }
    
    function GetXId($codigo) {
        $sql = "SELECT u.*,p.*,pr.Nombres,pr.Paterno,pr.Materno,pr.Telefono,pr.Celular,pr.Correo FROM  usuario u, perfil p,persona pr 
            WHERE pr.CodPersona=u.CodPersona and u.CodPerfil=p.CodPerfil and u.Activo in ('S') and u.CodUsuario='$codigo'";
        return $this->db->query($sql)->row();
    }

    function ComboPersona() {
        $sql = "SELECT * FROM persona  WHERE Tipold in ('U')";
        $resultado = $this->db->query($sql);
        $s = "<select name='CodPersona' id='CodPersona'>";
        $s .= "<option value=''>-- Seleccione persona --</option>";
        foreach ($resultado->result() as $row)
            $s .= "<option value=" . $row->CodPerfil .  ">" . $row->Perfil . "</option>";
        return $s . "</select>";
    }
    
    function ComboPerfil() {
        $sql = "SELECT * FROM perfil ORDER BY Perfil";
        $resultado = $this->db->query($sql);
        $s = "<select name='CodPerfil' id='CodPerfil'>";
        foreach ($resultado->result() as $row)
            $s .= "<option value=" . $row->CodPerfil .  ">" . $row->Perfil . "</option>";
        return $s . "</select>";
    }
}

?>