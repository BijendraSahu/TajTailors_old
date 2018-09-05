@extends('web.layouts.e_master')

@section('title', 'Organic Food : My Profile')

@section('head')
    <style type="text/css">
        .profile_block {
            width: 100%;
            background-color: #f7f7f7;
            border: 1px solid #ececec;
            position: relative;
            padding: 20px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            overflow: hidden;
            margin: 10px auto;
            position: relative;
            border: 5px solid #fff;
            box-shadow: 5px 8px 20px rgba(0, 0, 0, 0.19), 0 2px 5px rgba(0, 0, 0, 0.23);
            background-color: #ffffff;
            border-radius: 50%;
        }

        .profile-picture img {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .profile-upload {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            margin-right: 10px;
            margin-top: 10px;
            padding: 0px 5px;
        }

        .profile-upload-pic {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0px;
            top: 0px;
            opacity: 0;
            z-index: 3;
            cursor: pointer;
        }

        .mute_caption {
            margin-top: 15px;
            width: 100%;
            display: inline-block;
        }

        .my_profile_picshow {
            position: relative;
            width: 100%;
            display: inline-block;
            padding: 15px 0px;
            padding-left: 70px;
        }

        .my_profile_picshow img {
            position: absolute;
            left: 0px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            top: 0px;
        }

        .my_profile_name {
            display: inline-block;
            width: 100%;
            font-weight: bold;
            font-size: 16px;
            color: #86bc43;
        }

        .errorClass {
            border: 1px solid red !important;
        }
    </style>
@stop
@section('content')
    <section class="product_section">
        <div class="container">
            <div class="col-sm-12 col-md-3">
                <div class="order_listbox">
                    <div class="carousal_head">
                        <span class="filter_head_txt slider_headtxt">My Profile</span>
                    </div>
                    <div class="order_list_container">
                        <div class="my_profile_picshow">
                            @if(isset($user->profile_img))
                                <img src="{{url('u_img').'/'.$user->id.'/'.$user->profile_img}}" id="_UserProfile"
                                     alt="UserProfile">
                            @else
                                <img src="{{url('images/Male_default.png')}}" id="" alt="UserProfile">
                            @endif
                            <div class="my_profile_name">{{$user->name}}</div>
                        </div>
                        <hr>
                        <div class="menu_popup_settingrow">
                            <a class="menu_setting_row" onclick="ShowProfile();">
                                <i class="mdi mdi-account-edit"></i>
                                Edit Profile
                            </a>
                        </div>
                        <div class="menu_popup_settingrow">
                            <a class="menu_setting_row" onclick="ShowAddress();">
                                <i class="mdi mdi-map-marker"></i>
                                Manage Address
                            </a>
                        </div>
                        <div class="menu_popup_settingrow">
                            <a href="{{url('order_list')}}" class="menu_setting_row">
                                <i class="mdi mdi-format-list-checks"></i>
                                Order List
                            </a>
                        </div>

                        <div class="menu_popup_settingrow">
                            <a href="{{url('product_feedback')}}" class="menu_setting_row">
                                <i class="mdi mdi-message-draw"></i>
                                Review &amp; Rating
                            </a>
                        </div>
                        {{--<div onclick="ChangePasswordShow();" class="menu_popup_settingrow"--}}
                        {{--data-target="#myModal_UpdatePassword" data-toggle="modal">--}}
                        {{--<a class="menu_setting_row" href="#">--}}
                        {{--<i class="mdi mdi-lock-open-outline"></i>--}}
                        {{--Change Password--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        <div class="menu_popup_settingrow">
                            <a href="{{url('logout')}}" class="menu_setting_row">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                <div class="order_listbox">
                    <div id="profile_box">
                        <div class="carousal_head">
                            <span class="filter_head_txt slider_headtxt">Edit Profile Details</span>
                        </div>
                        <div class="order_list_container">
                            <div class="order_row border-none">

                                <form enctype="multipart/form-data" id="userpostForm">
                                    <div class="order_details_box">
                                        <div class="col-md-5 col-sm-12">
                                            <div class="profile_block text-center">
                                                <div class="profile-picture">
                                                    @if(isset($user->profile_img))
                                                        <img src="{{url('u_img').'/'.$user->id.'/'.$user->profile_img}}"
                                                             id="_UserProfile" alt="UserProfile">
                                                    @else
                                                        <img src="{{url('images/Male_default.png')}}" id=""
                                                             alt="UserProfile"/>
                                                    @endif

                                                </div>
                                                <div class="btn btn-info btn-sm profile-upload">
                                                    <span class="mdi mdi-account-edit mdi-24px"></span>
                                                    <input type="file" name="profile_img" id="profile_file"
                                                           class="profile-upload-pic"
                                                           onchange="ChangeSetImage(this, _UserProfile);">
                                                </div>
                                                <div class="btn btn-default btn-sm profile-upload"
                                                     onclick="RemoveProfileImage(_UserProfile, profile_file);">
                                                    <span class="mdi mdi-close mdi-24px"></span>
                                                </div>
                                                <small class="text-muted mute_caption">
                                                    Accepted formats are .jpg, .gif &amp; .png. Size &lt; 1MB.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-12">
                                            <div class="deli_row">
                                                <input type="text" name="name" value="{{$user->name}}" id="username"
                                                       placeholder="Name"
                                                       class="form-control"/>
                                            </div>
                                            <div class="deli_row">
                                                <input type="text" name="email" value="{{$user->email}}" id="e_id"
                                                       placeholder="Email Id"
                                                       class="form-control"/>
                                            </div>
                                            <div class="deli_row">
                                                <input type="text" name="contact" value="{{$user->contact}}" id="p_id"
                                                       placeholder="Phone No."
                                                       class="form-control"/>
                                            </div>
                                            <div class="deli_row">
                                                <button type="submit" class="btn btn-success confirm_order_btn"><i
                                                            class="mdi mdi-account-check basic_icon_margin"></i>Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <div id="address_block" style="display: none;">
                        <div class="carousal_head">
                            <span class="filter_head_txt slider_headtxt">Delivery Address Details</span>
                        </div>
                        <form enctype="multipart/form-data" id="userAddress">
                            <div class="order_list_container">
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <input id="add_1" value="male" class="gender" name="address_radio"
                                                   type="radio"
                                                   checked="" onchange="AddressOption('new');">
                                            <label for="add_1" class="radio-label">New</label>
                                        </div>

                                        <div class="radio">
                                            <input id="add_2" onchange="AddressOption('existing');" value="female"
                                                   class="gender" name="address_radio" type="radio">
                                            <label for="add_2" class="radio-label">Existing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="existing_dropbox" style="display:none">
                                        <?php $addresses = \App\UserAddress::where(['is_active' => '1', 'user_id' => $user->id])->get(); ?>
                                        @if(count($addresses)>0)
                                            <select onchange="getuseraddress();" class="form-control"
                                                    id="existaddress" name="address_id">
                                                <option value="0"> --- Please Select ---</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->name.', '.$address->contact.', '.$address->address.', '.$address->address2.', '.$address->zip}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Name" name="name" id="add_name"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Phone No." name="contact" id="add_contact"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Email Id" name="email" id="add_email"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="City" id="add_city" name="city"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control glo_txtarea" id="add_address" name="address"
                                                  placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary pull-right"
                                               value="Save"/>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <p id="err1"></p>
    </section>
    <script>
        function getuseraddress() {
            var address_id = $('#existaddress :selected').val();
            if (address_id > 0) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('getexistaddress') }}",
                    data: {address_id: address_id},
                    success: function (data) {
                        $('#add_name').val(data.name);
                        $('#add_email').val(data.email);
                        $('#add_contact').val(data.contact);
                        $('#add_address').val(data.address);
                    },
                    error: function (xhr, status, error) {
                        ShowErrorPopupMsg('Error in uploading...');
                        $('#userpostForm').css("opacity", "");
                        // $('#err1').html(xhr.responseText);
                        // ShowErrorPopupMsg(xhr.message);
                    }
                });
            } else {
                $('#add_name').val('');
                $('#add_email').val('');
                $('#add_contact').val('');
                $('#add_address').val('');
            }
        }

        function Requiredtxt(me) {
            var text = $.trim($(me).val());
            if (text == '') {
                $(me).addClass("errorClass");
                return false;
            } else {
                $(me).removeClass("errorClass");
                return true;
            }
        }

        $(document).ready(function () {
            $("#userAddress").on('submit', function (e) {
                e.preventDefault();
                var username = $('#add_address').val();
                var email = $('#add_contact').val();
                var contact = $('#p_id').val();
                var result = true;
                if (!Boolean(Requiredtxt("#add_name")) || !Boolean(Requiredtxt("#add_contact")) || !Boolean(Requiredtxt("#add_email")) || !Boolean(Requiredtxt("#add_address"))) {
                    result = false;
                }
                if (!result) {
                    return false;
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('address_update') }}",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            if (confirm("Are you sure?")) {
                                $('#userAddress').css("opacity", ".5");
                            } else {
                                // stop the ajax call
                                return false;
                            }
                        },
                        success: function (data) {
                            if (data == 'success') {
                                ShowSuccessPopupMsg('Address has been updated...');
                                $('#userAddress').css("opacity", "");
                                setTimeout(function () {
                                    window.location.href = "{{url('my_profile')}}";
                                }, 2000);
                            } else {
                                $('#userAddress').css("opacity", "");
                                ShowErrorPopupMsg(data);
                            }

                        },
                        error: function (xhr, status, error) {
                            ShowErrorPopupMsg('Error in uploading...');
                            $('#userAddress').css("opacity", "");
                            // $('#err1').html(xhr.responseText);
                        }
                    });
                }
