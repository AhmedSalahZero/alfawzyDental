<?php

use App\Http\Controllers\Admin\{AuthController,
    HomeController,

};
use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::get('login', [AuthController::class, 'loginView'])->name('admin.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('admin.postLogin');

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'admin']
    ], function() {


    Route::group([ 'middleware' => 'admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.index');
        Route::get('calender', [HomeController::class, 'calender'])->name('admin.calender');

        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        ### admins

        Route::resource('admins', \App\Http\Controllers\Admin\AdminController::class);
        Route::get('activateAdmin', [App\Http\Controllers\Admin\AdminController::class, 'activate'])->name('admin.active.admin');


        ### faqQuestion

        Route::resource('faq_questions', \App\Http\Controllers\Admin\FaqQuestionController::class);


        ### Reviews ####

        Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);

        ### patients ###


        Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class);


        ### authors ###

        Route::resource('authors', \App\Http\Controllers\Admin\AuthorController::class);

        ###  BlogCategories ###

        Route::resource('blogCategories', \App\Http\Controllers\Admin\BlogCategoryController::class);

        ### Blogs ###


        Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);



        ###  ServiceCategories ###

        Route::resource('serviceCategories', \App\Http\Controllers\Admin\ServiceCategoryController::class);

        ### Services ###


        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);


        ### Galleries ###

        Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);


        ### Contacts ###


        Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class);


        ### Settings ###

        Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);


        ### Partners ###

        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);


        ### Category Members ####


        Route::resource('categoryMembers', \App\Http\Controllers\Admin\CategoryMemberController::class);
        Route::get('activateCategoryMembers', [App\Http\Controllers\Admin\CategoryMemberController::class, 'activate'])->name('admin.active.categoryMembers');


        ### members ###

        Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);

        ### about Us ###

        Route::resource('about_us', \App\Http\Controllers\Admin\AboutUsController::class);


        ### dental Tourism ####

        Route::resource('dental_tourism', \App\Http\Controllers\Admin\DentalTourismController::class);

        ### Dental Tourism Rows ###

        Route::resource('dental_tourism_rows', \App\Http\Controllers\Admin\DentalTourismRowController::class);


    });

});
