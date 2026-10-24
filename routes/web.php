<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CommitteeController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\TrustController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\LiveDarshanController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\RoomBookingController;
use App\Http\Controllers\Frontend\ContactController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationManagerController;
use App\Http\Controllers\Admin\BookingManagerController;
use App\Http\Controllers\Admin\CommitteeManagerController;
use App\Http\Controllers\Admin\GalleryManagerController;
use App\Http\Controllers\Admin\BlogManagerController;
use App\Http\Controllers\Admin\AartiManagerController;
use App\Http\Controllers\Admin\LiveDarshanManagerController;
use App\Http\Controllers\Admin\TrustActivityManagerController;
use App\Http\Controllers\Admin\ContactInquiryManagerController;
use App\Http\Controllers\Admin\AboutManagerController;
use App\Http\Controllers\Admin\SliderManagerController;

/*
|--------------------------------------------------------------------------
| 1. LANGUAGE SWITCHER ROUTE (ગુજરાતી / English)
|--------------------------------------------------------------------------
*/
Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['gu', 'en'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| 2. PUBLIC WEBSITE ROUTES (Dynamic Frontend)
|--------------------------------------------------------------------------
*/
// 1. Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. About & Committees
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/committee', [CommitteeController::class, 'trust'])->name('committee.trust');
Route::get('/committee/gam', [CommitteeController::class, 'gam'])->name('committee.gam');

// 3. Photo & Video Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// 4. Trust & Seva Activities
Route::get('/trust', [TrustController::class, 'index'])->name('trust');

// 5. News / Events Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// 6. Live Darshan
Route::get('/live-darshan', [LiveDarshanController::class, 'index'])->name('live.darshan');

// 7. Contact Us
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// 8. E-Donation
Route::get('/donation', [DonationController::class, 'index'])->name('donation');
Route::post('/donation', [DonationController::class, 'submit'])->name('donation.submit');
Route::redirect('/rooms', '/contact')->name('rooms');
Route::redirect('/rooms/book', '/contact')->name('rooms.submit');

/*
|--------------------------------------------------------------------------
| 3. ADMIN PANEL MANAGEMENT ROUTES (Full Dynamic CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // 1. Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // 2. Donations Management
    Route::get('/donations', [DonationManagerController::class, 'index'])->name('donations.index');
    Route::put('/donations/{id}', [DonationManagerController::class, 'update'])->name('donations.update');
    Route::delete('/donations/{id}', [DonationManagerController::class, 'destroy'])->name('donations.destroy');

    // 3. Room Bookings Management (Disabled / Redirected to Dashboard)
    Route::redirect('/bookings', '/admin/dashboard')->name('bookings.index');

    // 4. Committee Members Management
    Route::get('/committees', [CommitteeManagerController::class, 'index'])->name('committees.index');
    Route::post('/committees', [CommitteeManagerController::class, 'store'])->name('committees.store');
    Route::put('/committees/{id}', [CommitteeManagerController::class, 'update'])->name('committees.update');
    Route::delete('/committees/{id}', [CommitteeManagerController::class, 'destroy'])->name('committees.destroy');

    // 5. Gallery Items Management
    Route::get('/gallery', [GalleryManagerController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryManagerController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{id}', [GalleryManagerController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryManagerController::class, 'destroy'])->name('gallery.destroy');

    // 6. Blog / News Management
    Route::get('/blogs', [BlogManagerController::class, 'index'])->name('blogs.index');
    Route::post('/blogs', [BlogManagerController::class, 'store'])->name('blogs.store');
    Route::put('/blogs/{id}', [BlogManagerController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogManagerController::class, 'destroy'])->name('blogs.destroy');

    // 7. Aarti Timings Management (Home & Aarti)
    Route::get('/aarti', [AartiManagerController::class, 'index'])->name('aarti.index');
    Route::post('/aarti', [AartiManagerController::class, 'store'])->name('aarti.store');
    Route::put('/aarti/{id}', [AartiManagerController::class, 'update'])->name('aarti.update');
    Route::delete('/aarti/{id}', [AartiManagerController::class, 'destroy'])->name('aarti.destroy');

    // 8. Trust Activities Management (Annakshetra, Gaushala, Medical)
    Route::get('/trust', [TrustActivityManagerController::class, 'index'])->name('trust.index');
    Route::post('/trust', [TrustActivityManagerController::class, 'store'])->name('trust.store');
    Route::put('/trust/{id}', [TrustActivityManagerController::class, 'update'])->name('trust.update');
    Route::delete('/trust/{id}', [TrustActivityManagerController::class, 'destroy'])->name('trust.destroy');

    // 9. Contact Inquiries Management (Messages from Devotees)
    Route::get('/contacts', [ContactInquiryManagerController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{id}', [ContactInquiryManagerController::class, 'destroy'])->name('contacts.destroy');

    // 10. Live Darshan Settings
    Route::get('/live-darshan', [LiveDarshanManagerController::class, 'index'])->name('live-darshan.index');
    Route::post('/live-darshan', [LiveDarshanManagerController::class, 'update'])->name('live-darshan.update');

    // 11. About Us / Temple History Management
    Route::get('/about', [AboutManagerController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutManagerController::class, 'update'])->name('about.update');

    // 12. Hero Sliders Management
    Route::get('/sliders', [SliderManagerController::class, 'index'])->name('sliders.index');
    Route::post('/sliders', [SliderManagerController::class, 'store'])->name('sliders.store');
    Route::put('/sliders/{id}', [SliderManagerController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{id}', [SliderManagerController::class, 'destroy'])->name('sliders.destroy');
});
