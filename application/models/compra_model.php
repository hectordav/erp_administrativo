<?php
class compra_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_max_compra() {
      $this->db->select_max('id');
        $compra=$this->db->get('t_compra');
    if ($compra->num_rows()>0) {
        return $compra;
        }else{
        return false;
        }
    }
  #*******************************************************************************
  public function get_compra_id($id_compra){
    $this->db->select('t_compra.id as id_compra,t_proveedor.ruf as proveedor_ruf, t_proveedor.nombre as proveedor_nombre, t_compra.num_compra as num_compra, t_compra.sub_total as presupuesto_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_proveedor', 't_compra.id_proveedor = t_proveedor.id', 'left');
    $this->db->join('t_usuario', 't_compra.id_usuario = t_usuario.id', 'left');
    $this->db->where('t_compra.id', $id_compra);
    $compra=$this->db->get('t_compra');
    if ($compra->num_rows()>0) {
        return $compra;
        }else{
        return false;
        }
    }
    public function get_compra(){
    $this->db->select('t_compra.id as id_compra,t_proveedor.ruf as proveedor_ruf, t_proveedor.nombre as proveedor_nombre, t_compra.num_compra as num_compra, t_compra.sub_total as presupuesto_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_proveedor', 't_compra.id_proveedor = t_proveedor.id', 'left');
    $this->db->join('t_usuario', 't_compra.id_usuario = t_usuario.id', 'left');
    $this->db->where('t_compra.id', $id_compra);
    $compra=$this->db->get('t_compra');
    if ($compra->num_rows()>0) {
        return $compra;
        }else{
        return false;
        }
    }

#*******************************************************************************
 public function guardar_compra($id_proveedor,$fecha,$total){
    $data = array('id_proveedor' =>$id_proveedor,
                  'total'=>$total,
                  'fecha'=>$fecha);
    $this->db->insert('t_compra', $data);
 }
  public function guardar_det_compra($id_compra,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total){
    $data = array('id_compra' =>$id_compra,
                  'id_inventario_producto'=>$id_inventario_producto,
                  'descripcion'=>$nombre_producto,
                  'cantidad'=>$cantidad_web,
                  'precio'=>$precio_neto,
                  'total'=>$total);
    $this->db->insert('t_det_compra', $data);
 }
 #******************este es para json-encode************************************
  public function get_det_compra($id_compra){
    $this->db->where('id_compra', $id_compra);
    $det_compra=$this->db->get('t_det_compra');
    if ($det_compra->num_rows()>0) {
        return $det_compra->result();
        }else{
        return false;
        }
    }

#*********************************************************************************
    public function get_det_compra_id($id_det_compra){
      $this->db->where('id', $id_det_compra);
      $det_compra=$this->db->get('t_det_compra');
       if ($det_compra->num_rows()>0) {
          return $det_compra;
          }else{
          return false;
          }
      }

    public function eliminar_det_compra($id_det_compra){
    $this->db->where('id', $id_det_compra);
    $this->db->delete('t_det_compra');
    }

     public function eliminar_compra_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_compra');
    }

  public function actualizar_compra($id_compra, $fecha_compra,$sub_total, $iva,$total,$observaciones){
    $data = array('num_compra'=>$id_compra,
                  'sub_total' =>$sub_total,
                  'iva'=>$iva,
                  'total'=>$total,
                  'fecha'=>$fecha_compra,
                  'observaciones'=>$observaciones);
    $this->db->where('id',$id_compra);
    $this->db->update('t_compra', $data);
 }
}