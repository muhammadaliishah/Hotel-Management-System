<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePay;
use App\Models\EmployeePosition;
use App\Models\EmployeePayRoll;
use App\Models\EmployeeTransaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeePayRollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new EmployeePayRoll();
        $data=$data::leftJoin('employees','employee_payroll.emp_Id','=','employees.emp_Id')
        ->leftJoin('employee_positions','employees.pos_id','=','employees.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employees.emp_gen','employees.emp_contact','employees.emp_address','employees.emp_status','employees.joining_date','employees.leaving_date','employee_positions.pos_id','employee_positions.pos_type','employee_positions.pos_name','employee_payroll.payroll_Id','employee_payroll.days_worked','employee_payroll.overtime_hrs_worked','employee_payroll.overtime_hrs_fare','employee_payroll.hours_late','employee_payroll.hours_late_deduction','employee_payroll.days_absent','employee_payroll.days_absent_deduction','employee_payroll.bonus_description','employee_payroll.bonus_amount','employee_payroll.loan_deduction','employee_payroll.estimated_month_salary','employee_payroll.salary_month','employee_payroll.salary_year','employee_payroll.created_at','employee_payroll.updated_at');
        if ($request->search) {
            $data = $data->where('emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employees_payroll.index')->with('data', $data);
    }

    public function getEmpDetails(Request $request)
{
   $result = DB::table('employees as emp')
    ->select('emp.emp_Id',
        DB::raw('CASE WHEN es.salary_status = 1 THEN es.monthly_salary ELSE NULL END as monSalary'),
        DB::raw('SUM(COALESCE(el.transaction_amount, 0)) as totalLoan')
    )->where('emp.emp_Id','=',$request->value)->where('es.salary_status','=',1)
    ->leftJoin('emp_salaries as es', 'emp.emp_Id', '=', 'es.emp_Id')
    ->leftJoin('emp_loans as el', 'emp.emp_Id', '=', 'el.emp_Id')
    ->groupBy('emp.emp_Id', 'es.salary_status','es.monthly_salary')
    ->first();
    return response()->json(['result' => $result]);
}
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emp = new Employee();
        $currentYear = Carbon::now()->year;
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        //$defaultDate = now()->toDateString();
        return view('employees_payroll.create',['emp'=>$emp,'currentYear'=>$currentYear]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_Id' => 'required',
            'days_worked' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:31',
            'overtime_hrs_worked' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'overtime_hrs_fare'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'hours_late' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'hours_late_deduction'=>'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->mn_salary,
            'days_absent' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:31',
            'days_absent_deduction' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->mn_salary,
            'bonus_description' => 'required',
            'bonus_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'loan_deduction' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->loan_dues,
            'estimated_month_salary'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'salary_month' => 'required',
            'salary_year'=>'required'
        ],[
            'emp_Id.required'=>'Please select employee',
            'days_worked.required' => 'Number of days worked  is required',
            'days_worked.regex' => 'Inavlid format for number of days worked',
            'overtime_hrs_worked.required' => 'Number of overtime hours worked is required',
            'days_worked.regex' => 'Inavlid format for number of overtime hours worked',
            'overtime_hrs_fare.required' =>'Amount for overtime hours worked is required',
            'overtime_hrs_fare.regex' =>'Invalid format for overtime amount fare',
            'hours_late.required' =>'Number of hours late is required',
            'hours_late.regex' =>'Invalid format for late hours',
            'hours_late_deduction.required'=>'Late hours amount dedcution is required',
            'hours_late_deduction.regex' =>'Invalid format for late hours amount dedcution',
            'days_absent.required' => 'Number of days absent is required.',
            'days_absent.regex' => 'Invalid format for days abesent',
            'days_absent_deduction.required'=>'Amount deduction for days absent is required',
            'days_absent_deduction.regex'=>'Invalid format for days absent amount deduction',
            'bonus_description.required' =>'Bonus description is required',
            'bonus_amount.required'=>'Bonus amount is required',
            'bonus_amount.regex'=>'Invalid format for bonus amount',
            'loan_deduction.required' => 'Advance loan deduction amount is required',
            'loan_deduction.regex' => 'Invalid format for advance loan deduction amount',
            'estimated_month_salary.required'=>'Estimated monthly salary is required',
            'estimated_month_salary.regex'=>'Invalid format for estimated monthly salary',
            'salary_month.required' => 'Salary month is required.',
            'salary_year.required'=>'Salary year is required',
        ]);
        $loanId=null;
        if($request->loan_deduction>0){
            $loan=new EmployeeTransaction();
            $loan->emp_Id=$request->emp_Id;
            $loan->transaction_amount=-$request->loan_deduction;
            $loan->payment_nature='Deduction';
            $loan->transaction_date=Carbon::now()->toDateString();
            $loan->save();
            $loanId=$loan->loanId;
        }
        $input = $request->all();
        $input['loanId']=$loanId;
        $monthly_salary = EmployeePayRoll::create($input);
        
        return redirect()->route('employees_payroll.index')
                        ->with('success','Employee payroll created successfully');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emp = new Employee();
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        return view('employees_payroll.show',compact('emp'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $emp = new Employee();
        $currentYear = Carbon::now()->year;
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        $payroll = new EmployeePayRoll();
        $payroll=$payroll::leftJoin('employees','employee_payroll.emp_Id','=','employees.emp_Id')
        ->leftJoin('employee_positions','employees.pos_id','=','employees.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employees.emp_gen','employees.emp_contact','employees.emp_address','employees.emp_status','employees.joining_date','employees.leaving_date','employee_positions.pos_id','employee_positions.pos_type','employee_positions.pos_name','employee_payroll.payroll_Id','employee_payroll.loanId','employee_payroll.days_worked','employee_payroll.overtime_hrs_worked','employee_payroll.overtime_hrs_fare','employee_payroll.hours_late','employee_payroll.hours_late_deduction','employee_payroll.days_absent','employee_payroll.days_absent_deduction','employee_payroll.bonus_description','employee_payroll.bonus_amount','employee_payroll.loan_deduction','employee_payroll.estimated_month_salary','employee_payroll.salary_month','employee_payroll.salary_year','employee_payroll.created_at','employee_payroll.updated_at')->where('employee_payroll.payroll_Id','=',$id)->first();
        $loanamount=0;
        $loan=EmployeeTransaction::find($payroll->loanId);
        if($loan){
            $loanamount=$loan->transaction_amount;
        }
        //dd($payroll['salary_year']);
        return view('employees_payroll.edit',compact('emp','currentYear','payroll','loanamount'));
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
            'days_worked' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:31',
            'overtime_hrs_worked' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'overtime_hrs_fare'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'hours_late' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'hours_late_deduction'=>'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->mn_salary,
            'days_absent' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:31',
            'days_absent_deduction' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->mn_salary,
            'bonus_description' => 'required',
            'bonus_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'loan_deduction' => 'required|regex:/^\d+(\.\d{1,2})?$/|lte:'.$request->loan_dues,
            'estimated_month_salary'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'salary_month' => 'required',
            'salary_year'=>'required'
        ],[
            'emp_Id.required'=>'Please select employee',
            'days_worked.required' => 'Number of days worked  is required',
            'days_worked.regex' => 'Inavlid format for number of days worked',
            'overtime_hrs_worked.required' => 'Number of overtime hours worked is required',
            'days_worked.regex' => 'Inavlid format for number of overtime hours worked',
            'overtime_hrs_fare.required' =>'Amount for overtime hours worked is required',
            'overtime_hrs_fare.regex' =>'Invalid format for overtime amount fare',
            'hours_late.required' =>'Number of hours late is required',
            'hours_late.regex' =>'Invalid format for late hours',
            'hours_late_deduction.required'=>'Late hours amount dedcution is required',
            'hours_late_deduction.regex' =>'Invalid format for late hours amount dedcution',
            'days_absent.required' => 'Number of days absent is required.',
            'days_absent.regex' => 'Invalid format for days abesent',
            'days_absent_deduction.required'=>'Amount deduction for days absent is required',
            'days_absent_deduction.regex'=>'Invalid format for days absent amount deduction',
            'bonus_description.required' =>'Bonus description is required',
            'bonus_amount.required'=>'Bonus amount is required',
            'bonus_amount.regex'=>'Invalid format for bonus amount',
            'loan_deduction.required' => 'Advance loan deduction amount is required',
            'loan_deduction.regex' => 'Invalid format for advance loan deduction amount',
            'estimated_month_salary.required'=>'Estimated monthly salary is required',
            'estimated_month_salary.regex'=>'Invalid format for estimated monthly salary',
            'salary_month.required' => 'Salary month is required.',
            'salary_year.required'=>'Salary year is required',
        ]);
        $monthly_salary = EmployeePayRoll::find($id);
        $input = $request->all();
        $loan=EmployeeTransaction::find($input['loanId']);
        if($loan){
            $loan->transaction_amount=-$input['loan_deduction'];
            $loan->save();
        }
        $monthly_salary->update($input);

        return redirect()->route('employees_payroll.index')
                        ->with('success','Employee payroll updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $payroll=EmployeePayRoll::find($id);
        $loan=EmployeeTransaction::find($payroll->loanId);
        if($loan){
            $loan->delete();
        }
        $payroll->delete();
        return redirect()->route('employees_payroll.index')
                        ->with('success','Employee payroll deleted successfully');
    }
}
