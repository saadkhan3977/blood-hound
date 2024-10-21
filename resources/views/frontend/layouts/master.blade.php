

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('/toastr/toastr.min.css')}}">
    <link href="{{ asset('frontend') }}/assets/css/style.css" rel="stylesheet" />
    <!-- Summernote -->
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<!-- multi Select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!-- <link href="./assets/css/style.css" rel="stylesheet" /> -->
    
    <title>Adam | @yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-dark  indigo darken-2">
        <div class="container-fluid">
            <div class="row" id="alignment">
                <div class="col-md-2 col-8">
					@php
						$settings=DB::table('settings')->get();
					@endphp 
                    <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" class="logo" alt="logo"></a>

                </div>
                <div class="col-md-1 col-4">
                    <button class="navbar-toggler third-button" type="button" data-toggle="hodor" data-target="#navbarSupportedContent22" aria-controls="navbarSupportedContent22" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="animated-icon3"><span></span><span></span><span></span></div>
                    </button>
                    <div class="navbar-collapse hodor" id="navbarSupportedContent22">
                        <ul class="navbar-nav mr-auto">
                            @auth
                            @if(auth()->user()->role =='vendor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{url(auth()->user()->role)}}/profile">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/vendor/vproduct/create')}}">Product Add</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{url(auth()->user()->role)}}/dashboard">Dashboard</a>
                            </li>
                            @endif
                            @endauth
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{route('cart')}}">Cart</a>
                            </li>-->

                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('about-us')}}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('how-to-use')}}">How To Use</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{route('commerce-policy')}}">Commerce Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('FAQ')}}">FAQ's</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('terms')}}">Terms Of Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('privacy-policy')}}">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dispute-policy')}}">Dispute Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('fee-schedule')}}">Fee Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('postage-label-terms')}}">Postage Label Terms</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <!--<div class="container-fluid">
                        <div class="row">
                            <div class="input-group">
                                <div class="search-panel">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                        <span id="search_concept">All</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    @php 
                                        $category = \DB::table('categories')->get();
                                    @endphp
                                    @if($category)
                                    @foreach($category as $cat)
                                        <li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
                                    @endforeach
                                    @endif
                                    </ul>
                                </div>
								<form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <input type="hidden" name="search_param" value="all" id="search_param">
                                <input type="text" class="form-control" name="search" placeholder="Search term...">
									</form>
                                <span class="input-group-btn">
                                    <button class="btn btn-default1" type="button"><i class="fa fa-magnifying-glass"></i></span></button>
                                </span>
								
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-1 col-6 shortcol1">
                <!--    <a href="javascript:"><i class="fa fa-code-compare" id="fafa"></i></a>
                    <a href="{{route('cart')}}"><i class="fa fa-heart" id="fafa1"></i></a>-->
                </div>
                <div class="col-md-1 col-2" id="shortcol">
                    <i class="fa fa-user"></i>
                </div>
                <div class="col-md-2 col-4 shortcol1">
                    @if(auth()->check())

                        @if(auth()->user()->role == 'admin')
                        <a href="{{url('/admin/dashboard')}}">
                            <h4 class="a">{{auth::user()->name}}</h4>
                        </a>
                        @endif
                        @if(auth()->user()->role == 'vendor')
                        <a href="{{url('/vendor/profile')}}">
                            <h4 class="a">{{auth::user()->name}}</h4>
                        </a>
                        @endif
                        @if(auth()->user()->role == 'user')
                        <a href="{{url('/user/dashboard')}}">
                            <h4 class="a">{{auth::user()->name}}</h4>
                        </a>
                        @endif
                    @else
                    <a href="{{url('/user/login')}}">
                        <h4 class="a">Login</h4>
                    </a>
                    <a href="{{url('/vendor/login')}}">
                        <h4 class="b">Become a Seller</h4>
                    </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="trending"><h2></h2>
                        <!-- <h2 class="c">Trending Now: </h2>
                        <ul class="d">
                            <a href="javascript:">
                                <li>Pickleball</li>
                            </a>
                            <a href="javascript:">
                                <li>Net</li>
                            </a>
                            <a href="javascript:">
                                <li>Shirt</li>
                            </a>
                            <a href="javascript:">
                                <li>Short</li>
                            </a>
                            <a href="javascript:">
                                <li>Shoes</li>
                            </a>
                        </ul> -->
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </nav>

    @yield('content')
        <footer>
        <div class="footer-copyright">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
						<h4 class="copyright">
						   <a style="color:#fff;" href="{{route('about-us')}}">About Us </a> | 
						   <a style="color:#fff;" href="{{route('how-to-use')}}">How To Use</a> |
						<a style="color:#fff;" href="{{route('FAQ')}}">FAQ's </a> | 
						   <a style="color:#fff;" href="{{route('fee-schedule')}}">Fee Schedule</a> |
						<a style="color:#fff;" href="{{route('postage-label-terms')}}">Postage Label Terms </a></h4> <br>
                        <h4 class="copyright">Copyright © 2023 Adam | Impact Enterprises LLC. All rights reserved.</h4>
                    </div>
                    <div class="col-md-4">
                       <h4 class="copyrighta">
						   <a style="color:#fff;" href="{{route('commerce-policy')}}">Commerce Policy </a> | 
						   <a style="color:#fff;" href="{{route('dispute-policy')}}">Dispute Policy</a> <br><br>
						   <a style="color:#fff;" href="{{route('privacy-policy')}}">Privacy Policy </a> | 
						   <a style="color:#fff;" href="{{route('terms')}}">Our Terms</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>

 <!-- Toastr -->
 <script src="{{asset('/toastr/toastr.min.js')}}"></script>
      <script>
        @if(session('success'))
          toastr.success("{{session('success')}}");
        @endif
        @if(session('error'))
          toastr.error("{{session('error')}}")
        @endif
        @if($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error("{{$error}}")
            @endforeach
        @endif
    </script>
<script>

    function logout(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            /* the route pointing to the post function */
            url: "{{ route('logout') }}",
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
            }
        }); 
    }
    $(document).ready(function()
    {
        $('.dltBtn').click(function(e)
        {
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal("Your data is safe!");
                }
            });
        })
    })

    
    function openTabb(evt, cityName,id) {
        
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/vendor/product/edit_product/")}}',
            date: {'id':id},
            success: function (data) 
            {
                alert(data);
            },
            error: function() { 
                alert(data);
            }
        });

        // var i, tabcontent, tablinks;
        // tabcontent = document.getElementsByClassName("tabcontent");
        // for (i = 0; i < tabcontent.length; i++) {
        // tabcontent[i].style.display = "none";
        // }
        // tablinks = document.getElementsByClassName("tablinks");
        // for (i = 0; i < tablinks.length; i++) {
        // tablinks[i].className = tablinks[i].className.replace(" active", "");
        // }
        // document.getElementById(cityName).style.display = "block";
        // evt.currentTarget.className += " active";
    }
