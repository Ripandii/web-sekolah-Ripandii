<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Semua Data</title>
    <style>
        * { box-sizing: border-box; }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            color: #2c3e50;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            width: 230px;
            background: #1e293b;
            color: #fff;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .sidebar .brand {
            padding: 20px;
            font-size: 16px;
            font-weight: 700;
            border-bottom: 1px solid #334155;
        }

        .sidebar nav {
            flex: 1;
            padding: 10px 0;
        }

        .sidebar nav button {
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: #cbd5e1;
            padding: 12px 20px;
            font-size: 14px;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .sidebar nav button:hover {
            background: #273449;
            color: #fff;
        }

        .sidebar nav button.active {
            background: #273449;
            color: #fff;
            border-left: 3px solid #2563eb;
            font-weight: 600;
        }

        .sidebar .logout-box {
            padding: 15px 20px;
            border-top: 1px solid #334155;
        }

        .sidebar .logout-box button {
            width: 100%;
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 9px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .sidebar .logout-box button:hover {
            background: #dc2626;
        }

        /* ---------- MAIN CONTENT ---------- */
        .main {
            margin-left: 230px;
            padding: 30px;
            width: 100%;
            max-width: 900px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .tab-section {
            display: none;
        }

        .tab-section.active {
            display: block;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }

        .card h2 {
            margin-top: 0;
            font-size: 18px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
            color: #1e293b;
        }

        .card h3 { font-size: 14px; color: #475569; margin-top: 20px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-top: 12px;
            margin-bottom: 4px;
            color: #334155;
        }

        input[type=text], input[type=email], input[type=number],
        input[type=date], textarea, select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        textarea { min-height: 70px; resize: vertical; }
        input[type=file] { margin-top: 4px; }
        input[type=checkbox] { width: auto; margin-right: 6px; }

        button[type=submit], .btn {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
        }

        button[type=submit]:hover { background: #1d4ed8; }

        ul { list-style: none; padding: 0; margin: 10px 0 0 0; }
        ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        ul li form button {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        ul li form button:hover { background: #dc2626; }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }
            .main {
                margin-left: 0;
                max-width: 100%;
            }
            .layout {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <div class="layout">

        <!-- ================= SIDEBAR ================= -->
        <div class="sidebar">
            <div class="brand">Panel Admin</div>
            <nav>
                <button class="tab-link active" data-tab="profil">Profil Sekolah</button>
                <button class="tab-link" data-tab="beranda">Beranda</button>
                <button class="tab-link" data-tab="jurusan">Jurusan</button>
                <button class="tab-link" data-tab="guru">Guru & Staff</button>
                <button class="tab-link" data-tab="ekskul">Ekstrakurikuler</button>
                <button class="tab-link" data-tab="galeri-video">Galeri Video</button>
                <button class="tab-link" data-tab="artikel">Artikel</button>
                <button class="tab-link" data-tab="agenda">Agenda</button>
                <button class="tab-link" data-tab="fasilitas">Fasilitas</button>
                <button class="tab-link" data-tab="prestasi">Prestasi</button>
            </nav>
            <div class="logout-box">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="main">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            {{-- ================== PROFIL SEKOLAH ================== --}}
            <div class="tab-section active" id="tab-profil">
                <div class="page-title">Profil Sekolah</div>
                <div class="card">
                    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label>Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ $profil->nama_sekolah ?? '' }}">

                        <label>NPSN</label>
                        <input type="text" name="npsn" value="{{ $profil->npsn ?? '' }}">

                        <label>Alamat</label>
                        <textarea name="alamat">{{ $profil->alamat ?? '' }}</textarea>

                        <label>Telepon</label>
                        <input type="text" name="telepon" value="{{ $profil->telepon ?? '' }}">

                        <label>Email</label>
                        <input type="text" name="email" value="{{ $profil->email ?? '' }}">

                        <label>Visi</label>
                        <textarea name="visi">{{ $profil->visi ?? '' }}</textarea>

                        <label>Misi</label>
                        <textarea name="misi">{{ $profil->misi ?? '' }}</textarea>

                        <label>Logo</label>
                        <input type="file" name="logo">

                        <button type="submit">Simpan Profil</button>
                    </form>
                </div>
            </div>

            {{-- ================== BERANDA ================== --}}
            <div class="tab-section" id="tab-beranda">
                <div class="page-title">Beranda / Tentang Kami</div>
                <div class="card">
                    <form method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label>Judul Hero</label>
                        <input type="text" name="judul_hero" value="{{ $beranda->judul_hero ?? '' }}">

                        <label>Deskripsi Hero</label>
                        <textarea name="deskripsi_hero">{{ $beranda->deskripsi_hero ?? '' }}</textarea>

                        <label>Gambar Hero</label>
                        <input type="file" name="gambar_hero">

                        <button type="submit">Simpan Beranda</button>
                    </form>
                </div>
            </div>

            {{-- ================== JURUSAN ================== --}}
            <div class="tab-section" id="tab-jurusan">
                <div class="page-title">Jurusan</div>
                <div class="card">
                    <h3>Tambah Jurusan</h3>
                    <form method="POST" action="{{ route('admin.jurusan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Kode</label>
                        <input type="text" name="kode">

                        <label>Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" required>

                        <label>Kepala Jurusan</label>
                        <input type="text" name="kepala_jurusan">

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Foto</label>
                        <input type="file" name="foto">

                        <button type="submit">Tambah Jurusan</button>
                    </form>

                    <h3>Daftar Jurusan</h3>
                    <ul>
                        @foreach($jurusan as $j)
                            <li>
                                <span>{{ $j->nama_jurusan }} ({{ $j->kode }})</span>
                                <form method="POST" action="{{ route('admin.jurusan.destroy', $j->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== GURU & STAFF ================== --}}
            <div class="tab-section" id="tab-guru">
                <div class="page-title">Guru & Staff</div>
                <div class="card">
                    <h3>Tambah Guru/Staff</h3>
                    <form method="POST" action="{{ route('admin.guru.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Nama</label>
                        <input type="text" name="nama" required>

                        <label>NIP</label>
                        <input type="text" name="nip">

                        <label>Jabatan</label>
                        <input type="text" name="jabatan">

                        <label>Jurusan</label>
                        <select name="jurusan_id">
                            <option value="">-- Tidak terikat jurusan --</option>
                            @foreach($jurusanList as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                            @endforeach
                        </select>

                        <label><input type="checkbox" name="staf" value="1"> Staf (bukan guru mapel)</label>

                        <label>Foto</label>
                        <input type="file" name="foto">

                        <button type="submit">Tambah Guru/Staff</button>
                    </form>

                    <h3>Daftar Guru & Staff</h3>
                    <ul>
                        @foreach($guru as $g)
                            <li>
                                <span>{{ $g->nama }} — {{ $g->jabatan }} — {{ $g->jurusan->nama_jurusan ?? 'Tanpa Jurusan' }}</span>
                                <form method="POST" action="{{ route('admin.guru.destroy', $g->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== EKSTRAKURIKULER ================== --}}
            <div class="tab-section" id="tab-ekskul">
                <div class="page-title">Ekstrakurikuler</div>
                <div class="card">
                    <h3>Tambah Ekstrakurikuler</h3>
                    <form method="POST" action="{{ route('admin.ekskul.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Nama Ekskul</label>
                        <input type="text" name="nama_ekskul" required>

                        <label>Pembina</label>
                        <input type="text" name="pembina">

                        <label>Jadwal</label>
                        <input type="text" name="jadwal">

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Gambar</label>
                        <input type="file" name="gambar">

                        <button type="submit">Tambah Ekskul</button>
                    </form>

                    <h3>Daftar Ekstrakurikuler</h3>
                    <ul>
                        @foreach($ekskul as $e)
                            <li>
                                <span>{{ $e->nama_ekskul }}</span>
                                <form method="POST" action="{{ route('admin.ekskul.destroy', $e->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== GALERI VIDEO ================== --}}
            <div class="tab-section" id="tab-galeri-video">
                <div class="page-title">Galeri Video</div>
                <div class="card">
                    <h3>Tambah Video</h3>
                    <form method="POST" action="{{ route('admin.galeri-video.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Judul</label>
                        <input type="text" name="judul" required>

                        <label>URL Video (YouTube dll)</label>
                        <input type="text" name="url_video">

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail">

                        <button type="submit">Tambah Video</button>
                    </form>

                    <h3>Daftar Video</h3>
                    <ul>
                        @foreach($galeriVideo as $gv)
                            <li>
                                <span>{{ $gv->judul }}</span>
                                <form method="POST" action="{{ route('admin.galeri-video.destroy', $gv->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== ARTIKEL ================== --}}
            <div class="tab-section" id="tab-artikel">
                <div class="page-title">Artikel</div>
                <div class="card">
                    <h3>Tambah Artikel</h3>
                    <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Judul</label>
                        <input type="text" name="judul" required>

                        <label>Slug (unik)</label>
                        <input type="text" name="slug" required>

                        <label>Ringkasan</label>
                        <textarea name="ringkasan"></textarea>

                        <label>Isi Artikel</label>
                        <textarea name="isi"></textarea>

                        <label>Penulis</label>
                        <input type="text" name="penulis">

                        <label>Gambar</label>
                        <input type="file" name="gambar">

                        <button type="submit">Tambah Artikel</button>
                    </form>

                    <h3>Daftar Artikel</h3>
                    <ul>
                        @foreach($artikel as $a)
                            <li>
                                <span>{{ $a->judul }}</span>
                                <form method="POST" action="{{ route('admin.artikel.destroy', $a->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== AGENDA ================== --}}
            <div class="tab-section" id="tab-agenda">
                <div class="page-title">Agenda</div>
                <div class="card">
                    <h3>Tambah Agenda</h3>
                    <form method="POST" action="{{ route('admin.agenda.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Judul</label>
                        <input type="text" name="judul" required>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Lokasi</label>
                        <input type="text" name="lokasi">

                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai">

                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai">

                        <label>Gambar</label>
                        <input type="file" name="gambar">

                        <button type="submit">Tambah Agenda</button>
                    </form>

                    <h3>Daftar Agenda</h3>
                    <ul>
                        @foreach($agenda as $ag)
                            <li>
                                <span>{{ $ag->judul }} ({{ $ag->tanggal_mulai }})</span>
                                <form method="POST" action="{{ route('admin.agenda.destroy', $ag->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== FASILITAS ================== --}}
            <div class="tab-section" id="tab-fasilitas">
                <div class="page-title">Fasilitas</div>
                <div class="card">
                    <h3>Tambah Fasilitas</h3>
                    <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" required>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Jumlah</label>
                        <input type="number" name="jumlah">

                        <label>Gambar</label>
                        <input type="file" name="gambar">

                        <button type="submit">Tambah Fasilitas</button>
                    </form>

                    <h3>Daftar Fasilitas</h3>
                    <ul>
                        @foreach($fasilitas as $f)
                            <li>
                                <span>{{ $f->nama_fasilitas }}</span>
                                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ================== PRESTASI ================== --}}
            <div class="tab-section" id="tab-prestasi">
                <div class="page-title">Prestasi</div>
                <div class="card">
                    <h3>Tambah Prestasi</h3>
                    <form method="POST" action="{{ route('admin.prestasi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label>Judul</label>
                        <input type="text" name="judul" required>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi"></textarea>

                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa">

                        <label>Tingkat</label>
                        <input type="text" name="tingkat">

                        <label>Tanggal</label>
                        <input type="date" name="tanggal">

                        <label>Gambar</label>
                        <input type="file" name="gambar">

                        <button type="submit">Tambah Prestasi</button>
                    </form>

                    <h3>Daftar Prestasi</h3>
                    <ul>
                        @foreach($prestasi as $p)
                            <li>
                                <span>{{ $p->judul }}</span>
                                <form method="POST" action="{{ route('admin.prestasi.destroy', $p->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var links = document.querySelectorAll('.tab-link');
            var sections = document.querySelectorAll('.tab-section');

            var savedTab = localStorage.getItem('adminActiveTab');
            if (savedTab && document.getElementById('tab-' + savedTab)) {
                activateTab(savedTab);
            }

            links.forEach(function (link) {
                link.addEventListener('click', function () {
                    activateTab(this.dataset.tab);
                    localStorage.setItem('adminActiveTab', this.dataset.tab);
                });
            });

            function activateTab(tabName) {
                links.forEach(function (l) { l.classList.remove('active'); });
                sections.forEach(function (s) { s.classList.remove('active'); });

                var targetLink = document.querySelector('.tab-link[data-tab="' + tabName + '"]');
                var targetSection = document.getElementById('tab-' + tabName);

                if (targetLink) targetLink.classList.add('active');
                if (targetSection) targetSection.classList.add('active');
            }
        });
    </script>

</body>
</html>