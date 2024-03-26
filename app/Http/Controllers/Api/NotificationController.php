<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;
use App\Http\Requests\StoreNotificationRequest;

class NotificationController extends Controller
{
    public function index(){
        return NotificationResource::collection(

            Notification::query()->orderBy('id', 'desc')->paginate(10)
        ); 

    }

    public function store(StoreNotificationRequest $request)
    {
        $data = $request->validated();
        $notification = Notification::create([
            'username' => $data['username'],
            'owner' => $data['owner'],
            'repo_name' => $data['repo_name'],
        ]);
        $notification = Notification::create($data);
        return response(new NotificationResource($notification), 201); // created new resource on the server
    }
}
