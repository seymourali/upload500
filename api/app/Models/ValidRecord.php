<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ValidRecord
 *
 * @property int $id
 * @property mixed $row
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ValidRecord whereUserId($value)
 * @mixin \Eloquent
 */
class ValidRecord extends Model
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
