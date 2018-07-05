<div class="modal fade bs-example-modal-lg "id="mnotacredito">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		<a href="<?= $this->config->base_url();?>nota_credito">
		              <button type="button" class="close" aria-hidden="true">&times;</button></a>
		               <strong><h3><span class ="label label-warning">Nueva Nota de Credito</span></h3></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
	<form action="<?php echo $this->config->base_url();?>nota_credito/add_nota_credito" method="POST" accept-charset="utf-8">
	<br>
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
   			<P ALIGN="RIGHT"> <label>Factura:</label></P>
   		</div>
		<div class="col-md-9 col-sm-9 col-xs-9">
		   <select class="selectpicker form-control" data-live-search="true" id="cb_id_factura" name="cb_id_factura"style="width:10px" required>
				  <?php if ($factura): ?>
					  <?php foreach ($factura->result() as $data): ?>
						<option data-tokens="<?= $data->id_factura.", ".$data->cliente_ruf.",".$data->cliente_nombre?>" value="<?= $data->id_factura ?>"># Factura: <?= $data->id_factura.", Ruf: ".$data->cliente_ruf.", Cliente:".$data->cliente_nombre?></option>
					  <?php endforeach ?>
					<?php else: echo "no hay Resultados"?>
				  <?php endif ?>
		</select>
		</div>


	</div>
			</div>
			</div>
					<br>
		            <div class="modal-footer">
		            	<left><button type="submit" class="btn btn-primary"><strong><i class="fa fa-plus-circle"></i></i>&nbsp; Crear Nota de Credito</strong></button></left>
		            	</form>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->