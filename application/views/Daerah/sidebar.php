<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi RPJMD</title>
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/notika-custom-icon.css">
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-editable.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-mini-width: 70px;
            --transition-speed: 0.3s;
        }

        .menu-icon {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            color: #20c997;
        }

        .bi {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            color: #20c997;
            font-size: 1.75rem;
        }
        
        /* Sidebar Styles */
        .sidebar-wrapper {
            width: var(--sidebar-width);
            background-color: #f8f9fa;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 70px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 999;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-mini .sidebar-wrapper {
            width: var(--sidebar-mini-width);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-mini .main-content {
            margin-left: var(--sidebar-mini-width);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            border-left: 3px solid transparent;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }
        
        .sidebar-menu a:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        
        .sidebar-menu a:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background-color: #20c997;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform var(--transition-speed) ease;
        }
        
        .sidebar-menu a:hover:before {
            transform: scaleY(1);
        }
        
        .sidebar-menu .active > a {
            border-left: 3px solid #20c997;
            background-color: rgba(32, 201, 151, 0.1);
        }
        
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            background-color: #e9ecef;
            padding-left: 15px;
            transition: max-height 0.5s ease, padding var(--transition-speed) ease;
        }
        
        .sidebar-submenu.show {
            max-height: 500px; /* Adjust based on your content */
        }
        
        .sidebar-submenu a {
            padding: 10px 15px;
            transition: all var(--transition-speed) ease;
        }
        
        .sidebar-submenu a:hover {
            padding-left: 25px;
        }
        
        .sidebar-submenu .sidebar-submenu {
            background-color: #dee2e6;
        }
        
        .sidebar-submenu .sidebar-submenu a {
            padding: 8px 15px;
        }
        
        .fa-chevron-down {
            transition: transform var(--transition-speed) ease;
            margin-left: auto;
        }
        
        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background-color: #20c997;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            border-radius: 50%;
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
            background-color: #1aa67d;
        }
        
        
        /* Mini Sidebar Styles */
        .sidebar-mini .sidebar-menu span {
            display: none;
        }
        
        .sidebar-mini .sidebar-menu .fa-chevron-down {
            display: none;
        }
        
        .sidebar-mini .sidebar-submenu {
            position: absolute;
            left: var(--sidebar-mini-width);
            top: 0;
            width: 200px;
            background-color: #f8f9fa;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            display: none !important;
            padding-left: 0;
            max-height: none !important;
        }
        
        .sidebar-mini .sidebar-dropdown:hover .sidebar-submenu {
            display: block !important;
        }
        
        .sidebar-mini .sidebar-dropdown {
            position: relative;
        }
        
        /* Table Styles */
        .data-table-list {
            margin-top: 20px;
        }
        
        .button-icon-btn {
            display: flex;
            gap: 5px;
        }
        
        /* Animation for sidebar items */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .sidebar-menu li {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }
        
        /* Delay animations for each item */
        .sidebar-menu li:nth-child(1) { animation-delay: 0.1s; }
        .sidebar-menu li:nth-child(2) { animation-delay: 0.2s; }
        .sidebar-menu li:nth-child(3) { animation-delay: 0.3s; }
        .sidebar-menu li:nth-child(4) { animation-delay: 0.4s; }
        .sidebar-menu li:nth-child(5) { animation-delay: 0.5s; }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }
            
            .sidebar-mini .sidebar-wrapper {
                transform: translateX(0);
                width: var(--sidebar-mini-width);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-mini .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                left: 15px;
            }
            
            .sidebar-mini .sidebar-toggle {
                left: calc(var(--sidebar-mini-width) - 20px);
            }
        }
    </style>
