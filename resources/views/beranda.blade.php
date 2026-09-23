<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMK Negeri 1 Cijati</title>
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>
<body>

<header>
  <nav>
    <div class="logo">SMK Negeri 1 Cijati</div>
    <div class="menu-toggle" onclick="document.querySelector('nav ul').classList.toggle('active')">☰</div>
    <ul>
      <li><a href="#" class="menu-item active" data-page="beranda">Beranda</a></li>
      <li><a href="#" class="menu-item" data-page="galeri">Galeri Foto</a></li>
      <li><a href="#" class="menu-item" data-page="jurusan">Jurusan</a></li>
      <li><a href="#" class="menu-item" data-page="prestasi">Galeri Prestasi</a></li>
      <li><a href="#" class="menu-item" data-page="eskul">Eskul</a></li>
    </ul>
  </nav>
</header>

<section id="page-beranda" class="page active">
  @php
    $beranda_hero_slides = [
        asset('images/hero/hero-upacara.jpg'),
        asset('images/hero/tkr.jpg'),
      
    ];
  @endphp

  <div class="beranda-hero">
    <div class="beranda-slides" id="berandaSlides">
      @foreach($beranda_hero_slides as $i => $slideUrl)
        <div class="beranda-slide {{ $i === 0 ? 'active' : '' }}" style="background-image:url('{{ $slideUrl }}');"></div>
      @endforeach
    </div>

    <div class="beranda-overlay"></div>
    <div class="beranda-content">
      <img src="{{ asset('images/logo-smkn1cijati.png') }}" alt="Logo SMK Negeri 1 Cijati" class="beranda-logo"
           onerror="this.style.display='none';">
      <h1>Selamat Datang di SMK Negeri 1 Cijati</h1>
      <p>Sekolah Menengah Kejuruan Negeri</p>
      <a href="#" class="btn menu-item" data-page="jurusan">Lihat Jurusan</a>
    </div>
  </div>
</section>

<section id="page-galeri" class="page">
  <h2>Galeri Foto</h2>
  <div class="galeri-grid">
    <div class="galeri-item"><img src="{{ asset('images/cijati.jpg') }}" alt="Kegiatan Sekolah"></div>
    <div class="galeri-item"><img src="{{ asset('images/poto-pkl-smk.jpg') }}" alt="Lab Komputer"></div>
    <div class="galeri-item"><img src="{{ asset('images/ilham-sulaeman-paskibra-kabupaten.jpeg') }}" alt="Upacara Bendera"></div>
    <div class="galeri-item"><img src="{{ asset('images/juara-banbinton.jpeg') }}" alt="Lomba Sekolah"></div>
  </div>
</section>

<section id="page-jurusan" class="page">
  <h2>Jurusan</h2>
  <div class="jurusan-grid">
    <div class="card" style="--accent-dept:#1c4e80">
      <div class="card-logo">
        <img src="{{ asset('images/jurusan/logo-tkr.jpeg') }}" alt="Logo TKR"
             onerror="this.closest('.card-logo').style.display='none';">
      </div>
      <h3>TKR</h3>
      <p>Teknik Kendaraan Ringan</p>
    </div>
    <div class="card" style="--accent-dept:#1565c0">
      <div class="card-logo">
        <img src="{{ asset('images/jurusan/logo-pemasaran.jpeg') }}" alt="Logo Pemasaran"
             onerror="this.closest('.card-logo').style.display='none';">
      </div>
      <h3>Pemasaran</h3>
      <p>Bisnis Daring dan Pemasaran</p>
    </div>
    <div class="card" style="--accent-dept:#d32f2f">
      <div class="card-logo">
        <img src="{{ asset('images/jurusan/logo-pplg.jpeg') }}" alt="Logo PPLG"
             onerror="this.closest('.card-logo').style.display='none';">
      </div>
      <h3>PPLG</h3>
      <p>Pengembangan Perangkat Lunak dan Gim</p>
    </div>
    <div class="card" style="--accent-dept:#c98a1f">
      <div class="card-logo">
        <img src="{{ asset('images/jurusan/logo-aphp.jpeg') }}" alt="Logo APHP"
             onerror="this.closest('.card-logo').style.display='none';">
      </div>
      <h3>APHP</h3>
      <p>Agriteknologi Pengolahan Hasil Pertanian</p>
    </div>
  </div>
