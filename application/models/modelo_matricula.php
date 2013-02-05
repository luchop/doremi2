<?php

class Modelo_matricula extends CI_Model {

    private $Tabla = 'matricula';

    function __construct() {
        parent::__construct();
    }
    
    //determina caso: nuevo, antiguo, carrera paralela
    function DeterminaCategoria($CodPersona, $Gestion) {
        if( $this->EsEstudianteNuevo($CodPersona) ) 
            return 'nuevo';
        else if( $this->CarreraParalela($CodPersona) )
            return 'paralela';
        else
            return 'antiguo';
    }
    
    function GeneraNumArchivo($CodCarrera, $Gestion) {
        $sql = "SELECT IFNULL(MAX(CAST(estudiante_carrera.NumArchivo AS UNSIGNED)),0) AS Mayor
                FROM estudiante_carrera, matricula 
                WHERE estudiante_carrera.CodEstudianteCarrera=matricula.CodEstudianteCarrera
                AND matricula.Gestion='$Gestion'
                AND estudiante_carrera.CodCarrera=$CodCarrera";
        return sprintf('%02d-%d', $Gestion-2000, $this->db->query($sql)->row()->Mayor+1);
    }
	
	function BuscaMatricula($Apellido, $CI, $RegUniversitario) {
        $sql = "SELECT persona.CodPersona, CONCAT_WS(' ', Paterno, Materno, Nombres) AS NombreCompleto, 
                Carrera.Nombre AS NombreCarrera, matricula.Matricula, Gestion, matricula.CodMatricula 
                FROM estudiante, persona, estudiante_carrera, carrera, matricula 
                WHERE estudiante.CodPersona=persona.CodPersona  
                AND estudiante.CodPersona=estudiante_carrera.CodPersona
                AND persona.CodPersona=estudiante_carrera.CodPersona 
                AND estudiante_carrera.CodCarrera=carrera.CodCarrera 
                AND estudiante_carrera.CodEstudianteCarrera=matricula.CodEstudianteCarrera 
                AND (CONCAT_WS(' ', Paterno, Materno) LIKE '%$Apellido%' OR '$Apellido'='') 
				AND (CI='$CI' OR '$CI'='') 
				AND (RegUniversitario='$RegUniversitario' OR '$RegUniversitario'='')
                ORDER BY NombreCompleto, NombreCarrera, Gestion";
        return $this->db->query($sql);
    }
    
    function DatosMatricula($CodMatricula, &$CodPersona, &$AnioIngreso, &$Matricula, &$RegUniversitario, &$Anexo,
							&$NumArchivo, &$AnioEgreso, &$CodCarrera, &$CodCarreraOrigen, 
							&$CodCambio1, &$CodCambio2, &$Deposito, &$Fecha, &$NumDeposito) {
        $sql = "SELECT * FROM matricula, estudiante_carrera, estudiante, deposito_bancario 
                WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
                AND matricula.CodMatricula=deposito_bancario.CodMatricula
                AND estudiante_carrera.CodPersona=estudiante.CodPersona
                AND matricula.CodMatricula=$CodMatricula";
        $query = $this->db->query($sql);
        $row = $query->row();
        $CodPersona = $row->CodPersona;
        $AnioIngreso = $row->AnioIngreso;
        $Matricula = $row->Matricula;
        $RegUniversitario = $row->RegUniversitario;
        $Anexo = $row->Anexo;
		$NumArchivo = $row->NumArchivo;
        $AnioEgreso = $row->AnioEgreso;
        $CodCarrera = $row->CodCarrera;
        $Deposito = $row->DepMatricula;
        $CodCarreraOrigen = 0;
        $CodCambio1 = 0;
        $CodCambio2 = 0;
        $Fecha = $row->Fecha;
        $NumDeposito = $row->NumDeposito;
    }
    
