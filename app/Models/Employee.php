<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
     * @OAS\Schema(
     *   schema="Employee",
     *   type="object",
     *   required={"id", "name", "salary"},
     * )
     * Class Employee
     * @package App\Models
     *
     */

class Employee extends Model
{
    use HasFactory;

    /**
     * Get all of the overtime for the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    
    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }
}
