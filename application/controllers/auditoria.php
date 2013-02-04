<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Auditoria extends CI_Controller {

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
    
    function Listado() {
        $tabla="<table><tr><td>Fecha</td><td>Cambio</td></tr>";
        $CodPersona=0;
        if($this->auditoria->BusquedaPersona($_POST["Ci"],$_POST["Apellido"],$_POST["Registro"])) {
            $registro = $this->auditoria->BusquedaPersona($_POST["Ci"],$_POST["Apellido"],$_POST["Registro"]);
            $CodPersona=$registro->CodPersona;
        }
        
        
        $registros = $this->auditoria->GetAllXCodPersona($CodPersona);
        foreach ($registros->result() as $registro)
        {
            $tabla.="<tr>
                <td>".$registro->Fecha."</td><td>".$registro->Consulta."</td>
                </tr>";
        }
        $tabla.="</tabla>";
        echo $tabla;
    }
    
    function BuscaParaAuditoria() {
        $this->funciones->VerificaSesion();
        
        $data['VistaMenu'] = $this->Menu;
        $this->form_validation->set_rules('Apellido', '"apellido"', 'trim|min_length[3]');
        if ($this->form_validation->run()) {
            $registros = $this->modelo_estudiante->Busqueda($this->input->post('Apellido'), $this->input->post('CI'), 
                                                                         $this->input->post('RegUniversitario'));
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
            $data['VistaPrincipal'] = 'vista_auditoria';
            $this->load->view('vista_maestra', $data);
        }
    }
}
?>