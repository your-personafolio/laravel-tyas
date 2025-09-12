<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\AContactController;
use App\Http\Controllers\Admin\ASkillController;
use App\Http\Controllers\Admin\AHomeController;
use App\Http\Controllers\Admin\ACertificateController;
use App\Http\Controllers\Admin\AProjectsController;
use App\Http\Controllers\Admin\AAboutController;
use App\Http\Controllers\Admin\AMessageController;

// Route untuk halaman umum (user-facing)
Route::get('/', [AboutController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/', [AMessageController::class, 'store'])->name('admin.message.store');


// Route untuk admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware('admin')->name('admin.dashboard');

    // Route untuk Home
    Route::prefix('home')->group(function () {
        Route::get('/', [AHomeController::class, 'index'])->name('admin.home');
        Route::get('/create', [AHomeController::class, 'create'])->name('admin.home.create');
        Route::post('/', [AHomeController::class, 'store'])->name('admin.home.store');
        Route::delete('/{id}', [AHomeController::class, 'destroy'])->name('admin.home.destroy');
        Route::get('/edit/{id}', [AHomeController::class, 'edit'])->name('admin.home.edit');
        Route::put('/update/{id}', [AHomeController::class, 'update'])->name('admin.home.update');
        Route::get('/data', [AHomeController::class, 'data'])->name('admin.home.data');
        Route::get('/{id}', [AHomeController::class, 'show'])->name('admin.home.show');
    });

    // Route untuk Skills
    Route::prefix('skills')->group(function () {
        Route::get('/', [ASkillController::class, 'index'])->name('admin.skills');
        Route::get('/create', [ASkillController::class, 'create'])->name('admin.skills.create');
        Route::post('/', [ASkillController::class, 'store'])->name('admin.skills.store');
        Route::delete('/{id}', [ASkillController::class, 'destroy'])->name('admin.skills.destroy');
        Route::get('/edit/{id}', [ASkillController::class, 'edit'])->name('admin.skills.edit');
        Route::put('/update/{id}', [ASkillController::class, 'update'])->name('admin.skills.update');
    });

    // Route untuk Certificates
    Route::prefix('certificate')->group(function () {
        Route::get('/', [ACertificateController::class, 'index'])->name('admin.certificate');
        Route::get('/data', [ACertificateController::class, 'getData'])->name('admin.certificate.data'); 
        Route::get('/create', [ACertificateController::class, 'create'])->name('admin.certificate.create');
        Route::post('/', [ACertificateController::class, 'store'])->name('admin.certificate.store');
        Route::delete('/{id}', [ACertificateController::class, 'destroy'])->name('admin.certificate.destroy');
        Route::get('/edit/{id}', [ACertificateController::class, 'edit'])->name('admin.certificate.edit');
        Route::put('/update/{id}', [ACertificateController::class, 'update'])->name('admin.certificate.update');
        Route::get('/{id}', [ACertificateController::class, 'show'])->name('admin.certificate.show');
    });

    // Route untuk Projects
    Route::prefix('project')->group(function () {
        Route::get('/', [AProjectsController::class, 'index'])->name('admin.project');
        Route::get('/data', [AProjectsController::class, 'getProjects'])->name('admin.project.data');
        Route::get('/create', [AProjectsController::class, 'create'])->name('admin.project.create');
        Route::post('/', [AProjectsController::class, 'store'])->name('admin.project.store');
        Route::get('/edit/{id}', [AProjectsController::class, 'edit'])->name('admin.project.edit');
        Route::put('/update/{id}', [AProjectsController::class, 'update'])->name('admin.project.update');
        Route::delete('/{id}', [AProjectsController::class, 'destroy'])->name('admin.project.destroy');
    });
    
    // Route untuk About
    Route::prefix('about')->group(function () {
        Route::get('/home', [AboutController::class, 'home'])->name('home');
        Route::get('/', [AAboutController::class, 'index'])->name('admin.about');
        Route::get('/data', [AAboutController::class, 'getAbouts'])->name('admin.about.data');
        Route::get('/create', [AAboutController::class, 'create'])->name('admin.about.create');
        Route::post('/', [AAboutController::class, 'store'])->name('admin.about.store');
        Route::get('/edit/{id}', [AAboutController::class, 'edit'])->name('admin.about.edit');
        Route::put('/update/{id}', [AAboutController::class, 'update'])->name('admin.about.update');
        Route::delete('/{id}', [AAboutController::class, 'destroy'])->name('admin.about.destroy');
        Route::get('/{id}', [AAboutController::class, 'show'])->name('admin.about.show');
    });
    
    
    // Route untuk Contact
    Route::prefix('contact')->group(function () {
        Route::get('/', [AContactController::class, 'index'])->name('admin.contact');
        Route::get('/data', [AContactController::class, 'getContacts'])->name('admin.contact.data');
        Route::get('/create', [AContactController::class, 'create'])->name('admin.contact.create');
        Route::post('/', [AContactController::class, 'store'])->name('admin.contact.store');
        Route::get('/edit/{id}', [AContactController::class, 'edit'])->name('admin.contact.edit');
        Route::put('/update/{id}', [AContactController::class, 'update'])->name('admin.contact.update');
        Route::delete('/{id}', [AContactController::class, 'destroy'])->name('admin.contact.destroy');
    });

    Route::prefix('message')->group(function () {
        Route::get('/', [AMessageController::class, 'index'])->name('admin.message'); // Menampilkan pesan
        Route::get('/data', [AMessageController::class, 'getMessage'])->name('admin.message.data'); // Ganti getMessages menjadi getMessage
        Route::get('/create', [AMessageController::class, 'create'])->name('admin.message.create'); // Form untuk membuat pesan
        Route::get('/edit/{id}', [AMessageController::class, 'edit'])->name('admin.message.edit'); // Edit pesan
        Route::put('/update/{id}', [AMessageController::class, 'update'])->name('admin.message.update'); // Update pesan
        Route::delete('/{id}', [AMessageController::class, 'destroy'])->name('admin.message.destroy'); // Menghapus pesan
    });
    

});

require __DIR__ . '/auth.php';
