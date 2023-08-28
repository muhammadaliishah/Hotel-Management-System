<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CashFlowCategory;

class CashFlowCategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = CashFlowCategory::orderBy('cf_catId','DESC')->paginate(100);
        return view('cashflowcategories.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cashflowcategories.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request);
       $this->validate($request, [
            'cf_catName' => 'required|unique:cf_categories,cf_catName',
            'cf_catDetail' => 'required',
            'cf_catAbb' => 'required|string|max:4|unique:cf_categories,cf_catAbb'
        ]);
    
        $input = $request->all();
        //dd($input);
        $category = CashFlowCategory::create($input);
    
        return redirect()->route('cashflowcategories.index')
                        ->with('success','Storage item category created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = CashFlowCategory::find($id);
        return view('cashflowcategories.show',compact('category'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $category = CashFlowCategory::find($id);
    
        return view('cashflowcategories.edit',compact('category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = CashFlowCategory::find($id);
        $cf_catId =$category->cf_catId ;
        $this->validate($request, [
            'cf_catName' => 'required',
            'cf_catDetail' => 'required',
            'cf_catAbb' => 'required|string|max:4'
        ]);
    
        $input = $request->all();
        $category->update($input);
    
        return redirect()->route('cashflowcategories.index')
                        ->with('success','Store item category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        CashFlowCategory::find($id)->delete();
        return redirect()->route('cashflowcategories.index')
                        ->with('success','Store item category deleted successfully');
    }
}
