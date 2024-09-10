<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property integer $user_id
 * @property string $date
 * @property string $send_at

 */
class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'message',
        'send_at',
    ];
}
