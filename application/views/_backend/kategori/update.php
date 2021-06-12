<?=@$this->session->flashdata("msg")?>

	<div class="col-xs-12">
		<form class="form-horizontal" role="form" action="<?=base_url()?>Redaktur/Kategori/prosesupdate" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-2 control-label no-padding-left"> Caption </label>

				<div class="col-sm-10">
					<input type="hidden" placeholder="M Irwansyah S" class="form-control" name="ID" value="<?=$data->ID?>" />
					<input type="text" placeholder="Kategori Nama" class="form-control" name="kategori_nama" value="<?=$data->kategori_nama?>" />
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
