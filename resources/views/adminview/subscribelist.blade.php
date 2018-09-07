@extends('adminlayout.adminmaster')

@section('title','Subscribe List')

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

        .switch input {
            display: none;
        }

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
                        All Subscribers

                      </span>
                                    <?php $Sdata = \App\Subscribe::get();
                                    $count = 1;
                                    ?>

                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="10%">Email</th>
                                            {{--     <th width="50%"></th>--}}

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Sdata as $mysobj)
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td>{{$mysobj->email}}</td>
                                                <?php $count++; ?>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>

        <div class="modal fade" id="myModalR" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div id="Rh" class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Reject Information</h4>
                    </div>
                    <div id="Rb" class="modal-body">
                        <textarea class="form-control" id="rejectdetails" placeholder="Enter Some Details"></textarea>
                    </div>
                    <div id="Rf" class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        </div>


    </section>

    <script>
        function approvedr(id) {
            var myid = id;
            $.get('{{url('approvereciepe')}}', {myid: myid}, function (data) {
                /* alert(data);*/

                location.reload();
            });

        }
        function rejectr(id) {

            $('#Rf').html('');
            $('#Rf').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="sendrejreq(' + id + ');" class="btn btn-danger">Reject</button>');
            $('#myModalR').modal();


        }

        function sendrejreq(id) {
            var myid = id;
            var value = $('#rejectdetails').val();

            $.get('{{url('rejectRecip')}}', {myid: myid, value: value}, function (data) {
                /* alert(data);*/
                alert(data);
                console.log(data);
                location.reload();
            });
        }

        function deleteR(id) {
            myid = id;
            $.get('{{url('deleteRecip')}}', {myid: myid}, function (data) {
                /* alert(data);*/

                console.log(data);
                location.reload();
            });
        }


        function openmyform() {
            $("#item_part1").addClass("hidealways");
            $("#item_part2").removeClass("hidealways");
        }
        function openlist() {
            $("#item_part1").removeClass("hidealways");
            $("#item_part2").addClass("hidealways");
        }

    </script>
@stop
{{--$("#myroll").load(location.href + " #myroll");--}}
{{--window.location.reload();--}}






