<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class CFMainController extends Controller
{
    public function index() 
    {
        $inventory = DB::table('po_bills')
    ->select(DB::raw('COALESCE(SUM(bill_paid), 0) as inventory'))
    ->whereDate('payment_date', '=', DB::raw('CURDATE()'))
    ->first();
   $inven = $inventory !== null ? $inventory->inventory : 0.00; 

$pos = DB::table('payments')
    ->select(DB::raw('COALESCE(SUM(amount), 0) as pos'))
    ->whereRaw('DATE_FORMAT(created_at, "%Y/%c/%d") = DATE_FORMAT(CURDATE(), "%Y/%c/%d")')
    ->first();
 $po = $pos !== null ? $pos->pos : 0.00;    

$extraExpense = DB::table('cashflow')
    ->select(DB::raw('COALESCE(SUM(cfexpense), 0) as extraExpense'))
    ->whereRaw('DATE_FORMAT(created_at, "%Y/%c/%d") = DATE_FORMAT(CURDATE(), "%Y/%c/%d")')
    ->first();
$extraExp = $extraExpense !== null ? $extraExpense->extraExpense : 0.00;

$result = [
    'inventory' => $inventory->inventory,
    'pos' => $po,
    'extraExpense' => $extraExp
];
//dd($result);
        return view('cfmain.index',['result'=>$result]);
    }
}
