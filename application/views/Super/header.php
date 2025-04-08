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
                        <li <?=$Halaman == 'Kementerian' ? 'class="active"' : ''; ?>><a data-toggle="tab" href="#Kementerian"><i class="notika-icon notika-house"></i> <b>Kementerian</b></a></li>

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
                            </ul>
                        </div>
                        <div id="Kementerian" class="tab-pane in <?=$Halaman == 'Kementerian' ? 'active' : ''; ?> notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li>
                                    <a href="<?=base_url('Super/Kementerian')?>"><i class="notika-icon notika-form"></i> <b>Kelola Kementerian</b></a>
                                </li>
                                <li>
                                    <a href="<?=base_url('Super/Isu')?>"><i class="notika-icon notika-form"></i> <b>Isu Strategis</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>