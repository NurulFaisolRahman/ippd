import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # Change "Laporan Sakip" to "Laporan"
    content = content.replace('Laporan Sakip', 'Laporan')

    # Remove "Kontak" and "Tentang Kami"
    kontak_html = '                <!-- Kontak Menu (tanpa dropdown) -->\n                <a href="mailto:info@ippd.example.com" class="navbar-item">Kontak</a>\n                \n                <!-- Tentang Kami Menu (tanpa dropdown) -->\n                <a href="#" class="navbar-item">Tentang Kami</a>'
    
    content = content.replace(kontak_html, '')
    
    # In case there are formatting differences
    content = re.sub(r'<!-- Kontak Menu.*?</nav>', '</nav>', content, flags=re.DOTALL)
    # Wait, the above regex is dangerous. I will just do exact matching or safe regex.
    content = re.sub(r'<!-- Kontak Menu.*?Tentang Kami</a>', '', content, flags=re.DOTALL)

    # Let's add a JS trigger in sidebarToggle to recalculate DataTable widths
    old_js = """            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-mini');
                // Save state to localStorage
                localStorage.setItem('sidebarMini', body.classList.contains('sidebar-mini'));
            });"""
            
    new_js = """            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-mini');
                // Save state to localStorage
                localStorage.setItem('sidebarMini', body.classList.contains('sidebar-mini'));
                
                // Trigger window resize so DataTables redraws its layout correctly
                setTimeout(function() {
                    window.dispatchEvent(new Event('resize'));
                    if ($.fn.dataTable) {
                        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                    }
                }, 300); // 300ms matches the CSS transition speed
            });"""
            
    content = content.replace(old_js, new_js)

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
