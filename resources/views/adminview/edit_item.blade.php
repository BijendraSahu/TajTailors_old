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

        .hh {
            overflow-y: scroll;
            overflow-x: hidden;
            height: 298px;

        }

        .hh::-webkit-scrollbar {
            display: none;
        }

        .mybtnh {
            position: absolute;
            top: 0;
            right: 0;
            width: 19px;
            height: 26px;
        }

        .mydivh {
            position: relative;
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

            $('.item_chk').each(function () {
                debugger;
                @foreach($all_items_cat as $myobj)
                if ($(this).val() == '{{$myobj->category_id}}') {
                    $(this).attr('checked', 'checked');
                }

                @endforeach
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

                <section id="part2">

                    <section id="item_form">
                        <div class="col-sm-12 col-md-12 col-xs-12 hei">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading heightset"><span class="white_dash_head_txt">
                         Edit Items
                                        <button onclick="openlist();" class="btn btn-default pull-right"><i
                                                    class="mdi mdi-back"></i>List</button>
                      </span>

                                    <form action="{{url('/itemeditpost')}}" method="post" id="userpostForm"
                                          enctype="multipart/form-data">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" id="namemy" name="item_name"
                                                       value="{{$all_items->name}}" class="form-control"
                                                       placeholder="Enter Item Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <input type="hidden" name="i_id" value="{{$findthis}}">

                                            <div class="col-sm-6" onmouseleave="myfunctionis()">
                                                <label>Description</label>
                                                <div class="text_editor" id="txtEditor_myy"></div>
                                                <input type="hidden" name="temp" id="temp" class="form-control">
                                                <script>


                                                    function myfunctionis() {
                                                        var htm = $("#txtEditor_myy").Editor("getText");

                                                        $('#temp').val(htm);
                                                    }


                                                </script>
                                            </div>

                                            <div class="col-sm-6 hh" style="">
                                                <label>Select Categories</label>
                                                <br>

                                                @foreach($allcat as $object)
                                                    <div class="col-sm-3">
                                                        <label class="container">{{$object->name}}
                                                            <input type="checkbox" name="category[]" class="item_chk"
                                                                   value="{{$object->id}}" id="CheckboxHead">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>

                                        <input type="hidden" id="hidddes" value="{{$all_items->description}}">

                                        <div class="col-sm-6 form-group">
                                            <input type="text" id="item_specification"
                                                   value="{{$all_items->specifcation}}" name="item_specification"
                                                   class="form-control"
                                                   placeholder="Enter Item Specification">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" id="item_ingredients" value="{{$all_items->ingredients}}"
                                                   name="item_ingredients"
                                                   class="form-control"
                                                   placeholder="Enter Item Ingredients">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" value="{{$all_items->nutrients}}" id="item_nutrients"
                                                   name="item_nutrients"
                                                   class="form-control"
                                                   placeholder="Enter Item Available Nutrients">
                                        </div>

                                        <div class="col-sm-6 form-group">

                                            <input type="text" value="{{$all_items->usage}}" id="item_usage"
                                                   name="item_usage"
                                                   class="form-control"
                                                   placeholder="Enter Item Usage">
                                        </div>


                                        <div class="form-group field_wrapper">
                                            <label class="form-label">Enter Price Details<span
                                                        style="color: red;">*</span></label>
                                            <br>

                                            <?php $counter = 1; ?>
                                            @foreach($all_items_price as $priceobj)

                                                <div class="col-sm-1 form-group">

                                                    <input type="text" class="form-control" id="unitismine"
                                                           name="unit[]"
                                                           value="{{$priceobj->unit}}"
                                                           placeholder="Unit" {{$counter == 1 ?'required':''}} />
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <select class="form-control" name="unit[]" id="weight">
                                                        <option value="{{$priceobj->weight}}">{{$priceobj->weight}}</option>
                                                        <option value="">select</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Gms">Gms</option>
                                                        <option value="Lt">Lt</option>
                                                        <option value="ml">ml</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]"
                                                           value="{{$priceobj->cost_price}}"
                                                                   placeholder="Cost price" required/>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]"
                                                           value="{{$priceobj->price}}"
                                                           placeholder="Price" {{$counter == 1 ?'required':''}}/>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]"
                                                           value="{{$priceobj->spl_price}}"
                                                           placeholder="Special Price" {{$counter == 1 ?'required':''}}/>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <input type="text" class="form-control" name="unit[]"
                                                           value="{{$priceobj->qty}}"
                                                           placeholder="Qty" {{$counter == 1 ?'required':''}}/>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]"
                                                           value="{{$priceobj->product_id}}"
                                                           placeholder="Product Id" {{$counter == 1 ?'required':''}}/>
                                                </div>
                                                <p class="clearfix"></p>
                                                {{--<div class="col-sm-1 form-group">
                                                    <a href="javascript:void(0);" class="addbtn add_button" name="price[]"
                                                       title="Add field"><img src="{{url('assets/add-icon.png')}}"/></a>
                                                </div>--}}
                                                <?php $counter++; ?>
                                            @endforeach
                                            <?php $pc = count($all_items_price);
                                            $empty_price = 4 - $pc;
                                            ?>
                                            @for($i=0; $i<$empty_price; $i++)
                                                <div class="col-sm-1 form-group">

                                                    <input type="text" class="form-control" id="unitismine"
                                                           name="unit[]" value=""
                                                           placeholder="Unit"/>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <select class="form-control" name="unit[]" id="weight">
                                                        <option value="">select</option>
                                                        <option value="Kg">Kg</option>
                                                        <option value="Gms">Gms</option>
                                                        <option value="Lt">Lt</option>
                                                        <option value="ml">ml</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]" value=""
                                                           placeholder="Cost Price"/>
                                                </div>

                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]" value=""
                                                           placeholder="Price"/>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]" value=""
                                                           placeholder="Special Price"/>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <input type="text" class="form-control" name="unit[]" value=""
                                                           placeholder="Qty"/>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <input type="text" class="form-control" name="unit[]" value=""
                                                           placeholder="Product Id"/>
                                                </div>
                                                <p class="clearfix"></p>
                                            @endfor


                                        </div>


                                        <p class="clearfix"></p>

                                        <label>Upload Image</label> <input type="file" onchange="PreviewImage();"
                                                                           multiple
                                                                           id="upload_file_image" name="file[]">
                                        <p class="clearfix"></p>
                                        <div style="display: inline-block; width: 100%;" id="image_preview">

                                        </div>
                                        <div style="display: block;" id="files_block">

                                        </div>
                                        <style>
                                            .picclass {
                                                height: 113px;
                                                width: 107px;
                                                padding: 6px;
                                                background-color: #ccc;
                                                overflow: hidden;
                                                float: left;
                                                margin-left: 8px;
                                                margin-bottom: 8px;
                                            }

                                            .picclass_img {
                                                height: 100%;
                                                width: 100%;
                                            }
                                        </style>

                                        <div class="col-md-12 divhye">
                                            <?php $picdata = \App\ItemImages::where(['item_master_id' => $findthis])->get();?>
                                            @foreach($picdata as $picobj)
                                                <div class="picclass mydivh">
                                                    <img class="picclass_img"
                                                         src="{{url('p_img').'/'.$findthis.'/'.$picobj->image}}"/>
                                                    <span onclick="deletepic('{{$picobj->image}}','{{$picobj->id}}',{{$picobj->item_master_id}});"
                                                          class="btn btn-primary mybtnh"><i class="mdi mdi-delete"
                                                                                            style="margin-left: -6px;"></i></span>

                                                </div>
                                            @endforeach
                                        </div>


                                        <div class="col-sm-6 form-group">

                                            <input type="text" value="{{$all_items->delivery}}" name="item_delivery"
                                                   class="form-control"
                                                   placeholder="Enter Delivery Information">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" value="{{$all_items->meta_tag}}" name="item_metatag"
                                                   class="form-control"
                                                   placeholder="Enter Meta Tag">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" value="{{$all_items->meta_keyword}}"
                                                   name="item_metakeyword" class="form-control"
                                                   placeholder="Enter Meta Keyword">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" value="{{$all_items->meta_description}}"
                                                   name="item_metadescription" class="form-control"
                                                   placeholder="Enter Meta Description">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="submit" value="Add"
                                                   class="btn btn-success">
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

        $(document).ready(function () {
            var sethtm = $('#hidddes').val();
            $("#txtEditor_myy").Editor("setText", sethtm);
        });


        $(document).ready(function () {
            var maxField = 4; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="col-sm-12"><div class="col-sm-2 form-group"><input type="text" class="form-control" name="unit[]" value="" placeholder="Unit" required/></div><div class="col-sm-1 form-group"><select class="form-control" name="unit[]" id="weight"><option value="Kg">Kg</option><option value="Gms">Gms</option><option value="Lt">Lt</option><option value="ml">ml</option></select></div><div class="col-sm-2 form-group"><input type="text" class="form-control" name="unit[]" value="" placeholder="Price" required/></div><div class="col-sm-2 form-group"><input type="text" class="form-control" name="unit[]" value="" placeholder="Special Price" required/></div><div class="col-sm-2 form-group"><input type="text" class="form-control" name="unit[]" value="" placeholder="Qty" required/></div><div class="col-sm-2 form-group"><input type="text" class="form-control" name="unit[]" value="" placeholder="Product Id" required/></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="{{url('assets/remove-icon.png')}}"/></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

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
                $('#more_price').append('<div class="col-sm-3"><p class="clearfix"></p><input type="text" name="item_unit" class="form-control unit_id" placeholder="Enter Unit"> </div> <div class="col-sm-3"> <p class="clearfix"></p> <input type="text" name="item_qty" class="form-control qty_id" placeholder="Enter Quantity"> </div> <div class="col-sm-3"> <p class="clearfix"></p> <input type="text" name="item_price" class="form-control price_id" placeholder="Enter price"></div><div class="col-sm-3"><p class="clearfix"></p><input type="text" name="item_spclprice" class="form-control spc_id" placeholder="Enter Spcl price"> </div>');
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

        function deletepic(name, id, itemid) {
            var i_name = name;
            var m_id = id;
            var item_id = itemid;

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Image file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('{{url('delete_item_pic')}}', {
                            i_name: i_name,
                            m_id: m_id,
                            item_id: item_id
                        }, function (data) {
                            $(".divhye").load(location.href + " .divhye");
                        });
                        swal(" Your image file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your image file is safe!");
                    }
                });


        }
    </script>
    {{--  <script>
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


      </script>--}}
    {{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#myroll").load(location.href + " #myroll");--}}
{{--window.location.reload();--}}


{{-- --}}
{{--public function demo()
{
$imagename = request('imagem');
$imageid = request('myid');

userPicmodel::where('id', $imageid)
->delete();
$image_path = 'user_img/' . $_SESSION['user_master']['id'] . '/' . $imagename;
if (File::exists($image_path)) {
File::delete($image_path);
return '1';
}
}--}}

