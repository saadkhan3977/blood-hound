@extends('frontend.layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->

<style>
    .tabcontent{
        overflow-y: auto
    }
</style>
    <section class="dashboard">
        <h2 class="Shopping-heading">Dashboard</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-0">
                    <div class="dash-div">
                        <h2 class="dashboard-txt">Dashboard</h2>
                    </div>
                    <div class="tab">
                        <div class="tab-btn tablinks" onclick="openTab(event, 'Profile')" id="defaultOpen">
                            <i class="fa-solid fa-user dash-icons"></i>
                            <button>Profilesss <i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="tab-btn tablinks">
                            <i class="fa-solid fa-briefcase dash-icons"></i>
                            <a href="{{route('vproduct.index')}}"><button>Products<i class="fa-solid fa-chevron-right"></i></button></a>
                        </div>
                        <div class="tab-btn tablinks" onclick="openTab(event, 'Upload')">
                            <i class="fa-sharp fa-solid fa-upload dash-icons"></i>
                            <button>Upload Product<i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="tab-btn tablinks" onclick="openTab(event, 'Earnings')">
                            <i class="fa-sharp fa-solid fa-dollar-sign dash-icons"></i>
                            <button>Earnings <i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <div class="tab-btn tablinks" onclick="logout()">
                            <!-- <a class="dropdown-item"  href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <button class="fa-solid fa-chevron-right">{{ __('Logout') }}</button>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form> -->
                             <i class="fa-sharp fa-solid fa-power-off dash-icons"></i> 
                            <button>Logout <i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 p-0">
                    <div id="Profile" class="tabcontent">
                    <div class="dash-div1">
                        <h2 class="dashboard-txt1">Your Information</h2>
                    </div>
                        <div class="profile-div">
                            <img src="./assets/images/profile-pic.png" alt="profile-pic" class="profile-pic">
                            <h4 class="profile-name">Mark Mathew</h4>
                            <h5 class="profile-email">markmathew1234@gmail.com</h5>
                            <div class="profile-social">
                                <a href="javascript:"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="javascript:"><i class="fa-brands fa-twitter"></i></a>
                                <a href="javascript:"><i class="fa-brands fa-google-plus-g"></i></a>
                                <a href="javascript:"><i class="fa-brands fa-pinterest-p"></i></a>
                                <a href="javascript:"><i class="fa fa-basketball"></i></a>
                            </div>
                            <p class="profile-desc"> We work with clients big and small across a range of sectors and we
                                utilise all
                                forms of media to get your name out there in a way that’s right for you. We have a
                                number of different teams within our agency that specialise in different areas.</p>
                        </div>
                    </div>

                    <div id="Products" class="tabcontent">
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
                                    <b>Category</b> : {{$product->cat_info['title']}}  {{$product->sub_cat_info->title ?? ''}}<br>
                                    <b>Feature</b> : {{(($product->is_featured==1)? 'Yes': 'No')}} <br>
                                    <b>Price</b> : Rs. {{$product->price}} /- <br>
                                    <b>Discount</b> : {{$product->discount}}% OFF <br>
                                    <b>Size</b> : {{$product->size}} <br>
                                    <b>Condition</b> : {{$product->condition}} <br>
                                    <b>Brand</b> : {{ucfirst($product->brand->title)}} <br>
                                    <b>Stock</b> : {{$product->stock}} <br>
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
                                        <!-- <a onclick="openTabb(event, 'Upload',{{$product->id}})" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a> -->
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

                    <div id="Upload" class="tabcontent">
                        <div class="dash-div1">
                            <h2 class="dashboard-txt1">Create Product</h2>
                        </div>
                        <form method="post" action="{{route('vproduct.store')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                                <input  type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
                                <input type="text" name="title" placeholder="Enter title" id="title" value="{{old('title')}}" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                                @error('summary')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="is_featured">Is Featured</label><br>
                                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
                            </div>
                            {{-- {{$categories}} --}}

                            <div class="form-group">
                                <label for="cat_id">Category <span class="text-danger">*</span></label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">--Select any category--</option>
                                    @foreach($categories as $key=>$cat_data)
                                        <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group d-none" id="child_cat_div">
                                <label for="child_cat_id">Sub Category</label>
                                <select name="child_cat_id" id="child_cat_id" class="form-control">
                                    <option value="">--Select any category--</option>
                                    {{-- @foreach($parent_cats as $key=>$parent_cat)
                                        <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                                <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="sku" class="col-form-label">SKU</label>
                                <input id="sku" type="text" name="sku" placeholder="Enter SKU"  value="{{old('sku')}}" class="form-control">
                                @error('sku')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="discount" class="col-form-label">Discount(%)</label>
                                <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"  value="{{old('discount')}}" class="form-control">
                                @error('discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
                                    <option value="">--Select any size--</option>
                                    <option value="S">Small (S)</option>
                                    <option value="M">Medium (M)</option>
                                    <option value="L">Large (L)</option>
                                    <option value="XL">Extra Large (XL)</option>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                {{-- {{$brands}} --}}

                                <select name="brand_id" id="brandId" class="form-control">
                                    <option value="">--Select Brand--</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="condition" class="form-control">
                                    <option value="">--Select Condition--</option>
                                    <option value="default">Default</option>
                                    <option value="new">New</option>
                                    <option value="hot">Hot</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stock">Quantity <span class="text-danger">*</span></label>
                                <input id="price" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control">
                                <!-- <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"  value="{{old('stock')}}" class="form-control"> -->
                                @error('stock')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" readonly style="margin-right: 70px;" placeholder="Choose Photo" name="photo" value="{{old('photo')}}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tags">Tag</label>
                                <select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker">
                                    <option value="">--Select any tag--</option>
                                    @foreach($tags as $key=>$data)
                                        <option value='{{$data->title}}'>{{$data->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div id="Earnings" class="tabcontent">

                    </div>
                    <div id="Logout" class="tabcontent">
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    
@endsection