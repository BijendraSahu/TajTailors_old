@extends('web.layouts.e_master')

@section('title', 'Organic Food : View Blog')

@section('head')
    <style>
        body {
            font-family: 'Roboto', sans-serif;

        }

        .box {
            /*margin-top: 30px;*/
            background-attachment: fixed;
            overflow: hidden;
            -webkit-box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
            box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
            -webkit-border-radius: .25rem;
            border-radius: .25rem;

        }

        .active_div {
            /*position: absolute;*/
            background-color: #ffffff;
            text-align: center;
            color: black;
            box-shadow: 3px 2px 13px 0px #ccc;
            width: 900px;
            letter-spacing: .3px;
            /*height: 170px;*/
            border-radius: 5px;
            top: 400px;
            /*left: 249px;*/
            /*line-height: 44.5px;*/
        }

        h2 {
            font-size: 30px;
            font-weight: bolder;
        }

        .social_counter {
            float: left;
            margin-left: 26px;
        }

        .set {
            font-size: 13px;
        }

        .main {
            font-size: 16px;
            font-weight: bolder;
        }

        .icon {
            padding-right: .5rem !important;
        }

        .btn .fa {
            position: relative;
            font-size: 15px;
        }

        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
        }

        .btn-fb {
            background-color: #3b5998 !important;
            color: #fff !important;
            margin-left: 30px;
        }

        .btn-tw {
            background-color: #55acee !important;
            color: #fff !important;
            margin-left: 30px;
        }

        .btn-gplus {
            background-color: #dd4b39 !important;
            color: #fff !important;
            margin-left: 30px;
        }

        .btn-default {
            background-color: #2bbbad !important;
            color: #fff !important;
            margin-left: 30px;
        }

        .content_txt {
            display: inline-block !important;

        }

        .content {
            position: relative;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
        }

        .btn {
            padding: 10px 40px;
            margin-bottom: 0;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 2px;
        }

        .counter {
            webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
            position: absolute;
            z-index: 2;
            margin-top: 0;
            margin-left: -23px;
            -webkit-border-radius: 10em;
            border-radius: 10em;
            padding: 1px 7px;
            background-color: #fe1212;
            font-size: 11px;
            color: #fff;
            left: auto;
        }
    </style>
@stop
@section('content')
    <section class="product_section">
        <div class="container">
            <div>
                <img src="{{url('blog_pic').'/'.$blog->id.'/'.$blog->img_url}}" class="box" height="400px"
                     width="1000px"/>
            </div>
            <div class="active_div">
                <h2>{{$blog->title}}</h2>
                <p class="blog_detail_box"> {!! $blog->description !!}</p>
                <div>
                    <span class="set">Written by</span>
                    <span class="main">{{$blog->created_by}},</span>
                    <span class="set">{{$blog->created_date}}</span>
                </div>
                <br>
                <div class="social_counter">
                    <a class="btn btn-fb content">
                        <i class="fa fa-facebook icon"></i>
                        <span class="clearfix content_txt">FACEBOOK</span>
                    </a>
                    <span class="counter">20</span>
                    <a class="btn btn-tw content">
                        <i class="fa fa-twitter icon"></i>
                        <span class="clearfix content_txt">TWITTER</span>
                    </a>
                    <a class="btn btn-gplus content">
                        <i class="fa fa-google-plus icon"></i>
                        <span class="clearfix content_txt">GOOGLE</span>
                    </a>
                    <a class="btn btn-default content">
                        <i class="fa fa-comments-o icon"></i>
                        <span class="clearfix content_txt">COMMENTS</span>
                    </a>
                </div>


            </div>

        </div>
    </section>
    <br>
    <br>
    @include('web.layouts.footer')
@stop