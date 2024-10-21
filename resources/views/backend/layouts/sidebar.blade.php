<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route((auth()->user()->role == 'admin') ? 'admin.dashboard' : 'vendor.dashboard' ) }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route((auth()->user()->role == 'admin') ? 'admin.dashboard' : 'vendor.dashboard' ) }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- Products --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
          <i class="fas fa-cubes"></i>
          <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Product Options:</h6>
            <a class="collapse-item" href=" {{ route((auth()->user()->role == 'admin') ? 'product.index' : 'vproduct.index' ) }}">Products</a>
            <a class="collapse-item" href="{{route( (auth()->user()->role == 'admin') ? 'product.create' : 'vproduct.create'  )}}">Add Product</a>
          </div>
        </div>
    </li>

    @if(Auth::user()->role == 'admin')
    

    <!-- Divider -->
    <hr class="sidebar-divider">
        <!-- Heading -->
        <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('order.index')}}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('donations.index')}}">
            <i class="fas fa-cash fa-chart-area"></i>
            <span>Donations</span>
        </a>
    </li>

   
    
     <!-- Users -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">
            <i class="fas fa-users"></i>
            <span>Users </span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{route('vendors.index')}}">
          <i class="fas fa-users"></i>
          <span>Vendors</span>
        </a>
    </li> -->
     <!-- General settings -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('settings')}}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>
     
  @endif

    
    

    

   

    <!-- Reviews -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{route('review.index')}}">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li> -->
    

    <!-- Divider -->
    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>