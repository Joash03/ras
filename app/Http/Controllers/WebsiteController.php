<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Product;
use App\Models\WebCart;
use App\Models\Reserve;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\General;

use App\Mail\Reservation;
use App\Mail\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class WebsiteController extends Controller
{
    public function index()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $sliders = Slider::all();
        $menus = Menu::where('status', '1')->orderBy('id', 'DESC')->limit(8)->get();
        $products = Product::where('status', '1')->where('stock_status', '1')->orderBy('id', 'DESC')->limit(8)->get();

        return view('home', compact('sliders', 'menus', 'products', 'carts'));
    } // End Method

    public function reserve(Request $request)
    {
        $reserve = new Reserve;
        $reserve->date = $request->date;
        $reserve->time = $request->time;
        $reserve->people = $request->people;
        $reserve->name = $request->name;
        $reserve->email = $request->email;
        $reserve->phone = $request->phone;
        $reserve->description = $request->description;
        $reserve->status = 0;
        $reserve->save();

        $data = [
            'title' => 'Reservation Form',
            'name' => $reserve->name,
            'message' => 'Thank you for making reservation with us. We will contact you soon!'
        ];
        Mail::to($reserve->email)->send(new Reservation($data));

        Alert::success('Success', 'Reservation submitted Successfully!')->showConfirmButton('OK', '#3085d6');
        return redirect()->route('home.reserve');
    } // End Method

    public function gallery($type)
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        if ($type === 'photo') {
            $data = Gallery::where('type', 0)->get();
            return view('frontend.gallery.photo', compact('data', 'carts'));
        }

        $data = Gallery::where('type', 1)->get();
        return view('frontend.gallery.video', compact('data', 'carts'));
    } // End Method

    public function blog()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $blogs = Blog::where('status', 1)->get();
        $categories = Category::where('type', 2)->get();
        $latests = Blog::latest('created_at')->limit(3)->get();

        return view('frontend.blog.index', compact('blogs', 'latests', 'categories', 'carts'));
    } // End Method

    public function getBlog(Blog $blog)
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $categories = Category::where('type', 1)->get();
        $latests = Blog::latest('created_at')->limit(3)->get();

        return view('frontend.blog.details', compact('blog', 'latests', 'categories', 'carts'));
    } // End Method

    public function getCategoryBlogs($id)
    {
        $blogs = Blog::where('category_id', $id)->get();
        $categories = Category::where('type', 1)->get();
        $latests = Blog::latest('created_at')->limit(3)->get();

        return view('frontend.blog.index', compact('blogs', 'latests', 'categories'));
    } // End Method

    public function about()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $services = Service::where('status', 1)->limit(4)->get();
        $teams = Team::all();
        $testimonials = Testimonial::all();

        return view('frontend.about', compact('services', 'teams', 'testimonials', 'carts'));
    } // End Method

    public function contact()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        return view('frontend.contact', compact('carts'));
    } // End Method

    public function mail(Request $request )
    {
        $data = [
            'title' => 'Contact Form',
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        $general = General::first();
        Mail::to($general->email)->send(new Contact($data));
        Alert::success('Success', 'Message Sent Successfuly!')->showConfirmButton('OK', '#3085d6');

        return back();
    } // End Method

    public function menu()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $starters = Menu::where('status', '1')->orderBy('price')->limit(4)->get();
        $menus = Menu::where('status', '1')->orderBy('id', 'DESC')->get();

        return view('frontend.menu', compact('menus', 'starters', 'carts'));
    } // End Method

    public function product()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        $starters = Product::where('status', '1')->where('stock_status', '1')->orderBy('sales_price')->limit(4)->get();
        $products = Product::where('status', '1')->where('stock_status', '1')->orderBy('id', 'DESC')->get();

        return view('frontend.product', compact('products', 'starters', 'carts'));
    } // End Method

    public function addmenuCart($page_id, $id)
    {
        $user = auth()->check() ? auth()->user()->id : null;
        $query = function ($query) use ($id) {
            $query->where('item_id', $id)->where('item_type', 'menu');
        };

        if ($user) {
            $cart = WebCart::where('user_id', $user)->where($query)->first();
            $cartCount = WebCart::where('user_id', $user)->count();

            if ($cartCount >= 7)
            {
                Alert::info('Cart Full', 'The cart is Full! Please Checkout')->showConfirmButton('OK', '#3085d6');

                if ($page_id == 0) {
                    return redirect()->route('home.menu');
                } else {
                    return redirect()->route('menu.menu');
                }
            }
            else {
                if ($cart) {
                    $cart->increment('quantity');
                }
                else {
                    WebCart::create([
                        'item_id' => $id,
                        'item_type' => 'menu',
                        'quantity' => 1,
                        'user_id' => $user
                    ]);
                }
            }
        }
        else {
            $sessionKey = session()->getId();
            $cart = WebCart::where('session_key', $sessionKey)->where($query)->first();
            $cartCount = WebCart::where('session_key', $sessionKey)->count();

            if ($cartCount >= 7)
            {
                Alert::info('Cart Full', 'The cart is Full! Please Checkout')->showConfirmButton('OK', '#3085d6');

                if ($page_id == 0) {
                    return redirect()->route('home.menu');
                } else {
                    return redirect()->route('menu.menu');
                }
            }
            else {
                if ($cart) {
                    $cart->increment('quantity');
                }
                else {
                    WebCart::create([
                        'item_id' => $id,
                        'item_type' => 'menu',
                        'quantity' => 1,
                        'session_key' => $sessionKey
                    ]);
                }
            }
        }

        Alert::success('Success', 'Menu item added to Cart!')->showConfirmButton('OK', '#3085d6');

        if ($page_id == 0) {
            return redirect()->route('home.menu');
        } else {
            return redirect()->route('menu.menu');
        }
    } // End Method

    public function addproductCart($page_id, $id)
    {
        $user = auth()->check() ? auth()->user()->id : null;
        $query = function ($query) use ($id) {
            $query->where('item_id', $id)->where('item_type', 'product');
        };

        if ($user) {
            $cart = WebCart::where('user_id', $user)->where($query)->first();
            $cartCount = WebCart::where('user_id', $user)->count();

            if ($cartCount >= 7)
            {
                Alert::info('Cart Full', 'The cart is Full! Please Checkout')->showConfirmButton('OK', '#3085d6');

                if ($page_id == 0) {
                    return redirect()->route('home.product');
                } else {
                    return redirect()->route('product.product');
                }
            }
            else {
                if ($cart) {
                    $cart->increment('quantity');
                }
                else {
                    WebCart::create([
                        'item_id' => $id,
                        'item_type' => 'product',
                        'quantity' => 1,
                        'user_id' => $user
                    ]);
                }
            }
        }
        else {
            $sessionKey = session()->getId();
            $cart = WebCart::where('session_key', $sessionKey)->where($query)->first();
            $cartCount = WebCart::where('session_key', $sessionKey)->count();

            if ($cartCount >= 7)
            {
                Alert::info('Cart Full', 'The cart is Full! Please Checkout')->showConfirmButton('OK', '#3085d6');

                if ($page_id == 0) {
                    return redirect()->route('home.product');
                } else {
                    return redirect()->route('product.product');
                }
            }
            else {
                if ($cart) {
                    $cart->increment('quantity');
                }
                else {
                    WebCart::create([
                        'item_id' => $id,
                        'item_type' => 'product',
                        'quantity' => 1,
                        'session_key' => $sessionKey
                    ]);
                }
            }
        }

        Alert::success('Success', 'Product item added to Cart!')->showConfirmButton('OK', '#3085d6');

        if ($page_id == 0) {
            return redirect()->route('home.product');
        } else {
            return redirect()->route('product.product');
        }
    } // End Method

    public function getCart()
    {
        $user = auth()->check() ? auth()->user()->id : null;

        if ($user) {
            $carts = WebCart::where('user_id', $user)->get();
        }
        else {
            $sessionKey = session()->getId() ? session()->getId() : null;
            $carts = WebCart::where('session_key', $sessionKey)->get();
        }

        return view('frontend.cart', compact('carts'));
    } // End Method

    public function updateCart(Request $request, $user = null)
    {
        $carts = WebCart::where(function ($query) use ($user) {
            if ($user) {
                $query->where('user_id', $user);
            } else {
                $query->where('session_key', session()->getId());
            }
        })->get();

        foreach ($carts as $cart) {
            $quantity = "quantity_" . $cart->id;
            $cart->update([
                'quantity' => $request->$quantity
            ]);
        }

        Alert::success('Success', 'Cart Updated Successfully!')->showConfirmButton('OK', '#3085d6');

        return redirect(route('getcart', $user));
    } // End Method

    public function destroyCart(WebCart $cart, $user = null)
    {
        $cart->delete();
        Alert::success('Success', 'Item Deleted Successfully!')->showConfirmButton('OK', '#3085d6');

        return redirect()->back();
    } // End Method

    public function checkout()
    {
        $user = auth()->check() ? auth()->user()->id : null;
        $orderuser = User::where('id', $user)->first();
        if ($user) {
            $cartCount = WebCart::where('user_id', $user)->count();

            if ($cartCount == 0) {
                Alert::info('Cart Empty', 'The cart is Empty! Please add an item')->showConfirmButton('OK', '#3085d6');
                return back();
            }
            else {
                $carts = WebCart::where('user_id', $user)->get();
            }
        }
        else {
            $sessionKey = session()->getId();
            $cartCount = WebCart::where('session_key', $sessionKey)->count();

            if ($cartCount == 0) {
                Alert::info('Cart Empty', 'The cart is Empty! Please add an item')->showConfirmButton('OK', '#3085d6');
                return back();
            }
            else {
                $carts = WebCart::where('session_key', $sessionKey)->get();
            }

        }

        return view('frontend.checkout', compact('carts', 'orderuser'));
    } // End Method

    public function verifyorder($reference)
    {
        $secret_key = "sk_test_bc5dde47e54366290424c981a67af65b9385c7c1";
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secret_key",
            "Cache-Control: no-cache",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $data = json_decode($response);
        return [$data];
    } // End Method

    public function order(Request $request, $user = null)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);
        $sessionKey = session()->getId();

        $transactionDate = $request->transaction_date;
        // Remove double quotes from the start and end of the string
        $transactionDate = str_replace('"', '', $transactionDate);
        if (strpos($transactionDate, '.000Z') !== false) {
            // Remove the last 5 characters (".000Z") to format the date string
            $transactionDate = substr($transactionDate, 0, -5);

            // Parse the modified date string using Carbon to the desired format
            $transactionDate = Carbon::parse($transactionDate)->format('Y-m-d H:i:s');
        } else {
            // Parse the modified date string using Carbon to the desired format
            $transactionDate = Carbon::parse($transactionDate)->format('Y-m-d H:i:s');
        }

        $paymentChannel = $request->payment_channel;
        $paymentChannel = str_replace('"', '', $paymentChannel);

        $paymentReference = $request->payment_reference;
        $paymentReference = str_replace('"', '', $paymentReference);

        $status = $request->status;
        $status = str_replace('"', '', $status);

        $orderStatus = 0;

        // Determine the payment status based on the 'status' property
        if ($status === 'fail') {
            $paymentStatus = 0;
            $orderStatus = 2;
        }
        elseif ($status === 'success') {
            $paymentStatus = 1;
        }
        else {
            $paymentStatus = 2;
        }

        if ($user){
            $order = Order::create([
                'user_id' => $user,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'transaction_date' => $transactionDate,
                'channel' => $paymentChannel,
                'reference' => $paymentReference,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'month' => $request->month,
            ]);

            for ($i = 0; $i < count($request->item_id); $i++) {
                Orderdetails::create([
                    'order_id' => $order->id,
                    'reference' => $paymentReference,
                    'item_id' => $request->item_id[$i],
                    'item_type' => $request->item_type[$i],
                    'item_name' => $request->item_name[$i],
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                ]);
            }

            WebCart::where('user_id', $user)->delete();
            Alert::success('Success', 'Order Placed Successfully!')->showConfirmButton('OK', '#3085d6');

            $user = User::find($user);
            if ($user->role === 'employee'){
                return redirect()->route('employee.order.index', ['order_status' => '0'] );
            }
            elseif($user->role === 'customer'){
                return redirect()->route('customer.order.index', ['order_status' => '0'] );
            }
        }
        else{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|max:200',
                'address' => 'required|max:400',
            ]);

            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            // Log in the newly created user
            Auth::login($newUser);
            $user = $newUser;

            $order = Order::create([
                'user_id' => $newUser->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'transaction_date' => $transactionDate,
                'channel' => $paymentChannel,
                'reference' => $paymentReference,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'subtotal' => $request->subtotal,
                'total' => $request->total,
                'month' => $request->month,
            ]);

            for ($i = 0; $i < count($request->item_id); $i++) {
                Orderdetails::create([
                    'order_id' => $order->id,
                    'reference' => $paymentReference,
                    'item_id' => $request->item_id[$i],
                    'item_type' => $request->item_type[$i],
                    'item_name' => $request->item_name[$i],
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                ]);
            }

            WebCart::where('user_id', $user)->delete();
            Alert::success('Success', 'Order Placed Successfully!')->showConfirmButton('OK', '#3085d6');

            return redirect()->route('customer.order.index', ['order_status' => '0'] );
        }
    } // End Method

}
