<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Listados extends CI_Controller {

    private $Menu;
	
	function __construct() {
        parent::__construct();
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$this->load->library('fpdf');
		$this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
    }

    function Index() {
        $this->funciones->VerificaSesion();
		
		$data['TituloPagina'] = 'Reporte';
        $data['Titulo'] = 'Reporte';            
        $data['VistaPrincipal'] = 'vista_consulta_reporte';		
		$data['ListaEstados']=$this->modelo_estado->ComboEstado(set_value('Estado'));
        $this->load->view('vista_maestra', $data);
    }
	
	function ExportaListaCarrera2(){
		$data['CodCarrera'] = $this->input->post('CodCarrera');
		$data['Carrera'] = $this->modelo_carrera->GetCarrera($this->input->post('CodCarrera'));
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Delimitador'] = $this->modelo_valores->GetTexto('DELIMITADOR');
		$data['Tabla'] = $this->modelo_matricula->TablaMatriculados($data['CodCarrera'], $data['Gestion']);
        
		$this->load->view('impresion/vista_exporta_lista_carrera', $data);
	}
	
	function ExportaListaCarrera(){
		$this->funciones->VerificaSesion();
        
		$this->form_validation->set_rules('CodCarrera', 'carrera', 'required|xss_clean');
		$data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasAdmitidas($this->session->userdata('CodUsuario'), True);
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['VistaMenu'] = $this->Menu;
        $data['VistaPrincipal'] = 'impresion/vista_config_exporta_carrera';
		if( $this->form_validation->run() )
			$this->ExportaListaCarrera2();
        else
            $this->load->view('vista_maestra', $data);
	}
	
	function ListaPorCarrera2(){
		$data['CodCarrera'] = $this->input->post('CodCarrera');
		$data['Carrera'] = $this->modelo_carrera->GetCarrera($this->input->post('CodCarrera'));
		$data['Gestion'] = $this->input->post('Gestion');
		$data['CI'] = $this->input->post('CI');
		$data['RegUniversitario'] = $this->input->post('RegUniversitario');
		$data['Tabla'] = $this->modelo_matricula->TablaMatriculados($data['CodCarrera'], $data['Gestion']);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_lista_carrera_pdf', $data);
	}
	
	function ListaPorCarrera1(){
		$this->funciones->VerificaSesion();
		
		$this->form_validation->set_rules('CodCarrera', 'carrera', 'xss_clean');
		$data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasAdmitidas($this->session->userdata('CodUsuario'), True);
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['CI'] = true;
		$data['RegUniversitario'] = true;
		$data['VistaMenu'] = $this->Menu;
        $data['VistaPrincipal'] = 'impresion/vista_config_lista_carrera';
		if( $this->form_validation->run() )
				$this->ListaPorCarrera2();
        $this->load->view('vista_maestra', $data);
	}
	
	function EstadisticaEstadoCivil2(){
		//0 : Soltero(a)	1 : Casado(a)	2 : Conviviente		3 : Divorciado(a)	4 : Viudo(a)
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Varones'] = $this->input->post('Varones');
		$data['Mujeres'] = $this->input->post('Mujeres');
		
		$TipoReporte = ($data['Mujeres'])?'F':'';
		$TipoReporte = ($data['Varones'])?'M':$TipoReporte;
		$TipoReporte = ($data['Mujeres']&&$data['Varones'])?'FM':$TipoReporte;

		$ArrayTiposReportes=array('F'=>'Mujeres','M'=>'Varones','FM'=>'Varones y mujeres');
		$data['Reporte'] = $ArrayTiposReportes[$TipoReporte];
		$data['Tabla'] = $this->modelo_matricula->TablaEstadosCiviles($data['Gestion'],$TipoReporte);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_estado_civil_pdf', $data);
	}
	
	function EstadisticaEstadoCivil(){
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['Varones'] = true;
		$data['Mujeres'] = true;
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('Gestion', 'Gestion', 'required|xss_clean');
		if( $this->form_validation->run() ){
				$this->EstadisticaEstadoCivil2();
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_estado_civil';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	function ListaPorTipoColegio2(){
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Varones'] = $this->input->post('Varones');
		$data['Mujeres'] = $this->input->post('Mujeres');
		$TipoReporte = ($data['Mujeres'])?'F':'';
		$TipoReporte = ($data['Varones'])?'M':$TipoReporte;
		$TipoReporte = ($data['Mujeres']&&$data['Varones'])?'FM':$TipoReporte;
		$ArrayTiposReportes=array('F'=>'Mujeres','M'=>'Varones','FM'=>'Varones y mujeres');
		$data['Reporte'] = $ArrayTiposReportes[$TipoReporte];
		$data['Tabla'] = $this->modelo_matricula->TablaTipoColegio($data['Gestion'],$TipoReporte);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_lista_tipo_colegio_pdf', $data);
	}
	
	function ListaPorTipoColegio(){
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['Varones'] = true;
		$data['Mujeres'] = true;
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('Gestion', 'Gestion', 'required|xss_clean');
		if( $this->form_validation->run() ){
				$this->ListaPorTipoColegio2();
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_lista_tipo_colegio';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	function ListaPorUniversidadTitulo2(){
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Varones'] = $this->input->post('Varones');
		$data['Mujeres'] = $this->input->post('Mujeres');
		$TipoReporte = ($data['Mujeres'])?'F':'';
		$TipoReporte = ($data['Varones'])?'M':$TipoReporte;
		$TipoReporte = ($data['Mujeres']&&$data['Varones'])?'FM':$TipoReporte;
		$ArrayTiposReportes=array('F'=>'Mujeres','M'=>'Varones','FM'=>'Varones y mujeres');
		$data['Reporte'] = $ArrayTiposReportes[$TipoReporte];
		$data['Tabla'] = $this->modelo_matricula->TablaUniversidadTitulo($data['Gestion'],$TipoReporte);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_lista_universidad_titulo_pdf', $data);
		//UPEA UMSA UTO UTF USXX USFX UMSS UAGRM UAP UJMS UTB SEDUCA
	}
	
	function ListaPorUniversidadTitulo(){
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['Varones'] = true;
		$data['Mujeres'] = true;
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('Gestion', 'Gestion', 'required|xss_clean');
		if( $this->form_validation->run() ){
				$this->ListaPorUniversidadTitulo2();
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_lista_universidad_titulo';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	function ListaMatriculas2(){
		$data['CodCarrera'] = $this->input->post('CodCarrera');
		//$data['Carrera'] = $this->modelo_carrera->GetCarrera($this->input->post('CodCarrera'));
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Tabla'] = $this->modelo_matricula->TablaMatriculados($data['CodCarrera'], $data['Gestion']);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_lista_matricula_pdf', $data);
	}
	
	function ListaMatriculas(){
		$data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasAdmitidas($this->session->userdata('CodUsuario'), True);
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['CI'] = true;
		$data['RegUniversitario'] = true;
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('Gestion', 'Gestion', 'required|xss_clean');
		if( $this->form_validation->run() ){
			$this->ListaMatriculas2();
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_lista_matricula';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	function EstadisticaPorCarreraGenero2(){
		$data['Gestion'] = $this->input->post('Gestion');
		$data['Tabla'] = $this->modelo_matricula->TablaCarreraGenero($data['Gestion']);
		$this->output->set_header('Content: application/pdf');
		$this->load->view('impresion/vista_lista_carrera_genero_pdf', $data);
	}
	
	function EstadisticaPorCarreraGenero(){
		$data['ComboGestion'] = ComboGestion($this->modelo_valores->GetNumero('GESTION'));
		$data['VistaMenu'] = $this->Menu;
		$this->form_validation->set_rules('Gestion', 'Gestion', 'required|xss_clean');
		if( $this->form_validation->run() ){
			$this->EstadisticaPorCarreraGenero2();
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_lista_carrera_genero';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	function ImprimeMatricula($CodPersona, $CodCarrera, $Gestion){
		$data['VistaMenu'] = $this->Menu;
		$data["css"]='
		<link rel="stylesheet" href="'.base_url().'js/jqueryUI/css/south-street/jquery-ui-1.8.16.custom.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'css/style_calibra.css" type="text/css" />';
		$data["javascript"]='<script type="text/javascript" src="'.base_url().'js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="'.base_url().'js/jqueryUI/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="'.base_url().'js/functions.js"></script>';
		
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
		
		$this->form_validation->set_rules('hs', 'hs', 'required');
		$this->form_validation->set_rules('vs', 'vs', 'required');
		$this->form_validation->set_rules('ms', 'ms', 'required');
		if( $this->form_validation->run() ){
			$this->ImprimeMatricula2($CodPersona, $CodCarrera, $Gestion);
		} else {
			$data['VistaPrincipal'] = 'impresion/vista_config_matricula';
			$this->load->view('vista_maestra', $data);
		}
	}
	
	public function ImprimeMatricula2($CodPersona, $CodCarrera, $Gestion) {
		$data["css"]='
		<link rel="stylesheet" href="'.base_url().'js/jqueryUI/css/south-street/jquery-ui-1.8.16.custom.css" type="text/css" />
		<link rel="stylesheet" href="'.base_url().'css/style_print.css" type="text/css" />';
		$data["javascript"]='<script type="text/javascript" src="'.base_url().'js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="'.base_url().'js/jqueryUI/js/jquery-ui-1.8.16.custom.min.js"></script>';

		$arrayVars=array('{Apellidos y Nombres}','{Carnet}','{Reg. univ.}','{Carrera}','{Domicilio}','{Fecha}','{Categoria}','{Numero}');
        $row = $this->modelo_matricula->GetDatosMatriculacion($CodPersona, $CodCarrera, $Gestion);
        $arrayDatos=array($row->NombreCompleto, $row->CI, $row->RegUniversitario, $row->NombreCarrera, $row->Domicilio, $row->Fecha, $row->Categoria, '');
		$data["anverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('anverso'));
		$data["reverso"]=str_replace($arrayVars,$arrayDatos,$this->session->userdata('reverso'));
		$data["espacios"]=$this->session->userdata('espacios');
		//$data['VistaPrincipal'] = 'impresion/vista_imprime_matricula';
		//$this->load->view('vista_maestra',$data);
		$this->load->view('impresion/vista_imprime_matricula',$data);
	}
	
	public function ajax($opcion='') {
		if ($opcion=="exportar"){
			header("Content-Type: application/force-download"); 
			header('Content-Description: File Transfer');
			header('Content-Disposition: attachment; filename="pagina.def"');
			print serialize(array('anverso'=>base64_encode($this->session->userdata('anverso')),'reverso'=>base64_encode($this->session->userdata('reverso')),'espacios'=>$this->session->userdata('espacios')));
		} elseif ($this->input->post('anverso') && $this->input->post('reverso')){
			$this->session->set_userdata('anverso', $this->input->post('anverso'));
			$this->session->set_userdata('reverso', $this->input->post('reverso'));
			$this->session->set_userdata('espacios', array('hs'=>$this->input->post("hs"),'vs'=>$this->input->post("vs"),'ms'=>$this->input->post("ms")));
		} elseif ($this->input->post('reset')){
			$this->session->unset_userdata('anverso');
			$this->session->unset_userdata('reverso');
			$this->session->unset_userdata('espacios');
		}
		exit;
	}
}
?>