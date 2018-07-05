<?php
class Tipo_model extends CI_Model{
    //put your code here

    public function get_tipo() {
        $this->db->order_by('descripcion', 'asc');
        $consulta = $this->db->get('t_tipo');
        if($consulta->num_rows() > 0){
            return $consulta->result();
        }
    }
   public function get_marca($id_tipo) {
        $this->db->where('id_tipo', $id_tipo);
        $this->db->order_by('descripcion', 'asc');
        $marca = $this->db->get('t_marca');
        if($marca->num_rows() > 0){
            return $marca->result();
        }
    }
    public function get_modelo_combo($id_marca) {
        $this->db->where('id_marca', $id_marca);
        $this->db->order_by('descripcion', 'asc');
        $modelo = $this->db->get('t_modelo');
        if($modelo->num_rows() > 0){
            return $modelo->result();
        }
    }
    public function get_producto_combo($id_marca) {
        $this->db->where('id_modelo', $id_marca);
        $this->db->order_by('id', 'asc');
        $producto = $this->db->get('t_producto');
        if($producto->num_rows() > 0){
            return $producto->result();
        }
    }
    public function guardar_modelo($id_marca, $modelo) {
       $data = array('id_marca' =>$id_marca ,'descripcion'=>$modelo);
        $this->db->insert('t_modelo', $data);
        }

#*******************************************************************************
    public function get_modelo($id_modelo) {
        $this->db->where('id', $id_modelo);
            $modelo=$this->db->get('t_modelo');
        if ($modelo->num_rows()>0) {
                    return $modelo;
                    }else{
                    return false;
                    }
        }
#*******************************************************************************
        public function actualizar_modelo($id_modelo, $id_marca, $modelo) {
           $data = array('id_marca' =>$id_marca ,'descripcion'=>$modelo);
            $this->db->where('id',$id_modelo);
            $this->db->update('t_modelo', $data);
        }

}