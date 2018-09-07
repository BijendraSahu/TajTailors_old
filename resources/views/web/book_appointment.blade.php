@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Book Appointment')

@section('head')
    <script src="{{url('js/login_validation.js')}}"></script>

    <section class="common_section">
        <div class="container">
            <div class="updated_box " id="appointment">
                <div class="top_heading_box">
                    <span class="heading_txt">Appointment Information</span>
                </div>
                <form action="{{url('take_appointment')}}" method="post" id="take_appointment1"
                      enctype="multipart/form-data">
                    <div class="update_databox">
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner">
                                    <input type="text" name="name" autocomplete="off"
                                           class="animate_txt"
                                           id="app_name" placeholder="Enter Name"/>
                                    <label class="animate_placeholder" for="name">Name*</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="textbox_containner">
                                    <input type="email" name="email" autocomplete="off"
                                           class="animate_txt"
                                           id="email" placeholder="xyz@gmail.com"/>
                                    <label class="animate_placeholder" for="email">Email*</label>
                                </div>
                            </div>
                        </div>
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <div class="textbox_containner ">
                                    <input type="text" name="contact" autocomplete="off" class="animate_txt"
                                           id="contact" placeholder="Enter Contact No"/>
                                    <label class="animate_placeholder" for="contact">Contact No.*</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="textbox_containner ">

                                    {{--<input type="date" class="form-control required glo_date" name="appointment_date"--}}
                                    {{--placeholder="Select Appointment Date" data-inputmask="'alias': 'dd/mm/yyyy'"--}}
                                    {{--data-mask=""/>--}}

                                    <input type="text" name="appointment_date" onpaste="return false;"
                                           autocomplete="off" class="animate_txt dtp " onkeypress="return false"
                                           id="appointment_date" placeholder="Select Appointment Date"/>
                                    <label class="animate_placeholder" for="contact">Appointment Date*</label>
                                </div>
                            </div>
                        </div>
                        <div class="update_profile_row row">
                            <div class="col-sm-6">
                                <select name="time_slot" id="appointment_time"
                                        class="form-control requiredDD drop_edit">
                                    <option value="0">Select Time Slot*</option>
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
                                      placeholder="Address" id="address" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="submit_btnbox row">
                            <button type="button" onclick="book_appointment()"
                                    class="btn btn-primary btn-sm center_btnmargin"
                                    id="btn_Update_profile"><i
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
        <p id="err2"></p>
    </section>
    <script type=text/javascript>
        //        $('body').on('click', '#Btn_AccountDetails', function () {
        $('#email').focusout(function () {
            var domains = ["gmail.com", "hotmail.com", "msn.com", "yahoo.com", "yahoo.in", "yahoo.com", "aol.com", "hotmail.co.uk", "yahoo.co.in", "live.com", "rediffmail.com", "outlook.com", "hotmail.it", "googlemail.com", "mail.com"]; //update ur domains here
            var idx1 = this.value.indexOf("@");
            if (idx1 > -1) {
                var splitStr = this.value.split("@");
                var sub = splitStr[1].split(".");
                if ($.inArray(splitStr[1], domains) == -1) {
                    swal("Oops....", "Email must have correct domain name Eg: @gmail.com", "info");
                    this.value = "";
                }
            }
        });
        function book_appointment() {
            var name = $('#app_name').val();
            var email = $('#email').val();
            var contact = $('#contact').val();
            var appointment_date = $('#appointment_date').val();
            var appointment_time = $('#appointment_time option:selected').val();
            var address = $('#address').val();
            if (name == '') {
                swal("Required....", "Please enter your name", "info");
            } else if (email == '') {
                swal("Required....", "Please enter email", "info");
            } else if (contact == '') {
                swal("Required....", "Please enter contact", "info");
            } else if (appointment_date == '') {
                swal("Required....", "Please select appointment date", "info");
            } else if (appointment_time == '') {
                swal("Required....", "Please select appointment time", "info");
            } else {
                $.ajax({
                    type: "get",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('take_appointment') }}",
//                    data: '{"name":"' + name + '","email":"' + email + '","contact":"' + contact + '","appointment_date":"' + appointment_date + '","appointment_time":"' + appointment_time + '","address":"' + address + '"}',
                    data: {
                        name: name,
                        email: email,
                        contact: contact,
                        appointment_date: appointment_date,
                        address: address,
                        appointment_time: appointment_time
                    },
                    success: function (data) {
                        if (data == 'success') {
                            $("#appointment").load(location.href + " #appointment");
                            swal("Success", "Your appointment request has been saved we will get back to you soon", "success");
                        }
                    },
                    error: function (xhr, status, error) {
//                        swal("Server Error", "Something went wrong", "info");
                        $('#err2').html(xhr.responseText);
                    }
                });
            }
        }
        var date = new Date();
        $('.dtp').datepicker({
            format: "dd-MM-yyyy",
            maxViewMode: 2,
            todayHighlight: true,
            daysOfWeekHighlighted: "0",
            autoclose: true,
            startDate: date
        });
    </script>
@stop