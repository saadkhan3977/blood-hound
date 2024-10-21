@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection
@section('title','E-SHOP || PRODUCT DETAIL')
@section('content')

<section class="bg1">
        <div class="container-fluid">
            <div class="row">
            @include('frontend.layouts.sidebar')
                <div class="col-md-9">
                    <div class="container pro-cont">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="small-img">
                                    <!-- <img src="images/next-icon.png" class="icon-left" alt="" id="prev-img"> -->
                                    <div class="small-container">
                                        <div id="small-img-roll">
                                         
                                        @php 
                                            $photo=explode(',',$product_detail->photo);
                                        // dd($photo);
                                        @endphp
                                        @foreach($photo as $data)
                                            <img src="{{$data}}" class="show-small-img" alt="">
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="col-xs-4 item-photo">
                                    <!-- Primary carousel image -->
                                    <div class="show1" href="{{$product_detail->photo}}">
                                        <img src="{{$photo[0]}}" id="show-img">
                                        <h3 class="mangnify"><i class="fa-solid fa-magnifying-glass"></i> Mouse over to
                                            zoom in</h3>
                                    </div>
                                    <!-- Secondary carousel image thumbnail gallery -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-xs-5" style="border:0px solid gray">
                                    <h3 class="pro-name">{{$product_detail->title}}</h3>
                                    <div class="product-details-div">
                                        <div class="reviews">
                                            <div class="stars">
												@php
													$rate=ceil($product_detail->getReview->avg('rate'))
												@endphp
												@for($i=1; $i<=5; $i++)
													@if($rate>=$i)
														<i class="fa fa-star"></i>
													@else 
														<i class="fa fa-star-o"></i>
													@endif
												@endfor
                                            </div>
                                            <!--<h5 class="review-text"> ( {{$product_detail['getReview']->count()}} Reviews )</h5>-->
                                        </div>
                                        <div class="condition">
                                            <h4 class="pro-condition">Conditon:</h4>
                                            <h5 class="new-condition">{{$product_detail->condition}}</h5>
                                        </div>
                                        <!--<div class="pro-sku">
                                            <h4 class="pro-condition">SKU:</h4>
                                            <h5 class="new-condition">{{$product_detail->sku}}</h5>
                                        </div>-->
                                    </div>
                                    <span id="productid" hidden>{{$product_detail->id}}</span>
                                    <!-- Precios -->
                                    <div class="price-div">
										@php 
										$after_discount=($product_detail->price-(($product_detail->discount*$product_detail->price)/100));
										@endphp
										
                                        <!--<h3 class="pro-price">${{number_format($after_discount,2)}}</h3>-->
                                        <h3 class="pro-price">${{number_format($product_detail->price,2)}}</h3>
                                        <!--<h6 class="discount-price">{{$product_detail->discount}}% off</h6>-->
                                    </div>
                                   
                                    <form action="{{route('single-add-to-cart')}}" method="POST">
									@csrf 
                                    <input type="text" name="slug" hidden value="{{$product_detail->slug}}">
									@if($product_detail->color)
                                    
                                    <div class="section">
                                        <h6 class="title-attr" style="margin-top:15px;">Color: <span style="font-weight: 700;color: #000">Select Option</span></h6>
                                        @php 
                                            $color = explode(',',$product_detail->color);         
                                        @endphp
                                        @if($product_detail->color)
                                          
                                        <div class="variant">
											@foreach($color as $key=>$data)
                                            <div class="attr"
                                                style="width: 30px;height: 30px;border-radius: 50%;background:{{$data}};">
                                            </div>
											@endforeach
                                        </div>
										@endif
										
                                    </div>
									@endif
									@if($product_detail->sizes)
										<div class="size mt-4">
											<h4>Size</h4>
											@php 
												$size = explode(',',$product_detail->size);         
											@endphp
											<select class="form-control" required name="size" id="">
                                                <option value="">select size</option>

                                                @foreach($size as $size)
													<option class="one">{{$size}}</option>
												@endforeach
											</select>
										</div>
									@endif
                                    <div class="quantity-sec">
                                        <div class="section" style="padding-bottom:20px;">
                                            <h6 class="title-attr">Quantity:</h6>
                                            <div>
                                                <div class="btn-minus"><i class="fa-solid fa-minus"></i></div>
                                                <input name="quant[1]" value="1" />
                                                <div class="btn-plus"><i class="fa-solid fa-plus"></i></div>
                                            </div>
                                        </div>
                                        <div class="section buy-div" style="padding-bottom:20px;">
                                            <button type="submit" class="btn btn-buynow"><i class="fa fa-bolt"
                                                    style="padding-right: 10px;"></i>
                                                Buy Now</button>
                                            <!--<button type="submit" class="btn btn-buynow"><i class="fa-solid fa-plus"
                                                    style="padding-right: 10px;"></i>
                                                Add to cart</button>
                                            <a href="javscript:"><i class="fa-solid fa-heart"></i></a>
                                            <a href="javscript:"><i class="fa fa-code-compare"></i></a>-->
                                        </div>
                                    </div>
                                </form>
                                    <div class="condition">
                                        <h4 class="pro-condition">Categories:</h4>
                                        <a href="javscript:">
                                            <h5 class="pro-category">{{$product_detail->cat_info['title']}}</h5>
                                        </a>
                                    </div>
                                    <div class="condition">
                                        <h4 class="pro-condition">Tags:</h4>
                                        <h5 class="new-condition">
                                            <div class="form-group">
                                            @php 
                                            $tags = explode(',',$product_detail->tags);         
                                            @endphp
                                            @if($product_detail->tags)
                                                @foreach($tags as $key=>$data)
                                                {{$data}},
                                                @endforeach
                                                @endif
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <section>
                                    <div class="container-fluid">
                                        <!-- <div class="net-product1">
                                            <h2 class="pro-bought">Frequently Bought Together</h2>
                                            <div class="row">
											@foreach($product_detail->rel_prods as $data)
                            					@if($data->id !==$product_detail->id)
												<div class="col-md-2">
                                                    <div class="image-box2">
                                                        <a href="javascript:" class="imganchor"><img
                                                                src="{{$data->photo}}" alt="product1"
                                                                class="p1"></a>
                                                    </div>
                                                    <div class="category-div">
                                                        <h3 class="paddle-price1">Pickleball</h3>
                                                    </div>
                                                    <a href="javascript:">
                                                        <h3 class="paddle-title1">{{$data->title}} </h3>
                                                    </a>
                                                    <h4 class="paddle-description1">by {{$product_detail->cat_info['title']}}</h4>
                                                    <h4 class="paddle-description2">${{$data->price}}</h4>
                                                </div>
												@endif
											@endforeach
                                               
                                            </div>
                                        </div> -->
                                       <div class="additional-items">
                                        {!! $product_detail->summary !!}
                                       </div>
                                       <!--  <div class="additional-items">
                                            <div class="checkbox-div">
                                                <div class="form-check1">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault" checked disabled>
                                                    <label class="form-check-label1" for="flexCheckDefault">
                                                        This item: Pickleball <span
                                                            style="color:#2f8a33">($347.99)</span>
                                                    </label>
                                                </div>
                                                <div class="form-check1">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked">
                                                    <label class="form-check-label1" for="flexCheckChecked">
                                                        Lorem ipsum dolor <span style="color:#2f8a33">($139.99) </span>
                                                    </label>
                                                </div>
                                                <div class="form-check1">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked1">
                                                    <label class="form-check-label1" for="flexCheckChecked1">
                                                        Lorem ipsum dolor <span style="color:#2f8a33">($139.99) </span>
                                                    </label>
                                                </div>
                                                <div class="form-check1">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckChecked2">
                                                    <label class="form-check-label1" for="flexCheckChecked2">
                                                        Lorem ipsum dolor <span style="color:#2f8a33">($139.99) </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="total-price-div">
                                                <h3 class="total-price-text">Price for all: <span
                                                        style="color:#2f8a33;font-weight: 700;">$1290.98</span></h3>
                                                <button class="btn btn-addall"><i class="fa-solid fa-plus"
                                                        style="padding-right: 10px;"></i>
                                                    Add all to cart</button>
                                                <h3 class="add-to-wish"><a href="javscript:"><i
                                                            class="fa-solid fa-heart"></i></a> Add all to Wishlist</h3>
                                            </div>
                                        </div> -->
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- <section class="product-details-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews(5)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Q&A </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Vendor Info</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
               {!! $product_detail->description !!}
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                {!! $product_detail->specification !!}
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="tab-single review-panel">
            <div class="row">
                <div class="col-12">
                <div class="comment-review">
																	<div class="add-review">
																		<h5>Add A Review</h5>
																		<p>Your email address will not be published. Required fields are marked</p>
																	</div>
																	<h4>Your Rating <span class="text-danger">*</span></h4>
																	<div class="review-inner">
																@auth
																<form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                  <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                      <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
                                                                                      <label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 out of 5 stars"></label>
                                                                                      <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
																					  <label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 out of 5 stars"></label>
																					  @error('rate')
																						<span class="text-danger">{{$message}}</span>
																					  @enderror
                                                                                    </div>
                                                                                  </div>
                                                                            </div>
                                                                        </div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group">
																				<label>Write a review</label>
																				<textarea name="review" rows="6" placeholder="" ></textarea>
																			</div>
																		</div>
																		<div class="col-lg-12 col-12">
																			<div class="form-group button5">	
																				<button type="submit" class="btn">Submit</button>
																			</div>
																		</div>
																	</div>
																</form>
																@else 
																<p class="text-center p-5">
																	You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('register.form')}}">Register</a>

																</p>
																@endauth
																	</div>
																</div>
															
																<div class="ratting-main">
																	<div class="avg-ratting">
																		{{-- @php 
																			$rate=0;
																			foreach($product_detail->rate as $key=>$rate){
																				$rate +=$rate
																			}
																		@endphp --}}
																		<h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(Overall)</span></h4>
																		<span>Based on {{$product_detail->getReview->count()}} Comments</span>
																	</div>
                                                                    @if($product_detail['getReview'])
																	@foreach($product_detail['getReview'] as $data)
																	<div class="single-rating">
																		<div class="rating-author">
																			@if($data->user_info)
																			<img src="{{$data->user_info->photo}}" alt="{{$data->user_info->photo}}">
																			@else 
																			<img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
																			@endif
																		</div>
																		<div class="rating-des">
																			<h6>{{$data->user_info['name']}}</h6>
																			<div class="ratings">

																				<ul class="rating">
																					@for($i=1; $i<=5; $i++)
																						@if($data->rate>=$i)
																							<li><i class="fa fa-star"></i></li>
																						@else 
																							<li><i class="fa fa-star-o"></i></li>
																						@endif
																					@endfor
																				</ul>
																				<div class="rate-count">(<span>{{$data->rate}}</span>)</div>
																			</div>
																			<p>{{$data->review}}</p>
																		</div>
																	</div>
																	@endforeach
                                                                    @endif
																</div>
            </div>
            </div>
            </div>
            </div>
            <div class="tab-pane" id="tabs-4" role="tabpanel">
                <p class="pro-full-descr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sapien odio,
                    ullamcorper ut nisi
                    eu, elementum ullamcorper est. Pellentesque in nulla sit amet leo ultricies gravida. Donec sagittis
                    elementum ornare. Integer molestie blandit purus, rutrum posuere lorem tincidunt auctor. Nunc semper
                    consectetur bibendum. Nam venenatis velit et libero condimentum, sit amet hendrerit eros dignissim.
                    Pellentesque et leo nec sem scelerisque dictum ac sit amet est. Aenean sodales tortor magna, ut
                    mattis erat consectetur at. Proin nec nunc lectus. Etiam nulla purus, sagittis nec justo eu,
                    vestibulum ullamcorper urna. Suspendisse ut nulla nisi. <br><br>

                    Pellentesque at felis elit. Mauris maximus sagittis commodo. Praesent sit amet egestas quam. Etiam
                    porta sed leo at malesuada. Praesent volutpat, enim ac aliquam lacinia, ante lectus aliquet urna,
                    sit amet auctor ligula lacus nec lectus. Cras pretium sodales dictum. Integer nec velit et ex
                    bibendum hendrerit eu sit amet nulla. Integer viverra ut augue sit amet maximus. Etiam et vestibulum
                    augue. Nulla sit amet rutrum mi, non mattis velit. Sed eget hendrerit elit. Nam eu blandit ipsum,
                    eget interdum nisl. Etiam non rhoncus velit. In vitae consequat quam, nec viverra neque. Etiam
                    mattis blandit sem. Nunc sapien ex, luctus nec feugiat vitae, tincidunt id ipsum. <br><br>

                    Maecenas molestie nulla at pulvinar venenatis. Sed pellentesque enim non lectus rhoncus, id laoreet
                    diam pharetra. Donec pulvinar lacinia lorem, a imperdiet felis egestas ut. In eu mauris a augue
                    convallis tincidunt nec nec nisl. Ut a quam mi. Nam ultricies vulputate aliquam. Donec ut orci in
                    turpis rhoncus iaculis.</p>

                <h4 class="pro-head">From the manufacturer</h4>
                <p class="pro-full-descr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sapien odio,
                    ullamcorper ut nisi eu, elementum ullamcorper est. Pellentesque in nulla sit amet leo ultricies
                    gravida. Donec sagittis elementum ornare. Integer molestie blandit purus, rutrum posuere lorem
                    tincidunt auctor.</p>
                <img src="{{asset('/frontend')}}/assets/images/product-desc-min.jpg" alt="product-desc-image" class="pro-des-img img-fluid">
            </div>
            <div class="tab-pane" id="tabs-5" role="tabpanel">
                <p class="pro-full-descr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sapien odio,
                    ullamcorper ut nisi
                    eu, elementum ullamcorper est. Pellentesque in nulla sit amet leo ultricies gravida. Donec sagittis
                    elementum ornare. Integer molestie blandit purus, rutrum posuere lorem tincidunt auctor. Nunc semper
                    consectetur bibendum. Nam venenatis velit et libero condimentum, sit amet hendrerit eros dignissim.
                    Pellentesque et leo nec sem scelerisque dictum ac sit amet est. Aenean sodales tortor magna, ut
                    mattis erat consectetur at. Proin nec nunc lectus. Etiam nulla purus, sagittis nec justo eu,
                    vestibulum ullamcorper urna. Suspendisse ut nulla nisi. <br><br>

                    Pellentesque at felis elit. Mauris maximus sagittis commodo. Praesent sit amet egestas quam. Etiam
                    porta sed leo at malesuada. Praesent volutpat, enim ac aliquam lacinia, ante lectus aliquet urna,
                    sit amet auctor ligula lacus nec lectus. Cras pretium sodales dictum. Integer nec velit et ex
                    bibendum hendrerit eu sit amet nulla. Integer viverra ut augue sit amet maximus. Etiam et vestibulum
                    augue. Nulla sit amet rutrum mi, non mattis velit. Sed eget hendrerit elit. Nam eu blandit ipsum,
                    eget interdum nisl. Etiam non rhoncus velit. In vitae consequat quam, nec viverra neque. Etiam
                    mattis blandit sem. Nunc sapien ex, luctus nec feugiat vitae, tincidunt id ipsum. <br><br>

                    Maecenas molestie nulla at pulvinar venenatis. Sed pellentesque enim non lectus rhoncus, id laoreet
                    diam pharetra. Donec pulvinar lacinia lorem, a imperdiet felis egestas ut. In eu mauris a augue
                    convallis tincidunt nec nec nisl. Ut a quam mi. Nam ultricies vulputate aliquam. Donec ut orci in
                    turpis rhoncus iaculis.</p>

                <h4 class="pro-head">From the manufacturer</h4>
                <p class="pro-full-descr">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sapien odio,
                    ullamcorper ut nisi eu, elementum ullamcorper est. Pellentesque in nulla sit amet leo ultricies
                    gravida. Donec sagittis elementum ornare. Integer molestie blandit purus, rutrum posuere lorem
                    tincidunt auctor.</p>
                <img src="{{asset('/frontend')}}/assets/images/product-desc-min.jpg" alt="product-desc-image" class="pro-des-img img-fluid">
            </div>
        </div>
    </section> -->

    <section class="product-details-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews({{$product_detail->getReview->count()}})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Q&A </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Vendor Info</a>
            </li>
        </ul><!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                {!! $product_detail->description !!}
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
            {!! $product_detail->specification !!}
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <h4 class="rating-main">Product Ratings</h4>
                <div class="rating-points">
                    <h3 class="ratings">{{ceil($product_detail->getReview->avg('rate'))}} </h3>
                    <h4 class="rating-out">/ 5</h4>
                </div>
                <div class="reivews-div1">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <h4 class="rating-main mt-4">Product Reviews</h4>
                <div class="rating-reviews1">
                @auth
                    <form action="{{route('review.store',$product_detail->slug)}}" method="post">
                        @csrf
                        <h4 class="name-reviewer mt-2" style="font-size: 20px;">Add A Review</h4>
                        <p class="name-reviewer1 mt-2">Your email address will not be published.Required fields are
                            marked
                        </p>
                        <h4 class="name-reviewer mt-4" style="font-size: 20px;">Your Rating *</h4>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rate" value="5" /><label class="full" for="star5"
                                title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4" name="rate" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3" name="rate" value="3" /><label class="full" for="star3"
                                title="Meh - 3 stars"></label>
                            <input type="radio" id="star2" name="rate" value="2" /><label class="full" for="star2"
                                title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1" name="rate" value="1" /><label class="full" for="star1"
                                title="Sucks big time - 1 star"></label>
                        </fieldset>
                        <h4 class="name-reviewer mt-2" style="font-size: 20px;">Write A Review</h4>
                        <textarea id="w3review" class="w-100 mt-3" name="review" rows="8" cols="100"></textarea>
                        <button type="submit" class="btn-review">Submit</button>
                    </form>
                    @else 
                        <p class="text-center p-5">
                            You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('login.form')}}">Register</a>

                        </p>
                        <!--/ End Form -->
                    @endauth
                </div>
                <div id="product-review">

                @foreach($product_review as $data)
                <div class="rating-reviews1">
                    <div class="rating-reviews-inner">
                        <h4 class="name-reviewer mt-2">{{$data->user_info['name']}}</h4>
                        <div class="reivews-div">
                            @for($i=1; $i<=5; $i++)
                                @if($data->rate>=$i)
                                    <i class="fa fa-star fa-star-o"></i>
                                @else 
                                    <i class="fa fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="verified-purchase">Verified Purchase</div>
                    <p class="review-comment mt-1">{{$data->review}}</p>
                </div>
                @endforeach
                </div>
                
            </div>
            <div class="tab-pane" id="tabs-4" role="tabpanel">
                <h3 class="qatext">Questions About This Product ({{count($qas)}})</h3>
              
                <div class="rating-reviews1">
                @auth
                    <form action="{{route('productqa.store')}}" method="post">
                        @csrf
                        <h4 class="name-reviewer mt-2" style="font-size: 20px;">Ask Your Question</h4>
                        <p class="name-reviewer1 mt-2">Your email address will not be published.Required fields are
                            marked
                        </p>
                        <input type="text" name="product_id" value="{{$product_detail->id}}" hidden>
                        <h4 class="name-reviewer mt-4" style="font-size: 20px;">Type Your Question Here *</h4>
                        <textarea id="w3review" class="w-100 mt-3" name="question" rows="8" cols="100"></textarea>
                        <button type="submit" class="btn-review">Submit</button>
                    </form>
                @else
                <p class="loginandregister"><a href="./login.html" style="color: #ffcc00">Login </a> or <a
                        href="./login.html" style="color: #ffcc00"> Register </a>
                    to ask questions to seller</p>
                <h3 class="qatext" style="font-size: 24px;">Other questions answered by By Ray K. Fleming</h3>
                @endauth
                </div>
                @if($qas)
                @foreach($qas as $row)

                <div class="qa-div mt-4">
                    <div class="qa-inner-div">
                        <img src="{{asset('/frontend')}}/assets/images/letter-q.png" alt="Q Letter" class="letter-q img-fluid" />
                        <p class="qa-ques">{{$row->question}}</p>
                    </div>
                    <div class="qa-inner-div mt-3">
                        <img src="{{asset('/frontend')}}/assets/images/a.png" alt="Q Letter" class="letter-q img-fluid" />
                        <p class="qa-ques">{{$row->answer}}</p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="tab-pane" id="tabs-5" role="tabpanel">
                <div class="store-div">
                    <h4 class="rating-main" style="font-size: 40px;">{{$vendor->name}}</h4> <a href="javascript:">
                        <!-- <button class="btn-follow">2703 Followers</button> -->
                        </a>
                </div>
                <!-- <p class="positive-seller">86% Positive Seller Ratings</p> -->
                <div class="ratings-div-main">
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-md-4">
                        @auth
                        <form action="{{route('vendor_review.store',$product_detail->user_id)}}" method="post">
                        @csrf
                        <h4 class="name-reviewer mt-2" style="font-size: 20px;">Add A Review</h4>
                        <h4 class="name-reviewer mt-4" style="font-size: 20px;">Your Rating *</h4>
                        <ul class="smile-or-sad">
                                <li><input type="radio" name="status" id="cb1" value="1" />
                                  <label for="cb1" class="label-of-cb1"><img src="{{asset('/frontend')}}/assets/images/smile.png" /></label>
                                </li>
                                <li><input type="radio" name="status" id="cb2" value="0" />
                                  <label for="cb2" class="label-of-cb1"><img src="{{asset('/frontend')}}/assets/images/sad.png" /></label>
                                </li>
                              </ul>
                        <h4 class="name-reviewer mt-2" style="font-size: 20px;">Write A Review</h4>
                        <textarea id="w3review" class="w-100 mt-3" name="review" rows="8" cols="100"></textarea>
                        <button type="submit" class="btn-review">Submit</button>
                    </form>
                    @else 
                        <p class="text-center p-5">
                            You need to <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Login</a> OR <a style="color:blue" href="{{route('login.form')}}">Register</a>

                        </p>
                        <!--/ End Form -->
                    @endauth
                        </div>
                        <div class="col-md-1 vertical-line"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <h3 class="seller-ratings">Seller Ratings and Reviews ({{count($vendor_review)}})</h3>
                            <a href="javascript:"><img src="{{asset('/frontend')}}/assets/images/smile.png" alt="Smile"
                                    class="Smile-img" /></a>
                            <a href="javascript:"><img src="{{asset('/frontend')}}/assets/images/sad.png" alt="Smile"
                                    class="Smile-img ml-5" /></a>
                            <div class="seller-rating-div mt-5">
                                <div class="row">
                                    @if($vendor_review)
                                    @foreach($vendor_review as $row)
                                    <div class="col-md-1">
                                        @if($row->status == 1)
                                        <img src="{{asset('/frontend')}}/assets/images/smile.png" alt="smile" class="smile-img w-75" />
                                        @else
                                        <img src="{{asset('/frontend')}}/assets/images/sad.png" alt="smile" class="smile-img w-75" />
                                        @endif
                                    </div>
                                    <div class="col-md-11">
                                        <h4 class="negative-response">{{ ($row->status == 1) ? 'Positive' : 'Negative'  }}</h4>
                                        <h4 class="name-reviewer mt-2">By {{$row->user->name}}</h4>
                                        <div class="verified-purchase">{{$row->review}}</div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
	<style>
		/* Rating */
		.rating_box {
		display: inline-flex;
		}

		.star-rating {
		font-size: 0;
		padding-left: 10px;
		padding-right: 10px;
		}

		.star-rating__wrap {
		display: inline-block;
		font-size: 1rem;
		}

		.star-rating__wrap:after {
		content: "";
		display: table;
		clear: both;
		}

		.star-rating__ico {
		float: right;
		padding-left: 2px;
		cursor: pointer;
		color: #F7941D;
		font-size: 16px;
		margin-top: 5px;
		}

		.star-rating__ico:last-child {
		padding-left: 0;
		}

		.star-rating__input {
		display: none;
		}

		.star-rating__ico:hover:before,
		.star-rating__ico:hover ~ .star-rating__ico:before,
		.star-rating__input:checked ~ .star-rating__ico:before {
		content: "\F005";
		}

	</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



@endpush