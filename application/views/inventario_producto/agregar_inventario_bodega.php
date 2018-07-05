<div class="right_col" role="main" style="height:1040px;">
	<div class="x_panel">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table-label">
						<h4><strong>Agregar Inventario de Producto a Bodega<strong></h4>
					</div>
					<br>
					<div class="form-container table-container">
						<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>inventario_producto/guardar_inventario_bodega" method="POST">
						<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
					<?php foreach ($inventario_producto->result() as $data): ?>
		<input type="hidden" name="id_inventario" id="id_inventario" value="<?=$data->id ?>">

						<h5 ><P ALIGN="RIGHT"><label>Producto:</label></h5 ></P>
						</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
		<input type="hidden" name="id_producto" id="id_producto" value="<?=$data->id_producto ?>">

							<input type="text" name="txt_producto" id="txt_producto" class="form-control" value="<?=$data->producto_nombre?>" readonly>
						</div>
					</div>

<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Bodega:</label></h5 ></P>
					</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<input type="text" name="txt_bodega" id="txt_bodega" class="form-control" value="<?=$data->bodega_nombre?>" readonly>
					</div>
	</div>

	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Existencia:</label></h5 ></P>
					</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
						<input type="text" name="txt_existencia" id="txt_existencia" class="form-control" value="<?=$data->cantidad_inventario?>" readonly>
					  </div>
	</div>
<?php endforeach ?>

	<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Bodega a agregar:</label></h5 ></P>
					</div>
					  <div class="col-md-10 col-sm-10 col-xs-10">
							<select name="id_bodega" id="id_bodega" class="form-control" required >
							<?php if ($bodega): ?>
								<?php foreach ($bodega->result() as $i): ?>
						 <?= '<option value="'. $i->id .'">'.$i->descripcion.'</option>';?>
								<?php endforeach ?>
								<?php else: ?>
									<option value="0">Sin Resultados</option>
							<?php endif ?>
							</select>
					  </div>
	</div>
<!--*****************************************************************************-->
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-2 col-sm-2 col-xs-2">
			<h5 ><P ALIGN="RIGHT"><label>Cantidad:</label></h5 ></P>
			</div>
		  <div class="col-md-10 col-sm-10 col-xs-10">
			<input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control">
			</div>
	</div>
<!--******************los botones***********************-->
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
					</div>
					    <div class="col-md-offset-2 col-md-11">
					      <button type="submit" class="btn btn-info">Guardar</button>
					      <a href="<?php echo $this->config->base_url();?>inventario_producto"><button type="button" class="btn btn-danger">Cancelar</button></a>
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
