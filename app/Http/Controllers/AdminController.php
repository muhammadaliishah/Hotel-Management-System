<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\StoreItem;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders=Order::count();
        $products=Product::count();
        $items=StoreItem::count();
        $vendors=Vendor::count();
        $productsPie=DB::table('products')
    ->select('products.name', DB::raw('SUM(order_items.quantity) as y'))
    ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
    ->groupBy('products.name', 'products.id')
    ->get();
    $sItemsPie=DB::table('storeitems')
    ->select('storeitems.itemName', DB::raw('SUM(purchaseorders.quantity) as y'))
    ->leftJoin('purchaseorders', 'storeitems.itemId', '=', 'purchaseorders.itemId')
    ->groupBy('storeitems.itemName', 'storeitems.itemId')
    ->get();
   // dd($sItemsPie);
        return view('admin.index',['orders'=>$orders,
            'products'=>$products,
            'items'=>$items,
            'vendors'=>$vendors,
            'productsPie'=>$productsPie,
            'sItemsPie'=>$sItemsPie
        ]);
    }
}
