<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        
                        <!-- Filter untuk pengguna yang belum login -->
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
                                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
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
                        <?php } ?>

                        <!-- Info Wilayah -->
                        <?php if (!empty($KodeWilayah)) { ?>
                            <?php 
                                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                            ?>
                            <div class="alert alert-info" style="margin-bottom: 20px;">
                                <strong>Wilayah:</strong> <?= $nama_wilayah ?>
                            </div>
                        <?php } ?>

                        <!-- Tombol Tambah -->
                        <div class="basic-tb-hd">
                            <div class="button-icon-btn sm-res-mg-t-30">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTahapan">
                                    <i class="notika-icon bi-plus-lg"></i> <b>Tambah Tahapan Arah Kebijakan</b>
                                </button>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Tabel -->
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 18%;">Periode</th>
                                        <th style="width: 22%;">Misi</th>
                                        <th style="width: 13%;">Tahap I<br><small>2025-2029</small></th>
                                        <th style="width: 13%;">Tahap II<br><small>2030-2034</small></th>
                                        <th style="width: 13%;">Tahap III<br><small>2035-2039</small></th>
                                        <th style="width: 13%;">Tahap IV<br><small>2040-2045</small></th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <th style="width: 10%;" class="text-center">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; ?>
                                    <?php if (!empty($TahapanArahKebijakan)) { ?>
                                        <?php foreach ($TahapanArahKebijakan as $key) { ?>
                                        <tr>
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['Periode'] ?? '-') ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['Misi']) ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['tahap_1'] ?? '-') ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['tahap_2'] ?? '-') ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['tahap_3'] ?? '-') ?></td>
                                            <td style="vertical-align: middle;"><?= html_escape($key['tahap_4'] ?? '-') ?></td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
                                                    <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit" 
                                                            Edit="<?= $key['Id'] ?>">
                                                        <i class="notika-icon notika-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus" 
                                                            Hapus="<?= $key['Id'] ?>">
                                                        <i class="notika-icon notika-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="<?= (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) ? '8' : '7' ?>" class="text-center">
                                                <em>Belum ada data Tahapan Arah Kebijakan</em>
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
</div>

<!-- ============================================================
MODAL INPUT
============================================================ -->
<div class="modal fade" id="ModalInputTahapan" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Tambah Tahapan Arah Kebijakan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap">
                            <div class="form-example-int form-horizental">
                                
                                <!-- ========================================= -->
                                <!-- STEP 1: PILIH PERIODE (WAJIB)            -->
                                <!-- ========================================= -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputPeriode">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php 
                                                    if (!empty($PeriodeList)) {
                                                        foreach ($PeriodeList as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>">
                                                                <?= html_escape($p['Periode']) ?>
                                                            </option>
                                                        <?php } 
                                                    } else { ?>
                                                        <option value="">Tidak ada periode dengan misi</option>
                                                    <?php } ?>
                                                </select>
                                                <small class="text-muted text-danger"><b>Wajib</b> - Pilih periode untuk melihat daftar misi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========================================= -->
                                <!-- STEP 2: PILIH MISI (WAJIB)               -->
                                <!-- ========================================= -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="InputIdMisi" disabled>
                                                    <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                                                </select>
                                                <small class="text-muted text-danger" id="InputMisiInfo"><b>Wajib</b> - Pilih misi yang akan diisi tahapannya</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========================================= -->
                                <!-- PEMBATAS                                    -->
                                <!-- ========================================= -->
                                <hr style="border-top: 2px dashed #ccc; margin: 20px 0;">

                                <!-- ========================================= -->
                                <!-- TAHAPAN (OPSIONAL)                        -->
                                <!-- ========================================= -->
                                <div class="alert alert-info" style="margin-bottom: 15px;">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Tahapan bersifat opsional</strong> - Anda dapat mengisi sebagian atau semua tahapan, atau kosongkan semua.
                                </div>

                                <!-- Tahap I -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap I<br><small>2025-2029</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="InputTahap1" placeholder="Kosongkan jika belum diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap II -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap II<br><small>2030-2034</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="InputTahap2" placeholder="Kosongkan jika belum diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap III -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap III<br><small>2035-2039</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="InputTahap3" placeholder="Kosongkan jika belum diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap IV -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap IV<br><small>2040-2045</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="InputTahap4" placeholder="Kosongkan jika belum diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-example-int" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="BtnInput"><b>SIMPAN</b></button>
                                        <button class="btn btn-danger notika-btn-danger" data-dismiss="modal"><b>BATAL</b></button>
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

