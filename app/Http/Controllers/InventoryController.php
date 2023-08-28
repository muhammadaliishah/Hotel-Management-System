<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InventoryController extends Controller
{
    public function index()
    {
        $data = DB::table('storeitems')
    ->select(
        'itemcategories.catgeoryName',
        'storeitems.itemName',
        'storeitems.image',
        'storeitems.barcode',
        'storeitems.minQuantity',
        'storeitems.unitOfMeasurement',
        DB::raw('(SELECT COALESCE(SUM(sub_ritems.sRQuantity), 0) FROM sub_ritems WHERE storeitems.itemId = sub_ritems.sRItemId) AS TotalStorage'),
        DB::raw('(SELECT COALESCE(SUM(consumed_items.cquantity), 0) FROM consumed_items WHERE storeitems.itemId = consumed_items.itemId) AS QuantityConsumed')
    )
    ->join('itemcategories', 'storeitems.categoryId', '=', 'itemcategories.categoryId')
    ->get();
        return view('inventory.index')->with('data', $data);
    }
}
