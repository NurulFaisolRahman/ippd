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
                        <li <?=$Halaman == 'RPJPN' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPN"><i class="notika-icon notika-form"></i> <b>RPJPN</b></a></li>
                        <li <?=$Halaman == 'RPJMN' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJMN"><i class="notika-icon notika-form"></i> <b>RPJMN</b></a></li>
                        <li <?=$Halaman == 'RPJPD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJPD"><i class="notika-icon notika-form"></i> <b>RPJPD</b></a></li>
                        <li <?=$Halaman == 'RPJMD' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#RPJMD"><i class="notika-icon notika-form"></i> <b>RPJMD</b></a></li>
                        <li <?=$Halaman == 'Kementerian' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Kementerian"><i class="notika-icon notika-house"></i> <b>Kementerian</b></a></li>
                        <li <?=$Halaman == 'Isu' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Isu"><i class="notika-icon notika-house"></i> <b>Isu</b></a></li>


                    </ul>
                    <div class="tab-content custom-menu-content">
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
                    </div>
                </div>
            </div>
        </div>
    </div>