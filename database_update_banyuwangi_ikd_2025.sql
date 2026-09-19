-- MIGRATION DATA IKD BANYUWANGI (35.10) TAHUN 2025

INSERT IGNORE INTO akun (Username, Password, KodeWilayah, Level, created_at, updated_at) VALUES ('banyuwangi', '$2y$10$gZHWVI0lHSQGslGmgcAFdOTKfgRh7TmNyALFKMoVD9w9tEGEsRy.m', '35.10', 3, NOW(), NOW());

DELETE FROM ikd WHERE kodewilayah = '35.10';
DELETE FROM lkpj_bab3_ikd_capaian WHERE kodewilayah = '35.10';
DELETE FROM lkpj_bab3_ikd_perkembangan WHERE kodewilayah = '35.10';

INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 1, 'Indeks Infrastruktur', 'Angka', 
        '72,84', '72,97', '100,18', 
        '67,68', '69,1', '70,48', '71,4', '72,97', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 80, 'dayasaing', 1, 'Indeks Infrastruktur', 'Angka', '72,84', '72,97', '100,18', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 80, 'dayasaing', 1, 'Indeks Infrastruktur', 'Angka', '67,68', '69,1', '70,48', '71,4', '72,97', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 2, 'Persentase Kontribusi UMKM terhadap PDRB', '%', 
        '45', '45,96', '102,13', 
        NULL, NULL, NULL, NULL, '45,96', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 81, 'dayasaing', 2, 'Persentase Kontribusi UMKM terhadap PDRB', '%', '45', '45,96', '102,13', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 81, 'dayasaing', 2, 'Persentase Kontribusi UMKM terhadap PDRB', '%', NULL, NULL, NULL, NULL, '45,96', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 3, 'Persentase Pertumbuhan Nilai Investasi', '%', 
        '7', '76,4', '1091,43', 
        '-74,95', '276,18', '125,47', '57,1', '76,42', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 82, 'dayasaing', 3, 'Persentase Pertumbuhan Nilai Investasi', '%', '7', '76,4', '1091,43', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 82, 'dayasaing', 3, 'Persentase Pertumbuhan Nilai Investasi', '%', '-74,95', '276,18', '125,47', '57,1', '76,42', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 4, 'Persentase pertumbuhan PDRB Sektor Pertanian, Kehutanan dan Perikanan', '%', 
        '1,99', '3,44', '172,86', 
        '0,34', '4,03', '4,1', '1,94', '3,44', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 83, 'dayasaing', 4, 'Persentase pertumbuhan PDRB Sektor Pertanian, Kehutanan dan Perikanan', '%', '1,99', '3,44', '172,86', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 83, 'dayasaing', 4, 'Persentase pertumbuhan PDRB Sektor Pertanian, Kehutanan dan Perikanan', '%', '0,34', '4,03', '4,1', '1,94', '3,44', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 5, 'Persentase pertumbuhan PDRB Sektor Industri Pengolahan', '%', 
        '6,75', '9,05', '134,07', 
        '6,53', '53', '7,32', '6,7', '9,05', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 84, 'dayasaing', 5, 'Persentase pertumbuhan PDRB Sektor Industri Pengolahan', '%', '6,75', '9,05', '134,07', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 84, 'dayasaing', 5, 'Persentase pertumbuhan PDRB Sektor Industri Pengolahan', '%', '6,53', '53', '7,32', '6,7', '9,05', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 6, 'Persentase pertumbuhan PDRB Perdagangan Besar dan Eceran; Reparasi Mobil dan Sepeda Motor', '%', 
        '4,36', '3,46', '79,36', 
        '6,93', '6,07', '5,59', '4,14', '3,46', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 85, 'dayasaing', 6, 'Persentase pertumbuhan PDRB Perdagangan Besar dan Eceran; Reparasi Mobil dan Sepeda Motor', '%', '4,36', '3,46', '79,36', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 85, 'dayasaing', 6, 'Persentase pertumbuhan PDRB Perdagangan Besar dan Eceran; Reparasi Mobil dan Sepeda Motor', '%', '6,93', '6,07', '5,59', '4,14', '3,46', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 7, 'Indeks Inovasi Daerah', 'Angka', 
        '94,23', '86,65', '91,96', 
        '60,05', '73,17', '87,11', '94,13', '86,65', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 86, 'dayasaing', 7, 'Indeks Inovasi Daerah', 'Angka', '94,23', '86,65', '91,96', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 86, 'dayasaing', 7, 'Indeks Inovasi Daerah', 'Angka', '60,05', '73,17', '87,11', '94,13', '86,65', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 8, 'Akses Rumah Tangga Perkotaan terhadap Air Siap Minum Perpipaan', '%', 
        '31,24', '19,62', '62,80', 
        NULL, NULL, NULL, '26,99', '19,62', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 87, 'dayasaing', 8, 'Akses Rumah Tangga Perkotaan terhadap Air Siap Minum Perpipaan', '%', '31,24', '19,62', '62,80', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 87, 'dayasaing', 8, 'Akses Rumah Tangga Perkotaan terhadap Air Siap Minum Perpipaan', '%', NULL, NULL, NULL, '26,99', '19,62', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 9, 'Rumah Tangga dengan Akses Sanitasi Aman', '%', 
        '3,25', '0,0', '0,00', 
        NULL, NULL, NULL, NULL, '0,0', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 88, 'dayasaing', 9, 'Rumah Tangga dengan Akses Sanitasi Aman', '%', '3,25', '0,0', '0,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 88, 'dayasaing', 9, 'Rumah Tangga dengan Akses Sanitasi Aman', '%', NULL, NULL, NULL, NULL, '0,0', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 10, 'Rasio PDRB Industri Pengolahan', '%', 
        '20,49', '21,86', '106,69', 
        '19,53', '20,21', '20,58', '20,97', '21,86', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 89, 'dayasaing', 10, 'Rasio PDRB Industri Pengolahan', '%', '20,49', '21,86', '106,69', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 89, 'dayasaing', 10, 'Rasio PDRB Industri Pengolahan', '%', '19,53', '20,21', '20,58', '20,97', '21,86', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 11, 'Rasio PDRB Penyediaan Akomodasi Makan dan Minum', '%', 
        '1,77', '1,87', '105,65', 
        '1,78', '1,85', '1,8', '1,84', '1,87', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 90, 'dayasaing', 11, 'Rasio PDRB Penyediaan Akomodasi Makan dan Minum', '%', '1,77', '1,87', '105,65', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 90, 'dayasaing', 11, 'Rasio PDRB Penyediaan Akomodasi Makan dan Minum', '%', '1,78', '1,85', '1,8', '1,84', '1,87', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 12, 'Pembentukan Modal Tetap Bruto', '% PDRB', 
        '22,51', '21,99', '97,69', 
        '22,28', '22,77', '22,48', '22,09', '21,99', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 91, 'dayasaing', 12, 'Pembentukan Modal Tetap Bruto', '% PDRB', '22,51', '21,99', '97,69', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 91, 'dayasaing', 12, 'Pembentukan Modal Tetap Bruto', '% PDRB', '22,28', '22,77', '22,48', '22,09', '21,99', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 13, 'Produk Domestik Regional Bruto per Kapita', 'Rp Juta', 
        '38,88', '41,70', '107,25', 
        '30,77', '33,37', '36,19', '39,18', '41,7', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 92, 'dayasaing', 13, 'Produk Domestik Regional Bruto per Kapita', 'Rp Juta', '38,88', '41,70', '107,25', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 92, 'dayasaing', 13, 'Produk Domestik Regional Bruto per Kapita', 'Rp Juta', '30,77', '33,37', '36,19', '39,18', '41,7', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 14, 'Kontribusi PDRB Kabupaten/Kota terhadap Provinsi', '%', 
        '0,85', '0,85', '100,00', 
        '0,86', '0,85', '0,85', '0,85', '0,85', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 93, 'dayasaing', 14, 'Kontribusi PDRB Kabupaten/Kota terhadap Provinsi', '%', '0,85', '0,85', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 93, 'dayasaing', 14, 'Kontribusi PDRB Kabupaten/Kota terhadap Provinsi', '%', '0,86', '0,85', '0,85', '0,85', '0,85', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 15, 'Tingkat Partisipasi Angkatan Kerja', '%', 
        '78,04', '78,51', '100,60', 
        '71,63', '72,15', '75,28', '76,66', '78,51', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 94, 'dayasaing', 15, 'Tingkat Partisipasi Angkatan Kerja', '%', '78,04', '78,51', '100,60', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 94, 'dayasaing', 15, 'Tingkat Partisipasi Angkatan Kerja', '%', '71,63', '72,15', '75,28', '76,66', '78,51', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 16, 'Tingkat Partisipasi Angkatan Kerja Perempuan', '%', 
        '65,19', '68,47', '105,03', 
        '58,22', '57,87', '63,84', '64,13', '68,47', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 95, 'dayasaing', 16, 'Tingkat Partisipasi Angkatan Kerja Perempuan', '%', '65,19', '68,47', '105,03', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 95, 'dayasaing', 16, 'Tingkat Partisipasi Angkatan Kerja Perempuan', '%', '58,22', '57,87', '63,84', '64,13', '68,47', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 17, 'Realisasi Investasi (Miliar)', 'Rp', 
        '425', '1040,9', '244,92', 
        '49,92', '187,81', '423,46', '590', '1040,9', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 96, 'dayasaing', 17, 'Realisasi Investasi (Miliar)', 'Rp', '425', '1040,9', '244,92', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 96, 'dayasaing', 17, 'Realisasi Investasi (Miliar)', 'Rp', '49,92', '187,81', '423,46', '590', '1040,9', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 18, 'Indeks Kapasitas Fiskal Daerah', 'Indeks', 
        '1,237', '0,052', '4,20', 
        '0,937', '1,439', '1,323', '1,403', '0,052', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 97, 'dayasaing', 18, 'Indeks Kapasitas Fiskal Daerah', 'Indeks', '1,237', '0,052', '4,20', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 97, 'dayasaing', 18, 'Indeks Kapasitas Fiskal Daerah', 'Indeks', '0,937', '1,439', '1,323', '1,403', '0,052', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 19, 'Jumlah Desa Mandiri', 'Desa', 
        '72', '84', '116,67', 
        '6', '16', '35', '62', '84', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 98, 'dayasaing', 19, 'Jumlah Desa Mandiri', 'Desa', '72', '84', '116,67', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 98, 'dayasaing', 19, 'Jumlah Desa Mandiri', 'Desa', '6', '16', '35', '62', '84', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 20, 'Persentase Desa Mandiri', '%', 
        '54,55', '54,55', '116,59', 
        '4,54', '12,12', '26,52', '46,97', '63,6', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 99, 'dayasaing', 20, 'Persentase Desa Mandiri', '%', '54,55', '54,55', '116,59', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 99, 'dayasaing', 20, 'Persentase Desa Mandiri', '%', '4,54', '12,12', '26,52', '46,97', '63,6', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 21, 'Jumlah Desa Inklusi', 'Desa', 
        '13', '9', '69,23', 
        NULL, NULL, NULL, '10', '9', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 100, 'dayasaing', 21, 'Jumlah Desa Inklusi', 'Desa', '13', '9', '69,23', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 100, 'dayasaing', 21, 'Jumlah Desa Inklusi', 'Desa', NULL, NULL, NULL, '10', '9', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 22, 'ICOR', 'Rasio', 
        '4,84', 'Belum Rilis', '-', 
        '7,24', '5,48', '4,98', '4,98', NULL, 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 101, 'dayasaing', 22, 'ICOR', 'Rasio', '4,84', 'Belum Rilis', '-', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 101, 'dayasaing', 22, 'ICOR', 'Rasio', '7,24', '5,48', '4,98', '4,98', NULL, NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 23, 'Pengeluaran Perkapita (Ribu)', 'Rp', 
        '11.58', '11.713', '11.713', 
        '9.996', '10.263', '10.702', '11.216', '11.713', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 102, 'dayasaing', 23, 'Pengeluaran Perkapita (Ribu)', 'Rp', '11.58', '11.713', '11.713', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 102, 'dayasaing', 23, 'Pengeluaran Perkapita (Ribu)', 'Rp', '9.996', '10.263', '10.702', '11.216', '11.713', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 24, 'Indeks Desa', '%', 
        '79', '80,8', '102,28', 
        NULL, NULL, NULL, '62', '80,8', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 103, 'dayasaing', 24, 'Indeks Desa', '%', '79', '80,8', '102,28', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 103, 'dayasaing', 24, 'Indeks Desa', '%', NULL, NULL, NULL, '62', '80,8', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 25, 'Rumah Tangga dengan Akses Hunian Layak, Terjangkau dan Berkelanjutan', '%', 
        '53,8', '52,8', '98,14', 
        '49,29', '45,1', '49,77', '52,94', '52,8', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 104, 'dayasaing', 25, 'Rumah Tangga dengan Akses Hunian Layak, Terjangkau dan Berkelanjutan', '%', '53,8', '52,8', '98,14', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 104, 'dayasaing', 25, 'Rumah Tangga dengan Akses Hunian Layak, Terjangkau dan Berkelanjutan', '%', '49,29', '45,1', '49,77', '52,94', '52,8', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 26, 'Indeks Akses Keuangan daerah (IKAD)', 'Indeks', 
        '3,94', 'Belum Rilis', '-', 
        NULL, NULL, NULL, NULL, NULL, 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 105, 'dayasaing', 26, 'Indeks Akses Keuangan daerah (IKAD)', 'Indeks', '3,94', 'Belum Rilis', '-', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 105, 'dayasaing', 26, 'Indeks Akses Keuangan daerah (IKAD)', 'Indeks', NULL, NULL, NULL, NULL, NULL, NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'dayasaing', 27, 'Indeks Zakat Nasional', 'Indeks', 
        '0,38', '0,34', '89,47', 
        NULL, NULL, NULL, '0,34', '0,34', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 106, 'dayasaing', 27, 'Indeks Zakat Nasional', 'Indeks', '0,38', '0,34', '89,47', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 106, 'dayasaing', 27, 'Indeks Zakat Nasional', 'Indeks', NULL, NULL, NULL, '0,34', '0,34', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 1, 'Indeks Ketahanan Pangan (IKP)', 'Indeks', 
        '81,02', '71,67', '88,46', 
        '77,58', '76,31', '76,64', '80,22', '71,67', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 107, 'geografi', 1, 'Indeks Ketahanan Pangan (IKP)', 'Indeks', '81,02', '71,67', '88,46', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 107, 'geografi', 1, 'Indeks Ketahanan Pangan (IKP)', 'Indeks', '77,58', '76,31', '76,64', '80,22', '71,67', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 2, 'Indeks Risiko Bencana', 'Indeks', 
        '149,12', '138,43', '107,17', 
        NULL, '151,22', '151,22', '151,65', '138,43', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 108, 'geografi', 2, 'Indeks Risiko Bencana', 'Indeks', '149,12', '138,43', '107,17', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 108, 'geografi', 2, 'Indeks Risiko Bencana', 'Indeks', NULL, '151,22', '151,22', '151,65', '138,43', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 3, 'Indeks Kualitas Lingkungan Hidup Daerah', 'Indeks', 
        '77,52', '75,10', '96,88', 
        '74,49', '73,02', '75,4', '69,53', '75,11', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 109, 'geografi', 3, 'Indeks Kualitas Lingkungan Hidup Daerah', 'Indeks', '77,52', '75,10', '96,88', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 109, 'geografi', 3, 'Indeks Kualitas Lingkungan Hidup Daerah', 'Indeks', '74,49', '73,02', '75,4', '69,53', '75,11', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 4, 'Indeks Kualitas Tutupan Lahan', 'Indeks', 
        '72,47', '71,46', '98,61', 
        '68,75', '61,49', '64,17', '64,42', '71,46', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 110, 'geografi', 4, 'Indeks Kualitas Tutupan Lahan', 'Indeks', '72,47', '71,46', '98,61', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 110, 'geografi', 4, 'Indeks Kualitas Tutupan Lahan', 'Indeks', '68,75', '61,49', '64,17', '64,42', '71,46', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 5, 'Penurunan emisi GRK kumulatif', 'TON CO2 EQ', 
        '24.738,28', '59.89', '242,09', 
        '3.395,08', '5.890,99', '19.477,04', '23.308,04', '59.890,00', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 111, 'geografi', 5, 'Penurunan emisi GRK kumulatif', 'TON CO2 EQ', '24.738,28', '59.89', '242,09', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 111, 'geografi', 5, 'Penurunan emisi GRK kumulatif', 'TON CO2 EQ', '3.395,08', '5.890,99', '19.477,04', '23.308,04', '59.890,00', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 6, 'Luas lahan kritis', 'Ha', 
        '10274', '10,274,076', '100,00', 
        NULL, NULL, NULL, NULL, '10274', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 112, 'geografi', 6, 'Luas lahan kritis', 'Ha', '10274', '10,274,076', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 112, 'geografi', 6, 'Luas lahan kritis', 'Ha', NULL, NULL, NULL, NULL, '10274', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 7, 'Prevalensi Ketidakcukupan Konsumsi Pangan (Prevalence of Undernourishment)', '%', 
        '13,26', '17,22', '129,86', 
        '15,67', '19,65', '13,33', '17,35', '17,22', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 113, 'geografi', 7, 'Prevalensi Ketidakcukupan Konsumsi Pangan (Prevalence of Undernourishment)', '%', '13,26', '17,22', '129,86', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 113, 'geografi', 7, 'Prevalensi Ketidakcukupan Konsumsi Pangan (Prevalence of Undernourishment)', '%', '15,67', '19,65', '13,33', '17,35', '17,22', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 8, 'Indeks Kualitas Udara', 'Indeks', 
        '81,21', '79,26', '97.6', 
        '85,75', '87,73', '89,7', '86,61', '79,26', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 114, 'geografi', 8, 'Indeks Kualitas Udara', 'Indeks', '81,21', '79,26', '97.6', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 114, 'geografi', 8, 'Indeks Kualitas Udara', 'Indeks', '85,75', '87,73', '89,7', '86,61', '79,26', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 9, 'Timbulan Sampah Terolah di Fasilitas Pengolahan Sampah', '%', 
        '11,09', '10,8', '97,39', 
        '17', '17,02', '10', '9,77', '10,8', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 115, 'geografi', 9, 'Timbulan Sampah Terolah di Fasilitas Pengolahan Sampah', '%', '11,09', '10,8', '97,39', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 115, 'geografi', 9, 'Timbulan Sampah Terolah di Fasilitas Pengolahan Sampah', '%', '17', '17,02', '10', '9,77', '10,8', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 10, 'Proporsi Rumah Tangga (RT) Dengan Layanan Penuh Pengumpulan Sampah', '%', 
        '61,45', '57,8', '94,06', 
        '61,12', '61,1', '62,27', '61,25', '57,8', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 116, 'geografi', 10, 'Proporsi Rumah Tangga (RT) Dengan Layanan Penuh Pengumpulan Sampah', '%', '61,45', '57,8', '94,06', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 116, 'geografi', 10, 'Proporsi Rumah Tangga (RT) Dengan Layanan Penuh Pengumpulan Sampah', '%', '61,12', '61,1', '62,27', '61,25', '57,8', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 11, 'Indeks Ketahanan Daerah', 'Angka', 
        '0,7', '0,71', '101,43', 
        '0,71', '0,72', '0,73', '0,69', '0,71', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 117, 'geografi', 11, 'Indeks Ketahanan Daerah', 'Angka', '0,7', '0,71', '101,43', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 117, 'geografi', 11, 'Indeks Ketahanan Daerah', 'Angka', '0,71', '0,72', '0,73', '0,69', '0,71', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'geografi', 12, 'Indeks Kualitas Air', 'Indeks', 
        '76,49', '72,8', '95,18', 
        '65,71', '64,29', '66,55', '54,12', '72,8', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 118, 'geografi', 12, 'Indeks Kualitas Air', 'Indeks', '76,49', '72,8', '95,18', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 118, 'geografi', 12, 'Indeks Kualitas Air', 'Indeks', '65,71', '64,29', '66,55', '54,12', '72,8', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 1, 'Indeks PPP (Purchasing Power Parity)', 'Indeks', 
        '0,78', '0,75', '96,15', 
        '0,700', '0,710', '0,720', '0,740', '0,750', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 119, 'kesejahteraan', 1, 'Indeks PPP (Purchasing Power Parity)', 'Indeks', '0,78', '0,75', '96,15', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 119, 'kesejahteraan', 1, 'Indeks PPP (Purchasing Power Parity)', 'Indeks', '0,700', '0,710', '0,720', '0,740', '0,750', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 2, 'Indeks Pembangunan Gender (IPG)', 'Indeks', 
        '87,87', '87,73', '99,84', 
        '87,16', '87,32', '87.59', '87,73', '87,73', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 120, 'kesejahteraan', 2, 'Indeks Pembangunan Gender (IPG)', 'Indeks', '87,87', '87,73', '99,84', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 120, 'kesejahteraan', 2, 'Indeks Pembangunan Gender (IPG)', 'Indeks', '87,16', '87,32', '87.59', '87,73', '87,73', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 3, 'Tingkat Pengangguran Terbuka', '%', 
        '3,01', '3,02', '99,67', 
        '3,68', '3,38', '3,27', '3,15', '3,02', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 121, 'kesejahteraan', 3, 'Tingkat Pengangguran Terbuka', '%', '3,01', '3,02', '99,67', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 121, 'kesejahteraan', 3, 'Tingkat Pengangguran Terbuka', '%', '3,68', '3,38', '3,27', '3,15', '3,02', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 4, 'Indeks Solidaritas Sosial', 'Indeks', 
        '81,59', '81,02', '99,30', 
        '72,90', '77,52', '78,37', '80,20', '81,02', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 122, 'kesejahteraan', 4, 'Indeks Solidaritas Sosial', 'Indeks', '81,59', '81,02', '99,30', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 122, 'kesejahteraan', 4, 'Indeks Solidaritas Sosial', 'Indeks', '72,90', '77,52', '78,37', '80,20', '81,02', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 5, 'Indeks Pendidikan', 'Indeks', 
        '0,604', '0,601', '99,50', 
        '0,586', '0,587', '0,596', '0,598', '0,601', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 123, 'kesejahteraan', 5, 'Indeks Pendidikan', 'Indeks', '0,604', '0,601', '99,50', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 123, 'kesejahteraan', 5, 'Indeks Pendidikan', 'Indeks', '0,586', '0,587', '0,596', '0,598', '0,601', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 6, 'Indeks Toleransi', 'Indeks', 
        '85,41', '84,2', '98,58', 
        '72,80', '81,80', '81,28', '84,01', '84,21', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 124, 'kesejahteraan', 6, 'Indeks Toleransi', 'Indeks', '85,41', '84,2', '98,58', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 124, 'kesejahteraan', 6, 'Indeks Toleransi', 'Indeks', '72,80', '81,80', '81,28', '84,01', '84,21', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 7, 'Indeks Stabilitas', 'Indeks', 
        '85,37', '84,1', '98,51', 
        '57,20', '76,28', '76,65', '83,97', '84,10', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 125, 'kesejahteraan', 7, 'Indeks Stabilitas', 'Indeks', '85,37', '84,1', '98,51', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 125, 'kesejahteraan', 7, 'Indeks Stabilitas', 'Indeks', '57,20', '76,28', '76,65', '83,97', '84,10', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 8, 'Indeks kesehatan', 'Indeks', 
        '0,822', '0,824', '100,24', 
        '0,757', '0,763', '0,819', '0,821', '0,824', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 126, 'kesejahteraan', 8, 'Indeks kesehatan', 'Indeks', '0,822', '0,824', '100,24', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 126, 'kesejahteraan', 8, 'Indeks kesehatan', 'Indeks', '0,757', '0,763', '0,819', '0,821', '0,824', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 9, 'Rata-Rata Lama Sekolah', 'Tahun', 
        '7,36', '7,03', '95,52', 
        '6,62', '6,63', '6,90', '6,93', '7,03', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 127, 'kesejahteraan', 9, 'Rata-Rata Lama Sekolah', 'Tahun', '7,36', '7,03', '95,52', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 127, 'kesejahteraan', 9, 'Rata-Rata Lama Sekolah', 'Tahun', '6,62', '6,63', '6,90', '6,93', '7,03', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 10, 'Indeks Ketimpangan Gender (IKG)', 'Indeks', 
        '0,4', '0,421', '105,25', 
        '0,47', '0,47', '0,41', '0,46', '0,42', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 128, 'kesejahteraan', 10, 'Indeks Ketimpangan Gender (IKG)', 'Indeks', '0,4', '0,421', '105,25', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 128, 'kesejahteraan', 10, 'Indeks Ketimpangan Gender (IKG)', 'Indeks', '0,47', '0,47', '0,41', '0,46', '0,42', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 11, 'Harapan Lama Sekolah', 'Tahun', 
        '13,21', '13,21', '100,00', 
        '13,16', '13,18', '13,19', '13,20', '13,21', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 129, 'kesejahteraan', 11, 'Harapan Lama Sekolah', 'Tahun', '13,21', '13,21', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 129, 'kesejahteraan', 11, 'Harapan Lama Sekolah', 'Tahun', '13,16', '13,18', '13,19', '13,20', '13,21', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 12, 'Angka Kematian Ibu (AKI)', 'Per 100.000 kelahiran hidup', 
        '49,34', '110,84', '-24,65', 
        NULL, NULL, NULL, '29,94', '24,65', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 130, 'kesejahteraan', 12, 'Angka Kematian Ibu (AKI)', 'Per 100.000 kelahiran hidup', '49,34', '110,84', '-24,65', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 130, 'kesejahteraan', 12, 'Angka Kematian Ibu (AKI)', 'Per 100.000 kelahiran hidup', NULL, NULL, NULL, '29,94', '24,65', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 13, 'Angka keberhasilan pengobatan tuberkulosis (treatment success rate)', '%', 
        '90', '90,59', '100,66', 
        '91,99', '93,5', '71,6', '65,09', '90,59', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 131, 'kesejahteraan', 13, 'Angka keberhasilan pengobatan tuberkulosis (treatment success rate)', '%', '90', '90,59', '100,66', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 131, 'kesejahteraan', 13, 'Angka keberhasilan pengobatan tuberkulosis (treatment success rate)', '%', '91,99', '93,5', '71,6', '65,09', '90,59', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 14, 'Prosentase Penemuan dan Pengobatan Kasus Tuberkulosis (Treatment Coverage)', '%', 
        '90', '85,6', '95,11', 
        '69,18', '73,46', '79,35', '88', '85,6', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 132, 'kesejahteraan', 14, 'Prosentase Penemuan dan Pengobatan Kasus Tuberkulosis (Treatment Coverage)', '%', '90', '85,6', '95,11', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 132, 'kesejahteraan', 14, 'Prosentase Penemuan dan Pengobatan Kasus Tuberkulosis (Treatment Coverage)', '%', '69,18', '73,46', '79,35', '88', '85,6', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 15, 'Cakupan Kepesertaan Jaminan Sosial Ketenagakerjaan', '%', 
        '16,73', '13,68', '81,77', 
        NULL, NULL, NULL, '10,98', '13,68', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 133, 'kesejahteraan', 15, 'Cakupan Kepesertaan Jaminan Sosial Ketenagakerjaan', '%', '16,73', '13,68', '81,77', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 133, 'kesejahteraan', 15, 'Cakupan Kepesertaan Jaminan Sosial Ketenagakerjaan', '%', NULL, NULL, NULL, '10,98', '13,68', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 16, 'Usia Harapan Hidup (UHH)', 'Tahun', 
        '73,54', '73,54', '100,00', 
        '72,72', '72,99', '73,22', '73,36', '73,54', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 134, 'kesejahteraan', 16, 'Usia Harapan Hidup (UHH)', 'Tahun', '73,54', '73,54', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 134, 'kesejahteraan', 16, 'Usia Harapan Hidup (UHH)', 'Tahun', '72,72', '72,99', '73,22', '73,36', '73,54', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 17, 'Prevalensi Stunting (pendek dan sangat pendek)', '%', 
        '9,8', '6,07', '138,06', 
        '23,7', '30,9', '4,1', '5,9', '6,07', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 135, 'kesejahteraan', 17, 'Prevalensi Stunting (pendek dan sangat pendek)', '%', '9,8', '6,07', '138,06', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 135, 'kesejahteraan', 17, 'Prevalensi Stunting (pendek dan sangat pendek)', '%', '23,7', '30,9', '4,1', '5,9', '6,07', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 18, 'Proporsi Penduduk Berusia 15 Tahun ke Atas yang Berkualifikasi Pendidikan Tinggi', '%', 
        '8,21', '9,2', '112,06', 
        '2,72', '2,73', '2,80', '2,83', '9,20', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 136, 'kesejahteraan', 18, 'Proporsi Penduduk Berusia 15 Tahun ke Atas yang Berkualifikasi Pendidikan Tinggi', '%', '8,21', '9,2', '112,06', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 136, 'kesejahteraan', 18, 'Proporsi Penduduk Berusia 15 Tahun ke Atas yang Berkualifikasi Pendidikan Tinggi', '%', '2,72', '2,73', '2,80', '2,83', '9,20', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 19, 'Angka Kematian Bayi (AKB) per 1.000 kelahiran hidup', 'Orang', 
        '15', '10,30', '131,33', 
        NULL, NULL, NULL, '2,59', '10,3', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 137, 'kesejahteraan', 19, 'Angka Kematian Bayi (AKB) per 1.000 kelahiran hidup', 'Orang', '15', '10,30', '131,33', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 137, 'kesejahteraan', 19, 'Angka Kematian Bayi (AKB) per 1.000 kelahiran hidup', 'Orang', NULL, NULL, NULL, '2,59', '10,3', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 20, 'Persentase Penurunan PPKS', '%', 
        '1,26', '0,86', '68,25', 
        NULL, NULL, NULL, NULL, '0,86', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 138, 'kesejahteraan', 20, 'Persentase Penurunan PPKS', '%', '1,26', '0,86', '68,25', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 138, 'kesejahteraan', 20, 'Persentase Penurunan PPKS', '%', NULL, NULL, NULL, NULL, '0,86', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 21, 'Persentase Pertumbuhan Usaha Mikro', '%', 
        '0,5', '4,29', '858,00', 
        NULL, '5,26', '0,24', '0,53', '4,29', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 139, 'kesejahteraan', 21, 'Persentase Pertumbuhan Usaha Mikro', '%', '0,5', '4,29', '858,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 139, 'kesejahteraan', 21, 'Persentase Pertumbuhan Usaha Mikro', '%', NULL, '5,26', '0,24', '0,53', '4,29', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 22, 'Prosentase UHC', '%', 
        '98', '99', '101,02', 
        NULL, NULL, NULL, '95,70', '99,00', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 140, 'kesejahteraan', 22, 'Prosentase UHC', '%', '98', '99', '101,02', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 140, 'kesejahteraan', 22, 'Prosentase UHC', '%', NULL, NULL, NULL, '95,70', '99,00', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 23, 'Indeks Lansia Berdaya', '%', 
        '59,3', '67', '112,98', 
        NULL, NULL, NULL, '59,1', '67', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 141, 'kesejahteraan', 23, 'Indeks Lansia Berdaya', '%', '59,3', '67', '112,98', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 141, 'kesejahteraan', 23, 'Indeks Lansia Berdaya', '%', NULL, NULL, NULL, '59,1', '67', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 24, 'Indeks Pengasuhan Keluarga Memiliki Remaja', '%', 
        '82,3', '78,3', '95,14', 
        NULL, NULL, NULL, NULL, '78,3', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 142, 'kesejahteraan', 24, 'Indeks Pengasuhan Keluarga Memiliki Remaja', '%', '82,3', '78,3', '95,14', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 142, 'kesejahteraan', 24, 'Indeks Pengasuhan Keluarga Memiliki Remaja', '%', NULL, NULL, NULL, NULL, '78,3', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'kesejahteraan', 25, 'Indeks Kesejahteraan Sosial', '%', 
        '61,48', '58,22', '94,70', 
        NULL, NULL, NULL, NULL, '58,22', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 143, 'kesejahteraan', 25, 'Indeks Kesejahteraan Sosial', '%', '61,48', '58,22', '94,70', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 143, 'kesejahteraan', 25, 'Indeks Kesejahteraan Sosial', '%', NULL, NULL, NULL, NULL, '58,22', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 1, 'Nilai Sakip', 'Nilai', 
        '82,05', '80,47', '98,07', 
        '82,49', '81,41', '81,59', '81,65', '80,47', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 144, 'pelayanan', 1, 'Nilai Sakip', 'Nilai', '82,05', '80,47', '98,07', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 144, 'pelayanan', 1, 'Nilai Sakip', 'Nilai', '82,49', '81,41', '81,59', '81,65', '80,47', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 2, 'Indeks SPBE', 'Indeks', 
        '4,26', '4,33', '101,64', 
        '2,43', '3,19', '4,17', '4,21', '4,33', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 145, 'pelayanan', 2, 'Indeks SPBE', 'Indeks', '4,26', '4,33', '101,64', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 145, 'pelayanan', 2, 'Indeks SPBE', 'Indeks', '2,43', '3,19', '4,17', '4,21', '4,33', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 3, 'Opini BPK Atas Laporan Keuangan', 'Nilai', 
        'WTP', 'WTP', '100,00', 
        'WTP', 'WTP', 'WTP', 'WTP', 'WTP', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 146, 'pelayanan', 3, 'Opini BPK Atas Laporan Keuangan', 'Nilai', 'WTP', 'WTP', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 146, 'pelayanan', 3, 'Opini BPK Atas Laporan Keuangan', 'Nilai', 'WTP', 'WTP', 'WTP', 'WTP', 'WTP', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 4, 'Indeks Kepuasan Masyarakat (IKM)', 'Indeks', 
        '87,38', '88,77', '101,59', 
        '80,62', '82,71', '82,75', '86,52', '88,77', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 147, 'pelayanan', 4, 'Indeks Kepuasan Masyarakat (IKM)', 'Indeks', '87,38', '88,77', '101,59', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 147, 'pelayanan', 4, 'Indeks Kepuasan Masyarakat (IKM)', 'Indeks', '80,62', '82,71', '82,75', '86,52', '88,77', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 5, 'Indeks Profesionalitas ASN', 'Nilai', 
        '80,81', '82,14', '101,65', 
        NULL, NULL, NULL, NULL, '82,14', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 148, 'pelayanan', 5, 'Indeks Profesionalitas ASN', 'Nilai', '80,81', '82,14', '101,65', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 148, 'pelayanan', 5, 'Indeks Profesionalitas ASN', 'Nilai', NULL, NULL, NULL, NULL, '82,14', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 6, 'Indeks Pembangunan Statistik (IPS)', 'Poin', 
        '2,85', '2,85', '100,00', 
        NULL, NULL, '2,63', '2,63', '2,85', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 149, 'pelayanan', 6, 'Indeks Pembangunan Statistik (IPS)', 'Poin', '2,85', '2,85', '100,00', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 149, 'pelayanan', 6, 'Indeks Pembangunan Statistik (IPS)', 'Poin', NULL, NULL, '2,63', '2,63', '2,85', NOW(), NOW()
    );
