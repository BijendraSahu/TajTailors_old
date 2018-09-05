@extends('web.layouts.e_master')

@section('title', 'Organic Food : My Cart')

@section('head')

@stop
@section('content')
    <?php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; ?>
    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
        <?php $total += $row->price * $row->qty;
        $counter++;
        $itemcount++;
        ?>
    @endforeach
    <section class="product_section">
        <div class="container">
            <div class="mycart_mainbox">
                <div class="mycart_fixedamount_box">
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
                            <?php $delivery_charge = DB::select("SELECT delivery_charge FROM delivery_charges where amount>=$total and is_active= '1' ORDER BY id DESC LIMIT 1"); ?>
                            <div class="option_availability">
                                <div class="option_txt">Delivery Charges</div>
                                <div class="product_right_txt">
                                    <i class="mdi mdi-currency-inr"></i>@if($total>0){{count($delivery_charge)>0?number_format($delivery_charge[0]->delivery_charge,2):'0'}}@else {{'0.00'}} @endif
                                </div>
                            </div>
                        </div>
                        <div class="option_availability">
                            <div class="option_txt">Amount Payable</div>
                            <div class="order_amt">
                                <i class="mdi mdi-currency-inr"></i>@if($total>0){{count($delivery_charge)>0?number_format($delivery_charge[0]->delivery_charge+$total,2):$total}}@else {{'0.00'}} @endif
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="product_btn_box">
                             <a class="btn btn-warning" href="product_list.php"><i class="mdi mdi-basket basic_icon_margin"></i>Continue</a>
                             <a class="btn btn-success pull-right" href="checkout.php"><i class="mdi mdi-currency-inr basic_icon_margin"></i>Place Order</a>
                         </div>-->
                        <div class="product_btn_box">
                            <a class="btn btn-warning btn-sm" href="{{url('product_list')}}"><i
                                        class="mdi mdi-basket basic_icon_margin"></i>Keep Shopping</a>
                            <a class="btn btn-success pull-right btn-sm" href="{{url('checkout')}}"><i
                                        class="mdi mdi-currency-inr basic_icon_margin"></i>Place Order</a>
                        </div>
                    </div>
                </div>

                <div class="order_listbox">
                    <div class="carousal_head">
                        <span class="filter_head_txt slider_headtxt">My Cart ({{$itemcount}})</span>
                    </div>
                    <div class="order_list_container">
                        <?php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; ?>
                        @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content())>0)
                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                <div class="order_row border-none">
                                    <div class="order_details_box">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="productdetails_order_row">
                                                <div class="order_product_imgbox">
                                                    <?php $item_images = \App\ItemImages::where(['item_master_id' => $row->id])->first(); ?>
                                                    @if(isset($item_images))
                                                        <img src="{{url('p_img').'/'.$row->id.'/'.$item_images->image}}"
                                                             alt="{{$row->name}}">
                                                    @else
                                                        <img src="images/product_09.jpg" alt="Organic product">
                                                    @endif

                                                </div>
                                                <div class="product_name">
                                                    {{$row->name}}
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Product Type</div>
                                                    <div class="product_right_txt">
                                                        Whole Grains
                                                    </div>
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Container Type</div>
                                                    <div class="product_right_txt">
                                                        Bottle
                                                    </div>
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Sales Package</div>
                                                    <div class="product_right_txt">
                                                        Oil Bottle (60 ml)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="track_del_address">Free delivery by 15-May-2018</div>
                                            <div class="order_amt"><i
                                                        class="mdi mdi-currency-inr"></i> {{number_format($row->price,2)}}
                                            </div>
                                            <form action="{{url('cart_update').'/'.$row->rowId}}" id="cartupdate"
                                                  method="post">
                                                <input type="hidden" name="_token"
                                                       value="{{csrf_token()}}">
                                                <div class="spinner_withbtn my_cartbtnbox">
                                                    <div class="input-group qty_box">
                                                        <span class="qty_txt">Qty</span>
                                                        <input type="number" name="qty"
                                                               class="form-control text-center qty_edittxt"
                                                               min="1"
                                                               max="10" id="crtupdate" value="{{$row->qty}}">
                                                    </div>
                                                    <a href="{{url('cart_delete').'/'.$row->rowId}}"
                                                       class="spinner_addcardbtn btn-danger" id="{{$row->id}}"><span
                                                                class="mdi mdi-close close_btn"></span> <span
                                                                class="button-group_text">Remove</span></a>
                                                </div>
                                            </form>
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
            </div>
        </div>
    </section>
    <script>
        $('#crtupdate').click(function () {
            form = $('#cartupdate');
//                                form.attr('action', form.attr('action') + '.xls').trigger('submit');
//                                form.attr('action', action);
            form.submit();
        });
    </script>
@stop