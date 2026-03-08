<style>
    /* CSS Card Container Enhancement */
    .data-table-list {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: none;
    }

    /* CSS Table Enhancement */
    .table > thead > tr > th {
        background-color: #f8f9fa;
        color: #455a64;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0 !important;
        vertical-align: middle;
    }
    .table > tbody > tr > td {
        vertical-align: middle;
        color: #444;
        border-top: 1px solid #f2f2f2;
        font-size: 13px;
    }
    .table > tbody > tr {
        transition: filter 0.2s ease;
    }
    .table > tbody > tr:hover {
        filter: brightness(0.96); 
    }

    /* CSS Button Enhancements */
    .btn-action {
        border-radius: 5px;
        margin: 0 2px;
        transition: all 0.3s ease;
        padding: 6px 12px;
        font-weight: 600;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Label/Badge untuk Level Akun */
    .badge-level {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        color: #fff;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .bg-kemen { background-color: #8bc34a; } /* Hijau */
    .bg-prov { background-color: #00bcd4; }  /* Biru Cyan */
    .bg-kab { background-color: #ff9800; }   /* Oranye */

    /* CSS untuk Modal Vertical Center */
    .modal {
        text-align: center;
        padding: 0!important;
    }
    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }
    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        max-width: 95%; 
    }
    .modal-header h2 {
        font-size: 20px;
        color: #333;
        font-weight: 600;
        margin-bottom: 0;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="basic-tb-hd" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <h3 style="margin: 0; color: #333; font-weight: 600; line-height: 1.5;">Manajemen Akun</h3>
                        <div class="button-icon-btn sm-res-mg-t-30">
                            <button type="button" class="btn btn-success notika-btn-success btn-action" data-toggle="modal" data-target="#ModalInputAkun">
                                <i class="fa fa-user-plus" style="margin-right: 5px;"></i> <b>Buat Akun</b>
                            </button>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th style="width: 25%;">Username</th>
                                    <th style="width: 35%;">Password (Hashed)</th>
                                    <th style="width: 15%;" class="text-center">Tipe Akun</th>
                                    <th style="width: 20%;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $No = 1; foreach ($Akun as $key) { ?>
                                <tr>
                                    <td class="text-center"><b><?=$No++?></b></td>
                                    <td><b><?=$key['Username']?></b></td>
                                    <td style="font-family: monospace; color: #888; font-size: 11px; word-break: break-all;">
                                        <?=$key['Password']?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($key['Level'] == 1) { ?>
                                            <span class="badge-level bg-kemen"><i class="fa fa-building"></i> Kementerian</span>
                                        <?php } elseif($key['Level'] == 2) { ?>
                                            <span class="badge-level bg-prov"><i class="fa fa-map"></i> Provinsi</span>
                                        <?php } else { ?>
                                            <span class="badge-level bg-kab"><i class="fa fa-map-marker"></i> Kab/Kota</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info btn-action Edit" Edit="<?=$key['Username']?>|<?=$key['Username']?>" title="Edit Akun"><i class="fa fa-edit"></i> Edit</button>
                                        <button class="btn btn-sm btn-danger btn-action Hapus" Hapus="<?=$key['Username']?>" title="Hapus Akun"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL INPUT AKUN BARU -->
<div class="modal fade" id="ModalInputAkun" role="dialog">
    <div class="modal-dialog modals-default" style="width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-user-plus"></i> Buat Akun Baru</h2>
            </div>
            <div class="modal-body" style="padding-top: 25px;">
                
                <!-- Tipe Akun -->
                <div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp"><i class="fa fa-users" style="color: #666;"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="form-control" id="User">
                            <option value="">-- Pilih Tipe Akun --</option>
                            <option value="1">Kementerian</option>
                            <option value="2">Provinsi</option>
                            <option value="3">Kab/Kota</option>
                        </select>
                    </div>
                </div>

                <!-- Periode (Dinamic) -->
                <div class="form-group ic-cmp-int" id="ListPeriode" style="display: none; margin-top: 15px;">
                    <div class="form-ic-cmp"><i class="fa fa-calendar" style="color: #666;"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="form-control" id="Periode">
                            <option value="">-- Pilih Periode --</option>
                        </select>
                    </div>
                </div>

                <!-- Kementerian (Dinamic) -->
                <div class="form-group ic-cmp-int" id="ListKementerian" style="display: none; margin-top: 15px;">
                    <div class="form-ic-cmp"><i class="fa fa-building" style="color: #666;"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="form-control" id="Kementrian">
                            <option value="">-- Pilih Kementerian --</option>
                        </select>
                    </div>
                </div>

                <!-- Provinsi (Dinamic) -->
                <div class="form-group ic-cmp-int" id="ListProvinsi" style="display: none; margin-top: 15px;">
                    <div class="form-ic-cmp"><i class="fa fa-map" style="color: #666;"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="form-control" id="Provinsi">
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>
                </div>

                <!-- Kab/Kota (Dinamic) -->
                <div class="form-group ic-cmp-int" id="ListKabKota" style="display: none; margin-top: 15px;">
                    <div class="form-ic-cmp"><i class="fa fa-map-marker" style="color: #666;"></i></div>
                    <div class="nk-int-st" style="width: 100%;">
                        <select class="form-control" id="KabKota">
                            <option value="">-- Pilih Kab/Kota --</option>
                        </select>
                    </div>
                </div>

                <!-- Username -->
                <div class="form-group ic-cmp-int" style="margin-top: 25px;">
                    <div class="form-ic-cmp"><i class="fa fa-user" style="color: #00c292;"></i></div>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" id="Username" placeholder="Ketik Username..." autocomplete="off">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group ic-cmp-int" style="margin-top: 15px;">
                    <div class="form-ic-cmp"><i class="fa fa-lock" style="color: #00c292;"></i></div>
                    <div class="nk-int-st">
                        <input type="password" class="form-control" id="Password" placeholder="Ketik Password..." autocomplete="new-password">
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-success btn-action" id="Input"><i class="fa fa-save"></i> SIMPAN AKUN</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT AKUN (Tambahan) -->
<div class="modal fade" id="ModalEditAkun" role="dialog">
    <div class="modal-dialog modals-default" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2><i class="fa fa-edit"></i> Edit Username</h2>
            </div>
            <div class="modal-body" style="padding-top: 25px;">
                <input type="hidden" id="Id">
                <div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp"><i class="fa fa-user" style="color: #00c292;"></i></div>
                    <div class="nk-int-st">
                        <input type="text" class="form-control" id="_Username" placeholder="Username...">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 15px;">
                <button type="button" class="btn btn-info btn-action" id="BtnUpdateAkun"><i class="fa fa-save"></i> UPDATE</button>
                <button type="button" class="btn btn-default btn-action" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/vendor/jquery-1.12.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery-price-slider.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.scrollUp.min.js"></script>
<script src="../js/meanmenu/jquery.meanmenu.js"></script>
<script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../js/data-table/jquery.dataTables.min.js"></script>
<script src="../js/data-table/data-table-act.js"></script>
<script src="../js/main.js"></script>

<script>
    var BaseURL = '<?=base_url()?>';
    
    jQuery(document).ready(function($) {

        $("#User").change(function(){
            if ($("#User").val() == "") {
                alert("Mohon Pilih Akun");
                $("#ListPeriode").hide(); $("#ListKementerian").hide(); $("#ListProvinsi").hide(); $("#ListKabKota").hide();
            } else if ($("#User").val() == "1") {
                $.post(BaseURL+"Super/GetPeriodeKementerian").done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Periode = '<option value="">-- Pilih Periode --</option>'
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            Periode += '<option value="'+Data[i].TahunMulai+'">'+Data[i].TahunMulai+' - '+Data[i].TahunAkhir+'</option>'
                        }    
                    } else {
                        alert("Belum Ada Data Periode")
                    }
                    $("#Periode").html(Periode)
                    $("#ListPeriode").show();
                    
                    var Kementerian = '<option value="">-- Pilih Kementerian --</option>'
                    $("#Kementrian").html(Kementerian)
                    $("#ListKementerian").show();
                    
                    $("#ListProvinsi").hide();
                    $("#ListKabKota").hide();
                })                        
            } else {
                $.post(BaseURL+"Super/GetListProvinsi").done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Provinsi = '<option value="">-- Pilih Provinsi --</option>'
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            Provinsi += '<option value="'+Data[i].Kode+'">'+Data[i].Nama+'</option>'
                        }   
                        $("#Provinsi").html(Provinsi)
                        
                        $("#ListKementerian").hide();
                        $("#ListPeriode").hide();
                        $("#ListProvinsi").show();
                        
                        if ($("#User").val() == "2") {    
                            $("#ListKabKota").hide();
                        } else {
                            var KabKota = '<option value="">-- Pilih Kab/Kota --</option>'
                            $("#KabKota").html(KabKota)
                            $("#ListKabKota").show();
                        }
                    } else {
                        alert("Belum Ada Data Provinsi")
                    }
                })                        
            } 
        });

        $("#Periode").change(function(){
            if ($("#Periode").val() == "") {
                alert("Mohon Input Periode")
            } else {
                $.post(BaseURL+"Super/GetListKementerian", {TahunMulai:$("#Periode").val()}).done(function(Respon) {
                    var Data = JSON.parse(Respon)
                    var Kementerian = '<option value="">-- Pilih Kementerian --</option>'
                    if (Data.length > 0) {
                        for (let i = 0; i < Data.length; i++) {
                            Kementerian += '<option value="'+Data[i].Id+'">'+Data[i].NamaKementerian+'</option>'
                        }    
                    } else {
                        alert("Belum Ada Data Kementerian")
                    }
                    $("#Kementrian").html(Kementerian)
                })                    
            }
        });

        $("#Provinsi").change(function(){
            $.post(BaseURL+"Super/GetListKabKota", { Kode : $("#Provinsi").val()}).done(function(Respon) {
                var Data = JSON.parse(Respon)
                var KabKota = '<option value="">-- Pilih Kab/Kota --</option>'
                if (Data.length > 0) {
                    for (let i = 0; i < Data.length; i++) {
                        KabKota += '<option value="'+Data[i].Kode+'">'+Data[i].Nama+'</option>'
                    }    
                } else {
                    alert("Belum Ada Data Kab/Kota")
                }
                $("#KabKota").html(KabKota)
            })
        }); 

        $("#Input").click(function() {
            if ($("#User").val() == "") {
                alert('Tipe Akun Belum Dipilih!'); return false;
            } else if ($("#User").val() == "1") {
                if ($("#Periode").val() == "") { alert("Mohon Input Periode"); return false; } 
                else if ($("#Kementrian").val() == "") { alert("Mohon Input Kementerian"); return false; }
            } else if ($("#User").val() == "2") {
                if ($("#Provinsi").val() == "") { alert("Mohon Input Provinsi"); return false; }
            } else if ($("#User").val() == "3") {
                if ($("#KabKota").val() == "") { alert("Mohon Input Kab/Kota"); return false; }
            } 
            
            if ($("#Username").val() == "") {
                alert('Input Username Belum Benar!')
            } else if ($("#Password").val() == "") {
                alert('Input Password Belum Benar!')
            } else {
                var Akun = { 
                    Level: $("#User").val(),
                    Username: $("#Username").val(),
                    Password: $("#Password").val() 
                };

                if ($("#User").val() == "1") Akun['IdKementerian'] = $("#Kementrian").val();
                else if ($("#User").val() == "2") Akun['KodeWilayah'] = $("#Provinsi").val();
                else if ($("#User").val() == "3") Akun['KodeWilayah'] = $("#KabKota").val();
                  
                $.post(BaseURL+"Super/InputAkun", Akun).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                })                        
            }
        });
        
        $(document).on("click",".Edit",function(){
            var Data = $(this).attr('Edit');
            var Pisah = Data.split("|");
            $("#Id").val(Pisah[0]); // Asumsi Index 0 Id
            $("#_Username").val(Pisah[1]); // Asumsi Index 1 Username
            $('#ModalEditAkun').modal("show");
        });

        $('#data-table-basic tbody').on('click', '.Hapus', function () {
            if(confirm("Yakin ingin menghapus akun ini?")) {
                var Akun = { Username: $(this).attr('Hapus') }
                $.post(BaseURL+"Super/HapusAkun", Akun).done(function(Respon) {
                    if (Respon == '1') {
                        window.location.reload();
                    } else {
                        alert(Respon);
                    }
                });
            }                        
        });
    });  
</script>
</body>
</html>