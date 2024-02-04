<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\AdvanceSalary;
use App\Models\PaySalary;
use App\Models\Attendance;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\StoreInventory;
use App\Models\Expense;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Slider;
use App\Models\General;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Reserve;
use App\Models\Order;
use App\Models\Orderdetails;

use App\Mail\Reservation;
use App\Mail\OrderMail;

use App\Exports\MenuExport;
use App\Exports\ProductExport;
use App\Imports\MenuImport;
use App\Imports\ProductImport;
use App\Exports\CategoryExport;
use App\Exports\PermissionExport;
use App\Imports\CategoryImport;
use App\Imports\PermissionImport;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use File;

class AdminController extends Controller
{
    // Start Accounts Method
    public function AdminDashboard(Request $request)
    {
        $date = date('d F Y');

        $outofstockproducts = Product::where('stock_status', '0')->get();
        $expiredproducts = Product::where('stock_status', '2')->get();

        $employees = Employee::join('users', 'employees.employee_id', '=', 'users.id')->where('status', 'active')->latest('employees.created_at')->get();
        $customers = User::where('role', 'customer')->where('status', 'active')->latest('created_at')->get();
        $suppliers = Supplier::latest('created_at')->get();

        $products = Product::all();
        $menues = Menu::all();
        $blogs = Blog::all();
        $storeinventories = StoreInventory::all();

        $month = date("F");
        $monthlyExpenses = Expense::where('month', $month)->get();
        $totalExpenses = $monthlyExpenses->sum('amount');
        $orders = Order::where('payment_status', 1)->where('month', $month)->get();
        $totalSales = $orders->sum('total');
        $monthlyExpenses = Expense::where('month', $month)->get();
        $totalExpenses = $monthlyExpenses->sum('amount');

        $monthsal = date("F", strtotime("-1 month"));
        $paidSalary = PaySalary::with('user', 'employee', 'advanceSalary')->where('salary_month', $monthsal)->get();
        $totalSalary = $paidSalary->sum('due_salary');

        $totalorders = Order::where('order_status', 1)->latest('created_at')->get();
        $totalreservations = Reserve::where('status', 1)->latest('created_at')->get();

        $pendingorders = Order::where('order_status', 0)->latest('created_at')->get();
        $orderdetails = Orderdetails::with('order')->latest('created_at')->get();
        $pendingreservations = Reserve::where('status', 0)->orwhere('status', 2)->latest('created_at')->get();

        return view('admin.index', compact('date', 'outofstockproducts', 'expiredproducts', 'totalorders', 'totalSalary', 'monthsal', 'pendingorders', 'orderdetails', 'totalreservations', 'pendingreservations', 'employees', 'customers', 'suppliers', 'products', 'menues', 'blogs', 'storeinventories', 'totalExpenses', 'totalSales', 'month'));
    }// End Method
    public function SessionDestory(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }// End Method
    public function Profile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }// End Method
    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $formData = User::find($id);
        $formData->username = $request->username;
        $formData->name = $request->name;
        $formData->email = $request->email;
        $formData->phone = $request->phone;
        $formData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\admin_images\\' . $formData->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\admin_images'))) {
                mkdir(public_path('uploads\\admin_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\admin_images\\' . $filename), 90);
            $formData->photo = $filename;
        }

        $formData->save();
        Alert::success('Success', 'Profile Updated Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->back();
    }// End Method
    public function ChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password');
    }// End Method
    public function UpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            Alert::error('Error', 'Old Password does not Match!')->showConfirmButton('OK', '#CE7F36');
            return back();

        }

        // Update The New Password

        User::whereId(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        Alert::success('Success', 'Password Change Successfully!');
        return back();

    }// End Method
    // End Accounts Method



    // Start Employee Method
    public function AllEmployee()
    {
        if (request('status') == 'active') {
            $employees = Employee::join('users', 'employees.employee_id', '=', 'users.id')->where('status', 'active')->latest('employees.created_at')->get();
            $page_title = 'Current Employee Index';
            return view('admin.employee.employee_index', compact('employees', 'page_title'));
        }
        elseif (request('status') == 'inactive') {
            $employees = Employee::join('users', 'employees.employee_id', '=', 'users.id')->where('status', 'inactive')->latest('employees.created_at')->get();
            $page_title = 'Former Employee Index';
            return view('admin.employee.employee_index', compact('employees', 'page_title'));
        }
    }// End Method
    public function GetEmployeeDetails($id)
    {
        $employeeDetails = Employee::join('users', 'employees.employee_id', '=', 'users.id')
        ->where('users.id', '=', $id)->first();

        return  view('admin.employee.employee_details', compact('employeeDetails'));

    }// End Method
    public function AddEmployee()
    {
        return view('admin.employee.employee_create');
    }// End Method
    public function StoreEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'qualification' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'next_kin' => 'required',
            'salary' => 'required',
        ]);

        $defaultPassword = 'password123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($defaultPassword),
            'role' => 'employee',
            'status' => $request->status,
        ]);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();

            $adminDirectory = public_path('uploads\\admin_images\\');
            $employeeDirectory = public_path('uploads\\employee_images\\');

            // Create directories if they don't exist
            if (!is_dir($adminDirectory)) {
                mkdir($adminDirectory, 0755, true);
            }

            if (!is_dir($employeeDirectory)) {
                mkdir($employeeDirectory, 0755, true);
            }

            // Save the image in the admin directory
            Image::make($file)->fit(300, 300)->save($adminDirectory . $filename, 90);

            // Copy the image to the employee directory
            copy($adminDirectory . $filename, $employeeDirectory . $filename);

            $user->photo = $filename;
        }

        $user->save();

        $employee = Employee::create([
            'employee_id' => $user->id,
            'qualification' => $request->qualification,
            'salary' => $request->salary,
            'dob' => $request->dob,
            'next_kin' => $request->next_kin,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'appointment_date' => $request->appointment_date,
        ]);

        $status = $request->status;
        Alert::success('Success', 'Employee created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('employee.all',  compact('status'));
    }// End Method
    public function EditEmployee($id)
    {
        $employee = Employee::join('users', 'employees.employee_id', '=', 'users.id')->where('users.id', '=', $id)->first();

        return view('admin.employee.employee_edit',compact('employee'));

    }// End Method
    public function UpdateEmployee(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'qualification' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'next_kin' => 'required',
            'salary' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();

            $adminDirectory = public_path('uploads\\admin_images\\');
            $employeeDirectory = public_path('uploads\\employee_images\\');

            // Create directories if they don't exist
            if (!is_dir($adminDirectory)) {
                mkdir($adminDirectory, 0755, true);
            }

            if (!is_dir($employeeDirectory)) {
                mkdir($employeeDirectory, 0755, true);
            }

            // Remove the previous image from both directories
            @unlink($adminDirectory . $user->photo);
            @unlink($employeeDirectory . $user->photo);

            // Save the image in the admin directory
            Image::make($file)->fit(300, 300)->save($adminDirectory . $filename, 90);

            // Copy the image to the employee directory
            copy($adminDirectory . $filename, $employeeDirectory . $filename);

            $user->photo = $filename;
        }

        $user->save();

        $employee = Employee::where('employee_id', $id)->firstOrFail();
        $employee->qualification = $request->qualification;
        $employee->salary = $request->salary;
        $employee->dob = $request->dob;
        $employee->next_kin = $request->next_kin;
        $employee->gender = $request->gender;
        $employee->religion = $request->religion;
        $employee->blood_group = $request->blood_group;
        $employee->appointment_date = $request->appointment_date;
        $employee->save();

        $status = $request->status;
        Alert::success('Success', 'Employee updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('employee.all',  compact('status'));
    }// End Method
    public function DeleteEmployee($id, Request $request)
    {
        // Find the employee record by the user ID
        $employee = Employee::where('employee_id', $id)->first();

        if ($employee) {
            // Delete the employee record
            $employee->delete();

            // Now, delete the user record
            $employee = User::find($id);

            if ($employee) {
                // Delete the user's photo (if exists)
                if (!empty($employee->photo) && file_exists(public_path('uploads/employee_images/' . $employee->photo))) {
                    unlink(public_path('uploads/employee_images/' . $employee->photo));
                }

                // Delete the user record
                $employee->delete();
            }
        }

        return back();
    }// End Method
    // End Employee Method


    // Start Customer Method
    public function AllCustomer()
    {
        if (request('status') == 'active') {
            $customers = User::where('role', 'customer')->where('status', 'active')->latest('created_at')->get();
            $page_title = 'Current Customers Index';
        }
        elseif (request('status') == 'inactive') {
            $customers = User::where('role', 'customer')->where('status', 'inactive')->latest('created_at')->get();
            $page_title = 'Former Customers Index';
        }

        return view('admin.customer.customer_index', compact('customers', 'page_title'));
    }// End Method
    public function GetCustomerDetails($id)
    {
        $customerDetails = User::where('role', 'customer')->where('users.id', '=', $id)->first();

        return  view('admin.customer.customer_details', compact('customerDetails'));

    }// End Method
    public function AddCustomer()
    {
        return view('admin.customer.customer_create');
    }// End Method
    public function StoreCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
        ]);

        $defaultPassword = 'password123';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($defaultPassword),
            'status' => $request->status,
        ]);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\customer_images\\' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\customer_images'))) {
                mkdir(public_path('uploads\\customer_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\customer_images\\' . $filename), 90);
            $user->photo = $filename;
        }

        $user->save();

        $status = $request->status;
        Alert::success('Success', 'Customer created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('customer.all',  compact('status'));
    }// End Method
    public function EditCustomer($id)
    {
        // Retrieve the customer by ID
        $customer = User::where('role', 'customer')->where('users.id', '=', $id)->first();

        return view('admin.customer.customer_edit',compact('customer'));

    }// End Method
    public function UpdateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\customer_images\\' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\customer_images'))) {
                mkdir(public_path('uploads\\customer_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\customer_images\\' . $filename), 90);
            $user->photo = $filename;
        }

        $user->save();

        $status = $request->status;
        Alert::success('Success', 'Customer updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('customer.all',  compact('status'));
    }// End Method
    public function DeleteCustomer($id, Request $request)
    {
        // Find the customer record by the user ID
        $customer = User::find($id);

        if ($customer) {
            // Delete the user's photo (if exists)
            if (!empty($customer->photo) && file_exists(public_path('uploads/customer_images/' . $customer->photo))) {
                unlink(public_path('uploads/customer_images/' . $customer->photo));
            }

            // Delete the user record
            $customer->delete();
        }
        return back();
    }// End Method
    // End Customer Method


    // Start Supplier Method
    public function AllSupplier()
    {
        $suppliers = Supplier::latest('created_at')->get();

        return view('admin.supplier.supplier_index', compact('suppliers'));
    }// End Method
    public function GetSupplierDetails($id)
    {
        $supplierDetails = Supplier::where('suppliers.id', '=', $id)->first();

        return  view('admin.supplier.supplier_details', compact('supplierDetails'));

    }// End Method
    public function AddSupplier()
    {
        return view('admin.supplier.supplier_create');
    }// End Method
    public function StoreSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
        ]);

        $existingSupplier = Supplier::where('email', $request->email)->first();

        if ($existingSupplier) {

            Alert::error('Error', 'Supplier with the same email already exists!')->showConfirmButton('OK', '#CE7F36');

            return redirect()->route('supplier.add');
        }

        $user = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => $request->type,
        ]);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\supplier_images\\' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\supplier_images'))) {
                mkdir(public_path('uploads\\supplier_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\supplier_images\\' . $filename), 90);
            $user->photo = $filename;
        }

        $user->save();

        Alert::success('Success', 'Supplier created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('supplier.all');
    }// End Method
    public function EditSupplier($id)
    {
        // Retrieve the supplier by ID
        $supplier = Supplier::where('suppliers.id', '=', $id)->first();

        return view('admin.supplier.supplier_edit',compact('supplier'));

    }// End Method
    public function UpdateSupplier(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
        ]);

        $user = Supplier::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->type = $request->type;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\supplier_images\\' . $user->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\supplier_images'))) {
                mkdir(public_path('uploads\\supplier_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\supplier_images\\' . $filename), 90);
            $user->photo = $filename;
        }

        $user->save();

        Alert::success('Success', 'Supplier updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('supplier.all');
    }// End Method
    public function DeleteSupplier($id, Request $request)
    {
        // Find the supplier record by the user ID
        $supplier = Supplier::find($id);

        if ($supplier) {
            // Delete the user's photo (if exists)
            if (!empty($supplier->photo) && file_exists(public_path('uploads/supplier_images/' . $supplier->photo))) {
                unlink(public_path('uploads/supplier_images/' . $supplier->photo));
            }

            // Delete the user record
            $supplier->delete();
        }
        return back();
    }// End Method
    // End supplier Method


    // Start Salary Method
    public function AllAdvanceSalary()
    {
        $advancesalaries = AdvanceSalary::with('user', 'employee')->latest()->get();

        return view('admin.salary.advance_salary_index', compact('advancesalaries'));
    }// End Method
    public function GetAdvanceSalaryDetails($id)
    {
        $salaryDetails = AdvanceSalary::with('user', 'employee') ->where('advance_salaries.employee_id', '=', $id)->first();

        return  view('admin.salary.advance_salary_details', compact('salaryDetails'));

    }// End Method
    public function AddAdvanceSalary()
    {
        $employees = Employee::join('users', 'employees.employee_id', '=', 'users.id')->latest('employees.created_at')->get();

        return view('admin.salary.advance_salary_create', compact('employees'));
    }// End Method
    public function StoreAdvanceSalary(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'required|string|max:255',
        ]);

        $existingSalaryMonth = AdvanceSalary::where('month', $request->month)->first();
        $existingSalaryYear = AdvanceSalary::where('year', $request->year)->first();
        $existingSalaryId = AdvanceSalary::where('employee_id', $request->employee_id)->first();

        if ($existingSalaryMonth && $existingSalaryId && $existingSalaryYear) {
            Alert::error('Error', 'Employee Advance Salary has already been Paid!')->showConfirmButton('OK', '#CE7F36');
            return redirect()->route('salary.advance.add');
        }

        $salary = AdvanceSalary::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
        ]);


        $salary->save();

        Alert::success('Success', 'Advance Salary Paid successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('salary.advance.all');
    }// End Method
    public function EditAdvancesalary($id)
    {
        $employees = Employee::join('users', 'employees.employee_id', '=', 'users.id')->latest('employees.created_at')->get();
        $advancesalary = AdvanceSalary::where('advance_salaries.employee_id', '=', $id)->first();

        return view('admin.salary.advance_salary_edit',compact('advancesalary', 'employees'));

    }// End Method
    public function UpdateAdvancesalary(Request $request, $id)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'required|string|max:255',
        ]);

        $salary = AdvanceSalary::findOrFail($id);
        $salary->employee_id = $request->employee_id;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->advance_salary = $request->advance_salary;

        $salary->save();

        Alert::success('Success', 'Advance Salary updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('salary.advance.all');
    }// End Method
    public function DeleteAdvancesalary($id, Request $request)
    {
        // Find the employee record by the user ID
        $salary = AdvanceSalary::where('employee_id', $id)->first();

        if ($salary) {
            // Delete the salary record
            $salary->delete();
        }

        return back();
    }// End Method
    public function PaySalary()
    {
        $employees = Employee::with('user', 'paySalary', 'advanceSalary')->latest('employees.created_at')->get();
        return view('admin.salary.pay_salary_index', compact('employees'));
    }// End Method
    public function PaySalaryDetails($id)
    {
        $paysalaryDetails = Employee::with('user', 'advanceSalary')->where('employees.employee_id', '=', $id)->first();
        return view('admin.salary.pay_salary_details', compact('paysalaryDetails'));
    }// End Method
    public function PaySalaryStore(Request $request)
    {
        $paysalary = PaySalary::create([
            'employee_id' => $request->id,
            'salary_month' => $request->salary_month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'paid_amount' => $request->paid_amount,
            'due_salary' => $request->due_salary,
        ]);

        $paysalary->save();

        Alert::success('Success', 'Employee Salary Paid successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('salary.pay');
    }// End Method
    public function PaidSalary()
    {
        $paidSalary = PaySalary::with('user', 'employee', 'advanceSalary')->latest('pay_salaries.created_at')->get();
        return view('admin.salary.paid_salary_index', compact('paidSalary'));
    }// End Method
    public function PaySalaryHistory($id)
    {
        $paysalaryHistory = PaySalary::with('user', 'employee', 'advanceSalary') ->where('pay_salaries.employee_id', '=', $id)->first();
        return view('admin.salary.pay_salary_history', compact('paysalaryHistory'));
    }// End Method
    // End Salary Method


    // Start Attendance Method
    public function AttendanceList()
    {
        $allData = Attendance::select('date')->groupBy('date')->orderBy('id','desc')->get();

        return view('admin.attendance.attendance_list', compact('allData'));
    }// End Method
    public function TakeAttendance()
    {
        $employees = Employee::with('user')->latest()->get();

        return view('admin.attendance.attendance_take', compact('employees'));
    }// End Method
    public function StoreAttendance(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attend_status.*' => 'required|in:present,leave,absent',
        ]);
        Attendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();

        $attendStatus = $request->attend_status;
        foreach ($attendStatus as $employeeId => $status) {
            $attendance = new Attendance();
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->employee_id = $employeeId;
            $attendance->status = $status;
            $attendance->save();
        }

        Alert::success('Success', 'Employee Attendance Submitted successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('employee.attendance');
    }// End Method
    public function GetAttendanceDetails($date)
    {
        $employees = Employee::with('user')->latest()->get();
        $detailsData = Attendance::where('date',$date)->get();

        return view('admin.attendance.attendance_details',compact('employees','detailsData'));

    }// End Method
    public function EditAttendance($date)
    {
        $editData = Attendance::where('date',$date)->get();

        return view('admin.attendance.attendance_edit',compact('editData'));

    }// End Method
    public function deleteAttendance($date)
    {
        // Use where() directly in the query builder
        $deletedRows = Attendance::where('date', $date)->delete();

        // Check if any rows were deleted
        if ($deletedRows > 0) {
            // Records were deleted successfully
            return back();
        } else {
            // No matching records found
            return back()->with('error', 'No matching attendance records found for the given date.');
        }
    }// End Method
    // End Attendance Method


    // Start Category Method
    public function AllCategory()
    {
        if (request('type') == 'store') {
            $categories = Category::where('type', 3)->latest('created_at')->get();
            $page_title = 'Store Category List';
        }
        elseif (request('type') == 'blog') {
            $categories = Category::where('type', 2)->latest('created_at')->get();
            $page_title = 'Blog Category List';
        }
        elseif (request('type') == 'product') {
            $categories = Category::where('type', 1)->latest('created_at')->get();
            $page_title = 'Product Category List';
        }
        elseif (request('type') == 'menu') {
            $categories = Category::where('type', 0)->latest('created_at')->get();
            $page_title = 'Menu Category List';
        }
        return view('admin.category.index', compact('page_title', 'categories'));
    }// End Method
    public function AddCategory()
    {
        $page_title = 'Category Create';
        return view('admin.category.create', compact('page_title'));
    }// End Method
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $category = new Category;
        $category->name = trim($request->name);
        $category->type = trim($request->type);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\category_images\\' . $category->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\category_images'))) {
                mkdir(public_path('uploads\\category_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\category_images\\' . $filename), 90);
            $category->thumbnail = $filename;
        }

        $category->save();

        Alert::success('Success', 'Category created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('category.index', ['type' => $request->type == 0 ? 'menu' : ($request->type == 1 ? 'product' : ($request->type == 2 ? 'blog' : 'store'))]);
    }// End Method
    public function EditCategory($id)
    {
        // Retrieve the category by ID
        $category = Category::where('id', '=', $id)->first();
        $page_title = 'Category Edit';

        return view('admin.category.edit', compact('page_title', 'category'));
    }// End Method
    public function UpdateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->name = trim($request->name);
        $category->type = trim($request->type);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\category_images\\' . $category->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\category_images'))) {
                mkdir(public_path('uploads\\category_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\category_images\\' . $filename), 90);
            $category->thumbnail = $filename;
        }

        $category->save();

        Alert::success('Success', 'Category Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('category.index', ['type' => $request->type == 0 ? 'menu' : ($request->type == 1 ? 'product' : ($request->type == 2 ? 'blog' : 'store'))]);
    }// End Method
    public function DeleteCategory($id)
    {
        // Find the category record by the user ID
        $category = Category::find($id);

        if ($category) {
            // Delete the category photo (if exists)
            if (!empty($category->thumbnail) && file_exists(public_path('uploads/category_images/' . $category->thumbnail))) {
                unlink(public_path('uploads/category_images/' . $category->thumbnail));
            }

            // Delete the category record
            $category->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    public function ImportCategory()
    {
        $page_title = 'Category Import';
        return view('admin.category.import', compact('page_title'));
    }// End Method
    public function ExportCategory()
    {
        return Excel::download(new CategoryExport,'category.xlsx');
    }// End Method
    public function ImportCategoryStore(Request $request)
    {
        validate($request, [
            'import_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ProductImport, $request->file('import_file'));
        Alert::success('Success', 'Category Imported Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->route('category.index');
    }// End Method
    // End Category Method


    // Start Blog Method
    public function AllBlog()
    {
        $page_title = "Blog List";
        $blogs = Blog::all();
        return view('admin.blog.index', compact('page_title', 'blogs'));
    }// End Method
    public function AddBlog()
    {
        $categories = Category::where('type', 2)->get();
        $page_title = 'Blog Create';
        return view('admin.blog.create', compact('page_title', 'categories'));
    }// End Method
    public function StoreBlog(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'content' => 'required',
            'status' => 'required',
        ]);

        $blog = new Blog;
        $blog->user_id = $user_id;
        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->status = $request->status;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\blog_images\\' . $blog->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\blog_images'))) {
                mkdir(public_path('uploads\\blog_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\blog_images\\' . $filename));
            $blog->thumbnail = $filename;
        }

        $blog->save();

        Alert::success('Success', 'Blog created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('blog.index');
    }// End Method
    public function EditBlog($id)
    {
        // Retrieve the blog by ID
        $blog = Blog::where('id', '=', $id)->first();
        $categories = Category::where('type', 2)->get();
        $page_title = 'Blog Edit';


        return view('admin.blog.edit', compact('page_title', 'categories', 'blog'));
    }// End Method
    public function UpdateBlog(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->user_id = $user_id;
        $blog->category_id = trim($request->category_id);
        $blog->title = trim($request->title);
        $blog->content = trim($request->content);
        $blog->status = trim($request->status);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\blog_images\\' . $blog->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\blog_images'))) {
                mkdir(public_path('uploads\\blog_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\blog_images\\' . $filename));
            $blog->thumbnail = $filename;
        }

        $blog->save();

        Alert::success('Success', 'Blog Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('blog.index');
    }// End Method
    public function DeleteBlog($id)
    {
        // Find the blog record by the user ID
        $blog = Blog::find($id);

        if ($blog) {
            // Delete the blog photo (if exists)
            if (!empty($blog->thumbnail) && file_exists(public_path('uploads/blog_images/' . $blog->thumbnail))) {
                unlink(public_path('uploads/blog_images/' . $blog->thumbnail));
            }

            // Delete the blog record
            $blog->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Blog Method


    // Start Menu Method
    public function AllMenu()
    {
        $page_title = "Menu List";
        $menues = Menu::all();
        return view('admin.menu.index', compact('page_title', 'menues'));
    }// End Method
    public function AddMenu()
    {
        $categories = Category::where('type', 0)->get();
        $page_title = 'Menu Create';
        return view('admin.menu.create', compact('page_title', 'categories'));
    }// End Method
    public function StoreMenu(Request $request)
    {
        $menucode = IdGenerator::generate(['table' => 'menus','field' => 'code','length' => 7, 'prefix' => 'MU' ]);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'price' => 'required',
            'status' => 'required',
        ]);

        // Check if product name already exists
        $existingMenu = Product::where('name', $request->name)->first();
        if ($existingMenu) {
            Alert::error('Error', 'Product already Exists!')->showConfirmButton('OK', '#CE7F36');
            return back();
        }

        $menu = new Menu;
        $menu->category_id = $request->category_id;
        $menu->code = $menucode;
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->status = $request->status;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\menu_images\\' . $menu->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\menu_images'))) {
                mkdir(public_path('uploads\\menu_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\menu_images\\' . $filename), 90);
            $menu->thumbnail = $filename;
        }

        $menu->save();

        Alert::success('Success', 'Menu created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('menu.index');
    }// End Method
    public function EditMenu($id)
    {
        // Retrieve the menu by ID
        $menu = Menu::where('id', '=', $id)->first();
        $categories = Category::where('type', 0)->get();
        $page_title = 'Menu Edit';


        return view('admin.menu.edit', compact('page_title', 'categories', 'menu'));
    }// End Method
    public function UpdateMenu(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->category_id = trim($request->category_id);
        $menu->name = trim($request->name);
        $menu->description = trim($request->description);
        $menu->price= trim($request->price);
        $menu->status = trim($request->status);


        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\menu_images\\' . $menu->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\menu_images'))) {
                mkdir(public_path('uploads\\menu_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\menu_images\\' . $filename), 90);
            $menu->thumbnail = $filename;
        }

        $menu->save();

        Alert::success('Success', 'Menu Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('menu.index');
    }// End Method
    public function DeleteMenu($id)
    {
        // Find the menu record by the user ID
        $menu = Menu::find($id);

        if ($menu) {
            // Delete the menu photo (if exists)
            if (!empty($menu->thumbnail) && file_exists(public_path('uploads/menu_images/' . $menu->thumbnail))) {
                unlink(public_path('uploads/menu_images/' . $menu->thumbnail));
            }

            // Delete the menu record
            $menu->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    public function ImportMenu()
    {
        $page_title = 'Menu Import';
        return view('admin.menu.import', compact('page_title'));
    }// End Method
    public function ExportMenu()
    {
        return Excel::download(new MenuExport,'menus.xlsx');
    }// End Method
    public function ImportMenuStore(Request $request)
    {
        validate($request, [
            'import_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new MenuImport, $request->file('import_file'));
        Alert::success('Success', 'Menu Imported Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->route('menu.index');
    }// End Method
    // End Menu Method


    // Start Product Method
    public function AllProduct()
    {
        $page_title = "Product List";
        $products = Product::all();
        return view('admin.product.index', compact('page_title', 'products'));
    }// End Method
    public function AddProduct()
    {
        $categories = Category::where('type', 1)->get();
        $suppliers = Supplier::latest()->get();
        $page_title = 'Product Create';
        return view('admin.product.create', compact('page_title', 'categories', 'suppliers'));
    }// End Method
    public function StoreProduct(Request $request)
    {
        $productcode = IdGenerator::generate(['table' => 'products','field' => 'code','length' => 7, 'prefix' => 'PC' ]);

        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'purchase_date' => 'required',
            'expiry_date' => 'required',
            'purchase_price' => 'required',
            'sales_price' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        // Check if product name already exists
        $existingProduct = Product::where('name', $request->name)->first();
        if ($existingProduct) {
            Alert::error('Error', 'Product already Exists!')->showConfirmButton('OK', '#CE7F36');
            return back();
        }

        if ($request->stock == 0) {
            $stock_status = 0;
        }
        else {
            $stock_status = 1;
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->code = $productcode;
        $product->purchase_date = $request->purchase_date;
        $product->expiry_date = $request->expiry_date;
        $product->purchase_price = $request->purchase_price;
        $product->sales_price = $request->sales_price;
        $product->stock = $request->stock;
        $product->stock_status = $stock_status;
        $product->status = $request->status;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\product_images\\' . $product->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\product_images'))) {
                mkdir(public_path('uploads\\product_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\product_images\\' . $filename), 90);
            $product->thumbnail = $filename;
        }
        $product->save();

        $productInventory = new ProductInventory;
        $productInventory->product_id = $product->id;
        $productInventory->purchase_date = $request->purchase_date;
        $productInventory->expiry_date = $request->expiry_date;
        $productInventory->purchase_price = $request->purchase_price;
        $productInventory->sales_price = $request->sales_price;
        $productInventory->present_stock = $request->stock;
        $productInventory->save();

        Alert::success('Success', 'Product created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('product.index');
    }// End Method
    public function EditProduct($id)
    {
        // Retrieve the product by ID
        $product = Product::where('id', '=', $id)->first();
        $categories = Category::where('type', 1)->get();
        $suppliers = Supplier::latest()->get();
        $page_title = 'Product Edit';


        return view('admin.product.edit', compact('page_title', 'categories', 'product', 'suppliers'));
    }// End Method
    public function UpdateProduct(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'purchase_date' => 'required',
            'expiry_date' => 'required',
            'purchase_price' => 'required',
            'sales_price' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        if ($request->stock == 0) {
            $stock_status = 0;
        }
        else {
            $stock_status = 1;
        }

        $product = Product::findOrFail($id);
        $product->category_id = trim($request->category_id);
        $product->supplier_id = trim($request->supplier_id);
        $product->name = trim($request->name);
        $product->description = trim($request->description);
        $product->purchase_date= trim($request->purchase_date);
        $product->expiry_date= trim($request->expiry_date);
        $product->purchase_price= trim($request->purchase_price);
        $product->sales_price= trim($request->sales_price);
        $product->status = trim($request->status);
        $product->stock = trim($request->stock);
        $product->stock_status = $stock_status;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\product_images\\' . $product->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\product_images'))) {
                mkdir(public_path('uploads\\product_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\product_images\\' . $filename), 90);
            $product->thumbnail = $filename;
        }

        $product->save();

        $product_id = $id;
        $productInventory = ProductInventory::where('product_id', $product_id)->firstOrFail();
        $productInventory->purchase_date= trim($request->purchase_date);
        $productInventory->expiry_date= trim($request->expiry_date);
        $productInventory->purchase_price= trim($request->purchase_price);
        $productInventory->sales_price= trim($request->sales_price);
        $productInventory->present_stock = trim($request->stock);

        $productInventory->save();

        Alert::success('Success', 'Product Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('product.index');
    }// End Method
    public function DeleteProduct($id)
    {
        // Find the product record by the user ID
        $product = Product::find($id);

        if ($product) {
            // Delete the product photo (if exists)
            if (!empty($product->thumbnail) && file_exists(public_path('uploads/product_images/' . $product->thumbnail))) {
                unlink(public_path('uploads/product_images/' . $product->thumbnail));
            }

            // Delete the product record
            $product->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    public function ImportProduct()
    {
        $page_title = 'Product Import';
        return view('admin.product.import', compact('page_title'));
    }// End Method
    public function ExportProduct()
    {
        return Excel::download(new ProductExport,'products.xlsx');
    }// End Method
    public function ImportProductStore(Request $request)
    {
        validate($request, [
            'import_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ProductImport, $request->file('import_file'));
        Alert::success('Success', 'Product Imported Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->route('product.index');
    }// End Method
    // End Product Method


    // Start Order Method
    public function NewOrder()
    {
        $page_title = 'Order List';
        $orders = Order::where('order_status', 0)->latest('created_at')->get();
        $orderdetails = Orderdetails::with('order')->latest('created_at')->get();

        return view('admin.order.index', compact('page_title', 'orders', 'orderdetails'));
    }// End Method
    public function OrderHistory()
    {
        $page_title = 'Order History';
        $orders = Order::where('order_status', 2)->orwhere('order_status', 1)->latest('created_at')->get();
        $orderdetails = Orderdetails::with('order')->get();

        return view('admin.order.history', compact('page_title', 'orders', 'orderdetails'));
    }// End Method
    public function ConfirmPayment($id)
    {
        $paymentStatus = 1;
        $order = Order::findOrFail($id);
        $data = [
            'title' => 'Payment Confirmation',
            'name' => $order->name,
            'message' => 'Thank you for placing order with us. Your order payment has been confirmed!'
        ];
        Mail::to($order->email)->send(new OrderMail($data));

        $order->payment_status = $paymentStatus;
        $order->save();

        Alert::success('Success', 'Order Payment confirmed Successfully!')->showConfirmButton('OK', '#CE7F36');
        return back();
    }// End Method
    public function OrderConfirmation($status, $id)
    {
        if ($status === 'complete') {
            $orderStatus = 1;
            $order = Order::findOrFail($id);
            $orderContents = Orderdetails::where('order_id', $order->id)->get();

            foreach ($orderContents as $orderItem) {
                if ($orderItem->item_type == 'product') {
                    $product = Product::findOrFail($orderItem->item_id);
                    $product->stock = $product->stock - $orderItem->quantity;
                    $product->stock_status = ($product->stock == 0) ? 0 : 1;
                    $product->save();

                    $productInventory = ProductInventory::where('product_id', $orderItem->item_id)->first();
                    $productInventory->present_stock = $productInventory->present_stock - $orderItem->quantity;
                    $productInventory->save();
                }
            }

            $data = [
                'title' => 'Order Confirmation',
                'name' => $order->name,
                'message' => 'Thank you for placing order with us. Your order is ready for pick up!'
            ];
            Mail::to($order->email)->send(new OrderMail($data));

            $order->order_status = $orderStatus;
            $order->save();

            Alert::success('Success', 'Order Completed!')->showConfirmButton('OK', '#CE7F36');
            return back();
        }
        else if ($status === 'cancel'){
            $orderStatus = 2;
            $order = Order::findOrFail($id);

            $data = [
                'title' => 'Order Confirmation',
                'name' => $order->name,
                'message' => 'Thank you for placing order with us. We were unable to verify your order payment. The order with Invoice Reference: ' . $order->reference . ' has been canceled! '
            ];
            Mail::to($order->email)->send(new OrderMail($data));

            $order->order_status = $orderStatus;
            $order->save();
            Alert::success('Success', 'Order Cancelled!')->showConfirmButton('OK', '#CE7F36');
            return back();
        }
    }// End Method
    public function DeleteOrder($id)
    {
        // Find the order record by the user ID
        $order = Order::find($id);
        if ($order) {

            // Delete the order record
            $order->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Order Method


    // Start Reservation Method reserve
    public function AllReservation()
    {
        $page_title = "All Reservations";
        $reservations = Reserve::where('status', 0)->orwhere('status', 2)->latest('created_at')->get();

        return view('admin.reserve.index', compact('reservations', 'page_title'));
    }// End Method
    public function ReservationrHistory()
    {
        $page_title = 'Reservations History';
        $reservations = Reserve::where('status', 1)->latest('created_at')->get();

        return view('admin.reserve.history', compact('page_title', 'reservations'));
    }// End Method
    public function ConfirmationReservation($status, Reserve $reserve)
    {
        if ($status === 'accept') {
            $data = [
                'title' => 'Reservation',
                'name' => $reserve->name,
                'message' => 'Thank you for making reservation with us. Your reservation has been confirmed!'
            ];

            $reserve->status = 1;
            $reserve->update();

            Mail::to($reserve->email)->send(new Reservation($data));
            Alert::success('Success', 'Reservation confirmed!')->showConfirmButton('OK', '#CE7F36');
            return back();
        }

        $data = [
            'title' => 'Reservation',
            'name' => $reserve->name,
            'message' => 'Thank you for making reservation with us. Your reservation has been declined!'
        ];
        $reserve->status = 2;
        $reserve->update();
        Mail::to($reserve->email)->send(new Reservation($data));

        Alert::success('Success', 'Reservation cancelled!')->showConfirmButton('OK', '#CE7F36');
        return back();
    }// End Method
    public function DeleteReservation($id)
    {
        // Find the reserve record by the user ID
        $reserve = Reserve::find($id);
        // Delete the reserve record
        $reserve->delete();

        // Return a response or redirect as needed
        return back();
    }// End Method
    // End Reservation Method


    // Start POS Method
    public function POSIndex()
    {
        $page_title = "Product List";
        $menus = Menu::all();
        $products = Product::where('status', '1')->where('stock_status', '1')->get();
        $categories = Category::where('type', 1)->get();
        $customers = User::where('role', 'customer')->latest('created_at')->get();
        return view('admin.pos.index', compact('page_title', 'menus', 'products', 'customers'));
    }// End Method
    public function POSAddCart(Request $request)
    {
        if ($request->item_type == 'product') {
            $product = Product::findOrFail($request->id);
            if ($product->stock < $request->qty) {
                Alert::error('Error', 'Product Stock is Low!')->showConfirmButton('OK', '#CE7F36');
                return back();
            }
        }
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'weight' => 0,
            'price' => $request->price,
            'options' => ['item_type' => $request->item_type]
        ]);

        toast('Item Added Successfully!','success');

        return redirect()->back();
    }
    // End Method
    public function POSCartUpdate(Request $request)
    {
        // Get the cart contents using the ShoppingCart alias
        $cartContents = Cart::content();

        foreach ($cartContents as $cartItem) {
            if ($cartItem->options->item_type == 'product') {
                $product = Product::findOrFail($cartItem->id);
                $qty = array_values($request->qty)[0];
                if ($product->stock < $qty) {
                    Alert::error('Error', 'Product Stock is Low!')->showConfirmButton('OK', '#CE7F36');
                    return back();
                }
            }
        }

        foreach ($request->qty as $rowId => $qty) {
            Cart::update($rowId, $qty);
        }

        toast('Cart Updated Successfully!','success');

        // Redirect back or to a different route
        return redirect()->back();

    }// End Method
    public function POSCartRemove($rowId)
    {
        Cart::remove($rowId);

        toast('Item Deleted Successfully!','success');

        // Redirect back or to a different route
        return redirect()->back();

    }// End Method
    public function POSCartEmpty()
    {
        Cart::destroy();

        toast('Cart Emptied Successfully!','success');

        // Redirect back or to a different route
        return redirect()->back();

    }// End Method
    public function OrderPOS(Request $request)
    {
        $transactionDate = $request->transaction_date;
        // Remove double quotes from the start and end of the string
        $transactionDate = str_replace('"', '', $transactionDate);
        if (strpos($transactionDate, '.000Z') !== false) {
            // Remove the last 5 characters (".000Z") to format the date string
            $transactionDate = substr($transactionDate, 0, -5);

            // Parse the modified date string using Carbon to the desired format
            $transactionDate = Carbon::parse($transactionDate)->format('Y-m-d H:i:s');
        }
        else {
            // Parse the modified date string using Carbon to the desired format
            $transactionDate = Carbon::parse($transactionDate)->format('Y-m-d H:i:s');
        }

        $paymentChannel = $request->payment_channel;
        $customer_id = $request->customer_id;
        $user = User::findOrFail($customer_id);

        $orderStatus = 1;
        // Get the cart contents using the ShoppingCart alias
        $cartContents = Cart::content();

        $order = Order::create([
            'user_id' => $customer_id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'transaction_date' => $transactionDate,
            'channel' => $paymentChannel,
            'reference' => $request->payment_reference,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'order_status' => $orderStatus,
            'subtotal' => $request->subtotal,
            'total' => $request->total,
            'month' => $request->month,
        ]);

        foreach ($cartContents as $cartItem) {
            Orderdetails::create([
                'order_id' => $order->id,
                'reference' => $request->payment_reference,
                'item_id' => $cartItem->id,
                'item_type' => $cartItem->options->item_type,
                'item_name' => $cartItem->name,
                'quantity' => $cartItem->qty,
                'price' => $cartItem->price,
            ]);

            if ($cartItem->options->item_type == 'product') {
                $product = Product::findOrFail($cartItem->id);
                $product->stock = $product->stock - $cartItem->qty;
                if ($product->stock == 0) {
                    $product->stock_status = 0;
                }
                else {
                    $product->stock_status = 1;
                }
                $product->save();

                $productInventory = ProductInventory::where('product_id', $cartItem->id)->first();
                $productInventory->present_stock = $productInventory->present_stock - $cartItem->qty;
                $productInventory->save();
            }
        }

        Alert::success('Success', 'Order Placed Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('pos.invoice', $order->id);
    }// End Method
    // End POS Method


    // Start Invoice Method
    public function POSCreateInvoice($id)
    {
        $page_title = "Order Inoice";

        $orderid = $id;
        $order = Order::find($orderid);
        $orderdetails = $order->orderdetails;

        $user_id = $order->user_id;
        $user = User::where('id',$user_id)->first();
        Cart::destroy();

        return view('admin.invoice.index', compact('page_title', 'order', 'user', 'orderdetails'));

    }// End Method
    // End Invoice Method


    // Start Inventory Method
    // Product Inventory Method
    public function AllProductInventory()
    {
        $page_title = "Product Inventory List";
        $inventoryproducts = ProductInventory::with('product')->get();
        return view('admin.inventory.product.index', compact('inventoryproducts', 'page_title'));
    }// End Method
    public function OutOfStockProductInventory()
    {
        $page_title = "Product Out of Stock Inventory";
        $outofstockproducts = Product::where('stock_status', '0')->get();
        $wizardstatus = 0;
        return view('admin.inventory.product.outofstock', compact('outofstockproducts', 'wizardstatus', 'page_title'));
    }// End Method
    public function EditOutOfStockProductInventory(Request $request)
    {
        $page_title = "Edit Product Out of Stock Inventory";
        $outofstockproducts = Product::where('stock_status', '0')->get();
        $wizardstatus = 1;
        return view('admin.inventory.product.outofstock', compact('outofstockproducts', 'wizardstatus', 'page_title'));
    }// End Method
    public function UpdateOutOfStockProductInventory(Request $request)
    {
        // Validate the form data
        $request->validate([
            'new_stock.*' => 'required|numeric',
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find the corresponding ProductInventory
            $productInventory = ProductInventory::findOrFail($productId);
            $productInventory->previous_stock = DB::raw('present_stock + ' . $request->input("new_stock.$productId"));
            $productInventory->present_stock = DB::raw('present_stock + ' . $request->input("new_stock.$productId"));
            $productInventory->save();

            // Find the corresponding Product
            $product = Product::findOrFail($productId);
            $product->stock = DB::raw('stock + ' . $request->input("new_stock.$productId"));
            $product->save();

            $product = Product::findOrFail($productId);
            $newstock =  $product->stock;
            if ($newstock > 0) {
                $product->stock_status = 1;
            }
            else {
                $product->stock_status = 0;
            }
            $product->save();
        }

        // Redirect with success message
        return redirect()->route('inventory.product.outofstock');
    }// End Method
    public function ExpiredProductInventory()
    {
        $page_title = "Expired Product Inventory";
        $expiredproducts = Product::where('stock_status', '2')->get();
        $wizardstatus = 0;
        return view('admin.inventory.product.expiredproduct', compact('expiredproducts', 'wizardstatus', 'page_title'));
    }// End Method
    public function EditExpiredProductInventory()
    {
        $page_title = "Edit Expired Product Inventory";
        $expiredproducts = Product::where('stock_status', '2')->get();
        $wizardstatus = 1;
        return view('admin.inventory.product.expiredproduct', compact('expiredproducts', 'wizardstatus', 'page_title'));
    }// End Method
    public function UpdateExpiredProductInventory(Request $request)
    {
        // Validate the form data
        $request->validate([
            'purchase_date.*' => 'required|date',
            'expiry_date.*' => 'required|date'
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find the corresponding ProductInventory
            $productInventory = ProductInventory::findOrFail($productId);
            $productInventory->purchase_date = $request->input("purchase_date.$productId", now());
            $productInventory->expiry_date = $request->input("expiry_date.$productId", $productInventory->expiry_date);;
            $productInventory->save();

            // Find the corresponding Product
            $product = Product::findOrFail($productId);
            $product->purchase_date = $request->input("purchase_date.$productId", now());
            $product->expiry_date = $request->input("expiry_date.$productId", $product->expiry_date);
            $product->stock_status = 1;
            $product->save();
        }

        Alert::success('Success', 'Product Inventory updated successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect with success message
        return redirect()->route('inventory.product.expiredproduct');
    }// End Method
    public function EditProductInventory()
    {
        $page_title = "Update Product Inventory";
        $products = Product::all();
        $wizardstatus = 0;
        return view('admin.inventory.product.edit', compact('products', 'wizardstatus', 'page_title'));
    }// End Method
    public function UpdateProductInventoryStock(Request $request)
    {
        // Validate the form data
        $request->validate([
            'new_stock.*' => 'required|numeric',
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find the corresponding ProductInventory
            $productInventory = ProductInventory::findOrFail($productId);
            $productInventory->previous_stock = DB::raw('present_stock + ' . $request->input("new_stock.$productId"));
            $productInventory->present_stock = DB::raw('present_stock + ' . $request->input("new_stock.$productId"));
            $productInventory->save();

            // Find the corresponding Product
            $product = Product::findOrFail($productId);
            $product->stock = DB::raw('stock + ' . $request->input("new_stock.$productId"));
            $product->save();
        }

        $page_title = "Edit Product Inventory";
        $products = Product::where('status', '1')->get();
        $wizardstatus = 1;
        Alert::success('Success', 'Product Stock updated successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect with success message
        return view('admin.inventory.product.edit', compact('products', 'wizardstatus', 'page_title'));
    }// End Method
    public function UpdateProductInventoryPrice(Request $request)
    {
        // Validate the form data
        $request->validate([
            'purchase_price.*' => 'required|numeric',
            'sales_price.*' => 'required|numeric',
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find the corresponding ProductInventory
            $productInventory = ProductInventory::findOrFail($productId);
            $productInventory->purchase_price = $request->input("purchase_price.$productId", $productInventory->purchase_price);
            $productInventory->sales_price = $request->input("sales_price.$productId", $productInventory->sales_price);
            $productInventory->save();

            // Find the corresponding Product
            $product = Product::findOrFail($productId);
            $product->purchase_price = $request->input("purchase_price.$productId", $product->purchase_price);
            $product->sales_price = $request->input("sales_price.$productId", $product->sales_price);
            $product->save();
        }

        $page_title = "Edit Product Inventory";
        $products = Product::all();
        $wizardstatus = 2;
        Alert::success('Success', 'Product Price updated successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect with success message
        return view('admin.inventory.product.edit', compact('products', 'wizardstatus', 'page_title'));
    }// End Method
    public function UpdateProductInventoryDate(Request $request)
    {
        // Validate the form data
        $request->validate([
            'purchase_date.*' => 'required|date',
            'expiry_date.*' => 'required|date'
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find the corresponding ProductInventory
            $productInventory = ProductInventory::findOrFail($productId);
            $productInventory->purchase_date = $request->input("purchase_date.$productId", now());
            $productInventory->expiry_date = $request->input("expiry_date.$productId", $productInventory->expiry_date);;
            $productInventory->save();

            // Find the corresponding Product
            $product = Product::findOrFail($productId);
            $product->purchase_date = $request->input("purchase_date.$productId", now());
            $product->expiry_date = $request->input("expiry_date.$productId", $product->expiry_date);
            $product->save();
        }

        Alert::success('Success', 'Product Inventory updated successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect with success message
        return redirect()->route('inventory.product.index');
    }// End Method
    public function updateProductInventory(Request $request)
    {
        // Validate the form data
        $request->validate([
            'new_stock.*' => 'required|numeric',
            'purchase_price.*' => 'required|numeric',
            'sales_price.*' => 'required|numeric',
            'purchase_date.*' => 'required|date',
            'expiry_date.*' => 'required|date'
        ]);

        // Loop through the data and update the ProductInventory and Product models
        foreach ($request->input('product_id') as $productId) {
            // Find or create ProductInventory
            $productInventory = ProductInventory::updateOrCreate(
                ['product_id' => $productId],
                [
                    'previous_stock' => DB::raw('previous_stock + ' . $request->input("new_stock.$productId")),
                    'present_stock' => DB::raw('present_stock + ' . $request->input("new_stock.$productId")),
                    'purchase_price' => $request->input("purchase_price.$productId", 0),
                    'sales_price' => $request->input("sales_price.$productId", 0),
                    'purchase_date' => $request->input("purchase_date.$productId", now()),
                    'expiry_date' => $request->input("expiry_date.$productId"),
                ]
            );

            // Find the corresponding Product
            $product = Product::findOrFail($productId);

            // Update Product data
            $product->stock = DB::raw('stock + ' . $request->input("new_stock.$productId"));
            $product->purchase_price = $request->input("purchase_price.$productId", $product->purchase_price);
            $product->sales_price = $request->input("sales_price.$productId", $product->sales_price);
            $product->purchase_date = $request->input("purchase_date.$productId", now());
            $product->expiry_date = $request->input("expiry_date.$productId", $product->expiry_date);

            // Save changes
            $product->save();
        }

        Alert::success('Success', 'Product inventory updated successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect with success message
        return redirect()->route('inventory.store.index');
    }// End Method

    // Store Inventory Method
    public function AllStoreInventory()
    {
        $page_title = "Store Item List";
        $storeinventories = StoreInventory::all();
        return view('admin.inventory.store.index', compact('page_title', 'storeinventories'));
    }// End Method
    public function AddStoreInventory()
    {
        $categories = Category::where('type', 3)->get();
        $suppliers = Supplier::latest()->get();
        $page_title = 'Create New Store Item';
        return view('admin.inventory.store.create', compact('page_title', 'categories', 'suppliers'));
    }// End Method
    public function StoreStoreInventory(Request $request)
    {
        $itemcode = IdGenerator::generate(['table' => 'store_inventories','field' => 'code','length' => 7, 'prefix' => 'SC' ]);

        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'stock' => 'required',
            'stock_value' => 'required',
        ]);

        if ($request->stock == 0) {
            $stock_status = 0;
        }
        else {
            $stock_status = 1;
        }

        $storeinventory = new StoreInventory;
        $storeinventory->category_id = $request->category_id;
        $storeinventory->supplier_id = $request->supplier_id;
        $storeinventory->name = $request->name;
        $storeinventory->description = $request->description;
        $storeinventory->code = $itemcode;
        $storeinventory->purchase_date = $request->purchase_date;
        $storeinventory->purchase_price = $request->purchase_price;
        $storeinventory->stock = $request->stock;
        $storeinventory->stock_value = $request->stock_value;
        $storeinventory->stock_status = $stock_status;
        $storeinventory->expiry_date = $request->expiry_date;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\store_images\\' . $storeinventory->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\store_images'))) {
                mkdir(public_path('uploads\\store_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\store_images\\' . $filename), 90);
            $storeinventory->thumbnail = $filename;
        }

        $storeinventory->save();

        Alert::success('Success', 'Item created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('inventory.store.index');
    }// End Method
    public function EditStoreInventory($id)
    {
        // Retrieve the product by ID
        $storeItem = StoreInventory::where('id', '=', $id)->first();
        $categories = Category::where('type', 3)->get();
        $suppliers = Supplier::latest()->get();
        $page_title = 'Store Item Edit';

        return view('admin.inventory.store.edit', compact('page_title', 'categories', 'storeItem', 'suppliers'));
    }// End Method
    public function UpdateStoreInventory(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'stock' => 'required',
            'stock_value' => 'required',
        ]);

        if ($request->stock == 0) {
            $stock_status = 0;
        }
        else {
            $stock_status = 1;
        }

        $storeItem = StoreInventory::findOrFail($id);
        $storeItem->category_id = trim($request->category_id);
        $storeItem->supplier_id = trim($request->supplier_id);
        $storeItem->name = trim($request->name);
        $storeItem->description = trim($request->description);
        $storeItem->purchase_date= trim($request->purchase_date);
        $storeItem->purchase_price= trim($request->purchase_price);
        $storeItem->stock = trim($request->stock);
        $storeItem->stock_value = trim($request->stock_value);
        $storeItem->stock_status = $stock_status;
        $storeItem->expire_date = trim($request->expire_date);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\store_images\\' . $storeItem->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\store_images'))) {
                mkdir(public_path('uploads\\store_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\store_images\\' . $filename), 90);
            $storeItem->thumbnail = $filename;
        }

        $storeItem->save();
        Alert::success('Success', 'Item Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('inventory.store.index');
    }// End Method
    public function DeleteInventory($id)
    {
        // Find the storeItem record by the user ID
        $storeItem = StoreInventory::find($id);

        if ($storeItem) {
            // Delete the storeItem photo (if exists)
            if (!empty($storeItem->thumbnail) && file_exists(public_path('uploads/store_images/' . $storeItem->thumbnail))) {
                unlink(public_path('uploads/store_images/' . $storeItem->thumbnail));
            }

            // Delete the storeItem record
            $storeItem->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Inventory Method


    // Start Expense Method
    public function DailyExpense()
    {
        $page_title = "Expense List";
        $date = date("d-m-Y");
        $daily = Expense::where('date', $date)->get();
        return view('admin.expense.daily', compact('page_title', 'daily'));
    }// End Method
    public function WeeklyExpense()
    {
        $page_title = "Expense List";

        $startDate =date("d F Y", strtotime("-1 week"));
        $endDate = date("d F Y");
        $weekly = Expense::whereBetween('date', [$startDate, $endDate])->get();

        return view('admin.expense.weekly', compact('page_title', 'weekly', 'startDate', 'endDate'));
    }// End Method
    public function MonthlyExpense()
    {
        $page_title = "Expense List";
        $month = date("F");
        $monthly = Expense::where('month',$month)->get();
        return view('admin.expense.monthly', compact('page_title', 'monthly'));
    }// End Method
    public function YearlyExpense()
    {
        $page_title = "Expense List";
        $year = date("Y");
        $yearly = Expense::where('year',$year)->get();
        return view('admin.expense.yearly', compact('page_title', 'yearly'));
    }// End Method
    public function AddExpense()
    {
        $page_title = 'Expense Create';
        return view('admin.expense.create', compact('page_title'));
    }// End Method
    public function StoreExpense(Request $request)
    {
        $request->validate([
            'details' => 'required',
            'amount' => 'required',
            'month' => 'required',
            'year' => 'required',
            'date' => 'required',
        ]);

        $expense = new Expense;
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->month = $request->month;
        $expense->year = $request->year;
        $expense->date = $request->date;
        $expense->save();

        Alert::success('Success', 'Expense created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->back();
    }// End Method
    public function EditExpense($id)
    {
        // Retrieve the expense by ID
        $expense = Expense::where('id', '=', $id)->first();
        $page_title = 'Expense Edit';

        return view('admin.expense.edit', compact('page_title', 'expense'));
    }// End Method
    public function UpdateExpense(Request $request, $id)
    {
        $request->validate([
            'details' => 'required',
            'amount' => 'required',
            'month' => 'required',
            'year' => 'required',
            'date' => 'required',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->details = trim($request->details);
        $expense->amount = trim($request->amount);
        $expense->month = trim($request->month);
        $expense->year = trim($request->year);
        $expense->date= trim($request->date);
        $expense->save();

        Alert::success('Success', 'Expense Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->back();
    }// End Method
    public function DeleteExpense($id)
    {
        $expense = Expense::find($id);
        if ($expense){
            $expense->delete();
        }
        return back();
    }
    // End Expense Method


    // Start Gallery Method
    public function AllGallery()
    {
        if (request('type') == 'photo') {
            $galleries = Gallery::where('type', 0)->get();
            $page_title = 'Photo Gallery List';
        }
        elseif (request('type') == 'video') {
            $galleries = Gallery::where('type', 1)->get();
            $page_title = 'Video Gallery List';
        }
        return view('admin.gallery.index', compact('page_title', 'galleries'));
    }// End Method
    public function Addgallery()
    {
        $page_title = 'Gallery Create';
        return view('admin.gallery.create', compact('page_title'));
    }// End Method
    public function StoreGallery(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'type' => 'required',
        ]);

        if ($request->type == 0) {
            // Validate for Photo
            $request->validate([
                'photo' => 'required|mimes:jpg,jpeg,png',
            ]);

            $gallery = new Gallery;
            $gallery->caption = trim($request->caption);
            $gallery->type = 0;
            $gallery->video_link = null;

            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('uploads\\gallery_images\\' . $gallery->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\gallery_images'))) {
                    mkdir(public_path('uploads\\gallery_images'), 0755, true);
                }

                Image::make($file)->fit(300, 300)->save(public_path('uploads\\gallery_images\\' . $filename), 90);
                $gallery->photo = $filename;
            }
        }

        elseif ($request->type == 1) {
            // Validate for Video
            $request->validate([
                'video_link' => 'required|url',
                'vphoto' => 'required|mimes:jpg,jpeg,png',
            ]);

            $gallery = new Gallery;
            $gallery->caption = trim($request->caption);
            $gallery->type = 1;
            $gallery->video_link = 'https://www.youtube.com/embed/' . $request->video_link;

            if ($request->file('vphoto')) {
                $file = $request->file('vphoto');
                @unlink(public_path('uploads\\gallery_images\\' . $gallery->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\gallery_images'))) {
                    mkdir(public_path('uploads\\gallery_images'), 0755, true);
                }

                Image::make($file)->fit(300, 300)->save(public_path('uploads\\gallery_images\\' . $filename), 90);
                $gallery->photo = $filename;
            }
        }

        $gallery->save();

        Alert::success('Success', 'Gallery created successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect back to the appropriate gallery type
        return redirect()->route('gallery.index', ['type' => $request->type == 0 ? 'photo' : 'video']);
    }// End Method
    public function EditGallery($id)
    {
        // Retrieve the gallery by ID
        $gallery = Gallery::where('id', '=', $id)->first();
        $page_title = 'Gallery Edit';


        return view('admin.gallery.edit', compact('page_title', 'gallery'));
    }// End Method
    public function UpdateGallery(Request $request, $id)
    {
        $request->validate([
            'caption' => 'required',
            'type' => 'required',
        ]);

        // Check the type to determine which fields to validate and update
        if ($request->type == 0) {

            $gallery = Gallery::findOrFail($id);
            $gallery->caption = trim($request->caption);
            $gallery->type = 0;
            $gallery->video_link = null;

            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('uploads\\gallery_images\\' . $gallery->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\gallery_images'))) {
                    mkdir(public_path('uploads\\gallery_images'), 0755, true);
                }

                Image::make($file)->fit(300, 300)->save(public_path('uploads\\gallery_images\\' . $filename), 90);
                $gallery->photo = $filename;
            }

        } elseif ($request->type == 1) {
            // Validate for Video
            $request->validate([
                'video_link' => 'required|url',
            ]);

            $gallery = Gallery::findOrFail($id);
            $gallery->caption = trim($request->caption);
            $gallery->type = 1;
            $gallery->video_link = $request->video_link;

            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('uploads\\gallery_images\\' . $gallery->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\gallery_images'))) {
                    mkdir(public_path('uploads\\gallery_images'), 0755, true);
                }

                Image::make($file)->fit(300, 300)->save(public_path('uploads\\gallery_images\\' . $filename), 90);
                $gallery->photo = $filename;
            }
        }

        $gallery->update();

        Alert::success('Success', 'Gallery Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        // Redirect back to the appropriate gallery type
        return redirect()->route('gallery.index', ['type' => $gallery->type == 0 ? 'photo' : 'video']);
    }// End Method
    public function DeleteGallery($id)
    {
        // Find the gallery record by the user ID
        $gallery = Gallery::find($id);

        if ($gallery) {
            // Delete the gallery photo (if exists)
            if (!empty($gallery->thumbnail) && file_exists(public_path('uploads/gallery_images/' . $gallery->thumbnail))) {
                unlink(public_path('uploads/gallery_images/' . $gallery->thumbnail));
            }

            // Delete the gallery record
            $gallery->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Gallery Method


    // Start Service Method
    public function AllService()
    {
        $page_title = "Service List";
        $services = Service::all();
        return view('admin.service.index', compact('page_title', 'services'));
    }// End Method
    public function AddService()
    {
        $page_title = 'Service Create';
        return view('admin.service.create', compact('page_title'));
    }// End Method
    public function StoreService(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'description' => 'required',
            'status' => 'required',
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->status = $request->status;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\service_images\\' . $service->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\service_images'))) {
                mkdir(public_path('uploads\\service_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\service_images\\' . $filename), 90);
            $service->thumbnail = $filename;
        }

        $service->save();

        Alert::success('Success', 'Service created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('service.index');
    }// End Method
    public function EditService($id)
    {
        // Retrieve the service by ID
        $service = Service::where('id', '=', $id)->first();
        $page_title = 'Service Edit';


        return view('admin.service.edit', compact('page_title', 'service'));
    }// End Method
    public function UpdateService(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $service = Service::findOrFail($id);
        $service->name = trim($request->name);
        $service->description = trim($request->description);
        $service->status = trim($request->status);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\service_images\\' . $service->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\service_images'))) {
                mkdir(public_path('uploads\\service_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\service_images\\' . $filename), 90);
            $service->thumbnail = $filename;
        }

        $service->save();

        Alert::success('Success', 'Service Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('service.index');
    }// End Method
    public function DeleteService($id)
    {
        // Find the service record by the user ID
        $service = Service::find($id);

        if ($service) {
            // Delete the service photo (if exists)
            if (!empty($service->thumbnail) && file_exists(public_path('uploads/service_images/' . $service->thumbnail))) {
                unlink(public_path('uploads/service_images/' . $service->thumbnail));
            }

            // Delete the service record
            $service->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Service Method


    // Start Slider Method
    public function AllSlider()
    {
        $page_title = "Slider List";
        $sliders = Slider::all();
        return view('admin.slider.index', compact('page_title', 'sliders'));
    }// End Method
    public function AddSlider()
    {
        $page_title = 'Slider Create';
        return view('admin.slider.create', compact('page_title'));
    }// End Method
    public function StoreSlider(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png',
        ]);

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\slider_images\\' . $slider->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\slider_images'))) {
                mkdir(public_path('uploads\\slider_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\slider_images\\' . $filename));
            $slider->photo = $filename;
        }

        $slider->save();

        Alert::success('Success', 'Slider created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('slider.index');
    }// End Method
    public function EditSlider($id)
    {
        // Retrieve the slider by ID
        $slider = Slider::where('id', '=', $id)->first();
        $page_title = 'Slider Edit';


        return view('admin.slider.edit', compact('page_title', 'slider'));
    }// End Method
    public function UpdateSlider(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\slider_images\\' . $slider->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\slider_images'))) {
                mkdir(public_path('uploads\\slider_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\slider_images\\' . $filename));
            $slider->photo = $filename;
        }

        $slider->save();

        Alert::success('Success', 'Slider Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('slider.index');
    }// End Method
    public function DeleteSlider($id)
    {
        // Find the slider record by the user ID
        $slider = Slider::find($id);

        if ($slider) {
            // Delete the slider photo (if exists)
            if (!empty($slider->photo) && file_exists(public_path('uploads/slider_images/' . $slider->photo))) {
                unlink(public_path('uploads/slider_images/' . $slider->photo));
            }

            // Delete the slider record
            $slider->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Slider Method


    // Start Team Method
    public function AllTeam()
    {
        $page_title = "Team List";
        $teams = Team::all();
        return view('admin.team.index', compact('page_title', 'teams'));
    }// End Method
    public function AddTeam()
    {
        $page_title = 'Team Create';
        return view('admin.team.create', compact('page_title'));
    }// End Method
    public function StoreTeam(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'designation' => 'required'
        ]);

        $team = new Team;
        $team->name = $request->name;
        $team->designation = $request->designation;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\team_images\\' . $team->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\team_images'))) {
                mkdir(public_path('uploads\\team_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\team_images\\' . $filename));
            $team->thumbnail = $filename;
        }

        $team->save();

        Alert::success('Success', 'Team created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('team.index');
    }// End Method
    public function EditTeam($id)
    {
        // Retrieve the team by ID
        $team = Team::where('id', '=', $id)->first();
        $page_title = 'Team Edit';

        return view('admin.team.edit', compact('page_title', 'team'));
    }// End Method
    public function UpdateTeam(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'designation' => 'required'
        ]);

        $team = Team::findOrFail($id);
        $team->name = trim($request->name);
        $team->designation = trim($request->designation);

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            @unlink(public_path('uploads\\team_images\\' . $team->thumbnail));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\team_images'))) {
                mkdir(public_path('uploads\\team_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\team_images\\' . $filename));
            $team->thumbnail = $filename;
        }

        $team->save();

        Alert::success('Success', 'Team Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('team.index');
    }// End Method
    public function DeleteTeam($id)
    {
        // Find the team record by the user ID
        $team = Team::find($id);

        if ($team) {
            // Delete the team photo (if exists)
            if (!empty($team->thumbnail) && file_exists(public_path('uploads/team_images/' . $team->thumbnail))) {
                unlink(public_path('uploads/team_images/' . $team->thumbnail));
            }

            // Delete the team record
            $team->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Team Method


    // Start Testimonial Method
    public function AllTestimonial()
    {
        $page_title = "Testimonial List";
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('page_title', 'testimonials'));
    }// End Method
    public function AddTestimonial()
    {
        $page_title = 'Testimonial Create';
        return view('admin.testimonial.create', compact('page_title'));
    }// End Method
    public function StoreTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png'
        ]);

        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\testimonial_images\\' . $testimonial->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\testimonial_images'))) {
                mkdir(public_path('uploads\\testimonial_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\testimonial_images\\' . $filename));
            $testimonial->photo = $filename;
        }

        $testimonial->save();

        Alert::success('Success', 'Testimonial created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('testimonial.index');
    }// End Method
    public function EditTestimonial($id)
    {
        // Retrieve the testimonial by ID
        $testimonial = Testimonial::where('id', '=', $id)->first();
        $page_title = 'Testimonial Edit';

        return view('admin.testimonial.edit', compact('page_title', 'testimonial'));
    }// End Method
    public function UpdateTestimonial(Request $request, $id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'name' => 'required',
            'message' => 'required'
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = trim($request->name);
        $testimonial->message = trim($request->message);

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads\\testimonial_images\\' . $testimonial->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\testimonial_images'))) {
                mkdir(public_path('uploads\\testimonial_images'), 0755, true);
            }

            Image::make($file)->save(public_path('uploads\\testimonial_images\\' . $filename));
            $testimonial->photo = $filename;
        }

        $testimonial->save();

        Alert::success('Success', 'Testimonial Updated Successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('testimonial.index');
    }// End Method
    public function DeleteTestimonial($id)
    {
        // Find the testimonial record by the user ID
        $testimonial = Testimonial::find($id);

        if ($testimonial) {
            // Delete the testimonial photo (if exists)
            if (!empty($testimonial->photo) && file_exists(public_path('uploads/testimonial_images/' . $testimonial->photo))) {
                unlink(public_path('uploads/testimonial_images/' . $testimonial->photo));
            }

            // Delete the testimonial record
            $testimonial->delete();
        }
        // Return a response or redirect as needed
        return back();

    }// End Method
    // End Testimonial Method


    // Start General Method
    public function AddGeneral()
    {
        $general = General::latest('created_at')->first();
        $page_title = 'General Information';

        return view('admin.general.create', compact('general', 'page_title'));
    }// End Method
    public function StoreGeneral(Request $request, $type,)
    {
        $request->validate([
            "company_name" => "required",
            "logo" => 'mimes:jpg,jpeg,png',
            "logo_sticky" => 'mimes:jpg,jpeg,png',
            "logo_favicon" => 'mimes:jpg,jpeg,png',
            "story_title" => "required",
            "story_description" => "required",
            "why_choose_us" => "required",
            "address" => "required",
            "primary_phone" => "required",
            "email" => "required",
            "delivery_fee" => "required"
        ]);

        if ($type === 'create') {

            // Create a new general item
            $general = new General;
            $general->company_name = $request->company_name;
            $general->story_title = $request->story_title;
            $general->story_description = $request->story_description;
            $general->why_choose_us = $request->why_choose_us;
            $general->address = $request->address;
            $general->primary_phone = $request->primary_phone;
            $general->secondary_phone = $request->secondary_phone;
            $general->email = $request->email;
            $general->facebook = $request->facebook;
            $general->twitter = $request->twitter;
            $general->instagram = $request->instagram;
            $general->delivery_fee = $request->delivery_fee;

            // Upload and save the logo
            if ($request->file('logo')) {
                $file = $request->file('logo');
                @unlink(public_path('uploads\\general_images\\' . $general->logo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo = $filename;
            }

            // Upload and save the logo_sticky
            if ($request->file('logo_sticky')) {
                $file = $request->file('logo_sticky');
                @unlink(public_path('uploads\\general_images\\' . $general->logo_sticky));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo_sticky = $filename;
            }

            // Upload and save the logo_favicon
            if ($request->file('logo_favicon')) {
                $file = $request->file('logo_favicon');
                @unlink(public_path('uploads\\general_images\\' . $general->logo_favicon));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo_favicon = $filename;
            }

            $general->save();

            // Display a success SweetAlert alert
            Alert::success('Success', 'General Details created successfully!')->showConfirmButton('OK', '#CE7F36');

        }
        else {
            // Retrieve the existing model
            $general = General::latest('created_at')->first();

            // Update a general item
            $general->company_name = trim($request->company_name);
            $general->story_title = trim($request->story_title);
            $general->story_description = trim($request->story_description);
            $general->why_choose_us = trim($request->why_choose_us);
            $general->address = trim($request->address);
            $general->primary_phone = trim($request->primary_phone);
            $general->secondary_phone = trim($request->secondary_phone);
            $general->email = trim($request->email);
            $general->facebook = trim($request->facebook);
            $general->twitter = trim($request->twitter);
            $general->instagram = trim($request->instagram);
            $general->delivery_fee = trim($request->delivery_fee);

            // Upload and save the logo
            if ($request->file('logo')) {
                $file = $request->file('logo');
                @unlink(public_path('uploads\\general_images\\' . $general->logo));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo = $filename;
            }

            // Upload and save the logo_sticky
            if ($request->file('logo_sticky')) {
                $file = $request->file('logo_sticky');
                @unlink(public_path('uploads\\general_images\\' . $general->logo_sticky));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo_sticky = $filename;
            }
            // Upload and save the logo_favicon
            if ($request->file('logo_favicon')) {
                $file = $request->file('logo_favicon');
                @unlink(public_path('uploads\\general_images\\' . $general->logo_favicon));
                $filename = date('YmdHi') . $file->getClientOriginalName();

                if (!is_dir(public_path('uploads\\general_images'))) {
                    mkdir(public_path('uploads\\general_images'), 0755, true);
                }

                Image::make($file)->save(public_path('uploads\\general_images\\' . $filename));
                $general->logo_favicon = $filename;
            }


            $general->save(); // Save the updated model

            // Display a success SweetAlert alert
            Alert::success('Success', 'General Details Updated Successfully!')->showConfirmButton('OK', '#CE7F36');
        }

        return back();
    }// End Method
    // End General Method Reservation


    // Start Database Method
    public function AllDatabase()
    {
        return view('admin.database.index')->with('files',File::allFiles(storage_path('/app/RAS')));
    }// End Method
    public function AddDatabase()
    {
        \Artisan::call('backup:run');
        Alert::success('Success', 'Database Backup Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->back();
    }// End Method
    public function DownloadDatabase($getFilename)
    {
        $path = storage_path('app\RAS/'.$getFilename);
        return response()->download($path);
    }// End Method
    public function DeleteDatabase($getFilename)
    {
        Storage::delete('RAS/'.$getFilename);
        return redirect()->back();
    }// End Method
    // End Database Method


    // Start Permission Method
    public function AllPermission()
    {
        $permissions = Permission::orderBy('group_name')->get();

        return view('admin.permission.index', compact('permissions'));
    }// End Method
    public function AddPermission()
    {
        return view('admin.permission.create');
    }// End Method
    public function StorePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        Alert::success('Success', 'Permission created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('permission.all');
    }// End Method
    public function EditPermission($id)
    {
        // Retrieve the permission by ID
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit',compact('permission'));

    }// End Method
    public function UpdatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
        ]);

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        Alert::success('Success', 'Permission updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('permission.all');
    }// End Method
    public function DeletePermission($id, Request $request)
    {
        // Find the supplier record by the user ID
        $permission = Permission::find($id);
        // Delete the permission record
        $permission->delete();

        return back();
    }// End Method
    public function ImportPermission()
    {
        $page_title = 'Permission Import';
        return view('admin.permission.import', compact('page_title'));
    }// End Method
    public function ExportPermission()
    {
        return Excel::download(new PermissionExport,'permission.xlsx');
    }// End Method
    public function ImportPermissionStore(Request $request)
    {
        validate($request, [
            'import_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ProductImport, $request->file('import_file'));
        Alert::success('Success', 'Permission Imported Successfully!')->showConfirmButton('OK', '#CE7F36');
        return redirect()->route('permission.index');
    }// End Method
    // End Permission Method


    // Start Role Method
    public function AllRole()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }// End Method
    public function Addrole()
    {
        return view('admin.role.create');
    }// End Method
    public function StoreRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Role created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('role.all');
    }// End Method
    public function EditRole($id)
    {
        // Retrieve the role by ID
        $role = Role::findOrFail($id);
        return view('admin.role.edit',compact('role'));

    }// End Method
    public function UpdateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Role updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('role.all');
    }// End Method
    public function DeleteRole($id, Request $request)
    {
        // Find the supplier record by the user ID
        $role = Role::find($id);
        // Delete the role record
        $role->delete();

        return back();
    }// End Method
    // End role Method


    // Start Role Permissions Method
    public function AllRolePermission()
    {
        $roles = Role::all();
        return view('admin.role_permission.index',compact('roles'));
    } // End Method
    public function AddRolePermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role_permission.create',compact('roles','permissions','permission_groups'));
    }// End Method
    Public function StoreRolePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission' => 'required',
        ]);

        $formdata = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item)
        {
           $formdata['role_id'] = $request->role_id;
           $formdata['permission_id'] = $item;

           DB::table('role_has_permissions')->insert($formdata);

        }

        Alert::success('Success', 'Role Permission created successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('role.permission.all');
    }// End Method
    public function EditRolePermission($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('admin.role_permission.edit',compact('role','permissions','permission_groups'));
    } // End Method
    public function UpdateRolePermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        // Check if all permission IDs exist
        $validPermissions = Permission::whereIn('id', $permissions)->pluck('id')->toArray();

        // Sync only the valid permissions
        $role->syncPermissions($validPermissions);

        Alert::success('Success', 'Role Permission updated successfully!')->showConfirmButton('OK', '#CE7F36');

        return redirect()->route('role.permission.all');
    }// End Method
    public function DeleteRolePermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return back();

    }// End Method
    // End Role Permissions Method


    // Start Admin Employee Role Method
    public function AdminAllEmployeeRoles()
    {
        $authUser = auth()->user();
        $employees = User::where('role', 'admin')->where('id', '!=', $authUser->id)->latest()->get();
        return view('admin.admin_employee_role.index', compact('employees'));
    }// End Method
    public function AdminAddEmployeeRoles()
    {
        $roles = Role::all();
        $users = User::whereIn('role', ['admin', 'employee'])->orderBy('created_at', 'desc')->get();
        return view('admin.admin_employee_role.create',compact('roles','users'));
    }// End Method
    public function AdminStoreEmployeeRoles(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'employee_id' => 'required',
        ]);

        $employee_id = $request->employee_id;
        $employee = User::whereIn('role', ['admin', 'employee'])->where('id', $employee_id)->first();
        $employee->role = 'admin';
        $employee->save();

        // Retrieve the role by its ID
        $role = Role::findById($request->role_id);

        // Check if the role exists
        if ($role)
        {
            // Assign the role to the employee
            $employee->assignRole($role);
            Alert::success('Success', 'Role assigned successfully!')->showConfirmButton('OK', '#CE7F36');
            return redirect()->route('employee.role.all');
        }
        else
        {
            // Handle the case where the role does not exist
            return redirect()->back()->with('error', 'Invalid role provided');
        }
    }
    public function AdminEditEmployeeRoles($id)
    {
        $roles = Role::all();
        $user = User::whereIn('role', ['admin', 'employee'])->where('users.id', '=', $id)->first();

        return view('admin.admin_employee_role.edit',compact('roles','user'));
    } // End Method
    public function AdminUpdateEmployeeRoles(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        $employee_id = $id;
        $employee = User::where('role', 'admin')->where('id', $employee_id)->first();

        $employee->roles()->detach();

        // Retrieve the role by its ID
        $role = Role::findById($request->role_id);

        // Check if the role exists
        if ($role)
        {
            // Assign the role to the employee
            $employee->assignRole($role);
            Alert::success('Success', 'Role assigned successfully!')->showConfirmButton('OK', '#CE7F36');
            return redirect()->route('employee.role.all');
        }
        else
        {
            // Handle the case where the role does not exist
            return redirect()->back()->with('error', 'Invalid role provided');
        }

    }// End Method
    public function AdminDetachEmployeeRoles($id)
    {
        $employee_id = $id;
        $employee = User::where('role', 'admin')->where('id', $employee_id)->first();

        $employee->roles()->detach();

        $employee->role = 'employee';
        $employee->save();

        return back();

    }// End Method
    // End Admin Employee Role Method


    // Start Employee Role Method
    public function AllEmployeeRoles()
    {
        $excludedUserId = 1;
        $authUser = auth()->user();
        $employees = User::where('role', 'admin')->where('id', '!=', $excludedUserId)->where('id', '!=', $authUser->id)->latest()->get();
        return view('admin.employee_role.index', compact('employees'));
    }// End Method
    public function AddEmployeeRoles()
    {
        $roles = Role::where('name', '!=', 'Super Administrator')->get();
        $employees = User::where('role', 'employee')->latest('created_at')->get();
        return view('admin.employee_role.create',compact('roles','employees'));
    }// End Method
    public function StoreEmployeeRoles(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'employee_id' => 'required',
        ]);

        $employee_id = $request->employee_id;
        $employee = User::where('role', 'employee')->where('id', $employee_id)->first();
        $employee->role = 'admin';
        $employee->save();

        // Retrieve the role by its ID
        $role = Role::findById($request->role_id);

        // Check if the role exists
        if ($role)
        {
            // Assign the role to the employee
            $employee->assignRole($role);
            Alert::success('Success', 'Employee Role assigned successfully!')->showConfirmButton('OK', '#CE7F36');
            return redirect()->route('employee.role.all');
        }
        else
        {
            // Handle the case where the role does not exist
            return redirect()->back()->with('error', 'Invalid role provided');
        }
    }
    public function EditEmployeeRoles($id)
    {
        $roles = Role::all();
        $employee = User::where('role', 'admin')->where('users.id', '=', $id)->first();

        return view('admin.employee_role.edit',compact('roles','employee'));
    } // End Method
    public function UpdateEmployeeRoles(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required',
        ]);

        $employee_id = $id;
        $employee = User::where('role', 'admin')->where('id', $employee_id)->first();

        $employee->roles()->detach();

        // Retrieve the role by its ID
        $role = Role::findById($request->role_id);

        // Check if the role exists
        if ($role)
        {
            // Assign the role to the employee
            $employee->assignRole($role);
            Alert::success('Success', 'Employee Role assigned successfully!')->showConfirmButton('OK', '#CE7F36');
            return redirect()->route('employee.role.all');
        }
        else
        {
            // Handle the case where the role does not exist
            return redirect()->back()->with('error', 'Invalid role provided');
        }

    }// End Method
    public function DetachEmployeeRoles($id)
    {
        $employee_id = $id;
        $employee = User::where('role', 'admin')->where('id', $employee_id)->first();

        $employee->roles()->detach();

        $employee->role = 'employee';
        $employee->save();

        return back();

    }// End Method
    // End Employee Role Method


}
