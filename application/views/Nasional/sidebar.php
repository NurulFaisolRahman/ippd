<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
if (defined('NASIONAL_SIDEBAR_LOADED')) { return; }
define('NASIONAL_SIDEBAR_LOADED', true);
?>

<!-- CSS & Icons for Sidebar -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --sidebar-width: 280px;
        --sidebar-mini-width: 70px;
        --transition-speed: 0.3s;
        --theme-primary: #20c997;
        --theme-dark: #17a57a;
    }

    .menu-icon {
        margin-right: 12px;
        width: 20px;
        text-align: center;
        color: var(--theme-primary);
        font-size: 16px;
    }

    .sidebar-menu .bi {
        margin-right: 12px;
        width: 20px;
        text-align: center;
        color: var(--theme-primary);
        font-size: 1.25rem;
        display: inline-block;
        vertical-align: middle;
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
        box-shadow: 2px 0 6px rgba(0,0,0,0.08);
        z-index: 999;
        overflow-y: auto;
        transition: all var(--transition-speed) ease;
    }

    .sidebar-menu {
        padding-bottom: 120px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-mini .sidebar-wrapper {
        width: var(--sidebar-mini-width);
    }
    
    /* Main Content Shift */
    .main-content,
    .data-table-area {
        margin-left: var(--sidebar-width) !important;
        padding: 20px 15px !important;
        min-height: calc(100vh - 64px);
        transition: all var(--transition-speed) ease;
    }
    
    .sidebar-mini .main-content,
    .sidebar-mini .data-table-area {
        margin-left: var(--sidebar-mini-width) !important;
    }

    .data-table-area .container {
        width: 100% !important;
        max-width: 100% !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
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
        font-weight: 500;
    }
    
    .sidebar-menu a:hover {
        background-color: #e9ecef;
        transform: translateX(4px);
        text-decoration: none;
        color: #111;
    }
    
    .sidebar-menu a:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: var(--theme-primary);
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform var(--transition-speed) ease;
    }
    
    .sidebar-menu a:hover:before {
        transform: scaleY(1);
    }
    
    .sidebar-menu .active > a {
        border-left: 3px solid var(--theme-primary);
        background-color: rgba(32, 201, 151, 0.1);
        color: var(--theme-dark);
        font-weight: 700;
    }
    
    .sidebar-submenu {
        max-height: 0;
        overflow: hidden;
        background-color: #e9ecef;
        padding-left: 15px;
        transition: max-height 0.4s ease, padding var(--transition-speed) ease;
    }

    .sidebar-submenu.show {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .sidebar-submenu a {
        padding: 10px 15px;
        transition: all var(--transition-speed) ease;
        font-size: 13px;
        color: #495057;
    }
    
    .sidebar-submenu a:hover {
        padding-left: 22px;
        background-color: #dee2e6;
        color: #212529;
    }

    .sidebar-submenu a.active-link {
        color: var(--theme-primary) !important;
        font-weight: 700 !important;
        background-color: rgba(32, 201, 151, 0.15) !important;
        border-left: 3px solid var(--theme-primary) !important;
    }
    
    .sidebar-menu .fa-chevron-down {
        transition: transform var(--transition-speed) ease;
        margin-left: auto;
        font-size: 12px;
        color: #888;
    }

    /* Mini Sidebar Styles */
    .sidebar-mini .sidebar-menu span {
        display: none;
    }
    
    .sidebar-mini .sidebar-menu .fa-chevron-down {
        display: none;
    }
    
    .sidebar-mini .sidebar-submenu {
        position: absolute;
        left: var(--sidebar-mini-width);
        top: 0;
        width: 250px;
        background-color: #f8f9fa;
        box-shadow: 2px 4px 12px rgba(0,0,0,0.15);
        display: none !important;
        padding-left: 0;
        max-height: none !important;
        border-radius: 0 8px 8px 0;
        z-index: 1000;
    }
    
    .sidebar-mini .sidebar-dropdown:hover .sidebar-submenu {
        display: block !important;
    }
    
    .sidebar-mini .sidebar-dropdown {
        position: relative;
    }

    /* Animation */
    @keyframes fadeInSidebar {
        from { opacity: 0; transform: translateX(-15px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .sidebar-menu > li {
        animation: fadeInSidebar 0.4s ease forwards;
        opacity: 0;
    }
    
    .sidebar-menu > li:nth-child(1) { animation-delay: 0.05s; }
    .sidebar-menu > li:nth-child(2) { animation-delay: 0.10s; }
    .sidebar-menu > li:nth-child(3) { animation-delay: 0.15s; }
    .sidebar-menu > li:nth-child(4) { animation-delay: 0.20s; }
    .sidebar-menu > li:nth-child(5) { animation-delay: 0.25s; }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .sidebar-wrapper {
            transform: translateX(-100%);
            width: var(--sidebar-width);
        }
        
        body.sidebar-mini .sidebar-wrapper {
            transform: translateX(0);
            width: var(--sidebar-width);
        }
        
        .main-content,
        .data-table-area {
            margin-left: 0 !important;
        }
        
        body.sidebar-mini .main-content,
        body.sidebar-mini .data-table-area {
            margin-left: 0 !important;
        }
    }
</style>

<!-- Sidebar HTML -->
<div class="sidebar-wrapper">
    <div class="sidebar-content">
        <ul class="sidebar-menu">

            <!-- RPJPN -->
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="menu-icon fa fa-area-chart"></i>
                    <span>RPJPN</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Nasional/VisiRPJPN')?>">Visi Pembangunan</a>
                    <a href="<?=base_url('Nasional/MisiRPJPN')?>">Misi Pembangunan</a>
                    <a href="<?=base_url('Nasional/TahapanRPJPN')?>">Tahapan Pembangunan</a>
                    <a href="<?=base_url('Nasional/IUPRPJPN')?>">Arah Pembangunan dan IUP</a>
                </div>
            </li>

            <!-- RPJMN -->
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="menu-icon fa fa-line-chart"></i>
                    <span>RPJMN</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Nasional/VisiRPJMN')?>">Visi & Misi Presiden</a>
                    <a href="<?=base_url('Nasional/SasaranPembangunanRPJMN')?>">Sasaran Pembangunan Nasional</a>
                    <a href="<?=base_url('Nasional/TahapanRPJMN')?>">Tahapan</a>
                    <a href="<?=base_url('Nasional/IUPRPJMN')?>">Agenda Pembangunan (PN/PP/KP)</a>
                    <a href="<?=base_url('Nasional/ProyekStrategisRPJMN')?>">Proyek Strategis Nasional</a>
                    <a href="<?=base_url('Nasional/SasaranPembangunanDaerah')?>">Sasaran Pembangunan Wilayah</a>
                    <a href="<?=base_url('Nasional/PembangunanKewilayahanRPJMN')?>">Pembangunan Kewilayahan</a>
                </div>
            </li>

            <!-- RKP -->
            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-file-text-fill"></i>
                    <span>RKP</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Nasional/TemaRKP')?>">Tema RKP</a>
                    <a href="<?=base_url('Nasional/SasaranPembangunanRKP')?>">Sasaran Pembangunan</a>
                    <a href="<?=base_url('Nasional/MatriksPembangunan')?>">Matriks Pembangunan</a>
                    <a href="<?=base_url('Nasional/ArahPembangunanKewilayahan')?>">Arah Pembangunan Kewilayahan</a>
                </div>
            </li>

        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Helper function to open dropdown
    function openDropdown(item) {
        item.classList.add('active');
        const submenu = item.querySelector(':scope > .sidebar-submenu');
        if (submenu) submenu.classList.add('show');
        const icon = item.querySelector(':scope > a .fa-chevron-down');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }

    // Toggle Dropdown Accordion
    document.querySelectorAll('.sidebar-dropdown > a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const li = this.parentElement;
            const submenu = li.querySelector(':scope > .sidebar-submenu');
            const isOpen = submenu && submenu.classList.contains('show');

            // Close other sibling dropdowns
            const siblings = li.parentElement.querySelectorAll(':scope > .sidebar-dropdown');
            siblings.forEach(sibling => {
                if (sibling !== li) {
                    sibling.classList.remove('active');
                    const sm = sibling.querySelector(':scope > .sidebar-submenu');
                    if (sm) sm.classList.remove('show');
                    const icon = sibling.querySelector(':scope > a .fa-chevron-down');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                }
            });

            if (!isOpen && submenu) {
                li.classList.add('active');
                submenu.classList.add('show');
                const icon = this.querySelector('.fa-chevron-down');
                if (icon) icon.style.transform = 'rotate(180deg)';
            } else if (submenu) {
                li.classList.remove('active');
                submenu.classList.remove('show');
                const icon = this.querySelector('.fa-chevron-down');
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Highlight Menu Aktif Berdasarkan URL
    const currentPath = window.location.pathname.replace(/\/+$/, '').toLowerCase();
    document.querySelectorAll('.sidebar-submenu a').forEach(link => {
        const href = link.getAttribute('href');
        if (!href) return;
        try {
            const linkPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '').toLowerCase();
            if (linkPath === currentPath) {
                link.classList.add('active-link');

                // Open parent dropdown
                let parent = link.closest('.sidebar-dropdown');
                while (parent) {
                    openDropdown(parent);
                    const next = parent.parentElement.closest('.sidebar-dropdown');
                    parent = next;
                }
            }
        } catch(e) {}
    });
});
</script>
