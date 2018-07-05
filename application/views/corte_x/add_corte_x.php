<div class="right_col" role="main" style="height:1040px;">
<div class="x_panel">
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="table-label">
				<h4><strong>Balance entre Fechas: Desde <?=$fecha_i?> Hasta <?=$fecha_f?><strong></h4>
			</div>
			  <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
			  <hr>
<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>corte_x/guardar_corte" method="POST">
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Numero de Facturas :</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
						<?php if ($contar_factura): ?>
								<label><?=$contar_factura?></label>
								<input type="hidden" name="txt_contar_factura" value="<?=$contar_factura?>">
						<?php else: ?>
								<label>0</label>
									<input type="hidden" name="txt_contar_factura" value="0">
						<?php endif ?>

						</div>
			  </div>
			  <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Totales Facturas:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
						<?php if ($total_factura): ?>
							<label><?=$total_factura?></label>
							<input type="hidden" name="txt_total_factura" value="<?=$total_factura?>">
						<?php else: ?>
								<label>0</label>
									<input type="hidden" name="txt_tran_efectivo" value="0">
						<?php endif ?>

						</div>
			  </div>
			  <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Facturas en Efectivo:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
						<?php if ($tran_efectivo): ?>
							<label><?=$tran_efectivo?></label>
							<input type="hidden" name="txt_tran_efectivo" value="<?=$tran_efectivo?>">
						<?php else: ?>
								<label>0</label>
									<input type="hidden" name="txt_tran_efectivo" value="0">
						<?php endif ?>

						</div>
			  </div>
			  <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Facturas en Transferencia:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<?php if ($contar_transferencia): ?>
								<label><?=$contar_transferencia?></label>
								<input type="hidden" name="txt_contar_transferencia" value="<?=$contar_transferencia?>">
								<?php else: ?>
										<label>0</label>
										<input type="hidden" name="txt_contar_transferencia" value="0">
								<?php endif ?>

						</div>
			  </div>
			   <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Facturas en Pto Venta:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
						<?php if ($contar_pto_venta): ?>
							<label><?=$contar_pto_venta?></label>
<input type="hidden" name="txt_contar_pto_venta" value="<?=$contar_pto_venta?>">
								<?php else: ?>
										<label>0</label>

<input type="hidden" name="txt_contar_pto_venta" value="0">
								<?php endif ?>

						</div>
			  </div>
			   <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Total Efectivo:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<?php if ($sumar_efectivo_pago): ?>

<input type="hidden" name="txt_sumar_efectivo_pago" value="<?=$sumar_efectivo_pago?>">
								<label><?=$sumar_efectivo_pago?></label>
									<?php else: ?>
										<label>0</label>
<input type="hidden" name="txt_sumar_efectivo_pago" value="0">

								<?php endif ?>

						</div>
			  </div>
			   <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Total Transferencias:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<?php if ($sumar_transferencias_pago): ?>

<input type="hidden" name="txt_sumar_transferencias_pago" value="<?=$sumar_transferencias_pago?>">
									<label><?=$sumar_transferencias_pago?></label>
									<?php else: ?>
										<label>0</label>
<input type="hidden" name="txt_sumar_transferencias_pago" value="0">
								<?php endif ?>
						</div>
			  </div>
			  <div class="col-md-12 col-sm-12 col-xs-12">
			  <p></p>
						<div class="col-md-3 col-sm-3 col-xs-3">
						<P ALIGN="RIGHT"><label>Total Pto de Venta:</label></P>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<?php if ($sumar_pto_venta_pago): ?>
									<label><?=$sumar_pto_venta_pago?></label>
								<?php else: ?>
										<label>0</label>
<input type="hidden" name="txt_sumar_pto_venta_pago" value="0">
								<?php endif ?>

						</div>
			  </div>
<input type="hidden" name="txt_fecha_i" value="<?=$fecha_i?>">
<input type="hidden" name="txt_fecha_f" value="<?=$fecha_f?>">
<!--******************los botones***********************-->
			  <div class="col-md-12 col-sm-12 col-xs-12">

			<div class="col-md-2 col-sm-2 col-xs-2">
			</div>
			<hr>
			    <div class="col-md-offset-2 col-md-11">
			      <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o"></i>&nbsp;Guardar Balance</button>
			      <a href="<?php echo $this->config->base_url();?>corte_x"><button type="button" class="btn btn-danger">Cancelar</button></a>
				</form>
			    </div>
			  </div>

	</div>
	<br>
	<br>
</div>
</div>
</div>
</div>
  	</div>
</div>
