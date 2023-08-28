<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\StoreItem;
use App\Models\PurchaseOrder;
use App\Models\PoMain;
use App\Models\MainReceivedItem;
use App\Models\SubReceivedItem;
use App\Models\PoBill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReceivedItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('receiveditems.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($ven,$det=null)
    {
        $defaultDate = now()->toDateString();
       $data = DB::table('sub_ritems as sri')
        ->rightJoin('purchaseorders as po', 'sri.poSubItemId', '=', 'po.poItemId')
        ->rightJoin('storeitems as si', 'po.itemId', '=', 'si.itemId')
        ->rightJoin('po_main as pom', 'po.pMainId', '=', 'pom.poMainId')
        ->rightJoin('vendors as ven', 'pom.vendorId', '=', 'ven.vendorId')
        ->select(DB::raw("CONCAT(ven.first_name, ' ', ven.last_name) as vendorName"),
                 'pom.orderId',
                 'pom.poMainId',
                 'pom.orderedDate',
                 'si.itemName',
                 'si.itemId',
                 'po.poItemId',
                 'po.quantity',
                 DB::raw('SUM(sri.sRQuantity) as ReceivedQuan'))
        ->where('pom.orderId', '=', $ven)
        ->groupBy('vendorName', 'pom.orderId', 'pom.poMainId', 'pom.orderedDate', 'si.itemName', 'si.itemId','po.poItemId','po.quantity')
        ->get();
        return view('receiveditems.create')->with('data', $data)->with('defaultDate', $defaultDate)->with('det',$det);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $image_path = '';

        if ($request->hasFile('invoiceImage')) {
            $image_path = $request->file('invoiceImage')->store('invoices', 'public');
        }
       $data = $request->all();
       $validator = Validator::make($data, [
        'invoiceNumber' => 'required|unique:main_ritems,invoiceNumber',
        'addMore.*.sRQuantity' =>'required|numeric|lte:addMore.*.poQuan',
        'deliveryStatus'=>'required',
        'invoiceImage' => 'image|mimes:jpg,png,jpeg',
        'receivedDate'=>'required',
        'bill_paid'=>'required|numeric|lte:totbill|gte:0',
        'bill_paid_date'=>'required',
        'addMore.*.sRPrice' => 'required|numeric'], 
        [
    'addMore.*.sRQuantity.required' => 'The received quantity for item at S.No :index is required',
'addMore.*.sRQuantity.numeric' => 'The received quantity for item at S.No :index must be numeric',
'addMore.*.sRQuantity.lte' => 'The received quantity for item at S.No :index must be less than or equal to :value',
'addMore.*.sRPrice.required' => 'The price for received item at S.No :index is required',
'addMore.*.sRPrice.numeric' => 'The price for received item at S.No :index must be numeric',
    ]);
        $validator->validate();
        $mr_item=new MainReceivedItem();
        $mr_item->poRMainId= $request->poMainId;
        $mr_item->invoiceNumber= $request->invoiceNumber;
        $mr_item->deliveryStatus= $request->deliveryStatus;
        $mr_item->receivedDate= $request->receivedDate;
        $mr_item->invoiceImage=$image_path;
        $mr_item->save();
        $mr_itemID=$mr_item->mainRItemId; 
        if($request->bill_paid>0){
                $paidBill=new PoBill();
                $paidBill->invoice_Id = $mr_itemID;
                $paidBill->bill_paid=$request->bill_paid;
                $paidBill->bill_details='bill paid on '.$request->bill_paid_date;
                $paidBill->payment_date=$request->bill_paid_date;
                $paidBill->save();
            }
        foreach ($request->addMore as $key => $value) {
            $value['mRItemId']=$mr_itemID ;
            $value['expiryDate']=date('Y-m-d');
            SubReceivedItem::create($value);
        }
    if($request->det==1){
        return \Redirect::route('purchaseorders.po_summery', $request->orderId)->with('success', 'Success, your invoice has been added.');
    }
        return \Redirect::route('purchaseorders.index')->with('success', 'Success, your invoice has been added.');
    }
}
