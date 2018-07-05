<?php
class Inventario_producto_model extends CI_Model{
    //put your code here
    public function guardar_inventario_producto($id_producto,$id_bodega,$cantidad) {
      $data = array('id_bodega' =>$id_bodega,
      'id_producto' =>$id_producto,
       'cantidad' =>$cantidad);
      $this->db->insert('t_inventario_producto', $data);
      }
 #**************************************************************************
 	 public function buscar_inventario($id_inventario){
	    $this->db->select('t_inventario_producto.id, t_bodega.descripcion as bodega_nombre,t_inventario_producto.id_producto as id_producto, t_producto.producto as producto_nombre, t_producto.precio_neto as precio_neto, t_inventario_producto.cantidad as cantidad_inventario');
			$this->db->join('t_bodega','t_inventario_producto.id_bodega = t_bodega.id','left');
			$this->db->join('t_producto','t_inventario_producto.id_producto = t_producto.id','left');
	    $this->db->where('t_inventario_producto.id', $id_inventario);
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }

 #***************************************************************************
	 public function get_inventario_producto(){
	    $this->db->select('t_inventario_producto.id as id_inventario,t_bodega.descripcion as bodega_nombre,t_inventario_producto.id_producto as id_producto,t_producto.cod_producto as cod_producto, t_producto.producto as producto_nombre,t_inventario_producto.cantidad as cantidad_inventario');
		  $this->db->join('t_bodega','t_inventario_producto.id_bodega = t_bodega.id','left');
			$this->db->join('t_producto','t_inventario_producto.id_producto = t_producto.id','left');
	    $this->db->where('t_inventario_producto.id_bodega','1');
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }
	public function get_inventario_producto_bodega_piso_compra(){
	    $this->db->select('t_inventario_producto.id as id_inventario,t_bodega.descripcion as bodega_nombre,t_inventario_producto.id_producto as id_producto,t_producto.cod_producto as cod_producto, t_producto.producto as producto_nombre,t_inventario_producto.cantidad as cantidad_inventario');
		  $this->db->join('t_bodega','t_inventario_producto.id_bodega = t_bodega.id','left');
			$this->db->join('t_producto','t_inventario_producto.id_producto = t_producto.id','left');
	    $this->db->where('t_bodega.id_piso','1');
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }
	public function get_inventario_producto_bodega_piso_venta(){
	    $this->db->select('t_inventario_producto.id as id_inventario,t_bodega.descripcion as bodega_nombre,t_inventario_producto.id_producto as id_producto,t_producto.cod_producto as cod_producto, t_producto.producto as producto_nombre,t_inventario_producto.cantidad as cantidad_inventario');
		  $this->db->join('t_bodega','t_inventario_producto.id_bodega = t_bodega.id','left');
			$this->db->join('t_producto','t_inventario_producto.id_producto = t_producto.id','left');
	    $this->db->where('t_bodega.id_piso','2');
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }
	public function buscar_inventario_x_bodega($id_producto,$id_bodega, $cantidad_vieja){
	    $this->db->where('id_producto', $id_producto);
	    $this->db->where('id_bodega', $id_bodega);
	    $this->db->where('cantidad', $cantidad_vieja);
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }
	public function buscar_inventario_x_bodega_2($id_producto,$id_bodega){
	    $this->db->where('id_producto', $id_producto);
	    $this->db->where('id_bodega', $id_bodega);
	    $query=$this->db->get('t_inventario_producto');
	     if ($query->num_rows()>0) {
	            return $query;
	            }else{
	            return false;
	            }
	        }
	public function actualizar_inventario($id_inventario,$cantidad_suma){
		$data = array('cantidad' =>$cantidad_suma);
		$this->db->where('id', $id_inventario);
		$this->db->update('t_inventario_producto', $data);
	}
}