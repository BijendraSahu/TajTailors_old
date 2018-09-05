@extends('adminlayout.adminmaster')

@section('title','Organic Dolchi | Ask For Call')

@section('content')


    <section class="box_containner" id="fullid">
        <div class="container-fluid">
            <div class="row">
                <section id="item_part1">
                    <section id="item_list">
                        <div class="col-sm-12 col-md-12 col-xs-12">
                            <div class="dash_boxcontainner white_boxlist">
                                <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Caller List
                         {{--<button onclick="opencityform();" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>--}}
                      </span>
                                    <p class="clearfix"></p>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">S.No.</th>
                                            <th scope="col">Mobile Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $object)
                                        <tr>
                                            <td>1</td>
                                            <td>{{$object->mobile}}</td>
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




@stop
{{--$("#item_form").load(location.href + " #item_form");--}}
{{--window.location.reload();--}}


