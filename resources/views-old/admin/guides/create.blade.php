@extends('admin.layouts.master')

@section('title', 'Guides')
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
                            <h3 class="card-title">Guides <small>ADD</small></h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                                @foreach ($errors->all() as $e)
                                <label class="btn btn-danger">{{ $e }}</label>
                                @endforeach
                        @endif

                        <!-- form start -->
                        <form action="{{route('guides.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input name="question" type="text" class="form-control" placeholder="Enter ..." required>
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description"  class="form-control" required></textarea>
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

