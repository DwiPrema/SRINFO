<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SRINFO</title>

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- boxicons -->
  <link rel="stylesheet" href="lib/boxicons/css/boxicons.min.css">

  <!-- css -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/keyframes.css">
  <link rel="stylesheet" href="css/switch-mode.css">
</head>

<body>
  <?php
  include "switch-mode.php";
  ?>
  <!-- header -->
  <div class="header">
    <div class="logo">
      <img src="assets/logo-ssri.png" alt="">
    </div>

    <div class="text-hero">
      <h1>Metaksu</h1>
      <p>Mandiri, Terampil, Kompeten, Santun, dan Unggul</p>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="hero">
    <div class="swiper hero-slider">
      <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide" style="background-image: url('assets/hero-img1.jpg');">
          <div class="overlay"></div>
          <div class="hero-content">
            <h1>Selamat Datang di SRINFO!</h1>
            <p>Sistem Informasi SMKN 1 Sukawati</p>
            <a href="#about" class="btn">Selengkapnya</a>
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide" style="background-image: url('assets/hero-img2.jpg');">
          <div class="overlay"></div>
          <div class="hero-content">
            <h1>Apa Saja Program Kami?</h1>
            <p>Satu akses mudah untuk semua program.</p>
            <a href="#program" class="btn">Lihat Program</a>
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide" style="background-image: url('assets/hero-img3.jpg');">
          <div class="overlay"></div>
          <div class="hero-content">
            <h1>Mulai Gunakan Sistem Digital</h1>
            <p>Tingkatkan efisiensi di sekolah dengan teknologi</p>
            <a href="#program" class="btn">Login</a>
          </div>
        </div>
        <!-- Slide 4 -->
        <div class="swiper-slide" style="background-image: url('assets/hero-img4.jpg');">
          <div class="overlay"></div>
          <div class="hero-content">
            <h1>SMKN 1 Sukawati</h1>
            <p>Sekolah berbasis seni dan teknologi</p>
            <a href="#footer" class="btn">Kontak Kami</a>
          </div>
        </div>

      </div>

      <!-- Navigation -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- section about -->
  <section class="about">
    <div class="row-about" id="about">
      <div class="gambar-row">
        <img src="assets/hero-img3.jpg" alt="">
      </div>

      <div class="text-about">
        <h1>Apa Itu SRINFO?</h1>
        <p>SRINFO (SSRI Information) adalah sebuah platform digital khusus yang dikembangkan untuk
          SMKN 1 Sukawati. Platform ini dirancang sebagai pusat informasi terintegrasi yang memudahkan siswa, guru, dan
          seluruh warga sekolah dalam mengakses berbagai program serta layanan sekolah.</p>
      </div>
    </div>

    <div class="row-about">
      <div class="text-about">
        <h1>Tujuan SRINFO</h1>
        <p>Melalui SRINFO, semua aktivitas
          penting—mulai dari absensi, jurnal mengajar, rekap SPP, hingga perpustakaan digital—dapat diakses dengan lebih
          cepat, praktis, dan efisien. Tujuannya adalah menciptakan ekosistem sekolah yang lebih modern, transparan,
          serta
          mendukung penerapan teknologi dalam kegiatan belajar mengajar di SMKN 1 Sukawati.</p>
      </div>

      <div class="gambar-tujuan">
        <img src="assets/hero-img3.jpg" alt="">
      </div>
    </div>

    <!-- section program -->
    <div class="program" id="program">
      <h1>Program Kami</h1>
      <div class="container">
        <div class="card">
          <i class='bx bx-calendar-check'></i>
          <h1>Absensi Digital</h1>
          <p>MPK (Majelis Perwakilan Kelas) bisa mengabsen teman-teman sekelasnya melalui platform digital ini.</p>
          <a href="#" class="btn-program">Masuk</a>
        </div>

        <div class="card">
          <i class='bx bx-notepad'></i>
          <h1>Jurnal Guru</h1>
          <p>Semua guru yang ada di SMKN 1 Sukawati bisa mengisi jurnal mengajar melalui platform digital ini.</p>
          <a href="guru/index.php" id="btn-jurnal" class="btn-program">Masuk</a>
        </div>

        <div class="card">
          <i class='bx bx-receipt'></i>
          <h1>Rekap Pembayaran SPP</h1>
          <p>Siswa atau orang tua siswa bisa melihat rekap pembayaran spp anaknya melalui platform ini.</p>
          <a href="#" class="btn-program">Masuk</a>
        </div>

      </div>
    </div>
  </section>

  <!-- section cta login -->
  <section class="CTA-login">
    <div class="vid-cta">
      <video src="assets/background-video.mp4" autoplay muted loop></video>
    </div>

    <div class="text-cta">
      <div class="text-row">
        <h1>Mari Gunakan Sistem Digital Sekarang!</h1>
        <p>Lebih Praktis, Efektif, dan Efisien</p>
        <a href="./admin/login.php">Login sebagai Admin</a>
      </div>
    </div>
  </section>

  <!-- footer -->
  <footer class="site-footer" id="footer">
    <div class="footer-top">

      <div class="footer-about">
        <div class="logo">
          <div class="logo-mark"><img src="assets/logo-ssri.png" alt="logo-ssi"></div>
          <div class="logo-text">
            <h1>SRINFO</h1>
            <p>SSRI Information</p>
          </div>
        </div>
        <p class="about-text">
          "Akses sistem informasi sekolah sesuai dengan kebutuhan Anda."
        </p>
      </div>


      <div class="footer-col social">

        <div class="programs">
          <h1>Program Kami</h1>
          <ul class="list">
            <li><i class='bx bx-calendar-check'></i> <a href="#">Absensi Digital</a></li>
            <li><i class='bx bx-notepad'></i> <a href="#">Jurnal Guru</a></li>
            <li><i class='bx bx-receipt'></i> <a href="#">Rekap Pembayaran SPP</a></li>
          </ul>
        </div>

        <div class="contact-us">
          <h1>Kontak Kami</h1>
          <ul class="list">
            <li><i class='bx bx-envelope'></i> <a href="#">support@srinfo.com</a>
            </li>
            <li><i class='bx bx-phone-call'></i> <a href="#">+62 812-3456-789</a></li>
            <li><i class='bx bx-map'></i> <a href="#"> Jl. SMKI, Br. Pengambangan, Batubulan, Sukawati, Gianyar, Bali.</a></li>
          </ul>
        </div>

        <div class="contact-us">
          <h1>Legal</h1>
          <ul class="list">
            <li><i class='bx bx-envelope'></i> <a href="#">Privacy Police</a>
            </li>
            <li><i class='bx bx-phone-call'></i> <a href="#">Terms Of Service</a>
            </li>
          </ul>
        </div>

      </div>

    </div>

    <div class="line"></div>

    <div class="footer-bottom">
      <p>© 2025 SRINFO - All rights reserved</p>

      <div class="socials">
        <a href="#" aria-label="Instagram"><i class='bx bxl-instagram'></i></a>
        <a href="#" aria-label="Youtube"><i class='bx bxl-youtube'></i></a>
      </div>
    </div>
  </footer>


  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- js -->
  <script src="js/script.js"></script>
  <script src="js/switchMode.js"></script>
</body>

</html>