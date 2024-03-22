<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Http\Resources\WatcherResource;

class WatcherController extends Controller
{
    public function index()
    {
        return WatcherResource::collection(
            
            Watcher::query()->orderBy('id', 'desc')->paginate(10)
        );
    }
}


