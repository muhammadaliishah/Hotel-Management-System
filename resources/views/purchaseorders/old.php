@section('cs')
<style>
.spreadSheetGroup{
    /*font:0.75em/1.5 sans-serif;
    font-size:14px;
  */
    color:#333;
    background-color:#fff;
    padding:1em;
}

/* Tables */
.spreadSheetGroup table{
    width:100%;
    margin-bottom:1em;
    border-collapse: collapse;
}
.spreadSheetGroup .proposedWork th{
    background-color:#eee;
}
.tableBorder th{
  background-color:#eee;
}
.spreadSheetGroup th,
.spreadSheetGroup tbody td{
    padding:0.5em;

}
.spreadSheetGroup tfoot td{
    padding:0.5em;

}
.spreadSheetGroup td:focus { 
  border:1px solid #fff;
  -webkit-box-shadow:inset 0px 0px 0px 2px #5292F7;
  -moz-box-shadow:inset 0px 0px 0px 2px #5292F7;
  box-shadow:inset 0px 0px 0px 2px #5292F7;
  outline: none;
}
.spreadSheetGroup .spreadSheetTitle{ 
  font-weight: bold;
}
.spreadSheetGroup tr td{
  text-align:center;
}
/*
.spreadSheetGroup tr td:nth-child(2){
  text-align:left;
  width:100%;
}
*/

/*
.documentArea.active tr td.calculation{
  background-color:#fafafa;
  text-align:right;
  cursor: not-allowed;
}
*/
.spreadSheetGroup .calculation::before, .spreadSheetGroup .groupTotal::before{
  /*content: "$";*/
}
.spreadSheetGroup .trAdd{
  background-color: #007bff !important;
  color:#fff;
  font-weight:800;
  cursor: pointer;
}
.spreadSheetGroup .tdDelete{
  background-color: #eee;
  color:#888;
  font-weight:800;
  cursor: pointer;
}
.spreadSheetGroup .tdDelete:hover{
  background-color: #df5640;
  color:#fff;
  border-color: #ce3118;
}
.documentControls{
  text-align:right;
}
.spreadSheetTitle span{
  padding-right:10px;
}

.spreadSheetTitle a{
  font-weight: normal;
  padding: 0 12px;
}
.spreadSheetTitle a:hover, .spreadSheetTitle a:focus, .spreadSheetTitle a:active{
  text-decoration:none;
}
.spreadSheetGroup .groupTotal{
  text-align:right;
}



table.style1 tr td:first-child{
  font-weight:bold;
  white-space:nowrap;
  text-align:right;
}
table.style1 tr td:last-child{
  border-bottom:1px solid #000;
}



table.proposedWork td,
table.proposedWork th,
table.exclusions td,
table.exclusions th{
  border:1px solid #000;
}
table.proposedWork thead th, table.exclusions thead th{
  font-weight:bold;
}
table.proposedWork td,
table.proposedWork th:first-child,
table.exclusions th, table.exclusions td{
  text-align:left;
  vertical-align:top;
}
table.proposedWork td.description{
  width:80%;
}

table.proposedWork td.amountColumn, table.proposedWork th.amountColumn,
table.proposedWork td:last-child, table.proposedWork th:last-child{
  text-align:center;
  vertical-align:top;
  white-space:nowrap;
}

.amount:before, .total:before{
  content: "$";
}
table.proposedWork tfoot td:first-child{
  border:none;
  text-align:right;
}
table.proposedWork tfoot tr:last-child td{
  font-size:16px;
  font-weight:bold;
}

table.style1 tr td:last-child{
  width:100%;
}
table.style1 td:last-child{
  text-align:left;
}
td.tdDelete{
  width:1%;
}

table.coResponse td{text-align:left}
table.shipToFrom td, table.shipToFrom th{text-align:left}

.docEdit{border:0 !important}

.tableBorder td, .tableBorder th{
  border:1px solid #000;
}
.tableBorder th, .tableBorder td{text-align:center}

table.proposedWork td, table.proposedWork th{text-align:center}
table.proposedWork td.description{text-align:left}
</style>
@endsection
@extends('layouts.master')
@section('content')
<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                    <h1>Purchase Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Purchase Orders</li>
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
      Purchase Orders
    </h3>
    <a class="float-right btn-primary mb-2 p-2"  href="">Create New Purchase Order</a>
            </div>
        <div class="card-body" style="overflow: auto;">
            <div class="document active">
  <div class="spreadSheetGroup">

    
    <table class="table-bordered table-striped shipToFrom">
      <thead style="font-weight:bold">
        <tr class="bg-info">
          <th>TO</th>
          <th>SHIP TO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td contenteditable="true" style="width:50%">
            
          </td>
          <td contenteditable="true" style="width:50%">
