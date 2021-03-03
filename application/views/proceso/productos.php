
			<main id="main-container" >
				<div class="content-mini bg-gray-lighter">
					<div class="row push-10">
						<div class="col-sm-6">
							<h1 class="page-heading">
								<?php echo $titulo_text;?>
							</h1>
						</div>
						<div class="col-sm-6 text-right hidden-xs">
							<ol class="breadcrumb push-10-t">
								<li><?php echo $menu_text;?></li>
								<li><a class="link-effect" href="#"><?php echo $submenu_text;?></a></li>
							</ol>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-4">
							<a class="block block-link-hover2 nuevoregistro" href="#" data-toggle="modal" data-target="#registro-modal">
								<div class="block-content block-content-full bg-primary clearfix">
									<i class="si si-tag  fa-2x text-white pull-right"></i>
									<i class="fa fa-plus text-white push-10-r"></i><span class="h4 text-white">Registrar <?php echo $registro_text;?></span>
								</div>
							</a>
						</div>
					</div>
					<div class="block">
						<script type="text/javascript">
							var reportetext='<?php echo $export_text;?>';
						</script>
						<div class="block-header bg-gray-lighter">
							<h3 class="block-title"><?php echo $export_text;?></h3>
						</div>
						<div class="block-content">
							<div class="row options push-5">
								<div class="col-xs-12 col-sm-6">
								</div>
								<div class="col-xs-12 col-sm-3">
								</div>
								<div class="col-xs-12 col-sm-3">
								</div>
							</div>
							<table class="table table-hover" id="table-list">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Categoría</th>
										<th>Precio</th>
										<th>Stock</th>
										<th>Fecha de registro</th>
										<th>Fecha de ult. venta</th>
										<th class="text-center" style="width: 120px;">Acciones</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</main>

			<div class="modal fade" id="registro-modal" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-popout modal-lg">
					<div class="modal-content">
						<div class="block block-themed block-transparent remove-margin-b">
							<div class="block-header bg-primary">
								<ul class="block-options"><li><button data-dismiss="modal" type="button"><i class="si si-close"></i></button></li></ul>
								<h3 class="block-title"><i class="fa fa-plus push-10-r"></i><span>Formulario de <?php echo $registro_text;?></span></h3>
							</div>
							<div class="block-content">
								<form class="form-horizontal push-10-t push-10" method="post" action="" id="registro-form" autocomplete="off">
									<input type="hidden" name="id" value="">
									<input type="hidden" name="table" value="proceso_producto">
									<h3 class="h5 font-w600 text-uppercase push-15"><i class="fa fa-info text-primary push-5-r"></i> Datos generales</h3>
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<input class="form-control required textoinput" type="text" name="nombre">
														<label>Nombre de <?php echo $registro_text;?></label>
														<span class="input-group-addon"><i class="si si-info"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<input class="form-control required textoinput" type="text" name="referencia">
														<label>Referencia</label>
														<span class="input-group-addon"><i class="si si-info"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-3">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<span class="input-group-addon">S/ </span>
														<input class="form-control required digits" type="number" step="1" min="1" name="precio">
														<label>Precio</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<input class="form-control required digits" type="number" step="1" min="1" name="peso">
														<span class="input-group-addon">Kg.</span>
														<label>Peso</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-3">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="form-material form-material-info">
														<select class="form-control required" name="categoria" style="width: 100%;">
															<option value="">Seleccione</option>
															<?php foreach($tipos as $item):?>
															<option value="<?php echo $item['id']; ?>" ><?php echo $item['descripcion']; ?></option>
															<?php endforeach;?>
														</select>
														<label>Categoría de <?php echo $registro_text;?></label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-3">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<input class="form-control required digits" type="number" step="1" min="1" name="stock">
														<span class="input-group-addon">Unid.</span>
														<label>Stock</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-sm-3">
											<div class="form-group">
												<div class="col-xs-12">
													<div class="input-group form-material form-material-info">
														<input class="js-datepicker form-control required" data-date-format="yyyy-mm-dd" type="text" name="fecha_creacion" placeholder="Fecha">
														<label>Fecha de registro</label>
														<span class="input-group-addon"><i class="si si-calendar"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 text-center">
											<a class="btn btn-minw btn-square btn-muted" data-dismiss="modal"><i class="fa fa-times push-5-r"></i> Cerrar</a>
											<button class="btn btn-minw btn-square btn-success" type="submit"><i class="fa fa-plus push-5-r"></i> Registrar</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
