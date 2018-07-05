<?php
class Proveedor_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function get_proveedor() {
        $proveedor=$this->db->get('t_proveedor');
    if ($proveedor->num_rows()>0) {
        return $proveedor;
        }else{
        return false;
        }
    }
#*******************************************************************************
 

}