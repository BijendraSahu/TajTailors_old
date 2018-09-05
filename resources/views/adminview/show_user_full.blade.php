<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        .my_button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }



        button:hover, a:hover {
            opacity: 0.7;
        }
        .set{
            height: 175px;
        }
        .usr_back_img{
            background: url(images/bg.jpg)navajowhite;
            height: 200px;
            background-size: contain;
        }
        .usr_img{
            height: 135px;
            border: 2px solid #1213124f;
            border-radius: 50%;
            position: absolute;
            width: 135px;
            top: 15%;
            left: 40%;
            overflow: hidden;
            background-color: #ffffff;
        }

        .usr_img img{
          width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

{{--<h2 style="text-align:center">User Profile Card</h2>--}}

<div>
    <div class="usr_back_img">
        <div class="usr_img">
            {{--<img src="u_img\{{$user_data->id}}\{{$user_data->profile_img}}" alt="no image found"> --}}
            <img src="images\Admin_pic.jpg" alt="no image found">
        </div>
    </div>
    <h3>{{$user_data->name}}</h3>
    <div >
        <p class="title"><b>Email   : </b>{{$user_data->email}}</p>
        <p class="title"><b>Gender  : </b>{{$user_data->gender}}</p>
        <p class="title"><b>Contact : </b>{{$user_data->contact}}</p>
       {{-- <p class="title"><b>City    : </b>{{$user_data->city_name->city}}</p>--}}
        <p class="title"><b>Status  : </b>@if($user_data->is_active=='1')Active @else Inactive @endif</p>

    </div>


   {{-- <p><button class="my_button">Contact</button></p>--}}
</div>

</body>
</html>
