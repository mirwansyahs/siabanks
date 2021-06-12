        <div class="container">
          <div class="row">
            <div class="col-lg-9">
              <div class="row">
                <div class="col-6 col-md-6">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Sejarah</a></li>
                    <li><a href="#">Visi Misi</a></li>
                    <li><a href="#">Kepala Sekolah</a></li>
                  </ul>
                </div>
                <div class="col-6 col-md-6">
                  <ul class="list-unstyled mb-0">
                    <li><a href="#">Maps</a></li>
                    <li><a href="#">Galeri</a></li>
                    <li><a href="#">Fasilitas</a></li>
                    <li><a href="#">Newsletter</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
              <p align="justify">

              <!-- START ALAMAT -->
              <?php if (!empty($instance->instance_alamat)){ ?>
              <?=$instance->instance_alamat?> <br/>
              <?php }else{ ?>
              Jl. Raya Cikeusik, No 72, Cidahu - Kuningan, 45188 <br/>
              <?php } ?>
              <!-- END ALAMAT -->

              <!-- START EMAIL -->
              <?php if (!empty($instance->instance_email)){ ?>
              <?=$instance->instance_email?> <br/>
              <?php }else{ ?>
              info@ilmungawur.club<br/>
              <?php } ?>
              <!-- END EMAIL -->

              <!-- START TELPON -->
              <?php if (!empty($instance->instance_telp)){ ?>
              <?=$instance->instance_telp?> <br/>
              <?php }else{ ?>
              0838-2528-7989
              <?php } ?>
              <!-- END TELPON -->

              </p>
            </div>
          </div>
        </div>