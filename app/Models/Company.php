<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * HasMany tasks
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function scopesearchByName(Builder $builder, string $search)
    {
        $builder->where('name', 'like', "%{$search}%")
            ->orWhereHas('tasks', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
    }
}
