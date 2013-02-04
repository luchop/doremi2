<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Habilita extends CI_Controller {

	private $Menu;
    
    function __construct() {
        parent::__construct();
        
        $this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
		$this->load->model('Modelo_habilitacion','modelo_habilitacion');
    }
	
	public function index() {
		$this->load->view('habilita_lista');
	}
	
	public function agrega() {
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('FechaInicio', '"FechaInicio"', 'trim|valid_date');
        $this->form_validation->set_rules('FechaFin', '"FechaFin"', 'trim|valid_date');
        if ($this->form_validation->run()) {
			$FechaInicio = FechaParaMySQL($this->input->post('FechaInicio'));
			$FechaFin = FechaParaMySQL($this->input->post('FechaFin'));
			$this->modelo_habilitacion->Insert($FechaInicio, $FechaFin, $this->input->post('CodCarrera'), $this->input->post('DesdeNombre'),$this->input->post('HastaNombre'));
			$data['Mensaje'] = "Se ha registrado la habilitaci&oacute;n de matriculaci&oacute;n.";
            $data['VistaPrincipal'] = 'vista_mensaje';
		} else
            $data['VistaPrincipal'] = 'vista_habilita_agrega';      
        $this->load->view('vista_maestra', $data);
	}
	
	public function edita($CodHabilitacion=0)
	{
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('FechaInicio', '"FechaInicio"', 'trim|valid_date');
		$this->form_validation->set_rules('FechaFin', '"FechaFin"', 'trim|valid_date');
        if ($this->form_validation->run()) {
			$FechaInicio = FechaParaMySQL($this->input->post('FechaInicio'));
			$FechaFin = FechaParaMySQL($this->input->post('FechaFin'));
			$this->modelo_habilitacion->Update($this->input->post('CodHabilitacion'),$FechaInicio, $FechaFin, $this->input->post('CodCarrera'), $this->input->post('DesdeNombre'),$this->input->post('HastaNombre'));
			$data['Mensaje'] = "Se ha actualizado la habilitaci&oacute;n de matr&iacute;culas.";
            $data['VistaPrincipal'] = 'vista_mensaje';
		} else {
			$Fila = $this->modelo_habilitacion->GetItem($CodHabilitacion);
			$data['Fila'] = $Fila;
            $data['VistaPrincipal'] = 'habilita_edita';
		}
        $this->load->view('vista_maestra', $data);
	}

	public function verificar($id_carrera)
	{
		$test=array('id_carrera'=>1,'inicio'=>'25/12/2012','fin'=>'25/01/2013','apellido_ini'=>'A','apellido_fin'=>'H');

		//CONSULTA SQL para ver si esta disponible la matriculacion para esa carrera
		//strtodate($fecha)
		//EL resultado se almacena en $result
		$result=$test;
		
		$this->load->view('habilita_verifica',$data);
	}
}