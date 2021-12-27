<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOption extends Model
{
    use HasFactory;

    public function serviceOption()
    {
        return $this->hasOne(ServiceOption::class, 'id', 'service_option_id');
    }
}
