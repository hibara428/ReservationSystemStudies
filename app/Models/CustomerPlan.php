<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPlan extends Model
{
    use HasFactory;

    public function servicePlan()
    {
        return $this->hasOne(ServicePlan::class, 'id', 'service_plan_id');
    }
}
