@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Checkout')

@section('head')
    <style>
        .min_height_0 {
            min-height: 0px;
        }

        .hide {
            display: none;
        }

        .show {
            display: block;
        }

    </style>
    <script type="text/javascript">
        function paymentOption(txt) {
            if (txt == "cash") {
                $('#terms_show').fadeOut();
            } else {
                $('#terms_show').fadeIn();
            }
        }

        var fixed_leftposition;

        function checkOffFixed() {
            if ($('#price_details_containner').offset().top + $('#price_details_containner').height()
                >= $('#footer').offset().top - 30) {
                $('#price_details_containner').removeClass('position_fixed_removed');
                $('#price_details_containner').css('right', 0);
            }
            if ($(document).scrollTop() + window.innerHeight < $('#footer').offset().top) {
                $('#price_details_containner').addClass('position_fixed_removed');
                $('#price_details_containner').css('right', fixed_leftposition);
            }
        }

        $(document).ready(function () {
            /* fixed_leftposition=$('#price_details_containner').offset().left;
             if($(document).scrollTop()<100)
             {
             $('#price_details_containner').css('right' ,fixed_leftposition);
             $('#price_details_containner').addClass('position_fixed_removed');
             }*/
        });
        $(document).scroll(function () {
            // checkOffFixed();
        });


        function PromoSubmit() {
            var promo_code = $('#promo_code').val();
            $.ajax({
                type: 'get',
                url: "{{ url('web_check_promo') }}",
                data: {
                    promo_code: promo_code,
                },
                success: function (data) {
                    if (data != 'Invalid') {
                        $('#promo_code_box').show();
                        gAmount = 0;
                        $('#promo').text(data);
                        $('#selected_promo').val(data);
                        var net_amount = parseFloat($('#net_amount').html());
                        gAmount += net_amount - data;
                        $('#net_amount').text(gAmount);
                        $('#net_amt').val(gAmount);
                        $('#PromoCode').modal('hide');
                        $('#have_a_promo').hide()
                        swal("Success", "Promo Code has been applied...", "success");
                    } else {
                        swal("Oops", "Please enter a valid promo code...", "info");
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    $('#promo').html(xhr.responseText);
                    // swal("Oops", "Something went wrong...", "error");
                }
            });
            // promo_code

        }

        function remove_promo() {
            gAmount = 0;
            var promo = parseFloat($('#selected_promo').val());
            var net_amount = parseFloat($('#net_amount').html());
            gAmount += net_amount + promo;
            $('#net_amt').val(gAmount);
            $('#net_amount').text(gAmount);
            $('#promo_code_box').hide();
            $('#have_a_promo').show();
            $('#promo').text('');
            $('#selected_promo').val('');
        }


        function getcod(dis) {
            var iscod = $(dis).val();
            if (iscod == 1) {
                $('#button_confirm_cod').addClass('btn btn-success pull-right btn-sm show');
                $('#button_confirm_pay').attr('class', 'btn btn-success pull-right btn-sm hide');

            } else {
                $('#button_confirm_pay').addClass('btn btn-success pull-right btn-sm show');
                $('#button_confirm_cod').attr('class', 'btn btn-success pull-right btn-sm hide');
            }
        }

        function Paybypoint(dis) {
            gAmount = 0;
            var pointamt = parseFloat($(dis).val());
            var net_amount = parseFloat($('#net_amount').html());
            if ($(dis).is(":checked")) {
                $('#applyamt').removeClass('apply');
                gAmount += net_amount - pointamt;
                $('#selected_point').val(pointamt);
                $('#net_amount').text(gAmount);
                $('#net_amt').val(gAmount);
            } else {
                gAmount += net_amount + pointamt;
                $('#selected_point').val('');
                $('#net_amount').text(gAmount);
                $('#net_amt').val(gAmount);
                $('#applyamt').addClass('apply');
            }
        }

        function proceed_to_pay() {
            var existaddress = $('#existaddress').val();
            if (existaddress.trim() != '0') {
                submitPayUmoney();
            } else {
                swal("Required", "Please select address", "info");
            }
        }

        function submitPayUmoney() {
            $('#myModal').modal('show');
            var is_cod = $('#payment').val();
            // var is_express = $('#express').val();
            // var shipping = $('#shipping').text();
            $('#modal_title').html('Checkout Payment');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var id = 1;
            var selected_point = $('#selected_point').val();
            var selected_promo = $('#selected_promo').val();
            var existaddress = $('#existaddress').val();
            var delivery_charge = $('#delivery_charge').text();
            var amt = $('#net_amt').val();
            var payment_url = '{{ url('/') }}' + "/payment/";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: payment_url,
                data: {
                    selected_point: selected_point,
                    selected_promo: selected_promo,
                    cod: is_cod,
                    amt: amt,
                    existaddress: existaddress,
                    delivery_charge: delivery_charge.trim(),
                },
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });
        }
    </script>
