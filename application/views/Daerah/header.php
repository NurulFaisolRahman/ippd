<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin IPPD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

  <!-- CSS utama -->
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/meanmenu/meanmenu.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/wave/button.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/notika-custom-icon.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/jquery.dataTables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/main.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('css/responsive.css'); ?>">

  <!-- Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .navbar{
      background-color:#20c997;
      padding: 1rem 1.25rem;
      border-radius: 0 0 12px 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      z-index: 1200;
    }

    .navbar-container{
      display:flex;
      align-items:center;
      justify-content:space-between;
      width:100%;
    }

    .navbar-left{
      display:flex;
      align-items:center;
      gap: 12px;
      flex-shrink: 0;
      min-width: 0;
    }

    .sidebar-header-btn{
      background: rgba(255,255,255,0.15);
      border: none;
      color: white;
      width: 42px;
      height: 42px;
      border-radius: 12px;
      cursor: pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      transition: .2s ease;
      flex-shrink: 0;
    }
    .sidebar-header-btn:hover{
      background: rgba(255,255,255,0.25);
      transform: scale(1.05);
    }

    .navbar-center{
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      z-index: 1;
      display:flex;
      align-items:center;
      justify-content:center;
      pointer-events: none; /* biar klik tidak mengganggu menu */
    }
    .navbar-center a{
      pointer-events: auto; /* link tetap bisa diklik */
    }

    /* Brand (IPPD) */
    .navbar-brand{
      color:#fff;
      font-weight:900;
      font-size:1.3rem;
      display:flex;
      align-items:center;
      text-decoration:none;
      letter-spacing:.5px;
      user-select:none;
      flex-shrink: 0;
    }
    .navbar-brand i{ margin-right:.5rem; }

    /* Badge info login (tetap kiri, setelah IPPD) */
    .login-badge{
      display:inline-flex;
      align-items:center;
      gap:10px;
      padding:10px 16px;
      border-radius:1000px;
      background: rgba(255,255,255,0.18);
      border: 1px solid rgba(255,255,255,0.28);
      color:#fff;
      font-weight:700;
      font-size:.100 rem;
      line-height:1;
      white-space:nowrap;
      max-width: 45vw;
      overflow:hidden;
      text-overflow:ellipsis;
    }

    .navbar-menu{
      display:flex;
      align-items:center;
      gap:1.25rem;
      margin-left:auto;          /* dorong ke kanan */
      justify-content:flex-end;
      flex-shrink: 0;
    }

    .navbar-item{
      color: rgba(255,255,255,0.92);
      font-weight: 600;
      padding: .5rem 0;
      position: relative;
      transition: all .25s ease;
      text-decoration:none;
      white-space:nowrap;
    }
    .navbar-item:hover{ color:#fff; text-decoration:none; }

    .dropdown{ position:relative; display:inline-block; }
    .dropdown-content{
      display:none;
      position:absolute;
      background-color:white;
      min-width:220px;
      box-shadow:0 8px 20px rgba(0,0,0,0.15);
      z-index:1201;
      border-radius:8px;
      top:100%;
      left:50%;
      transform:translateX(-50%);
      border:1px solid rgba(0,0,0,0.1);
    }
    .dropdown:hover .dropdown-content{ display:block; }

    .dropdown-item{
      color:#4b5563;
      padding:.75rem 1rem;
      text-decoration:none;
      display:block;
      transition: all .25s ease;
      white-space:nowrap;
      position:relative;
    }
    .dropdown-item:hover{ background-color:#f3f4f6; color:#20c997; }

    .dropdown-submenu{ position:relative; }
    .dropdown-submenu > .dropdown-item:after{
      content:"▸";
      position:absolute;
      right:10px;
      top:50%;
      transform:translateY(-50%);
    }
    .dropdown-submenu .dropdown-submenu-content{
      display:none;
      position:absolute;
      left:100%;
      top:0;
      background-color:white;
      min-width:220px;
      box-shadow:0 8px 20px rgba(0,0,0,0.15);
      z-index:1202;
      border-radius:0 8px 8px 0;
      border:1px solid rgba(0,0,0,0.1);
      border-left:none;
    }
    .dropdown-submenu:hover > .dropdown-submenu-content{ display:block; }

    .logout-btn{
      background-color: rgba(255,255,255,0.12);
      color:white;
      border:none;
      padding:.55rem .9rem;
      border-radius:10px;
      display:flex;
      align-items:center;
      gap:.5rem;
      font-weight:700;
      transition: all .25s ease;
      cursor:pointer;
      white-space:nowrap;
    }
    .logout-btn:hover{ background-color: rgba(255,255,255,0.22); }

    .page-top-space{ height:82px; }

    /* Mobile: tetap satu baris, menu scroll horizontal */
    @media (max-width: 768px){
      .navbar-container{
        flex-direction: row !important;
        align-items: center !important;
        gap: 10px;
      }
      .navbar-menu{
        margin-left:auto;
        justify-content:flex-end;
        gap:.75rem;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      .navbar-menu::-webkit-scrollbar{ height:6px; }
      .navbar-menu::-webkit-scrollbar-thumb{ background: rgba(255,255,255,0.35); border-radius:999px; }

      /* dropdown di mobile tetap bisa, tapi tidak maksa column */
      .dropdown-content{
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

  if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) {
    $KodeWilayah = $_SESSION['KodeWilayah'] ?? '';

    if (!empty($KodeWilayah)) {
      $row = $this->db->select('Username')
        ->from('akun')
        ->where('KodeWilayah', $KodeWilayah)
        ->where('Level', 3)
        ->where('deleted_at IS NULL', null, false)
        ->limit(1)
        ->get()
        ->row_array();

      $LoginInfo = $row['Username'] ?? '';
    }
  }
?>


<!-- NAVBAR -->
<nav class="navbar">
  <div class="navbar-container">

    <!-- KIRI: tombol + IPPD + info login -->
    <div class="navbar-left">
      <button id="sidebarToggle" class="sidebar-header-btn" type="button" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
      </button>

        <?php if (!empty($LoginInfo)) { ?>
            <span class="login-badge" title="<?= html_escape($LoginInfo) ?>">
            <i class="fas fa-user"></i>
            <?= html_escape($LoginInfo) ?>
            </span>
        <?php } ?>
    </div>

    <div class="navbar-center">
      <a href="<?= base_url('Beranda'); ?>" class="navbar-brand">
        <i class="fas fa-chart-line"></i>
        IPPD
    </a>

    </div>

    <!-- KANAN: menu -->
    <div class="navbar-menu">

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

      <a href="mailto:info@ippd.example.com" class="navbar-item">Kontak</a>
      <a href="#" class="navbar-item">Tentang Kami</a>

      <?php if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3) { ?>
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

<div class="page-top-space"></div>

<script>
  function logout(){ window.location.href = '/ippd'; }
  function Login(){ window.location.href = '/ippd/Home'; }

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
