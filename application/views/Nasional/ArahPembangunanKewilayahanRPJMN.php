<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$userLevel = $_SESSION['Level'] ?? ($this->session->userdata('Level') ?? null);
$isLoggedIn = !empty($_SESSION['isLoggedIn']) || !empty($this->session->userdata('isLoggedIn'));
$canEdit = $isLoggedIn && ($userLevel !== null && $userLevel !== '' && (string)$userLevel === '0');

// Helper untuk merender Highlight Indikasi Intervensi: setiap kategori & sub-kategori terpisah dengan point rapi
if (!function_exists('renderHighlightPointsRPJMN')) {
    function renderHighlightPointsRPJMN($text) {
        if (empty(trim($text))) return '-';
        $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", trim($text)));
        $html = '<div class="highlight-points-wrapper">';
        
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '') continue;

            // Cek apakah sub-point (diawali 'o ' atau '◦ ' atau '* ' atau indentasi 2+ spasi)
            if (preg_match('/^(?:o|◦|\*)\s+(.*)$/u', $trimmed, $matches) || preg_match('/^\s{2,}(?:o|\*|\-)?\s*(.*)$/u', $line, $matches)) {
                $content = !empty($matches[1]) ? $matches[1] : $trimmed;
                $html .= '<div class="point-sub"><span class="bullet-sub">o</span><span class="point-text">' . htmlspecialchars($content) . '</span></div>';
            } elseif (preg_match('/^(?:•||\-|\d+\.)\s*(.*)$/u', $trimmed, $matches)) {
                $content = !empty($matches[1]) ? $matches[1] : $trimmed;
                $html .= '<div class="point-main"><span class="bullet-main">•</span><span class="point-text">' . htmlspecialchars($content) . '</span></div>';
            } else {
                // Kategori umum / baris judul poin
                $html .= '<div class="point-main"><span class="bullet-main">•</span><span class="point-text">' . htmlspecialchars($trimmed) . '</span></div>';
            }
        }
        $html .= '</div>';
        return $html;
    }
}

// Helper untuk merender Tagging Lokasi dengan bullet point
if (!function_exists('renderTaggingPointsRPJMN')) {
    function renderTaggingPointsRPJMN($text) {
        if (empty(trim($text))) return '-';
        $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", trim($text)));
        $html = '<div class="tagging-points-wrapper">';
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '') continue;
            // Bersihkan bullet sebelumnya jika ada
            $clean = preg_replace('/^(?:•|o|\*|\-)\s*/u', '', $trimmed);
            $html .= '<div class="tag-point"><span class="bullet-main">•</span><span class="tag-text">' . htmlspecialchars($clean) . '</span></div>';
        }
        $html .= '</div>';
        return $html;
    }
}
?>

