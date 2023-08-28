@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Consumed Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/consumeditems') }}">Consumed Items</a></li>
                        <li class="breadcrumb-item active">Create Consumed Item</li>
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
      Add New Consumed Item
    </h3>
    <div class="float-right">
            <a href="{{ route('inventory.index') }}" class="btn btn-danger text-white p-2">
              <i class="nav-icon fas fa-chart-pie"></i>
                Open Inventory
            </a>
    </div>
    </div>
    <div class="card-body">

        <form action="{{ route('consumeditems.store') }}" method="POST" enctype="multipart/form-data">
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
            <table class="table table-bordered table-striped" id="dynamicTable">
                <thead class="bg-secondary">
                <tr>
                    <th>S.No</th>
                    <th>Consumed Item</th>
                    <th>Consumed Quantity</th>
                    <th>Consumed Date</th>
                    <th class="trAdd" id="trAdd"><span><i class="fa fa-check-circle text-success"></i></span></th>
                </tr>
                </thead>
                <tbody>
                    @if(session()->has('addmore'))
                        @foreach(session('addmore') as $key=>$value)
                        <tr>
                        <td>{{$key}}</td>
                        <td>
                            <select name="addmore[{{$key}}][itemId]"  class="form-control drdown">
                                <option value="">--Select Item--</option>
                                @foreach($items as $item)
                                <option value="{{$item->itemId}}" {{$value['itemId']==$item->itemId?"selected":""}}>{{$item->itemName}}</option>
                                @endforeach
                        </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="addmore[{{$key}}][cquantity]" value="{{ $value['cquantity'] }}" placeholder="Enter Consumed Quantity">
                            <input type="hidden" name="addmore[{{$key}}][maxQuan]" class="max-quan" value="{{ $value['maxQuan'] }}">
                        </td>
                        <td>
                            <input type="date" name="addmore[{{$key}}][consumedDate]" id="consumedDate" class="form-control" placeholder="Enter Consumed Date" value="{{ $value['consumedDate'] }}">
                        </td>
                        <td class="tdDelete"><span><i class="fa fa-times-circle text-danger"></i></span></td>
                        </tr>
                        @endforeach
                    @endif
            </tbody>
            </table>
            </div>
            <button class="btn btn-primary text-white" type="submit" style="float:right">Add Consumed Items</button>
        </form>
    </div>
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
        $("#dynamicTable").append('<tr><td>'+i+'</td><td><select name="addmore['+i+'][itemId]"  class="form-control drdown"><option value="">--Select Consumed Item--</option>@foreach($items as $item)<option value="{{$item->itemId }}">{{$item->itemName}}</option>@endforeach</select></td><td><input type="text" name="addmore[' + i +'][cquantity]" placeholder="Enter Consumed Quantity" class="form-control" /><input type="hidden" name="addmore[' + i +'][maxQuan]" class="max-quan"></td><td><input type="date" name="addmore[' + i +'][consumedDate]" placeholder="Enter Cosumed Date" class="form-control" value="{{ old('addmore[i][consumedDate]',$defaultDate) }}" /></td><td class="tdDelete"><span><i class="fa fa-times-circle text-danger"></i></span></td></tr>'
            );
    });
    $(document).on('click', '.tdDelete', function () {
        $(this).parents('tr').remove();
        var key=0;
          $('#dynamicTable tbody tr').each(function(index) {
            $(this).children('td:first').html(index);
            var itemId = 'addmore[' + index + '][itemId]';
            $(this).find('select').attr('name', itemId);
            var cquantity = 'addmore[' + index + '][cquantity]';
            $(this).find('td:eq(2) input').attr('name', cquantity);
            var consumedDate = 'addmore[' + index + '][consumedDate]';
            $(this).find('td:eq(3) input').attr('name', consumedDate);
            key=key+1;
          });
    });
    
    $(document).on('change', '.drdown', function() {
  var dropdownValue = $(this).val();
  var numberInput = $(this).closest('tr').find('.max-quan');

  // Make the AJAX call
  // Retrieve the CSRF token value from the meta tag
var csrfToken = $('meta[name="csrf-token"]').attr('content');
if (csrfToken){
  $.ajax({
    url: '{{ route('consumeditems.getStock') }}', // Replace with the actual route to your Laravel controller/action
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    data: { value: dropdownValue },
    success: function(response) {
      numberInput.val(response.number);
    },
        error: function (xhr, status, error) {
        // Handle the error response
        console.log(xhr.responseText);
    }

  });
}
else{
    console.log('CSRF token not found');
}
});
</script>
@endsection