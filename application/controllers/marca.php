<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marca extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index()
	{
			redirect('marca/grilla');
	}
	public function grilla()
	{
		try {
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_marca');
		$crud->set_subject('Marca');
		$crud->set_relation('id_tipo','t_tipo','descripcion',null,'id ASC');
		$crud->set_language('spanish');
		$crud->display_as('id_tipo','Tipo');
		$crud->display_as('descripcion','Marca');
		$crud->columns('id_tipo','descripcion');
		$crud->required_fields('id_tipo','descripcion');
		$output = $crud->render();
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('marca/marca',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
}