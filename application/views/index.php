<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>IPPD</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <!-- <link href="assets/signin/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet"> -->
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/signin/fonts/icomoon/style.css" rel="stylesheet">
  <!-- <link href="assets/signin/css/owl.carousel.min.css" rel="stylesheet"> -->

  <style>
     body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      color: black;
      background: url('assets/img/bglogin.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
    }
    .bglogin {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
	.card {
      background: rgb(255, 255, 255); /* Transparansi 20% */
      border-radius: 15px;
      backdrop-filter: blur(10px); /* Efek blur */
      border: 1px solid rgba(255, 255, 255, 0.2); /* Border transparan */
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      padding: 2rem;
      width: 100%;
      max-width: 400px;
      margin: 0 auto;
    }
    .form-control {
      border-radius: 25px;
      padding: 10px 20px;
      background: rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: black;
    }
    .form-control:focus {
      background: rgba(0, 0, 0, 0.2);
      border-color: rgba(0, 0, 0, 0.4);
      box-shadow: none;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .btn {
      border-radius: 25px;
      padding: 10px 20px;
      transition: all 0.3s ease;
      background: #ff4c4c;
      border: none;
      color: white;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(255, 76, 76, 0.4);
    }
    .input-group-text {
      background: rgba(0, 0, 0, 0.1);
      border: rgba(0, 0, 0, 0.2);
      color: black;
      border-radius: 25px 0 0 25px;
    }
    h3 {
      font-family: 'Poppins', sans-serif;
    }
    .header-text {
      text-align: center;
      margin-bottom: auto;
      margin-top: auto;
      font-size: 3rem;
      color: white;
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    .header-text  {
      color:rgb(0, 0, 0);
    }
    .image-container {
      width: 50%;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-20px);
      }
    }

    .image-container img {
      border-radius: 15px;
      width: 100%; /* Lebar gambar mengikuti container */
      height: auto; /* Tinggi disesuaikan secara proporsional */
      max-height: 500px; /* Maksimum tinggi gambar */
      object-fit: cover; /* Memastikan gambar menutupi area tanpa distorsi */
      animation: float 2s ease-in-out infinite;
    }
    /* Menyamakan tinggi gambar dengan card form login */
    .row {
      align-items: stretch; /* Memastikan kedua kolom memiliki tinggi yang sama */
    }
    .col-md-6 {
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>

<main id="main">
    <section id="login" class="bglogin">
      <div class="container" data-aos="fade-down">
        <div class="header-text">
          Better Solution For Your Governance
        </div>
		<br>
        <div class="row">
          <!-- Gambar Statis di Sebelah Kiri -->
          <div class="col-md-6 image-container">
            <img src="assets/img/hero-img.png" alt="Gambar Statis">
          </div>
          <!-- Form Login di Sebelah Kanan -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="mb-4 text-center ">
                  <h3 style="color:black;"><b>LOGIN</b></h3>
                </div>
                <div class="form-group first">
                  <label for="Username"><b>Username</b></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="Username" autocomplete="off">
                  </div>
                </div>
                <div class="form-group last">
                  <label for="Password"><b>Password</b></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="Password" autocomplete="off">
                  </div>
                </div>
                <button class="btn btn-block" id="Login"><b>Login</b></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

		
		<section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>VISI RPJPN 2025-2045</h2>
          <p style="font-size: 30px;"><b class="text-danger">Negara Nusantara Berdaulat, Maju, dan Berkelanjutan</b></p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box border border-primary" style="height: 200px;">
							<!-- <div class="icon"><i class="bx bxl-dribbble"></i></div> -->
							<h4 class="text-center text-danger"><b>Nusantara :</b></h4>
							<p class="text-center text-primary"><b>Negara Kepulauan Yang Memiliki Ketangguhan Politik, Ekonomi, Keamanan Nasional dan Budaya/Peradaban Bahari Sebagai Poros Maritim Dunia</b></p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box border border-primary" style="height: 200px;">
							<!-- <div class="icon"><i class="bx bx-file"></i></div> -->
							<h4 class="text-center text-danger"><b>Berdaulat :</b></a></h4>
              <p class="text-center text-primary"><b>Ketahanan, Kesatuan, Mandiri, Aman</b></p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box border border-primary" style="height: 200px;">
							<!-- <div class="icon"><i class="bx bx-tachometer"></i></div> -->
							<h4 class="text-center text-danger"><b>Maju :</b></h4>
              <p class="text-center text-primary"><b>Berdaya, Modern, Tangguh, Inovatif, Adil</b></p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box border border-primary" style="height: 200px;">
              <!-- <div class="icon"><i class="bx bx-layer"></i></div> -->
              <h4 class="text-center text-danger"><b>Berkelanjutan :</b></h4>
              <p class="text-center text-primary"><b>Lestari dan Seimbang Antara Pembangunan Ekonomi, Sosial, dan Lingkungan</b></p>
            </div>
          </div>

        </div>
      </div>
		</section><!-- End Services Section -->
		<section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3 class="text-center"><strong>MISI RPJPN 2025-2045</strong></h3>
              <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
              </p> -->
            </div>
            
            <div class="accordion-list">
              <ul class="border border-primary">
                <li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-1"><span>01</span> <b>Mewujudkan transformasi sosial</b></a>
                  <div id="accordion-list-1" class="collapse" data-bs-parent=".accordion-list">
										<p style="margin-left: 32px;" class="text-warning">T1. Kesehatan untuk semua</p>
										<p style="margin-left: 32px;" class="text-warning">T2. Pendidikan berkualitas yang merata</p>
										<p style="margin-left: 32px;" class="text-warning">T3. Perlindungan sosial yang adaptif</p>
                  </div>
								</li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-2"><span>02</span> <b>Mewujudkan transformasi ekonomi</b></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
										<p style="margin-left: 32px;" class="text-warning">T4. Iptek, inovasi dan produktivitas ekonomi</p>
										<p style="margin-left: 32px;" class="text-warning">T5. Penerapan ekonomi hijau</p>
										<p style="margin-left: 32px;" class="text-warning">T6. Transformasi digital</p>
										<p style="margin-left: 32px;" class="text-warning">T7. Integrasi ekonomi domestik dan global</p>
										<p style="margin-left: 32px;" class="text-warning">T8. Perkotaan dan perdesaan sebagai pusat pertumbuhan ekonomi</p>
                  </div>
								</li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-3"><span>03</span> <b>Mewujudkan transformasi tata kelola</b></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
										<p style="margin-left: 32px;" class="text-warning">T9. Regulasi dan tata kelola yang berintegritas dan adaptif</p>
                  </div>
								</li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-4"><span>04</span> <b>Memantapkan supremasi hukum, stabilitas dan kepemimpinan</b></a>
                  <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
										<p style="margin-left: 32px;" class="text-warning">T10. Hukum berkeadilan, keamanan nasional tangguh dan demokrasi substansial</p>
										<p style="margin-left: 32px;" class="text-warning">T11. Stabilitas ekonomi makro</p>
										<p style="margin-left: 32px;" class="text-warning">T12. Ketangguhan diplomasi dan pertahanan berdaya gentar kawasan</p>
                  </div>
								</li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-5"><span>05</span> <b>Memantapkan ketahanan sosial budaya dan ekologi</b></a>
                  <div id="accordion-list-5" class="collapse" data-bs-parent=".accordion-list">
										<p style="margin-left: 32px;" class="text-warning">T13. Beragama maslahat dan berkebudayaan maju</p>
										<p style="margin-left: 32px;" class="text-warning">T14. Keluarga berkualitas, kesetaraan gender dan masyarakat inklusif</p>
										<p style="margin-left: 32px;" class="text-warning">T15. Lingkungan hidup berkualitas</p>
										<p style="margin-left: 32px;" class="text-warning">T16. Berketahanan energi, air dan kemandirian pangan</p>
										<p style="margin-left: 32px;" class="text-warning">T17. Resiliensi terhadap bencana dan perubahan iklim</p>
                  </div>
								</li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-6"><span>06</span> <b>Mewujudkan transformasi sosial</b></a>
                  <div id="accordion-list-6" class="collapse" data-bs-parent=".accordion-list">
										<!-- <p style="margin-left: 32px;" class="text-warning">T1</p> -->
                  </div>
                </li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-7"><span>07</span> <b>Mewujudkan transformasi sosial</b></a>
                  <div id="accordion-list-7" class="collapse" data-bs-parent=".accordion-list">
										<!-- <p style="margin-left: 32px;" class="text-warning">T1</p> -->
                  </div>
                </li>
								<li>
                  <a data-bs-toggle="collapse" class="collapse text-danger" data-bs-target="#accordion-list-8"><span>08</span> <b>Mewujudkan transformasi sosial</b></a>
                  <div id="accordion-list-8" class="collapse" data-bs-parent=".accordion-list">
										<!-- <p style="margin-left: 32px;" class="text-warning">T1</p> -->
                  </div>
                </li>
              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-7 order-lg-2 img" style='background-image: url("assets/img/skills.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section -->
	</main>
	
	<div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
	<!-- Template Main JS File -->
	<script src="assets/js/main.js"></script>
	<script>
    var BaseURL = '<?=base_url()?>'
    jQuery(document).ready(function($) {
      // Fungsi untuk melakukan login
      function performLogin() {
        var Login = { 
          Username: $("#Username").val(),
          Password: $("#Password").val() 
        };
        $.post(BaseURL + "Home/Login", Login).done(function(Respon) {
          if (Respon == '1') {
            if ($("#Username").val() == 'admin') {
              window.location = BaseURL + "Super/VMTS";	
            } else {
              window.location = BaseURL + "Admin/Visi";
            }
          } else {
            alert(Respon);
          }
        });
      }

      // Event listener untuk tombol "Login"
      $("#Login").click(function() {
        performLogin();
      });

      // Event listener untuk tombol "Enter" pada input field
      $("#Username, #Password").keypress(function(event) {
        if (event.which == 13) { // 13 adalah kode untuk tombol "Enter"
          performLogin();
        }
      });
    });

    $(window).on('hashchange', function() {
      setTimeout(function() {
        if (window.location.hash) {
          history.replaceState('', document.title, window.location.href.split('#')[0]);
        }
      }, 100);
    });
  </script>
</body>
</html>