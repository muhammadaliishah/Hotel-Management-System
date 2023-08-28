<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new EmployeeSalary();
        $data=$data::leftJoin('employees','emp_salaries.emp_Id','=','employees.emp_Id')
        ->leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name','emp_salaries.salaryId','emp_salaries.monthly_salary','emp_salaries.salary_status','emp_salaries.created_at','emp_salaries.updated_at');
        if ($request->search) {
            $data = $data->where('employees.emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employee_salaries.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emp = new Employee();
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        $defaultDate = now()->toDateString();
        return view('employee_salaries.create',['emp'=>$emp,'defaultDate'=>$defaultDate]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_Id' => 'required',
            'monthly_salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'salary_status' => 'required|boolean'
        ],[
            'emp_Id.required'=>'Please select employee',
            'monthly_salary.required' => 'Employee Salary is required',
            'monthly_salary.regex' => 'Salary format is invalid',
            'salary_status.required' => 'Salary Status is required'
        ]);
        $input = $request->all();
        if($input['salary_status']==1){
        $oldSal=EmployeeSalary::where('emp_Id','=',$input['emp_Id'])->where('salary_status','=',1)->first();
        if($oldSal){
            $oldSal->salary_status=0;
            $oldSal->save();
        }
    }
        $emp_salary = EmployeeSalary::create($input);
    
        return redirect()->route('employee_salaries.index')
                        ->with('success','Salary created successfully');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emp_salary = EmployeeSalary::find($id);
        return view('employee_salaries.show',compact('emp_salary'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $emp = new Employee();
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        //dd($emp);
        $emp_salary = EmployeeSalary::find($id);
        return view('employee_salaries.edit',compact('emp_salary','emp'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'emp_Id' => 'required',
            'monthly_salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'salary_status' => 'required|boolean'
        ],[
            'emp_Id.required'=>'Please select employee',
            'monthly_salary.required' => 'Employee Salary is required',
            'monthly_salary.regex' => 'Salary format is invalid',
            'salary_status.required' => 'Salary Status is required'
        ]);
        $emp_salary = EmployeeSalary::find($id);
        $input = $request->all();
        if($input['salary_status']==1){
        $oldSal=EmployeeSalary::where('emp_Id','=',$input['emp_Id'])->where('salary_status','=',1)->where('salaryId','!=',$id)->first();
        if($oldSal){
            $oldSal->salary_status=0;
            $oldSal->save();
        }
    }
        $emp_salary->update($input);
        return redirect()->route('employee_salaries.index')
                        ->with('success','Employee salary updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        EmployeeSalary::find($id)->delete();
        return redirect()->route('employee_salaries.index')
                        ->with('success','Employee salary deleted successfully');
    }
}
