<div class="footer">
    <div class="section subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Subscribe to get latest offers</h3>
                    <p>Sign up for exclusive early sale access and tailored new arrivals</p>
                </div>
                <div class="col-md-6">
                    <form action="#">
                        <label for="">Email address</label>
                        <div class="input-box">
                            <input type="email" placeholder="Enter your email">
                            <button type="submit" class="btn btn-filled btn-big">Sign up</button>
                        </div>
                    </form>
                    <div class="socials">
                        <a href="#">
                            <i class="feather-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="feather-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="feather-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section links">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4>About</h4>
                    <ul>
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Locations</a>
                        </li>
                        <li>
                            <a href="#">Careers</a>
                        </li>
                        <li>
                            <a href="#">Press</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>Brands</h4>
                    <ul>
                        @foreach (App\Models\Brand::oldest("name")->get() as $brand)
                        <li>
                            <a href="{{ route("latest-arrivals") }}">{{ $brand->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>Customer service</h4>
                    <ul>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li>
                            <a href="#">Shipping</a>
                        </li>
                        <li>
                            <a href="#">Returns</a>
                        </li>
                        <li>
                            <a href="#">Payments</a>
                        </li>
                        <li>
                            <a href="{{ route("orders") }}">Your Orders</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>Contact us</h4>
                    <ul>
                        <li>
                            <a href="#">+977 9801234567</a>
                        </li>
                        <li>
                            <a href="">Email Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>
                            <a href="#">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 we-accept">
                    <div>
                        We accept
                        <img src="{{ asset("assets/images/visa.png") }}" alt="visa">
                        <img src="{{ asset("assets/images/esewa.png") }}" alt="Esewa">
                        <img src="{{ asset("assets/images/khalti.png") }}" alt="khalti">
                    </div>
                    <div class="copyright-text">
                        Copyright &copy; {{ date("Y") }} | All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
