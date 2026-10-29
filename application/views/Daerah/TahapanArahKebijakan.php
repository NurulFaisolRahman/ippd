<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list" style="border-radius: 12px; box-shadow: 0 4px 18px rgba(0,0,0,0.06); padding: 25px 25px 30px; background: #fff; border: 1px solid #e2e8f0;">
                        
                        <!-- Filter untuk pengguna yang belum login -->
                        <?php if (!isset($_SESSION['KodeWilayah'])) { ?>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                                    <div style="flex: 1 1 250px; min-width: 200px;">
                                        <label for="Provinsi" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Provinsi</label>
                                        <select class="form-control" id="Provinsi" style="height: 38px; border-radius: 6px;">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($Provinsi as $prov) { ?>
                                                <option value="<?= html_escape($prov['Kode']) ?>" <?= (substr($KodeWilayah, 0, 2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                    <?= html_escape($prov['Nama']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div style="flex: 1 1 250px; min-width: 200px;">
                                        <label for="KabKota" style="font-weight: 700; margin-bottom: 6px; display: block; color: #374151;">Kab/Kota</label>
                                        <select class="form-control" id="KabKota" style="height: 38px; border-radius: 6px;">
                                            <option value="">Pilih Kab/Kota</option>
                                        </select>
                                    </div>
                                    <div style="flex: 0 0 auto;">
                                        <button class="btn btn-primary notika-btn-primary" id="Filter" style="height: 38px; padding: 0 25px; font-weight: 700; border-radius: 6px;">
                                            Filter
                                        </button>
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
                            <div class="alert alert-info" style="margin-bottom: 20px; border-radius: 8px;">
                                <strong>Wilayah:</strong> <?= $nama_wilayah ?>
                            </div>
                        <?php } ?>

                        <!-- HEADER MENU -->
                        <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-sm-6">
                                    <h3 style="font-weight: 800; color: #1f2937; margin: 0 0 5px 0; display: flex; align-items: center; gap: 10px;">
                                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 8px; background: #e0f2fe; color: #0284c7; font-size: 18px;">
                                            <i class="fa fa-tasks"></i>
                                        </span>
                                        TAHAPAN ARAH KEBIJAKAN
                                    </h3>
                                    <div style="color: #64748b; font-size: 13px;">
                                        Tahapan periodisasi arah kebijakan RPJPD per 5 tahun (Tahap I s/d Tahap IV).
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6 text-right" style="display: flex; justify-content: flex-end; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                        <button type="button" class="btn btn-success notika-btn-success" data-toggle="modal" data-target="#ModalInputTahapan" style="border-radius: 6px; font-weight: 700; padding: 8px 18px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(22, 163, 74, 0.25);">
                                            <i class="fa fa-plus-circle"></i> Tambah Tahapan Arah Kebijakan
                                        </button>
                                    <?php } ?>
                                </div>
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
<!-- ============================================================
MODAL INPUT
============================================================ -->
<div class="modal fade" id="ModalInputTahapan" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
            
            <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e6fcf5; color: #0ca678;">
                        <i class="fa fa-tasks"></i>
                    </span>
                    Tambah Tahapan Arah Kebijakan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
            </div>

            <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="InputPeriode" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="InputPeriode" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
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
                            <small class="text-muted" style="display: block; margin-top: 4px; font-size: 11.5px;">Pilih periode untuk melihat daftar misi</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="InputIdMisi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Misi <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="InputIdMisi" disabled style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                            </select>
                            <small class="text-muted" id="InputMisiInfo" style="display: block; margin-top: 4px; font-size: 11.5px;">Pilih misi yang akan diisi tahapannya</small>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info" style="margin-bottom: 18px; border-radius: 8px; background: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1; padding: 10px 14px; font-size: 12.5px;">
                    <i class="fa fa-info-circle"></i> <strong>Tahapan bersifat opsional</strong> — Anda dapat mengisi sebagian atau seluruh tahapan.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="InputTahap1" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap I (2025 - 2029)
                            </label>
                            <textarea class="form-control" rows="3" id="InputTahap1" placeholder="Kosongkan jika belum diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="InputTahap2" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap II (2030 - 2034)
                            </label>
                            <textarea class="form-control" rows="3" id="InputTahap2" placeholder="Kosongkan jika belum diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="InputTahap3" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap III (2035 - 2039)
                            </label>
                            <textarea class="form-control" rows="3" id="InputTahap3" placeholder="Kosongkan jika belum diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="InputTahap4" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap IV (2040 - 2045)
                            </label>
                            <textarea class="form-control" rows="3" id="InputTahap4" placeholder="Kosongkan jika belum diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 18px; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">
                    Batal
                </button>
                <button class="btn btn-success notika-btn-success" id="BtnInput" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 22px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save"></i> <b>SIMPAN</b>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- ============================================================
MODAL EDIT
============================================================ -->
<div class="modal fade" id="ModalEditTahapan" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 760px; width: 92%;">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18); border: none;">
            
            <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; padding: 16px 24px; position: relative;">
                <h4 class="modal-title" style="font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; font-size: 16px; text-align: left; padding-right: 40px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #fef3c7; color: #d97706;">
                        <i class="fa fa-pencil-square-o"></i>
                    </span>
                    Edit Tahapan Arah Kebijakan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 20px; top: 16px; font-size: 24px; opacity: 0.6; line-height: 1; cursor: pointer; border: none; background: transparent; padding: 0; margin: 0; z-index: 10;">&times;</button>
            </div>

            <div class="modal-body" style="padding: 24px 26px; max-height: calc(85vh - 140px); overflow-y: auto;">
                <input type="hidden" id="EditId">
                <input type="hidden" id="EditCurrentMisiId">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="EditPeriode" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Periode <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="EditPeriode" style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
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
                            <small class="text-muted" style="display: block; margin-top: 4px; font-size: 11.5px;">Pilih periode untuk melihat daftar misi</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="EditIdMisi" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Misi <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" id="EditIdMisi" disabled style="height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                <option value="">-- Pilih Periode Terlebih Dahulu --</option>
                            </select>
                            <small class="text-muted" id="EditMisiInfo" style="display: block; margin-top: 4px; font-size: 11.5px;">Pilih misi yang akan diisi tahapannya</small>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info" style="margin-bottom: 18px; border-radius: 8px; background: #f0f9ff; border: 1px solid #bae6fd; color: #0369a1; padding: 10px 14px; font-size: 12.5px;">
                    <i class="fa fa-info-circle"></i> <strong>Tahapan bersifat opsional</strong> — Anda dapat mengisi sebagian atau seluruh tahapan.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="EditTahap1" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap I (2025 - 2029)
                            </label>
                            <textarea class="form-control" rows="3" id="EditTahap1" placeholder="Kosongkan jika tidak diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="EditTahap2" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap II (2030 - 2034)
                            </label>
                            <textarea class="form-control" rows="3" id="EditTahap2" placeholder="Kosongkan jika tidak diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="EditTahap3" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap III (2035 - 2039)
                            </label>
                            <textarea class="form-control" rows="3" id="EditTahap3" placeholder="Kosongkan jika tidak diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label for="EditTahap4" style="font-weight: 700; font-size: 13px; color: #374151; margin-bottom: 6px; display: block;">
                                Tahap IV (2040 - 2045)
                            </label>
                            <textarea class="form-control" rows="3" id="EditTahap4" placeholder="Kosongkan jika tidak diisi" style="border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 18px; color: #64748b; border: 1px solid #cbd5e1; background: #fff;">
                    Batal
                </button>
                <button class="btn btn-success notika-btn-success" id="BtnEdit" style="border-radius: 8px; font-weight: 600; font-size: 13px; padding: 8px 22px; box-shadow: 0 2px 6px rgba(16,185,129,0.3);">
                    <i class="fa fa-save"></i> <b>UPDATE</b>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- CSS -->
<style>
/* Modal Header styling - Tombol silang pojok kanan, judul pojok kiri */
.modal-header {
    position: relative !important;
    padding: 16px 24px !important;
}
.modal-header:before,
.modal-header:after {
    display: none !important;
}
.modal-header .close {
    position: absolute !important;
    right: 20px !important;
    top: 16px !important;
    margin: 0 !important;
    padding: 0 !important;
    font-size: 24px !important;
    opacity: 0.6 !important;
    line-height: 1 !important;
    cursor: pointer !important;
    border: none !important;
    background: transparent !important;
    z-index: 10 !important;
    transition: opacity 0.2s;
}
.modal-header .close:hover {
    opacity: 1 !important;
}
.modal-header .modal-title {
    text-align: left !important;
    margin: 0 !important;
    padding-right: 40px !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

/* Styling Tabel Sesuai Tema Notika / Menu Lain */
#data-table-basic {
    border-collapse: collapse;
    width: 100% !important;
}
#data-table-basic thead th {
    background-color: #f1f5f9 !important;
    color: #334155 !important;
    font-weight: 700 !important;
    border: 1px solid #cbd5e1 !important;
    font-size: 11.5px !important;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 10px 8px !important;
    vertical-align: middle !important;
}
#data-table-basic tbody td {
    border: 1px solid #e2e8f0;
    vertical-align: middle !important;
    font-size: 12px;
}
#data-table-basic tbody tr:hover {
    background-color: #f8fafc;
}

