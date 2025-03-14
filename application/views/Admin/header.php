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
    
</head>

<body>
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h3 style="color: white;margin-top: 10px;">Admin</h3>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li <?=$Halaman == 'AkunInstansi' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#AkunInstansi"><i class="notika-icon notika-form"></i> <b>AKUN INSTANSI</b></a></li>
                        <li <?=$Halaman == 'Cascading' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Cascading"><i class="notika-icon notika-house"></i> <b>CASCADING</b></a></li>
                        <li <?=$Halaman == 'RPJPN2025' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPN2025"><i class="notika-icon notika-house"></i> <b>RPJPN 2025</b></a></li>
                    </ul>
        
                    <div class="tab-content custom-menu-content">
                        <div id="RPJPN2025" class="tab-pane in <?=$Halaman == 'RPJPN2025' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/Visi')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Misi')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Tujuan')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/Sasaran')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="Cascading" class="tab-pane in <?=$Halaman == 'Cascading' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/Cascading')?>"><i class="notika-icon notika-form"></i> <b>Menejemen Cascading</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="AkunInstansi" class="tab-pane in <?=$Halaman == 'AkunInstansi' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/AkunInstansi')?>"><i class="notika-icon notika-form"></i> <b>Daftar Instansi</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>