@extends('frontend.layouts.master')

@section('title','PRODUCT PAGE')

@section('content')

<section class="bg1">
    <div class="container-fluid">
        <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-md-9">
                    
                    <div class="all-products">
                        @if($products)
                        <div class="net-product all">

                            
                            <div class="row">
                            
                                @foreach($products as $row)
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
						
						@else
						<br><br>
						<div class="net-product all"><div class="row"><div class="col-md-9"><div class="text-danger">Not Found!</div></div></div></div>
                        @endif
                    </div>
                </div>

                
        </div>
    </div>
</section>

@endsection
@push('styles')
<style>
    .pagination{
        display:inline-flex;
    }
    .filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
        color: white;
    }
</style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
                    else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
    <script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>
@endpush
