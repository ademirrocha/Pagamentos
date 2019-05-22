<?php

namespace App\Models\Api\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Api\Payments\Payments;

class User extends Model
{
    protected $table = 'users_api';

    protected $fillable = [
        'name', 'email', 'cpf', 'token', 
    ];

    public function payments(){
        return $this->hasMany(Payments::class,  'user_id');
    }
}
