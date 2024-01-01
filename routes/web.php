<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


//Website
Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/#homereservations', [WebsiteController::class, 'index'])->name('home.reserve');
Route::get('/#menu', [WebsiteController::class, 'index'])->name('home.menu');
Route::get('/#product', [WebsiteController::class, 'index'])->name('home.product');



Route::get('/menu', [WebsiteController::class, 'menu'])->name('menu');
Route::get('/menu/#menu', [WebsiteController::class, 'menu'])->name('menu.menu');

Route::get('/product', [WebsiteController::class, 'product'])->name('product');
Route::get('/product/#product', [WebsiteController::class, 'product'])->name('product.product');

Route::post('/mail', [WebsiteController::class, 'mail'])->name('mail');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::post('/reserve', [WebsiteController::class, 'reserve'])->name('reserve');
Route::get('/gallery/{type}', [WebsiteController::class, 'gallery'])->name('gallery');
Route::get('/blog', [WebsiteController::class, 'blog'])->name('allblogs');
Route::get('/blog/{blog}', [WebsiteController::class, 'getBlog'])->name('get.blog');
Route::get('/category/blog/{id}', [WebsiteController::class, 'getCategoryBlogs'])->name('category.blog');


//Cart
Route::get('/carts/{user?}', [WebsiteController::class, 'getCart'])->name('getcart');
Route::post('/cart/update/{user?}', [WebsiteController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/delete/{cart}/{user?}', [WebsiteController::class, 'destroyCart'])->name('cart.delete');
Route::get('/cart/menu/{page_id}/{id}', [WebsiteController::class, 'addmenuCart'])->name('cart.menu.add');
Route::get('/cart/product/{page_id}/{id}', [WebsiteController::class, 'addproductCart'])->name('cart.product.add');


//Checkout & Order
Route::get('/order/{user?}', [WebsiteController::class, 'checkout'])->name('checkout');
Route::get('/order/verify/{reference}', [WebsiteController::class, 'verifyorder'])->name('order.verify');
Route::post('/order/{user?}', [WebsiteController::class, 'order'])->name('order');
Route::get('/payment/succes/{order}', [WebsiteController::class, 'success'])->name('success');
Route::get('/payment/cancel', [WebsiteController::class, 'cancel'])->name('cancel');


//Authentication Route
require __DIR__.'/auth.php';


Route::middleware(['auth', 'rolegen:admin'])->group(function () {
    //Account
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'SessionDestory'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'Profile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'ProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'ChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'UpdatePassword'])->name('admin.update.password');



    //Employees
    Route::get('/all/employee', [AdminController::class, 'AllEmployee'])->name('employee.all')->middleware('permission:employee.all.current');
    Route::get('/all/employee', [AdminController::class, 'AllEmployee'])->name('employee.all')->middleware('permission:employee.all.former');
    Route::get('/get/employee/details/{id}', [AdminController::class, 'GetEmployeeDetails'])->name('employee.details');
    Route::get('/add/employee', [AdminController::class, 'AddEmployee'])->name('employee.add')->middleware('permission:employee.add');
    Route::post('/store/employee', [AdminController::class, 'StoreEmployee'])->name('employee.store');
    Route::get('/edit/employee/{id}', [AdminController::class, 'EditEmployee'])->name('employee.edit')->middleware('permission:employee.edit');
    Route::post('/update/employee/{id}',[AdminController::class, 'UpdateEmployee'])->name('employee.update');
    Route::delete('/delete/employee/{id}', [AdminController::class, 'DeleteEmployee'])->name('employee.delete')->middleware('permission:employee.delete');



    //Customer
    Route::get('/all/customer', [AdminController::class, 'AllCustomer'])->name('customer.all')->middleware('permission:customer.all.current');
    Route::get('/all/customer', [AdminController::class, 'AllCustomer'])->name('customer.all')->middleware('permission:customer.all.former');
    Route::get('/get/customer/details/{id}', [AdminController::class, 'GetCustomerDetails'])->name('customer.details');
    Route::get('/add/customer', [AdminController::class, 'AddCustomer'])->name('customer.add')->middleware('permission:customer.add');
    Route::post('/store/customer', [AdminController::class, 'StoreCustomer'])->name('customer.store');
    Route::get('/edit/customer/{id}', [AdminController::class, 'EditCustomer'])->name('customer.edit')->middleware('permission:customer.edit');
    Route::post('/update/customer/{id}',[AdminController::class, 'UpdateCustomer'])->name('customer.update');
    Route::delete('/delete/customer/{id}', [AdminController::class, 'DeleteCustomer'])->name('customer.delete')->middleware('permission:customer.delete');



    //Supplier
    Route::get('/all/supplier', [AdminController::class, 'AllSupplier'])->name('supplier.all')->middleware('permission:supplier.all');
    Route::get('/get/supplier/details/{id}', [AdminController::class, 'GetSupplierDetails'])->name('supplier.details');
    Route::get('/add/supplier', [AdminController::class, 'AddSupplier'])->name('supplier.add')->middleware('permission:supplier.add');
    Route::post('/store/supplier', [AdminController::class, 'StoreSupplier'])->name('supplier.store');
    Route::get('/edit/supplier/{id}', [AdminController::class, 'EditSupplier'])->name('supplier.edit')->middleware('permission:supplier.edit');
    Route::post('/update/supplier/{id}',[AdminController::class, 'UpdateSupplier'])->name('supplier.update');
    Route::delete('/delete/supplier/{id}', [AdminController::class, 'DeleteSupplier'])->name('supplier.delete')->middleware('permission:supplier.delete');



    //Salary
    Route::get('/all/advance/salary', [AdminController::class, 'AllAdvanceSalary'])->name('salary.advance.all')->middleware('permission:salary.advance.all');
    Route::get('/get/advance/salary/details/{id}', [AdminController::class, 'GetAdvanceSalaryDetails'])->name('salary.advance.details');
    Route::get('/add/adavance/salary', [AdminController::class, 'AddAdvanceSalary'])->name('salary.advance.add')->middleware('permission:salary.advance.add');
    Route::post('/store/adavance/salary', [AdminController::class, 'StoreAdvanceSalary'])->name('salary.advance.store');
    Route::get('/edit/advance/salary/{id}', [AdminController::class, 'EditAdvancesalary'])->name('salary.advance.edit')->middleware('permission:salary.advance.edit');
    Route::post('/update/advance/salary/{id}',[AdminController::class, 'UpdateAdvancesalary'])->name('salary.advance.update');
    Route::delete('/delete/advance/salary/{id}', [AdminController::class, 'DeleteAdvancesalary'])->name('salary.advance.delete')->middleware('permission:salary.advance.delete');
    Route::get('/pay/salary', [AdminController::class, 'PaySalary'])->name('salary.pay')->middleware('permission:salary.pay');
    // Route::post('/pay/all/salary', [AdminController::class, 'PayAllSalary'])->name('salary.pay.all');
    Route::get('/get/salary/details/{id}', [AdminController::class, 'PaySalaryDetails'])->name('salary.pay.details');
    Route::post('/pay/salary/store', [AdminController::class, 'PaySalaryStore'])->name('salary.pay.store');
    Route::get('/paid/salary', [AdminController::class, 'PaidSalary'])->name('salary.paid')->middleware('permission:salary.paid');
    Route::get('/get/salary/history/{id}', [AdminController::class, 'PaySalaryHistory'])->name('salary.pay.history');



    //Attendance
    Route::get('/employee/attendance', [AdminController::class, 'AttendanceList'])->name('employee.attendance')->middleware('permission:employee.attendance');
    Route::get('/take/employee/attendance', [AdminController::class, 'TakeAttendance'])->name('attendance.take')->middleware('permission:attendance.take');
    Route::post('/store/employee/attendance', [AdminController::class, 'StoreAttendance'])->name('employee.attendance.store');
    Route::get('/get/employee/attendance/details/{date}', [AdminController::class, 'GetAttendanceDetails'])->name('employee.attendance.details');
    Route::get('/edit/employee/attendance/{date}', [AdminController::class, 'EditAttendance'])->name('employee.attendance.edit')->middleware('permission:employee.attendance.edit');
    Route::delete('/delete/employee/attendance/{date}', [AdminController::class, 'DeleteAttendance'])->name('employee.attendance.destroy')->middleware('permission:employee.attendance.destroy');



    //Category
    Route::get('/all/category', [AdminController::class, 'AllCategory'])->name('category.index')->middleware('permission:category.index.menu');
    Route::get('/all/category', [AdminController::class, 'AllCategory'])->name('category.index')->middleware('permission:category.index.product');
    Route::get('/all/category', [AdminController::class, 'AllCategory'])->name('category.index')->middleware('permission:category.index.store');
    Route::get('/all/category', [AdminController::class, 'AllCategory'])->name('category.index')->middleware('permission:category.index.blog');
    Route::get('/add/category', [AdminController::class, 'AddCategory'])->name('category.create')->middleware('permission:category.create');
    Route::post('/store/category', [AdminController::class, 'StoreCategory'])->name('category.store');
    Route::get('/edit/category/{id}', [AdminController::class, 'EditCategory'])->name('category.edit')->middleware('permission:category.edit');
    Route::post('/update/category/{id}',[AdminController::class, 'UpdateCategory'])->name('category.update');
    Route::delete('/delete/category/{id}', [AdminController::class, 'DeleteCategory'])->name('category.destroy')->middleware('permission:category.destroy');
    Route::get('/import/category', [AdminController::class, 'ImportCategory'])->name('category.import')->middleware('permission:category.import');
    Route::get('/export/category', [AdminController::class, 'ExportCategory'])->name('category.export');
    Route::post('/store/import/category', [AdminController::class, 'ImportCategoryStore'])->name('category.import.store');



    //Blog
    Route::get('/all/blog', [AdminController::class, 'AllBlog'])->name('blog.index')->middleware('permission:blog.index');
    Route::get('/add/blog', [AdminController::class, 'AddBlog'])->name('blog.create')->middleware('permission:blog.create');
    Route::post('/store/blog', [AdminController::class, 'StoreBlog'])->name('blog.store');
    Route::get('/edit/blog/{id}', [AdminController::class, 'EditBlog'])->name('blog.edit')->middleware('permission:blog.edit');
    Route::post('/update/blog/{id}',[AdminController::class, 'UpdateBlog'])->name('blog.update');
    Route::delete('/delete/blog/{id}', [AdminController::class, 'DeleteBlog'])->name('blog.destroy')->middleware('permission:blog.destroy');



    //Menu
    Route::get('/all/menu', [AdminController::class, 'AllMenu'])->name('menu.index')->middleware('permission:menu.index');
    Route::get('/add/menu', [AdminController::class, 'AddMenu'])->name('menu.create')->middleware('permission:menu.create');
    Route::post('/store/menu', [AdminController::class, 'StoreMenu'])->name('menu.store');
    Route::get('/edit/menu/{id}', [AdminController::class, 'EditMenu'])->name('menu.edit')->middleware('permission:menu.edit');
    Route::post('/update/menu/{id}',[AdminController::class, 'UpdateMenu'])->name('menu.update');
    Route::delete('/delete/menu/{id}', [AdminController::class, 'DeleteMenu'])->name('menu.destroy')->middleware('permission:menu.destroy');
    Route::get('/import/menu', [AdminController::class, 'ImportMenu'])->name('menu.import')->middleware('permission:menu.import');
    Route::get('/export/menu', [AdminController::class, 'ExportMenu'])->name('menu.export');
    Route::post('/store/import/menu', [AdminController::class, 'ImportMenuStore'])->name('menu.import.store');



    //Product
    Route::get('/all/product', [AdminController::class, 'AllProduct'])->name('product.index')->middleware('permission:product.index');
    Route::get('/add/product', [AdminController::class, 'AddProduct'])->name('product.create')->middleware('permission:product.create');
    Route::post('/store/product', [AdminController::class, 'StoreProduct'])->name('product.store');
    Route::get('/edit/product/{id}', [AdminController::class, 'EditProduct'])->name('product.edit')->middleware('permission:product.edit');
    Route::post('/update/product/{id}',[AdminController::class, 'UpdateProduct'])->name('product.update');
    Route::delete('/delete/product/{id}', [AdminController::class, 'DeleteProduct'])->name('product.destroy')->middleware('permission:product.destroy');
    Route::get('/import/product', [AdminController::class, 'ImportProduct'])->name('product.import')->middleware('permission:product.import');
    Route::get('/export/product', [AdminController::class, 'ExportProduct'])->name('product.export');
    Route::post('/store/import/product', [AdminController::class, 'ImportProductStore'])->name('product.import.store');



    //Expense
    Route::get('/daily/expense', [AdminController::class, 'DailyExpense'])->name('expense.daily')->middleware('permission:expense.daily');
    Route::get('/weekly/expense', [AdminController::class, 'WeeklyExpense'])->name('expense.weekly')->middleware('permission:expense.weekly');
    Route::get('/monthly/expense', [AdminController::class, 'MonthlyExpense'])->name('expense.monthly')->middleware('permission:expense.monthly');
    Route::get('/yearly/expense', [AdminController::class, 'YearlyExpense'])->name('expense.yearly')->middleware('permission:expense.yearly');
    Route::get('/add/expense', [AdminController::class, 'Addexpense'])->name('expense.create')->middleware('permission:expense.create');
    Route::post('/store/expense', [AdminController::class, 'Storeexpense'])->name('expense.store');
    Route::get('/edit/expense/{id}', [AdminController::class, 'Editexpense'])->name('expense.edit')->middleware('permission:expense.edit');
    Route::post('/update/expense/{id}',[AdminController::class, 'Updateexpense'])->name('expense.update');
    Route::delete('/delete/expense/{id}', [AdminController::class, 'Deleteexpense'])->name('expense.destroy')->middleware('permission:expense.destroy');



    //Reservation
    Route::get('/reservation', [AdminController::class, 'AllReservation'])->name('reserve.index')->middleware('permission:reserve.index');
    Route::get('/reservation/{status}/{reserve}', [AdminController::class, 'ConfirmationReservation'])->name('reserve.confirmation');
    Route::get('/completed/reservation/history', [AdminController::class, 'ReservationrHistory'])->name('reserve.history')->middleware('permission:reserve.history');
    Route::delete('/reservation/{id}', [AdminController::class, 'DeleteReservation'])->name('reserve.delete');



    //Order
    Route::get('/new/order', [AdminController::class, 'NewOrder'])->name('order.index')->middleware('permission:order.index');
    Route::get('/confirm/payment/{id}', [AdminController::class, 'ConfirmPayment'])->name('confirm.payment');
    Route::get('/confirmation/{status}/{id}', [AdminController::class, 'OrderConfirmation'])->name('order.confirmation');
    Route::get('/completed/order/history', [AdminController::class, 'OrderHistory'])->name('order.history')->middleware('permission:order.history');
    Route::delete('/delete/order/{id}', [AdminController::class, 'DeleteOrder'])->name('order.delete');



    //POS
    Route::get('/sales/pos', [AdminController::class, 'POSIndex'])->name('pos.index')->middleware('permission:pos.index');
    Route::post('/pos/add/cart', [AdminController::class, 'POSAddCart'])->name('pos.add');
    Route::post('/pos/update/cart', [AdminController::class, 'POSCartUpdate'])->name('pos.update');
    Route::get('/pos/remove/{rowId}', [AdminController::class, 'POSCartRemove'])->name('pos.remove');
    Route::get('/pos/empty/cart', [AdminController::class, 'POSCartEmpty'])->name('pos.empty');
    Route::post('/pos/order', [AdminController::class, 'OrderPOS'])->name('order.pos');




    //POS Invoice
    Route::get('/pos/create/invoice/{id}', [AdminController::class, 'POSCreateInvoice'])->name('pos.invoice');



    //Product Inventory
    Route::get('/inventory/product', [AdminController::class, 'AllProductInventory'])->name('inventory.product.index')->middleware('permission:inventory.product.index');


    Route::get('/inventory/product/outofstock', [AdminController::class, 'OutOfStockProductInventory'])->name('inventory.product.outofstock')->middleware('permission:inventory.product.outofstock');
    Route::get('/edit/inventory/product/outofstock', [AdminController::class, 'EditOutOfStockProductInventory'])->name('inventory.product.outofstock.edit');
    Route::post('/update/inventory/product/outofstock', [AdminController::class, 'UpdateOutOfStockProductInventory'])->name('inventory.product.outofstock.update');


    Route::get('/inventory/product/expiredproduct', [AdminController::class, 'ExpiredProductInventory'])->name('inventory.product.expiredproduct')->middleware('permission:inventory.product.expiredproduct');
    Route::get('/edit/inventory/product/expiredproduct', [AdminController::class, 'EditExpiredProductInventory'])->name('inventory.product.expiredproduct.edit');
    Route::post('/update/inventory/product/expiredproduct', [AdminController::class, 'UpdateExpiredProductInventory'])->name('inventory.product.expiredproduct.update');


    Route::get('/new/inventory/product', [AdminController::class, 'EditProductInventory'])->name('inventory.product.edit')->middleware('permission:inventory.product.edit');
    Route::post('/update/inventory/product/stock', [AdminController::class, 'UpdateProductInventoryStock'])->name('inventory.product.update.one');
    Route::post('/update/inventory/product/price', [AdminController::class, 'UpdateProductInventoryPrice'])->name('inventory.product.update.two');
    Route::post('/update/inventory/product/date', [AdminController::class, 'UpdateProductInventoryDate'])->name('inventory.product.update.three');



    //Store Inventory
    Route::get('/store/inventory', [AdminController::class, 'AllStoreInventory'])->name('inventory.store.index')->middleware('permission:inventory.store.index');
    Route::get('/add/store/inventory', [AdminController::class, 'AddStoreInventory'])->name('inventory.store.add')->middleware('permission:inventory.store.add');
    Route::post('/store/store/inventory/', [AdminController::class, 'StoreStoreInventory'])->name('inventory.store.store');
    Route::get('/edit/store/inventory/{id}', [AdminController::class, 'EditStoreInventory'])->name('inventory.store.edit')->middleware('permission:inventory.store.edit');
    Route::post('/update/store/inventory/{id}', [AdminController::class, 'UpdateStoreInventory'])->name('inventory.store.update');
    Route::delete('/delete/store/inventory/{id}', [AdminController::class, 'DeleteInventory'])->name('inventory.store.destroy')->middleware('permission:inventory.store.destroy');



    //Gallery
    Route::get('/all/gallery', [AdminController::class, 'AllGallery'])->name('gallery.index')->middleware('permission:gallery.index.photo');
    Route::get('/all/gallery', [AdminController::class, 'AllGallery'])->name('gallery.index')->middleware('permission:gallery.index.video');
    Route::get('/add/gallery', [AdminController::class, 'AddGallery'])->name('gallery.create')->middleware('permission:gallery.add');
    Route::post('/store/gallery', [AdminController::class, 'StoreGallery'])->name('gallery.store');
    Route::get('/edit/gallery/{id}', [AdminController::class, 'EditGallery'])->name('gallery.edit')->middleware('permission:gallery.edit');
    Route::post('/update/gallery/{id}',[AdminController::class, 'UpdateGallery'])->name('gallery.update');
    Route::delete('/delete/gallery/{id}', [AdminController::class, 'DeleteGallery'])->name('gallery.destroy')->middleware('permission:gallery.destroy');



    //Services
    Route::get('/all/service', [AdminController::class, 'AllService'])->name('service.index')->middleware('permission:service.index');
    Route::get('/add/service', [AdminController::class, 'AddService'])->name('service.create')->middleware('permission:service.create');
    Route::post('/store/service', [AdminController::class, 'StoreService'])->name('service.store');
    Route::get('/edit/service/{id}', [AdminController::class, 'EditService'])->name('service.edit')->middleware('permission:service.edit');
    Route::post('/update/service/{id}',[AdminController::class, 'UpdateService'])->name('service.update');
    Route::delete('/delete/service/{id}', [AdminController::class, 'DeleteService'])->name('service.destroy')->middleware('permission:service.destroy');



    //Slider
    Route::get('/all/slider', [AdminController::class, 'AllSlider'])->name('slider.index')->middleware('permission:slider.index');
    Route::get('/add/slider', [AdminController::class, 'AddSlider'])->name('slider.create')->middleware('permission:slider.create');
    Route::post('/store/slider', [AdminController::class, 'StoreSlider'])->name('slider.store');
    Route::get('/edit/slider/{id}', [AdminController::class, 'EditSlider'])->name('slider.edit')->middleware('permission:slider.edit');
    Route::post('/update/slider/{id}',[AdminController::class, 'UpdateSlider'])->name('slider.update');
    Route::delete('/delete/slider/{id}', [AdminController::class, 'DeleteSlider'])->name('slider.destroy')->middleware('permission:slider.destroy');



    //Team
    Route::get('/all/team', [AdminController::class, 'AllTeam'])->name('team.index')->middleware('permission:team.index');
    Route::get('/add/team', [AdminController::class, 'AddTeam'])->name('team.create')->middleware('permission:team.create');
    Route::post('/store/team', [AdminController::class, 'StoreTeam'])->name('team.store');
    Route::get('/edit/team/{id}', [AdminController::class, 'EditTeam'])->name('team.edit')->middleware('permission:team.edit');
    Route::post('/update/team/{id}',[AdminController::class, 'UpdateTeam'])->name('team.update');
    Route::delete('/delete/team/{id}', [AdminController::class, 'DeleteTeam'])->name('team.destroy')->middleware('permission:team.destroy');



    //Settings
    Route::get('/add/general', [AdminController::class, 'AddGeneral'])->name('general.create')->middleware('permission:general.create');
    Route::post('/store/general/{type}', [AdminController::class, 'StoreGeneral'])->name('general.store');



    //Database
    Route::get('/all/database', [AdminController::class, 'AllDatabase'])->name('database.index');
    Route::get('/add/database', [AdminController::class, 'AddDatabase'])->name('database.create');
    Route::get('/download/database/{getFilename}', [AdminController::class, 'DownloadDatabase'])->name('database.download');
    Route::delete('/delete/database/{getFilename}', [AdminController::class, 'DeleteDatabase'])->name('database.destroy');



    //Permission
    Route::get('/all/permission', [AdminController::class, 'AllPermission'])->name('permission.all');
    Route::get('/add/permission', [AdminController::class, 'AddPermission'])->name('permission.add');
    Route::post('/store/permission', [AdminController::class, 'StorePermission'])->name('permission.store');
    Route::get('/edit/permission/{id}', [AdminController::class, 'EditPermission'])->name('permission.edit');
    Route::post('/update/permission/{id}',[AdminController::class, 'UpdatePermission'])->name('permission.update');
    Route::delete('/delete/permission/{id}', [AdminController::class, 'DeletePermission'])->name('permission.delete');
    Route::get('/import/permission', [AdminController::class, 'ImportPermission'])->name('permission.import');
    Route::get('/export/permission', [AdminController::class, 'ExportPermission'])->name('permission.export');
    Route::post('/store/import/permission', [AdminController::class, 'ImportPermissionStore'])->name('permission.import.store');


    //Role
    Route::get('/all/role', [AdminController::class, 'AllRole'])->name('role.all');
    Route::get('/add/role', [AdminController::class, 'AddRole'])->name('role.add');
    Route::post('/store/role', [AdminController::class, 'StoreRole'])->name('role.store');
    Route::get('/edit/role/{id}', [AdminController::class, 'EditRole'])->name('role.edit');
    Route::post('/update/role/{id}',[AdminController::class, 'UpdateRole'])->name('role.update');
    Route::delete('/delete/role/{id}', [AdminController::class, 'DeleteRole'])->name('role.delete');



    //Role Permission
    Route::get('/all/role/permission', [AdminController::class, 'AllRolePermission'])->name('role.permission.all');
    Route::get('/add/role/permission', [AdminController::class, 'AddRolePermission'])->name('role.permission.add');
    Route::post('/store/role/permission', [AdminController::class, 'StoreRolePermission'])->name('role.permission.store');
    Route::get('/edit/role/permission/{id}', [AdminController::class, 'EditRolePermission'])->name('role.permission.edit');
    Route::post('/update/role/permission/{id}',[AdminController::class, 'UpdateRolePermission'])->name('role.permission.update');
    Route::delete('/delete/role/permission/{id}', [AdminController::class, 'DeleteRolePermission'])->name('role.permission.delete');



    //Admin Employee Role
    Route::get('/admin/all/employee/role', [AdminController::class, 'AdminAllEmployeeRoles'])->name('admin.employee.role.all');
    Route::get('/admin/add/employee/role', [AdminController::class, 'AdminAddEmployeeRoles'])->name('admin.employee.role.add');
    Route::post('/admin/store/employee/role', [AdminController::class, 'AdminStoreEmployeeRoles'])->name('admin.employee.role.store');
    Route::get('/admin/edit/employee/role/{id}', [AdminController::class, 'AdminEditEmployeeRoles'])->name('admin.employee.role.edit');
    Route::post('/admin/update/employee/role/{id}',[AdminController::class, 'AdminUpdateEmployeeRoles'])->name('admin.employee.role.update');
    Route::post('/admin/detach/employee/role/{id}', [AdminController::class, 'AdminDetachEmployeeRoles'])->name('admin.employee.role.detach');



    //Employee Role
    Route::get('/all/employee/role', [AdminController::class, 'AllEmployeeRoles'])->name('employee.role.all')->middleware('permission:employee.role.all');
    Route::get('/add/employee/role', [AdminController::class, 'AddEmployeeRoles'])->name('employee.role.add')->middleware('permission:employee.role.add');
    Route::post('/store/employee/role', [AdminController::class, 'StoreEmployeeRoles'])->name('employee.role.store');
    Route::get('/edit/employee/role/{id}', [AdminController::class, 'EditEmployeeRoles'])->name('employee.role.edit')->middleware('permission:employee.role.edit');
    Route::post('/update/employee/role/{id}',[AdminController::class, 'UpdateEmployeeRoles'])->name('employee.role.update');
    Route::post('/detach/employee/role/{id}', [AdminController::class, 'DetachEmployeeRoles'])->name('employee.role.detach')->middleware('permission:employee.role.detach');

}); // End Group Admin Middleware


Route::middleware(['auth', 'rolegen:employee'])->group(function () {
    //Account
    Route::get('/employee/dashboard', [EmployeeController::class, 'EmployeeDashboard'])->name('employee.dashboard');
    Route::get('/employee/logout', [EmployeeController::class, 'SessionDestory'])->name('employee.logout');
    Route::get('/employee/profile', [EmployeeController::class, 'Profile'])->name('employee.profile');
    Route::post('/employee/profile/store', [EmployeeController::class, 'ProfileStore'])->name('employee.profile.store');
    Route::get('/employee/change/password', [EmployeeController::class, 'ChangePassword'])->name('employee.change.password');
    Route::post('/employee/update/password', [EmployeeController::class, 'UpdatePassword'])->name('employee.update.password');



    //Order
    Route::get('/employee/new/order', [EmployeeController::class, 'EmployeeOrder'])->name('employee.order.index');
    Route::get('/employee/order/history', [EmployeeController::class, 'EmployeeOrderHistory'])->name('employee.order.history');
    //Order Invoice
    Route::get('/employee/order/create/invoice/{id}', [EmployeeController::class, 'EmployeeCreateInvoice'])->name('employee.invoice');

}); // End Group Employee Middleware


Route::middleware(['auth','rolegen:customer'])->group(function () {
    //Account
    Route::get('/customer/dashboard', [CustomerController::class, 'CustomerDashboard'])->name('customer.dashboard');
    Route::get('/customer/logout', [CustomerController::class, 'SessionDestory'])->name('customer.logout');
    Route::get('/customer/profile', [CustomerController::class, 'Profile'])->name('customer.profile');
    Route::post('/customer/profile/store', [CustomerController::class, 'ProfileStore'])->name('customer.profile.store');
    Route::get('/customer/change/password', [CustomerController::class, 'ChangePassword'])->name('customer.change.password');
    Route::post('/customer/update/password', [CustomerController::class, 'UpdatePassword'])->name('customer.update.password');



    //Order
    Route::get('/customer/new/order', [CustomerController::class, 'CustomerOrder'])->name('customer.order.index');
    Route::get('/customer/order/history', [CustomerController::class, 'CustomerOrderHistory'])->name('customer.order.history');
    //Order Invoice
    Route::get('/customer/order/create/invoice/{id}', [CustomerController::class, 'CustomerCreateInvoice'])->name('customer.invoice');

}); // End Group Customer Middleware

