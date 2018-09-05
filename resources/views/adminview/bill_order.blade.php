<style type="text/css">

    .kot_table
    {
        background: #fff;
        min-height: 50px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        position: relative;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        -ms-border-radius: 2px;
        border-radius: 2px;
        margin: 0px;
        padding: 0px;
    }
    .kot_table tbody tr td{
        padding:2px;
    }
    .kot_table tbody tr td
    {
        border: none;
    }
    .kot_table tbody tr td hr
    {
        margin: 5px 0px;
        border: solid thin #ccc;
    }
    .letter_txt
    {
        letter-spacing: -.5px;
    }
    .center_headtxt
    {
        display: inline-block;
        width: 100%;
        font-size: 20px;
    }
    .small_head
    {
        display: inline-block;
        width: 100%;
    }
    .right_txt
    {
        text-align: right;
    }
    .set_bill
    {
        width:400px;
    }
    .backgroud_my
    {
        background-color: black;
        color: white;
        font-size: 30px;
    }
</style>

<div class="set_bill">
    <table class="kot_table table">
        <tbody>
        <tr><td colspan="4" style="text-align: center;">
                <span onclick="abc();" class="center_headtxt backgroud_my">INVOICE</span>
                <br>
                <span class="center_headtxt"> Organic Dolchi </span>
               {{-- <span class="small_head">Bar & Restaurant</span>
                <span class="small_head">Mandla Road Tilhari Juridiction of jabalpur -482020</span>--}}
                <span class="small_head">TIN No. : 23729162058</span>
                <span class="small_head">PH NO. : 0761-4048090-4045064</span>
                <span class="small_head">GSTIN : 23AACCD5322K1ZX</span>
            </td></tr>
        <tr><td colspan="4"><hr></td></tr>
        <tr><td colspan="2">Bill No : {{$order_data->order_no}}</td>{{--<td class="right_txt"  colspan="2">Table # 30</td>--}}</tr>
        <tr><td colspan="2">Date : 01/11/2017</td>{{--<td colspan="2" class="right_txt">Stevard : Surendar</td>--}}</tr>
        <tr><td colspan="2">Time : 10:30 pm</td><td colspan="2" class="right_txt">Covers : 2</td></tr>
        <tr ><td colspan="4">Print Date : 02/02/2018 5:13 pm</td>
        </tr>
        <tr><td colspan="4"><hr></td></tr>
        <tr><td>Item</td><td class="right_txt">Qty</td><td class="right_txt">Rate</td><td class="right_txt">Amount</td></tr>
        <tr><td colspan="4"><hr></td></tr>



        @foreach($order_details as $objectmy)
        <tr><td>{{$objectmy->my_name->name}}</td><td class="right_txt">{{$objectmy->qty}}</td><td class="right_txt">{{$objectmy->unit_price}}</td><td class="right_txt">{{$objectmy->total}}</td></tr>
@endforeach

        <tr><td colspan="4"><hr></td></tr>

        <tr><td colspan="2">Bill Amount</td><td colspan="2" class="right_txt">{{$total_price[0]->total}}</td></tr>
       {{-- <tr><td colspan="2">SGST (9%)</td><td colspan="2" class="right_txt">42.89</td></tr>
        <tr><td colspan="2">CGST (9%)</td><td colspan="2" class="right_txt">42.89</td></tr>
        <tr><td colspan="2">Round Off</td><td colspan="2" class="right_txt">0.22</td></tr>--}}
        <tr><td colspan="4"><hr></td></tr>
        <tr><td colspan="2">Net Amount</td><td colspan="2" class="right_txt">{{$total_price[0]->total}}</td></tr>
        <p class="clearfix"></p>
        {{-- <tr><td colspan="4"><hr></td></tr>

     <tr><td colspan="4"><br><br></td></tr>
       <tr><td colspan="1">CASHIER : Prakash</td><td colspan="3" class="right_txt">Guest Signature</td></tr>
       <tr><td colspan="4"><br><br><br></td></tr>
       <tr><td colspan="4" style="text-align: center;">
               <span class="center_headtxt">  THANK YOU FOR COMING PLEASE VISIT AGAIN !!! </span>
           </td>
       </tr>
       <tr><td colspan="4"><br></td></tr>--}}
        </tbody>
    </table>
</div>
<script !src="">
    function abc() {
        window.print();
    }
</script>