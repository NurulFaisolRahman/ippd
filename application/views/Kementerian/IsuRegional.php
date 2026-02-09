<?php $this->load->view('Kementerian/Sidebar'); ?>

<div class="main-content">

<div class="breadcomb-area">
    <div class="container">
        <ul class="breadcomb-menu" style="list-style:none;padding:0;margin:0">
            <li style="display:inline-block">
                <a href="<?= base_url('Beranda') ?>">Beranda</a>
                <span class="bread-slash"> / </span>
            </li>
            <li style="display:inline-block">
                <a href="<?= base_url('Kementerian/IsuRegional') ?>">Isu</a>
                <span class="bread-slash"> / </span>
            </li>
            <li style="display:inline-block">
                <span class="bread-blk">Isu Regional</span>
            </li>
        </ul>
    </div>
</div>

<div class="data-table-area">
<div class="container">
<div class="row">
<div class="col-lg-12">

<div class="data-table-list">

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="alert alert-info" style="margin-bottom:15px;">
    <i class="notika-icon notika-info"></i>
    <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName) ?><br>
    <b>Periode :</b> <?= htmlspecialchars($UserPeriode) ?>
</div>
<?php endif; ?>

<div class="basic-tb-hd">
    <div class="button-icon-btn sm-res-mg-t-30">

        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0): ?>
        <button class="btn btn-primary notika-btn-primary" id="FilterIsuRegional">
            <i class="notika-icon notika-search"></i>
            <b>Filter Data</b>
            <?php if (isset($CurrentPeriode) && ($CurrentPeriode || $CurrentKementerian)): ?>
                <span class="badge" style="background:#f44336;margin-left:5px;">Aktif</span>
            <?php endif; ?>
        </button>
        <?php endif; ?>

        <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
        <button class="btn btn-success notika-btn-success" id="BtnInputIsuRegional">
            <i class="notika-icon notika-edit"></i>
            <b>Input Isu Regional</b>
        </button>
        <?php endif; ?>

    </div>
</div>

<div class="table-responsive">
<table id="data-table-basic" class="table table-striped">
<thead>
<tr>
    <th width="5%" class="text-center">No</th>

    <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
        <th width="25%">Kementerian</th>
    <?php endif; ?>

    <th>Isu Regional</th>
    <th width="18%">Periode</th>

    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
        <th width="12%" class="text-center">Aksi</th>
    <?php endif; ?>
</tr>
</thead>

<tbody>
<?php if (!empty($IsuRegional)): ?>
<?php $no=1; foreach($IsuRegional as $row): ?>
<tr>
    <td class="text-center"><?= $no++ ?></td>

    <?php if (!isset($_SESSION['Level']) || $_SESSION['Level'] == 0): ?>
        <td><?= htmlspecialchars($row['NamaKementerian']) ?></td>
    <?php endif; ?>

    <td><?= htmlspecialchars($row['NamaIsuRegional']) ?></td>
    <td><?= $row['TahunMulai'].' - '.$row['TahunAkhir'] ?></td>

    <?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
    <td class="text-center">
        <div class="button-icon-btn button-icon-btn-cl sm-res-mg-t-30">
            <?php if ($row['IdKementerian'] == $_SESSION['IdKementerian']): ?>
                <button class="btn btn-sm btn-amber amber-icon-notika btn-reco-mg btn-button-mg Edit"
                        data-id="<?= $row['Id'] ?>"
                        title="Edit">
                    <i class="notika-icon notika-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger amber-icon-notika btn-reco-mg btn-button-mg Hapus"
                        data-id="<?= $row['Id'] ?>"
                        title="Hapus">
                    <i class="notika-icon notika-trash"></i>
                </button>
            <?php else: ?>
                <button class="btn btn-sm btn-default amber-icon-notika btn-reco-mg btn-button-mg"
                        disabled
                        title="Data milik kementerian lain">
                    <i class="notika-icon notika-lock"></i>
                </button>
            <?php endif; ?>
        </div>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="<?= isset($_SESSION['Level']) && $_SESSION['Level']==1 ? 4 : 4 ?>" class="text-center">
        <div class="alert alert-warning">
            <i class="notika-icon notika-info"></i>
            Belum ada data Isu Regional
        </div>
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="modal fade" id="ModalInputIsuRegional">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Input Isu Regional</h4>
</div>
<div class="modal-body">

<div class="alert alert-info">
    <b>Kementerian :</b> <?= htmlspecialchars($UserKementerianName) ?><br>
    <b>Periode :</b> <?= htmlspecialchars($UserPeriode) ?>
</div>

