<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Super Admin IPPD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/meanmenu/meanmenu.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/wave/button.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/notika-custom-icon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/responsive.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/notika-custom-icon.css">
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-editable.css">
    <style>
        /* Navbar Styles */
        .navbar {
            background-color:#20c997;
            padding: 1rem 2rem;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .navbar-item {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            padding: 0.5rem 0;
            position: relative;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .navbar-item:hover {
            color: white;
            text-decoration: none;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 20px 0px rgba(0,0,0,0.15);
            z-index: 1001;
            border-radius: 8px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid rgba(0,0,0,0.1);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            color: #4b5563;
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #20c997;
        }

        /* Submenu Styles */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-item:after {
            content: "▸";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .dropdown-submenu .dropdown-submenu-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 20px 0px rgba(0,0,0,0.15);
            z-index: 1002;
            border-radius: 0 8px 8px 0;
            border: 1px solid rgba(0,0,0,0.1);
            border-left: none;
        }

        .dropdown-submenu:hover > .dropdown-submenu-content {
            display: block;
        }

        /* Logout Button */
        .logout-btn {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .dropdown-content {
                position: static;
                transform: none;
                width: 100%;
                display: none;
            }
            
            .dropdown-submenu .dropdown-submenu-content {
                position: static;
                border-radius: 0 0 8px 8px;
                border-left: 1px solid rgba(0,0,0,0.1);
                margin-left: 15px;
                box-shadow: none;
            }
            
            .dropdown.active .dropdown-content {
                display: block;
            }
            
            .dropdown-submenu.active > .dropdown-submenu-content {
                display: block;
            }
        }

        /* Remove click effects */
        .navbar-item:focus,
        .navbar-item:active,
        .dropdown-item:focus,
        .dropdown-item:active,
        .logout-btn:focus,
        .logout-btn:active {
            outline: none;
            box-shadow: none;
            background-color: transparent !important;
        }

        /* Ensure main content doesn't get overlapped */
        .main-content-wrapper {
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }

        /* Additional fix for dropdown arrow */
        .dropdown .navbar-item i.fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .dropdown:hover .navbar-item i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Sidebar  */
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
        }
        
        /* Sidebar Styles */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            background-color: #f8f9fa;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 70px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 999;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-mini .sidebar-wrapper {
            width: var(--sidebar-mini-width);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-mini .main-content {
            margin-left: var(--sidebar-mini-width);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
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
        }
        
        .sidebar-menu a:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
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
        }
        
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            background-color: #e9ecef;
            padding-left: 15px;
            transition: max-height 0.5s ease, padding var(--transition-speed) ease;
        }
        
        .sidebar-submenu.show {
            max-height: 500px; /* Adjust based on your content */
        }
        
        .sidebar-submenu a {
            padding: 10px 15px;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-submenu a:hover {
            padding-left: 25px;
        }
        
        .sidebar-submenu .sidebar-submenu {
            background-color: #dee2e6;
        }
        
        .sidebar-submenu .sidebar-submenu a {
            padding: 8px 15px;
        }
        
        .fa-chevron-down {
            transition: transform var(--transition-speed) ease;
            margin-left: auto;
        }
        
        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background-color: #20c997;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            border-radius: 50%;
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
            background-color: #1aa67d;
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
            width: 200px;
            background-color: #f8f9fa;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            display: none !important;
            padding-left: 0;
            max-height: none !important;
        }
        
        .sidebar-mini .sidebar-dropdown:hover .sidebar-submenu {
            display: block !important;
        }
        
        .sidebar-mini .sidebar-dropdown {
            position: relative;
        }
        
        /* Table Styles */
        .data-table-list {
            margin-top: 20px;
        }
        
        .button-icon-btn {
            display: flex;
            gap: 5px;
        }
        
        /* Animation for sidebar items */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .sidebar-menu li {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }
        
        /* Delay animations for each item */
        .sidebar-menu li:nth-child(1) { animation-delay: 0.1s; }
        .sidebar-menu li:nth-child(2) { animation-delay: 0.2s; }
        .sidebar-menu li:nth-child(3) { animation-delay: 0.3s; }
        .sidebar-menu li:nth-child(4) { animation-delay: 0.4s; }
        .sidebar-menu li:nth-child(5) { animation-delay: 0.5s; }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }
            
            .sidebar-mini .sidebar-wrapper {
                transform: translateX(0);
                width: var(--sidebar-mini-width);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-mini .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                left: 15px;
            }
            
            .sidebar-mini .sidebar-toggle {
                left: calc(var(--sidebar-mini-width) - 20px);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/ippd/Beranda" class="navbar-brand">
                <i class="fas fa-chart-line"></i>
                IPPD
            </a>
            <div class="navbar-menu">
                <!-- Menu Nasional dengan Submenu -->
                <div class="dropdown">
                    <a href="#" class="navbar-item active">Laporan Sakip <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Perencanaan</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Nasional/VisiRPJPN')?>" class="dropdown-item">Nasional</a>
                                <a href="<?=base_url('Kementerian/Kementerian')?>" class="dropdown-item">Kementerian</a>
                                <a href="<?=base_url('Provinsi/VisiRPJPD')?>" class="dropdown-item">Provinsi</a>
                                <a href="<?=base_url('Daerah/VisiRPJPD')?>" class="dropdown-item">Daerah</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Pengukuran</a>
                            <div class="dropdown-submenu-content">
                                <a href="#" class="dropdown-item">Nasional</a>
                                <a href="#" class="dropdown-item">Kementerian</a>
                                <a href="#" class="dropdown-item">Provinsi</a>
                                <a href="#" class="dropdown-item">Daerah</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Pelaporan</a>
                            <div class="dropdown-submenu-content">
                                <a href="#" class="dropdown-item">Nasional</a>
                                <a href="#" class="dropdown-item">Kementerian</a>
                                <a href="#" class="dropdown-item">Provinsi</a>
                                <a href="#" class="dropdown-item">Daerah</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Evaluasi</a>
                            <div class="dropdown-submenu-content">
                                <a href="#" class="dropdown-item">Nasional</a>
                                <a href="#" class="dropdown-item">Kementerian</a>
                                <a href="#" class="dropdown-item">Provinsi</a>
                                <a href="#" class="dropdown-item">Daerah</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Prestasi</a>
                            <div class="dropdown-submenu-content">
                                <a href="#" class="dropdown-item">Nasional</a>
                                <a href="#" class="dropdown-item">Kementerian</a>
                                <a href="#" class="dropdown-item">Provinsi</a>
                                <a href="#" class="dropdown-item">Daerah</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Kontak Menu (tanpa dropdown) -->
                <a href="mailto:info@ippd.example.com" class="navbar-item">Kontak</a>
                
                <!-- Tentang Kami Menu (tanpa dropdown) -->
                <a href="#" class="navbar-item">Tentang Kami</a>
                
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) { ?>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
                <?php } else { ?>
                <button class="Login-btn" onclick="Login()">
                    <i class="fas fa-sign-out-alt"></i>
                    Login
                </button>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <div class="sidebar-content">
            <ul class="sidebar-menu">
                <br>
                <!-- RPJPN -->
                <div class="sidebar-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-line-chart"></i>
                        <span>RPJPN</span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu" style="display: block;">
                        <a href="<?=base_url('Nasional/VisiRPJPN')?>">Visi</a>
                        <a href="<?=base_url('Nasional/MisiRPJPN')?>">Misi</a>
                        <a href="<?=base_url('Nasional/TujuanRPJPN')?>">Tujuan</a>
                        <a href="<?=base_url('Nasional/SasaranRPJPN')?>">Sasaran</a>
                        <a href="<?=base_url('Nasional/TahapanRPJPN')?>">Tahapan</a>
                        <a href="<?=base_url('Nasional/IUPRPJPN')?>">IUP RPJPN</a>
                        <br>
                    </div>
                </div>

                <!-- RPJMN -->
                <div class="sidebar-dropdown">
                    <a href="#">
                    <i class="menu-icon fa fa-area-chart"></i>
                    <span>RPJMN</span>
                    <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="<?=base_url('Nasional/VisiRPJMN')?>">Visi</a>
                        <a href="<?=base_url('Nasional/MisiRPJMN')?>">Misi</a>
                        <a href="<?=base_url('Nasional/TujuanRPJMN')?>">Tujuan</a>
                        <a href="<?=base_url('Nasional/SasaranRPJMN')?>">Sasaran</a>
                        <a href="<?=base_url('Nasional/PrioritasNasional')?>">Prioritas Nasional</a>
                        <a href="<?=base_url('Nasional/TahapanRPJMN')?>">Tahapan</a>
                        <a href="<?=base_url('Nasional/IUPRPJMN')?>">IUP RPJMN</a>
                        <br>
                    </div>
                </div>

                <!-- RKP -->
                <div class="sidebar-dropdown">
                    <a href="#">
                    <i class="menu-icon fa fa-area-chart"></i>
                    <span>RKP</span>
                    <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="<?=base_url('Nasional/SasaranPrioritasNasional')?>">Sasaran Prioritas Nasional</a>
                        <a href="<?=base_url('Nasional/SasaranPembangunanDaerah')?>">Sasaran Pembangunan Daerah</a>
                        <br>
                    </div>
                </div>
            </ul>
        </div>
    </div>
<script>
        // Log Out Clear Session in Controller Beranda
        function logout() {
            window.location.href = '/ippd';
        }

        // Redirect to Login
        function Login() {    
            window.location.href = '/ippd/Home';
        }

        // Mobile menu handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle mobile menu clicks
            if (window.innerWidth <= 768) {
                document.addEventListener('click', function(e) {
                    // Close all dropdowns if clicking outside
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-content, .dropdown-submenu-content').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(item => {
                            item.classList.remove('active');
                        });
                    }
                });

                // Toggle main dropdowns
                document.querySelectorAll('.navbar-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768 && this.nextElementSibling && 
                            this.nextElementSibling.classList.contains('dropdown-content')) {
                            e.preventDefault();
                            const dropdown = this.closest('.dropdown');
                            const content = dropdown.querySelector('.dropdown-content');
                            
                            // Close other dropdowns
                            document.querySelectorAll('.dropdown-content, .dropdown-submenu-content').forEach(menu => {
                                if (menu !== content) menu.style.display = 'none';
                            });
                            
                            // Toggle current dropdown
                            content.style.display = content.style.display === 'block' ? 'none' : 'block';
                            dropdown.classList.toggle('active');
                        }
                    });
                });

                // Toggle submenus
                document.querySelectorAll('.dropdown-submenu > .dropdown-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();
                            const submenu = this.nextElementSibling;
                            const isVisible = submenu.style.display === 'block';
                            
                            // Close all submenus first
                            document.querySelectorAll('.dropdown-submenu-content').forEach(sm => {
                                sm.style.display = 'none';
                            });
                            
                            // Toggle current submenu if it wasn't visible
                            if (!isVisible) {
                                submenu.style.display = 'block';
                                this.closest('.dropdown-submenu').classList.add('active');
                            }
                        }
                    });
                });
            }
        });
    </script>
    <script>
        var BaseURL = '<?=base_url()?>';
        
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const body = document.body;
            
            // Check if sidebar state is saved in localStorage
            if (localStorage.getItem('sidebarMini') === 'true') {
                body.classList.add('sidebar-mini');
            }
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-mini');
                // Save state to localStorage
                localStorage.setItem('sidebarMini', body.classList.contains('sidebar-mini'));
            });
            
            // Close all dropdowns except the active one
            document.querySelectorAll('.sidebar-dropdown').forEach(dropdown => {
                if (!dropdown.classList.contains('active')) {
                    const submenu = dropdown.querySelector('.sidebar-submenu');
                    if (submenu) {
                        submenu.style.maxHeight = '0';
                        submenu.style.padding = '0 15px';
                    }
                }
            });

            // Toggle sidebar dropdowns (for expanded sidebar)
            document.querySelectorAll('.sidebar-dropdown > a').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Only prevent default if sidebar is not minimized
                    if (!body.classList.contains('sidebar-mini')) {
                        e.preventDefault();
                        
                        const dropdown = this.parentElement;
                        const submenu = this.nextElementSibling;
                        
                        // Close other dropdowns at the same level
                        if (dropdown.parentElement.classList.contains('sidebar-menu') || 
                            dropdown.parentElement.classList.contains('sidebar-submenu')) {
                            const siblings = Array.from(dropdown.parentElement.children)
                                .filter(child => child !== dropdown);
                            
                            siblings.forEach(sibling => {
                                const siblingSubmenu = sibling.querySelector('.sidebar-submenu');
                                if (siblingSubmenu) {
                                    siblingSubmenu.style.maxHeight = '0';
                                    siblingSubmenu.style.padding = '0 15px';
                                }
                                sibling.classList.remove('active');
                                
                                // Reset chevron icon for siblings
                                const siblingChevron = sibling.querySelector('.fa-chevron-down');
                                if (siblingChevron) {
                                    siblingChevron.style.transform = 'rotate(0)';
                                }
                            });
                        }
                        
                        // Toggle current dropdown
                        if (submenu) {
                            if (dropdown.classList.contains('active')) {
                                submenu.style.maxHeight = '0';
                                submenu.style.padding = '0 15px';
                                dropdown.classList.remove('active');
                            } else {
                                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                                submenu.style.padding = '10px 15px';
                                dropdown.classList.add('active');
                            }
                            
                            // Rotate chevron icon
                            const chevron = this.querySelector('.fa-chevron-down');
                            if (chevron) {
                                chevron.style.transform = dropdown.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0)';
                            }
                        }
                    }
                });
            });
            
            // Highlight active menu item based on current URL
            const currentUrl = window.location.pathname;
            document.querySelectorAll('.sidebar-submenu a').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    link.style.color = '#20c997';
                    link.style.fontWeight = 'bold';
                    
                    // Expand parent menus
                    let parent = link.closest('.sidebar-submenu');
                    while (parent) {
                        parent.style.maxHeight = parent.scrollHeight + 'px';
                        parent.style.padding = '10px 15px';
                        const parentDropdown = parent.previousElementSibling;
                        if (parentDropdown) {
                            parentDropdown.style.color = '#20c997';
                            const chevron = parentDropdown.querySelector('.fa-chevron-down');
                            if (chevron) chevron.style.transform = 'rotate(180deg)';
                            parentDropdown.parentElement.classList.add('active');
                        }
                        parent = parent.parentElement.closest('.sidebar-submenu');
                    }
                }
            });
            
            // Add hover effect animation
            document.querySelectorAll('.sidebar-menu a').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>