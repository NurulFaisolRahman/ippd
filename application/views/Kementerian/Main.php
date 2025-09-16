<?php $this->load->view('Kementerian/Sidebar'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Data Kementerian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .filter-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .result-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-left: 4px solid #0d6efd;
        }
        .btn-filter {
            background-color: #0d6efd;
            color: white;
        }
        .btn-filter:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4"><i class="fas fa-filter me-2"></i>Filter Data Kementerian</h2>
                
                <!-- Filter Form -->
                <div class="filter-container">
                    <form method="GET" action="<?= base_url('main') ?>">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="periode" class="form-label"><strong>Pilih Periode:</strong></label>
                                    <select class="form-select" id="periode" name="periode" onchange="getKementerian()">
                                        <option value="">-- Pilih Periode --</option>
                                        <?php foreach ($AllPeriode as $periode): ?>
                                            <?php 
                                                $periodeValue = $periode['TahunMulai'] . '|' . $periode['TahunAkhir'];
                                                $periodeText = $periode['TahunMulai'] . ' - ' . $periode['TahunAkhir'];
                                                $selected = ($CurrentPeriode == $periodeValue) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $periodeValue ?>" <?= $selected ?>>
                                                <?= $periodeText ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="kementerian" class="form-label"><strong>Pilih Kementerian:</strong></label>
                                    <select class="form-select" id="kementerian" name="kementerian" <?= empty($Kementerian) ? 'disabled' : '' ?>>
                                        <option value="">-- Pilih Kementerian --</option>
                                        <?php foreach ($Kementerian as $kementerian): ?>
                                            <?php $selected = ($CurrentKementerian == $kementerian['Id']) ? 'selected' : ''; ?>
                                            <option value="<?= $kementerian['Id'] ?>" <?= $selected ?>>
                                                <?= $kementerian['NamaKementerian'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-filter w-100">
                                        <i class="fas fa-search me-1"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Results Section -->
                <?php if ($CurrentKementerian && !empty($SelectedKementerian)): ?>
                <div class="result-container">
                    <h4 class="mb-4">Informasi Kementerian</h4>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= $SelectedKementerian['NamaKementerian'] ?></h5>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>ID Kementerian:</strong> <?= $SelectedKementerian['Id'] ?></p>
                                    <p><strong>Periode:</strong> <?= $SelectedKementerian['TahunMulai'] ?> - <?= $SelectedKementerian['TahunAkhir'] ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Dibuat pada:</strong> <?= date('d/m/Y', strtotime($SelectedKementerian['created_at'])) ?></p>
                                    <?php if ($SelectedKementerian['edited_at']): ?>
                                        <p><strong>Diubah pada:</strong> <?= date('d/m/Y', strtotime($SelectedKementerian['edited_at'])) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php elseif ($CurrentPeriode): ?>
                <div class="result-container text-center">
                    <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                    <h5>Silakan pilih kementerian untuk melihat detail</h5>
                    <p class="text-muted">Pilih kementerian dari dropdown di atas</p>
                </div>
                <?php else: ?>
                <div class="result-container text-center">
                    <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                    <h5>Selamat Datang di Filter Data Kementerian</h5>
                    <p class="text-muted">Pilih periode dan kementerian untuk melihat informasi</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function getKementerian() {
            var periode = $('#periode').val();
            
            if (periode) {
                $.ajax({
                    url: '<?= base_url("main/get_kementerian") ?>',
                    type: 'POST',
                    data: {periode: periode},
                    success: function(response) {
                        var kementerian = JSON.parse(response);
                        var select = $('#kementerian');
                        
                        select.empty().append('<option value="">-- Pilih Kementerian --</option>');
                        
                        if (kementerian.length > 0) {
                            select.prop('disabled', false);
                            $.each(kementerian, function(index, item) {
                                select.append('<option value="' + item.Id + '">' + item.NamaKementerian + '</option>');
                            });
                        } else {
                            select.prop('disabled', true);
                        }
                    }
                });
            } else {
                $('#kementerian').empty().append('<option value="">-- Pilih Kementerian --</option>').prop('disabled', true);
            }
        }
    </script>
</body>
</html>