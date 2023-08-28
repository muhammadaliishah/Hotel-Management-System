<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\StoreItem;
use App\Models\PurchaseOrder;
use App\Models\PoMain;
use App\Models\MainReceivedItem;
use App\Models\SubReceivedItem;
use App\Models\PoBill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PoBillController extends Controller
{
    public function index(Request $request) 
    {
       $data=new PoBill();
       $data=$data::join('main_ritems','po_bills.invoice_Id','=','main_ritems.mainRItemId')->orderby('po_bills.payment_date')->select('main_ritems.invoiceNumber','po_bills.*');
       $data = $data->paginate(10);
        if (request()->wantsJson()) {
            return PoBill::collection($data);
        }
        return view('pobill.index')->with('data', $data);
    }

    public function create($invoiceNumber=null)
    {
        $defaultDate = now()->toDateString();
        $invoices=MainReceivedItem::get();
        if($invoiceNumber!=null){
            $invoices=$invoices->where('mainRItemId','=',$invoiceNumber);
        }
        return view('pobill.create',['invoices'=>$invoices,'invoiceNumber'=>$invoiceNumber,'defaultDate'=>$defaultDate]);
    }

    public function store(Request $request){
        $totalBill = DB::table('sub_ritems as sri')
            ->join('main_ritems as mri', 'sri.mRItemId', '=', 'mri.mainRItemId')
            ->where('mri.mainRItemId', $request->invoice_Id)
            ->select(DB::raw('sum(sri.sRQuantity * sri.sRPrice) as TotalBill'))
            ->first()->TotalBill;
        $totalBillPaid = DB::table('po_bills')
            ->where('invoice_Id', $request->invoice_Id)
            ->sum('bill_paid');
        $dueAmount=$totalBill-$totalBillPaid;
         $request->validate([
            'invoice_Id' => 'required',
            'bill_paid' => 'required|numeric|gte:0|lte:'.$dueAmount,
            'bill_details' => 'required',
            'payment_date' => 'required'
        ]);

        $input = $request->all();
        $storeitem = pobill::create($input);
        if($request->invoice!=null){
            $main_ritem = new MainReceivedItem();
            $main_ritem=$main_ritem::join('po_main','main_ritems.poRMainId','=','po_main.poMainId')->where('main_ritems.mainRItemId',$request->invoice)->select('po_main.orderId')->get();

            return \Redirect::route('purchaseorders.po_summery', $main_ritem[0]->orderId)->with('success', 'Success, payment has been added.');
        }
        return \Redirect::route('pobill.index')->with('success', 'Success, payment has been added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $data=new PoBill();
       $data=$data::join('main_ritems','po_bills.invoice_Id','=','main_ritems.mainRItemId')->where('po_bills.bill_Id',$id)->select('main_ritems.invoiceNumber','po_bills.*')->get();
        return view('pobill.edit',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
       // dd($id);
        $this->validate($request, [
            'invoice_Id' => 'required',
            'bill_paid' => 'required|numeric',
            'bill_details' => 'required',
            'payment_date' => 'required'
        ]);
        $data = PoBill::find($id);
       // dd($data);
        $input = $request->all();
        $data->update($input);

        return redirect()->route('pobill.index')
                        ->with('success','Payment updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        PoBill::find($id)->delete();
        return redirect()->route('pobill.index')
                        ->with('success','Payment deleted successfully');
    }
}
