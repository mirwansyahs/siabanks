
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="<?=base_url()?>">
                <?php if (!empty($instance->instance_image)){ ?>
                <img src="<?=base_url()?>assets/images/resources/<?=$instance->instance_image?>" class="header-brand-img" alt="tabler logo">
                <?php }else{ ?>
                <img src="<?=base_url()?>assets/images/resources/favicon.ico" class="header-brand-img" alt="tabler logo">
                <?php } ?>
                <?php if (!empty($instance->instance_nama)){ ?>
                <?=$instance->instance_nama?>
                <?php }else{ ?>
                SMK NEGERI 4 KUNINGAN
                <?php } ?>
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <?php if(empty($this->session->userdata('status'))){ ?>
                <div class="nav-item d-none d-md-flex">
                  <a href="<?=base_url()?>login" class="btn btn-sm btn-outline-success">Login</a>
                </div>
                <?php }else{ ?>
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <!-- Gambar User -->
                    <span class="avatar" style="background-image: url(<?=base_url()?>assets/images/people/male/<?php if (!empty($this->session->userdata('user_image'))){ echo $this->session->userdata('user_image'); }else{ echo "0.jpg"; } ?>)"></span>

                    <span class="ml-2 d-none d-lg-block">
                      <!-- Nama User -->
                      <span class="text-default"><?= $userdata->display_name?></span>
                      <!-- Level User -->
                      <small class="text-muted d-block mt-1"><?=$userdata->user_login?></small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="<?=base_url()?>Redaktur/Home">
                      <i class="dropdown-icon fe fe-home"></i> Administrator
                    </a>
                    <a class="dropdown-item" href="<?=base_url()?>Redaktur/Profile">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url()?>Login/out">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item dropdown">
                    <a href="<?=base_url()?>" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-info"></i> Profile</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="<?=base_url()?>Sejarah" class="dropdown-item "> Sejarah</a>
                      <a href="<?=base_url()?>Visimisi" class="dropdown-item "> Visi Misi</a>
                      <a href="<?=base_url()?>Sambutan" class="dropdown-item "> Kata Sambutan</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Direktori</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="" class="dropdown-item "> Guru</a>
                      <a href="" class="dropdown-item "> Tata Usaha</a>
                      <a href="" class="dropdown-item "> Siswa</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="<?=base_url()?>Artikel" class="nav-link"><i class="fe fe-file-text"></i> Artikel</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Informasi</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="" class="dropdown-item "> Unit Produksi</a>
                      <a href="" class="dropdown-item "> Ekstrakurikuler</a>
                      <a href="" class="dropdown-item "> Organisasi Siswa</a>
                      <a href="" class="dropdown-item "> Fasilitas</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <?php if (empty($this->session->userdata('status'))){ ?>
                    <a href="<?=base_url()?>Login" class="nav-link"><i class="fe fe-arrow-right-circle"></i> Login</a>
                    <?php } ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>