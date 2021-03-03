
jQuery(function () {
	
	var registromodal= '#registro-modal';
	var registroform= '#registro-form';
	var nuevoregistro= '.nuevoregistro';
	var editarregistro= '.editarregistro';
	var detalleregistro= '.detalleregistro';
	var eliminarregistro= '.eliminarregistro';
	var nuevaventa= '.nuevaventa';
	var tablelist= '#table-list';

	jQuery('body').on('click', nuevoregistro, function() {
		reiniciarform(registroform,registrovalidate,'generico/nuevoregistro','<i class="fa fa-plus push-5-r"></i> Registrar');
		jQuery(registroform+' [name="id"]').val(null);
		jQuery(registroform+' [name="nombre"]').prop('disabled',false);
		jQuery(registroform+' [name="referencia"]').prop('disabled',false);
		jQuery(registroform+' [name="precio"]').prop('disabled',false);
		jQuery(registroform+' [name="peso"]').prop('disabled',false);
		jQuery(registroform+' [name="categoria"]').prop('disabled',false);
		jQuery(registroform+' [name="stock"]').prop('disabled',false);
		jQuery(registroform+' [name="fecha_creacion"]').prop('disabled',false);
		jQuery(registroform+' [type=submit]').show();
	});

	jQuery('body').on('click', detalleregistro, function() {
		jQuery.ajax({
			type: "POST",
			url: base_url + "generico/detalleregistro",
			data: 'table=' + jQuery(this).data('table') + '&id=' + jQuery(this).data('id'),
			dataType: 'json',
			timeout: 60000,
			success: function(response) {
				if(response.estado=='500'){
					notifytemplate('fa fa-times', response.msg, 'danger');
				}
				if(response.estado=='200'){
					reiniciarform(registroform,registrovalidate,'','');
					jQuery.each(response.registro, function(index, item) {
						if(jQuery(registroform+' [name='+index+']').length>0){
							jQuery(registroform+' [name='+index+']').val(item).prop('disabled',true);
						}
					});
					jQuery(registroform+' [type=submit]').hide();
					jQuery(registromodal).modal('toggle');
				}
			}
		});
	});

	jQuery('body').on('click', editarregistro, function() {
		jQuery.ajax({
			type: "POST",
			url: base_url + "generico/detalleregistro",
			data: 'table=' + jQuery(this).data('table') + '&id=' + jQuery(this).data('id'),
			dataType: 'json',
			timeout: 60000,
			success: function(response) {
				if(response.estado=='500'){
					notifytemplate('fa fa-times', response.msg, 'danger');
				}
				if(response.estado=='200'){
					reiniciarform(registroform,registrovalidate,'generico/actualizarregistro','<i class="fa fa-edit push-5-r"></i> Editar');
					jQuery.each(response.registro, function(index, item) {
						if(jQuery(registroform+' [name='+index+']').length>0){
							jQuery(registroform+' [name='+index+']').val(item).prop('disabled',false);
						}
					});
					jQuery(registroform+' [type=submit]').show();
					jQuery(registromodal).modal('toggle');
				}
			}
		});
	});

	jQuery('body').on('click', eliminarregistro, function() {
		var elemento = jQuery(this);
		jQuery.confirm({
			icon: 'fa fa-warning',
			title: 'Advertencia',
			content: '¿Eliminar registro?',
			type: 'red',
			closeIcon: true,
			draggable: false,
			buttons: {
				cancel: {
					btnClass: 'btn-muted',
					text: 'Cancelar'
				},
				success: {
					btnClass: 'btn-green',
					text: 'Confimar',
					action: function(){
						jQuery.ajax({
							type: "POST",
							url: base_url + "generico/eliminarregistro",
							data: 'table=' + elemento.data('table') + '&id=' + elemento.data('id'),
							dataType: 'json',
							timeout: 60000,
							success: function(response) {
								if(response.estado=='500'){
									notifytemplate('fa fa-times', response.msg, 'danger');
								}
								if(response.estado=='201'){
									notifytemplate('fa fa-check', 'Registro eliminado', 'success');
									listdt.ajax.reload();
								}
							}
						});
					}
				}
			}
		});
	});

	jQuery('body').on('click', nuevaventa, function() {
		var elemento = jQuery(this);
		jQuery.confirm({
			icon: 'fa fa-check',
			title: 'Aviso',
			content: '¿Realizar venta?',
			type: 'green',
			closeIcon: true,
			draggable: false,
			buttons: {
				cancel: {
					btnClass: 'btn-muted',
					text: 'Cancelar'
				},
				success: {
					btnClass: 'btn-green',
					text: 'Confimar',
					action: function(){
						jQuery.ajax({
							type: "POST",
							url: base_url + "generico/nuevoregistro",
							data: 'table=' + elemento.data('table') + '&id=' + elemento.data('id'),
							dataType: 'json',
							timeout: 60000,
							success: function(response) {
								if(response.estado=='500'){
									notifytemplate('fa fa-times', response.msg, 'danger');
								}
								if(response.estado=='200'){
									notifytemplate('fa fa-check', 'Venta registrada', 'success');
									listdt.ajax.reload();
								}
							}
						});
					}
				}
			}
		});
	});

	var listdt = jQuery(tablelist).DataTable({
		ajax: {
			type: 'POST',
			url: base_url+'generico/listado/',
			timeout: ajax_timeout,
			data: {
				table: 'proceso_producto',
				estado: '^5',
			},
			dataSrc: function ( json ) {
				switch (json.estado) {
					case 200:
						for ( var i=0, ien=json.data.length ; i<ien ; i++ ) {
							json.data[i]['acciones']='<div class="btn-group">'+
																'    <button class="btn btn-xs btn-info detalleregistro" data-toggle="tooltip" data-placement="top" title="Ver" data-id="'+json.data[i]['id']+'" data-table="proceso_producto">'+
																'        <i class="fa fa-bars"></i>'+
																'    </button>'+
																'    <button class="btn btn-xs btn-success editarregistro" data-toggle="tooltip" data-placement="top" title="Actualizar" data-id="'+json.data[i]['id']+'" data-table="proceso_producto">'+
																'        <i class="fa fa-edit"></i>'+
																'    </button>'+
																'    <button class="btn btn-xs btn-warning nuevaventa" data-toggle="tooltip" data-placement="top" title="Venta del producto" data-id="'+json.data[i]['id']+'" data-table="proceso_venta">'+
																'        <i class="si si-basket"></i>'+
																'    </button>'+
																'    <button class="btn btn-xs btn-danger eliminarregistro" data-toggle="tooltip" data-placement="top" title="Borrar" data-id="'+json.data[i]['id']+'" data-table="proceso_producto">'+
																'        <i class="fa fa-times"></i>'+
																'    </button>'+
																'</div>';							
							json.data[i]['preciostr']='S/ '+json.data[i]['precio'];
						}
						return json.data;
						break;
					case 500:
						notifytemplate('fa fa-times', json.msg, 'danger');
						return [];
						break;
					default:
						return [];
						break;
				}
			}
		},
		columns: [
			{ data: 'id' },
			{ data: 'nombre' },
			{ data: 'tipodesc' },
			{ data: 'preciostr' },
			{ data: 'stock' },
			{ data: 'fecha_creacion' },
			{ data: 'fecha_ultima_venta' },
			{ data: 'acciones' },
		],
		columnDefs: [
			{
				targets: [-2,-1],
				className: 'dt-body-center'
			},
		],
		buttons: false,
		order: [[ 0, "desc" ]],
		bAutoWidth: false,
	});	

	var registrovalidate = jQuery(registroform).validate({
		submitHandler: function(form) {
			event.preventDefault();
			jQuery.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				dataType: 'json',
				timeout: 60000,
				success: function(response) {
					if(response.estado=='500'){
						notifytemplate('fa fa-times', response.msg, 'danger');
					}
					if(response.estado=='200'){
						notifytemplate('fa fa-check', 'Registro correcto', 'success');
						listdt.ajax.reload();
						jQuery(registromodal).modal('toggle');
					}
					if(response.estado=='201'){
						notifytemplate('fa fa-check', 'Registro actualizado', 'success');
						listdt.ajax.reload();
						jQuery(registromodal).modal('toggle');
					}
				}
			});
		}
	});

});