<?=@$this->session->flashdata("msg")?>

	<div class="col-xs-12">
		<form class="form-horizontal" role="form" action="<?=base_url()?>Redaktur/Sambutan/update" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label no-padding-left"> Sambutan </label>

				<div class="col-sm-10">
					<textarea class="form-control" id="instance" name="instance_sambutan"><?=$data->instance_sambutan?></textarea>
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