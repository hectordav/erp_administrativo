<?php
class Tipo_pago_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function get_tipo_pago() {
        $tipo_pago=$this->db->get('t_tipo_pago');
    if ($tipo_pago->num_rows()>0) {
        return $tipo_pago;
        }else{
        return false;
        }
    }
    public function guardar_pago($id_factura,$id_tipo_pago,$referencia,$total,$fecha){
    	$data = array(
    		'id_factura' =>$id_factura,
    		'id_tipo_pago' =>$id_tipo_pago,
    		'referencia' =>$referencia,
    		'monto' =>$total,
    		'fecha' =>$fecha);
    	$this->db->insert('t_pago', $data);
    }
#*******************************************************************************
 public function contar_pago_efectivo_entre_fechas($fecha_i,$fecha_f){
        $this->db->from('t_pago');
        $this->db->where('id_tipo_pago','1');
        $this->db->where('fecha >=',$fecha_i);
        $this->db->where('fecha <=',$fecha_f);
        return $this->db->count_all_results();
    }
 public function contar_pago_transferencia_entre_fechas($fecha_i,$fecha_f){
        $this->db->from('t_pago');
        $this->db->where('id_tipo_pago','2');
        $this->db->where('fecha >=',$fecha_i);
        $this->db->where('fecha <=',$fecha_f);
        return $this->db->count_all_results();
    }

 public function contar_pago_pto_venta_entre_fechas($fecha_i,$fecha_f){
        $this->db->from('t_pago');
        $this->db->where('id_tipo_pago','3');
        $this->db->where('fecha >=',$fecha_i);
        $this->db->where('fecha <=',$fecha_f);
        return $this->db->count_all_results();
    }
public function sumar_pago_efectivo_entre_fechas($fecha_i,$fecha_f){
          $this->db->select_sum('monto');
          $this->db->where('id_tipo_pago','1');
          $this->db->where('fecha >=',$fecha_i);
          $this->db->where('fecha <=',$fecha_f);
          $query= $this->db->get('t_pago');
              if ($query->num_rows()>0) {
              return $query;
              }else{
              return false;
              }
 }
 public function sumar_pago_transferencia_entre_fechas($fecha_i,$fecha_f){
          $this->db->select_sum('monto');
          $this->db->where('id_tipo_pago','2');
          $this->db->where('fecha >=',$fecha_i);
          $this->db->where('fecha <=',$fecha_f);
          $query= $this->db->get('t_pago');
              if ($query->num_rows()>0) {
              return $query;
              }else{
              return false;
              }
 }
 public function sumar_pago_pto_venta_entre_fechas($fecha_i,$fecha_f){
          $this->db->select_sum('monto');
          $this->db->where('id_tipo_pago','3');
          $this->db->where('fecha >=',$fecha_i);
          $this->db->where('fecha <=',$fecha_f);
          $query= $this->db->get('t_pago');
              if ($query->num_rows()>0) {
              return $query;
              }else{
              return false;
              }
 }

}