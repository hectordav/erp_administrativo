<div class="right_col" role="main" style="height:1040px;">
	    	<div class="x_panel">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="table-label">
				<h4><strong>Nota de Venta<strong></h4>
				</div>
			<div class="form-container table-container">
				<form id="form-guardar" class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>nota_venta/guardar_nota_venta" method="POST">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<br>
				<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label>Cliente:</label></h5 ></P>
				</div>
					  <div class="col-md-5 col-sm-5 col-xs-5">
					  <?php foreach ($nota_venta->result() as $data): ?>
							<input type="text" name="txt_cliente" id="txt_cliente" class="form-control" vrequired="required" value="RUT: <?=$data->cliente_ruf ?> Nombre: <?=$data->cliente_nombre ?>" readonly>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-1">
						<h5 ><P ALIGN="RIGHT"><label>Fecha:</label></h5 ></P>
					</div>
					  <div class="col-md-2 col-sm-2 col-xs-2">
					  <?$fecha=date('d-m-Y')?>
						<input type="date" name="dt_fecha" id="dt_fecha" class="form-control" value="<?$fecha?>" required="required">
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label># Nota:</label></h5 ></P>
					</div>
					  <div class="col-md-1 col-sm-1 col-xs-1">
						<input type="text" name="txt_id_nota_venta" id="txt_id_nota_venta" class="form-control" value="<?=$data->id_nota_venta?>" required="required" readonly>
					  <?php endforeach ?>
					</div>
		</div>
<!--**********************************************************************************-->
<div class="col-md-12 col-sm-12 col-xs-12">
<hr>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<h5 ><P ALIGN="RIGHT"><label>Articulo:</label></h5 ></P>
	</div>
	  <div class="col-md-8 col-sm-8 col-xs-8">
	  	<select name="id_producto" id="id_producto" class="form-control selectpicker show-menu-arrow" required data-live-search="true" >
	  <?php if ($inventario_producto): ?>
		<?php foreach ($inventario_producto->result() as $data): ?>
			<option value="<?=$data->id_inventario?>"><?=$data->cod_producto?>,<?=$data->producto_nombre?></option>
		<?php endforeach ?>
	  <?php endif ?>
			</select>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<h5 ><P ALIGN="RIGHT"><label>Cantidad:</label></h5 ></P>
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control"min="{1"} max="" step="">
	</div>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<button class="btn btn-default " onclick="guardar_det_producto()" name="btn_enviar_producto"id="btn_enviar_producto" type="button">Agregar</button>
	</div>
	</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div id="det_nota_venta">
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
<?php foreach ($nota_venta->result() as $data): ?>

  <button type="submit" class="btn btn-primary">Guardar Nota de Venta</button>
  <button type="button" class="btn btn-danger"OnClick="eliminar_nota_venta(this)"value="<?=$data->id_nota_venta?>">Cancelar</button></P>
 </div>
<?php endforeach ?>
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
