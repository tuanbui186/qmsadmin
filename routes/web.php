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
    return redirect('login');
});
Auth::routes(); 
// Route::group(['middleware' => ['auth']], function() {
//employee
    Route::get('/employee-manager',['as'=>'getEmployeeManager','uses'=>'EmployeeController@index']);
    Route::get('/get-stores',['as'=>'getStore','uses'=>'EmployeeController@getStore']);
    Route::get('/get-all-employee',['as'=>'getAllEmployee','uses'=>'EmployeeController@getAllEmployee']);
    Route::get('/show-all-employee/{id}',['as'=>'showAllEmployee','uses'=>'EmployeeController@showAllEmployee']);
    Route::get('/employeeattendance',['as'=>'getEmployeeAttendance','uses'=>'EmployeeController@employeeAttendance']);
    Route::get('/get-chart-average-score',['as'=>'getChartAverageScore','uses'=>'EmployeeController@getChartAverageScore']);
    Route::get('/get-attendance-employee',['as'=>'getAttendanceEmployee','uses'=>'Employeecontroller@getAttendanceEmployee']);
    Route::get('/get-info-employee',['as'=>'getInfoEmployee','uses'=>'EmployeeController@getInfoEmployee']);
    Route::get('/get-store',['as'=>'getStore','uses'=>'EmployeeController@getStore']);
    Route::post('/add-employee', ['as'=>'addEmployee','uses'=>'EmployeeController@addEmployee']);
	Route::post('/add-image-employee', ['as'=>'addImageEmployee','uses'=>'EmployeeController@addImageEmployee']);
    Route::post('/del-employee', ['as'=>'delEmployee','uses'=>'EmployeeController@delEmployee']);
    Route::post('/edit-employee', ['as'=>'editEmployee','uses'=>'EmployeeController@editEmployee']);
    Route::get('/get-mark-employee', ['as'=>'getMarkEmployee','uses'=>'EmployeeController@getMarkEmployee']);

    //end employee

    //employee detail
    Route::get('/summary/{id}',['as'=>'getSummaryEmployee','uses'=>'EmployeeController@getSummaryEmployee']);

    Route::get('/account-manager/{id}',['as'=>'getAccountManager','uses'=>'EmployeeController@getAccountManager']);

    Route::get('/get-data-account-manager',['as'=>'getDataAccountManager','uses'=>'EmployeeController@getDataAccountManager']);

    Route::get('/transaction/{id}',['as'=>'transaction','uses'=>'EmployeeController@getTransaction']);

    Route::get('/get-data-transaction-employee',['as'=>'getDataTransactionEmployee','uses'=>'EmployeeController@getDataTransaction']);
    
    Route::get('/rating/{id}',['as'=>'getRating','uses'=>'EmployeeController@getRating']);

    Route::get('/get-data-rating',['as'=>'getDataRating','uses'=>'EmployeeController@getDataRating']);

    Route::get('/time-working/{id}',['as'=>'getTimeWorking','uses'=>'EmployeeController@getTimeWorking']);

    Route::get('/get-data-time-working',['as'=>'getDataTimeWorking','uses'=>'EmployeeController@getDataTimeWorking']);

    //Customer
    Route::get('/customer',['as'=>'customer','uses'=>'CustomerController@index']);
    Route::get('/get-customer',['as'=>'getCustomer','uses'=>'CustomerController@getCustomer']);
    Route::post('/add-customer', ['as'=>'addCustomer','uses'=>'CustomerController@addCustomer']);
    Route::get('/access-right', function () {
        return view('accessright');
    });

    Route::get('/status-trans', function () {
        return view('statustrans');
    });

    // Route::get('/summary', function (){
    //     return view('employee.detail.summary');
    // });

    Route::get('/test', function() {
        return view('test');
    });

        // Route::get('login', 'AuthController@getLogin');
        // Route::post('login', 'AuthController@postLogin');
        // Route::get('register', 'AuthController@getRegister');
        // Route::post('register', 'AuthController@postRegister');
        // Route::get('logout', 'AuthController@getLoggi theout');
    //Dashboard    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/count-transaction',['as'=>'countTransaction','uses'=>'HomeController@countTransaction']);
    Route::get('/count-fail-transaction',['as'=>'countFailTransaction','uses'=>'HomeController@countFailTransaction']);
    Route::get('/get-average-timeout',['as'=>'getAverageTimeout','uses'=>'HomeController@getAverageTimeout']);
    Route::get('/get-average-score',['as'=>'getAverageScore','uses'=>'HomeController@getAverageScore']);
    Route::get('/get-vote',['as'=>'getVote','uses'=>'HomeController@getVote']);
    Route::get('/get-average-service-time',['as'=>'getAverageServiceTime','uses'=>'HomeController@getAverageServiceTime']);
    //Chart of Dashboard
    Route::get('/get-time-service-chart',['as'=>'getTimeServiceChart','uses'=>'HomeController@getTimeServiceChart']);
    Route::get('/get-ratio-circle-chart',['as'=>'getRatioCircleChart','uses'=>'HomeController@getRatioCircleChart']);

    ////MANAGEMENT/////
    Route::get('/trans-counters',['as'=>'TransCounters','uses'=>'Management\TransactionCounterController@index']);
    Route::get('/get-all-trans-counters',['as'=>'getAllTransactionCounters','uses'=>'Management\TransactionCounterController@getAllTransactionCounters']);
    Route::get('/get-transaction-counter',['as'=>'getTransactionCounter','uses'=>'Management\TransactionCounterController@getTransactionCounter']);
    Route::post('/add-transaction-counter',['as'=>'addTransactionCounter','uses'=>'Management\TransactionCounterController@addTransactionCounter']);
    Route::post('/del-transaction-counter',['as'=>'delTransactionCounter','uses'=>'Management\TransactionCounterController@delTransactionCounter']);
    Route::post('/edit-transaction-counter',['as'=>'editTransactionCounter','uses'=>'Management\TransactionCounterController@editTransactionCounter']);

    Route::get('/devices',['as'=>'TransCounters','uses'=>'Management\DevicesController@index']);
    Route::get('/get-all-devices',['as'=>'getAllDevices','uses'=>'Management\DevicesController@getAllDevices']);
    Route::get('/get-device',['as'=>'getDevice','uses'=>'Management\DevicesController@getDevice']);
    Route::post('/add-device',['as'=>'addDevice','uses'=>'Management\DevicesController@addDevice']);
    Route::post('/del-device',['as'=>'delDevice','uses'=>'Management\DevicesController@delDevice']);
    Route::post('/edit-device',['as'=>'editDevice','uses'=>'Management\DevicesController@editDevice']);

    Route::get('/get-stores-manager',['as'=>'getStoresManager','uses'=>'Management\StoresController@index']);
    Route::get('/get-all-stores', ['as'=>'getAllStores','uses'=>'Management\StoresController@getAllStores']);
    Route::get('/get-store',['as'=>'getStore','uses'=>'Management\StoresController@getStore']);
    Route::post('/add-store',['as'=>'addStore','uses'=>'Management\StoresController@addStore']);
    Route::post('/edit-image-store',['as'=>'editImageStore','uses'=>'Management\StoresController@editImageStore']);
    Route::post('/del-store',['as'=>'delStore','uses'=>'Management\StoresController@delStore']);
    Route::post('/edit-store',['as'=>'editTransacedit-transaction-countertionPoint','uses'=>'Management\StoresController@editStore']);
    Route::get('/get-district',['as'=>'getDistrict','uses'=>'Management\StoresController@getDistrict']);
    //Config
    Route::get('/service-config',['as'=>'ServiceConfig','uses'=>'ServiceConfigController@index']);
    Route::get('/show-services',['as'=>'showServices','uses'=>'ServiceConfigController@showServices']);
    Route::post('/add-service-of-store',['as'=>'addServiceOfStore','uses'=>'ServiceConfigController@addServiceOfStore']);
    Route::post('/create-service',['as'=>'createService','uses'=>'ServiceConfigController@createService']);
    Route::post('/create-service-of-store',['as'=>'createServiceOfStore','uses'=>'ServiceConfigController@createServiceOfStore']);
    Route::post('/del-service',['as'=>'deleteService','uses'=>'ServiceConfigController@deleteService']);
    Route::post('/del-service-of-store',['as'=>'deleteServiceOfStore','uses'=>'ServiceConfigController@deleteServiceOfStore']);
    Route::get('/get-service',['as'=>'getService','uses'=>'ServiceConfigController@getService']);
    Route::post('/edit-service',['as'=>'editService','uses'=>'ServiceConfigController@editService']);
    Route::post('/edit-image-service',['as'=>'editImageService','uses'=>'ServiceConfigController@editImageService']);
    Route::get('/get-service-not-in-store',['as'=>'getServiceNotInStore','uses'=>'ServiceConfigController@getServiceNotInStore']);
    Route::get('/get-service-of-store',['as'=>'getServiceOfStore','uses'=>'ServiceConfigController@getServiceOfStore']);

    Route::get('/main-screen',['as'=>'getMainScreen','uses'=>'Config\MainScreenController@index']);

    //statistical
    Route::get('/statistical/transaction',['as'=>'getStatisticalTransaction','uses'=>'Statistical\TransactionController@index']);
    Route::get('/statistical/get-transactions',['as'=>'getTransactions','uses'=>'Statistical\TransactionController@getTransactions']);
    Route::get('/statistical/search-transactions',['as'=>'searchTransactions','uses'=>'Statistical\TransactionController@searchTransactions']);    

    Route::get('/statistical/rating',['as'=>'getStatisticalRating','uses'=>'Statistical\RatingController@index']);
    Route::get('/statistical/get-rating',['as'=>'getRating','uses'=>'Statistical\RatingController@getRating']);

    Route::get('/queue',['as'=>'getQueue','uses'=>'QueueController@index']);
    Route::get('/get-queue',['as'=>'getQueue','uses'=>'QueueController@getQueue']);
    Route::get('/developing', function () {
        return view('developing');
    });
// });
