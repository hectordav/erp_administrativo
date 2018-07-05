<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Factura extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('nota_venta_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('iva_model');
			$this->load->model('factura_model');
			$this->load->model('tipo_pago_model');
	}
	public function index(){
		redirect('factura/grilla');
	}
	public function grilla(){
	try {
	$this->factura_model->eliminar_factura_total_0();
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_factura');
		$crud->set_subject('Factura');
		$crud->set_relation('id_cliente','t_cliente','nombre');
		$crud->set_relation('id_usuario','t_usuario','nombre');
		$crud->set_language('spanish');
		$crud->display_as('id_cliente','Cliente');
		$crud->display_as('id_usuario','Usuario');
		$crud->display_as('num_fact','# Factura');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('observaciones','Observaciones');
		$crud->columns('num_fact','id_cliente','total','fecha','observaciones');
		$crud->unset_delete();
		$crud->unset_edit();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('factura/add');
		}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('factura/factura',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}catch (Exception $e) {
	}
}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_factura');
		$crud->set_subject('Factura');
		$output = $crud->render();
		$data = array('cliente' =>$this->cliente_model->get_cliente());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_factura',$data);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('factura/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_factura(){
		try {
		$id_cliete= $this->input->post('cb_id_cliente');
		$fecha = date('Y-m-d');
		$total=0;
		$this->factura_model->guardar_factura($id_cliete,$fecha,$total);
		$factura=$this->factura_model->get_max_factura();
		foreach ($factura->result() as $data) {
			$id_factura=$data->id;
		}
		$data = array('factura'=>$this->factura_model->get_factura_id($id_factura),'inventario_producto'=>$this->inventario_producto_model->get_inventario_producto_bodega_piso_venta(),
			'tipo_pago'=>$this->tipo_pago_model->get_tipo_pago(),
			'valor_iva'=>$this->iva_model->get_iva());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_factura');
		$crud->set_subject('Factura');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/script/script_salir_factura');
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('factura/add_factura',$data);
		$this->load->view('modal/modal_pago_factura',$data);
		$this->load->view('../../assets/inc/footer_common_add_factura',$output);
		} catch (Exception $e) {
		}
	}
	public function guardar_det_factura_item(){
			if($this->input->is_ajax_request()){
		$id_factura= $this->input->post('txt_id_factura');
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
			$datos=$this->factura_model->guardar_det_factura($id_factura,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total);
			}
#*************************************************************************
	}
	public function mostrar_det_factura(){
		if($this->input->is_ajax_request()){
		$id_factura= $this->input->post('txt_id_factura');
		if ($datos=$this->factura_model->get_det_factura($id_factura))
		{
			echo json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function eliminar_det_factura(){
	if ($this->input->is_ajax_request()) {
		$id_det_factura = $this->input->post("id");
		$data_det_factura=$this->factura_model->get_det_factura_id($id_det_factura);
	#************************el foreach del det_factura**************************
		foreach ($data_det_factura->result() as $data) {
			$data_det_factura_2 = array('id_inventario' =>$data->id_inventario_producto,
				'cantidad' =>$data->cantidad
			 );
		}
		$id_inventario_producto=$data_det_factura_2['id_inventario'];
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
			$cantidad_suma=$data_det_factura_2['cantidad']+$data_inventario_producto['cantidad'];
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
			$this->factura_model->eliminar_det_factura($id_det_factura);
	}
	}
	public function guardar_factura(){
		$id_factura = $this->input->post('txt_id_factura');
		$fecha_compra=$this->input->post('dt_fecha');
		$observaciones=$this->input->post('txt_observaciones');
		$referencia=$this->input->post('txt_referencia');
		$sub_total= $this->input->post('txt_sub_total_2');
		$iva= $this->input->post('txt_iva_2');
		$total= $this->input->post('txt_total_2');
		$id_tipo_pago=$this->input->post('cb_id_tipo_pago');
		$this->tipo_pago_model->guardar_pago($id_factura,$id_tipo_pago,$referencia,$total,$fecha_compra);
		$this->factura_model->actualizar_factura($id_factura,$fecha_compra,$sub_total, $iva,$total,$observaciones);
		redirect('factura/grilla');
	}
	public function eliminar_toda_factura(){
		if ($this->input->is_ajax_request()) {
		$id_factura = $this->input->post("id");
		if ($data_det_factura=$this->factura_model->get_det_factura_eliminar($id_factura)) {
			foreach ($data_det_factura->result() as $data) {
				$data_det_factura_2 = array(
				'id' =>$data->id,
				'id_inventario' =>$data->id_inventario_producto,
				'cantidad'=>$data->cantidad
			 );$data=$this->inventario_producto_model->buscar_inventario($data_det_factura_2['id_inventario']);
	#************************el foreach del inventario*************************
			foreach ($data->result() as $data) {
				$data_inventario_producto = array(
				'id' =>$data->id,
				'nombre_producto' =>$data->producto_nombre,
				'precio_neto' =>$data->precio_neto,
				'cantidad'=>$data->cantidad_inventario);
			}#fin foreach inventario
		$id_inventario=$data_inventario_producto['id'];
		$cantidad_suma=$data_det_factura_2['cantidad']+$data_inventario_producto['cantidad'];
		$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
		$this->factura_model->eliminar_det_factura($data_det_factura_2['id']);
#*******************************************************************************
			} #fin foreach det_factura
		$this->factura_model->eliminar_factura($id_factura);

		}else{
		}
}

	}
}
