@extends('frontend.layouts.master')
@section('title','E-SHOP || HOME PAGE')
@section('content')
 <section class="bg1">
        <div class="container-fluid">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-md-9">
                    <div id="product">
                        <h2 class="product-paddles">Featured Products</h2>
                        <div class="row">
                            @if($featured)
                            @foreach($featured as $row)
                            @php 
                                $photo=explode(',',$row->photo);
                                // dd($photo);
                            @endphp
                            <div class="col-md-3">
                                <div class="image-box">
                                    <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                            alt="product1" class="p1"></a>
                                    <div class="star"><a href="javascript:"><i class="fa fa-star"></i></div></a>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="lorem"> {{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                    <div class="price">
                                        <h3 class="price1">${{$row->price}} Price</h3>
                                        @if($row->is_featured == 1)
                                            <a href="javascript:"><button class="featured">Featured</button></a>
                                        @endif
                                    </div>
                                    <div class="addtocart">
                                        <!-- <a href="javascript:"><button class="cart"><i class="fa fa-cart-shopping"></i>
                                                Add To
                                                Cart</button></a> -->
                                        <a href="{{route('add-to-wishlist',$row->slug)}}" style="color:#fff"><i class="fa fa-heart hearta"></i></a>
                                        <img src="{{asset('/frontend')}}/assets/images/vertical-line.png" alt="vertical-line"
                                            class="verti-line">
                                        <a href="javascript:" style="color:#fff"><i
                                                class="fa fa-code-compare hearta"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                   <!--slider -->
                    <div class="all-products">
                        @if($catp1 != '[]')
                        <div class="net-product all">
                            <h2 class="product-nets">{{$catp1[0]->cat_info->title}}</h2>
                            <div class="net-row">
                                <a href="{{route('product-cat',$catp1[0]->cat_info->slug)}}">
                                    <h3 class="see-all-net">See All</h3>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($catp1 as $row)
                                    @php 
                                        $photo=explode(',',$row->photo);
                                        // dd($photo);
                                    @endphp
                                <div class="col-md-3">
                                    <div class="image-box1">
                                        <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                                alt="product1" class="p1"></a>
                                    </div>
                                    <div class="price">
                                        <h3 class="paddle-price">${{$row->price}} Price</h3>
                                    </div>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="paddle-title">{{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        @endif
                        @if($catp2 != '[]')
                        <div class="net-product all">
                            <h2 class="product-nets">{{$catp2[0]->cat_info->title}}</h2>
                            <div class="net-row">
                                <a href="{{route('product-cat',$catp2[0]->cat_info->slug)}}">
                                    <h3 class="see-all-net">See All</h3>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($catp2 as $row)
                                    @php 
                                        $photo=explode(',',$row->photo);
                                        // dd($photo);
                                    @endphp
                                <div class="col-md-3">
                                    <div class="image-box1">
                                        <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                                alt="product1" class="p1"></a>
                                    </div>
                                    <div class="price">
                                        <h3 class="paddle-price">${{$row->price}} Price</h3>
                                    </div>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="paddle-title">{{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        @endif
                        @if($catp3 != '[]')
                        <div class="net-product all">
                            <h2 class="product-nets">{{$catp3[0]->cat_info->title}}</h2>
                            <div class="net-row">
                                <a href="{{route('product-cat',$catp3[0]->cat_info->slug)}}">
                                    <h3 class="see-all-net">See All</h3>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($catp3 as $row)
                                    @php 
                                        $photo=explode(',',$row->photo);
                                        // dd($photo);
                                    @endphp
                                <div class="col-md-3">
                                    <div class="image-box1">
                                        <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                                alt="product1" class="p1"></a>
                                    </div>
                                    <div class="price">
                                        <h3 class="paddle-price">${{$row->price}} Price</h3>
                                    </div>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="paddle-title">{{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        @endif
                        @if($catp4 != '[]')
                        <div class="net-product all">
                            <h2 class="product-nets">{{$catp4[0]->cat_info->title}}</h2>
                            <div class="net-row">
                                <a href="{{route('product-cat',$catp4[0]->cat_info->slug)}}">
                                    <h3 class="see-all-net">See All</h3>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($catp4 as $row)
                                    @php 
                                        $photo=explode(',',$row->photo);
                                        // dd($photo);
                                    @endphp
                                <div class="col-md-3">
                                    <div class="image-box1">
                                        <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                                alt="product1" class="p1"></a>
                                    </div>
                                    <div class="price">
                                        <h3 class="paddle-price">${{$row->price}} Price</h3>
                                    </div>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="paddle-title">{{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        @endif
                        @if($catp5 != '[]')
                        <div class="net-product all">
                            <h2 class="product-nets">{{$catp5[0]->cat_info->title}}</h2>
                            <div class="net-row">
                                <a href="{{route('product-cat',$catp5[0]->cat_info->slug)}}">
                                    <h3 class="see-all-net">See All</h3>
                                </a>
                            </div>
                            <div class="row">
                                @foreach($catp5 as $row)
                                    @php 
                                        $photo=explode(',',$row->photo);
                                        // dd($photo);
                                    @endphp
                                <div class="col-md-3">
                                    <div class="image-box1">
                                        <a href="{{ route('product-detail',$row->slug ) }}" class="imganchor"><img src="{{$photo[0]}}"
                                                alt="product1" class="p1"></a>
                                    </div>
                                    <div class="price">
                                        <h3 class="paddle-price">${{$row->price}} Price</h3>
                                    </div>
                                    <a href="{{ route('product-detail',$row->slug ) }}">
                                        <h3 class="paddle-title">{{ \Illuminate\Support\Str::limit($row->title, 15, $end='...') }}</h3>
                                    </a>
                                </div>
                               @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
