@extends('frontend.layouts.master')
@section('title','Product Edit')

@section('content')
<style>
    .bootstrap-tagsinput {
	margin: 0;
	width: 100%;
	padding: 0.5rem 0.75rem 0;
	font-size: 1rem;
  line-height: 1.25;
	transition: border-color 0.15s ease-in-out;
	
	&.has-focus {
    background-color: #fff;
    border-color: #5cb3fd;
	}
	
	.label-info {
		display: inline-block;
		background-color: #636c72;
		padding: 0 .4em .15em;
		border-radius: .25rem;
		margin-bottom: 0.4em;
	}
	
	input {
		margin-bottom: 0.5em;
	}
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
	content: '\00d7';
}
</style>
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />

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
            @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                   

                    

                    <div id="Upload" class="tabcontent" style="display: block;">
                    <div class="dash-div1">
                            <h2 class="dashboard-txt1">Edit Product</h2>
                        </div>


                        <form method="post" action="{{route('vproduct.update',$editproduct->id)}}">
                          @csrf 
                          @method('PATCH')
                          <div class="form-group">
                            <input  type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
                            <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$editproduct->title}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{$editproduct->description}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="form-group">
                            <label for="is_featured">Is Featured <b>($5 will be charged)</b></label><br>
                            <input type="checkbox" name='is_featured' id='is_featured' value='{{$editproduct->is_featured}}' {{(($editproduct->is_featured) ? 'checked' : '')}}> Yes                        
                          </div>
                          {{-- {{$categories}} --}}

                          <div class="form-group">
                            <label for="cat_id">Category <span class="text-danger">*</span></label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                <option value="">--Select any category--</option>
                                @foreach($categories as $key=>$cat_data)
                                    <option value='{{$cat_data->id}}' {{(($editproduct->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="price" class="col-form-label">Price<span class="text-danger">*</span></label>
                            <input id="price" type="text" name="price" placeholder="Enter price"  value="{{$editproduct->price}}" class="form-control">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="form-group">
                              <label for="brand_id">Brand</label>
                              <input id="" type="text" name="brand" placeholder="Enter Brand" required value="{{$editproduct->brand}}" class="form-control">
                          </div>

                          <div class="form-group">
                            <label for="condition">Condition</label>
                            <select name="condition" class="form-control">
                                <option value="">--Select Condition--</option>
                                <option value="new" {{(($editproduct->condition=='new')? 'selected':'')}}>New</option>
                                <option value="Used-Like-New" {{(($editproduct->condition=='Used-Like-New')? 'selected':'')}}>Used - Like New</option>
                                <option value="Used–Good" {{ ($editproduct->condition == 'Used-Good') ? 'selected':''}}>Used – Good</option>
                                <option value="Used–Fair" {{ ($editproduct->condition == 'Used–Fair' ) ? 'selected':''}} >Used – Fair</option>
                              </select>
                          </div>

                          <div class="form-group">
                                <label for="tags">Size</label>
                                <input name="size[]" id="size" value="{{$editproduct->size}}" data-role="tagsinput" class="form-control">
                                <span>Separate keywords with a comma, space bar, or enter key</span>
                            </div>
                            
                            <div class="form-group">
                                <label for="tags">Color</label>
                                <input name="color[]" id="color" value="{{$editproduct->color}}" data-role="tagsinput" class="form-control">
                                <span>Separate keywords with a comma, space bar, or enter key</span>
                            </div>
                          
                          <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                    <i class="fas fa-image"></i> Choose
                                    </a>
                                </span>
                            <input id="thumbnail" class="form-control"  readonly style="margin-right: 70px;"  type="text" name="photo" value="{{$editproduct->photo}}">
                          </div>
                          <div id="holder" style="margin-top:15px;max-height:100px;">
                          <img src="{{$editproduct->photo}}" width="100">  
                        </div>
                        @error('photo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                      @php 
                        $post_tags=explode(',',$editproduct->tags);
                        // dd($tags);
                      @endphp
                      <div class="form-group">
                        <label for="tags">Tag</label>
                        <select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker">
                            <option value="">--Select any tag--</option>
                            @foreach($tags as $key=>$data)
                            
                            <option value="{{$data->title}}"  {{(( in_array( "$data->title",$post_tags ) ) ? 'selected' : '')}}>{{$data->title}}</option>
                            @endforeach
                        </select>
                      </div>
        
                      <div class="form-group">
                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                          <option value="active" {{(($editproduct->status=='active')? 'selected' : '')}}>Active</option>
                          <option value="inactive" {{(($editproduct->status=='inactive')? 'selected' : '')}}>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                      <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
                      </div>
                    </form>

                                        
                    </div>
                    <div id="Earnings" class="tabcontent" style="display: none;">

                    </div>
                    <div id="Logout" class="tabcontent" style="display: none;">
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>

    <script>
        $("#size").tagsinput();
        $("#color").tagsinput();
    </script>
@endsection