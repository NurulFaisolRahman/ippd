<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Custom CSS for Sidebar Kementerian (Matching Daerah Style) -->
<style>
    :root {
        --sidebar-width: 280px;
        --sidebar-mini-width: 70px;
        --transition-speed: 0.3s;
    }

    .menu-icon {
        margin-right: 12px;
        width: 20px;
        text-align: center;
        color: #20c997;
        font-size: 16px;
    }

    /* Sidebar Styles */
    .sidebar-wrapper {
        width: var(--sidebar-width);
        background-color: #f8f9fa;
        height: calc(100vh - 64px) !important;
        position: fixed !important;
        left: 0 !important;
        top: 64px !important;
        margin-top: 0 !important;
        border-top: none !important;
        box-shadow: 2px 0 5px rgba(0,0,0,0.08);
        z-index: 999;
        overflow-y: auto;
        overflow-x: hidden;
        transition: width var(--transition-speed) ease, transform var(--transition-speed) ease;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        padding-top: 15px;
        padding-bottom: 120px;
    }

    .sidebar-mini .sidebar-wrapper {
        width: var(--sidebar-mini-width);
        overflow: visible !important;
    }

    /* Main Content adjustment & Dynamic Fluid Table Layout */
    .main-content {
        margin-left: var(--sidebar-width);
        width: calc(100% - var(--sidebar-width));
        padding: 20px 24px;
        min-height: calc(100vh - 64px);
        transition: margin-left var(--transition-speed) ease, width var(--transition-speed) ease;
        box-sizing: border-box;
    }

    .sidebar-mini .main-content {
        margin-left: var(--sidebar-mini-width);
        width: calc(100% - var(--sidebar-mini-width));
    }

    /* Hilangkan batasan width fixed dari Bootstrap .container agar dinamis 100% penuh saat buka/tutup sidebar */
    .main-content .container,
    .main-content .container-fluid {
        width: 100% !important;
        max-width: 100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .main-content .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .main-content [class*="col-"] {
        padding-left: 0 !important;
        padding-right: 0 !important;
        width: 100% !important;
    }

    .main-content .breadcomb-area,
    .main-content .data-table-area {
        width: 100% !important;
    }

    .main-content .breadcomb-list,
    .main-content .data-table-list {
        width: 100% !important;
        box-sizing: border-box;
    }

    .main-content .data-table-list {
        padding: 20px 24px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }

    .main-content .table-responsive {
        width: 100% !important;
        margin-bottom: 15px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: none;
    }

    .main-content table.dataTable,
    .main-content table.table {
        width: 100% !important;
    }

    .main-content .dataTables_wrapper {
        width: 100% !important;
        clear: both;
        box-sizing: border-box;
    }

    .main-content .dataTables_wrapper .dataTables_length,
    .main-content .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }

    .main-content .dataTables_wrapper .dataTables_info,
    .main-content .dataTables_wrapper .dataTables_paginate {
        margin-top: 15px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        transition: all var(--transition-speed) ease;
        border-left: 3px solid transparent;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
        font-size: 14px;
    }

    .sidebar-menu a:hover {
        background-color: #e9ecef;
        transform: translateX(3px);
        color: #20c997;
        text-decoration: none;
    }

    .sidebar-menu a:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: #20c997;
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform var(--transition-speed) ease;
    }

    .sidebar-menu a:hover:before {
        transform: scaleY(1);
    }

    .sidebar-menu .active > a {
        border-left: 3px solid #20c997;
        background-color: rgba(32, 201, 151, 0.1);
        color: #20c997;
        font-weight: 600;
    }

    .sidebar-submenu {
        max-height: 0;
        overflow: hidden;
        background-color: #e9ecef;
        padding-left: 15px;
        transition: max-height 0.4s ease, padding var(--transition-speed) ease;
    }

    .sidebar-submenu.show {
        max-height: 800px;
        overflow-y: auto;
    }

    .sidebar-submenu a {
        padding: 10px 15px;
        font-size: 13px;
        transition: all var(--transition-speed) ease;
    }

    .sidebar-submenu a:hover {
        padding-left: 22px;
    }

    .fa-chevron-down {
        transition: transform var(--transition-speed) ease;
        margin-left: auto;
        font-size: 11px;
        color: #888;
    }

    /* Mini Sidebar Styles */
    .sidebar-mini .sidebar-menu span {
        display: none;
    }

    .sidebar-mini .sidebar-menu .fa-chevron-down {
        display: none;
    }

    .sidebar-mini .sidebar-menu a {
        padding: 14px 0;
        justify-content: center;
        text-align: center;
    }

    .sidebar-mini .sidebar-menu a .menu-icon {
        margin-right: 0;
        width: 100%;
        font-size: 18px;
    }

    .sidebar-mini .sidebar-dropdown {
        position: relative;
    }

    .sidebar-mini .sidebar-submenu {
        position: absolute;
        left: var(--sidebar-mini-width);
        top: 0;
        width: 220px;
        background-color: #f8f9fa;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        display: none !important;
        padding-left: 0;
        max-height: none !important;
        border-radius: 0 8px 8px 0;
        border: 1px solid #dee2e6;
        z-index: 1050;
    }

    .sidebar-mini .sidebar-submenu a {
        justify-content: flex-start;
        padding: 10px 18px;
        text-align: left;
    }

    .sidebar-mini .sidebar-submenu a:hover {
        padding-left: 24px;
    }

    .sidebar-mini .sidebar-dropdown:hover > .sidebar-submenu {
        display: block !important;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .sidebar-wrapper {
            transform: translateX(-100%);
            width: var(--sidebar-width);
        }

        body.sidebar-mini .sidebar-wrapper {
            transform: translateX(0);
            width: var(--sidebar-width);
            overflow-y: auto !important;
        }

        body.sidebar-mini .sidebar-menu span {
            display: inline;
        }

        body.sidebar-mini .sidebar-menu .fa-chevron-down {
            display: inline-block;
        }

        body.sidebar-mini .sidebar-menu a {
            justify-content: flex-start;
            padding: 12px 20px;
            text-align: left;
        }

        body.sidebar-mini .sidebar-menu a .menu-icon {
            margin-right: 12px;
            width: 20px;
        }

        body.sidebar-mini .sidebar-submenu {
            position: static;
            width: 100%;
            box-shadow: none;
            border: none;
            border-radius: 0;
            padding-left: 15px;
        }

        .main-content {
            margin-left: 0 !important;
        }

        .sidebar-mini .main-content {
            margin-left: 0 !important;
        }
    }
