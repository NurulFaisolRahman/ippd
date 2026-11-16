<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?=base_url()?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/notika-custom-icon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Navbar Header Fixed & Seamless Connection with Sidebar */
        .navbar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 64px !important;
            padding: 0 1.25rem !important;
            border-radius: 0 !important;
            border: none !important;
            margin: 0 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important;
            z-index: 99999 !important;
        }

        .page-top-space {
            height: 64px !important;
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .sidebar-wrapper {
            top: 64px !important;
            height: calc(100vh - 64px) !important;
            border-top: none !important;
            margin-top: 0 !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
        margin-bottom: 20px;
        }

        .filter-row { display:flex; align-items:flex-end; flex-wrap:wrap; gap:10px; }
        .filter-group { display:flex; flex-direction:column; align-items:flex-start; }
        .filter-group label { font-size:14px; margin-bottom:5px; }
        .filter-select { width:260px; font-size:14px; padding:5px 8px; }
        @media (max-width:768px){
        .filter-row{ flex-direction:column; gap:15px; }
        .filter-select{ width:100%; }
        }

        /* ================= FILTER WILAYAH SEPERTI TABULASI ================= */
        .filter-card-custom {
            background: #ffffff !important;
            border-radius: 12px !important;
            padding: 18px 24px !important;
            margin-bottom: 20px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04) !important;
            border: 1px solid #cbd5e1 !important;
        }
        .filter-card-custom .filter-header-title {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            margin-bottom: 14px !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .filter-card-custom .filter-header-title i {
            color: #2d6a4f !important;
        }
        .filter-card-custom .col-filter label {
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #475569 !important;
            margin-bottom: 5px !important;
            display: block !important;
        }
        .filter-card-custom .filter-select-custom {
            width: 100% !important;
            height: 38px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            font-size: 13px !important;
            padding: 6px 10px !important;
            color: #1e293b !important;
            background-color: #ffffff !important;
        }
        .btn-primary-custom {
            background: #2d6a4f !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.25) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            transition: all .15s ease !important;
            cursor: pointer !important;
        }
        .btn-primary-custom:hover {
            background: #1e3d34 !important;
            color: #ffffff !important;
            box-shadow: 0 6px 16px rgba(30, 61, 52, 0.35) !important;
        }
        .wilayah-terpilih-badge {
            margin-top: 14px !important;
            padding: 10px 14px !important;
            background: #f2fbf5 !important;
            border-left: 4px solid #2d6a4f !important;
            border-radius: 6px !important;
            font-size: 12.5px !important;
            color: #334155 !important;
        }

        /* ================= TABEL MODERN RENSTRA (SERUPA IKK PD) ================= */
        .table-ikk-wrapper {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            overflow: hidden !important;
            background: #ffffff !important;
            margin-bottom: 12px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
        }
        .table-ikk-wrapper .table-responsive {
            margin-bottom: 0 !important;
            border: none !important;
        }

        .table-ikk-custom {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            font-size: 12.5px !important;
            margin-bottom: 0 !important;
            background: #ffffff !important;
        }

        .table-ikk-custom thead tr th {
            background: #f8fafc !important;
            color: #334155 !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px !important;
            padding: 12px 10px !important;
            border-top: none !important;
            border-left: none !important;
            border-bottom: 2px solid #cbd5e1 !important;
            border-right: 1px solid #e2e8f0 !important;
            vertical-align: middle !important;
            text-align: center;
        }
        .table-ikk-custom thead tr th:last-child {
            border-right: none !important;
        }
        .table-ikk-custom thead tr th.th-target-group {
            background: #f1f5f9 !important;
            color: #0f172a !important;
            font-weight: 800 !important;
            border-bottom: 1.5px solid #cbd5e1 !important;
        }
        .table-ikk-custom thead tr.th-years-sub th {
            background: #f8fafc !important;
            font-size: 11.5px !important;
            color: #0369a1 !important;
            font-weight: 700 !important;
            padding: 9px 6px !important;
        }

        .table-ikk-custom tbody td {
            padding: 11px 10px !important;
            border-top: 1px solid #f1f5f9 !important;
            border-right: 1px solid #f1f5f9 !important;
            border-bottom: none !important;
            border-left: none !important;
            vertical-align: middle !important;
            color: #1e293b !important;
            font-size: 12.5px !important;
            line-height: 1.45 !important;
        }
        .table-ikk-custom tbody td:last-child {
            border-right: none !important;
        }
        .table-ikk-custom tbody tr:hover td {
            background-color: #f8fafc !important;
        }
        .table-ikk-custom tbody tr:nth-of-type(odd) td {
            background-color: #ffffff;
        }
        .table-ikk-custom tbody tr:nth-of-type(even) td {
            background-color: #fafbfc;
        }

        /* Kolom Nilai Baseline & Target */
        .table-ikk-custom .td-baseline-val {
            background-color: #f8fafc !important;
            font-weight: 700 !important;
            color: #334155 !important;
            font-family: 'Consolas', 'Roboto Mono', monospace !important;
            font-size: 12px !important;
            text-align: center !important;
            border-right: 1.5px solid #cbd5e1 !important;
            min-width: 65px;
        }
        .table-ikk-custom .td-target-val {
            background-color: #ffffff !important;
            font-weight: 600 !important;
            color: #0369a1 !important;
            font-family: 'Consolas', 'Roboto Mono', monospace !important;
            font-size: 12px !important;
            text-align: center !important;
            border-right: 1px dashed #e2e8f0 !important;
            min-width: 60px;
        }

        /* Card Modern Curve Renstra */
        .data-table-list {
            border-radius: 14px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            padding: 24px 26px !important;
        }

        /* DataTables Controls & Wrapper Styling - Konsep IKK PD */
        .dataTables_wrapper {
            padding-top: 8px !important;
        }
        .table-ikk-wrapper .dataTables_wrapper {
            padding-left: 8px !important;
            padding-right: 8px !important;
            padding-top: 8px !important;
        }
        .dataTables_wrapper .dataTables_length {
            float: left !important;
            margin-bottom: 14px !important;
            font-size: 13px !important;
            color: #64748b !important;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            margin: 0 6px !important;
            outline: none !important;
            background: #ffffff !important;
            font-size: 13px !important;
            color: #334155 !important;
            height: 34px !important;
        }
        .dataTables_wrapper .dataTables_filter {
            float: right !important;
            width: auto !important;
            max-width: 100% !important;
            margin-bottom: 14px !important;
            margin-right: 0 !important;
            padding-right: 0 !important;
            position: relative !important;
            text-align: right !important;
            display: flex !important;
            justify-content: flex-end !important;
            align-items: center !important;
        }
        .dataTables_wrapper .dataTables_filter label {
            font-size: 13px !important;
            color: #64748b !important;
            font-weight: 500 !important;
            margin: 0 !important;
            padding: 0 !important;
            width: auto !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 8px !important;
        }
        .dataTables_wrapper .dataTables_filter input {
            height: 36px !important;
            padding: 6px 14px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 20px !important;
            font-size: 13px !important;
            color: #1e293b !important;
            background-color: #ffffff !important;
            background-image: none !important;
            outline: none !important;
            transition: all 0.2s ease !important;
            width: 220px !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04) !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            width: 260px !important;
            border-color: #0ea5e9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15) !important;
        }
        .dataTables_wrapper .dataTables_filter label:after,
        .dataTables_wrapper .dataTables_filter label::after,
        .dataTables_filter label:after,
        .dataTables_filter label::after {
            display: none !important;
            content: none !important;
        }

        /* Perjelas Icon + & Icon Tombol Aksi */
        .notika-icon.bi-plus-lg,
        .notika-icon.bi-plus,
        .notika-icon[class*="bi-"] {
            font-family: 'bootstrap-icons' !important;
            font-style: normal !important;
            font-weight: 900 !important;
        }
        .btn-success .notika-icon,
        .btn-success i,
        .notika-btn-success i,
        .notika-btn-success .notika-icon,
        .btn-primary i,
        .button-icon-btn i,
        .btn i.fa,
        .btn i.fa-plus,
        .btn i.bi,
        .btn i.bi-plus-lg,
        .btn i.bi-plus,
        .btn .notika-icon {
            color: #ffffff !important;
            opacity: 1 !important;
            font-size: 14px !important;
            font-weight: 900 !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        .dataTables_wrapper .dataTables_info {
            float: left;
            margin-top: 18px;
            font-size: 12.5px;
            color: #64748b;
            font-weight: 500;
        }
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            margin-top: 18px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:before,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:before {
            display: none !important;
            content: "" !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            min-width: 32px !important;
            height: 32px !important;
            line-height: 30px !important;
            padding: 0 8px !important;
            text-align: center !important;
            font-size: 12px !important;
            border-radius: 6px !important;
            background: #ffffff !important;
            color: #475569 !important;
            border: 1px solid #e2e8f0 !important;
            margin: 0 3px !important;
            display: inline-block !important;
            vertical-align: middle !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-sizing: border-box !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #00c292 !important;
            border-color: #00c292 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            opacity: 0.4 !important;
            cursor: not-allowed !important;
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            color: #94a3b8 !important;
        }

        /* ================= AKSI BUTTON DALAM TABEL ================= */
        .btn-action-group,
        .btn-group-flex,
        .btn-table-action-group,
        td.text-center > .button-icon-btn.button-icon-btn-cl,
        td.text-center .button-icon-btn.button-icon-btn-cl {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            margin: 0 !important;
            padding: 0 !important;
            vertical-align: middle !important;
        }

        .btn-action-table,
        .btn-action-custom,
        .btn-table-action,
        .btn-action-group .btn,
        .btn-group-flex .btn,
        .btn-xs-custom,
        .btn-aksi,
        td.text-center .btn-aksi,
        td.text-center > .button-icon-btn.button-icon-btn-cl .btn,
        td.text-center .button-icon-btn.button-icon-btn-cl .btn,
        td.text-center .btn.BtnEdit,
        td.text-center .btn.BtnHapus,
        td.text-center .btn.BtnEditMaster,
        td.text-center .btn.BtnHapusMaster,
        td.text-center .btn.BtnEditDetail,
        td.text-center .btn.BtnHapusDetail,
        td.text-center .btn.BtnAddDetail,
        td.text-center .btn.EditHeader,
        td.text-center .btn.HapusHeader,
        td.text-center .btn.EditKolom,
        td.text-center .btn.HapusKolom,
        td.text-center .btn.TambahKolom {
            width: 30px !important;
            height: 30px !important;
            min-width: 30px !important;
            padding: 0 !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            font-size: 13px !important;
            line-height: 1 !important;
            margin: 0 !important;
            cursor: pointer !important;
            transition: all 0.15s ease-in-out !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

        .btn-action-group .btn:hover,
        .btn-group-flex .btn:hover,
        .btn-action-custom:hover,
        .btn-xs-custom:hover,
        td.text-center .button-icon-btn.button-icon-btn-cl .btn:hover,
        td.text-center .btn.BtnEdit:hover,
        td.text-center .btn.BtnHapus:hover,
        td.text-center .btn.BtnEditMaster:hover,
        td.text-center .btn.BtnHapusMaster:hover,
        td.text-center .btn.BtnEditDetail:hover,
        td.text-center .btn.BtnHapusDetail:hover,
        td.text-center .btn.BtnAddDetail:hover,
        td.text-center .btn.EditHeader:hover,
        td.text-center .btn.HapusHeader:hover,
        td.text-center .btn.EditKolom:hover,
        td.text-center .btn.HapusKolom:hover,
        td.text-center .btn.TambahKolom:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.95 !important;
        }

        /* Container grup tombol aksi dalam tabel */
        .action-group,
        .btn-group-aksi,
        .item-actions-group,
        .level-actions {
            display: inline-flex !important;
            flex-direction: row !important;
            gap: 5px !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap !important;
            margin-top: 5px !important;
        }

        /* Tombol Tambah sub-elemen dalam baris tabel (memiliki teks deskripsi seperti Tambah Isu / Sasaran / Indikator) */
        .btn-action-custom.btn-action-add,
        .btn-action-add,
        .btn-add-level,
        .btn-xs-custom.btn-add-level,
        .btn-sub-add {
            width: auto !important;
            min-width: unset !important;
            height: 28px !important;
            padding: 0 10px !important;
            font-size: 11.5px !important;
            font-weight: 600 !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 5px !important;
            white-space: nowrap !important;
            background-color: #10b981 !important;
            border: 1px solid #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.08) !important;
            cursor: pointer !important;
        }
        .btn-action-custom.btn-action-add:hover,
        .btn-action-add:hover,
        .btn-add-level:hover,
        .btn-xs-custom.btn-add-level:hover,
        .btn-sub-add:hover {
            background-color: #059669 !important;
            color: #ffffff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 2px 5px rgba(5, 150, 105, 0.25) !important;
        }

        /* Edit / Warning Button Style (Sesuai Keterkaitan: Amber/Orange) */
        .btn-action-edit,
        .btn-action-custom.btn-action-edit,
        .btn-edit-level,
        .btn-xs-custom.btn-edit-level,
        .btn-aksi,
        .btn-aksi.btn-warning,
        td.text-center .btn.btn-amber,
        td.text-center .btn.btn-warning,
        td.text-center .btn.BtnEdit,
        td.text-center .btn.BtnEditDetail,
        td.text-center .btn.EditHeader {
            background-color: #f0ad4e !important;
            border: 1px solid #eea236 !important;
            color: #ffffff !important;
        }
        .btn-action-edit:hover,
        .btn-action-custom.btn-action-edit:hover,
        .btn-edit-level:hover,
        .btn-xs-custom.btn-edit-level:hover,
        td.text-center .btn.btn-amber:hover,
        td.text-center .btn.btn-warning:hover,
        td.text-center .btn.BtnEdit:hover,
        td.text-center .btn.BtnEditDetail:hover,
        td.text-center .btn.EditHeader:hover {
            background-color: #ec971f !important;
            border-color: #d58512 !important;
            color: #ffffff !important;
        }

        /* Delete / Danger Button Style (Sesuai Keterkaitan: Merah) */
        .btn-action-delete,
        .btn-action-custom.btn-action-delete,
        .btn-del-level,
        .btn-xs-custom.btn-del-level,
        td.text-center .btn.btn-danger,
        td.text-center .btn.BtnHapus,
        td.text-center .btn.BtnHapusMaster,
        td.text-center .btn.BtnHapusDetail,
        td.text-center .btn.HapusHeader,
        td.text-center .btn.HapusKolom {
            background-color: #d9534f !important;
            border: 1px solid #d43f3a !important;
            color: #ffffff !important;
        }
        .btn-action-delete:hover,
        .btn-action-custom.btn-action-delete:hover,
        .btn-del-level:hover,
        .btn-xs-custom.btn-del-level:hover,
        td.text-center .btn.btn-danger:hover,
        td.text-center .btn.BtnHapus:hover,
        td.text-center .btn.BtnHapusMaster:hover,
        td.text-center .btn.BtnHapusDetail:hover,
        td.text-center .btn.HapusHeader:hover,
        td.text-center .btn.HapusKolom:hover {
            background-color: #c9302c !important;
            border-color: #ac2925 !important;
            color: #ffffff !important;
        }

        /* Info / Master Button Style */
        .btn-action-info,
        td.text-center .btn.btn-info,
        td.text-center .btn.BtnEditMaster,
        td.text-center .btn.EditKolom {
            background-color: #0284c7 !important;
            border: 1px solid #0369a1 !important;
            color: #ffffff !important;
        }
        .btn-action-info:hover,
        td.text-center .btn.btn-info:hover,
        td.text-center .btn.BtnEditMaster:hover,
        td.text-center .btn.EditKolom:hover {
            background-color: #0369a1 !important;
            color: #ffffff !important;
        }

        /* Modal Positioning & Centering (Tidak tertimpa header & berada di tengah halaman) */
        .modal {
            text-align: center !important;
            padding: 0 !important;
            z-index: 105000 !important;
            overflow-y: auto !important;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block !important;
            text-align: left !important;
            vertical-align: middle !important;
            margin: 30px auto !important;
        }

        .modal-backdrop {
            z-index: 104990 !important;
        }

        .select2-container--open,
        .select2-dropdown {
            z-index: 105050 !important;
        }
    </style>
</head>
</html>