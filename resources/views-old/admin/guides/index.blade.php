@extends('admin.layouts.master')

@section('title', 'Guides')
@section('content')
    <div class="card">
	    <div class="card-header">
	        <h3 class="card-title">Guide list</h3>
            <div class="float-sm-right">
                <button type="button" class="btn btn-block btn-outline-info btn-sm" onclick="location.href='{{route('guides.create')}}';">
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
                        <th>Question</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if( count($guides) > 0)
                    @foreach($guides as $val)
                        <tr>
                            <td>S.No :: {{$val->id}}</td>
                         
                            <td>
                                {{$val->question}}
                            </td>
                   
                            <td>
                            {{$val->description}}
                            </td>
                      
                            <td>
                                <div class="btn-group btn-group-sm dtr-data-2">
                                    <a href="{{route('guides.edit',$val->id)}}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{route('guides.destroy',$val->id)}}" method="Post">
                                        @method('DELETE')    
                                        @csrf
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> </button>
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
