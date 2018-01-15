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

Route::get('/', function () {
    
    return redirect('/selectbranchandyear');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->middleware('revalidate');
Route::get('/home/changepassword', 'ChangePasswordController@show')->middleware('revalidate');
Route::post('/home/changepassword', 'ChangePasswordController@validatepassword')->middleware('revalidate');

//SWICTH ROUTES
Route::get('/selectbranchandyear','HomeController@selectbranchandyear')->middleware('revalidate');
Route::get('/switchbranchandyear','HomeController@switchbranchandyear')->middleware('revalidate');
Route::post('/setsession','HomeController@setsession')->middleware('revalidate');
Route::get('/home', 'HomeController@index')->name('home')->middleware('revalidate');

//USER ROUTES
Route::get('users','UsersController@index')->middleware('revalidate');
Route::get('users/create','UsersController@create')->middleware('revalidate');
Route::post('users/create','UsersController@store')->middleware('revalidate');
Route::get('users/{user}/edit','UsersController@edit')->middleware('revalidate'); 
Route::post('users/{user}/edit','UsersController@update')->middleware('revalidate');
Route::get('users/{user}/delete','UsersController@delete')->middleware('revalidate');

//ENQUIRY ROUTES
Route::get('enquiry','EnquiryController@index')->middleware('revalidate');
Route::get('enquiry/create','EnquiryController@create')->middleware('revalidate');
Route::post('enquiry/create','EnquiryController@store')->middleware('revalidate');
Route::get('enquiry/{enquiry}/edit','EnquiryController@edit')->middleware('revalidate'); 
Route::patch('enquiry/{enquiry}/edit','EnquiryController@update')->middleware('revalidate');
Route::get('enquiry/{enquiry}/delete','EnquiryController@delete')->middleware('revalidate'); 
Route::get('enquiry/filters','EnquiryController@filters')->middleware('revalidate'); 
Route::get('enquiry/search','EnquiryController@search')->middleware('revalidate');


//AJAX ROUTES
Route::get('ajax/orientation/{enquiry}','OrientationController@view')->middleware('revalidate'); 
Route::post('ajax/orientation/{enquiry}','OrientationController@add')->middleware('revalidate'); 
Route::get('ajax/admission/{standard}/{branch}/{fromyear}/{toyear}','AdmissionController@standard')->middleware('revalidate'); 
Route::get('ajax/admissionbatch/{batch}/{standard}/{branch}/{fromyear}/{toyear}','AdmissionController@batch')->middleware('revalidate'); 
Route::get('ajax/feecheck/{standard}/{fromyear}/{toyear}','AdmissionController@feecheck')->middleware('revalidate'); 
Route::get('ajax/admissionremedial/{standard}/{branch}/{fromyear}/{toyear}','AdmissionController@remedialbatch')->middleware('revalidate'); 

//ORIENTATION LIST
Route::get('orientation/list','OrientationController@index')->middleware('revalidate');
Route::get('orientation/filters','OrientationController@filters')->middleware('revalidate'); 
Route::get('orientation/search','OrientationController@search')->middleware('revalidate');

//ADMISSION ROUTES
Route::get('admission','AdmissionController@index')->middleware('revalidate');
Route::get('admission/create','AdmissionController@create')->middleware('revalidate');
Route::post('admission/create','AdmissionController@save')->middleware('revalidate');
Route::get('admission/{enquiry}/add','AdmissionController@createthroughenquiry')->middleware('revalidate');
Route::get('admission/{admission}/list','AdmissionController@list')->middleware('revalidate');
Route::get('admission/{admission}/edit','AdmissionController@edit')->middleware('revalidate');
Route::post('admission/{admission}/edit','AdmissionController@update')->middleware('revalidate');
Route::get('admission/{admission}/delete','AdmissionController@delete')->middleware('revalidate');
Route::get('admission/{admission}/report','AdmissionController@report')->middleware('revalidate');
Route::get('admission/filters','AdmissionController@filters')->middleware('revalidate'); 
Route::get('admission/{batch}/{standard}/search','AdmissionController@search')->middleware('revalidate');
Route::get('batch/{batch}/{standard}/admission','AdmissionController@admissionsview')->middleware('revalidate');


//ADMISSION TRANSFER
Route::get('admission/{admission}/transferadm','AdmissionController@transferadm')->middleware('revalidate');
Route::post('admission/{admission}/transferadm','AdmissionController@addtransfer')->middleware('revalidate');

//STUDENT ADM REMEDIAL BATCH DETAILS.
Route::get('admission/{admission}/remedialdetails','AdmissionController@remedialdetails')->middleware('revalidate');
Route::post('admission/{admission}/remedialdetails','AdmissionController@storeremedialdetails')->middleware('revalidate');

//BATCH ROUTES
Route::get('batch','BatchController@index')->middleware('revalidate');
Route::get('batch/create','BatchController@create')->middleware('revalidate');
Route::post('batch/create','BatchController@save')->middleware('revalidate');
Route::get('batch/{batch}/list','BatchController@list')->middleware('revalidate');
Route::get('batch/{batch}/edit','BatchController@edit')->middleware('revalidate');
Route::post('batch/{batch}/edit','BatchController@update')->middleware('revalidate');
Route::get('batch/{batch}/delete','BatchController@delete')->middleware('revalidate');
Route::get('batch/filters','BatchController@filters')->middleware('revalidate'); 
Route::get('batch/search','BatchController@search')->middleware('revalidate');

//FEE ROTES
Route::get('fee','FeeController@index')->middleware('revalidate');
Route::get('fee/create','FeeController@create')->middleware('revalidate');
Route::post('fee/create','FeeController@save')->middleware('revalidate');
Route::get('fee/{fee}/edit','FeeController@edit')->middleware('revalidate');
Route::post('fee/{fee}/edit','FeeController@update')->middleware('revalidate');
Route::get('fee/{fee}/delete','FeeController@delete')->middleware('revalidate');

//FEE ADD ROUTES
Route::get('admission/{admission}/{installment}/fee','AdmissionController@fee')->middleware('revalidate');
Route::post('admission/{admission}/{installment}/fee','AdmissionController@feeadd')->middleware('revalidate');

Route::get('admission/{admission}/{installment}/viewfeereceipt','AdmissionController@viewfeereceipt')->middleware('revalidate');
Route::get('admission/{admission}/{installment}/downloadreceipt','AdmissionController@downloadreceipt')->middleware('revalidate');
Route::get('admission/{admission}/{installment}/emailreceipt','AdmissionController@emailreceipt')->middleware('revalidate');

//TO-DO LIST

Route::get('todolist','TodolistController@index')->middleware('revalidate');
Route::get('todolist/create','TodolistController@create')->middleware('revalidate');
Route::post('todolist/create','TodolistController@store')->middleware('revalidate');
Route::get('todolist/{todolist}/edit','TodolistController@edit')->middleware('revalidate'); 
Route::patch('todolist/{todolist}/edit','TodolistController@update')->middleware('revalidate');
Route::get('todolist/{todolist}/delete','TodolistController@delete')->middleware('revalidate'); 
Route::get('todolist/filters','TodolistController@filters')->middleware('revalidate'); 
Route::get('todolist/search','TodolistController@search')->middleware('revalidate');

//EXPORT TEMPLATE
Route::get('export/create','ExportController@create')->middleware('revalidate');
Route::post('export/create','ExportController@export')->middleware('revalidate');




//PARENTS MEET
Route::get('parentsmeet','ParentsmeetController@index')->middleware('revalidate');
Route::get('parentsmeet/create','ParentsmeetController@create')->middleware('revalidate');
Route::post('parentsmeet/create','ParentsmeetController@store')->middleware('revalidate');
Route::get('parentsmeet/{parentsmeet}/edit','ParentsmeetController@edit')->middleware('revalidate'); 
Route::patch('parentsmeet/{parentsmeet}/edit','ParentsmeetController@update')->middleware('revalidate');
Route::get('parentsmeet/{parentsmeet}/delete','ParentsmeetController@delete')->middleware('revalidate'); 
Route::get('parentsmeet/filters','ParentsmeetController@filters')->middleware('revalidate'); 
Route::get('parentsmeet/search','ParentsmeetController@search')->middleware('revalidate');



//MARKS ROUTES
Route::get('marks/create','MarksController@batchlist')->middleware('revalidate');
Route::get('marks/{batch}/{standard}/newmarks','MarksController@createmarks')->middleware('revalidate');
Route::post('marks/{batch}/{standard}/newmarks','MarksController@addmarks')->middleware('revalidate');
Route::get('marks/{batch}/{standard}/listmarks','MarksController@listmarks')->middleware('revalidate');
Route::get('marks/{batch}/{standard}/summaryreport','MarksController@viewreport')->middleware('revalidate');
Route::get('marks/{marks}/{batch}/{standard}/editmarks','MarksController@editmarks')->middleware('revalidate');
Route::post('marks/{marks}/{batch}/{standard}/editmarks','MarksController@updatemarks')->middleware('revalidate');
Route::get('marks/{marks}/{batch}/{standard}/deletemarks','MarksController@deletemarks')->middleware('revalidate');
Route::get('marks/{batch}/{standard}/search','MarksController@search')->middleware('revalidate');
Route::get('marks/{marks}/{batch}/{standard}/addstudentmarks','MarksController@addstudentmarks')->middleware('revalidate');
Route::post('marks/{marks}/{batch}/{standard}/addstudentmarks','MarksController@storestudentmarks')->middleware('revalidate');
Route::get('marks/{marks}/{batch}/{standard}/liststudentmarks','MarksController@liststudentmarks')->middleware('revalidate');
Route::get('marks/{marks}/{batch}/{standard}/filters','MarksController@marks_filters')->middleware('revalidate');


//SCHOOL MARKS ROUTES
Route::get('schoolmarks/create','SchoolMarksController@batchlist')->middleware('revalidate');
Route::get('schoolmarks/{batch}/{standard}/newmarks','SchoolMarksController@createmarks')->middleware('revalidate');
Route::post('schoolmarks/{batch}/{standard}/newmarks','SchoolMarksController@addmarks')->middleware('revalidate');
Route::get('schoolmarks/{batch}/{standard}/listmarks','SchoolMarksController@listmarks')->middleware('revalidate');
Route::get('schoolmarks/{batch}/{standard}/summaryreport','SchoolMarksController@viewreport')->middleware('revalidate');
Route::get('schoolmarks/{marks}/{batch}/{standard}/editmarks','SchoolMarksController@editmarks')->middleware('revalidate');
Route::post('schoolmarks/{marks}/{batch}/{standard}/editmarks','SchoolMarksController@updatemarks')->middleware('revalidate');
Route::get('schoolmarks/{marks}/{batch}/{standard}/deletemarks','SchoolMarksController@deletemarks')->middleware('revalidate');
Route::get('schoolmarks/{batch}/{standard}/search','SchoolMarksController@search')->middleware('revalidate');

Route::get('schoolmarks/{marks}/{batch}/{standard}/addstudentmarks','SchoolMarksController@addstudentmarks')->middleware('revalidate');
Route::post('schoolmarks/{marks}/{batch}/{standard}/addstudentmarks','SchoolMarksController@storestudentmarks')->middleware('revalidate');

Route::get('schoolmarks/{marks}/{batch}/{standard}/liststudentmarks','SchoolMarksController@liststudentmarks')->middleware('revalidate');
Route::get('schoolmarks/{marks}/{batch}/{standard}/filters','SchoolMarksController@marks_filters')->middleware('revalidate');



//ATTENDACE ROUTES
Route::get('attendance/create','AttendanceController@batchlist')->middleware('revalidate');
Route::get('attendance/{batch}/{standard}/newattendance','AttendanceController@createattendance')->middleware('revalidate');
Route::post('attendance/{batch}/{standard}/newattendance','AttendanceController@addattendance')->middleware('revalidate');
Route::get('attendance/{batch}/{standard}/listattendance','AttendanceController@listattendance')->middleware('revalidate');
Route::get('attendance/{batch}/{standard}/summaryreport','AttendanceController@viewreport')->middleware('revalidate');
Route::get('attendance/{attendances}/{batch}/{standard}/editattendance','AttendanceController@editattendance')->middleware('revalidate');
Route::post('attendance/{attendances}/{batch}/{standard}/editattendance','AttendanceController@updateattendance')->middleware('revalidate');
Route::get('attendance/{attendances}/{batch}/{standard}/deleteattendance','AttendanceController@deleteattendance')->middleware('revalidate');
Route::get('attendance/{batch}/{standard}/search','AttendanceController@search')->middleware('revalidate');

Route::get('attendance/{attendances}/{batch}/{standard}/addstudentattendance','AttendanceController@addstudentattendance')->middleware('revalidate');
Route::post('attendance/{attendances}/{batch}/{standard}/addstudentattendance','AttendanceController@storestudentattendance')->middleware('revalidate');

Route::get('attendance/{attendances}/{batch}/{standard}/liststudentattendance','AttendanceController@liststudentattendance')->middleware('revalidate');


//WAITING LIST ROUTES.
Route::get('ajax/waiting_list/{enquiry}/{check}','WaitingListController@waiting_list')->middleware('revalidate');
Route::get('waiting_list/list','WaitingListController@view')->middleware('revalidate');
Route::get('waiting_list/filters','WaitingListController@filters')->middleware('revalidate'); 
Route::get('waiting_list/search','WaitingListController@search')->middleware('revalidate');


//TESTSCHEDULER ROUTES
Route::get('testscheduler','TestSchedulerController@index')->middleware('revalidate');
Route::get('testscheduler/create','TestSchedulerController@create')->middleware('revalidate');
Route::post('testscheduler/create','TestSchedulerController@store')->middleware('revalidate');
Route::get('testscheduler/{testscheduler}/edit','TestSchedulerController@edit')->middleware('revalidate'); 
Route::patch('testscheduler/{testscheduler}/edit','TestSchedulerController@update')->middleware('revalidate');
Route::get('testscheduler/{testscheduler}/delete','TestSchedulerController@delete')->middleware('revalidate'); 
Route::get('testscheduler/filters','TestSchedulerController@filters')->middleware('revalidate'); 
Route::get('testscheduler/search','TestSchedulerController@search')->middleware('revalidate');


//REMEDIAL ROUTES
Route::get('ajax/remedial_list/{admission}/{check}','RemedialBatchController@remedial_list')->middleware('revalidate');


//REMEDIAL BATCH ROUTES
Route::get('remedialbatch','RemedialBatchController@index')->middleware('revalidate');
Route::get('remedialbatch/create','RemedialBatchController@create')->middleware('revalidate');
Route::post('remedialbatch/create','RemedialBatchController@save')->middleware('revalidate');
Route::get('remedialbatch/{batch}/list','RemedialBatchController@list')->middleware('revalidate');
Route::get('remedialbatch/{batch}/edit','RemedialBatchController@edit')->middleware('revalidate');
Route::post('remedialbatch/{batch}/edit','RemedialBatchController@update')->middleware('revalidate');
Route::get('remedialbatch/{batch}/delete','RemedialBatchController@delete')->middleware('revalidate');
Route::get('remedialbatch/filters','RemedialBatchController@filters')->middleware('revalidate'); 
Route::get('remedialbatch/search','RemedialBatchController@search')->middleware('revalidate');

Route::get('remedial/create','RemedialController@batchlist')->middleware('revalidate');
Route::get('remedial/{batch}/{standard}/newattendance','RemedialController@createattendance')->middleware('revalidate');
Route::post('remedial/{batch}/{standard}/newattendance','RemedialController@addattendance')->middleware('revalidate');
Route::get('remedial/{batch}/{standard}/listattendance','RemedialController@listattendance')->middleware('revalidate');
Route::get('remedial/{batch}/{standard}/summaryreport','RemedialController@viewreport')->middleware('revalidate');
Route::get('remedial/{attendances}/{batch}/{standard}/editattendance','RemedialController@editattendance')->middleware('revalidate');
Route::post('remedial/{attendances}/{batch}/{standard}/editattendance','RemedialController@updateattendance')->middleware('revalidate');
Route::get('remedial/{attendances}/{batch}/{standard}/deleteattendance','RemedialController@deleteattendance')->middleware('revalidate');
Route::get('remedial/{batch}/{standard}/search','RemedialController@search')->middleware('revalidate');

Route::get('remedial/{attendances}/{batch}/{standard}/addstudentattendance','RemedialController@addstudentattendance')->middleware('revalidate');
Route::post('remedial/{attendances}/{batch}/{standard}/addstudentattendance','RemedialController@storestudentattendance')->middleware('revalidate');

Route::get('remedial/{attendances}/{batch}/{standard}/liststudentattendance','RemedialController@liststudentattendance')->middleware('revalidate');