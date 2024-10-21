<div class="col-md-3">
    <div class="sidebar">
        <div class="marketplace-col" >
            <div class="marketplace-inner">
                <div class="marketplace">
                    <h2 class="pickle">Pickle Marketplace</h2>
                    <!-- <form class="example" action="">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form> -->
                    <div class="marketplaceabc">
                        <h3 class="categories">Filter</h3>
                        <div class="form-group has-search">

                                
                           <form method="POST" action="{{route('product.search')}}">
                                @csrf
                                <span class="fa fa-search form-control-feedback"></span>
							   <input type="hidden" name="search_param" value="all" id="search_param">
                                <input type="text" name="search" class="form-control" placeholder="Search by product name">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="categories1">
                    <h3 class="categories">Categories</h3>
                    @php 
                        $category = \DB::table('categories')->get();
                    @endphp
                    @if($category)
                    @foreach($category as $cat)
                    <div class="form-check">
                        <input class="form-check-input" {{ (request()->segment(2) == $cat->slug) ? 'checked' : null }} type="radio" name="flexRadioDefault"
                            id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <h3 class="categoriesb">Seller Zone</h3>

                <div class="notification">
                    <h3 class="notification1">Notification</h3>
                </div>
                <div class="notification">
                    <h3 class="notification1">Inbox</h3>
                </div>
                <div class="notificationa">
                    <h3 class="notification1">Your Listings</h3>
                </div>
                <button class="btn1">Manage Listings</button>
            </div>
        </div>
    </div>
</div>