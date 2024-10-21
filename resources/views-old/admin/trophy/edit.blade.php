@extends('admin.layouts.master')

@section('title', 'Trophy')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <!-- left column -->
                <div class="col-md-12">
                        <!-- jquery validation -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Trophy  <small>Edit</small></h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                                @foreach ($errors->all() as $e)
                                <label class="btn btn-danger">{{ $e }}</label>
                                @endforeach
                        @endif

                        <!-- form start -->
                        <form action="{{route('trophy.update',$trophy->id)}}" method="post" enctype="multipart/form-data">
                            @method('Patch')
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" type="text" class="form-control" value="{{$trophy->name}}" placeholder="Enter ..." required>
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Trophy</label>
                                            <input name="trophy"  class="form-control" required  value="{{$trophy->trophy}}" />
                                        </div>
                                    </div>                                  
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-sm-right">
                                  
                                    UPdate
                                </button>
                                <button type="button" class="btn btn-danger float-sm-left" onclick="location.href='{{route('guides.index')}}';">
                                    <i class="fas fa-reply"></i>  Back
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection

