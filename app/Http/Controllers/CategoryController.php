<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category list page
    public function list()
    {
        $categories = Category::when(request('dataSearch'),function($query){
            $key = request('dataSearch');
            $query->where('name','like','%'.$key.'%');
        })->orderBy('id','desc')->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    // direct category create page
    public function createPage()
    {
       return view('admin.category.create');
    }

    // Category Create
    public function create(Request $request)
    {
        $this->categoryValidaion($request,'create');
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('list#page')->with(['createMessage' => " Category ကို အောင်မြင်စွာ ဖန်တီးခဲ့သည်။"]);
    }

    // Category Delete
    public function delete($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('list#page')->with(['deleteMessage' => "Category ကို အောင်မြင်စွာ ဖျက်လိုက်ပါပြီ။"]);
    }

    // Category Edit
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // Category Update
    public function update(Request $request)
    {
        $this->categoryValidaion($request,'update');
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('list#page')->with(['updateMessage' => 'အပ်ဒိတ် ပို့စ် အောင်မြင်စွာ တင်နိုင်ပါပြီ။']);
    }

    // Category Validation
    private function categoryValidaion($request,$status){
        if($status == 'update'){
            Validator::make($request->all(),[
                'categoryName' => 'required|min:5|unique:categories,name,'.$request->categoryId,
            ])->validate();
        }else{
            Validator::make($request->all(),[
                'categoryName' => 'required|min:5|unique:categories,name',
            ])->validate();
        }
    }

    // Category Data
    private function requestCategoryData($request)
    {
        return [
            "name" => $request->categoryName
        ];
    }
}
