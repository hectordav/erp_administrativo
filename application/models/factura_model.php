<?php
class Factura_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_max_factura() {
      $this->db->select_max('id');
        $nota_venta=$this->db->get('t_factura');
    if ($nota_venta->num_rows()>0) {
        return $nota_venta;
        }else{
        return false;
        }
    }
  #*******************************************************************************
  public function get_factura_id($id_factura){
    $this->db->select('t_factura.id as id_factura,t_cliente.id as cliente_id,t_cliente.ruf as cliente_ruf, t_cliente.nombre as cliente_nombre, t_factura.num_fact as num_fact, t_factura.sub_total as factura_sub_total,t_factura.iva as factura_iva, t_factura.total as factura_total, t_usuario.nombre as usuario_nombre');
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
 public function guardar_factura($id_cliente,$fecha,$total){
    $data = array('id_cliente' =>$id_cliente,
                  'total'=>$total,
                  'fecha'=>$fecha);
    $this->db->insert('t_factura', $data);
 }
  public function guardar_det_factura($id_factura,$id_inventario_producto, $nombre_producto,$cantidad_web, $precio_neto, $total){
    $data = array('id_factura' =>$id_factura,
                  'id_inventario_producto'=>$id_inventario_producto,
                  'descripcion'=>$nombre_producto,
                  'cantidad'=>$cantidad_web,
                  'precio'=>$precio_neto,
                  'total'=>$total);
    $this->db->insert('t_det_factura', $data);
 }
 #******************este es para json-encode************************************
  public function get_det_factura($id_factura){
    $this->db->where('id_factura', $id_factura);
    $det_factura=$this->db->get('t_det_factura');
    if ($det_factura->num_rows()>0) {
        return $det_factura->result();
        }else{
        return false;
        }
    }
# lo busca por el id_factura ya cargada anteriormente (para la notas de credito/debito)
   public function get_det_factura_id_factura($id_factura){
    $this->db->where('id_factura', $id_factura);
    $det_factura=$this->db->get('t_det_factura');
     if ($det_factura->num_rows()>0) {
          return $det_factura;
          }else{
          return false;
          }
    }
#*******************************************************************************
  public function get_det_factura_eliminar($id_factura){
    $this->db->where('id_factura', $id_factura);
    $det_factura=$this->db->get('t_det_factura');
    if ($det_factura->num_rows()>0) {
          return $det_factura;
          }else{
          return false;
          }
    }
#********************lo busca por el id del det_factra********************************
    public function get_det_factura_id($id_factura){
      $this->db->where('id', $id_factura);
      $det_factura=$this->db->get('t_det_factura');
       if ($det_factura->num_rows()>0) {
          return $det_factura;
          }else{
          return false;
          }
      }
    public function eliminar_det_factura($id_det_factura){
    $this->db->where('id', $id_det_factura);
    $this->db->delete('t_det_factura');
    }
    public function eliminar_factura_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_factura');
    }
    public function eliminar_factura($id_factura){
    $this->db->where('id',$id_factura);
    $this->db->delete('t_factura');
    }
  public function actualizar_factura($id_factura, $fecha_compra,$sub_total, $iva,$total,$observaciones){
    $data = array('num_fact'=>$id_factura,
                  'sub_total' =>$sub_total,
                  'iva'=>$iva,
                  'total'=>$total,
                  'fecha'=>$fecha_compra,
                  'observaciones'=>$observaciones);
    $this->db->where('id',$id_factura);
    $this->db->update('t_factura', $data);
 }
 public function contar_factura_entre_fechas($fecha_i,$fecha_f){
            $this->db->from('t_factura');
            $this->db->where('fecha >=',$fecha_i);
            $this->db->where('fecha <=',$fecha_f);
            return $this->db->count_all_results();
 }
 public function sumar_factura_entre_fechas($fecha_i,$fecha_f){
          $this->db->select_sum('total');
          $this->db->where('fecha >=',$fecha_i);
          $this->db->where('fecha <=',$fecha_f);
          $query= $this->db->get('t_factura');
              if ($query->num_rows()>0) {
              return $query;
              }else{
              return false;
              }
 }
}