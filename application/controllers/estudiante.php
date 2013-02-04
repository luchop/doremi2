<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Estudiante extends CI_Controller {

	private $Menu;
	
    function __construct() {
        parent::__construct();
		$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
    }

	function BuscaParaModificar($Modificacion) {
        $this->funciones->VerificaSesion();
        
        $data['VistaMenu'] = $this->Menu;
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim|min_length[3]');
        if ($this->form_validation->run()) {
            $registros = $this->modelo_estudiante->Busqueda($this->input->post('Apellido'), $this->input->post('CI'), 
                                                                         $this->input->post('RegUniversitario'));

            if( $Modificacion==1 )
                $Vista = 'vista_modifica_estudiante';
            else
                $Vista = 'vista_consulta_estudiante';
            
            if ($registros->num_rows() == 0) {
                $data['Mensaje'] = 'No se encontraron registros que cumplan el criterio de b&uacute;squeda';
                $data['VistaPrincipal'] = 'vista_mensaje';            
                $this->load->view('vista_maestra', $data);
            } else if ($registros->num_rows() == 1) {            //solo un registro encontrado                
				redirect("/formulario/Editar/".$registros->row()->CodPersona."/0", 'refresh');
            } else {                                             // varios registros encontrados: muestra lista
                //genera tabla
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del estudiante', 'Carrera', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="tablaseleccion">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->NombreCompleto, $registro->NombreCarrera,
                            anchor("estudiante/CargaVista/$registro->CodPersona/0", 
                                  ($Modificacion==1? ' Modificar ':' Ver '), 
                                  array('class'=>($Modificacion==1? ' actualiza':'vista'))));
                $data['Tabla'] = $this->table->generate();
                $data['VistaPrincipal'] = 'vista_lista_estudiantes';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaPrincipal'] = 'vista_busca_estudiante';
            $data['Modificacion'] = $Modificacion;
            $this->load->view('vista_maestra', $data);
        }
    }
	
	function BuscaParaEliminar() {
        $this->funciones->VerificaSesion();
        
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim|min_length[3]');
        $data['VistaMenu'] = $this->Menu;
        if ($this->form_validation->run()) {
            $registros = $this->modelo_estudiante->Busqueda($this->input->post('Apellido'), $this->input->post('CI'), $this->input->post('RegUniversitario'));

            $Vista = 'vista_elimina_estudiante';
            if ($registros->num_rows() == 0) {
                $data['Mensaje'] = 'No se encontraron registros que cumplan el criterio de b&uacute;squeda';
                $data['VistaPrincipal'] = 'vista_mensaje';            
                $this->load->view('vista_maestra', $data);
            } else if ($registros->num_rows() == 1) {            //solo un registro encontrado                
				$data['NombreEstudiante'] = $registros->row()->NombreCompleto;
				$data['NombreCarrera'] = $registros->row()->NombreCarrera;
				$data['CodPersona'] = $registros->row()->CodPersona;
				$data['VistaPrincipal'] = 'vista_elimina_estudiante';            
                $this->load->view('vista_maestra', $data);
            } else {                                             // varios registros encontrados: muestra lista
                //genera tabla
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del estudiante', 'Carrera', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="tablaseleccion">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->NombreCompleto, $registro->NombreCarrera,
                            anchor("estudiante/CargaVista/$registro->CodPersona/0", 
                                  'Eliminar', array('class'=>'elimina')));
                $data['Tabla'] = $this->table->generate();
                $data['VistaPrincipal'] = 'vista_lista_estudiantes';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaPrincipal'] = 'vista_busca_estudiante';
            $this->load->view('vista_maestra', $data);
        }
    }
    
    function RedirigeSegunCategoria($CodPersona) {
        $Categoria = $this->modelo_estudiante->ObtieneCategoria($CodPersona);
        if( $Categoria=="Antiguo" || $Categoria=="BachillerWeb")
            redirect("formulario/Editar/$CodPersona/1", 'refresh');       //param 1:matriculacion
        else
            redirect("formulario/NuevoEstudiante", 'refresh');
    }
	
	//presenta form01 y luego permite matricular
    function BuscaParaMatricular() {
        $this->funciones->VerificaSesion();
        
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim');
        if ($this->form_validation->run()) {
            $registros = $this->modelo_estudiante->BuscaEstudiante($this->input->post('Apellido'), $this->input->post('CI'));

            $data['VistaMenu'] = $this->Menu;
            if ($registros->num_rows() == 0) 
                redirect("formulario/NuevoEstudiante", 'refresh');
            else if ($registros->num_rows() == 1)             //solo un registro encontrado                
				$this->RedirigeSegunCategoria($registros->row()->CodPersona);
            else {                                             // varios registros encontrados: muestra lista
                //genera tabla de seleccion
                $this->load->library('table');
                $this->table->set_empty("&nbsp;");
                $this->table->set_heading('No.', 'Nombre del estudiante', 'Carrera', 'Acci&oacute;n');
                $aux = array('table_open' => '<table class="tablaseleccion">');
                $this->table->set_template($aux);
                $i = 0;
                foreach ($registros->result() as $registro)
                    $this->table->add_row(++$i, $registro->NombreCompleto, $registro->NombreCarrera,
                            anchor("estudiante/RedirigeSegunCategoria/$registro->CodPersona",
                                  ' Seleccionar ', array('class'=>'vista')));
                $data['Tabla'] = $this->table->generate();
                $data['VistaPrincipal'] = 'vista_lista_estudiantes';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaMenu'] = $this->Menu;
            $data['VistaPrincipal'] = 'vista_busca_ci';
            $this->load->view('vista_maestra', $data);
        }
    }
	
	function CargaVista($CodPersona, $Matriculacion=0) {
        redirect("/formulario/Editar/$CodPersona/$Matriculacion", 'refresh');
    }

    function EliminarEstudiante() {
		$this->form_validation->set_rules('CodPersona', '"CodPersona"', 'required');
        $data['VistaMenu'] = $this->Menu;
		if ($this->form_validation->run()) {
			$CodPersona = $this->input->post('CodPersona');
			$Accion = $this->input->post("submit");
			if ($Accion == "borrar") {
				$data['Mensaje'] = 'El registro ha sido eliminado de la base de datos.';
				$data['VistaPrincipal'] = 'vista_mensaje';            
				$this->load->view('vista_maestra', $data);		
			}
            else
                $data['VistaPrincipal'] = 'vista_nula';
		}
		else 
            $data['VistaPrincipal'] = 'vista_elimina_estudiante';
            
        $this->load->view('vista_maestra', $data);
    }
}
?>