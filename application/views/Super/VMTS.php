<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin IPPD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
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
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!-- <div class="logo-area">
                        <a href="#"><img src="../img/logo/logo.png" alt="" /></a>
                    </div> -->
                    <h3 style="color: white;margin-top: 10px;">Admin</h3>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                        </ul>
                    </div>
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
															<li><a data-toggle="collapse" data-target="#VMTS" href="#"?>"><b>VMTS</b></a>
																	<ul class="collapse dropdown-header-top">
																			<li>
																					<a href="<?=base_url('Super/VMTS')?>"><i class="notika-icon notika-house"></i> <b>VMTS</b></a>
																			</li>
																	</ul>
															</li>
															<li><a data-toggle="collapse" data-target="#Kementerian" href="#"><b>Kementerian</b></a>
																	<ul class="collapse dropdown-header-top">
																			<li>
																					<a href="<?=base_url('Super/Kementerian')?>"><i class="notika-icon notika-form"></i> <b>Kementerian</b></a>
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
                        <li class="active"><a data-toggle="tab" href="#VMTS"><i class="notika-icon notika-form"></i> <b>VMTS</b></a></li>
                        <li><a data-toggle="tab" href="#Kementerian"><i class="notika-icon notika-house"></i> <b>Kementerian</b></a></li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="VMTS" class="tab-pane in active notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/VMTS')?>"><i class="notika-icon notika-house"></i> <b>VMTS</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="Kementerian" class="tab-pane in notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/Kementerian')?>"><i class="notika-icon notika-form"></i> <b>Kementerian</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                                                <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputVMTS">
                                <i class="notika-icon notika-house"></i> <b>Input VMTS</b>
                            </button>
                        </div>
                            <!-- <h2>Basic Example</h2>
                            <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p> -->
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Visi</th>
                                        <th>Tahun</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($VMTS as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=explode("<br/>",$key['Visi'])[0]?></td>
                                        <td style="vertical-align: middle;"><?=$key['Tahun']?></td>
                                        <td>
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id']?>"><i class="notika-icon notika-next"></i></button>
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
		<div class="modal fade" id="ModalInputVMTS" role="dialog">
			<div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
													<label class="hrzn-fm"><b>Tahun</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<input type="text" class="form-control input-sm" id="Tahun">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Visi</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="Visi"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Misi</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="Misi"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Tujuan</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="Tujuan"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Sasaran</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="Sasaran"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Tahap Pembangunan</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="Tahap"></textarea>
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
		<div class="modal fade" id="ModalEditVMTS" role="dialog">
			<div class="modal-dialog modal-large" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
													<label class="hrzn-fm"><b>Tahun</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<input type="hidden" class="form-control input-sm" id="Id">
														<input type="text" class="form-control input-sm" id="tahun">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Visi</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="visi" wrap="off"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Misi</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="misi" wrap="off"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Tujuan</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="tujuan" wrap="off"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Sasaran</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="sasaran" wrap="off"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-example-int form-horizental">
										<div class="form-group">
											<div class="row">
												<div class="col-lg-2">
													<label class="hrzn-fm"><b>Tahap Pembangunan</b></label>
												</div>
												<div class="col-lg-9">
													<div class="nk-int-st">
														<textarea class="form-control" rows="3" id="tahap" wrap="off"></textarea>
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
												<button class="btn btn-success notika-btn-success" id="Edit"><b>Update</b></button>
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
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/jquery-price-slider.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/data-table/jquery.dataTables.min.js"></script>
    <script src="../js/data-table/data-table-act.js"></script>
    <!-- main JS
		============================================ -->
		<script src="../js/main.js"></script>
		<script>
			var BaseURL = '<?=base_url()?>'
			jQuery(document).ready(function($) {
				$("#Input").click(function() {
					var VMTS = { Visi: $("#Visi").val().split("\n").join("<br/>"),
											 Misi: $("#Misi").val().split("\n").join("<br/>"),
											 Tujuan: $("#Tujuan").val().split("\n").join("<br/>"),
											 Sasaran: $("#Sasaran").val().split("\n").join("<br/>"),
											 Tahap: $("#Tahap").val().split("\n").join("<br/>"),
											 Tahun: $("#Tahun").val() }
					$.post(BaseURL+"Super/InputVMTS", VMTS).done(function(Respon) {
						if (Respon == '1') {
							window.location = BaseURL+"Super/VMTS"
						} else {
							alert(Respon)
						}
					})                         
				})
				
				$(document).on("click",".Edit",function(){
          $.post(BaseURL+"Super/GetVMTS/"+$(this).attr('Edit')).done(function(Respon) {
						var Data = JSON.parse(Respon)
						$("#Id").val(Data.Id)
            $("#tahun").val(Data.Tahun)
						$("#visi").val(Data.Visi.split("<br/>").join("\n"))
						$("#misi").val(Data.Misi.split("<br/>").join("\n"))
						$("#tujuan").val(Data.Tujuan.split("<br/>").join("\n"))
						$("#sasaran").val(Data.Sasaran.split("<br/>").join("\n"))
						$("#tahap").val(Data.Tahap.split("<br/>").join("\n"))
            $('#ModalEditVMTS').modal("show")
          })
				})

				$("#Edit").click(function() {
					var VMTS = { Visi: $("#visi").val().split("\n").join("<br/>"),
											 Misi: $("#misi").val().split("\n").join("<br/>"),
											 Tujuan: $("#tujuan").val().split("\n").join("<br/>"),
											 Sasaran: $("#sasaran").val().split("\n").join("<br/>"),
											 Tahap: $("#tahap").val().split("\n").join("<br/>"),
											 Id: $("#Id").val(), Tahun: $("#tahun").val() }
					$.post(BaseURL+"Super/EditVMTS", VMTS).done(function(Respon) {
						if (Respon == '1') {
							window.location = BaseURL+"Super/VMTS"
						} else {
							alert(Respon)
						}
					})                         
				})
			})
		</script>
	<!-- tawk chat JS
		============================================ -->
    <!-- <script src="../js/tawk-chat.js"></script> -->
</body>

</html>