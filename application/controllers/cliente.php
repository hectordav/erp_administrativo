<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index()
	{
		redirect('cliente/cargar_grilla');
	}
	public function cargar_grilla()
	{
		try {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_cliente');
				$crud->set_subject('Cliente');
				$crud->set_language('spanish');
				$crud->display_as('ruf','RUT');
				$crud->display_as('nombre','Nombre');
				$crud->display_as('direccion','Direccion');
				$crud->display_as('telf','Telefono');
				$crud->display_as('correo','Email');
				$crud->callback_add_field('correo',array($this,'input_correo_add'));
				$crud->callback_edit_field('correo',array($this,'input_correo_edit'));
				$crud->columns('ruf','nombre','direccion','telf','correo');
				$crud->required_fields('ruf','nombre','direccion','telf','correo');
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
	//*******************************************************************************
	function input_correo_add()
	{
	return ' <input  name="correo" type="email" class="form-control">';
	}
	function input_correo_edit($value, $primary_key)
	{
	return ' <input  name="correo" type="email" class="form-control"value="'.$value.'">';
	}

}