    function GetDatosMatriculacion($CodPersona, $CodCarrera, $Gestion) {
        $sql = "SELECT CONCAT_WS(' ', nombres, paterno, materno) AS NombreCompleto, CONCAT_WS(' ', CI, Expedido) AS CI,
                RegUniversitario, carrera.Nombre AS NombreCarrera, Domicilio, Fecha
                FROM persona, estudiante, estudiante_carrera, carrera, matricula
                WHERE persona.CodPersona=estudiante.CodPersona
                AND persona.CodPersona=estudiante_carrera.CodPersona
                AND estudiante_carrera.CodCarrera=carrera.CodCarrera
                AND estudiante_carrera.CodEstudianteCarrera=matricula.CodEstudianteCarrera
                AND persona.CodPersona=$CodPersona AND estudiante_carrera.CodCarrera=$CodCarrera
                AND matricula.Gestion='$Gestion'";
        $row = $this->db->query($sql)->row();
    }
    
    function InsertEstudianteCarrera($CodPersona, $CodCarrera, $AnioIngreso, $AnioEgreso, $NumArchivo) {
		$sql = "INSERT INTO estudiante_carrera (CodPersona, CodCarrera, AnioIngreso, AnioEgreso, NumArchivo) 
                VALUES ($CodPersona, $CodCarrera, '$AnioIngreso', '$AnioEgreso', '$NumArchivo')";
        $this->db->query($sql);
		$sql2 = "SELECT LAST_INSERT_ID() AS Codigo";
		$Codigo = $this->db->query($sql2)->row()->Codigo;
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        return $Codigo;
	}
	
	function InsertEstudiante($CodPersona, $RegUniversitario, $Anexo, $DocIngreso, $Categoria) {
		$sql = "INSERT INTO estudiante (CodPersona, RegUniversitario, Anexo, DocIngreso, Categoria) 
                VALUES ($CodPersona, $RegUniversitario, $Anexo, $DocIngreso, '$Categoria')";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
	}
	
	function DeleteRequisitos($CodPersona) {
    	$sql = "DELETE FROM estudiante_requisito WHERE CodPersona=$CodPersona";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
    }
    
