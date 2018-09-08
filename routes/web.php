<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::GET('lgt', function () {
    session_start();
    $_SESSION['admin_master'] = null;
    $_SESSION['user_master'] = null;
    return redirect('/access');
});
Route::GET('logout', function () {
    session_start();
    $_SESSION['admin_master'] = null;
    $_SESSION['user_master'] = null;
    return redirect('/');
});
Route::get('/', 'FrontendController@user_home');
Route::get('my_profile', 'FrontendController@my_profile');
Route::get('product_list', 'FrontendController@product_list');
Route::get('order_list', 'FrontendController@order_list');
Route::get('product_feedback', 'FrontendController@product_feedback');
Route::post('submit_feedback', 'FrontendController@submit_feedback');
Route::get('mycart', 'FrontendController@mycart');
Route::get('checkout', 'FrontendController@checkout');
Route::get('pd', 'FrontendController@product_details');
Route::get('view_product/{slug}', 'FrontendController@product_details');

Route::post('login', 'FrontendController@login');
Route::post('profile_update', 'FrontendController@profile_update');
Route::get('removeProfile', 'APIController@removeProfile'); //Profile
Route::get('getexistaddress', 'FrontendController@getexistaddress');
Route::get('address_update', 'FrontendController@address_update');
Route::post('change_p', 'FrontendController@change_password');
Route::post('confirm_order', 'FrontendController@confirm_order');
Route::get('web_check_promo','FrontendController@web_check_promo');



Route::get('cart_load', 'CartController@cartload');
Route::post('cart_update/{id}', 'CartController@cart_update');
Route::get('addtocart', 'CartController@addtocart');
//Route::get('cart_delete/{id}', 'CartController@delete');
Route::get('cart_delete', 'CartController@delete');



Route::get('view_item', 'FrontendController@view_item');
Route::get('getmoreproducts', 'FrontendController@getmoreproducts');
Route::get('getFabricproducts', 'FrontendController@getFabricproducts');
Route::get('getPriceproducts', 'FrontendController@getPriceproducts');

Route::get('/payment', 'CartController@payment');
Route::post('success', 'CartController@payment_success');
Route::post('failed', 'CartController@payment_failed');

Route::get('blogs', 'FrontendController@blog_list');
Route::get('view_blog/{slug}', 'FrontendController@view_blog');


Route::get('about', 'FrontendController@about');
Route::get('contact_us', 'FrontendController@contact_us');
Route::get('return_policy', 'FrontendController@return_policy');
Route::get('terms_conditions', 'FrontendController@terms_conditions');
Route::get('book_appointment', 'FrontendController@book_appointment');
Route::get('take_appointment', 'FrontendController@take_appointment');
Route::get('notify', 'FrontendController@notify');
Route::get('subscribe', 'FrontendController@subscribe');

Route::get('register_user', 'User_loginController@register');
Route::get('login_user', 'User_loginController@login');
Route::get('checkno', 'User_loginController@checkno');
Route::get('checkemail', 'User_loginController@checkemail');
Route::get('verify_otp', 'User_loginController@verify_otp');
Route::get('forgot_password', 'User_loginController@forgot_password');
Route::get('ask_number','AskController@ask_number');


Route::get('testimonials','TestimonialsController@list');
Route::get('/addtstimonials','TestimonialsController@addtstimonials');
Route::get('/inactivetest','TestimonialsController@inactivetest');
Route::get('/activetest','TestimonialsController@activetest');
Route::get('/deletetest','TestimonialsController@deletetest');
Route::get('subscribe_list','SubscribeController@view');

//////////////////////////////////////*********Stitches*************////////////////////////////////////////////////////////////////////////////////////////

Route::get('stitches_list','StitchesController@stitches_list');
Route::get('add_stitches','StitchesController@add_stitches');
Route::get('update_stitches','StitchesController@update_stitches');
Route::get('delete_stitches','StitchesController@delete_stitches');

//////////////////////////////////////*********Stitches//////////////////////////////

/*************API******************/
Route::get('getCategory','APIController@getCategory');
Route::get('getItem_bycid','APIController@get_item_by_cid');
Route::get('getItem','APIController@get_item_by_id');
Route::get('getlogin','APIController@getlogin');
Route::post('getregister','APIController@getregister');
Route::get('change_password','APIController@change_password');
Route::post('edit_profile','APIController@edit_profile');
Route::post('insert_user_address','APIController@insert_user_address');
Route::post('update_user_address','APIController@update_user_address');
Route::get('getaddress','APIController@getaddress');
Route::get('getaddressbyid','APIController@getaddressbyid');