@stop
@section('content')
    @php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; @endphp
    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
        @php $total += $row->price * $row->qty;
        $counter++;
        $itemcount++;
        @endphp
    @endforeach
    <section class="product_section">
        <div class="container">
            <div class="mycart_mainbox">
                <form action="{{url('confirm_order')}}" id="confirm_order" method="post"
                      enctype="multipart/form-data">
                    <div class="mycart_fixedamount_box" id="price_details_containner">
                        <div class="order_listbox">
                            <div class="carousal_head">
                                <span class="filter_head_txt slider_headtxt">Price Details</span>
                            </div>
                            <div class="cart_price_details_box">
                                <div class="option_availability">
                                    <div class="option_txt">Price ({{$itemcount}} items)</div>
                                    <div class="product_right_txt">
                                        <i class="mdi mdi-currency-inr"></i>{{number_format($total,2)}}
                                    </div>
                                </div>
                                @php $delivery_charge = DB::selectOne("select delivery_charge from delivery_charges where amount>$total and is_active= '1'"); @endphp
                                <div class="option_availability">
                                    <div class="option_txt">Delivery Charges</div>
                                    <div class="product_right_txt" id="delivery_charge">
                                        <i class="mdi mdi-currency-inr"></i>@if($total>0 && isset($delivery_charge)){{($delivery_charge->delivery_charge > 0 )?number_format($delivery_charge->delivery_charge,2):'0.00'}}@else {{'0.00'}} @endif
                                        <input type="hidden" name="delivery_charge"
                                               value="@if($total>0 && isset($delivery_charge)){{($delivery_charge->delivery_charge > 0 )?number_format($delivery_charge->delivery_charge,2):'0.00'}}@else {{'0.00'}} @endif">
                                    </div>


                                </div>

                            </div>
                            <div class="option_availability">
                                <div class="option_txt">Net Payable</div>
                                <div class="order_amt">
                                    <i class="mdi mdi-currency-inr" id="net_amount">
                                        @if($total>0)
                                            @if(isset($delivery_charge))
                                                {{$delivery_charge->delivery_charge + $total}}
                                            @else
                                                {{$total}}
                                            @endif
                                        @else
                                            {{'0.00'}}
                                        @endif
                                    </i>
                                    <input type="hidden" id="net_amt"
                                           value="@if($total>0)
                                           @if(isset($delivery_charge))
                                           {{$delivery_charge->delivery_charge + $total}}
                                           @else
                                           {{$total}}
                                           @endif
                                           @else
                                           {{'0.00'}}
                                           @endif">
                                </div>
                            </div>

                            <div class="product_btn_box">
                                <a class="btn btn-warning btn-sm" href="{{url('product_list')}}"><i
                                            class="mdi mdi-basket basic_icon_margin"></i>Keep Shopping</a>
                                <button onclick="confirm_order();" type="button"
                                        class="btn btn-success pull-right btn-sm show" id="button_confirm_cod"><i
                                            class="mdi mdi-currency-inr basic_icon_margin"></i>Confirm Order
                                </button>

                                <button onclick="proceed_to_pay();" type="button" id="button_confirm_pay"
                                        class="btn btn-success pull-right btn-sm hide"><i
                                            class="mdi mdi-currency-inr basic_icon_margin"></i>Proceed To Pay
                                </button>
                            </div>
                            <!--<div class="product_btn_box">
                                <div class="btn btn-success confirm_order_btn">
                                    <i class="mdi mdi-currency-inr basic_icon_margin"></i>Proceed To Pay
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="order_listbox margin_bottom0">
                        <div class="carousal_head">
                            <span class="filter_head_txt slider_headtxt">Delivery Address</span>
                        </div>
                        <form enctype="multipart/form-data" id="userAddress">
                            <div class="order_list_container">
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <input id="add_1" value="male" class="gender" name="address_radio"
                                                   type="radio"
                                                   checked="" onchange="AddressOption('new');">
                                            <label for="add_1" class="radio-label">New</label>
                                        </div>

                                        <div class="radio">
                                            <input id="add_2" onchange="AddressOption('existing');" value="female"
                                                   class="gender" name="address_radio" type="radio">
                                            <label for="add_2" class="radio-label">Existing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="existing_dropbox" style="display:none">
                                        @php
                                            $addresses = \App\UserAddress::where(['is_active' => '1', 'user_id' => $user->id])->get();
                                        @endphp
                                        @if(count($addresses)>0)
                                            <select onchange="getuseraddress();" class="form-control"
                                                    id="existaddress" name="address_id">
                                                <option value="0"> --- Please Select ---</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->name.', '.$address->contact.', '.$address->address.', '.(isset($address->city_id)?$address->city->city:'-').', '.$address->zip}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Name" name="name" id="add_name"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Phone No." name="contact" id="add_contact"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Email Id" name="email" id="add_email"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Pincode" name="pincode" id="add_pincode"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <select class="form-control" id="add_city"
                                                name="add_city">
                                            <option value="0"> --Please Select City--</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <textarea class="form-control glo_txtarea" id="add_address" name="address"
                                                  placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-12">
                                        <div id="update_address" class="hidden">
                                            <input type="button" onclick="disable_remove();"
                                                   class="btn btn-primary pull-right" value="Update Address"/></div>
                                        <div id="save_address" class="hidden">
                                            <input type="button" onclick="cancel_update();"
                                                   class="btn btn-danger pull-right"
                                                   value="Cancel"/>

                                        </div>

                                        {{--<input type="checkbox" value="test1" name="test_record[]" />--}}
                                        {{--<input type="checkbox" value="test2" name="test_record[]" />--}}
                                        {{--<input type="checkbox" value="test3" name="test_record[]" />--}}
                                        <input type="button" onclick="saveaddress()"
                                               class="btn btn-success pull-right"
                                               value="Save"/></div>
                                </div>
                            </div>
                        </form>
                        <div class="carousal_head">
                            <span class="filter_head_txt slider_headtxt">Payment Option</span>
                        </div>
                        <div class="order_list_container min_height_0">
                            <div class="deli_row">
                                <div class="col-sm-12">
                                    <div class="radio">
                                        <input id="radio-2" value="1" class="gender" name="payment_type"
                                               type="radio" onclick="getcod(this);"
                                               checked="" onchange="paymentOption('cash');">
                                        <label for="radio-2" class="radio-label">Cash On Delivery</label>
                                    </div>
                                    <div class="radio">
                                        <input id="radio-1" value="0" onclick="getcod(this);" class="gender"
                                               name="payment_type"
                                               type="radio"
                                               onchange="paymentOption('payumoney');">
                                        <label for="radio-1" class="radio-label"> Pay With PayUMoney (T&amp;C)</label>
                                    </div>


                                    <div class="percent_show" id="terms_show" style="display: none">
                                        3% Gateway Charge applicable on Total Amount levied by PayUMoney.
                                    </div>
                                    <input type="hidden" name="payment" value="1" id="payment">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order_listbox">
                        <div class="carousal_head">
                            <span class="filter_head_txt slider_headtxt">Order Summary</span>
                            <a class="btn btn-success btn-sm pull-right" href="{{url('mycart')}}"><i
                                        class="mdi mdi-basket basic_icon_margin"></i>Edit Cart</a>
                        </div>
                        <div class="order_list_container">
                            @php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; @endphp
                            @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content())>0)
                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                    <div class="order_row border-none">
                                        <div class="order_details_box">
                                            <div class="col-md-8 col-sm-12">
                                                <div class="productdetails_order_row">
                                                    <div class="order_product_imgbox">
                                                        @php $item_images = \App\ItemImages::where(['item_master_id' => $row->id])->first();
                                                        $item = \App\ItemMaster::find($row->id);
                                                        @endphp
                                                        @if(isset($item_images))
                                                            <img src="{{url('p_img').'/'.$row->id.'/'.$item_images->image}}"
                                                                 alt="{{$row->name}}">
                                                        @else
                                                            <img src="{{url('images/product_09.jpg')}}"
                                                                 alt="Organic product">
                                                        @endif

                                                    </div>
                                                    <div class="product_name">
                                                        <a href="{{url('view_product').'/'.(encrypt($row->id))}}">{{$row->name}}</a>
                                                    </div>
                                                    <div class="option_availability">
                                                        <div class="option_txt">Specification</div>
                                                        <div class="product_right_txt">
                                                            {!! $item->specifcation!!}
                                                        </div>
                                                    </div>
                                                    {{--<div class="option_availability">--}}
                                                    {{--<div class="option_txt">Container Type</div>--}}
                                                    {{--<div class="product_right_txt">--}}
                                                    {{--Bottle--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="option_availability">--}}
                                                    {{--<div class="option_txt">Sales Package</div>--}}
                                                    {{--<div class="product_right_txt">--}}
                                                    {{--Oil Bottle (60 ml)--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="order_amt"><i
                                                            class="mdi mdi-currency-inr"></i> {{number_format($row->price,2)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="order_row border-none">
                                    <span class="no_record">< No Record Available ></span>
                                </div>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal right fade" id="PromoCode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Promo Code</h4>
                </div>
                <div class="modal-body">
                    <div class="deli_row">
                        <input type="text" name="ask_number" id="promo_code" autocomplete="off"
                               class="form-control login_txt"
                               placeholder="Enter Promo Code"/>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="PromoSubmit" onclick="PromoSubmit();">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>

        function disable_remove() {
            $('#add_name').removeAttr('disabled', 'disabled');
            $('#add_email').removeAttr('disabled', 'disabled');
            $('#add_contact').removeAttr('disabled', 'disabled');
            $('#add_address').removeAttr('disabled', 'disabled');
            $('#add_city').removeAttr('disabled', 'disabled');
            $('#add_pincode').removeAttr('disabled', 'disabled');
            $('#update_address').attr('class', 'hidden');
            $('#save_address').removeAttr('class', 'hidden');
        }

        function cancel_update() {
            $('#add_name').attr('disabled', 'disabled');
            $('#add_email').attr('disabled', 'disabled');
            $('#add_contact').attr('disabled', 'disabled');
            $('#add_address').attr('disabled', 'disabled');
            $('#add_city').attr('disabled', 'disabled');
            $('#add_pincode').attr('disabled', 'disabled');
            $('#update_address').removeAttr('class', 'hidden');
            $('#save_address').attr('class', 'hidden');
        }

        function saveaddress() {
            var existaddress = $('#existaddress :selected').val();
            var add_name = $('#add_name').val();
            var add_contact = $('#add_contact').val();
            var add_email = $('#add_email').val();
            var add_city = $('#add_city :selected').val();
            var add_pincode = $('#add_pincode').val();
            var add_address = $('#add_address').val();
            // var value = $('#userAddress').serialize();

            if (add_name == '') {
                swal("Fields Required", "Please enter name", "error");
                $('#add_name').focus();
                return false;
            } else if (add_contact == '') {
                swal("Fields Required", "Please enter contact", "error");
                $('#add_contact').focus();
                return false;
            } else if (add_email == '') {
                swal("Fields Required", "Please enter email", "error");
                $('#add_email').focus();
                return false;
            } else if (add_city == '0') {
                swal("Fields Required", "Please select city", "error");
                $('#add_city').focus();
                return false;
            } else if (add_pincode == '') {
                swal("Fields Required", "Please enter pincode", "error");
                $('#add_pincode').focus();
                return false;
            } else if (add_address == '') {
                swal("Fields Required", "Please enter address", "error");
                $('#add_address').focus();
                return false;
            } else {
                $.ajax({
                    type: 'get',
                    url: "{{ url('address_update') }}",
                    data: {
                        add_name: add_name,
                        add_email: add_email,
                        add_contact: add_contact,
                        add_city: add_city,
                        add_pincode: add_pincode,
                        add_address: add_address,
                        existaddress: existaddress,
                    },
                    // data: value,
                    success: function (data) {
                        // alert(data);
                        // console.log(data);
                        if (data == 'success') {
                            swal("Success", "Address has been updated...", "success");
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            swal("Oops", "Some went wrong...", "error");
                        }

                    },
                    error: function (xhr, status, error) {
                        swal("Oops", "Some went wrong...", "error");
                    }
                });
                // }
            }
        }

        function confirm_order() {
            var existaddress = $('#existaddress :selected').val();
            if (existaddress == '0') {
                swal("Address Required", "Please select delivery address", "warning");
                $('#existaddress').focus();
                return false;
            } else {
                swal({
                    title: "Are you sure?",
                    text: "Confirm Order, you will not be able to edit once you confirm the order",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#confirm_order').submit();
                    }
                });
            }
        }

        function getuseraddress() {
            var address_id = $('#existaddress :selected').val();
            if (address_id > 0) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('getexistaddress') }}",
                    data: {address_id: address_id},
                    success: function (data) {
                        $('#add_name').val(data.name);
                        $('#add_email').val(data.email);
                        $('#add_contact').val(data.contact);
                        $('#add_address').val(data.address);
                        $('#add_city').val(data.city_id);
                        $('#add_pincode').val(data.pincode);

                        $('#add_name').attr('disabled', 'disabled');
                        $('#add_email').attr('disabled', 'disabled');
                        $('#add_contact').attr('disabled', 'disabled');
                        $('#add_address').attr('disabled', 'disabled');
                        $('#add_city').attr('disabled', 'disabled');
                        $('#add_pincode').attr('disabled', 'disabled');
                        $('#update_address').removeAttr('class', 'hidden');
                    },
                    error: function (xhr, status, error) {
                        ShowErrorPopupMsg('Error in uploading...');
                        $('#userpostForm').css("opacity", "");
                        // $('#err1').html(xhr.responseText);
                        // ShowErrorPopupMsg(xhr.message);
                    }
                });
            } else {
                $('#update_address').attr('class', 'hidden');
                $('#save_address').attr('class', 'hidden');
                empty_address();
            }
        }


    </script>
@stop