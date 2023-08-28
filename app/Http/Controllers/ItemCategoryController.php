<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ItemCategory::orderBy('categoryId','DESC')->paginate(100);
        return view('itemcategories.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('itemcategories.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'catgeoryName' => 'required|unique:itemcategories,catgeoryName',
            'categoryDetail' => 'required',
            'categoryAbb' => 'required|string|max:4|unique:itemcategories,categoryAbb'
        ]);
    
        $input = $request->all();
    
        $category = ItemCategory::create($input);
    
        return redirect()->route('itemcategories.index')
                        ->with('success','Storage item category created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = ItemCategory::find($id);
        return view('itemcategories.show',compact('category'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $category = ItemCategory::find($id);
    
        return view('itemcategories.edit',compact('category'));
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
        $category = ItemCategory::find($id);
        $categoryId=$category->categoryId;
        $this->validate($request, [
            'catgeoryName' => 'required',
            'categoryDetail' => 'required',
            'categoryAbb' => 'required|string|max:4'
        ]);
    
        $input = $request->all();
        $category->update($input);
    
        return redirect()->route('itemcategories.index')
                        ->with('success','Store item category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        ItemCategory::find($id)->delete();
        return redirect()->route('itemcategories.index')
                        ->with('success','Store item category deleted successfully');
    }
}
