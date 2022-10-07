<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Change Password Page
    public function changePasswordPage()
    {
       return view('admin.account.changePassword');
    }

    // Change Password
    public function changePassword(Request $request)
    {
        // 1 . all Field must be fill
        // 2 . new password & confirm password length must be greater than 6 and not greater than 10
        // 3 . new password & confirm password must be same
        // 4 . client old passowrd must be same with db password
        // 5 . password change
        $this->paswordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashPassword = $user->password;
        if(Hash::check($request->oldPassword,$dbHashPassword)){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',$currentUserId)->update($data);

            return back()->with(['changeSuccess' => 'စကားဝှက်ကို အောင်မြင်စွာ ပြောင်းလဲခဲ့သည်။']);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'Old password does not match  with db password']);
    }

    // Account Detail Page
    public function accountDetail()
    {
        return view('admin.account.detail');
    }

    // Account Edit Page
    public function aacountEdit()
    {
        return view('admin.account.edit');
    }

     // Account Update Page
     public function accountUpdate($id,Request $request)
     {
        $this->accountValidaionCheck($request);
        $data = $this->getUserData($request);
        if($request->hasFile('image')){
            // 1. old image name  2. name check has ? 3. delete 4. new image store
            $oldImageFromDB = User::where('id',$id)->first();
            $oldImageFromDB = $oldImageFromDB->image;
            if($oldImageFromDB != null){
                Storage::delete('public/'.$oldImageFromDB);
            }
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#accountdetail')->with(['updateSuccess' => 'စီမံခန့်ခွဲသူအကောင့်ကို အောင်မြင်စွာ အပ်ဒိတ်လုပ်ထားသည်။']);
     }


    //  Admin List
    public function adminList()
    {
        $admins = User::when(request('dataSearch'),function($query){
            $key = request('dataSearch');
            $query->orWhere('name','like','%'.$key.'%')
            ->orWhere('email','like','%'.$key.'%')
            ->orWhere('gender','like','%'.$key.'%')
            ->orWhere('phone','like','%'.$key.'%')
            ->orWhere('address','like','%'.$key.'%');
        })->where('role','admin')
        ->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list',compact('admins'));
    }

     // User List Page
     public function userListPage()
     {
        $userLists = User::when(request('dataSearch'),function($query){
            $key = request('dataSearch');
            $query->orWhere('name','like','%'.$key.'%')
            ->orWhere('email','like','%'.$key.'%')
            ->orWhere('gender','like','%'.$key.'%')
            ->orWhere('phone','like','%'.$key.'%')
            ->orWhere('address','like','%'.$key.'%');
        })->where('role','user')->paginate(3);
         return view('admin.user.list',compact('userLists'));
     }

     //User List Delete For each user
     public function userDeleteFromAdmin($id)
     {
        User::where('id',$id)->delete();
        return back()->with(['deleteMessage' => 'User Account ကို အောင်မြင်စွာ ဖျက်လိုက်ပါပြီ။']);
     }

    //    Delete Account
    public function delete($id)
    {
        User::where('id',$id)->delete();
        return back()->with(['deleteMessage' => 'Account ကို အောင်မြင်စွာ ဖျက်လိုက်ပါပြီ။']);
    }

    // Change Role Page With route
    public function changeRole($id)
    {
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    // Change Role with route
    public function change($id,Request $request)
    {
        $data = $this->roleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    // Change Role Admin With Ajax
    public function ajaxChangeRole(Request $request)
    {
        User::where('id',$request->adminId)->update(
            [
                'role' => $request->role,
            ]
        );
    }

    // Change Role User With Ajax
    public function ajaxUserChangeRole(Request $request)
    {
        User::where('id',$request->userId)->update(
            [
                'role' => $request->role,
            ]
        );
    }

    // User Role Data
    private function roleData($request)
    {
        return [
            'role' => $request->role
        ];
    }

    //  User data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
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
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',
        ])->validate();
    }

    // Password Validation
    private function paswordValidationCheck($request)
    {
        $validationPassword = [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' =>  'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
        ];
        Validator::make($request->all(),$validationPassword )->validate();
    }
}
