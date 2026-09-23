<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin — SMK Negeri 1 Cijati</title>
<style>
  :root {
    --navy: #1c4e80;
    --navy-dark: #143a5f;
    --blue: #1565c0;
    --red: #d32f2f;
    --gold: #c98a1f;
    --bg: #f4f6f9;
    --card-bg: #ffffff;
    --text: #1f2937;
    --muted: #6b7280;
    --border: #e5e7eb;
  }

  * { box-sizing: border-box; }

  body {
    margin: 0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background: var(--bg);
    color: var(--text);
  }

  /* ===== Layout ===== */
  .admin-wrap {
    display: flex;
    min-height: 100vh;
  }

  /* ===== Sidebar ===== */
  .sidebar {
    width: 250px;
    flex-shrink: 0;
    background: var(--navy);
    color: #fff;
    display: flex;
    flex-direction: column;
  }

  .sidebar .brand {
    padding: 22px 20px;
    font-size: 1.05rem;
    font-weight: 700;
    border-bottom: 1px solid rgba(255,255,255,0.15);
  }

  .sidebar .brand span {
    display: block;
    font-weight: 400;
    font-size: 0.78rem;
    color: rgba(255,255,255,0.7);
    margin-top: 4px;
  }

  .sidebar nav {
    flex: 1;
    padding: 10px 0;
    overflow-y: auto;
  }

  .sidebar .nav-item {
    display: block;
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    color: rgba(255,255,255,0.85);
    padding: 12px 20px;
    font-size: 0.92rem;
    cursor: pointer;
    border-left: 3px solid transparent;
  }

  .sidebar .nav-item:hover {
    background: rgba(255,255,255,0.08);
  }

  .sidebar .nav-item.active {
    background: rgba(255,255,255,0.12);
    border-left-color: var(--gold);
    color: #fff;
    font-weight: 600;
  }

  .sidebar .logout-form {
    padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,0.15);
  }

  .sidebar .logout-btn {
    width: 100%;
    padding: 9px;
    background: var(--red);
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.85rem;
  }

  /* ===== Main content ===== */
  .main {
    flex: 1;
    padding: 28px 34px;
    max-width: 100%;
  }

  .topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
  }

  .topbar h1 {
    font-size: 1.4rem;
    margin: 0;
    color: var(--navy-dark);
  }

  .topbar .status-msg {
    background: #e6f4ea;
    color: #1e7a34;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 0.85rem;
  }

  .tab-page { display: none; }
  .tab-page.active { display: block; }

  /* ===== Overview cards ===== */
  .overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 10px;
  }

  .overview-card {
    background: var(--card-bg);
    border-radius: 10px;
    padding: 18px;
    border-top: 4px solid var(--navy);
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
  }

  .overview-card .count {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--navy-dark);
  }

  .overview-card .label {
    font-size: 0.82rem;
    color: var(--muted);
    margin-top: 4px;
  }

  /* ===== Section list ===== */
  .section-title {
    font-size: 1.15rem;
    margin: 0 0 14px;
    color: var(--navy-dark);
  }

  .data-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
  }

  .data-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-left: 4px solid var(--accent, var(--navy));
    border-radius: 10px;
    padding: 16px 18px;
  }

  .data-card h3 {
    margin: 0 0 8px;
    font-size: 1rem;
    color: var(--text);
  }

  .data-card .field {
    font-size: 0.82rem;
    color: var(--muted);
    margin-bottom: 3px;
  }

  .data-card .field b {
    color: var(--text);
    font-weight: 600;
  }

  .empty-msg {
    color: var(--muted);
    font-style: italic;
    padding: 14px 0;
  }

  .single-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 20px;
    max-width: 520px;
  }
</style>
</head>
<body>

@php
    // Daftar field yang tidak perlu ditampilkan di kartu ringkasan
    $hiddenFields = ['id', 'created_at', 'updated_at', 'password', 'remember_token'];

    $accentMap = [
        'tkr' => '#1c4e80',
        'otomotif' => '#1c4e80',
        'pemasaran' => '#1565c0',
        'pplg' => '#d32f2f',
        'aphp' => '#c98a1f',
    ];

    function accentForJurusan($nama, $map) {
        $nama = strtolower((string) $nama);
        foreach ($map as $key => $color) {
            if (str_contains($nama, $key)) return $color;
        }
        return null;
    }
