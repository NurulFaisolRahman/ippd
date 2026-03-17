<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<script src="https://d3js.org/d3.v7.min.js"></script>

<style>
:root {
    --l1: #1e40af;
    --l1-light: #dbeafe;
    --l2: #0369a1;
    --l2-light: #e0f2fe;
    --l3: #b45309;
    --l3-light: #fef3c7;
    --l4: #c2410c;
    --l4-light: #ffedd5;
    --l5: #6d28d9;
    --l5-light: #ede9fe;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'Segoe UI', system-ui, sans-serif; }

.main-content {
    background: #f0f4f8;
    min-height: 100vh;
}

/* === CARD WRAPPER === */
.pk-card {
    margin: 16px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.1);
    background: #fff;
    display: flex;
    flex-direction: column;
    height: calc(100vh - 32px);
}

/* === FILTER SECTION === */
.filter-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    padding: 16px 24px;
    border-bottom: 2px solid #e2e8f0;
    flex-shrink: 0;
}

.filter-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    color: #1e293b;
    font-weight: 600;
    font-size: 14px;
}

.filter-title i {
    color: #3b82f6;
    font-size: 16px;
}

.filter-row {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    font-size: 14px;
    background: white;
    transition: all 0.2s;
}

.filter-group select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}

.filter-group select:disabled {
    background: #f1f5f9;
    cursor: not-allowed;
}

.btn-filter {
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    min-width: 120px;
    justify-content: center;
}

.btn-filter:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.2);
}

.btn-filter:disabled {
    background: #94a3b8;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.wilayah-info {
    margin-top: 12px;
    padding: 10px 16px;
    background: #dbeafe;
    border-left: 4px solid #2563eb;
    border-radius: 8px;
    font-size: 14px;
    color: #1e40af;
    display: flex;
    align-items: center;
    gap: 8px;
}

.wilayah-info i {
    font-size: 16px;
}

/* === HEADER === */
.pk-header {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 60%, #60a5fa 100%);
    padding: 20px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}

.pk-header-title {
    display: flex;
    align-items: center;
    gap: 14px;
    color: white;
}

.pk-header-title .icon-wrap {
    width: 44px; height: 44px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
}

.pk-header-title h4 {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: .3px;
}

.pk-header-title p {
    font-size: 13px;
    opacity: .8;
    margin-top: 2px;
}

.wilayah-badge {
    background: rgba(255,255,255,0.15);
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 500;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.2);
}

/* === LEGEND === */
.pk-legend {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 10px 24px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
    flex-shrink: 0;
}

.pk-legend span {
    font-size: 11px;
    font-weight: 600;
    color: #475569;
    margin-right: 4px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #374151;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 4px 12px;
    cursor: default;
}

.legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.legend-count {
    background: #e2e8f0;
    border-radius: 12px;
    padding: 2px 8px;
    font-size: 10px;
    font-weight: 600;
    color: #475569;
    margin-left: 4px;
}

/* === SVG CONTAINER === */
#chart-container {
    flex: 1;
    overflow: hidden;
    position: relative;
    background:
        radial-gradient(circle at 20% 50%, rgba(59,130,246,.04) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139,92,246,.04) 0%, transparent 50%),
        #f8fafc;
}

#chart-svg {
    width: 100%;
    height: 100%;
    cursor: grab;
}

#chart-svg:active { cursor: grabbing; }

/* === MODAL POPUP === */
.pk-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

.pk-modal {
    background: #1e293b;
    border-radius: 24px;
    width: 90%;
    max-width: 600px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
    animation: modalSlideUp 0.3s ease;
    border-left: 6px solid;
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pk-modal-header {
    padding: 20px 24px;
    background: rgba(255,255,255,0.05);
    border-bottom: 1px solid #334155;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 24px 24px 0 0;
}

.pk-modal-header h3 {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 18px;
    font-weight: 600;
    color: #f8fafc;
    margin: 0;
}

.pk-modal-header h3 i {
    font-size: 20px;
}

.pk-modal-close {
    background: rgba(255,255,255,0.1);
    border: none;
    color: #f8fafc;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 18px;
}

.pk-modal-close:hover {
    background: rgba(255,255,255,0.2);
    transform: rotate(90deg);
}

.pk-modal-body {
    padding: 24px;
    overflow-y: auto;
    max-height: calc(85vh - 80px);
    color: #e2e8f0;
    scrollbar-width: thin;
    scrollbar-color: #475569 #1e293b;
}

.pk-modal-body::-webkit-scrollbar {
    width: 8px;
}

.pk-modal-body::-webkit-scrollbar-track {
    background: #1e293b;
    border-radius: 8px;
}

.pk-modal-body::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 8px;
}

.pk-modal-body::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

.modal-section {
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #334155;
}

