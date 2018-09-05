@extends('adminlayout.adminmaster')

@section('title','Dashboard')

@section('content')
    <style>
        .btn_center {
            text-align: center;
            margin-top: 10px;
        }

        .update_btn {
            display: none;
        }
        .hidealways {
            display: none;
        }
        .label_checkbox
        {
  display: inline-block;
        }

        .label_checkbox .cr{
            margin: 0px 5px;
        }
        .newrow
        {
            background: #1e81cd52 !important;
        }

    </style>

    <section class="box_containner">
        <div class="container-fluid">
            <div class="row">
               <section id="menu1">
                    <div class="home_brics_row">
                        <?php $cdata= \App\ItemCategory::where(['is_active'=>1])->count();?>
                        <a href="/category"><div class="col-sm-3">
                            <div class="white_brics">
                                <div class="white_icon_withtxt">
                                    <div class="white_icons_blk"><i class="mdi mdi-tag"></i></div>
                                    <div class="white_brics_txt">Category</div>
                                    <div class="white_brics_count">{{$cdata}}</div>
                                </div>
                                <div class="brics_progress white_brics_border_clr1"></div>
                            </div>
                        </div>
                        </a>
                            <?php $idata= \App\ItemMaster::where(['is_active'=>1])->count();?>
                        <a href="/items">
                        <div class="col-sm-3">
                            <div class="white_brics">
                                <div class="white_icon_withtxt">
                                    <div class="white_icons_blk white_brics_clr2"><i
                                                class="mdi mdi-content-duplicate"></i></div>
                                    <div class="white_brics_txt">Items</div>
                                    <div class="white_brics_count">{{$idata}}</div>
                                </div>
                                <div class="brics_progress white_brics_border_clr2" style="