/* ==============================================
   UNIFIED BUTTON STYLING
   ============================================== */
.btn {
    border-radius: 8px !important;
    transition: all 0.2s ease !important;
    font-weight: 600 !important;
}
.btn-sm, .btn-xs {
    border-radius: 6px !important;
    font-weight: 600 !important;
}
.btn.Edit, .btn.EditSasaran, .btn.EditPeriodeMisi, .btn-amber {
    background-color: #f59e0b !important;
    border-color: #f59e0b !important;
    color: #ffffff !important;
    border-radius: 6px !important;
    padding: 5px 9px !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
    box-shadow: 0 1px 3px rgba(245, 158, 11, 0.25) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.btn.Edit:hover, .btn.EditSasaran:hover, .btn.EditPeriodeMisi:hover, .btn-amber:hover {
    background-color: #d97706 !important;
    border-color: #d97706 !important;
    color: #ffffff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(245, 158, 11, 0.35) !important;
}
.btn.Hapus, .btn.HapusSasaran, .btn.HapusPeriodeMisi, .btn-danger {
    background-color: #ef4444 !important;
    border-color: #ef4444 !important;
    color: #ffffff !important;
    border-radius: 6px !important;
    padding: 5px 9px !important;
    font-size: 12px !important;
    line-height: 1.4 !important;
    box-shadow: 0 1px 3px rgba(239, 68, 68, 0.25) !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.btn.Hapus:hover, .btn.HapusSasaran:hover, .btn.HapusPeriodeMisi:hover, .btn-danger:hover {
    background-color: #dc2626 !important;
    border-color: #dc2626 !important;
    color: #ffffff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(239, 68, 68, 0.35) !important;
}
.button-icon-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 5px !important;
    margin: 0 !important;
}
.button-icon-btn .btn-reco-mg,
.button-icon-btn .btn-button-mg {
    margin: 0 !important;
}

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