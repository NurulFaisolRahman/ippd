import re

def process_file():
    with open('application/views/Daerah/IsuStrategisDaerah.php', 'r', encoding='utf-8') as f:
        content = f.read()

    # 1. Update the table CSS colors and layout
    old_css = """    .table-linearitas thead th {
        background: #f8fafc;
        color: #334155;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        vertical-align: middle !important;
        text-align: center;
        padding: 12px 10px;
    }
    .table-linearitas tbody td {
        vertical-align: top !important;
        color: #475569;
        font-size: 13px;
        border-color: #e2e8f0;
        padding: 14px 12px;
    }"""
    
    new_css = """    .table-linearitas {
        border-collapse: collapse;
        width: 100%;
    }
    .table-linearitas thead th {
        background: #E47937; /* Orange header from image */
        color: #ffffff;
        font-weight: 700;
        font-size: 12px;
        border: 1px solid #c96223;
        vertical-align: middle !important;
        text-align: center;
        padding: 12px 10px;
    }
    .table-linearitas tbody td {
        vertical-align: middle !important;
        color: #333333;
        font-size: 13px;
        border: 1px solid #e2a47a;
        background-color: #fdeadd; /* Light peach background */
        padding: 0; /* Padding handled by inner elements */
    }
    .table-linearitas tbody td.td-permasalahan {
        background-color: transparent;
        border: none;
        padding: 0;
    }
    
    .permasalahan-item {
        background-color: #ffffff;
        padding: 10px 12px;
        border-bottom: 1px solid #e2a47a;
        border-right: 1px solid #e2a47a;
        border-left: 1px solid #e2a47a;
        min-height: 40px;
        display: flex;
        align-items: center;
    }
    .permasalahan-item:last-child {
        border-bottom: none;
    }
    
    .td-content-wrapper {
        padding: 14px 12px;
    }
"""
    content = content.replace(old_css, new_css)

    # Update formatLinearitasCell
    old_php_func = """    function formatLinearitasCell($text) {
        if ($text === null || trim($text) === '') {
            return '<span class="text-muted">-</span>';
        }
        $lines = preg_split('/\\r\\n|\\r|\\n/', trim($text));
        $lines = array_filter(array_map('trim', $lines), function($item) {
            return $item !== '';
        });
        if (count($lines) <= 1) {
            return nl2br(htmlspecialchars(reset($lines)));
        }
        $html = '<ul class="linearitas-list">';
        foreach ($lines as $line) {
            // Strip existing bullet prefix if typed manually
            $cleanLine = preg_replace('/^[\\?\\-\\*\\d\\.\\)\\s]+/u', '', $line);
            if ($cleanLine === '') $cleanLine = $line;
            $html .= '<li>' . htmlspecialchars($cleanLine) . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }"""
    
    new_php_func = """    function formatLinearitasCell($text, $isPermasalahan = false) {
        if ($text === null || trim($text) === '') {
            return $isPermasalahan ? '<div class="permasalahan-item text-muted">-</div>' : '<div class="td-content-wrapper text-muted">-</div>';
        }
        $lines = preg_split('/\\r\\n|\\r|\\n/', trim($text));
        $lines = array_filter(array_map('trim', $lines), function($item) {
            return $item !== '';
        });
        
        $html = '';
        if ($isPermasalahan) {
            foreach ($lines as $line) {
                $cleanLine = preg_replace('/^[\\?\\-\\*\\d\\.\\)\\s]+/u', '', $line);
                if ($cleanLine === '') $cleanLine = $line;
                $html .= '<div class="permasalahan-item">' . htmlspecialchars($cleanLine) . '</div>';
            }
        } else {
            if (count($lines) <= 1) {
                return '<div class="td-content-wrapper">' . nl2br(htmlspecialchars(reset($lines))) . '</div>';
            }
            $html .= '<div class="td-content-wrapper"><ul class="linearitas-list" style="padding-left: 15px; margin: 0;">';
            foreach ($lines as $line) {
                $cleanLine = preg_replace('/^[\\?\\-\\*\\d\\.\\)\\s]+/u', '', $line);
                if ($cleanLine === '') $cleanLine = $line;
                $html .= '<li>' . htmlspecialchars($cleanLine) . '</li>';
            }
            $html .= '</ul></div>';
        }
        return $html;
    }"""
    content = content.replace(old_php_func, new_php_func)

    # 3. Update the table body to use the new parameter
    content = content.replace("<td><?= formatLinearitasCell($row['permasalahan_pokok']) ?></td>", '<td class="td-permasalahan"><?= formatLinearitasCell($row[\'permasalahan_pokok\'], true) ?></td>')

    # 4. Re-order the Add Modal form
    # Extract the form-field-cards
    isu_strat_match = re.search(r'<!-- 2\. Isu Strategis -->.*?</div>\s*<!-- 3\. Permasalahan -->', content, re.DOTALL)
    if isu_strat_match:
        isu_strat_html = isu_strat_match.group(0).replace('<!-- 3. Permasalahan -->', '').strip()
        perm_match = re.search(r'<!-- 3\. Permasalahan -->.*?</div>\s*<!-- 4\. Isu KLHS -->', content, re.DOTALL)
        perm_html = perm_match.group(0).replace('<!-- 4. Isu KLHS -->', '').strip()
        
        # We need to swap Permasalahan to be first, then Isu KLHS, then Global, etc.
        # Let's just manually replace the entire modal body for Add and Edit since it's cleaner
        pass

    # We will just regex replace the entire body of both modals to get the order right.
    # Add Modal:
    old_add_body = re.search(r'<div class="modal-body modal-body-scrollable">.*?</div>\s*<div class="modal-footer">', content, re.DOTALL)
    
    if old_add_body:
        new_add_body = """<div class="modal-body modal-body-scrollable">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="TambahPeriodeRPJMD">
                            <span>1. Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="PeriodeRPJMD" id="TambahPeriodeRPJMD" required>
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Permasalahan Pokok -->
                    <div class="form-field-card">
                        <label for="TambahPermasalahan">
                            <span>2. Permasalahan Pokok</span>
                            <span class="field-hint">Tekan Enter untuk permasalahan baru</span>
                        </label>
                        <textarea class="form-control" name="permasalahan_pokok" id="TambahPermasalahan" placeholder="Contoh:&#10;Infrastruktur kesehatan belum merata&#10;Masih adanya kasus Stunting"></textarea>
                    </div>

                    <!-- 3. Isu KLHS -->
                    <div class="form-field-card">
                        <label for="TambahIsuKLHS">
                            <span>3. Isu KLHS</span>
                            <span class="field-hint">Isu Kajian Lingkungan Hidup Strategis</span>
                        </label>
                        <textarea class="form-control" name="isu_klhs" id="TambahIsuKLHS" placeholder="Contoh: Kualitas SDM"></textarea>
                    </div>

                    <div class="text-center" style="margin: 10px 0;">
                        <span class="modal-section-badge">
                            <i class="fa fa-globe"></i> Isu Lingkungan Dinamis
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <!-- Global -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="TambahIsuGlobal"><span>Global</span></label>
                                <textarea class="form-control" name="isu_global" id="TambahIsuGlobal" placeholder="Contoh: Persaingan Talenta Global"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Nasional -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="TambahIsuNasional"><span>Nasional</span></label>
                                <textarea class="form-control" name="isu_nasional" id="TambahIsuNasional" placeholder="Contoh: Rendahnya Kualitas SDM"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Regional -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="TambahIsuRegional"><span>Regional</span></label>
                                <textarea class="form-control" name="isu_regional" id="TambahIsuRegional" placeholder="Contoh: Pengembangan SDM..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Isu Strategis -->
                    <div class="form-field-card">
                        <label for="TambahNamaIsuStrategis">
                            <span>4. Isu Strategis Daerah <span class="text-danger">*</span></span>
                            <span class="field-hint">Rumusan isu strategis daerah</span>
                        </label>
                        <textarea class="form-control" name="NamaIsuStrategis" id="TambahNamaIsuStrategis" placeholder="Contoh: Sumber Daya Manusia yang Belum Berdaya Saing" required></textarea>
                    </div>

                </div>"""
        content = content.replace(old_add_body.group(0), new_add_body + '\n                <div class="modal-footer">')

    # Edit Modal:
    old_edit_body = re.search(r'<div class="modal-body modal-body-scrollable" id="EditModalBody">.*?</div>\s*<div class="modal-footer">', content, re.DOTALL)
    
    if old_edit_body:
        new_edit_body = """<div class="modal-body modal-body-scrollable" id="EditModalBody">
                    <input type="hidden" name="Id" id="EditId">
                    
                    <!-- 1. Periode RPJMD -->
                    <div class="form-field-card">
                        <label for="EditPeriodeRPJMD">
                            <span>1. Periode RPJMD <span class="text-danger">*</span></span>
                            <span class="field-hint">Pilih periode berlaku dokumen</span>
                        </label>
                        <select class="form-control" name="PeriodeRPJMD" id="EditPeriodeRPJMD" required>
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($Periods)) { foreach ($Periods as $p) { 
                                $valP = $p['TahunMulai'] . '-' . $p['TahunAkhir'];
                            ?>
                                <option value="<?= $valP ?>"><?= $p['TahunMulai'] ?> - <?= $p['TahunAkhir'] ?></option>
                            <?php } } else { ?>
                                <option value="2025-2029">2025 - 2029</option>
                                <option value="2026-2030">2026 - 2030</option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- 2. Permasalahan Pokok -->
                    <div class="form-field-card">
                        <label for="EditPermasalahan">
                            <span>2. Permasalahan Pokok</span>
                            <span class="field-hint">Tekan Enter untuk permasalahan baru</span>
                        </label>
                        <textarea class="form-control" name="permasalahan_pokok" id="EditPermasalahan" placeholder="Contoh:&#10;Infrastruktur kesehatan belum merata&#10;Masih adanya kasus Stunting"></textarea>
                    </div>

                    <!-- 3. Isu KLHS -->
                    <div class="form-field-card">
                        <label for="EditIsuKLHS">
                            <span>3. Isu KLHS</span>
                        </label>
                        <textarea class="form-control" name="isu_klhs" id="EditIsuKLHS"></textarea>
                    </div>

                    <div class="text-center" style="margin: 10px 0;">
                        <span class="modal-section-badge">
                            <i class="fa fa-globe"></i> Isu Lingkungan Dinamis
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <!-- Global -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="EditIsuGlobal"><span>Global</span></label>
                                <textarea class="form-control" name="isu_global" id="EditIsuGlobal"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Nasional -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="EditIsuNasional"><span>Nasional</span></label>
                                <textarea class="form-control" name="isu_nasional" id="EditIsuNasional"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Regional -->
                            <div class="form-field-card" style="background-color: #f8fafc;">
                                <label for="EditIsuRegional"><span>Regional</span></label>
                                <textarea class="form-control" name="isu_regional" id="EditIsuRegional"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Isu Strategis -->
                    <div class="form-field-card">
                        <label for="EditNamaIsuStrategis">
                            <span>4. Isu Strategis Daerah <span class="text-danger">*</span></span>
                            <span class="field-hint">Rumusan isu strategis daerah</span>
                        </label>
                        <textarea class="form-control" name="NamaIsuStrategis" id="EditNamaIsuStrategis" required></textarea>
                    </div>

                </div>"""
        content = content.replace(old_edit_body.group(0), new_edit_body + '\n                <div class="modal-footer">')

    # Add extra style for td-content-wrapper in row with Isu Strategis
    # so Isu Strategis column doesn't jump to top but is vertically centered. 
    # vertical-align: middle !important handles this.
    
    with open('application/views/Daerah/IsuStrategisDaerah.php', 'w', encoding='utf-8') as f:
        f.write(content)

process_file()
