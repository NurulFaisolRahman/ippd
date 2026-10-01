import re

def fix():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    sidebar_css = """
        /* Sidebar  */
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
        }
"""
    
    if "/* Sidebar  */" not in content:
        content = content.replace("  </style>", sidebar_css + "\n  </style>")

    # Clean up duplicate script
    bad_script = """<script>
  function logout(){ window.location.href = '<?= base_url('Home/Logout'); ?>'; }
  function Login(){ window.location.href = '<?= base_url('Home'); ?>'; }
</script>"""
    content = content.replace(bad_script, "")

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

fix()
