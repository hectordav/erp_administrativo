<?php
class Presupuesto_model extends CI_Model{
    //put your code here
 #*******************************************************************************
    public function get_max_presupuesto() {
      $this->db->select_max('id');
        $presupuesto=$this->db->get('t_presupuesto');
    if ($presupuesto->num_rows()>0) {
        return $presupuesto;
        }else{
        return false;
        }
    }
  #*******************************************************************************
  public function get_presupuesto_id($id_presupuesto){
    $this->db->select('t_presupuesto.id as id_presupuesto,t_cliente.ruf as cliente_ruf, t_cliente.nombre as cliente_nombre, t_presupuesto.num_presupuesto as num_presupuesto, t_presupuesto.sub_total as presupuesto_sub_total, t_usuario.nombre as usuario_nombre');
    $this->db->join('t_cliente', 't_presupuesto.id_cliente = t_cliente.id', 'left');
    $this->db->join('t_usuario', 't_presupuesto.id_usuario = t_usuario.id', 'left');
    $this->db->where('t_presupuesto.id', $id_presupuesto);
    $presupuesto=$this->db->get('t_presupuesto');
    if ($presupuesto->num_rows()>0) {
        return $presupuesto;
        }else{
        return false;
        }
    }

#*******************************************************************************
 public function guardar_presupuesto($id_cliente,$fecha,$total){
    $data = array('id_cliente' =>$id_cliente,
                  'total'=>$total,
                  'fecha'=>$fecha);
    $this->db->insert('t_presupuesto', $data);
 }
  public function guardar_det_presupuesto($id_presupuesto, $nombre_producto,$cantidad_web, $precio_neto, $total){
    $data = array('id_presupuesto' =>$id_presupuesto,
                  'descripcion'=>$nombre_producto,
                  'cantidad'=>$cantidad_web,
                  'precio'=>$precio_neto,
                  'total'=>$total);
    $this->db->insert('t_det_presupuesto', $data);
 }
 #******************este es para json-encode************************************
  public function get_det_presupuesto($id_presupuesto){
    $this->db->where('id_presupuesto', $id_presupuesto);
    $det_presupuesto=$this->db->get('t_det_presupuesto');
    if ($det_presupuesto->num_rows()>0) {
        return $det_presupuesto->result();
        }else{
        return false;
        }
    }

    public function eliminar_det_presupuesto($id_det_presupuesto){
    $this->db->where('id', $id_det_presupuesto);
    $this->db->delete('t_det_presupuesto');
    }

    public function eliminar_presupuesto_total_0(){
    $this->db->where('total','0');
    $this->db->delete('t_presupuesto');
    }

    public function sumar_total_det_presupuesto($id_det_presupuesto){
          $this->db->select_sum('total');
          $this->db->where('id_presupuesto',$id_det_presupuesto);
          $query = $this->db->get('t_det_presupuesto');
             if ($query->num_rows() > 0) {
         return $query->row()->total;
    }

  }
  public function actualizar_presupuesto($id_presupuesto,$sub_total, $iva,$total,$observaciones){
    $data = array('num_presupuesto'=>$id_presupuesto,
                  'sub_total' =>$id_presupuesto,
                  'iva'=>$sub_total,
                  'total'=>$iva,
                  'observaciones'=>$observaciones);
    $this->db->where('id',$id_presupuesto);
    $this->db->update('t_presupuesto', $data);
 }
}