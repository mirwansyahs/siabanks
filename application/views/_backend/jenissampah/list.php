<?=@$this->session->flashdata("msg")?>

	<div class="col-xs-12">
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			<?=@$judul?>
		</div>
		<table id="dynamic-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="5%" class="center">#</th>
					<th>Nama</th>
					<th width="10%">Harga (Rp/)</th>
					<th width="10%">Contoh</th>
					<th width="10%" class="center">
						<a class="blue" data-toggle="modal" data-target="#add" >
							<i class="ace-icon fa fa-plus-square bigger-130"></i>
						</a>

						<a class="red" href="<?=base_url()?>Redaktur/Jenis/deleteall">
							<i class="ace-icon fa fa-trash bigger-130"></i>
						</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($data as $key) {  ?>
				<tr>
					<td class="center"><?=$no++?></td>
					<td><?=$key->nama_jenis?></td>
					<td><?=$key->harga?></td>
					<td><?=($key->gambar_jenis!=null)?'<img src="data:image/jpg;base64,'.base64_encode($key->gambar_jenis).'" width="100%" />':'No image available.'?></td>
					<td class="center">
						<div class="hidden-sm hidden-xs action-buttons">

							<a class="green" data-toggle="modal" data-target="#edit<?=$key->id_jenis?>" >
								<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>

							<a class="red" href="<?=base_url()?>Redaktur/Jenis/delete/<?=$key->id_jenis?>">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
						</div>

						<div class="hidden-md hidden-lg">
							<div class="inline pos-rel">
								<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
									<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
								</button>

								<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

									<li>
										<a data-toggle="modal" data-target="#edit<?=$key->id_jenis?>" class="tooltip-success" data-rel="tooltip" title="Edit">
											<span class="green">
												<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
											</span>
										</a>
									</li>

									<li>
										<a href="<?=base_url()?>Redaktur/Jenis/delete/<?=$key->id_jenis?>" class="tooltip-error" data-rel="tooltip" title="Delete">
											<span class="red">
												<i class="ace-icon fa fa-trash-o bigger-120"></i>
											</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

		
	<div id="add" class="modal" tabindex="-1">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="blue bigger">Add <?=@$judul?></h4>

				</div>



				<div class="modal-body">

					<div class="row">

						<div class="col-xs-12">

							<form action="<?=base_url()?>Redaktur/Jenis/ProsesAdd" method="POST" enctype="multipart/form-data">

								<!-- <legend>Form</legend> -->

								<div class="form-group col-xs-12">

									<label for="form-field-first">Nama Jenis*</label>



									<div class="">

										<input type="text" id="form-field-first" placeholder="Nama Jenis" value="" class="form-control" name="nama_jenis" required="required" />

									</div>

								</div>

								<!-- <legend>Form</legend> -->

								<div class="form-group col-xs-12">

									<label for="form-field-first">Harga*</label>



									<div class="">

										<input type="number" id="form-field-first1" placeholder="" value="0" class="form-control" name="harga" min="0" max="99999" required="required" />

									</div>

								</div>

								<!-- <legend>Form</legend> -->

								<div class="form-group col-xs-12">

									<label for="form-field-first">Contoh*</label>



									<div class="">

										<input type="file" id="id-input-file-2" name="image"  required="required" />

									</div>

								</div>

								<div class="form-group col-md-12">

									<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-send-o"></i> Kirim</button>

								</div>

							</form>

						</div>

					</div>

				</div>	

			</div>

		</div>

	</div><!-- PAGE CONTENT ENDS -->

	<?php foreach ($data as $value) { ?>

		<div id="edit<?=$value->id_jenis?>" class="modal" tabindex="-1">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal">&times;</button>

						<h4 class="blue bigger">Add <?=@$judul?></h4>

					</div>



					<div class="modal-body">

						<div class="row">

							<div class="col-xs-12">

								<form action="<?=base_url()?>Redaktur/Jenis/ProsesUpdate/<?=$value->id_jenis?>" method="POST" enctype="multipart/form-data">

									<!-- <legend>Form</legend> -->

									<div class="form-group col-xs-12">

										<label for="form-field-first">Nama Jenis*</label>



										<div class="">

											<input type="text" id="form-field-first" placeholder="Nama Jenis" value="<?=$value->nama_jenis?>" class="form-control" name="nama_jenis" required="required" />

										</div>

									</div>

									<!-- <legend>Form</legend> -->

									<div class="form-group col-xs-12">

										<label for="form-field-first">Harga*</label>



										<div class="">

											<input type="number" id="form-field-first1" placeholder="" value="<?=$value->harga?>" class="form-control" name="harga" min="0" max="99999" required="required" />

										</div>

									</div>
									<?php if ($value->gambar_jenis != null){ ?>
									<!-- <legend>Form</legend> -->

									<div class="form-group col-xs-12">

										<div class="">

											<img src="data:image/jpg;base64, <?=base64_encode($value->gambar_jenis)?>" width="30%">

										</div>

									</div>
									<?php } ?>
									<!-- <legend>Form</legend> -->

									<div class="form-group col-xs-12">

										<label for="form-field-first">Contoh*</label>



										<div class="">

											<input type="file" id="id-input-file-2" name="image"/>

										</div>

									</div>

									<div class="form-group col-md-12">

										<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-send-o"></i> Kirim</button>

									</div>

								</form>

							</div>

						</div>

					</div>	

				</div>

			</div>

		</div><!-- PAGE CONTENT ENDS -->

	<?php } ?>

		<script src="<?=base_url()?>assets/js/bootbox.js"></script>

		<!-- page specific plugin scripts datatables -->
		<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?=base_url()?>assets/js/buttons.flash.min.js"></script>
		<script src="<?=base_url()?>assets/js/buttons.html5.min.js"></script>
		<script src="<?=base_url()?>assets/js/buttons.print.min.js"></script>
		<script src="<?=base_url()?>assets/js/buttons.colVis.min.js"></script>
		<script src="<?=base_url()?>assets/js/dataTables.select.min.js"></script>

		<script type="text/javascript">
			jQuery(function($) {

				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: ''
						//Ini Print Button
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
                $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });
                
			
			})
		</script>