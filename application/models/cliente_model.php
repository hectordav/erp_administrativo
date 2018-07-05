<?php
class Cliente_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function get_cliente() {
        $cliente=$this->db->get('t_cliente');
    if ($cliente->num_rows()>0) {
        return $cliente;
        }else{
        return false;
        }
    }
#*******************************************************************************
 

}