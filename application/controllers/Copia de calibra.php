<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Calibra extends CI_Controller {

	private $Menu;
	
	function __construct() {
        parent::__construct();
		$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
    }
    
    public function Index() {
        if (!$this->session->userdata('anverso')) {
            if (file_exists('pagina.def')){
                $content=unserialize(file_get_contents('pagina.def'));
				$this->session->set_userdata('anverso', base64_decode($content['anverso']));
				$this->session->set_userdata('reverso', base64_decode($content['reverso']));
				$this->session->set_userdata('espacios', $content['espacios']);
			}
		}

		$data["anverso"]=$this->session->userdata('anverso');
		$data["reverso"]=$this->session->userdata('reverso');
		$data["espacios"]=$this->session->userdata('espacios');

		$data['VistaMenu'] = $this->Menu;
        $data['VistaPrincipal'] = 'vista_calibra';
		$this->load->view('vista_maestra',$data);
	}
	
	public function printpage() {
		$arrayVars=array('{Apellidos y Nombres}','{Carnet}','{Reg. universitario}','{Carrera}','{Domicilio}','{Fecha}','{Categoria}','{Numero}');
		$arrayDatos=array('Nombre del universitario','Carnet','Reg.univ.','Carrera','Domicilio','Fecha','Categoria','Numero');
		$data["anverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('anverso'));
		$data["reverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('reverso'));
		$data["espacios"]=$this->session->userdata('espacios');
        
		//$data['VistaMenu'] = $this->Menu;
		//$data['VistaPrincipal'] = 'print';
        //$data['VistaPrincipal'] = 'vista_imprime_matricula';
		//$this->load->view('vista_maestra',$data);
        $this->load->view('impresion/vista_imprime_matricula',$data);
	}
	
	public function ajax($opcion='') {
        if ($opcion=="exportar"){
			header("Content-Type: application/force-download"); 
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="pagina.def"');
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