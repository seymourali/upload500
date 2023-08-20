<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InvalidRecord
 *
 * @property int $id
 * @property mixed $row
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvalidRecord whereUserId($value)
 * @mixin \Eloquent
 */
class InvalidRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'row',
        'user_id'
    ];
}
