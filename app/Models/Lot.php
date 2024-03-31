<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lot extends Model
{
    use HasFactory;

    protected $fillable  = ['name', 'starting_price', 'status', 'winner_user_id'];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'starting_price' => 'float',
            'status' => 'string',
            'winner_user_id' => 'int',
        ];
    }

    public function auction(): BelongsToMany
    {
        return $this->belongsToMany(Auction::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