<style>
    /* CSS Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0 !important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        width: 780px;
        max-width: 95%;
    }
    .modal-header h2 {
        font-size: 18px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }

    /* Container Card - Selaras dengan Halaman Lain */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
        margin-bottom: 30px;
    }

    /* Table Styling - Selaras dengan Halaman Lain (#f8f9fa / #455a64) */
    #kewilayahan-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }
    #kewilayahan-table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: 1px solid #e0e0e0;
        padding: 12px 10px;
        vertical-align: middle;
        text-align: center;
    }
    #kewilayahan-table > tbody > tr > td {
        border: 1px solid #e9ecef;
        padding: 10px 12px;
        vertical-align: top;
        color: #333;
        line-height: 1.55;
    }
    #kewilayahan-table > tbody > tr:hover {
        background-color: #fcfdfe;
    }

    /* Cell styling */
    .cell-provinsi {
        font-weight: 700;
        color: #1e293b;
        background-color: #fafbfc;
        vertical-align: top !important;
        font-size: 12px;
    }
    .cell-lokasi {
        font-weight: 600;
        color: #334155;
        vertical-align: top !important;
        background-color: #ffffff;
    }
    .cell-highlight {
        vertical-align: top !important;
    }
    .cell-tagging {
        vertical-align: top !important;
        background-color: #fdfefe;
    }
    .cell-aksi {
        text-align: center;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    /* Highlight Points Formatting */
    .highlight-points-wrapper {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .point-main {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        font-weight: 500;
        color: #1e293b;
    }
    .point-main .bullet-main {
        color: #00c292;
        font-size: 14px;
        line-height: 1.2;
        flex-shrink: 0;
    }
    .point-sub {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        padding-left: 18px;
        color: #475569;
        font-size: 11.5px;
    }
    .point-sub .bullet-sub {
        color: #03a9f4;
        font-size: 11px;
        line-height: 1.3;
        flex-shrink: 0;
        font-weight: bold;
    }

    /* Tagging Lokasi Formatting */
    .tagging-points-wrapper {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .tag-point {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        color: #334155;
        font-size: 11.5px;
    }
    .tag-point .bullet-main {
        color: #00c292;
        font-size: 13px;
        line-height: 1.2;
        flex-shrink: 0;
    }

    /* Action Buttons */
    .btn-action {
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s ease;
        margin: 2px;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    /* Search Box */
    .table-search-box {
        position: relative;
        display: inline-block;
    }
    .table-search-box input {
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 6px 15px 6px 32px;
        font-size: 12px;
        outline: none;
        transition: border-color 0.2s;
        width: 230px;
    }
    .table-search-box input:focus {
        border-color: #00c292;
    }
    .table-search-box .fa-search {
        position: absolute;
        left: 11px;
        top: 9px;
        color: #aaa;
        font-size: 12px;
    }

    /* Tagging Location Pills in Modal */
    .tag-pill {
        display: inline-flex;
        align-items: center;
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        border-radius: 14px;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 500;
        margin: 3px;
    }
    .tag-pill .btn-del-tag {
        margin-left: 6px;
        cursor: pointer;
        color: #0284c7;
        font-weight: bold;
        font-size: 13px;
        line-height: 1;
    }
    .tag-pill .btn-del-tag:hover {
        color: #dc2626;
    }

    /* Builder Point Items in Modal */
    .point-item-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 10px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .point-item-card.is-sub {
        margin-left: 20px;
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .point-item-card .btn-delete-point {
        padding: 3px 7px;
        font-size: 11px;
        border-radius: 4px;
    }
    .form-section-title {
        font-weight: 700;
        font-size: 12px;
        color: #334155;
        margin-top: 14px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 4px;
    }
    .badge-point-type {
        font-size: 10px;
        padding: 3px 6px;
        border-radius: 4px;
        white-space: nowrap;
    }
    .badge-point-type.main { background: #00c292; color: #fff; }
    .badge-point-type.sub { background: #03a9f4; color: #fff; }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">

                    <!-- Header Kontainer Tabel Selaras dengan Halaman Lain -->
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px;">
                        <div>
                            <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Arah Pembangunan Kewilayahan Nasional</h3>
                            <small style="color: #888; display: block; margin-bottom: 10px;">Pemetaan Wilayah, Lokasi Prioritas, Highlight Indikasi Intervensi, dan Tagging Lokasi RPJMN</small>
                            <?php if ($canEdit) { ?>
                            <div class="button-icon-btn">
                                <button type="button" class="btn btn-success notika-btn-success btn-action" id="BtnOpenModalInput" style="padding: 6px 14px;">
                                    <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <b>Input Arah Kewilayahan Nasional</b>
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <div class="table-search-box">
                                <i class="fa fa-search"></i>
                                <input type="text" id="searchInput" placeholder="Cari arah kewilayahan...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="kewilayahan-table">
                            <thead>
                                <tr>
                                    <th style="width: 14%;">Provinsi</th>
                                    <th style="width: 26%;">Lokasi Prioritas</th>
                                    <th style="width: 42%;">Highlight Indikasi Intervensi</th>
                                    <th style="width: 18%;">Tagging Lokasi</th>
                                    <?php if ($canEdit) { ?>
                                    <th style="width: 8%;">Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($DataArah) && count($DataArah) > 0):
                                    // Kelompokkan data berdasarkan Provinsi dan Lokasi Prioritas untuk render rowspan yang rapi
                                    $grouped = [];
                                    foreach ($DataArah as $row) {
                                        $pKey = $row['NamaProvinsi'] ?: ($row['Provinsi'] ?: 'Lainnya');
                                        $lKey = $row['LokasiPrioritas'] ?: '-';
                                        $grouped[$pKey][$lKey][] = $row;
                                    }

                                    foreach ($grouped as $namaProv => $lokasiGroups):
                                        // Hitung total baris untuk Provinsi ini
                                        $provRowspan = 0;
                                        foreach ($lokasiGroups as $items) {
                                            $provRowspan += count($items);
                                        }

                                        $isProvFirst = true;

                                        foreach ($lokasiGroups as $namaLokasi => $items):
                                            $lokasiRowspan = count($items);
                                            $isLokasiFirst = true;

                                            foreach ($items as $item):
                                ?>
                                                <tr class="kewilayahan-row">
                                                    <?php if ($isProvFirst) { ?>
                                                        <td rowspan="<?= $provRowspan ?>" class="cell-provinsi">
                                                            <?= htmlspecialchars($namaProv) ?>
                                                        </td>
                                                    <?php $isProvFirst = false; } ?>

                                                    <?php if ($isLokasiFirst) { ?>
                                                        <td rowspan="<?= $lokasiRowspan ?>" class="cell-lokasi">
                                                            <?= htmlspecialchars($namaLokasi) ?>
                                                        </td>
                                                    <?php $isLokasiFirst = false; } ?>

                                                    <td class="cell-highlight">
                                                        <?= renderHighlightPointsRPJMN($item['HighlightIntervensi']) ?>
                                                    </td>
                                                    <td class="cell-tagging">
                                                        <?= renderTaggingPointsRPJMN($item['TaggingLokasi']) ?>
                                                    </td>

                                                    <?php if ($canEdit) { ?>
                                                        <td class="cell-aksi">
                                                            <button type="button" class="btn btn-xs btn-success btn-action TambahArahLokasi" 
                                                                data-provinsi="<?= htmlspecialchars($item['Provinsi'], ENT_QUOTES) ?>"
                                                                data-lokasi="<?= htmlspecialchars($item['LokasiPrioritas'], ENT_QUOTES) ?>"
                                                                title="Tambah Intervensi Baru di Lokasi Ini">
                                                                <i class="fa fa-plus"></i> Highlight
                                                            </button>
                                                            <button type="button" class="btn btn-xs btn-info btn-action EditArah" 
                                                                data-id="<?= $item['Id'] ?>" 
                                                                title="Edit Data">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-xs btn-danger btn-action HapusArah" 
                                                                data-id="<?= $item['Id'] ?>" 
                                                                title="Hapus Data">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                <?php
                                            endforeach;
                                        endforeach;
                                    endforeach;
                                else: ?>
                                    <tr>
                                        <td colspan="<?= $canEdit ? '5' : '4' ?>" style="text-align: center; padding: 40px; color: #888;">
                                            Belum ada data Arah Pembangunan Kewilayahan Nasional.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($canEdit) { ?>
<!-- ======== MODAL INPUT / EDIT ARAH KEWILAYAHAN NASIONAL ======== -->
<div class="modal fade" id="ModalFormArah" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 id="ModalFormTitle"><i class="fa fa-plus-circle" style="color: #00c292; margin-right: 6px;"></i> Input Arah Pembangunan Kewilayahan Nasional</h2>
            </div>
            <div class="modal-body" style="padding-top: 15px; max-height: 75vh; overflow-y: auto;">
                <input type="hidden" id="FormId" value="">

                <!-- 1. Pilih Provinsi -->
                <div class="form-section-title">1. Pilih Provinsi</div>
                <select class="form-control" id="FormProvinsi">
                    <option value="">-- Pilih Provinsi --</option>
                    <?php if (isset($Provinsi)) { foreach ($Provinsi as $p) { ?>
                        <option value="<?= $p['Kode'] ?>"><?= $p['Nama'] ?></option>
                    <?php } } ?>
                </select>

                <!-- 2. Lokasi Prioritas -->
                <div class="form-section-title">2. Lokasi Prioritas</div>
                <textarea class="form-control" id="FormLokasiPrioritas" rows="2" placeholder="cth: WM Surabaya dan Kawasan Pengembangan Industri Gresik-Surabaya- Sidoarjo- Mojokerto- Pasuruan"></textarea>

                <!-- 3. Highlight Indikasi Intervensi (Builder Poin & Delete) -->
                <div class="form-section-title">3. Highlight Indikasi Intervensi (Kategori & Poin Terpisah)</div>
                <div style="font-size: 11px; color: #64748b; margin-bottom: 8px;">
                    Gunakan tombol <b>Tambah Poin</b> di bawah untuk menambahkan poin/kategori. Klik tombol <b>Delete (tempat sampah)</b> untuk menghapus poin.
                </div>
                
                <div id="HighlightPointsContainer" style="margin-bottom: 10px;">
                    <!-- Baris poin dinamis akan dimuat di sini -->
                </div>

                <div style="display: flex; gap: 8px; margin-bottom: 12px; flex-wrap: wrap;">
                    <button type="button" class="btn btn-sm btn-success" id="BtnAddMainPoint" style="padding: 5px 12px;">
                        <i class="fa fa-plus"></i> Tambah Poin Utama (•)
                    </button>
                    <button type="button" class="btn btn-sm btn-info" id="BtnAddSubPoint" style="padding: 5px 12px;">
                        <i class="fa fa-plus"></i> Tambah Sub-Poin (o)
                    </button>
                </div>

                <!-- 4. Tagging Lokasi (Builder Tag & Delete Tanpa Perlu Shift) -->
                <div class="form-section-title">4. Tagging Lokasi (Kabupaten / Kota)</div>
                <div style="font-size: 11px; color: #64748b; margin-bottom: 6px;">
                    Pilih Kabupaten/Kota lalu klik <b>Tambah</b>. Setiap tag dapat dihapus langsung dengan tombol <b>Delete (x)</b> tanpa perlu tombol Shift.
                </div>
                
                <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                    <select class="form-control" id="FormKabupatenDropdown" style="flex: 1;">
                        <option value="" disabled selected>-- Pilih Provinsi Terlebih Dahulu --</option>
                    </select>
                    <button type="button" class="btn btn-success btn-sm" id="BtnAddTagging" style="white-space: nowrap; padding: 7px 14px;">
                        <i class="fa fa-plus"></i> Tambah Tagging
                    </button>
                </div>

                <div id="TaggingPillsContainer" style="min-height: 42px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 10px; background: #f8fafc;">
                    <span id="EmptyTaggingNote" style="font-size: 11px; color: #94a3b8; font-style: italic;">Belum ada tagging lokasi yang ditambahkan.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="BtnSaveArah"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/wow.min.js') ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js') ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js') ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js') ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>

<script>
var BaseURL = '<?= base_url() ?>';
var DataArahMap = <?= json_encode(isset($DataArah) ? $DataArah : [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?> || [];

// Helper: konversi nama kab/kota ke format rapi (Title Case)
function formatKabNama(nama) {
    if (!nama) return '';
    return nama.toLowerCase().replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); })
               .replace(/\bKab\b/g, 'Kab.')
               .replace(/\bKota\b/g, 'Kota');
}

// Global cache data kabupaten per provinsi agar loading instan
var KabCache = {};

function loadKabupatenDropdown(provKode, callback) {
    var $dd = $('#FormKabupatenDropdown');
    $dd.empty().append('<option value="" disabled selected>Memuat data kabupaten/kota...</option>');

    if (!provKode) {
        $dd.empty().append('<option value="" disabled selected>-- Pilih Provinsi Terlebih Dahulu --</option>');
        if (callback) callback([]);
        return;
    }

    if (KabCache[provKode]) {
        populateDropdown(KabCache[provKode]);
        if (callback) callback(KabCache[provKode]);
        return;
    }

    $.post(BaseURL + 'Nasional/GetKabupatenByProvinsi', { Provinsi: provKode }, function(res) {
        var data = [];
        try { data = typeof res === 'object' ? res : JSON.parse(res); } catch(e) { data = []; }
        KabCache[provKode] = data;
        populateDropdown(data);
        if (callback) callback(data);
    }).fail(function(){
        $dd.empty().append('<option value="" disabled selected>Gagal memuat data</option>');
        if (callback) callback([]);
    });

    function populateDropdown(items) {
        $dd.empty();
        if (items.length === 0) {
            $dd.append('<option value="" disabled selected>Tidak ada data kabupaten/kota</option>');
        } else {
            $dd.append('<option value="" disabled selected>-- Pilih Kabupaten/Kota untuk Ditambahkan --</option>');
            $.each(items, function(idx, itm) {
                var namaFmt = formatKabNama(itm.Nama);
                $dd.append('<option value="' + itm.Kode + '" data-nama="' + namaFmt + '">' + itm.Nama + '</option>');
            });
        }
    }
}

// Helper: Menambahkan baris input point
function appendPointRow(type, text) {
    text = text || '';
    var isMain = (type === 'main');
    var badgeClass = isMain ? 'main' : 'sub';
    var badgeText = isMain ? '• Poin Utama' : 'o Sub-Poin';
    var cardClass = isMain ? 'is-main' : 'is-sub';

    var html = '<div class="point-item-card ' + cardClass + '" data-type="' + type + '">'
             + '  <span class="badge-point-type ' + badgeClass + '">' + badgeText + '</span>'
             + '  <input type="text" class="form-control point-input-val" value="' + $('<div>').text(text).html() + '" placeholder="Ketik isi poin..." style="flex:1; font-size:12px; height:32px;">'
             + '  <button type="button" class="btn btn-xs btn-danger btn-delete-point" title="Hapus Poin ini"><i class="fa fa-trash"></i></button>'
             + '</div>';
    $('#HighlightPointsContainer').append(html);
}

// Helper: Menambahkan tag pill untuk Tagging Lokasi
function appendTagPill(kode, nama) {
    if (!kode || !nama) return;
    // Cek duplikasi
    var exists = false;
    $('#TaggingPillsContainer .tag-pill').each(function(){
        if ($(this).attr('data-kode') === kode) {
            exists = true;
            return false;
        }
    });
    if (exists) return;

    $('#EmptyTaggingNote').hide();
    var pill = '<span class="tag-pill" data-kode="' + kode + '" data-nama="' + $('<div>').text(nama).html() + '">'
             + '  <i class="fa fa-map-marker text-success" style="margin-right:5px;"></i> • ' + $('<div>').text(nama).html()
             + '  <span class="btn-del-tag" title="Hapus tag">&times;</span>'
             + '</span>';
    $('#TaggingPillsContainer').append(pill);
}

function checkEmptyTagPills() {
    if ($('#TaggingPillsContainer .tag-pill').length === 0) {
        $('#EmptyTaggingNote').show();
    } else {
        $('#EmptyTaggingNote').hide();
    }
}

$(function(){
    // Live Search Filter Table
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#kewilayahan-table tbody tr.kewilayahan-row').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    <?php if ($canEdit) { ?>
    // 1. Tambah Poin Utama
    $('#BtnAddMainPoint').click(function(){
        appendPointRow('main', '');
    });

    // 2. Tambah Sub-Poin
    $('#BtnAddSubPoint').click(function(){
        appendPointRow('sub', '');
    });

    // 3. Hapus Poin
    $('body').on('click', '.btn-delete-point', function(){
        $(this).closest('.point-item-card').remove();
    });

    // 4. Tambah Tagging Lokasi dari Dropdown
    $('#BtnAddTagging').click(function(){
        var $opt = $('#FormKabupatenDropdown').find('option:selected');
        var kode = $opt.val();
        var nama = $opt.data('nama') || $opt.text();
        if (!kode) {
            alert('Silakan pilih kabupaten/kota terlebih dahulu!');
            return;
        }
        appendTagPill(kode, nama);
    });

    // 5. Hapus Tagging Lokasi
    $('body').on('click', '.btn-del-tag', function(){
        $(this).closest('.tag-pill').remove();
        checkEmptyTagPills();
    });

    // 6. Ganti Provinsi di Modal
    $('#FormProvinsi').on('change', function(){
        var prov = $(this).val();
        loadKabupatenDropdown(prov);
        // Kosongkan tagging sebelumnya jika provinsi diganti
        $('#TaggingPillsContainer .tag-pill').remove();
        checkEmptyTagPills();
    });

    // 7. Klik Buka Modal Input Baru
    $('#BtnOpenModalInput').click(function(){
        $('#FormId').val('');
        $('#ModalFormTitle').html('<i class="fa fa-plus-circle" style="color: #00c292; margin-right: 6px;"></i> Input Arah Pembangunan Kewilayahan Nasional');
        $('#FormProvinsi').val('');
        $('#FormLokasiPrioritas').val('');
        $('#HighlightPointsContainer').empty();
        appendPointRow('main', ''); // 1 poin awal
        $('#TaggingPillsContainer .tag-pill').remove();
        checkEmptyTagPills();
        loadKabupatenDropdown('');
        $('#ModalFormArah').modal('show');
    });

    // 8. Klik Tambah Baris Intervensi Pada Lokasi Prioritas yang Sama dari Tabel
    $('body').on('click', '.TambahArahLokasi', function(e){
        e.preventDefault();
        var prov = $(this).attr('data-provinsi');
        var lokasi = $(this).attr('data-lokasi');

        $('#FormId').val('');
        $('#ModalFormTitle').html('<i class="fa fa-plus-circle" style="color: #00c292; margin-right: 6px;"></i> Tambah Highlight di Lokasi Terpilih');
        $('#FormProvinsi').val(prov);
        $('#FormLokasiPrioritas').val(lokasi);
        $('#HighlightPointsContainer').empty();
        appendPointRow('main', '');
        $('#TaggingPillsContainer .tag-pill').remove();
        checkEmptyTagPills();

        loadKabupatenDropdown(prov, function(){
            $('#ModalFormArah').modal('show');
        });
    });

    // 9. Klik Edit Data
    $('body').on('click', '.EditArah', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var item = null;
        for (var i = 0; i < DataArahMap.length; i++) {
            if (DataArahMap[i].Id == id) {
                item = DataArahMap[i];
                break;
            }
        }
        if (!item) {
            alert('Data tidak ditemukan!');
            return;
        }

        $('#FormId').val(item.Id);
        $('#ModalFormTitle').html('<i class="fa fa-edit" style="color: #03a9f4; margin-right: 6px;"></i> Edit Arah Pembangunan Kewilayahan Nasional');
        $('#FormProvinsi').val(item.Provinsi);
        $('#FormLokasiPrioritas').val(item.LokasiPrioritas);

        // Parse dan render poin-poin Highlight Indikasi Intervensi
        $('#HighlightPointsContainer').empty();
        var rawHighlight = item.HighlightIntervensi || '';
        var lines = rawHighlight.split('\n');
        var hasLine = false;

        $.each(lines, function(idx, line) {
            var trimmed = $.trim(line);
            if (!trimmed) return;
            hasLine = true;
            // Cek apakah sub-point
            if (/^(?:o|◦|\*)\s+(.*)$/i.test(trimmed) || /^\s{2,}/.test(line)) {
                var clean = trimmed.replace(/^(?:o|◦|\*)\s*/i, '');
                appendPointRow('sub', clean);
            } else {
                var clean = trimmed.replace(/^(?:•||\-|\d+\.)\s*/i, '');
                appendPointRow('main', clean);
            }
        });

        if (!hasLine) {
            appendPointRow('main', '');
        }

        // Render Tagging Lokasi pills
        $('#TaggingPillsContainer .tag-pill').remove();
        var rawTagging = item.TaggingLokasi || '';
        var rawKode = item.TaggingLokasiKode || '';
        var tagLines = rawTagging.split('\n');
        var kodes = rawKode ? rawKode.split(',') : [];

        $.each(tagLines, function(idx, tl) {
            var tClean = $.trim(tl).replace(/^(?:•|o|\*|\-)\s*/i, '');
            if (tClean) {
                var k = kodes[idx] || ('tag_' + idx);
                appendTagPill(k, tClean);
            }
        });
        checkEmptyTagPills();

        // Buka modal segera
        $('#ModalFormArah').modal('show');

        // Muat dropdown kabupaten untuk provinsi ini
        loadKabupatenDropdown(item.Provinsi);
    });

    // 10. Simpan / Update Data
    $('#BtnSaveArah').click(function(){
        var id = $('#FormId').val();
        var prov = $('#FormProvinsi').val();
        var lokasi = $.trim($('#FormLokasiPrioritas').val());

        if (!prov) return alert('Provinsi belum dipilih!');
        if (!lokasi) return alert('Lokasi Prioritas belum diisi!');

        // Serialize Highlight Points
        var highlightLines = [];
        $('#HighlightPointsContainer .point-item-card').each(function(){
            var type = $(this).attr('data-type');
            var val = $.trim($(this).find('.point-input-val').val());
            if (val) {
                if (type === 'sub') {
                    highlightLines.push('  o ' + val);
                } else {
                    highlightLines.push('• ' + val);
                }
            }
        });

        if (highlightLines.length === 0) {
            return alert('Highlight Indikasi Intervensi minimal memiliki 1 poin!');
        }
        var highlightText = highlightLines.join('\n');

        // Serialize Tagging Lokasi
        var taggingKodes = [];
        var taggingNames = [];
        $('#TaggingPillsContainer .tag-pill').each(function(){
            var k = $(this).attr('data-kode');
            var n = $(this).attr('data-nama');
            if (k) taggingKodes.push(k);
            if (n) taggingNames.push('• ' + n);
        });

        if (taggingNames.length === 0) {
            return alert('Tagging Lokasi minimal memiliki 1 Kabupaten/Kota!');
        }
        var taggingKodeStr = taggingKodes.join(',');
        var taggingNameStr = taggingNames.join('\n');

        var url = id ? (BaseURL + 'Nasional/EditArahKewilayahanRPJMN') : (BaseURL + 'Nasional/InputArahKewilayahanRPJMN');
        var postData = {
            Provinsi: prov,
            LokasiPrioritas: lokasi,
            HighlightIntervensi: highlightText,
            TaggingLokasiKode: taggingKodeStr,
            TaggingLokasi: taggingNameStr,
            Tahun: '2025-2029'
        };
        if (id) {
            postData.Id = id;
        }

        $.post(url, postData).done(function(res){
            if (res === '1') {
                location.reload();
            } else {
                alert(res);
            }
        }).fail(function(xhr, status, error){
            alert('Gagal menyimpan data: ' + error);
        });
    });

    // 11. Hapus Data
    $('body').on('click', '.HapusArah', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.post(BaseURL + 'Nasional/HapusArahKewilayahanRPJMN', { Id: id }).done(function(res){
                if (res === '1') {
                    location.reload();
                } else {
                    alert(res);
                }
            }).fail(function(xhr, status, error){
                alert('Gagal hapus data: ' + error);
            });
        }
    });
    <?php } ?>
});
</script>
