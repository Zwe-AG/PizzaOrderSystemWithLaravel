<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Product List
    public function productList()
    {
        $pizzas = Product::select('products.*','categories.name as category_name')->when(request('dataSearch'),function($query){
            $key = request('dataSearch');
            $query->where('products.name','like','%'.$key .'%');
        })->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    // create page
    public function productCreatePage()
    {
        $categories = Category::select('id','name')->get();
       return view('admin.product.create',compact('categories'));
    }

    // Create Pizza
    public function create(Request $request)
    {
        $this->pizzaValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $filename = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$filename);
            $data['image'] = $filename;
        }

        Product::create($data);
        return redirect()->route('product#list');
    }

    // Delete pizza
    public function delete($id)
    {
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteMessage' => 'Product ကို အောင်မြင်စွာ ဖျက်လိုက်ပါပြီ။']);
    }

    // edit page
    public function edit($id)
    {
        $pizza = Product::select('products.*','categories.name as category_name')->leftJoin('categories','products.category_id','categories.id')->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    // update page
    public function updatePage($id)
    {
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    // update
    public function update(Request $request)
    {
        $this->pizzaValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImage = Product::where('id',$request->pizzaID)->first();
            $oldImage  = $oldImage->image;
            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }
            $filename = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$filename);
            $data['image'] = $filename;
        }


        Product::where('id',$request->pizzaID)->update($data);

        return redirect()->route('product#list')->with(['updateMessage' => 'Pizza အပ်ဒိတ် ပို့စ် အောင်မြင်စွာ တင်နိုင်ပါပြီ။']);

    }

    // Pizza Data
    private function requestProductInfo($request)
    {
        $data = [
            "category_id" => $request->pizzaCategory,
            "name" => $request->pizzaName,
            "description" => $request->pizzaDescription,
            "price" => $request->pizzaPrice,
            "waiting_time" => $request->pizzaWaitingTime,
        ];
        return $data;
    }

    // Pizza validation
    private function pizzaValidationCheck($request,$status)
    {
        $data = [
            'pizzaName' => 'required|min:5|unique:products,name,'. $request->pizzaID,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];
        $data['pizzaImage'] = $status == 'create' ? 'required|mimes:jpg,png,jpeg,webp|file' : 'mimes:jpg,png,jpeg,webp|file';
        Validator::make($request->all(),$data)->validate();
    }

}
