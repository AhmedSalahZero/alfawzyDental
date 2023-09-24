<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Frontend\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/en', [HomeController::class, 'index'])->name('home.index');
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/about', [HomeController::class, 'showAbout'])->name('web_about.index');
    Route::get('/services', [HomeController::class, 'showServices'])->name('web_services.index');
    Route::get('/service/{id}', [HomeController::class, 'showService'])->name('web_category_services.index');

    Route::get('/partners', [HomeController::class, 'showPartners'])->name('web_partners.index');

    Route::get('/contact-us', [HomeController::class, 'showContacts'])->name('web_contacts.index');
    Route::post('/contact-us/store', [HomeController::class, 'storeContacts'])->name('web_contacts.store');

    Route::get('/faq', [HomeController::class, 'showFaq'])->name('web_faq.index');
    Route::get('/dental-tourism', [HomeController::class, 'showDentalTourism'])->name('dental.tourism.index');
    Route::get('/gallery', [HomeController::class, 'showGallery'])->name('web_gallery.index');
    Route::get('/blogs', [HomeController::class, 'showBlogs'])->name('web_blogs.index');
    Route::get('/blog/{id}', [HomeController::class, 'showBlog'])->name('web_blog.index');

    Route::get('patientVideo/{id}',[HomeController::class, 'patientVideo'])->name('patientVideo');
    Route::get('patientImage',[HomeController::class, 'patientImage'])->name('patientImage');




});



