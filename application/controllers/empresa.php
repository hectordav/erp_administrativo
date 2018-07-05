<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index(){
		redirect('empresa/cargar_grilla');
	}
	public function cargar_grilla(){
	try {
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_empresa');
		$crud->set_subject('Empresa');
		$crud->set_language('spanish');
		$crud->display_as('nombre','Nombre');
		$crud->display_as('ruf','RUT');
		$crud->display_as('direccion','Direccion');
		$crud->display_as('telf_1','Telef 1');
		$crud->display_as('telf_2','Telef 2');
		$crud->display_as('correo','Email');
		$crud->columns('nombre','ruf','direccion','telf_1','telf_2','correo');
		$crud->required_fields('nombre','ruf','direccion','telf_1','telf_2','correo');
		$crud->unset_add();
		$crud->unset_delete();
		$output = $crud->render();
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('empresa/empresa',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}catch (Exception $e) {

	}
}

}
