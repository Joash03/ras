<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function advanceSalary()
    {
        return $this->hasOne(AdvanceSalary::class, 'employee_id', 'employee_id');
    }

    public function paySalary()
    {
        return $this->hasOne(PaySalary::class, 'employee_id', 'employee_id');
    }

    public function attendace()
    {
        return $this->hasOne(Attendace::class, 'employee_id', 'employee_id');
    }
}
