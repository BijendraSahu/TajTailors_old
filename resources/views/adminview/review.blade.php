@extends('adminlayout.adminmaster')

@section('title','Organic Dolchi | Review')

@section('content')

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="menu2">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       All Reviews
                                    {{-- <button id="open_modal" class="btn btn-default pull-right"><i
                                                 class="mdi mdi-plus"></i>Add</button>--}}
                    </span>

                                <div id="snackbar">New Categories added Successfully</div>
                                <p class="clearfix"></p>
                                <input id='myInput' class="form-control" placeholder="search" onkeyup='searchTable()' type='text'>
                                <br>
                                <section id="user_table">
                                    <table class="table table-striped" id='myTable'>
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Review</th>
                                            <th>Star</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <section id="allrow">
                                        @foreach($review_data as $review_obj)
                                       <tr>
                                           <td>{{$review_obj->name}}</td>
                                           <td>{{$review_obj->email}}</td>
                                           <td>{{$review_obj->review}}</td>
                                          {{-- <td>{{str_limit($review_obj->review,25)}}</td>--}}
                                           <td>{{$review_obj->star_rating}}<i class="mdi mdi-star"></i></td>
                                           @if($review_obj->is_approved=='0')
                                           <td><label class="switch">
                                                   <input onchange="aprove({{$review_obj->id}});" type="checkbox">
                                                   <span class="slider round"></span>
                                               </label></td>
                                               @else<td><label class="switch">
                                                   <input onchange="unaprove({{$review_obj->id}});" type="checkbox" checked>
                                                   <span class="slider round"></span>
                                               </label></td>
                                               @endif
                                       </tr>
                                            @endforeach
                                        </section>
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
        function aprove(id)
        {
            var IDD=id;
            $.ajax({
                type: "get",
                url: "{{url('/activate_review')}}",
                data: "IDD= " + IDD ,
                success: function (data) {
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Review Successfully Approved');
                    $("#user_table").load(location.href + " #user_table");
                },
                error: function (data) {

                }
            });

        }

        function unaprove(id)
        {
            var IDD=id;
            $.ajax({
                type: "get",
                url: "{{url('/un_activate_review')}}",
                data: "IDD= " + IDD ,
                success: function (data) {
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('Review Successfully Denied');
                    $("#allrow").load(location.href + " #allrow");
                },
                error: function (data) {

                }
            });

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





    {{--////////////////////////////////////////////////*****Start Menu 3******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}



    {{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#item_form").load(location.href + " #item_form");--}}
{{--window.location.reload();--}}


