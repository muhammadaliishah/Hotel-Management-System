<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orders = Order::with(['items', 'payments'])->get();
        $customers_count = Customer::count();

        return view('pos.index', [
            'orders_count' => $orders->count(),
            'income' => $orders->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'income_today' => $orders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'customers_count' => $customers_count
        ]);
    }
}
