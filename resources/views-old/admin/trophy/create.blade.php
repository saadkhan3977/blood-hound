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
                            <h3 class="card-title">Trophy <small>ADD</small></h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                                @foreach ($errors->all() as $e)
                                <label class="btn btn-danger">{{ $e }}</label>
                                @endforeach
                        @endif

                        <!-- form start -->
                        <form action="{{route('trophy.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>trophy</label>
                                            <input name="trophy" type="number" class="form-control" placeholder="Enter ..." required>
                                        </div>
                                    </div>                                  
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-sm-right">
                                    <i class="fas fa-plus">
                                    </i>
                                    Save
                                </button>
                                <button type="button" class="btn btn-danger float-sm-left" onclick="location.href='{{route('trophy.index')}}';">
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