<div class="form-example-wrap">
    <div class="form-example-int form-horizental">
        <div class="form-group">
            <label><b>Nama Isu Regional</b></label>
            <textarea class="form-control" id="NamaIsuRegional" rows="4"
                placeholder="Tuliskan isu strategis regional..."></textarea>
        </div>
    </div>

    <button class="btn btn-success notika-btn-success" id="InputIsuRegional">
        <i class="notika-icon notika-checked"></i> SIMPAN
    </button>
    <button class="btn btn-default" data-dismiss="modal">BATAL</button>
</div>

</div>
</div>
</div>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1): ?>
<div class="modal fade" id="ModalEditIsuRegional">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4 class="modal-title">Edit Isu Regional</h4>
</div>
<div class="modal-body">

<input type="hidden" id="EditId">

<div class="form-example-wrap">
    <div class="form-example-int">
        <label><b>Nama Isu Regional</b></label>
        <textarea class="form-control" id="EditNamaIsuRegional" rows="4"></textarea>
    </div>

    <button class="btn btn-success notika-btn-success" id="UpdateIsuRegional">
        <i class="notika-icon notika-checked"></i> UPDATE
    </button>
    <button class="btn btn-default" data-dismiss="modal">BATAL</button>
</div>

</div>
</div>
</div>
</div>
<?php endif; ?>

<script src="<?= base_url('js/vendor/jquery-1.12.4.min.js'); ?>"></script>
<script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('js/wow.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery-price-slider.js'); ?>"></script>
<script src="<?= base_url('js/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.scrollUp.min.js'); ?>"></script>
<script src="<?= base_url('js/meanmenu/jquery.meanmenu.js'); ?>"></script>
<script src="<?= base_url('js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
<script src="<?= base_url('js/data-table/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('js/main.js'); ?>"></script>

