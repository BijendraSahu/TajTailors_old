<div class="all_data_view">
    <div class="col-sm-6">
        <div class="magnifyimages_box">
            <div class="magnify">
                <div class="large" id="view_large_bg"></div>
                <?php $image = \App\ItemImages::where(['item_master_id' => $item->id])->first(); ?>
                @if(isset($image))
                    <img class="small" id="view_images" src="{{url('p_img').'/'.$item->id.'/'.$image->image}}"/>
                @else
                    <img src="{{url('images/default.png')}}">
                @endif
            </div>
            <div class="images_thumbbox">
                @foreach($item_images as $image)
                    <img class="brics_images" src="{{url('p_img').'/'.$item->id.'/'.$image->image}}"
                         onclick="appendimages(this);"/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="more_other_details">
            <div class="more_product_head">
                {{$item->name}}
            </div>

            <div class="option_availability">
                <div class="option_txt">Price :</div>
                {{--<select class="form-control rate" name="unit" id="price">--}}
                {{--@foreach($item_prices as $item_price)--}}
                {{--@if($item_price->qty > 0)--}}
                {{--<option value="{{$item_price->id}}">{{$item_price->unit.' - '.'Rs '.$item_price->price}}</option>--}}
                {{--@endif--}}
                {{--@endforeach--}}
                {{--</select>--}}
                @if($item->special_price > 0)
                    <div><span class="product_amt_less"><i
                                    class="mdi mdi-currency-inr"></i>{{number_format($item->price,2)}}</span><span
                                class="product_amt_real"> <i
                                    class="mdi mdi-currency-inr"></i>{{number_format($item->special_price,2)}}</span>
                    </div>
                @else
                    <span class="product_amt_real"><i
                                class="mdi mdi-currency-inr"></i>{{number_format($item->price,2)}}</span>
                @endif

            </div>
            @if($item->special_price > 0)
                <div class="option_availability">
                    <div class="option_txt">Save :</div>
                    <div class="save_amt">Save Rs. {{$item->price-$item->special_price}}</div>
                </div>
            @endif
            <div class="option_availability">
                <div class="option_txt">Option Availability :</div>
                <div class="availability_container">
                    <?php $sizes = \App\ItemSize::where(['item_master_id' => $item->id])->get();

                    $count = 1;
                    ?>
                    @if(count($sizes)>0)
                        @foreach($sizes as $size)
                            <div class="available_box {{$count == 1 ?'avail_selected':''}}"
                                 onclick="Select_Availability(this);">{{$size->size}}</div>
                            @php $count++ @endphp
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="option_availability">
                <div class="option_txt">Qty :</div>
                <input type="number" min="1" max="10" id="qty_view_{{$item->id}}" class="form-control text-center"
                       value="1"/>
            </div>
            <div class="option_availability">
                <button class="more_addToCart btn-primary" type="button" id="{{$item->id}}"
                        onclick="AddTOcartView(this)"><i class="mdi mdi-cart"></i> <span id="{{$item->id}}"
                                                                                         class="button-group__text">Add</span>
                </button>
            </div>
            <div class="more_product_head">
                Description :
            </div>
            <div class="more_product_details">
                {!! $item->description !!}
            </div>

        </div>
    </div>
</div>
<script>
    function AddTOcartView(dis) {
        var itemid = $(dis).attr('id');
        var rateid = $('#price :selected').val();
        var qty = $('#qty_view_' + itemid).val();
        var size = $(dis).parent().parent().find('.avail_selected').text();
        var carturl = "{{url('addtocart')}}";
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: carturl,
            data: {itemid: itemid, rateid: rateid, quantity: qty, size: size},
            success: function (data) {
                swal("Success", "Item has been added to cart", "success");
                $("#cartload").html(data);
            },
            error: function (xhr, status, error) {
                $("#cartload").html(xhr.responseText);
            }
        });
    }
</script>