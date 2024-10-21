@extends('frontend.layouts.master')

@section('content')

<section class="dashboard">
        <h2 class="Shopping-heading">Dashboard</h2>
        <div class="container">
            <div class="row">
                @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                    <div class="dash-div1">
                        <h2 class="dashboard-txt1">Your Information</h2>
                    </div>
                    <div id="Profile" class="tabcontent">
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
                </div>
            </div>
        </div>

    </section>
@endsection