</script>
@stack('scripts')


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<script src="{{ asset('frontend') }}/assets/scripts/zoom-image.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/assets/scripts/script.js"></script>
<script src="{{ asset('frontend') }}/assets/scripts/main.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<!-- multi select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<!-- summernot -->
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<!-- file manager -->
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<!-- sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script>
    
    $('#lfm').filemanager('image');   


    // $('select').selectpicker();


    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });
    
    $(document).ready(function() {
      $('#specification').summernote({
        placeholder: "Write detail specification.....",
          tabsize: 2,
          height: 150
      });
    });


</script>

       
@if(Request::segment(1) == 'product-detail')
<script  src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
@endif
<script>

$(document).ready(function() {
    
    $('#load-more-btn').click(function() {
        var offset = $(this).data('offset');
        // alert(offset);
        var id = $('#productid').text();
        $.ajax({
            url: '/product-review-fetch/' + offset +'/'+ id,
            type: 'get',
            success: function(response) {
                if(response.length > 0) {
                    // append new products to the container
                    var productsContainer = $('#product-review');
                    $.each(response, function(index, row) 
                    {
                        var html = '';
                        for (let i = 1; i <= 5; i++) {
                            // alert('saad'+i);
                                if( row.rate >= i )
                                {
                                    html+= '<i class="fa fa-star fa-star-o"></i>';
                                }
                                if( row.rate < i )
                                {
                                    html+= '<i class="fa fa-star"></i>';
                                }
                        }
                        
                        var text = '<div class="rating-reviews1"><div class="rating-reviews-inner"><h4 class="name-reviewer mt-2">'+row.user_info.name+'</h4><div class="reivews-div">'+html+'</div></div><div class="verified-purchase">Verified Purchase</div><p class="review-comment mt-1">'+row.review+'</p></div>';
                        productsContainer.append(text);
                    });
                    // update offset for next request
                    $('#load-more-btn').data('offset', offset + response.length);
                } 
				else {
                    // hide the load more button if no more products
                    $('#load-more-btn').hide();
                }
            },
            error: function() {
                // handle error
            }
        });
    });
});
	
</script>

    <script>
        document.getElementById("size").tagsinput();
        document.getElementById("color").tagsinput();
    </script>
</html>