Apollo Painting & Wallcovering<br/>
ATTN: <br/>
535 N. Eucalyptus Ave.<br/>
Inglewood, CA 90302<br/>
Phone (310)672-3080
          </td>
        </tr>
      </tbody>
    </table>

    <hr style="visibility:hidden"/>
    <table class="table table-striped table-bordered proposedWork" width="100%" style="margin-top:20px">
      <thead class="bg-info">
        <th>QTY</th>
        <th>UNIT</th>
        <th>DESCRIPTION</th>
        <th>COST</th>
        <th class="amountColumn">TOTAL</th>
        <th class="docEdit trAdd">+</th>
      </thead>
      <tbody>
        <tr>
          <td contenteditable="true">1</td>
          <td class="unit" contenteditable="true"></td>
          <td contenteditable="true" class="description"></td>
          <td class="amount" contenteditable="true">0</td>
          <td class="amount amountColumn rowTotal" contenteditable="true">0</td>
          <td class="docEdit tdDelete">X</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td style="border:none"></td>
          <td style="border:none"></td>
          <td style="border:none"></td>
        <td style="border:none;text-align:right">SUBTOTAL:</td>
        <td class="amount subtotal">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style="border:none"></td>
          <td style="border:none"></td>
          <td style="border:none"></td>
        <td style="border:none;text-align:right">SALES TAX:</td>
        <td class="amount" contenteditable="true">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style="border:none"></td>
          <td style="border:none"></td>
          <td style="border:none"></td>
        <td style="border:none;text-align:right;white-space:nowrap">SHIPPING & HANDLING:</td>
        <td class="amount" contenteditable="true">0.00</td>
        <td class="docEdit"></td>
        </tr>
        <tr>
          <td style="border:none"></td>
          <td style="border:none"></td>
          <td style="border:none"></td>
        <td style="border:none;text-align:right">TOTAL:</td>
        <td class="total amount" contenteditable="true"">0.00</td>
        <td class="docEdit"></td>
        </tr>
      </tfoot>
    </table>

    
    
    <table width="100%">
      <tbody>
        <tr>
          <td style="50%" style="vertical-align:top">
            <table style="width:100%">
              <tbody>
                <tr>
                  <td style="text-align:left">
                  <p>1. Please send two copies of your invoice.</p>
<p>2. Enter this order in accordance with the prices, terms, delivery method, and specifications listed above.</p>
<p>3. Please notify us immediately if you are unable to ship as specified.</p>
<p>4. Send all correspondence to:</p>
<p style="padding-left:20px">Apollo Painting & Wallcovering
  <br/>
535 N. Eucalyptus Ave.
  <br/>
Inglewood, CA 90302
  <br/>
Phone (714)326-3025
                  </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td style="padding-left:40px; width:50%; vertical-align:top">
            <table style="width:100%">
              <tbody>
                <tr>
                  <td style="text-align:left">
                    <strong>COMMENTS:</strong>
                  </td>
                </tr>
                <tr>
                  <td contenteditable="true" style="text-align:left;border: 1px solid #000">Please ship all goods to our office using our UPS account #1234</td>
                </tr>
                <tr>
                  <td style="padding-top:60px">
                    Authorized by: _____________________________ Date: __________
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

  

  </div>
</div>
        </div>
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
    <script>
        $(document).ready(function(){
  
    function calculateTotal(currentGroup) {
      var groupTotal = 0;
      currentGroup.parents('table').find('.rowTotal').each(function( i ){
        groupTotal = Number(groupTotal) + Number( $(this).text() );
      });
      currentGroup.parents('table').find('.total').text(groupTotal.toFixed(2));
      currentGroup.parents('table').find('.subtotal').text(groupTotal.toFixed(2));
    }

    $(".document.active").delegate( ".tdDelete", "click", function() {
      if ($(this).parents('tbody').children().length > 1){
        $(this).prev().text('0');
        calculateTotal($(this));
        
        $(this).parents('tr').remove();
      }
    });
  
    $(".document.active").delegate( ".trAdd", "click", function() {
        $(this).parents('table').find('tbody').append( $(this).parents('table').find('tbody tr:last-child').clone() );
        calculateTotal($(this));
    });
  
  $(".document.active").delegate( ".amount", "keyup", function() {
    //console.log('test');
    calculateTotal($(this));
  });
  
  
  
  
    var tdValues = [];
    $(".document.active .proposedWork").delegate( "td:not(.description .unit)", "keyup", function() {
      tdValues.length = 0;
  
        //Paint
        $(this).parents('tr').find('td').each(function( i ){
          if(i > 4){return false}
          if(i == 4){$(this).text( tdValues[0]*tdValues[3] )}
          tdValues[i] = Number( $(this).text() );
        });

      calculateTotal($(this));
    });
  
  
  

});
    </script>
@endsection
