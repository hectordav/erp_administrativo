<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bodega extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('piso_model');
	}
	public function index()
	{
			redirect('bodega/grilla');
	}
	public function grilla(){
		try {
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
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('bodega/bodega',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}

}