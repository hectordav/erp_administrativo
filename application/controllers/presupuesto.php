<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Presupuesto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('cliente_model');
			$this->load->model('presupuesto_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('iva_model');
			$this->view_data=array();
	}
	public function index(){
			redirect('presupuesto/grilla');
	}
	public function grilla(){
		try {
		$this->presupuesto_model->eliminar_presupuesto_total_0();
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_presupuesto');
		$crud->set_subject('Cotizacion');
		$crud->set_relation('id_cliente','t_cliente','nombre');
		$crud->set_relation('id_usuario','t_usuario','nombre');
		$crud->set_language('spanish');
		$crud->display_as('id_cliente','Cliente');
		$crud->display_as('id_usuario','Usuario');
		$crud->display_as('id_status_presupuesto','Status');
		$crud->display_as('num_presupuesto','# Cotizacion');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('observaciones','Observaciones');
		$crud->columns('id_cliente','num_presupuesto','total','fecha','observaciones');
		$crud->unset_edit();
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('presupuesto/add');
		}
		//las vistas
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('presupuesto/presupuesto',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_presupuesto');
		$crud->set_subject('prsupuesto');
		$output = $crud->render();
		$data = array('cliente' =>$this->cliente_model->get_cliente());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_cotizacion',$data);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('presupuesto/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_presupuesto(){
		$id_cliente= $this->input->post('cb_id_cliente');
		$fecha = date('Y-m-d');
		$total=0;
		$this->presupuesto_model->guardar_presupuesto($id_cliente,$fecha,$total);
		$presupuesto=$this->presupuesto_model->get_max_presupuesto();
		foreach ($presupuesto->result() as $data) {
			$id_presupuesto=$data->id;
		}
		$data = array('presupuesto'=>$this->presupuesto_model->get_presupuesto_id($id_presupuesto),'inventario_producto'=>$this->inventario_producto_model->get_inventario_producto(),
			'valor_iva'=>$this->iva_model->get_iva());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_presupuesto');
		$crud->set_subject('presupuesto');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('presupuesto/add_presupuesto',$data);
		$this->load->view('../../assets/inc/footer_common_add_presupuesto',$output);
	}
	public function mostrar_det_presupuesto(){
		if($this->input->is_ajax_request()){
		$id_presupuesto= $this->input->post('txt_id_presupuesto');
		if ($datos=$this->presupuesto_model->get_det_presupuesto($id_presupuesto))
		{
			echo json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function total_det_presupuesto(){
		if($this->input->is_ajax_request()){
		$id_presupuesto= $this->input->post('txt_id_presupuesto');
		$sub_total=$this->presupuesto_model->sumar_total_det_presupuesto($id_presupuesto);
		$get_iva=$this->iva_model->get_iva();
		foreach ($get_iva->result() as $data) {
			$valor_iva=$data->iva;
		}
		$iva=($sub_total*$valor_iva)/100;
		$total=$sub_total+$iva;
		$datos = array('sub_total' =>$sub_total,
									'iva'=>$iva,
									'total'=>$total);
		if ($datos){
		json_encode($datos);
		}else{
			$datos=null;
			echo json_encode($datos);
		}
		}
	}
	public function guardar_det_presupuesto_item(){
	if($this->input->is_ajax_request()){
		$id_presupuesto= $this->input->post('txt_id_presupuesto');
		$id_producto_inventario=$this->input->post('id_producto');
		$cantidad_web= $this->input->post('txt_cantidad');
#*************************************************************************
		$data=$this->inventario_producto_model->buscar_inventario($id_producto_inventario);
			foreach ($data->result() as $data) {
			$data_inventario_producto = array('id' =>$data->id,
			'nombre_producto' =>$data->producto_nombre,
			'precio_neto' =>$data->precio_neto);
			}#fin foreach
			$nombre_producto=$data_inventario_producto['nombre_producto'];
			$precio_neto=$data_inventario_producto['precio_neto'];
			$total= $precio_neto*$cantidad_web;
#*************************************************************************
		$datos=$this->presupuesto_model->guardar_det_presupuesto($id_presupuesto, $nombre_producto,$cantidad_web, $precio_neto, $total);
		}
	}
	public function eliminar_det_presupuesto(){
	if ($this->input->is_ajax_request()) {
		$id_det_presupuesto = $this->input->post("id");
		$data=$this->presupuesto_model->eliminar_det_presupuesto($id_det_presupuesto);
	}
	}
	public function guardar_presupuesto(){
		$id_presupuesto = $this->input->post('txt_id_presupuesto');
		$observaciones=$this->input->post('txt_observaciones');
		$sub_total= $this->input->post('txt_sub_total');
		$iva= $this->input->post('txt_iva');
		$total= $this->input->post('txt_total');
		$this->presupuesto_model->actualizar_presupuesto($id_presupuesto,$sub_total, $iva,$total,$observaciones);
		redirect('presupuesto/grilla');
	}
}