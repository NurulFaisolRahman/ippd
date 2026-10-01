import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update .navbar CSS
    old_navbar_css = """        .navbar {
            background-color: #20c997;
            padding: 1rem 2rem;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }"""
    
    new_navbar_css = """        .navbar {
            background-color: #20c997;
            padding: 0 1.25rem !important;
            height: 64px !important;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 99999 !important;
        }"""
    
    content = content.replace(old_navbar_css, new_navbar_css)

    # 2. Update .navbar-container CSS
    old_navbar_container_css = """        .navbar-container {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }"""
        
    new_navbar_container_css = """        .navbar-container {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100%;
        }
        
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            height: 100%;
        }"""
        
    content = content.replace(old_navbar_container_css, new_navbar_container_css)

    # 3. Update badges CSS (to match Daerah exactly)
    old_badges_css = """        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 1000px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .daerah-badge {
            background: rgba(255, 255, 255, 0.13);
            border-color: rgba(255, 255, 255, 0.25);
        }"""
        
    new_badges_css = """        .login-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 20px;
            border-radius: 1000px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            color: #fff;
            font-weight: 800;
            font-size: 1.08rem;
            white-space: nowrap;
        }

        .daerah-badge {
            background: rgba(255, 255, 255, 0.13);
            border-color: rgba(255, 255, 255, 0.25);
            font-weight: 800;
            font-size: 1.05rem;
        }
        
        .sidebar-header-btn {
            background: transparent;
            border: none;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: .2s ease;
        }
        .sidebar-header-btn:hover {
            background: rgba(255,255,255,0.25);
        }"""
        
    content = content.replace(old_badges_css, new_badges_css)

    # 4. Remove old floating toggle button and badges
    old_floating_html = """    <!-- Toggle Button & Badges Container -->
    <div style="position: fixed; top: 15px; left: 15px; z-index: 1000; display: flex; align-items: center; gap: 15px;">
        <button class="sidebar-toggle" id="sidebarToggle" style="position: static !important; margin: 0;">
            <i class="fa fa-bars"></i>
        </button>
        
        <?php if (!empty($NamaProvinsi)) { ?>
            <div class="login-badge daerah-badge" title="Provinsi: <?= html_escape($NamaProvinsi) ?>" style="margin: 0; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                <i class="fas fa-map-marker-alt"></i>
                <?= html_escape($NamaProvinsi) ?>
            </div>
        <?php } ?>
        
        <?php if (!empty($LoginInfo)) { ?>
            <div class="login-badge" title="<?= html_escape($LoginInfo) ?>" style="margin: 0; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                <i class="fas fa-user"></i>
                <?= html_escape($LoginInfo) ?>
            </div>
        <?php } ?>
    </div>"""
    
    content = content.replace(old_floating_html, "")

    # 5. Insert new .navbar-left inside .navbar-container
    old_navbar_container_html = """        <div class="navbar-container">
                        <div style="width: 50px;"></div> <!-- Spacer for flex -->"""
                        
    new_navbar_container_html = """        <div class="navbar-container">
            <div class="navbar-left">
                <button class="sidebar-header-btn" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                
                <?php if (!empty($NamaProvinsi)) { ?>
                    <div class="login-badge daerah-badge" title="Provinsi: <?= html_escape($NamaProvinsi) ?>">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= html_escape($NamaProvinsi) ?>
                    </div>
                <?php } ?>
                
                <?php if (!empty($LoginInfo)) { ?>
                    <div class="login-badge" title="<?= html_escape($LoginInfo) ?>">
                        <i class="fas fa-user"></i>
                        <?= html_escape($LoginInfo) ?>
                    </div>
                <?php } ?>
            </div>"""
            
    content = content.replace(old_navbar_container_html, new_navbar_container_html)
    
    # 6. Add spacer div after </nav>
    if '<div style="height: 64px; width: 100%;"></div>' not in content:
        content = content.replace('</nav>\n    <!-- Sidebar -->', '</nav>\n    <div style="height: 64px; width: 100%;"></div>\n    <!-- Sidebar -->')

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
