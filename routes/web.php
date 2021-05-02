<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix('/admin')->middleware(['auth','verified'])->group(function (){
    Route::get('/home', 'Admin\AdminController@index')->name('admin.home');

    /*Courses*/
    Route::get('/my-courses','Admin\CourseController@index')->name('admin.courses');
    Route::post('/add-course','Admin\CourseController@store')->name('course.store');
    Route::patch('/{id}/update-course','Admin\CourseController@update')->name('course.update');
    Route::delete('/{id}/delete-course','Admin\CourseController@destroy')->name('course.delete');
    Route::get('/course/{course_id}/addStudent','Admin\CourseController@addStudent')->name('course.students.add');
    Route::post('/course/store-student','Admin\CourseController@storeStudent')->name('store.student');
    Route::delete('/course/{id}/delete-student','Admin\CourseController@deleteStudent')->name('delete.student');

    /*Assignments Routes*/
    Route::group(['prefix'=>'assignments'],function (){
        Route::get('/','Admin\AssignmentController@index')->name('assignment.list');
        Route::get('/create','Admin\AssignmentController@create')->name('assignment.create');
        Route::post('/store','Admin\AssignmentController@store')->name('assignment.store');
        Route::get('/{id}/edit','Admin\AssignmentController@edit')->name('assignment.edit');
        Route::patch('/{id}/update','Admin\AssignmentController@update')->name('assignment.update');
        Route::delete('/{assignment}/delete','Admin\AssignmentController@destroy');

        //Routes for student marking
        Route::get('/{assignmentId}/students','Admin\MarkStudentsController@index')->name('assignment.students');
        Route::post('/store-marking','Admin\MarkStudentsController@storeMarking')->name('store.marking');
    });

});

