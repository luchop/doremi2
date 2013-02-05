<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Auditoria extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function Index() {
        $data['VistaMenu'] = 'vista_menu';
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
    
    function Busqueda() {
        $data['VistaMenu'] = 'vista_menu';
        $data['VistaPrincipal'] = 'vista_auditoria';
        $this->load->view('vista_maestra', $data);
    }
}
?>