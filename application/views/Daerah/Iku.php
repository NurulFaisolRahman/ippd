<?php
if (!function_exists('format_rumus_rpjmd')) {
    function format_rumus_rpjmd($rumus) {
        if (empty($rumus)) return '';
        $escaped = htmlspecialchars($rumus, ENT_QUOTES, 'UTF-8');
        $formatted = str_replace(
            ['&lt;sup&gt;', '&lt;/sup&gt;', '&lt;sub&gt;', '&lt;/sub&gt;'],
            ['<sup>', '</sup>', '<sub>', '</sub>'],
            $escaped
        );
        $formatted = preg_replace('/\^\{([^\}]+)\}/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\^\(([^\)]+)\)/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\^([0-9a-zA-Z\+\-\*\/]+)/', '<sup>$1</sup>', $formatted);
        $formatted = preg_replace('/\_\{([^\}]+)\}/', '<sub>$1</sub>', $formatted);
        $formatted = preg_replace('/\_\(([^\)]+)\)/', '<sub>$1</sub>', $formatted);
        $formatted = preg_replace('/\_([a-zA-Z0-9\+\-]+)/', '<sub>$1</sub>', $formatted);
        return nl2br($formatted);
    }
}
?>
<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Main Content -->
<div class="main-content">
    <div class="data-table-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
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

                                <!-- Menampilkan Wilayah dan Pesan Error setelah filter -->
                                <?php if (!empty($KodeWilayah)) { ?>
                                    <?php 
                                        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                                        $nama_wilayah = $wilayah ? html_escape($wilayah['Nama']) : 'Wilayah Tidak Ditemukan';
                                        if (empty($Iku)) {
                                            $pesan_error = "Tidak ada data IKU untuk wilayah: $nama_wilayah";
                                        }
                                    ?>
                                    <div class="alert <?= empty($Iku) ? 'alert-warning' : 'alert-info' ?>" style="margin-bottom: 20px;">
                                        <strong>Wilayah:</strong> <?= $nama_wilayah ?><br>
                                        <?php if (!empty($pesan_error)) { ?>
                                            <strong>Peringatan:</strong> <?= html_escape($pesan_error) ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px; align-items: center;">
                                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                    <button type="button" class="btn btn-primary notika-btn-primary BtnBukaSinkron" data-tipe="tujuan" data-label="Sinkron Tujuan">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Tujuan</b>
                                    </button>
                                    <button type="button" class="btn btn-info notika-btn-info BtnBukaSinkron" data-tipe="sasaran" data-label="Sinkron Sasaran">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Sasaran</b>
                                    </button>
                                    <button type="button" class="btn btn-success notika-btn-success BtnBukaSinkron" data-tipe="tujuan_sasaran" data-label="Sinkron Tujuan &amp; Sasaran">
                                        <i class="fa fa-refresh"></i> <b>Sinkron Tujuan &amp; Sasaran</b>
                                    </button>
                                <?php } ?>

                                <button type="button" class="btn btn-primary BtnBukaIntegrasiApi" id="BtnOpenIntegrasiApi" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%) !important; color: #fff !important; border: none !important; font-weight: 700; border-radius: 4px; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.25);">
                                    <i class="fa fa-cloud-download"></i> <b>Integrasi &amp; Impor API</b>
                                </button>

                                <!-- Realtime Status Pill -->
                                <div class="realtime-status-pill" id="RealtimeStatusPill" title="Koneksi realtime perubahan data IKU aktif" style="display: inline-flex; align-items: center; gap: 8px; margin-left: auto; padding: 6px 14px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 9999px; font-size: 12px; font-weight: 600; color: #065f46;">
                                    <span class="realtime-pulse-dot"></span>
                                    <span id="RealtimeStatusText">Realtime IKU Aktif</span>
                                </div>
                            </div>

                            <!-- Alert Banner Realtime Update -->
                            <div id="AlertRealtimeUpdate" class="alert alert-warning" style="display: none; border-left: 5px solid #f59e0b; border-radius: 6px; margin-bottom: 15px; padding: 12px 16px; background: #fffbeb; color: #92400e;">
                                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                                    <div>
                                        <i class="fa fa-bell" style="margin-right: 6px; color: #d97706;"></i>
                                        <strong>Pemberitahuan Realtime:</strong> <span id="AlertRealtimeText">Terjadi perubahan data pada menu IKU.</span>
                                    </div>
                                    <button type="button" class="btn btn-xs btn-warning" id="BtnRefreshTableRealtime" style="font-weight: 700; border-radius: 4px;">
                                        <i class="fa fa-refresh"></i> Muat Ulang Tabel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 3%; vertical-align: middle !important;">No</th>
                                        <th style="width: 23%; vertical-align: middle !important;">Indikator Kinerja Utama</th>
                                        <th style="width: 18%; vertical-align: middle !important;">Rumus</th>
                                        <th style="width: 18%; vertical-align: middle !important;">Definisi Operasional</th>
                                        <th class="text-center" style="width: 10%; vertical-align: middle !important;">Periode</th>
                                        <th class="text-center" style="width: 5%; vertical-align: middle !important;">Target <br><small>Tahun 1</small></th>
                                        <th class="text-center" style="width: 5%; vertical-align: middle !important;">Target <br><small>Tahun 2</small></th>
                                        <th class="text-center" style="width: 5%; vertical-align: middle !important;">Target <br><small>Tahun 3</small></th>
                                        <th class="text-center" style="width: 5%; vertical-align: middle !important;">Target <br><small>Tahun 4</small></th>
                                        <th class="text-center" style="width: 5%; vertical-align: middle !important;">Target <br><small>Tahun 5</small></th>
                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                            <th class="text-center" style="width: 6%; vertical-align: middle !important;">Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $No = 1; foreach ($Iku as $key) { ?>
                                        <tr id="row-iku-<?= $key['id'] ?>">
                                            <td style="vertical-align: middle;" class="text-center"><?= $No++ ?></td>
                                            <td style="vertical-align: middle; font-weight: 600;">
                                                <span class="indikator-nama-text"><?= html_escape($key['indikator_tujuan']) ?></span>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="rumus-display-box" id="rumus-box-<?= $key['id'] ?>">
                                                    <?php if (!empty($key['rumus'])) { ?>
                                                        <div class="rumus-tag-wrapper">
                                                            <span class="rumus-badge-icon"><i class="fa fa-calculator"></i></span>
                                                            <span class="rumus-content"><?= format_rumus_rpjmd($key['rumus']) ?></span>
                                                        </div>
                                                    <?php } else { ?>
                                                        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                            <button type="button" class="btn btn-xs btn-add-rumus BtnBukaInputRumus" 
                                                                    data-id="<?= $key['id'] ?>" 
                                                                    data-indikator="<?= html_escape($key['indikator_tujuan']) ?>" 
                                                                    data-rumus=""
                                                                    data-definisi="<?= html_escape($key['definisi_operasional'] ?? '') ?>"
                                                                    data-periode="<?= (!empty($key['tahun_mulai']) && !empty($key['tahun_akhir'])) ? html_escape($key['tahun_mulai']) . ' - ' . html_escape($key['tahun_akhir']) : '-' ?>">
                                                                <i class="fa fa-plus-circle"></i> Tambah Rumus
                                                            </button>
                                                        <?php } else { ?>
                                                            <span class="text-muted"><small><em>Belum ada rumus</em></small></span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="definisi-display-box" id="definisi-box-<?= $key['id'] ?>">
                                                    <?php if (!empty($key['definisi_operasional'])) { ?>
                                                        <div class="definisi-text-wrapper">
                                                            <?= nl2br(html_escape($key['definisi_operasional'])) ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="text-muted" style="font-size:11px; font-style:italic;">-</span>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= (!empty($key['tahun_mulai']) && !empty($key['tahun_akhir'])) ? html_escape($key['tahun_mulai']) . ' - ' . html_escape($key['tahun_akhir']) : '-' ?>
                                            </td>
<?php
if (!function_exists('format_target_koma')) {
    function format_target_koma($v) {
        if ($v === null || $v === '') return '-';
        $str = trim((string)$v);
        if ($str === '' || $str === '-') return '-';
        return html_escape(str_replace('.', ',', $str));
    }
}
?>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= format_target_koma($key['target_1'] ?? null) ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= format_target_koma($key['target_2'] ?? null) ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= format_target_koma($key['target_3'] ?? null) ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= format_target_koma($key['target_4'] ?? null) ?>
                                            </td>
                                            <td style="vertical-align: middle;" class="text-center">
                                                <?= format_target_koma($key['target_5'] ?? null) ?>
                                            </td>
                                            <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
                                                <td style="vertical-align: middle;" class="text-center">
                                                    <button type="button" class="btn btn-xs btn-primary btn-action-iku BtnBukaInputRumus" 
                                                            style="background-color: #03a9f3 !important; color: #fff !important; border: none;"
                                                            data-id="<?= $key['id'] ?>"
                                                            data-indikator="<?= html_escape($key['indikator_tujuan']) ?>"
                                                            data-rumus="<?= html_escape($key['rumus'] ?? '') ?>"
                                                            data-definisi="<?= html_escape($key['definisi_operasional'] ?? '') ?>"
                                                            data-periode="<?= (!empty($key['tahun_mulai']) && !empty($key['tahun_akhir'])) ? html_escape($key['tahun_mulai']) . ' - ' . html_escape($key['tahun_akhir']) : '-' ?>"
                                                            title="Tambah / Edit Rumus & Definisi Operasional RPJMD">
                                                        <i class="fa fa-calculator"></i>
                                                    </button>
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

    <!-- Modal Pilih Periode Sinkronisasi -->
    <div class="modal fade" id="ModalSinkronIku" role="dialog">
        <div class="modal-dialog modal-iku-dialog">
            <div class="modal-content modal-iku-content">
                <div class="modal-header modal-iku-header">
                    <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                    <h4 class="modal-title" id="ModalSinkronTitle">
                        <span class="modal-title-icon"><i class="fa fa-refresh"></i></span>
                        Sinkronisasi Data IKU
                    </h4>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-body modal-iku-body">
                    <form id="FormSinkronIku">
                        <input type="hidden" id="SinkronTipe" name="tipe" value="">
                        
                        <div class="alert alert-info" style="border-radius: 6px; padding: 12px 15px; margin-bottom: 18px;">
                            <i class="fa fa-info-circle"></i> <span id="SinkronKeterangan">Pilih periode tahun untuk melakukan sinkronisasi data dari VMTS.</span>
                        </div>

                        <div class="form-group">
                            <label for="SinkronPeriode" style="font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;"><b>Pilih Periode Tahun</b> <span class="text-danger">*</span></label>
                            <select class="form-control" id="SinkronPeriode" name="periode" required style="border-radius: 6px; height: 38px;">
                                <option value="" selected disabled>-- Pilih Periode Tahun --</option>
                                <?php if (!empty($Periods)) { ?>
                                    <?php foreach ($Periods as $period) { ?>
                                        <option value="<?= html_escape($period['TahunMulai'] . '-' . $period['TahunAkhir']) ?>">
                                            <?= html_escape($period['TahunMulai'] . ' - ' . $period['TahunAkhir']) ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled>Belum ada data periode VMTS untuk wilayah ini</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="modal-footer modal-iku-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                            <button type="submit" class="btn btn-success notika-btn-success" id="BtnProsesSinkron" style="border-radius: 6px;">
                                <i class="fa fa-cloud-download"></i> <b>Sinkronkan Sekarang</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Input / Edit Rumus RPJMD -->
    <div class="modal fade" id="ModalInputRumus" role="dialog">
        <div class="modal-dialog modal-rumus-dialog">
            <div class="modal-content modal-iku-content">
                <div class="modal-header modal-iku-header">
                    <button type="button" class="close" data-dismiss="modal" title="Tutup">&times;</button>
                    <h4 class="modal-title">
                        <span class="modal-title-icon"><i class="fa fa-calculator"></i></span>
                        Rumus & Definisi Operasional
                    </h4>
                    <div style="clear: both;"></div>
                </div>
                <div class="modal-body modal-iku-body">
                    <form id="FormInputRumus">
                        <input type="hidden" id="RumusIkuId" name="id" value="">
                        
                        <div class="detail-indikator-card">
                            <div class="detail-indikator-label">Indikator Kinerja Utama (IKU)</div>
                            <div class="detail-indikator-val" id="RumusIndikatorNama">-</div>
                            <div class="detail-indikator-periode" id="RumusIndikatorPeriode" style="margin-top: 4px; font-size: 11px; color: #64748b;"></div>
                        </div>

                        <!-- Bilah Toolbar Simbol Matematika & Perpangkatan -->
                        <div class="math-toolbar-box">
                            <div class="math-toolbar-header">
                                <span class="math-toolbar-title"><i class="fa fa-keyboard-o"></i> Sisipkan Simbol & Notasi Rumus:</span>
                                <div class="math-tab-pills">
                                    <button type="button" class="math-tab-btn active" data-tab="tab-pangkat">Pangkat</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-subscript">Indeks Bawah</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-operator">Operator & Akar</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-simbol">Simbol & Yunani</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-kurung">Kurung</button>
                                    <button type="button" class="math-tab-btn" data-tab="tab-template">Template Cepat</button>
                                </div>
                            </div>
                            
                            <!-- Konten Tab 1: Pangkat (Superscript) -->
                            <div class="math-tab-content active" id="tab-pangkat">
                                <div class="math-char-group">
                                    <span class="math-group-label">Pangkat Angka & Huruf:</span>
                                    <button type="button" class="btn-math-char" data-char="⁰" title="Pangkat 0">⁰</button>
                                    <button type="button" class="btn-math-char" data-char="¹" title="Pangkat 1">¹</button>
                                    <button type="button" class="btn-math-char" data-char="²" title="Pangkat 2 (Kuadrat)">²</button>
                                    <button type="button" class="btn-math-char" data-char="³" title="Pangkat 3 (Kubik)">³</button>
                                    <button type="button" class="btn-math-char" data-char="⁴" title="Pangkat 4">⁴</button>
                                    <button type="button" class="btn-math-char" data-char="⁵" title="Pangkat 5">⁵</button>
                                    <button type="button" class="btn-math-char" data-char="⁶" title="Pangkat 6">⁶</button>
                                    <button type="button" class="btn-math-char" data-char="⁷" title="Pangkat 7">⁷</button>
                                    <button type="button" class="btn-math-char" data-char="⁸" title="Pangkat 8">⁸</button>
                                    <button type="button" class="btn-math-char" data-char="⁹" title="Pangkat 9">⁹</button>
                                    <button type="button" class="btn-math-char" data-char="ⁿ" title="Pangkat n">ⁿ</button>
                                    <button type="button" class="btn-math-char" data-char="ᵗ" title="Pangkat t (Tahun/Waktu)">ᵗ</button>
                                    <button type="button" class="btn-math-char" data-char="ˣ" title="Pangkat x">ˣ</button>
                                    <button type="button" class="btn-math-char" data-char="ʸ" title="Pangkat y">ʸ</button>
                                    <button type="button" class="btn-math-char" data-char="⁺" title="Pangkat +">⁺</button>
                                    <button type="button" class="btn-math-char" data-char="⁻" title="Pangkat -">⁻</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Format Notasi Eksponen:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="^(2)" title="Pangkat dua / kuadrat">^(2)</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="^(n)" title="Pangkat n">^(n)</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="^(1/t)" title="Akar pangkat t / geometrik">^(1/t)</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="<sup></sup>" data-tag="sup" title="Tag HTML Pangkat (Superscript)">&lt;sup&gt;x&lt;/sup&gt;</button>
                                </div>
                            </div>

                            <!-- Konten Tab 2: Indeks Bawah (Subscript) -->
                            <div class="math-tab-content" id="tab-subscript">
                                <div class="math-char-group">
                                    <span class="math-group-label">Indeks Angka & Variabel:</span>
                                    <button type="button" class="btn-math-char" data-char="₀" title="Subscript 0 (Periode dasar / awal)">₀</button>
                                    <button type="button" class="btn-math-char" data-char="₁" title="Subscript 1">₁</button>
                                    <button type="button" class="btn-math-char" data-char="₂" title="Subscript 2">₂</button>
                                    <button type="button" class="btn-math-char" data-char="₃" title="Subscript 3">₃</button>
                                    <button type="button" class="btn-math-char" data-char="₄" title="Subscript 4">₄</button>
                                    <button type="button" class="btn-math-char" data-char="₅" title="Subscript 5">₅</button>
                                    <button type="button" class="btn-math-char" data-char="₆" title="Subscript 6">₆</button>
                                    <button type="button" class="btn-math-char" data-char="₇" title="Subscript 7">₇</button>
                                    <button type="button" class="btn-math-char" data-char="₈" title="Subscript 8">₈</button>
                                    <button type="button" class="btn-math-char" data-char="₉" title="Subscript 9">₉</button>
                                    <button type="button" class="btn-math-char" data-char="ₜ" title="Subscript t (Tahun ke-t)">ₜ</button>
                                    <button type="button" class="btn-math-char" data-char="ᵢ" title="Subscript i (Item / Kategori ke-i)">ᵢ</button>
                                    <button type="button" class="btn-math-char" data-char="ₙ" title="Subscript n (Populasi / Jumlah)">ₙ</button>
                                    <button type="button" class="btn-math-char" data-char="ⱼ" title="Subscript j">ⱼ</button>
                                    <button type="button" class="btn-math-char" data-char="ₘ" title="Subscript m">ₘ</button>
                                    <button type="button" class="btn-math-char" data-char="ₖ" title="Subscript k">ₖ</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Kombinasi Notasi Indeks:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Pₜ" title="Populasi / Capaian tahun t">Pₜ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Pₜ₋₁" title="Tahun sebelumnya (t-1)">Pₜ₋₁</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="P₀" title="Tahun dasar / baseline (0)">P₀</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Xᵢ" title="Variabel ke-i">Xᵢ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="Wᵢ" title="Bobot ke-i (Weight)">Wᵢ</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="_(t-1)" title="Notasi underscore _(t-1)">_(t-1)</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="<sub></sub>" data-tag="sub" title="Tag HTML Indeks Bawah">&lt;sub&gt;x&lt;/sub&gt;</button>
                                </div>
                            </div>

                            <!-- Konten Tab 3: Operator & Akar -->
                            <div class="math-tab-content" id="tab-operator">
                                <div class="math-char-group">
                                    <span class="math-group-label">Aritmatika & Perbandingan:</span>
                                    <button type="button" class="btn-math-char" data-char=" × " title="Kali (Perkalian)">×</button>
                                    <button type="button" class="btn-math-char" data-char=" ÷ " title="Bagi (Pembagian)">÷</button>
                                    <button type="button" class="btn-math-char" data-char=" ± " title="Plus Minus">±</button>
                                    <button type="button" class="btn-math-char" data-char=" ∓ " title="Minus Plus">∓</button>
                                    <button type="button" class="btn-math-char" data-char=" / " title="Garis Miring / Pembagian">/</button>
                                    <button type="button" class="btn-math-char" data-char=" · " title="Titik Perkalian (Dot)">·</button>
                                    <button type="button" class="btn-math-char" data-char=" = " title="Sama dengan">=</button>
                                    <button type="button" class="btn-math-char" data-char=" ≠ " title="Tidak sama dengan">≠</button>
                                    <button type="button" class="btn-math-char" data-char=" ≈ " title="Mendekati / Kira-kira">≈</button>
                                    <button type="button" class="btn-math-char" data-char=" ≤ " title="Kurang dari sama dengan">≤</button>
                                    <button type="button" class="btn-math-char" data-char=" ≥ " title="Lebih dari sama dengan">≥</button>
                                    <button type="button" class="btn-math-char" data-char=" < " title="Kurang dari">&lt;</button>
                                    <button type="button" class="btn-math-char" data-char=" > " title="Lebih dari">&gt;</button>
                                    <button type="button" class="btn-math-char" data-char="%" title="Persen">%</button>
                                    <button type="button" class="btn-math-char" data-char="‰" title="Permil">‰</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Bentuk Akar:</span>
                                    <button type="button" class="btn-math-char" data-char="√" title="Akar Kuadrat (Square Root)">√</button>
                                    <button type="button" class="btn-math-char" data-char="√( )" data-wrap="√(" data-wrapend=")" title="Akar dengan tanda kurung">√( )</button>
                                    <button type="button" class="btn-math-char" data-char="∛" title="Akar Pangkat 3">∛</button>
                                    <button type="button" class="btn-math-char" data-char="∜" title="Akar Pangkat 4">∜</button>
                                </div>
                            </div>

                            <!-- Konten Tab 4: Simbol & Yunani -->
                            <div class="math-tab-content" id="tab-simbol">
                                <div class="math-char-group">
                                    <span class="math-group-label">Statistik & Kalkulus:</span>
                                    <button type="button" class="btn-math-char" data-char="∑" title="Sigma (Total / Penjumlahan akumulatif)">∑</button>
                                    <button type="button" class="btn-math-char" data-char="∏" title="Pi Besar (Perkalian berurutan)">∏</button>
                                    <button type="button" class="btn-math-char" data-char="Δ" title="Delta (Perubahan / Selisih)">Δ</button>
                                    <button type="button" class="btn-math-char" data-char="x̄" title="x-bar (Rata-rata)">x̄</button>
                                    <button type="button" class="btn-math-char" data-char="μ" title="Mu (Mean / Rata-rata populasi)">μ</button>
                                    <button type="button" class="btn-math-char" data-char="σ" title="Sigma kecil (Standar Deviasi)">σ</button>
                                    <button type="button" class="btn-math-char" data-char="∞" title="Tak Hingga (Infinity)">∞</button>
                                    <button type="button" class="btn-math-char" data-char="∂" title="Turunan Parsial">∂</button>
                                    <button type="button" class="btn-math-char" data-char="∫" title="Integral">∫</button>
                                    <button type="button" class="btn-math-char" data-char="!" title="Faktorial">!</button>
                                </div>
                                <div class="math-char-group" style="margin-top: 6px;">
                                    <span class="math-group-label">Huruf Yunani Umum:</span>
                                    <button type="button" class="btn-math-char" data-char="α" title="Alpha">α</button>
                                    <button type="button" class="btn-math-char" data-char="β" title="Beta">β</button>
                                    <button type="button" class="btn-math-char" data-char="γ" title="Gamma">γ</button>
                                    <button type="button" class="btn-math-char" data-char="δ" title="Delta">δ</button>
                                    <button type="button" class="btn-math-char" data-char="ε" title="Epsilon">ε</button>
                                    <button type="button" class="btn-math-char" data-char="θ" title="Theta">θ</button>
                                    <button type="button" class="btn-math-char" data-char="λ" title="Lambda">λ</button>
                                    <button type="button" class="btn-math-char" data-char="π" title="Pi (3.14159...)">π</button>
                                    <button type="button" class="btn-math-char" data-char="ρ" title="Rho">ρ</button>
                                    <button type="button" class="btn-math-char" data-char="τ" title="Tau">τ</button>
                                    <button type="button" class="btn-math-char" data-char="φ" title="Phi">φ</button>
                                    <button type="button" class="btn-math-char" data-char="ω" title="Omega">ω</button>
                                </div>
                            </div>

                            <!-- Konten Tab 5: Kurung & Pengelompokan -->
                            <div class="math-tab-content" id="tab-kurung">
                                <div class="math-char-group">
                                    <span class="math-group-label">Tanda Kurung & Pembatas:</span>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="( )" data-wrap="(" data-wrapend=")" title="Kurung Biasa ( )">( )</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="[ ]" data-wrap="[" data-wrapend="]" title="Kurung Siku [ ]">[ ]</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="{ }" data-wrap="{" data-wrapend="}" title="Kurung Kurawal { }">{ }</button>
                                    <button type="button" class="btn-math-char btn-math-tag" data-char="| |" data-wrap="|" data-wrapend="|" title="Nilai Mutlak / Absolut | |">| x |</button>
                                </div>
                            </div>

                            <!-- Konten Tab 6: Template Rumus Cepat -->
                            <div class="math-tab-content" id="tab-template">
                                <div class="math-template-list">
                                    <button type="button" class="btn-math-tpl" data-tpl="(Realisasi / Target) × 100%" title="Persentase Capaian Target">
                                        <i class="fa fa-percent text-success"></i> <b>Capaian Target:</b> (Realisasi / Target) × 100%
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100%" title="Laju Pertumbuhan Tahunan Sederhana">
                                        <i class="fa fa-line-chart text-info"></i> <b>Laju Pertumbuhan Tahunan:</b> ((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100%
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="((Pₜ / P₀)^(1/t) - 1) × 100%" title="Laju Pertumbuhan Geometrik (Pangkat)">
                                        <i class="fa fa-superscript text-primary"></i> <b>Laju Pertumbuhan Geometrik:</b> ((Pₜ / P₀)^(1/t) - 1) × 100%
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="(Jumlah Kasus / Total Populasi) × 100%" title="Proporsi / Rasio Persentase">
                                        <i class="fa fa-pie-chart text-warning"></i> <b>Rasio / Proporsi:</b> (Kasus / Populasi) × 100%
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="∑(Wᵢ × Xᵢ) / ∑Wᵢ" title="Rata-rata Tertimbang (Weighted Mean)">
                                        <i class="fa fa-balance-scale text-danger"></i> <b>Rata-rata Tertimbang:</b> ∑(Wᵢ × Xᵢ) / ∑Wᵢ
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="(∑ Xᵢ) / n" title="Rata-rata Hitung Sederhana (Mean)">
                                        <i class="fa fa-calculator text-success"></i> <b>Rata-rata Hitung:</b> (∑ Xᵢ) / n
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="√[ ∑(Xᵢ - x̄)² / (n - 1) ]" title="Standar Deviasi">
                                        <i class="fa fa-area-chart text-info"></i> <b>Standar Deviasi:</b> √[ ∑(Xᵢ - x̄)² / (n - 1) ]
                                    </button>
                                    <button type="button" class="btn-math-tpl" data-tpl="(Indeks₁ + Indeks₂ + ... + Indeksₙ) / n" title="Indeks Komposit / Gabungan">
                                        <i class="fa fa-cubes text-primary"></i> <b>Indeks Komposit:</b> (Indeks₁ + ... + Indeksₙ) / n
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 15px; margin-bottom: 12px;">
                            <label for="RumusText" style="font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 4px;">
                                <span><b>Formula / Rumus Penghitungan RPJMD</b> <span class="text-danger">*</span></span>
                                <span style="font-size: 11px; font-weight: 400; color: #64748b;">
                                    <i class="fa fa-info-circle text-info"></i> Mendukung simbol matematika, caret <code>^2</code>, underscore <code>_t</code>, & tag HTML
                                </span>
                            </label>
                            <textarea class="form-control" id="RumusText" name="rumus" rows="3" required
                                      placeholder="Ketik rumus atau klik tombol simbol di atas...&#10;Contoh: ((Pₜ - Pₜ₋₁) / Pₜ₋₁) × 100% atau (1 + r)^n"
                                      style="border-radius: 8px; font-size: 13.5px; font-family: 'Consolas', 'Courier New', monospace; resize: vertical; padding: 10px 12px; border: 1.5px solid #cbd5e1; line-height: 1.5;"></textarea>
                        </div>

                        <!-- Live Preview Box -->
                        <div class="rumus-preview-container">
                            <div class="rumus-preview-header">
                                <span><i class="fa fa-eye text-primary"></i> <b>Pratinjau Tampilan Rumus:</b></span>
                                <span class="rumus-preview-badge">Tampilan di Tabel / Laporan</span>
                            </div>
                            <div class="rumus-preview-body" id="RumusLivePreview">
                                <span class="text-muted" style="font-style: italic; color: #94a3b8;">Belum ada rumus yang dimasukkan. Ketik rumus atau klik tombol simbol di atas.</span>
                            </div>
                        </div>

                        <!-- Input Definisi Operasional -->
                        <div class="form-group" style="margin-top: 15px; margin-bottom: 12px;">
                            <label for="DefinisiOperasionalText" style="font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                                <b>Definisi Operasional</b>
                            </label>
                            <textarea class="form-control" id="DefinisiOperasionalText" name="definisi_operasional" rows="3"
                                      placeholder="Masukkan penjelasan definisi operasional indikator (opsional)..."
                                      style="border-radius: 8px; font-size: 13px; resize: vertical; padding: 10px 12px; border: 1.5px solid #cbd5e1; line-height: 1.5;"></textarea>
                        </div>

                        <div class="modal-footer modal-iku-footer" style="margin-top: 16px;">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">Batal</button>
                            <button type="submit" class="btn btn-primary notika-btn-primary" id="BtnProsesSimpanRumus" style="border-radius: 6px;">
                                <i class="fa fa-save"></i> <b>Simpan Data</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- MODAL INTEGRASI API, IMPOR DATA EKSTERNAL & WEBHOOK REALTIME -->
    <!-- ========================================================================= -->
    <div class="modal fade" id="ModalIntegrasiApi" role="dialog">
        <div class="modal-dialog modal-lg" style="width: 92%; max-width: 1050px; margin: 30px auto;">
            <div class="modal-content modal-iku-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); overflow: hidden;">
                <div class="modal-header modal-iku-header" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); color: #fff; padding: 18px 24px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.8; font-size: 24px;">&times;</button>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span class="modal-title-icon" style="background: rgba(255, 255, 255, 0.2); width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 20px;">
                            <i class="fa fa-plug"></i>
                        </span>
                        <div>
                            <h4 class="modal-title" style="color: #fff; font-weight: 700; margin: 0; font-size: 18px;">
                                Integrasi API &amp; Webhook Realtime IKU
                            </h4>
                            <p style="margin: 2px 0 0 0; font-size: 12px; color: #cbd5e1;">
                                Impor data IKU dari API eksternal, kelola webhook perubahan realtime ke web lain, dan dokumentasi REST API IPPD.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="modal-body modal-iku-body" style="padding: 20px 24px; background: #f8fafc;">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs nav-tabs-api" role="tablist" style="border-bottom: 2px solid #e2e8f0; margin-bottom: 20px; display: flex; gap: 6px; flex-wrap: wrap;">
                        <li role="presentation" class="active">
                            <a href="#tab-impor-api" aria-controls="tab-impor-api" role="tab" data-toggle="tab" style="font-weight: 700; border-radius: 8px 8px 0 0; padding: 10px 16px;">
                                <i class="fa fa-cloud-download text-primary"></i> <b>1. Impor dari API Eksternal</b>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab-webhook-api" aria-controls="tab-webhook-api" role="tab" data-toggle="tab" style="font-weight: 700; border-radius: 8px 8px 0 0; padding: 10px 16px;">
                                <i class="fa fa-bolt text-warning"></i> <b>2. Webhook Realtime (Kirim ke Web Lain)</b>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab-endpoint-api" aria-controls="tab-endpoint-api" role="tab" data-toggle="tab" style="font-weight: 700; border-radius: 8px 8px 0 0; padding: 10px 16px;">
                                <i class="fa fa-code text-info"></i> <b>3. REST API IPPD (Diambil Web Lain)</b>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#tab-logs-api" aria-controls="tab-logs-api" role="tab" data-toggle="tab" style="font-weight: 700; border-radius: 8px 8px 0 0; padding: 10px 16px;">
                                <i class="fa fa-history text-success"></i> <b>4. Log Realtime &amp; Perubahan</b>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; min-height: 420px;">
                        
                        <!-- TAB 1: IMPOR DARI API EKSTERNAL -->
                        <div role="tabpanel" class="tab-pane active" id="tab-impor-api">
                            <div class="alert alert-info" style="border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; background: #eff6ff; border-left: 4px solid #3b82f6; color: #1e40af;">
                                <i class="fa fa-info-circle"></i> <strong>Tarik Data IKU Otomatis:</strong> Masukkan URL Endpoint REST API dari sistem / website lain (misal: SIPD, Sistem Bappeda, atau Aplikasi Perencanaan lain). Sistem akan menarik JSON data, menganalisis struktur indikator, dan memberikan pratinjau sebelum disimpan ke IKU IPPD.
                            </div>

                            <form id="FormTarikApi">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;">
                                                URL Endpoint API Eksternal <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group" style="width: 100%;">
                                                <input type="url" class="form-control" id="ImportApiUrl" placeholder="https://contoh-domain-lain.go.id/api/iku" required style="border-radius: 6px; height: 38px; font-family: monospace;">
                                            </div>
                                            <small class="text-muted">Mendukung respons JSON berupa array objek indikator, atau dibungkus dalam properti <code>data</code> / <code>items</code> / <code>results</code>.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;">Metode HTTP</label>
                                            <select class="form-control" id="ImportApiMethod" style="border-radius: 6px; height: 38px;">
                                                <option value="GET" selected>GET (Standar)</option>
                                                <option value="POST">POST</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;">Tipe Autentikasi API</label>
                                            <select class="form-control" id="ImportApiAuthType" style="border-radius: 6px; height: 38px;">
                                                <option value="none" selected>Tanpa Autentikasi (Publik)</option>
                                                <option value="bearer">Bearer Token (JWT / Auth Token)</option>
                                                <option value="api_key">Header X-API-KEY</option>
                                                <option value="basic">Basic Auth (user:pass)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;" id="LabelImportApiToken">Token / API Key (Opsional)</label>
                                            <input type="text" class="form-control" id="ImportApiToken" placeholder="Masukkan token jika API eksternal membutuhkan autentikasi..." style="border-radius: 6px; height: 38px; font-family: monospace;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;">Periode Target RPJMD</label>
                                            <select class="form-control" id="ImportApiPeriode" style="border-radius: 6px; height: 38px;">
                                                <option value="" selected>-- Otomatis Dari Data API atau VMTS --</option>
                                                <?php if (!empty($Periods)) { ?>
                                                    <?php foreach ($Periods as $p) { ?>
                                                        <option value="<?= html_escape($p['TahunMulai'] . '-' . $p['TahunAkhir']) ?>">
                                                            Periode <?= html_escape($p['TahunMulai'] . ' - ' . $p['TahunAkhir']) ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-weight: 700; font-size: 13px; color: #1e293b;">Mode Penanganan Data (Impor)</label>
                                            <select class="form-control" id="ImportApiMode" style="border-radius: 6px; height: 38px;">
                                                <option value="upsert" selected>Perbarui &amp; Tambah (Upsert - Rekomendasi)</option>
                                                <option value="append">Tambahkan Semua sebagai Data Baru (Append)</option>
                                                <option value="replace">Timpa / Gantikan Seluruh IKU Wilayah Ini (Replace Total)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 10px; margin-top: 5px;">
                                    <button type="submit" class="btn btn-primary" id="BtnTarikApi" style="font-weight: 700; border-radius: 6px; padding: 8px 20px; background: #2563eb;">
                                        <i class="fa fa-search"></i> Tarik &amp; Pratinjau Data API
                                    </button>
                                    <button type="button" class="btn btn-default" id="BtnResetTarikApi" style="border-radius: 6px;">
                                        Reset Form
                                    </button>
                                </div>
                            </form>

                            <!-- Pratinjau Hasil Penarikan Data API -->
                            <div id="ContainerPreviewApi" style="display: none; margin-top: 25px; border-top: 2px dashed #cbd5e1; padding-top: 20px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                                    <div>
                                        <h5 style="margin: 0; font-weight: 700; color: #0f172a;">
                                            <i class="fa fa-table text-primary"></i> Pratinjau Data yang Siap Diimpor
                                        </h5>
                                        <span class="badge badge-success" id="BadgeTotalFound" style="background: #10b981; font-size: 12px; padding: 4px 10px; margin-top: 4px;">0 Indikator Ditemukan</span>
                                    </div>
                                    <button type="button" class="btn btn-success" id="BtnEksekusiImpor" style="font-weight: 700; border-radius: 6px; padding: 8px 22px; background: #059669; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);">
                                        <i class="fa fa-download"></i> Konfirmasi &amp; Eksekusi Impor ke IKU
                                    </button>
                                </div>

                                <div class="table-responsive" style="max-height: 380px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <table class="table table-bordered table-striped" style="margin-bottom: 0; font-size: 12.5px;">
                                        <thead style="background: #f1f5f9; position: sticky; top: 0; z-index: 2;">
                                            <tr>
                                                <th class="text-center" style="width: 4%;">No</th>
                                                <th style="width: 25%;">Indikator Kinerja Utama</th>
                                                <th style="width: 20%;">Rumus Penghitungan</th>
                                                <th style="width: 20%;">Definisi Operasional</th>
                                                <th class="text-center" style="width: 6%;">T1</th>
                                                <th class="text-center" style="width: 6%;">T2</th>
                                                <th class="text-center" style="width: 6%;">T3</th>
                                                <th class="text-center" style="width: 6%;">T4</th>
                                                <th class="text-center" style="width: 6%;">T5</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TbodyPreviewApi">
                                            <!-- Rendered dynamically via JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: WEBHOOK REALTIME (KIRIM KE WEB LAIN) -->
                        <div role="tabpanel" class="tab-pane" id="tab-webhook-api">
                            <div class="alert alert-warning" style="border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; background: #fffbeb; border-left: 4px solid #f59e0b; color: #92400e;">
                                <i class="fa fa-bolt"></i> <strong>Koneksi Otomatis Realtime:</strong> Daftarkan URL webhook dari sistem atau website lain. Setiap kali data IKU ditambah, diubah rumus/targetnya, dihapus, disinkronisasi, atau diimpor, IPPD akan langsung mengirimkan payload HTTP POST secara realtime dengan payload JSON lengkap ke URL terdaftar.
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <h5 style="margin: 0; font-weight: 700; color: #0f172a;">
                                    <i class="fa fa-globe text-primary"></i> Daftar Webhook Terhubung
                                </h5>
                                <button type="button" class="btn btn-sm btn-primary" id="BtnBukaFormWebhook" style="border-radius: 6px; font-weight: 600;">
                                    <i class="fa fa-plus"></i> Tambah Webhook Baru
                                </button>
                            </div>

                            <!-- Form Tambah Webhook (Collapsible) -->
                            <div id="FormWebhookContainer" style="display: none; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                                <h6 style="margin-top: 0; font-weight: 700; color: #1e293b;">
                                    <i class="fa fa-plus-circle text-primary"></i> Daftarkan Webhook Baru
                                </h6>
                                <form id="FormSimpanWebhook">
                                    <input type="hidden" id="WebhookId" value="">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-12">
                                            <div class="form-group">
                                                <label style="font-weight: 700; font-size: 12px; color: #334155;">Nama Sistem / Web Tujuan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="WebhookName" placeholder="Contoh: Portal Data Bappeda / SIPD" required style="border-radius: 6px; height: 36px;">
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <label style="font-weight: 700; font-size: 12px; color: #334155;">URL Target Webhook (HTTP POST) <span class="text-danger">*</span></label>
                                                <input type="url" class="form-control" id="WebhookTargetUrl" placeholder="https://website-lain.go.id/api/receive-iku-webhook" required style="border-radius: 6px; height: 36px; font-family: monospace;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label style="font-weight: 700; font-size: 12px; color: #334155;">Secret Token (Opsional untuk HMAC SHA-256 Signature)</label>
                                                <input type="text" class="form-control" id="WebhookSecretToken" placeholder="Kunci rahasia untuk memvalidasi header X-IPPD-Signature" style="border-radius: 6px; height: 36px; font-family: monospace;">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label style="font-weight: 700; font-size: 12px; color: #334155;">Event yang Dipantau</label>
                                                <select class="form-control" id="WebhookEvents" style="border-radius: 6px; height: 36px;">
                                                    <option value="all" selected>Semua Event Perubahan</option>
                                                    <option value="iku.create,iku.update">Hanya Create &amp; Update</option>
                                                    <option value="iku.delete">Hanya Delete</option>
                                                    <option value="iku.sync,iku.import_api">Hanya Sync &amp; Import</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label style="font-weight: 700; font-size: 12px; color: #334155;">Status</label>
                                                <select class="form-control" id="WebhookIsActive" style="border-radius: 6px; height: 36px;">
                                                    <option value="1" selected>Aktif (Live Kirim)</option>
                                                    <option value="0">Non-Aktif (Jeda)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 8px;">
                                        <button type="submit" class="btn btn-sm btn-primary" id="BtnSubmitWebhook" style="font-weight: 700; border-radius: 4px;">
                                            <i class="fa fa-save"></i> Simpan Webhook
                                        </button>
                                        <button type="button" class="btn btn-sm btn-info" id="BtnTestPingWebhook" style="font-weight: 600; border-radius: 4px;">
                                            <i class="fa fa-paper-plane"></i> Kirim Tes Ping
                                        </button>
                                        <button type="button" class="btn btn-sm btn-default" id="BtnTutupFormWebhook" style="border-radius: 4px;">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Tabel Daftar Webhook -->
                            <div class="table-responsive" style="border: 1px solid #e2e8f0; border-radius: 6px;">
                                <table class="table table-bordered table-hover" style="margin-bottom: 0; font-size: 13px;">
                                    <thead style="background: #f1f5f9;">
                                        <tr>
                                            <th style="width: 22%;">Nama Sistem</th>
                                            <th style="width: 35%;">URL Target Webhook</th>
                                            <th class="text-center" style="width: 12%;">Status Terakhir</th>
                                            <th style="width: 16%;">Terakhir Dipicu</th>
                                            <th class="text-center" style="width: 15%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="TbodyListWebhook">
                                        <!-- Rendered dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 3: REST API IPPD (DIAMBIL OLEH WEB LAIN) -->
                        <div role="tabpanel" class="tab-pane" id="tab-endpoint-api">
                            <div class="alert alert-success" style="border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; background: #f0fdf4; border-left: 4px solid #10b981; color: #166534;">
                                <i class="fa fa-check-circle"></i> <strong>Endpoint REST API Terbuka:</strong> Website atau aplikasi eksternal dapat mengambil, mengimpor, atau streaming data IKU wilayah ini menggunakan endpoint di bawah ini. Mendukung format JSON standar dan SSE (Server-Sent Events) untuk streaming realtime.
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Endpoint GET Data IKU -->
                                    <div class="api-endpoint-box" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px 16px; margin-bottom: 14px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; flex-wrap: wrap; gap: 8px;">
                                            <div>
                                                <span class="badge" style="background: #2563eb; color: #fff; font-weight: 700; padding: 4px 8px; border-radius: 4px; font-size: 11px;">GET</span>
                                                <strong style="margin-left: 6px; color: #0f172a; font-size: 13.5px;">Endpoint Data IKU (JSON)</strong>
                                            </div>
                                            <button type="button" class="btn btn-xs btn-default BtnCopyText" data-target="#EndpointUrlIku" style="font-weight: 600; border-radius: 4px;">
                                                <i class="fa fa-copy"></i> Salin URL
                                            </button>
                                        </div>
                                        <input type="text" readonly id="EndpointUrlIku" class="form-control" style="font-family: monospace; font-size: 12.5px; background: #fff; border-color: #cbd5e1;" value="">
                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                            Parameter query opsional: <code>tahun_mulai</code>, <code>tahun_akhir</code>, <code>q</code> (pencarian), <code>since</code> (tanggal perubahan), <code>limit</code>, <code>offset</code>.
                                        </small>
                                    </div>

                                    <!-- Endpoint SSE Realtime Stream -->
                                    <div class="api-endpoint-box" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px 16px; margin-bottom: 14px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; flex-wrap: wrap; gap: 8px;">
                                            <div>
                                                <span class="badge" style="background: #059669; color: #fff; font-weight: 700; padding: 4px 8px; border-radius: 4px; font-size: 11px;">SSE STREAM</span>
                                                <strong style="margin-left: 6px; color: #0f172a; font-size: 13.5px;">Endpoint Realtime Stream (Server-Sent Events)</strong>
                                            </div>
                                            <button type="button" class="btn btn-xs btn-default BtnCopyText" data-target="#EndpointUrlStream" style="font-weight: 600; border-radius: 4px;">
                                                <i class="fa fa-copy"></i> Salin URL
                                            </button>
                                        </div>
                                        <input type="text" readonly id="EndpointUrlStream" class="form-control" style="font-family: monospace; font-size: 12.5px; background: #fff; border-color: #cbd5e1;" value="">
                                        <small class="text-muted" style="display: block; margin-top: 4px;">
                                            Gunakan <code>new EventSource(url)</code> di Javascript browser / server untuk menerima event <code>iku_change</code> seketika tanpa polling!
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Kelola Kunci Akses (API Key) -->
                            <div style="margin-top: 15px; border-top: 1px solid #e2e8f0; padding-top: 18px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                                    <h5 style="margin: 0; font-weight: 700; color: #0f172a;">
                                        <i class="fa fa-key text-warning"></i> Kelola API Key
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="BtnBukaFormApiKey" style="border-radius: 6px; font-weight: 600;">
                                        <i class="fa fa-plus"></i> Buat Kunci Akses Baru
                                    </button>
                                </div>

                                <!-- Form Buat API Key Baru -->
                                <div id="FormApiKeyContainer" style="display: none; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px; margin-bottom: 15px;">
                                    <form id="FormSimpanApiKey" style="display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;">
                                        <div style="flex: 2; min-width: 200px;">
                                            <label style="font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 4px;">Nama Aplikasi / Deskripsi Kunci</label>
                                            <input type="text" class="form-control" id="ApiKeyNameInput" placeholder="Contoh: Web SIPD Bappeda" required style="border-radius: 6px; height: 36px;">
                                        </div>
                                        <div style="flex: 1; min-width: 140px;">
                                            <label style="font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 4px;">Hak Akses</label>
                                            <select class="form-control" id="ApiKeyPermsInput" style="border-radius: 6px; height: 36px;">
                                                <option value="read,write" selected>Baca &amp; Tulis (Read/Write)</option>
                                                <option value="read">Hanya Baca (Read-Only)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary" style="border-radius: 6px; height: 36px; font-weight: 700;">
                                                <i class="fa fa-check"></i> Buat Kunci
                                            </button>
                                            <button type="button" class="btn btn-default" id="BtnTutupFormApiKey" style="border-radius: 6px; height: 36px;">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive" style="border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <table class="table table-bordered table-striped" style="margin-bottom: 0; font-size: 13px;">
                                        <thead style="background: #f1f5f9;">
                                            <tr>
                                                <th style="width: 25%;">Nama Kunci / Sistem</th>
                                                <th style="width: 35%;">API Key (Token)</th>
                                                <th class="text-center" style="width: 15%;">Hak Akses</th>
                                                <th style="width: 15%;">Terakhir Digunakan</th>
                                                <th class="text-center" style="width: 10%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TbodyListApiKeys">
                                            <!-- Rendered dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Contoh Kode Integrasi -->
                            <div style="margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                                <h6 style="margin-top: 0; font-weight: 700; color: #334155;">
                                    <i class="fa fa-laptop-code text-info"></i> Contoh Kode Integrasi Web Lain
                                </h6>
                                <div style="background: #0f172a; color: #f8fafc; border-radius: 8px; padding: 14px; font-family: monospace; font-size: 12px; overflow-x: auto;" id="CodeSnippetExample">
// JavaScript / Fetch Contoh:
const res = await fetch("<?= base_url('api/iku?kode_wilayah=') ?>" + kodeWilayah, {
  headers: { "X-API-KEY": "MASUKKAN_API_KEY" }
});
const json = await res.json();
console.log("Data IKU:", json.data);

// Realtime Server-Sent Events (SSE) Listener:
const stream = new EventSource("<?= base_url('api/iku/stream?kode_wilayah=') ?>" + kodeWilayah);
stream.addEventListener("iku_change", (e) => {
  const update = JSON.parse(e.data);
  console.log("Realtime Update IKU:", update);
  alert("Data IKU telah diperbarui oleh web lain: " + update.indikator);
});
                                </div>
                            </div>
                        </div>

                        <!-- TAB 4: LOG REALTIME & AKTIVITAS -->
                        <div role="tabpanel" class="tab-pane" id="tab-logs-api">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 8px;">
                                <div>
                                    <h5 style="margin: 0; font-weight: 700; color: #0f172a;">
                                        <i class="fa fa-history text-success"></i> Riwayat Perubahan Data &amp; Webhook
                                    </h5>
                                    <small class="text-muted">Mencatat setiap kali data IKU ditambah, diubah rumus/targetnya, disinkronkan, atau diimpor.</small>
                                </div>
                                <button type="button" class="btn btn-sm btn-default" id="BtnRefreshLogs" style="border-radius: 6px; font-weight: 600;">
                                    <i class="fa fa-refresh"></i> Segarkan Log
                                </button>
                            </div>

                            <div class="table-responsive" style="max-height: 420px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 6px;">
                                <table class="table table-bordered table-striped" style="margin-bottom: 0; font-size: 12.5px;">
                                    <thead style="background: #f1f5f9; position: sticky; top: 0; z-index: 2;">
                                        <tr>
                                            <th style="width: 16%;">Waktu</th>
                                            <th class="text-center" style="width: 14%;">Event</th>
                                            <th style="width: 38%;">Indikator / Deskripsi</th>
                                            <th class="text-center" style="width: 16%;">Sumber</th>
                                            <th class="text-center" style="width: 16%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="TbodyListLogs">
                                        <!-- Rendered dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer modal-iku-footer" style="padding: 14px 24px; background: #f1f5f9; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; font-weight: 600; padding: 8px 20px;">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Payload Log -->
    <div class="modal fade" id="ModalDetailLog" role="dialog" style="z-index: 106000 !important;">
        <div class="modal-dialog" style="max-width: 600px; margin: 60px auto;">
            <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background: #1e293b; color: #fff; padding: 14px 20px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
                    <h5 class="modal-title" style="color: #fff; font-weight: 700; margin: 0;">
                        <i class="fa fa-code"></i> Detail Payload Aktivitas
                    </h5>
                </div>
                <div class="modal-body" style="padding: 16px; background: #0f172a;">
                    <pre id="PreDetailLogPayload" style="background: transparent; border: none; color: #38bdf8; font-size: 12px; margin: 0; max-height: 400px; overflow-y: auto;"></pre>
                </div>
                <div class="modal-footer" style="padding: 10px 16px;">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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

        /* Card Modern Curve untuk Tabel dan Data IKU */
        .data-table-list {
            border-radius: 14px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid #f1f5f9;
            overflow: hidden;
            background: #ffffff;
            padding: 24px !important;
        }

        /* Posisi Teks Header Tabel Berada Presisi di Tengah (Vertikal) */
        table.dataTable thead th,
        table.dataTable thead td,
        #data-table-basic thead th,
        .table thead th {
            vertical-align: middle !important;
            text-align: center;
            line-height: 1.4 !important;
            padding: 12px 8px !important;
            background-image: none !important;
            cursor: default !important;
        }

        /* Hilangkan Icon Panah Pseudo Bawaan Notika pada Pagination */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:before,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:before {
            display: none !important;
            content: "" !important;
        }

        /* Styling Bersih & Rapi untuk Tombol Penomoran Halaman */
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 25px !important;
            padding-top: 8px !important;
            float: right;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            min-width: 28px !important;
            height: 28px !important;
            line-height: 26px !important;
            padding: 0 6px !important;
            text-align: center !important;
            font-size: 12px !important;
            border-radius: 6px !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            border: 1px solid #e2e8f0 !important;
            margin: 0 2px !important;
            display: inline-block !important;
            vertical-align: middle !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
            box-sizing: border-box !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #00c292 !important;
            border-color: #00c292 !important;
            color: #ffffff !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:focus {
            background: #00c292 !important;
            border-color: #00c292 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            opacity: 0.4 !important;
            cursor: not-allowed !important;
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            color: #94a3b8 !important;
        }
        .dataTables_wrapper .dataTables_info {
            font-size: 12px !important;
            margin-top: 25px !important;
            padding-top: 12px !important;
            float: left;
            color: #64748b;
        }

        /* Hilangkan Icon Search Bawaan Notika di Sebelah Kanan */
        .dataTables_filter label:after,
        .dataTables_filter label::after,
        .dataTables_wrapper .dataTables_filter label:after,
        .dataTables_wrapper .dataTables_filter label::after {
            display: none !important;
            content: none !important;
        }

        /* Styling Bersih Kolom Pencarian (Search) */
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            margin-bottom: 15px;
            width: auto !important;
        }
        .dataTables_wrapper .dataTables_filter label {
            font-weight: normal;
            margin-bottom: 0;
            position: relative;
            display: inline-block;
            width: auto !important;
            font-size: 13px !important;
        }
        .dataTables_wrapper .dataTables_filter input {
            height: 38px;
            padding: 6px 16px !important;
            font-size: 13px;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            outline: none;
            background-color: #ffffff !important;
            background-image: none !important;
            transition: all 0.25s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            min-width: 220px;
            margin-left: 0 !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            min-width: 260px;
            border-color: #00c292;
            box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
            background-color: #ffffff !important;
            background-image: none !important;
        }

        /* Styling Dropdown Tampilkan Entri (Length Menu) */
        .dataTables_wrapper .dataTables_length {
            float: left;
            margin-bottom: 15px;
        }
        .dataTables_wrapper .dataTables_length label {
            font-weight: 500;
            font-size: 13px;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 0;
        }
        .dataTables_wrapper .dataTables_length select {
            height: 38px;
            padding: 4px 12px;
            font-size: 13px;
            color: #1e293b;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background-color: #ffffff;
            outline: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            margin: 0 4px;
        }
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #00c292;
            box-shadow: 0 0 0 3px rgba(0, 194, 146, 0.18);
        }

        /* Modal IKU Styling */
        .modal-iku-dialog {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) !important;
            width: 90%;
            max-width: 580px;
            margin: 0;
        }
        .modal-iku-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .modal-iku-header {
            background: #ffffff;
            color: #1e293b;
            padding: 18px 24px;
            position: relative;
            width: 100%;
            border-bottom: 1px solid #eef2f6;
        }
        .modal-iku-header::before,
        .modal-iku-header::after {
            display: none !important;
        }
        .modal-iku-header .modal-title {
            color: #1e293b;
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            float: left !important;
            text-align: left;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            line-height: 32px;
        }
        .modal-iku-header .modal-title-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(0, 194, 146, 0.12);
            color: #00c292;
            font-size: 15px;
        }
        .modal-iku-header .close {
            color: #64748b !important;
            opacity: 0.7 !important;
            font-size: 26px !important;
            font-weight: 300 !important;
            text-shadow: none !important;
            float: right !important;
            margin-top: 1px !important;
            margin-right: 0 !important;
            line-height: 28px !important;
            outline: none !important;
            cursor: pointer;
            transition: all 0.2s;
        }
        .modal-iku-header .close:hover {
            color: #0f172a !important;
            opacity: 1 !important;
        }
        .modal-iku-body {
            padding: 22px 24px;
            background-color: #ffffff;
        }
        .modal-iku-footer {
            padding: 15px 0 0 0;
            border-top: 1px solid #eef2f6;
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Card preview nama indikator dalam modal */
        .detail-indikator-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #00c292;
            border-radius: 6px;
            padding: 12px 14px;
        }
        .detail-indikator-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
        }
        .detail-indikator-val {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 3px;
            line-height: 1.35;
        }

        /* Badge & styling tampilan rumus pada tabel */
        .rumus-tag-wrapper {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 3px solid #03a9f3;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            color: #334155;
            line-height: 1.4;
            display: inline-flex;
            align-items: flex-start;
            gap: 7px;
            max-width: 100%;
            word-break: break-word;
        }
        .rumus-badge-icon {
            color: #03a9f3;
            font-size: 12px;
            margin-top: 2px;
            flex-shrink: 0;
        }
        .btn-add-rumus {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px dashed #86efac;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-add-rumus:hover {
            background: #dcfce7;
            color: #15803d;
            border-color: #4ade80;
        }
        .btn-action-iku {
            width: 26px !important;
            height: 26px !important;
            padding: 0 !important;
            font-size: 11px !important;
            line-height: 26px !important;
            border-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 1px !important;
            transition: all 0.2s ease;
        }
        .btn-action-iku:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        /* Modal Dialog Rumus (Wider for Math Keyboard & Preview) */
        .modal-rumus-dialog {
            max-width: 760px !important;
            width: 95% !important;
            margin: 30px auto !important;
        }

        /* Math Toolbar Box */
        .math-toolbar-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 12px;
            margin-top: 14px;
        }
        .math-toolbar-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        .math-toolbar-title {
            font-size: 12px;
            font-weight: 700;
            color: #334155;
        }
        .math-tab-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        .math-tab-btn {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            border-radius: 14px;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none !important;
        }
        .math-tab-btn:hover {
            border-color: #00c292;
            color: #00c292;
        }
        .math-tab-btn.active {
            background: #00c292;
            color: #ffffff;
            border-color: #00c292;
            box-shadow: 0 2px 4px rgba(0, 194, 146, 0.25);
        }
        .math-tab-btn.active:hover {
            color: #ffffff;
        }
        .math-tab-content {
            display: none;
        }
        .math-tab-content.active {
            display: block;
        }
        .math-char-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 4px;
        }
        .math-group-label {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            margin-right: 4px;
            display: inline-block;
        }
        .btn-math-char {
            min-width: 32px;
            height: 32px;
            padding: 2px 7px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            outline: none !important;
        }
        .btn-math-char:hover {
            background: #00c292;
            color: #ffffff;
            border-color: #00c292;
            transform: translateY(-1px);
            box-shadow: 0 3px 6px rgba(0, 194, 146, 0.2);
        }
        .btn-math-tag {
            font-size: 11.5px;
            font-family: 'Consolas', 'Courier New', monospace;
            font-weight: 600;
            padding: 2px 8px;
            min-width: unset;
        }
        .rumus-content {
            font-family: 'Consolas', 'Courier New', monospace;
            font-weight: 600;
            font-size: 12.5px;
            color: #1e293b;
            letter-spacing: 0.2px;
        }

        /* Definisi Operasional Styling pada Tabel */
        .definisi-display-box {
            min-height: 20px;
        }
        .definisi-text-wrapper {
            font-size: 12px;
            color: #334155;
            line-height: 1.45;
            word-break: break-word;
        }
        .math-template-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 6px;
            max-height: 165px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .btn-math-tpl {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 11.5px;
            text-align: left;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s ease;
            width: 100%;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            outline: none !important;
        }
        .btn-math-tpl:hover {
            background: #f0fdf4;
            border-color: #86efac;
            color: #166534;
            box-shadow: 0 2px 4px rgba(0,0,0,0.06);
            transform: translateY(-1px);
        }

        /* Live Preview Styling */
        .rumus-preview-container {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 14px;
        }
        .rumus-preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
            font-size: 12px;
            color: #475569;
        }
        .rumus-preview-badge {
            font-size: 10px;
            background: #e2e8f0;
            color: #475569;
            padding: 2px 7px;
            border-radius: 4px;
            font-weight: 600;
        }
        .rumus-preview-body {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 12px;
            min-height: 42px;
            font-size: 14px;
            color: #0f172a;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            line-height: 1.5;
            word-break: break-word;
        }

        /* Superscript & Subscript Clean Typography */
        sup {
            font-size: 75% !important;
            vertical-align: super !important;
            line-height: 0 !important;
        }
        sub {
            font-size: 75% !important;
            vertical-align: sub !important;
            line-height: 0 !important;
        }

        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            .filter-select {
                width: 100%;
            }
            .math-template-list {
                grid-template-columns: 1fr;
            }
            .modal-rumus-dialog {
                width: 98% !important;
                margin: 15px auto !important;
            }
        }

        /* Realtime Pulsing Dot Animation */
        .realtime-pulse-dot {
            width: 9px;
            height: 9px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: pulseGreen 1.8s infinite;
        }
        @keyframes pulseGreen {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 7px rgba(16, 185, 129, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Nav Tabs Styling Inside API Modal */
        .nav-tabs-api > li > a {
            color: #475569 !important;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1 !important;
            border-bottom: none !important;
            margin-right: 4px;
            transition: all 0.2s ease;
        }
        .nav-tabs-api > li.active > a,
        .nav-tabs-api > li.active > a:hover,
        .nav-tabs-api > li.active > a:focus {
            color: #1e1b4b !important;
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-bottom: 2px solid #ffffff !important;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.03);
        }
        .nav-tabs-api > li > a:hover {
            background-color: #e2e8f0;
        }
    </style>

    <!-- Scripts -->
    <script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('js/wow.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
    <script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
    <script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
    <script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('js/main.js'); ?>"></script>

    <script>
        var BaseURL = '<?= base_url() ?>';
        var CSRF_TOKEN = '<?= $this->security->get_csrf_hash() ?>';
        var CSRF_NAME = '<?= $this->security->get_csrf_token_name() ?>';

        $(document).ready(function() {
            // Inisialisasi DataTables IKU
            $('#data-table-basic').DataTable({
                "ordering": false,
                "pageLength": 5,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari indikator kinerja utama...",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "paginate": {
                        "first": '<i class="fa fa-angle-double-left"></i>',
                        "last": '<i class="fa fa-angle-double-right"></i>',
                        "next": '<i class="fa fa-angle-right"></i>',
                        "previous": '<i class="fa fa-angle-left"></i>'
                    }
                }
            });

            // Logika filter untuk pengguna yang belum login
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
                            try {
                                var Data = JSON.parse(Respon);
                                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                                if (Data.length > 0) {
                                    for (let i = 0; i < Data.length; i++) {
                                        KabKota += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                                    }
                                } else {
                                    alert("Belum Ada Data Kab/Kota");
                                }
                                $("#KabKota").html(KabKota).prop('disabled', false);
                            } catch (e) {
                                alert("Gagal memuat data Kab/Kota");
                                $("#KabKota").prop('disabled', false);
                            }
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
                            var r = typeof Respon === 'string' ? Respon.trim() : Respon;
                            if (r === '1' || r === 'success' || r == 1) {
                                window.location.href = BaseURL + "Daerah/IKU";
                            } else {
                                alert("Gagal menyimpan filter wilayah!");
                                $("#Filter").prop('disabled', false).text('Filter');
                            }
                        },
                        error: function() {
                            alert("Gagal menghubungi server!");
                            $("#Filter").prop('disabled', false).text('Filter');
                        }
                    });
                });

                // Populate Kab/Kota dropdown on page load if KodeWilayah is set
                <?php if (!empty($KodeWilayah)) { ?>
                    var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
                    var kodeKab = "<?= $KodeWilayah ?>";
                    $("#Provinsi").val(kodeProv);
                    $.ajax({
                        url: BaseURL + "Daerah/GetListKabKota",
                        type: "POST",
                        data: { Kode: kodeProv, [CSRF_NAME]: CSRF_TOKEN },
                        success: function(Respon) {
                            try {
                                var Data = JSON.parse(Respon);
                                var KabKota = '<option value="">Pilih Kab/Kota</option>';
                                if (Data.length > 0) {
                                    for (let i = 0; i < Data.length; i++) {
                                        var selected = (Data[i].Kode === kodeKab) ? 'selected' : '';
                                        KabKota += '<option value="' + Data[i].Kode + '" ' + selected + '>' + Data[i].Nama + '</option>';
                                    }
                                }
                                $("#KabKota").html(KabKota);
                            } catch (e) {
                                alert("Gagal memuat data Kab/Kota");
                            }
                        },
                        error: function() {
                            alert("Gagal memuat data Kab/Kota");
                        }
                    });
                <?php } ?>
            <?php } ?>

            // Ketika salah satu dari 3 tombol sinkronisasi diklik
            $(".BtnBukaSinkron").click(function() {
                var tipe = $(this).data('tipe');
                var label = $(this).data('label');
                
                $("#SinkronTipe").val(tipe);
                $("#ModalSinkronTitle").html('<span class="modal-title-icon"><i class="fa fa-refresh"></i></span> ' + label + ' dari VMTS');
                
                var keterangan = "Sinkronisasi akan menarik data ";
                if (tipe === 'tujuan') {
                    keterangan += "<b>Indikator Tujuan</b>";
                } else if (tipe === 'sasaran') {
                    keterangan += "<b>Indikator Sasaran</b>";
                } else {
                    keterangan += "<b>Indikator Tujuan (di atas) dan Indikator Sasaran (di bawah)</b>";
                }
                keterangan += " untuk periode yang dipilih.";
                
                $("#SinkronKeterangan").html(keterangan);
                $("#SinkronPeriode").val('');
                $("#ModalSinkronIku").modal('show');
            });

            // Submit Form Sinkronisasi
            $("#FormSinkronIku").submit(function(e) {
                e.preventDefault();

                var tipe = $("#SinkronTipe").val();
                var periode = $("#SinkronPeriode").val();

                if (!periode) {
                    alert("Silakan pilih periode tahun terlebih dahulu!");
                    return false;
                }

                var btn = $("#BtnProsesSinkron");
                var originalHtml = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');

                $.ajax({
                    url: BaseURL + "Daerah/SinkronIku",
                    type: "POST",
                    data: {
                        tipe: tipe,
                        periode: periode,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(response) {
                        btn.prop('disabled', false).html(originalHtml);
                        if (response.status === 'success') {
                            $("#ModalSinkronIku").modal('hide');
                            alert(response.message);
                            location.reload();
                        } else if (response.status === 'warning') {
                            alert(response.message);
                        } else {
                            alert(response.message || "Gagal melakukan sinkronisasi data!");
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(originalHtml);
                        alert("Terjadi kesalahan saat menghubungi server: " + error);
                    }
                });
            });

            // Fungsi Render Format Rumus untuk Live Preview
            function renderRumusHtml(str) {
                if (!str || !str.trim()) {
                    return '<span class="text-muted" style="font-style: italic; color: #94a3b8;">Belum ada rumus yang dimasukkan. Ketik rumus atau klik tombol simbol di atas.</span>';
                }
                // Escape HTML
                var escaped = $('<div>').text(str).html();
                // Kembalikan tag <sup> dan <sub> yang diizinkan
                escaped = escaped.replace(/&lt;sup&gt;/gi, '<sup>')
                                 .replace(/&lt;\/sup&gt;/gi, '</sup>')
                                 .replace(/&lt;sub&gt;/gi, '<sub>')
                                 .replace(/&lt;\/sub&gt;/gi, '</sub>');

                // Regex Pangkat (Caret): ^{...}, ^(...), ^word/num
                escaped = escaped.replace(/\^\{([^\}]+)\}/g, '<sup>$1</sup>');
                escaped = escaped.replace(/\^\(([^\)]+)\)/g, '<sup>$1</sup>');
                escaped = escaped.replace(/\^([0-9a-zA-Z\+\-\*\/]+)/g, '<sup>$1</sup>');

                // Regex Indeks Bawah (Underscore): _{...}, _(...), _word/num
                escaped = escaped.replace(/\_\{([^\}]+)\}/g, '<sub>$1</sub>');
                escaped = escaped.replace(/\_\(([^\)]+)\)/g, '<sub>$1</sub>');
                escaped = escaped.replace(/\_([a-zA-Z0-9\+\-]+)/g, '<sub>$1</sub>');

                // Ganti baris baru (\n) menjadi <br>
                escaped = escaped.replace(/\n/g, '<br>');
                return escaped;
            }

            function updateRumusLivePreview() {
                var raw = $('#RumusText').val();
                $('#RumusLivePreview').html(renderRumusHtml(raw));
            }

            // Fungsi Sisipkan Teks / Simbol pada Posisi Kursor di Textarea Rumus
            function insertRumusText(textToInsert, wrapStart, wrapEnd) {
                var textarea = document.getElementById('RumusText');
                if (!textarea) return;

                var startPos = textarea.selectionStart;
                var endPos = textarea.selectionEnd;
                var currentVal = textarea.value;

                if (wrapStart !== undefined && wrapEnd !== undefined && startPos !== endPos) {
                    // Jika ada teks yang diblok/diseleksi, bungkus teks tersebut
                    var selectedText = currentVal.substring(startPos, endPos);
                    var replacement = wrapStart + selectedText + wrapEnd;
                    textarea.value = currentVal.substring(0, startPos) + replacement + currentVal.substring(endPos);
                    textarea.selectionStart = startPos + wrapStart.length;
                    textarea.selectionEnd = startPos + wrapStart.length + selectedText.length;
                } else if (typeof startPos === 'number' && typeof endPos === 'number') {
                    textarea.value = currentVal.substring(0, startPos) + textToInsert + currentVal.substring(endPos);
                    textarea.selectionStart = textarea.selectionEnd = startPos + textToInsert.length;
                } else {
                    textarea.value += textToInsert;
                }

                textarea.focus();
                updateRumusLivePreview();
            }

            // Tab Switching Bilah Simbol Matematika
            $(document).on('click', '.math-tab-btn', function(e) {
                e.preventDefault();
                $('.math-tab-btn').removeClass('active');
                $(this).addClass('active');

                var targetTab = $(this).data('tab');
                $('.math-tab-content').removeClass('active');
                $('#' + targetTab).addClass('active');
            });

            // Klik Tombol Karakter / Simbol Matematika
            $(document).on('click', '.btn-math-char', function(e) {
                e.preventDefault();
                var tag = $(this).data('tag');
                var char = $(this).data('char');
                var wrap = $(this).data('wrap');
                var wrapEnd = $(this).data('wrapend');

                if (tag === 'sup') {
                    insertRumusText('<sup></sup>', '<sup>', '</sup>');
                } else if (tag === 'sub') {
                    insertRumusText('<sub></sub>', '<sub>', '</sub>');
                } else if (wrap && wrapEnd) {
                    insertRumusText(char, wrap, wrapEnd);
                } else {
                    insertRumusText(char);
                }
            });

            // Klik Tombol Template Rumus Cepat
            $(document).on('click', '.btn-math-tpl', function(e) {
                e.preventDefault();
                var tpl = $(this).data('tpl');
                var current = $('#RumusText').val().trim();

                if (current && current !== tpl) {
                    if (confirm('Ganti teks rumus saat ini dengan template yang dipilih?')) {
                        $('#RumusText').val(tpl);
                    } else {
                        insertRumusText(' ' + tpl);
                    }
                } else {
                    $('#RumusText').val(tpl);
                }
                $('#RumusText').focus();
                updateRumusLivePreview();
            });

            // Update Live Preview saat pengguna mengetik di Textarea
            $('#RumusText').on('input propertychange change keyup', function() {
                updateRumusLivePreview();
            });

            // Ketika tombol Tambah/Edit Rumus RPJMD diklik
            $(document).on('click', '.BtnBukaInputRumus', function() {
                var id = $(this).data('id');
                var indikator = $(this).data('indikator');
                var rumus = $(this).data('rumus') || '';
                var definisi = $(this).data('definisi') || '';
                var periode = $(this).data('periode') || '-';

                $("#RumusIkuId").val(id);
                $("#RumusIndikatorNama").text(indikator);
                $("#RumusIndikatorPeriode").html('<i class="fa fa-calendar text-muted"></i> Periode RPJMD: <b>' + (periode ? periode : '-') + '</b>');
                $("#RumusText").val(rumus);
                $("#DefinisiOperasionalText").val(definisi);

                updateRumusLivePreview();
                $("#ModalInputRumus").modal('show');
            });

            // Submit Form Input / Edit Rumus RPJMD
            $("#FormInputRumus").submit(function(e) {
                e.preventDefault();

                var id = $("#RumusIkuId").val();
                var rumus = $("#RumusText").val().trim();
                var definisi = $("#DefinisiOperasionalText").val().trim();

                if (!id) {
                    alert("ID IKU tidak valid!");
                    return false;
                }

                var btn = $("#BtnProsesSimpanRumus");
                var origText = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.ajax({
                    url: BaseURL + "Daerah/SimpanRumusIku",
                    type: "POST",
                    data: {
                        id: id,
                        rumus: rumus,
                        definisi_operasional: definisi,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        btn.prop('disabled', false).html(origText);
                        if (res.status === 'success') {
                            $("#ModalInputRumus").modal('hide');
                            alert(res.message);
                            location.reload();
                        } else {
                            alert(res.message || "Gagal menyimpan Rumus RPJMD!");
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(origText);
                        alert("Terjadi kesalahan sistem saat menyimpan: " + error);
                    }
                });
            });

            // =========================================================================
            // JAVASCRIPT INTEGRASI API, IMPOR EKSTERNAL & REALTIME STREAM ENGINE
            // =========================================================================
            var currentKodeWilayah = '<?= html_escape($KodeWilayah) ?>';
            var importedApiItems = [];
            var latestObservedLogId = 0;
            var realtimeSseSource = null;

            // Buka Modal Integrasi & Impor API
            $("#BtnOpenIntegrasiApi, .BtnBukaIntegrasiApi").on('click', function(e) {
                e.preventDefault();
                $("#ModalIntegrasiApi").modal('show');
                loadApiIntegrasiData();
            });

            // Fungsi memuat data integrasi API, Keys, Webhooks, dan Logs
            function loadApiIntegrasiData() {
                $.ajax({
                    url: BaseURL + "Daerah/ApiIntegrasiInfo",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            // Update URLs
                            $("#EndpointUrlIku").val(res.api_url);
                            $("#EndpointUrlStream").val(res.stream_url);

                            // Render Webhooks
                            renderWebhooksTable(res.webhooks);

                            // Render API Keys
                            renderApiKeysTable(res.keys);

                            // Render Logs
                            renderLogsTable(res.logs);

                            // Update periods jika ada
                            if (res.periods && res.periods.length > 0) {
                                var optHtml = '<option value="">-- Otomatis Dari Data API atau VMTS --</option>';
                                $.each(res.periods, function(i, p) {
                                    optHtml += '<option value="' + p.TahunMulai + '-' + p.TahunAkhir + '">Periode ' + p.TahunMulai + ' - ' + p.TahunAkhir + '</option>';
                                });
                                $("#ImportApiPeriode").html(optHtml);
                            }
                        }
                    }
                });
            }

            // Render Webhooks
            function renderWebhooksTable(webhooks) {
                var tbody = $("#TbodyListWebhook");
                tbody.empty();
                if (!webhooks || webhooks.length === 0) {
                    tbody.html('<tr><td colspan="5" class="text-center text-muted" style="padding: 20px;"><em>Belum ada Webhook yang didaftarkan untuk wilayah ini.</em></td></tr>');
                    return;
                }

                $.each(webhooks, function(i, wh) {
                    var statusBadge = '<span class="badge" style="background: #94a3b8; font-size: 11px;">Belum Diuji</span>';
                    if (wh.last_status) {
                        if (wh.last_status >= 200 && wh.last_status < 300) {
                            statusBadge = '<span class="badge" style="background: #10b981; font-size: 11px;">HTTP ' + wh.last_status + ' OK</span>';
                        } else {
                            statusBadge = '<span class="badge" style="background: #ef4444; font-size: 11px;">HTTP ' + wh.last_status + '</span>';
                        }
                    }

                    var tr = $('<tr></tr>');
                    tr.append('<td><strong>' + $('<div>').text(wh.name).html() + '</strong></td>');
                    tr.append('<td><code style="word-break: break-all; font-size: 11.5px;">' + $('<div>').text(wh.target_url).html() + '</code></td>');
                    tr.append('<td class="text-center">' + statusBadge + '</td>');
                    tr.append('<td style="font-size: 11.5px;">' + (wh.last_triggered_at || '-') + '</td>');
                    tr.append('<td class="text-center">' +
                        '<button type="button" class="btn btn-xs btn-info BtnTestPingRow" data-url="' + $('<div>').text(wh.target_url).html() + '" data-secret="' + $('<div>').text(wh.secret_token || '').html() + '" style="margin-right: 4px;" title="Uji Koneksi Ping">' +
                            '<i class="fa fa-paper-plane"></i> Tes' +
                        '</button>' +
                        '<button type="button" class="btn btn-xs btn-danger BtnHapusWebhookRow" data-id="' + wh.id + '" title="Hapus Webhook">' +
                            '<i class="fa fa-trash"></i>' +
                        '</button>' +
                    '</td>');
                    tbody.append(tr);
                });
            }

            // Render API Keys
            function renderApiKeysTable(keys) {
                var tbody = $("#TbodyListApiKeys");
                tbody.empty();
                if (!keys || keys.length === 0) {
                    tbody.html('<tr><td colspan="5" class="text-center text-muted" style="padding: 20px;"><em>Belum ada API Key aktif. Buat kunci baru menggunakan tombol di atas.</em></td></tr>');
                    return;
                }

                $.each(keys, function(i, k) {
                    var tr = $('<tr></tr>');
                    tr.append('<td><strong>' + $('<div>').text(k.key_name).html() + '</strong></td>');
                    tr.append('<td>' +
                        '<div class="input-group input-group-sm" style="width: 100%;">' +
                            '<input type="text" readonly class="form-control" value="' + $('<div>').text(k.api_key).html() + '" style="font-family: monospace; font-size: 11.5px; background: #fff;">' +
                            '<span class="input-group-btn">' +
                                '<button class="btn btn-default BtnCopyDirect" data-text="' + $('<div>').text(k.api_key).html() + '" type="button" title="Salin Key"><i class="fa fa-copy"></i></button>' +
                            '</span>' +
                        '</div>' +
                    '</td>');
                    tr.append('<td class="text-center"><span class="badge" style="background: #3b82f6; font-size: 11px;">' + $('<div>').text(k.permissions).html() + '</span></td>');
                    tr.append('<td style="font-size: 11.5px;">' + (k.last_used_at || 'Belum pernah') + '</td>');
                    tr.append('<td class="text-center">' +
                        '<button type="button" class="btn btn-xs btn-danger BtnHapusApiKeyRow" data-id="' + k.id + '" title="Hapus API Key">' +
                            '<i class="fa fa-trash"></i>' +
                        '</button>' +
                    '</td>');
                    tbody.append(tr);
                });
            }

            // Render Activity Logs
            function renderLogsTable(logs) {
                var tbody = $("#TbodyListLogs");
                tbody.empty();
                if (!logs || logs.length === 0) {
                    tbody.html('<tr><td colspan="5" class="text-center text-muted" style="padding: 20px;"><em>Belum ada riwayat aktivitas untuk wilayah ini.</em></td></tr>');
                    return;
                }

                if (logs[0] && logs[0].id) {
                    latestObservedLogId = Math.max(latestObservedLogId, parseInt(logs[0].id));
                }

                $.each(logs, function(i, l) {
                    var evBadge = '<span class="badge" style="font-size: 11px; background: #64748b;">' + l.event_type + '</span>';
                    if (l.event_type === 'CREATE') evBadge = '<span class="badge" style="font-size: 11px; background: #10b981;">TAMBAH</span>';
                    if (l.event_type === 'UPDATE' || l.event_type === 'UPDATE_RUMUS') evBadge = '<span class="badge" style="font-size: 11px; background: #f59e0b;">UBAH</span>';
                    if (l.event_type === 'DELETE') evBadge = '<span class="badge" style="font-size: 11px; background: #ef4444;">HAPUS</span>';
                    if (l.event_type === 'SYNC') evBadge = '<span class="badge" style="font-size: 11px; background: #06b6d4;">SYNC VMTS</span>';
                    if (l.event_type === 'IMPORT_API') evBadge = '<span class="badge" style="font-size: 11px; background: #6366f1;">IMPOR API</span>';

                    var tr = $('<tr></tr>');
                    tr.append('<td style="font-size: 11.5px;">' + (l.created_at || '-') + '</td>');
                    tr.append('<td class="text-center">' + evBadge + '</td>');
                    tr.append('<td>' + $('<div>').text(l.indikator || '-').html() + '</td>');
                    tr.append('<td class="text-center"><span class="badge" style="background: #e2e8f0; color: #334155; font-size: 10.5px;">' + (l.source || 'WEB_UI') + '</span></td>');
                    tr.append('<td class="text-center">' +
                        '<button type="button" class="btn btn-xs btn-default BtnLihatPayloadLog" data-payload=\'' + JSON.stringify(l.details || {}) + '\'>' +
                            '<i class="fa fa-code"></i> Detail' +
                        '</button>' +
                    '</td>');
                    tbody.append(tr);
                });
            }

            // Klik Detail Payload Log
            $(document).on('click', '.BtnLihatPayloadLog', function() {
                var raw = $(this).attr('data-payload');
                try {
                    var parsed = JSON.parse(raw);
                    $("#PreDetailLogPayload").text(JSON.stringify(parsed, null, 2));
                } catch(e) {
                    $("#PreDetailLogPayload").text(raw || "(Kosong)");
                }
                $("#ModalDetailLog").modal('show');
            });

            // Segarkan Log
            $("#BtnRefreshLogs").on('click', function() {
                loadApiIntegrasiData();
            });

            // Copy to Clipboard
            $(document).on('click', '.BtnCopyText', function() {
                var target = $(this).attr('data-target');
                var val = $(target).val();
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(val);
                } else {
                    $(target).select();
                    document.execCommand("copy");
                }
                var btn = $(this);
                var orig = btn.html();
                btn.html('<i class="fa fa-check text-success"></i> Tersalin!');
                setTimeout(function() { btn.html(orig); }, 2000);
            });

            $(document).on('click', '.BtnCopyDirect', function() {
                var text = $(this).attr('data-text');
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text);
                }
                var btn = $(this);
                btn.html('<i class="fa fa-check text-success"></i>');
                setTimeout(function() { btn.html('<i class="fa fa-copy"></i>'); }, 2000);
            });

            // Toggle Form Webhook
            $("#BtnBukaFormWebhook").on('click', function() {
                $("#FormWebhookContainer").slideToggle(200);
            });
            $("#BtnTutupFormWebhook").on('click', function() {
                $("#FormWebhookContainer").slideUp(200);
            });

            // Simpan Webhook
            $("#FormSimpanWebhook").on('submit', function(e) {
                e.preventDefault();
                var btn = $("#BtnSubmitWebhook");
                var origText = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

                $.ajax({
                    url: BaseURL + "Daerah/SimpanWebhook",
                    type: "POST",
                    data: {
                        id: $("#WebhookId").val(),
                        name: $("#WebhookName").val().trim(),
                        target_url: $("#WebhookTargetUrl").val().trim(),
                        secret_token: $("#WebhookSecretToken").val().trim(),
                        events: $("#WebhookEvents").val(),
                        is_active: $("#WebhookIsActive").val(),
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        btn.prop('disabled', false).html(origText);
                        if (res.status === 'success') {
                            alert(res.message);
                            $("#FormSimpanWebhook")[0].reset();
                            $("#FormWebhookContainer").slideUp(200);
                            loadApiIntegrasiData();
                        } else {
                            alert(res.message || "Gagal menyimpan webhook!");
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(origText);
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            });

            // Tes Ping Webhook dari Form
            $("#BtnTestPingWebhook").on('click', function() {
                var url = $("#WebhookTargetUrl").val().trim();
                var secret = $("#WebhookSecretToken").val().trim();
                if (!url) {
                    alert("Masukkan URL Target Webhook terlebih dahulu!");
                    return;
                }
                eksekusiTesPing(url, secret, $(this));
            });

            // Tes Ping dari Baris Tabel
            $(document).on('click', '.BtnTestPingRow', function() {
                var url = $(this).attr('data-url');
                var secret = $(this).attr('data-secret');
                eksekusiTesPing(url, secret, $(this));
            });

            function eksekusiTesPing(url, secret, btn) {
                var origText = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Tes...');

                $.ajax({
                    url: BaseURL + "Daerah/TesWebhook",
                    type: "POST",
                    data: {
                        target_url: url,
                        secret_token: secret,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        btn.prop('disabled', false).html(origText);
                        alert(res.message + (res.latency_ms ? "\nWaktu respons: " + res.latency_ms + "ms" : ""));
                        loadApiIntegrasiData();
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(origText);
                        alert("Gagal menguji webhook: " + error);
                    }
                });
            }

            // Hapus Webhook
            $(document).on('click', '.BtnHapusWebhookRow', function() {
                if (!confirm("Apakah Anda yakin ingin menghapus Webhook ini?")) return;
                var id = $(this).attr('data-id');
                $.ajax({
                    url: BaseURL + "Daerah/HapusWebhook",
                    type: "POST",
                    data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
                    dataType: "json",
                    success: function(res) {
                        alert(res.message);
                        loadApiIntegrasiData();
                    }
                });
            });

            // Toggle Form API Key
            $("#BtnBukaFormApiKey").on('click', function() {
                $("#FormApiKeyContainer").slideToggle(200);
            });
            $("#BtnTutupFormApiKey").on('click', function() {
                $("#FormApiKeyContainer").slideUp(200);
            });

            // Buat API Key Baru
            $("#FormSimpanApiKey").on('submit', function(e) {
                e.preventDefault();
                var keyName = $("#ApiKeyNameInput").val().trim();
                var perms = $("#ApiKeyPermsInput").val();

                $.ajax({
                    url: BaseURL + "Daerah/BuatApiKey",
                    type: "POST",
                    data: {
                        key_name: keyName,
                        permissions: perms,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            alert(res.message + "\nKunci: " + res.api_key);
                            $("#ApiKeyNameInput").val('');
                            $("#FormApiKeyContainer").slideUp(200);
                            loadApiIntegrasiData();
                        } else {
                            alert(res.message || "Gagal membuat kunci!");
                        }
                    }
                });
            });

            // Hapus API Key
            $(document).on('click', '.BtnHapusApiKeyRow', function() {
                if (!confirm("Apakah Anda yakin ingin menghapus API Key ini? Akses eksternal dengan kunci ini akan terputus.")) return;
                var id = $(this).attr('data-id');
                $.ajax({
                    url: BaseURL + "Daerah/HapusApiKey",
                    type: "POST",
                    data: { id: id, [CSRF_NAME]: CSRF_TOKEN },
                    dataType: "json",
                    success: function(res) {
                        alert(res.message);
                        loadApiIntegrasiData();
                    }
                });
            });

            // =========================================================================
            // TAB 1: LOGIKA TARIK & IMPOR DARI API EKSTERNAL
            // =========================================================================
            $("#ImportApiAuthType").on('change', function() {
                var v = $(this).val();
                if (v === 'bearer') {
                    $("#LabelImportApiToken").text("Bearer Token (JWT / String Token)");
                    $("#ImportApiToken").attr("placeholder", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...").prop('disabled', false);
                } else if (v === 'api_key') {
                    $("#LabelImportApiToken").text("Kunci API (X-API-KEY)");
                    $("#ImportApiToken").attr("placeholder", "ippd_live_xxxxxxxx...").prop('disabled', false);
                } else if (v === 'basic') {
                    $("#LabelImportApiToken").text("Kredensial Basic Auth (format: username:password)");
                    $("#ImportApiToken").attr("placeholder", "admin:password123").prop('disabled', false);
                } else {
                    $("#LabelImportApiToken").text("Token / API Key (Tidak Diperlukan)");
                    $("#ImportApiToken").attr("placeholder", "").prop('disabled', true).val('');
                }
            });

            // Submit Form Tarik Data API
            $("#FormTarikApi").on('submit', function(e) {
                e.preventDefault();
                var url = $("#ImportApiUrl").val().trim();
                var method = $("#ImportApiMethod").val();
                var authType = $("#ImportApiAuthType").val();
                var token = $("#ImportApiToken").val().trim();

                if (!url) {
                    alert("URL Endpoint API Eksternal harus diisi!");
                    return;
                }

                var btn = $("#BtnTarikApi");
                var origText = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menghubungi API Eksternal...');

                $.ajax({
                    url: BaseURL + "Daerah/TarikDataApiEksternal",
                    type: "POST",
                    data: {
                        url: url,
                        method: method,
                        auth_type: authType,
                        token: token,
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        btn.prop('disabled', false).html(origText);
                        if (res.status === 'success') {
                            importedApiItems = res.items || [];
                            renderPreviewImport(importedApiItems);
                        } else {
                            alert(res.message || "Gagal menarik data dari API eksternal!");
                            $("#ContainerPreviewApi").slideUp(200);
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(origText);
                        alert("Terjadi kesalahan jaringan / server saat menarik data: " + error);
                    }
                });
            });

            // Render Preview Import Table
            function renderPreviewImport(items) {
                var tbody = $("#TbodyPreviewApi");
                tbody.empty();

                if (!items || items.length === 0) {
                    alert("API berhasil dihubungi namun tidak ada item indikator yang dapat dideteksi dalam respons JSON.");
                    $("#ContainerPreviewApi").slideUp(200);
                    return;
                }

                $("#BadgeTotalFound").text(items.length + " Indikator Ditemukan");

                $.each(items, function(i, itm) {
                    var tr = $('<tr></tr>');
                    tr.append('<td class="text-center">' + (i + 1) + '</td>');
                    tr.append('<td><strong>' + $('<div>').text(itm.indikator_tujuan).html() + '</strong></td>');
                    tr.append('<td><small>' + (itm.rumus ? $('<div>').text(itm.rumus).html() : '<em class="text-muted">-</em>') + '</small></td>');
                    tr.append('<td><small>' + (itm.definisi_operasional ? $('<div>').text(itm.definisi_operasional).html() : '<em class="text-muted">-</em>') + '</small></td>');
                    tr.append('<td class="text-center">' + (itm.target_1 !== null ? itm.target_1 : '-') + '</td>');
                    tr.append('<td class="text-center">' + (itm.target_2 !== null ? itm.target_2 : '-') + '</td>');
                    tr.append('<td class="text-center">' + (itm.target_3 !== null ? itm.target_3 : '-') + '</td>');
                    tr.append('<td class="text-center">' + (itm.target_4 !== null ? itm.target_4 : '-') + '</td>');
                    tr.append('<td class="text-center">' + (itm.target_5 !== null ? itm.target_5 : '-') + '</td>');
                    tbody.append(tr);
                });

                $("#ContainerPreviewApi").slideDown(300);
            }

            // Eksekusi Konfirmasi Impor ke IKU
            $("#BtnEksekusiImpor").on('click', function() {
                if (!importedApiItems || importedApiItems.length === 0) {
                    alert("Tidak ada data yang dapat diimpor!");
                    return;
                }

                var mode = $("#ImportApiMode").val();
                var periode = $("#ImportApiPeriode").val();

                var modeText = "Perbarui & Tambah (Upsert)";
                if (mode === 'append') modeText = "Tambahkan Semua sebagai Data Baru (Append)";
                if (mode === 'replace') modeText = "TIMPA TOTAL (Seluruh data IKU wilayah ini akan dihapus & digantikan)";

                var confirmMsg = "Konfirmasi Eksekusi Impor:\n" +
                                 "- Jumlah Indikator: " + importedApiItems.length + "\n" +
                                 "- Mode: " + modeText + "\n\n" +
                                 "Lanjutkan proses impor data ke database IKU?";

                if (!confirm(confirmMsg)) return;

                var btn = $(this);
                var origText = btn.html();
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan ke Database...');

                $.ajax({
                    url: BaseURL + "Daerah/EksekusiImporApi",
                    type: "POST",
                    data: {
                        mode: mode,
                        periode: periode,
                        items: JSON.stringify(importedApiItems),
                        [CSRF_NAME]: CSRF_TOKEN
                    },
                    dataType: "json",
                    success: function(res) {
                        btn.prop('disabled', false).html(origText);
                        if (res.status === 'success') {
                            alert(res.message);
                            $("#ModalIntegrasiApi").modal('hide');
                            location.reload();
                        } else {
                            alert(res.message || "Gagal melakukan impor data!");
                        }
                    },
                    error: function(xhr, status, error) {
                        btn.prop('disabled', false).html(origText);
                        alert("Terjadi kesalahan sistem saat mengeksekusi impor: " + error);
                    }
                });
            });

            // =========================================================================
            // REALTIME ENGINE: SSE (SERVER-SENT EVENTS) & LIVE NOTIFICATION
            // =========================================================================
            function initRealtimeStream() {
                if (!currentKodeWilayah) return;

                if (window.EventSource) {
                    var sseUrl = BaseURL + "api/iku/stream?kode_wilayah=" + encodeURIComponent(currentKodeWilayah);
                    try {
                        if (realtimeSseSource) realtimeSseSource.close();
                        realtimeSseSource = new EventSource(sseUrl);

                        realtimeSseSource.addEventListener('connected', function(e) {
                            $("#RealtimeStatusText").text("Realtime IKU Aktif");
                            $("#RealtimeStatusPill").css({"background": "#ecfdf5", "border-color": "#a7f3d0", "color": "#065f46"});
                        });

                        realtimeSseSource.addEventListener('iku_change', function(e) {
                            try {
                                var payload = JSON.parse(e.data);
                                handleIncomingRealtimeChange(payload);
                            } catch(err) {
                                console.warn("Error parsing realtime SSE payload", err);
                            }
                        });

                        realtimeSseSource.onerror = function() {
                            // Browser EventSource automatically reconnects
                            $("#RealtimeStatusText").text("Menghubungkan Ulang...");
                            $("#RealtimeStatusPill").css({"background": "#fef3c7", "border-color": "#fde68a", "color": "#92400e"});
                        };
                    } catch(e) {
                        startPollingFallback();
                    }
                } else {
                    startPollingFallback();
                }
            }

            function handleIncomingRealtimeChange(payload) {
                var eventName = payload.event_type || 'UPDATE';
                var indikator = payload.indikator || 'Indikator IKU';
                var time = new Date().toLocaleTimeString();

                $("#AlertRealtimeText").html(
                    'Perubahan <strong>' + eventName + '</strong> pada <em>"' + $('<div>').text(indikator).html() + '"</em> diterima secara realtime pukul ' + time + '.'
                );
                $("#AlertRealtimeUpdate").slideDown(300);

                // Flash status badge
                var pill = $("#RealtimeStatusPill");
                pill.css({"background": "#fef3c7", "border-color": "#f59e0b", "color": "#b45309"});
                $("#RealtimeStatusText").text("Data Baru Masuk!");

                setTimeout(function() {
                    pill.css({"background": "#ecfdf5", "border-color": "#a7f3d0", "color": "#065f46"});
                    $("#RealtimeStatusText").text("Realtime IKU Aktif");
                }, 4000);
            }

            // Polling Fallback jika SSE diblokir oleh proxy/jaringan
            function startPollingFallback() {
                setInterval(function() {
                    if (!currentKodeWilayah) return;
                    $.ajax({
                        url: BaseURL + "Daerah/CekPerubahanRealtime",
                        type: "POST",
                        data: {
                            last_log_id: latestObservedLogId,
                            [CSRF_NAME]: CSRF_TOKEN
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.status === 'success' && res.has_changes) {
                                latestObservedLogId = res.latest_id;
                                handleIncomingRealtimeChange(res.latest_change || { event_type: 'UPDATE', indikator: 'Data IKU' });
                            }
                        }
                    });
                }, 12000); // Cek setiap 12 detik
            }

            // Refresh Tabel saat alert diklik
            $("#BtnRefreshTableRealtime").on('click', function() {
                location.reload();
            });

            // Mulai stream realtime saat halaman dibuka
            initRealtimeStream();
        });
    </script>
</div>
</body>
</html>