@extends('frontend.layouts.master')

@section('title','Order Detail')

@section('content')
<section class="dashboard">
  <h2 class="Shopping-heading">Order Detail</h2>
  <div class="container">
    <div class="row">
      @include('vendor.layouts.sidebar')
      <div class="col-md-8 p-0">              
        <div id="Products" class="tabcontent" style="display: block;">
          <div class="dash-div1">
            <h2 class="dashboard-txt1">Order Detail <a href="{{route('vorder.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a></h2>
          </div>
          <table class="table table-responsive" >
            <thead>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>

              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->order_number}}</td>
                <td>{{$order->first_name}} {{$order->last_name}}</td>
                <td>{{$order->email}}</td>
                <td>${{number_format($order->total_amount,2)}}</td>
                <td>
                    @if($order->status=='new')
                      <span class="badge badge-primary">{{$order->status}}</span>
                    @elseif($order->status=='process')
                      <span class="badge badge-warning">{{$order->status}}</span>
                    @elseif($order->status=='delivered')
                      <span class="badge badge-success">{{$order->status}}</span>
                    @else
                      <span class="badge badge-danger">{{$order->status}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
            </tbody>
          </table>  
          
          <div class="row">
          <div class="col-lg-12 col-lx-12" style="margin-bottom: 25px;">
            <div class="shipping-info">
              <h4 class="text-center pb-4">Products INFORMATION</h4>
              <table class="table">
                @foreach($order->cart_info as $row)
                <tr class="">
                  <td style="display: inline-flex;gap:15px;align-items: center;">
                    <img src="{{$row->product->photo}}" width="150" alt="">
                    <p><b>Product Name:</b><br>{{$row->product->title}}<br><br>
                    <b>Price:</b>{{$row->price}}  <br> 
                    <b>Quantity:</b>{{$row->quantity}}  <br> 
                  </p>
                  </td>
                  <td> </td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">ORDER INFORMATION</h4>
              <table class="table">
                    <tr class="">
                        <td>Order Number</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    
                    <tr>
                      <td>Coupon</td>
                      <td> : $ {{number_format($order->coupon,2)}}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td> : $ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td> : @if($order->payment_method=='cod') Cash on Delivery @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
              <table class="table">
                <tr class="">
                  <td>Phone</td>
                  <td> : {{ ($order->another_phone != '') ? $order->another_phone : $order->phone}}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td> : {{ ($order->another_email != '') ? $order->another_email : $order->email}}</td>
                </tr>
                <tr>
                  <td>Country</td>
                  <td> : {{($order->another_country != '') ? $order->another_country : $order->country}}</td>
                </tr>
                <tr>
                  <td>City</td>
                  <td> : {{ ($order->another_city != '') ? $order->another_city : $order->city}}</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td> : {{ ($order->another_address != '') ? $order->another_address : $order->address}}</td>
                </tr>
                <tr>
                  <td>Post Code</td>
                  <td> : {{ ($order->another_zip_code != '') ? $order->another_zip_code : $order->zip_code}}</td>
                </tr>
              </table>
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
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
