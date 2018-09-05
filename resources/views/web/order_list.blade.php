@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Order List')

@section('content')
    <section class="product_section">
        <div class="container">
            <div class="order_listbox">
                <div class="carousal_head">
                    <span class="filter_head_txt slider_headtxt">My Orders List</span>
                </div>
                <div class="order_list_container">
                    @if(count($orders)>0)
                        @foreach($orders as $order)
                            <div class="order_row">
                                <div class="order_header">
                                    <div class="order_no">TajTailors{{$order->order_no}}</div>
                                    <div class="order_amt pull-right"><i
                                                class="mdi mdi-currency-inr"></i> {{$order->total}}
                                    </div>
                                </div>
                                @php
                                    $item = \App\ItemMaster::find($order->item_master_id);
                                @endphp
                                <div class="order_details_box">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="productdetails_order_row">
                                            <div class="order_product_imgbox">
                                                @php
                                                    $image = \App\ItemImages::where(['item_master_id' => $item->id])->first();
                                                @endphp
                                                @if(isset($image))
                                                    <img src="{{url('p_img').'/'.$item->id.'/'.$image->image}}">
                                                @else
                                                    <img src="{{url('images/default.png')}}" alt="Organic product">
                                                @endif
                                            </div>
                                            <div class="product_name">
                                                <a class="product_details_link"
                                                   href="{{url('view_product').'/'.(encrypt($item->id))}}"> {{$item->name}}</a>
                                            </div>
                                            <div class="option_availability">
                                                <div class="option_txt">Specification</div>
                                                <div class="product_right_txt">
                                                    {!! $item->specifcation!!}
                                                </div>
                                            </div>
                                            <div class="option_availability">
                                                <div class="option_txt">Qty</div>
                                                <div class="product_right_txt">
                                                    {{$order->qty}}
                                                </div>
                                            </div>
                                            {{--<div class="option_availability">--}}
                                            {{--<div class="option_txt">Sales Package</div>--}}
                                            {{--<div class="product_right_txt">--}}
                                            {{--Oil Bottle (60 ml)--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="track_del_address">
                                            @php
                                                $address = \App\UserAddress::find($order->address_id);
                                            @endphp
                                            {{isset($address)?$address->name.', '.$address->contact.', '.$address->address.', '.$address->address2.', '.$address->zip:'-'}}
                                        </div>
                                        <div class="track_status">
                                            <p><b>Item {{$order->status}}
                                                    on {{ date_format(date_create($order->updated_time), "d-M-Y ")}}</b>
                                            </p>
                                            <span class="del_status">Your item has been {{$order->status}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_track">
                                    <ol class="progtrckr" data-progtrckr-steps="5">
                                        @if($order->status=='Ordered')
                                            <li class="progtrckr-done">Ordered</li>
                                            <li class="progtrckr-todo">Packed</li>
                                            <li class="progtrckr-todo">Shipped</li>
                                            <li class="progtrckr-todo">Delivered</li>
                                        @elseif($order->status=='Packed')
                                            <li class="progtrckr-done">Ordered</li>
                                            <li class="progtrckr-done">Packed</li>
                                            <li class="progtrckr-todo">Shipped</li>
                                            <li class="progtrckr-todo">Delivered</li>
                                        @elseif($order->status=='Shipped')
                                            <li class="progtrckr-done">Ordered</li>
                                            <li class="progtrckr-done">Packed</li>
                                            <li class="progtrckr-done">Shipped</li>
                                            <li class="progtrckr-todo">Delivered</li>
                                        @elseif($order->status=='Delivered')
                                            <li class="progtrckr-done">Ordered</li>
                                            <li class="progtrckr-done">Packed</li>
                                            <li class="progtrckr-done">Shipped</li>
                                            <li class="progtrckr-done">Delivered</li>
                                        @endif

                                    </ol>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>< No Orders Available ></div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@stop