</head>
<!-- Sidebar -->
<div class="sidebar-wrapper">
    <div class="sidebar-content">
        <ul class="sidebar-menu">

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-person-circle"></i>
                    <span>Daftar Urusan & Akun</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Daerah/UrusanPD')?>">Daftar Urusan</a>
                    <a href="<?=base_url('Daerah/Instansi')?>">Daftar Instansi</a>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="menu-icon fa fa-area-chart"></i>
                    <span>RPJPD</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Daerah/VisiRPJPD')?>">Visi</a>
                    <a href="<?=base_url('Daerah/MisiRPJPD')?>">Misi</a>
                    <a href="<?=base_url('Daerah/TujuanRPJPD')?>">Tujuan</a>
                    <a href="<?=base_url('Daerah/SasaranRPJPD')?>">Sasaran</a>
                    <a href="<?=base_url('Daerah/TahapanRPJPD')?>">Tahapan</a>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="menu-icon fa fa-line-chart"></i>
                    <span>RPJMD</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('Daerah/VisiRPJMD')?>">Visi</a>
                    <a href="<?=base_url('Daerah/MisiRPJMD')?>">Misi</a>
                    <a href="<?=base_url('Daerah/TujuanRPJMD')?>">Tujuan</a>
                    <a href="<?=base_url('Daerah/SasaranRPJMD')?>">Sasaran</a>
                    <a href="<?=base_url('Daerah/ProgramPD')?>">Program</a>
                    <a href="<?=base_url('Daerah/TahapanRPJMD')?>">Tahapan</a>
                    <a href="<?=base_url('Daerah/Iku')?>">IKU</a>
                    <a href="<?=base_url('Daerah/Ikd')?>">IKD</a>
                    <a href="<?=base_url('Daerah/cascade')?>">Cascade</a>
                    <a href="<?=base_url('Daerah/PotensiDaerah')?>">Potensi Daerah</a>
                    <a href="<?=base_url('Daerah/PermasalahanPokok')?>">Permasalahan Pokok</a>
                    <a href="<?=base_url('Daerah/IsuKLHS')?>">Isu KLHS</a>
                  
                </div>
            </li>

             <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Renstra</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('#')?>">Form Renstra</a>
            
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-file-text-fill"></i>
                    <span>RKPD</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('#')?>">Form RKPD</a>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="bi bi-cash"></i>
                    <span>Anggaran</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('#')?>">RAPBD</a>
                    <a href="<?=base_url('#')?>">APBD</a>
                </div>
            </li>

            <li class="sidebar-dropdown">
                <a href="#">
                    <i class="menu-icon fa fa-sitemap"></i>
                    <span>Pohon Kinerja</span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="sidebar-submenu">
                    <a href="<?=base_url('#')?>">Pohon Kinerja</a>
            
                </div>
            </li>

        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;

  function closeDropdown(li) {
    li.classList.remove('active');
    const submenu = li.querySelector(':scope > .sidebar-submenu');
    if (submenu) submenu.classList.remove('show');
    const chev = li.querySelector(':scope > a .fa-chevron-down');
    if (chev) chev.style.transform = 'rotate(0)';
  }

  function openDropdown(li) {
    li.classList.add('active');
    const submenu = li.querySelector(':scope > .sidebar-submenu');
    if (submenu) submenu.classList.add('show');
    const chev = li.querySelector(':scope > a .fa-chevron-down');
    if (chev) chev.style.transform = 'rotate(180deg)';
  }

  // Toggle dropdown klik (hanya saat sidebar tidak mini)
  document.querySelectorAll('.sidebar-dropdown > a').forEach(a => {
    a.addEventListener('click', function (e) {
      if (body.classList.contains('sidebar-mini')) return; // mini mode pakai hover

      e.preventDefault();
      const li = this.closest('.sidebar-dropdown');

      // close siblings
      const siblings = Array.from(li.parentElement.children).filter(el => el !== li);
      siblings.forEach(s => closeDropdown(s));

      // toggle current
      if (li.classList.contains('active')) closeDropdown(li);
      else openDropdown(li);
    });
  });

  // Highlight menu aktif berdasarkan URL
  const currentPath = window.location.pathname.replace(/\/+$/, '');
  document.querySelectorAll('.sidebar-submenu a').forEach(link => {
    const href = link.getAttribute('href');
    if (!href) return;

    const linkPath = new URL(href, window.location.origin).pathname.replace(/\/+$/, '');
    if (linkPath === currentPath) {
      link.style.color = '#20c997';
      link.style.fontWeight = 'bold';

      // open parent dropdown
      const parentLi = link.closest('.sidebar-dropdown');
      if (parentLi) openDropdown(parentLi);
    }
  });
});
</script>
</html>