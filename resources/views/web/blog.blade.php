@extends('web.layouts.e_master')

@section('title', 'Organic Food : Blog')

@section('head')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        p {
            font-size: 15px;
        }

        .btn {

            height: 34px;
            width: 110px;
        }

        h3 {
            font-weight: bolder;
            font-size: 25px;

        }

        .blog_detail_box {
            font-size: 15px;
            font-weight: 300;
            letter-spacing: .3px;
            text-shadow: 1px 1px #e8e8e8;
            text-align: justify;
            line-height: 1.5;

        }

        .one {

            margin: 30px 0px 0px 0px;
            border-radius: 5px;
        }

        .shadow {

            box-shadow: 1px 7px 16px 0px #5f393940;
        }

        .two {
            margin: 15px 0px 0px 15px;
        }

        .line {
            padding-bottom: 20px;
            border-bottom: solid thin #ccc;
        }

        .button {
            border-radius: 4px;
            background-color: #4285f4;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 15px;
            height: 37px;
            color: white;
            width: 130px;
            transition: all 0.5s;
            margin: 5px;

        }

        .first {
            border-radius: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }
    </style>
@stop
@section('content')
    <section class="product_section">
        <div class="container">
            @foreach($blogs as $blog)
                <div class="row line">
                    <div class="col-sm-3 one">
                        <div class="shadow">
                            <img src="{{url('blog_pic').'/'.$blog->id.'/'.$blog->img_url}}" class="first" width="270px" height="200px"/>
                        </div>
                    </div>
                    <div class="col-sm-7 two">
                        <div>
                            <h3>{{$blog->title}}</h3>
                            <p class="blog_detail_box"> {!! $blog->description !!}</p>
                            <div class="name">
                                <span>by</span>
                                <span style="font-weight: bold">{{$blog->created_by}}, </span>
                                <span>{{$blog->created_date}}</span>
                            </div>
                            <br>
                            <button onclick="window.location.href = '{{url('view_blog').'/'.encrypt($blog->id)}}'" class="button"><span>Read More</span>
                            </button>

                            <!--<button class="btn btn-primary">READ MORE</button>-->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @include('web.layouts.footer')
@stop