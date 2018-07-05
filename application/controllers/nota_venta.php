<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nota_venta extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('nota_venta_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('iva_model');
	}
	public function index(){
		redirect('nota_venta/grilla');
	}
	public function grilla(){
	try {
	$this->nota_venta_model->eliminar_nota_venta_total_0();
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_venta');
		$crud->set_subject('Nota de Venta');
		$crud->set_relation('id_cliente','t_cliente','nombre');
		$crud->set_relation('id_usuario','t_usuario','nombre');
		$crud->set_language('spanish');
		$crud->display_as('id_cliente','Cliente');
		$crud->display_as('id_usuario','Usuario');
		$crud->display_as('num_nota','# Nota');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('observaciones','Observaciones');
		$crud->columns('num_nota','id_cliente','total','fecha','observaciones');
		$crud->unset_delete();
		$crud->unset_edit();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('nota_venta/add');
		}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_venta/nota_venta',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}catch (Exception $e) {
	}
}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_venta');
		$crud->set_subject('Nota_venta');
		$output = $crud->render();
		$data = array('cliente' =>$this->cliente_model->get_cliente());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_nota_venta',$data);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_venta/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_nota_venta(){
		try {
		$id_cliete= $this->input->post('cb_id_cliente');
		$fecha = date('Y-m-d');
		$total=0;
		$this->nota_venta_model->guardar_nota_venta($id_cliete,$fecha,$total);
		$nota_venta=$this->nota_venta_model->get_max_nota_venta();
		foreach ($nota_venta->result() as $data) {
			$id_nota_venta=$data->id;
		}
		$data = array('nota_venta'=>$this->nota_venta_model->get_nota_venta_id($id_nota_venta),'inventario_producto'=>$this->inventario_producto_model->get_inventario_producto_bodega_piso_venta(),
			'valor_iva'=>$this->iva_model->get_iva());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_venta');
		$crud->set_subject('Nota de Venta');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_venta/add_nota_venta',$data);
		$this->load->view('../../assets/inc/footer_common_add_nota_venta',$output);
		} catch (Exception $e) {
		}
	}
	public function guardar_det_nota_venta_item(){
			if($this->input->is_ajax_request()){
		$id_nota_venta= $this->input->post('txt_id_nota_venta');
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
			$cantidad_suma=$data_inventario_producto['cantidad']-$cantidad_web;
			$this->inventario_producto_model->actualizar_inventario($id_inventario_producto,$cantidad_suma);
			$datos=$this->nota_venta_model->guardar_det_nota_venta($id_nota_venta,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total);
			}
#*************************************************************************
	}
	public function mostrar_det_nota_venta(){
		if($this->input->is_ajax_request()){
		$id_nota_venta= $this->input->post('txt_id_nota_venta');
		if ($datos=$this->nota_venta_model->get_det_nota_venta($id_nota_venta))
		{
			echo json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function eliminar_det_nota_venta(){
	if ($this->input->is_ajax_request()) {
		$id_det_nota_venta = $this->input->post("id");
		$data_det_nota_venta=$this->nota_venta_model->get_det_nota_venta_id($id_det_nota_venta);

	#************************el foreach del det_compra**************************
		foreach ($data_det_nota_venta->result() as $data) {
			$data_det_nota_venta_2 = array('id_inventario' =>$data->id_inventario_producto,
				'cantidad' =>$data->cantidad
			 );
		}
		$id_inventario_producto=$data_det_nota_venta_2['id_inventario'];
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
			$cantidad_suma=$data_det_nota_venta_2['cantidad']+$data_inventario_producto['cantidad'];
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
			$this->nota_venta_model->eliminar_det_nota_venta($id_det_nota_venta);
	}
	}

	public function guardar_nota_venta(){
		$id_nota_venta = $this->input->post('txt_id_nota_venta');
		$fecha_compra=$this->input->post('dt_fecha');
		$observaciones=$this->input->post('txt_observaciones');
		$sub_total= $this->input->post('txt_sub_total');
		$iva= $this->input->post('txt_iva');
		$total= $this->input->post('txt_total');
		$this->nota_venta_model->actualizar_nota_venta($id_nota_venta,$fecha_compra,$sub_total, $iva,$total,$observaciones);
		redirect('nota_venta/grilla');
	}
	public function eliminar_toda_nota_venta(){
		if ($this->input->is_ajax_request()) {
		$id_nota_venta = $this->input->post("id");
		if ($data_nota_venta=$this->nota_venta_model->get_det_nota_venta_eliminar($id_nota_venta)) {
			foreach ($data_nota_venta->result() as $data) {
				$data_nota_venta_2 = array(
				'id' =>$data->id,
				'id_inventario' =>$data->id_inventario_producto,
				'cantidad'=>$data->cantidad
			 );$data=$this->inventario_producto_model->buscar_inventario($data_nota_venta_2['id_inventario']);
	#************************el foreach del inventario*************************
			foreach ($data->result() as $data) {
				$data_inventario_producto = array(
				'id' =>$data->id,
				'nombre_producto' =>$data->producto_nombre,
				'precio_neto' =>$data->precio_neto,
				'cantidad'=>$data->cantidad_inventario);
			}#fin foreach inventario
		$id_inventario=$data_inventario_producto['id'];
		$cantidad_suma=$data_nota_venta_2['cantidad']+$data_inventario_producto['cantidad'];
		$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
		$this->nota_venta_model->eliminar_det_nota_venta($data_nota_venta_2['id']);
#*******************************************************************************
			} #fin foreach det_factura
		$this->nota_venta_model->eliminar_nota_venta($id_nota_venta);
		}else{
		}
}

	}
}
