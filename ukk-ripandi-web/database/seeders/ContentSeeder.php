<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Beranda;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\GaleriVideo;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Prestasi;
use App\Models\Profil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedProfil();
        $this->seedBeranda();
        $jurusan = $this->seedJurusan();
        $this->seedGuru($jurusan);
        $this->seedEkstrakurikuler();
        $this->seedGaleriVideo();
        $this->seedFasilitas();
        $this->seedArtikel();
        $this->seedAgenda();
        $this->seedPrestasi();
    }

    private function seedProfil(): void
    {
        Profil::updateOrCreate(['id' => 1], [
            'nama_sekolah' => 'SMK Negeri 1 Contoh',
            'npsn' => '12345678',
            'nss' => '123456789012',
            'alamat' => 'Jl. Pendidikan No. 1, Bandung, Jawa Barat',
            'telepon' => '022-1234567',
            'email' => 'info@smkcontoh.sch.id',
            'website' => 'https://smkcontoh.sch.id',
            'logo' => null,
            'sambutan_kepala_sekolah' => 'Selamat datang di website resmi sekolah kami. Kami berkomitmen mencetak lulusan yang unggul, berkarakter, dan siap kerja.',
            'nama_kepala_sekolah' => 'Drs. Ahmad Sutrisno, M.Pd.',
            'foto_kepala_sekolah' => null,
            'visi' => 'Menjadi sekolah kejuruan unggulan yang menghasilkan lulusan kompeten, mandiri, dan berdaya saing global.',
            'misi' => "1. Menyelenggarakan pendidikan kejuruan berkualitas.\n2. Membangun karakter siswa yang disiplin dan berintegritas.\n3. Menjalin kerja sama dengan dunia industri.",
            'sejarah' => 'Sekolah ini didirikan untuk menjawab kebutuhan tenaga kerja terampil di berbagai bidang keahlian.',
        ]);
    }

    private function seedBeranda(): void
    {
        Beranda::updateOrCreate(['id' => 1], [
            'judul_hero' => 'Selamat Datang di SMK Negeri 1 Contoh',
            'deskripsi_hero' => 'Mencetak generasi unggul, terampil, dan siap kerja.',
            'gambar_hero' => null,
            'judul_about' => 'Tentang Kami',
            'deskripsi_about' => 'SMK Negeri 1 Contoh adalah sekolah kejuruan yang fokus pada pengembangan keterampilan siswa sesuai kebutuhan industri.',
            'gambar_about' => null,
            'link_whatsapp' => 'https://wa.me/6281234567890',
            'link_maps' => 'https://maps.google.com/?q=SMK+Negeri+1+Contoh',
        ]);
    }

    private function seedJurusan()
    {
        $data = [
            ['kode' => 'TKR', 'nama_jurusan' => 'Teknik Kendaraan Ringan Otomotif', 'kepala_jurusan' => 'Budi Santoso, S.Pd.', 'deskripsi' => 'Kompetensi keahlian di bidang perawatan dan perbaikan kendaraan ringan.'],
            ['kode' => 'PMS', 'nama_jurusan' => 'Bisnis Daring dan Pemasaran', 'kepala_jurusan' => 'Siti Aminah, S.E.', 'deskripsi' => 'Kompetensi keahlian di bidang pemasaran dan bisnis digital.'],
            ['kode' => 'PPLG', 'nama_jurusan' => 'Pengembangan Perangkat Lunak dan Gim', 'kepala_jurusan' => 'Rizky Pratama, S.Kom.', 'deskripsi' => 'Kompetensi keahlian di bidang pengembangan perangkat lunak dan gim.'],
            ['kode' => 'APHP', 'nama_jurusan' => 'Agribisnis Pengolahan Hasil Pertanian', 'kepala_jurusan' => 'Dewi Lestari, S.P.', 'deskripsi' => 'Kompetensi keahlian di bidang pengolahan hasil pertanian.'],
        ];

        $result = collect();
        foreach ($data as $row) {
            $result->push(Jurusan::updateOrCreate(['kode' => $row['kode']], $row));
        }

        return $result;
    }

    private function seedGuru($jurusanList): void
    {
        $names = [
            ['nama' => 'Ahmad Sutrisno', 'jabatan' => 'Kepala Sekolah', 'staf' => false, 'jurusan' => null],
            ['nama' => 'Budi Santoso', 'jabatan' => 'Kepala Jurusan TKR', 'staf' => false, 'jurusan' => 'TKR'],
            ['nama' => 'Siti Aminah', 'jabatan' => 'Kepala Jurusan Pemasaran', 'staf' => false, 'jurusan' => 'PMS'],
            ['nama' => 'Rizky Pratama', 'jabatan' => 'Kepala Jurusan PPLG', 'staf' => false, 'jurusan' => 'PPLG'],
            ['nama' => 'Dewi Lestari', 'jabatan' => 'Kepala Jurusan APHP', 'staf' => false, 'jurusan' => 'APHP'],
            ['nama' => 'Fajar Nugroho', 'jabatan' => 'Guru Matematika', 'staf' => false, 'jurusan' => null],
            ['nama' => 'Rina Marlina', 'jabatan' => 'Guru Bahasa Indonesia', 'staf' => false, 'jurusan' => null],
            ['nama' => 'Hendra Wijaya', 'jabatan' => 'Staf Tata Usaha', 'staf' => true, 'jurusan' => null],
        ];

        foreach ($names as $n) {
            $jurusanId = $n['jurusan']
                ? optional($jurusanList->firstWhere('kode', $n['jurusan']))->id
                : null;

            Guru::updateOrCreate(['nama' => $n['nama']], [
                'nip' => null,
                'jabatan' => $n['jabatan'],
                'foto' => null,
                'staf' => $n['staf'],
                'jurusan_id' => $jurusanId,
            ]);
        }
    }

    private function seedEkstrakurikuler(): void
    {
        $data = [
            'Rohis' => 'Kegiatan kerohanian Islam bagi siswa.',
            'Cinemak' => 'Klub sinematografi dan produksi video.',
            'Voli' => 'Ekstrakurikuler bola voli.',
            'PMR' => 'Palang Merah Remaja, pelatihan pertolongan pertama.',
            'Karawitan' => 'Seni musik tradisional gamelan.',
            'Futsal' => 'Ekstrakurikuler futsal.',
            'Pramuka' => 'Kegiatan kepramukaan.',
            'Paskibra' => 'Pasukan pengibar bendera.',
            'Marching Band' => 'Kelompok marching band sekolah.',
            'Jepang' => 'Klub bahasa dan budaya Jepang.',
        ];

        foreach ($data as $nama => $deskripsi) {
            Ekstrakurikuler::updateOrCreate(['nama_ekskul' => $nama], [
                'pembina' => 'Pembina ' . $nama,
                'deskripsi' => $deskripsi,
                'gambar' => null,
                'jadwal' => 'Setiap Jumat, 14.00 - 16.00 WIB',
            ]);
        }
    }

    private function seedGaleriVideo(): void
    {
        $data = [
            ['judul_video' => 'Profil Sekolah', 'url_video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'deskripsi' => 'Video profil singkat sekolah.'],
            ['judul_video' => 'Kegiatan Belajar Mengajar', 'url_video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'deskripsi' => 'Dokumentasi kegiatan belajar mengajar.'],
            ['judul_video' => 'Ekstrakurikuler Sekolah', 'url_video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'deskripsi' => 'Dokumentasi kegiatan ekstrakurikuler.'],
        ];

        foreach ($data as $row) {
            GaleriVideo::updateOrCreate(['judul_video' => $row['judul_video']], $row + ['thumbnail' => null]);
        }
    }

    private function seedFasilitas(): void
    {
        $data = [
            ['nama_fasilitas' => 'Laboratorium Komputer', 'jumlah' => 3, 'deskripsi' => 'Ruang lab komputer dengan spesifikasi terbaru.'],
            ['nama_fasilitas' => 'Bengkel Otomotif', 'jumlah' => 1, 'deskripsi' => 'Bengkel praktik untuk jurusan TKR.'],
            ['nama_fasilitas' => 'Perpustakaan', 'jumlah' => 1, 'deskripsi' => 'Perpustakaan dengan koleksi buku lengkap.'],
            ['nama_fasilitas' => 'Lapangan Olahraga', 'jumlah' => 2, 'deskripsi' => 'Lapangan untuk kegiatan olahraga dan upacara.'],
            ['nama_fasilitas' => 'Masjid Sekolah', 'jumlah' => 1, 'deskripsi' => 'Tempat ibadah bagi warga sekolah.'],
        ];

        foreach ($data as $row) {
            Fasilitas::updateOrCreate(['nama_fasilitas' => $row['nama_fasilitas']], $row + ['gambar' => null]);
        }
    }

    private function seedArtikel(): void
    {
        $data = [
            'Penerimaan Peserta Didik Baru Dibuka' => 'Pendaftaran PPDB tahun ajaran baru telah resmi dibuka. Simak informasi selengkapnya di sini.',
            'Siswa Raih Juara di Kompetisi Nasional' => 'Tim siswa berhasil meraih prestasi membanggakan di ajang kompetisi tingkat nasional.',
            'Kunjungan Industri Jurusan PPLG' => 'Siswa jurusan PPLG melaksanakan kunjungan industri ke perusahaan teknologi terkemuka.',
        ];

        foreach ($data as $judul => $ringkasan) {
            Artikel::updateOrCreate(['slug' => Str::slug($judul)], [
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'ringkasan' => $ringkasan,
                'isi' => $ringkasan . ' ' . $ringkasan,
                'gambar' => null,
                'penulis' => 'Admin',
                'tanggal_publish' => now(),
            ]);
        }
    }

    private function seedAgenda(): void
    {
        $data = [
            ['judul' => 'Rapat Orang Tua Siswa', 'lokasi' => 'Aula Sekolah', 'mulai' => now()->addDays(7), 'selesai' => now()->addDays(7)],
            ['judul' => 'Ujian Tengah Semester', 'lokasi' => 'Ruang Kelas', 'mulai' => now()->addDays(14), 'selesai' => now()->addDays(20)],
            ['judul' => 'Pentas Seni Tahunan', 'lokasi' => 'Lapangan Sekolah', 'mulai' => now()->addDays(30), 'selesai' => now()->addDays(30)],
        ];

        foreach ($data as $row) {
            Agenda::updateOrCreate(['judul' => $row['judul']], [
                'deskripsi' => 'Kegiatan ' . $row['judul'] . ' akan dilaksanakan sesuai jadwal.',
                'gambar' => null,
                'lokasi' => $row['lokasi'],
                'tanggal_mulai' => $row['mulai'],
                'tanggal_selesai' => $row['selesai'],
            ]);
        }
    }

    private function seedPrestasi(): void
    {
        $data = [
            ['judul' => 'Juara 1 Lomba Kompetensi Siswa (LKS) Otomotif', 'tingkat' => 'Provinsi', 'tahun' => '2025'],
            ['judul' => 'Juara 2 Lomba Debat Bahasa Inggris', 'tingkat' => 'Kabupaten/Kota', 'tahun' => '2025'],
            ['judul' => 'Juara 1 Lomba Marching Band', 'tingkat' => 'Nasional', 'tahun' => '2024'],
        ];

        foreach ($data as $row) {
            Prestasi::updateOrCreate(['judul' => $row['judul']], $row + [
                'gambar' => null,
                'deskripsi' => 'Prestasi diraih oleh siswa-siswi terbaik sekolah.',
            ]);
        }
    }
}