		<script src="<?php echo base_url();?>public/js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-datetimepicker/moment.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-datetimepicker/locale/es.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/select2/select2.full.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/jquery-validation/jquery.validate.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/jquery-validation/additional-methods.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/jszip.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/pdfmake.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/vfs_fonts.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/buttons.html5.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/buttons.print.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/datatables_ini.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/datatables/dataTables.checkboxes.min.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/jquery-blockui/jquery.blockUI.js"></script>
		<script src="<?php echo base_url();?>public/js/plugins/jquery-confirm/jquery-confirm.min.js"></script>
		<script>
			jQuery(function () {
				App.initHelpers(['slick','datepicker','datetimepicker','maxlength', 'select2', 'slimscroll','notify','table-tools']);
			});
			var base_server ='<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";?>';
			var base_url ='<?php echo base_url();?>';
			var ajax_timeout ='<?php echo $this->config->item('ajax_timeout');?>';
		</script>
		<script type="text/javascript">
			/***Funciones generales***/
				function blockpage(mensaje) {
					jQuery.blockUI({ 
						css: { 
							border: 'none', 
							padding: '15px', 
							backgroundColor: '#000', 
							'-webkit-border-radius': '10px', 
							'-moz-border-radius': '10px', 
							opacity: 1, 
							color: '#fff',
						},
						baseZ: 2000, 
						message: mensaje
					});
				}	
				
				function reiniciarform(idform, formvalidate, url, botonhtml) {
					jQuery(idform)[0].reset();
					jQuery(idform).find('.form-group').removeClass('has-error');
					jQuery(idform).find('.select2').val('').trigger("change");
					if(formvalidate==''){}else{ formvalidate.resetForm(); }
					jQuery(idform).attr("action", base_url + url);
					jQuery(idform+' button[type="submit"]').html(botonhtml);
				}

				function notifytemplate(icon, message, type,delay=2000) {
					jQuery.notify({
						icon: icon,
						message: message
						},{
						element: 'body',
						type: type,
						allow_dismiss: true,
						newest_on_top: true,
						showProgressbar: false,
						mouse_over: 'pause',
						offset: 20,
						spacing: 10,
						z_index: 1051,
						delay: delay,
						animate: {
							enter: 'animated fadeIn',
							exit: 'animated fadeOutDown'
						}
					});
				}

				function datatabletemplate(idtable,lengthChange=true) {
					var tabletemp =jQuery(idtable).DataTable({
						buttons: false,
						columnDefs: [ { orderable: false, targets: [-1]} ],
						order: [],
						lengthChange: lengthChange,
						pageLength: 10,
						lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
						bAutoWidth: false
					});
					return tabletemp;
				}

			/***Funciones generales***/

			jQuery(function () {
			
				/*****Generales********/
					var width = $(window).width();

					jQuery('form').on('keyup keypress', function(e) {
						var keyCode = e.keyCode || e.which;
						if (keyCode === 13) { 
							e.preventDefault();
							return false;
						}
					});

					jQuery('body').on('focusout', '.validarfixed', function() {
						if(jQuery(this).val()!=''){
							var numero = parseFloat(jQuery(this).val()) || 0;
							jQuery(this).val(numero.toFixed(3));
						}
					});

					if(width <769){
						if (jQuery('select.select2').data('select2')) {	jQuery('select.select2').select2("destroy");}
					}else{
						jQuery('select.select2').select2();
						jQuery('body').tooltip({
							selector: '[data-toggle=tooltip]',
							trigger: "hover",
							animation: true,
							html: true,
							container: 'body'
						});
					}

					jQuery.fn.modal.Constructor.prototype.enforceFocus = function() {};
					jQuery.fn.select2.amd.require(["select2/dropdown/attachBody", "select2/utils"], function(AttachBody, Utils){
						AttachBody.prototype._attachPositioningHandler = function (decorated, container) {
							var self = this;
							var scrollEvent = "scroll.select2." + container.id;
							var resizeEvent = "resize.select2." + container.id;
							var orientationEvent = "orientationchange.select2." + container.id;
							var $watchers = this.$container.parents().filter(Utils.hasScroll);
							$watchers.each(function () {
								$(this).data("select2-scroll-position", {
									x: $(this).scrollLeft(),
									y: $(this).scrollTop()
								});
							});
							$watchers.on(scrollEvent, function (ev) {
								var position = $(this).data("select2-scroll-position");
								$(self).scrollTop(position.y); // patch: this => self
							});
							$(window).on(scrollEvent + " " + resizeEvent + " " + orientationEvent,
								function (e) {
									self._positionDropdown();
									self._resizeDropdown();
								}
							);
						};
					});

					jQuery('.js-select2-filtro, .select2').on('change', function (evt) {
						jQuery('.select2-selection__rendered').removeAttr('title');
					});
				/*****Generales********/

				/***Validate***/
					jQuery.validator.setDefaults({
						ignore: "",
						errorClass: 'help-block text-right animated fadeInDown',
						errorElement: 'div',
						errorPlacement: function(error, e) {
							jQuery(e).parents('.form-group > div').append(error);
						},
						highlight: function(e) {
							var elem = jQuery(e);
							elem.closest('.form-group').removeClass('has-error').addClass('has-error');
							elem.closest('.help-block').remove();
						},
						success: function(e) {
							var elem = jQuery(e);
							elem.closest('.form-group').removeClass('has-error');
							elem.closest('.help-block').remove();
						}
					});

					jQuery.validator.addClassRules('required', {
						required: true
					});
					jQuery.validator.addClassRules('email', {
						email: true
					});
					jQuery.validator.addClassRules('textoinput', {
						minlength: 2,
						maxlength: 255
					});
					jQuery.validator.addClassRules('textoinputcorta', {
						maxlength: 2
					});
					jQuery.validator.addClassRules('textoareainput', {
						maxlength: 1000,
					});
					jQuery.validator.addClassRules('digits', {
						digits: true
					});
					jQuery.validator.addClassRules('number', {
						number: true
					});
					jQuery.extend(jQuery.validator.messages, {
						required: jQuery.validator.format("Obligatorio"),
						equalTo: jQuery.validator.format("Campo diferente a {0}"),
						minlength: jQuery.validator.format("Mínimo {0} caracteres"),
						maxlength: jQuery.validator.format("Máximo {0} caracteres"),
						digits: jQuery.validator.format("Solo dígitos"),
						email: jQuery.validator.format("Correo inválido"),
						number: jQuery.validator.format("Número inválido"),
						min: jQuery.validator.format("Mínimo: {0}"),
						max: jQuery.validator.format("Máximo: {0} ")
					});

					jQuery("select").on("select2:close", function (e) {  
						if($(this).valid()) $(this).parents('.form-group').removeClass('has-error');
					});
				/***Validate***/

				/***AJAX***/
					jQuery( document ).ajaxStart(function() {
						blockpage('<h1><i class="fa fa-cog fa-spin fa-fw"></i> Procesando</h1>');
					});
					jQuery( document ).ajaxError(function(event, jqxhr, settings, thrownError) {
						console.log(jqxhr.status+' - '+jqxhr.statusText+': '+settings.type+' "'+settings.url+'".');
						jQuery.unblockUI();
						notifytemplate('fa fa-times', 'Sin conexión', 'danger');
					});
					jQuery( document ).ajaxSuccess(function() {
						jQuery.unblockUI();
					});
				/***AJAX***/
			});
		</script>
		<?php foreach ($funciones as $item) { ?>
		<script src="<?php echo base_url();?>public/js/pages/<?php echo $item;?>.js?v<?php echo rand();?>"></script>
		<?php }?>
	</body>
</html>