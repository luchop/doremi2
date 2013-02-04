<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calibra extends CI_Controller {

	private $Archivo;
    
    function __construct() {
        parent::__construct();
		$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
        $this->Archivo = 'imagenes/matricula.def';
    }
    
    public function index() {
        if (!$this->session->userdata('anverso')) {
			if (file_exists($this->Archivo)){
				$content=unserialize(file_get_contents($this->Archivo));
				$this->session->set_userdata('anverso', base64_decode($content['anverso']));
				$this->session->set_userdata('reverso', base64_decode($content['reverso']));
				$this->session->set_userdata('espacios', $content['espacios']);
			}
		}
		
		$data["anverso"]=$this->session->userdata('anverso');
		$data["reverso"]=$this->session->userdata('reverso');
		$data["espacios"]=$this->session->userdata('espacios');
        $data['VistaPrincipal'] = 'vista_calibra';
        $data['URLControlador'] = base_url().'index.php/calibra/';
        $data['VistaMenu'] = $this->Menu;
        $this->load->view('vista_maestra', $data);
	}
	
	public function printpage() {
		$arrayVars=array('{Apellidos y Nombres}','{Carnet}','{Reg. universitario}','{Carrera}','{Domicilio}','{Fecha}','{Categoria}','{Numero}');
		$arrayDatos=array('Huanca Vila Ausberto','1234567 LP','12387-UIOPO','Ingenieria de sistemas','Villa Victoria Calle Pacajes #10','20 de octubre','Mi categoria','12313478979');
		$data["anverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('anverso'));
		$data["reverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('reverso'));
		$data["espacios"]=$this->session->userdata('espacios');
		$this->load->view('vista_print',$data);
	}
	
	public function ajax($opcion='') {
		$this->load->library('session');
		if ($opcion=="exportar"){
			header("Content-Type: application/force-download"); 
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="matricula.def"');
			print serialize(array('anverso'=>base64_encode($this->session->userdata('anverso')),'reverso'=>base64_encode($this->session->userdata('reverso')),'espacios'=>$this->session->userdata('espacios')));
			exit;
		} elseif ($this->input->post('anverso') && $this->input->post('reverso')){
			$this->session->set_userdata('anverso', $this->input->post('anverso'));
			$this->session->set_userdata('reverso', $this->input->post('reverso'));
			$this->session->set_userdata('espacios', array('hs'=>$this->input->post("hs"),'vs'=>$this->input->post("vs"),'ms'=>$this->input->post("ms")));
			exit;
		} elseif ($this->input->post('reset')){
			$this->session->unset_userdata('anverso');
			$this->session->unset_userdata('reverso');
			$this->session->unset_userdata('espacios');
			exit;
		}
	}
}