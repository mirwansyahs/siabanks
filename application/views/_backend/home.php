<?=@$this->session->flashdata("msg")?>

<?php $jns_sampah = $this->M_sampah->select_jenis_sampah()?>

<?php if ($this->userdata->user_status == "2") { ?>
<div class="col-xs-12">
    <div class="tabbable">
        <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
            <li class="active">
                <a data-toggle="tab" href="#home4">
                    <i class="blue ace-icon fa fa-dollar bigger-120"></i>
                    Points
                </a>
            </li>
            <?php if ($this->userdata->user_status == "2"){?>
            <li>
                <a data-toggle="tab" href="#profile4">
                    <i class="blue ace-icon fa fa-recycle bigger-120"></i>
                    Setor Sampah
                </a>
            </li>
            <?php } ?>
            <li>
                <a data-toggle="tab" href="#redeem">
                    <i class="blue ace-icon fa fa-gift bigger-120"></i>
                    Redeem
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="home4" class="tab-pane in active">
                <center><h1>Saldo Rp<span><?= number_format($data->Saldo, 2, ',', '.') ?></span></h1></center>
                <center><h5>Points <span><?= number_format($data->Points, 2, ',', '.') ?></span></h5></center>
            </div>
            
            <div id="profile4" class="tab-pane">
                
                <!-- <center> -->
                <?php 
                $Disable = false;
                    if($Satuan == "km"){
                        if ($Distance > 14){
                            $Disable = true;
                        }
                    }
                ?>
                    
                
                    <form action="<?=base_url()?>Redaktur/Sampah/prosesadd" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group" style="text-align: center">
                                <div class="col-xs-12">
                                    <img id="gambar_jenis" src="data:image/jpg;base64,<?=base64_encode($jns_sampah->row()->gambar_jenis)?>" width="400px" >
                                </div>

                                <label class="col-xs-12" style="text-align: left"> Jenis Sampah </label>
                                <div class="col-xs-12">
                                    <select name="id_jenis" id="nama_jenis" onchange="getImage(this)" class="form-control">
                                        <?php foreach ($jns_sampah->result() as $jns) { ?>
                                        <option value="<?=$jns->id_jenis?>"><?=$jns->nama_jenis?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-12"> Jumlah Sampah (*/kg) </label>

                                <div class="col-xs-12">
                                    <input type="number" name="jumlah_sampah" id="jumlah_sampah" class="form-control" onblur="validation()" value="3" min="3" max="99999" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-12"> Estimasi Pendapatan </label>

                                <div class="col-xs-12">
                                    <input type="text" name="estimate" id="estimate" class="form-control" value="Rp.0,00,-" readonly="readonly" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-xs-12"> Capture </label>

                                <div class="col-xs-12">
                                    <input id="id-input-file-2"  name="image" type="file" accept="image/*" capture required="required"/>
                                </div>
                            </div>
                            <div class="form-group" style="text-align: center">
                                <button class="btn btn-app btn-info btn-xs radius-4">
                                    <i class="ace-icon fa fa-floppy-o bigger-160"></i>

                                    Save
                                    <span class="badge badge-transparent">
                                        <i class="light-red ace-icon fa fa-asterisk"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
            </div>

            <div id="redeem" class="tab-pane">
                <center>
                    <div class="col-md-12">
                        <?php if (empty($validateDayRedeem)){ ?>
                        <div class="row">
                            <?php foreach ($item as $key) { ?>
                            <div class="col-md-3 col-sm-12 pricing-box">
                                <div class="widget-box widget-color-blue">
                                    <div class="widget-header">
                                        <h5 class="widget-title bigger lighter">Pulsa</h5>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <ul class="list-unstyled spaced2">
                                                <li>
                                                    <?php if($data->Saldo < $key->price){ ?>
                                                    <i class="ace-icon fa fa-close red"></i>
                                                    <?php }else if ($data->Saldo >= $key->price){?>
                                                    <i class="ace-icon fa fa-check green"></i>
                                                    <?php } ?>
                                                    Saldo Rp.<?=number_format($key->price)?> = <?=number_format($key->itemname)?> Pulsa <small>
                                                </li>
                                            </ul>

                                            <hr />
                                            <div class="price">
                                                <small>Rp.<?=number_format($key->itemname)?>,-</small>
                                            </div>
                                        </div>

                                        <div>
                                            <?php if($data->Saldo < $key->price){ ?>
                                            <a href="" class="btn btn-block btn-primary disabled">
                                            <?php }else if ($data->Saldo >= $key->price){?>
                                            <a href="<?=base_url()?>Redaktur/Home/redeem/<?=$key->id_detailitem?>" class="btn btn-block btn-primary">
                                            <?php } ?>
                                                <i class="ace-icon fa fa-shopping-cart bigger-110"></i>
                                                <span>Buy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <ul class="pagination col-xs-12">
                            <?php echo $page;?>
                        </ul>
                        <?php } else{ echo "Anda telah menukar hadiah hari ini!. <br/> Silahkan tunggu besok hari. :D"; }?>
                    </div>
                </center>
            </div><!-- /.col -->

        <div class="clearfix"></div>
        <br/>
    </div>
</div>
<?php } ?>
<div class="col-xs-12">

    <div class="clearfix">
        <div class="pull-right tableTools-container"></div>
    </div>
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="center">#</th>
                <th width="15%">Tanggal Lapor</th>
                <?php if ($this->userdata->user_status == "0" || $this->userdata->user_status == "1"){ ?>
                <th width="15%">Nama</th>
                <?php } ?>
                <th width="20%">Lokasi</th>
                <?php if ($this->userdata->user_status != "2"){ ?>
                <th width="20%">Saldo Masyarakat</th>
                <?php } ?>
                <th width="10%">Jenis</th>
                <th width="5%">Jumlah/kg</th>
                <th width="20%">Bukti</th>
                <th width="10%" class="center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($dataSampah as $key) {  ?>
            <tr>
                <td class="center"><?=$no++?></td>
                <td><?= date_format(date_create($key->tanggal_lapor), "d M Y H:i:s")?></td>
                <?php if ($this->userdata->user_status == "0" || $this->userdata->user_status == "1"){ ?>
                <td><?=$key->Nama_Depan. " ".$key->Nama_Belakang?></td>
                <?php } ?>
                <td>
                    <center><?=$key->alamat?>.</center>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a href="https://www.google.com/maps/place/<?=$key->latitude?>+<?=$key->longitude?>" target="_BLANK">Lat : <?=$key->latitude?><br/>Long : <?=$key->longitude?></a>
                    </div>

                    <center>
                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="https://www.google.com/maps/place/<?=$key->latitude?>+<?=$key->longitude?>" target="_BLANK" class="tooltip-success" data-rel="tooltip" title="Buka Lokasi">
                                            <span class="green">
                                                <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </center>
                </td>
                <?php if ($this->userdata->user_status != "2"){ ?>
                <td>Rp<?=number_format($key->Saldo, 0, ',', '.')?></td>
                <?php } ?>
                <td>
                    <select name="id_jenis" id="nama_jenisUpdate" onchange="saveUpdate('<?=$key->id_sampah?>', 'id_jenis')" class="form-control" <?=($key->status_sampah != "0")?'disabled="disabled"':'';?>>
                    <?php foreach ($jns_sampah->result() as $jns) { ?>
                        <option value="<?=$jns->id_jenis?>" <?=($jns->nama_jenis == $key->nama_jenis)?'selected="selected"':'';?>><?=$jns->nama_jenis?></option>
                    <?php } ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="jumlah_sampah" id="jumlah_sampahUpdate" value="<?=$key->jumlah_sampah?>" onblur="saveUpdate('<?=$key->id_sampah?>', 'jumlah_sampah')" class="form-control" min="3" max="200" <?=($key->status_sampah != "0")?'disabled="disabled"':'';?> />
                </td>
                <td>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <ul class="ace-thumbnails clearfix">
                            <li>
                                <a href="<?=base_url()?>assets/images/bukti/<?=$key->bukti_photo?>" data-rel="colorbox">
                                    <img width="150" height="150" alt="150x150" src="<?=base_url()?>assets/images/bukti/<?=$key->bukti_photo?>" />
                                        <div class="text">
                                            <div class="inner">Bukti dari <?=$key->Nama_Depan?></div>
                                        </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

                                <li>
                                    <a href="<?=base_url()?>assets/images/bukti/<?=$key->bukti_photo?>" target="_BLANK" class="tooltip-info" data-rel="tooltip" title="Lihat Bukti">
                                        <span class="blue">
                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                        
                </td>
                <td class="center">
                    <span>
                        <?php  
                            if ($key->status_sampah == "1"){
                                    $oleh = $this->db->select("concat_ws(' ', tb_members.Nama_Depan, tb_members.Nama_Belakang) AS Nama")
                                                     ->select("tanggal_pengambilan")
                                                     ->where("tb_pengumpulansampah.id_sampah = tb_pengambilansampah.id_sampah")
                                                     ->where("tb_pengambilansampah.MemberID = tb_members.MemberID")
                                                     ->where("tb_pengumpulansampah.id_sampah", $key->id_sampah)
                                                     ->get("tb_members, tb_pengumpulansampah, tb_pengambilansampah")->row();
                                    echo "<span class='text-success'>Sudah diambil oleh ".$oleh->Nama.".<br/>Pada tanggal ".date_format(date_create($oleh->tanggal_pengambilan), "d-M-Y H:i:s")."</span>"; 
                                }
                                elseif ($key->status_sampah == "2"){ 
                                    $oleh = $this->db->select("concat_ws(' ', tb_members.Nama_Depan, tb_members.Nama_Belakang) AS Nama")
                                                     ->select("tanggal_pengambilan")
                                                     ->where("tb_pengumpulansampah.id_sampah = tb_pengambilansampah.id_sampah")
                                                     ->where("tb_pengambilansampah.MemberID = tb_members.MemberID")
                                                     ->where("tb_pengumpulansampah.id_sampah", $key->id_sampah)
                                                     ->get("tb_members, tb_pengumpulansampah, tb_pengambilansampah")->row();
                                    echo "<span class='text-danger'>Tidak ada, sudah diperiksa oleh ".$oleh->Nama.".<br/>Pada tanggal ".date_format(date_create($oleh->tanggal_pengambilan), "d-M-Y H:i:s")."</span>"; 
                                }else{
                                    if ($this->userdata->user_status == "2"){ echo "<span class='text-info'>Belum diambil.</span>"; }
                                    else{
                        ?>
                        <div class="hidden-sm hidden-xs action-buttons">

                            <a class="blue" href="<?=base_url()?>Redaktur/Sampah/diambil/<?=$key->id_sampah?>">
                                <i class="ace-icon fa fa-check bigger-130"></i>
                            </a>

                            <a class="red" href="<?=base_url()?>Redaktur/Sampah/fraud/<?=$key->id_sampah?>">
                                <i class="ace-icon fa fa-close bigger-130"></i>
                            </a>
                        </div>

                        <div class="hidden-md hidden-lg">
                            <div class="inline pos-rel">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">


                                    <li>
                                        <a href="<?=base_url()?>Redaktur/Sampah/diambil/<?=$key->id_sampah?>" class="tooltip-success" data-rel="tooltip" title="Diambil.">
                                            <span class="blue">
                                                <i class="ace-icon fa fa-check bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?=base_url()?>Redaktur/Sampah/fraud/<?=$key->id_sampah?>" class="tooltip-error" data-rel="tooltip" title="Fraud.">
                                            <span class="red">
                                                <i class="ace-icon fa fa-close bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                                        
                    </span>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/js/buttons.flash.min.js"></script>
<script src="<?=base_url()?>assets/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/js/buttons.colVis.min.js"></script>
<script src="<?=base_url()?>assets/js/dataTables.select.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?=base_url()?>assets/js/bootbox.js"></script>
<script src="<?=base_url()?>assets/js/jquery.easypiechart.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.gritter.min.js"></script>
<script src="<?=base_url()?>assets/js/spin.js"></script>
<!-- page specific plugin scripts -->
<script src="<?=base_url()?>assets/js/jquery.colorbox.min.js"></script>


<!-- inline scripts related to this page -->
<script type="text/javascript">
    function getImage(){
        const id_jenis = $('#nama_jenis');
		$.post('<?= base_url() ?>Redaktur/Home/getImagePrice','ID='+id_jenis.val(),function(data){
			try{
                data = JSON.parse(data);
				if (data){
                    // $("#gambar_jenis").attr("src", data);
                    
                    document.getElementById('gambar_jenis').src = data.gambar_jenis;
                    document.getElementById('jumlah_sampah').max = data.max;
                }
			}catch(error){
			}
		})
    }
    function saveUpdate(IDSampah = '', prefix = ''){
        if (prefix == "id_jenis"){
            const id_jenis = $('#nama_jenisUpdate');
            $.post('<?= base_url() ?>Redaktur/Home/saveUpdate','ID='+IDSampah+'&Prefix='+prefix+'&value='+id_jenis.val(),function(data){
                try{
                    alert('Berhasil mengubah jenis sampah.');
                }catch(error){
                }
            })

        }else if (prefix == "jumlah_sampah"){
            const jumlah_sampah = $('#jumlah_sampahUpdate');
            $.post('<?= base_url() ?>Redaktur/Home/saveUpdate','ID='+IDSampah+'&Prefix='+prefix+'&value='+jumlah_sampah.val(),function(data){
                try{
                    alert('Berhasil mengubah jumlah sampah.');
                }catch(error){
                }
            })

        }
        
    }
    jQuery(function($) {
        $('#jumlah_sampah').on('keyup', function(){
            const id_jenis  = $('#nama_jenis');
            let jumlah    = $('#jumlah_sampah').val();
            if (jumlah != ''){
                $.post('<?=base_url()?>Redaktur/Home/getEstimate', 'ID='+id_jenis.val()+'&total='+jumlah,function(data){
                    try{
                        if (data){
                            $("#estimate").val(data);
                        }
                    }catch(error){
                        }
                })
            }else{
                $("#estimate").val('Rp.0,00,-');
            }
        })
        var myTable = 
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable( {
                    bAutoWidth: false,
                    // "aoColumns": [
                    //   { "bSortable": false },
                    //   null, null, null, null, null,<?php if ($this->userdata->user_status == "0" || $this->userdata->user_status == "1"){ echo "null,"; } ?>
                    //   { "bSortable": false }
                    // ],
                    "aaSorting": [],
                    
                    
                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,
            
                    //,
                    // "sScrollY": "800px",
                    // "bPaginate": true,
            
                    // "sScrollX": "100%",
                    // "sScrollXInner": "120%",
                    // "bScrollCollapse": false,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
            
                    "iDisplayLength": 50,
            
            
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
            
        var $overflow = '';
    var colorbox_params = {
        rel: 'colorbox',
        reposition:true,
        scalePhotos:true,
        scrolling:false,
        previous:'<i class="ace-icon fa fa-arrow-left"></i>',
        next:'<i class="ace-icon fa fa-arrow-right"></i>',
        close:'&times;',
        current:'{current} of {total}',
        maxWidth:'100%',
        maxHeight:'100%',
        onOpen:function(){
            $overflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
        },
        onClosed:function(){
            document.body.style.overflow = $overflow;
        },
        onComplete:function(){
            $.colorbox.resize();
        }
    };

    $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
    $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
    
    
    $(document).one('ajaxloadstart.page', function(e) {
        $('#colorbox, #cboxOverlay').remove();
   });
                /**
                $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                  //console.log(e.target.getAttribute("href"));
                })
                    
                $('#accordion').on('shown.bs.collapse', function (e) {
                    //console.log($(e.target).is('#collapseTwo'))
                });
                */
                
                $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    //if($(e.target).attr('href') == "#home") doSomethingNow();
                })
            
                
                /**
                    //go to next tab, without user clicking
                    $('#myTab > .active').next().find('> a').trigger('click');
                */
            
            
                $('#accordion-style').on('click', function(ev){
                    var target = $('input', ev.target);
                    var which = parseInt(target.val());
                    if(which == 2) $('#accordion').addClass('accordion-style2');
                     else $('#accordion').removeClass('accordion-style2');
                });

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
                
                //$('[href="#collapseTwo"]').trigger('click');
            
            
                $('.easy-pie-chart.percentage').each(function(){
                    $(this).easyPieChart({
                        barColor: $(this).data('color'),
                        trackColor: '#EEEEEE',
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: 8,
                        animate: ace.vars['old_ie'] ? false : 1000,
                        size:75
                    }).css('color', $(this).data('color'));
                });
            
                $('[data-rel=tooltip]').tooltip();
                $('[data-rel=popover]').popover({html:true});
            
            
                $('#gritter-regular').on(ace.click_event, function(){
                    $.gritter.add({
                        title: 'This is a regular notice!',
                        text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
                        image: 'assets/images/avatars/avatar1.png', //in Ace demo ./dist will be replaced by correct assets path
                        sticky: false,
                        time: '',
                        class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
                    });
            
                    return false;
                });
            
                $('#gritter-sticky').on(ace.click_event, function(){
                    var unique_id = $.gritter.add({
                        title: 'This is a sticky notice!',
                        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
                        image: 'assets/images/avatars/avatar.png',
                        sticky: true,
                        time: '',
                        class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                    });
            
                    return false;
                });
            
            
                $('#gritter-without-image').on(ace.click_event, function(){
                    $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: 'This is a notice without an image!',
                        // (string | mandatory) the text inside the notification
                        text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
                        class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                    });
            
                    return false;
                });
            
            
                $('#gritter-max3').on(ace.click_event, function(){
                    $.gritter.add({
                        title: 'This is a notice with a max of 3 on screen at one time!',
                        text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
                        image: 'assets/images/avatars/avatar3.png', //in Ace demo ./dist will be replaced by correct assets path
                        sticky: false,
                        before_open: function(){
                            if($('.gritter-item-wrapper').length >= 3)
                            {
                                return false;
                            }
                        },
                        class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                    });
            
                    return false;
                });
            
            
                $('#gritter-center').on(ace.click_event, function(){
                    $.gritter.add({
                        title: 'This is a centered notification',
                        text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
                        class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                    });
            
                    return false;
                });
                
                $('#gritter-error').on(ace.click_event, function(){
                    $.gritter.add({
                        title: 'This is a warning notification',
                        text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
                        class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
                    });
            
                    return false;
                });
                    
            
                $("#gritter-remove").on(ace.click_event, function(){
                    $.gritter.removeAll();
                    return false;
                });
                    
            
                ///////
            
            
                $("#bootbox-regular").on(ace.click_event, function() {
                    bootbox.prompt("What is your name?", function(result) {
                        if (result === null) {
                            
                        } else {
                            
                        }
                    });
                });
                    
                $("#bootbox-confirm").on(ace.click_event, function() {
                    bootbox.confirm("Are you sure?", function(result) {
                        if(result) {
                            //
                        }
                    });
                });
                
            /**
                $("#bootbox-confirm").on(ace.click_event, function() {
                    bootbox.confirm({
                        message: "Are you sure?",
                        buttons: {
                          confirm: {
                             label: "OK",
                             className: "btn-primary btn-sm",
                          },
                          cancel: {
                             label: "Cancel",
                             className: "btn-sm",
                          }
                        },
                        callback: function(result) {
                            if(result) alert(1)
                        }
                      }
                    );
                });
            **/
                
            
                $("#bootbox-options").on(ace.click_event, function() {
                    bootbox.dialog({
                        message: "<span class='bigger-110'>I am a custom dialog with smaller buttons</span>",
                        buttons:
                        {
                            "success" :
                             {
                                "label" : "<i class='ace-icon fa fa-check'></i> Success!",
                                "className" : "btn-sm btn-success",
                                "callback": function() {
                                    //Example.show("great success");
                                }
                            },
                            "danger" :
                            {
                                "label" : "Danger!",
                                "className" : "btn-sm btn-danger",
                                "callback": function() {
                                    //Example.show("uh oh, look out!");
                                }
                            }, 
                            "click" :
                            {
                                "label" : "Click ME!",
                                "className" : "btn-sm btn-primary",
                                "callback": function() {
                                    //Example.show("Primary button");
                                }
                            }, 
                            "button" :
                            {
                                "label" : "Just a button...",
                                "className" : "btn-sm"
                            }
                        }
                    });
                });
            
            
            
                $('#spinner-opts small').css({display:'inline-block', width:'60px'})
            
                var slide_styles = ['', 'green','red','purple','orange', 'dark'];
                var ii = 0;
                $("#spinner-opts input[type=text]").each(function() {
                    var $this = $(this);
                    $this.hide().after('<span />');
                    $this.next().addClass('ui-slider-small').
                    addClass("inline ui-slider-"+slide_styles[ii++ % slide_styles.length]).
                    css('width','125px').slider({
                        value:parseInt($this.val()),
                        range: "min",
                        animate:true,
                        min: parseInt($this.attr('data-min')),
                        max: parseInt($this.attr('data-max')),
                        step: parseFloat($this.attr('data-step')) || 1,
                        slide: function( event, ui ) {
                            $this.val(ui.value);
                            spinner_update();
                        }
                    });
                });
            
            
            
                //CSS3 spinner
                $.fn.spin = function(opts) {
                    this.each(function() {
                      var $this = $(this),
                          data = $this.data();
            
                      if (data.spinner) {
                        data.spinner.stop();
                        delete data.spinner;
                      }
                      if (opts !== false) {
                        data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
                      }
                    });
                    return this;
                };
            
                function spinner_update() {
                    var opts = {};
                    $('#spinner-opts input[type=text]').each(function() {
                        opts[this.name] = parseFloat(this.value);
                    });
                    opts['left'] = 'auto';
                    $('#spinner-preview').spin(opts);
                }
            
            
            
                $('#id-pills-stacked').removeAttr('checked').on('click', function(){
                    $('.nav-pills').toggleClass('nav-stacked');
                });
            
                
                
                
                
                
                ///////////
                $(document).one('ajaxloadstart.page', function(e) {
                    $.gritter.removeAll();
                    $('.modal').modal('hide');
                });
            
            });
</script>