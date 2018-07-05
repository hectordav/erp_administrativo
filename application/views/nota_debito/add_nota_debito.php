<div class="right_col" role="main" style="height:1040px;">
	    	<div class="x_panel">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="table-label">
				<h4><strong>Nota de Debito<strong></h4>
				</div>
			<div class="form-container table-container">
				<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>nota_debito/guardar_nota_debito" method="POST">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<br>
				<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label>Cliente:</label></h5 ></P>
				</div>
					  <div class="col-md-4 col-sm-4 col-xs-4">
					  <?php foreach ($factura->result() as $data): ?>
							<input type="text" name="txt_cliente" id="txt_cliente" class="form-control" vrequired="required" value="RUT: <?=$data->cliente_ruf ?> Nombre: <?=$data->cliente_nombre ?>" readonly>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label>Fecha:</label></h5 ></P>
					</div>
					  <div class="col-md-2 col-sm-2 col-xs-2">
					  <?$fecha=date('d-m-Y')?>
						<input type="text" name="dt_fecha" id="dt_fecha" class="form-control" value="<?=$fecha?>" required="required" readonly>
					</div>
					<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label># Fact:</label></h5 ></P>
					</div>
					  <div class="col-md-1 col-sm-1 col-xs-1">
						<input type="text" name="txt_id_factura" id="txt_id_factura" class="form-control" value="<?=$data->id_factura?>" required="required" readonly></div>
					<?php endforeach ?>
					<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label># NC:</label></h5 ></P>
					</div>
					  <div class="col-md-1 col-sm-1 col-xs-1">
						<input type="text" name="txt_id_nota_debito" id="txt_id_nota_debito" class="form-control" value="<?=$id_nota_debito_2?>" required="required" readonly></div>
		</div>
<!--**********************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
<hr>
	<div class="col-md-10 col-sm-10 col-xs-10">
	<div class="alert alert-success animated bounceInDown">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle h4">
  <strong></i></strong> &nbsp;Haga clic en Cargar Articulos, a continuacion ELIMINE los articulos que NO estarán en esta Nota de debito
</div>
	</div>
	<div class="col-md-2 col-sm-2 col-xs-2">
	<br>
		<button class="btn btn-success " onclick="mostrardatos()" name="btn_enviar_producto"id="btn_enviar_producto" type="button">Cargar Articulos</button>
	</div>
	</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div id="det_nota_credito">
<hr>
<table class="table table-condensed table-bordered table-hover">
	<thead>
		<tr>
			<th class="info"><h5><strong>Articulo</strong></h5></th>
			<th class="info"><h5><strong>Cantidad</strong></h5></th>
			<th class="info"><h5><strong>P. Unitario</strong></h5></th>
			<th class="info"><h5><strong>Total</strong></h5></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
</div>
</div>
<?php foreach ($valor_iva->result() as $data): ?>
<input type="hidden" id="valor_iva"name="valor_iva" value="<?=$data->iva?>">
<?php endforeach ?>
 <div class="col-md-12 col-sm-12 col-xs-12">
 <hr>
 <div class="col-md-8 col-sm-8 col-xs-8">
  <label>Observaciones:</label>
  <textarea name="txt_observaciones" id="txt_observaciones" class="form-control" rows="2" required="required"></textarea>
   <p></p>
   <P ALIGN="RIGHT">
<?php foreach ($factura->result() as $data): ?>
  <button type="submit" class="btn btn-primary">Guardar Nota de Debito</button>
  <button type="button" class="btn btn-danger"OnClick="eliminar_nota_debito_salir(this)"value="<?=$id_nota_debito_2?>">Cancelar</button></P>
 </div>
 <div class="col-md-4 col-sm-4 col-xs-4">
<table class="table table-condensed table-bordered ">
	<thead>
		<tr>
			<th class="info col-md-2"><h5>Sub Total</h5></th>
			<th  class="col-md-1"><h5 ><div id="sub_total">0</div></h5></th>
		</tr>
		<tr>
			<th class="info col-md-2"><h5>Iva</h5></th>
			<th  class="col-md-1"><h5 ><div id="iva">0</h5></th>
		</tr>
		<tr>
			<th class="info col-md-2"><h5>Total</h5></th>
			<th  class="col-md-1"><h5 ><div id="total">0</h5></th>
		<?php endforeach ?>
			<input type="hidden" id="txt_sub_total"name="txt_sub_total" value="">
			<input type="hidden" id="txt_iva" name="txt_iva" value="">
			<input type="hidden" id="txt_total" name="txt_total" value="">
		</tr>
	</thead>
</table>
</div>
</div>
<!--******************los botones***********************-->
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
					</div>
					   <div class="col-md-10 col-sm-10 col-xs-10">
						</form> <!--final del form-->
					    </div>
					  </div>
			</div>
			<br>
		</div>
	</div>
  </div>
 </div>
	    	</div>
</div>
