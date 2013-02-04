<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct()
    {
        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Valid Date (ISO format)
     *
     * @access    public
     * @param    string
     * @return    bool
     */
    function valid_date($str) {
		$CI =& get_instance();
		$CI->form_validation->set_message('valid_date', 'Fecha incorrecta.');

		//if( preg_match('@([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})@', $str)) {
		//if (preg_match("@^[0-9]{2}/[0-9]{2}/[0-9]{4}$@", $str)) {
		if( preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $str) ) {
			$arr = explode("/", $str);
			$dd = $arr[0];
			$mm = $arr[1];
			$yyyy = $arr[2];
			if (is_numeric($yyyy) && is_numeric($mm) && is_numeric($dd)) 
				return checkdate($mm, $dd, $yyyy);
			else 
				return false;
		} else 
			return false;
	} 
}
?>