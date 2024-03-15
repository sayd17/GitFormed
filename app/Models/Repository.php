<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PullRequest;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Repository extends Model
{
    use HasFactory;

    public function notifications() : HasMany 
    {
        return $this->hasMany(Notification::class);
    }
    
    public function pullRequests() : HasMany 
    {
        return $this->hasMany(PullRequest::class);
    }
}
