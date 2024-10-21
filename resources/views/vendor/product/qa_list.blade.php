@extends('frontend.layouts.master')
@section('title','Product QA List')
@section('content')
    <section class="dashboard">
        <h2 class="Shopping-heading">Products </h2>
        <div class="container">
            <div class="row">
                @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                    

                    <div id="Products" class="tabcontent" style="display: block;">
                        <div class="dash-div1">
                            <h2 class="dashboard-txt1">Products QA List</h2>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Product Image</th>
                                <th>Product Info</th>
                                <th>Q / A</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                        @php
                                            $photo=explode(',',$product['products']->photo);
                                            // dd($photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:200px" alt="{{$product->photo}}"><br>
                                </td>
                                <td>
                                    <b>Prodcuct Name</b> : {{$product['products']->title}} <br>
                                </td>
                                <td>
                                    <b>Question</b> : {{$product->question}} <br>
                                    <b>Answer</b> : {{$product->answer}} <br>
                                </td>
                                
                                <td>
                                    <a href="{{route('vproductqa.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>   
                    </div>

                   
                </div>
            </div>
        </div>

    </section>    
    
@endsection