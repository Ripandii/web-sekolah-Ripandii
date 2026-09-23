<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\GaleriVideoController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\ArtikelVideoController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Auth\AdminMagicLoginController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\JurusanPublicController;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Artikel;
use App\Models\Agenda;
use App\Models\Beranda;
use App\Models\Fasilitas;
use App\Models\Profil;

// ==========================
// Halaman Utama (Publik)
// ==========================
Route::get('/', function () {
    $profil = Profil::first() ?? new Profil();
    $beranda = Beranda::first();

    $jurusan   = Jurusan::all();
    $guru      = Guru::with('jurusan')->get();
    $ekskul    = Ekstrakurikuler::all();
    $artikel   = Artikel::all();
    $agenda    = Agenda::all();
    $fasilitas = Fasilitas::all();

    // ---- Artikel Terbaru (khusus untuk section "Artikel Terbaru" di beranda) ----
    $artikelBeranda = Artikel::latest()->take(6)->get()->map(function ($item) {
        return [
            'foto'    => $item->gambar ? 'images/artikel/'.$item->gambar : null,
            'judul'   => $item->judul,
            'tanggal' => optional($item->created_at)->translatedFormat('d F Y'),
            'excerpt' => Str::limit($item->ringkasan, 120),
        ];
    });

    $galeriVideo = class_exists(\App\Models\GaleriVideo::class)
        ? \App\Models\GaleriVideo::all()
        : collect();

    $prestasi = class_exists(\App\Models\Prestasi::class)
        ? \App\Models\Prestasi::all()
        : collect();

    $notifikasi = class_exists(\App\Models\Notifikasi::class)
        ? \App\Models\Notifikasi::latest()->take(5)->get()
        : collect();

    $kepalaSekolah = class_exists(\App\Models\KepalaSekolah::class)
        ? \App\Models\KepalaSekolah::first()
        : null;

    $sambutanKepsek = $kepalaSekolah->sambutan ?? null;

    return view('beranda', compact(
        'profil', 'beranda', 'jurusan', 'guru', 'ekskul', 'galeriVideo', 'artikel', 'artikelBeranda',
        'agenda', 'fasilitas', 'prestasi', 'notifikasi', 'kepalaSekolah', 'sambutanKepsek'
    ));
});

// ==========================
// Halaman Detail Jurusan (Publik) — 4 halaman statis
// ==========================
Route::get('/jurusan/tkr', [JurusanPublicController::class, 'tkr'])->name('jurusan.tkr');
Route::get('/jurusan/pms', [JurusanPublicController::class, 'pms'])->name('jurusan.pms');
Route::get('/jurusan/pplg', [JurusanPublicController::class, 'pplg'])->name('jurusan.pplg');
Route::get('/jurusan/aphp', [JurusanPublicController::class, 'aphp'])->name('jurusan.aphp');

// ==========================
// Halaman Detail Ekstrakurikuler (Publik) — 10 halaman statis
// ==========================
Route::get('/ekstrakurikuler/rohis', [EkskulController::class, 'rohis'])->name('ekskul.rohis');
Route::get('/ekstrakurikuler/cinemak', [EkskulController::class, 'cinemak'])->name('ekskul.cinemak');
Route::get('/ekstrakurikuler/voli', [EkskulController::class, 'voli'])->name('ekskul.voli');
Route::get('/ekstrakurikuler/pmr', [EkskulController::class, 'pmr'])->name('ekskul.pmr');
Route::get('/ekstrakurikuler/karawitan', [EkskulController::class, 'karawitan'])->name('ekskul.karawitan');
Route::get('/ekstrakurikuler/futsal', [EkskulController::class, 'futsal'])->name('ekskul.futsal');
Route::get('/ekstrakurikuler/pramuka', [EkskulController::class, 'pramuka'])->name('ekskul.pramuka');
Route::get('/ekstrakurikuler/paskibra', [EkskulController::class, 'paskibra'])->name('ekskul.paskibra');
Route::get('/ekstrakurikuler/marchingband', [EkskulController::class, 'marchingband'])->name('ekskul.marchingband');
Route::get('/ekstrakurikuler/jepang', [EkskulController::class, 'jepang'])->name('ekskul.jepang');

// ==========================
// Login
// ==========================
Route::get('/login', [AdminMagicLoginController::class, 'showRequestForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================
// Login Admin lewat Email (Magic Link)
// ==========================
Route::get('/admin/login-link', [AdminMagicLoginController::class, 'showRequestForm'])
    ->name('admin.magic-login.request');

Route::post('/admin/login-link', [AdminMagicLoginController::class, 'sendLink'])
    ->name('admin.magic-login.send');

Route::get('/admin/login-link/{user}', [AdminMagicLoginController::class, 'login'])
    ->middleware('signed')
    ->name('admin.magic-login');

// ==========================
// Dashboard / Panel Admin
// ==========================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'level:admin'])->group(function () {

    // Halaman utama admin: "Kelola Semua Data" (resources/views/admin/admin.blade.php)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

   // ---- Profil Sekolah (data tunggal) ----
Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    // ---- Beranda / Tentang Kami (data tunggal) ----
    Route::put('/beranda', [BerandaController::class, 'update'])->name('beranda.update');

    // ---- Jurusan ----
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    // ---- Guru & Staff ----
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::put('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // ---- Ekstrakurikuler ----
    Route::post('/ekskul', [EkstrakurikulerController::class, 'store'])->name('ekskul.store');
    Route::put('/ekskul/{ekskul}', [EkstrakurikulerController::class, 'update'])->name('ekskul.update');
    Route::delete('/ekskul/{ekskul}', [EkstrakurikulerController::class, 'destroy'])->name('ekskul.destroy');

    // ---- Galeri Video ----
    Route::post('/galeri-video', [GaleriVideoController::class, 'store'])->name('galeri-video.store');
    Route::put('/galeri-video/{galeri_video}', [GaleriVideoController::class, 'update'])->name('galeri-video.update');
    Route::delete('/galeri-video/{galeri_video}', [GaleriVideoController::class, 'destroy'])->name('galeri-video.destroy');

    // ---- Fasilitas ----
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::put('/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

    // ---- Artikel ----
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // ---- Agenda ----
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::put('/agenda/{agenda}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AgendaController::class, 'destroy'])->name('agenda.destroy');

    // ---- Prestasi ----
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('/prestasi/{prestasi}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{prestasi}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});