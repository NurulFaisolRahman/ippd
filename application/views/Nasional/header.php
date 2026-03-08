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
    <style>
        /* ==========================================
           MODERN CSS VARIABLES
           ========================================== */
        :root {
            --primary-color: #20c997;
            --primary-dark: #17a57a;
            --primary-light: #e6f9f3;
            --text-main: #2d3748;
            --text-muted: #4a5568; 
            --transition-speed: 0.35s;
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 25px -5px rgba(32, 201, 151, 0.15);
        }

        /* ==========================================
           NAVBAR STYLES (Modern & Elegant)
           ========================================== */
        .navbar {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            padding: 0.8rem 2rem;
            border-radius: 0 0 16px 16px;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 1000;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .navbar-brand {
            color: white;
            font-weight: 800;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem; 
        }

        .navbar-item {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            padding: 0.6rem 0.8rem;
            border-radius: 8px;
            position: relative;
            transition: all var(--transition-speed) ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 1.1rem; /* Ukuran font menu utama diperbesar */
        }

        .navbar-item i.menu-icon {
            margin-right: 6px;
            font-size: 1.2rem; /* Ukuran icon diperbesar menyesuaikan font */
        }

        .navbar-item:hover, .navbar-item.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            text-decoration: none;
        }

        /* ==========================================
           DROPDOWN & SUBMENU STYLES
           ========================================== */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 250px; /* Diperlebar sedikit agar muat dengan font yang lebih besar */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            border-radius: 12px;
            top: 100%; 
            margin-top: 10px; 
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid rgba(0,0,0,0.05);
            padding: 0.5rem;
        }

        /* Jembatan tak terlihat untuk memperbaiki masalah hover (gap issue) */
        .dropdown-content::after {
            content: '';
            position: absolute;
            top: -15px; 
            left: 0;
            right: 0;
            height: 15px;
            background: transparent;
        }

        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 12px;
            height: 12px;
            background-color: white;
            border-top: 1px solid rgba(0,0,0,0.05);
            border-left: 1px solid rgba(0,0,0,0.05);
            z-index: 1; 
        }

        .dropdown:hover .dropdown-content {
            display: block;
            animation: fadeInDrop 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInDrop {
            from { opacity: 0; transform: translate(-50%, -10px); }
            to { opacity: 1; transform: translate(-50%, 0); }
        }

        .dropdown-item {
            color: var(--text-main);
            padding: 0.8rem 1.2rem;
            text-decoration: none;
            display: block;
            transition: all var(--transition-speed) ease;
            white-space: nowrap;
            border-radius: 8px;
            margin-bottom: 2px;
            font-weight: 500;
            font-size: 1.05rem; /* Ukuran font dropdown item diperbesar */
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            transform: translateX(4px);
        }

        /* Submenu adjustments */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-item:after {
            content: "\f105"; 
            font-family: "Font Awesome 5 Free", "FontAwesome";
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
            transition: color var(--transition-speed);
        }

        .dropdown-submenu > .dropdown-item:hover:after {
            color: var(--primary-color);
        }

        .dropdown-submenu .dropdown-submenu-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            margin-left: 5px; 
            background-color: white;
            min-width: 220px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            z-index: 1002;
            border-radius: 12px;
            padding: 0.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* Jembatan transparan untuk submenu agar tidak hilang saat cursor bergeser ke kanan */
        .dropdown-submenu .dropdown-submenu-content::after {
            content: '';
            position: absolute;
            top: 0;
            left: -15px; 
            width: 15px;
            height: 100%;
            background: transparent;
        }

        .dropdown-submenu:hover > .dropdown-submenu-content {
            display: block;
            animation: fadeInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translate(-10px, 0); }
            to { opacity: 1; transform: translate(0, 0); }
        }

        /* ==========================================
           LOGOUT / LOGIN BUTTONS
           ========================================== */
        .logout-btn, .Login-btn {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            transition: all var(--transition-speed) ease;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-size: 1rem;
            margin-left: 10px;
        }

        .logout-btn:hover, .Login-btn:hover {
            background-color: white;
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        
        /* ==========================================
           RESPONSIVE & MOBILE
           ========================================== */
        @media (max-width: 992px) {
            .navbar {
                padding: 1rem;
                border-radius: 0;
            }

            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.5rem;
                width: 100%;
            }
            
            .dropdown-content {
                position: static;
                transform: none;
                width: 100%;
                display: none;
                box-shadow: none;
                border: none;
                background-color: rgba(255,255,255,0.05);
                margin-top: 5px;
            }

            .dropdown-content::before, .dropdown-content::after {
                display: none;
            }
            
            .dropdown-submenu .dropdown-submenu-content {
                position: static;
                border-radius: 8px;
                margin-top: 5px;
                margin-left: 0;
                box-shadow: none;
                background-color: rgba(0,0,0,0.02);
            }

            .dropdown-submenu .dropdown-submenu-content::after {
                display: none;
            }
            
            .dropdown.active .dropdown-content,
            .dropdown-submenu.active > .dropdown-submenu-content {
                display: block;
            }
            
            .logout-btn, .Login-btn {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* Remove click outlines */
        button:focus, a:focus {
            outline: none;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/ippd/Beranda" class="navbar-brand">
                <i class="fas fa-chart-line"></i>
                &nbsp;IPPD
            </a>
            <div class="navbar-menu">
                
                <!-- Menu RPJPN -->
                <div class="dropdown">
                    <a href="#" class="navbar-item"><i class="fas fa-landmark menu-icon"></i> RPJPN <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="<?=base_url('Nasional/VisiRPJPN')?>" class="dropdown-item">VMTS</a>
                        <a href="<?=base_url('Nasional/TahapanRPJPN')?>" class="dropdown-item">Tahapan</a>
                        <a href="<?=base_url('Nasional/IUPRPJPN')?>" class="dropdown-item">Indikator Utama Pembangunan</a>
                    </div>
                </div>

                <!-- Menu RPJMN -->
                <div class="dropdown">
                    <a href="#" class="navbar-item"><i class="fas fa-map-marked-alt menu-icon"></i> RPJMN <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="<?=base_url('Nasional/VisiRPJMN')?>" class="dropdown-item">VMTS</a>
                        <a href="<?=base_url('Nasional/TahapanRPJMN')?>" class="dropdown-item">Tahapan</a>
                        <a href="<?=base_url('Nasional/IUPRPJMN')?>" class="dropdown-item">Indikator Utama Pembangunan</a>
                        <a href="<?=base_url('Nasional/SasaranPembangunanRPJMN')?>" class="dropdown-item">Sasaran Pembangunan Nasional</a>
                        <a href="<?=base_url('Nasional/SasaranPembangunanDaerah')?>" class="dropdown-item">Sasaran Pembangunan Wilayah</a>
                        <a href="<?=base_url('Nasional/PembangunanKewilayahanRPJMN')?>" class="dropdown-item">Pembangunan Kewilayahan</a>
                        <a href="<?=base_url('Nasional/ProyekStrategisRPJMN')?>" class="dropdown-item">Proyek Strategis Nasional</a>
                        <!-- <a href="<?=base_url('Nasional/PrioritasNasionalRPJMN')?>" class="dropdown-item">Prioritas Nasional</a>
                        <a href="<?=base_url('Nasional/ProgramPrioritasRPJMN')?>" class="dropdown-item">Program Prioritas</a>
                        <a href="<?=base_url('Nasional/KegiatanPrioritasRPJMN')?>" class="dropdown-item">Kegiatan Prioritas</a>
                        <a href="<?=base_url('Nasional/ProyekPrioritasRPJMN')?>" class="dropdown-item">Proyek Prioritas</a> -->
                    </div>
                </div>

                <!-- Menu RKP -->
                <div class="dropdown">
                    <a href="#" class="navbar-item"><i class="fas fa-tasks menu-icon"></i> RKP <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="<?=base_url('Nasional/TemaRKP')?>" class="dropdown-item">Tema Rencana Kerja Pemerintah</a>
                        <a href="<?=base_url('Nasional/SasaranPembangunanRKP')?>" class="dropdown-item">Sasaran Pembangunan</a>
                        <a href="<?=base_url('Nasional/SasaranPrioritasNasional')?>" class="dropdown-item">Sasaran Prioritas Nasional</a>
                        <a href="<?=base_url('Nasional/IndikasiIntervensi')?>" class="dropdown-item">Indikasi Intervensi Prioritas Nasional</a>
                    </div>
                </div>
                
                <!-- Menu Laporan Sakip (Dipindah sebelum Kontak) -->
                <div class="dropdown">
                    <a href="#" class="navbar-item">Laporan Sakip <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
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
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
                <?php } ?>
            </div>
        </div>
    </nav>

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
            // Handle mobile menu clicks (Ubah Hover menjadi Click pada Mobile View)
            if (window.innerWidth <= 992) {
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
                        if (window.innerWidth <= 992 && this.nextElementSibling && 
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
                        if (window.innerWidth <= 992) {
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
</body>
</html>