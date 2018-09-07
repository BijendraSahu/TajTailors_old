<!DOCTYPE >
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @include('web.layouts.plugin')
    {{--<link rel="stylesheet" id="boldthemes_fonts-css"--}}
    {{--href="https://fonts.googleapis.com/css?family=Raleway%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CPlayfair+Display%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CRaleway%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CPlayfair+Display%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic%7CRaleway%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%2C100italic%2C200italic%2C300italic%2C400italic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic&amp;subset=latin%2Clatin-ext&amp;ver=1.0.0"--}}
    {{--type="text/css" media="all" data-viewport-units-buggyfill="ignore"/>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type=text/javascript>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style type="text/css">
        .errorClass {
            border: 1px solid red;
        }

    </style>
    @yield('head')
</head>
<body class="body_color">
@include('web.layouts.header')

@yield('content')

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="modal_title" class="modal-title">Title</h4>
            </div>
            <div id="modal_body" class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <div class=" pull-right">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                    &nbsp;
                </div>
                &nbsp;
                <div id="modalBtn" class="pull-right">&nbsp;</div>
                {{--<button id="extraBtn1" type="button" class="btn btn-primary" style="display:none">Save changes</button>--}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@include('web.layouts.footer')

<script type="text/javascript">
    $(document).ready(function () {
        cartload();
    });

    function cartload() {
        var editurl = "{{url('cart_load')}}";
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            data: '{"data":"' + "cart" + '"}',
            success: function (data) {
                $("#cartload").html(data);
            },
            error: function (xhr, status, error) {
                $('#cartload').html(xhr.responseText);
            }
        });
    }
</script>
@if(session()->has('message'))
    <script type="text/javascript">
        setTimeout(function () {
            swal("Success", "{{ session()->get('message') }}", "success");
        }, 500);
    </script>
@endif
@if($errors->any())
    <script type="text/javascript">
        if ('{{$errors->first()}}' == 'Please login first') {
            ShowLoginSignup('signin');
        } else {
            setTimeout(function () {
                swal("Success", "{{$errors->first()}}", "success");
            }, 500);
        }

    </script>
@endif
</body>
</html>
