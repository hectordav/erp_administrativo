<div class="modal fade "id="mpagofactura">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <strong><h3><span class ="label label-warning">Procesar Factura</span></h3></strong>
          </div> <!-- termina el header -->
		<div class="container">
			<div class="row">
<form action="<?php echo $this->config->base_url();?>factura/guardar_factura" method="POST" accept-charset="utf-8">
<p></p>
	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2">
			<?php foreach ($factura->result() as $data): ?>
			<input type="hidden" name="txt_id_factura" id="txt_id_factura" class="form-control" value="<?= $data->id_factura?>" required="required" pattern="" title="">
			<?php endforeach ?>
	   			<P ALIGN="RIGHT"> <label>T. de Pago</label></P>
	   	</div>
			<div class="col-md-9 col-sm-9 col-xs-9">
			  <p><select class="selectpicker form-control" data-live-search="true" id="cb_id_tipo_pago" name="cb_id_tipo_pago"style="width:10px" required>
			  <?php if ($tipo_pago): ?>
				  <?php foreach ($tipo_pago->result() as $data): ?>
					<option data-tokens="<?=$data->descripcion?>" value="<?= $data->id ?>"><?=$data->descripcion ?></option>
				  <?php endforeach ?>
				<?php else: echo "no hay Resultados"?>
			  <?php endif ?>
				</select></p>
			</div>
		</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2">
	   			<P ALIGN="RIGHT"> <label>Total:</label></P>
	   	</div>
			<div class="col-md-9 col-sm-9 col-xs-9">
			  <p><input type="text" name="txt_total_2" id="txt_total_2" class="form-control" value="" required="required" readonly=""></p>
			  <input type="hidden" name="txt_sub_total_2" id="txt_sub_total_2" class="form-control" value="" required="required">
			  <input type="hidden" name="txt_iva_2" id="txt_iva_2" class="form-control" value="" required>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2">
	   			<P ALIGN="RIGHT"><label># Ref:</label></P>
	   	</div>
			<div class="col-md-9 col-sm-9 col-xs-9">
			<p>
			<input type="text" name="txt_referencia" id="txt_referencia" class="form-control" value="">
			</p>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-2 col-sm-2 col-xs-2">
	   			<P ALIGN="RIGHT"><label>Fecha:</label></P>
	   	</div>
			<div class="col-md-9 col-sm-9 col-xs-9">
			  <?$fecha=date('d-m-Y')?>
						<input type="date" name="dt_fecha" id="dt_fecha" class="form-control" value="<?$fecha?>" required="required">
			</div>
		</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			<p></p>
		<div class="col-md-2 col-sm-2 col-xs-2">
	  <label>Observaciones:</label>
	  </div>
	  <div class="col-md-9 col-sm-9 col-xs-9">
	  <textarea name="txt_observaciones" id="txt_observaciones" class="form-control" rows="2" required="required"></textarea>
	  </div></div>
	  </div>
<br>
          <div class="modal-footer">
          	<left><button type="submit" class="btn btn-primary"><strong><i class="fa fa-floppy-o"></i>&nbsp;Procesar</strong></button></left>
          	</form>
          </div>
        </div><!-- termina el content -->
      </div> <!-- termina el modal dialog -->
  </div> <!-- termina la ventana modal -->