</style>

<!-- Sidebar -->
<div class="sidebar-wrapper">
    <div class="sidebar-content">
        <ul class="sidebar-menu">

            <!-- Kementerian -->
            <li class="sidebar-dropdown">
                <a href="#" title="Kementerian">
                    <i class="menu-icon fa fa-university"></i>
                    <span>Kementerian</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Kementerian/Kementerian')?>">Daftar Kementerian</a>
                    <a href="<?=base_url('Kementerian/SPM')?>">SPM</a>
                    <a href="<?=base_url('Kementerian/SasaranStrategis')?>">Sasaran Strategis</a>
                    <a href="<?=base_url('Kementerian/ProgramStrategis')?>">Program Strategis</a>
                    <a href="<?=base_url('Kementerian/ProyekStrategis')?>">Proyek Strategis</a>
                </div>
            </li>

            <!-- Rencana Strategis -->
            <li class="sidebar-dropdown">
                <a href="#" title="Rencana Strategis">
                    <i class="menu-icon fa fa-file-text-o"></i>
                    <span>Rencana Strategis</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Kementerian/PermasalahanPokok')?>">Permasalahan Pokok</a>
                    <a href="<?=base_url('Kementerian/IsuKLHS')?>">Isu KLHS</a>
                    <a href="<?=base_url('Kementerian/IsuGlobal')?>">Isu Global</a>
                    <a href="<?=base_url('Kementerian/IsuNasional')?>">Isu Nasional</a>
                    <a href="<?=base_url('Kementerian/IsuRegional')?>">Isu Regional</a>
                    <a href="<?=base_url('Kementerian/IsuStrategis')?>">Isu Strategis</a>
                    <a href="<?=base_url('Kementerian/Renstra')?>">Rencana Strategis</a>
                    <a href="<?=base_url('Kementerian/Pendanaan')?>">Pendanaan</a>
                    <a href="<?=base_url('Kementerian/MatriksKinerja')?>">Matriks Kinerja</a>
                </div>
            </li>

            <!-- Rencana Kerja -->
            <li class="sidebar-dropdown">
                <a href="#" title="Rencana Kerja">
                    <i class="menu-icon fa fa-tasks"></i>
                    <span>Rencana Kerja</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Kementerian/renjaanggaranrekap1')?>">Rekap 1</a>
                    <a href="<?=base_url('Kementerian/renjaanggaranrekap2')?>">Rekap 2</a>
                    <a href="<?=base_url('Kementerian/renjaanggaranrekap3')?>">Rekap 3</a>
                </div>
            </li>

            <!-- NSPK -->
            <li class="sidebar-dropdown">
                <a href="#" title="NSPK">
                    <i class="menu-icon fa fa-book"></i>
                    <span>NSPK</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Kementerian/Nspk')?>">NSPK Kementerian</a>
                </div>
            </li>

        </ul>
    </div>
</div>