<!-- ============================================================
MODAL EDIT
============================================================ -->
<div class="modal fade" id="ModalEditTahapan" role="dialog">
    <div class="modal-dialog modals-default" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);overflow-x: hidden;overflow-y: auto;max-height: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Edit Tahapan Arah Kebijakan</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-example-wrap">
                            <div class="form-example-int form-horizental">
                                
                                <input type="hidden" id="EditId">
                                <input type="hidden" id="EditCurrentMisiId">

                                <!-- ========================================= -->
                                <!-- STEP 1: PILIH PERIODE (WAJIB)            -->
                                <!-- ========================================= -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Periode</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditPeriode">
                                                    <option value="">-- Pilih Periode --</option>
                                                    <?php 
                                                    if (!empty($PeriodeList)) {
                                                        foreach ($PeriodeList as $p) { ?>
                                                            <option value="<?= $p['Id'] ?>">
                                                                <?= html_escape($p['Periode']) ?>
                                                            </option>
                                                        <?php } 
                                                    } else { ?>
                                                        <option value="">Tidak ada periode dengan misi</option>
                                                    <?php } ?>
                                                </select>
                                                <small class="text-muted text-danger"><b>Wajib</b> - Pilih periode untuk melihat daftar misi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========================================= -->
                                <!-- STEP 2: PILIH MISI (WAJIB)               -->
                                <!-- ========================================= -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Misi</b> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <select class="form-control" id="EditIdMisi" disabled>
                                                    <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                                                </select>
                                                <small class="text-muted text-danger"><b>Wajib</b> - Pilih misi yang akan diisi tahapannya</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========================================= -->
                                <!-- PEMBATAS                                    -->
                                <!-- ========================================= -->
                                <hr style="border-top: 2px dashed #ccc; margin: 20px 0;">

                                <!-- ========================================= -->
                                <!-- TAHAPAN (OPSIONAL)                        -->
                                <!-- ========================================= -->
                                <div class="alert alert-info" style="margin-bottom: 15px;">
                                    <i class="fa fa-info-circle"></i> 
                                    <strong>Tahapan bersifat opsional</strong> - Anda dapat mengisi sebagian atau semua tahapan.
                                </div>

                                <!-- Tahap I -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap I<br><small>2025-2029</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="EditTahap1" placeholder="Kosongkan jika tidak diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap II -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap II<br><small>2030-2034</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="EditTahap2" placeholder="Kosongkan jika tidak diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap III -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap III<br><small>2035-2039</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="EditTahap3" placeholder="Kosongkan jika tidak diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tahap IV -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="hrzn-fm"><b>Tahap IV<br><small>2040-2045</small></b></label>
                                            <span class="text-muted"><br><small>(Opsional)</small></span>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="nk-int-st">
                                                <textarea class="form-control" rows="2" id="EditTahap4" placeholder="Kosongkan jika tidak diisi"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-example-int" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-9">
                                        <button class="btn btn-success notika-btn-success" id="BtnEdit"><b>UPDATE</b></button>
                                        <button class="btn btn-danger notika-btn-danger" data-dismiss="modal"><b>BATAL</b></button>
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

<!-- CSS -->
<style>
.filter-row {
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
    gap: 10px;
}
.filter-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.filter-group label {
    font-size: 14px;
    margin-bottom: 5px;
}
.filter-select {
    width: 260px;
    font-size: 14px;
    padding: 5px 8px;
}
@media (max-width: 768px) {
    .filter-row {
        flex-direction: column;
        gap: 15px;
    }
    .filter-select {
        width: 100%;
    }
}
.table th {
    text-align: center;
    vertical-align: middle;
}
.modal-body {
    padding: 20px 30px;
}
.modal-dialog {
    max-width: 800px;
}
.text-danger {
    color: #ff0000;
}
.text-muted {
    color: #888;
}
.alert-info {
    background-color: #d9edf7;
    border-color: #bce8f1;
    color: #31708f;
    padding: 10px 15px;
    border-radius: 4px;
}
hr {
    margin: 20px 0;
    border: 0;
    border-top: 2px dashed #ccc;
}
</style>

