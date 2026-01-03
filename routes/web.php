<?php

use App\Http\Controllers\ChildrenGroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\CourtAppointmentController;
use App\Http\Controllers\MedicalAppointmentController;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return view('staff.login');
});
Route::group(['prefix'=>'staff'], function(){
    Route::group(['middleware'=>'staff.guest'], function(){
        Route::get('login', [UserController::class,'staffIndex'])->name('staff.login');
        Route::post('authenticate', [UserController::class,'staffAuthenticate'])->name('staff.authenticate');
        // Route::get('login/redirect', function() {
        //     return redirect(route('staff.login'));
        // })->name('login');
    });
    Route::group(['middleware'=>'auth'], function(){
        Route::get('dashboard', [UserController::class,'staffDashboard'])->name('staff.dashboard');
        Route::get('logout', [UserController::class,'staffLogout'])->name('staff.logout');
        Route::get('change-password', [UserController::class, 'staffChangePassword'])->name('staff.change-password');
        Route::post('update-password', [UserController::class, 'staffUpdatePassword'])->name('staff.update-password');

        //Children Group Routes
        Route::get('children-group/create', [ChildrenGroupController::class, 'headCGindex'])->name('head.children-group.create');
        Route::post('children-group/store', [ChildrenGroupController::class, 'headCGstore'])->name('head.children-group.store');
        Route::get('children-group/read', [ChildrenGroupController::class, 'headCGread'])->name('head.children-group.read');
        Route::get('children-group/delete/{id}', [ChildrenGroupController::class, 'headCGdelete'])->name('head.children-group.delete');
        Route::get('children-group/edit/{id}', [ChildrenGroupController::class, 'headCGedit'])->name('head.children-group.edit');
        Route::get('children-group/show/{id}', [ChildrenGroupController::class, 'show'])->name('head.children-group.show');
        Route::put('children-group/update/{id}', [ChildrenGroupController::class, 'headCGupdate'])->name('head.children-group.update');

         //Children Routes
         Route::get('children/edit/{id}', [ChildrenController::class, 'staffEdit'])->name('staff.children.edit');
         Route::get('children/show/{id}', [ChildrenController::class, 'staffShow'])->name('staff.children.show');
         Route::put('children/update/{id}', [ChildrenController::class, 'staffUpdate'])->name('staff.children.update');
         Route::put('children/archive/{id}', [ChildrenController::class, 'headArchive'])->name('head.children.archive');
         Route::get('children/read', [ChildrenController::class, 'staffRead'])->name('staff.children.read');
         Route::get('children/read/{id}', [ChildrenController::class, 'staffGroupRead'])->name('staff.children.group-read');
         Route::get('children/archives', [ChildrenController::class, 'headArchives'])->name('head.children.archives');
         Route::get('children/read/download/csf/{id}', [ChildrenController::class, 'downloadCsf'])->name('staff.download.csf');
         Route::get('children/read/download/poe/{id}', [ChildrenController::class, 'downloadPoe'])->name('staff.download.poe');
         Route::get('children/read/download/cof/{id}', [ChildrenController::class, 'downloadCof'])->name('staff.download.cof');
         Route::get('children/read/download/cola/{id}', [ChildrenController::class, 'downloadCola'])->name('staff.download.cola');
         Route::get('children/read/download/cfsc/{id}', [ChildrenController::class, 'downloadCfsc'])->name('staff.download.cfsc');
         Route::get('children/read/download/bc/{id}', [ChildrenController::class, 'downloadBc'])->name('staff.download.bc');
         Route::get('children/read/download/ap/{id}', [ChildrenController::class, 'downloadAdmissionPhoto'])->name('staff.download.admission_photo');
         Route::get('children/read/download/lp/{id}', [ChildrenController::class, 'downloadLatestPhoto'])->name('staff.download.latest_photo');

        //Appointment Routes
        Route::get('appointments/create', [MedicalAppointmentController::class, 'staffAcreate'])->name('staff.appointments.create');
        Route::post('appointments/store', [MedicalAppointmentController::class, 'staffAstore'])->name('staff.appointments.store');
        Route::get('appointments/read', [MedicalAppointmentController::class, 'staffAread'])->name('staff.appointments.read');
        Route::put('appointments/delete/{id}', [MedicalAppointmentController::class, 'staffAdelete'])->name('staff.appointments.destroy');
        Route::get('appointments/edit/{id}', [MedicalAppointmentController::class, 'staffAedit'])->name('staff.appointments.edit');
        Route::get('appointments/show/{id}', [MedicalAppointmentController::class, 'staffAshow'])->name('staff.appointments.show');
        Route::put('appointments/update/{id}', [MedicalAppointmentController::class, 'staffAupdate'])->name('staff.appointments.update');

        //Logs Routes
        Route::get('logs/{id}/create', [LogController::class, 'staffLcreate'])->name('staff.logs.create');
        Route::post('logs/store', [LogController::class, 'staffLstore'])->name('staff.logs.store');
        Route::get('logs/{id}/list', [LogController::class, 'staffLindex'])->name('staff.logs.index');
        Route::delete('logs/delete/{id}', [LogController::class, 'staffLdelete'])->name('staff.logs.delete');
        Route::get('logs/edit/{id}', [LogController::class, 'staffLedit'])->name('staff.logs.edit');
        Route::put('logs/update/{id}', [LogController::class, 'staffLupdate'])->name('staff.logs.update');
    });
});

