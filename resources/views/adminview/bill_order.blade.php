<style type="text/css">

    .kot_table {
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

    .kot_table tbody tr td {
        padding: 2px;
    }

    .kot_table tbody tr td {
        border: none;
    }

    .kot_table tbody tr td hr {
        margin: 5px 0px;
        border: solid thin #ccc;
    }

    .letter_txt {
        letter-spacing: -.5px;
    }

    .center_headtxt {
        display: inline-block;
        width: 100%;
        font-size: 20px;
    }

    .small_head {
        display: inline-block;
        width: 100%;
    }

    .right_txt {
        text-align: right;
    }

    .set_bill {
        width: 400px;
    }

    .backgroud_my {
        background-color: black;
        color: white;
        font-size: 30px;
    }
</style>

<div class="set_bill">
    <table class="kot_table table">
        <tbody>
        <tr>
            <td colspan="4" style="text-align: center;">
                <span onclick="abc();" class="center_headtxt backgroud_my">INVOICE</span>
                <br>
                <span class="center_headtxt"> Taj Tailors </span>
                <span class="small_head">TIN No. : 23729162058</span>
                <span class="small_head">PH NO. : 0761-4048090, 0761-4045064</span>
                <span class="small_head">GSTIN : 23AACCD5322K1ZX</span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="2">Bill No : {{$order_data->order_no}}</td>
            <td colspan="2" class="right_txt">Date : {{ date_format(date_create($order_data->order_date), "d-M-Y")}}</td>{{--<td class="right_txt"  colspan="2">Table # 30</td>--}}</tr>
        <tr>
            {{--<td colspan="2" class="right_txt">Stevard : Surendar</td>--}}</tr>
        <tr>
            <td colspan="2" >Print Date : {{ date_format(date_create($order_data->order_date), "d-M-Y h:i A")}}</td>
            <td colspan="2" class="right_txt">Time : {{ date_format(date_create($order_data->order_date), "h:i A")}}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        <tr>
            <td>Item</td>
            <td class="right_txt">Qty</td>
            <td class="right_txt">Rate</td>
            <td class="right_txt">Amount</td>
        </tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>


        @foreach($order_details as $objectmy)
            <tr>
                <td>{{$objectmy->my_name->name}}</td>
                <td class="right_txt">{{$objectmy->qty}}</td>
                <td class="right_txt">{{$objectmy->unit_price}}</td>
                <td class="right_txt">{{$objectmy->total}}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>

        <tr>
            <td colspan="2">Bill Amount</td>
            <td colspan="2" class="right_txt">{{$total_price[0]->total}}</td>
        </tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        <tr>
            <td colspan="2">Net Amount</td>
            <td colspan="2" class="right_txt">{{$total_price[0]->total}}</td>
        </tr>
        <p class="clearfix"></p>

        </tbody>
    </table>
</div>
<script !src="">
    function abc() {
        window.print();
    }
</script>