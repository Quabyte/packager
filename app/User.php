<?php

namespace App;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'address',
        'postal_code',
        'country',
        'telephone',
        'tc_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if (Auth::user()->isAdmin)
        {
            return true;
        }

        return false;
    }

    public static function hasOrders($userID)
    {
        $orders = Order::where('user_id', '=', $userID)->get();

        if ($orders->count()) {
            return true;
        } else {
            return false;
        }
    }

    public static function listOrders($userID)
    {
        $orders = Order::where([
            ['user_id', '=', $userID],
            ['status', '=', 'completed']
        ])->get();

        return $orders;
    }
}
