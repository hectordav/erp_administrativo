<div class="right_col" role="main" style="height:1040px;">
	    	<div class="x_panel">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="table-label">
				<h4><strong>Agregar Modelo<strong></h4>
				</div>
			<div class="form-container table-container">
				<form class="form-horizontal" role="form" action="<?php echo $this->config->base_url();?>modelo/guardar_modelo" method="POST">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
						<h5 ><P ALIGN="RIGHT"><label>Tipo:</label></h5 ></P>
						</div>
					  <div class="col-md-8 col-sm-8 col-xs-8">
							<select class="form-control" name="id_tipo" id="id_tipo" data-show-subtext="true" data-live-search="true" required style='width:500px;'>
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
					  <div class="col-md-8 col-sm-8 col-xs-8">
							<select name="id_marca" id="id_marca" class="form-control" required style='width:500px;'>
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
							<input type="text" name="txt_modelo" id="txt_modelo" class="form-control">
						</div>
					</div>
<!--******************los botones***********************-->
					  <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2 col-sm-2 col-xs-2">
					</div>
					    <div class="col-md-offset-2 col-md-11">
					      <button type="submit" class="btn btn-info">Guardar</button>
					      <a href="<?php echo $this->config->base_url();?>modelo"><button type="button" class="btn btn-danger">Cancelar</button></a>
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
