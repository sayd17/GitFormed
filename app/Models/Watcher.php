<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Watcher extends Model
{
    use HasFactory;

    public function users(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'username',
        'owner',
        'repo_name',
    ];

}