</section>

<section id="page-prestasi" class="page">
  <h2>Galeri Prestasi</h2>
  <div class="prestasi-wrap">
    <div class="prestasi-item">
      <div class="prestasi-photo">
        <img src="{{ asset('images/prestasi/ilham-sulaeman-paskibra-kabupaten.jpeg') }}" alt="Ilham Sulaeman - Pasukan Pengibar Bendera Pusaka Kabupaten Cianjur">
      </div>
      <span>Pengukuhan</span>
      <h3>Pasukan Pengibar Bendera Pusaka</h3>
      <p>Ilham Sulaeman dikukuhkan sebagai anggota Pasukan Pengibar Bendera Pusaka tingkat Kabupaten Cianjur.</p>
    </div>
    <div class="prestasi-item">
      <div class="prestasi-photo">
        <img src="{{ asset('images/prestasi/juara-banbinton.jpeg') }}" alt="Siti Nurhalimah dan Celsa Wisdasari - O2SN">
      </div>
      <span>Juara 3</span>
      <h3>O2SN (Olimpiade Olahraga Siswa Nasional)</h3>
      <p>Siti Nurhalimah meraih Juara 3 Atletik Putri dan Celsa Wisdasari meraih Juara 3 Bulutangkis Tunggal Putri.</p>
    </div>
    <div class="prestasi-item">
      <div class="prestasi-photo">
        <img src="{{ asset('images/prestasi/pmr-juara1-kabupaten-cianjur.jpg') }}" alt="Tim PMR - Juara 1 Kabupaten Cianjur">
      </div>
      <span>Juara 1</span>
      <h3>Lomba PMR Tingkat Kabupaten</h3>
      <p>Tim Palang Merah Remaja (PMR) SMK Negeri 1 Cijati meraih Juara 1 tingkat Kabupaten Cianjur.</p>
    </div>
>
  </div>
</section>

<section id="page-eskul" class="page">
  <h2>Ekstrakurikuler</h2>
  <div class="eskul-grid">
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/pmr.jpg') }}" alt="Logo PMR"></div>
      <p>PMR</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/pramuka.jpg') }}" alt="Logo Pramuka"></div>
      <p>Pramuka</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/rohis.jpg') }}" alt="Logo Rohis"></div>
      <p>Rohis</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/voli.jpg') }}" alt="Logo Bola Voli"></div>
      <p>Bola Voli</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/paskibra.jpg') }}" alt="Logo Paskibra"></div>
      <p>Paskibra</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/futsal.jpg') }}" alt="Logo Futsal"></div>
      <p>Futsal</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/karawitan.jpg') }}" alt="Logo Karawitan"></div>
      <p>Karawitan</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/marchingband.jpg') }}" alt="Logo Marching Band"></div>
      <p>Marching Band</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/cinemak.jpg') }}" alt="Logo Cinemak"></div>
      <p>Jurnalistik (Cinemak)</p>
    </div>
    <div class="eskul-item">
      <div class="eskul-logo"><img src="{{ asset('images/ekskul/jepang.jpg') }}" alt="Logo Kelas Bahasa Jepang"></div>
      <p>Bahasa Jepang</p>
    </div>
</section>

<footer>
  <p>© 2026 SMK Negeri 1 Cijati</p>
  <p>Kabupaten Cianjur, Jawa Barat</p>
  <!-- TODO: ganti dengan alamat lengkap dan kontak resmi sekolah -->
  <p>Contact: info@smkn1cijati.sch.id</p>
</footer>

<script src="{{ asset('js/beranda.js') }}"></script>
</body>
</html>