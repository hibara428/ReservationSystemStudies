<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function customerPlan()
    {
        return $this->hasOne(CustomerPlan::class);
    }

    public function customerOptions()
    {
        return $this->hasMany(CustomerOption::class);
    }
}