<!-- ============================================================
JAVASCRIPT
============================================================ -->
<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/data-table/data-table-act.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

jQuery(document).ready(function($) {

    // ============================================================
    // FILTER WILAYAH
    // ============================================================
    <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
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
                success: function(Respon) {
                    var Data = JSON.parse(Respon);
                    var KabKota = '<option value="">Pilih Kab/Kota</option>';
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                        }
                    }
                    $("#KabKota").html(KabKota).prop('disabled', false);
                },
                error: function() {
                    alert("Gagal memuat data Kab/Kota");
                    $("#KabKota").prop('disabled', false);
                }
            });
        });

        $("#Filter").click(function() {
            if ($("#Provinsi").val() === "") {
                alert("Mohon Pilih Provinsi");
                return;
            }
            if ($("#KabKota").val() === "") {
                alert("Mohon Pilih Kab/Kota");
                return;
            }
            var kodeWilayah = $("#KabKota").val();
            $.ajax({
                url: BaseURL + "Daerah/SetTempKodeWilayah",
                type: "POST",
                data: { KodeWilayah: kodeWilayah, [CSRF_NAME]: CSRF_TOKEN },
                beforeSend: function() { $("#Filter").prop('disabled', true).text('Memuat...'); },
                success: function(Respon) {
                    if (Respon === '1') {
                        window.location.href = BaseURL + "Daerah/TahapanArahKebijakan";
                    } else {
                        alert(Respon || "Gagal menyimpan filter wilayah!");
                        $("#Filter").prop('disabled', false).text('Filter');
                    }
                },
                error: function() {
                    alert("Gagal menghubungi server!");
                    $("#Filter").prop('disabled', false).text('Filter');
                }
            });
        });

        <?php if (!empty($KodeWilayah)) { ?>
            var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
            var kodeKab = "<?= $KodeWilayah ?>";
            $("#Provinsi").val(kodeProv);
            $.ajax({
                url: BaseURL + "Daerah/GetListKabKota",
                type: "POST",
                data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                success: function(Respon) {
                    var Data = JSON.parse(Respon);
                    var KabKota = '<option value="">Pilih Kab/Kota</option>';
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                            KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                        }
                    }
                    $("#KabKota").html(KabKota);
                }
            });
        <?php } ?>
    <?php } ?>

    // ============================================================
    // LOAD MISI BY PERIODE (INPUT)
    // ============================================================
    $("#InputPeriode").change(function() {
        var periodeId = $(this).val();
        var $misiSelect = $("#InputIdMisi");
        var $info = $("#InputMisiInfo");
        
        if (periodeId == "") {
            $misiSelect.html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
            $misiSelect.prop('disabled', true);
            $info.html('<b class="text-danger">Wajib</b> - Pilih misi yang akan diisi tahapannya');
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetMisiByPeriodeArahKebijakan",
            type: "POST",
            data: { Id: periodeId, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { 
                $misiSelect.prop('disabled', true);
                $misiSelect.html('<option value="">Memuat data...</option>');
                $info.text('Memuat daftar misi...');
            },
            success: function(Respon) {
                var Data = JSON.parse(Respon);
                var Misi = '<option value="">-- Pilih Misi --</option>';
                
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var exists = Data[i].hasData || false;
                        var disabled = exists ? 'disabled' : '';
                        var label = Data[i].Misi;
                        if (exists) {
                            label += ' (Sudah Ada)';
                        }
                        Misi += '<option value="' + Data[i].Id + '" ' + disabled + '>' + label + '</option>';
                    }
                    $info.html('<b class="text-danger">Wajib</b> - Tersedia ' + Data.length + ' misi untuk periode ini');
                } else {
                    Misi = '<option value="">Tidak ada misi untuk periode ini</option>';
                    $info.html('<b class="text-warning">Perhatian</b> - Silakan tambahkan misi terlebih dahulu');
                }
                
                $misiSelect.html(Misi).prop('disabled', false);
            },
            error: function() {
                alert("Gagal memuat data Misi");
                $misiSelect.html('<option value="">-- Error Memuat Data --</option>');
                $misiSelect.prop('disabled', false);
                $info.text('Gagal memuat data');
            }
        });
    });

    // ============================================================
    // LOAD MISI BY PERIODE (EDIT)
    // ============================================================
    $("#EditPeriode").change(function() {
        var periodeId = $(this).val();
        var $misiSelect = $("#EditIdMisi");
        var currentMisiId = $("#EditCurrentMisiId").val();
        
        if (periodeId == "") {
            $misiSelect.html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
            $misiSelect.prop('disabled', true);
            return;
        }
        
        $.ajax({
            url: BaseURL + "Daerah/GetMisiByPeriodeArahKebijakan",
            type: "POST",
            data: { Id: periodeId, [CSRF_NAME]: CSRF_TOKEN },
            beforeSend: function() { 
                $misiSelect.prop('disabled', true);
                $misiSelect.html('<option value="">Memuat data...</option>');
            },
            success: function(Respon) {
                var Data = JSON.parse(Respon);
                var Misi = '<option value="">-- Pilih Misi --</option>';
                
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        var selected = (Data[i].Id == currentMisiId) ? 'selected' : '';
                        var exists = Data[i].hasData && Data[i].Id != currentMisiId;
                        var disabled = exists ? 'disabled' : '';
                        var label = Data[i].Misi;
                        if (exists) {
                            label += ' (Sudah Ada)';
                        }
                        Misi += '<option value="' + Data[i].Id + '" ' + selected + ' ' + disabled + '>' + label + '</option>';
                    }
                } else {
                    Misi = '<option value="">Tidak ada misi untuk periode ini</option>';
                }
                
                $misiSelect.html(Misi).prop('disabled', false);
            },
            error: function() {
                alert("Gagal memuat data Misi");
                $misiSelect.html('<option value="">-- Error Memuat Data --</option>');
                $misiSelect.prop('disabled', false);
            }
        });
    });

    // ============================================================
