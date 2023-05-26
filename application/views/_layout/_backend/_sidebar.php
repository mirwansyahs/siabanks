<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>


				<ul class="nav nav-list">
					<li <?php if ($judul == 'Dashboard') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Home">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li <?php if ($judul == 'List Redeem.') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/ListRedeem">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> List Redeem </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php if ($this->userdata->user_status != "2"){ ?>
					<li <?php if ($judul == 'Sudah dikerjakan.') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Task">
							<i class="menu-icon fa fa-file-text"></i>
							<span class="menu-text"> Telah dikerjakan </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } ?>

 					<?php if ($this->userdata->user_status == "0"){ ?>
					<!-- <li <?php if ($judul == 'Top up saldo') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Topup">
							<i class="menu-icon fa fa-dollar"></i>
							<span class="menu-text"> Top Up </span>
						</a>

						<b class="arrow"></b>
					</li> -->
					<li <?php if ($judul == 'Members') {echo 'class="active"';} ?>>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Members </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?=base_url()?>Redaktur/Users/add">
									<i class="menu-icon fa fa-plus-square"></i>
									Add Member
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?=base_url()?>Redaktur/Users">
									<i class="menu-icon fa fa-list"></i>
									List Members
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li <?php if ($judul == 'Jenis Sampah') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Jenis">
							<i class="menu-icon fa fa-trash"></i>
							<span class="menu-text"> Jenis Sampah </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } ?>
					<li <?php if ($judul == 'My Profile') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Profile">
							<i class="menu-icon glyphicon glyphicon-user"></i>
							<span class="menu-text"> My profile </span>
						</a>

						<b class="arrow"></b>
					</li>

					<!-- <li <?php if ($judul == 'Disclaimer') {echo 'class="active"';} ?>>
						<a href="<?=base_url()?>Redaktur/Disclaimer">
							<i class="menu-icon glyphicon glyphicon-warning-sign"></i>
							<span class="menu-text"> Disclaimer </span>
						</a>

						<b class="arrow"></b>
					</li> -->

					<li class="">
						<a href="<?=base_url()?>Login/out">
							<i class="menu-icon glyphicon glyphicon-off"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>