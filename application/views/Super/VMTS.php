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
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['Id']?>"><i class="notika-icon notika-next"></i></button>
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