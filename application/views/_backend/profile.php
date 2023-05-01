<script>
			let latitude = "";
			let longitude = "";
			$(document).ready(function() {
				navigator.geolocation.getCurrentPosition(function (position) {

					sendLatitude(position.coords.latitude);
					sendLongitude(position.coords.longitude);

					latitude 	= <?=(@$data->latitude != '')?$data->latitude:'position.coords.latitude';?>;
					longitude 	= <?=(@$data->longitude != '')?$data->longitude:'position.coords.longitude';?>;

					$('#latitude').val(latitude);
					$('#longitude').val(longitude);
					var mapOptions = {
						center: [latitude,longitude],
						zoom: 17
					}
					var peta = new L.map('map-canvas', mapOptions);
					// console.log(latitude);
					L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
						attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
						maxZoom: 18,
						id: 'mapbox/streets-v11',
						tileSize: 512,
						zoomOffset: -1,
						accessToken: 'pk.eyJ1IjoibWlyd2Fuc3lhaHMiLCJhIjoiY2tjdjhrZWU4MDF1dTJ1bWxybHYzcjUyeiJ9.pBy872j-S0fYVPy9K_T1Uw'
					}).addTo(peta);
					let pos = L.marker([latitude, longitude],{draggable:true}).addTo(peta)
						.bindPopup('<?=$data->alamat?>')
						.openPopup();
					pos.on('dragend', function (e) {
						document.getElementById('latitude').value = pos.getLatLng().lat;
						document.getElementById('longitude').value = pos.getLatLng().lng;
					});
				}, function (e) {
					showError(e);
					alert('Geolocation Tidak Mendukung Pada Browser Anda');
				}, {
					enableHighAccuracy: true
				});
			});

			function sendLatitude(position){

				return position;
				// longitude 	= position.coords.longitude;

			}function sendLongitude(position){

				return position;
				// longitude 	= position.coords.longitude;

			}
			function showError(error) {
				var view = document.getElementById("lokasi");
				switch(error.code) {
					case error.PERMISSION_DENIED:
						view.innerHTML = "<p>Yah, mau deteksi lokasi tapi ga boleh :(</p>"
						break;
					case error.POSITION_UNAVAILABLE:
						view.innerHTML = "<p>Yah, Info lokasimu nggak bisa ditemukan nih</p>"
						break;
					case error.TIMEOUT:
						view.innerHTML = "<p>Requestnya timeout bro</p>"
						break;
					case error.UNKNOWN_ERROR:
						view.innerHTML = "<p>An unknown error occurred.</p>"
						break;
				}
			}
			</script>