Route::post('insert_review','APIController@insert_review');
Route::get('getreview','APIController@getreview');
Route::get('delivery_charge','APIController@delivery_charge');
Route::get('searchitem','APIController@searchitem');
Route::get('check_promo','APIController@check_promo');
Route::post('confirm_checkout','APIController@confirm_checkout');
Route::get('getOrders','APIController@getOrders');
/*************API******************/


/////////////////////////////////******Aditya***********/////////////////////////////////////////////////////////////////////////

///////////////////////////////admin/////////////////////////////////////////////////////////////////////////////////////////
Route::get('/admin', 'AdminController@admin');
Route::get('/access', 'AdminController@adminlogin');
Route::get('/logincheck', 'AdminController@logincheck');
/////////////////////******Category*****///////////////////////////////////////////////////////////////////////////////
Route::get('/category', 'AdminController@category');
Route::post('add_cat', 'CrudController@add_cat');
Route::post('updatecat', 'CrudController@updatecat');
Route::post('deletecat', 'CrudController@deletecat');
/////////////////////////*******item******//////////////////////////////////////////////////////////////////
Route::get('/items', 'ItemmasterController@items');
Route::get('/send_cat_price', 'ItemmasterController@send_cat_price');
Route::get('/update_item', 'ItemmasterController@update_item');
Route::post('mypost', 'ItemmasterController@itemsadd');
Route::get('itemshow/{id}', 'ItemmasterController@itemshow');
Route::get('edit_item_show/{id}', 'ItemmasterController@edit_item_show');
Route::get('deactivate_item', 'ItemmasterController@deactivate_item');
Route::get('activatemy_item', 'ItemmasterController@activatemy_item');
Route::post('itemeditpost', 'ItemmasterController@itemeditpost');
Route::get('searchtable', 'ItemmasterController@searchtable');
/////////////////////////////////////////api///////////////////////////////////////////////////////
/*Route::get('firstapi', 'ItemmasterController@apishowall');*/
///////////////////////////////////////////////////////////////////////////////////////////
Route::get('/userlist', 'User_loginController@userlist');
Route::get('/deactivate_user', 'User_loginController@deactivate_user');
Route::get('/activate_user', 'User_loginController@activate_user');
Route::get('/usershow/{id}', 'User_loginController@usershow');
////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/review', 'ReviewController@review');
Route::get('/activate_review', 'ReviewController@activate_review');
Route::get('/un_activate_review', 'ReviewController@un_activate_review');
///////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/orderlist', 'OrderController@orderlist');
Route::get('/ordered', 'OrderController@ordered');
Route::get('/packed', 'OrderController@packed');
Route::get('/shipped', 'OrderController@shipped');
Route::get('/delivered', 'OrderController@delivered');
Route::get('/active_order', 'OrderController@active_order');
Route::get('/inactive_order', 'OrderController@inactive_order');
Route::get('/more_order/{id}', 'OrderController@more_order');
Route::get('/bill_order/{id}', 'OrderController@bill_order');
Route::get('delete_item_pic', 'ItemmasterController@delete_item_pic');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/statelist', 'StateController@statelist');
Route::get('/add_state', 'StateController@add_state');
Route::get('/update_state', 'StateController@update_state');
Route::get('/delete_state', 'StateController@delete_state');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/citylist', 'CityController@citylist');
Route::get('/add_city', 'CityController@add_city');
Route::get('/add_updatecity', 'CityController@add_updatecity');
Route::get('/delete_city', 'CityController@delete_city');
////////////////////////////////*********Settings***********///////////////////////////////////////////////////////////////////////////////////////////
Route::get('/settings/{id}', 'SettingController@settings');
Route::get('/changepass', 'SettingController@changepass');
Route::post('myadminpost', 'SettingController@myadminpost');





//////////////////////////////////////*********delivery*************////////////////////////////////////////////////////////////////////////////////////////

Route::get('/delivery','DeliveryController@delivery');
Route::get('/add_delivery','DeliveryController@add_delivery');
Route::get('/update_delivery','DeliveryController@update_delivery');
Route::get('/delete_del','DeliveryController@delete_del');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/ask','AskController@ask');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/blog','BlogController@blog');
Route::get('/addblogcat','BlogController@addblogcat');
Route::get('/blogpost','BlogController@blogpost');
Route::post('/blogpic','BlogController@blogpic');
Route::get('/updateblog/{id}','BlogController@updateblog');

Route::GET('logoutadmin', function () {
    session_start();
    $_SESSION['admin_master'] = null;
    return redirect('/adminlogin');
});

