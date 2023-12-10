<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $original_url
 * @property string $short_url
 * @property int $count
 */
class UrlShortener extends Model
{
    use HasFactory;

    protected $guarded = [];
}