//                }
            });


            $("#userpostForm").on('submit', function (e) {
                e.preventDefault();
                var username = $('#username').val();
                var email = $('#e_id').val();
                var contact = $('#p_id').val();
                var result = true;
                if (!Boolean(Requiredtxt("#username")) || !Boolean(Requiredtxt("#e_id")) || !Boolean(Requiredtxt("#p_id"))) {
                    result = false;
                }
                if (!result) {
                    return false;
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('profile_update') }}",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            if (confirm("Are you sure?")) {
                                $('#userpostForm').css("opacity", ".5");
                            } else {
                                // stop the ajax call
                                return false;
                            }
                        },
                        success: function (data) {
                            console.log(data);
                            if (data == 'success') {
                                ShowSuccessPopupMsg('Profile has been updated...');
                                $('#userpostForm').css("opacity", "");
                                setTimeout(function () {
                                    window.location.href = "{{url('my_profile')}}";
                                }, 2000);
                            } else {
                                $('#userpostForm').css("opacity", "");
                                ShowErrorPopupMsg(data);
                            }
                        },
                        error: function (xhr, status, error) {
                            ShowErrorPopupMsg('Error in uploading...');
                            $('#userpostForm').css("opacity", "");
                            // $('#err1').html(xhr.responseText);
                            // ShowErrorPopupMsg(xhr.message);
                        }
                    });
                }
//                }
            });
        });
    </script>
@stop