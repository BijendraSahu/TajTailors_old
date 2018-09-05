@extends('adminlayout.adminmaster')

@section('title','Dashboard')

@section('content')

    <script src="{{url('js/my_validation.js')}}"></script>

    <style>

        .errorClass {
            border: 1px solid red !important;
        }

        .modalback {
            background-color: blue;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            color: white;
            font-weight: bolder;
        }

        .thumb_close {
            position: absolute;
            width: 18px;
            height: 18px;
            background: #ff5656;
            line-height: 20px;
            color: #fff;
            cursor: pointer;
            right: 5px;
            top: 5px;
            z-index: 2;
        }

        .upimg_box {
            width: 25%;
            text-align: center;
            display: inline-block;
            max-width: 100px;
            height: 100px;
            overflow: hidden;
            position: relative;
            border: solid thin #e1e1e1;
            padding: 5px;
            margin-top: 5px;
            margin-right: 5px;
            box-shadow: 5px 8px 20px rgba(199, 199, 199, 0.19), 0 2px 5px rgba(107, 100, 100, 0.23);
            -webkit-box-shadow: 5px 8px 20px rgba(199, 199, 199, 0.19), 0 2px 5px rgba(107, 100, 100, 0.23);
        }

        .btn_center {
            text-align: center;
            margin-top: 10px;
        }

        .update_btn {
            display: none;
        }

        .hidealways {
            display: none;
        }

        /* .label_checkbox {
             display: inline-block;
         }*/

        .label_checkbox .cr {
            margin: 0px 5px;
        }

        .newrow {
            background: #1e81cd52 !important;
        }

        .nav-sidebar {
            width: 100%;
            padding: 8px 0;
            border-right: 1px solid #ddd;
        }

        .nav-sidebar a {
            color: #333;
            -webkit-transition: all 0.08s linear;
            -moz-transition: all 0.08s linear;
            -o-transition: all 0.08s linear;
            transition: all 0.08s linear;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .nav-sidebar .active a {
            cursor: default;
            background-color: #428bca;
            color: #fff;
            text-shadow: 1px 1px 1px #666;
        }

        .nav-sidebar .active a:hover {
            background-color: #428bca;
        }

        .nav-sidebar .text-overflow a,
        .nav-sidebar .text-overflow .media-body {
            white-space: nowrap;
            overflow: hidden;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
        }

        /* Right-aligned sidebar */
        .nav-sidebar.pull-right {
            border-right: 0;
            border-left: 1px solid #ddd;
        }

        .nav-sidebar.pull-right a {
            -webkit-border-radius: 0 4px 4px 0;
            -moz-border-radius: 0 4px 4px 0;
            border-radius: 0 4px 4px 0;
        }

        .heightset {
            min-height: 325px;
        }

        .btn_box {
            position: absolute;
            right: 20px;
            bottom: -60px;
        }

        .inner_box {
            position: relative;
            min-height: 230px;
        }

        .check_div {
            border: 1px solid #15141438;
            overflow: scroll;
            height: 100px;
            width: 170px;
            overflow-x: hidden;
            margin-left: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .border_none {
            border: none !important;
        }

        .container {
            font-size: 16px !important;
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .horiz {
            border: 1px solid #1b1a1a30;
            margin-top: 10px;
            border-radius: 5px;
            width: 543px;
        }

    </style>

    <script type="text/javascript">
        var o = 1
        $(document).ready(function () {
            $('.action-btn').click(function () {
                if (o % 2 == 0) {
                    $('.btn-group').addClass('open');
                    o++;
                } else {
                    $('.btn-group').removeClass('open');
                    o++;
                }
            });
        });
        function Requiredtxt(me) {
            var text = $.trim($(me).val());
            if (text == '') {
                $(me).addClass("errorClass");
                return false;
            } else {
                $(me).removeClass("errorClass");
                return true;
            }
        }


    </script>

    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="item_part1">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         All Items
                         <button onclick="openAddform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>
                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th width="50%">Delivezxczxczxcxzccxzcry</th>
                                            <th>Status</th>
                                            <th>option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($all_items as $itemobj)

                                            <tr>
                                                <input type="hidden" value="{{$itemobj->id}}">
                                                <td>{{$itemobj->name}}</td>
                                                <td width="30%">{{$itemobj->delivery}}</td>
                                                <td>@if($itemobj->is_active =='1')
                                                        <div class="status pending">Active</div>
                                                    @else

                                                        <div class="status approved">Inactive</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm action-btn"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">Options
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-sm action-btn"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="true"><span class="caret"></span><span
                                                                    class="sr-only">Toggle Dropdown</span></button>
                                                        <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                            <li><a href="#" onclick="edit_item({{$itemobj->id}});"
                                                                   data-toggle="modal"
                                                                   data-target="#"><i
                                                                            class="mdi mdi-lead-pencil optiondrop_icon"></i>Edit</a>
                                                            </li>
                                                            <li><a href="#"
                                                                   onclick="deactivate_item({{$itemobj->id}});"><i
                                                                            class="mdi mdi-delete optiondrop_icon"></i>Delete</a>
                                                            </li>
                                                            <li><a href="#"
                                                                   onclick="openMymo({{$itemobj->id}});"
                                                                   class="border_none" data-toggle="modal"
                                                                   data-target=""><i
                                                                            class="mdi mdi-more optiondrop_icon"></i>More</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                    <div align="center">
                                        {{$all_items->links()}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </section>
                <section id="part2">
                    <section id="item_form" class="hidealways">
                        <div class="col-sm-12 col-md-12 col-xs-12 hei">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading heightset"><span class="white_dash_head_txt">
                         Add Items
                                        <button onclick="openlist();" class="btn btn-default pull-right"><i
                                                    class="mdi mdi-back"></i>List</button>
                      </span>
                                    <div class="col-sm-2">
                                        <nav class="nav-sidebar">
                                            <ul class="nav">
                                                <li id="pehla"><a onclick="first();" href="#">General</a></li>
                                                <li id="dusra"><a onclick="second();" href="#">Attributes</a></li>
                                                <li><a onclick="third();" href="#">Price</a></li>
                                                <li><a onclick="fourth();" href="#">Image</a></li>
                                                <li><a onclick="fifth();" href="#">Delivery</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <form action="{{url('/itempost')}}" method="post" id="userpostForm"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col-sm-10 inner_box  " id="fir">
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Name </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" id="namemy" name="item_name" class="form-control"
                                                       placeholder="Enter Item Name">
                                            </div>


                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Description </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <div class="text_editor" id="txtEditor_myy"></div>
                                                <input type="hidden" name="temp" id="temp" class="form-control">
                                                {{--<button type="button" >play</button>--}}
                                                <script>

                                                    $("#namemy").focusout(function () {
                                                        var htm = $("#txtEditor_myy").Editor("getText");

                                                        $('#temp').val(htm);
                                                    });


                                                </script>
                                            </div>


                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Select Categories</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8 horiz">

                                                <p class="clearfix"></p>
                                                @foreach($allcat as $object)
                                                    <div class="col-sm-3">
                                                        <label class="container">{{$object->name}}
                                                            <input type="checkbox" name="category[]"
                                                                   value="{{$object->id}}" id="CheckboxHead">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>


                                            <div align="right" class="btn_box">
                                                <button onclick="second();" type="button"
                                                        class="btn btn-success btn-next">Next
                                                </button>
                                                <br></br>
                                            </div>

                                        </div>
                                        <div class="col-sm-10 inner_box hidealways " id="sec">
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Specification </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" id="item_specification" name="item_specification"
                                                       class="form-control"
                                                       placeholder="Enter Item Specification">
                                            </div>


                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Ingredients </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" id="item_ingredients" name="item_ingredients"
                                                       class="form-control"
                                                       placeholder="Enter Item Ingredients">
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Available Nutrients </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" id="item_nutrients" name="item_nutrients"
                                                       class="form-control"
                                                       placeholder="Enter Item Available Nutrients">
                                            </div>

                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Usage </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" id="item_usage" name="item_usage"
                                                       class="form-control"
                                                       placeholder="Enter Item Usage">
                                                <p class="clearfix"></p>
                                            </div>
                                            <div align="right" class="btn_box">
                                                <button onclick="first();" type="button" class="btn btn-primary">
                                                    previous
                                                </button>
                                                <button onclick="third();" type="button" class="btn btn-success">Next
                                                </button>
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="col-sm-10 inner_box hidealways " id="thre">
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Unit :</label>
                                                <input type="text" name="item_unit" class="form-control unit_id"
                                                       placeholder="Enter Unit">
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Quantity :</label>
                                                <input type="text" name="item_qty" class="form-control qty_id"
                                                       placeholder="Enter Quantity">
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Price :</label>
                                                <input type="text" name="item_price" class="form-control price_id"
                                                       placeholder="Enter price">
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Spc. Price :</label>
                                                <input type="text" name="item_spclprice" class="form-control spc_id"
                                                       placeholder="Enter Spcl price">
                                            </div>
                                            <div id="more_price">
                                            </div>
                                            <div align="center">
                                                <p class="clearfix"></p>
                                                <input type="button" onclick="add_more();" class="btn btn-default"
                                                       value="Add More Price">
                                            </div>
                                            <div class="btn_box">
                                                <button onclick="second();" type="button" class="btn btn-primary">
                                                    previous
                                                </button>
                                                <button onclick="fourth();" type="button" class="btn btn-success">Next
                                                </button>
                                                <br></br>
                                            </div>

                                        </div>
                                        <div class="col-sm-10 hidealways inner_box" id="for">
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Upload Image</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="file" onchange="PreviewImage();" multiple
                                                       id="upload_file_image" name="file[]">
                                                <p class="clearfix"></p>
                                                <div style="display: inline-block; width: 100%;" id="image_preview">

                                                </div>
                                                <div style="display: block;" id="files_block">

                                                </div>

                                            </div>
                                            <div class="btn_box">
                                                <button onclick="third();" type="button" class="btn btn-primary">
                                                    previous
                                                </button>
                                                <button onclick="fifth();" type="button" class="btn btn-success">Next
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-sm-10  hidealways  " id="fiv">
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Delivery</label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" name="item_delivery" class="form-control"
                                                       placeholder="Enter Delivery Information">

                                            </div>
                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Meta Tag </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" name="item_metatag" class="form-control"
                                                       placeholder="Enter Meta Tag">
                                            </div>

                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Meta Keyword </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" name="item_metakeyword" class="form-control"
                                                       placeholder="Enter Meta Keyword">
                                            </div>

                                            <div class="col-sm-3">
                                                <p class="clearfix"></p>
                                                <label>Meta Description </label>
                                            </div>
                                            <div class="col-sm-1">
                                                <p class="clearfix"></p>
                                                <label>:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="clearfix"></p>
                                                <input type="text" name="item_metadescription" class="form-control"
                                                       placeholder="Enter Meta Description">
                                                <p class="clearfix"></p>
                                            </div>


                                            <div align="center" class="btn_box">
                                                <button onclick="fourth();" type="button" class="btn btn-primary">
                                                    Previous
                                                </button>
                                                <input type="submit" value="Add"
                                                       class="btn btn-success"><br></br>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <p id="err1"></p>

                            </div>
                        </div>
                    </section>

                </section>


            </div>
        </div>
    </section>





    {{--////////////////////////////////////////////////*****Start Menu 3******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}


    <script>
        function openAddform() {
            $('#item_form').show();
            $('#item_part1').hide();

        }
        function openlist() {
            $('#item_form').hide();
            $('#item_part1').show();

        }
        function openMymo(id) {

            $('#myheader').html('');
            $('#mybody').html('');
            $('#myfooter').html('');
            $('#myheader').html('Product view  <button type="button" class="close" onclick="aaoneeche();"  data-dismiss="modal">&times;</button>');
            $('#myfooter').html('<button type="button" onclick="aaoneeche();" class="btn btn-default" data-dismiss="modal">Close</button>');

            var editurl = '{{ url('itemshow') }}' + '/' + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#myModal').modal();
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }

        function aaoneeche() {

            location.reload();
        }

        function first() {
            $('#fir').show();
            $('#sec').hide();
            $('#thre').hide();
            $('#for').hide();
            $('#fiv').hide();
        }

        function second() {
            var result = true;
            if (!Boolean(Requiredtxt("#namemy"))) {
                result = false;
            }
            if (!result) {
                return false;
            } else {
                var htm = $("#txtEditor_myy").Editor("getText");

                $('#temp').val(htm);
                $('#fir').hide();
                $('#sec').show();
                $('#thre').hide();
                $('#for').hide();
                $('#fiv').hide();
            }


        }

        function third() {
            debugger;
            var result = true;
            if (!Boolean(Requiredtxt("#item_specification") || !Boolean(Requiredtxt("#item_ingredients")) || !Boolean(Requiredtxt("#item_nutrients")) || !Boolean(Requiredtxt("#item_usage")))) {
                result = false;
            }
            if (!result) {
                return false;
            } else {
                var htm = $("#txtEditor_myy").Editor("getText");
                $('#fir').hide();
                $('#thre').show();
                $('#sec').hide();
                $('#for').hide();
                $('#fiv').hide();
            }

        }

        function fourth() {
            $('#fir').hide();
            $('#for').show();
            $('#sec').hide();
            $('#thre').hide();
            $('#fiv').hide();


        }

        function fifth() {
            $('#fir').hide();
            $('#for').hide();
            $('#sec').hide();
            $('#thre').hide();
            $('#fiv').show();


        }

        var limit = 1;
        function add_more() {
            if (limit < 4) {
                $('#more_price').append('<div class="col-sm-3"><p class="clearfix"></p><input type="text" name="item_unit" class="form-control unit_id" placeholder="Enter Unit"> </div> <div class="col-sm-3"> <p class="clearfix"></p> <input type="text" name="item_qty" class="form-control qty_id" placeholder="Enter Quantity"> </div> <div class="col-sm-3">        <p class="clearfix"></p> <input type="text" name="item_price" class="form-control price_id" placeholder="Enter price"></div><div class="col-sm-3"><p class="clearfix"></p><input type="text" name="item_spclprice" class="form-control spc_id" placeholder="Enter Spcl price"> </div>');
                limit++;

            }
            else {

                $('#snackbar').html('');
                $('#snackbar').html('You Can Add Only 4 Prices ');
                myFunction();

            }
        }


        function getmycheck() {
            var getcid = [];
            var getqty = [];
            var getprice = [];
            var getspcl = [];

            $('.unit_id').each(function () {
                if ($(this).val() != '') {
                    getcid.push($(this).val());

                }

            });
            $('.qty_id').each(function () {
                if ($(this).val() != '') {
                    getqty.push($(this).val());


                }
            });
            $('.price_id').each(function () {
                if ($(this).val() != '') {
                    getprice.push($(this).val());

                }
            });
            $('.spc_id').each(function () {
                if ($(this).val() != '') {
                    getspcl.push($(this).val());


                }
            });

            $.get('{{url('send_cat_price')}}', {
                getcid: getcid,
                getqty: getqty,
                getprice: getprice,
                getspcl: getspcl
            }, function (data) {
                $('#myheader').html('');
                $('#mybody').html('');
                $('#mybody').text('New Product Added Successfully');
                $('#myheader').html('Success Message<button type="button" class="close"  data-dismiss="modal">&times;</button>');


                $('#myModal').modal();
                $("#item_list").load(location.href + " #item_list");
                openlist();
                location.reload();



            });


        }

        //        function picdata() {
        //            debugger;
        $("#userpostForm").on('submit', function (e) {
//                var textval = $('#post_text').text();
//                $('#posttext').val(textval);
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('mypost') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                success: function (data) {
                    console.log(data);
                    getmycheck();


//
                },
                error: function (xhr, status, error) {
//                    console.log('Error:', data);
//                    ShowErrorPopupMsg('Error in uploading...');
                    $('#err1').html(xhr.responseText);
                }
            });
//                }
        });
        //}


        $(document).ready(function () {

            $('#open_modal').click(function () {
                $('#myheader').html('');
                $('#mybody').html('');
                $('#myfooter').html('');
                $('#myheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Add Categories</h4></div>');
                $('#mybody').append('<div class="panel-body dash_table_containner"><input type="text" class="form-control vRequiredTex" name="cat_name" placeholder="Enter Your Category Name " id="cat_name"><p class="clearfix"></p><textarea name="cat_description" id="cat_description" class="form-control vRequiredTex" rows="4" cols="50" placeholder="Enter Your Description "></textarea></p></div>');
                $('#myfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="validate();" class="btn btn-primary">Add</button>');
                $('#myModal').modal();
            });
        });


        function myFunction() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);

        }

        function abcd($id) {
            $('.edittable' + $id).attr('contenteditable', 'true');
            $('.edit' + $id).hide();
            $('.update' + $id).show();

        }
        function abcdd($id) {
            $('.edittable' + $id).attr('contenteditable', 'false');
            $('.edit' + $id).show();
            $('.update' + $id).hide();

        }
        function abcddd($id) {
            $('.edittable' + $id).attr('contenteditable', 'false');
            $('.edit' + $id).show();
            $('.update' + $id).hide();
            $('.hiderow' + $id).hide();

        }
        function update(dis, id) {
            var ID = id;
            var name = $(dis).parent().parent("#" + id).children('.name').html();
            var slug = $(dis).parent().parent("#" + id).children('.slug').html();
            var des = $(dis).parent().parent("#" + id).children('.description').html();
            /*alert(ID+one+two+three);*/
            $.ajax({
                type: "post",
                url: "{{url('updatecat')}}",
                data: "name= " + name + "&slug= " + slug + "&des= " + des + "&ID= " + ID,
                success: function (data) {
                    abcdd(ID);
                    $('#snackbar').html('');
                    $('#snackbar').html('Categories Updated successfully');
                    myFunction();
                    $("#item_form").load(location.href + " #item_form");


                },
                error: function (data) {
                    alert("Error")
                }
            });


        }
        function deletecat(id) {
            var ID = id;
            $.ajax({
                type: "post",
                url: "{{url('deletecat')}}",
                data: "&ID= " + ID,
                success: function (data) {
                    abcddd(ID);
                    $('#snackbar').html('')
                    $('#snackbar').html('Successfully Deleted');
                    myFunction();
                    $("#item_form").load(location.href + " #item_form");

                },
                error: function (data) {
                    alert("Error")
                }
            });

        }

    </script>
    <script>
        function deactivate_item(id) {
            /*alert(id);*/
            var IDD = id;
            $.get('{{url('deactivate_item')}}', {IDD: IDD}, function (data) {
                $('#myheader').html('');
                $('#mybody').html('');
                $('#mybody').html('Item Deactivate Successfully');

                $('#myheader').html('Success  <button type="button" class="close"   data-dismiss="modal">&times;</button>');

                $('#myModal').modal();
                $("#item_part1").load(location.href + " #item_part1");


            });
        }
    </script>
    <script>
        function edit_item(id) {
            $('#myheader').html('');
            $('#mybody').html('');
            $('#myfooter').html('');
            $('#myheader').html('Product Edit View  <button type="button" class="close"  data-dismiss="modal">&times;</button>');
            $('#myfooter').html('<button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>');
            $('#myModal').modal();

            /*alert(id);*/
            /*var IDD= id;*/
            var editurl1 = '{{ url('edit_item_show') }}' + '/' + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl1,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);

                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });


        }
    </script>
    {{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#myroll").load(location.href + " #myroll");--}}
{{--window.location.reload();--}}






