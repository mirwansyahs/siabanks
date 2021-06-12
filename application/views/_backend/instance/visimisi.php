<?=@$this->session->flashdata("msg")?>

	<div class="col-xs-12">
		<form class="form-horizontal" role="form" action="<?=base_url()?>Redaktur/Visimisi/update" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label no-padding-left"> Visi Misi </label>

				<div class="col-sm-10">
					<textarea class="form-control" id="instance" name="instance_visimisi"><?=$data->instance_visimisi?></textarea>
				</div>
			</div>

			<div class="col-xs-4 col-md-5"></div>
			<div class="col-xs-4 col-md-5">
				<button class="btn btn-app btn-success btn-xs radius-4">
					<i class="ace-icon fa fa-floppy-o bigger-160"></i> Save
				</button>
			</div>
		</form>
	</div>

	<script>
		CKEDITOR.replace('instance');
	</script>