    <div class="card">
      <div class="card-status card-status bg-success"></div>
      <div class="card-header">
        <h3 class="card-title">
          <i class="fe fe-star text-success"></i> Popular Post
        </h3>
                      
        <div class="card-options">
          <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
        </div>
      </div>
      <div class="card-body">
        <div class="col-sm-6 col-xl-12">
          <div class="card">
            <a href="<?=base_url()?>Artikel/detail/<?=$artikelpopuler->artikel_seo?>"><img class="card-img-top" src="<?=base_url()?>assets/images/artikel/<?=$artikelpopuler->artikel_image?>" alt="<?=$artikelpopuler->artikel_judul?>"></a>
            <div class="card-body d-flex flex-column">
              <h4><a href="<?=base_url()?>Artikel/detail/<?=$artikelpopuler->artikel_seo?>"><?=$artikelpopuler->artikel_judul?></a></h4>
              <div class="text-muted"><?=htmlspecialchars_decode(substr($artikelpopuler->artikel_isi, 0, 90))?></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-status card-status bg-info"></div>
      <div class="card-header">
        <h3 class="card-title">
          <i class="fe fe-star text-info"></i> Latest Post
        </h3>
                      
        <div class="card-options">
          <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
        </div>
      </div>
      <div class="card-body">
        <div class="col-sm-6 col-xl-12">
          <div class="card">
            <a href="<?=base_url()?>Artikel/detail/<?=$artikelbaru->artikel_seo?>"><img class="card-img-top" src="<?=base_url()?>assets/images/artikel/<?=$artikelbaru->artikel_image?>" alt="<?=$artikelbaru->artikel_judul?>"></a>
            <div class="card-body d-flex flex-column">
              <h4><a href="<?=base_url()?>Artikel/detail/<?=$artikelbaru->artikel_seo?>"><?=$artikelbaru->artikel_judul?></a></h4>
              <div class="text-muted"><?=htmlspecialchars_decode(substr($artikelbaru->artikel_isi, 0, 90))?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
              
              