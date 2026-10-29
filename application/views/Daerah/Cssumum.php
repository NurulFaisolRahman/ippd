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

        #data-table-basic {
        font-size: 12px;
        }

        #data-table-basic thead th {
        font-size: 12px;
        font-weight: bold;
        padding: 6px;
        }

        #data-table-basic tbody td {
        font-size: 12px;
        padding: 6px;
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
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            padding: 0 !important;
            border-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            font-size: 13px !important;
            line-height: 1 !important;
            margin: 0 !important;
            cursor: pointer !important;
            transition: all 0.15s ease-in-out !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
        }

        .btn-action-group .btn:hover,
        .btn-group-flex .btn:hover,
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
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15) !important;
            opacity: 0.95 !important;
        }

        /* Edit / Warning Button Style */
        .btn-action-edit,
        td.text-center .btn.btn-amber,
        td.text-center .btn.btn-warning,
        td.text-center .btn.BtnEdit,
        td.text-center .btn.BtnEditDetail,
        td.text-center .btn.EditHeader {
            background-color: #f59e0b !important;
            border: 1px solid #d97706 !important;
            color: #ffffff !important;
        }
        .btn-action-edit:hover,
        td.text-center .btn.btn-amber:hover,
        td.text-center .btn.btn-warning:hover,
        td.text-center .btn.BtnEdit:hover,
        td.text-center .btn.BtnEditDetail:hover,
        td.text-center .btn.EditHeader:hover {
            background-color: #d97706 !important;
            color: #ffffff !important;
        }

        /* Delete / Danger Button Style */
        .btn-action-delete,
        td.text-center .btn.btn-danger,
        td.text-center .btn.BtnHapus,
        td.text-center .btn.BtnHapusMaster,
        td.text-center .btn.BtnHapusDetail,
        td.text-center .btn.HapusHeader,
        td.text-center .btn.HapusKolom {
            background-color: #ef4444 !important;
            border: 1px solid #dc2626 !important;
            color: #ffffff !important;
        }
        .btn-action-delete:hover,
        td.text-center .btn.btn-danger:hover,
        td.text-center .btn.BtnHapus:hover,
        td.text-center .btn.BtnHapusMaster:hover,
        td.text-center .btn.BtnHapusDetail:hover,
        td.text-center .btn.HapusHeader:hover,
        td.text-center .btn.HapusKolom:hover {
            background-color: #dc2626 !important;
            color: #ffffff !important;
        }

        /* Add / Success Button Style */
        .btn-action-add,
        td.text-center .btn.btn-success,
        td.text-center .btn.BtnAddDetail,
        td.text-center .btn.TambahKolom {
            background-color: #10b981 !important;
            border: 1px solid #059669 !important;
            color: #ffffff !important;
        }
        .btn-action-add:hover,
        td.text-center .btn.btn-success:hover,
        td.text-center .btn.BtnAddDetail:hover,
        td.text-center .btn.TambahKolom:hover {
            background-color: #059669 !important;
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