<!DOCTYPE HTML>
<html lang="en">

<?= @$_header?>

<body class="no-skin">
	<?= @$_menu?>

	<div class="main-container ace-save-state" id="main-container">
		<?= @$_sidebar?>

		<div class="main-content">
			<div class="main-content-inner">
				<?= @$_content?>
			</div>
		</div>
		
		<div class="footer">
			<div class="footer-inner">
				<?=@$_footer?>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

</body>
</html>