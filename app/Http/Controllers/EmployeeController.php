<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePay;
use App\Models\EmployeePosition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new Employee();
        $data=$data::leftJoin('employee_positions','employees.pos_id','=','employees.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employees.emp_gen','employees.emp_contact','employees.emp_address','employees.emp_status','employees.joining_date','employees.leaving_date','employee_positions.pos_type','employee_positions.pos_name');
        if ($request->search) {
            $data = $data->where('emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employees.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultDate = now()->toDateString();
        $empsPos=EmployeePosition::where('pos_status','=',1)->get();
        return view('employees.create',['empsPos'=>$empsPos,'defaultDate'=>$defaultDate]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_fname' => 'required',
            'emp_lname' => 'required',
            'emp_gen' => 'required',
            'emp_contact'=>'required|digits:11',
            'pos_id' => 'required',
            'emp_address'=>'required',
            'emp_status' => 'required|boolean',
            'joining_date' => 'required',
            'leaving_date' => 'nullable'
        ],[
            'emp_fname.required'=>'Employee First Name is required',
            'emp_lname.required' => 'Employee Last Name is required',
            'emp_gen.required' => 'Employee Gender is required',
            'emp_contact.required' =>'Employee Contact is required is required',
            'emp_contact.digits:11' =>'Employee Contact must be 11 digits',
            'pos_id.required'=>'Employee Position is required',
            'emp_address.required' => 'Employee Email is required.',
            'joining_date.required'=>'Employee Joining Date is required'
        ]);
      
        $input = $request->all();
        $storeitem = Employee::create($input);
    
        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employees.show',compact('employee'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $empsPos=EmployeePosition::get();
        $emps = Employee::find($id);
        return view('employees.edit',compact('emps','empsPos'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'emp_fname' => 'required',
            'emp_lname' => 'required',
            'emp_gen' => 'required',
            'emp_contact'=>'required|digits:11',
            'pos_id' => 'required',
            'emp_address'=>'required',
            'emp_status' => 'required|boolean',
            'joining_date' => 'required',
            'leaving_date' => 'nullable'
        ],[
            'emp_fname.required'=>'Employee First Name is required',
            'emp_lname.required' => 'Employee Last Name is required',
            'emp_gen.required' => 'Employee Gender is required',
            'emp_contact.required' =>'Employee Contact is required is required',
            'emp_contact.digits:11' =>'Employee Contact must be 11 digits',
            'pos_id.required'=>'Employee Position is required',
            'emp_address.required' => 'Employee Email is required.',
            'joining_date.required'=>'Employee Joining Date is required'
        ]);
        $employee = Employee::find($id);
        $input = $request->all();
        $employee->update($input);

        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}
