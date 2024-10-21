@extends('frontend.layouts.master')

@section('title','Vendor Profile')

@section('content')

<section class="dashboard">
  <h2 class="Shopping-heading">Profile Edit</h2>
  <div class="container">
    <div class="row">
      @include('vendor.layouts.sidebar')
      <div class="col-md-8 p-0">              
        <div id="Products" class="tabcontent" style="display: block;">
        <div class="dash-div1">
            <h2 class="dashboard-txt1">Profile Edit</h2>
          </div>
          <form class="border px-4 pt-2 pb-3" method="POST" action="{{route('vendor-profile-update',$profile->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name</label>
                      <input id="inputTitle" type="text" name="name" placeholder="Enter name"  value="{{$profile->name}}" class="form-control">
                      @error('name')
                      <span class="text-danger">{{$message}}</span>
                      @enderror
                      </div>
              
                      <div class="form-group">
                          <label for="inputEmail" class="col-form-label">Email</label>
                        <input id="inputEmail" disabled type="email" name="email" placeholder="Enter email"  value="{{$profile->email}}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                     
                      <div class="form-group">
                          <label for="inputEmail" class="col-form-label">Phone</label>
                        <input id="inputEmail" type="number" name="phone" placeholder="Enter phone"  value="{{$profile->phone}}" class="form-control">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
              

                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </form>



        </div>
      </div>
    </div>
  </div>
</section>
@endsection

