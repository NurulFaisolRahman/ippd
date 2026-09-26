-- ==============================================================================
-- SQL INSERT / UPDATE (UPSERT) AKUN INSTANSI PERANGKAT DAERAH KABUPATEN BANYUWANGI
-- Kode Wilayah : 35.10
-- Role / Level : 4 (Sama dengan Role Instansi/Dinas di Situbondo)
-- Periode      : 2025 - 2029
-- Password     : $2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6
-- ==============================================================================

INSERT INTO `akun_instansi` (
    `kode_instansi`,
    `kodewilayah`,
    `nama`,
    `urusan_id`,
    `bidang_urusan_id`,
    `idkementerian`,
    `password`,
    `Level`,
    `tahun_mulai`,
    `tahun_akhir`,
    `created_at`,
    `updated_at`,
    `deleted_at`
) VALUES
-- 1. Dinas Pendidikan Banyuwangi
('1.01.0.00.0.00.01.0000', '35.10', 'DINAS PENDIDIKAN BANYUWANGI', '1.01', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 2. Dinas Kesehatan Banyuwangi
('1.02.0.00.0.00.01.0000', '35.10', 'DINAS KESEHATAN BANYUWANGI', '1.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 3. Dinas Pekerjaan Umum Cipta Karya, Perumahan dan Permukiman Banyuwangi
('1.03.1.04.0.00.01.000', '35.10', 'DINAS PEKERJAAN UMUM CIPTA KARYA, PERUMAHAN DAN PERMUKIMAN BANYUWANGI', '1.03,1.04', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 4. Dinas Pekerjaan Umum Pengairan Banyuwangi
('1.03.0.00.0.00.02.0000', '35.10', 'DINAS PEKERJAAN UMUM PENGAIRAN BANYUWANGI', '1.03', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 5. Dinas Sosial, Pemberdayaan Perempuan dan Keluarga Berencana Banyuwangi
('1.06.2.08.2.14.01.000', '35.10', 'DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN KELUARGA BERENCANA BANYUWANGI', '1.06,2.08,2.14', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 6. Dinas Lingkungan Hidup Banyuwangi
('2.11.0.00.0.00.01.0000', '35.10', 'DINAS LINGKUNGAN HIDUP BANYUWANGI', '2.11', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 7. Dinas Kependudukan dan Pencatatan Sipil Banyuwangi
('2.12.0.00.0.00.01.0000', '35.10', 'DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL BANYUWANGI', '2.12', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 8. Dinas Pemberdayaan Masyarakat dan Desa Banyuwangi
('2.13.0.00.0.00.01.0000', '35.10', 'DINAS PEMBERDAYAAN MASYARAKAT DAN DESA BANYUWANGI', '2.13', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 9. Dinas Perhubungan Banyuwangi
('2.15.0.00.0.00.01.000', '35.10', 'DINAS PERHUBUNGAN BANYUWANGI', '2.15', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 10. Dinas Komunikasi, Informatika dan Persandian Banyuwangi
('2.16.2.20.2.21.01.0000', '35.10', 'DINAS KOMUNIKASI, INFORMATIKA DAN PERSANDIAN BANYUWANGI', '2.16,2.20,2.21', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 11. Dinas Koperasi, Usaha Mikro dan Perdagangan Banyuwangi
('2.17.3.30.0.00.01.0000', '35.10', 'DINAS KOPERASI, USAHA MIKRO DAN PERDAGANGAN BANYUWANGI', '2.17,3.30', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 12. Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Banyuwangi
('2.18.0.00.0.00.01.0000', '35.10', 'DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU BANYUWANGI', '2.18', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 13. Dinas Pemuda dan Olahraga Banyuwangi
('2.19.0.00.0.00.01.0000', '35.10', 'DINAS PEMUDA DAN OLAHRAGA BANYUWANGI', '2.19', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 14. Dinas Perpustakaan dan Kearsipan Banyuwangi
('2.23.2.24.0.00.02.0000', '35.10', 'DINAS PERPUSTAKAAN DAN KEARSIPAN BANYUWANGI', '2.23,2.24', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 15. Dinas Perikanan Banyuwangi
('3.25.0.00.0.00.01.0000', '35.10', 'DINAS PERIKANAN BANYUWANGI', '3.25', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 16. Dinas Kebudayaan dan Pariwisata Banyuwangi
('2.22.3.26.0.00.01.0000', '35.10', 'DINAS KEBUDAYAAN DAN PARIWISATA BANYUWANGI', '2.22,3.26', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 17. Dinas Pertanian dan Pangan Banyuwangi
('3.27.2.09.0.00.01.0000', '35.10', 'DINAS PERTANIAN DAN PANGAN BANYUWANGI', '3.27,2.09', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 18. Badan Perencanaan Pembangunan Daerah Banyuwangi
('5.01.5.05.0.00.01.0000', '35.10', 'BADAN PERENCANAAN PEMBANGUNAN DAERAH BANYUWANGI', '5.01,5.05', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 19. Badan Pendapatan Daerah Banyuwangi
('5.02.0.00.0.00.02.0000', '35.10', 'BADAN PENDAPATAN DAERAH BANYUWANGI', '5.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 20. Badan Pengelolaan Keuangan dan Aset Daerah Banyuwangi
('5.02.0.00.0.00.01.0000', '35.10', 'BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH BANYUWANGI', '5.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 21. Badan Kepegawaian, Pendidikan dan Pelatihan Banyuwangi
('5.03.5.04.0.00.01.0000', '35.10', 'BADAN KEPEGAWAIAN, PENDIDIKAN DAN PELATIHAN BANYUWANGI', '5.03,5.04', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 22. Badan Kesatuan Bangsa dan Politik Banyuwangi
('8.01.0.00.0.00.01.0000', '35.10', 'BADAN KESATUAN BANGSA DAN POLITIK BANYUWANGI', '8.01', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 23. Badan Penanggulangan Bencana Daerah Banyuwangi
('1.05.0.00.0.00.02.0000', '35.10', 'BADAN PENANGGULANGAN BENCANA DAERAH BANYUWANGI', '1.05', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 24. Inspektorat Kabupaten Banyuwangi
('6.01.0.00.0.00.01.0000', '35.10', 'INSPEKTORAT KABUPATEN BANYUWANGI', '6.01', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 25. Sekretariat Daerah Banyuwangi
('4.01.0.00.0.00.01.0000', '35.10', 'SEKRETARIAT DAERAH BANYUWANGI', '4.01', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 26. Sekretariat Dewan Perwakilan Rakyat Daerah Banyuwangi
('4.02.0.00.0.00.01.0000', '35.10', 'SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH BANYUWANGI', '4.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 27. Satuan Polisi Pamong Praja Banyuwangi
('1.05.0.00.0.00.01.0000', '35.10', 'SATUAN POLISI PAMONG PRAJA BANYUWANGI', '1.05', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 28. RSUD Blambangan Banyuwangi
('1.02.0.00.0.00.01.0001', '35.10', 'RSUD BLAMBANGAN BANYUWANGI', '1.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL),

-- 29. RSUD Genteng Banyuwangi
('1.02.0.00.0.00.01.0002', '35.10', 'RSUD GENTENG BANYUWANGI', '1.02', NULL, NULL, '$2y$10$T2iMP5EGv1kn65isGJn.Guf7Pb5u7/uGEOv9R.HJoazwJbwxqDLG6', 4, 2025, 2029, NOW(), NOW(), NULL)

ON DUPLICATE KEY UPDATE
    `nama` = VALUES(`nama`),
    `urusan_id` = VALUES(`urusan_id`),
    `password` = VALUES(`password`),
    `Level` = VALUES(`Level`),
    `tahun_mulai` = VALUES(`tahun_mulai`),
    `tahun_akhir` = VALUES(`tahun_akhir`),
    `deleted_at` = NULL,
    `updated_at` = NOW();
