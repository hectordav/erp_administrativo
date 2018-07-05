<div class="modal fade "id="mcorte">
		        <div class="modal-dialog">
		          <div class="modal-content">
		            <div class="modal-header">
		             <a href="<?= $this->config->base_url();?>compra">
		              <button type="button" class="close" aria-hidden="true">&times;</button></a>
		               <strong><h3><span class ="label label-warning">Balance</span></h3></strong>
		            </div> <!-- termina el header -->
					<div class="container">
						<div class="row">
	<form action="<?php echo $this->config->base_url();?>corte_x/add_corte" method="POST" accept-charset="utf-8">
	<br>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
   			<P ALIGN="RIGHT"> <label>F. Inicio:</label></P>
   	</div>
		<div class="col-md-10 col-sm-10 col-xs-10">
		   <input type="date" name="dt_fecha_i" id="dt_fecha_i" class="form-control" value="" required="required" title="">
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
	<p></p>
	<div class="col-md-2 col-sm-2 col-xs-2">
   			<P ALIGN="RIGHT"> <label>Fecha Fin:</label></P>
   	</div>
		<div class="col-md-10 col-sm-10 col-xs-10">
		   <input type="date" name="dt_fecha_f" id="dt_fecha_f" class="form-control" value="" required="required" title="">
		</div>
	</div>
			</div>
			</div>
					<br>
		            <div class="modal-footer">
		            	<left><button type="submit" class="btn btn-primary"><strong><i class="fa fa-plus-circle"></i>&nbsp; Balance</strong></button></left>
		            	</form>
		            </div>
		          </div><!-- termina el content -->
		        </div> <!-- termina el modal dialog -->
		    </div> <!-- termina la ventana modal -->