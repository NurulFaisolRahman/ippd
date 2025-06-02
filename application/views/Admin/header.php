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

        /* Dropdown Styles - Fixed Version */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 180px;
            box-shadow: 0px 8px 20px 0px rgba(0,0,0,0.15);
            z-index: 9999; /* Increased z-index */
            border-radius: 8px;
            overflow: hidden;
            top: calc(100% + 5px); /* Added small gap */
            left: 50%;
            transform: translateX(-50%); /* Center the dropdown */
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.1);
        }

        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
            visibility: visible;
        }

        .dropdown-item {
            color: #4b5563;
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #20c997;
            text-decoration: none;
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

        .logout-btn i {
            font-size: 0.9rem;
        }

        /* Ensure main content doesn't get overlapped */
        .main-content-wrapper {
            position: relative;
            z-index: 1;
            margin-top: 20px; /* Add some spacing from navbar */
        }

        /* Additional fix for dropdown arrow */
        .dropdown .navbar-item i.fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .dropdown:hover .navbar-item i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Mobile responsiveness */
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
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                width: 200px;
            }
        }

        /* CSS TAMBAHAN UNTUK MENGHILANGKAN EFEK WARNA SAAT DITEKAN */
        
        /* Hilangkan efek warna saat navbar item ditekan/diklik */
        .navbar-item:focus,
        .navbar-item:active,
        .navbar-item:visited {
            color: rgba(255, 255, 255, 0.9) !important;
            outline: none;
            box-shadow: none;
            background-color: transparent;
        }

        /* Hilangkan efek warna saat dropdown item ditekan/diklik */
        .dropdown-item:focus,
        .dropdown-item:active,
        .dropdown-item:visited {
            color: #4b5563 !important;
            outline: none;
            box-shadow: none;
            background-color: transparent !important;
        }

        /* Hilangkan efek warna saat logout button ditekan */
        .logout-btn:focus,
        .logout-btn:active {
            background-color: rgba(255, 255, 255, 0.1) !important;
            outline: none;
            box-shadow: none;
        }

        /* Hilangkan efek pada navbar brand juga */
        .navbar-brand:focus,
        .navbar-brand:active,
        .navbar-brand:visited {
            color: white !important;
            outline: none;
            box-shadow: none;
            text-decoration: none;
        }

        /* Hilangkan highlight default browser */
        .navbar-item,
        .dropdown-item,
        .logout-btn,
        .navbar-brand {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Pastikan dropdown tetap berfungsi normal saat hover */
        .dropdown-item:hover {
            background-color: #f3f4f6 !important;
            color: #20c997 !important;
        }

        .navbar-item:hover {
            color: white !important;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Hilangkan efek pada link yang memiliki class active */
        .navbar-item.active:focus,
        .navbar-item.active:active {
            color: rgba(255, 255, 255, 0.9) !important;
            background-color: transparent !important;
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
                <a href="#" class="navbar-item active">Kementerian</a>
                <div class="dropdown">
                    <a href="#" class="navbar-item">Nasional <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">RPJPN</a>
                        <a href="#" class="dropdown-item">RPJMN</a>
                        <a href="#" class="dropdown-item">RPJPD</a>
                        <a href="#" class="dropdown-item">RPJMD</a>
                        <a href="#" class="dropdown-item">Isu Nasional</a>
                    </div>
                </div>
                 <div class="dropdown">
                    <a href="#" class="navbar-item">Daerah <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">RPJPD</a>
                        <a href="#" class="dropdown-item">RPJMD</a>
                        <a href="#" class="dropdown-item">Cascading</a>
                        <a href="#" class="dropdown-item">Isu Daerah</a>
                    </div>
                </div>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Tab Navigation -->
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                            <li <?= $Halaman == 'RPJPD' ? 'class="active"' : '' ?>>
                                <a data-toggle="tab" href="#RPJPD"><i class="notika-icon notika-house"></i> <b>RPJPD</b></a>
                            </li>
                            <li <?= $Halaman == 'RPJMD' ? 'class="active"' : '' ?>>
                                <a data-toggle="tab" href="#RPJMD"><i class="notika-icon notika-edit"></i> <b>RPJMD</b></a>
                            </li>
                            <li <?= $Halaman == 'Cascading' ? 'class="active"' : '' ?>>
                                <a data-toggle="tab" href="#Cascading"><i class="notika-icon notika-form"></i> <b>CASCADING</b></a>
                            </li>
                            <li <?= $Halaman == 'Isudaerah' ? 'class="active"' : '' ?>>
                                <a data-toggle="tab" href="#Isudaerah"><i class="notika-icon notika-house"></i> <b>ISU DAERAH</b></a>
                            </li>
                        </ul>
                        
                        <div class="tab-content custom-menu-content">
                            <!-- RPJPD Tab Content -->
                            <div id="RPJPD" class="tab-pane in <?= $Halaman == 'RPJPD' ? 'active' : '' ?> notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li>
                                        <a href="<?= base_url('Admin/VisiRPJPD') ?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/MisiRPJPD') ?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/TujuanRPJPD') ?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/SasaranRPJPD') ?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('Admin/TahapanRPJPD')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- RPJMD Tab Content -->
                            <div id="RPJMD" class="tab-pane in <?= $Halaman == 'RPJMD' ? 'active' : '' ?> notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li>
                                        <a href="<?= base_url('Admin/VisiRPJMD') ?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/MisiRPJMD') ?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/TujuanRPJMD') ?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/SasaranRPJMD') ?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('Admin/TahapanRPJMD')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('Admin/JanjiPolitik')?>"><i class="notika-icon notika-form"></i> <b>Janji Politik</b></a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Cascading Tab Content -->
                            <div id="Cascading" class="tab-pane in <?= $Halaman == 'Cascading' ? 'active' : '' ?> notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li>
                                        <a href="<?= base_url('Admin/Instansi') ?>"><i class="notika-icon notika-form"></i> <b>Daftar Instansi</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/IKU') ?>"><i class="notika-icon notika-form"></i> <b>IKU</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/IKD') ?>"><i class="notika-icon notika-form"></i> <b>IKD</b></a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Isu Daerah Tab Content -->
                            <div id="Isudaerah" class="tab-pane in <?= $Halaman == 'Isudaerah' ? 'active' : '' ?> notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li>
                                        <a href="<?= base_url('Admin/PermasalahanPokok') ?>"><i class="notika-icon notika-house"></i> <b>Permasalahan Pokok</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/IsuKLHS') ?>"><i class="notika-icon notika-house"></i> <b>Isu KLHS Daerah</b></a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('Admin/IsuStrategisDaerah') ?>"><i class="notika-icon notika-house"></i> <b>Isu Strategis Daerah</b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Logout function
            function logout() {
                // Redirect to logout page or clear session
                window.location.href = '/ippd';
            }
        </script>