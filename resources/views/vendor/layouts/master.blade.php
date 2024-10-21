<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('frontend')}}/assets/css/style.css" rel="stylesheet" />
    <title>Profile</title>
</head>

<body>
    <nav class="navbar navbar-dark  indigo darken-2">
        <div class="container-fluid">
            <div class="row" id="alignment">
                <div class="col-md-2 col-8">
                    <a class="navbar-brand" href="#"><img src="./assets/images/logo.png" alt="logo" class="logo"></a>
                </div>
                <div class="col-md-1 col-4">
                    <button class="navbar-toggler third-button" type="button" data-toggle="hodor"
                        data-target="#navbarSupportedContent22" aria-controls="navbarSupportedContent22"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <div class="animated-icon3"><span></span><span></span><span></span></div>
                    </button>
                    <div class="navbar-collapse hodor" id="navbarSupportedContent22">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="./dashboard.html">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./cart.html">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./checkout.html">Checkout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./product-add.html">Product Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="input-group">
                                <div class="search-panel">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown">
                                        <span id="search_concept">All</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#all">All</a></li>
                                        <li><a href="#pickleball">Pickleball</a></li>
                                        <li><a href="#net">Net</a></li>
                                        <li><a href="#shirt">Shirt</a>
                                        </li>
                                        <li><a href="#short">Short</a></li>
                                        <li><a href="#shoes">Shoes</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">
                                <input type="text" class="form-control" name="x" placeholder="Search term...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default1" type="button"><i
                                            class="fa fa-magnifying-glass"></i></span></button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1 col-6 shortcol1">
                    <a href="javascript:"><i class="fa fa-code-compare" id="fafa"></i></a>
                    <a href="javascript:"><i class="fa fa-heart" id="fafa1"></i></a>
                    <!-- <i class="fa fa-cart-shopping" id="fafa1"></i> -->
                </div>
                <div class="col-md-1 col-2" id="shortcol">
                    <i class="fa fa-user"></i>
                </div>
                <div class="col-md-2 col-4 shortcol1">
                    <a href="./login.html">
                        <h4 class="a">Login</h4>
                    </a>
                    <a href="./login.html">
                        <h4 class="b">Become a Seller</h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="trending">
                        <h2 class="c">Trending Now: </h2>
                        <ul class="d">
                            <a href="javascript:">
                                <li>Pickleball</li>
                            </a>
                            <a href="javascript:">
                                <li>Net</li>
                            </a>
                            <a href="javascript:">
                                <li>Shirt</li>
                            </a>
                            <a href="javascript:">
                                <li>Short</li>
                            </a>
                            <a href="javascript:">
                                <li>Shoes</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </nav>
@yield('content')

</body>
<footer>
    <div class="footer-copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="copyright">Copyright © 2023 Adam | Impact Enterprises LLC. All rights reserved.</h4>
                </div>
                <div class="col-md-4">
                    <h4 class="copyrighta">Privacy Policy | Our Terms</h4>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/scripts/script.js"></script>
<!-- Product Image Gallery Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>