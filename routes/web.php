<?php
use Illuminate\Foundation\Application;
use App\Models\Tour;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SaleController;

Route::post('/sales', [SaleController::class, 'store']);

Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

Route::get('/tour-images/{tourId}', [TourImageController::class, 'getImages']);
/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

Route::get('/', function (){
    return Inertia::render('HomePage');
});

Route::get('/cart', function (){
    return Inertia::render('Cart');
});

Route::get('/tours', function (){
    return Inertia::render('Tours');
});

Route::get('/tours/{slug}', function ($slug) {
    $tour = App\Models\Tour::where('route', "tours/{$slug}")->firstOrFail();
    return Inertia::render('Ejemplo', ['tour' => $tour]);
});

Route::get('/open-payment', function (){
    return Inertia::render('OpenPayment');
});

Route::get('/reviews-&-comments', function (){
    return Inertia::render('Reviews');
});

Route::get('/contact', function (){
    return Inertia::render('Contact');
});

/*Route::get('/mayan-experience', function (){
    return Inertia::render('MayanExperience');
});

Route::get('/xtreme-snorkel-vip', function (){
    return Inertia::render('XtremeSnorkelVIP');
});

Route::get('/xtreme-snorkel-shared', function (){
    return Inertia::render('XtremeSnorkelShared');
});

Route::get('/xtreme-snorkel-private', function (){
    return Inertia::render('XtremeSnorkelPrivate');
});

Route::get('/sunrise-snorkeling', function (){
    return Inertia::render('SunriseSnorkeling');
});

Route::get('/shark-tour', function (){
    return Inertia::render('SharkTour');
});

Route::get('/shark-tour-pcrm', function (){
    return Inertia::render('SharkTourPCRM');
});

Route::get('/shark-tour-cancun', function (){
    return Inertia::render('SharkCancun');
});

Route::get('/shark-tour-im', function (){
    return Inertia::render('SharkIM');
});

Route::get('/deep-sea-fishing', function (){
    return Inertia::render('DeepSea');
});

Route::get('/local-fishing', function (){
    return Inertia::render('LocalFishing');
});

Route::get('/bottom-fishing', function (){
    return Inertia::render('BottomFishing');
});

Route::get('/fishing-snorkeling-tour', function (){
    return Inertia::render('FishingSnorkeling');
});

Route::get('/sport-fishing', function (){
    return Inertia::render('SportFishing');
});

Route::get('/spear-fishing', function (){
    return Inertia::render('SpearFishing');
});

Route::get('/sailfish-experience', function (){
    return Inertia::render('Sailfish');
});

Route::get('/sunset-tour', function (){
    return Inertia::render('Sunset');
});

Route::get('/catamaran-tour', function (){
    return Inertia::render('Catamaran');
});

Route::get('/contoy-island', function (){
    return Inertia::render('Contoy');
});*/

require __DIR__.'/auth.php';
