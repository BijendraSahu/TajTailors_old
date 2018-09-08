@extends('adminlayout.adminmaster')

@section('title','Taj Tailors | OrderList')

@section('content')

    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>

    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="menu2">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       All Orders
                                    {{-- <button id="open_modal" class="btn btn-default pull-right"><i
                                                 class="mdi mdi-plus"></i>Add</button>--}}
                    </span>

                                <div id="snackbar">New Categories added Successfully</div>
                                <p class="clearfix"></p><input id='myInput' class="form-control" placeholder="search"
                                                               onkeyup='searchTable()' type='text'>
                                <br>
                                <section id="user_table">
                                    <table class="table table-striped" id='myTable'>
                                        <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Active / Inactive</th>

                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($orderdata as $order_object)
                                            <tr>
                                                <td>{{$order_object->order_no}}</td>
                                                <td>{{$order_object->order_date}}</td>
                                                <td>{{$order_object->user->name}}</td>
                                                <td>
                                                    @if($order_object->is_active=='1')
                                                        <div class="status pending">Active</div>
                                                    @else
                                                        <div class="status approved">Inactive</div>
                                                    @endif
                                                </td>

                                                <td>{{$order_object->status}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm">Status Change</button>
                                                        <div class="dropdown-content">
                                                            <a onclick="ordered({{$order_object->id}});" href="#">Ordered</a>
                                                            <a onclick="packed({{$order_object->id}});"
                                                               href="#">Packed</a>
                                                            <a onclick="shipped({{$order_object->id}});" href="#">Shipped</a>
                                                            <a onclick="delivered({{$order_object->id}});" href="#">Delivered</a>
                                                        </div>
                                                    </div>
                                                    &nbsp;&nbsp;
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm">ON/OFF</button>
                                                        <div class="dropdown-content">
                                                            <a onclick="active({{$order_object->id}});"
                                                               href="#">Active</a>
                                                            <a onclick="inactive({{$order_object->id}});" href="#">InActive</a>
                                                        </div>
                                                    </div>
                                                    &nbsp;&nbsp;<a href='{{url("/bill_order/{$order_object->id}")}}'
                                                                   target="_blank">
                                                        <button class="btn btn-primary btn-sm">Bill &nbsp;<i
                                                                    class="mdi mdi-clipboard-text"></i></button>
                                                    </a>&nbsp;&nbsp;
                                                    <button onclick="more_full({{$order_object->id}});"
                                                            data-toggle="modal" data-target="#myModal"
                                                            class="btn btn-primary btn-sm">More &nbsp;<i
                                                                class="mdi mdi-eye"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>

                                </section>


                            </div>


                        </div>
                    </div>
                </section>


            </div>
        </div>
    </section>
    <script>

        function more_full(id) {
            // $('#myModal').modal();
            // $('#myfooter').html('');
            $('#myheader').html('Order Full View');
            // $('#myfooter').html('<button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>');
            /*alert(id);*/
            /*var IDD= id;*/
            $('#mybody').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var editurl1 = '{{ url('more_order') }}' + '/' + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl1,
                data: '{"data":"' + id + '"}',
                success: function (data) {

                    $('#mybody').html(data);

                },
                error: function (xhr, status, error) {
                    $('#mybody').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });


        }


        function active(id) {
            $.ajax({
                type: "get",
                url: "{{url('/active_order')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('order is active');

                },
                error: function (data) {

                }
            });

        }
        function inactive(id) {
            $.ajax({
                type: "get",
                url: "{{url('/inactive_order')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('order is inactive');

                },
                error: function (data) {

                }
            });

        }
        function ordered(id) {
            $.ajax({
                type: "get",
                url: "{{url('/ordered')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Status has been changed to Ordered');

                },
                error: function (data) {

                }
            });

        }
        function packed(id) {
            $.ajax({
                type: "get",
                url: "{{url('/packed')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Status has been changed to Packed');

                },
                error: function (data) {

                }
            });
        }
        function shipped(id) {
            $.ajax({
                type: "get",
                url: "{{url('/shipped')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Status has been changed to Shipped');
                },
                error: function (data) {

                }
            });
        }
        function delivered(id) {
            $.ajax({
                type: "get",
                url: "{{url('/delivered')}}",
                data: {IDD: id},
                success: function (data) {
                    $("#user_table").load(location.href + " #user_table");
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Status has been changed to Delivered');
                },
                error: function (data) {

                }
            });
        }


    </script>
    <script>
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





    {{--////////////////////////////////////////////////*****Start Menu 3******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}



    {{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#item_form").load(location.href + " #item_form");--}}
{{--window.location.reload();--}}


