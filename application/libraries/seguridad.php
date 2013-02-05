<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seguridad {
    
	protected $ci;
   
    function __construct(){
		$this->ci =& get_instance();
    }
	
    function FiltroGenerico($s) {
        $s = $this->security->xss_clean($s);
        return $this->db->escape($s);
    }
    
    function FiltroNombres($s) {
        //$s = $this->FiltroGenerico($s);
        return mb_convert_case(addslashes(trim($s)), MB_CASE_TITLE, "UTF-8");
    }
}

?>