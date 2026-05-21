<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- FILTER WILAYAH (Provinsi, Kab/Kota, dan Instansi) - SEBELUM LOGIN -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="Provinsi"><b>Provinsi</b></label>
                                                    <select class="form-control filter-select" id="Provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($Provinsi as $prov) { ?>
                                                            <option value="<?= html_escape($prov['Kode']) ?>"
                                                                <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2)==$prov['Kode']) ? 'selected' : '' ?>>
                                                                <?= html_escape($prov['Nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-6">
                                                <div class="filter-group">
                                                    <label for="KabKota"><b>Kab/Kota</b></label>
                                                    <select class="form-control filter-select" id="KabKota">
                                                        <option value="">Pilih Kab/Kota</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- FILTER INSTANSI SEBELUM LOGIN -->
                                            <div class="col-lg-3 col-md-6" id="FilterInstansiGroupBefore" style="display: none;">
                                                <div class="filter-group">
                                                    <label for="FilterInstansiBeforeLogin"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansiBeforeLogin">
                                                        <option value="">-- Semua Instansi --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                        <b>Filter</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (!empty($KodeWilayah)) { ?>
                                <?php
                                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                    $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                ?>
                                <div class="alert alert-info" style="margin-bottom: 20px;">
                                    <strong>Wilayah terpilih:</strong> <?= $nama_wilayah ?>
                                    <?php 
                                    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
                                    if (!empty($filter_instansi_id)) { 
                                        $instansi_terpilih = $this->db->select('nama')->from('akun_instansi')->where('id', $filter_instansi_id)->get()->row_array();
                                    ?>
                                        <br><strong>Instansi terpilih:</strong> <?= htmlspecialchars($instansi_terpilih['nama'] ?? '-') ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <!-- END FILTER WILAYAH -->

                        <!-- FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) -->
                        <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
                            <div class="form-example-wrap" style="margin-bottom: 20px;">
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row filter-row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="filter-group">
                                                    <label for="FilterInstansi"><b>Filter Instansi</b></label>
                                                    <select class="form-control filter-select" id="FilterInstansi">
                                                        <option value="">-- Semua Instansi --</option>
                                                        <?php foreach ($ListInstansi as $ins) { ?>
                                                            <option value="<?= $ins['id'] ?>" <?= ($FilterInstansiId == $ins['id']) ? 'selected' : '' ?>>
                                                                <?= html_escape($ins['nama']) ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-info notika-btn-info btn-block" id="FilterInstansiBtn">
                                                        <b>Tampilkan</b>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6">
                                                <div class="filter-group" style="margin-top: 28px;">
                                                    <button class="btn btn-default notika-btn-default btn-block" id="ResetFilterBtn">
                                                        <b>Reset</b>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- END FILTER INSTANSI -->

                        <!-- TAMPILKAN NAMA INSTANSI YANG SEDANG LOGIN (UNTUK ROLE 4) -->
                        <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                            <div class="alert alert-success" style="margin-bottom: 20px;">
                                <i class="fa fa-building"></i> <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                                <br><small>Anda hanya dapat melihat dan mengelola data milik instansi Anda sendiri.</small>
                            </div>
                        <?php } ?>

                        <!-- ================= URUSAN PD ================= -->
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-lg-4">
                                <label><b>Urusan PD <span style="color:red">*</span></b></label>
                                <select class="form-control" id="UrusanPD">
                                    <option value="">-- Pilih Urusan --</option>
                                    <?php foreach ($Urusan as $u) { ?>
                                        <option value="<?= $u['id'] ?>"
                                            <?= ($UrusanAktif == $u['id']) ? 'selected' : '' ?>>
                                            <?= html_escape($u['nama_urusan']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if ($IsRole4 && $UrusanAktif) { ?>
                                <div class="col-lg-3" style="margin-top:25px;">
                                    <button class="btn btn-success notika-btn-success"
                                        data-toggle="modal" data-target="#ModalInputIKK">
                                        <i class="notika-icon bi-plus-lg"></i> <b>Tambah IKK</b>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- ================= TABLE ================= -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" width="50">No</th>
                                        <th rowspan="2">Indikator</th>
                                        <th class="text-center" rowspan="2" width="80">Satuan</th>
                                        <th class="text-center" rowspan="2" width="90">Baseline<br>2024</th>
                                        <th class="text-center" colspan="6">Target Tahun</th>
                                        <th rowspan="2">Keterangan</th>
                                        <?php if ($IsRole4) { ?>
                                            <th class="text-center" rowspan="2" width="120">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                    <tr class="text-center">
                                        <th class="text-center">2025</th>
                                        <th class="text-center">2026</th>
                                        <th class="text-center">2027</th>
                                        <th class="text-center">2028</th>
                                        <th class="text-center">2029</th>
                                        <th class="text-center">2030</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($UrusanAktif && !empty($Data)) { ?>
                                        <?php $no = 1; foreach ($Data as $row) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td><?= nl2br(html_escape($row['indikator'])) ?></td>
                                                <td class="text-center"><?= html_escape($row['satuan']) ?></td>
                                                <td class="text-center"><?= $row['baseline_2024'] ?></td>
                                                <td class="text-center"><?= $row['t_2025'] ?></td>
                                                <td class="text-center"><?= $row['t_2026'] ?></td>
                                                <td class="text-center"><?= $row['t_2027'] ?></td>
                                                <td class="text-center"><?= $row['t_2028'] ?></td>
                                                <td class="text-center"><?= $row['t_2029'] ?></td>
                                                <td class="text-center"><?= $row['t_2030'] ?></td>
                                                <td><?= nl2br(html_escape($row['keterangan'])) ?></td>
                                                <?php if ($IsRole4) { ?>
                                                    <td class="text-center">
                                                        <?php if ($InstansiId == ($row['id_instansi'] ?? null)) { ?>
                                                            <button class="btn btn-warning btn-sm BtnEdit"
                                                                data-json='<?= json_encode($row) ?>'>
                                                                <i class="notika-icon notika-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger BtnHapus"
                                                                data-id="<?= $row['id'] ?>">
                                                                <i class="notika-icon notika-trash"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= $IsRole4 ? '12' : '11' ?>" class="text-center">
                                                <?= $UrusanAktif ? 'Belum ada data IKK PD' : 'Silakan pilih Urusan PD terlebih dahulu' ?>
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

    <!-- ================= MODAL INPUT / EDIT ================= -->
    <div class="modal fade" id="ModalInputIKK">
        <div class="modal-dialog modal-lg" style="top:10%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        Form Indikator Urusan
                    </h3>
                </div>
                <div class="modal-body">
                    <?php if ($IsRole4 && !empty($NamaInstansi)) { ?>
                        <div class="alert alert-info">
                            <strong>Instansi:</strong> <?= htmlspecialchars($NamaInstansi) ?>
                        </div>
                    <?php } ?>
                    
                    <input type="hidden" id="EditId">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <label><b>Indikator <span style="color:red">*</span></b></label>
                            <textarea id="indikator" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <br>
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <label><b>Satuan</b></label>
                            <input type="text" id="satuan" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label><b>Baseline 2024</b></label>
                            <input type="number" step="0.01" id="baseline_2024" class="form-control">
                        </div>
                    </div>
                    <br>
                    
                    <div class="row">
                        <?php for ($y = 2025; $y <= 2030; $y++) { ?>
                            <div class="col-lg-2">
                                <label><b><?= $y ?></b></label>
                                <input type="number" step="0.01" id="t_<?= $y ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                    
                    <label><b>Keterangan</b></label>
                    <textarea id="keterangan" class="form-control" rows="3"></textarea>
                    <br>
                    
                    <button class="btn btn-success notika-btn-success" id="BtnSimpan">
                        <b>SIMPAN</b>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <b>BATAL</b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var IS_ROLE_4 = '<?= $IsRole4 ?>';
var IS_LOGGED_IN = '<?= $IsLoggedIn ?>';
var CURRENT_FILTER_INSTANSI = '<?= $FilterInstansiId ?? '' ?>';
var KODE_WILAYAH = '<?= $KodeWilayah ?? '' ?>';

jQuery(document).ready(function($){

    // Inisialisasi DataTable (gunakan ID yang sesuai)
    if ($('#data-table-basic').length > 0) {
        try {
            if ($.fn.DataTable.isDataTable('#data-table-basic')) {
                $('#data-table-basic').DataTable().destroy();
            }
            $('#data-table-basic').DataTable({
                "pageLength": 10,
                "ordering": false,
                "language": {
                    "emptyTable": "Tidak ada data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "drawCallback": function(settings) {
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.find('a').css('margin', '0 5px');
                }
            });
        } catch(e) {
            console.log("DataTable error:", e);
        }
    }

    setTimeout(function() {
        $('.dataTables_paginate a').css('margin', '0 5px');
        $('.dataTables_paginate span a').css('margin', '0 5px');
        $('.dataTables_paginate').css('margin-top', '10px');
        $('.dataTables_info').css('margin', '10px 0');
    }, 100);

    /* ================= FILTER WILAYAH SEBELUM LOGIN ================= */
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>

    $("#Provinsi").change(function() {
        if ($(this).val() === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
            $("#FilterInstansiGroupBefore").hide();
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListKabKota",
            type: "POST",
            data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").hide();
            },
            success: function(Data) {
                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }
                $("#KabKota").html(KabKota).prop('disabled', false);
            },
            error: function() { alert("Gagal memuat data Kab/Kota"); }
        });
    });

    $("#KabKota").change(function() {
        var kabKotaKode = $(this).val();
        if (kabKotaKode === "") {
            $("#FilterInstansiGroupBefore").hide();
            $("#FilterInstansiBeforeLogin").html('<option value="">-- Semua Instansi --</option>');
            return;
        }

        $.ajax({
            url: BaseURL + "Instansi/GetListInstansiLevel4",
            type: "POST",
            data: { kode_wilayah: kabKotaKode, [CSRF_NAME]: CSRF_TOKEN },
            dataType: 'json',
            beforeSend: function() {
                $("#FilterInstansiBeforeLogin").html('<option value="">Memuat...</option>');
                $("#FilterInstansiGroupBefore").show();
            },
            success: function(Data) {
                var options = '<option value="">-- Semua Instansi --</option>';
                if (Data && Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (CURRENT_FILTER_INSTANSI == Data[i].id) ? 'selected' : '';
                        options += '<option value="' + Data[i].id + '" ' + selected + '>' + Data[i].nama + '</option>';
                    }
                }
                $("#FilterInstansiBeforeLogin").html(options);
                $("#FilterInstansiGroupBefore").show();
            },
            error: function() { alert("Gagal memuat data Instansi"); }
        });
    });

    $("#Filter").click(function() {
        if ($("#Provinsi").val() === "") { alert("Mohon Pilih Provinsi"); return; }
        if ($("#KabKota").val() === "") { alert("Mohon Pilih Kab/Kota"); return; }

        var kodeWilayah = $("#KabKota").val();
        var instansiId = $("#FilterInstansiBeforeLogin").val();
        
        $.ajax({
            url: BaseURL + "Instansi/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
            success: function(res) {
                if (res === '1') {
                    var redirectUrl = BaseURL + "Instansi/IkkPD";
                    if (instansiId && instansiId != '') {
                        redirectUrl += "?instansi_id=" + instansiId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            },
            error: function() { alert("Gagal menghubungi server!"); }
        });
    });

    <?php if (!empty($KodeWilayah)) { ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        var kodeKab  = "<?= $KodeWilayah ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
        setTimeout(function() {
            $("#KabKota").val(kodeKab).trigger('change');
            <?php if (!empty($FilterInstansiId)) { ?>
                setTimeout(function() {
                    if ($("#FilterInstansiBeforeLogin option[value='<?= $FilterInstansiId ?>']").length > 0) {
                        $("#FilterInstansiBeforeLogin").val("<?= $FilterInstansiId ?>");
                    }
                }, 800);
            <?php } ?>
        }, 500);
    <?php } ?>

    <?php } ?>

    /* ================= FILTER INSTANSI (UNTUK YANG SUDAH LOGIN DAN BUKAN ROLE 4) ================= */
    <?php if ($IsLoggedIn && !$IsRole4 && !empty($KodeWilayah) && !empty($ListInstansi)) { ?>
        $("#FilterInstansiBtn").click(function() {
            var instansiId = $("#FilterInstansi").val();
            var url = BaseURL + "Instansi/IkkPD";
            if (instansiId && instansiId != '') { url += "?instansi_id=" + instansiId; }
            window.location.href = url;
        });
        $("#ResetFilterBtn").click(function() { window.location.href = BaseURL + "Instansi/IkkPD"; });
    <?php } ?>

    /* ================= EVENT UNTUK FILTER URUSAN (UNTUK SEMUA ROLE) ================= */
    // PERBAIKAN: Event handler untuk ganti Urusan PD
    $("#UrusanPD").change(function(){
        var urusan_id = $(this).val();
        if (!urusan_id) return;
        
        // Reload halaman dengan parameter urusan_id
        var url = BaseURL + "Instansi/IkkPD?urusan_id=" + urusan_id;
        
        // Jika ada filter instansi, tambahkan ke URL
        if (CURRENT_FILTER_INSTANSI && CURRENT_FILTER_INSTANSI !== '') {
            url += "&instansi_id=" + CURRENT_FILTER_INSTANSI;
        }
        
        window.location.href = url;
    });

    // Set dropdown urusan jika ada nilai dari URL
    <?php if (!empty($UrusanAktif)) { ?>
        $("#UrusanPD").val("<?= $UrusanAktif ?>");
    <?php } ?>

    /* ================= CRUD OPERATIONS (HANYA UNTUK ROLE 4) ================= */
    <?php if ($IsRole4) { ?>

    // SIMPAN IKK (baru / edit)
    $("#BtnSimpan").click(function(){
        var indikator = $("#indikator").val().trim();
        var satuan = $("#satuan").val().trim();
        var urusan_id = $("#UrusanPD").val();
        
        console.log("Urusan ID:", urusan_id);
        console.log("Indikator:", indikator);
        console.log("Satuan:", satuan);
        
        if (!urusan_id) {
            alert("Urusan PD wajib dipilih terlebih dahulu!");
            return;
        }
        
        if (indikator === "") {
            alert("Indikator wajib diisi!");
            return;
        }
        
        if (satuan === "") {
            alert("Satuan wajib diisi!");
            return;
        }
        
        var id = $("#EditId").val();
        var url = id ? "EditIkkPD" : "InputIkkPD";
        
        var postData = {
            [CSRF_NAME]: CSRF_TOKEN,
            id: id,
            urusan_id: urusan_id,
            indikator: indikator,
            satuan: satuan,
            baseline_2024: $("#baseline_2024").val(),
            t_2025: $("#t_2025").val(),
            t_2026: $("#t_2026").val(),
            t_2027: $("#t_2027").val(),
            t_2028: $("#t_2028").val(),
            t_2029: $("#t_2029").val(),
            t_2030: $("#t_2030").val(),
            keterangan: $("#keterangan").val()
        };
        
        console.log("Post Data:", postData);
        
        $.ajax({
            url: BaseURL + "Instansi/" + url,
            type: "POST",
            data: postData,
            dataType: 'text',
            success: function(res){
                console.log("Response:", res);
                if (res === '1') {
                    location.reload();
                } else {
                    alert(res || "Gagal menyimpan data!");
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
                console.log("Response Text:", xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });
    });

    // EDIT button
    $(document).on("click", ".BtnEdit", function(){
        var d = JSON.parse($(this).attr("data-json"));
        $("#EditId").val(d.id);
        $("#indikator").val(d.indikator);
        $("#satuan").val(d.satuan);
        $("#baseline_2024").val(d.baseline_2024);
        for (let y = 2025; y <= 2030; y++) {
            $("#t_" + y).val(d["t_" + y] || "");
        }
        $("#keterangan").val(d.keterangan);
        $("#ModalInputIKK").modal("show");
    });

    // HAPUS button
    $(document).on("click", ".BtnHapus", function(){
        if (!confirm("Hapus data IKK ini?")) return;
        $.ajax({
            url: BaseURL + "Instansi/HapusIkkPD",
            type: "POST",
            data: {
                id: $(this).data("id"),
                [CSRF_NAME]: CSRF_TOKEN
            },
            success: function(res){
                if (res === '1') location.reload();
                else alert(res);
            },
            error: function() { alert("Gagal request!"); }
        });
    });

    <?php } ?>
});
</script>
</body>
</html>