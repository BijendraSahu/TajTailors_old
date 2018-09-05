<div align="center"><h3>{{ucfirst($all_items->name)}}</h3></div>


<h4 class="pro_title"><b>Price :</b></h4>
    @foreach($all_items_price as $objmy)
        <p><b>Unit</b> :{{$objmy->unit}}&nbsp;&nbsp; <b>Quantity</b> :{{$objmy->qty}} &nbsp;&nbsp; <b>price</b> :{{$objmy->price}}&nbsp;&nbsp;  <b>Special Price</b>:{{$objmy->spl_price}}</p>
        @endforeach




<h4 class="pro_title"><b>Selected Catagrious:</b></h4>
    @foreach($all_items_cat as $objmycat)
        <p>{{$objmycat->cat_name->name}}</p>
    @endforeach



<h4  class="pro_title"><b>Delivery :</b></h4>
    <p>{{ucfirst($all_items->delivery)}}</p>


<h4  class="pro_title"><b>Specifications :</b></h4>
    <p>{{ucfirst($all_items->specifcation)}}</p>



<h4  class="pro_title"><b>Ingredients :</b></h4>
    <p>{{ucfirst($all_items->ingredients)}}</p>


<h4  class="pro_title"><b>Available Nutrients :</b></h4>
    <p>{{ucfirst($all_items->nutrients)}}</p>


<h4 class="pro_title"><b>Description :</b></h4>
    <p>{{ucfirst($all_items->description)}}</p>


<h4 class="pro_title"><b>Usage :</b></h4>
    <p>{{ucfirst($all_items->usage)}}</p>


<h4 class="pro_title"><b>Images :</b></h4>
<div>
    @foreach($all_items_image as $imgobj)
    <img style="height: 125px;" src="p_img\{{$imgobj->item_master_id}}\{{$imgobj->image}}">
        @endforeach
</div>
<style type="text/css">
    .pro_title{
        border-bottom: 1px solid #353a351c;
        font-size: 20px;
        padding-bottom: 12px;
    }

</style>
