@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : My Profile')

@section('head')
    <style type="text/css">

    </style>
@stop
@section('content')
    <section class="product_section">
        <div class="container res_pad0" id="profile_section">
            <div class="col-sm-12 col-md-3">
                <div class="order_listbox">
                    <div class="carousal_head">
                        <span class="filter_head_txt slider_headtxt">My Profile</span>
                    </div>
                    <div class="order_list_container">
                        <div class="my_profile_picshow">
                            @if($user->profile_img != 'images/Male_default.png')
                                <img src="{{url('u_img').'/'.$user->id.'/'.$user->profile_img}}" id="_UserProfile"
                                     alt="UserProfile">
                            @else
                                <img src="{{url('images/Male_default.png')}}" id="_UserProfile" alt="UserProfile">
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
                        {{--  <div class="menu_popup_settingrow">
                              <a class="menu_setting_row" onclick="ShowAddress();">
                                  <i class="mdi mdi-map-marker"></i>
                                  Manage Address
                              </a>
                          </div>--}}

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

                                <form enctype="multipart/form-data" id="userpostForm"
                                      action="{{url('profile_update')}}" method="post">
                                    <div class="order_details_box">
                                        <div class="col-md-5 col-sm-12">
                                            <div class="profile_block text-center">
                                                <div class="profile-picture">
                                                    @if($user->profile_img != 'images/Male_default.png')
                                                        <img src="{{url('u_img').'/'.$user->id.'/'.$user->profile_img}}"
                                                             id="_UserProfile" alt="UserProfile">
                                                    @else
                                                        <img src="{{url('images/Male_default.png')}}" id="_UserProfile"
                                                             alt="UserProfile"/>
                                                    @endif

                                                </div>
                                                <div class="btn btn-info btn-sm profile-upload">
                                                    <span class="mdi mdi-account-edit mdi-24px"></span>
                                                    <input type="file" name="profile_img" id="profile_file"
                                                           class="profile-upload-pic"
                                                           onchange="ChangeSetImage(this, _UserProfile);">
                                                </div>
                                                {{--<div class="btn btn-default btn-sm profile-upload"--}}
                                                {{--onclick="RemoveProfileImage(_UserProfile, profile_file);">--}}
                                                {{--<span class="mdi mdi-close mdi-24px"></span>--}}
                                                {{--</div>--}}
                                                @if($user->profile_img != 'images/Male_default.png')
                                                    <div class="btn btn-default btn-sm profile-upload">
                                                        <span class="mdi mdi-close mdi-24px"
                                                              onclick="removeProfile(_UserProfile,profile_file)"></span>
                                                    </div>
                                                @endif
                                                <small class="text-muted mute_caption">
                                                    Accepted formats are .jpg, .gif &amp; .png. Size &lt; 2MB.
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
                                                       class="form-control" onkeypress="return false;"/>
                                            </div>
                                            <div class="deli_row">
                                                <input type="text" name="contact" value="{{$user->contact}}" id="p_id"
                                                       placeholder="Phone No."
                                                       class="form-control" onkeypress="return false;"/>
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
                            <div class="order_list_container  margin_top15">
                                <div class="deli_row">
                                    <div class="col-sm-6 radio_row">
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

        function removeProfile(changepicid, file_id) {
            swal({
                title: "Confirmation",
                text: "Are you sure you want to remove profile pic?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((okk) => {
                if (okk) {
                    $.ajax({
                        type: "get",
                        contentType: "application/json; charset=utf-8",
                        url: "{{ url('removeProfile') }}",
                        success: function (data) {
                            if (jQuery.parseJSON(data).response == 'No record found') {
                                swal("Something went wrong", jQuery.parseJSON(data).response, "info");
                            } else {
                                $(changepicid).attr('src', 'images/Male_default.png');
                                $(file_id).val('');
                                swal("Success!", jQuery.parseJSON(data).response, "success");
//                                setTimeout(function () {
//                                    $("#profile_section").load(location.href + " #profile_section");
//                                }, 1500);
                            }
                        },
                        error: function (xhr, status, error) {
                            alert(error);
                            swal("Server Issue", "Something went wrong", "info");

                        }
                    });
                }

            });
        }

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
                            console.log(data);
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


            {{--$("#userpostForm").on('submit', function (e) {--}}
            {{--debugger;--}}
            {{--e.preventDefault();--}}
            {{--var username = $('#username').val();--}}
            {{--var email = $('#e_id').val();--}}
            {{--var contact = $('#p_id').val();--}}
            {{--var result = true;--}}
            {{--if (!Boolean(Requiredtxt("#username")) || !Boolean(Requiredtxt("#e_id")) || !Boolean(Requiredtxt("#p_id"))) {--}}
            {{--result = false;--}}
            {{--}--}}
            {{--if (!result) {--}}
            {{--return false;--}}
            {{--} else {--}}
            {{--$.ajax({--}}
            {{--type: 'POST',--}}
            {{--url: "{{ url('profile_update') }}",--}}
            {{--data: new FormData(this),--}}
            {{--contentType: false,--}}
            {{--cache: false,--}}
            {{--processData: false,--}}
            {{--beforeSend: function () {--}}
            {{--if (confirm("Are you sure?")) {--}}
            {{--$('#userpostForm').css("opacity", ".5");--}}
            {{--} else {--}}
            {{--// stop the ajax call--}}
            {{--return false;--}}
            {{--}--}}
            {{--},--}}
            {{--success: function (data) {--}}
            {{--console.log(data);--}}
            {{--if (data == 'success') {--}}
            {{--ShowSuccessPopupMsg('Profile has been updated...');--}}
            {{--$('#userpostForm').css("opacity", "");--}}
            {{--setTimeout(function () {--}}
            {{--window.location.href = "{{url('my_profile')}}";--}}
            {{--}, 2000);--}}
            {{--} else {--}}
            {{--$('#userpostForm').css("opacity", "");--}}
            {{--ShowErrorPopupMsg(data);--}}
            {{--}--}}
            {{--},--}}
            {{--error: function (xhr, status, error) {--}}
            {{--ShowErrorPopupMsg('Error in uploading...');--}}
            {{--$('#userpostForm').css("opacity", "");--}}
            {{--// $('#err1').html(xhr.responseText);--}}
            {{--// ShowErrorPopupMsg(xhr.message);--}}
            {{--}--}}
            {{--});--}}
            {{--}--}}
            {{--//                }--}}
            {{--});--}}
        });
    </script>
@stop