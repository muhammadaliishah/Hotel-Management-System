<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CashFlow;
use App\Models\CashFlowCategory;
use Illuminate\Support\Facades\Validator;

class CashFlowController extends Controller
{
    public function index(Request $request) 
    {
        $data = new CashFlow();
        //$products = Product::with('category');
        $data=$data::leftjoin('cf_categories','cashflow.cf_catId','=','cf_categories.cf_catId')->select('cashflow.*','cf_categories.cf_catName');
        if ($request->search) {
            $data = $data->where('cf_catName', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('cashflow.index')->with('data', $data);
    }

    public function create()
    {
        $categories=CashFlowCategory::get();
        return view('cashflow.create',['categories'=>$categories]);
    }

    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
        'addmore.*.cf_catId' => 'required',
        'addmore.*.cfdetails' =>'required',
        'addmore.*.cfexpense' => 'required|numeric'], 
        [
    'addmore.*.cf_catId.required' => 'The expense item at S.No :index is required',
    'addmore.*.cfdetails.required' => 'The details of expense at S.No :index is required',
    'addmore.*.cfexpense.required' => 'The expense amount of item at S.No :index is required',
'addmore.*.cfexpense.numeric' => 'The expense amount of item at S.No :index must be numeric'
    ]);
        if ($validator->fails()) {
            $addmore = $request->addmore;
             $request->session()->flash('addmore', $addmore);
        return redirect()->back()->withErrors($validator);
    }
         

        foreach ($request->addmore as $key => $value) {
            CashFlow::create($value);
        }
    
        return \Redirect::route('cfmain.index')->with('success', 'Success, expense item has been added.');
    }
}
