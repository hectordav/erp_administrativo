<?php
class Nota_venta_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_max_nota_venta() {
      $this->db->select_max('id');
        $nota_venta=$this->db->get('t_nota_venta');
    if ($nota_venta->num_rows()>0) {
        return $nota_venta;
        }else{
        return false;
        }
    }
  #*******************************************************************************
  public function get_nota_venta_id($id_nota_venta){
    $this->db->select('t_nota_venta.id as id_nota_venta,t_cliente.ruf as cliente_ruf, t_cliente.nombre as cliente_nombre, t_nota_venta.num_nota as num_nota, t_nota_venta.sub_total as nota_venta_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_cliente', 't_nota_venta.id_cliente = t_cliente.id', 'left');
    $this->db->join('t_usuario', 't_nota_venta.id_usuario = t_usuario.id', 'left');
    $this->db->where('t_nota_venta.id', $id_nota_venta);
    $compra=$this->db->get('t_nota_venta');
    if ($compra->num_rows()>0) {
        return $compra;
        }else{
        return false;
        }
    }

#*******************************************************************************
 public function guardar_nota_venta($id_cliente,$fecha,$total){
    $data = array('id_cliente' =>$id_cliente,
                  'total'=>$total,
                  'fecha'=>$fecha);
    $this->db->insert('t_nota_venta', $data);
 }
  public function guardar_det_nota_venta($id_nota_venta,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total){
    $data = array('id_nota_venta' =>$id_nota_venta,
                  'id_inventario_producto'=>$id_inventario_producto,
                  'descripcion'=>$nombre_producto,
                  'cantidad'=>$cantidad_web,
                  'precio'=>$precio_neto,
                  'total'=>$total);
    $this->db->insert('t_det_nota_venta', $data);
 }
 #******************este es para json-encode************************************
  public function get_det_nota_venta($id_nota_venta){
    $this->db->where('id_nota_venta', $id_nota_venta);
    $det_nota_venta=$this->db->get('t_det_nota_venta');
    if ($det_nota_venta->num_rows()>0) {
        return $det_nota_venta->result();
        }else{
        return false;
        }
    }

#*********************************************************************************
    public function get_det_nota_venta_id($id_nota_venta){
      $this->db->where('id', $id_nota_venta);
      $det_nota_venta=$this->db->get('t_det_nota_venta');
       if ($det_nota_venta->num_rows()>0) {
          return $det_nota_venta;
          }else{
          return false;
          }
      }

    public function eliminar_det_nota_venta($id_det_nota_venta){
    $this->db->where('id', $id_det_nota_venta);
    $this->db->delete('t_det_nota_venta');
    }
    public function eliminar_nota_venta_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_nota_venta');
    }
      public function eliminar_nota_venta($id_factura){
    $this->db->where('id',$id_factura);
    $this->db->delete('t_factura');
    }

  public function actualizar_nota_venta($id_nota_venta, $fecha_compra,$sub_total, $iva,$total,$observaciones){
    $data = array('num_nota'=>$id_nota_venta,
                  'sub_total' =>$sub_total,
                  'iva'=>$iva,
                  'total'=>$total,
                  'fecha'=>$fecha_compra,
                  'observaciones'=>$observaciones);
    $this->db->where('id',$id_nota_venta);
    $this->db->update('t_nota_venta', $data);
 }
public function get_det_nota_venta_eliminar($id_nota_venta){
    $this->db->where('id_nota_venta', $id_nota_venta);
    $det_nota_venta=$this->db->get('t_det_nota_venta');
    if ($det_nota_venta->num_rows()>0) {
          return $det_nota_venta;
          }else{
          return false;
          }
    }
}