Route::group(['prefix'=>'head'], function(){
    Route::group(['middleware'=>'guest'], function(){
        Route::get('login', [UserController::class,'headIndex'])->name('head.login');
        Route::post('authenticate', [UserController::class,'headAuthenticate'])->name('head.authenticate');
        Route::get('login/redirect', function() {
            return redirect(route('head.login'));
        })->name('login');
    });
    Route::group(['middleware'=>'auth'], function(){
        Route::get('dashboard', [UserController::class,'headDashboard'])->name('head.dashboard');
        Route::get('logout', [UserController::class,'headLogout'])->name('head.logout');
        Route::get('change-password', [UserController::class, 'changePassword'])->name('head.change-password');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('head.update-password');

        //Children Group Routes
        Route::get('children-group/create', [ChildrenGroupController::class, 'headCGindex'])->name('head.children-group.create');
        Route::post('children-group/store', [ChildrenGroupController::class, 'headCGstore'])->name('head.children-group.store');
        Route::get('children-group/read', [ChildrenGroupController::class, 'headCGread'])->name('head.children-group.read');
        Route::get('children-group/delete/{id}', [ChildrenGroupController::class, 'headCGdelete'])->name('head.children-group.delete');
        Route::get('children-group/edit/{id}', [ChildrenGroupController::class, 'headCGedit'])->name('head.children-group.edit');
        Route::get('children-group/show/{id}', [ChildrenGroupController::class, 'show'])->name('head.children-group.show');
        Route::put('children-group/update/{id}', [ChildrenGroupController::class, 'headCGupdate'])->name('head.children-group.update');

         //Children Routes
         Route::get('children/create', [ChildrenController::class, 'headIndex'])->name('head.children.create');
         Route::post('children/store', [ChildrenController::class, 'headStore'])->name('head.children.store');
         Route::get('children/edit/{id}', [ChildrenController::class, 'headEdit'])->name('head.children.edit');
         Route::get('children/show/{id}', [ChildrenController::class, 'headShow'])->name('head.children.show');
         Route::put('children/update/{id}', [ChildrenController::class, 'headUpdate'])->name('head.children.update');
         Route::put('children/archive/{id}', [ChildrenController::class, 'headArchive'])->name('head.children.archive');
         Route::get('children/read', [ChildrenController::class, 'headRead'])->name('head.children.read');
         Route::get('children/archives', [ChildrenController::class, 'headArchives'])->name('head.children.archives');
         Route::get('children/read/download/csf/{id}', [ChildrenController::class, 'downloadCsf'])->name('head.download.csf');
         Route::get('children/read/download/poe/{id}', [ChildrenController::class, 'downloadPoe'])->name('head.download.poe');
         Route::get('children/read/download/cof/{id}', [ChildrenController::class, 'downloadCof'])->name('head.download.cof');
         Route::get('children/read/download/cola/{id}', [ChildrenController::class, 'downloadCola'])->name('head.download.cola');
         Route::get('children/read/download/cfsc/{id}', [ChildrenController::class, 'downloadCfsc'])->name('head.download.cfsc');
         Route::get('children/read/download/bc/{id}', [ChildrenController::class, 'downloadBc'])->name('head.download.bc');
         Route::get('children/read/download/ap/{id}', [ChildrenController::class, 'downloadAdmissionPhoto'])->name('head.download.admission_photo');
         Route::get('children/read/download/lp/{id}', [ChildrenController::class, 'downloadLatestPhoto'])->name('head.download.latest_photo');
         Route::put('children/archive/{id}', [ChildrenController::class, 'headDestroy'])->name('head.children.destroy');
         Route::put('children/unarchive/{id}', [ChildrenController::class, 'headUnarchive'])->name('head.children.unarchive');

        //Court Appointment Routes
        Route::get('appointments/create', [CourtAppointmentController::class, 'headAindex'])->name('head.appointments.create');
        Route::post('appointments/store', [CourtAppointmentController::class, 'headAstore'])->name('head.appointments.store');
        Route::get('appointments/read', [CourtAppointmentController::class, 'headAread'])->name('head.appointments.read');
        Route::put('appointments/delete/{id}', [CourtAppointmentController::class, 'headAdelete'])->name('head.appointments.destroy');
        Route::get('appointments/edit/{id}', [CourtAppointmentController::class, 'headAedit'])->name('head.appointments.edit');
        Route::get('appointments/show/{id}', [CourtAppointmentController::class, 'headAshow'])->name('head.appointments.show');
        Route::put('appointments/update/{id}', [CourtAppointmentController::class, 'headAupdate'])->name('head.appointments.update');

        //Logs Routes
        Route::get('logs/{id}/create', [LogController::class, 'headLcreate'])->name('head.logs.create');
        Route::post('logs/store', [LogController::class, 'headLstore'])->name('head.logs.store');
        Route::get('logs/{id}/list', [LogController::class, 'headLindex'])->name('head.logs.index');
        Route::delete('logs/delete/{id}', [LogController::class, 'headLdelete'])->name('head.logs.delete');
        Route::get('logs/edit/{id}', [LogController::class, 'headLedit'])->name('head.logs.edit');
        Route::put('logs/update/{id}', [LogController::class, 'headLupdate'])->name('head.logs.update');
    });
});

