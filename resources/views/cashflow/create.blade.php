@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Non Inventory Expenses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/cashflow') }}">Non Inventory Expenses</a></li>
                        <li class="breadcrumb-item active">Create Expense</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
</section>
<section class="content">
<div class="row">
<div class="col-md-12">
    @if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    <div class="card">
        <div class="card-header bg-info">
                <h3 class="card-title">
      <i class="fa fa-users mr-1"></i>
      Add New Non Inventory Expense
    </h3>
    <div class="float-right">
            <a href="{{ route('cfmain.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Cash Flow
            </a>
    </div>
    </div>
    <div class="card-body">
        
        <form id="expense-entry" action="{{ route('cashflow.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
   
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="document active">
             <table class="table table-sm"  id="dynamicTable">
                <thead class="bg-secondary">
                <tr>
                    <th>S.No</th>
                    <th>Expense Category</th>
                    <th>Expense Details</th>
                    <th>Expense Amount</th>
                    <th class="trAdd" id="trAdd"><span><i class="fa fa-check-circle text-success"></i></span></th>
                </tr>
                </thead>
                <tbody>
                    @if(session()->has('addmore'))
                        @foreach(session('addmore') as $key=>$value)
                        <tr class="headtr">
                        <td>{{$key}}</td>
                        <td>
                            <select name="addmore[{{$key}}][cf_catId]"  class="form-control drdown">
                                <option value="">--Expense Category--</option>
                                @foreach($categories as $category)
                                <option value="{{$category->cf_catId}}" {{$value['cf_catId']==$category->cf_catId?"selected":""}}>{{$category->cf_catName}}</option>
                                @endforeach
                        </select>
                        </td>
                        <td>
                            <textarea type="textarea" name="addmore[{{$key}}][cfdetails]" class="form-control" placeholder="Enter Expense Details">{{ $value['cfdetails'] }}</textarea>
                        </td>
                        <td>
                            <input type="text" name="addmore[{{$key}}][cfexpense]" class="form-control form-line form-cost" placeholder="Enter Consumed Amount"  value="{{ $value['cfexpense'] }}">
                            <input type="hidden" class="form-value" value="0">
                        </td>
                        <td class="tdDelete"><span><i class="fa fa-times-circle text-danger"></i></span></td>
                        </tr>
                        @endforeach
                    @endif
                    {{-- <tr class="headtr">
                        <td class="rowcount">1</td>
                        <td>
                            <select name="addmore[0][cf_catId]" id="addmore[0][cf_catId]" class="form-control">
                                <option value="">--Expense Category--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->cf_catId }}">{{$category->cf_catName}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <textarea type="textarea" name="addmore[0][cfdetails]" class="form-control" placeholder="Enter Expense Details"></textarea>
                        </td>
                        <td>
                            <input type="text" name="addmore[0][cfexpense]" class="form-control form-cost" placeholder="Enter Expense Amount">
                            <input type="hidden" class="form-line" value="0">
                        </td>
                        <td class="tdDelete"><span><i class="fa fa-times-circle text-danger"></i></span></td>
                    </tr> --}}
                </tbody>
    <tfoot style="border: none;">
        <tr>
          <td style=""></td>
          <td ></td>
        <td style="text-align:right"><label>TOTAL:</label></td>
        <td class="total amount" contenteditable="true" id="total">0.00</td>
        <td class="docEdit"></td>
        </tr>
        
      </tfoot>
            </table> 
            </div>
            <button class="btn btn-primary text-white" type="submit" style="float:right">Add Expenses</button>
        </form>
</div>
</div>
</div>
</section>
@endsection
@section('js')
<script src="{{ asset('adm/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adm/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adm/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    var i = 0;
    $("#trAdd").click(function () {
        var totalTrs=$('#dynamicTable tbody tr').length;
        i=totalTrs;
        $("#dynamicTable").append('<tr><td>'+i+'</td><td><select name="addmore['+i+'][cf_catId]"  class="form-control drdown"><option value="">--Expense Category--</option>@foreach($categories as $category)<option value="{{$category->cf_catId }}">{{$category->cf_catName}}</option>@endforeach</select></td><td><textarea type="text" name="addmore[' + i +'][cfdetails]" placeholder="Enter Expense Details" class="form-control"></textarea></td><td><input type="text" name="addmore[' + i +'][cfexpense]" placeholder="Enter Expense Amount" class="form-control form-line form-cost" /><input type="hidden" class="form-value" value="0"></td><td class="tdDelete"><span><i class="fa fa-times-circle text-danger"></i></span></td></tr>'
            );
    });
    $(document).on('click', '.tdDelete', function () {
        $(this).parents('tr').remove();
        var key=0;
          $('#dynamicTable tbody tr').each(function(index) {
            $(this).children('td:first').html(index);
            var cf_catId = 'addmore[' + index + '][cf_catId]';
            $(this).find('select').attr('name', cf_catId);
            var cfdetails = 'addmore[' + index + '][cfdetails]';
            $(this).find('td:eq(2) textarea').attr('name', cfdetails);
            var cfexpense = 'addmore[' + index + '][cfexpense]';
            $(this).find('td:eq(3) input').attr('name', cfexpense);
            key=key+1;
          });
    });
    $(document).ready(function() {
    $("#dynamicTable").on("keyup", ".form-line", function() {
        var parent = $(this).closest("tr");
         parent.find(".form-value").val(parseFloat(parent.find(".form-cost").val()).toFixed(2));

        var total = 0;
        $(".form-value").each(function(){
            total += parseFloat($(this).val()||0);
        });
        $("#total").text(total.toFixed(2));
    });
        $('.form-line').each(function() {
          var parent = $(this).closest("tr");
         parent.find(".form-value").val(parseFloat(parent.find(".form-cost").val()).toFixed(2));
        // var bb=parent.find(".form-qty").val();
        // alert(bb);

        var total = 0;
        $(".form-value").each(function(){
            total += parseFloat($(this).val()||0);
        });
        $("#total").text(total.toFixed(2));
      });
});
</script>
@endsection