<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<h4><strong>Agregar Producto<strong></h4>
					</div>
					<div class="form-container table-container">
						<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>producto/guardar_producto" method="POST">
						<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Tipo:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<select class="form-control" name="id_tipo" id="id_tipo" data-show-subtext="true" data-live-search="true" required >
										<option value="">Seleccione</option>
										 <?php
										 if ($tipo) {
										 foreach ($tipo as $i) {
								         echo '<option value="'. $i->id .'">'.$i->descripcion.'</option>';
								            }
										 }else{
										 }
								        ?>
							</select>
						</div>
					</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Marca:</label></h5 ></P>
					</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<select name="id_marca" id="id_marca" class="form-control" required >
							<option value=""></option>
							</select>
					</div>
	</div>
	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Modelo:</label></h5 ></P>
					</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<select name="id_modelo" id="id_modelo" class="form-control" required >
							<option value=""></option>
							</select>
					</div>
	</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
			<h5 ><P ALIGN="RIGHT"><label>Cod Producto:</label></h5 ></P>
			</div>
		  <div class="col-md-10 col-sm-10 col-xs-10">
			<input type="text" name="txt_cod_producto" id="txt_cod_producto" class="form-control">
			</div>
	</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
			<h5 ><P ALIGN="RIGHT"><label>Producto:</label></h5 ></P>
			</div>
		  <div class="col-md-10 col-sm-10 col-xs-10">
			<input type="text" name="txt_producto" id="txt_producto" class="form-control">
			</div>
	</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>P. Compra:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input type="number" name="txt_p_compra" id="txt_p_compra" class="form-control">
						</div>
	</div>
	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Ganancia (%):</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input onkeyup="fncSumar();" type="number" name="txt_ganancia" id="txt_ganancia" class="form-control">
						</div>
	</div>
	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>P. Neto:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input type="number" name="txt_precio_neto" id="txt_precio_neto" class="form-control" readonly>
						</div>
	</div>
		<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Iva:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input type="number" name="txt_iva" id="txt_iva" class="form-control" readonly>
						</div>
	</div>
	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>P.V.P:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input type="number" name="txt_pvp" id="txt_pvp" class="form-control" readonly>
						</div>
	</div>
	<?php foreach ($iva->result() as $data): ?>
	<input type="hidden" name="txt_valor_iva" id="txt_valor_iva" value="<?=$data->iva ?>">

	<?php endforeach ?>

<!--******************los botones***********************-->
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
					</div>
					    <div class="col-md-offset-2 col-md-11">
					      <button type="submit" class="btn btn-info">Guardar</button>
					      <a href="<?php echo $this->config->base_url();?>producto"><button type="button" class="btn btn-danger">Cancelar</button></a>
						</form>
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
