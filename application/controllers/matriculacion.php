<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Matriculacion extends CI_Controller {

    private $Menu;
	
	function __construct() {
        parent::__construct();
		$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
    }

    function Index() {
	    $data['VistaMenu'] = $this->Menu;
		$data['VistaPrincipal'] = 'vista_nula';
        $this->load->view('vista_maestra', $data);
    }
	
	function Login() {
		$data['VistaPrincipal'] = 'vista_login';
        $this->load->view('vista_maestra', $data);
    }
	
	function InicializaVariables($CodPersona) {
		$data['VistaMenu'] = $this->Menu;

		//determina caso: nuevo, antiguo, carrera paralela
        $Carreras = $this->modelo_matricula->CuentaCarreras($CodPersona);
        if( $Carreras==0 )
            $this->modelo_estudiante->DatosNuevaMatriculacion($CodPersona, $AnioIngreso, $RegUniversitario, $Anexo,
															  $NumArchivo, $AnioEgreso, $CodCarrera, $CodCarreraOrigen, 
															  $CodCambio1, $CodCambio2);
		else if( $Carreras==1 )
			$this->modelo_estudiante->DatosMatriculacion($CodPersona, $AnioIngreso, $RegUniversitario, $Anexo,
														 $NumArchivo, $AnioEgreso, $CodCarrera, $CodCarreraOrigen, 
														 $CodCambio1, $CodCambio2);
        else  //datos de la carrera en que aun no se ha matriculado
            $this->modelo_estudiante->DatosMatriculacionParalela($CodPersona, $AnioIngreso, $RegUniversitario, $Anexo,
                                                                 $NumArchivo, $AnioEgreso, $CodCarrera, $CodCarreraOrigen, 
                                                                 $CodCambio1, $CodCambio2);
        $data['AnioIngreso'] = $AnioIngreso;
		$data['Matricula'] = $this->UltimaMatriculaExpedida() + 1;
        //importe de la matricula depende de la nacionalidad
		if( $this->modelo_persona->EsNacional($CodPersona) ) 
			$data['Deposito'] = number_format( $this->modelo_valores->GetNumero('MATRICULANACIONAL')/100, 2);
		else
			$data['Deposito'] = number_format( $this->modelo_valores->GetNumero('MATRICULAEXTRANJERO')/100, 2);
		$data['RegUniversitario'] = $RegUniversitario;
		$data['Anexo'] = $Anexo==0? '': $Anexo;
		$data['NumArchivo'] = $NumArchivo;
		$data['AnioEgreso'] = $AnioEgreso;
		$data['CodCarrera'] = $CodCarrera;
		$data['CodCarreraOrigen'] = $CodCarreraOrigen;
		$data['CodCambio1'] = $CodCambio1;
		$data['CodCambio2'] = $CodCambio2;
		$data['Fecha'] = date('d/m/Y');
		$data['NumDeposito'] = '';
		
		$this->modelo_estudiante->DatosEstudiante($CodPersona, $Notas, $Egresado, $Profesional, $Traspaso, $Magisterio, $DocIngreso);
		$data['Notas'] = $Notas;
		$data['Egresado'] = $Egresado;
		$data['Profesional'] = $Profesional;
		$data['Traspaso'] = $Traspaso;
		$data['Magisterio'] = $Magisterio;
		$data['ComboDocIngreso'] = $this->funciones->ComboDocIngreso($DocIngreso);
		
		$this->modelo_estudiante->RequisitosEstudiante($CodPersona, $Titulo, $FotocopiaCI, $Certificado, $Fotografia);
		$data['Titulo'] = $Titulo;
		$data['FotocopiaCI'] = $FotocopiaCI;
		$data['Certificado'] = $Certificado;
		$data['Fotografia'] = $Fotografia;

		return $data;
	}
    
    function RecuperaDatosMatricula($CodMatricula) {
        $this->modelo_matricula->DatosMatricula($CodMatricula, $CodPersona, $AnioIngreso, $Matricula, $RegUniversitario, $Anexo,
												$NumArchivo, $AnioEgreso, $CodCarrera, $CodCarreraOrigen, 
												$CodCambio1, $CodCambio2, $Deposito, $Fecha, $NumDeposito);
		$data['CodMatricula'] = $CodMatricula;
        $data['CodPersona'] = $CodPersona;
        $data['AnioIngreso'] = $AnioIngreso;
		$data['Matricula'] = $Matricula;
		$data['RegUniversitario'] = $RegUniversitario;
		$data['Anexo'] = $Anexo==0? '': $Anexo;
		$data['NumArchivo'] = $NumArchivo;
		$data['AnioEgreso'] = $AnioEgreso;
		$data['CodCarrera'] = $CodCarrera;
		$data['CodCarreraOrigen'] = $CodCarreraOrigen;
		$data['CodCambio1'] = $CodCambio1;
		$data['CodCambio2'] = $CodCambio2;
		$data['Deposito'] = number_format($Deposito, 2);
		$data['Fecha'] = $Fecha;
		$data['NumDeposito'] = $NumDeposito;
		
		$this->modelo_estudiante->DatosEstudiante($CodPersona, $Notas, $Egresado, $Profesional, $Traspaso, $Magisterio, $DocIngreso);
		$data['Notas'] = $Notas;
		$data['Egresado'] = $Egresado;
		$data['Profesional'] = $Profesional;
		$data['Traspaso'] = $Traspaso;
		$data['Magisterio'] = $Magisterio;
		$data['ComboDocIngreso'] = $this->funciones->ComboDocIngreso($DocIngreso);
		
		$this->modelo_estudiante->RequisitosEstudiante($CodPersona, $Titulo, $FotocopiaCI, $Certificado, $Fotografia);
		$data['Titulo'] = $Titulo;
		$data['FotocopiaCI'] = $FotocopiaCI;
		$data['Certificado'] = $Certificado;
		$data['Fotografia'] = $Fotografia;

		return $data;
    }
	
	function ArregloRequisitos($Titulo, $FotocopiaCI, $Certificado, $Fotografia) {
		$a = array();
		if($Titulo)	$a[] = 1;
		if($FotocopiaCI) $a[] = 2;
		if($Certificado) $a[] = 3;
		if($Fotografia)	$a[] = 4;
		return $a;
	}
	
	//
	//Funcion que se usa cuando el estudiante no esta matriculado en _esta_ gestion
	//
	function NuevaMatricula($CodPersona) {
		$this->funciones->VerificaSesion();
		
		$this->form_validation->set_rules('Fecha', '"Fecha"', 'trim|valid_date');
		$this->form_validation->set_rules('Matricula', '"matr&iacute;cula"', 'trim|callback_MatriculaValida');
		$this->form_validation->set_rules('RegUniversitario', '"registro universitario"', 'trim|callback_RegUniversitarioValido['.$this->input->post('Anexo').']');
		$data = $this->InicializaVariables($CodPersona);
		$data['CodPersona'] = $CodPersona;
		$data['VistaMenu'] = $this->Menu;
        if ($this->form_validation->run()) {
			$Anexo = $this->input->post('Anexo')==''? 0 : $this->input->post('Anexo');
			
			$Categoria = $this->input->post('Egresado')? 'E':''; $Categoria .= $this->input->post('Profesional')? 'P':'';
			$Categoria .= $this->input->post('Traspaso')? 'T':''; $Categoria .= $this->input->post('Magisterio')? 'M':'';
			
			$Requisito = $this->ArregloRequisitos($this->input->post('Titulo'), $this->input->post('FotocopiaCI'),
			                                        $this->input->post('Certificado'), $this->input->post('Fotografia'));
			$Fecha = FechaParaMySQL($this->input->post('Fecha'));										
			$CodMatricula = $this->modelo_matricula->Insert($CodPersona, $this->input->post('AnioIngreso'), 
											$this->input->post('Matricula'), $this->input->post('RegUniversitario'), 
											$Anexo, $this->input->post('AnioEgreso'), 
											$this->input->post('Egresado'), $this->input->post('Profesional'), 
											$this->input->post('Traspaso'), $this->input->post('Magisterio'), 
											$this->input->post('Titulo'), $this->input->post('FotocopiaCI'), 
											$this->input->post('Certificado'), $this->input->post('Fotografia'), 
											$this->input->post('DocIngreso'), $this->input->post('NumArchivo'), 
											$this->input->post('CodCarrera'), 
											$Fecha, $this->input->post('NumDeposito'), 
											$this->input->post('Deposito'), $Categoria, $Requisito,
											$this->input->post('Notas')); 
            
            //redirect("listados/ImprimeMatricula/$CodPersona/".$this->input->post('CodCarrera')."/".$this->session->userdata('Gestion'), 'refresh');
            $data['CodMatricula'] = $CodMatricula;
            $data['NumMatricula'] = $this->input->post('Matricula');
            $data['VistaPrincipal'] = 'impresion/vista_confirma_impresion_matricula';
        } else
            $data['VistaPrincipal'] = 'vista_nueva_matricula';
        $this->load->view('vista_maestra', $data);
    }
    
    function ModificaMatricula($CodMatricula) {
		$this->funciones->VerificaSesion();
		
		$this->form_validation->set_rules('Fecha', '"Fecha"', 'trim|valid_date');
		//$this->form_validation->set_rules('Matricula', '"matr&iacute;cula"', 'trim|callback_MatriculaValida');
		//$this->form_validation->set_rules('RegUniversitario', '"registro universitario"', 'trim|callback_RegUniversitarioValido['.$this->input->post('Anexo').']');
		$data = $this->RecuperaDatosMatricula($CodMatricula);
        $data['VistaMenu'] = $this->Menu;
        if ($this->form_validation->run()) {
			$Anexo = $this->input->post('Anexo')==''? 0 : $this->input->post('Anexo');
			
			$Categoria = $this->input->post('Egresado')? 'E':''; $Categoria .= $this->input->post('Profesional')? 'P':'';
			$Categoria .= $this->input->post('Traspaso')? 'T':''; $Categoria .= $this->input->post('Magisterio')? 'M':'';
			
			$Requisito = $this->ArregloRequisitos($this->input->post('Titulo'), $this->input->post('FotocopiaCI'),
			                                        $this->input->post('Certificado'), $this->input->post('Fotografia'));
			$Fecha = FechaParaMySQL($this->input->post('Fecha'));										
			$this->modelo_matricula->Update($CodMatricula, $this->input->post('CodPersona'), $this->input->post('AnioIngreso'), 
											$this->input->post('Matricula'), $this->input->post('RegUniversitario'), 
											$Anexo, $this->input->post('AnioEgreso'), 
											$this->input->post('Egresado'), $this->input->post('Profesional'), 
											$this->input->post('Traspaso'), $this->input->post('Magisterio'), 
											$this->input->post('Titulo'), $this->input->post('FotocopiaCI'), 
											$this->input->post('Certificado'), $this->input->post('Fotografia'), 
											$this->input->post('DocIngreso'), $this->input->post('NumArchivo'), 
											$this->input->post('CodCarrera'), 
											$Fecha, $this->input->post('NumDeposito'), 
											$this->input->post('Deposito'), $Categoria, $Requisito,
											$this->input->post('Notas')); 
            
            $data['Mensaje'] = 'Las modificaciones han sido registradas.';
            $data['VistaPrincipal'] = 'vista_mensaje';            
        } else
            $data['VistaPrincipal'] = 'vista_modifica_matricula';
        $this->load->view('vista_maestra', $data);
    }
    
    function BuscaParaModificar() {
        $this->funciones->VerificaSesion();
        
        $data['VistaMenu'] = $this->Menu;
        $data['Modificacion'] = 1;
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim|min_length[3]');
        if ($this->form_validation->run()) {
            $registros = $this->modelo_matricula->BuscaMatricula($this->input->post('Apellido'), $this->input->post('CI'), 
                                                                 $this->input->post('RegUniversitario'));
            if ($registros->num_rows() == 0) {
                $data['Mensaje'] = 'No se encontraron registros que cumplan el criterio de b&uacute;squeda';
                $data['VistaPrincipal'] = 'vista_mensaje';            
                $this->load->view('vista_maestra', $data);
            } else if ($registros->num_rows() == 1) {            //solo un registro encontrado                
				redirect("/matriculacion/ModificaMatricula/".$registros->row()->CodMatricula, 'refresh');
            } else {                                             // varios registros encontrados: muestra lista
                //genera tabla
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del estudiante', 'Carrera', 'Gesti&oacute;n', '# matr.', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="tablaseleccion">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->NombreCompleto, $registro->NombreCarrera, $registro->Gestion, $registro->Matricula,
                            anchor("matricula/CargaVista/$registro->CodMatricula", ' Seleccionar ', 
                                  array('class'=>'vista')));
                $data['Tabla'] = $this->table->generate();
                $data['VistaPrincipal'] = 'vista_lista_matriculas';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaPrincipal'] = 'vista_busca_matricula';
            $this->load->view('vista_maestra', $data);
        }
    }
    
    function BuscaParaEliminar() {
        $this->funciones->VerificaSesion();
        
        $data['VistaMenu'] = $this->Menu;
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim|min_length[3]');
        if ($this->form_validation->run()) {
            $registros = $this->modelo_matricula->BuscaMatricula($this->input->post('Apellido'), $this->input->post('CI'), 
                                                                 $this->input->post('RegUniversitario'));
            if ($registros->num_rows() == 0) {
                $data['Mensaje'] = 'No se encontraron registros que cumplan el criterio de b&uacute;squeda';
                $data['VistaPrincipal'] = 'vista_mensaje';            
                $this->load->view('vista_maestra', $data);
            } else if ($registros->num_rows() == 1) {            //solo un registro encontrado                
				$data['CodMatricula'] = $registros->row()->CodMatricula;
                $data['NombreEstudiante'] = $registros->row()->NombreCompleto;
				$data['NombreCarrera'] = $registros->row()->NombreCarrera;
				$data['Matricula'] = $registros->row()->Matricula;
                $data['Gestion'] = $registros->row()->Gestion;
				$data['VistaPrincipal'] = 'vista_elimina_matricula';
                $this->load->view('vista_maestra', $data);
            } else {                                             // varios registros encontrados: muestra lista
                //genera tabla
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del estudiante', 'Carrera', 'Gesti&oacute;n', '# matr.', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="tablaseleccion">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->NombreCompleto, $registro->NombreCarrera, $registro->Gestion, $registro->Matricula,
                            anchor("matricula/CargaVista/$registro->CodMatricula", ' Seleccionar ', 
                                  array('class'=>'vista')));
                $data['Tabla'] = $this->table->generate();
                $data['VistaPrincipal'] = 'vista_lista_matriculas';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaPrincipal'] = 'vista_busca_matricula';
            $this->load->view('vista_maestra', $data);
        }
    }
    
    function EliminarMatricula() {
		$this->form_validation->set_rules('CodMatricula', '"CodMatricula"', 'required');
        $data['VistaMenu'] = $this->Menu;
		if ($this->form_validation->run()) {
			$CodMatricula = $this->input->post('CodMatricula');
			$Accion = $this->input->post("submit");
			if ($Accion == "borrar") {
				$this->modelo_matricula->Delete($CodMatricula);
                $data['Mensaje'] = 'El registro ha sido eliminado de la base de datos.';
				$data['VistaPrincipal'] = 'vista_mensaje';            
			}
            if ($Accion == "anular") {
				$this->modelo_matricula->Anulacion($CodMatricula);
                $data['Mensaje'] = 'El registro ha sido marcado como <strong>anulado</strong>.';
				$data['VistaPrincipal'] = 'vista_mensaje';            
			}
            else
                $data['VistaPrincipal'] = 'vista_nula';
		}
		else 
            $data['VistaPrincipal'] = 'vista_elimina_matricula';
            
        $this->load->view('vista_maestra', $data);
    }
	
	function ImprimeMatricula($CodMatricula) {
        $this->form_validation->set_rules('CodMatricula', '"CodMatricula"', 'required');
        $data['VistaMenu'] = $this->Menu;
		if ($this->form_validation->run()) {
			$CodMatricula = $this->input->post('CodMatricula');
			$Accion = $this->input->post("submit");
			if ($Accion == "imprimir") {
				// *** impresion ***
				$data['VistaPrincipal'] = 'vista_nula';            
			}
            else
                $data['VistaPrincipal'] = 'vista_nula';
		}
		else 
            $data['VistaPrincipal'] = 'vista_elimina_matricula';
            
        $this->load->view('vista_maestra', $data);
    }
    
    //*********+ funciones callback
    function MatriculaValida($mat) {
		//verificacion de cupo del usuario y en la gestion
		$r = False;
		if( ! $this->modelo_matricula->DentroDelCupo($mat) ) 
			$this->form_validation->set_message('MatriculaValida', 'Fuera de cupo asignado.');
		else if( $this->modelo_matricula->MatriculaExistente($mat) ) 
			$this->form_validation->set_message('MatriculaValida', 'Matr&iacute;cula ya registrada.');
		else
			$r = True;
			
		return $r;
	}
	
	function RegUniversitarioValido($RegU, $Anexo) {
		$CodPersona = $this->input->post("CodPersona");
		
		//si es primera matriculacion simplemente no debe repetirse
		$Nuevo = $this->modelo_matricula->EsEstudianteNuevo($CodPersona);
		
		if( $Nuevo && $this->modelo_estudiante->RegUniversitarioExistente($RegU, $Anexo) ) {
			$this->form_validation->set_message('RegUniversitarioValido', "Reg. universitario ya existe.");
			return false;
		} //si es antiguo reg.univ. no debe repetirse para otra persona
		else if( ! $Nuevo && $this->modelo_estudiante->RegUniversitarioUnico($RegU, $Anexo, $CodPersona) ) {
			$this->form_validation->set_message('RegUniversitarioValido', "Reg. universitario ya existe.");
			return false;
		}
			return true;
	}
    
}

?>