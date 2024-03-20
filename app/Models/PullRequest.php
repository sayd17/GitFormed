<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class PullRequest extends Model
{
    use HasFactory;
    
    public function repository(): BelongsTo 
    {
        return $this->belongsTo(Repository::class);
    }
}
