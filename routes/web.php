<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\ManajemenController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KepsekController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SdgController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guru\ProjectController as GuruProjectController;
use App\Http\Controllers\Guru\RubricController as GuruRubricController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\LmsController;
use App\Http\Controllers\Guru\LmsController as GuruLmsController;
use App\Http\Controllers\Admin\LmsContentController;
use App\Http\Controllers\Siswa\ProjectController as SiswaProjectController;
use App\Http\Controllers\Guru\EnrollmentController;
use App\Http\Controllers\Guru\LmsContentController as GuruLmsContentController;
use App\Http\Controllers\Siswa\LmsController as SiswaLmsController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Siswa\QuizController as SiswaQuizController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Kepsek\DashboardController as KepsekDashboardController;

Route::redirect('/', '/login');
Route::redirect('/register', '/login');


Route::get('/home', function () {
    $role = Auth::user()->role->name; // Mengambil nama role dari user yang login

    if ($role == 'guru') {
        // Jika guru, arahkan ke dashboard guru
        // Asumsi Anda memiliki route bernama 'guru.dashboard'
        return redirect()->route('guru.dashboard');
    } elseif ($role == 'siswa') {
        // Jika siswa, arahkan ke dashboard siswa yang baru
        return redirect()->route('siswa.dashboard');
    } elseif ($role == 'kepsek') {
        // Jika kepala sekolah, arahkan ke dashboard kepsek
        return redirect()->route('kepsek.dashboard');
    }elseif ($role == 'admin') {
        // Jika admin, arahkan ke dashboard admin
        return redirect()->route('admin.manajemen.index');}

    // Arahkan ke halaman utama jika tidak ada role yang cocok
    return redirect('/');

})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:is-kepsek'])->prefix('kepsek')->name('kepsek.')->group(function () {
    Route::get('/dashboard', [KepsekDashboardController::class, 'index'])->name('dashboard');

});

// Grup route untuk Administrator
Route::middleware(['auth', 'can:is-admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/manajemen', [ManajemenController::class, 'index'])->name('manajemen.index');
        Route::resource('kelas', KelasController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('sdg', SdgController::class);
        Route::resource('kepsek', KepsekController::class);
        Route::resource('proyek', ProjectController::class);
        Route::post('/siswa/reset-kelas', [SiswaController::class, 'resetAllKelas'])->name('siswa.resetAllKelas');
        Route::resource('subject', SubjectController::class);
        Route::resource('lms', LmsController::class);
        Route::resource('lms-content', \App\Http\Controllers\Admin\LmsContentController::class);
        Route::post('/lms-content/update-order', [LmsContentController::class, 'updateOrder'])->name('lms-content.updateOrder');
        Route::post('/siswa/{user}/toggle-status', [\App\Http\Controllers\Admin\SiswaController::class, 'toggleStatus'])->name('siswa.toggleStatus');
    });
});
// Grup route untuk Kepala Sekolah (Menggunakan middleware is-kepsek)

