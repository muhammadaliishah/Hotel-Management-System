<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StoreItem;
use App\Models\ItemCategory;

use Illuminate\Support\Facades\Storage;

class StoreItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new StoreItem();
        //$products = Product::with('category');
        $data=$data::join('itemcategories','storeitems.categoryId','=','itemcategories.categoryId')->select('storeitems.*','itemcategories.catgeoryName');
        if ($request->search) {
            $data = $data->where('name', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        if (request()->wantsJson()) {
            return ProductResource::collection($data);
        }
        return view('storeitems.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=ItemCategory::get();
        return view('storeitems.create',['categories'=>$categories]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'itemName' => 'required|unique:storeitems,itemName',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'barcode' => 'required|string|max:50|unique:storeitems,barcode',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|boolean',
            'minQuantity' => 'required',
            'unitOfMeasurement' => 'required|string|max:20'
        ]);
      // dd($request);
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('items', 'public');
        }
        $input = $request->all();
         $input['image']=$image_path;
        $storeitem = StoreItem::create($input);
    
        return redirect()->route('storeitems.index')
                        ->with('success','Storage item created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $storeitem = StoreItem::find($id);
        return view('storeitems.show',compact('storeitem'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $storeitem = StoreItem::find($id);
        $categories=ItemCategory::get();
        return view('storeitems.edit',compact('storeitem','categories'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'itemName' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'barcode' => 'required|string|max:50',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required|boolean',
            'categoryId' => 'required',
            'minQuantity' => 'required',
            'unitOfMeasurement' => 'required|string|max:20'
        ]);
        $storeitem = StoreItem::find($id);
        $image_path ='public/'.$storeitem->image;
       // dd($image_path);
        $input = $request->all();
        $storeitem->update($input);
    if ($request->hasFile('image')) {
                Storage::delete($image_path);
                $image_path = $request->file('image')->store('items', 'public');
                $storeitem->image = $image_path;
                $storeitem->save();
            
        }

        return redirect()->route('storeitems.index')
                        ->with('success','Store item updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        StoreItem::find($id)->delete();
        return redirect()->route('storeitems.index')
                        ->with('success','Store item deleted successfully');
    }
}
