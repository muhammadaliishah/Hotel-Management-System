<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeTransaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmployeeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('emp_loans AS el')
        ->leftJoin('employees AS emp', 'el.emp_Id', '=', 'emp.emp_Id')
        ->leftJoin('employee_positions AS empp', 'emp.pos_id', '=', 'empp.pos_id')
        ->select('emp.emp_Id', 'emp.emp_fname', 'emp.emp_lname', 'empp.pos_name')
        ->selectRaw('SUM(COALESCE(CASE WHEN el.transaction_amount > 0 THEN el.transaction_amount ELSE 0 END)) AS AmountReceived')
        ->selectRaw('SUM(COALESCE(CASE WHEN el.transaction_amount < 0 THEN el.transaction_amount ELSE 0 END)) AS AmountPaid')
        ->groupBy('emp.emp_Id', 'emp.emp_fname', 'emp.emp_lname', 'empp.pos_name');
        if ($request->search) {
            $data = $data->where('employees.emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employee_transactions.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($pn=null)
    {
        $paymentNature=null;
        if($pn==1){
            $paymentNature='Payment';
        }
        elseif($pn==2){
            $paymentNature='Deduction';
        }
        else{
            $paymentNature='Addition';
        }
        $emp = new Employee();
        $emp=$emp::leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name')->get();
        $defaultDate = now()->toDateString();
        return view('employee_transactions.create',['emp'=>$emp,'defaultDate'=>$defaultDate,'paymentNature'=>$paymentNature]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_Id' => 'required',
            'transaction_amount' => 'required|regex:/^-?\d+(\.\d{1,2})?$/',
            'transaction_date' => 'required'
        ],[
            'emp_Id.required'=>'Please select employee',
            'transaction_amount.required' => 'Loan Amount received or paid is required',
            'transaction_amount.regex' => 'Loan Amount format is invalid',
            'transaction_date.required' => 'Loan Amount received or paid date is required'
        ]);
      
        $input = $request->all();
        if($input['payment_nature']=='Addition'){
            $input['transaction_amount']=$input['transaction_amount'];
        }
        else{
            $input['transaction_amount']=-$input['transaction_amount'];
        }
        //dd($input);
        $emp_salary = EmployeeTransaction::create($input);
        
        return redirect()->route('employee_transactions.index')
                        ->with('success','Loan received or paid created successfully');
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $data = new EmployeeTransaction();
        $data=$data::leftJoin('employees','emp_loans.emp_Id','=','employees.emp_Id')
        ->leftJoin('employee_positions','employees.pos_id','=','employee_positions.pos_id')
        ->select('employees.emp_Id','employees.emp_fname','employees.emp_lname','employee_positions.pos_name','emp_loans.loanId','emp_loans.transaction_amount','emp_loans.payment_nature','emp_loans.transaction_date')->where('emp_loans.emp_Id','=',$id)->orderby('emp_loans.payment_nature');
        if ($request->search) {
            $data = $data->where('employees.emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        return view('employee_transactions.show',compact('data'));
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
        $emp_transaction = EmployeeTransaction::find($id);
        return view('employee_transactions.edit',compact('emp_transaction','emp'));
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
            'transaction_amount' => 'required|regex:/^-?\d+(\.\d{1,2})?$/',
            'transaction_date' => 'required'
        ],[
            'emp_Id.required'=>'Please select employee',
            'transaction_amount.required' => 'Loan Amount received or paid is required',
            'transaction_amount.regex' => 'Loan Amount format is invalid',
            'transaction_date.required' => 'Loan Amount received or paid date is required'
        ]);
        $emp_transaction = EmployeeTransaction::find($id);
        $input = $request->all();
        $emp_transaction->update($input);

        return redirect()->route('employee_transactions.index')
                        ->with('success','Loan received or paid updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        EmployeeTransaction::find($id)->delete();
        return redirect()->route('employee_transactions.index')
                        ->with('success','Loan received or paid deleted successfully');
    }
}