Route::group(['prefix'=> 'admin'], function ()
{
    Route::group(['middleware'=>'admin.guest'], function(){
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate')->middleware('web');
    });

    Route::group(['middleware'=> 'admin.auth'], function(){
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');
        Route::get('table', [AdminController::class, 'table'])->name('admin.table');
        Route::get('change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
        Route::post('update-password', [AdminController::class, 'updatePassword'])->name('admin.update-password');
        // /Route::get('admin/chart' , [UserController::class, 'userChart'])->name('admin.chart');


        //User Routes
        Route::get('users/archives' , [UserController::class, 'archives'])->name('users.archives');
        Route::put('users/archive/{id}' , [UserController::class, 'archive'])->name('users.archive');
        Route::put('users/unarchive/{id}' , [UserController::class, 'unarchive'])->name('users.unarchive');
        Route::resource('users', UserController::class);
        Route::get('users' , [UserController::class, 'read'])->name('users.read');
        //Route::get('users/chart' , [UserController::class, 'userChart'])->name('users.chart');

        //Children Group Routes
        Route::get('children-group/create', [ChildrenGroupController::class, 'index'])->name('children-group.create');
        Route::post('children-group/store', [ChildrenGroupController::class, 'store'])->name('children-group.store');
        Route::get('children-group/read', [ChildrenGroupController::class, 'read'])->name('children-group.read');
        Route::get('children-group/delete/{id}', [ChildrenGroupController::class, 'delete'])->name('children-group.delete');
        Route::get('children-group/edit/{id}', [ChildrenGroupController::class, 'edit'])->name('children-group.edit');
        Route::put('children-group/update/{id}', [ChildrenGroupController::class, 'update'])->name('children-group.update');

        //Children Routes
        Route::get('children/create', [ChildrenController::class, 'index'])->name('children.create');
        Route::post('children/store', [ChildrenController::class, 'store'])->name('children.store');
        Route::get('children/edit/{id}', [ChildrenController::class, 'edit'])->name('children.edit');
        Route::put('children/update/{id}', [ChildrenController::class, 'update'])->name('children.update');
        Route::put('children/archive/{id}', [ChildrenController::class, 'archive'])->name('children.archive');
        Route::get('children/read', [ChildrenController::class, 'read'])->name('children.read');
        Route::get('children/archives', [ChildrenController::class, 'archives'])->name('children.archives');
        Route::get('children/read/download/csf/{id}', [ChildrenController::class, 'downloadCsf'])->name('download.csf');
        Route::get('children/read/download/poe/{id}', [ChildrenController::class, 'downloadPoe'])->name('download.poe');
        Route::get('children/read/download/cof/{id}', [ChildrenController::class, 'downloadCof'])->name('download.cof');
        Route::get('children/read/download/cola/{id}', [ChildrenController::class, 'downloadCola'])->name('download.cola');
        Route::get('children/read/download/cfsc/{id}', [ChildrenController::class, 'downloadCfsc'])->name('download.cfsc');
        Route::get('children/read/download/bc/{id}', [ChildrenController::class, 'downloadBc'])->name('download.bc');
        Route::get('children/read/download/ap/{id}', [ChildrenController::class, 'downloadAdmissionPhoto'])->name('download.admission_photo');
        Route::get('children/read/download/lp/{id}', [ChildrenController::class, 'downloadLatestPhoto'])->name('download.latest_photo');
        Route::put('children/archive/{id}', [ChildrenController::class, 'destroy'])->name('children.destroy');
        Route::put('children/unarchive/{id}', [ChildrenController::class, 'unarchive'])->name('children.unarchive');

        //Court Appointment Routes
        Route::resource('court-appointments', CourtAppointmentController::class);

        //Medical Appointment Routes
        Route::resource('medical-appointments', MedicalAppointmentController::class);
        //Logs Routes
        Route::resource('logs', LogController::class);
    });
});
