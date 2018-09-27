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
                                    <div class="col-md-6">
                                        <select name="cat" onchange="mysearch();" id="Mycat" class="form-control">
                                            <?php $catdata = \App\Categorymaster::where(['is_active' => '1'])->get();?>
                                            <option value="">All</option>
                                            @foreach($catdata as $mydata)
                                                <option value="{{$mydata->id}}">{{$mydata->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input id='myInput' class="form-control" placeholder="search"
                                               onkeyup='mysearch()' type='text'>
                                    </div>

                                    <table id='myTable' class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th width="50%">Description</th>
                                            <th>Status</th>
                                            <th>option</th>
                                        </tr>
                                        </thead>
                                        <tbody id="newid">

                                        </tbody>
                                        <tbody class="activemy" id="old">
                                        @foreach($all_items as $itemobj)

                                            <tr id="oldid">
                                                <input type="hidden" value="{{$itemobj->id}}">
                                                <td>{{$itemobj->name}}</td>
                                                @if($itemobj->description=="")
                                                    <td width="30%">Not Given</td>
                                                @else
                                                    <td width="30%">{!!$itemobj->description!!}</td>
                                                @endif
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
                                                            <li><a href="{{url('/edit_item_show').'/'.$itemobj->id}}"
                                                                   data-toggle="modal"
                                                                   data-target="#"><i
                                                                            class="mdi mdi-lead-pencil optiondrop_icon"></i>Edit</a>
                                                            </li>

                                                            @if($itemobj->is_active =='1')
                                                                <li><a href="#"
                                                                       onclick="deactivate_item({{$itemobj->id}});"><i
                                                                                class="mdi mdi-delete optiondrop_icon"></i>Inactive</a>
                                                            @else
                                                                <li><a href="#"
                                                                       onclick="activatemy_item({{$itemobj->id}});"><i
                                                                                class="mdi mdi-star optiondrop_icon"></i>Active</a>
                                                                    @endif
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
                                        {{--<div id="newid">--}}


                                        {{--</div>--}}


                                        </tbody>
                                    </table>
                                    <div class="activemy" align="center">
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

                                    <form action="{{url('/mypost')}}" method="post" id="userpostForm"
                                          enctype="multipart/form-data">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" id="namemy" name="item_name" class="form-control"
                                                       placeholder="Enter Item Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 form-group">

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
                                                            <input type="checkbox" name="category[]"
                                                                   value="{{$object->id}}" id="CheckboxHead">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>

                                        <div>
                                            <div class="form-group field_wrapper">
                                                <label class="form-label">Enter Price Details<span
                                                            style="color: red;">*</span></label>
                                                <br>
                                                <div class="col-sm-1 form-group">
                                                    <select class="form-control" name="size[]" id="weight">
                                                        <option value="30">30</option>
                                                        <option value="32">32</option>
                                                        <option value="34">34</option>
                                                        <option value="36">36</option>
                                                        <option value="38">38</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <input type="text" class="form-control" name="size[]" value=""
                                                           placeholder="Qty" required/>
                                                </div>
                                                <div class="col-sm-1 form-group">
                                                    <a href="javascript:void(0);" class="addbtn add_button"
                                                       name="price[]"
                                                       title="Add field"><img src="{{url('assets/add-icon.png')}}"/></a>
                                                </div>
                                                <p class="clearfix"></p>

                                            </div>
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


                                        <div class="col-sm-6 form-group">

                                            <input type="text" name="price" class="form-control"
                                                   placeholder="Enter Price" required>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" name="special_price" class="form-control"
                                                   placeholder="Enter Special Price">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" name="item_metatag" class="form-control"
                                                   placeholder="Enter Meta Tag">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" name="item_metakeyword" class="form-control"
                                                   placeholder="Enter Meta Keyword">
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <input type="text" name="item_metadescription" class="form-control"
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
            debugger;
            var maxField = 5; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="append_div"><div class="col-sm-1 form-group"><select class="form-control" name="size[]" id="weight"><option value="30">30</option><option value="32">32</option><option value="34">34</option><option value="36">36</option><option value="38">38</option></select></div><div class="col-sm-1 form-group"><input type="text" class="form-control" name="size[]" value="" placeholder="Qty"required/></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="{{url('assets/remove-icon.png')}}"/></a><p class="clearfix"></p></div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
                debugger;
                e.preventDefault();
                $(this).parent('.append_div').remove(); //Remove field html
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


        function activatemy_item(id) {
            var IDD = id;
            $.get('{{url('activatemy_item')}}', {IDD: IDD}, function (data) {
                $('#myheader').html('');
                $('#mybody').html('');
                $('#mybody').html('Item Activate Successfully');

                $('#myheader').html('Success  <button type="button" class="close"   data-dismiss="modal">&times;</button>');

                $('#myModal').modal();
                $("#item_part1").load(location.href + " #item_part1");


            });
        }
    </script>
    <script>

        function mysearch() {
            var nameis = $('#myInput').val();
            var catid = $('#Mycat').val();
            if (nameis == "" && catid == '') {
                $('.activemy').show();
                $('#newid').hide();

            }
            else {
                $.get('{{url('searchtable')}}', {nameis: nameis, catid: catid}, function (data) {
                    $('#newid').html("");
                    if (data == "") {
                        $('#newid').append('<tr><td>No Record Found</td></tr>');

                    }
                    else {

                        console.log(data);
                        $('.activemy').hide();
                        $('#newid').show();
                        for (var i = 0; i < data.length; i++) {
                            url = '{{url('/')}}' + '/' + 'edit_item_show/' + data[i].id;

                            if (data[i].is_active == 1) {

                                var sts = '<div class="status pending">Active</div>';
                            }
                            else {
                                var sts = '<div class="status approved">Inactive</div>';
                            }

                            if (data[i].description == null) {
                                var des = "Not Given"
                            }
                            else {
                                var des = data[i].description
                            }

                            $('#newid').append('<tr><td>' + data[i].name + '</td><td width="30%">' + des + '</td><td>' + sts + ' </td><td><div class="btn-group"><button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options </button><button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu dropdown-menu-right grid-dropdown"><li><a href="' + url + '" data-toggle="modal" data-target="#"><i class="mdi mdi-lead-pencil optiondrop_icon"></i>Edit</a></li><li><a href="#" onclick="deactivate_item(' + data[i].id + ');"><i class="mdi mdi-delete optiondrop_icon"></i>Delete</a></li><li><a href="#" onclick="openMymo(' + data[i].id + ');" class="border_none" data-toggle="modal" data-target=""><i class="mdi mdi-more optiondrop_icon"></i>More</a></li></ul></div></td></tr>');
                        }
                    }
                });
            }
        }


        function searchTable() {
            var input, filter, found, table, tr, td, i, j;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    tr[i].style.display = "none";
                }
            }
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
