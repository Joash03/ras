<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Employee;
use App\Models\AdvanceSalary;
use App\Models\Order;
use App\Models\Orderdetails;

use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    // Start Accounts Method
    public function EmployeeDashboard(Request $request)
    {
        $date = date('d F Y');
        $authid = Auth::user()->id;

        $totalorders = Order::whereIn('order_status', [1, 2])->where('user_id', $authid)->latest('created_at')->get();
        $totalpendingorders = Order::where('order_status', 0)->where('user_id', $authid)->latest('created_at')->get();
        $pendingorders = Order::where('order_status', 0)->where('user_id', $authid)->latest('created_at')->get();

        $employee = Employee::where('employee_id', $authid)->first();
        $advancesalary = AdvanceSalary::where('employee_id', $authid)->first();
        if ($advancesalary == null) {
            $advancesalary = 0;
        } else {
            $advancesalary = $advancesalary->advance_salary;
        }
        return view('employee.index', compact('date', 'pendingorders', 'totalorders', 'totalpendingorders', 'employee', 'advancesalary'));
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
        return view('employee.employee_profile',compact('profileData'));
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
            @unlink(public_path('uploads\\employee_images\\' . $formData->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            if (!is_dir(public_path('uploads\\employee_images'))) {
                mkdir(public_path('uploads\\employee_images'), 0755, true);
            }

            Image::make($file)->fit(300, 300)->save(public_path('uploads\\employee_images\\' . $filename), 90);
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
        return view('employee.employee_change_password');
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


    // Start Order Method
    public function EmployeeOrder()
    {
        $authid = Auth::user()->id;
            $orders = Order::where('order_status', 0)->where('user_id', $authid)->latest('created_at')->get();
            $page_title = 'Order List';
            $orderdetails = Orderdetails::with('order')->get();

        return view('employee.order.index', compact('page_title', 'orders', 'orderdetails'));
    }// End Method
    public function EmployeeOrderHistory()
    {
        $authid = Auth::user()->id;
        $page_title = 'Order History';
        $orders = Order::whereIn('order_status', [1, 2])->where('user_id', $authid)->latest('created_at')->get();
        $orderdetails = Orderdetails::with('order')->get();

        return view('employee.order.history', compact('page_title', 'orders', 'orderdetails'));
    }// End Method
    // End Order Method


    // Start Invoice Method
    public function EmployeeCreateInvoice($id)
    {
        $page_title = "Order Inoice";

        $orderid = $id;
        $order = Order::find($orderid);
        $orderdetails = $order->orderdetails;

        $cust_id = $order->user_id;
        $employee = User::where('role', 'employee')->where('id',$cust_id)->first();

        return view('employee.invoice.index', compact('page_title', 'order', 'employee', 'orderdetails'));

    }// End Method
    // End Invoice Method
}

