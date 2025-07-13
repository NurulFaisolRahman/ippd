<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin IPPD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/meanmenu/meanmenu.min.css">
    <link rel="stylesheet" href="../css/wave/button.css">
    <link rel="stylesheet" href="../css/notika-custom-icon.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/responsive.css">
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
                <!-- Menu Kementerian dengan Submenu -->
                <div class="dropdown">
                    <a href="#" class="navbar-item active">Kementerian <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="<?=base_url('Super/Kementerian')?>" class="dropdown-item">Daftar Kementerian</a>
                        <a href="<?=base_url('Super/SPM')?>" class="dropdown-item">Standar Pelayanan Minimal</a>
                        <a href="<?=base_url('Super/ProgramStrategis')?>" class="dropdown-item">Program Strategis</a>
                        <a href="<?=base_url('Super/ProyekStrategis')?>" class="dropdown-item">Proyek Strategis</a>
                    </div>
                </div>
                
                <!-- Menu Nasional dengan Submenu -->
                <div class="dropdown">
                    <a href="#" class="navbar-item">Nasional <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <!-- RPJPN Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPN</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJPN')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJPN')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJPN')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJPN')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJPN')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJPN')?>" class="dropdown-item">IUP RPJPN</a>
                            </div>
                        </div>
                        
                        <!-- RPJMN Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMN</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJMN')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJMN')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJMN')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJMN')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJMN')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJMN')?>" class="dropdown-item">IUP RPJMN</a>
                            </div>
                        </div>
                        
                        <!-- RPJPD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJPD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJPD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJPD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJPD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJPD')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJPD')?>" class="dropdown-item">IUP RPJPD</a>
                            </div>
                        </div>
                        
                        <!-- RPJMD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJMD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJMD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJMD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJMD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJMD')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJMD')?>" class="dropdown-item">IUP RPJMD</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Daerah -->
                <div class="dropdown">
                    <a href="#" class="navbar-item">Daerah <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                         <!-- RPJPD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/VisiRPJPD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Admin/MisiRPJPD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Admin/TujuanRPJPD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Admin/SasaranRPJPD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Admin/TahapanRPJPD')?>" class="dropdown-item">Tahapan</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/VisiRPJMD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Admin/MisiRPJMD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Admin/TujuanRPJMD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Admin/SasaranRPJMD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Admin/TahapanRPJMD')?>" class="dropdown-item">Tahapan</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Cascading</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/kelola_instansi')?>" class="dropdown-item">Daftar Instansi</a>
                                <a href="<?=base_url('Admin/Iku')?>" class="dropdown-item">IKU</a>
                                <a href="<?=base_url('Admin/Ikd')?>" class="dropdown-item">IKD</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Isu Daerah</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/PermasalahanPokok')?>" class="dropdown-item">Permasalahan Pokok</a>
                                <a href="<?=base_url('Admin/IsuKLHS')?>" class="dropdown-item">Isu KLHS</a>
                                <a href="<?=base_url('Admin/IsuStrategisDaerah')?>" class="dropdown-item">Isu Strategis</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Rest of your content remains exactly the same -->
    <!-- <div class="container mx-auto px-4 py-8 max-w-6xl"> -->
        <!-- Tab Navigation -->
        <!-- <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li <?=$Halaman == 'Akun' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Akun"><i class="notika-icon notika-form"></i> <b>Akun</b></a></li>
                        <li <?=$Halaman == 'RPJPN' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPN"><i class="notika-icon notika-form"></i> <b>RPJPN</b></a></li>
                        <li <?=$Halaman == 'RPJMN' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJMN"><i class="notika-icon notika-form"></i> <b>RPJMN</b></a></li>
                        <li <?=$Halaman == 'RPJPD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPD"><i class="notika-icon notika-form"></i> <b>RPJPD</b></a></li>
                        <li <?=$Halaman == 'RPJMD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJMD"><i class="notika-icon notika-form"></i> <b>RPJMD</b></a></li>
                        <li <?=$Halaman == 'Kementerian' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Kementerian"><i class="notika-icon notika-house"></i> <b>Kementerian</b></a></li>
                        <li <?=$Halaman == 'Isu' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Isu"><i class="notika-icon notika-house"></i> <b>Isu</b></a></li>
                        <li <?=$Halaman == 'Nomenklatur' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Nomenklatur"><i class="notika-icon notika-house"></i> <b>Nomenklatur</b></a></li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="Akun" class="tab-pane in <?=$Halaman == 'Akun' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/Akun')?>"><i class="notika-icon notika-form"></i> <b>Akun</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="RPJPN" class="tab-pane in <?=$Halaman == 'RPJPN' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/VisiRPJPN')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/MisiRPJPN')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TujuanRPJPN')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/SasaranRPJPN')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TahapanRPJPN')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IUPRPJPN')?>"><i class="notika-icon notika-bar-chart"></i> <b>IUP RPJPN</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="RPJMN" class="tab-pane in <?=$Halaman == 'RPJMN' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/VisiRPJMN')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/MisiRPJMN')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TujuanRPJMN')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/SasaranRPJMN')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TahapanRPJMN')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IUPRPJMN')?>"><i class="notika-icon notika-bar-chart"></i> <b>IUP RPJMN</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="RPJPD" class="tab-pane in <?=$Halaman == 'RPJPD' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/VisiRPJPD')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/MisiRPJPD')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TujuanRPJPD')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/SasaranRPJPD')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TahapanRPJPD')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IUPRPJPD')?>"><i class="notika-icon notika-bar-chart"></i> <b>IUP RPJPD</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="RPJMD" class="tab-pane in <?=$Halaman == 'RPJMD' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/VisiRPJMD')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/MisiRPJMD')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TujuanRPJMD')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/SasaranRPJMD')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/TahapanRPJMD')?>"><i class="notika-icon notika-app"></i> <b>Tahapan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IUPRPJMD')?>"><i class="notika-icon notika-bar-chart"></i> <b>IUP RPJMD</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="Kementerian" class="tab-pane in <?=$Halaman == 'Kementerian' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/Kementerian')?>"><i class="notika-icon notika-form"></i> <b>Daftar Kementerian</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/SPM')?>"><i class="notika-icon notika-form"></i> <b>Standar Pelayanan Minimal</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/ProgramStrategis')?>"><i class="notika-icon notika-form"></i> <b>Program Strategis</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/ProyekStrategis')?>"><i class="notika-icon notika-form"></i> <b>Proyek Strategis</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="Isu" class="tab-pane in <?=$Halaman == 'Isu' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/PermasalahanPokok')?>"><i class="notika-icon notika-form"></i> <b>Permasalahan Pokok</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IsuKLHS')?>"><i class="notika-icon notika-form"></i> <b>Isu KLHS</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IsuGlobal')?>"><i class="notika-icon notika-form"></i> <b>Isu Global</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IsuNasional')?>"><i class="notika-icon notika-form"></i> <b>Isu Nasional</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/IsuStrategis')?>"><i class="notika-icon notika-form"></i> <b>Isu Strategis</b></a>
                                </li>   
                            </ul>
                        </div>
                        <div id="Nomenklatur" class="tab-pane in <?=$Halaman == 'Nomenklatur' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/NomenklaturProvinsi')?>"><i class="notika-icon notika-form"></i> <b>Provinsi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/NomenklaturKabupaten')?>"><i class="notika-icon notika-form"></i> <b>Kabupaten</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- </div> -->

    <script>
        // Logout function
        function logout() {
            window.location.href = '/ippd';
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