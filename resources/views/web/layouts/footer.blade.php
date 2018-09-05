<footer class="tailors_footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-xs-12 col-lg-8">
                <div class="footer-column">
                    <h4 class="border_bottom">Taj Tailors</h4>
                    <ul class="links">
                        <li class="first"><a target="_blank" href="{{url('about')}}" title="About Us">
                                <i class="mdi mdi-arrow-right-bold"></i>ABOUT US</a></li>
                        <li><a title="HOW IT WORKS" onclick="How_slide();">
                                <i class="mdi mdi-arrow-right-bold"></i>HOW IT WORKS</a></li>
                        <li><a title="Get measured" onclick="Review_slide();">
                                <i class="mdi mdi-arrow-right-bold"></i>Reviews<!--Get measured--></a>
                        </li>
                        <li><a title="Prices" onclick="Price_slide();">
                                <i class="mdi mdi-arrow-right-bold"></i>Prices</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4 class="border_bottom">Customer care</h4>
                    <ul class="links">
                        <li class="first"><a target="_blank" title="Return Policy" href="{{url('return_policy')}}">
                                <i class="mdi mdi-arrow-right-bold"></i>Return policy</a></li>
                        <li><a target="_blank" title="Terms" href="{{url('terms_conditions')}}">
                                <i class="mdi mdi-arrow-right-bold"></i>Terms &amp; Conditions</a></li>
                        <li><a target="_blank" title="Addresses" href="{{url('contact_us')}}">
                                <i class="mdi mdi-arrow-right-bold"></i>Contact US</a></li>
                        @if(isset($_SESSION['user_master']))
                            <li><a target="_blank" title="Orders History" href="{{url('order_list')}}">
                                    <i class="mdi mdi-arrow-right-bold"></i>Orders History</a></li>
                        @endif

                    </ul>
                </div>
                <div class="footer-column">
                    <h4 class="border_bottom">COMPANY DETAILS</h4>
                    <address>
                        <div><em class="mdi mdi-map-marker-radius"></em>
                            <span>ABC Write Town, Jabalpur Madhya Pradesh </span>
                        </div>
                        <div><em class="mdi mdi-phone-classic"></em><span> + 0800 567 345</span></div>
                        <div style="
    border: none;
"><em class="mdi mdi-email-alert"></em><span>abc@example.com</span></div>
                    </address>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 col-lg-4">
                <div class="co-info">
                    <h4>JOIN OUR MAILING LIST</h4>
                    <div class="newsletter-wrap">
                        <input type="text" autocomplete="off" name="email" id="newsletter1"
                               title="Sign up for our newsletter" class="news_letter_txt required-entry validate-email"
                               placeholder="Enter your email address">
                        <button type="button" onclick="getSubscribe()" title="Subscribe" class="button subscribe">
                            <span>Subscribe</span></button>
                    </div>

                    <div class="payment_optionbox">
                        <h4>100% SECURE PAYMENTS</h4>
                        <div class="payment-accept">
                            <div><img src="{{url('images/payment-1.png')}}" alt="payment1">
                                <img src="{{url('images/payment-2.png')}}" alt="payment2"> <img
                                        src="{{url('images/payment-3.png')}}" alt="payment3"> <img
                                        src="{{url('images/payment-4.png')}}" alt="payment4"></div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 coppyright">
                    © 2018 All Rights Reserved. Powered by
                    <a href="http://retinodes.com/" target="_blank"><img src="{{url('images/retinodes_logo.png')}}"
                                                                         class="logo_powered"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    function Requiredtxt(me) {
        var text = $.trim($(me).val());
        if (text == '') {
            $(me).addClass("errorClass");
            return false;
        } else {
            $(me).removeClass("errorClass");
            return true;
        }
    }
    function getSubscribe() {
        debugger;
        var email = $('#newsletter1').val();
        var result = true;
        if (!Boolean(Requiredtxt("#newsletter1"))) {
            result = false;
        }
        if (!result) {
            return false;
        } else {
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('subscribe') }}",
                data: {email: email},
                success: function (data) {
                    if (data == 'Success') {
                        $('#newsletter1').val('');
                        swal("Thank you", "We will get back to you soon", "success");
                    }
                },
                error: function (xhr, status, error) {
//                    $('#err1').html(xhr.responseText);
                    swal("Server Issue", "Something went wrong", "info");
                }
            });
        }
    }
</script>