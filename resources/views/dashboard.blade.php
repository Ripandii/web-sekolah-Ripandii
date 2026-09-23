<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $profil->nama_sekolah ?? 'Beranda Sekolah' }}</title>
</head>
<body>

    <h1>{{ $profil->nama_sekolah ?? 'Nama Sekolah' }}</h1>

    @if($beranda)
        <h2>{{ $beranda->judul_hero }}</h2>
        <p>{{ $beranda->deskripsi_hero }}</p>
    @endif

    <h2>Jurusan</h2>
    <ul>
        @foreach($jurusan as $j)
            <li>{{ $j->nama_jurusan }}</li>
        @endforeach
    </ul>

    <h2>Guru & Staff</h2>
    <ul>
        @foreach($guru as $g)
            <li>{{ $g->nama }} — {{ $g->jurusan->nama_jurusan ?? '-' }}</li>
        @endforeach
    </ul>

    <h2>Ekstrakurikuler</h2>
    <ul>
        @foreach($ekskul as $e)
            <li>{{ $e->nama_ekskul }}</li>
        @endforeach
    </ul>

    <h2>Artikel Terbaru</h2>
    <ul>
        @foreach($artikelBeranda as $a)
            <li>
                <strong>{{ $a['judul'] }}</strong> — {{ $a['tanggal'] }}
                <p>{{ $a['excerpt'] }}</p>
            </li>
        @endforeach
    </ul>

    <h2>Agenda</h2>
    <ul>
        @foreach($agenda as $ag)
            <li>{{ $ag->judul }} ({{ $ag->tanggal_mulai }})</li>
        @endforeach
    </ul>

    <h2>Fasilitas</h2>
    <ul>
        @foreach($fasilitas as $f)
            <li>{{ $f->nama_fasilitas }}</li>
        @endforeach
    </ul>

    <h2>Prestasi</h2>
    <ul>
        @foreach($prestasi as $p)
            <li>{{ $p->judul }}</li>
        @endforeach
    </ul>

    <h2>Galeri Video</h2>
    <ul>
        @foreach($galeriVideo as $gv)
            <li>{{ $gv->judul ?? '-' }}</li>
        @endforeach
    </ul>

</body>
</html>