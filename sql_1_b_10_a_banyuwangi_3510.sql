-- ========================================================
-- SINKRONISASI DATA RKP & RKPD TPT (POIN 1.b.10.a)
-- KABUPATEN BANYUWANGI (KODE WILAYAH: 35.10)
-- ========================================================

-- 1. DATA MASTER RKP NASIONAL (Tabel: sasaran_pembangunan_rkp)
-- Realisasi Tahun 2024: TPT 4.91
INSERT INTO `sasaran_pembangunan_rkp` (`LPE`, `Kemiskinan`, `TPT`, `IMM`, `RasioGINI`, `IntensitasEmisiGRK`, `NTP`, `NTN`, `Tahun`, `created_at`, `updated_at`)
VALUES ('5.05', '9.36', '4.91', '0.56', '0.380', '38.6', '113', '104', '2024', NOW(), NOW())
ON DUPLICATE KEY UPDATE `TPT` = VALUES(`TPT`), `updated_at` = NOW();

-- Target Tahun Terakhir 2026: TPT 4.44
INSERT INTO `sasaran_pembangunan_rkp` (`LPE`, `Kemiskinan`, `TPT`, `IMM`, `RasioGINI`, `IntensitasEmisiGRK`, `NTP`, `NTN`, `Tahun`, `created_at`, `updated_at`)
VALUES ('5.3 - 5.6', '7.0 - 8.0', '4.44', '0.56', '0.380', '38.6', '113', '104', '2026', NOW(), NOW())
ON DUPLICATE KEY UPDATE `TPT` = VALUES(`TPT`), `updated_at` = NOW();


-- 2. DATA TARGET MAKRO EKONOMI DAERAH RKPD (Tabel: target_makro_ekonomi)
-- Realisasi Tahun 2024: TPT 4.03
INSERT INTO `target_makro_ekonomi` (`kode_wilayah`, `tahun`, `indikator`, `target_rkpd_provinsi`, `target_rkpd_kabkota`, `keterangan`, `urutan`, `created_at`, `updated_at`)
VALUES ('35.10', 2024, 'Tingkat Pengangguran Terbuka (TPT) (%)', '4.03', '4.03', 'Realisasi RKPD 2024', 2, NOW(), NOW())
ON DUPLICATE KEY UPDATE `target_rkpd_kabkota` = VALUES(`target_rkpd_kabkota`), `updated_at` = NOW();

-- Target Tahun Terakhir 2026: TPT 3.77
INSERT INTO `target_makro_ekonomi` (`kode_wilayah`, `tahun`, `indikator`, `target_rkpd_provinsi`, `target_rkpd_kabkota`, `keterangan`, `urutan`, `created_at`, `updated_at`)
VALUES ('35.10', 2026, 'Tingkat Pengangguran Terbuka (TPT) (%)', '3.77', '3.77', 'Target Tahun Terakhir RKPD 2026', 2, NOW(), NOW())
ON DUPLICATE KEY UPDATE `target_rkpd_kabkota` = VALUES(`target_rkpd_kabkota`), `updated_at` = NOW();


-- 3. PENILAIAN AWAL IPPD POIN 1.b.10.a (Tabel: ippd_penilaian)
INSERT INTO `ippd_penilaian` (
    `kodewilayah`,
    `instansi_id`,
    `tahun`,
    `item_code`,
    `bobot_capaian`,
    `opsi_aksi`,
    `catatan`,
    `bukti_dukung`,
    `detail_json`,
    `status_verifikasi`,
    `created_at`,
    `updated_at`
) VALUES (
    '35.10',
    1,
    2026,
    '1.b.10.a',
    0.425,
    '0.43',
    'Tingkat Pengangguran Terbuka (TPT) RKPD Banyuwangi 2026 selaras dengan RKP',
    '',
    '{"mn_real":"4.91","mn_target":"4.44","mn_gap":"-0.47","md_real":"4.03","md_target":"3.77","md_gap":"-0.26","margin_real":"0.00%","margin_target":"0.00%","margin_gap":"-44.68%","score_real":100,"score_target":100,"score_gap":55,"avg_score":"85.00%","score_terbobot":"0.43","dokumen":"RKPD Kab Banyuwangi 2026","halaman":"IV-7","tabel":"Tabel 4.1","catatan":""}',
    'Draft',
    NOW(),
    NOW()
) ON DUPLICATE KEY UPDATE 
    `bobot_capaian` = VALUES(`bobot_capaian`),
    `opsi_aksi` = VALUES(`opsi_aksi`),
    `detail_json` = VALUES(`detail_json`),
    `updated_at` = NOW();
