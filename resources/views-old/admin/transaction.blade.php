@extends('admin.layouts.master')

@section('title', 'Transaction')
@section('content')
  <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
 
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
	        <table id="myTable" class="table table-bordered table-responsive table-striped">

                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th width="900">Date</th>
                        <th>Type</th>
                        <th style="width:100%">Reason</th>
                        <th>Status</th>

                    </tr>
                </thead>

                <tbody>
                    @if( count($transaction) > 0)
                    @foreach($transaction as $val)
                        <tr>
                            <td>{{$val->id}}</td>
                         
                            <td>{{$val->user->email}}</td>
                   
                            <td>{{$val->amount}}</td>
                            <td>{{$val->date}}</td>
                            <td>{{$val->type}}</td>
                            <td>{{$val->reason}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary @if($val->status == 'Pending') dropdown-toggle @endif" type="button" @if($val->status == 'Pending') id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"   @endif>
                                    {{$val->status}}
                                    </button>
                                    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('transaction_status',$val->id)}}?status=Approved">Approved</a>
                                        <!-- <a class="dropdown-item" href="#">Pending</a> -->
                                    </div>
                                </div>
                            </td>
                      
                            <!-- <td>
                                <div class="btn-group btn-group-sm dtr-data-2">
                                    <form action="{{route('guides.destroy',$val->id)}}" method="Post">
                                        @method('DELETE')    
                                        @csrf
                                        <button class="btn btn-danger" type="submit" onclic="return confirm('Are You Sure Want To D')"><i class="fas fa-trash"></i> </button>
                                    </from>
                                </div>

                            </td> -->
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        No Record Found
                    </tr>
                    @endif
                </tbody>
            </table>
	    </div>
	   
	  <!-- /.card-body -->
    </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $('#myTable').DataTable();
</script>
  @endsection
