<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;

class RouteController extends Controller
{
      public function productList()
      {
        $products = Product::get();
        $users = User::get();

        $data = [
            'product' => $products,
            'user' => $users,
        ];

        // $data = [
        //     'product' => [
        //         'codelab' => $products
        //     ],
        //     'user' => $users,
        // ];

        return response()->json($data, 200);
      }

      public function categoryListPage()
      {
        $category = Category::get();
        return response()->json($category, 200);
      }

    //   Category Create
      public function categoryList(Request $request)
      {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated-at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
        // dd($request->all());
        //  dd($request->header('password'));
      }

    //   Category delete with post
    public function categoryDelete(Request $request)
    {
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status' =>  'true', 'message' => 'delete success','deleteData' => $data],200);
        }
        return response()->json(['status' =>  'false', 'message' => 'There is no category'],200);
    }

    //   Category delete with get
    public function categoryDeleteWithGet($id)
    {
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' =>  'true', 'message' => 'delete success','deleteData' => $data],200);
        }
        return response()->json(['status' =>  'false', 'message' => 'There is no category'],200);
    }

     //   Category Detail with post
    public function categoryDetailWithPost(Request $request)
    {
        $data = Category::where('id',$request->product_id)->first();

        if(isset($data)){
            return response()->json(['status' =>  'true','detailData' => $data],200);
        }
        return response()->json(['status' =>  'false', 'message' => 'There is no category'],200);
    }

     //   Category Detail with get
     public function categoryDetailWithGet($id)
     {
         $data = Category::where('id',$id)->first();

         if(isset($data)){
             return response()->json(['status' =>  'true','detailData' => $data],200);
         }
         return response()->json(['status' =>  'false', 'message' => 'There is no category'],200);
     }

    //  Category Update
    public function categoryUpdate(Request $request)
    {
        $id = $request->category_id;
        $dbsource = Category::where('id',$id)->first();
        if(isset($dbsource)){
            $data = $this->getCategoryData($request);
            Category::where('id',$id)->update($data);
            return response()->json(['status' =>  'true','UpdateData' => $data],200);
        }
        return response()->json(['status' =>  'false', 'message' => 'There is no update'],500);
    }

    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
        ];
    }
}
