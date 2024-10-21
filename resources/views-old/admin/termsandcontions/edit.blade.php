@extends('admin.layouts.master')

@section('title', 'Terms And Contions')
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
                            <h3 class="card-title">Terms <small> & </small>Conditions</h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any())
                                @foreach ($errors->all() as $e)
                                <label class="btn btn-danger">{{ $e }}</label>
                                @endforeach
                        @endif

                        <!-- form start -->
                        <form action="{{route('terms_conditions_post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="id" type="hidden" class="form-control" value="{{($data)?$data->id :''}}" placeholder="Enter ...">
                            
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Effective Date</label>
                                        <input name="effective_date" type="date" class="form-control" value="{{($data)?$data->effective_date :''}}"  required>
                                    </div>
                                    </div>
                             
                                                                 
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control summernote" required>{{($data)?$data->description :''}}</textarea>
                                    </div>
                                    </div>
                                    </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-sm-right">
                                  + SAVE
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

