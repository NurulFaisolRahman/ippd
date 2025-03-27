<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
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
    <!-- Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h3 style="color: white; margin-top: 10px;">Admin</h3>
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

    <!-- Main Menu Area -->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li <?php echo ($Halaman == 'RPJPN2025') ? 'class="active"' : ''; ?>>
                            <a data-toggle="tab" href="#RPJPN2025"><i class="notika-icon notika-house"></i> <b>RPJPN 2025</b></a>
                        </li>
                        <li <?php echo ($Halaman == 'AkunInstansi') ? 'class="active"' : ''; ?>>
                            <a data-toggle="tab" href="#AkunInstansi"><i class="notika-icon notika-support"></i> <b>INSTANSI</b></a>
                        </li>
                        <li <?php echo ($Halaman == 'Cascading') ? 'class="active"' : ''; ?>>
                            <a data-toggle="tab" href="#Cascading"><i class="notika-icon notika-form"></i> <b>CASCADING</b></a>
                        </li>
                    </ul>

                    <div class="tab-content custom-menu-content">
                        <!-- RPJPN 2025 Tab -->
                        <div id="RPJPN2025" class="tab-pane in <?php echo ($Halaman == 'RPJPN2025') ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?= base_url('Admin/Visi') ?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/Misi') ?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/Tujuan') ?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/Sasaran') ?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                            </ul>
                        </div>

                        <!-- Cascading Tab -->
                        <div id="Cascading" class="tab-pane in <?php echo ($Halaman == 'Cascading') ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?= base_url('Admin/Iku') ?>"><i class="notika-icon notika-form"></i> <b>IKU</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/Ikd') ?>"><i class="notika-icon notika-form"></i> <b>IKD</b></a>
                                </li>
                            </ul>
                        </div>

                        <!-- Akun Instansi Tab -->
                        <div id="AkunInstansi" class="tab-pane in <?php echo ($Halaman == 'AkunInstansi') ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?= base_url('Admin/AkunInstansi') ?>"><i class="notika-icon notika-form"></i> <b>Daftar Instansi</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>