.modal-section:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.modal-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.modal-value {
    font-weight: 500;
    color: #f8fafc;
    word-break: break-word;
    font-size: 14px;
    line-height: 1.6;
}

.modal-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: rgba(255,255,255,0.1);
    color: #cbd5e1;
    margin-right: 6px;
    margin-bottom: 6px;
}

.higher-link-modal-item {
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 8px;
    border-left: 4px solid;
}

.higher-link-modal-item:last-child {
    margin-bottom: 0;
}

.pelaksana-card {
    background: rgba(255,255,255,0.05);
    border-radius: 16px;
    padding: 16px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.pelaksana-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    flex-shrink: 0;
}

.pelaksana-info {
    flex: 1;
}

.pelaksana-info h4 {
    font-size: 16px;
    font-weight: 600;
    color: #f8fafc;
    margin: 0 0 4px 0;
}

.pelaksana-info p {
    margin: 4px 0;
    font-size: 12px;
    color: #cbd5e1;
    display: flex;
    align-items: center;
    gap: 6px;
}

.pelaksana-info i {
    color: #64748b;
    width: 16px;
}

.indikator-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.indikator-list li {
    margin-bottom: 8px;
    padding: 8px 12px;
    background: rgba(255,255,255,0.03);
    border-radius: 8px;
    display: flex;
    align-items: start;
    gap: 8px;
    font-size: 13px;
}

.indikator-list li i {
    color: #3b82f6;
    font-size: 12px;
    margin-top: 3px;
}

.inovasi-grid {
    display: grid;
    gap: 12px;
}

.inovasi-item {
    background: rgba(255,255,255,0.03);
    border-radius: 12px;
    padding: 12px;
}

.inovasi-item .label {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.inovasi-item .value {
    font-size: 13px;
    color: #f8fafc;
}

.crosscutting-modal-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}

.crosscutting-modal-table th {
    text-align: left;
    padding: 8px 4px;
    color: #94a3b8;
    font-weight: 600;
    font-size: 10px;
    text-transform: uppercase;
    border-bottom: 1px solid #334155;
}

.crosscutting-modal-table td {
    padding: 10px 4px;
    border-bottom: 1px solid #2d3748;
}

.crosscutting-modal-table tr:last-child td {
    border-bottom: none;
}

.id-footer {
    margin-top: 16px;
    padding-top: 12px;
    border-top: 1px solid #334155;
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #64748b;
}

/* === ZOOM COUNTER === */
.zoom-badge {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: rgba(30,41,59,.75);
    backdrop-filter: blur(6px);
    color: #f1f5f9;
    border-radius: 10px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
    pointer-events: none;
}

/* === EMPTY STATE === */
.pk-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    gap: 16px;
    color: #94a3b8;
}

.pk-empty i { font-size: 48px; opacity: .4; }
.pk-empty p { font-size: 15px; }

/* === STATS CARD === */
.stats-card {
    background: white;
    border-radius: 12px;
    padding: 12px 20px;
    display: flex;
    gap: 24px;
    border: 1px solid #e2e8f0;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stat-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.stat-value {
    font-weight: 700;
    color: #1e293b;
}

.stat-label {
    font-size: 11px;
    color: #64748b;
}
</style>

