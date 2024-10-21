@extends('frontend.layouts.master')
@section('title','Product List')
@section('content')
    <section class="dashboard">
        <h2 class="Shopping-heading">Products </h2>
        <div class="container">
            <div class="row">
                @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                    

                    <div id="Products" class="tabcontent" style="display: block;">
                        <div class="dash-div1">
                            <h2 class="dashboard-txt1">Your Products</h2>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Product Image</th>
                                <th>Product Info</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($products as $product)
                            @php
                                $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                                // dd($sub_cat_info);
                                $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
                            @endphp
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>
                                        @php
                                            $photo=explode(',',$product->photo);
                                            // dd($photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:200px" alt="{{$product->photo}}"><br>
                                </td>
                                <td>
                                    <b>Prodcuct Name</b> : {{$product->title}} <br>
                                    <b>Category</b> : {{$product->cat_info['title']}} <br>
                                    <b>Feature</b> : {{(($product->is_featured==1)? 'Yes': 'No')}} <br>
                                    <b>Price</b> : Rs. {{$product->price}} /- <br>
                                    <b>Size</b> : {{$product->size}} <br>
                                    <b>Color</b> : {{$product->color}} <br>
                                    <b>Condition</b> : {{$product->condition}} <br>
                                    <b>Brand</b> : {{$product->brand}} <br>
                                </td>
                                <td>
                                    @if($product->status=='active')
                                        <span class="badge badge-success">{{$product->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$product->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->role =='admin')
                                        <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    @else
                                        <a href="{{route('vproduct.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    @endif
                                    <form method="POST" action="{{route('vproduct.destroy',[$product->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id='{{$product->id}}' style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
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