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

                            <div class="button-icon-btn sm-res-mg-t-30" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px;">
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
        });
    </script>
</div>
</body>
</html>