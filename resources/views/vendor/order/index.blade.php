@extends('frontend.layouts.master')
@section('title','Oders List')
@section('content')
 

<section class="dashboard">
  <h2 class="Shopping-heading">Orders List </h2>
  <div class="container">
    <div class="row">
      @include('vendor.layouts.sidebar')
      <div class="col-md-8 p-0">              
        <div id="Products" class="tabcontent" style="display: block;">
          <div class="dash-div1">
            <h2 class="dashboard-txt1">Orders List</h2>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Order No.</th>
                <th>Quantity</th>
                <th>Charge</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)  
              @php
                  $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
              @endphp 
              <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->order_number}}</td>
                <td>{{$order->quantity}}</td>
                <td>@foreach($shipping_charge as $data) $ {{number_format($data,2)}} @endforeach</td>
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
                    <a href="{{route('order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                    <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    
                </td>
              </tr>  
              @endforeach
            </tbody>
          </table>   
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
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
  </script>
@endpush