// INPUT TAHAPAN ARAH KEBIJAKAN
// ============================================================
$("#BtnInput").click(function() {
    var idMisi = $("#InputIdMisi").val();
    var tahap1 = $("#InputTahap1").val().trim();
    var tahap2 = $("#InputTahap2").val().trim();
    var tahap3 = $("#InputTahap3").val().trim();
    var tahap4 = $("#InputTahap4").val().trim();

    // ===== VALIDASI: Misi WAJIB =====
    if (idMisi == "") {
        alert("⚠️ Periode dan Misi wajib dipilih terlebih dahulu!");
        $("#InputPeriode").focus();
        return;
    }

    var data = {
        IdMisi: idMisi,
        tahapan: [tahap1, tahap2, tahap3, tahap4],
        [CSRF_NAME]: CSRF_TOKEN
    };

    $("#BtnInput").prop('disabled', true).text('Menyimpan...');
    
    $.post(BaseURL + "Daerah/InputTahapanArahKebijakan", data)
        .done(function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                
                if (result.status === 'success') {
                    // ===== LANGSUNG REFRESH HALAMAN =====
                    window.location.reload();
                } else {
                    alert(result.message || 'Terjadi kesalahan!');
                    $("#BtnInput").prop('disabled', false).text('SIMPAN');
                }
            } catch(e) {
                alert('Terjadi kesalahan pada server!');
                $("#BtnInput").prop('disabled', false).text('SIMPAN');
            }
        })
        .fail(function() {
            alert("Terjadi kesalahan pada server!");
            $("#BtnInput").prop('disabled', false).text('SIMPAN');
        });
});

    // ============================================================
    // EDIT TAHAPAN ARAH KEBIJAKAN
    // ============================================================
    $(document).on("click", ".Edit", function() {
        var id = $(this).attr('Edit');
        
        $.ajax({
            url: BaseURL + "Daerah/GetTahapanArahKebijakanById",
            type: "POST",
            data: { Id: id, [CSRF_NAME]: CSRF_TOKEN },
            success: function(Respon) {
                var Data = JSON.parse(Respon);
                if (Data && Data.Id) {
                    $("#EditId").val(Data.Id);
                    $("#EditCurrentMisiId").val(Data.IdMisi);
                    
                    $("#EditTahap1").val(Data.tahap_1 || '');
                    $("#EditTahap2").val(Data.tahap_2 || '');
                    $("#EditTahap3").val(Data.tahap_3 || '');
                    $("#EditTahap4").val(Data.tahap_4 || '');
                    
                    $("#EditPeriode").val(Data.visi_id || '');
                    
                    if (Data.visi_id) {
                        $("#EditPeriode").trigger('change');
                    }
                    
                    $('#ModalEditTahapan').modal('show');
                } else {
                    alert("Data tidak ditemukan!");
                }
            },
            error: function() {
                alert("Gagal mengambil data!");
            }
        });
    });

    // ============================================================
