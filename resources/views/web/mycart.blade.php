@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : My Cart')

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
                                        <div class="col-sm-8">
                                            <div class="productdetails_order_row">
                                                <div class="order_product_imgbox">
                                                    @php $item_image = \App\ItemImages::where(['item_master_id' => $row->id])->first();
                                                    $item_price = \App\ItemPrice::find($row->options->has('item_price_id') ? $row->options->item_price_id : '1');
                                                    $item = \App\ItemMaster::find($row->id);
                                                    @endphp
                                                    @if(isset($item_image))
                                                        <img src="{{url('p_img').'/'.$row->id.'/'.$item_image->image}}"
                                                             alt="{{$row->name}}">
                                                    @else
                                                        <img src="{{url('images/default.png')}}" alt="Organic product">
                                                    @endif

                                                </div>
                                                <div class="product_name">
                                                    {{$item->name}}
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Price :</div>
                                                    <div class="product_right_txt">
                                                        @if($item_price->price > 0)
                                                            <span class="mdi mdi-currency-inr"></span>{{$item_price->price}}
                                                        @else
                                                            {{"-"}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Special Price :</div>
                                                    <div class="product_right_txt">
                                                        @if($item_price->spl_price >0 )
                                                            <span class="mdi mdi-currency-inr"></span> {{$item_price->spl_price}}
                                                        @else
                                                            {{"-"}}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Quantity :</div>
                                                    <div class="product_right_txt">
                                                        {{$row->qty}}
                                                    </div>
                                                </div>
                                                <div class="desc_cart">
                                                    <div class="des_txt">Specifications :</div>
                                                    <div class="des_details">
                                                        {!! isset($item->specifcation)?$item->specifcation:'Not Mentioned'!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            {{--<div class="track_del_address">Free delivery by 15-May-2018</div>--}}
                                            <div class="order_amt"><i
                                                        class="mdi mdi-currency-inr"></i> {{number_format($row->price,2)}}
                                            </div>
                                            <form action="{{url('cart_update').'/'.$row->rowId}}"
                                                  id="cartupdate{{$row->rowId}}"
                                                  method="post">
                                                <input type="hidden" name="_token"
                                                       value="{{csrf_token()}}">
                                                <div class="spinner_withbtn my_cartbtnbox">
                                                    <div class="input-group qty_box">
                                                        <span class="qty_txt">Qty</span>
                                                        <input type="number" name="qty"
                                                               class="form-control text-center qty_edittxt"
                                                               min="1" max="10" value="{{$row->qty}}">

                                                    </div>
                                                    <a onclick="remove_cart_item('{{$row->rowId}}')"
                                                       class="spinner_addcardbtn btn-danger"><span
                                                                class="mdi mdi-close close_btn"></span> <span
                                                                class="button-group_text">Remove</span></a>
                                                </div>
                                                <div class="update_qty_box">
                                                    <button type="submit"
                                                            class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-refresh basic_icon_margin"></i> Update Qty
                                                    </button>
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
    @include('web.layouts.footer')
    <script>
        function remove_cart_item(cart_item_id) {
            $.ajax({
                type: 'get',
                url: "{{ url('cart_delete') }}",
                data: {cart_item_id: cart_item_id},
                success: function (data) {
                    $("#cartload").html(data);
                    $(".order_list_container").load(location.href + " .order_list_container");
                    $(".mycart_fixedamount_box").load(location.href + " .mycart_fixedamount_box");
                },
                error: function (xhr, status, error) {
                    $('#cartload').html(xhr.responseText);
                }
            });
            // promo_code

        }
        //         $('#crtupdate').click(function () {
        //             form = $('#cartupdate');
        // //                                form.attr('action', form.attr('action') + '.xls').trigger('submit');
        // //                                form.attr('action', action);
        //             form.submit();
        //         });
    </script>
@stop