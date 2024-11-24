<?php

use App\Http\Controllers\ChildrenGroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChildrenController;

Route::get('/', function () {
    return view('admin.login');
});
Route::group(['prefix'=> 'admin'], function () 
{
    Route::group(['middleware'=>'admin.guest'], function(){
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::get('register', [AdminController::class, 'register'])->name('admin.register');
        Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware'=> 'admin.auth'], function(){
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');
        Route::get('table', [AdminController::class, 'table'])->name('admin.table');

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
        Route::get('children/read/download/csf/{id}', [ChildrenController::class, 'downloadCsf'])->name('download.csf');
        Route::get('children/read/download/poe/{id}', [ChildrenController::class, 'downloadPoe'])->name('download.poe');
        Route::get('children/read/download/cof/{id}', [ChildrenController::class, 'downloadCof'])->name('download.cof');
        Route::get('children/read/download/cola/{id}', [ChildrenController::class, 'downloadCola'])->name('download.cola');
        Route::get('children/read/download/cfsc/{id}', [ChildrenController::class, 'downloadCfsc'])->name('download.cfsc');
        Route::get('children/read/download/bc/{id}', [ChildrenController::class, 'downloadBc'])->name('download.bc');
        Route::get('children/read/download/ap/{id}', [ChildrenController::class, 'downloadAdmissionPhoto'])->name('download.admission_photo');
        Route::get('children/read/download/lp/{id}', [ChildrenController::class, 'downloadLatestPhoto'])->name('download.latest_photo');
        Route::put('children/archive/{id}', [ChildrenController::class, 'destroy'])->name('children.destroy');
    });
});