<div class="main-content">
    <div class="pk-card">

        <!-- FILTER WILAYAH SECTION -->
        <div class="filter-section">
            <div class="filter-title">
                <i class="fa fa-map-filter"></i>
                <span>Pilih Wilayah untuk Melihat Pohon Kinerja</span>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <label> Provinsi</label>
                    <select id="Provinsi">
                        <option value="">Pilih Provinsi</option>
                        <?php foreach ($Provinsi as $prov) { ?>
                            <option value="<?= html_escape($prov['Kode']) ?>">
                                <?= html_escape($prov['Nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label> Kabupaten/Kota</label>
                    <select id="KabKota" disabled>
                        <option value="">Pilih Kab/Kota</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <button class="btn-filter" id="Filter">
                        <i class="fa fa-search"></i>
                        Tampilkan
                    </button>
                </div>
            </div>

            <!-- Wilayah Info (ditampilkan jika sudah pilih) -->
            <?php if (!empty($NamaWilayah)): ?>
                <div class="wilayah-info">
                    <i class="fa fa-map-pin"></i>
                    <span><strong>Wilayah terpilih:</strong> <?= html_escape($NamaWilayah) ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- HEADER CHART -->
        <div class="pk-header">
            <div class="pk-header-title">
                <div class="icon-wrap"><i class="fa fa-sitemap"></i></div>
                <div>
                    <h4>Pohon Kinerja <?= !empty($NamaWilayah) ? '- ' . html_escape($NamaWilayah) : '' ?></h4>
                    <p>Visualisasi hierarki kinerja 5 level - Klik node untuk melihat detail</p>
                </div>
            </div>
        </div>

        <!-- LEGEND & STATS -->
        <div class="pk-legend">
            <span>Level:</span>
            <div class="legend-item">
                <div class="legend-dot" style="background:var(--l1)"></div> 
                Ultimate Outcome
                <span class="legend-count"><?= $TotalData['level1'] ?? 0 ?></span>
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:var(--l2)"></div> 
                Intermediate Sektor
                <span class="legend-count"><?= $TotalData['level2'] ?? 0 ?></span>
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:var(--l3)"></div> 
                Intermediate Taktikal
                <span class="legend-count"><?= $TotalData['level3'] ?? 0 ?></span>
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:var(--l4)"></div> 
                Immediate Outcome
                <span class="legend-count"><?= $TotalData['level4'] ?? 0 ?></span>
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:var(--l5)"></div> 
                Output
                <span class="legend-count"><?= $TotalData['level5'] ?? 0 ?></span>
            </div>
        </div>

        <!-- CHART -->
        <div id="chart-container">
            <svg id="chart-svg"></svg>
            <div class="zoom-badge" id="zoom-badge">100%</div>
        </div>

        <!-- MODAL POPUP -->
        <div class="pk-modal-overlay" id="modalOverlay">
            <div class="pk-modal" id="modal">
                <div class="pk-modal-header">
                    <h3>
                        <i class="fa fa-info-circle"></i>
                        <span id="modalTitle">Detail Kinerja</span>
                    </h3>
                    <button class="pk-modal-close" id="modalClose">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="pk-modal-body" id="modalBody">
                    <!-- Content will be inserted here -->
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="pk-footer">
            <div class="pk-footer-info">
                <i class="fa fa-info-circle"></i> 
                Scroll / Pinch untuk zoom &bull; Drag untuk pan &bull; <strong>Klik node untuk melihat detail</strong>
            </div>
            <div class="btn-group-pk">
                <button class="btn-pk btn-back" onclick="location.href='<?= base_url('Daerah') ?>'">
                    <i class="fa fa-arrow-left"></i> Kembali
                </button>
                <button class="btn-pk btn-zoom" id="zoomIn"><i class="fa fa-search-plus"></i></button>
                <button class="btn-pk btn-zoom" id="zoomOut"><i class="fa fa-search-minus"></i></button>
                <button class="btn-pk btn-reset" id="btnReset"><i class="fa fa-rotate"></i> Reset</button>
            </div>
        </div>

    </div>
</div>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";

$(document).ready(function() {
    
    // Setup AJAX CSRF
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.type.toUpperCase() === 'POST') {
                settings.data = (settings.data || '') + (settings.data ? '&' : '') + CSRF_NAME + '=' + encodeURIComponent(CSRF_TOKEN);
            }
        }
    });

    // Load Kab/Kota saat Provinsi dipilih
    $("#Provinsi").change(function() {
        var prov = $(this).val();
        
        if (prov === "") {
            $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', true);
            return;
        }

        $.ajax({
            url: BaseURL + "Daerah/GetListKabKota",
            type: "POST",
            data: { Kode: prov },
            beforeSend: function() { 
                $("#KabKota").prop('disabled', true).html('<option value="">Memuat...</option>'); 
            },
            success: function(res) {
                var Data = (typeof res === 'string') ? JSON.parse(res) : res;
                var options = '<option value="">Pilih Kab/Kota</option>';

                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        options += '<option value="' + Data[i].Kode + '">' + Data[i].Nama + '</option>';
                    }
                }

                $("#KabKota").html(options).prop('disabled', false);
                
                <?php if (!empty($KodeWilayah)): ?>
                    var kodeKab = "<?= $KodeWilayah ?>";
                    $("#KabKota").val(kodeKab);
                <?php endif; ?>
            },
            error: function() {
                alert("Gagal memuat data Kab/Kota");
                $("#KabKota").html('<option value="">Pilih Kab/Kota</option>').prop('disabled', false);
            }
        });
    });

    <?php if (!empty($KodeWilayah)): ?>
        var kodeProv = "<?= substr($KodeWilayah, 0, 2) ?>";
        $("#Provinsi").val(kodeProv).trigger('change');
    <?php endif; ?>

    // Filter button click
    $("#Filter").click(function() {
        var provinsi = $("#Provinsi").val();
        var kabkota = $("#KabKota").val();

        if (provinsi === "") {
            alert("Mohon pilih Provinsi terlebih dahulu");
            $("#Provinsi").focus();
            return;
        }

        if (kabkota === "") {
            alert("Mohon pilih Kabupaten/Kota terlebih dahulu");
            $("#KabKota").focus();
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');

        $.ajax({
            url: BaseURL + "Daerah/SetTempKodeWilayah",
            type: "POST",
            data: { KodeWilayah: kabkota },
            success: function(res) {
                if (res === '1') {
                    window.location.reload();
                } else {
                    alert(res || "Gagal menyimpan filter wilayah!");
                    $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan');
                }
            },
            error: function() {
                alert("Gagal menghubungi server!");
                $btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan');
            }
        });
    });

    // Modal close handlers
    $("#modalClose, #modalOverlay").click(function(e) {
        if (e.target === this) {
            $("#modalOverlay").fadeOut(200);
        }
    });

    // Close modal with ESC key
    $(document).keydown(function(e) {
        if (e.key === "Escape" && $("#modalOverlay").is(":visible")) {
            $("#modalOverlay").fadeOut(200);
        }
    });
});
</script>

