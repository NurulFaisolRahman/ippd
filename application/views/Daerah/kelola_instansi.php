<?php $this->load->view('Daerah/sidebar'); ?>

    <!-- Main Content -->
    <div class="main-content">
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputInstansi"><i class="notika-icon notika-edit"></i> <b>Tambah Instansi</b></button>
                                <?php } ?>
                                <button type="button" class="btn btn-info notika-btn-info" id="toggleFilter"><i class="notika-icon notika-filter"></i> <b>Filter Tahun</b></button>
                            </div>
                            <!-- Filter Tahun (Tersembunyi awalnya) -->
                            <div id="filterSection" class="filter-section" style="display: none; margin-top: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 5px;">
                                <div style="display: inline-block; margin-right: 20px;">
                                    <label style="margin-right: 5px;"><b>Tahun Mulai:</b></label>
                                    <select id="filterTahunMulai" style="margin-right: 10px; padding: 5px;">
                                        <option value="">Semua Tahun Mulai</option>
                                    </select>
                                </div>
                                <div style="display: inline-block; margin-right: 20px;">
                                    <label style="margin-right: 5px;"><b>Tahun Akhir:</b></label>
                                    <select id="filterTahunAkhir" style="margin-right: 10px; padding: 5px;">
                                        <option value="">Semua Tahun Akhir</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" id="applyFilter" style="padding: 5px 10px;"><b>Pilih</b></button>
                                <button type="button" class="btn btn-default btn-sm" id="clearFilter" style="padding: 5px 10px; margin-left: 5px;"><b>Hapus</b></button>
                            </div>
                                <!-- <h2>Basic Example</h2>
                                <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p> -->
                            </div>
                            <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Username / Nama Perangkat daerah</th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th>Password (Hashed)</th>
                                        <th>Tahun Mulai</th>
                                        <th>Tahun Akhir</th>
                                        <th class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Akun as $key) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;" class="text-center"><?=$No++?></td>
                                        <td style="vertical-align: middle;"><?=$key['nama']?></td>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <td style="vertical-align: middle;"><?=$key['password']?></td>
                                        <td style="vertical-align: middle;" data-tahun-mulai="<?=$key['tahun_mulai']?>"><?=$key['tahun_mulai']?></td>
                                        <td style="vertical-align: middle;" data-tahun-akhir="<?=$key['tahun_akhir']?>"><?=$key['tahun_akhir']?></td>
                                        <td class="text-center">
                                            <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" Edit="<?=$key['id'].'|'.$key['nama'].'|'.$key['password'].'|'.$key['tahun_mulai'].'|'.$key['tahun_akhir']?>"><i class="notika-icon notika-edit"></i></button>
                                                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" Hapus="<?=$key['id']?>"><i class="notika-icon notika-trash"></i></button>
                                            </div>
                                        </td>
                                        <?php } ?>
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
    <div class="modal fade" id="ModalInputInstansi" role="dialog">
        <div class="modal-dialog modal-md" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama Perangkat Daerah</b></label>
                                            </div>
                                            <div class="col-lg-8">
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Password</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TahunMulai" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="TahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-8">
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
    <div class="modal fade" id="ModalEditInstansi" role="dialog">
        <div class="modal-dialog modal-md" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Nama Perangkat Daerah</b></label>
                                            </div>
                                            <div class="col-lg-8">
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
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Password</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_Password" placeholder="Isi Jika Ganti Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Tahun Mulai</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_TahunMulai">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label class="hrzn-fm"><b>Tahun Akhir</b></label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control input-sm" id="_TahunAkhir">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int">
                                    <div class="row">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="col-lg-8">
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
    <script src="../js/main.js"></script>
    <script>
        var BaseURL = '<?=base_url()?>'
        jQuery(document).ready(function($) {
            var table = $('#data-table-basic').DataTable(); // Asumsi DataTables sudah diinisialisasi

            // Toggle filter section
            $('#toggleFilter').click(function() {
                $('#filterSection').slideToggle(300); // Animasi slide untuk tampilan halus
                var icon = $(this).find('i');
                if (icon.hasClass('notika-filter')) {
                    icon.removeClass('notika-filter').addClass('notika-close');
                    $(this).html('<i class="notika-icon notika-close"></i> <b>Sembunyikan Filter</b>');
                } else {
                    icon.removeClass('notika-close').addClass('notika-filter');
                    $(this).html('<i class="notika-icon notika-filter"></i> <b>Filter Tahun</b>');
                }
            });

            // Generate opsi tahun (2000-2030)
            var currentYear = new Date().getFullYear();
            var startYear = 2000;
            var endYear = currentYear + 5;
            var tahunMulaiOptions = '<option value="">Semua Tahun Mulai</option>';
            var tahunAkhirOptions = '<option value="">Semua Tahun Akhir</option>';
            for (var y = startYear; y <= endYear; y++) {
                tahunMulaiOptions += '<option value="' + y + '">' + y + '</option>';
                tahunAkhirOptions += '<option value="' + y + '">' + y + '</option>';
            }
            $('#filterTahunMulai').html(tahunMulaiOptions);
            $('#filterTahunAkhir').html(tahunAkhirOptions);

            // Apply filter
            $('#applyFilter').click(function() {
                var tahunMulai = $('#filterTahunMulai').val();
                var tahunAkhir = $('#filterTahunAkhir').val();

                // Clear previous filters
                table.columns().search('');

                // Filter kolom Tahun Mulai (index 3)
                if (tahunMulai) {
                    table.column(3).search('^' + tahunMulai + '$', true, false).draw();
                }

                // Filter kolom Tahun Akhir (index 4)
                if (tahunAkhir) {
                    table.column(4).search('^' + tahunAkhir + '$', true, false).draw();
                }

                // Jika keduanya dipilih, filter gabungan
                if (tahunMulai && tahunAkhir) {
                    table.draw();
                }
            });

            // Clear filter
            $('#clearFilter').click(function() {
                $('#filterTahunMulai').val('');
                $('#filterTahunAkhir').val('');
                table.search('').columns().search('').draw();
            });

            $("#Input").click(function() {
                if ($("#Username").val() == "") {
                    alert('Input Username Belum Benar!')
                } else if ($("#Password").val() == "") {
                    alert('Input Password Belum Benar!')
                } else if ($("#TahunMulai").val() == "") {
                    alert('Input Tahun Mulai Belum Benar!')
                } else if ($("#TahunAkhir").val() == "") {
                    alert('Input Tahun Akhir Belum Benar!')
                } else {
                    var Akun = { 
                        nama: $("#Username").val(),
                        password: $("#Password").val(),
                        tahun_mulai: $("#TahunMulai").val(),
                        tahun_akhir: $("#TahunAkhir").val()
                    }
                    $.post(BaseURL+"Daerah/InputInstansi", Akun).done(function(Respon) {
                        if (Respon == '1') {
                            window.location.reload()
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
                $("#_Password").val(Pisah[2])
                $("#_TahunMulai").val(Pisah[3])
                $("#_TahunAkhir").val(Pisah[4])
                $('#ModalEditInstansi').modal("show")
            })

            $("#Edit").click(function() {
                if ($("#_Username").val() == "") {
                    alert('Input Username Belum Benar!')
                } else if ($("#_TahunMulai").val() == "") {
                    alert('Input Tahun Mulai Belum Benar!')
                } else if ($("#_TahunAkhir").val() == "") {
                    alert('Input Tahun Akhir Belum Benar!')
                } else {
                    var Akun = { 
                        id: $("#Id").val(), 
                        nama: $("#_Username").val(),
                        password: $("#_Password").val(),
                        tahun_mulai: $("#_TahunMulai").val(),
                        tahun_akhir: $("#_TahunAkhir").val()
                    }
                    $.post(BaseURL+"Daerah/EditInstansi", Akun).done(function(Respon) {
                        if (Respon == '1') {
                            window.location.reload()
                        } else {
                            alert(Respon)
                        }
                    })                         
                }
            })

            $('#data-table-basic tbody').on('click', '.Hapus', function () {
                var Akun = { id: $(this).attr('Hapus') }
                $.post(BaseURL+"Daerah/HapusInstansi", Akun).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload()
                    } else {
                        alert(Respon)
                    }
                })                         
            })
        })  
    </script>

</body>
</html>