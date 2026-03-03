<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">

                        <!-- ================= FILTER PROVINSI & KAB/KOTA ================= -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                        <div class="form-example-wrap" style="margin-bottom:20px;">
                            <div class="form-example-int form-horizental">
                                <div class="form-group">
                                    <div class="row filter-row">
                                        <div class="col-lg-3 col-md-6">
                                            <label><b>Provinsi</b></label>
                                            <select class="form-control filter-select" id="Provinsi">
                                                <option value="">Pilih Provinsi</option>
                                                <?php foreach ($Provinsi as $prov) { ?>
                                                    <option value="<?= html_escape($prov['Kode']) ?>"
                                                        <?= (substr($KodeWilayah ?? '', 0, 2) === $prov['Kode']) ? 'selected' : '' ?>>
                                                        <?= html_escape($prov['Nama']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <label><b>Kab/Kota</b></label>
                                            <select class="form-control filter-select" id="KabKota">
                                                <option value="">Pilih Kab/Kota</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <label>&nbsp;</label>
                                            <button class="btn btn-primary notika-btn-primary btn-block" id="Filter">
                                                <b>Filter</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <?php if (!empty($NamaWilayah)) { ?>
                            <div class="alert alert-info">
                                <strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?>
                            </div>
                        <?php } ?>
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
                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3 && $UrusanAktif) { ?>
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
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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
                                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning btn-sm BtnEdit"
                                                            data-json='<?= json_encode($row) ?>'>
                                                            <i class="notika-icon notika-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger BtnHapus"
                                                            data-id="<?= $row['id'] ?>">
                                                            <i class="notika-icon notika-trash"></i>
                                                        </button>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
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
                   <h3 class="modal-title" id="ModalLevelTitle">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                     Form Indikator Urusan
                </div>
                <div class="modal-body">
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= JAVASCRIPT ================= -->
<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

$('#data-table-basic').DataTable({ ordering: false });

// AUTO LOAD KAB/KOTA DARI SESSION JIKA FILTER SEDANG TAMPIL
<?php if (!isset($_SESSION['KodeWilayah']) && !empty($KodeWilayah)) { ?>
    var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
    var kodeKab  = "<?= $KodeWilayah ?>";

    $("#Provinsi").val(kodeProv);

    $.ajax({
        url: BaseURL + "Daerah/GetListKabKota",
        type: "POST",
        data: { 
            Kode: kodeProv, 
            [CSRF_NAME]: CSRF_TOKEN 
        },
        success: function(res) {
            var data = (typeof res === 'string') ? JSON.parse(res) : res;
            var options = '<option value="">Pilih Kab/Kota</option>';
            if (data && data.length > 0) {
                $.each(data, function(i, item) {
                    var selected = (item.Kode === kodeKab) ? 'selected' : '';
                    options += '<option value="' + item.Kode + '" ' + selected + '>' + item.Nama + '</option>';
                });
            }
            $("#KabKota").html(options);
        },
        error: function() {
            console.log("Gagal auto load kab/kota");
        }
    });
<?php } ?>

// Change Provinsi
$("#Provinsi").change(function() {
    if ($(this).val() === "") {
        $("#KabKota").html('<option value="">Pilih Kab/Kota</option>');
        return;
    }
    $.ajax({
        url: BaseURL + "Daerah/GetListKabKota",
        type: "POST",
        data: { Kode: $(this).val(), [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#KabKota").prop('disabled', true); },
        success: function(res) {
            var Data = (typeof res === 'string') ? JSON.parse(res) : res;
            var KabKota = '<option value="">Pilih Kab/Kota</option>';
            if (Data && Data.length > 0) {
                $.each(Data, function(i, item) {
                    KabKota += '<option value="' + item.Kode + '">' + item.Nama + '</option>';
                });
            } else {
                alert("Belum Ada Data Kab/Kota");
            }
            $("#KabKota").html(KabKota).prop('disabled', false);
        },
        error: function() {
            alert("Gagal memuat data Kab/Kota");
            $("#KabKota").prop('disabled', false);
        }
    });
});

// Tombol Filter
$("#Filter").click(function() {
    if ($("#Provinsi").val() === "") return alert("Mohon Pilih Provinsi");
    if ($("#KabKota").val() === "") return alert("Mohon Pilih Kab/Kota");
    var kodeWilayah = $("#KabKota").val();
    $.ajax({
        url: BaseURL + "Daerah/SetTempKodeWilayah",
        type: "POST",
        data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
        beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
        success: function(res) {
            if (res === '1') {
                window.location = BaseURL + "Daerah/IkkPD";
            } else {
                alert(res || "Gagal menyimpan filter wilayah!");
                $("#Filter").prop('disabled', false).text('Filter');
            }
        },
        error: function() {
            alert("Gagal menghubungi server!");
            $("#Filter").prop('disabled', false).text('Filter');
        }
    });
});

// Ganti Urusan PD
$("#UrusanPD").change(function(){
    if (!this.value) return;
    window.location = BaseURL + "Daerah/IkkPD?urusan_id=" + this.value;
});

// Simpan IKK (baru / edit)
$("#BtnSimpan").click(function(){
    if ($("#indikator").val().trim() === "") {
        alert("Indikator wajib diisi!");
        return;
    }
    var id = $("#EditId").val();
    var url = id ? "EditIkkPD" : "InputIkkPD";
    $.post(BaseURL + "Daerah/" + url, {
        [CSRF_NAME]: CSRF_TOKEN,
        id: id,
        urusan_id: $("#UrusanPD").val(),
        indikator: $("#indikator").val(),
        satuan: $("#satuan").val(),
        baseline_2024: $("#baseline_2024").val(),
        t_2025: $("#t_2025").val(),
        t_2026: $("#t_2026").val(),
        t_2027: $("#t_2027").val(),
        t_2028: $("#t_2028").val(),
        t_2029: $("#t_2029").val(),
        t_2030: $("#t_2030").val(),
        keterangan: $("#keterangan").val()
    }, function(res){
        if (res === '1') location.reload();
        else alert(res);
    });
});

// Edit button
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

// Hapus button
$(document).on("click", ".BtnHapus", function(){
    if (!confirm("Hapus data IKK ini?")) return;
    $.post(BaseURL + "Daerah/HapusIkkPD", {
        id: $(this).data("id"),
        [CSRF_NAME]: CSRF_TOKEN
    }, function(r){
        if (r === '1') location.reload();
        else alert(r);
    });
});
</script>