Route::middleware(['auth', 'can:is-guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');

    //=================================================
    // == MANAJEMEN PROYEK & PENILAIAN
    //=================================================
    Route::prefix('proyek')->name('proyek.')->group(function () {
        // Rute untuk menampilkan form penilaian
        Route::get('/{proyek}/nilai/{enrollment}', [GuruProjectController::class, 'showGradingForm'])->name('grading.show');

        // Rute untuk menyimpan data nilai
        Route::post('/{proyek}/nilai/{enrollment}', [GuruProjectController::class, 'storeGrades'])->name('grading.store');

        // Rute untuk melihat hasil nilai yang sudah disimpan
        Route::get('/{proyek}/nilai/{enrollment}/show', [GuruProjectController::class, 'showGrades'])->name('grading.result');

        // Rute untuk meminta revisi dari siswa
        Route::patch('/revisi/{enrollment}', [GuruProjectController::class, 'requestRevision'])->name('grading.requestRevision');
    });

    // Resource Controller untuk CRUD Proyek utama (index, create, store, show, edit, update, destroy)
    Route::resource('proyek', GuruProjectController::class);


    //=================================================
    // == MANAJEMEN PENDAFTARAN (ENROLLMENT)
    //=================================================
    Route::prefix('enrollment')->name('enrollment.')->group(function () {
        Route::post('/{enrollment}/approve', [EnrollmentController::class, 'approve'])->name('approve');
        Route::post('/{enrollment}/reject', [EnrollmentController::class, 'reject'])->name('reject');
        Route::delete('/{enrollment}', [EnrollmentController::class, 'destroy'])->name('destroy');
    });


    //=================================================
    // == MANAJEMEN RUBRIK
    //=================================================
    Route::prefix('rubrik')->name('rubrik.')->group(function () {
        // Halaman utama untuk melihat semua rubrik
        Route::get('/', [GuruRubricController::class, 'index'])->name('index');

        // Grup untuk Rubrik Proyek
        Route::prefix('proyek')->name('proyek.')->group(function () {
            Route::get('/create', [GuruRubricController::class, 'createProjectRubric'])->name('create');
            Route::post('/store', [GuruRubricController::class, 'storeProjectRubric'])->name('store');
            Route::get('/{rubric}/edit', [GuruRubricController::class, 'editProjectRubric'])->name('edit');
            Route::put('/{rubric}', [GuruRubricController::class, 'updateProjectRubric'])->name('update');
            Route::delete('/{rubric}', [GuruRubricController::class, 'destroyProjectRubric'])->name('destroy');
        });

        // Grup untuk Rubrik SDG
        Route::prefix('sdg')->name('sdg.')->group(function () {
            Route::get('/create', [GuruRubricController::class, 'createSdgRubric'])->name('create');
            Route::post('/', [GuruRubricController::class, 'storeSdgRubric'])->name('store');
            Route::get('/proyek/{project}/edit', [GuruRubricController::class, 'editSdgRubric'])->name('edit');
            Route::put('/proyek/{project}', [GuruRubricController::class, 'updateSdgRubric'])->name('update');

            // Rute khusus untuk menghapus semua rubrik SDG dalam satu proyek
            Route::delete('/proyek/{project}', [GuruRubricController::class, 'destroySdgRubricsByProject'])->name('destroy-by-project');
        });
    });

    Route::resource('lms', GuruLmsController::class);
    Route::post('lms-content', [GuruLmsContentController::class, 'store'])->name('lms-content.store');
    Route::put('lms-content/{lmsContent}', [GuruLmsContentController::class, 'update'])->name('lms-content.update');
    Route::delete('lms-content/{lmsContent}', [GuruLmsContentController::class, 'destroy'])->name('lms-content.destroy');
    Route::post('lms-content/update-order', [GuruLmsContentController::class, 'updateOrder'])->name('lms-content.updateOrder');
    Route::resource('quiz', GuruQuizController::class);
    // Route untuk menyimpan pertanyaan baru ke sebuah kuis
    Route::post('/quiz/{quiz}/questions', [GuruQuizController::class, 'storeQuestion'])->name('quiz.questions.store');

    // Route untuk menghapus pertanyaan dari sebuah kuis
    Route::delete('/questions/{question}', [GuruQuizController::class, 'destroyQuestion'])->name('quiz.questions.destroy');
    Route::get('/questions/{question}/edit', [GuruQuizController::class, 'editQuestion'])->name('quiz.questions.edit');
    Route::put('/questions/{question}', [GuruQuizController::class, 'updateQuestion'])->name('quiz.questions.update');
    Route::get('/quiz/{quiz}/analytics', [GuruQuizController::class, 'showAnalytics'])->name('quiz.analytics');


});

Route::middleware(['auth', 'can:is-siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    // --- Rute Proyek ---
    Route::get('/proyek', [SiswaProjectController::class, 'index'])->name('proyek.index');
    Route::get('/proyek/{project}', [SiswaProjectController::class, 'show'])->name('proyek.show');
    Route::post('/proyek/{project}/daftar', [SiswaProjectController::class, 'enroll'])->name('proyek.enroll');
    Route::get('/proyek-saya', [SiswaProjectController::class, 'myProjects'])->name('proyek.myProjects');
    Route::get('/proyek-saya/{enrollment}/submit', [SiswaProjectController::class, 'submitFinalProject'])->name('proyek.submit');
    Route::post('/proyek-saya/{enrollment}/submit', [SiswaProjectController::class, 'storeFinalProject'])->name('proyek.storeSubmission');

    // --- Rute LMS ---
    Route::get('/lms', [SiswaLmsController::class, 'index'])->name('lms.index');
    Route::get('/lms/{lmsMaterial}', [SiswaLmsController::class, 'show'])->name('lms.show');
    Route::get('/lms/content/{lmsContent}', [SiswaLmsController::class, 'showContent'])->name('lms.content.show');
    Route::post('/lms/content/{lmsContent}/complete', [SiswaLmsController::class, 'markAsComplete'])->name('lms.content.complete');
    Route::post('/lms/content/{lmsContent}/complete-and-next', [SiswaLmsController::class, 'completeAndNext'])->name('lms.content.completeAndNext');
    Route::get('/lms-tersimpan', [SiswaLmsController::class, 'showBookmarks'])->name('lms.bookmarks');
    Route::post('/lms/{lmsMaterial}/bookmark', [SiswaLmsController::class, 'toggleBookmark'])->name('lms.bookmark.toggle');

    // --- Rute Kuis ---
    Route::prefix('kuis')->name('quiz.')->group(function () {
        Route::get('/', [SiswaQuizController::class, 'index'])->name('index');
        Route::get('/{quiz}/mulai', [SiswaQuizController::class, 'start'])->name('start');
        Route::post('/{quiz}/kerjakan', [SiswaQuizController::class, 'processStart'])->name('processStart');
        Route::get('/attempt/{attempt}', [SiswaQuizController::class, 'take'])->name('take');
        // PERBAIKAN: Method dan nama route yang kosong sudah diisi
        Route::post('/attempt/{attempt}/submit', [SiswaQuizController::class, 'submit'])->name('submit');
        Route::get('/attempt/{attempt}/hasil', [SiswaQuizController::class, 'result'])->name('result');
    });
});

require __DIR__.'/auth.php';
