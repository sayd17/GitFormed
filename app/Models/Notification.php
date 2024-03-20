<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Repository;


class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'owner',
        'repo_name'
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    
    public function repository(): BelongsTo 
    {
        return $this->belongsTo(Repository::class);
    }
}
