<?php
class Nota_debito_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_max_nota_debito() {
      $this->db->select_max('id');
        $nota_credito=$this->db->get('t_nota_debito');
    if ($nota_credito->num_rows()>0) {
        return $nota_credito;
        }else{
        return false;
        }
    }
  #*******************************************************************************
  public function get_factura_id($id_factura){
    $this->db->select('t_factura.id as id_factura,t_cliente.ruf as cliente_ruf, t_cliente.nombre as cliente_nombre, t_factura.num_fact as num_fact, t_factura.sub_total as factura_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_cliente', 't_factura.id_cliente = t_cliente.id', 'left');
    $this->db->join('t_usuario', 't_factura.id_usuario = t_usuario.id', 'left');
    $this->db->where('t_factura.id', $id_factura);
    $compra=$this->db->get('t_factura');
    if ($compra->num_rows()>0) {
        return $compra;
        }else{
        return false;
        }
    }
     public function get_factura(){
    $this->db->select('t_factura.id as id_factura,t_cliente.ruf as cliente_ruf, t_cliente.nombre as cliente_nombre, t_factura.num_fact as num_fact, t_factura.sub_total as factura_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_cliente', 't_factura.id_cliente = t_cliente.id', 'left');
    $this->db->join('t_usuario', 't_factura.id_usuario = t_usuario.id', 'left');
    $factura=$this->db->get('t_factura');
    if ($factura->num_rows()>0) {
        return $factura;
        }else{
        return false;
        }
    }
#*******************************************************************************
 public function guardar_nota_debito($id_factura, $id_cliente, $nombre_cliente, $fecha, $total){
    $data = array('id_cliente' =>$id_cliente,
                  'num_nota'=>$id_factura,
                  'total'=>$total,
                  'fecha'=>$fecha);
    $this->db->insert('t_nota_debito', $data);
 }
  public function guardar_det_nota_debito($id_nota_debito, $id_inventario_producto, $nombre_producto, $cantidad, $precio_neto, $iva, $total){
    $data = array('id_nota_debito' =>$id_nota_debito,
                  'id_inventario_producto'=>$id_inventario_producto,
                  'descripcion'=>$nombre_producto,
                  'cantidad'=>$cantidad,
                  'precio'=>$precio_neto,
                  'iva'=>$iva,
                  'total'=>$total);
    $this->db->insert('t_det_nota_debito', $data);
 }
 #******************este es para json-encode************************************
  public function get_det_nota_debito($id_nota_debito){
    $this->db->where('id_nota_debito', $id_nota_debito);
    $det_nota_debito=$this->db->get('t_det_nota_debito');
    if ($det_nota_debito->num_rows()>0) {
        return $det_nota_debito->result();
        }else{
        return false;
        }
    }
#*****************aqui normal***************************************************
  public function get_det_factura_eliminar($id_factura){
    $this->db->where('id_factura', $id_factura);
    $det_factura=$this->db->get('t_det_factura');
    if ($det_factura->num_rows()>0) {
          return $det_factura;
          }else{
          return false;
          }
    }
#*********************************************************************************
    public function get_det_nota_debito_id($id_nota_debito){
      $this->db->where('id', $id_nota_debito);
      $det_nota_debito=$this->db->get('t_det_nota_debito');
       if ($det_nota_debito->num_rows()>0) {
          return $det_nota_debito;
          }else{
          return false;
          }
      }
    public function eliminar_det_nota_debito($id_det_nota_debito){
    $this->db->where('id', $id_det_nota_debito);
    $this->db->delete('t_det_nota_debito');
    }
    public function eliminar_nota_debito_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_nota_debito');
    }
    public function eliminar_nota_credito($id_nota_credito){
    $this->db->where('id',$id_nota_credito);
    $this->db->delete('t_nota_credito');
    }
  public function actualizar_nota_debito($id_nota_debito,$id_factura,$fecha_compra,$sub_total, $iva,$total,$observaciones){
    $data = array('num_nota'=>$id_nota_debito,
                  'num_fact'=>$id_factura,
                  'sub_total' =>$sub_total,
                  'iva'=>$iva,
                  'total'=>$total,
                  'fecha'=>$fecha_compra,
                  'observaciones'=>$observaciones);
    $this->db->where('id',$id_nota_debito);
    $this->db->update('t_nota_debito', $data);
 }
}