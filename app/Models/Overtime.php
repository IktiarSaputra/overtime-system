<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OAS\Schema(
 *   schema="Overtime",
 *   type="object",
 *   required={"id", "employee_id", "date", "hours"},
 * )
 * Class Overtime
 * @package App\Models
 *
 */
class Overtime extends Model
{
    use HasFactory;

    /**
     * Get the Employee that owns the Overtime
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
