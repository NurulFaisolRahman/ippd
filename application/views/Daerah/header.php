<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin IPPD</title>
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
                
                <!-- Menu Daerah dengan Submenu -->
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
                
                <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 3) { ?>
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
</body>
</html>