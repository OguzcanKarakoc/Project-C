<footer class="text-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3">
                <h5>About</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25"/>
                <p class="mb-0">
                    GameShop: selling games since 2018. Best prices, fast delivery!
                </p>
                <img src="{{ url('Logo.png') }}" style="border-radius: 50%; width: 120px; height: 60px; margin-top: 15px;">
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h5>Pages</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25"/>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('ajax-paginate') }}">Products</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                    <li><a href="{{ route('contact.index') }}">FAQ</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                <h5>Payment</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25"/>
                <ul class="list-unstyled">
                    <li><a>VISA</a></li>
                    <li><a>iDeal</a></li>
                    <li><a>MasterCard</a></li>
                    <li><a>Coupons</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3">
                <h5>Contact</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25"/>
                <ul class="list-unstyled">
                    <li><i class="fa fa-home"></i> GameShop </li>
                    <li><i class="fa fa-envelope"></i> www.gameshop@example.com</li>
                    <li><i class="fa fa-phone"></i> + 33 12 14 15 16</li>
                </ul>
            </div>
            <div class="col-12 copyright mt-3">
                <p class="float-left">
                    <a href="#">Back to top</a>
                </p>
            </div>
        </div>
    </div>
</footer>
