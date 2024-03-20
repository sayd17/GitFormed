<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'repo_name',
        'no_of_watchers'
    ];

    public function users(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}

