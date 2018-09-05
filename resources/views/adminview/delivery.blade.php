@extends('adminlayout.adminmaster')

@section('title','Organic Dolchi | Delivery')

@section('content')


    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="item_part1">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Delivery List
                         <button onclick="opendeliform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>
                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>City</th>
                                            <th>Area</th>
                                            <th>Pin</th>
                                            <th>Amount</th>
                                            <th>Delivery Charge</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deliverydata as $object)
                                            @if($object->is_active=='1')
                                        <tr>
                                            <input type="hidden" id="cityid{{$object->id}}" value="{{$object->city_id}}">
                                           {{-- <td id="cityname{{$object->id}}">{{$object->cityname->city_name}}</td>--}}
                                            <td id="area{{$object->id}}">{{$object->area}}</td>
                                            <td id="pin{{$object->id}}">{{$object->pin}}</td>
                                            <td id="amount{{$object->id}}">{{$object->amount}}</td>
                                            <td id="delivery_charge{{$object->id}}">{{$object->delivery_charge}}</td>
                                            <td><button type="button" onclick="editdeli({{$object->id}});" class="btn btn-primary btn-xs">Edit</button>
                                                <button type="button" onclick="deletedeli({{$object->id}});" class="btn btn-success btn-xs">Delete</button></td>

                                        </tr>
                                        @endif
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
    </section>

    <script>
       function opendeliform()
        {
            $('#smallheader').html('');
            $('#smallbody').html('');
            $('#smallfooter').html('');
            $('#smallheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Add Delivery</h4></div>');
            $('#smallbody').append('<select class="form-control" name="city_name" id="city_name"><option value="">Select</option>@foreach($citydata as $mydata) @if($mydata->is_deleted=='0') <option value="{{$mydata->id}}">{{$mydata->city_name}}</option>@endif @endforeach </select><p></p><input type="text" name="area" id="area" placeholder="enter area name" class="form-control"><p></p><input type="text" name="pin" id="pin" placeholder="enter pin code" class="form-control"><p></p><input type="text" name="amount" id="amount" placeholder="enter amount" class="form-control"><p></p><input type="text" name="del_charge" placeholder="enter delevery charge" id="del_charge" class="form-control"><p></p>');
            $('#smallfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="addarea();" class="btn btn-primary">Add</button>');
            $('#myModalsmall').modal();
        }
        function addarea()
        {
           var cityid=$('#city_name').val();
           var area=$('#area').val();
           var pin=$('#pin').val();
           var amount=$('#amount').val();
           var del_charge=$('#del_charge').val();

            $.get('{{url('add_delivery')}}', {cityid: cityid,area: area,pin: pin,amount: amount,del_charge: del_charge}, function (data) {
                $('#myModalsmall').modal('hide');
                $("#item_part1").load(location.href + " #item_part1");
                swal({
                    title: "Success",
                    text: "Delivery Charge Added Successfull",
                    icon: "success",
                    button: "ok",
                });

            });
        }


        function editdeli(id)
        {
var cityname=$('#cityname'+id).html();
var area=$('#area'+id).html();
var pin=$('#pin'+id).html();
var amount=$('#amount'+id).html();
var delivery_charge=$('#delivery_charge'+id).html();
var cityid=$('#cityid'+id).val();

/*alert(cityname+area+pin+amount+delivery_charge+cityid);*/
            $('#smallheader').html('');
            $('#smallbody').html('');
            $('#smallfooter').html('');
            $('#smallheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Add Delivery</h4></div>');
            $('#smallbody').append('<select class="form-control" name="city_name" id="city_name"><option value="'+cityid+'">'+cityname+'</option>@foreach($citydata as $mydata) @if($mydata->is_deleted=='0') <option value="{{$mydata->id}}">{{$mydata->city_name}}</option>@endif @endforeach </select><p></p><input type="text" name="area" id="area" value="'+area+'" placeholder="enter area name" class="form-control"><p></p><input type="text" value="'+pin+'" name="pin" id="pin" placeholder="enter pin code" class="form-control"><p></p><input type="text" name="amount" id="amount" value="'+amount+'" placeholder="enter amount" class="form-control"><p></p><input type="text" name="del_charge" placeholder="enter delevery charge" value="'+delivery_charge+'" id="del_charge" class="form-control"><p></p>');
            $('#smallfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="updateaddarea('+id+');" class="btn btn-primary">Add</button>');
            $('#myModalsmall').modal();
        }

        function updateaddarea(id)
        {
            var idd=id;
            var cityid=$('#city_name').val();
            var area=$('#area').val();
            var pin=$('#pin').val();
            var amount=$('#amount').val();
            var del_charge=$('#del_charge').val();
        /* alert(cityid+area+pin+amount+del_charge);*/
            $.get('{{url('update_delivery')}}', {cityid: cityid,area: area,pin: pin,amount: amount,del_charge: del_charge,idd: idd}, function (data) {
               console.log(data);
                $('#myModalsmall').modal('hide');
                $("#item_part1").load(location.href + " #item_part1");
                swal({
                    title: "Update Success",
                    text: "Delivery Charge Added Successfull",
                    icon: "success",
                    button: "ok",
                });

            });

        }


        function deletedeli(id)
        {
            var idd=id;

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Delivery Data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    $.get('{{url('delete_del')}}', {idd:idd}, function (data) {


                        $('#myModalsmall').modal('hide');
                        $("#item_part1").load(location.href + " #item_part1");

                    swal("Poof! Your file has been deleted!", {
                        icon: "success",
                    });
                    });
                } else {
                    swal("Your Delivery file is safe!");
        }
        });








        }
    </script>


@stop
{{--$("#item_part1").load(location.href + " #item_part1");--}}
{{--window.location.reload();--}}


