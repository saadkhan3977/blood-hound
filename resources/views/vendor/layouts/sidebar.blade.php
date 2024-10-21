<style>
    .tabcontent{
        overflow-y: auto
    }
</style>
<div class="col-md-4 p-0">
    <div class="dash-div">
        <h2 class="dashboard-txt">Dashboard</h2>
    </div>
    <div class="tab">
        <a href="{{route('vendor.profile')}}">
            <div class="tab-btn tablinks {{ (request()->is('vendor/profile')) ? 'active' : ''  }}">
                <i class="fa-solid fa-user dash-icons"></i>
                <button>Profile <i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </a>
        <a href="{{route('vproduct.index')}}">
            <div class="tab-btn tablinks {{ (request()->is('vendor/vproduct')) ? 'active' : ''  }}">
                <i class="fa-solid fa-briefcase dash-icons"></i>
                <button>Products<i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </a>
        
        <a href="{{route('vproduct.create')}}">
            <div class="tab-btn tablinks  {{ (request()->is('vendor/vproduct/create')) ? 'active' : ''  }}">
                <i class="fa-sharp fa-solid fa-upload dash-icons"></i>
                <button>Upload Product<i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </a>
        <!--<a href="{{route('vproductqa.index')}}">
            <div class="tab-btn tablinks {{ (request()->is('vendor/vproductqa')) ? 'active' : ''  }}">
                <i class="fa-solid fa-briefcase dash-icons"></i>
                <button>Products Q/A<i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </a>-->
        <a href="{{route('order.index')}}">
            <div class="tab-btn tablinks  {{ (request()->is('vendor/order')) ? 'active' : ''  }}">
                <i class="fa-sharp fa-solid fa-dollar-sign dash-icons"></i>
                <button>Earnings <i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
            <div class="tab-btn tablinks">
                <i class="fa-sharp fa-solid fa-power-off dash-icons"></i>
                <button>Logout <i class="fa-solid fa-chevron-right"></i></button>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </a>
    </div>
</div>