import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # Make .navbar-container relative to support absolute centering
    if "position: relative;" not in content.split(".navbar-container {")[1].split("}")[0]:
        content = content.replace(".navbar-container {\n            display: flex;", ".navbar-container {\n            position: relative;\n            display: flex;")
    
    # Add .navbar-center CSS if not exists
    if ".navbar-center" not in content:
        css_center = """
        .navbar-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        .navbar-center a {
            pointer-events: auto;
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
        }
"""
        content = content.replace("        .navbar-brand {", css_center + "        .navbar-brand {")

    # Replace the brand HTML
    old_brand = """            <a href="/ippd/Beranda" class="navbar-brand">
                <i class="fas fa-chart-line"></i>
                IPPD
            </a>"""
            
    # if it doesn't match exactly because of formatting, try regex
    match_brand = re.search(r'<a href="/ippd/Beranda"[^>]*class="navbar-brand"[^>]*>.*?IPPD\s*</a>', content, re.DOTALL)
    if match_brand:
        old_brand = match_brand.group(0)
        
    new_brand = """            <div class="navbar-center">
                <a href="<?= base_url('Provinsi/VisiRPJPD'); ?>" class="navbar-brand">
                    <i class="fas fa-chart-line"></i>
                    Sistem Perencanaan Daerah
                </a>
            </div>"""
    
    # Wait, the navbar-container in Provinsi has space-between. If we remove the first element,
    # the navbar-menu might jump to the left.
    # To fix this, we should add an empty div on the left to balance space-between, or just keep
    # the old brand as visibility: hidden, OR since we have display: flex; justify-content: flex-end; 
    # we can just add an empty div.
    
    # Actually, the badges are on the left outside the navbar now!
    # Let's add a spacer
    new_brand_with_spacer = """            <div style="width: 50px;"></div> <!-- Spacer for flex -->
            <div class="navbar-center">
                <a href="<?= base_url('Provinsi/VisiRPJPD'); ?>" class="navbar-brand">
                    <i class="fas fa-chart-line"></i>
                    Sistem Perencanaan Daerah
                </a>
            </div>"""

    content = content.replace(old_brand, new_brand_with_spacer)

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
