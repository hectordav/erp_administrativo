<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compra extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('proveedor_model');
			$this->load->model('compra_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('iva_model');
	}
	public function index(){
		redirect('compra/grilla');
	}
	public function grilla(){
	try {
		$this->compra_model->eliminar_compra_total_0();
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_compra');
		$crud->set_subject('Compras');
		$crud->set_relation('id_proveedor','t_proveedor','nombre');
		$crud->set_relation('id_usuario','t_usuario','nombre');
		$crud->set_language('spanish');
		$crud->display_as('id_proveedor','Proveedor');
		$crud->display_as('id_usuario','Usuario');
		$crud->display_as('num_compra','# Compra');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('observaciones','Observaciones');
		$crud->columns('num_compra','id_proveedor','total','fecha','observaciones');
		$crud->unset_delete();
		$crud->unset_edit();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('compra/add');
		}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('compra/compra',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}catch (Exception $e) {
	}
}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_compra');
		$crud->set_subject('compra');
		$output = $crud->render();
		$data = array('proveedor' =>$this->proveedor_model->get_proveedor());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_compra',$data);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('compra/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_compra(){
		try {
		$id_proveedor= $this->input->post('cb_id_cliente');
		$fecha = date('Y-m-d');
		$total=0;
		$this->compra_model->guardar_compra($id_proveedor,$fecha,$total);
		$compra=$this->compra_model->get_max_compra();
		foreach ($compra->result() as $data) {
			$id_compra=$data->id;
		}
		$data = array('compra'=>$this->compra_model->get_compra_id($id_compra),'inventario_producto'=>$this->inventario_producto_model->get_inventario_producto_bodega_piso_compra(),
			'valor_iva'=>$this->iva_model->get_iva());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_compra');
		$crud->set_subject('compra');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('compra/add_compra',$data);
		$this->load->view('../../assets/inc/footer_common_add_compra',$output);
		} catch (Exception $e) {
		}
	}
	public function guardar_det_compra_item(){
			if($this->input->is_ajax_request()){
		$id_compra= $this->input->post('txt_id_compra');
		$id_inventario_producto=$this->input->post('id_producto');
		$cantidad_web= $this->input->post('txt_cantidad');
#*************************************************************************
		$data=$this->inventario_producto_model->buscar_inventario($id_inventario_producto);
			foreach ($data->result() as $data) {
			$data_inventario_producto = array('id' =>$data->id,
			'nombre_producto' =>$data->producto_nombre,
			'precio_neto' =>$data->precio_neto,
			'cantidad'=>$data->cantidad_inventario);
			}#fin foreach
			$nombre_producto=$data_inventario_producto['nombre_producto'];
			$precio_neto=$data_inventario_producto['precio_neto'];
			$total= $precio_neto*$cantidad_web;
			$cantidad_suma=$data_inventario_producto['cantidad']+$cantidad_web;
			$this->inventario_producto_model->actualizar_inventario($id_inventario_producto,$cantidad_suma);
			$datos=$this->compra_model->guardar_det_compra($id_compra,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total);
			}
#*************************************************************************
	}
	public function mostrar_det_compra(){
		if($this->input->is_ajax_request()){
		$id_compra= $this->input->post('txt_id_compra');
		if ($datos=$this->compra_model->get_det_compra($id_compra))
		{
			echo json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function eliminar_det_compra(){
	if ($this->input->is_ajax_request()) {
		$id_det_compra = $this->input->post("id");
		$data_det_compra=$this->compra_model->get_det_compra_id($id_det_compra);

	#************************el foreach del det_compra**************************
		foreach ($data_det_compra->result() as $data) {
			$data_det_compra_2 = array('id_inventario' =>$data->id_inventario_producto,
				'cantidad' =>$data->cantidad
			 );
		}
		$id_inventario_producto=$data_det_compra_2['id_inventario'];
		$data=$this->inventario_producto_model->buscar_inventario($id_inventario_producto);
	#************************el foreach del inventario*************************
			foreach ($data->result() as $data) {
			$data_inventario_producto = array('id' =>$data->id,
			'nombre_producto' =>$data->producto_nombre,
			'precio_neto' =>$data->precio_neto,
			'cantidad'=>$data->cantidad_inventario);
			}#fin foreach
	#**************************************************************************
			$id_inventario=$data_inventario_producto['id'];
			$cantidad_suma=$data_det_compra_2['cantidad']-$data_inventario_producto['cantidad'];
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
			$this->compra_model->eliminar_det_compra($id_det_compra);
	}
	}

	public function guardar_compra(){
		$id_compra = $this->input->post('txt_id_compra');
		$fecha_compra=$this->input->post('dt_fecha');
		$observaciones=$this->input->post('txt_observaciones');
		$sub_total= $this->input->post('txt_sub_total');
		$iva= $this->input->post('txt_iva');
		$total= $this->input->post('txt_total');
		$this->compra_model->actualizar_compra($id_compra,$fecha_compra,$sub_total, $iva,$total,$observaciones);
		redirect('compra/grilla');
	}
}