INSERT INTO ikd (kodewilayah, IdSasaran, tahun_mulai, tahun_akhir, aspek, urutan, indikator_sasaran, satuan, target_2025, realisasi_2025, capaian_2025, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 0, 2021, 2026, 
        'pelayanan', 7, 'Indeks Pelayanan Publik', 'Indeks', 
        '3,52', '4,02', '114,20', 
        '3,25', '3,63', '3,18', '3,31', '4,02', 
        NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_capaian (kodewilayah, tahun, ikd_id, aspek, urutan, indikator_ikd, satuan, target, realisasi, capaian, created_at, updated_at) VALUES (
        '35.10', 2025, 150, 'pelayanan', 7, 'Indeks Pelayanan Publik', 'Indeks', '3,52', '4,02', '114,20', NOW(), NOW()
    );
INSERT INTO lkpj_bab3_ikd_perkembangan (kodewilayah, tahun, ikd_id, aspek, urutan, uraian_indikator, satuan, nilai_2021, nilai_2022, nilai_2023, nilai_2024, nilai_2025, created_at, updated_at) VALUES (
        '35.10', 2025, 150, 'pelayanan', 7, 'Indeks Pelayanan Publik', 'Indeks', '3,25', '3,63', '3,18', '3,31', '4,02', NOW(), NOW()
    );
