<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IPPD - Sistem Penyelarasan Pembangunan Daerah</title>
  <meta content="Sistem Informasi Penyelarasan Perencanaan dan Kinerja Pembangunan Daerah & Nasional" name="description">
  <meta content="IPPD, Bappeda, RPJPN 2025-2045, RPJPD, Perencanaan Pembangunan Daerah" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('img/favicon.ico'); ?>" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">

  <!-- Font Awesome (Identik dengan Beranda IPPD) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ==========================================================
       IPPD PORTAL DESIGN SYSTEM - GREEN THEME (#20c997)
       Identik dengan konsep warna & navbar Beranda IPPD
       ========================================================== */
    :root {
      --primary:          #20c997;
      --primary-hover:    #17a97e;
      --primary-dark:     #0f8060;
      --primary-darker:   #095942;
      --primary-light:    rgba(32, 201, 151, 0.12);
      --primary-glow:     rgba(32, 201, 151, 0.35);
      --dark-navy:        #0b1b2e;
      --dark-blue:        #122030;
      --dark-surface:     #173048;
      --text-main:        #1e293b;
      --text-muted:       #64748b;
      --border-color:     #e2e8f0;
      --card-bg:          rgba(255, 255, 255, 0.98);
      --glass-border:     rgba(255, 255, 255, 0.6);
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      color: var(--text-main);
      background-color: #f7fcfa;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }

    /* ----------------------------------------------------------
       NAVBAR (IDENTIK DENGAN BERANDA IPPD, TANPA TOMBOL LOGIN)
       ---------------------------------------------------------- */
    .navbar {
      background-color: #20c997;
      padding: 0.65rem 2rem;
      border-radius: 0 0 14px 14px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      transition: all 0.3s ease;
      height: 58px;
      display: flex;
      align-items: center;
    }

    .navbar-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1240px;
      margin: 0 auto;
      width: 100%;
    }

    .navbar-brand {
      color: white;
      font-weight: 800;
      font-size: 1.3rem;
      display: flex;
      align-items: center;
      text-decoration: none;
      font-family: 'Jost', sans-serif;
      letter-spacing: 0.5px;
      transition: opacity 0.2s;
    }

    .navbar-brand:hover {
      color: white;
      opacity: 0.95;
    }

    .navbar-brand i {
      margin-right: 0.55rem;
      font-size: 1.2rem;
    }

    .navbar-menu {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .navbar-item {
      color: rgba(255, 255, 255, 0.92);
      font-weight: 500;
      font-size: 0.88rem;
      padding: 0.4rem 0.5rem;
      position: relative;
      transition: all 0.25s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }

    .navbar-item:hover {
      color: white;
      text-decoration: none;
    }

    /* Dropdown Styles (sama persis dengan Beranda) */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 210px;
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
      z-index: 1001;
      border-radius: 10px;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      border: 1px solid rgba(0, 0, 0, 0.08);
      padding: 6px 0;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown-item {
      color: #4b5563;
      padding: 0.70rem 1.1rem;
      text-decoration: none;
      display: block;
      transition: all 0.25s ease;
      white-space: nowrap;
      position: relative;
      font-size: 0.86rem;
      font-weight: 500;
    }

    .dropdown-item:hover {
      background-color: #f0faf7;
      color: #20c997;
    }

    /* Submenu Styles */
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
      color: #9ca3af;
    }

    .dropdown-submenu:hover > .dropdown-item:after {
      color: #20c997;
    }

    .dropdown-submenu .dropdown-submenu-content {
      display: none;
      position: absolute;
      left: 100%;
      top: 0;
      background-color: white;
      min-width: 210px;
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
      z-index: 1002;
      border-radius: 0 10px 10px 10px;
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-left: none;
      padding: 6px 0;
    }

    .dropdown-submenu:hover > .dropdown-submenu-content {
      display: block;
    }

    .dropdown .navbar-item i.fa-chevron-down {
      transition: transform 0.3s ease;
    }

    .dropdown:hover .navbar-item i.fa-chevron-down {
      transform: rotate(180deg);
    }

    /* Mobile toggle */
    .mobile-menu-toggle {
      display: none;
      background: none;
      border: none;
      color: white;
      font-size: 1.4rem;
      cursor: pointer;
      padding: 4px;
    }

    /* ----------------------------------------------------------
       HERO & LOGIN SECTION - OPTIMIZED FOR IMMEDIATE VISIBILITY
       Form login langsung terlihat 100% tanpa perlu scroll
       ---------------------------------------------------------- */
    #hero {
      width: 100%;
      min-height: 100vh;
      background: linear-gradient(135deg, rgba(10, 25, 40, 0.88) 0%, rgba(18, 32, 48, 0.92) 100%), 
                  url('<?= base_url("assets/img/bglogin.jpg"); ?>') no-repeat center center;
      background-size: cover;
      background-attachment: fixed;
      display: flex;
      align-items: center;
      padding: 76px 0 25px 0;
      position: relative;
      overflow: hidden;
    }

    /* Ambient Green Light Orbs */
    #hero::before {
      content: '';
      position: absolute;
      top: -120px;
      right: -120px;
      width: 500px;
      height: 500px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(32, 201, 151, 0.22) 0%, transparent 70%);
      pointer-events: none;
    }

    #hero::after {
      content: '';
      position: absolute;
      bottom: -100px;
      left: -100px;
      width: 420px;
      height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(32, 201, 151, 0.14) 0%, transparent 70%);
      pointer-events: none;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(32, 201, 151, 0.18);
      border: 1px solid rgba(32, 201, 151, 0.45);
      color: #5ddbbb;
      padding: 4px 14px;
      border-radius: 30px;
      font-size: 0.80rem;
      font-weight: 600;
      margin-bottom: 14px;
      backdrop-filter: blur(6px);
    }

    .hero-title {
      font-family: 'Jost', sans-serif;
      font-size: 2.45rem;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.2;
      margin-bottom: 14px;
      text-shadow: 0 4px 14px rgba(0, 0, 0, 0.4);
    }

    .text-gradient-green {
      background: linear-gradient(90deg, #20c997 0%, #5ddbbb 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-subtitle {
      font-size: 0.94rem;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.65;
      margin-bottom: 20px;
      max-width: 500px;
    }

    .hero-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 9px;
      margin-bottom: 0;
    }

    .hero-pill {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.16);
      backdrop-filter: blur(6px);
      padding: 5px 14px;
      border-radius: 18px;
      color: #e2f9f3;
      font-size: 0.80rem;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-weight: 500;
      transition: all 0.25s ease;
    }

    .hero-pill:hover {
      background: rgba(32, 201, 151, 0.22);
      border-color: rgba(32, 201, 151, 0.6);
      transform: translateY(-2px);
    }

    .hero-pill i {
      color: var(--primary);
      font-size: 0.84rem;
    }

    /* ----------------------------------------------------------
       GLASSMORPHISM LOGIN CARD - COMPACT & IMMEDIATELY VISIBLE
       ---------------------------------------------------------- */
    .login-card {
      background: var(--card-bg);
      border-radius: 20px;
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.28), 0 0 0 1px rgba(255, 255, 255, 0.25);
      padding: 1.55rem 1.85rem;
      max-width: 410px;
      width: 100%;
      margin: 0 auto;
      position: relative;
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--primary) 0%, #5ddbbb 100%);
    }

    .login-header {
      text-align: center;
      margin-bottom: 1.15rem;
    }

    .login-icon-box {
      width: 44px;
      height: 44px;
      background: var(--primary-light);
      color: var(--primary-dark);
      border-radius: 13px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      margin-bottom: 7px;
      box-shadow: 0 4px 14px rgba(32, 201, 151, 0.2);
    }

    .login-header h3 {
      font-size: 1.3rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 2px;
      font-family: 'Poppins', sans-serif;
    }

    .login-header p {
      font-size: 0.82rem;
      color: var(--text-muted);
      margin-bottom: 0;
    }

    .custom-input-group {
      margin-bottom: 0.85rem;
    }

    .custom-input-group label {
      font-size: 0.79rem;
      font-weight: 600;
      color: #475569;
      margin-bottom: 4px;
      display: block;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-wrapper .input-icon {
      position: absolute;
      left: 14px;
      color: #94a3b8;
      font-size: 1rem;
      z-index: 4;
      pointer-events: none;
      transition: color 0.3s ease;
    }

    .input-wrapper .form-control {
      border-radius: 11px;
      padding: 9px 14px 9px 40px;
      background: #f8fafc;
      border: 1.5px solid #d8e2ec;
      color: #1e293b;
      font-size: 0.88rem;
      font-weight: 500;
      transition: all 0.25s ease;
      width: 100%;
    }

    .input-wrapper .form-control:focus {
      background: #ffffff;
      border-color: var(--primary);
      box-shadow: 0 0 0 3.5px var(--primary-glow);
      outline: none;
    }

    .input-wrapper .form-control:focus ~ .input-icon {
      color: var(--primary-dark);
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      background: none;
      border: none;
      color: #94a3b8;
      font-size: 1rem;
      cursor: pointer;
      padding: 0;
      z-index: 5;
      display: flex;
      align-items: center;
      transition: color 0.2s;
    }

    .toggle-password:hover {
      color: #475569;
    }

    .btn-login {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: #ffffff;
      border: none;
      border-radius: 11px;
      padding: 10px 20px;
      font-size: 0.92rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px var(--primary-glow);
      margin-top: 0.45rem;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary-darker) 100%);
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px var(--primary-glow);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .login-alert {
      display: none;
      padding: 8px 12px;
      border-radius: 10px;
      font-size: 0.80rem;
      margin-bottom: 0.9rem;
      align-items: center;
      gap: 7px;
    }

    .login-alert.alert-danger {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }

    /* Scroll Down Indicator */
    .scroll-down-hint {
      position: absolute;
      bottom: 8px;
      left: 50%;
      transform: translateX(-50%);
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.75rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      transition: all 0.2s;
      z-index: 10;
    }

    .scroll-down-hint:hover {
      color: #5ddbbb;
    }

    .scroll-down-hint i {
      animation: bounceDown 1.5s infinite;
    }

    @keyframes bounceDown {
      0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(4px);
      }
      60% {
        transform: translateY(2px);
      }
    }

    /* ----------------------------------------------------------
       SECTION COMMON STYLES
       ---------------------------------------------------------- */
    .section-title {
      text-align: center;
      padding-bottom: 40px;
    }

    .section-title .section-badge {
      display: inline-block;
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--primary-dark);
      background: var(--primary-light);
      padding: 5px 16px;
      border-radius: 20px;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .section-title h2 {
      font-size: 2.1rem;
      font-weight: 800;
      color: #1e293b;
      margin-bottom: 10px;
      font-family: 'Jost', sans-serif;
    }

    .section-title p {
      color: var(--text-muted);
      font-size: 1.10rem;
      font-weight: 600;
      max-width: 780px;
      margin: 0 auto;
    }

    /* ----------------------------------------------------------
       VISI SECTION (CARDS)
       ---------------------------------------------------------- */
    #services {
      padding: 85px 0;
      background: #f4fbf8;
    }

    .visi-card {
      background: #ffffff;
      border-radius: 18px;
      padding: 30px 24px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      border: 1px solid var(--border-color);
      height: 100%;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .visi-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--primary) 0%, #5ddbbb 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .visi-card:hover {
      transform: translateY(-7px);
      box-shadow: 0 18px 36px rgba(32, 201, 151, 0.12);
      border-color: rgba(32, 201, 151, 0.4);
    }

    .visi-card:hover::before {
      opacity: 1;
    }

    .visi-icon {
      width: 54px;
      height: 54px;
      border-radius: 15px;
      background: var(--primary-light);
      color: var(--primary-dark);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.55rem;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .visi-card:hover .visi-icon {
      background: var(--primary);
      color: #ffffff;
      transform: scale(1.08);
      box-shadow: 0 6px 18px var(--primary-glow);
    }

    .visi-badge-num {
      font-size: 0.74rem;
      font-weight: 700;
      color: var(--primary-dark);
      text-transform: uppercase;
      letter-spacing: 0.8px;
      margin-bottom: 6px;
      display: block;
    }

    .visi-card h4 {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 10px;
    }

    .visi-card p {
      font-size: 0.88rem;
      color: #475569;
      line-height: 1.65;
      margin-bottom: 0;
    }

    /* ----------------------------------------------------------
       MISI SECTION (ACCORDION DUA KOLOM BERSIH & RAPI)
       ---------------------------------------------------------- */
    #why-us {
      padding: 85px 0;
      background: #ffffff;
    }

    .accordion-custom .accordion-item {
      border: 1px solid var(--border-color);
      border-radius: 13px !important;
      margin-bottom: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
      transition: all 0.3s ease;
    }

    .accordion-custom .accordion-item:hover {
      border-color: rgba(32, 201, 151, 0.4);
    }

    .accordion-custom .accordion-button {
      font-size: 0.93rem;
      font-weight: 600;
      color: #1e293b;
      background: #ffffff;
      padding: 15px 18px;
      box-shadow: none;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .accordion-custom .accordion-button:not(.collapsed) {
      color: var(--primary-darker);
      background: #f0faf7;
      box-shadow: none;
    }

    .accordion-custom .accordion-button::after {
      filter: hue-rotate(110deg) saturate(1.4);
    }

    .accordion-badge-num {
      width: 32px;
      height: 32px;
      background: #f1f5f9;
      color: #475569;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.82rem;
      font-weight: 700;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .accordion-custom .accordion-button:not(.collapsed) .accordion-badge-num {
      background: var(--primary);
      color: #ffffff;
    }

    .accordion-custom .accordion-body {
      padding: 14px 18px 18px 62px;
      background: #ffffff;
      border-top: 1px solid #f1f5f9;
    }

    .target-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 9px;
      padding: 8px 13px;
      font-size: 0.86rem;
      color: #334155;
      margin-bottom: 7px;
      width: 100%;
      transition: all 0.2s;
    }

    .target-pill:hover {
      background: #f0faf7;
      border-color: rgba(32, 201, 151, 0.4);
    }

    .target-pill i {
      color: var(--primary);
      font-size: 0.92rem;
    }

    /* ----------------------------------------------------------
       FOOTER
       ---------------------------------------------------------- */
    #footer {
      background: #0a1928;
      color: #94a3b8;
      padding: 48px 0 24px 0;
      font-size: 0.88rem;
      border-top: 1px solid rgba(32, 201, 151, 0.2);
    }

    .footer-brand-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 14px;
    }

    .footer-brand-badge {
      width: 40px;
      height: 40px;
      border-radius: 11px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      box-shadow: 0 4px 12px var(--primary-glow);
    }

    .footer-brand-title {
      font-family: 'Jost', sans-serif;
      font-size: 1.3rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0;
      line-height: 1;
    }

    .footer-brand-sub {
      font-size: 0.67rem;
      color: var(--primary);
      margin: 0;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      font-weight: 600;
    }

    .footer-links h5 {
      color: #ffffff;
      font-size: 0.96rem;
      font-weight: 700;
      margin-bottom: 14px;
    }

    .footer-links ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-links li {
      margin-bottom: 9px;
    }

    .footer-links a {
      color: #94a3b8;
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-links a:hover {
      color: var(--primary);
    }

    #footer .copyright {
      text-align: center;
      padding-top: 22px;
      margin-top: 22px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      font-size: 0.84rem;
    }

    /* Back to top button */
    .back-to-top {
      position: fixed;
      visibility: hidden;
      opacity: 0;
      right: 20px;
      bottom: 20px;
      z-index: 996;
      background: var(--primary);
      width: 40px;
      height: 40px;
      border-radius: 50px;
      transition: all 0.4s;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      box-shadow: 0 4px 14px var(--primary-glow);
      text-decoration: none;
    }

    .back-to-top i {
      font-size: 22px;
      color: #fff;
      line-height: 0;
    }

    .back-to-top:hover {
      background: var(--primary-hover);
      color: #fff;
      transform: translateY(-3px);
    }

    .back-to-top.active {
      visibility: visible;
      opacity: 1;
    }

    /* Responsive */
    @media (max-width: 991px) {
      .navbar-menu {
        display: none;
      }
      .navbar-menu.show-mobile {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 58px;
        left: 0;
        right: 0;
        background: #20c997;
        padding: 1.2rem;
        border-radius: 0 0 14px 14px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        gap: 0.7rem;
      }
      .dropdown-content {
        position: static;
        transform: none;
        box-shadow: none;
        border: none;
        padding-left: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        margin-top: 4px;
      }
      .dropdown-item {
        color: white;
      }
      .dropdown-item:hover {
        background: transparent;
        color: #e2f9f3;
      }
      .dropdown-submenu .dropdown-submenu-content {
        position: static;
        box-shadow: none;
        border: none;
        padding-left: 1rem;
        background: rgba(255, 255, 255, 0.05);
      }
      .mobile-menu-toggle {
        display: block;
      }
      #hero {
        padding: 85px 0 40px 0;
      }
      .hero-title {
        font-size: 2.1rem;
      }
      .login-card {
        margin-top: 2rem;
      }
      .accordion-custom .accordion-body {
        padding-left: 18px;
      }
      .scroll-down-hint {
        display: none;
      }
    }
  </style>
