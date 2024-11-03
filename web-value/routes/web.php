<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DataPriceController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminWebsiteController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TypeTrainingController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\TrainingMaterialController;
use App\Http\Controllers\ScheduleTrainingController;
use App\Http\Controllers\LogController;
use Barryvdh\DomPDF\Facade as PDF;



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('homepage', function () {
    return view('auth.login');
})->name('login');  

Route::post('homepage', [AuthController::class, 'login'])->name('login.post');
Route::get('homepage', [AuthController::class, 'showHomePage'])->name('homepage');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth', 'role:admin-website'])->group(function () {
    Route::get('/admin-website/dashboard', [AdminWebsiteController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-website/posts', [AdminWebsiteController::class, 'posts'])->name('admin.website.posts');
    Route::get('/admin-website/users', [AdminWebsiteController::class, 'users'])->name('admin.website.users');
    Route::get('/admin-website/information', [AdminWebsiteController::class, 'edit'])->name('admin.edit-profile'); // Perbaikan nama route
    Route::put('/admin-website/update-profile', [AdminWebsiteController::class, 'update'])->name('admin.update-profile'); // Perbaikan nama route

    Route::resource('trainers', TrainerController::class);
    Route::get('/admin/trainers', [TrainerController::class, 'index'])->name('admin.trainers.index');

    Route::resource('hotels', HotelController::class);
    Route::get('/admin/hotels', [HotelController::class, 'index'])->name('admin.hotels.index');

    Route::get('logs', [LogController::class, 'index'])->name('logs.index');
    Route::delete('/logs/delete-all', [LogController::class, 'deleteAll'])->name('logs.delete-all');

    Route::resource('/type_trainings', TypeTrainingController::class);

    Route::resource('categories', CategoryPostController::class);

    Route::get('certificates', [CertificateController::class, 'index'])->name('admin.certificates.index');
    Route::get('certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    Route::post('certificates', [CertificateController::class, 'store'])->name('admin.certificates.store');
    Route::get('certificates-detail/{id}', [CertificateController::class, 'show'])->name('admin.certificates.show');
    Route::delete('certificates/{id}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
    

    Route::resource('data-prices', DataPriceController::class);

    Route::get('training_materials', [AdminWebsiteController::class, 'indexMaterials'])->name('training_materials.index');

    Route::get('schedule', [ScheduleTrainingController::class, 'index'])->name('schedule.index');
    Route::get('schedule/create', [ScheduleTrainingController::class, 'create'])->name('schedule.create');
    Route::post('schedule/store', [ScheduleTrainingController::class, 'store'])->name('schedule.store');
    Route::get('api/data-prices/{trainerId}', [ScheduleTrainingController::class, 'getDataPrices']);
    Route::get('api/training-materials/{trainerId}', [ScheduleTrainingController::class, 'getTrainingMaterials']);
    Route::get('schedule/{schedule}', [ScheduleTrainingController::class, 'show'])->name('schedule.show');
    Route::get('schedule/{schedule}/edit', [ScheduleTrainingController::class, 'edit'])->name('schedule.edit');
    Route::put('schedule/{schedule}', [ScheduleTrainingController::class, 'update'])->name('schedule.update');
    Route::delete('schedule/{schedule}', [ScheduleTrainingController::class, 'destroy'])->name('schedule.destroy');

    Route::resource('manage-posts', AdminPostController::class);
    Route::get('api/dataPrices/{trainerId}', [AdminPostController::class, 'getDataprices']);
    Route::get('api/schedules/{trainerId}', [AdminPostController::class, 'getSchedules']);

    Route::get('/admin/trainings', [TrainingController::class, 'index'])->name('admin.trainings.index');
    Route::get('trainings/{post_id}', [TrainingController::class, 'show'])->name('admin.trainings.show');


    Route::resource('events', EventController::class);
    Route::get('events/{event}/participants', [EventController::class, 'show'])->name('events.participants');

    Route::get('admin/payment-methods', [PaymentController::class, 'indexPayment'])->name('admin.payment.index');
    Route::get('admin/payment-methods/create', [PaymentController::class, 'createPayment'])->name('admin.payment.create');
    Route::post('admin/payment-methods/store', [PaymentController::class, 'storePayment'])->name('admin.payment.store');
    Route::delete('admin/payment-methods/{id}', [PaymentController::class, 'deletePayment'])->name('admin.payment.delete');

    // Route::get('/admin/trainee-orders', [PaymentController::class, 'indexOrder'])->name('admin.transaction.list');
    // Route::get('/orders/{id}', [PaymentController::class, 'showOrder'])->name('admin.orders.show');

    // Route untuk admin melihat dan mengelola order post
    Route::get('/admin/orders/posts', [PaymentController::class, 'indexPostOrders'])->name('admin.orders.posts');
    Route::put('/admin/orders/posts/{order}', [PaymentController::class, 'updatePostOrderStatus'])->name('admin.order.post.updateStatus');

    // Route untuk admin melihat dan mengelola order event
    Route::get('/admin/orders/events', [PaymentController::class, 'indexEventOrders'])->name('admin.orders.events');
    Route::put('/admin/orders/events/{order}', [PaymentController::class, 'updateEventOrderStatus'])->name('admin.order.event.updateStatus');

    Route::get('admin/evaluations', [EvaluationController::class, 'index'])->name('admin.evaluation.index');
    Route::get('/admin/evaluation-trainee/{id}', [EvaluationController::class, 'show'])->name('admin.evaluation.show');
    Route::get('admin/evaluation/create', [EvaluationController::class, 'create'])->name('admin.evaluation.create');
    Route::post('admin/evaluation/store', [EvaluationController::class, 'store'])->name('admin.evaluation.store');
    Route::get('/evaluation/{id}/download', [EvaluationController::class, 'downloadPdf'])->name('evaluation.downloadPdf');    

    Route::get('/admin/payments', [PaymentController::class, 'indexAllPayments'])->name('admin.payments.index');
    Route::get('/payments', [PaymentController::class, 'indexAllPayments'])->name('payments.index');
});

Route::middleware('auth:trainer')->group(function () {
    Route::get('trainer/dashboard', [TrainerController::class, 'dashboard'])->name('trainer.dashboard');
    Route::get('send-materials', [TrainingMaterialController::class, 'createMaterials'])->name('send_materials.create');
    Route::post('send-materials', [TrainingMaterialController::class, 'storeMaterials'])->name('training_materials.store');
    Route::get('my-materials', [TrainingMaterialController::class, 'myMaterials'])->name('trainer.send_materials.index');
    Route::get('posts/trainer', [TrainerController::class, 'indexPost'])->name('trainer.posts.index');
});

Route::middleware('auth:trainee')->group(function () {
    Route::get('trainee/dashboard', [TraineeController::class, 'dashboard'])->name('trainee.dashboard');
    Route::get('/certificates/download/{id}', [TraineeController::class, 'downloadCertificate'])->name('trainee.certificates.download');
    Route::get('trainee/edit-profile', [TraineeController::class, 'editProfile'])->name('trainee.edit-profile');
    Route::post('trainee/update-profile', [TraineeController::class, 'updateProfile'])->name('trainee.update-profile');
    Route::post('trainee/delete-account', [TraineeController::class, 'deleteAccount'])->name('trainee.delete-account');
    
    // Menggunakan TraineeController untuk menampilkan postingan
    // Route::get('posts', [TraineeController::class, 'index'])->name('trainee.posts.index');
    Route::get('/posts', [TrainingController::class, 'indexPost'])->name('trainee.posts.index');
    Route::get('posts/{postId}', [TrainingController::class, 'showPost'])->name('posts.show');
    Route::post('posts/{post}/register', [TraineeController::class, 'register'])->name('trainee.posts.register');
    Route::post('posts/{postId}/register', [TrainingController::class, 'registerPost'])->name('trainee.register');
    Route::delete('posts/{postId}/unregister', [TrainingController::class, 'unregisterPost'])->name('trainee.unregister');
    Route::get('/evaluasi-form', [TrainingController::class, 'listUnregister'])->name('trainings.list');

    Route::get('trainee/events', [EventController::class, 'listEventsForTrainee'])->name('trainee.events.index');
    Route::get('trainee/events/{event}', [EventController::class, 'showEventDetail'])->name('trainee.events.show');
    Route::post('trainee/events/{event}/register', [EventController::class, 'register'])->name('trainee.events.register');
    Route::delete('trainee/events/{event}/unregister', [EventController::class, 'unregister'])->name('trainee.events.unregister');
    Route::get('trainee/my-events', [EventController::class, 'listMyEvents'])->name('trainee.my-events');

    // // Menampilkan daftar tagihan trainee
    // // Route::get('/trainee/orders', [PaymentController::class, 'listOrders'])->name('trainee.orders');

    // // Halaman pembayaran trainee untuk Post
    // Route::get('/trainee/payment/post/{orderId}', [PaymentController::class, 'showPaymentPost'])->name('trainee.payment.post');
    // Route::post('/payment/process/{orderId}', [PaymentController::class, 'processPaymentPost'])->name('trainee.payment.process');

    // // Halaman pembayaran trainee untuk Event
    // Route::get('/trainee/payment/event/{orderId}', [PaymentController::class, 'showPaymentEvent'])->name('trainee.payment.event');
    // Route::post('/trainee/payment/event/{orderId}', [PaymentController::class, 'processPaymentEvent'])->name('trainee.payment.event.store');

    Route::get('/list-training', [PaymentController::class, 'index'])->name('trainee.orders.index');
    Route::get('/orders/{training}/payment', [PaymentController::class, 'showPaymentForm'])->name('trainee.payment.post');
    Route::post('/orders/{training}/payment', [PaymentController::class, 'storePaymentPost'])->name('trainee.payment.process');

    Route::get('/orders/{participantId}/create', [PaymentController::class, 'createPaymentEvent'])->name('trainee.order.create');
    Route::post('/orders/{participantId}/store', [PaymentController::class, 'storePaymentEvent'])->name('trainee.order.event.store');    

    Route::get('/evaluation/form/{id}', [EvaluationController::class, 'showEvaluationForm'])->name('evaluation.form');
    Route::post('/evaluation/form/{evaluationId}', [EvaluationController::class, 'storeEvaluation'])->name('evaluation.store');    

    Route::get('/evaluation/edit/{evaluationId}', [EvaluationController::class, 'editEvaluation'])->name('evaluation.edit');
    Route::put('/evaluation/update/{evaluationId}', [EvaluationController::class, 'updateEvaluation'])->name('evaluation.update');

    Route::get('feedback/form/{trainingId}', [EvaluationController::class, 'showFeedbackForm'])->name('feedback.form');
    Route::post('feedback/form/{trainingId}', [EvaluationController::class, 'storeFeedback'])->name('feedback.store');
});
