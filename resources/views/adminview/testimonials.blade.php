@extends('adminlayout.adminmaster')

@section('title','Dashboard')

@section('content')

    <script src="{{url('js/my_validation.js')}}"></script>
    <style>
        .hidealways {
            display: none;
        }
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
                <section id="item_part1">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Testimonials
                         <button onclick="openmyform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>
                                    <?php $mydata=\App\Testimonials::orderBy('id','desc')->get();?>
                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>User Name</th>
                                       {{--     <th width="50%"></th>--}}
                                            <th>review</th>
                                            <th>Status</th>
                                            <th>option</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mydata as $obj)

                                            <tr>
                                                <td>{{$obj->user_id}}</td>
                                                <input type="hidden" name="myuid" id="myuid{{$obj->user_id}}">
                                                <td>{{$obj->review}}</td>
                                                <td>
                                                    @if($obj->is_active == 1)
                                                        <span class="badge badge-primary">Showing</span>
                                                    @else
                                                        <span class="badge badge-primary">Not Showing</span>
                                                    @endif
                                                </td>
                                                <td>
                                                   {{-- <button onclick="edittest({{$obj->id}});" class="btn btn-primary btn-sm">Update</button>--}}
                                                    <button onclick="deletetest({{$obj->id}});" class="btn btn-danger btn-sm">Delete</button>
                                                    @if($obj->is_active == 1)
                                                    <button onclick="inactiveTest({{$obj->id}});" class="btn btn-default btn-sm">inactive</button>
                                                        @else
                                                        <button onclick="activeTest({{$obj->id}});" class="btn btn-warning btn-sm">Active</button>
                                                        @endif

                                                </td>

                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                   {{-- <div align="center">
                                        {{$all_items->links()}}
                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </section>
                </section>
                <section id="item_part2" class="hidealways">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       Add Testimonials
                         {{--<button onclick="openAddform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>--}}
                      </span>
                                    <?php $userdata= \App\UserMaster::get();?>
                                    <select class="form-control" name="userid" id="userid">
                                        <option value="0">--select--</option>
                                        @foreach($userdata as $userobj)
                                        <option value="{{$userobj->id}}">{{$userobj->name}}</option>
                                            @endforeach
                                    </select>

                                    <textarea class="form-control" placeholder="Enter Review" name="review" id="review" cols="30" rows="10"></textarea>
                                    <input type="button" onclick="mytesti();" class="btn btn-primary btn-block" value="Add">
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </section>

    <script>


        function inactiveTest(id) {
            var myid = id;
            $.get('{{url('inactivetest')}}', {myid: myid}, function (data) {
                /* alert(data);*/
              /*  alert(data);
                console.log(data);*/

                location.reload();
            });
        }
        function activeTest(id) {
            var myid = id;
            $.get('{{url('activetest')}}', {myid: myid}, function (data) {
                /* alert(data);*/
              /*  alert(data);
                console.log(data);*/

                location.reload();
            });
        }
        function deletetest(id) {
            var myy = id;
            $.get('{{url('deletetest')}}', {myy: myy}, function (data) {
                /* alert(data);*/
             /*   alert(data);
                console.log(data);
*/
                location.reload();
            });
        }

        function mytesti()
        {
            var user =$('#userid').val();
            var review =$('#review').val();
            $.get('{{url('addtstimonials')}}', {user: user,review:review}, function (data) {
               /* alert(data);*/

                location.reload();
            });
        }

        function openmyform()
        {
                $("#item_part1").addClass("hidealways");
                $("#item_part2").removeClass("hidealways");
        }
        function openlist()
        {
            $("#item_part1").removeClass("hidealways");
            $("#item_part2").addClass("hidealways");
        }

    </script>
@stop
{{--$("#myroll").load(location.href + " #myroll");--}}
{{--window.location.reload();--}}