</head>

<body>

  <!-- =======================================================
       HEADER / NAVBAR (IDENTIK DENGAN BERANDA IPPD, TANPA TOMBOL LOGIN)
       ======================================================= -->
  <nav class="navbar" id="topNavbar">
    <div class="navbar-container">
      
      <!-- Brand Identik dengan Beranda -->
      <a href="<?= base_url(); ?>" class="navbar-brand">
        <i class="fas fa-chart-line"></i>
        Sistem Perencanaan Daerah
      </a>

      <!-- Menu Dropdown Laporan Sakip & Navigasi -->
      <div class="navbar-menu" id="navMenu">
        
        <!-- Dropdown Laporan Sakip dengan Submenu Lengkap -->
        <div class="dropdown">
          <a href="#" class="navbar-item active">
            Laporan Sakip <i class="fas fa-chevron-down ml-1" style="font-size: 0.72rem; margin-left: 4px;"></i>
          </a>
          <div class="dropdown-content">
            
            <div class="dropdown-submenu">
              <a href="#" class="dropdown-item">Perencanaan</a>
              <div class="dropdown-submenu-content">
                <a href="<?= base_url('Nasional/VisiRPJPN'); ?>" class="dropdown-item">Nasional</a>
                <a href="<?= base_url('Kementerian/Kementerian'); ?>" class="dropdown-item">Kementerian</a>
                <a href="<?= base_url('Provinsi/VisiRPJPD'); ?>" class="dropdown-item">Provinsi</a>
                <a href="<?= base_url('Daerah/UrusanPD'); ?>" class="dropdown-item">Daerah</a>
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

        <!-- Menu Section Navigasi -->
        <a href="#services" class="navbar-item">Visi RPJPN</a>
        <a href="#why-us" class="navbar-item">Misi RPJPN</a>

        <!-- Kontak Menu -->
        <a href="mailto:cvideconsultan@gmail.com" target="_blank" class="navbar-item">Kontak</a>

        <!-- Tentang Kami Menu -->
        <a href="#why-us" class="navbar-item">Tentang Kami</a>

      </div>

      <!-- Mobile Toggle -->
      <button class="mobile-menu-toggle" id="mobileToggle" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
      </button>

    </div>
  </nav>

  <!-- =======================================================
       HERO & LOGIN SECTION
       Langsung tampil penuh tanpa terpotong
       ======================================================= -->
  <section id="hero">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center justify-content-between g-4">
        
        <!-- Left Hero Content -->
        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
          <div class="hero-badge">
            <i class="fas fa-shield-alt"></i> Portal Resmi Penyelarasan Pembangunan
          </div>
          <h1 class="hero-title">
            Better Solution For <br><span class="text-gradient-green">Your Governance</span>
          </h1>
          <p class="hero-subtitle">
            Sistem Informasi Penyelarasan Indikator Kinerja dan Perencanaan Pembangunan Daerah & Nasional secara Terintegrasi, Transparan, dan Akuntabel dari Pusat hingga Daerah.
          </p>

          <div class="hero-pills">
            <div class="hero-pill"><i class="fas fa-landmark"></i> Nasional</div>
            <div class="hero-pill"><i class="fas fa-building"></i> Kementerian / Lembaga</div>
            <div class="hero-pill"><i class="fas fa-map-marked-alt"></i> Provinsi</div>
            <div class="hero-pill"><i class="fas fa-sitemap"></i> Daerah & Instansi PD</div>
          </div>
        </div>

        <!-- Right Login Card (Tampil Penuh Langsung di Layar) -->
        <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200" id="login-box">
          <div class="login-card">
            
            <div class="login-header">
              <div class="login-icon-box">
                <i class="fas fa-user-lock"></i>
              </div>
              <h3>Selamat Datang</h3>
              <p>Silakan masuk menggunakan akun Anda</p>
            </div>

            <!-- Login Alert Box -->
            <div class="login-alert alert-danger" id="loginAlert">
              <i class="fas fa-exclamation-circle flex-shrink-0"></i>
              <span id="loginAlertMsg">Username atau Password salah!</span>
            </div>

            <!-- Login Form -->
            <form id="formLogin" onsubmit="return false;" autocomplete="on">
              
              <div class="custom-input-group">
                <label for="Username">Username / Kode Instansi</label>
                <div class="input-wrapper">
                  <i class="fas fa-user input-icon"></i>
                  <input type="text" class="form-control" id="Username" autocomplete="username" placeholder="Masukkan username atau kode instansi" required>
                </div>
              </div>

              <div class="custom-input-group">
                <label for="Password">Kata Sandi</label>
                <div class="input-wrapper">
                  <i class="fas fa-lock input-icon"></i>
                  <input type="password" class="form-control" id="Password" autocomplete="current-password" placeholder="Masukkan kata sandi Anda" required>
                  <button type="button" class="toggle-password" id="togglePasswordBtn" title="Tampilkan/Sembunyikan Password">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                  </button>
                </div>
              </div>

              <button class="btn btn-login" id="Login" type="button">
                <span id="btnText"><b>Masuk Sekarang</b></span>
                <i class="fas fa-arrow-right" id="btnIcon"></i>
                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
              </button>
            </form>

            <div class="text-center mt-3 pt-2 border-top">
              <small class="text-muted d-block" style="font-size: 0.76rem;">
                <i class="fas fa-shield-alt text-success me-1"></i> Akses Terproteksi Multi-Level Pemerintahan
              </small>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- Scroll Down Hint -->
    <a href="#services" class="scroll-down-hint">
      <span>Pelajari Visi & Misi</span>
      <i class="fas fa-chevron-down"></i>
    </a>
  </section>

  <main id="main">

    <!-- =======================================================
         VISI RPJPN 2025-2045 SECTION
         ======================================================= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <span class="section-badge">Visi Indonesia 2045</span>
          <h2>VISI RPJPN 2025-2045</h2>
          <p class="fw-bold" style="color: var(--primary-darker); font-size: 1.35rem;">Negara Nusantara Berdaulat, Maju, dan Berkelanjutan</p>
        </div>

        <div class="row g-4">
          
          <!-- Card 1: Nusantara -->
          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="visi-card">
              <div class="visi-icon">
                <i class="fas fa-globe-asia"></i>
              </div>
              <span class="visi-badge-num">Pilar 01</span>
              <h4>Nusantara</h4>
              <p>Negara Kepulauan yang memiliki ketangguhan politik, ekonomi, keamanan nasional, dan budaya/peradaban bahari sebagai poros maritim dunia.</p>
            </div>
          </div>

          <!-- Card 2: Berdaulat -->
          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="visi-card">
              <div class="visi-icon">
                <i class="fas fa-shield-alt"></i>
              </div>
              <span class="visi-badge-num">Pilar 02</span>
              <h4>Berdaulat</h4>
              <p>Ketahanan, kesatuan, kemandirian, dan keamanan nasional yang tangguh dalam menjaga kedaulatan serta keutuhan bangsa dan negara.</p>
            </div>
          </div>

          <!-- Card 3: Maju -->
          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="visi-card">
              <div class="visi-icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <span class="visi-badge-num">Pilar 03</span>
              <h4>Maju</h4>
              <p>Masyarakat yang berdaya, modern, tangguh, inovatif, dan berkeadilan sosial dengan daya saing ekonomi tingkat global.</p>
            </div>
          </div>

          <!-- Card 4: Berkelanjutan -->
          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="visi-card">
              <div class="visi-icon">
                <i class="fas fa-leaf"></i>
              </div>
              <span class="visi-badge-num">Pilar 04</span>
              <h4>Berkelanjutan</h4>
              <p>Lestari dan seimbang antara pembangunan ekonomi, kesejahteraan sosial, serta daya dukung kelestarian lingkungan hidup.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- =======================================================
         MISI RPJPN 2025-2045 SECTION (DUA KOLOM BERSIH & RAPI)
         ======================================================= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <span class="section-badge">Agenda Pembangunan Nasional</span>
          <h2>MISI RPJPN 2025-2045</h2>
          <p>8 Misi Transformasi Indonesia Menuju Indonesia Emas 2045</p>
        </div>

        <div class="row g-4 justify-content-center">

          <!-- Kolom Kiri: Misi 1 s/d 4 -->
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="accordion accordion-custom" id="misiAccordionLeft">
              
              <!-- Misi 1 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <span class="accordion-badge-num">01</span>
                    <span>Mewujudkan Transformasi Sosial</span>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#misiAccordionLeft">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T1. Kesehatan untuk semua</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T2. Pendidikan berkualitas yang merata</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T3. Perlindungan sosial yang adaptif</div>
                  </div>
                </div>
              </div>

              <!-- Misi 2 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="accordion-badge-num">02</span>
                    <span>Mewujudkan Transformasi Ekonomi</span>
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#misiAccordionLeft">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T4. Iptek, inovasi dan produktivitas ekonomi</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T5. Penerapan ekonomi hijau</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T6. Transformasi digital</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T7. Integrasi ekonomi domestik dan global</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T8. Perkotaan dan perdesaan sebagai pusat pertumbuhan ekonomi</div>
                  </div>
                </div>
              </div>

              <!-- Misi 3 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="accordion-badge-num">03</span>
                    <span>Mewujudkan Transformasi Tata Kelola</span>
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#misiAccordionLeft">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T9. Regulasi dan tata kelola yang berintegritas dan adaptif</div>
                  </div>
                </div>
              </div>

              <!-- Misi 4 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span class="accordion-badge-num">04</span>
                    <span>Memantapkan Supremasi Hukum, Stabilitas, dan Kepemimpinan</span>
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#misiAccordionLeft">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T10. Hukum berkeadilan, keamanan nasional tangguh dan demokrasi substansial</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T11. Stabilitas ekonomi makro</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T12. Ketangguhan diplomasi dan pertahanan berdaya gentar kawasan</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Kolom Kanan: Misi 5 s/d 8 -->
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="accordion accordion-custom" id="misiAccordionRight">
              
              <!-- Misi 5 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <span class="accordion-badge-num">05</span>
                    <span>Memantapkan Ketahanan Sosial Budaya dan Ekologi</span>
                  </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#misiAccordionRight">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T13. Beragama maslahat dan berkebudayaan maju</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T14. Keluarga berkualitas, kesetaraan gender dan masyarakat inklusif</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T15. Lingkungan hidup berkualitas</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T16. Berketahanan energi, air dan kemandirian pangan</div>
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T17. Resiliensi terhadap bencana dan perubahan iklim</div>
                  </div>
                </div>
              </div>

              <!-- Misi 6 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <span class="accordion-badge-num">06</span>
                    <span>Mewujudkan Pembangunan Kewilayahan yang Merata</span>
                  </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#misiAccordionRight">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T18. Percepatan pembangunan wilayah perbatasan dan pemerataan antar daerah</div>
                  </div>
                </div>
              </div>

              <!-- Misi 7 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <span class="accordion-badge-num">07</span>
                    <span>Mewujudkan Sarana dan Prasarana Berkualitas</span>
                  </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#misiAccordionRight">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T19. Infrastruktur konektivitas, energi bersih, air minum dan sanitasi terintegrasi</div>
                  </div>
                </div>
              </div>

              <!-- Misi 8 -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <span class="accordion-badge-num">08</span>
                    <span>Mewujudkan Kesinambungan Pembangunan</span>
                  </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#misiAccordionRight">
                  <div class="accordion-body">
                    <div class="target-pill"><i class="fas fa-check-circle"></i> T20. Tata kelola keuangan publik, pembiayaan inovatif dan integritas perencanaan</div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main>

  <!-- =======================================================
       FOOTER
       ======================================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row g-4 justify-content-between">
        
        <div class="col-lg-5">
          <div class="footer-brand-wrap">
            <div class="footer-brand-badge">
              <i class="fas fa-chart-line"></i>
            </div>
            <div>
              <h4 class="footer-brand-title">IPPD</h4>
              <p class="footer-brand-sub">Portal Penyelarasan Pembangunan</p>
            </div>
          </div>
          <p class="text-muted small" style="line-height: 1.7; max-width: 420px;">
            Sistem Informasi Penyelarasan Indikator Kinerja dan Perencanaan Pembangunan Daerah & Nasional secara Terpadu, Efisien, dan Berkelanjutan.
          </p>
        </div>

        <div class="col-lg-3 col-6 footer-links">
          <h5>Menu Utama</h5>
          <ul>
            <li><a href="#hero"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Beranda</a></li>
            <li><a href="#services"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Visi RPJPN 2025-2045</a></li>
            <li><a href="#why-us"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Misi Transformasi</a></li>
            <li><a href="mailto:cvideconsultan@gmail.com"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Kontak Bantuan</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-6 footer-links">
          <h5>Laporan Sakip</h5>
          <ul>
            <li><a href="<?= base_url('Nasional/VisiRPJPN'); ?>"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Perencanaan Nasional</a></li>
            <li><a href="<?= base_url('Kementerian/Kementerian'); ?>"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Kementerian / Lembaga</a></li>
            <li><a href="<?= base_url('Provinsi/VisiRPJPD'); ?>"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Provinsi</a></li>
            <li><a href="<?= base_url('Daerah/UrusanPD'); ?>"><i class="fas fa-chevron-right me-1" style="font-size: 0.72rem;"></i> Daerah & Instansi</a></li>
          </ul>
        </div>

      </div>

      <div class="copyright">
        &copy; <?= date('Y'); ?> <strong><span>IPPD</span></strong>. Sistem Informasi Penyelarasan Indikator Kinerja & Perencanaan Pembangunan. Hak Cipta Dilindungi.
      </div>
    </div>
  </footer>

  <!-- Back to top button -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" id="backToTopBtn" aria-label="Kembali ke atas">
    <i class="fas fa-arrow-up"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js'); ?>"></script>

  <script>
    var BaseURL = '<?= base_url(); ?>';

    jQuery(document).ready(function($) {

      // Init AOS Animations
      if (typeof AOS !== 'undefined') {
        AOS.init({
          duration: 800,
          easing: 'ease-in-out',
          once: true,
          mirror: false
        });
      }

      // Toggle Mobile Menu
      $('#mobileToggle').on('click', function() {
        $('#navMenu').toggleClass('show-mobile');
      });

      // Toggle Password Visibility
      $('#togglePasswordBtn').on('click', function(e) {
        e.preventDefault();
        var passwordInput = $('#Password');
        var icon = $('#togglePasswordIcon');
        
        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      // Show login alert message
      function showAlert(msg) {
        $('#loginAlertMsg').text(msg);
        $('#loginAlert').fadeIn(250);
      }

      function hideAlert() {
        $('#loginAlert').fadeOut(200);
      }

      // Hide alert when user starts typing
      $('#Username, #Password').on('input', function() {
        if ($('#loginAlert').is(':visible')) {
          hideAlert();
        }
      });

      // Perform Login Function
      function performLogin() {
        var username = $("#Username").val().trim();
        var password = $("#Password").val();

        if (username === '' || password === '') {
          showAlert('Username dan Password wajib diisi!');
          return;
        }

        hideAlert();

        // Button Loading State
        var btn = $("#Login");
        var btnText = $("#btnText");
        var btnIcon = $("#btnIcon");
        var btnSpinner = $("#btnSpinner");

        btn.prop('disabled', true);
        btnText.text('Memproses...');
        btnIcon.addClass('d-none');
        btnSpinner.removeClass('d-none');

        var LoginData = { 
          Username: username,
          Password: password 
        };

        $.post(BaseURL + "Home/Login", LoginData)
          .done(function(Respon) {
            Respon = (Respon + '').trim();

            if (Respon === '0') {
              window.location = BaseURL + "Nasional/VisiRPJPN";  
            } else if (Respon === '1') {
              window.location = BaseURL + "Kementerian/Kementerian";
            } else if (Respon === '2') {
              window.location = BaseURL + "Provinsi/VisiRPJPD";
            } else if (Respon === '3') {
              window.location = BaseURL + "Daerah/UrusanPD";
            } else if (Respon === '4') {
              window.location = BaseURL + "Instansi/PermasalahanPD";
            } else {
              showAlert(Respon || 'Username atau Password salah!');
              btn.prop('disabled', false);
              btnText.html('<b>Masuk Sekarang</b>');
              btnIcon.removeClass('d-none');
              btnSpinner.addClass('d-none');
            }
          })
          .fail(function(xhr, status, error) {
            showAlert('Terjadi gangguan jaringan atau server. Silakan coba lagi.');
            btn.prop('disabled', false);
            btnText.html('<b>Masuk Sekarang</b>');
            btnIcon.removeClass('d-none');
            btnSpinner.addClass('d-none');
          });
      }

      // Event listener tombol Login
      $("#Login").on('click', function(e) {
        e.preventDefault();
        performLogin();
      });

      // Event listener tombol Enter pada input Username & Password
      $("#Username, #Password").on('keypress', function(event) {
        if (event.which === 13) {
          event.preventDefault();
          performLogin();
        }
      });

      // Back to top scroll listener
      $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
          $('#backToTopBtn').addClass('active');
        } else {
          $('#backToTopBtn').removeClass('active');
        }
      });

    });

    $(window).on('hashchange', function() {
      setTimeout(function() {
        if (window.location.hash) {
          history.replaceState('', document.title, window.location.href.split('#')[0]);
        }
      }, 100);
    });
  </script>
</body>
</html>