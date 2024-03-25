<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Http\Resources\WatcherResource;
use App\Http\Requests\StoreWatcherRequest;

class WatcherController extends Controller
{
    public function index()
    {
        return WatcherResource::collection(
            
            Watcher::query()->orderBy('id', 'desc')->paginate(10)
        );
    }
    
    public function store(StoreWatcherRequest $request)
    {
        $data = $request->validated();
        $watcher = Watcher::create([
            'username' => $data['username'],
            'repo_name' => $data['repo_name'],
            'owner' => $data['owner'],
        ]);

        return response(new WatcherResource($watcher), 201); // created new resource on the server
    }
}


