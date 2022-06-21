<?php
// if (!env('DISABLE_WEBSITE')) {
//     Route::get('/', 'HomeController@index')->name('homepage');
// } else {
//     Route::get('/', 'Auth\LoginController@showLoginForm')->name('homepage');
// }
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('pricing', 'HomeController@pricing')->name('pricing');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::post('contact', 'HomeController@handle_email_query')->name('handle_email_query');
Route::get('instant-quote', 'OrderController@quote')->name('instant_quote');
Route::get('faq', 'HomeController@content')->name('faq');
Route::get('how-it-works', 'HomeController@content')->name('how_it_works');
Route::get('privacy-policy', 'HomeController@content')->name('privacy_policy');
Route::get('revision-policy', 'HomeController@content')->name('revision_policy');
Route::get('disclaimer', 'HomeController@content')->name('disclaimer');
Route::get('terms-and-conditions', 'HomeController@content')->name('terms_and_conditions');
Route::get('money-back-guarantee', 'HomeController@content')->name('money_back_guarantee');
Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.xml');


Route::get('online-class', 'PagesController@class')->name('online_class_page');
Route::get('online-class/{page:slug}', 'PagesController@classPages')->name('class_page_sub');

Route::get('exams', 'PagesController@exam')->name('exam_page');
Route::get('exams/{page:slug}', 'PagesController@examPages')->name('exam_page_sub');
Route::get('homework', 'PagesController@homework')->name('homework_page');
Route::get('homework/{page:slug}', 'PagesController@homeworkPages')->name('homework_page_sub');

Route::get('assignment', 'PagesController@assignment')->name('assignment_page');
Route::get('assignment/{page:slug}', 'PagesController@assignmentPages')->name('assignment_page_sub');
Route::get('essay-writing', 'PagesController@essay')->name('essay_writing_page');
Route::get('tools', 'PagesController@tools')->name('tools');
Route::get('blogs', 'PagesController@blogs')->name('blogs');

Route::get('contact-us', 'PagesController@contacts')->name('contact_page');
Route::get('about-us', 'PagesController@about')->name('about_page');
