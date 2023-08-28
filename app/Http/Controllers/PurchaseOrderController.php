<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\StoreItem;
use App\Models\PurchaseOrder;
use App\Models\PoMain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class PurchaseOrderController extends Controller
{
    public function index()
    {
        $tSubquery = DB::table('po_main as pom')
    ->select(
        DB::raw("CONCAT(ven.first_name, ' ', ven.last_name) AS vendorName"),
        'pom.orderId',
        'pom.orderedDate',
        'po.pMainId',
        DB::raw('SUM(po.quantity) as TotalOrder')
    )
    ->leftJoin('purchaseorders as po', 'pom.poMainId', '=', 'po.pMainId')
    ->leftJoin('vendors as ven', 'pom.vendorId', '=', 'ven.vendorId')
    ->groupBy('vendorName', 'pom.orderId', 'pom.orderedDate', 'po.pMainId');

$fSubquery = DB::table('po_main as pom')
    ->select('pom.poMainId', 'subquery.recOrder')
    ->leftJoin(
        DB::raw('(SELECT mri.poRMainId, SUM(sri.sRQuantity) AS recOrder
                  FROM sub_ritems as sri
                  LEFT JOIN main_ritems as mri ON sri.mRItemId = mri.mainRItemId
                  GROUP BY mri.poRMainId) as subquery'),
        'pom.poMainId', '=', 'subquery.poRMainId'
    );

$data = DB::table(DB::raw("({$tSubquery->toSql()}) as t"))
    ->select('t.*', 'f.*')
    ->leftJoin(DB::raw("({$fSubquery->toSql()}) as f"), 't.pMainId', '=', 'f.poMainId');
        $data = $data->paginate(10);
        if (request()->wantsJson()) {
            return PurchaseOrder::collection($data);
        }
        return view('purchaseorders.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultDate = now()->toDateString();
        $randomNumber = null;
        $isUnique = false;

        while (!$isUnique) {
            $randomNumber = rand(1000000000, 9999999999); 

            $existingRecord = PoMain::where('orderId', $randomNumber)->first();

            if (!$existingRecord) {
                $isUnique = true;
            }
        }
        $vendors=Vendor::get();
        $items=StoreItem::get();
        return view('purchaseorders.create',['vendors'=>$vendors,'items'=>$items,'randomNumber'=>$randomNumber,'defaultDate'=>$defaultDate]);
    }
    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
        'vendorId' => 'required',
        'orderedDate' => 'required',
        'addmore.*.itemId' =>'required',
        'addmore.*.quantity'=>'required|numeric',
        'addmore.*.description'=>'required'], 
        [
    'addmore.*.itemId.required' => 'The item at S.No :index is required',
    'addmore.*.quantity.required' => 'The quantity of item at S.No :index is required',
'addmore.*.quantity.numeric' => 'The quantity of item at S.No :index must be numeric',
'addmore.*.description.required' => 'The description of order for item at S.No :index is required'
    ]);
        //dd($request->addmore);
        //$validator->validate();
        if ($validator->fails()) {
            $addmore = $request->addmore;
             $request->session()->flash('addmore', $addmore);
        return redirect()->back()->withErrors($validator)->withInput();
    }
        $po_main=new PoMain();
        $po_main->orderId= $request->orderId;
        $po_main->vendorId= $request->vendorId;
        $po_main->orderedDate= $request->orderedDate;
        $po_main->expectedDate= date('Y-m-d');
        $po_main->save();
        $pomainID=$po_main->poMainId; 
        //$pomainID=PoMain::where('orderId','=',$request->orderId)->get(); 
       // echo $pomainID[0]['poMainId'];
        //$purOrder = new PurchaseOrder();

        foreach ($request->addmore as $key => $value) {
            $value['pMainId']=$pomainID ;
            $value['price']=0;
            PurchaseOrder::create($value);
        }
    return \Redirect::route('purchaseorders.show', $pomainID)->with('success', 'Success, your product has been updated.');
    }

    public function show($id)
    {
        $data = new PurchaseOrder();
        $data=$data::leftJoin('storeitems','purchaseorders.itemId','=','storeitems.itemId')->
        leftJoin('po_main','purchaseorders.pMainId','=','po_main.poMainId')
        ->leftJoin('vendors','po_main.vendorId','=','vendors.vendorId')
        ->leftJoin('main_ritems','po_main.poMainId','=','main_ritems.poRMainId')
        ->leftJoin('sub_ritems','main_ritems.mainRItemId','=','sub_ritems.mRItemId')
        ->where('po_main.poMainId', '=', $id)->select('storeitems.itemId','purchaseorders.description','storeitems.itemName','po_main.orderId','po_main.orderedDate','po_main.created_at','po_main.updated_at','purchaseorders.quantity','vendors.vendorId','vendors.first_name','vendors.last_name','sub_ritems.sRQuantity','sub_ritems.sRPrice','sub_ritems.expiryDate','main_ritems.receivedDate','main_ritems.deliveryStatus');
        //return view('purchaseorders.detail')->with('data', $data);
        $data=$data->get();
        return view('purchaseorders.detail')->with('data', $data);
    }

    public function po_summery($orderId){
        $vendors = DB::table('vendors as ven')->select(
            DB::raw("CONCAT(ven.first_name, ' ', ven.last_name) AS vendorName"),
            'ven.email',
            'ven.phone',
            'ven.address',
            'ven.avatar',
            'pom.orderId',
            'pom.orderedDate'
            )
            ->join('po_main as pom', 'ven.vendorId', '=', 'pom.vendorId')
            ->where('pom.orderId', $orderId)->get();

        $purchaseorders = DB::table('purchaseorders as po')
            ->select('si.itemName', 'po.quantity', 'si.unitOfMeasurement')
            ->join('po_main as pom', 'po.pMainId', '=', 'pom.poMainId')
            ->join('storeitems as si', 'po.itemId', '=', 'si.itemId')
            ->where('pom.orderId', $orderId)
            ->get();

        $invoices = DB::table('sub_ritems as sri')
            ->select('si.itemName', 'sri.sRQuantity', 'mri.invoiceNumber', 'mri.receivedDate', 'mri.deliveryStatus', 'si.unitOfMeasurement')
            ->join('main_ritems as mri', 'sri.mRItemId', '=', 'mri.mainRItemId')
            ->join('po_main as pom', 'mri.poRMainId', '=', 'pom.poMainId')
            ->join('storeitems as si', 'sri.sRItemId', '=', 'si.itemId')
            ->where('pom.orderId', $orderId)
            ->orderby('mri.invoiceNumber')
            ->get();

        $bills = DB::table('sub_ritems as sri')
            ->select('mri.mainRItemId','mri.invoiceNumber', 'pob.bill_paid', 'pob.payment_date','pob.invoice_Id','pob.bill_Id', DB::raw('sum(sri.sRQuantity * sri.sRPrice) as totalBill'))
            ->leftJoin('main_ritems as mri', 'sri.mRItemId', '=', 'mri.mainRItemId')
            ->leftJoin('po_main as pom', 'mri.poRMainId', '=', 'pom.poMainId')
            ->leftJoin('po_bills as pob', 'mri.mainRItemId', '=', 'pob.invoice_Id')
            ->where('pom.orderId', $orderId)
            ->groupBy('mri.mainRItemId','mri.invoiceNumber', 'pob.bill_paid', 'pob.payment_date','pob.invoice_Id','pob.bill_Id')
            ->orderBy('mri.invoiceNumber')
            ->get();

        return view('purchaseorders.po_summery')->with('vendors', $vendors)->with('purchaseorders', $purchaseorders)->with('invoices', $invoices)->with('bills', $bills);
    }
}
