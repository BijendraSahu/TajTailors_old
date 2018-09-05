@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Book Appointment')

@section('head')
    <section class="common_section">
        <div class="container">
            <div class="updated_box ">
                <div class="top_heading_box">
                    <span class="heading_txt">Appointment Information</span>
                </div>
                <form action="{{url('take_appointment')}}" method="post" id="take_appointment" enctype="multipart/form-data">
                    <div class="update_databox">
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner ">
                                    <input type="text" editable="false" name="name" autocomplete="off"
                                           class="animate_txt"
                                           id="name" placeholder="Enter Name"/>
                                    <label class="animate_placeholder" for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="textbox_containner required ">
                                    <input type="email" editable="false" name="email" autocomplete="off"
                                           class="animate_txt"
                                           id="email" placeholder="xyz@gmail.com"/>
                                    <label class="animate_placeholder" for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner ">
                                    <input type="text" name="contact" autocomplete="off" class="animate_txt"
                                           id="contact" placeholder="Enter Contact No"/>
                                    <label class="animate_placeholder" for="contact">Contact No.</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="dash_txt_icon_box input-group-addon">
                                        <i class="dash_txt_icon mdi mdi-calendar"></i>
                                    </div>
                                    <input type="date" class="form-control required glo_date" name="appointment_date" placeholder="Select Appointment Date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""/>
                                </div>
                            </div>
                        </div>
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <select name="time_slot" id="appointment_time" class="form-control requiredDD drop_edit">
                                    <option value="">Select Time Slot</option>
                                    <option value="09:00 - 10:00">09:00 - 10:00</option>
                                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                                    <option value="11:00 - 12:00">11:00 - 12:00</option>
                                    <option value="12:00 - 13:00">12:00 - 13:00</option>
                                    <option value="13:00 - 14:00">13:00 - 14:00</option>
                                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                                    <option value="16:00 - 17:00">16:00 - 17:00</option>
                                    <option value="17:00 -18:00">17:00 -18:00</option>
                                    <option value="18:00 - 19:00">18:00 - 19:00</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                            <textarea name="address" class="form-control update_txtarea"
                                      placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="submit_btnbox row">
                            <button type="submit" class="btn btn-primary btn-sm center_btnmargin" id="btn_Update_profile"><i
                                        class="mdi mdi-account-check basic_icon_margin"></i>Schedule Appointment
                            </button>
                            {{--<button class="btn btn-default btn-sm" id="btn_Edit_profile" onclick="AddEditable(this);"><i--}}
                            {{--class="mdi mdi-close basic_icon_margin"></i>Cancle--}}
                            {{--</button>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop