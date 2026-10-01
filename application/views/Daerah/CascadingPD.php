<?php $this->load->view('Daerah/sidebar'); ?>
<?php $this->load->view('Daerah/Cssumum'); ?>

<!-- Dependencies -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
/* === DESIGN SYSTEM TOKENS SESUAI CONTOH GAMBAR === */
:root {
    /* 5 Level Colors Sesuai Tampil Pohon Kinerja */
    --l1: #1e40af;        /* Level 1: Ultimate / Tujuan PD - Navy Blue */
    --l1-light: #dbeafe;
    --l1-badge: #60a5fa;

    --l2: #0369a1;        /* Level 2: Intermediate / Sasaran PD - Ocean Blue */
    --l2-light: #e0f2fe;
    --l2-badge: #38bdf8;

    --l3: #0d9488;        /* Level 3: Program PD - Vibrant Teal */
    --l3-light: #ccfbf1;
    --l3-badge: #2dd4bf;

    --l4: #b45309;        /* Level 4: Kegiatan PD - Warm Amber */
    --l4-light: #fef3c7;
    --l4-badge: #fbbf24;

    --l5: #6d28d9;        /* Level 5: Sub Kegiatan PD - Royal Purple */
    --l5-light: #ede9fe;
    --l5-badge: #a78bfa;

    --font-family: 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, Roboto, "Helvetica Neue", Arial, sans-serif;
}

* { box-sizing: border-box; }

.main-content {
    background: #f4f6f9;
    min-height: 100vh;
    padding: 15px;
}

/* === CARD CONTAINER UTAMA === */
.cascading-wrapper {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: calc(100vh - 95px);
    border: 1px solid #e2e8f0;
}

/* === HEADER & TOOLBAR === */
.cascading-header {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    color: #ffffff;
    padding: 14px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    border-bottom: 1px solid #334155;
}

.cascading-header-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cascading-header-title .icon-box {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 10px rgba(59,130,246,0.3);
}

.cascading-header-title h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 0.3px;
    color: #f8fafc;
}

.cascading-header-title p {
    margin: 2px 0 0 0;
    font-size: 12px;
    color: #94a3b8;
}

.cascading-header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.cascading-filter-select {
    background: #1e293b;
    border: 1px solid #475569;
    color: #f8fafc;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    outline: none;
    min-width: 220px;
    max-width: 380px;
    cursor: pointer;
    transition: all 0.2s;
}

.cascading-filter-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.25);
}

.cascading-filter-select option {
    background: #1e293b;
    color: #f8fafc;
    padding: 6px 10px;
}

