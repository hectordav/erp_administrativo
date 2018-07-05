<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iva extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index()
	{
		redirect('iva/cargar_grilla');
	}
	public function cargar_grilla()
	{
		try {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_iva');
				$crud->set_subject('Iva');
				$crud->set_language('spanish');
				$crud->display_as('iva','Iva');
				$crud->columns('iva');
				$crud->required_fields('iva');
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				//las vistas
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('cliente/cliente',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {

		}
	}
	
}
