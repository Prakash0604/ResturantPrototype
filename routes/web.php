<?php

use App\Http\Controllers\LandingPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IngredientController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return view('UsersPage.booktable');
});
// Route::get('/',[LandingPage::class,'LandingPage']);
Route::get('/', [AuthController::class, 'indexview']);
Route::post('/', [AuthController::class, 'storeindex']);
// Route::get('/sign-up',[AuthController::class,'index']);
// Route::post('/sign-up',[AuthController::class,'storeSignup']);
// Route::get('/email/verification/{token}',[AuthController::class,'verification']);
Route::middleware('is_admin')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/users/table', [AdminController::class, 'userstable']);

    Route::get('/admin/profile', [AdminController::class, 'profile']);
    Route::post('/admin/profile', [AdminController::class, 'updateprofile']);


    Route::get('/admin/add/menu', [AdminController::class, 'addMenu']);
    Route::post('/admin/add/item', [AdminController::class, 'additem']);
    Route::get('/admin/edit/item/{id}', [AdminController::class, 'editMenu']);
    Route::post('/admin/edit/item/', [AdminController::class, 'updateMenu']);
    Route::get('/admin/item/delete/{id}', [AdminController::class, 'deleteItems']);


    Route::post('/admin/add/category', [AdminController::class, 'addCategory']);
    Route::get('/admin/category/list', [AdminController::class, 'showCategory']);
    Route::get('/admin/category/edit/{id}', [AdminController::class, 'editCat']);
    Route::post('/admin/category/edit/', [AdminController::class, 'updateCat']);
    Route::get('/admin/category/delete/{id}', [AdminController::class, 'deleteCat']);


    Route::get('/admin/event/list', [AdminController::class, 'event']);
    Route::post('/admin/event/add', [AdminController::class, 'eventAdd']);
    Route::get('/admin/event/edit/{id}', [AdminController::class, 'editEvent']);
    Route::post('/admin/event/edit/', [AdminController::class, 'updateEvent']);
    Route::get('/admin/event/delete/{id}', [AdminController::class, 'deleteEvent']);


    Route::get('/admin/employee/list', [AdminController::class, 'Employeelist']);
    Route::post('/admin/employee/add', [AdminController::class, 'addEmployee']);
    Route::get('/admin/employee/edit/{id}', [AdminController::class, 'editEmployee']);
    Route::post('/admin/employee/edit/', [AdminController::class, 'updateEmployee']);
    Route::get('/admin/employee/delete/{id}', [AdminController::class, 'deleteEmployee']);

    Route::get('/admin/table', [AdminController::class, 'Tabledata']);
    Route::post('/admin/table/add', [AdminController::class, 'addTabledata']);
    Route::get('/admin/table/delete/{id}', [AdminController::class, 'deleteTabledata']);

    // Reservation table Start
    Route::get('/admin/table/reserved', [AdminController::class, 'reservedTable']);


    // ===========================User Route Start=====================================
    Route::get('/users/booktable', [UserController::class, 'booktable'])->name('reservation');
    Route::get('/users/profile', [UserController::class, 'userProfile']);
    Route::post('/users/profile', [UserController::class, 'updateProfile']);
    Route::get('/users/menu', [UserController::class, 'menuitem']);

    // Route::post('/users/store/item',[UserController::class,'storeItems'])->name('store.items');
    Route::get('/users/show/item/{id}', [UserController::class, 'showItems'])->name('show.items');
    // ===========================User Route End=======================================

    Route::get('/payment', [EsewaController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [EsewaController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [EsewaController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/failure', [EsewaController::class, 'paymentFailure'])->name('payment.failure');

    Route::get('/admin/order/item', [AdminController::class, 'orderTable'])->name('order_table');
    Route::post('admin/order/item/status/{id}', [AdminController::class, 'orderStatus'])->name('order_status');


    // Orders Web
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/admin/delete/orders/{id}', [OrderController::class, 'delete'])->name('delete_orders');
    Route::post('/save-order', [OrderController::class, 'store']);
    Route::get('/order-items/{id}/edit', [OrderController::class, 'edit'])->name('order-items.edit');
    Route::put('/order-items/{id}', [OrderController::class, 'update'])->name('order-items.update');


    // Generate Bill
    Route::get('/get-order-details/{orderId}', [OrderController::class, 'getOrderDetails']);
    Route::post('/get-order-details/save', [OrderController::class, 'saveBill'])->name('saveBill');

    Route::get('/admin/bills', [OrderController::class, 'listBills'])->name('bills.index');
    Route::get('/admin/bills/{orderId}/view', [OrderController::class, 'viewBill'])->name('bills.view');
    Route::get('/admin/bills/{orderId}/print', [OrderController::class, 'viewBill'])->name('bills.print');


    // Inventory

    Route::get('/admin/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
    Route::post('/admin/ingredients/store', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::delete('/admin/ingredients/{id}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');


    Route::get('/admin/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::post('/admin/stocks/store', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/admin/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');
    Route::put('/admin/stocks/{id}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/admin/stocks/{id}', [StockController::class, 'destroy'])->name('stocks.destroy');

    // Supplier
    Route::resource('suppliers', SupplierController::class);
    // Purchase


    Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::post('purchases/store', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::get('purchases/edit/{id}', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::post('purchases/update/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
    Route::delete('purchases/destroy/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('purchases/show/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
});
