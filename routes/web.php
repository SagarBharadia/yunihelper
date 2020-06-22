<?php

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

Route::get('/', 'StaticPagesController@index')->name('home');
Route::get('/aboutus', 'StaticPagesController@aboutUs');
Route::get('/whyuseus', 'StaticPagesController@whyUseUs');
Route::get('/privacypolicy', 'StaticPagesController@privacyPolicy');
// Authentication Routes
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');
Route::get('/login', 'SessionController@create')->name('login');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');

// Confirm Email Routes
Route::get('/user/{user_id}/confirmEmail/{confirmationToken}', 'EmailConfirmationController@confirmEmail');

// Forgot/Reset Password Routes
Route::get('/forgotpassword', 'ForgotPasswordController@forgotPassword');
Route::post('/forgotpassword', 'ForgotPasswordController@forgotPasswordEmail');
Route::get('/resetpassword/{id}/{resetPasswordToken}', 'ForgotPasswordController@resetPasswordView');
Route::post('/resetpassword', 'ForgotPasswordController@resetPassword');

// Dashboard Routes
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Settings Routes
Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/profile/update', 'SettingsController@updateProfileSettings');

// Notes Routes
Route::get('/notes', 'NoteController@index')->name('notes');
Route::get('/notes/create', 'NoteController@create');
Route::post('/notes/store', 'NoteController@store');
Route::get('/notes/{note}', 'NoteController@show');
Route::get('/notes/{note}/edit', 'NoteController@edit');
Route::post('/notes/{note}/update', 'NoteController@update');
Route::get('/notes/{note}/delete', 'NoteController@destroy');

// Assignments Routes
Route::get('/assignments', 'AssignmentController@index')->name('assignments');
Route::get('/assignments/create', 'AssignmentController@create');
Route::post('/assignments/store', 'AssignmentController@store');
Route::get('/assignments/{assignment}', 'AssignmentController@show');
Route::get('/assignments/{assignment}/edit', 'AssignmentController@edit');
Route::post('/assignments/{assignment}/update', 'AssignmentController@update');
Route::get('/assignments/{assignment}/delete', 'AssignmentController@destroy');

// Finances Routes
Route::get('/finances', 'FinanceController@index')->name('finances');
Route::get('/finances/additem', 'FinanceController@create')->middleware(VerifyBalanceSet::class);
Route::post('/finances/storeitem', 'FinanceController@store');
Route::post('/finances/setbalance', 'FinanceController@setBalance');
Route::get('/finances/all', 'FinanceController@showAll')->middleware(VerifyBalanceSet::class);
Route::get('/finances/{finance}', 'FinanceController@show')->middleware(VerifyBalanceSet::class);
Route::get('/finances/{finance}/edit', 'FinanceController@edit')->middleware(VerifyBalanceSet::class);
Route::post('/finances/{finance}/update', 'FinanceController@update');
Route::get('/finances/{finance}/delete', 'FinanceController@destroy')->middleware(VerifyBalanceSet::class);

// Todo List Routes
Route::get('/todos', 'ToDoController@index')->name('todos');
Route::post('/todos/store', 'ToDoController@store');
Route::get('/todos/{toDo}/destroy', 'ToDoController@destroy');

// Feedback Routes
Route::get('/feedback', 'FeedbackController@index')->name('feedback');
Route::post('/feedback/store', 'FeedbackController@store');

// Photo by Sebas Ribas on Unsplash
// Photo by Omar Lopez on Unsplash
// Photo by Cole Keister on Unsplash


// Todo boolean show past todos boolean 0 1


