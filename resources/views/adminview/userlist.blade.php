@extends('adminlayout.adminmaster')

@section('title','User List')

@section('content')
    <style>

    </style>

    <section class="box_containner">
        <div class="container-fluid">
            <div class="row">

                <section id="menu2">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       All Users
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
                                        <th>UserID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_data as $userobject)
                                    <tr>
                                        <td>{{$userobject->id}}</td>
                                        <td>{{$userobject->name}}</td>
                                        <td>{{$userobject->email}}</td>
                                        <td>
                                            @if($userobject->gender=='male')
                                                <i class="fa fa-male fa-lg"></i>&nbsp;&nbsp;Male
                                                @else
                                                <i class="fa fa-female"></i>&nbsp;&nbsp;Female
                                                @endif
                                        </td>
                                        <td>{{$userobject->contact}}</td>
                                        <td>
                                            @if($userobject->is_active=='1')
                                                <a href="#" onclick="deactivate({{$userobject->id}});"><div class="status pending">Active</div></a>@else
                                                <a href="#" onclick="activate({{$userobject->id}});"><div class="status approved">Inactive</div></a>@endif
                                        </td>
                                        <td>       <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Options
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true"><span class="caret"></span><span
                                                            class="sr-only">Toggle Dropdown</span></button>
                                                <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                 {{--   <li><a href="#" onclick="" data-toggle="modal"
                                                           data-target="#"><i
                                                                    class="mdi mdi-lead-pencil optiondrop_icon"></i>Edit</a>
                                                    </li>
                                                    <li><a href="#" onclick=""><i
                                                                    class="mdi mdi-delete optiondrop_icon"></i>Delete</a>
                                                    </li>--}}
                                                    <li><a href="#"
                                                           onclick="show_full({{$userobject->id}});"
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
        {{$user_data->links()}}
    </div>
</section>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
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
    <script>
        function activate(id)
        {
            var IDD=id;
            $.ajax({
                type: "get",
                url: "{{url('/activate_user')}}",
                data: "IDD= " + IDD ,
                success: function (data) {
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('User Is Active');
                    $("#user_table").load(location.href + " #user_table");
                },
                error: function (data) {

                }
            });

        }
        function deactivate(id)
        {
            var IDD=id;
            $.ajax({
                type: "get",
                url: "{{url('/deactivate_user')}}",
                data: "IDD= " + IDD ,
                success: function (data) {
                    myFunction();
                    $('#snackbar').html('');
                    $('#snackbar').addClass('show');
                    $('#snackbar').html('User Is Inactive');
                    $("#user_table").load(location.href + " #user_table");
                },
                error: function (data) {

                }
            });
        }
        function myFunction() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }

        function show_full(id)
        {

            $('#myheader').html('');
            $('#mybody').html('');
            $('#myfooter').html('');
            $('#myheader').html('User Info  <button type="button" class="close"  data-dismiss="modal">&times;</button>');
            $('#myfooter').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            $('#myModalsmall').modal();

            var editurl = '{{ url('usershow') }}' + '/' + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
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






    {{--////////////////////////////////////////////////*****Start Menu 2******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}


    {{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#item_form").load(location.href + " #item_form");--}}
{{--window.location.reload();--}}


