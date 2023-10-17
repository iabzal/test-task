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
 * @method static Question findOrFail(int $id)
 * @method static where(array $array)
 * @method static count()
 * @method static orderByDesc(string $string)
 * @method static latest()
 * @property int $id
 * @property string $title
 * @property string $message
 * @property int $category_id
 * @property ?int $subcategory_id
 * @property int $client_id
 * @property string $file
 */
class Question extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'message',
        'category_id',
        'subcategory_id',
        'client_id',
        'file',
        'status',
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
