<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Dashboard extends CI_Controller {

    private $Menu;
    
    function Index() {
        
        $data['VistaPrincipal'] = 'impresion/vista_dashboard';
        $this->load->view('vista_maestra', $data);
    }
    function Buscar()
    {
        $result=$this->modelo_formulario->ListadoEstudiantesPorGestion($_POST['gestion']);
        $c=0;
        $data=array();
        $carreras=array();
        $valores=array();
        foreach ($result->result() as $registro)
        {
            $carreras[$c]=$registro->Nombre;
            $valores[$c]=floatval($registro->numero);
            
            $c++;
        }
        array_push($data, $carreras);
        array_push($data, $valores);
        echo json_encode($data);
    }
    
    function Buscar2()
    {
        $result=$this->modelo_formulario->ListadoEstudiantesPorGestion($_POST['gestion']);
        $c=0;
        $data="";
        //$carreras=array();
        //$valores=array();
        foreach ($result->result() as $registro)
        {
            
            $data.='["'.$registro->Nombre.'",'.floatval($registro->numero).'],';
            $c++;
        }
        $data=substr($data,0,-1);
        $data.="";
        echo $data;
    }
    
    
    
}
?>
