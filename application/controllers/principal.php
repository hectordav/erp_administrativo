<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}

	public function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_bodega');
		$crud->set_subject('Bodega');
		$crud->set_relation('id_piso','t_piso','descripcion');
		$crud->set_language('spanish');
		$crud->display_as('id_piso','Piso');
		$crud->display_as('descripcion','Bodega');
		$crud->columns('descripcion');
		$crud->required_fields('descripcion');

		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common',$output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('../../assets/inc/central');
		$this->load->view('../../assets/inc/footer_common');
	}
}