"></div>
                            </div>
                        </div>
                        </a>
                            <?php $udata= \App\UserMaster::where(['is_active'=>1])->count();?>
                         <a href="/userlist">
                        <div class="col-sm-3">
                            <div class="white_brics">
                                <div class="white_icon_withtxt">
                                    <div class="white_icons_blk white_brics_clr3"><i
                                                class="mdi mdi-account-multiple"></i></div>
                                    <div class="white_brics_txt">Users</div>
                                    <div class="white_brics_count">{{$udata}}</div>
                                </div>
                                <div class="brics_progress white_brics_border_clr3"></div>
                            </div>
                        </div>
                         </a>
                            <?php $odata= \App\OrderMaster::where(['is_active'=>1])->count();?>
                            <a href="/orderlist">
                        <div class="col-sm-3">
                            <div class="white_brics">
                                <div class="white_icon_withtxt">
                                    <div class="white_icons_blk white_brics_clr4"><i
                                                class="mdi mdi-clipboard-plus"></i></div>
                                    <div class="white_brics_txt">Orders</div>
                                    <div class="white_brics_count">{{$odata}}</div>
                                </div>
                                <div class="brics_progress white_brics_border_clr4"></div>
                            </div>
                        </div>
                            </a>

                    </div>
                </section>
              {{--  <section id="menu2">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       All Categories
                       <button id="open_modal" class="btn btn-default pull-right"><i
                                   class="mdi mdi-plus"></i>Add</button>
                    </span>

                                <div id="snackbar">New Categories added Successfully</div>
                                <p class="clearfix"></p>
                                <section id="mytablereload">
                                <table class="table table-striped" id="mycattable">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    @if(count($alldata) > 0)
                                        @foreach($alldata as $object)
                                            <tbody>
                                            <tr class="hiderow{{$object->id}}" id="{{$object->id}}">
                                                <td>{{$no++}}</td>
                                                <td contenteditable="false"
                                                    class="edittable{{$object->id}} name">{{$object->name}}</td>
                                                <td contenteditable="false"
                                                    class="edittable{{$object->id}} description ">{{$object->description}}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info edit{{$object->id}}"
                                                            onclick="abcd({{$object->id}});">Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-primary update_btn update{{$object->id}}"
                                                            onclick="update(this,'{{$object->id}}');">Update
                                                    </button>
                                                    |
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="deletecat({{$object->id}});">Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    @else
                                        <tbody>
                                        <tr>
                                            <td>No record Available</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>

                                        </tbody>
                                    @endif

                                </table>
                                <div align="center">
                                    {{$alldata->links()}}
                                </div>
                                </section>
                            </div>

                        </div>
                    </div>
                </section>
                <section id="menu3">
                    <section id="item_list">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       All Items
                       <button id="open_item_form" class="btn btn-default pull-right"><i
                                   class="mdi mdi-plus"></i>Add</button>
                    </span>

                            </div>
                        </div>
                    </div>
                </section>
                </section>
                <section id="item_form" >
                   --}}{{-- <section id="item_form" class="hidealways">--}}{{--
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="dash_boxcontainner white_boxlist">
                            <div class="upper_basic_heading"><span class="white_dash_head_txt">
                       Add Items
                    </span>
                               --}}{{-- <div class="">--}}{{--
                                <p class="clearfix"></p>
                                <label>Name : </label>
                                <p class="clearfix"></p>
                                <input type="text" name="item_name" class="form-control" placeholder="Enter Item Name">
                                <p class="clearfix"></p>
                                <label>Price : </label>
                                <p class="clearfix"></p>
                                <input type="text" name="item_price" class="form-control" placeholder="Enter Item price">
                                <p class="clearfix"></p>
                                <label>Select Categories : </label><p class="clearfix"></p>
                                @foreach($allcat as $object)
                                    <div class="label_checkbox">
                                    <div class="checkbox ">
                                        <label><input type="checkbox"  class="setchat_box" value="{{$object->id}}" id="CheckboxHead"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span>{{$object->name}}</label>
                                    </div>
                                    </div>
                                @endforeach
                                <p class="clearfix"></p>
                                <label>Select Image : </label> <p class="clearfix"></p>
                                <input type="file" name="item_pic" class="form-control" placeholder="Upload Item image">
                                <p class="clearfix"></p>
                                <label>Usage : </label>
                                <p class="clearfix"></p>
                                <textarea name="item_usage" id="item_usage" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Usage "></textarea>
                                <p class="clearfix"></p>
                                <label>Description : </label>
                                <p class="clearfix"></p>
                                <textarea name="item_description" id="item_description" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Description "></textarea>
                                <p class="clearfix"></p>
                                <label>Specifications : </label>
                                <p class="clearfix"></p>
                                <textarea name="item_specifications" id="item_specifications" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Specifications "></textarea>
                                <p class="clearfix"></p>
                                <label>Ingredients : </label>
                                <p class="clearfix"></p>
                                <textarea name="item_ingredients" id="item_ingredients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Ingredients "></textarea>
                                <p class="clearfix"></p>
                                <label>Nutrients : </label>
                                <p class="clearfix"></p>
                                <textarea name="item_available_nutrients" id="item_available_nutrients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Available Nutrients "></textarea>
                                <p class="clearfix"></p>
                                <label>Delivery : </label>
                                <p class="clearfix"></p>
                                <input type="text" name="item_delivery" class="form-control" placeholder="Enter Your Delivery Information">
                                <p class="clearfix"></p>
                            </div>
                        </div>
                    </div>

                </section>--}}
            </div>
            <div class="row">
                <section id="menu1">
                    <div class="home_brics_row">
                        <?php $ddata= \App\DeliveryModel::where(['is_active'=>1])->count();?>
                        <a href="/delivery">
                            <div class="col-sm-3">
                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk white_brics_clr4"><i
                                                    class="mdi mdi-gift"></i></div>
                                        <div class="white_brics_txt">Delivery</div>
                                        <div class="white_brics_count">{{$ddata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr4"></div>
                                </div>
                            </div>
                        </a>


                        <a href="/review">
                            <?php $rdata= \App\Review::where(['is_active'=>1])->count();?>
                            <div class="col-sm-3">
                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk white_brics_clr3"><i
                                                    class="mdi mdi-forum"></i></div>
                                        <div class="white_brics_txt">Review</div>
                                        <div class="white_brics_count">{{$rdata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr3"></div>
                                </div>
                            </div>
                        </a>



                        <a href="/statelist">
                            <?php $sdata= \App\StateModel::where(['is_deleted'=>0])->count();?>
                            <div class="col-sm-3">
                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk white_brics_clr2"><i
                                                    class="mdi mdi-earth"></i></div>
                                        <div class="white_brics_txt">State</div>
                                        <div class="white_brics_count">{{$sdata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr2" style="
"></div>
                                </div>
                            </div>
                        </a>
                            <?php $cidata= \App\Cities::count();?>
                        <a href="/citylist"><div class="col-sm-3">
                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk"><i class=" mdi mdi-map-marker"></i></div>
                                        <div class="white_brics_txt">City</div>
                                        <div class="white_brics_count">{{$cidata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr1"></div>
                                </div>
                            </div>
                        </a>

                    </div>
                </section>
                {{--  <section id="menu2">
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         All Categories
                         <button id="open_modal" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>

                                  <div id="snackbar">New Categories added Successfully</div>
                                  <p class="clearfix"></p>
                                  <section id="mytablereload">
                                  <table class="table table-striped" id="mycattable">
                                      <thead>
                                      <tr>
                                          <th>Sr.</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Action</th>

                                      </tr>
                                      </thead>
                                      @if(count($alldata) > 0)
                                          @foreach($alldata as $object)
                                              <tbody>
                                              <tr class="hiderow{{$object->id}}" id="{{$object->id}}">
                                                  <td>{{$no++}}</td>
                                                  <td contenteditable="false"
                                                      class="edittable{{$object->id}} name">{{$object->name}}</td>
                                                  <td contenteditable="false"
                                                      class="edittable{{$object->id}} description ">{{$object->description}}</td>
                                                  <td>
                                                      <button class="btn btn-sm btn-info edit{{$object->id}}"
                                                              onclick="abcd({{$object->id}});">Edit
                                                      </button>
                                                      <button class="btn btn-sm btn-primary update_btn update{{$object->id}}"
                                                              onclick="update(this,'{{$object->id}}');">Update
                                                      </button>
                                                      |
                                                      <button class="btn btn-sm btn-danger"
                                                              onclick="deletecat({{$object->id}});">Delete
                                                      </button>
                                                  </td>
                                              </tr>
                                              </tbody>
                                          @endforeach
                                      @else
                                          <tbody>
                                          <tr>
                                              <td>No record Available</td>
                                              <td></td>
                                              <td></td>
                                              <td></td>

                                          </tr>

                                          </tbody>
                                      @endif

                                  </table>
                                  <div align="center">
                                      {{$alldata->links()}}
                                  </div>
                                  </section>
                              </div>

                          </div>
                      </div>
                  </section>
                  <section id="menu3">
                      <section id="item_list">
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         All Items
                         <button id="open_item_form" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>

                              </div>
                          </div>
                      </div>
                  </section>
                  </section>
                  <section id="item_form" >
                     --}}{{-- <section id="item_form" class="hidealways">--}}{{--
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Add Items
                      </span>
                                 --}}{{-- <div class="">--}}{{--
                                  <p class="clearfix"></p>
                                  <label>Name : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_name" class="form-control" placeholder="Enter Item Name">
                                  <p class="clearfix"></p>
                                  <label>Price : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_price" class="form-control" placeholder="Enter Item price">
                                  <p class="clearfix"></p>
                                  <label>Select Categories : </label><p class="clearfix"></p>
                                  @foreach($allcat as $object)
                                      <div class="label_checkbox">
                                      <div class="checkbox ">
                                          <label><input type="checkbox"  class="setchat_box" value="{{$object->id}}" id="CheckboxHead"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span>{{$object->name}}</label>
                                      </div>
                                      </div>
                                  @endforeach
                                  <p class="clearfix"></p>
                                  <label>Select Image : </label> <p class="clearfix"></p>
                                  <input type="file" name="item_pic" class="form-control" placeholder="Upload Item image">
                                  <p class="clearfix"></p>
                                  <label>Usage : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_usage" id="item_usage" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Usage "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Description : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_description" id="item_description" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Description "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Specifications : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_specifications" id="item_specifications" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Specifications "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Ingredients : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_ingredients" id="item_ingredients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Ingredients "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Nutrients : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_available_nutrients" id="item_available_nutrients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Available Nutrients "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Delivery : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_delivery" class="form-control" placeholder="Enter Your Delivery Information">
                                  <p class="clearfix"></p>
                              </div>
                          </div>
                      </div>

                  </section>--}}
            </div>
            <div class="row">
                <section id="menu1">
                    <div class="home_brics_row">


                        <a href="/ask"><div class="col-sm-3">
                                <?php $Askdata= \App\AskModel::count();?>

                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk"><i class="mdi mdi-cellphone-android"></i></div>
                                        <div class="white_brics_txt">Ask Caller</div>
                                        <div class="white_brics_count">{{$Askdata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr1"></div>
                                </div>
                            </div>
                        </a>
                        <a href="/blog">
                            <?php $blogdata= \App\Blogmodel::count();?>
                            <div class="col-sm-3">
                                <div class="white_brics">
                                    <div class="white_icon_withtxt">
                                        <div class="white_icons_blk white_brics_clr2"><i
                                                    class="mdi mdi-message-image"></i></div>
                                        <div class="white_brics_txt">Blog</div>
                                        <div class="white_brics_count">{{$blogdata}}</div>
                                    </div>
                                    <div class="brics_progress white_brics_border_clr2" style="
"></div>
                                </div>
                            </div>
                        </a>

                    </div>
                </section>


                {{--  <section id="menu2">
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         All Categories
                         <button id="open_modal" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>

                                  <div id="snackbar">New Categories added Successfully</div>
                                  <p class="clearfix"></p>
                                  <section id="mytablereload">
                                  <table class="table table-striped" id="mycattable">
                                      <thead>
                                      <tr>
                                          <th>Sr.</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Action</th>

                                      </tr>
                                      </thead>
                                      @if(count($alldata) > 0)
                                          @foreach($alldata as $object)
                                              <tbody>
                                              <tr class="hiderow{{$object->id}}" id="{{$object->id}}">
                                                  <td>{{$no++}}</td>
                                                  <td contenteditable="false"
                                                      class="edittable{{$object->id}} name">{{$object->name}}</td>
                                                  <td contenteditable="false"
                                                      class="edittable{{$object->id}} description ">{{$object->description}}</td>
                                                  <td>
                                                      <button class="btn btn-sm btn-info edit{{$object->id}}"
                                                              onclick="abcd({{$object->id}});">Edit
                                                      </button>
                                                      <button class="btn btn-sm btn-primary update_btn update{{$object->id}}"
                                                              onclick="update(this,'{{$object->id}}');">Update
                                                      </button>
                                                      |
                                                      <button class="btn btn-sm btn-danger"
                                                              onclick="deletecat({{$object->id}});">Delete
                                                      </button>
                                                  </td>
                                              </tr>
                                              </tbody>
                                          @endforeach
                                      @else
                                          <tbody>
                                          <tr>
                                              <td>No record Available</td>
                                              <td></td>
                                              <td></td>
                                              <td></td>

                                          </tr>

                                          </tbody>
                                      @endif

                                  </table>
                                  <div align="center">
                                      {{$alldata->links()}}
                                  </div>
                                  </section>
                              </div>

                          </div>
                      </div>
                  </section>
                  <section id="menu3">
                      <section id="item_list">
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         All Items
                         <button id="open_item_form" class="btn btn-default pull-right"><i
                                     class="mdi mdi-plus"></i>Add</button>
                      </span>

                              </div>
                          </div>
                      </div>
                  </section>
                  </section>
                  <section id="item_form" >
                     --}}{{-- <section id="item_form" class="hidealways">--}}{{--
                      <div class="col-sm-12 col-md-12 col-xs-12">
                          <div class="dash_boxcontainner white_boxlist">
                              <div class="upper_basic_heading"><span class="white_dash_head_txt">
                         Add Items
                      </span>
                                 --}}{{-- <div class="">--}}{{--
                                  <p class="clearfix"></p>
                                  <label>Name : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_name" class="form-control" placeholder="Enter Item Name">
                                  <p class="clearfix"></p>
                                  <label>Price : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_price" class="form-control" placeholder="Enter Item price">
                                  <p class="clearfix"></p>
                                  <label>Select Categories : </label><p class="clearfix"></p>
                                  @foreach($allcat as $object)
                                      <div class="label_checkbox">
                                      <div class="checkbox ">
                                          <label><input type="checkbox"  class="setchat_box" value="{{$object->id}}" id="CheckboxHead"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span>{{$object->name}}</label>
                                      </div>
                                      </div>
                                  @endforeach
                                  <p class="clearfix"></p>
                                  <label>Select Image : </label> <p class="clearfix"></p>
                                  <input type="file" name="item_pic" class="form-control" placeholder="Upload Item image">
                                  <p class="clearfix"></p>
                                  <label>Usage : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_usage" id="item_usage" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Usage "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Description : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_description" id="item_description" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Description "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Specifications : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_specifications" id="item_specifications" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Specifications "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Ingredients : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_ingredients" id="item_ingredients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Ingredients "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Nutrients : </label>
                                  <p class="clearfix"></p>
                                  <textarea name="item_available_nutrients" id="item_available_nutrients" class="form-control " rows="4" cols="50" placeholder="Enter Your Item Available Nutrients "></textarea>
                                  <p class="clearfix"></p>
                                  <label>Delivery : </label>
                                  <p class="clearfix"></p>
                                  <input type="text" name="item_delivery" class="form-control" placeholder="Enter Your Delivery Information">
                                  <p class="clearfix"></p>
                              </div>
                          </div>
                      </div>

                  </section>--}}
            </div>
        </div>
    </section>





    {{--////////////////////////////////////////////////*****Start Menu 3******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}


    <script>
       
    </script>


    {{--////////////////////////////////////////////////*****End Menu 3******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

{{--////////////////////////////////////////////////*****Start Menu 2******//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
    <script>
        function validate() {
            var cat_name = $('#cat_name').val();
            var cat_description = $('#cat_description').val();
            if (cat_name == "") {
                $('#cat_name').addClass("w3-border-red");
                return false;
            }
            else if (cat_description == "") {
                $('#cat_description').addClass("w3-border-red");
                return false;

            }
            else {
                sendcat();
            }
        }

        function sendcat() {
            var cat_name = $('#cat_name').val();
            var cat_description = $('#cat_description').val();
            $.ajax({
                type: "post",
                url: "{{url('add_cat')}}",
                data: "cat_name= " + cat_name + "&cat_description= " + cat_description,
                success: function (data) {
                    $('#snackbar').html('');
                    $('#snackbar').html('Categories added successfully');
                    $('#myModal').modal('hide');
                    myFunction();
                    $("#item_form").load(location.href + " #item_form");
                    $("#mytablereload").load(location.href + " #mytablereload");


                },
                error: function (data) {

                }
            });
        }

        $(document).ready(function () {
            $('#open_item_form').click(function () {
                $('#item_list').hide();
                $('#item_form').show();
            });
            $('#open_modal').click(function () {
                $('#myheader').html('');
                $('#mybody').html('');
                $('#myfooter').html('');
                $('#myheader').append('<div><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Add Categories</h4></div>');
                $('#mybody').append('<div class="panel-body dash_table_containner"><input type="text" class="form-control vRequiredTex" name="cat_name" placeholder="Enter Your Category Name " id="cat_name"><p class="clearfix"></p><textarea name="cat_description" id="cat_description" class="form-control vRequiredTex" rows="4" cols="50" placeholder="Enter Your Description "></textarea></p></div>');
                $('#myfooter').append('<button id="add_btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="validate();" class="btn btn-primary">Add</button>');
                $('#myModal').modal();
            });
        });

    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);

        }

        function abcd($id) {
            $('.edittable' + $id).attr('contenteditable', 'true');
            $('.edit' + $id).hide();
            $('.update' + $id).show();

        }
        function abcdd($id) {
            $('.edittable' + $id).attr('contenteditable', 'false');
            $('.edit' + $id).show();
            $('.update' + $id).hide();

        }
        function abcddd($id) {
            $('.edittable' + $id).attr('contenteditable', 'false');
            $('.edit' + $id).show();
            $('.update' + $id).hide();
            $('.hiderow' + $id).hide();

        }
        function update(dis, id) {
            var ID = id;
            var name = $(dis).parent().parent("#" + id).children('.name').html();
            var slug = $(dis).parent().parent("#" + id).children('.slug').html();
            var des = $(dis).parent().parent("#" + id).children('.description').html();
            /*alert(ID+one+two+three);*/
            $.ajax({
                type: "post",
                url: "{{url('updatecat')}}",
                data: "name= " + name + "&slug= " + slug + "&des= " + des + "&ID= " + ID,
                success: function (data) {
                    abcdd(ID);
                    $('#snackbar').html('');
                    $('#snackbar').html('Categories Updated successfully');
                    myFunction();
                    $("#item_form").load(location.href + " #item_form");


                },
                error: function (data) {
                    alert("Error")
                }
            });


        }
        function deletecat(id) {
            var ID = id;
            $.ajax({
                type: "post",
                url: "{{url('deletecat')}}",
                data: "&ID= " + ID,
                success: function (data) {
                    abcddd(ID);
                    $('#snackbar').html('')
                    $('#snackbar').html('Successfully Deleted');
                    myFunction();
                    $("#item_form").load(location.href + " #item_form");

                },
                error: function (data) {
                    alert("Error")
                }
            });

        }

    </script>
{{--///////////////////////////////////////////////////////////////////*****end Menu2*****//////////////////////////////////////////////////////////////////////////////////////////////////--}}
@stop
{{--$("#item_form").load(location.href + " #item_form");--}}
{{--window.location.reload();--}}
