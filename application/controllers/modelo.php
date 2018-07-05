<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modelo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('tipo_model');
	}
	public function index()
	{
			redirect('modelo/grilla');
	}
	public function grilla()
	{
		try {
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_modelo');
		$crud->set_subject('Modelo');
		$crud->set_relation('id_marca','t_marca','descripcion',null,'id ASC');
		$crud->set_language('spanish');
		$crud->display_as('id_marca','Marca');
		$crud->display_as('descripcion','Modelo');
		$crud->columns('id_marca','descripcion');
		$crud->required_fields('id_marca','descripcion');
		$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'id_primaria'));
		$crud->unset_edit();
		$crud->unset_read();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('modelo/add');
		}
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('modelo/modelo',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
	#***************llena el combo de la marca****************
	public function fill_marca() {
         $id_tipo = $this->input->post('id_tipo');
         echo $idEstado;
        if($id_tipo){
            $marca = $this->tipo_model->get_marca($id_tipo);
            echo '<option value="0">Seleccione</option>';
            foreach($marca as $fila){
                echo '<option value="'. $fila->id .'">'. $fila->descripcion.'</option>';
            }
        }  else {
            echo '<option value="0">Sin Resultados</option>';
        }
    }
    #********************************************************************************
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_marca');
		$crud->set_subject('Marca');
		$output = $crud->render();
		$data_tipo['tipo']=$this->tipo_model->get_tipo();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('modelo/add',$data_tipo);
		$this->load->view('../../assets/script/script_combo');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_modelo(){
		try {
		  $id_marca = $this->input->post('id_marca');
		  $modelo= $this->input->post('txt_modelo');
		  $this->tipo_model->guardar_modelo($id_marca, $modelo);
		  redirect('modelo/add');
		} catch (Exception $e) {
		}
	}
	function id_primaria($primary_key , $row)
	{
		return site_url('modelo/edit').'/'.$row->id;
	}
	public function edit(){
		try {
		$id_modelo = $this->uri->segment(3);
		$data_modelo = array('modelo' =>$this->tipo_model->get_modelo($id_modelo),
		 'tipo'=>$this->tipo_model->get_tipo());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_marca');
		$crud->set_subject('Marca');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('modelo/edit',$data_modelo);
		$this->load->view('../../assets/script/script_combo');
		$this->load->view('../../assets/inc/footer_common',$output);
		} catch (Exception $e) {
		}
	}
	public function actualizar_modelo(){
		try {
		  $id_modelo= $this->input->post('txt_id_modelo');
		  $id_marca = $this->input->post('id_marca');
		  $modelo= $this->input->post('txt_modelo');
		  $this->tipo_model->actualizar_modelo($id_modelo,$id_marca, $modelo);
		  redirect('modelo/grilla');
		} catch (Exception $e) {
			echo $e->message;
		}
	}
}