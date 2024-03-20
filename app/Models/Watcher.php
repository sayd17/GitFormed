<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;



class Watcher extends Model
{
    use HasFactory, SoftDeletes;

    public function users(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'username',
        'repo_name',
        'owner',
    ];
}
