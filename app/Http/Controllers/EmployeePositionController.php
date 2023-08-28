<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePay;
use App\Models\EmployeePosition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmployeePositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new EmployeePosition();
        if ($request->search) {
            $data = $data->where('pos_name', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employee_positions.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultDate = now()->toDateString();
        return view('employee_positions.create',['defaultDate'=>$defaultDate]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pos_type' => 'required',
            'pos_name' => 'required',
            'pos_status' => 'required|boolean'
        ],[
            'pos_type.required'=>'Position Type is required',
            'pos_name.required' => 'Position Name is required',
            'pos_status.required' => 'Position Status is required'
        ]);
      
        $input = $request->all();
        $emp_position = EmployeePosition::create($input);
    
        return redirect()->route('employee_positions.index')
                        ->with('success','Position created successfully');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emp_position = EmployeePosition::find($id);
        return view('employee_positions.show',compact('emp_position'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $emp_position = EmployeePosition::find($id);
        return view('employee_positions.edit',compact('emp_position'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'pos_type' => 'required',
            'pos_name' => 'required',
            'pos_status' => 'required|boolean'
        ],[
            'pos_type.required'=>'Position Type is required',
            'pos_name.required' => 'Position Name is required',
            'pos_status.required' => 'Position Status is required'
        ]);
        $emp_position = EmployeePosition::find($id);
        $input = $request->all();
        $emp_position->update($input);

        return redirect()->route('employee_positions.index')
                        ->with('success','Position updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        EmployeePosition::find($id)->delete();
        return redirect()->route('employee_positions.index')
                        ->with('success','Position deleted successfully');
    }
}