<!--end script google map-->
<?=@$this->session->flashdata("msg")?>
<div id="user-profile-2" class="user-profile">
	<div class="tabbable">
		<ul class="nav nav-tabs padding-18">
			<li class="active">
				<a data-toggle="tab" href="#home">
					<i class="green ace-icon fa fa-user bigger-120"></i>
					Profile
				</a>
			</li>
	
			<li>
				<a data-toggle="tab" href="#detail">
					<i class="blue ace-icon fa fa-info bigger-120"></i>
					Detail Profile
				</a>
			</li>

			<li>
				<a data-toggle="tab" href="#location">
					<i class="blue ace-icon fa fa-globe bigger-120"></i>
					Location
				</a>
			</li>

			<li>
				<a data-toggle="tab" href="#feed">
					<i class="orange ace-icon fa fa-lock bigger-120"></i>
					Change Password
				</a>
			</li>
		</ul>

		<div class="tab-content no-border padding-24">
			<div id="home" class="tab-pane in active">
				<div class="row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?=base_url()?>assets/images/<?php if(empty($this->userdata->Image)){ echo "people/male/0.jpg"; }else{ echo "Members/".$this->userdata->MemberID."/".$this->userdata->Image; } ?>" />
						</span>

						<div class="space space-4"></div>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle"><?=$data->Nama_Depan." ".$data->Nama_Belakang?></span>

							<span class="label label-success arrowed-in-right">
								<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
								online
							</span>
						</h4>

						<form action="<?=base_url()?>Redaktur/Profile/updateprofile" method="POST" enctype="multipart/form-data">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Username </div>

									<div class="profile-info-value">
										<span><?=$data->Email?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Display Name </div>

									<div class="profile-info-value">
										<span><?=$data->Nama_Depan." ".$data->Nama_Belakang?></span>
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> First Name </div>

									<div class="profile-info-value">
										<input type="text" class="form-control" name="user_nickname" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->Nama_Depan?>">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Last Name </div>

									<div class="profile-info-value">
										<input type="text" class="form-control" name="display_name" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->Nama_Belakang?>">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Email </div>

									<div class="profile-info-value">
										<input type="email" class="form-control" name="user_email" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->Email?>">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Phone Number </div>

									<div class="profile-info-value">
										<input type="text" class="form-control input-mask-phone" name="PhoneNumber" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->PhoneNumber?>" id="form-field-mask-2" autocomplete="off">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Joined </div>

									<div class="profile-info-value">
										<span class="editable" id="signup"><?=date_format(date_create($data->user_registered), 'd/m/Y H:i:s')?></span>
									</div>
								</div>

							</div>
							<br/>
							<div class="col-xs-4"></div>
							<div class="col-sm-12">
							<button class="btn btn-app btn-grey btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i>

									Save
									<span class="badge badge-transparent">
										<i class="light-red ace-icon fa fa-asterisk"></i>
									</span>
								</button>
							</div>
						</form>
					</div><!-- /.col -->
				</div><!-- /.row -->
													
			</div><!-- /#home -->

			<div id="detail" class="tab-pane">
				<div class="row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?=base_url()?>assets/images/<?php if(empty($this->userdata->Image)){ echo "people/male/0.jpg"; }else{ echo "Members/".$this->userdata->MemberID."/".$this->userdata->Image; } ?>" />
						</span>

						<div class="space space-4"></div>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle"><?=$data->Nama_Depan." ".$data->Nama_Belakang?></span>

							<span class="label label-success arrowed-in-right">
								<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
								online
							</span>
						</h4>

						<form action="<?=base_url()?>Redaktur/Profile/updateprofiledetail" method="POST" enctype="multipart/form-data">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Tempat Lahir </div>

									<div class="profile-info-value">
										<input type="text" class="form-control" name="tempat_lahir" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->tempat_lahir?>">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Tanggal Lahir </div>

									<div class="profile-info-value">
										<input type="date" class="form-control" name="tanggal_lahir" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->tanggal_lahir?>">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Jenis Kelamin </div>

									<div class="profile-info-value">
										<input type="radio" name="jenis_kelamin" value="L"
										 <?php if ($data->jenis_kelamin == "L"){echo "checked";}?>> Laki Laki
										<input type="radio" name="jenis_kelamin" value="P" <?php if($data->jenis_kelamin == "P"){echo "checked"; }?>> Perempuan
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Alamat </div>

									<div class="profile-info-value">
										<input type="text" class="form-control" name="alamat" placeholder="Jalan rumah, RT/RW, Nomor rumah, Desa, Kecamatan, Provinsi, Kode Pos." style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px" value="<?=$data->alamat?>">
									</div>
								</div>

							</div>
							<br/>
							<div class="col-xs-4"></div>
							<div class="col-sm-12">
							<button class="btn btn-app btn-grey btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i>

									Save
									<span class="badge badge-transparent">
										<i class="light-red ace-icon fa fa-asterisk"></i>
									</span>
								</button>
							</div>
						</form>
					</div><!-- /.col -->
				</div><!-- /.row -->
													
			</div><!-- /#detail profile -->


			<div id="feed" class="tab-pane">
				<div class="profile-feed row">
					<div class="col-xs-12 col-sm-3 center">
						<span class="profile-picture">
							<img class="editable img-responsive" alt="Alex's Avatar" src="<?=base_url()?>assets/images/<?php if(empty($this->userdata->Image)){ echo "people/male/0.jpg"; }else{ echo "Members/".$this->userdata->MemberID."/".$this->userdata->Image; } ?>" />
						</span>

						<div class="space space-4"></div>
					</div><!-- /.col -->

					<div class="col-xs-12 col-sm-9">
						<h4 class="blue">
							<span class="middle"><?=$data->Nama_Depan." ".$data->Nama_Belakang?></span>

							<span class="label label-success arrowed-in-right">
								<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
								online
							</span>
						</h4>

						<form action="<?=base_url()?>Redaktur/Profile/updatepassword" method="POST" enctype="multipart/form-data">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name"> Password Lama </div>

									<div class="profile-info-value">
										<input type="password" class="form-control" name="pass_lama" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Password Baru </div>

									<div class="profile-info-value">
										<input type="password" class="form-control" name="pass_baru" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px">
									</div>
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> Konfirmasi </div>

									<div class="profile-info-value">
										<input type="password" class="form-control" name="konfirmasi" style="border: none; border-bottom: 1px dashed; height: 20px; font-size: 12px">
									</div>
								</div>

							</div>
							<br/>
							<div class="col-xs-4"></div>
							<button class="btn btn-app btn-grey btn-xs radius-4">
								<i class="ace-icon fa fa-floppy-o bigger-160"></i>
								Save
								<span class="badge badge-transparent">
									<i class="light-red ace-icon fa fa-asterisk"></i>
								</span>
							</button>
							
						</form>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /#feed -->

			<div id="location" class="tab-pane">
		        <div class="col-md-8 col-sm-8 col-12">
		            <div class="panel panel-primary">
		                <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
		                <div class="panel-body" style="height:300px;" id="map-canvas">
		                </div>
		            </div>
		        </div>
		        <div class="col-md-4 col-sm-4">
		            <div class="panel panel-primary">
		                <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Koordinat</div>
		                <div class="panel-body" style="min-height:300px;">
		                    <form action="<?=base_url()?>Redaktur/Profile/updatelocation" method="POST">
		                        <div class="row">
		                            <div class="col-md-6 col-sm-6">
		                                <div class="form-group">
		                                    <label for="latitude">Latitude</label>
		                                    <input type="text" class="form-control" name="latitude" id="latitude" readonly="readonly" value="<?=$data->latitude?>">
		                                </div>
		                            </div>
		                            <div class="col-md-6 col-sm-6">
		                                <div class="form-group">
		                                    <label for="longitude">Longitude</label>
		                                    <input type="text" class="form-control" name="longitude" id="longitude" readonly="readonly" value="<?=$data->longitude?>">
		                                </div>
		                            </div>
		                        </div>
								<br/>
								<div class="col-xs-4"></div>
								<button class="btn btn-app btn-info btn-xs radius-4">
									<i class="ace-icon fa fa-floppy-o bigger-160"></i>
									Save
									<span class="badge badge-transparent">
										<i class="light-red ace-icon fa fa-asterisk"></i>
									</span>
								</button>
								
		                    </form>
		    			</div>
		    		</div>
		    	</div>
		    </div>
			</div><!-- /#location -->
		</div>
	</div>


		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?=base_url()?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.gritter.min.js"></script>
		<script src="<?=base_url()?>assets/js/bootbox.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="<?=base_url()?>assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="<?=base_url()?>assets/js/select2.min.js"></script>
		<script src="<?=base_url()?>assets/js/spinbox.min.js"></script>
		<script src="<?=base_url()?>assets/js/bootstrap-editable.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace-editable.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.maskedinput.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    
				
				//editables 
				
				//text editable
			    $('#username')
				.editable({
					type: 'text',
					name: 'user_login'		
			    });
			
				//text editable
			    $('#nickname')
				.editable({
					type: 'text',
					name: 'user_nickname'		
			    });

				//text editable
			    $('#display_name')
				.editable({
					type: 'text',
					name: 'display_name'		
			    });
			
				//text editable
			    $('#email')
				.editable({
					type: 'email',
					name: 'user_email'		
			    });
			
			
				
				
				
				// *** editable avatar *** //
				try {//ie8 throws some harmless exceptions, so let's catch'em
			
					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch(e) {
						Image.prototype.appendChild = function(el){}
					}
			
					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						//onblur: 'ignore',  //don't reset or hide editable onblur?!
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							maxSize: 110000,//~100Kb
			
							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							on_error : function(error_type) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(error_type == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(error_type == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();
							}
						},
					    url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//for a working upload example you can replace the contents of this function with 
							//examples/profile-avatar-update.js
			
							var deferred = new $.Deferred
			
							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}
			
			
							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if(thumb) $('#avatar').get(0).src = thumb;
								}
								
								deferred.resolve({'status':'OK'});
			
								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});
								
							 } , parseInt(Math.random() * 800 + 800))
			
							return deferred.promise();
							
							// ***END OF UPDATE AVATAR HERE*** //
						},
						
						success: function(response, newValue) {
						}
					})
				}catch(e) {}
				
				/**
				//let's display edit mode by default?
				var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
				if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
				*/
			
				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form action="<?=base_url()?>Redaktur/Profile/updateimage" method="POST" enctype="multipart/form-data">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="image" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Submit</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click to choose new avatar',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});
			
					// form.on('submit', function(){
					// 	if(!file.data('ace_input_files')) return false;
						
					// 	file.ace_file_input('disable');
					// 	form.find('button').attr('disabled', 'disabled');
					// 	form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						
					// 	var deferred = new $.Deferred;
					// 	working = true;
					// 	deferred.done(function() {
					// 		form.find('button').removeAttr('disabled');
					// 		form.find('input[type=file]').ace_file_input('enable');
					// 		form.find('.modal-body > :last-child').remove();
							
					// 		modal.modal("hide");
			
					// 		var thumb = file.next().find('img').data('thumb');
					// 		if(thumb) $('#avatar2').get(0).src = thumb;
			
					// 		working = false;
					// 	});
						
						
					// 	setTimeout(function(){
					// 		deferred.resolve();
					// 	} , parseInt(Math.random() * 800 + 800));
			
					// 	return false;
					// });
							
				});
			
				
			
				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
			
				$('a[ data-original-title]').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//right & left position
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function(e) {
					e.preventDefault();
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'large',
					droppable:true,
					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(099) 999-999-999');
			
				$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
				
				
				
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch(e) {}
					$('[class*=select2]').remove();
				});
			});
			
		</script>
		

