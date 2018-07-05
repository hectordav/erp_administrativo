<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nota_debito extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('nota_debito_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('iva_model');
			$this->load->model('factura_model');
			$this->load->model('compra_model');

	}
	public function index(){
		redirect('nota_debito/grilla');
	}
	public function grilla(){
	try {
	$this->nota_debito_model->eliminar_nota_debito_total_0();
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_debito');
		$crud->set_subject('Nota de Debito ');
		$crud->set_relation('id_cliente','t_cliente','nombre');
		$crud->set_relation('id_usuario','t_usuario','nombre');
		$crud->set_language('spanish');
		$crud->display_as('id_cliente','Cliente');
		$crud->display_as('id_usuario','Usuario');
		$crud->display_as('num_nota','# N. Debito');
		$crud->display_as('num_fact','# Factura');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('observaciones','Observaciones');
		$crud->columns('num_nota','num_fact','id_cliente','total','fecha','observaciones');
		$crud->unset_delete();
		$crud->unset_edit();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('nota_debito/add');
		}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_debito/nota_debito',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
			}catch (Exception $e) {
		}
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_debito');
		$crud->set_subject('nota de debito');
		$output = $crud->render();
		$data = array('factura' =>$this->factura_model->get_factura());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_nota_debito',$data);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_debito/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_nota_debito(){
		try {
		$id_factura= $this->input->post('cb_id_factura');
		$fecha = date('Y-m-d');
		$total=0;
		$data_factura =$this->factura_model->get_factura_id($id_factura);
		foreach ($data_factura->result() as $data) {
			$data_2 = array(
				'id_cliente' =>$data->cliente_id,
				'nombre_cliente' =>$data->cliente_nombre
			 );
		}
		$this->nota_debito_model->guardar_nota_debito($id_factura,$data_2['id_cliente'],$data_2['nombre_cliente'],$fecha,$total);
		$det_factura=$this->factura_model->get_det_factura_id_factura($id_factura);
		$id_nota_debito=$this->nota_debito_model->get_max_nota_debito();
		foreach ($id_nota_debito->result() as $data) {
			$id_nota_debito_2=$data->id;
		}
		foreach ($det_factura->result() as $data) {
			$data_det_factura_2 = array(
				'id_inventario_producto' =>$data->id_inventario_producto,
				'descripcion' =>$data->descripcion,
				'cantidad'=>$data->cantidad,
				'precio'=>$data->precio,
				'iva'=>$data->iva,
				'total'=>$data->total);
		$this->nota_debito_model->guardar_det_nota_debito($id_nota_debito_2,$data_det_factura_2['id_inventario_producto'],$data_det_factura_2['descripcion'],$data_det_factura_2['cantidad'],$data_det_factura_2['precio'],$data_det_factura_2['iva'],$data_det_factura_2['total']);
		}
		$data = array('factura'=>$this->nota_debito_model->get_factura_id($id_factura),
			'valor_iva'=>$this->iva_model->get_iva(),
			'id_nota_debito_2'=>$id_nota_debito_2);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nota_credito');
		$crud->set_subject('Nota Credito');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/script/script_salir_factura');
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nota_debito/add_nota_debito',$data);
		$this->load->view('../../assets/inc/footer_common_add_nota_debito',$output);
		} catch (Exception $e) {
		}
	}
	public function mostrar_det_nota_debito(){
		if($this->input->is_ajax_request()){
		$id_nota_debito= $this->input->post('txt_id_nota_debito');
		if ($datos=$this->nota_debito_model->get_det_nota_debito($id_nota_debito))
		{
			echo json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function eliminar_det_nota_debito(){
	if ($this->input->is_ajax_request()) {
		$id_det_nota_debito = $this->input->post("id");
		$data_det_nota_debito=$this->nota_debito_model->get_det_nota_debito_id($id_det_nota_debito);
	#************************el foreach del det_factura**************************
		foreach ($data_det_nota_debito->result() as $data) {
			$data_det_nota_debito_2 = array('id_inventario' =>$data->id_inventario_producto,
				'cantidad' =>$data->cantidad
			 );
		}
		$id_inventario_producto=$data_det_nota_debito_2['id_inventario'];
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
			$cantidad_suma=$data_det_nota_debito_2['cantidad']+$data_inventario_producto['cantidad'];
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
			$this->nota_debito_model->eliminar_det_nota_debito($id_det_nota_debito);
	}
	}
	public function guardar_nota_debito(){
		$id_nota_debito = $this->input->post('txt_id_nota_debito');
		$id_factura=$this->input->post('txt_id_factura');
		$fecha_compra=date('Y-m-d');
		$observaciones=$this->input->post('txt_observaciones');
		$sub_total= $this->input->post('txt_sub_total');
		$iva= $this->input->post('txt_iva');
		$total= $this->input->post('txt_total');
		$this->nota_debito_model->actualizar_nota_debito($id_nota_debito,$id_factura,$fecha_compra,$sub_total, $iva,$total,$observaciones);
		redirect('nota_debito/grilla');
	}
	public function eliminar_toda_nota_debito(){
		if ($this->input->is_ajax_request()) {
		$id_nota_credito = $this->input->post("id");
		if ($data_det_nota_debito=$this->factura_model->get_det_factura_eliminar($id_nota_credito)) {
			foreach ($data_det_nota_debito->result() as $data) {
				$data_det_nota_debito_2 = array(
				'id' =>$data->id,
				'id_inventario' =>$data->id_inventario_producto,
				'cantidad'=>$data->cantidad
			 );$data=$this->inventario_producto_model->buscar_inventario($data_det_nota_debito_2['id_inventario']);
	#************************el foreach del inventario*************************
			foreach ($data->result() as $data) {
				$data_inventario_producto = array(
				'id' =>$data->id,
				'nombre_producto' =>$data->producto_nombre,
				'precio_neto' =>$data->precio_neto,
				'cantidad'=>$data->cantidad_inventario);
			}#fin foreach inventario
		$id_inventario=$data_inventario_producto['id'];
		$cantidad_suma=$data_det_nota_debito_2['cantidad']+$data_inventario_producto['cantidad'];
		$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
		$this->factura_model->eliminar_det_nota_credito($data_det_nota_debito_2['id']);
#*******************************************************************************
			} #fin foreach det_factura
		$this->factura_model->eliminar_nota_credito($id_nota_credito);

		}else{
		}
}

	}
}
