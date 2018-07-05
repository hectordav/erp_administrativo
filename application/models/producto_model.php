<?php
class Producto_model extends CI_Model{
   
    public function guardar_producto($id_modelo,$cod_producto,$producto,$precio_compra,$ganancia,$precio_neto,$iva,$pvp) {
    	$data = array('id_modelo' =>$id_modelo ,
    				  'cod_producto' =>$cod_producto ,
    				  'producto' =>$producto,
    				  'precio_compra' =>$precio_compra ,
    				  'ganancia' =>$ganancia ,
    				  'precio_neto' =>$precio_neto ,
    				  'iva' =>$iva ,
    				  'total' =>$pvp);
        $this->db->insert('t_producto', $data);
        }
    #*******************************************************************************
    public function get_producto($id_producto) {
        $this->db->where('id', $id_producto);
        $producto=$this->db->get('t_producto');
        if ($producto->num_rows()>0) {
                    return $producto;
                    }else{
                    return false;
                    }
        }

	#*******************************************************************************
        public function actualizar_producto($id_producto,$id_modelo,$cod_producto,$producto,$precio_compra,$ganancia,$precio_neto,$iva,$pvp) {
          	$data = array('id_modelo' =>$id_modelo ,
	    				  'cod_producto' =>$cod_producto ,
	    				  'producto' =>$producto,
	    				  'precio_compra' =>$precio_compra ,
	    				  'ganancia' =>$ganancia ,
	    				  'precio_neto' =>$precio_neto ,
	    				  'iva' =>$iva ,
	    				  'total' =>$pvp);
            $this->db->where('id',$id_producto);
            $this->db->update('t_producto', $data);
        }
}