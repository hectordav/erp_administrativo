<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index()
	{
		redirect('usuario/cargar_grilla');
	}
	public function cargar_grilla()
	{
		try {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_usuario');
				$crud->set_subject('Usuario');
				$crud->set_language('spanish');
				$crud->set_relation('id_nivel','t_nivel','descripcion');
				$crud->display_as('id_nivel','Nivel');
				$crud->display_as('nombre','Usuario');
				$crud->display_as('login','Login');
				$crud->display_as('clave','Password');
				$crud->callback_add_field('clave',array($this,'input_clave_add'));
				$crud->callback_edit_field('clave',array($this,'input_clave_edit'));
				$crud->columns('id_nivel','nombre','login');
				$crud->required_fields('id_nivel','nombre','login','clave');
				$crud->callback_insert(array($this,'encripta_password_insert'));
				$crud->callback_update(array($this,'encripta_password_update'));
				$output = $crud->render();
				//las vistas
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('usuario/usuario',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {

		}
	}
	//**********************encripta la clave en add y update********************************

	function encripta_password_insert($post_array)
	 {
			$this->load->library('encrypt');
			$post_array['clave'] =md5($post_array['clave']);
			return $this->db->insert('t_usuario',$post_array);
	}
	function encripta_password_update($post_array, $primary_key)
	{
		    $this->load->library('encrypt');
		    if(!empty($post_array['password']))
		    {
		     	$post_array['clave'] =md5($post_array['clave']);
		    }
		    else
		    {
		    	$post_array['clave'] =md5($post_array['clave']);
		        //unset($post_array['password']);
		    }
			return $this->db->update('t_usuario',$post_array,array('ID' => $primary_key));
	}

	//*******************************************************************************
	function input_clave_add()
	{
	return ' <input  name="clave" type="password" class="form-control">';
	}
	function input_clave_edit($value, $primary_key)
	{
	return ' <input  name="clave" type="password" class="form-control"value="'.$value.'">';
	}

}
