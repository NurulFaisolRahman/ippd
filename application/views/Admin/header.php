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
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/meanmenu/meanmenu.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/wave/button.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/notika-custom-icon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/jquery.dataTables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/responsive.css'); ?>">
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
                        <li <?=$Halaman == 'RPJPD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPD"><i class="notika-icon notika-house"></i> <b>RPJPD</b></a></li>
                        <li <?=$Halaman == 'RPJMD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJMD"><i class="notika-icon notika-house"></i> <b>RPJMD</b></a></li>
                        <li <?=$Halaman == 'Cascading' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Cascading"><i class="notika-icon notika-form"></i> <b>CASCADING</b></a></li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="RPJPD" class="tab-pane in <?=$Halaman == 'RPJPD' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/VisiRPJPD')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/MisiRPJPD')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/TujuanRPJPD')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/SasaranRPJPD')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                            </ul>
                        </div>
                        <div id="RPJMD" class="tab-pane in <?=$Halaman == 'RPJMD' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Admin/VisiRPJMD')?>"><i class="notika-icon notika-house"></i> <b>Visi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/MisiRPJMD')?>"><i class="notika-icon notika-form"></i> <b>Misi</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/TujuanRPJMD')?>"><i class="notika-icon notika-edit"></i> <b>Tujuan</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Admin/SasaranRPJMD')?>"><i class="notika-icon notika-support"></i> <b>Sasaran</b></a>
                                </li>
                            </ul>
                        </div>

                        <!-- Akun Cascading Tab -->
                        <div id="Cascading" class="tab-pane in <?php echo ($Halaman == 'Cascading') ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?= base_url('Admin/Instansi') ?>"><i class="notika-icon notika-form"></i> <b>Instansi</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/IKU') ?>"><i class="notika-icon notika-form"></i> <b>IKU</b></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('Admin/IKD') ?>"><i class="notika-icon notika-form"></i> <b>IKD</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>