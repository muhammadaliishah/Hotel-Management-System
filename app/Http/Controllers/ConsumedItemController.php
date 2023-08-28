<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ConsumedItem;
use App\Models\StoreItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ConsumedItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new ConsumedItem();
        //$products = Product::with('category');
        $data=$data::leftJoin('storeitems','consumed_items.itemId','=','storeitems.itemId')->leftJoin('itemcategories','storeitems.categoryId','=','itemcategories.categoryId')
        ->select('storeitems.itemName','itemcategories.catgeoryName','storeitems.unitOfMeasurement','storeitems.barcode','consumed_items.cquantity','consumed_items.consumedDate','consumed_items.created_at','consumed_items.updated_at');
        if ($request->search) {
            $data = $data->where('name', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('consumeditems.index')->with('data', $data);
    }
    public function getStock(Request $request)
{
   $data=DB::table('storeitems')
    ->select(
        'itemName',
        DB::raw('(SELECT COALESCE(SUM(sub_ritems.sRQuantity), 0) FROM sub_ritems WHERE storeitems.itemId = sub_ritems.sRItemId) AS TotalStorage'),
        DB::raw('(SELECT COALESCE(SUM(consumed_items.cquantity), 0) FROM consumed_items WHERE storeitems.itemId = consumed_items.itemId) AS QuantityConsumed')
    )
    ->where('storeitems.itemId', $request->value)->first();
    $number=$data->TotalStorage-$data->QuantityConsumed;
    return response()->json(['number' => $number]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultDate = now()->toDateString();
        $storeitems=DB::table('storeitems AS si')
    ->join('sub_ritems AS ri', 'si.itemId', '=', 'ri.sRItemId')
    ->select('si.itemId','si.itemName',DB::raw('COALESCE(SUM(ri.sRQuantity), 0) AS totalSRQuantity'))
    ->groupBy('si.itemId', 'si.itemName')
    ->get();
        return view('consumeditems.create',['items'=>$storeitems,'defaultDate'=>$defaultDate]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
        'addmore.*.itemId' => 'required',
        'addmore.*.cquantity' =>'required|numeric|lte:addmore.*.maxQuan',
        'addmore.*.consumedDate' => 'required'], 
        [
    'addmore.*.itemId.required' => 'The item at S.No :index is required',
    'addmore.*.cquantity.required' => 'The quantity of item at S.No :index is required',
'addmore.*.cquantity.numeric' => 'The quantity of item at S.No :index must be numeric',
'addMore.*.cquantity.lte' => 'The consumed quantity for item at S.No :index must be less than or equal to :value',
'addmore.*.consumedDate.required' => 'The Consumed Date for item at S.No :index is required'
    ]);
        if ($validator->fails()) {
            $addmore = $request->addmore;
             $request->session()->flash('addmore', $addmore);
        return redirect()->back()->withErrors($validator);
    }
        foreach ($request->addmore as $key => $value) {
            ConsumedItem::create($value);
        }
    
        return redirect()->route('consumeditems.index')
                        ->with('success','consumed item created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consumeditem = ConsumedItem::find($id);
        return view('consumeditems.show',compact('consumeditem'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $consumeditem = ConsumedItem::find($id);
        return view('consumeditems.edit',compact('consumeditem'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'itemId' => 'required',
            'cquantity' => 'required'
        ]);
        $consumeditem = ConsumedItem::find($id);
        $image_path ='public/'.$storeitem->image;
       // dd($image_path);
        $input = $request->all();
        $consumeditem->update($input);

        return redirect()->route('consumeditems.index')
                        ->with('success','Consumed item updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        ConsumedItem::find($id)->delete();
        return redirect()->route('consumeditems.index')
                        ->with('success','Consumed item deleted successfully');
    }
}
