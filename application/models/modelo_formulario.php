<?php

class Modelo_formulario extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function InsertPersona($Paterno, $Materno, $Nombres, $Genero, $FechaNac, $LugarNac, $TipoId, $CI, $Expedido, $CodPais, $EstadoCivil, 
                           $Domicilio, $Telefono, $Celular, $Correo, $TelUrgencia, $Obs) {
        $Paterno = $this->seguridad->FiltroNombres($Paterno);
        $Materno = $this->seguridad->FiltroNombres($Materno);
        $Nombres = $this->seguridad->FiltroNombres($Nombres);
        $consulta = "INSERT INTO persona (Paterno, Materno, Nombres, Genero, FechaNac, LugarNac, TipoId, CI, Expedido, CodPais, EstadoCivil, 
                                          Domicilio, Telefono, Celular, Correo, TelUrgencia, Obs, FechaAlta) ";
        $consulta.= "VALUES ('$Paterno', '$Materno', '$Nombres', '$Genero', '$FechaNac', '$LugarNac', '$TipoId', '$CI', '$Expedido', '$CodPais', 
                             '$EstadoCivil', '$Domicilio', '$Telefono', '$Celular', '$Correo', '$TelUrgencia', '$Obs', NOW() ) ";

        $this->db->query($consulta);
        return $this->db->query("select LAST_INSERT_ID() as Codigo;")->row()->Codigo;
    }
    
    function InsertPreuniversitario($CodPersona, $CodUniversidad, $Colegio, $AnioEgreso, $TipoColegio, $NumTitulo, $AnioTitulo, $Localidad,$CodPais,$CodCarrera,$CodSubsede) {
        if($CodSubsede=='')   $CodSubsede2='null' ;        else $CodSubsede2=$CodSubsede;
        $consulta = "INSERT INTO preuniversitario (CodPersona, CodUniversidad, Colegio, AnioEgreso, TipoColegio, NumTitulo, AnioTitulo, Localidad,CodPais,CodCarrera,CodSubsede) ";
        $consulta.= "VALUES ('$CodPersona', '$CodUniversidad', '$Colegio', '$AnioEgreso', '$TipoColegio', '$NumTitulo', '$AnioTitulo', '$Localidad','$CodPais','$CodCarrera',$CodSubsede2) ";
		return $this->db->query($consulta);        
    }

    function UpdatePersona($CodPersona, $Paterno, $Materno, $Nombres, $Genero, $FechaNac, $LugarNac, $TipoId, $CI, $Expedido, $CodPais, $EstadoCivil, $Domicilio, $Telefono, $Celular, $Correo, $TelUrgencia, $Obs) {
        $consulta = "UPDATE persona SET ";
        $consulta.= " Paterno = '$Paterno', Materno = '$Materno', Nombres = '$Nombres', Genero = '$Genero', FechaNac = '$FechaNac', LugarNac = '$LugarNac', TipoId = '$TipoId', CI = '$CI', Expedido = '$Expedido', CodPais = '$CodPais', EstadoCivil = '$EstadoCivil', Domicilio = '$Domicilio', Telefono = '$Telefono', Celular = '$Celular', Correo = '$Correo', TelUrgencia = '$TelUrgencia', Obs = '$Obs' ";
        $consulta.= " WHERE CodPersona = '$CodPersona'  ";
        return $this->db->query($consulta);
    }

    function UpdatePreuniversitario($CodPersona, $CodUniversidad, $Colegio, $AnioEgreso, $TipoColegio, $NumTitulo, $AnioTitulo, $Localidad,$CodPais,$CodCarrera,$CodSubsede) {
        if($CodSubsede=='')  $CodSubsede2='null' ;    else $CodSubsede2=$CodSubsede;
            
        $consulta = "UPDATE preuniversitario SET ";
        $consulta.= " CodUniversidad = '$CodUniversidad', Colegio = '$Colegio', AnioEgreso = '$AnioEgreso', TipoColegio = '$TipoColegio', NumTitulo = '$NumTitulo', AnioTitulo = '$AnioTitulo', Localidad = '$Localidad',CodPais='$CodPais',CodCarrera='$CodCarrera',CodSubsede=$CodSubsede2";
        $consulta.= " WHERE CodPersona = '$CodPersona'  ";
       
        return $this->db->query($consulta);
    }

    function InsertSocioeconomico($CodPersona, $CodZona, $Gestion, $Vivienda, $Caracteristicas, $Trabaja, $Trabajo, $Jornada) {
        $consulta = "INSERT INTO socio_economico (CodPersona, CodZona, Gestion, Vivienda, Caracteristicas, Trabaja, Trabajo, Jornada) ";
        $consulta.= "VALUES ('$CodPersona', '$CodZona', '$Gestion', '$Vivienda', '$Caracteristicas', '$Trabaja', '$Trabajo', '$Jornada') ";
        return $this->db->query($consulta);
    }

    function UpdateSocioeconomico($CodPersona, $CodZona, $Gestion, $Vivienda, $Caracteristicas, $Trabaja, $Trabajo, $Jornada) {
        $consulta = "UPDATE socio_economico SET ";
        $consulta.= " CodZona = '$CodZona', Gestion = '$Gestion', Vivienda = '$Vivienda', Caracteristicas = '$Caracteristicas', Trabaja = '$Trabaja', Trabajo = '$Trabajo', Jornada = '$Jornada' ";
        $consulta.= " WHERE CodPersona = '$CodPersona' ";
        return $this->db->query($consulta);
    }

    function Disable($CodUsuario) {
        $sql = "UPDATE $this->Tabla SET Activo='N'
                WHERE CodUsuario=$CodUsuario";
        return $this->db->query($sql);
    }

    function GetAll() {
        $sql = "SELECT u.*,p.*,pr.Nombres,pr.Paterno,pr.Materno FROM  usuario u, perfil p,persona pr WHERE pr.CodPersona=u.CodPersona and u.TipoUsuario=p.CodPerfil and u.Activo in ('S')";
        return $this->db->query($sql);
    }

    function GetXId($CodPersona) {
        $sql = " SELECT p.*,p.CodPais as PaisNacimiento,ps1.Nombre as NombrePaisNacimiento,p2.*,p2.CodPais as PaisTitulo,c.nombre as NombreCarrera,
            ps2.Nombre as NombrePaisTitulo,s.*,z.Nombre as Zona,u.Nombre as Universidad,sb.Nombre as Subsede
            FROM persona p LEFT JOIN preuniversitario  p2 ON (p.CodPersona=p2.CodPersona)
            LEFT JOIN socio_economico s ON (s.CodPersona=p.CodPersona)
            LEFT JOIN zona z ON (z.CodZona=s.CodZona)
            LEFT JOIN pais ps1 ON (ps1.CodPais=p.CodPais)
            LEFT JOIN pais ps2 ON(ps2.CodPais=p2.CodPais)
            LEFT JOIN universidad u on (p2.CodUniversidad=u.CodUniversidad)
            LEFT JOIN carrera c on (p2.CodCarrera=c.CodCarrera)
            LEFT JOIN subsede sb on (P2.CodSubsede=sb.CodSubsede)
            
            WHERE p.CodPersona=$CodPersona ;";
        
        return $this->db->query($sql)->row();        
    }
    //+++++++++++++++++++++++++esto debe ir a otro modelo de reportes++++++++++++++++++++++++++//
    function ListadoEstudiantesPorGestion($Gestion) {
        $sql = "select count(*) numero,m.gestion,c.Nombre from matricula m, estudiante_carrera ec,carrera c
where m.CodEstudianteCarrera=ec.CodEstudianteCarrera and ec.CodCarrera=c.CodCarrera and gestion=$Gestion
group by c.CodCarrera;";
        
        return $this->db->query($sql);        
    }
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
    function ComboPais($Combo,$Selected) {
        $sql = "SELECT * FROM pais";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Pais--</option>";
        foreach ($resultado->result() as $row){
            if($row->CodPais==$Selected)
            {
                $s .= "<option value=" . $row->CodPais . " Selected>" . $row->Nombre . "</option>";
            }
            else
            $s .= "<option value=" . $row->CodPais . ">" .$row->Nombre . "</option>";
        }
        return $s . "</select>";
    }

     function ComboUniversidades($Combo,$Selected) {
        $sql = "SELECT * FROM universidad u";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Universidad--</option>";
        foreach ($resultado->result() as $row){
            if($row->CodUniversidad==$Selected)
            {
                $s .= "<option value=" . $row->CodUniversidad . " Selected>" .$row->Nombre . "</option>";
            }
            else
            $s .= "<option value=" . $row->CodUniversidad . ">" .$row->Nombre . "</option>";
        }
        return $s . "</select>";
    }
    
    function ComboZona($Combo,$Selected) {
        $sql = "SELECT * FROM zona z;";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Combo' id='$Combo'>";
        $s .= "<option value=''>--Seleccione Zona--</option>";
        foreach ($resultado->result() as $row){
            if($row->CodZona==$Selected)
            {
                $s .= "<option value=" . $row->CodZona . " Selected>" .$row->Nombre. "</option>";
            }
            else
            $s .= "<option value=" . $row->CodZona . ">" .$row->Nombre. "</option>";
        }
        return $s . "</select>";
    }
    function ComboCarrera($Nombre,$CodCarrera ) {
		$sql = "select * from carrera order by Nombre";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Nombre' id='$Nombre'>";
		$s .= "<option value=''>Seleccione una carrera</option>";
        foreach($resultado->result() as $row) {
			 if($row->CodCarrera==$CodCarrera)
            {
                $s .= "<option value=" . $row->CodCarrera . " Selected>" .$row->Nombre. "</option>";
            }
            else
            $s .= "<option value=" . $row->CodCarrera . ">" .$row->Nombre. "</option>";
        }
            
        return $s."</select>";
	}
    function VerificaEstudiante($Nombre, $Paterno, $Materno,$CI)
    {
        $sql = "SELECT * FROM persona WHERE Nombres = '$Nombre' and Paterno='$Paterno' and Materno = '$Materno' and CI='$CI' ";
        return $resultado = $this->db->query($sql)->row();
    }
    function VerificaPais()
    {
        $sql = "SELECT Numero FROM valores WHERE Codigo = 'CODIGOPAIS'";
        return $resultado = $this->db->query($sql)->row()->Numero;
    }
    
    function VerificaCI($Ci)
    {
        $sql = "SELECT * FROM persona Where CI='$Ci'";
        return $resultado = $this->db->query($sql)->row();        
    }
    
    function VerificaNombreEstudiante($Paterno,$Materno,$Nombres)
    {
        $sql = "SELECT persona.CodPersona, CONCAT_WS(' ', Paterno, Materno, Nombres) AS NombreCompleto
				FROM persona WHERE CONCAT_WS('-', Paterno, Materno,Nombres)='$Paterno-$Materno-$Nombres'";
        return $resultado = $this->db->query($sql)->row();
    }
    
    function VerificaEstudianteMatriculado($CodPersona) {
        $sql = "select * from estudiante where CodPersona=$CodPersona";
        return $this->db->query($sql)->row();
    }
    
    function ComboCarreraSubsedes($Nombre,$CodSubsede,$Carrera ) {
		$sql = "SELECT s.CodSubsede,s.Nombre 
                    FROM subsede_carrera sc, subsede s, carrera c 
                    WHERE s.CodSubsede=sc.CodSubsede and c.CodCarrera=sc.CodCarrera and sc.CodCarrera='$Carrera';";
        $resultado = $this->db->query($sql);
        $s = "<select name='$Nombre' id='$Nombre'>";
		$s .= "<option value=''>Seleccione una subsede</option>";
        foreach($resultado->result() as $row) {
			 if($row->CodSubsede==$CodSubsede)
            {
                $s .= "<option value=" . $row->CodSubsede . " Selected>" .$row->Nombre. "</option>";
            }
            else
            $s .= "<option value=" . $row->CodSubsede . ">" .$row->Nombre. "</option>";
        }
            
        return $s."</select>";
	}
}
?>