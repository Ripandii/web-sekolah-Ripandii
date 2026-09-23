<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jurusan — SMK Negeri 1 Cijati</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/jurusan.css') }}">
</head>
<body>

@php
    // Data setiap jurusan: logo, warna aksen (diambil dari warna khas logo masing-masing),
    // kepala kompetensi keahlian, deskripsi, dan galeri kegiatan.
    // Ganti/­tambah isi array 'kegiatan' kapan pun ada foto baru.
    $daftarJurusanDetail = [
        [
            'kode'       => 'TKR',
            'nama'       => 'Teknik Kendaraan Ringan',
            'logo'       => 'images/jurusan/logo-tkr.jpeg',
            'warna'      => '#1c4e80',
            'deskripsi'  => 'Program keahlian yang membekali siswa dengan kompetensi perawatan dan perbaikan kendaraan ringan, mulai dari sistem mesin, kelistrikan, hingga sasis dan pemindah tenaga.',
            'kepala'     => [
                'nama'    => 'Romi Darmayadi, S.Pd., S.T.',
                'jabatan' => 'Kepala Kompetensi Keahlian TKR',
                'foto'    => 'images/jurusan/kepala/kepala-tkr.jpg',
            ],
            'kegiatan'   => [
                ['foto' => 'images/jurusan/kegiatan/tkr-1.jpg', 'caption' => 'Ruang Praktik Siswa (RPS) TKR'],
            ],
        ],
        [
            'kode'       => 'PMS',
            'nama'       => 'Pemasaran',
            'logo'       => 'images/jurusan/logo-pemasaran.jpeg',
            'warna'      => '#1565c0',
            'deskripsi'  => 'Program keahlian yang mempersiapkan siswa untuk terjun ke dunia bisnis dan pemasaran, meliputi bisnis digital, strategi promosi, hingga pengelolaan bisnis ritel.',
            'kepala'     => [
                'nama'    => 'Nanang Suryana',
                'jabatan' => 'Kepala Kompetensi Keahlian Pemasaran',
                'foto'    => 'images/jurusan/kepala/kepala-pms.JPG',
            ],
            'kegiatan'   => [
                ['foto' => 'images/jurusan/kegiatan/pms-1.jpg', 'caption' => 'Workshop Bisnis Daring dan Pemasaran (BDP)'],
            ],
        ],
        [
            'kode'       => 'PPLG',
            'nama'       => 'Pengembangan Perangkat Lunak dan Gim',
            'logo'       => 'images/jurusan/logo-pplg.jpeg',
            'warna'      => '#d32f2f',
            'deskripsi'  => 'Program keahlian yang mengasah kemampuan siswa dalam pemrograman, pengembangan aplikasi/gim, serta desain antarmuka (UI/UX) untuk bekal karier di industri digital.',
            'kepala'     => [
                'nama'    => 'Rahmat Setiawan, S.T.',
                'jabatan' => 'Kepala Kompetensi Keahlian PPLG',
                'foto'    => 'images/jurusan/kepala/kepala-pplg.jpg',
            ],
            'kegiatan'   => [
                ['foto' => 'images/jurusan/kegiatan/pplg-1.jpg', 'caption' => 'Workshop Rekayasa Perangkat Lunak (RPL)'],
                ['foto' => 'images/jurusan/kegiatan/pplg-2.jpg', 'caption' => 'Ruang administrasi PPLG'],
            ],
        ],
        [
            'kode'       => 'APHP',
            'nama'       => 'Agriteknologi Pengolahan Hasil Pertanian',
            'logo'       => 'images/jurusan/logo-aphp.jpeg',
            'warna'      => '#c98a1f',
            'deskripsi'  => 'Program keahlian yang membekali siswa dalam mengolah hasil pertanian menjadi produk pangan bernilai jual, mulai dari proses produksi hingga pengemasan.',
            'kepala'     => [
                'nama'    => 'Budiana Hermawan, S.TP.',
                'jabatan' => 'Kepala Kompetensi Keahlian APHP',
                'foto'    => 'images/jurusan/kepala/kepala-aphp.jpg',
            ],
            'kegiatan'   => [
                // belum ada foto kegiatan diupload untuk APHP
            ],
        ],
    ];
