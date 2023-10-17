<?php

declare(strict_types = 1);

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static when(mixed $q, Closure $param)
 * @method static create(array $array)
 * @method static Client findOrFail(int $id)
 * @method static where(array $array)
 * @method static count()
 * @method static latest()
 * @property int $id
 * @property int $question_id
 * @property string $answer
 */
class Answer extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'answer',
    ];

    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
