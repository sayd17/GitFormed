<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Models\User;
use App\Http\Resources\WatcherResource;
use App\Http\Requests\StoreWatcherRequest;

class WatcherController extends Controller
{
    public function index()
    {      
        // $user = Auth::user();
        // // dd($user); // Commenting out or removing this line
        // $usernameForAuthUser = User::where('email', $user->email)->get();
        // // dd($usernameForAuthUser); // You can uncomment this line to inspect $usernameForAuthUser
        // // Watcher::where('username', $usernameForAuthUser->username)->get()
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


