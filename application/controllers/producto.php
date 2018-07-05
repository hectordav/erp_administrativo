<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Producto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('tipo_model');
			$this->load->model('iva_model');
			$this->load->model('producto_model');
	}
	public function index(){
		redirect('producto/cargar_grilla');
	}
	public function cargar_grilla(){
	try {
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_producto');
		$crud->set_subject('Producto');
		$crud->set_language('spanish');
		$crud->set_relation('id_modelo','t_modelo','descripcion');
		$crud->display_as('id_modelo','Modelo');
		$crud->display_as('producto','Producto');
		$crud->display_as('precio_compra','P. Compra');
		$crud->display_as('ganancia','Ganancia');
		$crud->display_as('precio_neto','P. Neto');
		$crud->display_as('iva','Iva');
		$crud->display_as('total','P.V.P');
		$crud->columns('producto','precio_neto','iva','total');
		$crud->required_fields('producto','precio_neto','iva','total');
		$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'id_primaria'));
		$crud->unset_edit();
		$crud->unset_read();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('producto/add');
		}
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('producto/producto',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
		#***************llena el combo de la marca****************
	public function fill_marca() {
	    $id_tipo = $this->input->post('id_tipo');
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
    #***************llena el combo del modelo****************
	public function fill_modelo() {
	    $id_marca = $this->input->post('id_marca');
        if($id_marca){
            $modelo = $this->tipo_model->get_modelo_combo($id_marca);
            echo '<option value="0">Seleccione</option>';
            foreach($modelo as $fila){
                echo '<option value="'. $fila->id .'">'. $fila->descripcion.'</option>';
            }
        }  else {
           echo '<option value="0">Sin Resultados</option>';
        }
    }
    #********************************************************************************
     #***************llena el combo del producto****************
	public function fill_producto() {
	    $id_marca = $this->input->post('id_modelo');
        if($id_marca){
            $producto = $this->tipo_model->get_producto_combo($id_marca);
            echo '<option value="0">Seleccione</option>';
            foreach($producto as $fila){
                echo '<option value="'. $fila->id .'">'. $fila->producto.'</option>';
            }
        }  else {
           echo '<option value="0">Sin Resultados</option>';
        }
    }
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_producto');
		$crud->set_subject('producto');
		$output = $crud->render();
		$data = array('tipo' =>$this->tipo_model->get_tipo(),
		 'iva' =>$this->iva_model->get_iva());
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/script/script_precio_producto');
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('producto/add',$data);
		$this->load->view('../../assets/script/script_combo_producto');
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_producto(){
		try {
		$id_modelo= $this->input->post('id_modelo');
		$cod_producto = $this->input->post('txt_cod_producto');
		$producto = $this->input->post('txt_producto');
		$precio_compra = $this->input->post('txt_p_compra');
		$ganancia = $this->input->post('txt_ganancia');
		$precio_neto= $this->input->post('txt_precio_neto');
		$iva = $this->input->post('txt_iva');
		$pvp = $this->input->post('txt_pvp');
		$this->producto_model->guardar_producto($id_modelo,$cod_producto,$producto,$precio_compra,$ganancia,$precio_neto,$iva,$pvp);
		  redirect('producto/cargar_grilla');
		} catch (Exception $e) {
		}
	}
	function id_primaria($primary_key , $row)
	{
		return site_url('producto/edit').'/'.$row->id;
	}
	public function edit(){
		try {
		$id_producto = $this->uri->segment(3);
		$data = array('tipo' =>$this->tipo_model->get_tipo(),
		 'iva' =>$this->iva_model->get_iva(),
		 'producto'=>$this->producto_model->get_producto($id_producto));
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_producto');
		$crud->set_subject('Producto');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/script/script_precio_producto');
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('producto/edit',$data);
		$this->load->view('../../assets/script/script_combo_producto');
		$this->load->view('../../assets/inc/footer_common',$output);
		} catch (Exception $e) {
		}
	}
	public function actualizar_producto(){
		try {
		$id_producto = $this->input->post('txt_id_producto');
		$id_modelo= $this->input->post('id_modelo');
		$cod_producto = $this->input->post('txt_cod_producto');
		$producto = $this->input->post('txt_producto');
		$precio_compra = $this->input->post('txt_p_compra');
		$ganancia = $this->input->post('txt_ganancia');
		$precio_neto= $this->input->post('txt_precio_neto');
		$iva = $this->input->post('txt_iva');
		$pvp = $this->input->post('txt_pvp');
		$this->producto_model->actualizar_producto($id_producto,$id_modelo,$cod_producto,$producto,$precio_compra,$ganancia,$precio_neto,$iva,$pvp);
		  redirect('producto/cargar_grilla');
		} catch (Exception $e) {
		}
	}
}
