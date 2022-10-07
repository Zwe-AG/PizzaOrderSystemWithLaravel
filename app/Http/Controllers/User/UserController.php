<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Home Page
    public function home()
    {
        $pizzas = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        $feedback = Contact::get()->toArray();
        return view('user.main.home',compact('pizzas','categories','carts','history','feedback'));
    }

    // Change Password Page
    public function changePage()
    {
        return view('user.password.changePassword');
    }

    // Change Password
    public function change(Request $request)
    {
        // dd($request->toArray());
        $this->passwordValidaiton($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashPassword = $user->password;
        if(Hash::check($request->oldPassword,$dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',$currentUserId)->update($data);
            return back()->with(['changeSuccess' => 'စကားဝှက်ကို အောင်မြင်စွာ ပြောင်းလဲခဲ့သည်။']);
        }
        return back()->with(['notMatch' => 'စကားဝှက်ဟောင်းသည် ဒေတာဘေ့စ်စကားဝှက်နှင့် မကိုက်ညီပါ။']);

    }

    // Account Profile Page
    public function profilePage()
    {
        return view('user.profile.account');
    }

    // Account Profile Change
    public function profileChange($id,Request $request)
    {
        $this->accountValidaionCheck($request);
        $data = $this->getUserData($request);
        if($request->hasFile('image')){
            $oldImage = User::where('id',$id)->first();
            $oldImage = $oldImage->image;
            if($oldImage != null ){
                Storage::delete('public/'.$oldImage);
            }
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess' => 'အသုံးပြုသူအကောင့်ကို အောင်မြင်စွာ အပ်ဒိတ်လုပ်ထားသည်။']);
    }

    // User Filter
    public function filter($id)
    {
        $pizzas = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        $feedback = Contact::get()->toArray();
        return view('user.main.home',compact('pizzas','categories','carts','history','feedback'));
    }

    // Pizza Detail
    public function detailPage($id)
    {
        $pizza = Product::where('id',$id)->first();
        $pizzaLists = Product::get();
        return view('user.main.detail',compact('pizza','pizzaLists'));
    }

    // Cart Page
    public function cartPage()
    {
        $cartLists = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                   ->leftJoin('products','products.id','carts.product_id')
                   ->where('carts.user_id',Auth::user()->id)->get();
        $totalPrice = 0;
        foreach ($cartLists as $cart) {
            $totalPrice += $cart->pizza_price * $cart->qty;
        }
        return view('user.main.cart',compact('cartLists','totalPrice'));
    }

    // User History Page
    public function history()
    {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('orders'));
    }

    //  User data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    // Account Validation
    private function accountValidaionCheck($request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

    // Password Validation
    private function passwordValidaiton($request)
    {
        $passwordData = [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' =>  'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ];
        Validator::make($request->all(),$passwordData)->validate();
    }


}
