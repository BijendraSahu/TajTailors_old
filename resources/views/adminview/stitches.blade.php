@extends('adminlayout.adminmaster')

@section('title','Taj Tailors | Stitches Price List')

@section('content')

    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="item_part1">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Stitches Price List
                         <button onclick="opendeliform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add Stitches Price</button>
                      </span>
                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Basic Price</th>
                                            <th>Premium Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deliverydata as $object)
                                            <tr>

                                                <td id="product_name{{$object->id}}">{{$object->product_name}}</td>
                                                <td id="basic_price{{$object->id}}">{{$object->basic_price}}</td>
                                                <td id="premium_price{{$object->id}}">{{$object->premium_price}}</td>
                                                <td>
                                                    <button type="button" onclick="editdeli({{$object->id}});"
                                                            class="btn btn-primary btn-xs">Edit
                                                    </button>
                                                    <button type="button" onclick="deletedeli({{$object->id}});"
                                                            class="btn btn-success btn-xs">Delete
                                                    </button>
                                                </td>

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
    </section>

    <script>
        function opendeliform() {
            $('#smallheader').html('');
            $('#smallbody').html('');
            $('#smallfooter').html('');
            $('#smallheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Add Stitches Price</h4></div>');
            $('#smallbody').append('<input type="text" name="product_name" id="product_name" placeholder="Enter Product Name" class="form-control"><p></p><input type="text" name="basic_price" id="basic_price" placeholder="enter Basic Price" class="form-control"><p></p><input type="text" name="premium_price" id="premium_price" placeholder="enter Premium Price" class="form-control">');
            $('#smallfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="addarea();" class="btn btn-primary">Add</button>');
            $('#myModalsmall').modal();
        }
        function addarea() {
            var product_name = $('#product_name').val();
            var basic_price = $('#basic_price').val();
            var premium_price = $('#premium_price').val();

            $.get('{{url('add_stitches')}}', {
                product_name: product_name,
                basic_price: basic_price,
                premium_price: premium_price,
            }, function (data) {
                $('#myModalsmall').modal('hide');
                $("#item_part1").load(location.href + " #item_part1");
                swal({
                    title: "Success",
                    text: "Stitches price has been added",
                    icon: "success",
                    button: "ok",
                });

            });
        }


        function editdeli(id) {
            var product_name = $('#product_name' + id).html();
            var basic_price = $('#basic_price' + id).html();
            var premium_price = $('#premium_price' + id).html();

            /*alert(cityname+area+pin+amount+delivery_charge+cityid);*/
            $('#smallheader').html('');
            $('#smallbody').html('');
            $('#smallfooter').html('');
            $('#smallheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Update Stitches Price</h4></div>');
            $('#smallbody').append('<input type="text" name="product_name" id="product_name" value="' + product_name + '" placeholder="enter Product name" class="form-control"><p></p><input type="text" value="' + basic_price + '" name="basic_price" id="basic_price" placeholder="enter Basic Price" class="form-control"><p></p><input type="text" name="premium_price" id="premium_price" value="' + premium_price + '" placeholder="Enter Premium Price" class="form-control"><p></p>');
            $('#smallfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="updateaddarea(' + id + ');" class="btn btn-primary">Update</button>');
            $('#myModalsmall').modal();
        }

        function updateaddarea(id) {
            var idd = id;
            var product_name = $('#product_name').val();
            var basic_price = $('#basic_price').val();
            var premium_price = $('#premium_price').val();
            /* alert(cityid+area+pin+amount+del_charge);*/
            $.get('{{url('update_stitches')}}', {
                product_name: product_name,
                basic_price: basic_price,
                premium_price: premium_price,
                idd: idd
            }, function (data) {
                $('#myModalsmall').modal('hide');
                $("#item_part1").load(location.href + " #item_part1");
                swal({
                    title: "Success",
                    text: "Stitches prices has been updated",
                    icon: "success",
                    button: "ok",
                });
            });
        }


        function deletedeli(id) {
            var idd = id;
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this stitches prices data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.get('{{url('delete_stitches')}}', {idd: idd}, function (data) {
                        $('#myModalsmall').modal('hide');
                        $("#item_part1").load(location.href + " #item_part1");
                        swal("Success! Stitches prices has been deleted", {
                            icon: "success",
                        });
                    });
                }
            });
        }
    </script>


@stop
{{--$("#item_part1").load(location.href + " #item_part1");--}}
{{--window.location.reload();--}}


