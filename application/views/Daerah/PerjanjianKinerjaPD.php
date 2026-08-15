<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<style>
/* ========== STYLE KHUSUS PERJANJIAN KINERJA ========== */
.table-perjanjian .status-badge {
    padding: 3px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.status-disetujui { background: #d4edda; color: #155724; }
.status-menunggu  { background: #fff3cd; color: #856404; }
.status-ditolak  { background: #f8d7da; color: #721c24; }

.btn-upload {
    position: relative;
    overflow: hidden;
}
.btn-upload input[type=file] {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0;
    cursor: pointer;
}
.upload-preview {
    font-size: 12px;
    color: #6c757d;
    margin-top: 5px;
}
.form-control[readonly] {
    background-color: #f8f9fa;
}
.modal-lg-custom {
    max-width: 85%;
}

/* ============================================================ */
/* RADIO BUTTON MODEL CENTANG (TOGGLE)                          */
/* ============================================================ */
.sasaran-item {
    position: relative;
    padding: 10px 15px 10px 50px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    margin-bottom: 8px;
    background: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}
.sasaran-item:hover {
    border-color: #6c757d;
    background: #f8f9fa;
}
.sasaran-item.selected {
    border-color: #2563eb;
    background: #eff6ff;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
}
.sasaran-item .radio-indicator {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: 2px solid #adb5bd;
    background: #fff;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.sasaran-item.selected .radio-indicator {
    border-color: #2563eb;
    background: #2563eb;
}
.sasaran-item.selected .radio-indicator::after {
    content: "✓";
    color: #fff;
    font-size: 14px;
    font-weight: 700;
}
.sasaran-item .sasaran-text {
    font-weight: 700;
    font-size: 14px;
    color: #1e293b;
    display: block;
}
.sasaran-item .sasaran-detail-text {
    display: block;
    font-size: 13px;
    color: #495057;
    margin-top: 2px;
}
.sasaran-item .sub-unit {
    font-size: 12px;
    color: #6c757d;
    display: block;
    margin-top: 2px;
}
.sasaran-item .radio-hidden {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}
.sasaran-detail {
    margin-left: 30px;
    margin-top: 10px;
    padding: 12px 15px;
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    display: none;
}
.sasaran-detail table {
    margin-bottom: 0;
    font-size: 13px;
}
.sasaran-detail table th {
    font-size: 12px;
    padding: 4px 8px;
}
.sasaran-detail table td {
    padding: 4px 8px;
}
.selected-count {
    margin-top: 10px;
    font-size: 13px;
    color: #6c757d;
}
.selected-count b {
    color: #2563eb;
}

/* ===== CHECKBOX ANGGARAN ===== */
.anggaran-checkbox-group {
    margin-top: 5px;
}
.anggaran-checkbox-group label {
    font-weight: normal;
    cursor: pointer;
}
.anggaran-checkbox-group input[type="checkbox"] {
    margin-right: 5px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}
</style>

<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="data-table-list">

                        <!-- ===== TOMBOL TAMBAH & DROPDOWN TAHUN ===== -->
                        <?php if ($IsRole4) { ?>
                        <div style="margin-bottom:20px;">
                            <button class="btn btn-success" id="btnTambahPK">
                                <i class="fa fa-plus"></i> <b>Buat Perjanjian Kinerja</b>
                            </button>
                            <div style="display:inline-block; margin-left:15px;">
                                <label for="tahun_filter" style="font-weight:bold;">Tahun:</label>
                                <select id="tahun_filter" class="form-control" style="width:auto;display:inline-block;">
                                    <?php for ($y = date('Y'); $y >= 2020; $y--) { ?>
                                        <option value="<?= $y ?>" <?= ($y == date('Y')) ? 'selected' : '' ?>><?= $y ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- ===== TABEL DAFTAR PERJANJIAN KINERJA ===== -->
                        <div class="table-card">
                            <div class="table-scroll">
                                <table class="table table-bordered table-hover" style="min-width:1200px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama / NIP / Jabatan</th>
                                            <th>Eselon</th>
                                            <th>Awal</th>
                                            <th>Akhir</th>
                                            <th>Definitif</th>
                                            <th>PK Perubahan</th>
                                            <th>PK PLT</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($PerjanjianKinerja)) {
                                            $no = 1;
                                            foreach ($PerjanjianKinerja as $pk) {
                                                $status_class = '';
                                                $status_text = $pk['status'];
                                                if ($status_text == 'disetujui') $status_class = 'status-disetujui';
                                                elseif ($status_text == 'menunggu')  $status_class = 'status-menunggu';
                                                elseif ($status_text == 'ditolak')   $status_class = 'status-ditolak';
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($pk['pengampu_nama'] ?? '') ?></strong><br>
                                                NIP: <?= htmlspecialchars($pk['pengampu_nip'] ?? '') ?><br>
                                                <?= htmlspecialchars($pk['pengampu_jabatan'] ?? '') ?>
                                            </td>
                                            <td><?= $pk['eselon'] ?? '' ?></td>
                                            <td><?= $pk['periode_awal'] ?></td>
                                            <td><?= $pk['periode_akhir'] ?></td>
                                            <td>DOC ID: <?= $pk['id'] ?></td>
                                            <td></td>
                                            <td></td>
                                            <td><span class="status-badge <?= $status_class ?>"><?= ucfirst($status_text) ?></span></td>
                                            <td>
                                                <?php if ($IsRole4) { ?>
                                                <button class="btn btn-sm btn-primary btn-edit-pk" data-id="<?= $pk['id'] ?>">Edit</button>
                                                <button class="btn btn-sm btn-danger btn-hapus-pk" data-id="<?= $pk['id'] ?>">Hapus</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }
                                        } else { ?>
                                        <tr><td colspan="10" style="text-align:center;padding:30px 0;">Belum ada data Perjanjian Kinerja</td></tr>
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
</div>

<!-- ================================================================ -->
<!-- MODAL FORM PERJANJIAN KINERJA (TAMBAH / EDIT)                    -->
<!-- ================================================================ -->
<div class="modal fade" id="modalPK" role="dialog">
    <div class="modal-dialog modal-lg modal-lg-custom">
        <div class="modal-content">
            <div class="modal-header" style="background:#2563eb; color:#fff; border-radius:6px 6px 0 0;">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4><b id="modalPKTitle">Buat Perjanjian Kinerja</b></h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="pk_id" value="">
                <input type="hidden" id="tahun_selected" value="">

                <!-- ===== 1. PEGAWAI PENGAMPU ===== -->
                <div class="form-group">
                    <label><b>Pilih Pegawai pengampu</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="pegawai_pengampu_id">
                        <option value="">-- Pilih Pegawai --</option>
                        <?php foreach ($PegawaiList as $peg) { ?>
                        <option value="<?= $peg['id'] ?>"
                            data-nip="<?= $peg['nip'] ?? '' ?>"
                            data-nama="<?= $peg['nama'] ?? '' ?>"
                            data-jabatan="<?= $peg['jabatan'] ?? '' ?>"
                            data-satuan="<?= $peg['satuan_unit_kerja'] ?? '' ?>">
                            <?= ($peg['nama'] ?? '') . ' - ' . ($peg['jabatan'] ?? '') ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Detail Pengampu -->
                <div class="row">
                    <div class="col-md-4">
                        <label><b>NIP Pengampu</b></label>
                        <input type="text" class="form-control" id="nip_pengampu" readonly>
                    </div>
                    <div class="col-md-4">
                        <label><b>Nama Pengampu</b></label>
                        <input type="text" class="form-control" id="nama_pengampu" readonly>
                    </div>
                    <div class="col-md-4">
                        <label><b>Jabatan Pengampu</b></label>
                        <input type="text" class="form-control" id="jabatan_pengampu" readonly>
                    </div>
                </div>

                <!-- Satuan Unit Kerja Pengampu -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-12">
                        <label><b>Satuan Unit Kerja</b></label>
                        <input type="text" class="form-control" id="satuan_unit_kerja" readonly>
                    </div>
                </div>

                <hr>

                <!-- ===== 2. ATASAN LANGSUNG ===== -->
                <div class="form-group">
                    <label><b>Atasan Langsung</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="atasan_langsung_id">
                        <option value="">-- Pilih Atasan --</option>
                        <?php foreach ($AtasanList as $atasan) { ?>
                        <option value="<?= $atasan['id'] ?>"
                            data-nip="<?= $atasan['nip'] ?? '' ?>"
                            data-nama="<?= $atasan['nama'] ?? '' ?>"
                            data-jabatan="<?= $atasan['jabatan'] ?? '' ?>"
                            data-satuan="<?= $atasan['satuan_unit_kerja'] ?? '' ?>">
                            <?= ($atasan['nama'] ?? '') . ' - ' . ($atasan['jabatan'] ?? '') ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label><b>NIP Atasan Langsung</b></label>
                        <input type="text" class="form-control" id="nip_atasan" readonly>
                    </div>
                    <div class="col-md-4">
                        <label><b>Nama Atasan</b></label>
                        <input type="text" class="form-control" id="nama_atasan" readonly>
                    </div>
                    <div class="col-md-4">
                        <label><b>Jabatan Atasan</b></label>
                        <input type="text" class="form-control" id="jabatan_atasan" readonly>
                    </div>
                </div>

                <!-- Satuan Unit Kerja Atasan -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-12">
                        <label><b>Satuan Unit Kerja Atasan</b></label>
                        <input type="text" class="form-control" id="satuan_unit_kerja_atasan" readonly>
                    </div>
                </div>

                <hr>

                <!-- ===== 3. JENIS PERJANJIAN ===== -->
                <div class="form-group">
                    <label><b>Jenis Perjanjian</b></label>
                    <select class="form-control" id="jenis_perjanjian">
                        <option value="PK Murni">PK Murni</option>
                        <option value="PK Perubahan">PK Perubahan</option>
                        <option value="PK PLT">PK PLT</option>
                    </select>
                </div>

                <!-- ===== 4. SASARAN PERJANJIAN (RADIO BUTTON MODEL CENTANG) ===== -->
                <div class="form-group">
                    <label><b>Level Sasaran Perjanjian</b> <span class="text-danger">*</span></label>
                    <select class="form-control" id="sasaran_level">
                        <option value="">-- Pilih Level --</option>
                        <option value="program">Program</option>
                        <option value="kegiatan">Kegiatan</option>
                        <option value="sub_kegiatan">Sub Kegiatan</option>
                    </select>
                </div>

                <div class="form-group" id="sasaran_container">
                    <label><b>Pilih Sasaran</b> <span class="text-danger">*</span></label>
                    <div id="sasaran_list">
                        <p class="text-muted">Pilih level terlebih dahulu</p>
                    </div>
                    <p class="selected-count" id="selectedCount">Belum ada sasaran dipilih</p>
                    <button type="button" class="btn btn-sm btn-secondary" id="btnBatalPilihSasaran" style="display:none;">
                        <i class="fa fa-times"></i> Batal Pilih
                    </button>
                </div>

                <!-- ===== 5. PERIODE ===== -->
                <div class="row">
                    <div class="col-md-4">
                        <label><b>Periode Awal</b></label>
                        <select class="form-control" id="periode_awal">
                            <?php for ($i=1; $i<=12; $i++) { ?>
                            <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,1)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><b>Periode Akhir</b></label>
                        <select class="form-control" id="periode_akhir">
                            <?php for ($i=1; $i<=12; $i++) { ?>
                            <option value="<?= $i ?>"><?= date('F', mktime(0,0,0,$i,1)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label><b>Anggaran</b></label>
                        <div class="anggaran-checkbox-group">
                            <label>
                                <input type="checkbox" id="anggaran_checkbox" value="1"> Anggaran
                            </label>
                        </div>
                    </div>
                </div>

                <!-- ===== 6. SUB UNIT (otomatis dari sasaran terpilih) ===== -->
                <div class="form-group">
                    <label><b>Sub Unit</b></label>
                    <input type="text" class="form-control" id="sub_unit" readonly>
                </div>

                <!-- ===== 7. UPLOAD DOKUMEN (2 file) ===== -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Dokumen Utama</b></label>
                            <div class="btn btn-default btn-upload">
                                <i class="fa fa-upload"></i> Pilih File
                                <input type="file" name="dokumen_utama" id="dokumen_utama" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                            </div>
                            <div class="upload-preview" id="preview_utama">Belum ada file</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Dokumen Lampiran</b></label>
                            <div class="btn btn-default btn-upload">
                                <i class="fa fa-upload"></i> Pilih File
                                <input type="file" name="dokumen_lampiran" id="dokumen_lampiran" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                            </div>
                            <div class="upload-preview" id="preview_lampiran">Belum ada file</div>
                        </div>
                    </div>
                </div>

                <!-- ===== 8. STATUS ===== -->
                <div class="form-group">
                    <label><b>Status</b></label>
                    <select class="form-control" id="status">
                        <option value="menunggu">Menunggu</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

            </div> <!-- /modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSimpanPK"><b>Simpan Perjanjian</b></button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================ -->
<!-- SCRIPT JAVASCRIPT                                                -->
<!-- ================================================================ -->
<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

<script>
var BaseURL   = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

$(document).ready(function() {

    // ============================================================
    // TAMBAH DATA (munculkan modal kosong)
    // ============================================================
    $('#btnTambahPK').click(function() {
        var tahun = $('#tahun_filter').val();
        $('#tahun_selected').val(tahun);
        $('#modalPKTitle').text('Buat Perjanjian Kinerja');
        $('#pk_id').val('');
        $('#pegawai_pengampu_id').val('');
        $('#atasan_langsung_id').val('');
        $('#jenis_perjanjian').val('PK Murni');
        $('#periode_awal').val(1);
        $('#periode_akhir').val(12);
        $('#anggaran_checkbox').prop('checked', false);
        $('#sasaran_level').val('');
        $('#sasaran_list').html('<p class="text-muted">Pilih level terlebih dahulu</p>');
        $('#sub_unit').val('');
        $('#status').val('menunggu');
        $('#dokumen_utama').val('');
        $('#dokumen_lampiran').val('');
        $('#preview_utama').text('Belum ada file');
        $('#preview_lampiran').text('Belum ada file');
        clearPengampuDetail();
        clearAtasanDetail();
        $('#satuan_unit_kerja').val('');
        $('#satuan_unit_kerja_atasan').val('');
        $('#selectedCount').text('Belum ada sasaran dipilih');
        $('#btnBatalPilihSasaran').hide();
        $('#modalPK').modal('show');
    });

    // ============================================================
    // EVENT CHANGE PEGAWAI PENGAMPU
    // ============================================================
    $('#pegawai_pengampu_id').change(function() {
        var selected = $(this).find('option:selected');
        var id = $(this).val();
        if (id) {
            $('#nip_pengampu').val(selected.data('nip') || '');
            $('#nama_pengampu').val(selected.data('nama') || '');
            $('#jabatan_pengampu').val(selected.data('jabatan') || '');
            $('#satuan_unit_kerja').val(selected.data('satuan') || '');
        } else {
            clearPengampuDetail();
            $('#satuan_unit_kerja').val('');
        }
    });

    // ============================================================
    // EVENT CHANGE ATASAN
    // ============================================================
    $('#atasan_langsung_id').change(function() {
        var selected = $(this).find('option:selected');
        var id = $(this).val();
        if (id) {
            $('#nip_atasan').val(selected.data('nip') || '');
            $('#nama_atasan').val(selected.data('nama') || '');
            $('#jabatan_atasan').val(selected.data('jabatan') || '');
            $('#satuan_unit_kerja_atasan').val(selected.data('satuan') || '');
        } else {
            clearAtasanDetail();
            $('#satuan_unit_kerja_atasan').val('');
        }
    });

    // ============================================================
    // EVENT CHANGE SASARAN LEVEL → LOAD SASARAN DARI DB
    // ============================================================
    $('#sasaran_level').change(function() {
        var level = $(this).val();
        var tahun = $('#tahun_selected').val();
        if (!level) {
            $('#sasaran_list').html('<p class="text-muted">Pilih level terlebih dahulu</p>');
            $('#sub_unit').val('');
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
            return;
        }
        $.ajax({
            url: BaseURL + "Instansi/getSasaranByLevel",
            type: "POST",
            data: {
                level: level,
                tahun: tahun,
                [CSRF_NAME]: CSRF_TOKEN
            },
            dataType: "json",
            beforeSend: function() {
                $('#sasaran_list').html('<p class="text-muted">Memuat data...</p>');
            },
            success: function(res) {
                if (res.status === 'success') {
                    renderSasaranList(res.data, level);
                } else {
                    $('#sasaran_list').html('<p class="text-danger">Gagal memuat data: ' + (res.message || '') + '</p>');
                }
            },
            error: function() {
                $('#sasaran_list').html('<p class="text-danger">Terjadi kesalahan saat memuat data</p>');
            }
        });
    });

    // ============================================================
    // RENDER SASARAN LIST (RADIO BUTTON MODEL CENTANG)
    // ============================================================
    function renderSasaranList(data, level) {
        if (!data || data.length === 0) {
            $('#sasaran_list').html('<p class="text-muted">Tidak ada data untuk level ini</p>');
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
            return;
        }

        var html = '';
        $.each(data, function(i, item) {
            var nama = item.nama || '-';
            var sasaran = item.sasaran || '';
            var subUnit = item.sub_unit || '-';
            var sasaranId = item.id;
            var indikatorList = item.indikator_list || [];

            html += '<div class="sasaran-item" data-id="' + sasaranId + '" data-subunit="' + subUnit + '" data-level="' + level + '">';
            html += '  <div class="radio-indicator"></div>';
            html += '  <input type="radio" class="radio-hidden" name="sasaran_radio" value="' + sasaranId + '" data-level="' + level + '">';
            html += '  <span class="sasaran-text">' + escapeHtml(nama) + '</span>';
            if (sasaran) {
                html += '  <span class="sasaran-detail-text">Sasaran: ' + escapeHtml(sasaran) + '</span>';
            }
            html += '  <span class="sub-unit">' + escapeHtml(subUnit) + '</span>';
            // Detail indikator (tabel)
            html += '  <div class="sasaran-detail" style="display:none;">';
            if (indikatorList.length > 0) {
                html += '    <table class="table table-sm table-bordered" style="margin-top:5px;">';
                html += '      <thead><tr><th>Indikator</th><th>Satuan</th><th>Target</th></tr></thead>';
                html += '      <tbody>';
                $.each(indikatorList, function(j, ind) {
                    html += '        <tr>';
                    html += '          <td>' + escapeHtml(ind.indikator || '') + '</td>';
                    html += '          <td>' + escapeHtml(ind.satuan || '') + '</td>';
                    html += '          <td>' + escapeHtml(ind.target || '') + '</td>';
                    html += '        </tr>';
                });
                html += '      </tbody>';
                html += '    </table>';
            } else {
                html += '    <p class="text-muted">Tidak ada indikator</p>';
            }
            html += '  </div>';
            html += '</div>';
        });

        $('#sasaran_list').html(html);
        updateSelectedCount();
        $('#btnBatalPilihSasaran').hide();
    }

    // ============================================================
    // EVENT DELEGATION UNTUK RADIO BUTTON (TOGGLE - bisa uncheck)
    // ============================================================
    $(document).on('click', '.sasaran-item', function(e) {
        if ($(e.target).closest('.sasaran-detail').length > 0) return;
        if ($(e.target).closest('input').length > 0) return;

        var $item = $(this);
        var $radio = $item.find('.radio-hidden');
        var isCurrentlyChecked = $radio.prop('checked');

        if (isCurrentlyChecked) {
            $radio.prop('checked', false);
            $item.removeClass('selected');
            $item.find('.sasaran-detail').slideUp();
            $('#sub_unit').val('');
            $('#btnBatalPilihSasaran').hide();
        } else {
            $('.sasaran-item').removeClass('selected');
            $('.radio-hidden').prop('checked', false);
            $('.sasaran-detail').slideUp();

            $radio.prop('checked', true);
            $item.addClass('selected');
            $item.find('.sasaran-detail').slideDown();

            var subUnit = $item.data('subunit');
            $('#sub_unit').val(subUnit || '');
            $('#btnBatalPilihSasaran').show();
        }
        updateSelectedCount();
    });

    $(document).on('change', '.radio-hidden', function() {
        var $radio = $(this);
        var $item = $radio.closest('.sasaran-item');

        if ($radio.is(':checked')) {
            $('.sasaran-item').removeClass('selected');
            $('.radio-hidden').prop('checked', false);
            $('.sasaran-detail').slideUp();

            $radio.prop('checked', true);
            $item.addClass('selected');
            $item.find('.sasaran-detail').slideDown();

            var subUnit = $item.data('subunit');
            $('#sub_unit').val(subUnit || '');
            $('#btnBatalPilihSasaran').show();
        } else {
            $item.removeClass('selected');
            $item.find('.sasaran-detail').slideUp();
            if ($('.radio-hidden:checked').length === 0) {
                $('#sub_unit').val('');
                $('#btnBatalPilihSasaran').hide();
            }
        }
        updateSelectedCount();
    });

    // ============================================================
    // TOMBOL BATAL PILIH SASARAN
    // ============================================================
    $('#btnBatalPilihSasaran').click(function() {
        $('.sasaran-item').removeClass('selected');
        $('.radio-hidden').prop('checked', false);
        $('.sasaran-detail').slideUp();
        $('#sub_unit').val('');
        $('#selectedCount').text('Belum ada sasaran dipilih');
        $(this).hide();
    });

    // ============================================================
    // UPDATE SELECTED COUNT
    // ============================================================
    function updateSelectedCount() {
        var count = $('.radio-hidden:checked').length;
        if (count > 0) {
            var text = $('.radio-hidden:checked').closest('.sasaran-item').find('.sasaran-text').text();
            $('#selectedCount').html('<b>1</b> sasaran dipilih: ' + text);
            $('#btnBatalPilihSasaran').show();
        } else {
            $('#selectedCount').text('Belum ada sasaran dipilih');
            $('#btnBatalPilihSasaran').hide();
        }
    }

    // ============================================================
    // FUNGSI BANTUAN
    // ============================================================
    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function clearPengampuDetail() {
        $('#nip_pengampu').val('');
        $('#nama_pengampu').val('');
        $('#jabatan_pengampu').val('');
    }

    function clearAtasanDetail() {
        $('#nip_atasan').val('');
        $('#nama_atasan').val('');
        $('#jabatan_atasan').val('');
    }

    // ============================================================
    // PREVIEW FILE
    // ============================================================
    $('#dokumen_utama').change(function() {
        var fileName = $(this).val().split('\\').pop();
        $('#preview_utama').text(fileName || 'Belum ada file');
    });
    $('#dokumen_lampiran').change(function() {
        var fileName = $(this).val().split('\\').pop();
        $('#preview_lampiran').text(fileName || 'Belum ada file');
    });

    // ============================================================
    // SIMPAN / UPDATE PERJANJIAN KINERJA (AJAX)
    // ============================================================
    $('#btnSimpanPK').click(function() {
        var id = $('#pk_id').val();

        if (!$('#pegawai_pengampu_id').val()) {
            alert('Pilih Pegawai Pengampu!');
            return;
        }
        if (!$('#atasan_langsung_id').val()) {
            alert('Pilih Atasan Langsung!');
            return;
        }
        if (!$('#jenis_perjanjian').val()) {
            alert('Pilih Jenis Perjanjian!');
            return;
        }
        if (!$('#sasaran_level').val()) {
            alert('Pilih Level Sasaran!');
            return;
        }
        if ($('.radio-hidden:checked').length === 0) {
            alert('Pilih satu sasaran!');
            return;
        }
        if (!$('#periode_awal').val() || !$('#periode_akhir').val()) {
            alert('Lengkapi periode!');
            return;
        }

        var sasaranTerpilih = [];
        $('.radio-hidden:checked').each(function() {
            var item = $(this).closest('.sasaran-item');
            var id = $(this).val();
            var level = $(this).data('level');
            // Ambil indikator dari tabel (hanya untuk informasi, tidak disimpan)
            var indikator = item.find('.indikator-input').val() || '';
            var satuan = item.find('.satuan-input').val() || '';
            var target = item.find('.target-input').val() || '';
            sasaranTerpilih.push({
                id: id,
                level: level,
                indikator: indikator,
                satuan: satuan,
                target: target
            });
        });

        var anggaran = $('#anggaran_checkbox').is(':checked') ? 1 : 0;

        var formData = new FormData();
        formData.append('pegawai_pengampu_id', $('#pegawai_pengampu_id').val());
        formData.append('atasan_langsung_id', $('#atasan_langsung_id').val());
        formData.append('jenis_perjanjian', $('#jenis_perjanjian').val());
        formData.append('periode_awal', $('#periode_awal').val());
        formData.append('periode_akhir', $('#periode_akhir').val());
        formData.append('anggaran', anggaran);
        formData.append('sasaran_level', $('#sasaran_level').val());
        formData.append('sasaran_data', JSON.stringify(sasaranTerpilih));
        formData.append('sub_unit', $('#sub_unit').val());
        formData.append('status', $('#status').val());
        formData.append(CSRF_NAME, CSRF_TOKEN);
        if (id) formData.append('id', id);

        var fileUtama = $('#dokumen_utama')[0].files[0];
        var fileLampiran = $('#dokumen_lampiran')[0].files[0];
        if (fileUtama)   formData.append('dokumen_utama', fileUtama);
        if (fileLampiran) formData.append('dokumen_lampiran', fileLampiran);

        var url = id ? BaseURL + "Instansi/updatePerjanjianKinerja"
                     : BaseURL + "Instansi/simpanPerjanjianKinerja";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function() {
                $('#btnSimpanPK').prop('disabled', true).text('Menyimpan...');
            },
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    $('#modalPK').modal('hide');
                    location.reload();
                } else {
                    alert(res.message || 'Gagal menyimpan!');
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                $('#btnSimpanPK').prop('disabled', false).text('Simpan Perjanjian');
            }
        });
    });

    // ============================================================
    // EDIT DATA (load data ke modal)
    // ============================================================
    $(document).on('click', '.btn-edit-pk', function() {
        var id = $(this).data('id');
        if (!id) return;
        var tahun = $('#tahun_filter').val();
        $('#tahun_selected').val(tahun);
        $.ajax({
            url: BaseURL + "Instansi/getPerjanjianKinerja",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    var data = res.data;
                    $('#modalPKTitle').text('Edit Perjanjian Kinerja');
                    $('#pk_id').val(data.id);
                    $('#pegawai_pengampu_id').val(data.pegawai_pengampu_id).trigger('change');
                    $('#atasan_langsung_id').val(data.atasan_langsung_id).trigger('change');
                    $('#jenis_perjanjian').val(data.jenis_perjanjian);
                    $('#periode_awal').val(data.periode_awal);
                    $('#periode_akhir').val(data.periode_akhir);
                    $('#anggaran_checkbox').prop('checked', (data.anggaran == 1));
                    $('#sasaran_level').val(data.sasaran_level).trigger('change');
                    if (data.sasaran_data) {
                        var selected = JSON.parse(data.sasaran_data);
                        setTimeout(function() {
                            $.each(selected, function(i, s) {
                                var $item = $('.sasaran-item[data-id="' + s.id + '"]');
                                if ($item.length) {
                                    $item.find('.radio-hidden').prop('checked', true);
                                    $item.addClass('selected');
                                    $item.find('.sasaran-detail').show();
                                    // Karena detail sekarang berupa tabel, kita isi input tersembunyi jika ada
                                    // atau kita bisa simpan data indikator di hidden
                                    $('#sub_unit').val($item.data('subunit') || '');
                                    $('#btnBatalPilihSasaran').show();
                                }
                            });
                            updateSelectedCount();
                        }, 500);
                    }
                    $('#sub_unit').val(data.sub_unit);
                    $('#status').val(data.status);
                    if (data.dokumen_utama) {
                        $('#preview_utama').html('<a href="<?= base_url('uploads/perjanjian_kinerja/') ?>' + data.dokumen_utama + '" target="_blank">Lihat file</a>');
                    } else {
                        $('#preview_utama').text('Belum ada file');
                    }
                    if (data.dokumen_lampiran) {
                        $('#preview_lampiran').html('<a href="<?= base_url('uploads/perjanjian_kinerja/') ?>' + data.dokumen_lampiran + '" target="_blank">Lihat file</a>');
                    } else {
                        $('#preview_lampiran').text('Belum ada file');
                    }
                    $('#modalPK').modal('show');
                } else {
                    alert(res.message || 'Gagal mengambil data!');
                }
            }
        });
    });

    // ============================================================
    // HAPUS DATA
    // ============================================================
    $(document).on('click', '.btn-hapus-pk', function() {
        if (!confirm('Yakin hapus Perjanjian Kinerja ini?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: BaseURL + "Instansi/hapusPerjanjianKinerja",
            type: "POST",
            data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.message);
                }
            }
        });
    });

}); // end ready
</script>

</body>
</html>