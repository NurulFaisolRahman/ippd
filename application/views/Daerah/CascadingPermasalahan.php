<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>
<?php 
// Pengguna yang login (Daerah atau Admin) dapat melakukan aksi CRUD
$isDaerah = isset($IsDaerah) ? $IsDaerah : (isset($_SESSION['Username']) || isset($_SESSION['Level'])); 
?>

<!-- Dependencies: Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
    .cascading-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 25px;
        overflow: hidden;
    }
    .cascading-card-header {
        background: #ffffff;
        padding: 20px 24px;
        border-bottom: 1.5px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }
    .cascading-title h3 {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }
    .cascading-title p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Tabel Cascading Permasalahan - Serasi dengan ProgramKegiatanPrioritas */
    .table-cascading {
        width: 100%;
        border-collapse: separate !important;
        border-spacing: 0;
        font-size: 13px;
        margin-bottom: 0;
        border: 1px solid #b7d7b0 !important;
    }
    .table-cascading thead th {
        background: #d9ead3 !important;
        color: #1b4d21 !important;
        text-align: center;
        vertical-align: middle !important;
        font-weight: 700;
        font-size: 12.5px;
        padding: 13px 10px !important;
        border: 1px solid #b7d7b0 !important;
        line-height: 1.4;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .table-cascading tbody td {
        vertical-align: top !important;
        padding: 12px 14px !important;
        border: 1px solid #e2e8f0 !important;
        line-height: 1.55;
        color: #1e293b;
        background-color: #ffffff;
    }
    .table-cascading tbody tr:hover td {
        background-color: #fbfdfb;
    }
    td.mid {
        vertical-align: middle !important;
    }

    /* Item & Action Buttons serasi dengan ProgramKegiatanPrioritas */
    .item {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-between;
        gap: 8px;
        position: relative;
        width: 100%;
    }
    .item .t {
        flex: 1;
        min-width: 0;
        border-radius: 4px;
        padding: 3px 6px;
        font-size: 13px;
        color: #1e293b;
        line-height: 1.5;
        transition: background 0.15s, box-shadow 0.15s;
        word-break: break-word;
    }
    .item .t[contenteditable="true"] {
        cursor: text;
    }
    .item .t[contenteditable="true"]:hover {
        background: #f0fdf4;
        box-shadow: inset 0 0 0 1px #a7f3d0;
    }
    .item .t[contenteditable="true"]:focus {
        background: #ffffff;
        outline: 2px solid #15803d;
        outline-offset: 1px;
        box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.18);
    }
    .item-actions {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .btn-xs-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        padding: 0;
        font-size: 11.5px;
        border-radius: 5px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
        line-height: 1;
    }
    .btn-edit-level {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .btn-edit-level:hover {
        background: #f59e0b;
        color: #ffffff;
        border-color: #f59e0b;
    }
    .btn-del-level {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .btn-del-level:hover {
        background: #ef4444;
        color: #ffffff;
        border-color: #ef4444;
    }
    @keyframes pulseHighlight {
        0% {
            background-color: rgba(21, 128, 61, 0.25);
            box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.35);
            border-radius: 4px;
        }
        50% {
            background-color: rgba(21, 128, 61, 0.12);
            box-shadow: 0 0 0 2px rgba(21, 128, 61, 0.2);
            border-radius: 4px;
        }
        100% {
            background-color: transparent;
            box-shadow: none;
        }
    }
    .highlight-edited {
        animation: pulseHighlight 2.2s ease-out;
    }
    .na {
        color: #94a3b8;
        font-style: italic;
    }

    /* Tools & Modals */
    .tools {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .chk {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 9px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        margin: 0 0 8px;
        font-weight: 400;
        background: #fff;
        cursor: pointer;
        transition: background 0.15s, border-color 0.15s;
    }
    .chk:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .chk input[type="checkbox"],
    .chk input[type="radio"] {
        margin-top: 3px;
        cursor: pointer;
    }
    .hint {
        color: #64748b;
        font-size: 12.5px;
    }
    .err-msg {
        color: #ef4444;
        font-size: 12px;
        font-weight: 600;
        min-height: 1.2em;
        margin: 6px 0 0;
    }
    .empty-msg {
        color: #64748b;
        padding: 16px;
        text-align: center;
        font-style: italic;
        background: #f8fafc;
        border-radius: 6px;
        border: 1px dashed #cbd5e1;
    }

    /* Filter Bar */
    .filter-wrapper {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }
</style>

<div class="main-content" style="padding: 20px 24px; min-height: 100vh; background: #f8fafc;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Filter Bar: Wilayah & Tahun RKPD -->
                <div class="filter-wrapper">
                    <form method="GET" action="<?= base_url('Daerah/CascadingPermasalahan') ?>" id="FormFilterCascading">
                        <div class="row" style="display: flex; align-items: flex-end; flex-wrap: wrap;">
                            
                            <?php if (empty($_SESSION['KodeWilayah'])) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Provinsi</label>
                                    <select class="form-control" id="FilterProvinsi" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php if (!empty($Provinsi)) { foreach ($Provinsi as $prov) { ?>
                                            <option value="<?= html_escape($prov['Kode']) ?>" <?= (!empty($KodeWilayah) && substr($KodeWilayah,0,2) == $prov['Kode']) ? 'selected' : '' ?>>
                                                <?= html_escape($prov['Nama']) ?>
                                            </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6" style="margin-bottom: 10px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155;">Pilih Kabupaten / Kota</label>
                                    <select class="form-control" name="KodeWilayah" id="FilterKabKota" style="height: 40px; border-radius: 6px;">
                                        <option value="">-- Pilih Kabupaten / Kota --</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="KodeWilayah" id="FilterKabKota" value="<?= html_escape($KodeWilayah) ?>">
                            <?php } ?>

                            <!-- Filter Tahun Perencanaan RKPD -->
                            <div class="col-lg-3 col-md-3 col-sm-6" style="margin-bottom: 10px;">
                                <label style="font-weight: 700; font-size: 13px; color: #334155;">
                                    <i class="fa fa-calendar" style="color: #15803d;"></i> Tahun Perencanaan RKPD
                                </label>
                                <select class="form-control" name="tahun" id="FilterTahun" style="height: 40px; border-radius: 6px; font-weight: 600;">
                                    <?php foreach ($ListTahun as $th) { ?>
                                        <option value="<?= html_escape($th) ?>" <?= ($SelectedTahun == $th) ? 'selected' : '' ?>>
                                            Tahun <?= html_escape($th) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6" style="margin-bottom: 10px;">
                                <button type="submit" class="btn btn-primary notika-btn-primary btn-block" style="height: 40px; font-weight: 700; border-radius: 6px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-filter"></i> Tampilkan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>

                <?php if (empty($KodeWilayah)) { ?>
                    <div class="alert alert-warning" style="border-radius: 8px; font-size: 13px; margin-bottom: 20px;">
                        <i class="fa fa-exclamation-triangle"></i> <strong>Perhatian:</strong> Silakan pilih Provinsi dan Kabupaten / Kota terlebih dahulu pada form filter di atas untuk mengelola data Cascading Permasalahan.
                    </div>
                <?php } ?>

                <!-- Card Utama: Tabel Cascading Permasalahan -->
                <div class="cascading-card">
                    <div class="cascading-card-header">
                        <div class="cascading-title">
                            <h3>
                                <i class="fa fa-sitemap" style="color: #15803d; margin-right: 8px;"></i> CASCADING PERMASALAHAN RKPD
                            </h3>
                            <p>Penyelarasan Permasalahan &rarr; Isu Strategis &rarr; Prioritas Pembangunan Daerah (Rancangan Awal RKPD Tahun <?= html_escape($SelectedTahun) ?>)</p>
                        </div>
                        <?php if ($isDaerah && !empty($KodeWilayah)) { ?>
                            <div class="tools">
                                <button type="button" class="btn btn-success" id="bP" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah permasalahan
                                </button>
                                <button type="button" class="btn btn-success" id="bI" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah isu strategis
                                </button>
                                <button type="button" class="btn btn-success" id="bR" style="border-radius: 6px; font-weight: 700; padding: 9px 16px; background: #15803d; border-color: #166534;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> Tambah prioritas pembangunan daerah
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div style="padding: 14px 24px 6px;">
                        <p class="hint" style="margin: 0; font-size: 13px; color: #166534; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 10px 14px; border-radius: 6px;">
                            <i class="fa fa-info-circle" style="color: #15803d; margin-right: 4px;"></i>
                            Tambahkan berurutan: <strong>permasalahan</strong>, <strong>isu strategis</strong>, lalu <strong>prioritas pembangunan daerah</strong>. Klik teks untuk mengubah langsung, atau klik tombol <span class="btn-xs-custom btn-edit-level" style="width:20px; height:20px; font-size:10px;"><i class="fa fa-pencil"></i></span> di sebelah kanan untuk mengubah keterkaitannya, serta tombol <span class="btn-xs-custom btn-del-level" style="width:20px; height:20px; font-size:10px;"><i class="fa fa-trash"></i></span> untuk menghapus butir.
                        </p>
                    </div>

                    <div class="table-responsive" style="padding: 14px 24px 24px;">
                        <table class="table table-bordered table-cascading" id="tbl"></table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?php if ($isDaerah) { ?>
<!-- ============================================================ -->
<!-- 1. MODAL TAMBAH PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="dP" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 560px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Permasalahan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <label for="inP" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Permasalahan</label>
                <textarea id="inP" class="form-control" rows="4" placeholder="Contoh: Rendahnya produktivitas dan nilai tambah sumber daya lokal" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                <p class="hint" style="margin: 6px 0 0; font-size: 12px; color: #64748b;">
                    <i class="fa fa-lightbulb-o" style="color: #f59e0b;"></i> Untuk menambah banyak sekaligus, tulis satu permasalahan per baris.
                </p>
                <p class="err-msg" id="eP"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sP" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 2. MODAL TAMBAH ISU STRATEGIS -->
<!-- ============================================================ -->
<div class="modal fade" id="dI" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Isu Strategis
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <label for="inI" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Isu strategis</label>
                <textarea id="inI" class="form-control" rows="3" placeholder="Contoh: Pemantapan pertumbuhan dan pemerataan ekonomi daerah" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>

                <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin: 16px 0 6px; display: block;">Permasalahan yang tercakup dalam isu ini</label>
                <div id="pickP" style="max-height: 220px; overflow-y: auto; padding: 2px;"></div>
                <p class="err-msg" id="eI"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sI" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 3. MODAL TAMBAH PRIORITAS PEMBANGUNAN DAERAH -->
<!-- ============================================================ -->
<div class="modal fade" id="dR" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-plus-circle" style="margin-right: 6px;"></i> Tambah Prioritas Pembangunan Daerah
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">
                    Isu strategis <span class="text-danger">*</span>
                </label>
                <div id="pickI" style="max-height: 200px; overflow-y: auto; padding: 2px;"></div>

                <label for="inR" style="font-weight: 700; font-size: 13px; color: #1e293b; margin: 16px 0 6px; display: block;">Prioritas pembangunan daerah</label>
                <textarea id="inR" class="form-control" rows="3" placeholder="Contoh: Jatim Kerja, memperluas lapangan kerja yang berkualitas" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                <p class="err-msg" id="eR"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="sR" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 4. MODAL EDIT PERMASALAHAN & KETERKAITAN ISU -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditPermasalahan" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 560px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Permasalahan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px;">
                <input type="hidden" id="editPermId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="editPermText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Permasalahan <span class="text-danger">*</span></label>
                    <textarea id="editPermText" class="form-control" rows="4" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <p class="err-msg" id="editPermErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditPerm" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 5. MODAL EDIT ISU STRATEGIS & KETERKAITAN PERMASALAHAN -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditIsu" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Isu Strategis & Pemetaan Permasalahan
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <input type="hidden" id="editIsuId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="editIsuText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Isu Strategis <span class="text-danger">*</span></label>
                    <textarea id="editIsuText" class="form-control" rows="3" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Permasalahan yang Tercakup dalam Isu Ini</label>
                    <p class="hint" style="margin: 0 0 8px; font-size: 12px; color: #64748b;">
                        Centang permasalahan untuk memetakannya ke isu ini, atau hilangkan centang untuk melepasnya.
                    </p>
                    <div id="editIsuPermContainer" style="max-height: 220px; overflow-y: auto; padding: 2px;"></div>
                </div>
                <p class="err-msg" id="editIsuErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditIsu" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- 6. MODAL EDIT PRIORITAS DAERAH & KETERKAITAN ISU -->
<!-- ============================================================ -->
<div class="modal fade" id="ModalEditPrioritas" role="dialog" data-backdrop="static">
    <div class="modal-dialog" style="margin-top: 60px; max-width: 580px;">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #15803d; color: #fff; padding: 16px 20px;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.9; font-size: 24px;">&times;</button>
                <h4 class="modal-title" style="font-weight: 800; color: #fff;">
                    <i class="fa fa-pencil" style="margin-right: 6px;"></i> Edit Prioritas Daerah & Keterkaitan Isu
                </h4>
            </div>
            <div class="modal-body" style="padding: 22px; max-height: calc(85vh - 120px); overflow-y: auto;">
                <input type="hidden" id="editProgId">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">
                        Isu Strategis yang Terkait <span class="text-danger">*</span>
                    </label>
                    <div id="editProgIsuContainer" style="max-height: 200px; overflow-y: auto; padding: 2px;"></div>
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="editProgText" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 6px; display: block;">Uraian Prioritas Pembangunan Daerah <span class="text-danger">*</span></label>
                    <textarea id="editProgText" class="form-control" rows="3" style="border-radius: 6px; border: 1.5px solid #cbd5e1; font-size: 13px;"></textarea>
                </div>
                <p class="err-msg" id="editProgErr"></p>
            </div>
            <div class="modal-footer" style="padding: 14px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Batal</button>
                <button type="button" class="btn btn-success" id="btnSaveEditProg" style="border-radius: 6px; font-weight: 700; background: #15803d; border-color: #166534; padding: 8px 22px;">
                    <i class="fa fa-save" style="margin-right: 4px;"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Scripts -->
<script>
$(document).ready(function() {
    var S = <?= json_encode(!empty($CascadingState) ? $CascadingState : ['perm'=>[], 'isu'=>[], 'prog'=>[]]) ?>;
    var isDaerah = <?= $isDaerah ? 'true' : 'false' ?>;
    var kodeWilayah = '<?= html_escape($KodeWilayah) ?>';
    var tahun = '<?= html_escape($SelectedTahun) ?>';
    var BaseURL = '<?= base_url() ?>';

    // State untuk menjaga posisi scroll dan kestabilan tampilan saat edit
    var savedScrollY = null;
    var savedScrollX = null;
    var savedWrapScrollLeft = 0;

    function captureScroll() {
        savedScrollY = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        savedScrollX = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
        var wr = $('.table-responsive');
        savedWrapScrollLeft = wr.length ? wr.scrollLeft() : 0;
    }

    function restoreScroll() {
        if (savedScrollY !== null && savedScrollY !== undefined) {
            window.scrollTo(savedScrollX || 0, savedScrollY);
            var wr = $('.table-responsive');
            if (wr.length && savedWrapScrollLeft != null) {
                wr.scrollLeft(savedWrapScrollLeft);
            }
        }
    }

    // Pastikan saat modal ditutup, posisi scroll tidak pernah melompat
    $('.modal').on('hidden.bs.modal', function() {
        restoreScroll();
        setTimeout(restoreScroll, 50);
        setTimeout(restoreScroll, 150);
    });

    function byId(id) {
        return document.getElementById(id);
    }

    function el(t, c, txt) {
        var e = document.createElement(t);
        if (c) e.className = c;
        if (txt != null) e.textContent = txt;
        return e;
    }

    function groups() {
        var g = [];
        var processedIsu = {};
        var processedProg = {};

        (S.perm || []).forEach(function(p) {
            if (p.isuId) {
                var isuKey = String(p.isuId);
                if (!processedIsu[isuKey]) {
                    processedIsu[isuKey] = true;
                    var isuObj = (S.isu || []).find(function(i) { return String(i.id) === isuKey; });
                    if (isuObj) {
                        g.push({
                            isu: isuObj,
                            P: (S.perm || []).filter(function(x) { return String(x.isuId) === isuKey; }),
                            R: (S.prog || []).filter(function(r) {
                                if (processedProg[r.id]) return false;
                                var match = (r.isuIds || []).map(String).indexOf(isuKey) > -1;
                                if (match) {
                                    processedProg[r.id] = true;
                                    return true;
                                }
                                return false;
                            })
                        });
                    }
                }
            } else {
                // Permasalahan belum dipetakan ke isu strategis
                // Pertahankan urutannya sesuai posisi permasalahan dalam daftar
                if (g.length > 0 && g[g.length - 1].isu === null) {
                    g[g.length - 1].P.push(p);
                } else {
                    g.push({
                        isu: null,
                        P: [p],
                        R: []
                    });
                }
            }
        });

        // Masukkan isu strategis yang belum memiliki permasalahan sama sekali (jika ada)
        (S.isu || []).forEach(function(i) {
            var isuKey = String(i.id);
            if (!processedIsu[isuKey]) {
                processedIsu[isuKey] = true;
                g.push({
                    isu: i,
                    P: [],
                    R: (S.prog || []).filter(function(r) {
                        if (processedProg[r.id]) return false;
                        var match = (r.isuIds || []).map(String).indexOf(isuKey) > -1;
                        if (match) {
                            processedProg[r.id] = true;
                            return true;
                        }
                        return false;
                    })
                });
            }
        });

        // Masukkan prioritas yang belum terpetakan ke grup manapun jika ada
        var unmappedProg = (S.prog || []).filter(function(r) {
            return !processedProg[r.id];
        });
        if (unmappedProg.length > 0) {
            if (g.length > 0 && g[g.length - 1].isu === null) {
                g[g.length - 1].R = g[g.length - 1].R.concat(unmappedProg);
            } else {
                g.push({
                    isu: null,
                    P: [],
                    R: unmappedProg
                });
            }
        }

        return g;
    }

    function editable(list, obj, type, isuContext) {
        var box = el('div', 'item'), t = el('span', 't', obj.text);
        box.setAttribute('data-type', type);
        box.setAttribute('data-id', obj.id);

        if (isDaerah && kodeWilayah) {
            t.contentEditable = 'true';
            t.spellcheck = false;
            t.title = 'Klik untuk mengubah teks langsung';

            t.onblur = function() {
                var v = t.textContent.trim();
                if (v && v !== obj.text) {
                    var oldText = obj.text;
                    obj.text = v;
                    $.ajax({
                        url: BaseURL + 'Daerah/UpdateCascadingItem',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            type: type,
                            id: obj.id,
                            text: v,
                            KodeWilayah: kodeWilayah,
                            Tahun: tahun
                        },
                        success: function(res) {
                            if (res.status !== 'success') {
                                obj.text = oldText;
                                t.textContent = oldText;
                                alert(res.message || 'Gagal menyimpan perubahan.');
                            } else {
                                box.classList.add('highlight-edited');
                                setTimeout(function() {
                                    box.classList.remove('highlight-edited');
                                }, 2200);
                            }
                        },
                        error: function() {
                            obj.text = oldText;
                            t.textContent = oldText;
                            alert('Gagal menghubungi server.');
                        }
                    });
                } else {
                    t.textContent = obj.text;
                }
            };

            t.onkeydown = function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    t.blur();
                }
            };

            var actions = el('span', 'item-actions');

            // Tombol Edit Keterkaitan
            var pencil = el('button', 'btn-xs-custom btn-edit-level', '');
            pencil.type = 'button';
            pencil.title = 'Edit uraian & keterkaitannya';
            pencil.innerHTML = '<i class="fa fa-pencil"></i>';
            pencil.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                captureScroll();
                openEditModal(type, obj, isuContext);
            };

            // Tombol Hapus
            var x = el('button', 'btn-xs-custom btn-del-level', '');
            x.type = 'button';
            x.title = 'Hapus';
            x.setAttribute('aria-label', 'Hapus');
            x.innerHTML = '<i class="fa fa-trash"></i>';
            x.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                captureScroll();

                var msg = type === 'perm' ? 'Apakah Anda yakin ingin menghapus permasalahan ini?' :
                         (type === 'isu' ? 'Apakah Anda yakin ingin menghapus isu strategis ini?\n(Permasalahan terkait akan kembali berstatus belum dipetakan)' :
                         'Apakah Anda yakin ingin menghapus prioritas pembangunan daerah ini?');
                if (!confirm(msg)) return;

                $.ajax({
                    url: BaseURL + 'Daerah/DeleteCascadingItem',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        type: type,
                        id: obj.id,
                        isuId: isuContext ? isuContext.id : null,
                        KodeWilayah: kodeWilayah,
                        Tahun: tahun
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            reloadState();
                        } else {
                            alert(res.message || 'Gagal menghapus data.');
                        }
                    },
                    error: function(xhr, status, err) {
                        alert('Terjadi kesalahan server: ' + err);
                    }
                });
            };

            actions.append(pencil, x);
            box.append(t, actions);
        } else {
            box.append(t);
        }
        return box;
    }

    function cell(rows, cls) {
        var c = document.createElement('td');
        if (rows > 1) c.rowSpan = rows;
        if (cls) c.className = cls;
        return c;
    }

    function renderTable(targetType, targetId) {
        var T = byId('tbl');
        if (!T) return;

        // Kunci tinggi minimum tabel agar tidak terjadi collapse tinggi dokumen yang menyebabkan scroll lompat ke atas
        var prevHeight = T.offsetHeight;
        if (prevHeight > 0) {
            T.style.minHeight = prevHeight + 'px';
        }

        T.innerHTML = '';
        var th = el('thead'), hr = el('tr');
        ['Permasalahan', 'Isu Strategis', 'Prioritas Pembangunan Daerah'].forEach(function(h) {
            var thCell = el('th', '', h);
            if (h === 'Permasalahan') thCell.style.width = '38%';
            else if (h === 'Isu Strategis') thCell.style.width = '32%';
            else thCell.style.width = '30%';
            hr.appendChild(thCell);
        });
        th.appendChild(hr);
        T.appendChild(th);

        var tb = el('tbody'), n = 0, gs = groups();
        if (!gs.length) {
            var r = el('tr');
            var emptyTxt = kodeWilayah ? 'Belum ada data. Klik "Tambah permasalahan" untuk memulai.' : 'Silakan pilih Provinsi dan Kabupaten / Kota terlebih dahulu.';
            var c = el('td', 'empty-msg', emptyTxt);
            c.colSpan = 3;
            r.appendChild(c);
            tb.appendChild(r);
        }
        gs.forEach(function(g) {
            var rows = Math.max(g.P.length, g.R.length, 1);
            for (var k = 0; k < rows; k++) {
                var tr = el('tr');
                if (g.P.length === 0) {
                    if (k === 0) {
                        var c0 = cell(rows);
                        c0.appendChild(el('span', 'na', 'Belum ada permasalahan'));
                        tr.appendChild(c0);
                    }
                } else if (k < g.P.length) {
                    var c1 = cell(k === g.P.length - 1 ? rows - k : 1);
                    n++;
                    var w = el('div', 'item-wrapper');
                    w.style.display = 'flex';
                    w.style.alignItems = 'flex-start';
                    w.style.gap = '8px';
                    w.style.width = '100%';

                    var num = el('span', 'item-num', n + '.');
                    num.style.fontWeight = '700';
                    num.style.color = '#15803d';
                    num.style.minWidth = '20px';
                    num.style.paddingTop = '3px';
                    num.style.fontSize = '13px';
                    w.appendChild(num);

                    var ed = editable(S.perm, g.P[k], 'perm', null);
                    ed.style.flex = '1';
                    w.appendChild(ed);
                    c1.appendChild(w);
                    tr.appendChild(c1);
                }

                if (k === 0) {
                    var c2 = cell(rows, 'mid');
                    if (g.isu) {
                        c2.appendChild(editable(S.isu, g.isu, 'isu', null));
                    } else {
                        c2.appendChild(el('span', 'na', 'Belum dipetakan ke isu strategis'));
                    }
                    tr.appendChild(c2);
                }

                if (g.R.length === 0) {
                    if (k === 0) {
                        var c3 = cell(rows);
                        c3.appendChild(el('span', 'na', g.isu ? 'Belum ada prioritas pembangunan daerah' : '—'));
                        tr.appendChild(c3);
                    }
                } else if (k < g.R.length) {
                    var c4 = cell(k === g.R.length - 1 ? rows - k : 1);
                    c4.appendChild(editable(S.prog, g.R[k], 'prog', g.isu));
                    tr.appendChild(c4);
                }
                tb.appendChild(tr);
            }
        });
        T.appendChild(tb);

        // Lepas minHeight secara mulus
        setTimeout(function() {
            if (T) T.style.minHeight = '';
        }, 120);

        // Kembalikan posisi scroll pada beberapa interval agar modal bootstrap tidak meresetnya
        restoreScroll();
        requestAnimationFrame(restoreScroll);
        setTimeout(restoreScroll, 40);
        setTimeout(restoreScroll, 120);
        setTimeout(restoreScroll, 300);

        // Beri efek highlight pada item yang baru selesai diedit
        if (targetType && targetId) {
            setTimeout(function() {
                var targetEl = document.querySelector('.item[data-type="' + targetType + '"][data-id="' + targetId + '"]');
                if (targetEl) {
                    targetEl.classList.add('highlight-edited');
                    setTimeout(function() {
                        targetEl.classList.remove('highlight-edited');
                    }, 2200);

                    // Pastikan tetap berada dalam bidang pandang tanpa lompat kasar
                    var rect = targetEl.getBoundingClientRect();
                    var windowH = window.innerHeight || document.documentElement.clientHeight;
                    if (rect.top < 60 || rect.bottom > windowH - 30) {
                        targetEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }
            }, 60);
        }
    }

    function clean() {
        var ids = {};
        (S.isu || []).forEach(function(i) { ids[String(i.id)] = 1; });
        (S.perm || []).forEach(function(p) { if (p.isuId && !ids[String(p.isuId)]) p.isuId = null; });
        (S.prog || []).forEach(function(r) {
            r.isuIds = (r.isuIds || []).filter(function(id) { return ids[String(id)]; });
        });
    }

    function render(targetType, targetId) {
        clean();
        if (isDaerah && kodeWilayah) {
            var hasPerm = S.perm && S.perm.length > 0;
            var hasIsu = S.isu && S.isu.length > 0;

            $('#bI').prop('disabled', !hasPerm).attr('title', hasPerm ? '' : 'Tambahkan permasalahan terlebih dahulu');
            $('#bR').prop('disabled', !hasIsu).attr('title', hasIsu ? '' : 'Tambahkan isu strategis terlebih dahulu');
        }
        renderTable(targetType, targetId);
    }

    function reloadState(targetType, targetId) {
        if (!kodeWilayah) return;
        if (savedScrollY === null || savedScrollY === undefined) {
            captureScroll();
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetCascadingData',
            type: 'POST',
            dataType: 'json',
            data: {
                KodeWilayah: kodeWilayah,
                Tahun: tahun
            },
            success: function(res) {
                if (res.status === 'success' && res.data) {
                    S = res.data;
                    render(targetType, targetId);
                }
            }
        });
    }

    // Modal Actions
    if (isDaerah && kodeWilayah) {

        // 1. Tambah Permasalahan
        $('#bP').on('click', function() {
            captureScroll();
            $('#inP').val('');
            $('#eP').text('');
            $('#dP').modal('show');
            setTimeout(function() { $('#inP').focus(); }, 350);
        });

        $('#sP').on('click', function() {
            var raw = $('#inP').val();
            var lines = raw.split('\n').map(function(s) { return s.trim(); }).filter(Boolean);
            if (!lines.length) {
                $('#eP').text('Isi permasalahan terlebih dahulu.');
                $('#inP').focus();
                return;
            }
            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SavePermasalahan',
                type: 'POST',
                dataType: 'json',
                data: {
                    lines: lines,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dP').modal('hide');
                        reloadState();
                    } else {
                        $('#eP').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eP').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // 2. Tambah Isu Strategis
        $('#bI').on('click', function() {
            captureScroll();
            $('#inI').val('');
            $('#eI').text('');
            var pk = $('#pickP');
            pk.empty();

            if (!S.perm || !S.perm.length) {
                pk.html('<div class="empty-msg">Belum ada permasalahan yang tersedia. (Anda tetap dapat menyimpan isu strategis ini dan memetakannya nanti)</div>');
            } else {
                S.perm.forEach(function(p, idx) {
                    var isChecked = !p.isuId;
                    var otherIsu = (!isChecked && p.isuId) ? (S.isu || []).find(function(x) { return String(x.id) === String(p.isuId); }) : null;
                    var badge = !p.isuId ? '<span class="label label-default" style="margin-left: 6px;">Belum dipetakan</span>' :
                               (otherIsu ? '<span class="label label-warning" style="margin-left: 6px;">Isu: ' + $('<div>').text(otherIsu.text).html() + '</span>' : '');
                    var l = $('<label class="chk"></label>');
                    var inp = $('<input type="checkbox">').val(p.id);
                    var num = (idx + 1) + '. ';
                    l.append(inp).append($('<span></span>').html('<strong>' + num + '</strong>' + $('<div>').text(p.text).html() + ' ' + badge));
                    pk.append(l);
                });
            }
            $('#sI').prop('disabled', false);
            $('#dI').modal('show');
            setTimeout(function() { $('#inI').focus(); }, 350);
        });

        $('#sI').on('click', function() {
            var t = $.trim($('#inI').val());
            var ids = [];
            $('#pickP input:checked').each(function() {
                ids.push($(this).val());
            });

            if (!t) {
                $('#eI').text('Isi isu strategis terlebih dahulu.');
                $('#inI').focus();
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SaveIsuStrategis',
                type: 'POST',
                dataType: 'json',
                data: {
                    text: t,
                    permIds: ids,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dI').modal('hide');
                        reloadState();
                    } else {
                        $('#eI').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eI').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // 3. Tambah Prioritas Pembangunan Daerah
        $('#bR').on('click', function() {
            captureScroll();
            $('#inR').val('');
            $('#eR').text('');
            var pk = $('#pickI');
            pk.empty();

            if (!S.isu || !S.isu.length) {
                pk.html('<div class="empty-msg">Belum ada isu strategis. Tambahkan isu strategis terlebih dahulu.</div>');
                $('#sR').prop('disabled', true);
            } else {
                $('#sR').prop('disabled', false);
                S.isu.forEach(function(i, idx) {
                    var l = $('<label class="chk"></label>');
                    var c = $('<input type="radio" name="pickIsuRadio">').val(i.id);
                    if (idx === 0) c.prop('checked', true);
                    l.append(c).append($('<span></span>').text(i.text));
                    pk.append(l);
                });
            }
            $('#dR').modal('show');
            setTimeout(function() { $('#inR').focus(); }, 350);
        });

        $('#sR').on('click', function() {
            var t = $.trim($('#inR').val());
            var selectedIsuId = $('#pickI input[name="pickIsuRadio"]:checked').val();
            var ids = selectedIsuId ? [selectedIsuId] : [];

            if (!ids.length) {
                $('#eR').text('Pilih isu strategis.');
                return;
            }
            if (!t) {
                $('#eR').text('Isi prioritas pembangunan daerah terlebih dahulu.');
                $('#inR').focus();
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/SavePrioritasDaerah',
                type: 'POST',
                dataType: 'json',
                data: {
                    text: t,
                    isuIds: ids,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).text('Simpan');
                    if (res.status === 'success') {
                        $('#dR').modal('hide');
                        reloadState();
                    } else {
                        $('#eR').text(res.message || 'Gagal menyimpan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).text('Simpan');
                    $('#eR').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // ============================================================
        // MODAL EDIT KETERKAITAN (Permasalahan, Isu, Prioritas)
        // ============================================================

        function openEditModal(type, obj, isuContext) {
            captureScroll();
            if (type === 'perm') {
                $('#editPermId').val(obj.id);
                $('#editPermText').val(obj.text);
                $('#editPermErr').text('');
                $('#ModalEditPermasalahan').modal('show');
                setTimeout(function() { $('#editPermText').focus(); }, 350);

            } else if (type === 'isu') {
                $('#editIsuId').val(obj.id);
                $('#editIsuText').val(obj.text);
                $('#editIsuErr').text('');

                var ctn = $('#editIsuPermContainer');
                ctn.empty();

                if (!S.perm || !S.perm.length) {
                    ctn.html('<div class="empty-msg">Belum ada permasalahan yang tersedia.</div>');
                } else {
                    S.perm.forEach(function(p, idx) {
                        var isChecked = String(p.isuId) === String(obj.id);
                        var otherIsu = (!isChecked && p.isuId) ? (S.isu || []).find(function(x) { return String(x.id) === String(p.isuId); }) : null;
                        var badge = isChecked ? '<span class="label label-success" style="margin-left: 6px;">Terhubung</span>' :
                                   (otherIsu ? '<span class="label label-warning" style="margin-left: 6px;">Isu: ' + $('<div>').text(otherIsu.text).html() + '</span>' :
                                              '<span class="label label-default" style="margin-left: 6px;">Belum dipetakan</span>');
                        var l = $('<label class="chk"></label>');
                        var inp = $('<input type="checkbox">').val(p.id).prop('checked', isChecked);
                        var num = (idx + 1) + '. ';
                        l.append(inp).append($('<span></span>').html('<strong>' + num + '</strong>' + $('<div>').text(p.text).html() + ' ' + badge));
                        ctn.append(l);
                    });
                }
                $('#ModalEditIsu').modal('show');
                setTimeout(function() { $('#editIsuText').focus(); }, 350);

            } else if (type === 'prog') {
                $('#editProgId').val(obj.id);
                $('#editProgText').val(obj.text);
                $('#editProgErr').text('');

                var ctn = $('#editProgIsuContainer');
                ctn.empty();

                if (!S.isu || !S.isu.length) {
                    ctn.html('<div class="empty-msg">Belum ada isu strategis.</div>');
                } else {
                    var activeIsuId = (isuContext && isuContext.id) ? String(isuContext.id) : 
                                     ((obj.isuIds && obj.isuIds.length) ? String(obj.isuIds[0]) : '');

                    S.isu.forEach(function(i, idx) {
                        var isChecked = activeIsuId ? (String(i.id) === activeIsuId) : (idx === 0);
                        var l = $('<label class="chk"></label>');
                        var inp = $('<input type="radio" name="editProgIsuRadio">').val(i.id).prop('checked', isChecked);
                        l.append(inp).append($('<span></span>').text(i.text));
                        ctn.append(l);
                    });
                }
                $('#ModalEditPrioritas').modal('show');
                setTimeout(function() { $('#editProgText').focus(); }, 350);
            }
        }

        // Simpan Edit Permasalahan
        $('#btnSaveEditPerm').on('click', function() {
            var id = $('#editPermId').val();
            var text = $.trim($('#editPermText').val());

            if (!text) {
                $('#editPermErr').text('Uraian permasalahan wajib diisi!');
                $('#editPermText').focus();
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanPermasalahan',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditPermasalahan').modal('hide');
                        reloadState('perm', id);
                    } else {
                        $('#editPermErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editPermErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // Simpan Edit Isu Strategis & Pemetaan Permasalahan
        $('#btnSaveEditIsu').on('click', function() {
            var id = $('#editIsuId').val();
            var text = $.trim($('#editIsuText').val());
            var permIds = [];
            $('#editIsuPermContainer input:checked').each(function() {
                permIds.push($(this).val());
            });

            if (!text) {
                $('#editIsuErr').text('Uraian isu strategis wajib diisi!');
                $('#editIsuText').focus();
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanIsu',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    permIds: permIds,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditIsu').modal('hide');
                        reloadState('isu', id);
                    } else {
                        $('#editIsuErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editIsuErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

        // Simpan Edit Prioritas Daerah & Keterkaitan Isu
        $('#btnSaveEditProg').on('click', function() {
            var id = $('#editProgId').val();
            var text = $.trim($('#editProgText').val());
            var selectedIsuId = $('#editProgIsuContainer input[name="editProgIsuRadio"]:checked').val();
            var isuIds = selectedIsuId ? [selectedIsuId] : [];

            if (!text) {
                $('#editProgErr').text('Uraian prioritas daerah wajib diisi!');
                $('#editProgText').focus();
                return;
            }
            if (!isuIds.length) {
                $('#editProgErr').text('Pilih isu strategis yang terkait!');
                return;
            }

            captureScroll();
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: BaseURL + 'Daerah/UpdateKeterkaitanPrioritas',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    text: text,
                    isuIds: isuIds,
                    KodeWilayah: kodeWilayah,
                    Tahun: tahun
                },
                success: function(res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    if (res.status === 'success') {
                        $('#ModalEditPrioritas').modal('hide');
                        reloadState('prog', id);
                    } else {
                        $('#editProgErr').text(res.message || 'Gagal menyimpan perubahan.');
                    }
                },
                error: function(xhr, status, err) {
                    btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Perubahan');
                    $('#editProgErr').text('Terjadi kesalahan server: ' + err);
                }
            });
        });

    }

    // Filter Provinsi/KabKota untuk admin
    $('#FilterProvinsi').on('change', function() {
        var provKode = $(this).val();
        if (!provKode) {
            $('#FilterKabKota').html('<option value="">-- Pilih Kabupaten / Kota --</option>');
            return;
        }
        $.ajax({
            url: BaseURL + 'Daerah/GetKabKotaByProvinsi',
            type: 'POST',
            dataType: 'json',
            data: { KodeProvinsi: provKode },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        opt += '<option value="' + k.Kode + '">' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    });

    // Populate KabKota saat halaman dibuka jika sudah ada provinsi terpilih
    var initProv = $('#FilterProvinsi').val();
    if (initProv) {
        $.ajax({
            url: BaseURL + 'Daerah/GetKabKotaByProvinsi',
            type: 'POST',
            dataType: 'json',
            data: { KodeProvinsi: initProv },
            success: function(kabList) {
                var opt = '<option value="">-- Pilih Kabupaten / Kota --</option>';
                if (kabList) {
                    for (var i = 0; i < kabList.length; i++) {
                        var k = kabList[i];
                        var sel = (k.Kode === kodeWilayah) ? 'selected' : '';
                        opt += '<option value="' + k.Kode + '" ' + sel + '>' + $('<div>').text(k.Nama).html() + '</option>';
                    }
                }
                $('#FilterKabKota').html(opt);
            }
        });
    }

    render();
});
</script>
