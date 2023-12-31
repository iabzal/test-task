<?php

declare(strict_types = 1);

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static when(mixed $q, Closure $param)
 * @method static create(array $array)
 * @method static Client findOrFail(int $id)
 * @method static where(array $array)
 * @method static count()
 * @method pluck(string $string)
 * @property int $id
 * @property string $full_name
 * @property string $title
 * @property string $phone_number
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $start_time
 * @property string $end_time
 * @property int $max_test_count
 * @property string $logo
 * @property boolean $is_show_branding
 */
class Client extends Authenticatable
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'login',
        'password',
    ];

    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];
}
