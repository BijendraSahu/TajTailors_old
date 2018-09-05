@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Contact Us')

@section('head')
    <style type="text/css">
        .address_blocks {
            display: inline-block;
            width: 100%;
            max-width: 980px;
            margin: 20px 0px;
        }
        .info_box {
            min-height: 200px;
            padding: 20px 0px 0px 0px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .info_icon {
            font-size: 25px;
            background-color: #044482;
            height: 50px;
            color: #fff;
            width: 50px;
            border-radius: 50px;
            margin: 0px auto;
            margin-bottom: 20px;
            text-align: center;
            line-height: 50px;
        }
        .info_content {
            text-align: center;
            color: #4c4b4b;
            line-height: 20px;
            font-size: 18px;
        }
        .contact_border {
            position: absolute;
            bottom: 0px;
            left: 50%;
            margin-left: -50px;
        }
        .contact_border:before {
            content: "";
            border-bottom: solid thin #a2a2a2;
            position: absolute;
            width: 160px;
            bottom: 0px;
            left: -40px;
        }
        .contact_border:after {
            content: "";
            border-bottom: solid 2px #0065c7;
            position: absolute;
            width: 80px;
            bottom: 0px;
            z-index: 10;
            left: 0px;
        }
        .email_border:after {
            border-bottom: solid 2px #dc3fc6;
        }
        .add_border:after {
            border-bottom: solid 2px #fbb331;
        }
        .contact_section {
            padding-top: 40px;
            background-image: url('{{url('images/google_map.jpg')}}');
        }
        .upper_layer {
            width: 100%;
            height: auto;
            display: inline-block;
            background: rgba(0,0,0,0.5);
            padding: 70px 0px 20px 0px;
        }
    </style>
@stop
@section('content')
    <section class="common_section contact_section">
        <div class="upper_layer">
            <div class="container">
                <div class="address_blocks">
                    <div class="col-md-4">
                        <div class="info_box">
                            <div class="info_icon stap4_color"><i class="mdi mdi-phone"></i></div>
                            <div class="info_content">
                                <p style="color: #2192ff;font-weight:500;">Contact number</p>
                                <p>9111101007</p>
                            </div>
                            <div class="contact_border"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info_box">
                            <div class="info_icon stap2_color"><i class="mdi mdi-email-alert"></i></div>
                            <div class="info_content">
                                <p style="color: #ef3dd9;font-weight:500;">Email Address</p>
                                <p>abc@example.com</p>

                            </div>
                            <div class="contact_border email_border"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info_box">
                            <div class="info_icon stap3_color "><i class="mdi mdi-map-marker-radius"></i></div>
                            <div class="info_content">
                                <p style="color: #ffb023;font-weight:500;">Address</p>
                                <p>ABC Write Town</p>
                                <p>482003-Jabalpur</p>
                            </div>
                            <div class="contact_border add_border"></div>
                        </div>
                    </div>
                </div>
                <div class="updated_box ">
                    <div class="top_heading_box">
                        <span class="heading_txt">GET IN TOUCH WITH US</span>

                    </div>
                    <div class="update_databox">
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner">
                                    <input type="text" editable="false" name="name" autocomplete="off" class="animate_txt" id="name" placeholder="Enter Name">
                                    <label class="animate_placeholder" for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="textbox_containner">
                                    <input type="email" editable="false" name="email" autocomplete="off" class="animate_txt" id="email" placeholder="xyz@gmail.com">
                                    <label class="animate_placeholder" for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner">
                                    <input type="text" name="contact" autocomplete="off" class="animate_txt" id="contact" placeholder="9589883533">
                                    <label class="animate_placeholder" for="contact">Contact No.</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="address" class="form-control update_txtarea" placeholder="Enter Your Message"></textarea>
                            </div>
                        </div>

                        <div class="submit_btnbox row">
                            <button class="btn btn-primary btn-sm center_btnmargin" id="btn_Update_profile"><i class="mdi mdi-send basic_icon_margin"></i>Submit</button>
                            <button class="btn btn-default btn-sm" id="btn_Edit_profile" onclick="AddEditable(this);"><i class="mdi mdi-close basic_icon_margin"></i>Cancle</button>
                        </div>
                    </div>
                </div>
            </div></div>
    </section>
@stop
