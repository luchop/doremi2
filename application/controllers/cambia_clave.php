<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Cambia_clave extends CI_Controller {

    private $Menu;

    function __construct() {
        parent::__construct();

        //$TipoUsuario = $this->session->userdata('TipoUsuario');
        //	$this->Menu = ObtieneVista($TipoUsuario);
    }

    function Index() {
                $data['VistaMenu'] = 'vista_menu';
                $data['VistaPrincipal'] = 'vista_cambia_clave';
		$this->load->view('vista_maestra', $data);
    }
    
    function Guardar()
    {
        //$this->form_validation->set_rules('ClaveActual', '"contrase&ntilde;a actual"', 'required|min_length[5]|max_length[12]|xss_clean');
        //$this->form_validation->set_rules('NuevaClave1', '"nueva contrase&ntilde;a"', 'required|min_length[5]|max_length[12]|xss_clean');
        //$this->form_validation->set_rules('NuevaClave2', '"confirmaci&oacute;n de contrase&ntilde;a"', 'required|matches[NuevaClave1]|xss_clean');
        //$this->form_validation->set_error_delimiters('<li>', '</li>');


        $this->load->model('Modelo_usuario');
        //if ($this->form_validation->run()) {
            ;
        
            $CodUsuario = $this->session->userdata('CodUsuario');
            if($this->Modelo_usuario->ClaveCorrespondeUsuario($this->input->post('ClaveActual'), $CodUsuario) )
                {

                $this->Modelo_usuario->CambiaClave($CodUsuario, $this->input->post('NuevaClave1'));
                $data['Mensaje'] = 'La contrase&ntilde;a ha sido cambiada correctamente.';
                $data['VistaMenu'] = 'vista_menu';
                
                $data['VistaPrincipal'] = 'vista_mensaje';
                $this->load->view('vista_maestra', $data);
                }
            else {
                $data['VistaMenu'] = 'vista_menu';
                $data['Mensaje'] = 'Contrase&ntilde;a incorrecta';
                $data['VistaPrincipal'] = 'vista_mensaje';
                $this->load->view('vista_maestra', $data);
            }
            
            
        //} else {
          //  $data['VistaMenu'] = 'vista_menu';
           // $data['VistaPrincipal'] = 'vista_cambia_clave';
            //$this->load->view('vista_maestra', $data);
       // }
    }

}

?>