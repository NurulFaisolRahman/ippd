import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # Remove the badges from the right side of the navbar
    badges_html = """                <?php if (!empty($NamaProvinsi)) { ?>
                    <div class="login-badge daerah-badge ml-2" title="Provinsi: <?= html_escape($NamaProvinsi) ?>">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= html_escape($NamaProvinsi) ?>
                    </div>
                <?php } ?>
                
                <?php if (!empty($LoginInfo)) { ?>
                    <div class="login-badge ml-2 mr-2" title="<?= html_escape($LoginInfo) ?>">
                        <i class="fas fa-user"></i>
                        <?= html_escape($LoginInfo) ?>
                    </div>
                <?php } ?>"""
    content = content.replace(badges_html, "")

    # Modify the toggle button area to include the badges
    toggle_html = """    <!-- Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fa fa-bars"></i>
    </button>"""
    
    new_toggle_html = """    <!-- Toggle Button & Badges Container -->
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
    
    content = content.replace(toggle_html, new_toggle_html)

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
