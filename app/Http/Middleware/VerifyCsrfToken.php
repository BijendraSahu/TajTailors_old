<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'add_cat',
        'updatecat',
        'deletecat',
        'itempost',
        'mypost',
        'mypost/{data}/itemsadd',
        'itemeditpost',
        'login', 'getregister', 'edit_profile', 'insert_user_address', 'update_user_address', 'insert_review', 'profile_update', 'address_update', 'change_p', 'confirm_order', 'submit_feedback','confirm_checkout','myadminpost',
        'blogpic','failed','success','take_appointment'
    ];
}