    function InsertRequisitos($CodPersona, $Requisito, $Fecha) {
		foreach($Requisito as $r) {
			$sql = "INSERT INTO estudiante_requisito (CodPersona, CodRequisito, FechaPresentacion) VALUES(
			       $CodPersona, $r, '$Fecha')";
			$this->db->query($sql);
            $this->modelo_auditoria->Insert($CodPersona, $sql);
		}
	}
	
	function InsertMatricula($CodEstudianteCarrera, $Matricula, $Fecha, $Gestion) {
		$sql = "INSERT INTO matricula (CodEstudianteCarrera, Matricula, Fecha, Gestion) 
                VALUES ($CodEstudianteCarrera, $Matricula, '$Fecha', '$Gestion')";
        $this->db->query($sql);
		$sql2 = "SELECT LAST_INSERT_ID() AS Codigo";
		$Codigo = $this->db->query($sql2)->row()->Codigo;
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        return $Codigo;
	}
	
	function InsertDeposito($CodMatricula, $TipoMatricula, $CodBanco, $DepMatricula, $FechaDeposito, $NumDeposito) {
        $sql = "INSERT INTO deposito_bancario (CodMatricula, TipoMatricula, CodBanco, DepMatricula, FechaDeposito, NumDeposito) 
                VALUES ($CodMatricula, '$TipoMatricula', $CodBanco, $DepMatricula, '$FechaDeposito', '$NumDeposito')";
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
	}

	function Insert($CodPersona, $AnioIngreso, $Matricula, $RegUniversitario, $Anexo, $AnioEgreso,  
					$Egresado, $Profesional, $Traspaso, $Magisterio, $Titulo, $FotocopiaCI, 
					$Certificado, $Fotografia, $DocIngreso, $NumArchivo, $CodCarrera, $Fecha, 
					$NumDeposito, $Deposito, $Categoria, $Requisito, $Notas) {
					
		//en estudiante: CodPersona, RegUniversitario, Anexo, DocIngreso, Categoria
		$this->InsertEstudiante($CodPersona, $RegUniversitario, $Anexo, $DocIngreso, $Categoria);
		
		//en estudiante_requisito: CodPersona, CodRequisito, FechaPresentacion
		$this->InsertRequisitos($CodPersona, $Requisito, $Fecha);
		
		//en estudiante_carrera: CodPersona, CodCarrera, AnioIngreso, AnioEgreso, NumArchivo, Modalidad, Activo
		$CodEstudianteCarrera = $this->InsertEstudianteCarrera($CodPersona, $CodCarrera, $AnioIngreso, $AnioEgreso, $NumArchivo);
		
		//en matricula: CodEstudianteCarrera, Matricula, Fecha, Gestion, Fuente
		$CodMatricula = $this->InsertMatricula($CodEstudianteCarrera, $Matricula, $Fecha, $this->session->userdata('Gestion'));
		
		//en deposito_bancario: CodMatricula, TipoMatricula, CodBanco, DepMatricula, Fecha, NumDeposito
        if($Deposito>0)
            $this->InsertDeposito($CodMatricula, 'U', $this->modelo_valores->GetNumero('BANCO'), $Deposito, $Fecha, $NumDeposito);
		
		$this->modelo_estudiante->UpdateNotas($CodPersona, $Notas);
        
        return $CodMatricula;
	}
    
    function Update($CodMatricula, $CodPersona, $AnioIngreso, $Matricula, $RegUniversitario, $Anexo, $AnioEgreso, 
					$Egresado, $Profesional, $Traspaso, $Magisterio, $Titulo, $FotocopiaCI, 
					$Certificado, $Fotografia, $DocIngreso, $NumArchivo, $CodCarrera, $Fecha, $NumDeposito, 
					$Deposito, $Categoria, $Requisito, $Notas) {
        //estudiante
        $sql = "UPDATE estudiante set RegUniversitario=$RegUniversitario, Anexo=$Anexo, DocIngreso=$DocIngreso, 
                Categoria='$Categoria' WHERE CodPersona=$CodPersona"; 
        $this->db->query($sql);
        
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        
        //requisitos pendiente
        $this->DeleteRequisitos($CodPersona);
        $this->InsertRequisitos($CodPersona, $Requisito, $Fecha);
        
        //deposito_bancario
        $sql = "UPDATE deposito_bancario set DepMatricula='$Deposito', FechaDeposito='$Fecha', NumDeposito='$NumDeposito' WHERE CodMatricula=$CodMatricula"; 
        $this->db->query($sql);
        
        //estudiante_carrera
        $sql = "UPDATE estudiante_carrera set CodCarrera=$CodCarrera, AnioIngreso='$AnioIngreso', AnioEgreso='$AnioEgreso',
                NumArchivo='$NumArchivo' WHERE CodPersona=$CodPersona AND CodCarrera=$CodCarrera"; 
        $this->db->query($sql);
        
        //matricula
        $Gestion = $this->session->userdata('Gestion');
        $sql = "UPDATE matricula set Matricula='$Matricula', Fecha='$Fecha', Gestion='$Gestion' WHERE CodMatricula=$CodMatricula"; 
        $this->db->query($sql);
        
        $this->modelo_estudiante->UpdateNotas($CodPersona, $Notas);
    }
	
	function GetCupo($CodPersona, $Gestion, &$Desde, &$Hasta) {
		$sql = "SELECT * FROM cupo_matricula WHERE CodPersona=$CodPersona AND Gestion='$Gestion'";
		$query = $this->db->query($sql);
		if( $query->num_rows()>0 ) {
			$Desde = $query->row()->Desde;
			$Hasta = $query->row()->Hasta;
		}
		else
			$Desde = $Hasta = 0;
	}
	
	function DentroDelCupo($mat) {
		$CodUsuario = $this->session->userdata('CodUsuario');
		$Gestion = $this->session->userdata('Gestion');

		$this->GetCupo($CodUsuario, $Gestion, $Desde, $Hasta);
		return ($mat>=$Desde && $mat<=$Hasta) || ($Desde==0 && $Hasta==0);
	}
	
	function MatriculaExistente($mat) {
		$CodUsuario = $this->session->userdata('CodUsuario');
		$Gestion = $this->session->userdata('Gestion');
		
		$sql = "SELECT COUNT(*) AS Conteo FROM matricula WHERE Matricula=$mat AND Gestion='$Gestion'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->Conteo>0;
	}
	
	function CuentaCarreras($CodPersona) {
		$sql = "SELECT COUNT(*) AS Conteo FROM estudiante_carrera, matricula
				WHERE estudiante_carrera.CodEstudianteCarrera= matricula.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=$CodPersona";
		$query = $this->db->query($sql);
		return $query->row()->Conteo;
	}
    
    function Delete($CodMatricula) {
        $sql = "SELECT CodPersona, CodCarrera FROM matricula, estudiante_carrera 
                WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
                AND CodMatricula=$CodMatricula";
        $query = $this->db->query($sql);
        $CodPersona = $query->row()->CodPersona;
        $CodCarrera = $query->row()->CodCarrera;
        
        $sql = "SELECT COUNT(*) AS Conteo FROM matricula, estudiante_carrera 
                WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
                AND CodPersona=$CodPersona";
        $query = $this->db->query($sql);
        $Conteo = $query->row()->Conteo;
        
        //solo se borra si es la unica matricula del estudiante
        if($Conteo==1) {
            $sql = "DELETE FROM estudiante_requisito WHERE CodPersona=$CodPersona";
            $this->db->query($sql);
            $this->modelo_auditoria->Insert($CodPersona, $sql);
        }
        
        $sql = "DELETE FROM deposito_bancario WHERE CodMatricula=$CodMatricula";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        
        //solo se borra si es la unica matricula en la carrera
        $sql = "SELECT COUNT(*) AS Conteo  FROM estudiante_carrera, matricula
                WHERE estudiante_carrera.CodEstudianteCarrera=matricula.CodEstudianteCarrera
                AND estudiante_carrera.CodPersona=$CodPersona
                AND estudiante_carrera.CodCarrera=$CodCarrera";
        $query = $this->db->query($sql);
        $ConteoCarreras = $query->row()->Conteo;
        
        $sql = "DELETE FROM matricula WHERE CodMatricula=$CodMatricula";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert($CodPersona, $sql);
        
        if( $ConteoCarreras==1 ) {
            $sql = "DELETE FROM estudiante_carrera WHERE CodPersona=$CodPersona AND CodCarrera=$CodCarrera";
            $this->db->query($sql);
            $this->modelo_auditoria->Insert($CodPersona, $sql);
        }
        
        //solo se borra si es la unica matricula del estudiante
        if($Conteo==1) {
            $sql = "DELETE FROM estudiante WHERE CodPersona=$CodPersona";
            $this->db->query($sql);
            $this->modelo_auditoria->Insert($CodPersona, $sql);
        }
    }
    
    function Anulacion($CodMatricula) {
        $sql = "UPDATE matricula SET Anulada='S' WHERE CodMatricula=$CodMatricula";
        $this->db->query($sql);
        $this->modelo_auditoria->Insert($CodPersona, $sql);
    }
	
	function TablaMatriculados($CodCarrera, $Gestion) {
		$sql = "SELECT CONCAT_WS(' ', Paterno, Materno, Nombres) AS NombreCompleto, CONCAT(CI, ' ', Expedido) AS CI, RegUniversitario,
				matricula.fecha as Fecha,carrera.Nombre AS NombreCarrera,matricula.Matricula
				FROM matricula, estudiante_carrera, persona, estudiante, carrera
				WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=persona.CodPersona
				AND persona.CodPersona=estudiante.CodPersona
				AND estudiante_carrera.CodPersona=estudiante.CodPersona
				AND matricula.Gestion='$Gestion'
				".(($CodCarrera)?"AND estudiante_carrera.CodCarrera=$CodCarrera":'')."
				AND carrera.CodCarrera=estudiante_carrera.CodCarrera
				ORDER BY NombreCompleto";
		return $this->db->query($sql);
	}
	
	function TablaCarreraGenero($Gestion) {
		$sql = "SELECT carrera.CodCarrera,carrera.Nombre AS NombreCarrera, 
				IF( persona.Genero='M', COUNT(persona.Genero), NULL ) AS Varones,
				IF( persona.Genero='F', COUNT(persona.Genero), NULL ) AS Mujeres
				FROM matricula, estudiante_carrera, persona, estudiante, carrera
				WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=persona.CodPersona
				AND persona.CodPersona=estudiante.CodPersona
				AND estudiante_carrera.CodPersona=estudiante.CodPersona
				AND matricula.Gestion='$Gestion'
				AND carrera.CodCarrera=estudiante_carrera.CodCarrera
				GROUP BY carrera.CodCarrera,persona.Genero ORDER BY NombreCarrera";
		return $this->db->query($sql);
	}
	
	function TablaEstadosCiviles($Gestion,$Tipo) {
		$sql = "SELECT carrera.CodCarrera,carrera.Nombre AS NombreCarrera, persona.EstadoCivil,
				IF( persona.EstadoCivil='0', 1, NULL ) AS Solteros,
				IF( persona.EstadoCivil='1', 1, NULL ) AS Casados,
				IF( persona.EstadoCivil='2', 1, NULL ) AS Convivientes,
				IF( persona.EstadoCivil='3', 1, NULL ) AS Divorciados,
				IF( persona.EstadoCivil='4', 1, NULL ) AS Viudos
				FROM matricula, estudiante_carrera, persona, estudiante, carrera
				WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=persona.CodPersona
				AND persona.CodPersona=estudiante.CodPersona
				AND estudiante_carrera.CodPersona=estudiante.CodPersona
				AND matricula.Gestion='$Gestion'
				".(($Tipo!="FM")?"AND persona.Genero='$Tipo'":"")."
				AND carrera.CodCarrera=estudiante_carrera.CodCarrera
				ORDER BY NombreCarrera";
		return $this->db->query($sql);
	}
	
	function TablaTipoColegio($Gestion,$Tipo) {
		$sql = "SELECT carrera.CodCarrera,carrera.Nombre AS NombreCarrera, 
				IF( preuniversitario.TipoColegio='0', 1, NULL ) AS Publico,
				IF( preuniversitario.TipoColegio='1', 1, NULL ) AS Privado,
				IF( preuniversitario.TipoColegio='2', 1, NULL ) AS Cema,
				IF( preuniversitario.TipoColegio='3', 1, NULL ) AS Otro
				FROM matricula, estudiante_carrera, persona, estudiante, carrera,preuniversitario
				WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=persona.CodPersona
				AND persona.CodPersona=estudiante.CodPersona
				AND estudiante_carrera.CodPersona=estudiante.CodPersona
				AND matricula.Gestion='$Gestion'
				".(($Tipo!="FM")?"AND persona.Genero='$Tipo'":"")."
				AND carrera.CodCarrera=estudiante_carrera.CodCarrera
				AND preuniversitario.CodPersona=persona.CodPersona
				ORDER BY NombreCarrera";
		return $this->db->query($sql);
	}
	
	function TablaUniversidadTitulo($Gestion,$Tipo) {
		$sql = "SELECT carrera.CodCarrera,carrera.Nombre AS NombreCarrera, 
				IF( preuniversitario.CodUniversidad='11', 1, NULL ) AS UPEA,
				IF( preuniversitario.CodUniversidad='12', 1, NULL ) AS UMSA,
				IF( preuniversitario.CodUniversidad='13', 1, NULL ) AS UTO,
				IF( preuniversitario.CodUniversidad='14', 1, NULL ) AS UTF,
				IF( preuniversitario.CodUniversidad='15', 1, NULL ) AS USXX,
				IF( preuniversitario.CodUniversidad='16', 1, NULL ) AS USFX,
				IF( preuniversitario.CodUniversidad='17', 1, NULL ) AS UMSS,
				IF( preuniversitario.CodUniversidad='18', 1, NULL ) AS UAGRM,
				IF( preuniversitario.CodUniversidad='19', 1, NULL ) AS UAP,
				IF( preuniversitario.CodUniversidad='20', 1, NULL ) AS UJMS,
				IF( preuniversitario.CodUniversidad='21', 1, NULL ) AS UTB,
				IF( preuniversitario.CodUniversidad='22', 1, NULL ) AS SEDUCA,
				IF( preuniversitario.CodUniversidad='99', 1, NULL ) AS SINTITULO
				FROM matricula, estudiante_carrera, persona, estudiante, carrera,preuniversitario
				WHERE matricula.CodEstudianteCarrera=estudiante_carrera.CodEstudianteCarrera
				AND estudiante_carrera.CodPersona=persona.CodPersona
				AND persona.CodPersona=estudiante.CodPersona
				AND estudiante_carrera.CodPersona=estudiante.CodPersona
				AND matricula.Gestion='$Gestion'
				".(($Tipo!="FM")?"AND persona.Genero='$Tipo'":"")."
				AND carrera.CodCarrera=estudiante_carrera.CodCarrera
				AND preuniversitario.CodPersona=persona.CodPersona
				ORDER BY NombreCarrera";
		return $this->db->query($sql);
	}	
}

?>