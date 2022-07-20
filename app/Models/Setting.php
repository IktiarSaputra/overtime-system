<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OAS\Schema(
 *   schema="Setting",
 *   type="object",
 *   required={"id", "key", "value"},
 * )
 * Class Setting
 * @package App\Models
 *
 */

class Setting extends Model
{
    use HasFactory;
}
