<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Akun</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <style>
        /* Navbar Styles */
        .navbar {
            background-color:#20c997;
            padding: 1rem 2rem;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .navbar-item {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            padding: 0.5rem 0;
            position: relative;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .navbar-item:hover {
            color: white;
            text-decoration: none;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 20px 0px rgba(0,0,0,0.15);
            z-index: 1001;
            border-radius: 8px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 1px solid rgba(0,0,0,0.1);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            color: #4b5563;
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
            white-space: nowrap;
            position: relative;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #20c997;
        }

        /* Submenu Styles */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-item:after {
            content: "▸";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .dropdown-submenu .dropdown-submenu-content {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 20px 0px rgba(0,0,0,0.15);
            z-index: 1002;
            border-radius: 0 8px 8px 0;
            border: 1px solid rgba(0,0,0,0.1);
            border-left: none;
        }

        .dropdown-submenu:hover > .dropdown-submenu-content {
            display: block;
        }

        /* Logout Button */
        .logout-btn {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .dropdown-content {
                position: static;
                transform: none;
                width: 100%;
                display: none;
            }
            
            .dropdown-submenu .dropdown-submenu-content {
                position: static;
                border-radius: 0 0 8px 8px;
                border-left: 1px solid rgba(0,0,0,0.1);
                margin-left: 15px;
                box-shadow: none;
            }
            
            .dropdown.active .dropdown-content {
                display: block;
            }
            
            .dropdown-submenu.active > .dropdown-submenu-content {
                display: block;
            }
        }

        /* Remove click effects */
        .navbar-item:focus,
        .navbar-item:active,
        .dropdown-item:focus,
        .dropdown-item:active,
        .logout-btn:focus,
        .logout-btn:active {
            outline: none;
            box-shadow: none;
            background-color: transparent !important;
        }

        /* Ensure main content doesn't get overlapped */
        .main-content-wrapper {
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }

        /* Additional fix for dropdown arrow */
        .dropdown .navbar-item i.fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .dropdown:hover .navbar-item i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Original styles for the rest of the page */
        .stat-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-right: 1.5rem;
            opacity: 0.9;
        }
        
        .stat-card .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1;
        }
        
        .stat-card .stat-label {
            font-size: 1rem;
            opacity: 0.95;
            margin-top: 0.5rem;
        }
        
        /* User Account Card - Blue */
        .user-card {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
        }
        
        /* Institutional Account Card - Green */
        .institution-card {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }
        
        .calendar-header {
            grid-column: span 7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .calendar-day {
            padding: 0.5rem;
            text-align: center;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .calendar-day.empty {
            visibility: hidden;
        }
        
        .calendar-day.today {
            background-color: #3b82f6;
            color: white;
            font-weight: bold;
        }
        
        .calendar-weekday {
            font-weight: 600;
            color: #4b5563;
            text-align: center;
            padding-bottom: 0.5rem;
            font-size: 0.85rem;
        }
        
        .chart-container {
            height: 300px;
        }
        
        .info-card {
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
            border-top: 4px solid;
        }
        
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .user-info-card {
            background: white;
            border-top-color: #3b82f6;
        }
        
        .institution-info-card {
            background: white;
            border-top-color: #10b981;
        }
        
        .info-icon {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-info-icon {
            background-color: #3b82f620;
            color: #3b82f6;
        }
        
        .institution-info-icon {
            background-color: #10b98120;
            color: #10b981;
        }
        
        .feature-list {
            margin-top: 1rem;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .feature-item i {
            margin-right: 0.5rem;
            margin-top: 0.2rem;
        }
        
        .user-feature i {
            color: #3b82f6;
        }
        
        .institution-feature i {
            color: #10b981;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/ippd/Beranda" class="navbar-brand">
                <i class="fas fa-chart-line"></i>
                IPPD
            </a>
            <div class="navbar-menu">
                <!-- Menu Kementerian dengan Submenu -->
                <div class="dropdown">
                    <a href="#" class="navbar-item active">Kementerian <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <a href="<?=base_url('Super/Kementerian')?>" class="dropdown-item">Daftar Kementerian</a>
                        <a href="<?=base_url('Super/SPM')?>" class="dropdown-item">Standar Pelayanan Minimal</a>
                        <a href="<?=base_url('Super/ProgramStrategis')?>" class="dropdown-item">Program Strategis</a>
                        <a href="<?=base_url('Super/ProyekStrategis')?>" class="dropdown-item">Proyek Strategis</a>
                    </div>
                </div>
                
                <!-- Menu Nasional dengan Submenu -->
                <div class="dropdown">
                    <a href="#" class="navbar-item">Nasional <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                        <!-- RPJPN Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPN</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJPN')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJPN')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJPN')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJPN')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJPN')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJPN')?>" class="dropdown-item">IUP RPJPN</a>
                            </div>
                        </div>
                        
                        <!-- RPJMN Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMN</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJMN')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJMN')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJMN')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJMN')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJMN')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJMN')?>" class="dropdown-item">IUP RPJMN</a>
                            </div>
                        </div>
                        
                        <!-- RPJPD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJPD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJPD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJPD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJPD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJPD')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJPD')?>" class="dropdown-item">IUP RPJPD</a>
                            </div>
                        </div>
                        
                        <!-- RPJMD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Super/VisiRPJMD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Super/MisiRPJMD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Super/TujuanRPJMD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Super/SasaranRPJMD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Super/TahapanRPJMD')?>" class="dropdown-item">Tahapan</a>
                                <a href="<?=base_url('Super/IUPRPJMD')?>" class="dropdown-item">IUP RPJMD</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Menu Daerah -->
                <div class="dropdown">
                    <a href="#" class="navbar-item">Daerah <i class="fas fa-chevron-down ml-1" style="font-size: 0.75rem;"></i></a>
                    <div class="dropdown-content">
                         <!-- RPJPD Submenu -->
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJPD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/VisiRPJPD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Admin/MisiRPJPD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Admin/TujuanRPJPD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Admin/SasaranRPJPD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Admin/TahapanRPJPD')?>" class="dropdown-item">Tahapan</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">RPJMD</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/VisiRPJMD')?>" class="dropdown-item">Visi</a>
                                <a href="<?=base_url('Admin/MisiRPJMD')?>" class="dropdown-item">Misi</a>
                                <a href="<?=base_url('Admin/TujuanRPJMD')?>" class="dropdown-item">Tujuan</a>
                                <a href="<?=base_url('Admin/SasaranRPJMD')?>" class="dropdown-item">Sasaran</a>
                                <a href="<?=base_url('Admin/TahapanRPJMD')?>" class="dropdown-item">Tahapan</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Cascading</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/kelola_instansi')?>" class="dropdown-item">Daftar Instansi</a>
                                <a href="<?=base_url('Admin/Iku')?>" class="dropdown-item">IKU</a>
                                <a href="<?=base_url('Admin/Ikd')?>" class="dropdown-item">IKD</a>
                            </div>
                        </div>
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item">Isu Daerah</a>
                            <div class="dropdown-submenu-content">
                                <a href="<?=base_url('Admin/PermasalahanPokok')?>" class="dropdown-item">Permasalahan Pokok</a>
                                <a href="<?=base_url('Admin/IsuKLHS')?>" class="dropdown-item">Isu KLHS</a>
                                <a href="<?=base_url('Admin/IsuStrategisDaerah')?>" class="dropdown-item">Isu Strategis</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </div>
        </div>
    </nav>

    <!-- Rest of your body content remains the same -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="text-start mb-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                Beranda IPPD
            </h1>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- User Account Card -->
            <div class="stat-card user-card">
                <i class="fas fa-user-tie"></i>
                <div>
                    <div class="stat-value"><?php echo number_format($total_akun); ?></div>
                    <div class="stat-label">Akun Pengguna</div>
                </div>
            </div>
            
            <!-- Institutional Account Card -->
            <div class="stat-card institution-card">
                <i class="fas fa-building"></i>
                <div>
                    <div class="stat-value"><?php echo number_format($total_instansi); ?></div>
                    <div class="stat-label">Akun Instansi</div>
                </div>
            </div>
        </div>
        
        <!-- Chart and Calendar Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Bar Chart Container -->
            <div class="bg-white rounded-xl shadow-md p-6 lg:col-span-2">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chart-bar text-indigo-500 mr-3"></i>
                    Perbandingan Jumlah Akun
                </h2>
                <div class="chart-container">
                    <canvas id="accountChart"></canvas>
                </div>
            </div>
            
            <!-- Calendar Container -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="calendar-header">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="far fa-calendar-alt text-emerald-500 mr-3"></i>
                        Kalender
                    </h2>
                    <div class="flex space-x-2">
                        <button id="prev-month" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button id="next-month" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div id="calendar-display" class="mt-4"></div>
            </div>
        </div>
        
        <!-- Info Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Tentang Akun Pengguna -->
            <div class="info-card user-info-card">
                <div class="info-icon user-info-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Tentang Akun Pengguna</h2>
                <p class="text-gray-600 mb-4">
                    Akun pengguna merupakan akun individu yang dibuat untuk mengakses fitur sistem sebagai user atau admin.
                </p>
            </div>
            
            <!-- Tentang Akun Instansi -->
            <div class="info-card institution-info-card">
                <div class="info-icon institution-info-icon">
                    <i class="fas fa-university"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Tentang Akun Instansi</h2>
                <p class="text-gray-600 mb-4">
                    Akun instansi merupakan akun organisasi/perusahaan yang memiliki akses khusus untuk manajemen data institusi.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Bar Chart Configuration
        const ctx = document.getElementById('accountChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Akun Pengguna', 'Akun Instansi'],
                datasets: [{
                    label: 'Jumlah Akun',
                    data: [<?php echo $total_akun; ?>, <?php echo $total_instansi; ?>],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                    barPercentage: 0.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `Jumlah: ${context.raw.toLocaleString()}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(229, 231, 235, 0.5)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });

        // Calendar Functionality with Automatic Date
        let currentDate = new Date(); // This will automatically get the current date
        
        function renderCalendar(date) {
            const today = new Date(); // Current date for comparison
            const year = date.getFullYear();
            const month = date.getMonth();
            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            let calendarHTML = `
                <div class="text-center text-gray-600 mb-3">${monthNames[month]} ${year}</div>
                <div class="grid grid-cols-7 mb-2">
                    <div class="calendar-weekday">Min</div>
                    <div class="calendar-weekday">Sen</div>
                    <div class="calendar-weekday">Sel</div>
                    <div class="calendar-weekday">Rab</div>
                    <div class="calendar-weekday">Kam</div>
                    <div class="calendar-weekday">Jum</div>
                    <div class="calendar-weekday weekend">Sab</div>
                </div>
                <div class="grid grid-cols-7 gap-1">
            `;
            
            // Empty days before first day of month
            for (let i = 0; i < firstDay; i++) {
                calendarHTML += `<div class="calendar-day empty"></div>`;
            }
            
            // Days of month
            for (let day = 1; day <= daysInMonth; day++) {
                const currentDay = new Date(year, month, day);
                const isToday = currentDay.getDate() === today.getDate() && 
                               currentDay.getMonth() === today.getMonth() && 
                               currentDay.getFullYear() === today.getFullYear();
                const isWeekend = currentDay.getDay() === 0 || currentDay.getDay() === 6;
                
                let dayClass = 'calendar-day';
                if (isToday) dayClass += ' today';
                if (isWeekend) dayClass += ' weekend';
                
                calendarHTML += `<div class="${dayClass}">${day}</div>`;
            }
            
            calendarHTML += `</div>`;
            document.getElementById('calendar-display').innerHTML = calendarHTML;
        }
        
        // Initialize calendar with current date
        renderCalendar(currentDate);
        
        // Navigation buttons
        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        });
        
        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        });

        // Logout function
        function logout() {
            // Redirect to logout page or clear session
            window.location.href = '/ippd';
        }

        // Mobile menu handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle mobile menu clicks
            if (window.innerWidth <= 768) {
                document.addEventListener('click', function(e) {
                    // Close all dropdowns if clicking outside
                    if (!e.target.closest('.dropdown')) {
                        document.querySelectorAll('.dropdown-content, .dropdown-submenu-content').forEach(menu => {
                            menu.style.display = 'none';
                        });
                        document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(item => {
                            item.classList.remove('active');
                        });
                    }
                });

                // Toggle main dropdowns
                document.querySelectorAll('.navbar-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768 && this.nextElementSibling && 
                            this.nextElementSibling.classList.contains('dropdown-content')) {
                            e.preventDefault();
                            const dropdown = this.closest('.dropdown');
                            const content = dropdown.querySelector('.dropdown-content');
                            
                            // Close other dropdowns
                            document.querySelectorAll('.dropdown-content, .dropdown-submenu-content').forEach(menu => {
                                if (menu !== content) menu.style.display = 'none';
                            });
                            
                            // Toggle current dropdown
                            content.style.display = content.style.display === 'block' ? 'none' : 'block';
                            dropdown.classList.toggle('active');
                        }
                    });
                });

                // Toggle submenus
                document.querySelectorAll('.dropdown-submenu > .dropdown-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();
                            const submenu = this.nextElementSibling;
                            const isVisible = submenu.style.display === 'block';
                            
                            // Close all submenus first
                            document.querySelectorAll('.dropdown-submenu-content').forEach(sm => {
                                sm.style.display = 'none';
                            });
                            
                            // Toggle current submenu if it wasn't visible
                            if (!isVisible) {
                                submenu.style.display = 'block';
                                this.closest('.dropdown-submenu').classList.add('active');
                            }
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>