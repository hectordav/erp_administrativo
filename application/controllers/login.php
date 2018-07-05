<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
	{
	public function __construct()
	    {
	        parent::__construct();
			$this->load->helper('security');
			$this->load->library('grocery_crud');
			$this->load->model('usuario_model');
			$this->load->helper('url'); 
	    }
		public function index()
		{
			
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_usuario');
		$crud->set_subject('Producto');
		$crud->set_language('spanish');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common',$output);
		$this->load->view('login/login');
		$this->load->view('modal/modal_login');
		$this->load->view('../../assets/inc/footer_common');

		}
	 public function iniciar_sesion_post()
	 {
			if ($this->input->post()) {
				$nombre = $this->input->post('txt_login');
				$contrasena = $this->input->post('txt_pass');
				$con_md5= md5($contrasena);
				$usuario = $this->usuario_model->login($nombre, $con_md5);
		         if ($usuario) {
		            $usuario_data = array(
		               'ID' => $usuario->ID,
		               'NOMBRE' => $usuario->NOMBRE,
		               'ID_NIVEL' => $usuario->ID_NIVEL,
		               'logueado' => TRUE
		            );
		            $this->session->set_userdata($usuario_data);
		            redirect('login/logueado');
	        	 	}else{
	           		 redirect('login');
	       		  	}
		      }else{
		         $this->index();
     	 	  }
  	 }
  	   public function logueado() {
			if($this->session->userdata('logueado')){
				redirect('principal/index','refresh');

			}else{
				redirect('login/index');
			}
  		}
   	 public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
     $this->session->sess_destroy();
      redirect('login');
   }

	}

/* End of file login.php */
/* Location: ./application/controllers/login.php */

?>