/* === FILTER BAR (ADMIN / PILIH PD) === */
.cascading-filter-bar {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.cascading-filter-left {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.cascading-filter-bar select, .cascading-filter-bar input {
    height: 34px;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-size: 12px;
    background: #fff;
    color: #334155;
}

.btn-filter-action {
    height: 34px;
    padding: 0 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}

.btn-filter-apply {
    background: #2563eb;
    color: #fff;
}
.btn-filter-apply:hover { background: #1d4ed8; }

.btn-filter-reset {
    background: #e2e8f0;
    color: #475569;
}
.btn-filter-reset:hover { background: #cbd5e1; }

/* === LEGEND SECTION === */
.cascading-legend {
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    padding: 8px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.legend-group {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.legend-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    cursor: default;
    border: 1px solid rgba(0,0,0,0.06);
    transition: transform 0.15s;
}

.legend-badge:hover { transform: translateY(-1px); }

.legend-badge.tujuan { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
.legend-badge.sasaran { background: #f0f9ff; color: #0369a1; border-color: #bae6fd; }
.legend-badge.program { background: #f0fdfa; color: #0f766e; border-color: #99f6e4; }
.legend-badge.kegiatan { background: #fffbeb; color: #b45309; border-color: #fde68a; }
.legend-badge.subkegiatan { background: #f5f3ff; color: #6d28d9; border-color: #ddd6fe; }

.legend-badge .count-pill {
    background: rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 1px 7px;
    font-size: 10px;
    font-weight: 700;
}

.quick-type-switcher {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #475569;
}

.btn-toggle-bulk {
    border: 1px solid #cbd5e1;
    background: #fff;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-toggle-bulk:hover {
    background: #f1f5f9;
}

.btn-toggle-bulk.active-program {
    background: #E8EAF6;
    color: #1A237E;
    border-color: #9FA8DA;
}

.btn-toggle-bulk.active-kegiatan {
    background: #E0F2F1;
    color: #004D40;
    border-color: #80CBC4;
}

/* === CANVAS SVG AREA === */
#chart-canvas-container {
    flex: 1;
    position: relative;
    overflow: hidden;
    background-color: #fafbfc;
    background-image: 
        radial-gradient(#e2e8f0 1px, transparent 1px),
        radial-gradient(#e2e8f0 1px, #fafbfc 1px);
    background-size: 40px 40px;
    background-position: 0 0, 20px 20px;
    cursor: grab;
}

#chart-canvas-container:active { cursor: grabbing; }

#cascading-svg {
    width: 100%;
    height: 100%;
    display: block;
}

/* === CARD D3 STYLING PERSIS SEPERTI DI TAMPIL POHON KINERJA === */
.cascading-card {
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    background: #ffffff;
    border-radius: 14px;
    border: 2px solid #94a3b8;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    user-select: none;
    cursor: pointer;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.cascading-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.14);
}

/* Border warna solid sesuai level pohon kinerja */
.cascading-card.tujuan_pd { border-color: var(--l1); }
.cascading-card.sasaran_pd { border-color: var(--l2); }
.cascading-card.program_pd { border-color: var(--l3); }
.cascading-card.kegiatan_pd { border-color: var(--l4); }
.cascading-card.sub_kegiatan_pd { border-color: var(--l5); }

/* Header Banner Terpadu (Menyatu di bagian atas kartu) */
.node-header-banner {
    color: #ffffff;
    height: 32px;
    min-height: 32px;
    padding: 0 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.node-header-banner.tujuan {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
}

.node-header-banner.sasaran {
    background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
}

.node-header-banner.program {
    background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
}

.node-header-banner.kegiatan {
    background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
}

.node-header-banner.subkegiatan {
    background: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%);
}

/* Lingkaran Nomor Level di Kiri Header (Sesuai Tampil Pohon Kinerja) */
.header-level-badge {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 800;
    color: #ffffff;
    flex-shrink: 0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.node-header-banner.tujuan .header-level-badge { background: var(--l1-badge); }
.node-header-banner.sasaran .header-level-badge { background: var(--l2-badge); }
.node-header-banner.program .header-level-badge { background: var(--l3-badge); }
.node-header-banner.kegiatan .header-level-badge { background: var(--l4-badge); }
.node-header-banner.subkegiatan .header-level-badge { background: var(--l5-badge); }

/* Teks Header di Tengah */
.header-label-text {
    flex: 1;
    text-align: center;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: #ffffff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 6px;
}

.header-action-slot {
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    flex-shrink: 0;
}

/* Body Box Bersih (Menyatu dengan Card, Solid White) */
.node-body-box {
    background: #ffffff;
    padding: 7px 10px 4px 10px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    text-align: center;
    font-size: 11px;
    line-height: 1.35;
    color: #1e293b;
    font-weight: 500;
    overflow: hidden;
    position: relative;
    border: none;
}

.node-card-footer {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding-top: 1px;
}

.node-id-tag {
    font-size: 8.5px;
    color: #94a3b8;
    font-weight: 500;
}

.node-main-text {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    line-height: 1.4;
    font-size: 12px;
    font-weight: 600;
    color: #1e293b;
    word-break: break-word;
    padding: 2px 4px;
}

/* Nomenklatur SIPD Badge Pada Card Diagram */
.node-sipd-badge {
    margin-top: 4px;
    width: 100%;
    padding: 2.5px 6px;
    border-radius: 5px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 9.5px;
    color: #334155;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
    cursor: pointer;
    transition: all 0.15s ease;
}

.node-sipd-badge:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.node-sipd-badge .sipd-pill {
    background: #475569;
    color: #ffffff;
    font-weight: 700;
    font-size: 8.5px;
    padding: 1px 5px;
    border-radius: 4px;
    letter-spacing: 0.2px;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    flex-shrink: 0;
}

.node-body-box.program .node-sipd-badge .sipd-pill {
    background: #0d9488;
}
.node-body-box.kegiatan .node-sipd-badge .sipd-pill {
    background: #b45309;
}
.node-body-box.subkegiatan .node-sipd-badge .sipd-pill {
    background: #6d28d9;
}

.node-sipd-badge .sipd-name {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 600;
    flex: 1;
    color: #334155;
}

.node-sipd-badge.empty {
    background: #fafafa;
    border: 1px dashed #cbd5e1;
    color: #94a3b8;
    justify-content: center;
    font-weight: 500;
    font-size: 9px;
    padding: 2px 4px;
}

.node-sipd-badge.empty:hover {
    background: #f0fdf4;
    color: #166534;
    border-color: #86efac;
}

/* Modal SIPD Styles */
.modal-sipd-section {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    padding: 14px;
    margin-top: 16px;
}

.sipd-result-item {
    padding: 8px 10px;
    border-bottom: 1px solid #f1f5f9;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    user-select: none;
}

.sipd-result-item:last-child {
    border-bottom: none;
}

.sipd-result-item:hover {
    background: #f8fafc;
}

.sipd-result-item.selected {
    background: #ecfdf5 !important;
    border-left: 3px solid #10b981;
}

.sipd-result-item .sipd-item-code {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-weight: 700;
    font-size: 11px;
    color: #1e293b;
    background: #e2e8f0;
    padding: 2px 6px;
    border-radius: 4px;
    white-space: nowrap;
}

.sipd-result-item.selected .sipd-item-code,
.sipd-result-item:hover .sipd-item-code {
    background: #10b981;
    color: #ffffff;
}

.sipd-result-item .sipd-item-title {
    font-size: 12px;
    color: #334155;
    flex: 1;
    line-height: 1.4;
}

.sipd-result-item .btn-choose-sipd {
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 4px;
    background: #3b82f6;
    color: #fff;
    border: none;
    cursor: pointer;
    font-weight: 600;
    white-space: nowrap;
}

.sipd-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 2px 7px;
    background: #ffffff;
    border: 1px solid #86efac;
    border-radius: 4px;
    font-size: 10.5px;
    color: #166534;
    font-weight: 600;
}

.sipd-chip .btn-remove-chip {
    color: #ef4444;
    cursor: pointer;
    font-weight: bold;
    padding-left: 2px;
}

.sipd-chip .btn-remove-chip:hover {
    color: #b91c1c;
}

.sipd-connected-row {
    transition: background 0.15s;
}

.sipd-connected-row:hover {
    background: #f1f5f9 !important;
}

/* Tombol ganti tipe pada immediate (Program vs Kegiatan) */
.btn-node-type-switch {
    background: rgba(255,255,255,0.22);
    border: 1px solid rgba(255,255,255,0.4);
    color: #fff;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    cursor: pointer;
    transition: all 0.2s;
    margin-left: 4px;
}

.btn-node-type-switch:hover {
    background: #ffffff;
    color: #1e293b;
    transform: scale(1.15) rotate(180deg);
}

/* Indicator badge kecil di dalam body */
.node-meta-badge {
    position: absolute;
    bottom: 3px;
    right: 5px;
    font-size: 9px;
    color: #94a3b8;
}

/* === CONNECTOR LINES & TOGGLE CIRCLE === */
.cascading-link {
    fill: none;
    stroke: #b0bec5;
    stroke-width: 2px;
    stroke-linecap: round;
    stroke-linejoin: round;
    transition: stroke 0.2s, stroke-width 0.2s;
}

.cascading-link:hover {
    stroke: #64748b;
    stroke-width: 2.5px;
}

.collapse-toggle-btn {
    cursor: pointer;
    transition: transform 0.15s ease;
}

.collapse-toggle-btn:hover {
    transform: scale(1.25);
}

.collapse-toggle-circle {
    fill: #ffffff;
    stroke: #90a4ae;
    stroke-width: 2px;
    transition: all 0.2s;
}

.collapse-toggle-btn:hover .collapse-toggle-circle {
    fill: #f1f5f9;
    stroke: #3b82f6;
    stroke-width: 2.5px;
}

.collapse-toggle-icon {
    font-family: Arial, sans-serif;
    font-size: 12px;
    font-weight: 700;
    fill: #546e7a;
    text-anchor: middle;
    dominant-baseline: central;
    pointer-events: none;
}

/* === FOOTER CONTROLS === */
.cascading-footer {
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.cascading-footer-info {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}

.cascading-footer-btns {
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-ctrl {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #334155;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.15s;
}

.btn-ctrl:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
    color: #0f172a;
}

.btn-ctrl.btn-primary-ctrl {
    background: #3b82f6;
    color: #fff;
    border-color: #3b82f6;
}

.btn-ctrl.btn-primary-ctrl:hover {
    background: #2563eb;
    border-color: #2563eb;
}

.zoom-indicator {
    padding: 6px 10px;
    background: #f1f5f9;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    color: #475569;
    min-width: 50px;
    text-align: center;
}

/* === DETAIL MODAL === */
.cascading-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.cascading-modal-content {
    background: #ffffff;
    border-radius: 18px;
    width: 100%;
    max-width: 620px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: modalIn 0.25s ease-out;
    border-left: 6px solid #3b82f6;
}

@keyframes modalIn {
    from { opacity: 0; transform: translateY(20px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.cascading-modal-header {
    padding: 16px 22px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cascading-modal-header h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cascading-modal-close {
    background: #f1f5f9;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.2s;
}

.cascading-modal-close:hover {
    background: #fee2e2;
    color: #ef4444;
}

.cascading-modal-body {
    padding: 20px 22px;
    overflow-y: auto;
    font-size: 13px;
    color: #334155;
}

.modal-detail-row {
    margin-bottom: 16px;
}

.modal-detail-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.modal-detail-value {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    line-height: 1.5;
    font-weight: 500;
}

.modal-type-changer {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 10px;
    padding: 12px 14px;
    margin-top: 10px;
}

.modal-type-options {
    display: flex;
    gap: 12px;
    margin-top: 8px;
}

.type-option-label {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 8px;
    border: 2px solid #cbd5e1;
    background: #fff;
    cursor: pointer;
    font-weight: 600;
    font-size: 12px;
    transition: all 0.2s;
}

.type-option-label.selected-program {
    border-color: #0d9488;
    background: #f0fdfa;
    color: #0f766e;
}

.type-option-label.selected-kegiatan {
    border-color: #b45309;
    background: #fffbeb;
    color: #92400e;
}

.empty-state-cascading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #64748b;
    padding: 40px;
    text-align: center;
}

.empty-state-cascading i {
    font-size: 54px;
    color: #cbd5e1;
    margin-bottom: 14px;
}
</style>

<div class="main-content">
    <div class="cascading-wrapper">

        <!-- HEADER SECTION -->
        <div class="cascading-header">
            <div class="cascading-header-title">
                <div class="icon-box">
                    <i class="fa fa-sitemap"></i>
                </div>
                <div>
                    <h4>Cascading Kinerja Perangkat Daerah <?= !empty($NamaInstansi) ? '— ' . html_escape($NamaInstansi) : '' ?></h4>
                    <p>Hierarki Cascading Hasil Pohon Kinerja: Tujuan PD &rarr; Sasaran PD &rarr; Program / Kegiatan PD &rarr; Sub Kegiatan PD</p>
                </div>
            </div>

            <div class="cascading-header-actions">
                <!-- Dropdown Pilih Tujuan PD -->
                <div style="display:flex; align-items:center; gap:8px;">
                    <label style="margin:0; font-size:12px; color:#cbd5e1; font-weight:600;"><i class="fa fa-bullseye"></i> Tujuan PD:</label>
                    <select id="select-tujuan-filter" class="cascading-filter-select">
                        <option value="">-- Tampilkan Semua Tujuan PD --</option>
                        <?php if (!empty($UltimateList)): ?>
                            <?php foreach ($UltimateList as $u): ?>
                                <option value="tujuan_<?= $u['id'] ?>" <?= (!empty($FilterUltimateId) && ($FilterUltimateId == $u['id'] || $FilterUltimateId == 'tujuan_' . $u['id'])) ? 'selected' : '' ?>>
                                    <?= html_escape(mb_strimwidth($u['nama'], 0, 50, '...')) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Input Cari Node -->
                <div style="position:relative;">
                    <input type="text" id="input-search-node" placeholder="Cari nama kinerja..." style="background:#1e293b; border:1px solid #475569; color:#f8fafc; padding:6px 28px 6px 10px; border-radius:8px; font-size:12px; width:180px;">
                    <i class="fa fa-search" style="position:absolute; right:10px; top:9px; color:#94a3b8; font-size:11px;"></i>
                </div>
            </div>
        </div>

        <!-- FILTER BAR (Untuk Non Role 4 / Admin / Ganti Instansi) -->
        <?php if (!$IsRole4 && !empty($KodeWilayah)): ?>
        <div class="cascading-filter-bar">
            <div class="cascading-filter-left">
                <label style="font-size:12px; font-weight:600; color:#475569; margin:0;"><i class="fa fa-building"></i> Filter Instansi / Perangkat Daerah:</label>
                <select id="FilterInstansiSelect" style="min-width: 280px;">
                    <option value="">-- Pilih Semua Perangkat Daerah --</option>
                    <?php if (!empty($ListInstansi)): ?>
                        <?php foreach ($ListInstansi as $inst): ?>
                            <option value="<?= $inst['id'] ?>" <?= ($FilterInstansiId == $inst['id']) ? 'selected' : '' ?>>
                                <?= html_escape($inst['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <button type="button" class="btn-filter-action btn-filter-apply" id="btnApplyInstansi">
                    <i class="fa fa-filter"></i> Terapkan
                </button>
                <button type="button" class="btn-filter-action btn-filter-reset" id="btnResetInstansi">
                    <i class="fa fa-refresh"></i> Reset
                </button>
            </div>
            <div>
                <span style="font-size: 11px; color:#64748b;">
                    <i class="fa fa-map-marker-alt text-primary"></i> Wilayah: <strong><?= html_escape($NamaWilayah ?: 'Nasional/Daerah') ?></strong>
                </span>
            </div>
        </div>
        <?php endif; ?>

        <!-- LEGEND & STATS BAR -->
        <div class="cascading-legend">
            <div class="legend-group">
                <span style="font-size:11px; font-weight:700; color:#64748b; margin-right:4px;">LEVEL CASCADING:</span>
                <div class="legend-badge tujuan" title="Level 1: Ultimate Outcome">
                    <i class="fa fa-bullseye"></i> Tujuan PD
                    <span class="count-pill" id="count-tujuan"><?= $TotalData['tujuan'] ?? 0 ?></span>
                </div>
                <div class="legend-badge sasaran" title="Level 2: Intermediate Outcome">
                    <i class="fa fa-crosshairs"></i> Sasaran Perangkat Daerah
                    <span class="count-pill" id="count-sasaran"><?= $TotalData['sasaran'] ?? 0 ?></span>
                </div>
                <div class="legend-badge program" title="Level 3: Immediate Outcome (Sebagai Program)">
                    <i class="fa fa-tasks"></i> Program Perangkat Daerah
                    <span class="count-pill" id="count-program"><?= $TotalData['program'] ?? 0 ?></span>
                </div>
                <div class="legend-badge kegiatan" title="Level 3: Immediate Outcome (Sebagai Kegiatan)">
                    <i class="fa fa-calendar-check"></i> Kegiatan Perangkat Daerah
                    <span class="count-pill" id="count-kegiatan"><?= $TotalData['kegiatan'] ?? 0 ?></span>
                </div>
                <div class="legend-badge subkegiatan" title="Level 4: Output">
                    <i class="fa fa-check-circle"></i> Sub Kegiatan Perangkat Daerah
                    <span class="count-pill" id="count-subkegiatan"><?= $TotalData['sub_kegiatan'] ?? 0 ?></span>
                </div>
            </div>
        </div>

        <!-- CANVAS SVG CHART -->
        <div id="chart-canvas-container">
            <svg id="cascading-svg"></svg>
            <div id="empty-state-view" class="empty-state-cascading" style="display:none;">
                <i class="fa fa-folder-open"></i>
                <h5 style="margin:0 0 6px 0; color:#334155; font-weight:700;">Belum Ada Data Cascading PD</h5>
                <p style="margin:0; max-width:440px; font-size:13px;">Data pohon kinerja perangkat daerah belum tersedia atau belum terinput untuk wilayah / instansi yang dipilih.</p>
            </div>
        </div>

        <!-- FOOTER CONTROLS -->
        <div class="cascading-footer">
            <div class="cascading-footer-info">
                <i class="fa fa-info-circle text-primary"></i>
                <span>Gunakan mouse scroll untuk <strong>Zoom</strong>, drag untuk <strong>Pan</strong>. Klik ikon <strong>+ / -</strong> untuk melipat cabang. Klik <strong>kartu</strong> untuk melihat detail.</span>
            </div>

            <div class="cascading-footer-btns">
                <button class="btn-ctrl" id="btnZoomIn" title="Perbesar"><i class="fa fa-plus"></i></button>
                <button class="btn-ctrl" id="btnZoomOut" title="Perkecil"><i class="fa fa-minus"></i></button>
                <div class="zoom-indicator" id="zoomLevelText">100%</div>
                <button class="btn-ctrl" id="btnZoomFit" title="Pas di Layar"><i class="fa fa-expand"></i> Pas Layar</button>
                <button class="btn-ctrl" id="btnZoomReset" title="Reset Tampilan"><i class="fa fa-refresh"></i> Reset</button>
                <button class="btn-ctrl" id="btnExpandAll" title="Buka Semua Cabang"><i class="fa fa-angle-double-down"></i> Buka Semua</button>
                <button class="btn-ctrl" id="btnCollapseAll" title="Tutup Semua Cabang"><i class="fa fa-angle-double-up"></i> Tutup</button>
                <button class="btn-ctrl btn-primary-ctrl" id="btnExportPNG" title="Download Gambar PNG"><i class="fa fa-download"></i> Ekspor PNG</button>
            </div>
        </div>

    </div>
</div>

<!-- DETAIL & EDIT MODAL POPUP -->
<div class="cascading-modal-overlay" id="cascadingModal">
    <div class="cascading-modal-content" id="cascadingModalContent">
        <div class="cascading-modal-header">
            <h4>
                <span id="modalNodeIcon"><i class="fa fa-info-circle"></i></span>
                <span id="modalNodeTitle">Detail Cascading Kinerja</span>
            </h4>
            <button class="cascading-modal-close" id="modalCloseBtn">&times;</button>
        </div>
        <div class="cascading-modal-body" id="modalNodeBody">
            <!-- Dynamic Content -->
        </div>
    </div>
</div>

<script>
var BaseURL = "<?= base_url() ?>";
var CSRF_NAME = "<?= $this->security->get_csrf_token_name() ?>";
var CSRF_TOKEN = "<?= $this->security->get_csrf_hash() ?>";
var rawChartData = <?= $ChartData ?? '{"nama":"ROOT","children":[]}' ?>;
var currentInstansiId = "<?= $FilterInstansiId ?? $InstansiId ?? '' ?>";
var perangkatDaerahList = <?= json_encode($perangkat_daerah ?? []) ?>;

var pdNameMap = {};
if (Array.isArray(perangkatDaerahList)) {
    perangkatDaerahList.forEach(function(item) {
        pdNameMap[item.id] = item.nama;
    });
}

function resolvePdName(val) {
    if (!val) return '—';
    if (pdNameMap[val]) return pdNameMap[val];
    return val;
}

function formatCrosscutting(pd, ket) {
    if (!pd) return [];
    var pdList = [];
    var ketList = [];

    if (typeof pd === 'string') {
        try {
            pdList = JSON.parse(pd);
        } catch(e) {
            if (pd.trim() !== '') {
                pdList = pd.split(',').map(s => s.trim()).filter(s => s);
            }
        }
    } else if (Array.isArray(pd)) {
        pdList = pd;
    }

    if (typeof ket === 'string') {
        try {
            ketList = JSON.parse(ket);
        } catch(e) {
            if (ket.trim() !== '') {
                ketList = ket.split(',').map(s => s.trim()).filter(s => s);
            }
        }
    } else if (Array.isArray(ket)) {
        ketList = ket;
    }

    if (!Array.isArray(pdList) || pdList.length === 0) return [];

    return pdList.map(function(item, index) {
        var keterangan = (ketList && ketList[index] && ketList[index].trim() !== '') ? ketList[index] : '—';
        return {
            pd: resolvePdName(item),
            ket: keterangan
        };
    });
}

// Inisialisasi Aplikasi Cascading
$(document).ready(function() {

    // Filter Perangkat Daerah
    $("#btnApplyInstansi").click(function() {
        var val = $("#FilterInstansiSelect").val();
        var url = BaseURL + "Instansi/CascadingPD";
        if (val) {
            url += "?instansi_id=" + val;
        }
        window.location.href = url;
    });

    $("#btnResetInstansi").click(function() {
        window.location.href = BaseURL + "Instansi/CascadingPD?reset=1";
    });

    // Close Modal
    $("#modalCloseBtn, #cascadingModal").click(function(e) {
        if (e.target === this) {
            $("#cascadingModal").fadeOut(150);
        }
    });

    $(document).keydown(function(e) {
        if (e.key === "Escape" && $("#cascadingModal").is(":visible")) {
            $("#cascadingModal").fadeOut(150);
        }
    });

    // Dropdown Filter Tujuan PD change
    $("#select-tujuan-filter").on('change', function() {
        var selectedVal = $(this).val();
        applyTujuanFilter(selectedVal);

        try {
            var newUrl = new URL(window.location.href);
            if (selectedVal) {
                newUrl.searchParams.set('ultimate_id', selectedVal);
            } else {
                newUrl.searchParams.delete('ultimate_id');
            }
            window.history.replaceState({}, '', newUrl);
        } catch(e) {}
    });

    // Sinkronisasi otomatis opsi dropdown jika belum terisi dari server
    syncTujuanDropdown();

    // Inisialisasi D3 Tree Engine
    initCascadingTree();
    updateLegendCounts();
});

// ========================================================
// D3.JS ENGINE UNTUK CASCADING PD
// ========================================================
var treeGraph = {
    svg: null,
    g: null,
    zoom: null,
    root: null,
    treeLayout: null,
    nodeWidth: 280,
    nodeHeight: 125,
    levelGapY: 195,
    nodeGapX: 305,
    currentScale: 1,
    activeRootData: null
};

function syncTujuanDropdown() {
    var $select = $("#select-tujuan-filter");
    if (!$select.length) return;

    if ($select.children("option").length <= 1 && rawChartData && Array.isArray(rawChartData.children) && rawChartData.children.length > 0) {
        rawChartData.children.forEach(function(item) {
            var val = item.id || ('tujuan_' + item.original_id);
            var text = item.nama || 'Tujuan PD';
            if (text.length > 65) text = text.substring(0, 62) + '...';
            $select.append($('<option>', {
                value: val,
                text: text
            }));
        });
    }
}

function applyTujuanFilter(selectedId) {
    if (!rawChartData || !rawChartData.children) return;

    if (!selectedId) {
        treeGraph.activeRootData = JSON.parse(JSON.stringify(rawChartData));
    } else {
        var filtered = rawChartData.children.filter(function(c) {
            return c.id === selectedId ||
                   ('tujuan_' + c.original_id) === selectedId ||
                   String(c.original_id) === String(selectedId) ||
                   String(c.id) === String(selectedId);
        });
        treeGraph.activeRootData = JSON.parse(JSON.stringify({
            nama: "ROOT",
            children: filtered
        }));
    }

    if (!treeGraph.activeRootData.children || treeGraph.activeRootData.children.length === 0) {
        $("#cascading-svg").hide();
        $("#empty-state-view").show();
        updateLegendCounts();
    } else {
        $("#empty-state-view").hide();
        $("#cascading-svg").show();
        setupHierarchy(treeGraph.activeRootData);
        updateDiagram(treeGraph.root);
        updateLegendCounts();
        setTimeout(fitToScreen, 150);
    }
}

function initCascadingTree() {
    const container = document.getElementById('chart-canvas-container');
    const width = container.clientWidth || 1200;
    const height = container.clientHeight || 700;

    const svg = d3.select("#cascading-svg")
        .attr("width", width)
        .attr("height", height);

    svg.selectAll("*").remove(); // Bersihkan SVG jika re-render

    treeGraph.svg = svg;

    // Zoom setup
    treeGraph.zoom = d3.zoom()
        .scaleExtent([0.1, 2.5])
        .on("zoom", function(event) {
            treeGraph.g.attr("transform", event.transform);
            treeGraph.currentScale = event.transform.k;
            $("#zoomLevelText").text(Math.round(event.transform.k * 100) + "%");
        });

    svg.call(treeGraph.zoom);

    // Group penampung transformasi
    treeGraph.g = svg.append("g").attr("class", "main-graph-group");

    // Layout
    treeGraph.treeLayout = d3.tree()
        .nodeSize([treeGraph.nodeGapX, treeGraph.levelGapY])
        .separation(function(a, b) {
            return a.parent === b.parent ? 1.08 : 1.18;
        });

    // Check if data is available
    if (!rawChartData || !rawChartData.children || rawChartData.children.length === 0) {
        $("#empty-state-view").show();
        $("#cascading-svg").hide();
        return;
    }

    $("#empty-state-view").hide();
    $("#cascading-svg").show();

    var initialTujuan = $("#select-tujuan-filter").val();
    if (initialTujuan) {
        var filtered = rawChartData.children.filter(function(c) {
            return c.id === initialTujuan ||
                   ('tujuan_' + c.original_id) === initialTujuan ||
                   String(c.original_id) === String(initialTujuan) ||
                   String(c.id) === String(initialTujuan);
        });
        treeGraph.activeRootData = JSON.parse(JSON.stringify({
            nama: "ROOT",
            children: filtered
        }));
    } else {
        treeGraph.activeRootData = JSON.parse(JSON.stringify(rawChartData));
    }

    // Setup hierarchy
    setupHierarchy(treeGraph.activeRootData);

    // Initial render
    updateDiagram(treeGraph.root);

    // Center and fit
    setTimeout(fitToScreen, 150);

    // Search filter
    $("#input-search-node").on('input', function() {
        var term = $(this).val().toLowerCase().trim();
        if (!term) {
            d3.selectAll(".cascading-card").style("opacity", 1);
            return;
        }
        d3.selectAll(".cascading-card").each(function(d) {
            var el = d3.select(this);
            var text = (d.data.nama || "").toLowerCase();
            if (text.includes(term)) {
                el.style("opacity", 1).style("transform", "scale(1.05)");
            } else {
                el.style("opacity", 0.25).style("transform", "scale(1)");
            }
        });
    });

    // Toolbar event listeners
    $("#btnZoomIn").click(function() {
        treeGraph.svg.transition().duration(250).call(treeGraph.zoom.scaleBy, 1.25);
    });

    $("#btnZoomOut").click(function() {
        treeGraph.svg.transition().duration(250).call(treeGraph.zoom.scaleBy, 0.8);
    });

    $("#btnZoomReset").click(function() {
        treeGraph.svg.transition().duration(300).call(
            treeGraph.zoom.transform,
            d3.zoomIdentity.translate(width / 2, 80).scale(1)
        );
    });

    $("#btnZoomFit").click(fitToScreen);

    $("#btnExpandAll").click(function() {
        expandAllNodes(treeGraph.root);
        updateDiagram(treeGraph.root);
        setTimeout(fitToScreen, 150);
    });

    $("#btnCollapseAll").click(function() {
        collapseAllNodes(treeGraph.root);
        updateDiagram(treeGraph.root);
        setTimeout(fitToScreen, 150);
    });

    $("#btnExportPNG").click(exportAsPNG);
}

function setupHierarchy(data) {
    treeGraph.root = d3.hierarchy(data, function(d) {
        return d.children;
    });

    // Simpan koordinat awal
    treeGraph.root.x0 = 0;
    treeGraph.root.y0 = 0;

    // Default: Semua expanded
    // Set level properties
    treeGraph.root.descendants().forEach(function(d) {
        if (d.data.children) {
            d._children = null; // Menyimpan anak saat collapsed
        }
    });
}

function updateDiagram(source) {
    const treeData = treeGraph.treeLayout(treeGraph.root);
    const nodes = treeData.descendants().filter(function(d) { return d.data.nama !== 'ROOT'; });
    const links = treeData.links().filter(function(d) { return d.source.data.nama !== 'ROOT'; });

    // Set posisi Y berdasarkan level kedalaman (Tier 1 s.d Tier 5)
    nodes.forEach(function(d) {
        var nodeLevel = d.data.level ? d.data.level : d.depth;
        d.y = (nodeLevel - 1) * treeGraph.levelGapY + 40;
    });

    // ============================================
    // 1. RENDER LINKS (GARIS KONEKTOR ORTHOGONAL)
    // ============================================
    const linkGroup = treeGraph.g.selectAll("g.link-group")
        .data([0])
        .join("g")
        .attr("class", "link-group");

    // Parent group untuk garis orthogonal
    const parentMap = new Map();
    links.forEach(function(l) {
        if (!parentMap.has(l.source)) {
            parentMap.set(l.source, []);
        }
        parentMap.get(l.source).push(l.target);
    });

    const linkPaths = [];
    parentMap.forEach(function(children, parent) {
        const pX = parent.x;
        const pY = parent.y + treeGraph.nodeHeight;
        const childMinY = Math.min(...children.map(c => c.y));
        const midY = pY + (childMinY - pY) / 2;

        if (children.length === 1) {
            const cX = children[0].x;
            const cY = children[0].y;
            if (Math.abs(pX - cX) < 1) {
                linkPaths.push(`M ${pX},${pY} V ${cY}`);
            } else {
                linkPaths.push(`M ${pX},${pY} V ${midY} H ${cX} V ${cY}`);
            }
        } else {
            const childXs = children.map(function(c) { return c.x; });
            const minX = Math.min(pX, ...childXs);
            const maxX = Math.max(pX, ...childXs);

            // Batang vertikal dari parent ke titik belok midY
            linkPaths.push(`M ${pX},${pY} V ${midY}`);
            // Batang horizontal membentang ke seluruh anak
            linkPaths.push(`M ${minX},${midY} H ${maxX}`);
            // Batang vertikal turun ke masing-masing anak
            children.forEach(function(c) {
                linkPaths.push(`M ${c.x},${midY} V ${c.y}`);
            });
        }
    });

    const link = linkGroup.selectAll("path.cascading-link")
        .data(linkPaths)
        .join(
            function(enter) {
                return enter.append("path")
                    .attr("class", "cascading-link")
                    .attr("d", function(d) { return d; });
            },
            function(update) {
                return update.transition().duration(250).attr("d", function(d) { return d; });
            },
            function(exit) {
                return exit.remove();
            }
        );

    // ============================================
    // 2. RENDER TOGGLE CIRCLE (+ / -) PADA CABANG
    // ============================================
    const toggleGroup = treeGraph.g.selectAll("g.toggle-group")
        .data([0])
        .join("g")
        .attr("class", "toggle-group");

    // Parent yang punya anak atau collapsed anak
    const expandableNodes = nodes.filter(function(d) {
        return (d.children && d.children.length > 0) || (d._children && d._children.length > 0);
    });

    const toggleBtns = toggleGroup.selectAll("g.collapse-toggle-btn")
        .data(expandableNodes, function(d) { return d.data.id; });

    const toggleEnter = toggleBtns.enter().append("g")
        .attr("class", "collapse-toggle-btn")
        .attr("transform", function(d) {
            return `translate(${d.x}, ${d.y + treeGraph.nodeHeight + 14})`;
        })
        .on("click", function(event, d) {
            event.stopPropagation();
            toggleNodeCollapse(d);
        });

    toggleEnter.append("circle")
        .attr("class", "collapse-toggle-circle")
        .attr("r", 9);

    toggleEnter.append("text")
        .attr("class", "collapse-toggle-icon")
        .attr("y", -0.5)
        .text(function(d) { return d._children ? "+" : "−"; });

    const toggleMerged = toggleBtns.merge(toggleEnter);
    toggleMerged.select(".collapse-toggle-icon")
        .text(function(d) { return d._children ? "+" : "−"; });
    toggleMerged
        .transition().duration(250)
        .attr("transform", function(d) {
            return `translate(${d.x}, ${d.y + treeGraph.nodeHeight + 14})`;
        });

    toggleBtns.exit().remove();

    // ============================================
    // 3. RENDER NODES (HTML CARDS DENGAN FOREIGNOBJECT)
    // ============================================
    const nodeGroup = treeGraph.g.selectAll("g.nodes-group")
        .data([0])
        .join("g")
        .attr("class", "nodes-group");

    const node = nodeGroup.selectAll("g.cascading-node")
        .data(nodes, function(d) { return d.data.id; });

    const nodeEnter = node.enter().append("g")
        .attr("class", "cascading-node")
        .attr("transform", function(d) {
            return `translate(${d.x - treeGraph.nodeWidth / 2}, ${d.y})`;
        });

    const fo = nodeEnter.append("foreignObject")
        .attr("width", treeGraph.nodeWidth)
        .attr("height", treeGraph.nodeHeight)
        .style("overflow", "visible");

    fo.append("xhtml:div")
        .attr("class", function(d) { return `cascading-card ${d.data.tipe}`; })
        .html(function(d) {
            return generateCardHtml(d.data);
        })
        .on("click", function(event, d) {
            // Jika tombol switch diklik, jangan buka modal
            if (event.target.closest('.btn-node-type-switch')) {
                event.stopPropagation();
                toggleSingleImmediateType(d);
                return;
            }
            openNodeModal(d);
        });

    // Update existing and new nodes (DOM content updated on selection, transform on transition)
    const nodeMerged = node.merge(nodeEnter);
    nodeMerged.select(".cascading-card")
        .attr("class", function(d) { return `cascading-card ${d.data.tipe}`; })
        .html(function(d) {
            return generateCardHtml(d.data);
        });

    nodeMerged
        .transition().duration(250)
        .attr("transform", function(d) {
            return `translate(${d.x - treeGraph.nodeWidth / 2}, ${d.y})`;
        });

    node.exit().remove();
}

// Helper parsing multi Nomenklatur SIPD (Kode & Nama)
function parseSipdItems(kodeStr, namaStr) {
    if (!kodeStr) return [];
    var kodes = [];
    if (typeof kodeStr === 'string' && kodeStr.indexOf('|||') !== -1) {
        kodes = kodeStr.split('|||').map(function(s) { return s.trim(); }).filter(function(s) { return s.length > 0; });
    } else if (Array.isArray(kodeStr)) {
        kodes = kodeStr;
    } else {
        var str = String(kodeStr).trim();
        if (str && str !== 'null') kodes = [str];
    }

    var namas = [];
    if (typeof namaStr === 'string' && namaStr.indexOf('|||') !== -1) {
        namas = namaStr.split('|||').map(function(s) { return s.trim(); }).filter(function(s) { return s.length > 0; });
    } else if (Array.isArray(namaStr)) {
        namas = namaStr;
    } else {
        var strN = String(namaStr || '').trim();
        if (strN && strN !== 'null') namas = [strN];
    }

    var items = [];
    for (var i = 0; i < kodes.length; i++) {
        items.push({
            kode: kodes[i],
            nama: namas[i] || kodes[i]
        });
    }
    return items;
}

// Generate Card HTML Sesuai Tampil Pohon Kinerja
function generateCardHtml(data) {
    var tipeClass = '';
    var headerLabel = '';
    var levelNumber = '1';
    var showSwitchBtn = false;

    if (data.tipe === 'tujuan_pd') {
        tipeClass = 'tujuan';
        headerLabel = 'TUJUAN PERANGKAT DAERAH';
        levelNumber = '1';
    } else if (data.tipe === 'sasaran_pd') {
        tipeClass = 'sasaran';
        headerLabel = 'SASARAN PERANGKAT DAERAH';
        levelNumber = '2';
    } else if (data.tipe === 'program_pd') {
        tipeClass = 'program';
        headerLabel = 'PROGRAM PERANGKAT DAERAH';
        levelNumber = '3';
        showSwitchBtn = true;
    } else if (data.tipe === 'kegiatan_pd') {
        tipeClass = 'kegiatan';
        headerLabel = 'KEGIATAN PERANGKAT DAERAH';
        levelNumber = '4';
        showSwitchBtn = true;
    } else if (data.tipe === 'sub_kegiatan_pd') {
        tipeClass = 'subkegiatan';
        headerLabel = 'SUB KEGIATAN PERANGKAT DAERAH';
        levelNumber = '5';
    }

    var cleanNama = escapeHtml(data.nama || '—');

    var switchBtnHtml = '';
    if (showSwitchBtn && data.original_id) {
        var nextType = (data.cascading_type === 'kegiatan') ? 'Program' : 'Kegiatan';
        switchBtnHtml = `<button type="button" class="btn-node-type-switch" title="Ubah menjadi ${nextType} PD"><i class="fa fa-sync-alt"></i></button>`;
    }

    var idTag = data.original_id ? `<span class="node-id-tag">#${escapeHtml(data.original_id)}</span>` : '';

    return `
        <div class="node-header-banner ${tipeClass}">
            <div class="header-level-badge">${levelNumber}</div>
            <span class="header-label-text">${headerLabel}</span>
            <div class="header-action-slot">${switchBtnHtml}</div>
        </div>
        <div class="node-body-box ${tipeClass}">
            <div class="node-main-text">${cleanNama}</div>
            <div class="node-card-footer">
                ${idTag}
            </div>
        </div>
    `;
}

// Toggle Collapse Node
function toggleNodeCollapse(d) {
    if (d.children) {
        d._children = d.children;
        d.children = null;
    } else {
        d.children = d._children;
        d._children = null;
    }
    updateDiagram(d);
}

function expandAllNodes(d) {
    if (d._children) {
        d.children = d._children;
        d._children = null;
    }
    if (d.children) {
        d.children.forEach(expandAllNodes);
    }
}

function collapseAllNodes(d) {
    if (d.children && d.data.nama !== 'ROOT') {
        d.children.forEach(collapseAllNodes);
        d._children = d.children;
        d.children = null;
    } else if (d.children) {
        d.children.forEach(collapseAllNodes);
    }
}

// Fit to screen
function fitToScreen() {
    const container = document.getElementById('chart-canvas-container');
    const width = container.clientWidth || 1200;
    const height = container.clientHeight || 700;

    const bounds = treeGraph.g.node().getBBox();
    if (bounds.width === 0 || bounds.height === 0) return;

    const fullWidth = bounds.width + 120;
    const fullHeight = bounds.height + 140;

    const midX = bounds.x + bounds.width / 2;
    const midY = bounds.y + bounds.height / 2;

    const scale = Math.min(width / fullWidth, height / fullHeight, 1.2);
    const translate = [width / 2 - scale * midX, height / 2 - scale * midY];

    treeGraph.svg.transition().duration(350).call(
        treeGraph.zoom.transform,
        d3.zoomIdentity.translate(translate[0], translate[1]).scale(scale)
    );
}

// ========================================================
// INTERAKTIF: GANTI TIPE IMMEDIATE (PROGRAM VS KEGIATAN)
// ========================================================
function setImmediateType(nodeD3, targetType, callback, parentProgramId) {
    var d = nodeD3.data;
    var newType = targetType ? targetType : ((d.cascading_type === 'kegiatan') ? 'program' : 'kegiatan');
    var parentId = (parentProgramId !== undefined) ? parentProgramId : (d.parent_immediate_id || null);

    $.ajax({
        url: BaseURL + "Instansi/updateCascadingType",
        type: "POST",
        dataType: "json",
        data: {
            id: d.original_id,
            type: newType,
            parent_program_id: parentId,
            instansi_id: currentInstansiId,
            [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res) {
            if (res.status === 'success') {
                if (res.chart_data) {
                    rawChartData = res.chart_data;
                    treeGraph.activeRootData = JSON.parse(JSON.stringify(rawChartData));
                    setupHierarchy(treeGraph.activeRootData);
                    updateDiagram(treeGraph.root);
                    updateLegendCounts();
                }

                if (typeof callback === 'function') {
                    callback(true, newType);
                }
            } else {
                alert(res.message || "Gagal mengubah tipe!");
                if (typeof callback === 'function') {
                    callback(false, newType);
                }
            }
        },
        error: function() {
            alert("Terjadi kesalahan jaringan atau sesi telah berakhir.");
            if (typeof callback === 'function') {
                callback(false, newType);
            }
        }
    });
}

function toggleSingleImmediateType(nodeD3) {
    setImmediateType(nodeD3, null);
}

function changeBulkImmediateType(type) {
    var confirmText = type === 'program' 
        ? "Ubah semua Immediate Outcome menjadi 'Program Perangkat Daerah'?" 
        : "Ubah semua Immediate Outcome menjadi 'Kegiatan Perangkat Daerah' (di bawah Program)?";

    if (!confirm(confirmText)) return;

    $.ajax({
        url: BaseURL + "Instansi/updateBulkCascadingType",
        type: "POST",
        dataType: "json",
        data: {
            type: type,
            instansi_id: currentInstansiId,
            [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res) {
            if (res.status === 'success') {
                if (res.chart_data) {
                    rawChartData = res.chart_data;
                    treeGraph.activeRootData = JSON.parse(JSON.stringify(rawChartData));
                    setupHierarchy(treeGraph.activeRootData);
                    updateDiagram(treeGraph.root);
                    updateLegendCounts();
                }

                // Update UI button class
                if (type === 'program') {
                    $("#btnBulkProgram").addClass("active-program");
                    $("#btnBulkKegiatan").removeClass("active-kegiatan");
                } else {
                    $("#btnBulkKegiatan").addClass("active-kegiatan");
                    $("#btnBulkProgram").removeClass("active-program");
                }
            } else {
                alert(res.message || "Gagal memperbarui tipe");
            }
        },
        error: function() {
            alert("Terjadi kesalahan jaringan.");
        }
    });
}

function updateLegendCounts() {
    var counts = { tujuan: 0, sasaran: 0, program: 0, kegiatan: 0, subkegiatan: 0 };
    if (treeGraph.root) {
        treeGraph.root.descendants().forEach(function(d) {
            if (d.data.tipe === 'tujuan_pd') counts.tujuan++;
            else if (d.data.tipe === 'sasaran_pd') counts.sasaran++;
            else if (d.data.tipe === 'program_pd') counts.program++;
            else if (d.data.tipe === 'kegiatan_pd') counts.kegiatan++;
            else if (d.data.tipe === 'sub_kegiatan_pd') counts.subkegiatan++;
        });
    }
    $("#count-tujuan").text(counts.tujuan);
    $("#count-sasaran").text(counts.sasaran);
    $("#count-program").text(counts.program);
    $("#count-kegiatan").text(counts.kegiatan);
    $("#count-subkegiatan").text(counts.subkegiatan);
}

// ========================================================
// MODAL DETAIL POPUP
// ========================================================
function openNodeModal(nodeD3) {
    var d = nodeD3.data;

    var levelColor = '#3b82f6';
    var iconClass = 'fa-info-circle';

    if (d.tipe === 'tujuan_pd') { levelColor = '#1e40af'; iconClass = 'fa-crown'; }
    else if (d.tipe === 'sasaran_pd') { levelColor = '#0369a1'; iconClass = 'fa-chart-line'; }
    else if (d.tipe === 'program_pd') { levelColor = '#0d9488'; iconClass = 'fa-tasks'; }
    else if (d.tipe === 'kegiatan_pd') { levelColor = '#b45309'; iconClass = 'fa-calendar-check'; }
    else if (d.tipe === 'sub_kegiatan_pd') { levelColor = '#6d28d9'; iconClass = 'fa-check-circle'; }

    $("#cascadingModalContent").css('border-left-color', levelColor);
    $("#modalNodeIcon").html(`<i class="fa ${iconClass}" style="color:${levelColor};"></i>`);
    $("#modalNodeTitle").text(d.tipe_label || 'Detail Kinerja');

    var html = `
        <div class="modal-detail-row">
            <div class="modal-detail-label"><i class="fa fa-align-left"></i> Kinerja / Uraian</div>
            <div class="modal-detail-value" style="font-size:14px; font-weight:600; color:#1e293b;">
                ${escapeHtml(d.nama || '—')}
            </div>
        </div>
    `;

    // Indikator
    var indikatorList = [];
    if (d.indikator) {
        if (typeof d.indikator === 'string') {
            indikatorList = d.indikator.split('|||').map(s => s.trim()).filter(s => s);
        } else if (Array.isArray(d.indikator)) {
            indikatorList = d.indikator;
        }
    }

    if (indikatorList.length > 0) {
        html += `
            <div class="modal-detail-row">
                <div class="modal-detail-label"><i class="fa fa-chart-line"></i> Indikator Kinerja</div>
                <div class="modal-detail-value">
                    <ul style="margin:0; padding-left:18px;">
                        ${indikatorList.map(i => `<li>${escapeHtml(i)}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `;
    }

    // Crosscutting Perangkat Daerah
    var crosscuttingList = formatCrosscutting(d.crosscutting_pd, d.crosscutting_ket);
    if (crosscuttingList && crosscuttingList.length > 0) {
        html += `
            <div class="modal-detail-row">
                <div class="modal-detail-label"><i class="fa fa-handshake"></i> Crosscutting Perangkat Daerah</div>
                <div class="modal-detail-value" style="padding: 0; overflow: hidden; border: 1px solid #cbd5e1;">
                    <table class="table table-bordered table-striped" style="margin: 0; font-size: 12px; width: 100%;">
                        <thead style="background: #f1f5f9; color: #334155;">
                            <tr>
                                <th style="width: 45%; padding: 8px 10px; font-weight: 700; border-bottom: 2px solid #cbd5e1;">Perangkat Daerah Terkait</th>
                                <th style="width: 55%; padding: 8px 10px; font-weight: 700; border-bottom: 2px solid #cbd5e1;">Keterangan Crosscutting</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${crosscuttingList.map(c => `
                                <tr>
                                    <td style="padding: 8px 10px; vertical-align: top;">
                                        <i class="fa fa-building" style="color: #64748b; margin-right: 4px;"></i>
                                        <strong>${escapeHtml(c.pd)}</strong>
                                    </td>
                                    <td style="padding: 8px 10px; vertical-align: top; color: #475569;">
                                        ${escapeHtml(c.ket)}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    } else if (d.tipe !== 'tujuan_pd') {
        html += `
            <div class="modal-detail-row">
                <div class="modal-detail-label"><i class="fa fa-handshake"></i> Crosscutting Perangkat Daerah</div>
                <div class="modal-detail-value" style="color: #94a3b8; font-style: italic;">
                    Tidak ada data crosscutting
                </div>
            </div>
        `;
    }

    // Opsi Ganti Tipe Khusus Immediate (Level 3 / Level 4)
    if (d.original_id && (d.tipe === 'program_pd' || d.tipe === 'kegiatan_pd' || d.level === 3 || d.level === 4)) {
        var isProgram = (d.cascading_type !== 'kegiatan');
        var programsAvailable = (d.available_programs || []).filter(function(p) {
            return String(p.id) !== String(d.original_id);
        });
        var showProgSelect = (!isProgram && programsAvailable.length > 0);

        html += `
            <div class="modal-type-changer" style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:12px; padding:14px; margin-top:16px;">
                <div style="font-weight:700; font-size:12px; color:#1e293b; display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                    <i class="fa fa-exchange-alt text-primary"></i> Pilihan Klasifikasi Node:
                    <span id="saveStatusIndicator" style="margin-left:auto; font-size:11px; font-weight:600; display:none;"></span>
                </div>
                <p style="margin:0 0 10px 0; font-size:11.5px; color:#64748b;">
                    Pilih apakah kinerja ini menjadi <strong>Program</strong> (Tier 3) atau <strong>Kegiatan</strong> (Tier 4, berada di bawah Program):
                </p>
                <div class="modal-type-options" style="display:flex; gap:12px; flex-wrap:wrap;">
                    <div class="type-option-card ${isProgram ? 'selected-program' : ''}" data-type="program" id="optTypeProgram" style="flex:1; min-width:200px; padding:12px 14px; border-radius:10px; border:2px solid ${isProgram ? '#0d9488' : '#cbd5e1'}; background:${isProgram ? '#f0fdfa' : '#ffffff'}; cursor:pointer; transition:all 0.2s;">
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                            <span style="font-size:16px; color:#0d9488;"><i class="fa fa-tasks"></i></span>
                            <span class="badge-status-check" id="badgeCheckProgram" style="font-size:11px; font-weight:700; color:${isProgram ? '#0d9488' : '#94a3b8'};">
                                ${isProgram ? '<i class="fa fa-check-circle"></i> Terpilih (Tier 3)' : '<i class="fa fa-circle"></i> Pilih'}
                            </span>
                        </div>
                        <div style="font-weight:700; font-size:13px; color:#1e293b;">Program Perangkat Daerah</div>
                        <div style="font-size:11px; color:#64748b; margin-top:2px;">Posisi sejajar di bawah Sasaran PD</div>
                    </div>

                    <div class="type-option-card ${!isProgram ? 'selected-kegiatan' : ''}" data-type="kegiatan" id="optTypeKegiatan" style="flex:1; min-width:200px; padding:12px 14px; border-radius:10px; border:2px solid ${!isProgram ? '#b45309' : '#cbd5e1'}; background:${!isProgram ? '#fffbeb' : '#ffffff'}; cursor:pointer; transition:all 0.2s;">
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                            <span style="font-size:16px; color:#b45309;"><i class="fa fa-calendar-check"></i></span>
                            <span class="badge-status-check" id="badgeCheckKegiatan" style="font-size:11px; font-weight:700; color:${!isProgram ? '#b45309' : '#94a3b8'};">
                                ${!isProgram ? '<i class="fa fa-check-circle"></i> Terpilih (Tier 4)' : '<i class="fa fa-circle"></i> Pilih'}
                            </span>
                        </div>
                        <div style="font-weight:700; font-size:13px; color:#1e293b;">Kegiatan Perangkat Daerah</div>
                        <div style="font-size:11px; color:#64748b; margin-top:2px;">Posisi berada di bawah Program PD</div>
                    </div>
                </div>

                <div id="wrapperSelectProgram" style="margin-top:12px; display:${showProgSelect ? 'block' : 'none'};">
                    <label style="font-size:11px; font-weight:700; color:#475569; margin-bottom:4px; display:block;">
                        <i class="fa fa-level-up-alt"></i> Letakkan di bawah Program PD Induk:
                    </label>
                    <select id="selectParentProgramModal" style="width:100%; height:34px; border-radius:6px; border:1px solid #cbd5e1; font-size:12px; padding:4px 10px; background:#fff;">
                        ${programsAvailable.map(p => `
                            <option value="${p.id}" ${d.parent_immediate_id == p.id ? 'selected' : ''}>
                                ${escapeHtml(p.nama)}
                            </option>
                        `).join('')}
                    </select>
                </div>
                
                ${programsAvailable.length === 0 ? `
                    <div id="noteAutoProgram" style="font-size:11.5px; color:#0d9488; margin-top:10px; display:${!isProgram ? 'block' : 'none'}; background:#f0fdfa; padding:8px 12px; border-radius:6px; border:1px solid #99f6e4;">
                        <i class="fa fa-info-circle"></i> Otomatis ditempatkan di bawah Program Perangkat Daerah pada Sasaran ini.
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Nomenklatur SIPD (Khusus Program, Kegiatan, dan Sub Kegiatan)
    var isSipdApplicable = (d.original_id && (d.tipe === 'program_pd' || d.tipe === 'kegiatan_pd' || d.tipe === 'sub_kegiatan_pd'));
    var sipdType = (d.tipe === 'sub_kegiatan_pd') ? 'sub_kegiatan' : ((d.tipe === 'kegiatan_pd') ? 'kegiatan' : 'program');
    var sipdLabel = (d.tipe === 'sub_kegiatan_pd') ? 'Sub Kegiatan' : ((d.tipe === 'kegiatan_pd') ? 'Kegiatan' : 'Program');
    var parentSipdCode = (nodeD3.parent && nodeD3.parent.data) ? nodeD3.parent.data.kode_nomenklatur : null;

    if (isSipdApplicable) {
        html += `
            <div class="modal-sipd-section" id="modalSipdSection">
                <div style="font-weight:700; font-size:12px; color:#1e293b; display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa fa-book-bookmark text-primary"></i> Nomenklatur SIPD Kabupaten:
                    </div>
                    <span id="sipdSaveStatus" style="font-size:11px; font-weight:600; display:none;"></span>
                </div>

                <div id="sipdDisplayCard">
                    ${renderSipdDisplayCard(d, levelColor, sipdLabel)}
                </div>

                <!-- Picker Container (Expanded when user wants to choose) -->
                <div id="sipdPickerContainer" style="display:none; background:#ffffff; border:1px solid #cbd5e1; border-radius:10px; padding:12px; margin-top:12px; box-shadow:0 4px 15px rgba(0,0,0,0.06);">
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                        <div style="position:relative; flex:1;">
                            <input type="text" id="sipdSearchInput" placeholder="Cari Kode atau Nama Nomenklatur SIPD..." 
                                   style="width:100%; height:34px; padding:6px 28px 6px 10px; font-size:12px; border:1px solid #cbd5e1; border-radius:6px; outline:none;">
                            <span id="sipdSearchSpinner" style="position:absolute; right:10px; top:9px; font-size:11px; color:#94a3b8; display:none;">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                        </div>
                        <button type="button" class="btn btn-sm btn-light" id="btnCloseSipdPicker" style="font-size:11px; padding:6px 10px; border:1px solid #cbd5e1; border-radius:6px;">
                            Batal
                        </button>
                    </div>

                    ${parentSipdCode ? `
                        <div style="margin-bottom:8px; font-size:11px; color:#475569; display:flex; align-items:center; gap:6px; background:#f1f5f9; padding:6px 10px; border-radius:5px;">
                            <input type="checkbox" id="chkFilterParentSipd" checked style="cursor:pointer;">
                            <label for="chkFilterParentSipd" style="margin:0; cursor:pointer; font-weight:500;">
                                Filter sesuai induk SIPD: <strong>[${escapeHtml(parentSipdCode.replace(/\|\|\|/g, ', '))}]</strong>
                            </label>
                        </div>
                    ` : ''}

                    <!-- Selected Chips Container -->
                    <div id="sipdSelectedChipsWrapper" style="display:none; margin-bottom:8px; padding:8px 10px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:6px;">
                        <div style="font-size:11px; font-weight:700; color:#166534; margin-bottom:6px; display:flex; align-items:center; justify-content:space-between;">
                            <span><i class="fa fa-check-square"></i> Nomenklatur Terpilih (<span id="sipdSelectedCount">0</span>):</span>
                            <a href="javascript:void(0)" id="btnClearAllTempSipd" style="color:#ef4444; font-size:10px; text-decoration:none; font-weight:600;">Kosongkan</a>
                        </div>
                        <div id="sipdSelectedChips" style="display:flex; flex-wrap:wrap; gap:5px; max-height:80px; overflow-y:auto;"></div>
                    </div>

                    <div id="sipdSearchResults" style="max-height:220px; overflow-y:auto; border:1px solid #f1f5f9; border-radius:6px;">
                        <!-- Results dynamically loaded here -->
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; margin-top:10px; padding-top:8px; border-top:1px solid #e2e8f0;">
                        <span style="font-size:11px; color:#64748b;">* Bisa memilih lebih dari 1 nomenklatur</span>
                        <div style="display:flex; gap:8px;">
                            <button type="button" class="btn btn-sm btn-light" id="btnCancelSipdPicker" style="font-size:11px; padding:5px 12px; border:1px solid #cbd5e1; border-radius:6px;">
                                Batal
                            </button>
                            <button type="button" class="btn btn-sm btn-success" id="btnApplySipdPicker" style="font-size:11px; padding:5px 14px; border-radius:6px; font-weight:600; background:#10b981; border-color:#10b981;">
                                <i class="fa fa-save"></i> Simpan Pilihan (<span id="sipdApplyCount">0</span>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    $("#modalNodeBody").html(html);
    $("#cascadingModal").fadeIn(150);

    // Event binding untuk Nomenklatur SIPD
    var tempSelectedSipd = [];

    if (isSipdApplicable) {
        bindSipdCardEvents();
    }

    function bindSipdCardEvents() {
        tempSelectedSipd = parseSipdItems(d.kode_nomenklatur, d.nomenklatur_sipd);

        $("#btnOpenSipdPicker").off('click').on('click', function() {
            tempSelectedSipd = parseSipdItems(d.kode_nomenklatur, d.nomenklatur_sipd);
            updateSelectedChipsUI();
            $("#sipdPickerContainer").slideDown(150, function() {
                $("#sipdSearchInput").focus();
            });
            fetchSipdResults();
        });

        $("#btnCloseSipdPicker, #btnCancelSipdPicker").off('click').on('click', function() {
            $("#sipdPickerContainer").slideUp(150);
        });

        $("#btnClearSipdLink").off('click').on('click', function() {
            if (!confirm("Lepaskan semua Nomenklatur SIPD dari node ini?")) return;
            saveNodeSipd(nodeD3, null, null, function(ok) {
                if (ok) {
                    tempSelectedSipd = [];
                    $("#sipdDisplayCard").html(renderSipdDisplayCard(d, levelColor, sipdLabel));
                    bindSipdCardEvents();
                }
            });
        });

        // Hapus satu item langsung dari sipdDisplayCard
        $(".btn-remove-single-sipd").off('click').on('click', function(e) {
            e.stopPropagation();
            var kodeToRemove = $(this).data('kode');
            var currentItems = parseSipdItems(d.kode_nomenklatur, d.nomenklatur_sipd);
            var remainingItems = currentItems.filter(function(it) { return it.kode !== kodeToRemove; });
            var newKode = remainingItems.map(function(it) { return it.kode; }).join('|||');
            var newNama = remainingItems.map(function(it) { return it.nama; }).join('|||');

            saveNodeSipd(nodeD3, newKode || null, newNama || null, function(ok) {
                if (ok) {
                    tempSelectedSipd = remainingItems;
                    $("#sipdDisplayCard").html(renderSipdDisplayCard(d, levelColor, sipdLabel));
                    bindSipdCardEvents();
                }
            });
        });

        // Kosongkan semua pilihan sementara di picker
        $("#btnClearAllTempSipd").off('click').on('click', function() {
            tempSelectedSipd = [];
            updateSelectedChipsUI();
            updateResultItemsVisual();
        });

        // Simpan pilihan multi-select dari picker
        $("#btnApplySipdPicker").off('click').on('click', function() {
            var newKode = tempSelectedSipd.map(function(it) { return it.kode; }).join('|||');
            var newNama = tempSelectedSipd.map(function(it) { return it.nama; }).join('|||');

            saveNodeSipd(nodeD3, newKode || null, newNama || null, function(ok) {
                if (ok) {
                    $("#sipdDisplayCard").html(renderSipdDisplayCard(d, levelColor, sipdLabel));
                    $("#sipdPickerContainer").slideUp(150);
                    bindSipdCardEvents();
                }
            });
        });

        var sipdDebounceTimer = null;
        $("#sipdSearchInput").off('input').on('input', function() {
            clearTimeout(sipdDebounceTimer);
            sipdDebounceTimer = setTimeout(function() {
                fetchSipdResults();
            }, 250);
        });

        $("#chkFilterParentSipd").off('change').on('change', function() {
            fetchSipdResults();
        });
    }

    function updateSelectedChipsUI() {
        $("#sipdSelectedCount").text(tempSelectedSipd.length);
        $("#sipdApplyCount").text(tempSelectedSipd.length);

        if (tempSelectedSipd.length > 0) {
            $("#sipdSelectedChipsWrapper").show();
            var chipsHtml = tempSelectedSipd.map(function(item) {
                return `
                    <span class="sipd-chip">
                        <span>[${escapeHtml(item.kode)}] ${escapeHtml(item.nama)}</span>
                        <span class="btn-remove-chip" data-kode="${escapeHtml(item.kode)}" title="Hapus">&times;</span>
                    </span>
                `;
            }).join('');
            $("#sipdSelectedChips").html(chipsHtml);

            $(".btn-remove-chip").off('click').on('click', function(e) {
                e.stopPropagation();
                var kodeToRemove = $(this).data('kode');
                tempSelectedSipd = tempSelectedSipd.filter(function(it) { return it.kode !== kodeToRemove; });
                updateSelectedChipsUI();
                updateResultItemsVisual();
            });
        } else {
            $("#sipdSelectedChipsWrapper").hide();
            $("#sipdSelectedChips").html('');
        }
    }

    function updateResultItemsVisual() {
        var selectedKodeSet = {};
        tempSelectedSipd.forEach(function(it) { selectedKodeSet[it.kode] = true; });

        $(".sipd-result-item").each(function() {
            var itemKode = $(this).data('kode');
            var isSel = !!selectedKodeSet[itemKode];
            if (isSel) {
                $(this).addClass('selected');
                $(this).find('input[type="checkbox"]').prop('checked', true);
                $(this).find('.badge-sipd-sel').show();
                $(this).find('.btn-choose-sipd').html('<i class="fa fa-check"></i> Terpilih').css('background', '#10b981');
            } else {
                $(this).removeClass('selected');
                $(this).find('input[type="checkbox"]').prop('checked', false);
                $(this).find('.badge-sipd-sel').hide();
                $(this).find('.btn-choose-sipd').html('Pilih').css('background', '#3b82f6');
            }
        });
    }

    function fetchSipdResults() {
        var query = ($("#sipdSearchInput").val() || '').trim();
        var filterParent = $("#chkFilterParentSipd").is(":checked");
        var parentCode = (filterParent && parentSipdCode) ? parentSipdCode : '';

        $("#sipdSearchSpinner").show();
        $("#sipdSearchResults").html('<div style="padding:15px; text-align:center; font-size:11.5px; color:#64748b;"><i class="fa fa-spinner fa-spin"></i> Memuat Nomenklatur SIPD...</div>');

        $.ajax({
            url: BaseURL + "Instansi/searchNomenklaturSIPD",
            type: "GET",
            dataType: "json",
            data: {
                type: sipdType,
                q: query,
                parent_code: parentCode,
                limit: 50
            },
            success: function(res) {
                $("#sipdSearchSpinner").hide();
                if (res.status === 'success' && Array.isArray(res.data) && res.data.length > 0) {
                    var selectedKodeSet = {};
                    tempSelectedSipd.forEach(function(it) { selectedKodeSet[it.kode] = true; });

                    var listHtml = res.data.map(function(item) {
                        var isSelected = !!selectedKodeSet[item.Kode];
                        return `
                            <div class="sipd-result-item ${isSelected ? 'selected' : ''}" data-kode="${escapeHtml(item.Kode)}" data-nama="${escapeHtml(item.Nomenklatur)}">
                                <div style="display:flex; align-items:center; gap:8px; flex:1; overflow:hidden;">
                                    <input type="checkbox" class="chk-sipd-row" style="cursor:pointer;" ${isSelected ? 'checked' : ''}>
                                    <span class="sipd-item-code">${escapeHtml(item.Kode)}</span>
                                    <span class="sipd-item-title">${escapeHtml(item.Nomenklatur)}</span>
                                    <span class="badge badge-success badge-sipd-sel" style="font-size:9px; padding:2px 5px; background:#10b981; color:#fff; display:${isSelected ? 'inline-block' : 'none'};">Terpilih</span>
                                </div>
                                <button type="button" class="btn-choose-sipd" style="background:${isSelected ? '#10b981' : '#3b82f6'};">
                                    ${isSelected ? '<i class="fa fa-check"></i> Terpilih' : 'Pilih'}
                                </button>
                            </div>
                        `;
                    }).join('');
                    $("#sipdSearchResults").html(listHtml);

                    // Toggle handler klik row item hasil SIPD
                    $(".sipd-result-item").off('click').on('click', function(e) {
                        var targetKode = $(this).data('kode');
                        var targetNama = $(this).data('nama');
                        var existsIdx = -1;
                        for (var i = 0; i < tempSelectedSipd.length; i++) {
                            if (tempSelectedSipd[i].kode === targetKode) {
                                existsIdx = i;
                                break;
                            }
                        }

                        if (existsIdx !== -1) {
                            tempSelectedSipd.splice(existsIdx, 1);
                        } else {
                            tempSelectedSipd.push({
                                kode: targetKode,
                                nama: targetNama
                            });
                        }

                        updateSelectedChipsUI();
                        updateResultItemsVisual();
                    });
                } else {
                    $("#sipdSearchResults").html(`
                        <div style="padding:15px; text-align:center; font-size:11.5px; color:#94a3b8;">
                            <i class="fa fa-info-circle"></i> Tidak ditemukan Nomenklatur SIPD yang cocok${parentCode ? ' di bawah induk ' + parentCode.replace(/\|\|\|/g, ', ') : ''}.
                        </div>
                    `);
                }
            },
            error: function() {
                $("#sipdSearchSpinner").hide();
                $("#sipdSearchResults").html('<div style="padding:12px; text-align:center; font-size:11.5px; color:#ef4444;"><i class="fa fa-exclamation-triangle"></i> Gagal memuat data dari server</div>');
            }
        });
    }

    // Click handler untuk kartu pilihan tipe
    $(".type-option-card").on('click', function() {
        var chosenType = $(this).data('type');
        var parentProgramId = $("#selectParentProgramModal").val() || null;

        if (chosenType === d.cascading_type && (!parentProgramId || parentProgramId == d.parent_immediate_id)) {
            return;
        }

        // Tampilkan loading indicator
        $("#saveStatusIndicator").html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').css('color', '#3b82f6').show();

        // Update UI card visual segera
        if (chosenType === 'program') {
            $("#optTypeProgram").css({'border-color': '#0d9488', 'background': '#f0fdfa'});
            $("#optTypeKegiatan").css({'border-color': '#cbd5e1', 'background': '#ffffff'});
            $("#badgeCheckProgram").html('<i class="fa fa-check-circle"></i> Terpilih (Tier 3)').css('color', '#0d9488');
            $("#badgeCheckKegiatan").html('<i class="fa fa-circle"></i> Pilih').css('color', '#94a3b8');
            $("#wrapperSelectProgram").slideUp(150);
            $("#noteAutoProgram").slideUp(150);
        } else {
            $("#optTypeKegiatan").css({'border-color': '#b45309', 'background': '#fffbeb'});
            $("#optTypeProgram").css({'border-color': '#cbd5e1', 'background': '#ffffff'});
            $("#badgeCheckKegiatan").html('<i class="fa fa-check-circle"></i> Terpilih (Tier 4)').css('color', '#b45309');
            $("#badgeCheckProgram").html('<i class="fa fa-circle"></i> Pilih').css('color', '#94a3b8');
            if ($("#selectParentProgramModal").length > 0) {
                $("#wrapperSelectProgram").slideDown(150);
            } else {
                $("#noteAutoProgram").slideDown(150);
            }
        }

        // Kirim request update
        setImmediateType(nodeD3, chosenType, function(success, newType) {
            if (success) {
                var posText = (newType === 'kegiatan') ? 'Kegiatan (di bawah Program)' : 'Program Perangkat Daerah';
                $("#saveStatusIndicator").html(`<i class="fa fa-check-circle"></i> Tersimpan sebagai ${posText}!`).css('color', '#10b981').fadeIn();
                setTimeout(function() {
                    $("#saveStatusIndicator").fadeOut(500);
                }, 2500);

                // Update judul dan border modal
                var newLevelColor = (newType === 'kegiatan') ? '#b45309' : '#0d9488';
                var newIconClass = (newType === 'kegiatan') ? 'fa-calendar-check' : 'fa-tasks';
                var newTitle = (newType === 'kegiatan') ? 'Kegiatan Perangkat Daerah (Tier 4)' : 'Program Perangkat Daerah (Tier 3)';

                $("#cascadingModalContent").css('border-left-color', newLevelColor);
                $("#modalNodeIcon").html(`<i class="fa ${newIconClass}" style="color:${newLevelColor};"></i>`);
                $("#modalNodeTitle").text(newTitle);
            } else {
                $("#saveStatusIndicator").html('<i class="fa fa-times-circle"></i> Gagal menyimpan').css('color', '#ef4444').show();
            }
        }, parentProgramId);
    });

    // Dropdown change parent program
    $("#selectParentProgramModal").on('change', function() {
        var selectedPid = $(this).val();
        $("#saveStatusIndicator").html('<i class="fa fa-spinner fa-spin"></i> Memindahkan ke Program...').css('color', '#3b82f6').show();
        setImmediateType(nodeD3, 'kegiatan', function(success) {
            if (success) {
                $("#saveStatusIndicator").html('<i class="fa fa-check-circle"></i> Berhasil dipindahkan ke Program!').css('color', '#10b981').fadeIn();
                setTimeout(function() { $("#saveStatusIndicator").fadeOut(500); }, 2000);
            }
        }, selectedPid);
    });
}

// Helpers untuk Nomenklatur SIPD
function renderSipdDisplayCard(d, levelColor, sipdLabel) {
    var items = parseSipdItems(d.kode_nomenklatur, d.nomenklatur_sipd);
    if (items.length > 0) {
        var listRows = items.map(function(item) {
            return `
                <div class="sipd-connected-row" style="display:flex; align-items:center; justify-content:space-between; gap:10px; padding:7px 10px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; margin-bottom:6px;">
                    <div style="flex:1; display:flex; align-items:center; gap:8px; overflow:hidden;">
                        <span class="badge" style="background:${levelColor}; color:#fff; font-family:monospace; font-size:11px; padding:3px 7px; border-radius:4px; flex-shrink:0;">
                            ${escapeHtml(item.kode)}
                        </span>
                        <span style="font-size:12px; font-weight:600; color:#1e293b; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="${escapeHtml(item.nama)}">
                            ${escapeHtml(item.nama)}
                        </span>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-single-sipd" data-kode="${escapeHtml(item.kode)}" style="font-size:10px; padding:3px 7px; border-radius:4px;" title="Lepas Nomenklatur ini">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            `;
        }).join('');

        return `
            <div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
                    <span style="font-size:11px; color:#10b981; font-weight:700;"><i class="fa fa-check-circle"></i> ${items.length} Nomenklatur SIPD Terhubung</span>
                    <div style="display:flex; gap:6px;">
                        <button type="button" class="btn btn-sm btn-outline-primary" id="btnOpenSipdPicker" style="font-size:11px; padding:4px 9px; border-radius:5px;">
                            <i class="fa fa-plus"></i> Tambah / Kelola
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="btnClearSipdLink" style="font-size:11px; padding:4px 8px; border-radius:5px;" title="Lepas Semua Nomenklatur SIPD">
                            <i class="fa fa-trash"></i> Hapus Semua
                        </button>
                    </div>
                </div>
                <div class="sipd-connected-list" style="max-height:180px; overflow-y:auto;">
                    ${listRows}
                </div>
            </div>
        `;
    } else {
        return `
            <div style="display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; padding:6px 0;">
                <div style="font-size:11.5px; color:#64748b; font-style:italic;">
                    <i class="fa fa-info-circle text-muted" style="margin-right:4px;"></i> Belum ada Nomenklatur SIPD Kabupaten yang dipilih.
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="btnOpenSipdPicker" style="font-size:11px; padding:5px 12px; border-radius:6px; background:${levelColor}; border-color:${levelColor};">
                    <i class="fa fa-plus-circle"></i> Pilih Nomenklatur SIPD
                </button>
            </div>
        `;
    }
}

function updateNodeInRawTree(root, targetId, updater) {
    if (!root) return false;
    if (root.id === targetId) {
        updater(root);
        return true;
    }
    if (root.children && Array.isArray(root.children)) {
        for (var i = 0; i < root.children.length; i++) {
            if (updateNodeInRawTree(root.children[i], targetId, updater)) return true;
        }
    }
    return false;
}

function saveNodeSipd(nodeD3, kode, nama, callback) {
    var d = nodeD3.data;
    var saveType = (d.tipe === 'sub_kegiatan_pd') ? 'sub_kegiatan' : ((d.tipe === 'kegiatan_pd') ? 'kegiatan' : 'program');
    
    $("#sipdSaveStatus").html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').css('color', '#3b82f6').show();
    
    $.ajax({
        url: BaseURL + "Instansi/saveNomenklaturSIPD",
        type: "POST",
        dataType: "json",
        data: {
            id: d.original_id,
            type: saveType,
            kode_nomenklatur: kode || '',
            nomenklatur_sipd: nama || '',
            [CSRF_NAME]: CSRF_TOKEN
        },
        success: function(res) {
            if (res.status === 'success') {
                d.kode_nomenklatur = res.kode_nomenklatur;
                d.nomenklatur_sipd = res.nomenklatur_sipd;
                
                // Update recursive in rawChartData & activeRootData
                updateNodeInRawTree(rawChartData, d.id, function(node) {
                    node.kode_nomenklatur = res.kode_nomenklatur;
                    node.nomenklatur_sipd = res.nomenklatur_sipd;
                });
                if (treeGraph.activeRootData) {
                    updateNodeInRawTree(treeGraph.activeRootData, d.id, function(node) {
                        node.kode_nomenklatur = res.kode_nomenklatur;
                        node.nomenklatur_sipd = res.nomenklatur_sipd;
                    });
                }
                
                // Refresh diagram node card visually
                treeGraph.g.selectAll(".cascading-node")
                    .filter(function(nd) { return nd.data.id === d.id; })
                    .select(".cascading-card")
                    .html(function(nd) { return generateCardHtml(nd.data); });
                
                var actionText = kode ? 'Nomenklatur SIPD tersimpan!' : 'Nomenklatur SIPD dihapus!';
                $("#sipdSaveStatus").html(`<i class="fa fa-check-circle"></i> ${actionText}`).css('color', '#10b981').fadeIn();
                setTimeout(function() { $("#sipdSaveStatus").fadeOut(400); }, 2000);
                
                if (typeof callback === 'function') callback(true);
            } else {
                $("#sipdSaveStatus").html('<i class="fa fa-times-circle"></i> Gagal menyimpan').css('color', '#ef4444').show();
                if (typeof callback === 'function') callback(false);
            }
        },
        error: function(err) {
            console.error(err);
            $("#sipdSaveStatus").html('<i class="fa fa-times-circle"></i> Kesalahan server').css('color', '#ef4444').show();
            if (typeof callback === 'function') callback(false);
        }
    });
}

// Export as PNG
function exportAsPNG() {
    var $btn = $("#btnExportPNG");
    $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengekspor...');

    var container = document.getElementById("chart-canvas-container");

    html2canvas(container, {
        backgroundColor: '#fafbfc',
        scale: 2,
        useCORS: true
    }).then(function(canvas) {
        var link = document.createElement('a');
        link.download = 'Cascading-PD-' + new Date().toISOString().slice(0, 10) + '.png';
        link.href = canvas.toDataURL("image/png");
        link.click();
        $btn.prop('disabled', false).html('<i class="fa fa-download"></i> Ekspor PNG');
    }).catch(function(err) {
        console.error(err);
        alert("Gagal mengekspor gambar.");
        $btn.prop('disabled', false).html('<i class="fa fa-download"></i> Ekspor PNG');
    });
}

function escapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
</script>
