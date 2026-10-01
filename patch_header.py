import re

def process_file():
    with open('application/views/Provinsi/header.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # Add PHP block for fetching session data
    php_block = """<body class="bg-gray-50 font-sans">
<?php
  $LoginInfo   = '';
  $NamaProvinsi = '';

  if (isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 2) {
    $KodeWilayah = $_SESSION['KodeWilayah'] ?? '';
    $LoginInfo = $_SESSION['Username'] ?? 'Provinsi';

    if (!empty($KodeWilayah)) {
      $rowWilayah = $this->db->select('Nama')
        ->from('kodewilayah')
        ->where('Kode', $KodeWilayah)
        ->limit(1)
        ->get()
        ->row_array();
      $NamaProvinsi = $rowWilayah['Nama'] ?? '';
    }
  } elseif (!empty($_SESSION['Username'])) {
    $LoginInfo = $_SESSION['Username'];
  }
?>"""
    content = content.replace('<body class="bg-gray-50 font-sans">', php_block)

    # Add CSS for badges
    css_block = """        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .login-badge {
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
    content = content.replace('        .logout-btn:hover {\n            background-color: rgba(255, 255, 255, 0.2);\n        }', css_block)

    # Insert badges into navbar right before logout button
    badges_html = """                <a href="#" class="navbar-item">Tentang Kami</a>
                
                <?php if (!empty($NamaProvinsi)) { ?>
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
    content = content.replace('                <a href="#" class="navbar-item">Tentang Kami</a>', badges_html)

    with open('application/views/Provinsi/header.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
