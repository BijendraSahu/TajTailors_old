@include('web.layouts.plugin')
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet"/>
@foreach($order_details as $desobj)
    <div class="order_row">
        <div class="order_header">
            <div class="order_no">TajTailors{{$order_data->order_no}}</div>
            <div class="order_amt pull-right"><i class="mdi mdi-currency-inr"></i> {{$desobj->total}}</div>
        </div>
        <div class="order_details_box">
            <div class="col-md-8 col-sm-12">
                <div class="productdetails_order_row">
                    <div class="order_product_imgbox">
                        <?php $productpicone = \App\ItemImages::where(['item_master_id' => $desobj->item_master_id])->first();?>
                        @if(isset($productpicone->image) && file_exists("p_img/$desobj->item_master_id/".$productpicone->image))
                            <img src="{{url('p_img').'/'.$desobj->item_master_id.'/'.$productpicone->image}}"
                                 alt="Organic product">
                        @else
                            <img src="{{url('images/default.png')}}">
                        @endif

                        {{--   <img src="" alt="Organic product">--}}
                    </div>
                    <div class="product_name">
                        <a target="_blank" class="product_details_link"
                           href="{{url('view_product').'/'.encrypt($desobj->item_master_id)}}">{{$desobj->my_name->name}}</a>
                    </div>
                    <div class="option_availability">
                        <div class="option_txt">Description</div>
                        <div class="product_right_txt">
                            {!! $desobj->my_name->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="track_del_address">
                    {{$order_data->user_address->name.", ".$order_data->user_address->contact.", ".$order_data->user_address->address}}
                </div>
                <div class="track_status">
                    <p><b>{{$order_data->status}}
                            on {{ date_format(date_create($order_data->updated_time), "d-M-Y h:i A")}}</b></p>
                    <span class="del_status">Your item has been {{$order_data->status}}</span>
                </div>
            </div>
        </div>

        @if($order_data->is_cancelled=='0')
            @if($order_data->status=='Ordered')
                <div class="order_track">
                    <ol class="progtrckr" data-progtrckr-steps="5">
                        {{--<li class="progtrckr-todo">Ordered</li>--}}
                        <li class="progtrckr-done">Ordered</li>
                        <li class="progtrckr-todo">Packed</li>
                        <li class="progtrckr-todo">Shipped</li>
                        <li class="progtrckr-todo">Delivered</li>

                    </ol>
                </div>
            @elseif($order_data->status=='Packed')
                <div class="order_track">
                    <ol class="progtrckr" data-progtrckr-steps="5">
                        {{--<li class="progtrckr-todo">Ordered</li>--}}
                        <li class="progtrckr-done">Ordered</li>
                        <li class="progtrckr-done">Packed</li>
                        <li class="progtrckr-todo">Shipped</li>
                        <li class="progtrckr-todo">Delivered</li>

                    </ol>
                </div>
            @elseif($order_data->status=='Shipped')
                <div class="order_track">
                    <ol class="progtrckr" data-progtrckr-steps="5">
                        {{--<li class="progtrckr-todo">Ordered</li>--}}
                        <li class="progtrckr-done">Ordered</li>
                        <li class="progtrckr-done">Packed</li>
                        <li class="progtrckr-done">Shipped</li>
                        <li class="progtrckr-todo">Delivered</li>

                    </ol>
                </div>
            @elseif($order_data->status=='Delivered')
                <div class="order_track">
                    <ol class="progtrckr" data-progtrckr-steps="5">
                        {{--<li class="progtrckr-todo">Ordered</li>--}}
                        <li class="progtrckr-done">Ordered</li>
                        <li class="progtrckr-done">Packed</li>
                        <li class="progtrckr-done">Shipped</li>
                        <li class="progtrckr-done">Delivered</li>

                    </ol>
                </div>
            @endif
        @else
            <div class="order_track">
                <ol class="progtrckr" data-progtrckr-steps="5">
                    {{--<li class="progtrckr-todo">Ordered</li>--}}
                    <li class="progtrckr-cancle">Ordered</li>
                    <li class="progtrckr-cancle">Packed</li>
                    <li class="progtrckr-cancle">Shipped</li>
                    <li class="progtrckr-cancle">Cancle</li>

                </ol>
            </div>
        @endif
        @endforeach


    </div>