<script>
$(document).ready(function () {

    /* =====================================================
     * GLOBAL
     * ===================================================== */
    const BaseURL   = "<?= site_url() ?>";
    const UserLevel = <?= isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : -1 ?>;

    /* =====================================================
     * DATATABLE - FIXED VERSION
     * ===================================================== */
    const tableSelector = '#data-table-basic';
    
    // Hapus instance DataTables yang ada jika ada
    if ($.fn.DataTable.isDataTable(tableSelector)) {
        $(tableSelector).DataTable().destroy();
        $(tableSelector).find('tbody').empty(); // Kosongkan tbody untuk memastikan
    }
    
    // Tunggu sejenak untuk memastikan DOM siap
    setTimeout(function() {
        // Inisialisasi DataTables dengan konfigurasi yang aman
        const table = $(tableSelector).DataTable({
            pageLength: 10,
            autoWidth: false,
            ordering: true,
            order: [],
            processing: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            columnDefs: [
                {
                    targets: '_all', // Semua kolom
                    defaultContent: '' // Default content untuk cell kosong
                }
            ],
            drawCallback: function(settings) {
                // Pastikan semua cell memiliki _DT_CellIndex
                const api = this.api();
                const rows = api.rows().nodes();
                const cells = api.cells().nodes();
                
                // Debug log untuk melihat jika ada masalah
                console.log('DataTables initialized successfully');
                console.log('Total rows:', api.rows().count());
                console.log('Total cells:', api.cells().count());
            }
        });
        
        // Tambahkan event untuk cek jika ada error
        table.on('error.dt', function(e, settings, techNote, message) {
            console.error('DataTables error:', message);
            console.error('Tech note:', techNote);
        });
    }, 100);

    /* =====================================================
     * FILTER (ADMIN)
     * ===================================================== */
    $('#FilterIsuRegional').on('click', function () {
        $('#ModalFilter').modal('show');
    });

    $('#FilterPeriode').on('change', function () {
        const periode = $(this).val();
        const select  = $('#FilterKementerianSelect');

        select.html('<option value="">Semua Kementerian</option>');

        if (!periode) return;

        const [tm, ta] = periode.split('|');

        $.post(BaseURL + 'Kementerian/GetKementerianByPeriode', {
            TahunMulai: tm,
            TahunAkhir: ta
        }, function (res) {
            let data;
            try {
                data = JSON.parse(res);
            } catch (e) {
                console.error('Error parsing response:', e);
                return;
            }

            if (Array.isArray(data)) {
                data.forEach(item => {
                    select.append(
                        `<option value="${item.Id}">${item.NamaKementerian}</option>`
                    );
                });
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
        });
    });

    $('#ApplyFilter').on('click', function () {
        let url = BaseURL + 'Kementerian/IsuRegional?';

        const periode     = $('#FilterPeriode').val();
        const kementerian = $('#FilterKementerianSelect').val();

        if (periode)     url += 'periode=' + encodeURIComponent(periode) + '&';
        if (kementerian) url += 'kementerian=' + encodeURIComponent(kementerian);

        window.location.href = url.replace(/&$/, '');
    });

    $('#ResetFilter').on('click', function () {
        window.location.href = BaseURL + 'Kementerian/IsuRegional';
    });

    /* =====================================================
     * INPUT ISU GLOBAL (LEVEL 1)
     * ===================================================== */
    $('#BtnInputIsuRegional').on('click', function () {
        $('#NamaIsuRegional').val('');
        $('#ModalInputIsuRegional').modal('show');
    });

    $('#InputIsuRegional').on('click', function () {
        const nama = $('#NamaIsuRegional').val().trim();

        if (!nama) {
            alert('Nama Isu Regional wajib diisi');
            return;
        }

        if (nama.length < 5) {
            alert('Nama Isu Regional minimal 5 karakter');
            return;
        }

        $.post(BaseURL + 'Kementerian/InputIsuRegional', {
            NamaIsuRegional: nama
        }, function (res) {
            let r;
            try {
                r = JSON.parse(res);
            } catch (e) {
                alert('Response server tidak valid');
                console.error('Parse error:', e);
                return;
            }

            alert(r.message);
            if (r.success) {
                $('#ModalInputIsuRegional').modal('hide');
                location.reload();
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            alert('Gagal menghubungi server: ' + textStatus);
            console.error('AJAX Error:', errorThrown);
        });
    });

    
$(document).on('click', '.Edit', function (e) {
    e.preventDefault();
    
    const id = $(this).data('id');
    const button = $(this);
    
    // Tampilkan loading state
    button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
    
    $.ajax({
        url: BaseURL + 'Kementerian/GetIsuRegionalById',
        type: 'POST',
        dataType: 'json',
        data: { Id: id },
        success: function (response) {
            button.prop('disabled', false).html('<i class="notika-icon notika-edit"></i>');
            
            if (response.success) {
                $('#EditId').val(response.data.Id);
                $('#EditNamaIsuRegional').val(response.data.NamaIsuRegional);
                $('#ModalEditIsuRegional').modal('show');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            button.prop('disabled', false).html('<i class="notika-icon notika-edit"></i>');
            alert('Gagal mengambil data: ' + error);
            console.error('AJAX Error:', error);
        }
    });
});

/* =====================================================
 * UPDATE ISU GLOBAL - FIXED VERSION
 * ===================================================== */
$(document).on('click', '#UpdateIsuRegional', function (e) {
    e.preventDefault();
    
    const id = $('#EditId').val();
    const nama = $('#EditNamaIsuRegional').val().trim();
    const button = $(this);
    
    // Validasi
    if (!nama) {
        alert('Nama Isu Regional wajib diisi');
        return;
    }
    
    if (nama.length < 5) {
        alert('Nama Isu Regional minimal 5 karakter');
        return;
    }
    
    // Tampilkan loading state
    const originalText = button.html();
    button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
    
    $.ajax({
        url: BaseURL + 'Kementerian/UpdateIsuRegional',
        type: 'POST',
        dataType: 'json',
        data: { 
            Id: id,
            NamaIsuRegional: nama
        },
        success: function (response) {
            button.prop('disabled', false).html(originalText);
            
            alert(response.message);
            if (response.success) {
                $('#ModalEditIsuRegional').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 500);
            }
        },
        error: function (xhr, status, error) {
            button.prop('disabled', false).html(originalText);
            alert('Gagal update data: ' + error);
            console.error('AJAX Error:', error);
        }
    });
});
    /* =====================================================
     * DELETE ISU GLOBAL
     * ===================================================== */
    $(document).on('click', '.Hapus', function () {
        const id = $(this).data('id');

        if (!confirm('Yakin ingin menghapus data ini?')) return;

        $.post(BaseURL + 'Kementerian/DeleteIsuRegional', {
            Id: id
        }, function (res) {
            let r;
            try {
                r = JSON.parse(res);
            } catch (e) {
                alert('Response server tidak valid');
                console.error('Parse error:', e);
                return;
            }

            alert(r.message);
            if (r.success) location.reload();
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            alert('Gagal menghapus data: ' + textStatus);
            console.error('AJAX Error:', errorThrown);
        });
    });

    /* =====================================================
     * ERROR HANDLING UNTUK DATATABLES
     * ===================================================== */
    // Tangkap error regional
    window.addEventListener('error', function(e) {
        if (e.message.includes('_DT_CellIndex')) {
            console.error('DataTables Cell Index Error detected');
            // Coba reload tanpa DataTables
            if ($.fn.DataTable.isDataTable(tableSelector)) {
                $(tableSelector).DataTable().destroy();
                $(tableSelector).removeAttr('style');
            }
        }
    });

});
</script>