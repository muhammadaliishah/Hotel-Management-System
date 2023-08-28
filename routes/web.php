<?php

// use App\Http\Controllers\cms\CMSController;

use App\Http\Controllers\cmsArticalController;
use App\Http\Controllers\cmsBasicsettingsController;
use App\Http\Controllers\cmsBlogController;
use App\Http\Controllers\cmsCategoryController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\cmsEventController;
use App\Http\Controllers\cmsFooterController;
use App\Http\Controllers\cmsGalleryController;
use App\Http\Controllers\cmsNavbarController;
use App\Http\Controllers\cmsNewsController;
use App\Http\Controllers\cmsPageController;
use App\Http\Controllers\cmsTripsController;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\navbar;
use App\Models\sitesettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['namespace' => 'App\Http\Controllers'], function()
{   /**
     * Admin Routes
     */
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::post('/contact-submit', function (Request $request){

        $request->validate([
        "name" =>  'required' ,
        "email" =>  'required' ,
        "message" =>  'required'
    ]);


    ContactUs::create($request->all());

        return back()->with('contactmessage' , 'Message Sent SuccessFully');
    });

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         *
         */

        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::prefix('admin')->middleware('auth')->group(function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('products', ProductController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('productcategories', ProductCategoriesController::class);
        Route::resource('itemcategories', ItemCategoryController::class);
        Route::resource('storeitems', StoreItemController::class);
        Route::resource('vendors', VendorController::class);
        Route::resource('purchaseorders', PurchaseOrderController::class);
        Route::resource('pos', PosController::class);
        Route::resource('inventory', InventoryController::class);
        Route::resource('receiveditems', ReceivedItemController::class);
        Route::resource('consumeditems', ConsumedItemController::class);
        Route::resource('payroll', PayRollController::class);

        // cms controllers
        Route::resource('cms',CMSController::class);
        Route::resource('pages',cmsPageController::class);
        Route::resource('categories',cmsCategoryController::class);
        Route::resource('blog', cmsBlogController::class);
        Route::resource('event', cmsEventController::class);
        Route::resource('gallery', cmsGalleryController::class);
        Route::resource('news', cmsNewsController::class);
        Route::resource('trips', cmsTripsController::class);
        Route::resource('basic-settings', cmsBasicsettingsController::class);
        Route::resource('set-navbar', cmsNavbarController::class);




        // short cms updatable functions

        Route::post('/banner-added', function (Request $request) {
        if($request->hasFile("banner")){

            $file =  $request->file('banner');
            $name = $file->getClientOriginalName();

            $filename =  "images/" . $name;
            $file->move("images/" , $filename );


            Banner::create([
                'banner' =>  $filename
             ]);
         }

         return back()->with('message'  , 'Data Saved Succesfully');


   return         request('banner');

        });


        Route::get('banner-delete/{id}' , function ($id){
             Banner::destroy($id);
            return back()->with('message' , 'Deleted Succesfully');

        });









        Route::resource('set-footer', cmsFooterController::class);

        Route::resource('employees', EmployeeController::class);
        Route::resource('employee_payroll', EmployeePayRollController::class);
        Route::resource('employee_positions', EmployeePositionController::class);
        Route::resource('employee_salaries', EmployeeSalaryController::class);
        Route::resource('employee_transactions', EmployeeTransactionController::class);
        Route::resource('employees_payroll', EmployeePayRollController::class);
        Route::post('/employees_payroll/getEmpDetails', 'EmployeePayRollController@getEmpDetails')->name('employees_payroll.getEmpDetails')->middleware('web');
        Route::get('/employee_transactions/create/{pn?}', 'App\Http\Controllers\EmployeeTransactionController@create')
    ->name('employee_transactions.create');
        Route::get('/receiveditems/create/{ven}/{det?}', 'App\Http\Controllers\ReceivedItemController@create')
    ->name('receiveditems.create');
    Route::get('/purchaseorders/po_summery/{orderId}', 'App\Http\Controllers\PurchaseOrderController@po_summery')
    ->name('purchaseorders.po_summery');
    Route::post('/consumeditems/getStock', 'ConsumedItemController@getStock')->name('consumeditems.getStock')->middleware('web');
        Route::resource('cashflow', CashFlowController::class);
        Route::resource('cashflowcategories', CashFlowCategoryController::class);
        Route::resource('cfmain', CFMainController::class);
        Route::resource('pobill', POBillController::class);
        Route::get('/pobill/create/{ven?}', 'App\Http\Controllers\POBillController@create')
    ->name('pobill.create');

        //Route::get('/receiveditems/create/{id}',[ReceivedItemController::class,'create']);
        // Route::get('/cart', ['as' => 'search', 'uses' => 'CartController@index']);
        Route::get('/cart','CartController@index')->name('cart.index');
       // Route::resource('cart', CartController::class);
       Route::post('/cart','CartController@store')->name('cart.store');
       Route::post('/cart/change-qty','CartController@changeQty');
     Route::delete('/cart/delete', 'CartController@delete');
    Route::delete('/cart/empty', 'CartController@empty');
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