@endphp

<div class="admin-wrap">

  <aside class="sidebar">
    <div class="brand">
      SMK Negeri 1 Cijati
      <span>Panel Admin</span>
    </div>
    <nav>
      <button class="nav-item active" data-tab="overview">Ikhtisar</button>
      <button class="nav-item" data-tab="profil">Profil Sekolah</button>
      <button class="nav-item" data-tab="beranda">Beranda</button>
      <button class="nav-item" data-tab="jurusan">Jurusan</button>
      <button class="nav-item" data-tab="guru">Guru &amp; Staf</button>
      <button class="nav-item" data-tab="ekskul">Ekstrakurikuler</button>
      <button class="nav-item" data-tab="galeri">Galeri Video</button>
      <button class="nav-item" data-tab="artikel">Artikel</button>
      <button class="nav-item" data-tab="agenda">Agenda</button>
      <button class="nav-item" data-tab="fasilitas">Fasilitas</button>
      <button class="nav-item" data-tab="prestasi">Prestasi</button>
    </nav>
    <form class="logout-form" method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">Keluar</button>
    </form>
  </aside>

  <main class="main">

    <div class="topbar">
      <h1 id="topbar-title">Ikhtisar</h1>
      @if (session('status'))
        <div class="status-msg">{{ session('status') }}</div>
      @endif
    </div>

    {{-- ===================== OVERVIEW ===================== --}}
    <section class="tab-page active" id="tab-overview">
      <div class="overview-grid">
        <div class="overview-card"><div class="count">{{ $jurusan->count() }}</div><div class="label">Jurusan</div></div>
        <div class="overview-card"><div class="count">{{ $guru->count() }}</div><div class="label">Guru &amp; Staf</div></div>
        <div class="overview-card"><div class="count">{{ $ekskul->count() }}</div><div class="label">Ekstrakurikuler</div></div>
        <div class="overview-card"><div class="count">{{ $galeriVideo->count() }}</div><div class="label">Galeri Video</div></div>
        <div class="overview-card"><div class="count">{{ $artikel->count() }}</div><div class="label">Artikel</div></div>
        <div class="overview-card"><div class="count">{{ $agenda->count() }}</div><div class="label">Agenda</div></div>
        <div class="overview-card"><div class="count">{{ $fasilitas->count() }}</div><div class="label">Fasilitas</div></div>
        <div class="overview-card"><div class="count">{{ $prestasi->count() }}</div><div class="label">Prestasi</div></div>
      </div>
    </section>

    {{-- ===================== PROFIL (data tunggal) ===================== --}}
    <section class="tab-page" id="tab-profil">
      <h2 class="section-title">Profil Sekolah</h2>
      @if ($profil)
        <div class="single-card">
          @foreach ($profil->getAttributes() as $key => $value)
            @if (!in_array($key, $hiddenFields))
              <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 120) : $value }}</div>
            @endif
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data profil.</p>
      @endif
    </section>

    {{-- ===================== BERANDA (data tunggal) ===================== --}}
    <section class="tab-page" id="tab-beranda">
      <h2 class="section-title">Beranda / Tentang Kami</h2>
      @if ($beranda)
        <div class="single-card">
          @foreach ($beranda->getAttributes() as $key => $value)
            @if (!in_array($key, $hiddenFields))
              <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 120) : $value }}</div>
            @endif
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data beranda.</p>
      @endif
    </section>

    {{-- ===================== JURUSAN ===================== --}}
    <section class="tab-page" id="tab-jurusan">
      <h2 class="section-title">Jurusan</h2>
      @if ($jurusan->count())
        <div class="data-grid">
          @foreach ($jurusan as $item)
            <div class="data-card" style="--accent: {{ accentForJurusan($item->nama_jurusan ?? '', $accentMap) ?? '#1c4e80' }}">
              <h3>{{ $item->nama_jurusan ?? '-' }}</h3>
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, array_merge($hiddenFields, ['nama_jurusan'])))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data jurusan.</p>
      @endif
    </section>

    {{-- ===================== GURU & STAF ===================== --}}
    <section class="tab-page" id="tab-guru">
      <h2 class="section-title">Guru &amp; Staf</h2>
      @if ($guru->count())
        <div class="data-grid">
          @foreach ($guru as $item)
            <div class="data-card">
              <h3>{{ $item->nama ?? '-' }}</h3>
              <div class="field"><b>Jabatan/Mapel:</b> {{ $item->jabatan && $item->jabatan !== '-' ? $item->jabatan : ($item->mapel ?? '-') }}</div>
              <div class="field"><b>Status:</b> {{ $item->staf ? 'Staf' : 'Guru' }}</div>
              <div class="field"><b>Jurusan:</b> {{ $item->jurusan->nama_jurusan ?? '—' }}</div>
              <div class="field"><b>NIP:</b> {{ $item->nip ?? '-' }}</div>
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data guru/staf.</p>
      @endif
    </section>

    {{-- ===================== EKSTRAKURIKULER ===================== --}}
    <section class="tab-page" id="tab-ekskul">
      <h2 class="section-title">Ekstrakurikuler</h2>
      @if ($ekskul->count())
        <div class="data-grid">
          @foreach ($ekskul as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data ekstrakurikuler.</p>
      @endif
    </section>

    {{-- ===================== GALERI VIDEO ===================== --}}
    <section class="tab-page" id="tab-galeri">
      <h2 class="section-title">Galeri Video</h2>
      @if ($galeriVideo->count())
        <div class="data-grid">
          @foreach ($galeriVideo as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data galeri video.</p>
      @endif
    </section>

    {{-- ===================== ARTIKEL ===================== --}}
    <section class="tab-page" id="tab-artikel">
      <h2 class="section-title">Artikel</h2>
      @if ($artikel->count())
        <div class="data-grid">
          @foreach ($artikel as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 80) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data artikel.</p>
      @endif
    </section>

    {{-- ===================== AGENDA ===================== --}}
    <section class="tab-page" id="tab-agenda">
      <h2 class="section-title">Agenda</h2>
      @if ($agenda->count())
        <div class="data-grid">
          @foreach ($agenda as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data agenda.</p>
      @endif
    </section>

    {{-- ===================== FASILITAS ===================== --}}
    <section class="tab-page" id="tab-fasilitas">
      <h2 class="section-title">Fasilitas</h2>
      @if ($fasilitas->count())
        <div class="data-grid">
          @foreach ($fasilitas as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data fasilitas.</p>
      @endif
    </section>

    {{-- ===================== PRESTASI ===================== --}}
    <section class="tab-page" id="tab-prestasi">
      <h2 class="section-title">Prestasi</h2>
      @if ($prestasi->count())
        <div class="data-grid">
          @foreach ($prestasi as $item)
            <div class="data-card">
              @foreach ($item->getAttributes() as $key => $value)
                @if (!in_array($key, $hiddenFields))
                  <div class="field"><b>{{ ucwords(str_replace('_', ' ', $key)) }}:</b> {{ is_string($value) ? \Illuminate\Support\Str::limit($value, 60) : $value }}</div>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      @else
        <p class="empty-msg">Belum ada data prestasi.</p>
      @endif
    </section>

  </main>
</div>

<script>
  const navItems = document.querySelectorAll('.sidebar .nav-item');
  const tabPages = document.querySelectorAll('.tab-page');
  const topbarTitle = document.getElementById('topbar-title');

  navItems.forEach(btn => {
    btn.addEventListener('click', () => {
      navItems.forEach(b => b.classList.remove('active'));
      tabPages.forEach(p => p.classList.remove('active'));

      btn.classList.add('active');
      document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
      topbarTitle.textContent = btn.textContent.trim();
    });
  });
</script>

</body>
</html>