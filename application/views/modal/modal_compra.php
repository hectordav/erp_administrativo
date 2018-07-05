<div class="modal fade "id="mcompra">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		             <a href="<?= $this->config->base_url();?>compra">
		              <button type="button" class="close" aria-hidden="true">&times;</button></a>
		               <strong><h3><span class ="label label-warning">Nuevo Registro de compra:</span></h3></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
	<form action="<?php echo $this->config->base_url();?>compra/add_compra" method="POST" accept-charset="utf-8">
	<br>
		<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
   			<P ALIGN="RIGHT"> <label>Proveedor:</label></P>
   		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
		   <select class="selectpicker form-control" data-live-search="true" id="cb_id_cliente" name="cb_id_cliente"style="width:10px" required>
				  <?php if ($proveedor): ?>
					  <?php foreach ($proveedor->result() as $data): ?>
						<option data-tokens="<?= $data->ruf.", ".$data->nombre?>" value="<?= $data->id ?>"><?= $data->ruf.", ".$data->nombre ?></option>
					  <?php endforeach ?>
					<?php else: echo "no hay Resultados"?>
				  <?php endif ?>
		</select>
		</div>
		<div class="col-md-1 col-sm-1 col-xs-1">
			<a class="btn btn-success btn-sm" href="<?= $this->config->base_url();?>proveedor/cargar_grilla/add"><i class="fa fa-plus"></i> &nbsp; Añadir Proveedor</a>
		</div>

	</div>
			</div>
			</div>
					<br>
		            <div class="modal-footer">
		            	<left><button type="submit" class="btn btn-primary"><strong><i class="fa fa-plus-circle"></i>&nbsp; Crear Compra</strong></button></left>
		            	</form>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->