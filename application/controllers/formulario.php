<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Formulario extends CI_Controller {

    private $Menu;
	
	function __construct() {
        parent::__construct();
		
        $this->Menu = ObtieneVista($this->session->userdata('TipoUsuario'));
    }

    function Index() {
        $TodaCarrera=False;
        $data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasHabilitadas(0, "CodCarrera", True, $TodaCarrera);
        $data['VistaPrincipal'] = 'vista_busca_formulario';
        $this->load->view('vista_maestra', $data);
    }

    function InicializaVariables($TodaCarrera=False) {
        $data['ComboZona'] = $this->modelo_formulario->ComboZona("CodZona", "");
        $data['ComboUniversidades'] = $this->modelo_formulario->ComboUniversidades("CodUniversidad", "");
        $data['ComboDepartamentos'] = ComboDepartamentos("Expedido", "");
        $data['ComboVivienda'] = ComboTipoVivienda("Vivienda", "");
        $data['ComboCaracteristicasVivienda'] = ComboCaracteristicasVivienda("Caracteristicas", "");
        $data['ComboComoTrabaja'] = ComboComoTrabaja("Trabajo", "");
        $data['ComboJornada'] = ComboJornada("Jornada", "");
        $data['ComboTipoColegio'] = ComboTipoColegio("TipoColegio", "");
        $data['ComboPaisesNacimiento'] = $this->modelo_formulario->ComboPais("PaisNacimiento", "11");
        $data['ComboPaisesColegio'] = $this->modelo_formulario->ComboPais("PaisColegio", "11");
        $data['EstadoCivil'] = ComboEstadoCivil("EstadoCivil", "0");
        $data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasHabilitadas($this->session->userdata('Carrera'), "CodCarrera", True, $TodaCarrera);
        $data['ComboSubsede'] = $this->modelo_formulario->ComboCarreraSubsedes("CodSubsede","" ,$this->session->userdata('Carrera'));
        $data['Modo'] = "Nuevo";
        return $data;
    }
    
    function Nuevo() {
        $data = $this->InicializaVariables(False);
        $data['Proveniente'] = "Estudiante";
		$data['VistaPrincipal'] = 'vista_formulario01_simple';
		$this->load->view('vista_maestra', $data);
    }
	
    function NuevoEstudiante() {
        $data = $this->InicializaVariables(True);
        $data['Proveniente'] = "Operario";
		$data['VistaMenu'] = $this->Menu;
		$data['VistaPrincipal'] = 'vista_formulario01';
		$this->load->view('vista_maestra', $data);
    }


    function Editar($CodPersona, $Matriculacion) {
        $Fila = $this->modelo_formulario->GetXId($CodPersona);
        $data['Fila'] = $Fila;
        $data['ComboZona'] = $this->modelo_formulario->ComboZona("CodZona", $Fila->CodZona);
        $data['ComboUniversidades'] = $this->modelo_formulario->ComboUniversidades("CodUniversidad", $Fila->CodUniversidad);
        $data['ComboDepartamentos'] = ComboDepartamentos("Expedido", $Fila->Expedido);
        $data['ComboVivienda'] = ComboTipoVivienda("Vivienda", $Fila->Vivienda);
        $data['ComboCaracteristicasVivienda'] = ComboCaracteristicasVivienda("Caracteristicas", $Fila->Caracteristicas);
        $data['ComboComoTrabaja'] = ComboComoTrabaja("Trabajo", $Fila->Trabajo);
        $data['ComboJornada'] = ComboJornada("Jornada", $Fila->Jornada);
        $data['ComboTipoColegio'] = ComboTipoColegio("TipoColegio", $Fila->TipoColegio);
        $data['ComboPaisesNacimiento'] = $this->modelo_formulario->ComboPais("PaisNacimiento", $Fila->PaisNacimiento);
        $data['ComboPaisesColegio'] = $this->modelo_formulario->ComboPais("PaisColegio", $Fila->PaisTitulo);
        $data['EstadoCivil'] = ComboEstadoCivil("EstadoCivil", $Fila->EstadoCivil);
        $data['FechaNac2']=FechaParaMySQL($Fila->FechaNac) ;
        //$data['ComboCarrera'] = $this->modelo_formulario->ComboCarrera("CodCarrera", $Fila->CodCarrera);
        $data['ComboCarrera']=$this->modelo_carrera->ComboCarrerasHabilitadas($Fila->CodCarrera,'CodCarrera',False,True);
        $data['ComboSubsede'] = $this->modelo_formulario->ComboCarreraSubsedes("CodSubsede",$Fila->CodSubsede ,$Fila->CodCarrera);
        $data['Modo'] = ($Matriculacion==0?"Editar":"Matricular");
        $data['Categoria'] = $this->modelo_estudiante->ObtieneCategoria($CodPersona);
        $data['Matriculacion'] = $Matriculacion;
        $data['VistaMenu'] = $this->Menu;
        $data['VistaPrincipal'] = 'vista_editar_formulario01';
		$this->load->view('vista_maestra', $data);
    }

    function Busqueda() {
        $datasession = array(
            'Carnet' => "",
            'Modo' => "",
            'Nombres' => "",
            'Paterno' => "",
            'Materno' => "",
            'CodPersona' => "",
            'Carrera' => "",
        );

        $this->session->set_userdata($datasession);
        $this->form_validation->set_rules('Paterno', '"apellido paterno"', 'trim');
        $this->form_validation->set_rules('Materno', '"apellido materno"', 'trim');
        $this->form_validation->set_rules('Nombres', '"nombres"', 'trim');
        $this->form_validation->set_rules('Carnet', '"carnet"', 'trim');
        if ($this->form_validation->run()) {
            if ($this->modelo_formulario->VerificaCI($this->input->post('Carnet')) && !$this->modelo_formulario->VerificaNombreEstudiante($this->input->post('Paterno'), $this->input->post('Materno'), $this->input->post('Nombres'))) {
                $data['Mensaje'] = 'Este n&uacute;mero de documento de identidad ya est&aacute; registrado. Pase por la oficina de Registros y Admisiones, por favor.';
                $data['VistaPrincipal'] = 'vista_mensaje';
                $this->load->view('vista_maestra', $data);
            } else if ($this->modelo_formulario->VerificaCI($this->input->post('Carnet'))) {
                $Fila = $this->modelo_formulario->VerificaCI($this->input->post('Carnet'));
                if ($this->modelo_formulario->VerificaEstudianteMatriculado($Fila->CodPersona)) {
                    $data['Mensaje'] = 'Los estudiantes antiguos s&oacute;lo deben pasar por la oficina de Registro y Admisiones.';
                    $data['VistaPrincipal'] = 'vista_mensaje';
                    $this->load->view('vista_maestra', $data);
                } else {
                    $data['Mensaje'] = 'Usted ya est&aacute; registrado. Pase por la oficina de Registro y Admisiones.';
                    $data['VistaPrincipal'] = 'vista_mensaje';
                    $this->load->view('vista_maestra', $data);
                }
            } else {
                $datasession = array(
                    'Carnet' => $this->input->post('Carnet'),
                    'Nombres' => $this->input->post('Nombres'),
                    'Paterno' => $this->input->post('Paterno'),
                    'Materno' => $this->input->post('Materno'),
                    'Carrera' => $this->input->post('CodCarrera'),
                    'Modo' => "Nuevo"
                );

                $this->session->set_userdata($datasession);
                $this->Nuevo();
            }
        } else {
            $data['VistaPrincipal'] = 'vista_busca_formulario';
            $this->load->view('vista_maestra', $data);
        }
    }

    function Guardar() {
        $Modo = $this->input->post('Modo');
        if ( $Modo == "Nuevo") {
            if ($this->input->post('Expedido') != "") 
                $TipoId = "C";
            else 
                $TipoId = "P";
            $CodPersona = $this->modelo_formulario->InsertPersona($this->input->post('Paterno'), $this->input->post('Materno'), 
                                                                $this->input->post('Nombres'), $this->input->post('Genero'),
                                                                FechaParaMySQL($this->input->post('FechaNac')) , $this->input->post('LugarNac'), 
                                                                $TipoId, $this->input->post('CI'), $this->input->post('Expedido'), 
                                                                $this->input->post('PaisNacimiento'), $this->input->post('EstadoCivil'), 
                                                                $this->input->post('Domicilio'), $this->input->post('Telefono'), 
                                                                $this->input->post('Celular'), $this->input->post('Correo'), 
                                                                $this->input->post('TelUrgencia'), $this->input->post('Obs'));
            $this->modelo_formulario->InsertPreuniversitario($CodPersona, $this->input->post('CodUniversidad'), $this->input->post('Colegio'), 
                                                                $this->input->post('AnioEgreso'), $this->input->post('TipoColegio'), 
                                                                $this->input->post('NumTitulo'), $this->input->post('AnioTitulo'), 
                                                                $this->input->post('Localidad'), $this->input->post('PaisColegio'),
                                                                $this->input->post('CodCarrera'),$this->input->post('CodSubsede'));
            $this->modelo_formulario->InsertSocioeconomico($CodPersona, $this->input->post('CodZona'), $this->session->userdata('Gestion'), 
                                                            $this->input->post('Vivienda'), $this->input->post('Caracteristicas'), 
                                                            $this->input->post('Trabaja'), $this->input->post('Trabajo'), $this->input->post('Jornada'));
            $data['CodPersona'] = $CodPersona;
            $datasession = array(
                'CodPersona' => $CodPersona
            );
            $this->session->set_userdata($datasession);
            
            if( $this->input->post('Proveniente')=="Estudiante" ) {
                $data['VistaPrincipal'] = 'vista_formulario01_pdf';
                $this->load->view('vista_maestra', $data);
            }    
            else 
                redirect("matriculacion/NuevaMatricula/$CodPersona", "refresh");
        }
        if ($Modo == "Editar" || $Modo=="Matricular") {
            if ($this->input->post('Expedido') != "")
                $TipoId = "C";
            else 
                $TipoId = "P";
            $CodPersona = $this->input->post('CodPersona');
            $this->modelo_formulario->UpdatePersona($CodPersona, $this->input->post('Paterno'), $this->input->post('Materno'), $this->input->post('Nombres'), 
                                                    $this->input->post('Genero'), FechaParaMySQL($this->input->post('FechaNac')), $this->input->post('LugarNac'), 
                                                    $TipoId, $this->input->post('CI'), $this->input->post('Expedido'), $this->input->post('PaisNacimiento'), 
                                                    $this->input->post('EstadoCivil'), $this->input->post('Domicilio'), $this->input->post('Telefono'), 
                                                    $this->input->post('Celular'), $this->input->post('Correo'), $this->input->post('TelUrgencia'), 
                                                    $this->input->post('Obs'));
            $this->modelo_formulario->UpdatePreuniversitario($CodPersona, $this->input->post('CodUniversidad'), $this->input->post('Colegio'), 
                                                             $this->input->post('AnioEgreso'), $this->input->post('TipoColegio'), $this->input->post('NumTitulo'), 
                                                             $this->input->post('AnioTitulo'), $this->input->post('Localidad'), $this->input->post('PaisColegio'),
                                                             $this->input->post('CodCarrera'),$this->input->post('CodSubsede'));
            $this->modelo_formulario->UpdateSocioeconomico($CodPersona, $this->input->post('CodZona'), $this->session->userdata('Gestion'), 
                                                           $this->input->post('Vivienda'), $this->input->post('Caracteristicas'), 
                                                           $this->input->post('Trabaja'), $this->input->post('Trabajo'), $this->input->post('Jornada'));
            $data['CodPersona'] = $this->input->post('CodPersona');
            $datasession = array(
                'CodPersona' => $this->input->post('CodPersona')
            );

            $this->session->set_userdata($datasession);
            if ($Modo=="Matricular") 
                redirect("matriculacion/NuevaMatricula/$CodPersona", "refresh");
            else {
                $data['VistaPrincipal'] = 'vista_formulario01_pdf';
                $this->load->view('vista_maestra', $data);
            }
        }
    }

    function ValorPais() {
        $this->load->model('modelo_formulario');
        $Fila = $this->modelo_formulario->VerificaPais();
        if ($Fila == $_POST['Pais'])
            echo "1";
        else 
            echo "0";
    }
    function VerificaCI() {
        $this->load->model('modelo_formulario');
        $Fila = $this->modelo_formulario->VerificaCI($_POST['CI']);
        if ($Fila)
            echo "1";
        else 
            echo "0";
    }
    function CargaSubsede()
    {
       $this->load->model('modelo_formulario');
       $combo= $this->modelo_formulario->ComboCarreraSubsedes("CodSubsede","" ,$_POST['CodCarrera']);
       echo $combo;
    }
    
}
?>