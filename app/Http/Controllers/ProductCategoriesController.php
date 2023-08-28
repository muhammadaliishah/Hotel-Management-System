<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $procategories = new ProductCategory();
        if ($request->search) {
            $procategories = $procategories->where('catgeoryName', 'LIKE', "%{$request->search}%");
        }
        $procategories = $procategories->latest()->paginate(10);
        return view('productcategories.index')->with('procategories', $procategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'catgeoryName' => 'required|unique:product_categories,catgeoryName',
            'categoryDetail' => 'required',
            'categoryAbb' => 'required|unique:product_categories,categoryAbb'
        ]);
    
        $input = $request->all();
        $procategory=ProductCategory::create($input);

        if (!$procategory) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product category.');
        }
        return redirect()->route('productcategories.index')->with('success', 'Success, your product category has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productcategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId)
    {
        $procategory = ProductCategory::find($categoryId);
        return view('productcategories.edit')->with('procategory', $procategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId)
    {
        $this->validate($request, [
            'catgeoryName' => 'required|unique:product_categories,catgeoryName',
            'categoryDetail' => 'required',
            'categoryAbb' => 'required|unique:product_categories,categoryAbb'
        ]);
        $procategory = ProductCategory::find($categoryId);
        $procategory->catgeoryName = $request->catgeoryName;
        $procategory->categoryDetail = $request->categoryDetail;
        $procategory->categoryAbb = $request->categoryAbb;

        if (!$procategory->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        return redirect()->route('productcategories.index')->with('success', 'Success, your product category has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $procategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId)
    {
        $procategory=ProductCategory::find($categoryId);
        // $products=Product::where('categoryId','=',$procategory->categoryId);
        // if($products){
        //     $products->delete();
        // }
        $procategory->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
