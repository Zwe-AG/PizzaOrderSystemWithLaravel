<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // return pizza list
    public function ajaxPizzaList(Request $request)
    {
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }

    // return cart list
    public function ajaxCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $responses = [
            'message' => 'Response Completely',
            'status' => 'success',
        ];
        return response()->json($responses,200);
    }

    // return order
    public function ajaxOrder(Request $request)
    {
        $total = 0;
        $cityFee = 0;
        // logger($request->all());
        foreach ($request->all() as $item) {
           $cityFee = $item['cityFee'];
           $data = OrderList::create([
            'user_id' => $item['user_id'],
            'product_id' => $item['product_id'],
            'qty' => $item['qty'],
            'total' => $item['total'],
            'order_code' => $item['order_code'],
           ]);
           $total += $data->total;
        };

        Cart::where('user_id',Auth::user()->id)->delete();

        // logger($total);

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + $cityFee
        ]);


        $responses = [
            'message' => 'Order Completely',
            'status' => 'success',
        ];


        return response()->json($responses,200);
    }

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->userProduct,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // clear cart
    public function ajaxCartClear(Request $request)
    {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    public function ajaxCartCurrentClear(Request $request)
    {
        Cart::where('user_id',Auth::user()->id)
              ->where('product_id',$request->product_id)
              ->where('id',$request->order_id)
              ->delete();
    }

    // Increase View Count
    public function increaseViewCount(Request $request)
    {
       $pizza = Product::where('id',$request->productId)->first();
       $viewCount = [
           'view_count' => $pizza->view_count + 1,
       ];
       Product::where('id',$request->productId)->update($viewCount);
    }
}

