<?php

namespace App\Models;

use Database\Factories\TicketFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $priority
 * @property int $status
 * @property int|null $assignee_id
 * @property int|null $issuer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $category_id
 * @property-read User|null $assignee
 * @property-read Category|null $category
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read User|null $issuer
 * @method static TicketFactory factory(...$parameters)
 * @method static Builder|Ticket newModelQuery()
 * @method static Builder|Ticket newQuery()
 * @method static Builder|Ticket query()
 * @method static Builder|Ticket whereAssigneeId($value)
 * @method static Builder|Ticket whereCategoryId($value)
 * @method static Builder|Ticket whereCreatedAt($value)
 * @method static Builder|Ticket whereDescription($value)
 * @method static Builder|Ticket whereId($value)
 * @method static Builder|Ticket whereIssuerId($value)
 * @method static Builder|Ticket wherePriority($value)
 * @method static Builder|Ticket whereStatus($value)
 * @method static Builder|Ticket whereTitle($value)
 * @method static Builder|Ticket whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Ticket extends Model
{
    use HasFactory;

    public const OPEN = 0;
    public const CLOSED = 1;

    protected $fillable = [
        'title',
        'description',
        'priority',
    ];

    protected $attributes = [
        'status' => self::OPEN
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issuer_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
