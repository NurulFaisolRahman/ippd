<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Super Admin IPPD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    
    <!-- CSS Utama -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/meanmenu/meanmenu.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/wave/button.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/notika-custom-icon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/responsive.css'); ?>">
    
    <!-- Tailwind & Font Awesome & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .navbar {
            background-color: #20c997;
            padding: 0 1.25rem !important;
            height: 64px !important;
            border-radius: 0 !important;
            border: none !important;
            margin: 0 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 99999 !important;
        }

        /* Modal Positioning & Centering */
        .modal {
            text-align: center !important;
            padding: 0 !important;
            z-index: 105000 !important;
            overflow-y: auto !important;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block !important;
            text-align: left !important;
            vertical-align: middle !important;
            margin: 30px auto !important;
        }

        .modal-backdrop {
            z-index: 104990 !important;
        }

        .select2-container--open,
        .select2-dropdown {
            z-index: 105050 !important;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            min-width: 0;
            height: 100%;
        }

        .sidebar-header-btn {
            background: transparent;
            border: none;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
            flex-shrink: 0;
            font-size: 1.15rem;
        }

        .sidebar-header-btn:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.05);
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            pointer-events: none;
        }

        .navbar-center a {
            pointer-events: auto;
        }

        /* Brand */
        .navbar-brand {
            color: #fff;
            font-weight: 900;
            font-size: 1.3rem;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            letter-spacing: .5px;
            user-select: none;
            flex-shrink: 0;
            margin: 0;
            line-height: 1;
        }

        .navbar-brand:hover {
            color: #fff;
            text-decoration: none;
        }

        .navbar-brand i { 
            margin-right: .5rem; 
            line-height: 1; 
        }

        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: 1000px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.28);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            line-height: 1;
            white-space: nowrap;
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-left: auto;
            justify-content: flex-end;
            flex-shrink: 0;
            height: 100%;
        }

        .navbar-item {
            color: rgba(255,255,255,0.92);
            font-weight: 600;
            padding: .5rem 0;
            display: inline-flex;
            align-items: center;
            margin: 0;
            line-height: 1;
            position: relative;
            transition: all .25s ease;
            text-decoration: none;
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .navbar-item:hover { 
            color: #fff; 
            text-decoration: none; 
        }

        .dropdown { 
            position: relative; 
            display: inline-flex; 
            align-items: center; 
            height: 100%; 
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 220px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            z-index: 1201;
            border-radius: 8px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid rgba(0,0,0,0.1);
            padding: 6px 0;
        }

        .dropdown:hover .dropdown-content { 
            display: block; 
        }

        .dropdown-item {
            color: #4b5563;
            padding: .75rem 1.1rem;
            text-decoration: none;
            display: block;
            transition: all .25s ease;
            white-space: nowrap;
            position: relative;
            font-size: 0.92rem;
            font-weight: 500;
        }

        .dropdown-item:hover { 
            background-color: #f3f4f6; 
            color: #20c997; 
            text-decoration: none;
        }

        .dropdown-submenu { 
            position: relative; 
        }

        .dropdown-submenu > .dropdown-item:after {
            content: "▸";
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.85rem;
        }

        .dropdown-submenu .dropdown-submenu-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            z-index: 1202;
            border-radius: 0 8px 8px 8px;
            border: 1px solid rgba(0,0,0,0.1);
            border-left: none;
            padding: 6px 0;
        }

        .dropdown-submenu:hover > .dropdown-submenu-content { 
            display: block; 
        }

        .logout-btn {
            background-color: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.25);
            padding: .55rem 1rem;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            font-weight: 700;
            line-height: 1;
            transition: all .25s ease;
            cursor: pointer;
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .logout-btn:hover { 
            background-color: rgba(255,255,255,0.3); 
            color: white;
        }

        .page-top-space { 
            height: 64px !important; 
            display: block !important; 
            margin: 0 !important; 
            padding: 0 !important; 
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: row !important;
                align-items: center !important;
                gap: 10px;
            }
            .navbar-center {
                display: none;
            }
            .navbar-menu {
                margin-left: auto;
                justify-content: flex-end;
                gap: .75rem;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .dropdown-content {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

<?php
  $LoginInfo = '';
  if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 0) {
    $LoginInfo = $_SESSION['Username'] ?? 'Super Admin';
  } elseif (!empty($_SESSION['Username'])) {
    $LoginInfo = $_SESSION['Username'];
  }
?>

<!-- Top Navbar Header -->
<nav class="navbar">
    <div class="navbar-container">

        <!-- Sisi Kiri: Sidebar Toggle & Info Login -->
        <div class="navbar-left">
            <button id="sidebarToggle" class="sidebar-header-btn" type="button" aria-label="Toggle sidebar" title="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>

            <?php if (!empty($LoginInfo)) { ?>
                <span class="login-badge" title="Pengguna: <?= html_escape($LoginInfo) ?>">
                    <i class="fas fa-user"></i>
                    <?= html_escape($LoginInfo) ?>
                </span>
            <?php } ?>
        </div>

        <!-- Sisi Tengah: Judul / Brand -->
        <div class="navbar-center">
            <a href="<?= base_url('Nasional/VisiRPJPN'); ?>" class="navbar-brand">
                <i class="fas fa-chart-line"></i>
                Sistem Perencanaan Daerah
            </a>
        </div>

        <!-- Sisi Kanan: Menu Laporan Sakip, Kontak, Tentang Kami & Login/Logout -->
        <div class="navbar-menu">

            <!-- Menu Laporan Sakip -->
            <div class="dropdown">
                <a href="#" class="navbar-item">
                    Laporan Sakip <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i>
                </a>
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

            <!-- Kontak Menu -->
            <a href="mailto:info@ippd.example.com" class="navbar-item">Kontak</a>
            
            <!-- Tentang Kami Menu -->
            <a href="#" class="navbar-item">Tentang Kami</a>

            <!-- Tombol Logout / Login -->
            <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 0) { ?>
                <button class="logout-btn" onclick="logout()" type="button">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            <?php } else { ?>
                <button class="logout-btn" onclick="Login()" type="button">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            <?php } ?>
        </div>

    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="page-top-space"></div>

<!-- Load Sidebar Nasional (RPJPN, RPJMN, RKP) -->
<?php $this->load->view('Nasional/sidebar'); ?>

<script>
    function logout() {
        window.location.href = '/ippd/Home';
    }

    function Login() {
        window.location.href = '/ippd/Home';
    }

    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('sidebarToggle');
        if (!btn) return;

        if (localStorage.getItem('sidebarMini') === 'true') {
            document.body.classList.add('sidebar-mini');
        }

        btn.addEventListener('click', function () {
            document.body.classList.toggle('sidebar-mini');
            localStorage.setItem('sidebarMini', document.body.classList.contains('sidebar-mini'));
        });
    });
</script>