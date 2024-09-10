<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 *
 * @property integer $user_id
 * @property string $date
 * @property string $check_in
 * @property string $check_out
 * @property float $number_working_hours
 */
class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'number_working_hours',
    ];
}