<script>
// Fungsi penyesuaian dinamis lebar DataTables
function adjustKementerianDataTables() {
    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.dataTable) {
        try {
            window.jQuery.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            if (window.jQuery.fn.dataTable.Responsive) {
                window.jQuery.fn.dataTable.tables({ visible: true, api: true }).responsive.recalc();
            }
        } catch(e) {
            try {
                window.jQuery('table.dataTable, table.table').each(function() {
                    if (window.jQuery.fn.DataTable && window.jQuery.fn.DataTable.isDataTable(this)) {
                        window.jQuery(this).DataTable().columns.adjust();
                    }
                });
            } catch(err) {}
        }
    }
    window.dispatchEvent(new Event('resize'));
}
window.adjustKementerianDataTables = adjustKementerianDataTables;

function triggerDynamicTableResize() {
    adjustKementerianDataTables();
    setTimeout(adjustKementerianDataTables, 50);
    setTimeout(adjustKementerianDataTables, 150);
    setTimeout(adjustKementerianDataTables, 320);
    setTimeout(adjustKementerianDataTables, 450);
}
window.triggerDynamicTableResize = triggerDynamicTableResize;

document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const mainContent = document.querySelector('.main-content');

    // Restore state from localStorage
    try {
        if (localStorage.getItem('sidebarMini') === 'true') {
            body.classList.add('sidebar-mini');
        }
    } catch(e) {}

    // Sidebar Toggle handler (fallback jika belum di-handle header)
    const sbToggle = document.getElementById('sidebarToggle');
    if (sbToggle && !sbToggle.dataset.hasToggleEvent) {
        sbToggle.dataset.hasToggleEvent = "true";
        sbToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (typeof toggleSidebar === 'function') {
                toggleSidebar(e);
            } else {
                body.classList.toggle('sidebar-mini');
                try {
                    localStorage.setItem('sidebarMini', body.classList.contains('sidebar-mini') ? 'true' : 'false');
                } catch(err) {}
                triggerDynamicTableResize();
            }
        });
    }

    // Sambungkan ResizeObserver pada main-content agar DataTables menyesuaikan secara instan dan mulus
    if (window.ResizeObserver && mainContent) {
        let resizeAnimFrame = null;
        const ro = new ResizeObserver(function() {
            if (resizeAnimFrame) cancelAnimationFrame(resizeAnimFrame);
            resizeAnimFrame = requestAnimationFrame(function() {
                adjustKementerianDataTables();
            });
        });
        ro.observe(mainContent);
    }

    if (mainContent) {
        mainContent.addEventListener('transitionend', function(e) {
            if (e.propertyName === 'margin-left' || e.propertyName === 'width') {
                adjustKementerianDataTables();
            }
        });
    }

    function closeDropdown(li) {
        li.classList.remove('active');
        const submenu = li.querySelector(':scope > .sidebar-submenu') || li.querySelector('.sidebar-submenu');
        if (submenu) {
            submenu.classList.remove('show');
            submenu.style.maxHeight = '0';
        }
        const chev = li.querySelector(':scope > a .fa-chevron-down') || li.querySelector('.fa-chevron-down');
        if (chev) chev.style.transform = 'rotate(0deg)';
    }

    function openDropdown(li) {
        li.classList.add('active');
        const submenu = li.querySelector(':scope > .sidebar-submenu') || li.querySelector('.sidebar-submenu');
        if (submenu) {
            submenu.classList.add('show');
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
        }
        const chev = li.querySelector(':scope > a .fa-chevron-down') || li.querySelector('.fa-chevron-down');
        if (chev) chev.style.transform = 'rotate(180deg)';
    }

    // Toggle dropdown click (hide / tampil submenu)
    document.querySelectorAll('.sidebar-dropdown > a').forEach(a => {
        a.addEventListener('click', function (e) {
            // Jika sidebar sedang mini dan di desktop, jangan toggle accordion vertikal
            if (body.classList.contains('sidebar-mini') && window.innerWidth > 768) {
                return;
            }

            e.preventDefault();

            const li = this.parentElement;
            const submenu = li.querySelector(':scope > .sidebar-submenu') || li.querySelector('.sidebar-submenu');

            if (!submenu) return;

            const isOpen = li.classList.contains('active');

            if (li.parentElement.classList.contains('sidebar-menu')) {
                document.querySelectorAll('.sidebar-menu > .sidebar-dropdown').forEach(item => {
                    if (item !== li) {
                        closeDropdown(item);
                    }
                });
            }

            if (!isOpen) {
                openDropdown(li);
            } else {
                closeDropdown(li);
            }
        });
    });

    // Highlight menu aktif berdasarkan URL
    const currentPath = window.location.pathname.replace(/\/+$/, '').toLowerCase();
    document.querySelectorAll('.sidebar-submenu a').forEach(link => {
        const href = link.getAttribute('href');
        if (!href) return;

        try {
            const linkPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();
            if (linkPath === currentPath) {
                link.style.color = '#20c997';
                link.style.fontWeight = 'bold';

                let parent = link.closest('.sidebar-dropdown');
                while (parent) {
                    openDropdown(parent);
                    parent = parent.parentElement.closest('.sidebar-dropdown');
                }
            }
        } catch(e) {}
    });
});
</script>