<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiKey
 *
 * @property string $public
 * @property string $private
 * @property int $exchange_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class ApiKey extends Model
{
    use HasFactory;
    protected $table = 'api_key';
    protected $fillable = [
        'public',
        'private',
        'exchange_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
