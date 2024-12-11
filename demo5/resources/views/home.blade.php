<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RumahFinder - Platform Jasa Pencarian Rumah</title>
  <link rel="stylesheet" href="/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body>
  <!-- Wrapper untuk memastikan layout sticky footer -->
  <div class="wrapper">
    <!-- Header -->
    <header class="header">
      <div class="container">
        <a href="#" class="logo">
          <img src="{{ asset('Logo_Icon.png') }}"/>
        </a>

        <!-- Hamburger Menu Button -->
        <button class="hamburger-menu" aria-label="Toggle navigation">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="navbar">
          <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#features">Keunggulan</a></li>
            <li><a href="rumah.html">Layanan</a></li>
            <li><a href="#testimonials">Testimoni</a></li>
            <li><a href="#contact">Kontak</a></li>
            <!-- Periksa autentikasi -->
            @auth
        <li><a href="/dashboard">Dashboard</a></li>
      @else
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
  @endauth
          </ul>
        </nav>
      </div>
    </header>

    <main>
      <!-- Hero Section -->
      <section id="home" class="hero">
        <div class="hero-background" style="background-image: url('/rumah-bg.jpg')"></div>
        <div class="container">
          <h1>Temukan Rumah Impian Anda</h1>
          <p>
            Platform pencarian properti terpercaya dengan ribuan pilihan hunian
            di seluruh Indonesia.
          </p>
          <div class="hero-buttons">
            <a href="#contact" class="btn-primary">Cari Rumah Sekarang</a>
            <a href="#" class="btn-secondary">Lihat Video Panduan</a>
          </div>
        </div>
      </section>

      <!-- Features Section -->
      <section id="features" class="features">
        <div class="container">
          <h2>Kenapa Memilih RumahFinder?</h2>
          <div class="features-grid">
            <div class="feature-card">
              <i class="fas fa-search"></i>
              <h3>Pencarian Komprehensif</h3>
              <p>Layanan pencarian properti dengan filter detail dan akurat.</p>
            </div>
            <div class="feature-card">
              <i class="fas fa-shield-alt"></i>
              <h3>Keamanan Terjamin</h3>
              <p>Jaminan properti terverifikasi dengan dokumentasi lengkap.</p>
            </div>
            <div class="feature-card">
              <i class="fas fa-home"></i>
              <h3>Konsultasi Profesional</h3>
              <p>Tim ahli properti siap membantu setiap tahap pencarian.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Layanan Section -->
      <section id="rumahs" class="features">
        <div class="container">
          <h2>Layanan Kami</h2>
          <div class="features-grid">
            <div class="feature-card">
              <i class="fas fa-city"></i>
              <h3>Properti Baru</h3>
              <p>
                Akses eksklusif ke properti terbaru dari developer terpercaya.
              </p>
            </div>
            <div class="feature-card">
              <i class="fas fa-building"></i>
              <h3>Properti Bekas</h3>
              <p>
                Pilihan rumah second dengan kualitas dan harga terbaik.
              </p>
            </div>
            <div class="feature-card">
              <i class="fas fa-map-marked-alt"></i>
              <h3>Lokasi Premium</h3>
              <p>Properti di area strategis dan berkembang.</p>
            </div>
            <div class="feature-card">
              <i class="fas fa-file-contract"></i>
              <h3>Bantuan Hukum</h3>
              <p>
                Pendampingan dokumen dan proses jual-beli properti.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Testimoni Section -->
      <section id="testimonials" class="features">
        <div class="container">
          <h2>Testimoni Pelanggan</h2>
          <div class="features-grid">
            <div class="feature-card">
              <p><strong>Budi</strong> dari Jakarta</p>
              <p>
                "Proses pencarian rumah jadi sangat mudah dan transparan. Terima kasih RumahFinder!"
              </p>
            </div>
            <div class="feature-card">
              <p><strong>Ani</strong> dari Bandung</p>
              <p>
                "Tim RumahFinder sangat profesional dan membantu dalam setiap tahap transaksi."
              </p>
            </div>
            <div class="feature-card">
              <p><strong>Rudi</strong> dari Surabaya</p>
              <p>
                "Dapat rumah impian dengan harga yang sangat bersahabat. Recommended!"
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Kontak Section -->
      <section id="contact" class="features">
        <div class="container">
          <h2>Hubungi Kami</h2>
          <form class="contact-form">
            <div>
              <label for="name">Nama Lengkap</label>
              <input type="text" id="name" placeholder="Nama Anda" required />
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" id="email" placeholder="Email Anda" required />
            </div>
            <div>
              <label for="message">Pesan</label>
              <textarea id="message" rows="4" placeholder="Konsultasi Properti" required></textarea>
            </div>
            <button type="submit" class="btn-primary">Kirim Pesan</button>
          </form>
        </div>
      </section>
    </main>
  </div>
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-section about">
          <h4>Tentang RumahFinder</h4>
          <p>
            Platform pencarian properti terpercaya dengan layanan komprehensif dan profesional di seluruh Indonesia.
          </p>
          <div class="contact-info">
            <p>
              <i class="fas fa-map-marker-alt"></i> Pondok Bestari Indah c5/277, Dau, Dusun Klandungan, Landungsari,
              Dau, Malang City, East Java 65151
            </p>
            <p><i class="fas fa-phone"></i> +62 858-9445-8042</p>
            <p><i class="fas fa-envelope"></i> modalproperti@gmail.com</p>
          </div>
        </div>

        <div class="footer-section links">
          <h4>Link Cepat</h4>
          <ul>
            <li><a href="#home">Beranda</a></li>
            <li><a href="#features">Keunggulan</a></li>
            <li><a href="rumah.html">Layanan</a></li>
            <li><a href="#testimonials">Testimoni</a></li>
            <li><a href="#contact">Kontak</a></li>
          </ul>
        </div>

        <div class="footer-section rumahs">
          <h4>Layanan Kami</h4>
          <ul>
            <li><i class="fas fa-city"></i> Properti Baru</li>
            <li><i class="fas fa-building"></i> Properti Bekas</li>
            <li><i class="fas fa-map-marked-alt"></i> Lokasi Strategis</li>
            <li><i class="fas fa-file-contract"></i> Bantuan Legal</li>
          </ul>
        </div>

        <div class="footer-section newsletter">
          <h4>Langganan Newsletter</h4>
          <form class="newsletter-form">
            <input type="email" placeholder="Email Anda" required />
            <button type="submit">Berlangganan</button>
          </form>
          <div class="social-links">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2024 ModalProperti. All rights reserved. Created by properti.id</p>
        <div class="footer-legal">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>
  <script src="/navbar_menu.js"></script>
</body>

</html>