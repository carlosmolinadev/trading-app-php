<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'symbol';
    /**
     * @var bool
     */
    public $timestamps = false;
}