@endphp

<div class="pj-page">

  <div class="pj-header">
    <h1>Jurusan</h1>
    <p>Program Keahlian di SMK Negeri 1 Cijati</p>
  </div>

  <!-- Navigasi cepat antar jurusan -->
  <div class="pj-tabnav" id="pjTabNav">
    @foreach($daftarJurusanDetail as $j)
      <a href="#jurusan-{{ strtolower($j['kode']) }}" class="pj-tabnav-item" data-target="jurusan-{{ strtolower($j['kode']) }}" style="--accent: {{ $j['warna'] }}">
        {{ $j['kode'] }}
      </a>
    @endforeach
  </div>

  @foreach($daftarJurusanDetail as $j)
    <section class="pj-jurusan-block" id="jurusan-{{ strtolower($j['kode']) }}" style="--accent: {{ $j['warna'] }}">

      <div class="pj-jurusan-top">
        <div class="pj-logo-wrap">
          @if($j['logo'])
            <img src="{{ asset($j['logo']) }}" alt="Logo {{ $j['kode'] }}"
                 onerror="this.closest('.pj-logo-wrap').innerHTML='<div class=&quot;pj-placeholder&quot;>{{ $j['kode'] }}</div>';">
          @else
            <div class="pj-placeholder">{{ $j['kode'] }}</div>
          @endif
        </div>
        <div class="pj-jurusan-title">
          <div class="pj-jurusan-kode">{{ $j['kode'] }}</div>
          <h2>{{ $j['nama'] }}</h2>
          <p>{{ $j['deskripsi'] }}</p>
        </div>
      </div>

      <div class="pj-kepala-card">
        <div class="pj-kepala-photo">
          @if($j['kepala']['foto'] ?? false)
            <img src="{{ asset($j['kepala']['foto']) }}" alt="{{ $j['kepala']['nama'] }}" data-lightbox
                 onerror="this.closest('.pj-kepala-photo').innerHTML='<div class=&quot;pj-placeholder-img&quot;></div>';">
          @else
            <div class="pj-placeholder-img"></div>
          @endif
        </div>
        <div class="pj-kepala-text">
          <div class="pj-kepala-nama">{{ $j['kepala']['nama'] ?? '-' }}</div>
          <div class="pj-kepala-jabatan">{{ $j['kepala']['jabatan'] ?? '-' }}</div>
        </div>
      </div>

      <div class="pj-kegiatan-wrap">
        <h3>Foto Kegiatan</h3>
        <div class="pj-kegiatan-grid">
          @forelse($j['kegiatan'] as $k)
            <div class="pj-kegiatan-card">
              <div class="pj-kegiatan-photo">
                <img src="{{ asset($k['foto']) }}" alt="{{ $k['caption'] }}" data-lightbox
                     onerror="this.closest('.pj-kegiatan-photo').innerHTML='<div class=&quot;pj-placeholder-img&quot;></div>';">
              </div>
              <div class="pj-kegiatan-caption">{{ $k['caption'] }}</div>
            </div>
          @empty
            <p class="pj-subtext">Belum ada foto kegiatan untuk jurusan ini.</p>
          @endforelse
        </div>
      </div>

    </section>
  @endforeach

</div>

<!-- Lightbox untuk foto kepala & kegiatan -->
<div class="pj-lightbox-overlay" id="pjLightbox">
  <button type="button" class="pj-lightbox-close" id="pjLightboxClose" aria-label="Tutup">&times;</button>
  <img id="pjLightboxImg" src="" alt="">
</div>

<script src="{{ asset('js/jurusan.js') }}"></script>
</body>
</html>