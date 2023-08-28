<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\StoreItem;
use App\Models\PurchaseOrder;
use App\Models\PoMain;
use App\Models\MainReceivedItem;
use App\Models\SubReceivedItem;

class SubReceivedItemController extends Controller
{
    public function create(string $ven)
    {
        $data=
        return view('receiveditems.create');
    }
}
