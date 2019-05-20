<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Payments extends Model
{

     protected $table = 'payments';

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
        return $this->belongsTo(User::class);
    }


    
}
