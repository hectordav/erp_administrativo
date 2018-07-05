<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventario_producto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('tipo_model');
			$this->load->model('iva_model');
			$this->load->model('inventario_producto_model');
			$this->load->model('bodega_model');
	}
	public function index()
	{
			redirect('inventario_producto/grilla');
	}
	public function grilla(){
		try {
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_inventario_producto');
		$crud->set_subject('Inventario');
		$crud->set_language('spanish');
		$crud->set_relation('id_bodega','t_bodega','descripcion');
		$crud->set_relation('id_producto','t_producto','{cod_producto} {producto}');
		$crud->display_as('id_bodega','Bodega');
		$crud->display_as('id_producto','Producto');
		$crud->display_as('cantidad','Cantidad');
		$crud->columns('id_producto','id_bodega','cantidad');
		$crud->required_fields('id_bodega','id_producto','cantidad');
		$crud->add_action('Agregar Inventario a bodega', '', '','fa fa-plus',array($this,'id_primaria'));
		$output = $crud->render();
		$state = $crud->getState();
		if($state == 'add')
		{
			 redirect('inventario_producto/add');
		}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario_producto/inventario_producto',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		}catch (Exception $e) {
		}
	}
	function id_primaria($primary_key , $row)
	{
		return site_url('inventario_producto/agregar_inventario_bodega').'/'.$row->id;
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_inventario_producto');
		$output = $crud->render();
		$data = array('tipo' =>$this->tipo_model->get_tipo(),
		 'iva' =>$this->iva_model->get_iva());
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario_producto/add',$data);
		$this->load->view('../../assets/script/script_combo_inventario');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_inventario(){
		$id_producto=$this->input->post('id_producto');
		$id_bodega=1;
		$cantidad=$this->input->post('txt_cantidad');
		$this->inventario_producto_model->guardar_inventario_producto($id_producto,$id_bodega,$cantidad);
		redirect('inventario_producto/grilla');
	}
	public function agregar_inventario_bodega(){
		$id_inventario = $this->uri->segment(3);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_inventario_producto');
		$output = $crud->render();
		$data = array('inventario_producto' =>$this->inventario_producto_model->buscar_inventario($id_inventario),
			'bodega' =>$this->bodega_model->get_bodega());
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario_producto/agregar_inventario_bodega',$data);
		$this->load->view('../../assets/script/script_combo_inventario');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_inventario_bodega(){
		$id_inventario=$this->input->post('id_inventario');
		$id_bodega=$this->input->post('id_bodega');
		$id_producto=$this->input->post('id_producto');
		$cantidad_vieja=$this->input->post('txt_existencia');
		$cantidad_nueva=$this->input->post('txt_cantidad');
		$data = array('buscar_inventario' =>$this->inventario_producto_model->buscar_inventario_x_bodega($id_producto,$id_bodega, $cantidad_vieja));
		if ($data['buscar_inventario']) {
			$cantidad_suma=$cantidad_vieja+$cantidad_nueva;
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_suma);
			redirect('inventario_producto/grilla');
		}else{
			$data = array('buscar_inventario_2' =>$this->inventario_producto_model->buscar_inventario_x_bodega_2($id_producto,$id_bodega));
			if ($data['buscar_inventario_2']) {
				foreach ($data['buscar_inventario_2']->result() as $data) {
					$inventario_viejo = array('cantidad_iv' =>$data->cantidad,
						'id_inventario_viejo' =>$data->id);
				}
				$cantidad_suma=$inventario_viejo['cantidad_iv']+$cantidad_nueva;
				$cantidad_resta=$cantidad_vieja-$cantidad_nueva;
				$this->inventario_producto_model->actualizar_inventario($inventario_viejo['id_inventario_viejo'],$cantidad_suma);
				$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_resta);
				redirect('inventario_producto/grilla');
			}else{
			$cantidad_resta=$cantidad_vieja-$cantidad_nueva;
			$this->inventario_producto_model->actualizar_inventario($id_inventario,$cantidad_resta);
			$this->inventario_producto_model->guardar_inventario_producto($id_producto,$id_bodega,$cantidad_nueva);
			redirect('inventario_producto/grilla');
			}
		}
	}
}