<script>
(function () {
    // Ambil data dari PHP
    const chartData = <?= $ChartData ?? 'null' ?>;
    const totalData = <?= json_encode($TotalData ?? []) ?>;

    const container = document.getElementById('chart-container');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const zoomBadge = document.getElementById('zoom-badge');

    // Helper functions
    function safe(v, fb = '—') {
        if (!v || String(v).trim() === '' || v === 'null') return fb;
        return String(v).trim();
    }

    function truncate(str, len = 60) {
        if (!str) return '—';
        str = String(str);
        if (str.length <= len) return str;
        return str.substr(0, len) + '...';
    }

    function formatIndikator(ind) {
        if (!ind) return [];
        if (typeof ind === 'string') {
            return ind.split('|||').filter(i => i && i.trim() !== '');
        }
        return [];
    }

    // Fungsi untuk mendapatkan path ke atas (higher level links)
    function getHigherLevelLinks(node) {
        const links = [];
        let currentNode = node.parent;
        
        while (currentNode && currentNode.data && currentNode.data.nama !== 'ROOT') {
            links.push({
                level: currentNode.data.level,
                nama: currentNode.data.nama,
                id: currentNode.data.id,
                color: LEVELS[currentNode.data.level]?.fill || '#94a3b8',
                original_id: currentNode.data.original_id
            });
            currentNode = currentNode.parent;
        }
        
        return links;
    }

    // Fungsi untuk menampilkan modal dengan data node
    function showNodeDetails(nodeData, level) {
        const lv = LEVELS[level];
        const levelName = lv ? lv.label : 'Level ' + level;
        const levelColor = lv ? lv.fill : '#94a3b8';
        
        // Format indikator
        const indikatorList = formatIndikator(nodeData.indikator);
        
        // Format crosscutting
        const crosscuttingList = nodeData.crosscutting_array || [];
        
        // Format inovasi
        const inovasiList = nodeData.inovasi ? String(nodeData.inovasi).split('|||').filter(i => i.trim()) : [];
        const outcomeInovasiList = nodeData.outcome_inovasi ? String(nodeData.outcome_inovasi).split('|||').filter(o => o.trim()) : [];
        const outputInovasiList = nodeData.output_inovasi ? String(nodeData.output_inovasi).split('|||').filter(o => o.trim()) : [];
        
        // Dapatkan tautan kinerja yang lebih tinggi
        const higherLinks = getHigherLevelLinks({ parent: { data: nodeData.parent } }); // Ini perlu disesuaikan
        
        // Ambil detail pelaksana
        const pelaksanaDetail = nodeData.pelaksana_detail;
        
        // Set modal title
        modalTitle.innerHTML = `${levelName}`;
        document.querySelector('.pk-modal').style.borderLeftColor = levelColor;
        
        // Mulai membangun konten modal
        let modalHtml = '';
        
        // ===== TAUTAN KINERJA YANG LEBIH TINGGI =====
        if (higherLinks.length > 0) {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-link"></i> Tautan Kinerja yang Lebih Tinggi
                    </div>
            `;
            
            higherLinks.forEach(link => {
                modalHtml += `
                    <div class="higher-link-modal-item" style="border-left-color: ${link.color};">
                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                            <i class="fa ${LEVELS[link.level]?.icon || 'fa-sitemap'}" style="color: ${link.color};"></i>
                            <span style="font-size:11px; font-weight:600; color:${link.color};">${LEVELS[link.level]?.label || 'Level ' + link.level}</span>
                        </div>
                        <div style="font-size:13px; margin-left:6px;">${link.nama}</div>
                    </div>
                `;
            });
            
            modalHtml += `</div>`;
        }
        
        // ===== KINERJA =====
        modalHtml += `
            <div class="modal-section">
                <div class="modal-label">
                    <i class="fa fa-tag"></i> Kinerja
                </div>
                <div class="modal-value">${nodeData.nama}</div>
            </div>
        `;
        
        // ===== INDIKATOR KINERJA =====
        if (indikatorList.length > 0) {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-list-check"></i> Indikator Kinerja
                    </div>
                    <ul class="indikator-list">
            `;
            
            indikatorList.forEach(ind => {
                modalHtml += `<li><i class="fa fa-circle" style="color:${levelColor}; font-size:8px;"></i> ${ind}</li>`;
            });
            
            modalHtml += `</ul></div>`;
        }
        
        // ===== PELAKSANA / URUSAN DENGAN DETAIL =====
        if (pelaksanaDetail) {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-users"></i> Pelaksana
                    </div>
                    <div class="pelaksana-card">
                        <div class="pelaksana-avatar">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="pelaksana-info">
                            <h4>${pelaksanaDetail.nama}</h4>
                            ${pelaksanaDetail.nip ? `<p><i class="fa fa-id-card"></i> NIP: ${pelaksanaDetail.nip}</p>` : ''}
                            ${pelaksanaDetail.jabatan ? `<p><i class="fa fa-briefcase"></i> ${pelaksanaDetail.jabatan}</p>` : ''}
                            ${pelaksanaDetail.dinas && pelaksanaDetail.dinas !== '-' ? `<p><i class="fa fa-building"></i> ${pelaksanaDetail.dinas}</p>` : ''}
                        </div>
                    </div>
                </div>
            `;
        } else if (nodeData.pelaksana && nodeData.pelaksana !== 'null' && nodeData.pelaksana !== '') {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-users"></i> Pelaksana / Urusan
                    </div>
                    <div class="modal-value">${nodeData.pelaksana}</div>
                </div>
            `;
        }
        
        // ===== INOVASI DAERAH =====
        if (inovasiList.length > 0 || outcomeInovasiList.length > 0 || outputInovasiList.length > 0) {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-lightbulb"></i> Inovasi Daerah
                    </div>
                    <div class="inovasi-grid">
            `;
            
            if (inovasiList.length > 0) {
                modalHtml += `
                    <div class="inovasi-item">
                        <div class="label"><i class="fa fa-star" style="color:#eab308;"></i> Inovasi</div>
                        <div class="value">
                `;
                inovasiList.forEach(inv => {
                    modalHtml += `<div style="margin-bottom:4px;">• ${inv}</div>`;
                });
                modalHtml += `</div></div>`;
            }
            
            if (outcomeInovasiList.length > 0) {
                modalHtml += `
                    <div class="inovasi-item">
                        <div class="label"><i class="fa fa-chart-line" style="color:#3b82f6;"></i> Outcome Inovasi</div>
                        <div class="value">
                `;
                outcomeInovasiList.forEach(out => {
                    modalHtml += `<div style="margin-bottom:4px;">• ${out}</div>`;
                });
                modalHtml += `</div></div>`;
            }
            
            if (outputInovasiList.length > 0) {
                modalHtml += `
                    <div class="inovasi-item">
                        <div class="label"><i class="fa fa-check-circle" style="color:#10b981;"></i> Output Inovasi</div>
                        <div class="value">
                `;
                outputInovasiList.forEach(out => {
                    modalHtml += `<div style="margin-bottom:4px;">• ${out}</div>`;
                });
                modalHtml += `</div></div>`;
            }
            
            modalHtml += `</div></div>`;
        }
        
        // ===== CROSSCUTTING =====
        if (crosscuttingList.length > 0) {
            modalHtml += `
                <div class="modal-section">
                    <div class="modal-label">
                        <i class="fa fa-share-alt"></i> Crosscutting
                    </div>
                    <table class="crosscutting-modal-table">
                        <thead>
                            <tr>
                                <th>PD/Lembaga</th>
                                <th>Pohon Kinerja</th>
                                <th>Informasi Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            
            crosscuttingList.forEach(cc => {
                modalHtml += `
                    <tr>
                        <td>${cc.pd || '—'}</td>
                        <td>${cc.pohon || '—'}</td>
                        <td>${cc.info || '—'}</td>
                    </tr>
                `;
            });
            
            modalHtml += `</tbody></table></div>`;
        }
        
        // ===== ID =====
        modalHtml += `
            <div class="id-footer">
                <span><i class="fa fa-hashtag"></i> ID: ${nodeData.original_id || nodeData.id}</span>
                <span><i class="fa fa-layer-group"></i> Level ${level}</span>
            </div>
        `;
        
        modalBody.innerHTML = modalHtml;
        modalOverlay.style.display = 'flex';
    }

    // Cek data kosong
    if (!chartData || !chartData.children || chartData.children.length === 0) {
        document.getElementById('chart-svg').style.display = 'none';
        
        let emptyHtml = `
            <div class="pk-empty">
                <i class="fa fa-diagram-project"></i>
                <p>Tidak ada data Pohon Kinerja untuk wilayah ini.</p>
        `;
        
        if (totalData.level1 > 0 || totalData.level2 > 0 || totalData.level3 > 0 || totalData.level4 > 0 || totalData.level5 > 0) {
            emptyHtml += `
                <div class="stats-card" style="margin-top:16px;">
                    <div class="stat-item">
                        <div class="stat-dot" style="background:var(--l1)"></div>
                        <span class="stat-value">${totalData.level1 || 0}</span>
                        <span class="stat-label">Ultimate</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-dot" style="background:var(--l2)"></div>
                        <span class="stat-value">${totalData.level2 || 0}</span>
                        <span class="stat-label">Sektor</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-dot" style="background:var(--l3)"></div>
                        <span class="stat-value">${totalData.level3 || 0}</span>
                        <span class="stat-label">Taktikal</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-dot" style="background:var(--l4)"></div>
                        <span class="stat-value">${totalData.level4 || 0}</span>
                        <span class="stat-label">Immediate</span>
                    </div>
                    <div class="stat-item">
                        <div class="stat-dot" style="background:var(--l5)"></div>
                        <span class="stat-value">${totalData.level5 || 0}</span>
                        <span class="stat-label">Output</span>
                    </div>
                </div>
            `;
        } else {
            emptyHtml += `<p style="margin-top:8px;">Silahkan pilih wilayah terlebih dahulu.</p>`;
        }
        
        emptyHtml += `</div>`;
        container.insertAdjacentHTML('beforeend', emptyHtml);
        return;
    }

    // Level configuration for 5 levels
    const LEVELS = {
        1: { 
            label: 'ULTIMATE OUTCOME',       
            fill: '#1e40af', 
            light: '#dbeafe', 
            text: '#fff',    
            badge: '#60a5fa',
            icon: 'fa-crown'
        },
        2: { 
            label: 'INTERMEDIATE SEKTOR',   
            fill: '#0369a1', 
            light: '#e0f2fe', 
            text: '#fff',    
            badge: '#38bdf8',
            icon: 'fa-chart-line'
        },
        3: { 
            label: 'INTERMEDIATE TAKTIKAL',  
            fill: '#b45309', 
            light: '#fef3c7', 
            text: '#fff',    
            badge: '#fbbf24',
            icon: 'fa-gear'
        },
        4: { 
            label: 'IMMEDIATE OUTCOME',      
            fill: '#c2410c', 
            light: '#ffedd5', 
            text: '#fff',    
            badge: '#fb923c',
            icon: 'fa-bolt'
        },
        5: { 
            label: 'OUTPUT',                  
            fill: '#6d28d9', 
            light: '#ede9fe', 
            text: '#fff',    
            badge: '#a78bfa',
            icon: 'fa-check-circle'
        },
    };

    // D3 Setup
    const svg = d3.select('#chart-svg');
    svg.selectAll('*').remove();

    const W = container.clientWidth || 1200;
    const H = container.clientHeight || 700;

    svg.attr('width', W).attr('height', H);

    // Node dimensions
    const NODE_WIDTH = 280;
    const NODE_HEIGHT = 120;
    const NODE_RADIUS = 16;
    const LEVEL_HEIGHT = 180;
    const HORIZONTAL_SPACING = 320;

    // Build hierarchy
    const root = d3.hierarchy(chartData, d => d.children);

    // Calculate tree layout manually
    function calculateTreeLayout(node, level = 0, x = 0, positions = new Map()) {
        if (!node) return;
        
        positions.set(node, {
            x: x,
            y: level * LEVEL_HEIGHT + 60,
            level: level
        });
        
        if (!node.children || node.children.length === 0) return;
        
        const totalChildrenWidth = (node.children.length - 1) * HORIZONTAL_SPACING;
        let startX = x - totalChildrenWidth / 2;
        
        node.children.forEach((child, index) => {
            const childX = startX + (index * HORIZONTAL_SPACING);
            calculateTreeLayout(child, level + 1, childX, positions);
        });
        
        return positions;
    }

    // Calculate positions
    const positions = calculateTreeLayout(root, 0, 0);

    // Convert to arrays for D3
    const nodes = [];
    const links = [];

    positions.forEach((pos, node) => {
        if (node.data.nama !== 'ROOT') {
            nodes.push({
                ...node,
                x: pos.x,
                y: pos.y,
                level: pos.level
            });
        }
    });

    // Create links
    positions.forEach((pos, node) => {
        if (node.parent && node.parent.data.nama !== 'ROOT') {
            const sourcePos = positions.get(node.parent);
            const targetPos = pos;
            
            links.push({
                source: sourcePos,
                target: targetPos,
                sourceNode: node.parent,
                targetNode: node
            });
        }
    });

    // Store original transform for reset
    let originalTransform = null;

    // Setup zoom
    let currentScale = 1;
    const zoom = d3.zoom()
        .scaleExtent([0.2, 3])
        .on('zoom', e => {
            g.attr('transform', e.transform);
            currentScale = e.transform.k;
            zoomBadge.textContent = Math.round(currentScale * 100) + '%';
        });

    svg.call(zoom);

    const g = svg.append('g');

    // Defs for gradients and shadow
    const defs = svg.append('defs');

    // Shadow filter
    const filter = defs.append('filter')
        .attr('id', 'shadow')
        .attr('x', '-20%')
        .attr('y', '-20%')
        .attr('width', '140%')
        .attr('height', '140%');

    filter.append('feDropShadow')
        .attr('dx', 0)
        .attr('dy', 4)
        .attr('stdDeviation', 6)
        .attr('flood-color', 'rgba(0,0,0,0.15)');

    // Gradients per level
    Object.entries(LEVELS).forEach(([lv, cfg]) => {
        const grad = defs.append('linearGradient')
            .attr('id', `grad-${lv}`)
            .attr('x1', '0%')
            .attr('y1', '0%')
            .attr('x2', '100%')
            .attr('y2', '100%');
        
        grad.append('stop')
            .attr('offset', '0%')
            .attr('stop-color', cfg.fill);
        
        grad.append('stop')
            .attr('offset', '100%')
            .attr('stop-color', d3.color(cfg.fill).brighter(0.5));
    });

    // Draw links
    links.forEach(link => {
        const sourceX = link.source.x;
        const sourceY = link.source.y + NODE_HEIGHT;
        const targetX = link.target.x;
        const targetY = link.target.y;
        const level = link.targetNode.data.level;
        const strokeColor = LEVELS[level]?.fill || '#94a3b8';
        
        const siblings = links.filter(l => 
            l.sourceNode === link.sourceNode && 
            l.targetNode !== link.targetNode
        );
        
        if (siblings.length > 0) {
            // Draw vertical line from parent
            g.append('line')
                .attr('x1', sourceX)
                .attr('y1', sourceY)
                .attr('x2', sourceX)
                .attr('y2', sourceY + 20)
                .attr('stroke', strokeColor)
                .attr('stroke-width', 2)
                .attr('stroke-opacity', 0.3);
            
            // Draw horizontal connector line
            const siblingNodes = [link, ...siblings].map(l => l.target);
            const minX = Math.min(...siblingNodes.map(n => n.x));
            const maxX = Math.max(...siblingNodes.map(n => n.x));
            
            g.append('line')
                .attr('x1', minX)
                .attr('y1', sourceY + 20)
                .attr('x2', maxX)
                .attr('y2', sourceY + 20)
                .attr('stroke', strokeColor)
                .attr('stroke-width', 2)
                .attr('stroke-opacity', 0.3);
            
            // Draw vertical line to this child
            g.append('line')
                .attr('x1', targetX)
                .attr('y1', sourceY + 20)
                .attr('x2', targetX)
                .attr('y2', targetY)
                .attr('stroke', strokeColor)
                .attr('stroke-width', 2)
                .attr('stroke-opacity', 0.3);
        } else {
            // Draw simple vertical line for single child
            g.append('line')
                .attr('x1', sourceX)
                .attr('y1', sourceY)
                .attr('x2', targetX)
                .attr('y2', targetY)
                .attr('stroke', strokeColor)
                .attr('stroke-width', 2)
                .attr('stroke-opacity', 0.3);
        }
    });

    // Draw nodes
    const node = g.selectAll('.node')
        .data(nodes)
        .join('g')
        .attr('class', 'node')
        .attr('transform', d => `translate(${d.x - NODE_WIDTH/2}, ${d.y})`)
        .style('cursor', 'pointer');

    // Card background
    node.append('rect')
        .attr('width', NODE_WIDTH)
        .attr('height', NODE_HEIGHT)
        .attr('rx', NODE_RADIUS)
        .attr('ry', NODE_RADIUS)
        .attr('fill', '#ffffff')
        .attr('stroke', d => LEVELS[d.data.level]?.fill || '#94a3b8')
        .attr('stroke-width', 2)
        .attr('filter', 'url(#shadow)');

    // Top colored band
    node.append('rect')
        .attr('width', NODE_WIDTH)
        .attr('height', 32)
        .attr('rx', NODE_RADIUS)
        .attr('ry', NODE_RADIUS)
        .attr('fill', d => `url(#grad-${d.data.level})`);

    // Level label
    node.append('text')
        .attr('x', NODE_WIDTH / 2)
        .attr('y', 20)
        .attr('text-anchor', 'middle')
        .attr('fill', '#ffffff')
        .attr('font-size', '10px')
        .attr('font-weight', '700')
        .attr('letter-spacing', '1px')
        .attr('text-transform', 'uppercase')
        .text(d => LEVELS[d.data.level]?.label || '');

    // Level badge
    node.append('circle')
        .attr('cx', 25)
        .attr('cy', 16)
        .attr('r', 10)
        .attr('fill', d => LEVELS[d.data.level]?.badge || '#94a3b8')
        .attr('stroke', '#ffffff')
        .attr('stroke-width', 2);

    node.append('text')
        .attr('x', 25)
        .attr('y', 20)
        .attr('text-anchor', 'middle')
        .attr('fill', '#ffffff')
        .attr('font-size', '10px')
        .attr('font-weight', '800')
        .text(d => d.data.level);

    // Node content with text wrapping
    node.each(function(d) {
        const el = d3.select(this);
        const words = d.data.nama.split(' ');
        const maxWidth = NODE_WIDTH - 40;
        const lineHeight = 18;
        const startY = 45;
        const maxLines = 4;

        let lines = [];
        let currentLine = '';
        
        const temp = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        temp.setAttribute('font-size', '12');
        temp.setAttribute('font-family', 'Segoe UI, system-ui, sans-serif');
        svg.node().appendChild(temp);

        words.forEach(word => {
            const testLine = currentLine ? currentLine + ' ' + word : word;
            temp.textContent = testLine;
            
            if (temp.getComputedTextLength() > maxWidth && currentLine) {
                lines.push(currentLine);
                currentLine = word;
            } else {
                currentLine = testLine;
            }
        });
        
        if (currentLine) lines.push(currentLine);
        svg.node().removeChild(temp);

        if (lines.length > maxLines) {
            lines = lines.slice(0, maxLines);
            lines[lines.length-1] = lines[lines.length-1].substring(0, 25) + '...';
        }

        const totalHeight = lines.length * lineHeight;
        const yStart = startY + (NODE_HEIGHT - 32 - totalHeight) / 2;

        lines.forEach((line, i) => {
            el.append('text')
                .attr('x', NODE_WIDTH / 2)
                .attr('y', yStart + i * lineHeight)
                .attr('text-anchor', 'middle')
                .attr('fill', '#1e293b')
                .attr('font-size', i === 0 ? '13px' : '12px')
                .attr('font-weight', i === 0 ? '600' : '400')
                .text(line);
        });

        // ID kecil di pojok
        el.append('text')
            .attr('x', NODE_WIDTH - 15)
            .attr('y', NODE_HEIGHT - 10)
            .attr('text-anchor', 'end')
            .attr('fill', '#94a3b8')
            .attr('font-size', '8px')
            .attr('font-weight', '500')
            .text(d.data.original_id || d.data.id.split('_')[1] || '');
    });

    // ============================================
    // CLICK HANDLER UNTUK MENAMPILKAN MODAL
    // ============================================
    node.on('click', function(event, d) {
        event.stopPropagation();
        showNodeDetails(d.data, d.data.level);
    });

    // Function to fit view
    function fitView() {
        let minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;
        
        nodes.forEach(node => {
            minX = Math.min(minX, node.x - NODE_WIDTH/2);
            minY = Math.min(minY, node.y);
            maxX = Math.max(maxX, node.x + NODE_WIDTH/2);
            maxY = Math.max(maxY, node.y + NODE_HEIGHT);
        });
        
        const bounds = {
            x: minX,
            y: minY,
            width: maxX - minX,
            height: maxY - minY
        };
        
        const W2 = container.clientWidth;
        const H2 = container.clientHeight;
        const pad = 60;
        
        const scale = Math.min(
            (W2 - pad * 2) / bounds.width, 
            (H2 - pad * 2) / bounds.height, 
            1
        );
        
        const tx = W2 / 2 - (bounds.x + bounds.width / 2) * scale;
        const ty = pad - bounds.y * scale;
        
        const transform = d3.zoomIdentity.translate(tx, ty).scale(scale);
        originalTransform = transform;
        
        svg.call(zoom.transform, transform);
    }

    // Fit view after a short delay
    setTimeout(fitView, 100);

    // Zoom buttons
    document.getElementById('zoomIn').addEventListener('click', () => {
        svg.transition().duration(300).call(zoom.scaleBy, 1.3);
    });

    document.getElementById('zoomOut').addEventListener('click', () => {
        svg.transition().duration(300).call(zoom.scaleBy, 1 / 1.3);
    });

    document.getElementById('btnReset').addEventListener('click', () => {
        if (originalTransform) {
            svg.transition().duration(400).call(zoom.transform, originalTransform);
        } else {
            fitView();
        }
    });

    // Resize handler
    window.addEventListener('resize', () => {
        const newW = container.clientWidth;
        const newH = container.clientHeight;
        svg.attr('width', newW).attr('height', newH);
        fitView();
    });

})();
</script>