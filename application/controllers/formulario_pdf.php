<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Formulario_pdf extends CI_Controller {

    private $Menu;

    function __construct() {
        parent::__construct();
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $this->load->library(array('fpdf'));
    }

    function ImpresionF01($CodPersona) {
        $this->form_validation->set_rules('CodPersona', '"CodPersona"', 'trim');
        //echo $this->input->post("submit");
        if ($this->form_validation->run()) {
            $Accion = $this->input->post("submit");
            
            
            if ($Accion == "Imprimir") {
                $Fila = $this->modelo_formulario->GetXId($CodPersona);
                $data['Fila'] = $Fila;
                $data['Genero']=Genero($Fila->Genero);
                $data['EstadoCivil']=EstadoCivil($Fila->EstadoCivil);
                $data['FechaNac']=FechaDeMySQL($Fila->FechaNac);
                $data['TipoColegio']=TipoColegio($Fila->TipoColegio);
                $data['TipoVivienda']=TipoVivienda($Fila->Vivienda);
                $data['Caracteristicas']=CaracteristicasVivienda($Fila->Caracteristicas);
                $data['Trabaja']=Trabaja($Fila->Trabaja);
                $data['Trabajo']=Trabajo($Fila->Trabajo);
                $data['Jornada']=Jornada($Fila->Jornada);
                $data['Gestion'] = $this->modelo_valores->GetNumero('GESTION');
                
                if($Fila->Subsede!="")
                    $Subsede=" - ".$Fila->Subsede;
                else
                    $Subsede="";
                
                $data["Subsede"]=$Subsede;
                $this->output->set_header('Content: application/pdf');
                $this->load->view('vista_formulario_pdf', $data);
            }
            else {
                $data['ComboCarrera'] = $this->modelo_carrera->ComboCarrerasHabilitadas(0, "CodCarrera", True, False);
                $data['VistaPrincipal'] = 'vista_busca_formulario';
                $this->load->view('vista_maestra', $data);
            }
        }
    }
}

?>