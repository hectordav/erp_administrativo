<?php
class Corte_model extends CI_Model{
    //put your code here

 #*******************************************************************************
    public function guardar_corte($contar_factura ,$total_factura, $tran_efectivo,$contar_transferencia,$contar_pto_venta,$sumar_efectivo_pago,$sumar_transferencias_pago,$sumar_pto_venta_pago,$fecha_i,$fecha_f) {
    	$data = array(
    			'contar_factura' =>$contar_factura,
    	 		'total_factura' =>$total_factura,
    	 		'tran_efectivo' =>$tran_efectivo,
    	 		'contar_transferencia' =>$contar_transferencia,
    	 		'contar_pto_venta' =>$contar_pto_venta,
    	 		'sumar_efectivo_pago' =>$sumar_efectivo_pago,
    	 		'sumar_transferencias_pago' =>$sumar_transferencias_pago,
    	 		'sumar_pto_venta_pago' => $sumar_pto_venta_pago,
    	 		'fecha_i'=>$fecha_i,
    	 		'fecha_f'=>$fecha_f
    	 		);
    	$this->db->insert('t_corte_x', $data);

    }
#*******************************************************************************
 

}