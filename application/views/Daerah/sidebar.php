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
<body>
    <!-- Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <div class="sidebar-content">
            <ul class="sidebar-menu">
                <br>

                <!-- RPJPD -->
                <div class="sidebar-dropdown">
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
                        <br>
                    </div>
                </div>

                <!-- RPJMD -->
                <div class="sidebar-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-line-chart"></i>
                        <span>RPJMD</span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu" style="display: block;">
                        <a href="<?=base_url('Daerah/VisiRPJMD')?>">Visi</a>
                        <a href="<?=base_url('Daerah/MisiRPJMD')?>">Misi</a>
                        <a href="<?=base_url('Daerah/TujuanRPJMD')?>">Tujuan</a>
                        <a href="<?=base_url('Daerah/SasaranRPJMD')?>">Sasaran</a>
                        <a href="<?=base_url('Daerah/TahapanRPJMD')?>">Tahapan</a>
                        <br>
                    </div>
                </div>
                
                <!-- Cascading -->
                <div class="sidebar-dropdown">
                    <a href="#">
                    <i class="menu-icon fa fa-sitemap"></i>
                        <span>Cascading</span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="<?=base_url('Daerah/Instansi')?>">Daftar Instansi</a>
                        <a href="<?=base_url('Daerah/Iku')?>">IKU</a>
                        <a href="<?=base_url('Daerah/Ikd')?>">IKD</a>
                        <br>
                    </div>
                </div>
                
                <!-- Isu Daerah -->
                <div class="sidebar-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-exclamation-triangle"></i>
                        <span>Isu Daerah</span>
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="sidebar-submenu">
                        <a href="<?=base_url('Daerah/PotensiDaerah')?>">Potensi Daerah</a>
                        <a href="<?=base_url('Daerah/PermasalahanPokok')?>">Permasalahan Pokok</a>
                        <a href="<?=base_url('Daerah/IsuKLHS')?>">Isu KLHS</a>
                        <a href="<?=base_url('Daerah/IsuStrategisDaerah')?>">Isu Strategis</a>
                        <br>
                    </div>
                </div>
            </ul>
        </div>
    </div>


    <script>
        var BaseURL = '<?=base_url()?>';
        
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const body = document.body;
            
            // Check if sidebar state is saved in localStorage
            if (localStorage.getItem('sidebarMini') === 'true') {
                body.classList.add('sidebar-mini');
            }
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-mini');
                // Save state to localStorage
                localStorage.setItem('sidebarMini', body.classList.contains('sidebar-mini'));
            });
            
            // Close all dropdowns except the active one
            document.querySelectorAll('.sidebar-dropdown').forEach(dropdown => {
                if (!dropdown.classList.contains('active')) {
                    const submenu = dropdown.querySelector('.sidebar-submenu');
                    if (submenu) {
                        submenu.style.maxHeight = '0';
                        submenu.style.padding = '0 15px';
                    }
                }
            });

            // Toggle sidebar dropdowns (for expanded sidebar)
            document.querySelectorAll('.sidebar-dropdown > a').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Only prevent default if sidebar is not minimized
                    if (!body.classList.contains('sidebar-mini')) {
                        e.preventDefault();
                        
                        const dropdown = this.parentElement;
                        const submenu = this.nextElementSibling;
                        
                        // Close other dropdowns at the same level
                        if (dropdown.parentElement.classList.contains('sidebar-menu') || 
                            dropdown.parentElement.classList.contains('sidebar-submenu')) {
                            const siblings = Array.from(dropdown.parentElement.children)
                                .filter(child => child !== dropdown);
                            
                            siblings.forEach(sibling => {
                                const siblingSubmenu = sibling.querySelector('.sidebar-submenu');
                                if (siblingSubmenu) {
                                    siblingSubmenu.style.maxHeight = '0';
                                    siblingSubmenu.style.padding = '0 15px';
                                }
                                sibling.classList.remove('active');
                                
                                // Reset chevron icon for siblings
                                const siblingChevron = sibling.querySelector('.fa-chevron-down');
                                if (siblingChevron) {
                                    siblingChevron.style.transform = 'rotate(0)';
                                }
                            });
                        }
                        
                        // Toggle current dropdown
                        if (submenu) {
                            if (dropdown.classList.contains('active')) {
                                submenu.style.maxHeight = '0';
                                submenu.style.padding = '0 15px';
                                dropdown.classList.remove('active');
                            } else {
                                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                                submenu.style.padding = '10px 15px';
                                dropdown.classList.add('active');
                            }
                            
                            // Rotate chevron icon
                            const chevron = this.querySelector('.fa-chevron-down');
                            if (chevron) {
                                chevron.style.transform = dropdown.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0)';
                            }
                        }
                    }
                });
            });
            
            // Highlight active menu item based on current URL
            const currentUrl = window.location.pathname;
            document.querySelectorAll('.sidebar-submenu a').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    link.style.color = '#20c997';
                    link.style.fontWeight = 'bold';
                    
                    // Expand parent menus
                    let parent = link.closest('.sidebar-submenu');
                    while (parent) {
                        parent.style.maxHeight = parent.scrollHeight + 'px';
                        parent.style.padding = '10px 15px';
                        const parentDropdown = parent.previousElementSibling;
                        if (parentDropdown) {
                            parentDropdown.style.color = '#20c997';
                            const chevron = parentDropdown.querySelector('.fa-chevron-down');
                            if (chevron) chevron.style.transform = 'rotate(180deg)';
                            parentDropdown.parentElement.classList.add('active');
                        }
                        parent = parent.parentElement.closest('.sidebar-submenu');
                    }
                }
            });
            
            // Add hover effect animation
            document.querySelectorAll('.sidebar-menu a').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>