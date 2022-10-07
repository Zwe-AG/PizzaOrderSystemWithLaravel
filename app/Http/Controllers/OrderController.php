<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Order List Page
    public function orderList()
    {
        $orders = Order::select('orders.*','users.name as user_name')
                 ->when(request('dataSearch'),function($response){
                    $key = request('dataSearch');
                    $response->orWhere('users.name','like','%'. $key .'%')
                    ->orWhere('orders.order_code','like','%'. $key .'%')
                    ->orWhere('orders.total_price','like','%'. $key .'%');
                 })
                 ->leftJoin('users','users.id','orders.user_id')
                 ->orderBy('orders.created_at','desc')
                 ->get();
        // $orders->appends(request()->all());
        return view('admin.order.list',compact('orders'));
    }

    // Change Status Search
    public function ajaxOrderStatus(Request $request)
    {
        // dd($request->all());
        $orders = Order::select('orders.*','users.name as user_name')
                 ->when(request('dataSearch'),function($response){
                    $key = request('dataSearch');
                    $response->orWhere('users.name','like','%'. $key .'%')->orWhere('orders.order_code','like','%'. $key .'%');
                 })
                 ->leftJoin('users','users.id','orders.user_id')
                 ->orderBy('orders.created_at','desc');

        if($request->orderStatus == null){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status',$request->orderStatus)->get();
        }
        // return response()->json($orders,200);
        return view('admin.order.list',compact('orders'));
    }

    // Change Status
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id',$request->orderId)->update(
            [
                'status' => $request->status,
            ]
        );
    }

    // Order info list
    public function listInfo($orderCode)
    {
    $order = Order::where('order_code',$orderCode)->first();
    $orderlists = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
                ->leftJoin('users','users.id','order_lists.user_id')
                ->leftJoin('products','products.id','order_lists.product_id')
                ->where('order_lists.order_code',$orderCode)
                ->get();
    return view('admin.order.productList',compact('orderlists','order'));
    }
}
