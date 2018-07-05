<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Corte_x extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('factura_model');
			$this->load->model('tipo_pago_model');
			$this->load->model('corte_model');
	}
	public function index(){
		redirect('corte_x/grilla');
	}
	public function grilla(){
		try {
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_corte_x');
			$crud->set_subject('Balance');
			$crud->set_language('spanish');
			$crud->display_as('contar_factura','Cant. Facturas');
			$crud->display_as('contar_pto_venta','Cant. Pto de ventas');
			$crud->display_as('contar_transferencia','Cant. Transferencias');
			$crud->display_as('total_factura','Totales Facturas');
			$crud->display_as('tran_efectivo','Totales Transferencias');
			$crud->display_as('sumar_efectivo_pago','Total efectivo');
			$crud->display_as('sumar_transferencias_pago','Total Pto Venta');
			$crud->display_as('sumar_pto_venta_pago','Total Pto Venta');
			$crud->display_as('fecha_i','F. Inicio');
			$crud->display_as('fecha_f','F Final');
			$crud->columns('contar_factura','contar_pto_venta','contar_transferencia','total_factura','tran_efectivo','sumar_efectivo_pago','sumar_transferencias_pago','sumar_pto_venta_pago','fecha_i','fecha_f');
			$crud->required_fields('contar_factura','contar_pto_venta','contar_transferencia','total_factura','tran_efectivo','sumar_efectivo_pago','sumar_transferencias_pago','sumar_pto_venta_pago','fecha_i','fecha_f');
			$crud->unset_edit();
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add')
			{
				 redirect('corte_x/add');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('corte_x/corte_x',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_corte_x');
		$crud->set_subject('corte_x');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('modal/modal_corte');
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('corte_x/add');
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function add_corte(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_corte_x');
		$crud->set_subject('corte_x');
		$output = $crud->render();
		$fecha_i=$this->input->post('dt_fecha_i');
		$fecha_f=$this->input->post('dt_fecha_f');
		$contar_factura=$this->factura_model->contar_factura_entre_fechas($fecha_i,$fecha_f);
		$contar_efectivo=$this->tipo_pago_model->contar_pago_efectivo_entre_fechas($fecha_i,$fecha_f);
		$contar_transferencias=$this->tipo_pago_model->contar_pago_transferencia_entre_fechas($fecha_i,$fecha_f);
		$contar_pto_venta=$this->tipo_pago_model->contar_pago_pto_venta_entre_fechas($fecha_i,$fecha_f);
		$sumar_factura=$this->factura_model->sumar_factura_entre_fechas($fecha_i,$fecha_f);
		$sumar_efectivo=$this->tipo_pago_model->sumar_pago_efectivo_entre_fechas($fecha_i,$fecha_f);
		$sumar_transferencias=$this->tipo_pago_model->sumar_pago_transferencia_entre_fechas($fecha_i,$fecha_f);
		$sumar_pto_venta=$this->tipo_pago_model->sumar_pago_pto_venta_entre_fechas($fecha_i,$fecha_f);
		foreach ($sumar_factura->result() as $data) {
			$sumar_total_factura=$data->total;
		}
		foreach ($sumar_efectivo->result() as $data) {
			$sumar_efectivo_pago=$data->monto;
		}
		foreach ($sumar_transferencias->result() as $data) {
			$sumar_transferencias_pago=$data->monto;
		}
		foreach ($sumar_pto_venta->result() as $data) {
			$sumar_pto_venta_pago=$data->monto;
		}
		$data = array(
			'contar_factura'=>$contar_factura,
			'total_factura'=>$sumar_total_factura,
			'tran_efectivo'=>$contar_efectivo,
			'contar_transferencia'=>$contar_transferencias,
			'contar_pto_venta'=>$contar_pto_venta,
			'sumar_efectivo_pago'=>$sumar_efectivo_pago,
			'sumar_transferencias_pago'=>$sumar_transferencias_pago,
			'sumar_pto_venta_pago'=>$sumar_pto_venta_pago,
			'fecha_i'=>$fecha_i,
			'fecha_f'=>$fecha_f
			 );
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('corte_x/add_corte_x',$data);
		$this->load->view('../../assets/inc/footer_common_add', $output);
	}
	public function guardar_corte(){
		$contar_factura=$this->input->post('txt_contar_factura');
		$total_factura=$this->input->post('txt_total_factura');
		$tran_efectivo=$this->input->post('txt_tran_efectivo');
		$contar_transferencia=$this->input->post('txt_contar_transferencia');
		$contar_pto_venta=$this->input->post('txt_contar_pto_venta');
		$sumar_efectivo_pago=$this->input->post('txt_sumar_efectivo_pago');
		$sumar_transferencias_pago=$this->input->post('txt_sumar_transferencias_pago');
		$sumar_pto_venta_pago=$this->input->post('txt_sumar_pto_venta_pago');
		$fecha_i=$this->input->post('txt_fecha_i');
		$fecha_f=$this->input->post('txt_fecha_f');
		$this->corte_model->guardar_corte($contar_factura ,$total_factura, $tran_efectivo,$contar_transferencia,$contar_pto_venta,$sumar_efectivo_pago,$sumar_transferencias_pago,$sumar_pto_venta_pago,$fecha_i,$fecha_f);
			redirect('corte_x/grilla');
	}
}
