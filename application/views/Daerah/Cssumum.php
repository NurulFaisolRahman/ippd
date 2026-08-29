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
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?=base_url()?>css/data-table/bootstrap-editable.css">
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

        td.text-center > .button-icon-btn.button-icon-btn-cl{
        display: inline-flex !important;      /* ikut text-align center */
        justify-content: center;
        align-items: center;
        gap: 8px;                  /* jarak antar tombol */
        }

        /* jaga kalau wrapper tidak langsung child (kadang ada div lain) */
        td.text-center .button-icon-btn.button-icon-btn-cl{
        justify-content: center;
        align-items: center;
        gap: 8px;
        }
        

    </style>
</head>
</html>