<?php
if ( ! defined('BASEPATH')) exit('No se permite acceso directo.');

class Administrador extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    function _example_output($output = null) {
        $this->load->view('vista_administrador.php', $output);
    }

    function index() {
        $this->_example_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    function Carrera() {
        $crud = new grocery_CRUD();
        $crud->set_table('carrera');
        $crud->set_subject('Carrera');
        $crud->required_fields('Nombre');
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }

    function Pais() {
        $crud = new grocery_CRUD();
        $crud->set_table('pais');
        $crud->set_subject('Pais');
        $crud->required_fields('Nombre');
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }
    
     function Banco() {
        $crud = new grocery_CRUD();
        $crud->set_table('banco');
        $crud->set_subject('Banco');
        $crud->required_fields('Nombre','Cuenta','Activo');
        $crud->field_type('Activo','true_false');
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }
    
     function GradoAcademico() {
        $crud = new grocery_CRUD();
        $crud->set_table('grado_academico');
        $crud->set_subject('Grado Academico');
        $crud->required_fields('Nombre','NombreCorto','Precedencia','TipoGrado');
        $crud->display_as('NombreCorto', 'Nombre Corto')
             ->display_as('TipoGrado', 'Tipo de Grado');
        $procedencia=array('1','2','3','4','5','6','7','8');
        $tipoGrado=array('GRA','POS');
        $crud->field_type('Precedencia','enum',$procedencia)
             ->field_type('TipoGrado','enum',$tipoGrado);
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }
    
    function Idioma() {
        $crud = new grocery_CRUD();
        $crud->set_table('idioma');
        $crud->set_subject('Idioma');
        $crud->required_fields('Nombre','TipoIdioma');
        $crud->display_as('TipoIdioma', 'Tipo de Idioma');
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }
    
    function Universidad() {
        $crud = new grocery_CRUD();
        $crud->set_table('universidad');
        $crud->set_subject('Universidad');
        $crud->required_fields('Nombre');
        $crud->unset_delete();
        $output = $crud->render();
        $this->_example_output($output);
    }

}