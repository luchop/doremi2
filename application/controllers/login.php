<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Login extends CI_Controller {

    private $Menu;
    
    function __construct() {
        parent::__construct();
    }

    function Index() {
        $data['VistaPrincipal'] = 'vista_login';
		$this->load->view('vista_maestra', $data);
    }

    function Verifica() {
        if ($this->input->post('NombreUsuario')) {
            $usuario = $this->input->post('NombreUsuario');
            $contrasena = $this->input->post('Clave');

            $this->load->model('Modelo_login');
            if ($this->Modelo_login->Login($usuario, $contrasena)) {
                $Fila=$this->Modelo_login->LoginDatos($usuario, $contrasena);
                $datasession = array(
                    'Autenticado' => TRUE,
                    'Llave'=>$Fila->Llave,
					'CodUsuario'=>$Fila->CodUsuario,
					'TipoUsuario'=>$Fila->CodPerfil,
                    'Gestion'=>$this->modelo_valores->GetNumero('GESTION'),
                    'NombreUsuario'=>$this->modelo_persona->GetNombre($Fila->CodPersona)
                );
                $this->session->set_userdata($datasession);
				$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
                $data['VistaMenu'] = $this->Menu;
				$data['VistaPrincipal'] = 'vista_nula';
				$this->load->view('vista_maestra', $data);
            } else {
                $this->session->set_flashdata('error', 'El usuario o contraseña son incorrectos.');				
                $data['VistaPrincipal'] = 'vista_login';
                $this->load->view('vista_maestra', $data);
            }
        } else {
            $data['VistaPrincipal'] = 'vista_login';
            $this->load->view('vista_maestra', $data);
        }
    }

    function Logout() {
        $this->session->unset_userdata('Autenticado');
        $this->session->unset_userdata('Llave');
        $this->session->unset_userdata('CodUsuario');
		$this->session->unset_userdata('TipoUsuario');
        $this->session->unset_userdata('Gestion');
        $this->session->unset_userdata('NombreUsuario');
        //session_destroy();
        $data['VistaPrincipal'] = 'vista_login';
		$this->load->view('vista_maestra', $data);
    }
}

?>
