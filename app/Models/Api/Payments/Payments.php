<?php

namespace App\Models\Api\Payments;

use Illuminate\Database\Eloquent\Model;

use App\Models\Api\Users\User;

class Payments extends Model
{

     protected $table = 'payments_api';

     protected $fillable = [
        'user_id',
        'paymentId',
        'type',
        'cardNumber',
        'returnCode',
        'returnMessage',
        'authorizationCode',
        'amount',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}