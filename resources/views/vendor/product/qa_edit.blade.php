@extends('frontend.layouts.master')
@section('title','Product Create')

@section('content')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<section class="dashboard">
        <h2 class="Shopping-heading">Edit Q/A</h2>
        <div class="container">
            <div class="row">
                @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                    <div class="dash-div1">
                        <h2 class="dashboard-txt1">Edit Product Q/A</h2>
                    </div>
                    <div id="Products" class="tabcontent" style="display: block;">
                        <form method="post" action="{{route('vproductqa.update',$product->id)}}">
                            {{csrf_field()}}
                            @method('put')
                            <div class="form-group">
                                <label for="summary" class="col-form-label">Answer <span class="text-danger">*</span></label>
                                <textarea class="form-control"  name="answer">{{$product->answer}}</textarea>
                                @error('answer')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection