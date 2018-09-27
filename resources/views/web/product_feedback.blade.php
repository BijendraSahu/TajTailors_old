@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Product List')

@section('head')
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function SelectStar(dis) {
            $(dis).parent().find('input.rating-value').val($(dis).data('rating'));
            var $star_rating = $(dis).parent().find('.mdi');
            $star_rating.each(function () {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('mdi-star-outline').addClass('mdi-star');
                } else {
                    return $(this).removeClass('mdi-star').addClass('mdi-star-outline');
                }
            });
        }
        $('#add_address_update').tooltip({'trigger':'focus', 'title': 'Password tooltip'});
    </script>
@stop
@section('content')
    <section class="feedback_block">
        <div class="container-fluid res_pad0">
            <div class="col-sm-12 col-md-9">
                <div class="order_listbox">
                    <div class="carousal_head">
                        <span class="filter_head_txt slider_headtxt">Ratings & Reviews</span>
                    </div>
                    <div class="order_list_container" id="feedback_refresh">
                        @if(count($orders)>0)
                            @foreach($orders as $order)
                                @php
                                    $item = \App\ItemMaster::find($order->item_master_id);
                                @endphp
                                <div class="order_row border-none">
                                    <div class="order_details_box">
                                        <div class="col-md-6 col-sm-12">
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
                                                    <a href="{{url('view_product').'/'.(encrypt($item->id))}}">{{$item->name}}</a>
                                                </div>
                                                {{-- <div class="option_availability">
                                                     <div class="option_txt">Specification</div>
                                                     <div class="product_right_txt">
                                                         {!! $item->specifcation!!}
                                                     </div>
                                                 </div>--}}
                                                {{--<div class="option_availability">--}}
                                                {{--<div class="option_txt">Container Type</div>--}}
                                                {{--<div class="product_right_txt">--}}
                                                {{--Bottle--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="option_availability">
                                                    <div class="option_txt">Qty</div>
                                                    <div class="product_right_txt">
                                                        {{$order->qty}}
                                                    </div>
                                                </div>
                                                <div class="option_availability">
                                                    <div class="option_txt">Amount</div>
                                                    <div class="product_right_txt">
                                                        <div class="order_amt">
                                                            <i class="mdi mdi-currency-inr"></i> {{$order->total}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="desc_cart">
                                                    <div class="des_txt">Specifications :</div>
                                                    <div class="des_details">
                                                        {!! $item->specifcation!!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            @php
                                                $review = \App\Review::where(['item_master_id'=>$item->id, 'user_id'=>$_SESSION['user_master']->id, 'order_description_id'=>$order->ods_id])->first();
                                            @endphp
                                            @if(isset($review))
                                                <div class="feedback_heading">Rated</div>
                                                <div class="feedback_txt">
                                                    <div class="star-rating">
                                                        @for ($x = 1; $x <= 5; $x++)
                                                            @if($x <= $review->star_rating)
                                                                <span class="mdi mdi-star"></span>
                                                            @else
                                                                <span class="mdi mdi-star-outline"></span>
                                                            @endif
                                                        @endfor

                                                    </div>
                                                </div>
                                                <div class="feedback_txt">
                                                    {{$review->review}}
                                                </div>
                                            @else
                                                <div class="feedback_heading">Rate this product</div>
                                                <div class="feedback_txt">
                                                    <div class="star-rating">
                                         <span onclick="SelectStar(this)" class="mdi mdi-star-outline" data-rating="1"
                                               data-toggle="tooltip" data-placement="top" title="Very Bad"></span>
                                                        <span onclick="SelectStar(this)" class="mdi mdi-star-outline"
                                                              data-rating="2"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="Bad"></span>
                                                        <span onclick="SelectStar(this)" class="mdi mdi-star-outline"
                                                              data-rating="3"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="Good"></span>
                                                        <span onclick="SelectStar(this)" class="mdi mdi-star-outline"
                                                              data-rating="4"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="Very Good"></span>
                                                        <span onclick="SelectStar(this)" class="mdi mdi-star-outline"
                                                              data-rating="5"
                                                              data-toggle="tooltip" data-placement="top"
                                                              title="Excellent"></span>
                                                        <input type="hidden" name="whatever1" class="rating-value"
                                                               id="rating"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="feedback_txt">
                                            <textarea class="form-control glo_txtarea" id="review_{{$item->id}}"
                                                      placeholder="Please give review for product"></textarea>
                                                </div>
                                                <div class="btn btn-success btn-sm pull-right"
                                                     data-content="{{$item->id}}"
                                                     id="{{$order->ods_id}}"
                                                     onclick="submit_review(this);">
                                                    <span class="mdi mdi-playlist-edit basic_icon_margin"></span>Submit
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div>< No Orders Available ></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="order_listbox">
                    <div class="carousal_head">
                        <span class="filter_head_txt slider_headtxt">What makes a good review</span>
                    </div>
                    <div class="order_list_container">
                        <p id="err"></p>
                        <div class="feedback_heading">
                            Have you used this product?
                        </div>
                        <div class="feedback_txt">
                            Your review should be about your experience with the product.
                        </div>
                        <hr>
                        <div class="feedback_heading">
                            Why review a product?
                        </div>
                        <div class="feedback_txt">
                            Your valuable feedback will help fellow shoppers decide!
                        </div>
                        <hr>
                        <div class="feedback_heading">
                            How to review a product?
                        </div>
                        <div class="feedback_txt">
                            Your review should include facts. An honest opinion is always appreciated.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function submit_review(dis) {
            var order_des_id = $(dis).attr('id');
            var item_id = $(dis).attr('data-content');
            var review = $('#review_' + item_id).val();
            var star_rating = $(dis).parent().find('#rating').val();
            if (star_rating.trim() == '') {
                swal("Oops", "please select star rating for this product", "info");
            } else if (review.trim() == '') {
                swal("Oops", "please enter review for this product", "info");
            } else {
                $.ajax({
                    type: "post",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('submit_feedback') }}",
                    data: '{"order_des_id":"' + order_des_id + '", "item_id":"' + item_id + '", "review":"' + review + '", "star_rating":"' + star_rating + '"}',
                    success: function (data) {
                        if (data == 'success') {
                            swal("Success", "Your review has been submitted...", "success");
                            setTimeout(function () {
                                $("#feedback_refresh").load(location.href + " #feedback_refresh");
                            }, 1000);
                        } else {
                            swal("Oops", "Something went wrong with review please try again later", "info");
                        }
                    },
                    error: function (xhr, status, error) {
//                        $('#err').html(xhr.responseText);
                        swal("Oops", "Server not responding please try again later", "info");
                    }
                });
            }
        }
    </script>
@stop