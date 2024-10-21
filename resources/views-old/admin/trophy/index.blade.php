@extends('admin.layouts.master')

@section('title', 'Trophy')
@section('content')
    <div class="card">
	    <div class="card-header">
	        <h3 class="card-title">Guide list</h3>
            <div class="float-sm-right">
                <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="location.href='{{route('trophy.create')}}';">
                    <i class="fas fa-plus"></i>
                    Create
                </button>
            </div>
	    </div>
	    <!-- /.card-header -->
        <div class="card-body">
	        <table id="example1" class="table table-bordered table-responsive table-striped">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Trophy</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if( count($trophy) > 0)
                    @foreach($trophy as $item)
                        <tr>
                            <td width="300px">S.No :: {{$item->id}}</td>
                         
                            <td  width="300px">
                                {{$item->name}}
                            </td>
                   
                            <td  width="300px">
                            {{$item->trophy}}
                            </td>
                      
                            <td  width="300px">
                                <div class="btn-group btn-group-sm dtr-data-2">
                                    <a href="{{route('trophy.edit',$item->id)}}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{route('trophy.destroy',$item->id)}}" method="Post">
                                        @method('DELETE')    
                                        @csrf
                                        <button onclick="return confirm('Are you sure want to delete this???')" class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> </button>
                                    </from>
                                </div>

                            </td>
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
	    <style>
	    
.dtr-data-2 a,
.dtr-data-2 button{
     margin:3px 5px;
}
	    </style>
	  <!-- /.card-body -->
    </div>
@endsection
