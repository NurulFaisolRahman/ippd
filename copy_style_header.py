import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        old_content = f.read()

    # Extract sidebar logic from old content
    sidebar_match = re.search(r'(<!-- Sidebar -->.*?</div>\s*</div>)', old_content, re.DOTALL)
    sidebar_html = sidebar_match.group(1) if sidebar_match else '<!-- Sidebar Missing -->'
    
    js_match = re.search(r'(<script>.*?var BaseURL = \'<\?=base_url\(\)\?>\';.*?</script>)', old_content, re.DOTALL)
    sidebar_js = js_match.group(1) if js_match else ''

    # Now let's read Daerah/header.php to get its base structure
    with open('application/views/Daerah/header.php', 'r', encoding='utf-8') as f:
        daerah_content = f.read()
        
    head_and_nav_match = re.search(r'(.*?)</nav>', daerah_content, re.DOTALL)
    head_and_nav = head_and_nav_match.group(1) + '</nav>'
    
    # We need to inject the Provinsi session logic instead of Daerah session logic.
    provinsi_session_logic = """<?php
  $LoginInfo   = '';
  $NamaProvinsi = '';

  if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 2) {
    $KodeWilayah = $_SESSION['KodeWilayah'] ?? '';

    if (!empty($KodeWilayah)) {
      $rowWilayah = $this->db->select('Nama')
        ->from('kodewilayah')
        ->where('Kode', $KodeWilayah)
        ->limit(1)
        ->get()
        ->row_array();
      $NamaProvinsi = $rowWilayah['Nama'] ?? '';
    }
    $LoginInfo = $_SESSION['Username'] ?? 'Provinsi';
  } elseif (!empty($_SESSION['Username'])) {
    $LoginInfo = $_SESSION['Username'];
  }
?>"""
    
    # Replace the PHP logic block
    head_and_nav = re.sub(r'<\?php\s*\$LoginInfo.*?elseif \(!empty\(\$_SESSION\[\'Username\'\]\)\) \{\s*\$LoginInfo = \$_SESSION\[\'Username\'\];\s*\}\s*\?>', provinsi_session_logic, head_and_nav, flags=re.DOTALL)
    
    # Replace "Sistem Perencanaan Daerah" with "Sistem Perencanaan Provinsi"
    head_and_nav = head_and_nav.replace('Sistem Perencanaan Daerah', 'Sistem Perencanaan Provinsi')
    # Replace URL UrusanPD with VisiRPJPD (which is the default Provinsi link)
    head_and_nav = head_and_nav.replace('Daerah/UrusanPD', 'Provinsi/VisiRPJPD')
    
    # Replace the badge logic from Level 4 / NamaDaerah to Level 2 / NamaProvinsi
    daerah_badge_logic = """      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 4) { ?>
      <?php if (!empty($NamaDaerah)) { ?>
          <span class="login-badge daerah-badge" title="Daerah: <?= html_escape($NamaDaerah) ?>">
            <i class="fas fa-map-marker-alt"></i>
            <?= html_escape($NamaDaerah) ?>
          </span>
      <?php } ?>
      <?php } ?>"""
    provinsi_badge_logic = """      <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 2) { ?>
      <?php if (!empty($NamaProvinsi)) { ?>
          <span class="login-badge daerah-badge" title="Provinsi: <?= html_escape($NamaProvinsi) ?>">
            <i class="fas fa-map-marker-alt"></i>
            <?= html_escape($NamaProvinsi) ?>
          </span>
      <?php } ?>
      <?php } ?>"""
    head_and_nav = head_and_nav.replace(daerah_badge_logic, provinsi_badge_logic)
    
    # Replace logout button condition from 3|4 to 2
    head_and_nav = head_and_nav.replace("((int)$_SESSION['Level'] === 3 || (int)$_SESSION['Level'] === 4)", "((int)$_SESSION['Level'] === 2)")

    # Construct the final file
    final_content = head_and_nav + '\n\n<div class="page-top-space"></div>\n\n' + sidebar_html + '\n\n<script>\n  function logout(){ window.location.href = \'<?= base_url(\'Home/Logout\'); ?>\'; }\n  function Login(){ window.location.href = \'<?= base_url(\'Home\'); ?>\'; }\n</script>\n\n' + sidebar_js + '\n</body>\n</html>'

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(final_content)

process_file()