// EDIT - UPDATE
// ============================================================
$("#BtnEdit").click(function() {
    var id = $("#EditId").val();
    var idMisi = $("#EditIdMisi").val();
    var tahap1 = $("#EditTahap1").val().trim();
    var tahap2 = $("#EditTahap2").val().trim();
    var tahap3 = $("#EditTahap3").val().trim();
    var tahap4 = $("#EditTahap4").val().trim();

    if (!id) {
        alert("ID tidak valid!");
        return;
    }

    // ===== VALIDASI: Misi WAJIB =====
    if (idMisi == "") {
        alert("⚠️ Periode dan Misi wajib dipilih terlebih dahulu!");
        $("#EditPeriode").focus();
        return;
    }

    var data = {
        Id: id,
        IdMisi: idMisi,
        tahapan: [tahap1, tahap2, tahap3, tahap4],
        [CSRF_NAME]: CSRF_TOKEN
    };

    $("#BtnEdit").prop('disabled', true).text('Menyimpan...');
    
    $.post(BaseURL + "Daerah/EditTahapanArahKebijakan", data)
        .done(function(Respon) {
            try {
                var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
                
                if (result.status === 'success') {
                    // ===== LANGSUNG REFRESH HALAMAN =====
                    window.location.reload();
                } else {
                    alert(result.message || 'Terjadi kesalahan!');
                    $("#BtnEdit").prop('disabled', false).text('UPDATE');
                }
            } catch(e) {
                alert('Terjadi kesalahan pada server!');
                $("#BtnEdit").prop('disabled', false).text('UPDATE');
            }
        })
        .fail(function() {
            alert("Terjadi kesalahan pada server!");
            $("#BtnEdit").prop('disabled', false).text('UPDATE');
        });
});

// ============================================================
// HAPUS TAHAPAN ARAH KEBIJAKAN
// ============================================================
$(document).on("click", ".Hapus", function() {
    var id = $(this).attr('Hapus');
    
    $.post(BaseURL + "Daerah/HapusTahapanArahKebijakan", {
        Id: id,
        [CSRF_NAME]: CSRF_TOKEN
    }).done(function(Respon) {
        try {
            var result = typeof Respon === 'string' ? JSON.parse(Respon) : Respon;
            
            if (result.status === 'success') {
                // ===== LANGSUNG REFRESH HALAMAN =====
                window.location.reload();
            } else {
                alert(result.message || 'Gagal menghapus data!');
            }
        } catch(e) {
            alert('Terjadi kesalahan pada server!');
        }
    }).fail(function() {
        alert("Terjadi kesalahan pada server!");
    });
});

    // ============================================================
    // RESET MODAL SAAT DITUTUP
    // ============================================================
    $('#ModalInputTahapan').on('hidden.bs.modal', function() {
        $("#InputPeriode").val('');
        $("#InputIdMisi").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
        $("#InputIdMisi").prop('disabled', true);
        $("#InputTahap1, #InputTahap2, #InputTahap3, #InputTahap4").val('');
        $("#InputMisiInfo").html('<b class="text-danger">Wajib</b> - Pilih misi yang akan diisi tahapannya');
        $("#BtnInput").prop('disabled', false).text('SIMPAN');
    });

    $('#ModalEditTahapan').on('hidden.bs.modal', function() {
        $("#EditId").val('');
        $("#EditCurrentMisiId").val('');
        $("#EditPeriode").val('');
        $("#EditIdMisi").html('<option value="">-- Pilih Periode Terlebih Dahulu --</option>');
        $("#EditIdMisi").prop('disabled', true);
        $("#EditTahap1, #EditTahap2, #EditTahap3, #EditTahap4").val('');
        $("#BtnEdit").prop('disabled', false).text('UPDATE');
    });

});
</script>

</body>
</html>