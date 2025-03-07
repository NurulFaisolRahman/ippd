<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Akun Instansi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="img/favicon.ico" rel="icon"> -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"> -->
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="../css/owl.carousel.css"> -->
    <!-- <link rel="stylesheet" href="../css/owl.theme.css"> -->
    <!-- <link rel="stylesheet" href="../css/owl.transitions.css"> -->
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="../css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="../css/animate.css"> -->
    <!-- normalize CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="../css/normalize.css"> -->
	<!-- wave CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="../css/wave/waves.min.css"> -->
    <link rel="stylesheet" href="../css/wave/button.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="../css/scrollbar/jquery.mCustomScrollbar.min.css"> -->
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="../css/notika-custom-icon.css">
    <!-- Data Table JS
		============================================ -->
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="../style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <!-- <script src="../js/vendor/modernizr-2.8.3.min.js"></script> -->
</head>
<body>
<div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!-- <div class="logo-area">
                        <a href="#"><img src="../img/logo/logo.png" alt="" /></a>
                    </div> -->
                    <h3 style="color: white;margin-top: 10px;">Admin</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#AkunInstansi" href="#"><b>AKUN INSTANSI</b></a>
                                <li><a data-toggle="collapse" data-target="#RPJPN2025" href="#"><b>RPJPN 2025</b></a>
                                    <ul class="collapse dropdown-header-top">
                                        <li>
                                            <a href="<?=base_url('Admin/Visi')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('Admin/Misi')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('Admin/Tujuan')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('Admin/Sasaran')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="active"><a data-toggle="tab" href="#AkunInstansi"><i class="notika-icon notika-form"></i> <b>AKUN INSTANSI</b></a></li>
                        <li><a data-toggle="tab" href="#RPJPN2025"><i class="notika-icon notika-house"></i> <b>RPJPN 2025</b></a></li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="RPJPN2025" class="tab-pane in notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/Visi')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Misi')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Tujuan')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Sasaran')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="AkunInstansi" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/AkunInstansi')?>"><i class="notika-icon notika-form"></i> <b>Daftar Instansi</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputAkunInstansi"><i class="notika-icon notika-form"></i> <b>Tambah Akun</b></button>
                            </div>
                                <!-- <h2>Basic Example</h2>
                                <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p> -->
                            </div>
                            <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Username</th>
                                        <th>Password (Hashed)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Akun as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['nama']?></td>
                                        <td style="vertical-align: middle;"><?=$key['password']?></td>
                                        <td>
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['id'].'|'.$key['nama'].'|'.$key['password']?>"><i class="notika-icon notika-next"></i></button>
                                                <button class="btn btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['id']?>"><i class="notika-icon notika-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalInputAkunInstansi" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Username</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="Username">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Password</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="Input"><b>SIMPAN</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEditAkunInstansi" role="dialog">
        <div class="modal-dialog modal-sm" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-example-wrap" style="padding: 5px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Username</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="hidden" class="form-control input-sm" id="Id">
                                                    <input type="text" class="form-control input-sm" id="_Username">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <label class="hrzn-fm"><b>Password</b></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_Password" placeholder="Isi Jika Ganti Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-success notika-btn-success" id="Edit"><b>SIMPAN</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery
		============================================ -->
        <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="../js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="../js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="../js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="../js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <!-- meanmenu JS
		============================================ -->
        <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
    <script src="../js/main.js"></script>
    <script>
        var BaseURL = '<?=base_url()?>'
        jQuery(document).ready(function($) {
            $("#Input").click(function() {
                if ($("#Username").val() == "") {
                    alert('Input Username Belum Benar!')
                } else if ($("#Password").val() == "") {
                    alert('Input Password Belum Benar!')
                } else {
                    var Akun = { nama: $("#Username").val(),
                                 password: $("#Password").val() }
                    $.post(BaseURL+"Admin/InputAkunInstansi", Akun).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/AkunInstansi"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })
            
            $(document).on("click",".Edit",function(){
                var Data = $(this).attr('Edit')
                var Pisah = Data.split("|");
                $("#Id").val(Pisah[0])
                $("#_Username").val(Pisah[1])
                $('#ModalEditAkunInstansi').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Username").val() == "") {
                    alert('Input Username Belum Benar!')
                } else {
                    var Akun = { id: $("#Id").val(), 
                                 nama: $("#_Username").val(),
                                 password: $("#_Password").val() }
                    $.post(BaseURL+"Admin/EditAkunInstansi", Akun).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL+"Admin/AkunInstansi"
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $(".Hapus").click(function() {
                var Akun = { id: $(this).attr('Hapus') }
                $.post(BaseURL+"Admin/HapusAkunInstansi", Akun).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL+"Admin/AkunInstansi"
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })  
    </script>

</body>
</html>