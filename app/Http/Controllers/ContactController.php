<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $data = $this->getUserData($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }

    // Contact Detail List Page
    public function contactList()
    {
        $contacts = Contact::when(request('dataSearch'),function($query){
            $key = request('dataSearch');
            $query->where('name','like','%'.$key.'%');
        })->orderBy('created_at','desc')
        ->paginate(5);
        $contacts->appends(request()->all());
        return view('admin.contact.list',compact('contacts'));
    }

    // Contact Detailfor each customer
    public function detail($id)
    {
        $details = Contact::where('id',$id)->first();
        return view('admin.contact.detail',compact('details'));
    }

     //  User data
     private function getUserData($request)
     {
         return [
             'name' => $request->userName,
             'email' => $request->userEmail,
             'message' => $request->userMessage,
         ];
     }
}
